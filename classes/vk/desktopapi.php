<?php defined('SYSPATH') OR die('No direct access allowed.');


class VK_DesktopApi extends Vk_DocumentedApi{

	/*
	 *  New format: http://vkontakte.ru/developers.php?oid=-1&p=%D0%9F%D1%80%D0%B0%D0%B2%D0%B0_%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0_%D0%BF%D1%80%D0%B8%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D0%B9
		Код	Описание
		+1	Пользователь разрешил отправлять ему уведомления.
		+2	Доступ к друзьям.
		+4	Доступ к фотографиям.
		+8	Доступ к аудиозаписям.
		+16	Доступ к видеозаписям.
		+32	Доступ к предложениям.
		+64	Доступ к вопросам.
		+128	Доступ к wiki-страницам.
		+256	Добавление ссылки на приложение в меню слева.
		+512	Добавление ссылки на приложение для быстрой публикации на стенах пользователей.
		+1024	Доступ к статусам пользователя.
		+2048	Доступ заметкам пользователя.
		+4096	(для Desktop-приложений) Доступ к расширенным методам работы с сообщениями.
		+8192	Доступ к обычным и расширенным методам работы со стеной.
	 */
    private $accessLevels = array(
        1,2,4,8,16,32,64,128,256,512,1024,2048,4096,8192
    );

    private $appToken;
    private $op_history = array();
    
    // Instances
	protected static $instance;
	
	/**
	 * @static
	 * @throws Exception
	 * @param string $config
	 * @return VK_DesktopApi
	 */
    public static function Instance($config='default')
	{
		if(is_array($config))
		{
			$instanceId = $config['user_email'].$config['app_id'];
		}
		else if(is_string($config) && $cfg_sect = Kohana::config('vk.'.$config))
		{
			$instanceId = $config;
			$config = $cfg_sect;
		}
		else{
			throw new Exception('$config is not an array or a config section id');
		}

		if ( ! isset(self::$instance[$instanceId]))
		{
			self::$instance[$instanceId] = new self($config);
		}
		return self::$instance[$instanceId];
	}

	protected $config;

    public function __construct(&$config){
		$this->config = $config;
        $code = $this->LoginUser($config['user_email'],$config['user_pass']);
		$this->LoginApp($code);
    }
    public function __wakeup(){
        $this->op_history = array();
    }
    public function __call($name,$args){
        if(strpos($name,'_') > 0){
            $name = str_replace('_','.',$name);
        }
        return $this->Call($name,count($args) == 1 ? array($args[0]) : $args);
    }
    public function Execute($code,$debug=false,$testmode=false){
       if($debug){
           var_dump($code);
       }
       return $this->Call(
           'execute',
            array(
               'code'=>$code,
               'test_mode'=>$testmode ? '1' : '0'
            )
       );
    }

    public function Call($method, array $params = array()){
        if($this->AppSessionExpired()){
            $this->LoginApp();
        }
		$params['api_id'] = $this->config['app_id'];
        $params['method'] = $method;
        //sig
		if (!isset($params['v'])) $params['v'] = '3.0';
		if (!isset($params['format']))$params['format'] = 'json';

        //signature gen
		ksort($params);
		$sig = '';
		foreach($params as $k=>$v) {
			$sig .= $k.'='.$v;
		}
		$sig = $this->appCookies['mid'] . $sig . $this->appCookies['secret'];

        $params['sig'] = md5($sig);
        $params['sid'] = $this->appCookies['sid'];

		$query = $this->curl($this->config['api_url'],$params);
		$res = (array)json_decode($query['contents'], true);

        if(!isset($res['response'])){
            ob_start();
				echo "<h4>VK Response:</h4>";
				var_dump($res);
				echo "<h4>Request history:</h4>";
				var_dump($this->op_history);
            $e_data = ob_get_clean();
			
            if(isset($res['error'])){
                 throw new VK_Exception('Error: '.$res['error']['error_code'].' - '.$res['error']['error_msg'],$e_data);
            }

            throw new Exception('Unknown response');
        }
		return $res['response'];

    }
    
