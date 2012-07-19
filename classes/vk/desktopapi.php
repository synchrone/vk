<?php defined('SYSPATH') OR die('No direct access allowed.');


class VK_DesktopApi extends VK_Api{

    private $accessLevels = array(
        //'notify', //Пользователь разрешил отправлять ему уведомления.
        'friends', //Доступ к друзьям.
        'photos', //Доступ к фотографиям.
        'audio', //Доступ к аудиозаписям.
        'video', //Доступ к видеозаписям.
        'docs', //Доступ к документам.
        'notes', //Доступ заметкам пользователя.
        'pages', //Доступ к wiki-страницам.
        'offers', //Доступ к предложениям (устаревшие методы).
        'questions', //Доступ к вопросам (устаревшие методы).
        'wall', //Доступ к обычным и расширенным методам работы со стеной.
        'groups', //Доступ к группам пользователя.
        'messages', //(для Standalone-приложений) Доступ к расширенным методам работы с сообщениями.
        'ads', //Доступ к расширенным методам работы с рекламным API.
        'offline'	//Доступ к API в любое время со стороннего сервера.
    );

    private $op_history = array();
    protected $config;
	protected static $instance;
	
	/**
	 * @static
	 * @throws Exception
	 * @param string $config
	 * @return VK_DesktopApi
	 */
    public static function Instance($config=null)
	{
        $config = $config !== null ? $config : 'default';

		if(is_array($config))
		{
			$instanceId = sha1(serialize($config));
		}
		else if(is_string($config) && $cfg_sect = Kohana::config('vk.'.$config))
		{
			$instanceId = $config;
			$config = $cfg_sect;
		}
		else{
			throw new Exception('$config is not an array or a config section id');
		}
        $classname = get_called_class();
		if ( ! isset(self::$instance[$instanceId]))
		{

			self::$instance[$instanceId] = new $classname($config);
		}
		return self::$instance[$instanceId];
	}

    public function __construct(&$config){
		$this->config = $config;
    }
    public function __wakeup(){
        $this->op_history = array();
    }
    public function __call($name,$args){
        if(strpos($name,'_') > 0){
            $name = str_replace('_','.',$name);
        }
        return $this->Call($name,count($args) == 1 ? $args[0] : $args);
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
        $params['access_token'] = $this->LoginApp();
		$query = $this->curl('https://api.vk.com/method/'.$method,$params,array(CURLOPT_POST=>true));
		$res = (array)json_decode($query['contents'], true);

        if(!isset($res['response'])){
            ob_start();
				echo "<h4>VK Response:</h4>";
				var_dump($res);
				echo "<h4>Request history:</h4>";
				var_dump($this->op_history);
            $e_data = ob_get_clean();

            if($res['error']['error_code'] == 14){
                throw new VK_Exception_Captcha($query['info'],$res['error']);
            }
			
            if(isset($res['error'])){
                 throw new VK_Exception('Error: '.$res['error']['error_code'].' - '.$res['error']['error_msg'],$e_data);
            }

            throw new Exception('Unknown response'."\n".$e_data);
        }
		return $res['response'];
    }

    /**
     * @return string App auth code
     * @throws Exception
     */
    private function LoginUser(){
        //This gonna get us login form, as no cookies provided
        $last_request = $this->Curl('https://api.vk.com/oauth/authorize',array(
            'client_id'=>$this->config['app_id'],
            'redirect_uri' => 'blank.html',
            'display' => 'wap',
            'scope' =>  $this->GetFullAccessMask(),
            'response_type'=>'code'
        ),array(CURLOPT_FOLLOWLOCATION => true, CURLOPT_COOKIESESSION => true));

        $last_request_info = end($last_request['info']);
        if($last_request_info['http_code'] != 200){throw new VK_Exception('Cannot get user auth form',$last_request);}

        $nokopage = Nokogiri::fromHtml($last_request['contents']);
        $form = $nokopage->get('form')->toArray();
        $form = $form[0];

        $params = array();
        foreach($nokopage->get('form input')->toArray() as $i){
            $i['name'] = isset($i['name']) ? $i['name'] : '';
            $i['value'] = isset($i['value']) ? $i['value'] : '';
            if($i['type']=='submit'){continue;}
            $params[$i['name']] = $i['value'];
        }
        $params['email'] = $this->config['user_email'];
        $params['pass']  = $this->config['user_pass'];

        $last_request = $this->Curl($form['action'],$params,array(
            CURLOPT_POST => $form['method'] == 'POST' ? true : false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_COOKIE => $last_request['cookie']
        ));
        if(strpos($last_request['contents'],'неверный логин')!==false){
            throw new Exception('Wrong auth data');
        }

        if(strpos($last_request['contents'],'Login success')===false){
            //Stage 2: Granting perms
            $nokopage = Nokogiri::fromHtml($last_request['contents']);
            $form = $nokopage->get('form')->toArray();
            if(!isset($form[0])){
                throw new Exception('No forms on stage 2 html',$last_request['contents']);
            }
            $form = $form[0];
            if(substr($form['action'],0,4) != 'http'){$form['action'] = 'http://api.vk.com'.$form['action'];}

            $params = array();
            foreach($nokopage->get('form input')->toArray() as $i){
                $i['name'] = isset($i['name']) ? $i['name'] : '';
                $i['value'] = isset($i['value']) ? $i['value'] : '';
                $params[$i['name']] = $i['value'];
            }

            $last_request = $this->Curl($form['action'],array(),array(
                CURLOPT_POST => true, //$form['method'] == 'POST' ? true : false,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_COOKIE => $last_request['cookie']
            ));
        }

        $rurl = end($last_request['info']);
        $rurl=$rurl['url'];
        if(($erroffset = strpos($rurl,'error_description=')) !== false){
            throw new Exception(substr($rurl,urldecode($erroffset)));
        }
        preg_match('/code=([a-zA-Z0-9]+)/',$rurl,$code);
        return $code[1];
    }

    /**
     * @param string $code App auth code returned by user
     * @return string VK API Token
     * @throws Exception
     */
    public function LoginApp($code = null){
        if(isset($this->config['token']) && //authd
                is_array($this->config['token']) &&
                $this->config['token']['access_token'] !== null && //got a token
                (
                    $this->config['token']['expire_time'] != -1 || //infinite
                    $this->config['token']['expire_time'] < time() //or not expired
                )
        ){
            return $this->config['token']['access_token'];
        }

        if($code === null){
            $code = $this->LoginUser();
        }
        $token = $this->Curl('https://api.vk.com/oauth/access_token',array(
            'client_id' => $this->config['app_id'],
            'client_secret' => $this->config['app_secret'],
            'code' => $code
        ));
        $token = json_decode($token['contents'],true);
        if(isset($token['error'])){
            throw new Exception($token['error_description'],$token['error']);
        }
        if($token['expires_in'] > 0){ $token['expire_time'] = time() + $token['expires_in']; }else{
            $token['expire_time'] = -1;
        }
        $this->config['token'] = $token;
        return $token['access_token'];
    }

    private function GetFullAccessMask(){
        return implode(',',$this->accessLevels);
    }

    protected function Curl($address, $params = null, $options = null,$redirect_count=0){
        if(isset($options[CURLOPT_MAXREDIRS]) && $redirect_count > $options[CURLOPT_MAXREDIRS]){
            throw new Exception('Max redirect count exceeded');
        }

        if(isset($options[CURLOPT_POST]) && $options[CURLOPT_POST] === true){
            $options[CURLOPT_POSTFIELDS] = $params;
            $params = array();
        }

        if($params != null && !empty($params)){ $address .= '?'.$this->Params($params);}

        //now just init that
        $c = curl_init($address);

        //opts
        $defaultOptions = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_AUTOREFERER => true,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_HEADER => true
        );
        foreach($defaultOptions as $k=>$v){
            if(!isset($options[$k])){
                $options[$k] = $v;
            }
        }
        if(isset($options[CURLOPT_HTTPHEADER]) && is_array($options[CURLOPT_HTTPHEADER])){//possibly check on existence
            $options[CURLOPT_HTTPHEADER][] = 'Expect:';
        }else{
            $options[CURLOPT_HTTPHEADER]= array('Expect:');
        }
        $options[CURLOPT_FOLLOWLOCATION]=false;//gonna handle that myself
        foreach($options as $k=>$v){
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

        if(isset($options[CURLOPT_HEADER]) && $options[CURLOPT_HEADER]===true){
            $set_cookie = array();
            $headers = substr($return,0,$info['header_size']);
            $return = substr($return,$info['header_size']);

            $responses_headers = explode("\r\n\r\n",trim($headers));
            foreach($responses_headers as &$headers){
                $str_headers = explode("\r\n",$headers);
                $headers = array();
                foreach($str_headers as $header){
                    $header = explode(': ',$header);
                    if(count($header) == 2){
                        $headers[$header[0]] = $header[1];

                        if($header[0]=='Set-Cookie'){
                            $set_cookie[] = $header[1];
                        }
                    }else if(strpos($header[0],'HTTP')!==false){
                        $headers['HTTP'] = $header[0];
                    }
                }
            }
            $info['response_header'] = $responses_headers;


            $cookies = array();
            //covering the cookies we had
            if(isset($options[CURLOPT_COOKIE]) && strlen($options[CURLOPT_COOKIE]) > 0){
                foreach(explode('; ',$options[CURLOPT_COOKIE]) as $cookie){
                    $cookie = explode('=',$cookie);
                    $cookies[$cookie[0]] = $cookie[1];
                }
            }
            //overwriting with what we got
            foreach($set_cookie as $cookie){
                $cookie = explode('; ',$cookie);
                $cookie = explode('=',$cookie[0]);
                $cookies[$cookie[0]] = $cookie[1];
            }

            $str_cookies = array();
            foreach($cookies as $n=>$v){
                $str_cookies[] = $n.'='.$v; //then re-collapsing back to header string
            }
            $info['cookie'] = implode('; ',$str_cookies);


            if(isset($info['response_header'][0]['Location']))//doing a recursive redirect
            {
                $options[CURLOPT_REFERER]=$info['url'];
                $options[CURLOPT_COOKIE]=$info['cookie'];
                unset($options[CURLOPT_POST]);
                unset($options[CURLOPT_POSTFIELDS]);

                if(substr($info['response_header'][0]['Location'],0,4)!=='http'){
                    $url = parse_url($address);
                    if(substr($info['response_header'][0]['Location'],0,1)=='/'){
                        $path = $info['response_header'][0]['Location'];
                    }else{
                        $path=pathinfo($address,PATHINFO_DIRNAME).'/'.$info['response_header'][0]['Location'];
                    }
                    $info['response_header'][0]['Location']=sprintf(
                        '%s://%s%s%s',
                        $url['scheme'],$url['host'],(isset($url['port'])? ':'.$url['port'] : ''),$path
                    );
                }
                $return = $this->Curl($info['response_header'][0]['Location'],array(),$options,++$redirect_count);
                array_unshift($return['info'],$info);
                $info=$return['info'];
                $return = $return['contents'];
            }else{
                $info = array($info);
            }
        }
        $resp = array('info'=>$info,'contents'=>$return,'cookie'=>$info[count($info)-1]['cookie']);
        $this->op_history[] = $address; //array('request'=>$address,'response'=>$resp);
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