    private function LoginUser($email,$password){
        //This gonna get us login form, as no cookies provided
        $login_page = $this->Curl('https://api.vk.com/oauth/authorize',array(
            'client_id'=>$this->config['app_id'],
            'redirect_uri' => 'blank.html',
            'display' => 'wap',
            'scope' =>  $this->GetFullAccessMask(),
            'response_type'=>'code'
        ),array(CURLOPT_FOLLOWLOCATION => true,CURLOPT_COOKIEJAR=>true));

        $nokopage = Nokogiri::fromHtml($login_page['contents']);
        $form = $nokopage->get('form')->toArray();
        $form = $form[0];

        $params = array();
        foreach($nokopage->get('form input')->toArray() as $i){
            $i['name'] = isset($i['name']) ? $i['name'] : '';
            $i['value'] = isset($i['value']) ? $i['value'] : '';
            $params[$i['name']] = $i['value'];
        }
        $params['email'] = $email;
        $params['pass']  = $password;

        $auth_result_form = $this->Curl($form['action'],$params,array(
            CURLOPT_POST => $form['method'] == 'POST' ? true : false,
            CURLOPT_COOKIEJAR=>true
        ));

        if(strpos($auth_result_form['contents'],'Login success')===false){
            //Stage 2: Granting perms
            $nokopage = Nokogiri::fromHtml($auth_result_form['contents']);
            $form = $nokopage->get('form')->toArray();
            $params = array();
            foreach($nokopage->get('form input')->toArray() as $i){
                $params[$i['name']] = $i['value'];
            }

            $auth_result_form = $this->Curl($form['action'],$params,array(
                CURLOPT_POST => $form['method'] == 'POST' ? true : false,
                CURLOPT_COOKIEJAR=>true
            ));
        }
        $rurl = $auth_result_form['info']['url'];
        if(($erroffset = strpos($rurl,'error_description=')) !== false){
            throw new Exception(substr($rurl,urldecode($erroffset)));
        }
        preg_match('/code=([a-zA-Z0-9]+)/',$rurl,$code);
        return $code[1];
    }

    private function LoginApp(){
        $loginResult = $this->curl($this->config['applogin_url'],
            array(
                'app'=>$this->config['app_id'],
                'layout'=>'popup',
                'type'=>'browser',
                'settings'=>$this->GetFullAccessMask()
            ),
            array(
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_COOKIE =>$this->getUserCookieStr()
            )
        );

        if(strstr($loginResult['info']['url'],'login.php')){
            throw new VK_Exception("User must add proxy app and allow interaction",$loginResult['contents']);
            /* needs figurin out
            $hash = preg_match("/var auth_hash = '([0-9a-fA-F]{18})'/",$loginResult['contents'],$loginHash);
            var_dump($hash);die();
            $this->curl($this->loginUrl,array(),array(
                CURLOPT_POSTFIELDS => $this->params(array(
                    'act'=>'',
                    'app'=>$this->appId,
                    'hash'=>'',
                    'permanent'=>'1'
                ))
            ));*/
        }

        if(strstr($loginResult['info']['url'],'login_fail')){
            throw new Exception('Wrong User Cookie');
        }
        
        $loginResponse = explode('session=',$loginResult['info']['url']);
        if(!isset($loginResponse[1])){
            ob_start();
            var_dump($loginResult);
            throw new Exception('Unexpected response:\n'.ob_get_clean());
        }
        $this->appCookies =  (array)json_decode(urldecode($loginResponse[1]));
    }

    private function GetFullAccessMask(){
        $sum = 0;
        foreach($this->accessLevels as $l){
            $sum+=$l;
        }
        return $sum;
    }
    private function AppSessionExpired(){
        return $this->appCookies==null || ($this->appCookies['expire'] < time() && $this->appCookies['expire'] > 0);
    }

    protected function Curl($address, $params, $options = null){
        if(isset($options[CURLOPT_POST]) && $options[CURLOPT_POST] === true){
            $options[CURLOPT_POSTFIELDS] = $params;
            $params = array();
        }

        $address .= '?'.$this->Params($params);

        //now just init that
        $c = curl_init($address);

        //opts
        $defaultOptions = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLINFO_HEADER_OUT => true
        );
        foreach($defaultOptions as $k=>$v){
            if(!isset($options[$k])){
                $options[$k] = $v;
            }
        }
        foreach($options as $k=>$v){
            if(($k == CURLOPT_COOKIEJAR || $k == CURLOPT_COOKIEFILE ) && $v == true){
                $v = '/tmp/curl_cookies';
                $options[CURLOPT_COOKIEJAR] = $v;
            }
            curl_setopt($c,$k,$v);
        }

        //and the actual work
        $return = curl_exec($c);
        $info = curl_getinfo($c);
        curl_close($c);

        if(isset($options[CURLOPT_COOKIEJAR]) && $options[CURLOPT_COOKIEJAR]){
            if(file_exists($options[CURLOPT_COOKIEJAR])){
                $info['cookiejar'] = file_get_contents($options[CURLOPT_COOKIEJAR]);
				unlink($options[CURLOPT_COOKIEJAR]);
            }else{
                throw new Exception("Cookie was demanded, but can't retrive from curl file");
            }
        }
        $resp = array('info'=>$info,'contents'=>$return);
        $this->op_history[] = $address;//array('request'=>$address,'response'=>$resp);
        return $resp;
    }
	
    protected function Params($params)
	{
        if(!is_array($params)){return $params;}
        
		$piece = array();
		foreach($params as $k=>$v) {
			$piece[] = $k.'='.urlencode($v);
		}
		return implode('&',$piece);
	}
}
