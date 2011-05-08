<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Desktop API module for  vk.com
 *
 * @package    Vk_DesktopApi
 * @author     Alexander Bogdanov
 * @copyright  (c) 2010 Alexander Bogdanov <syn@li.ru>
 * @license    http://kohanaphp.com/license.html
 */
class VK_DesktopApi {
    private $accessLevels = array(
        1,2,4,8,16,32,64,128,256,512,1024,2048,4096,8192
    );
    private $userLoginUrl;
    private $userLogin2Url;
    private $loginUrl;
    private $userCookies;
    
    private $apiUrl;
    private $appId;
    private $appSecret;
    private $appCookies;

    private $op_history = array();
    
    // Instances
	protected static $instance;
	public static function Instance()
	{
		if ( ! isset(VK_DesktopApi::$instance))
		{
			// Load the configuration for this type
			$config = Kohana::config('vk.VK_DESKTOP');

			// Create a new session instance
			VK_DesktopApi::$instance = new VK_DesktopApi($config);
		}

		return VK_DesktopApi::$instance;
	}

	protected $config;
    public function __construct($config){
        $this->loginUrl = $config['applogin_url'];
        $this->apiUrl = $config['api_url'];
        $this->userLoginUrl = $config['userlogin_url'];
        $this->userLogin2Url = $config['userlogin2_url'];
        $this->appId = $config['app_id'];
        $this->appSecret = $config['app_secret'];
        $this->LoginUser($config['user_email'],$config['user_pass']);
        $this->LoginApp();
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

    public function Call($method,$params){
        if($this->AppSessionExpired()){
            $this->LoginApp();
        }
        if (!$params) $params = array();
		$params['api_id'] = $this->appId;
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

		$query = $this->curl($this->apiUrl,$params);
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
        $stage1 = $this->curl(
            $this->userLoginUrl,
            null,
            array(
                CURLOPT_POSTFIELDS => $this->params(array(
                        'email' => $email,
                        'pass' => $password
                    )
                )
            )
        );
        preg_match("/name='s' value='([a-fA-F0-9]+)'/",$stage1['contents'],$stage2hash);
        if(count($stage2hash) != 2){
            var_dump($stage1);
            throw new Exception('Wrong user email or password');
        }
        $stage2hash = $stage2hash[1];


        $stage2 = $this->curl( $this->userLogin2Url,null,
            array(
                CURLOPT_COOKIEJAR=>true,
                CURLOPT_POSTFIELDS => $this->params(array(
                        's' => $stage2hash,
                        'op' => 'slogin',
                        'redirect'=>0,
                        'expire'=>0
                    )
                ))
        );
        preg_match("/remixsid=([a-fA-F0-9]+);/",$stage2['info']['request_header'],$remixsid);
        if(count($remixsid) != 2){
            var_dump($stage2);
            throw new Exception('Couldnt get remixsid cookie');
        }
        $this->userCookies =  array('remixsid'=>$remixsid[1]);
    }
    protected function getUserCookieStr(){
        $userCookieStr = '';
        foreach($this->userCookies as $k=>$v){
            $userCookieStr .=$k.'='.$v.';';
        }
        return $userCookieStr;
    }
    private function LoginApp(){


        $loginResult = $this->curl($this->loginUrl,
            array(
                'app'=>$this->appId,
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
            throw new Exception("User must add proxy app and allow interaction");
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
            }else{
                throw new Exception("Cookie was demanded, but can't retrive from curl file");
            }
        }
        $resp = array('info'=>$info,'contents'=>$return);
        $this->op_history[] = $address;//array('request'=>$address,'response'=>$resp);
        return $resp;
    }
    protected function Params($params) {
        if(!is_array($params)){return $params;}
        
		$piece = array();
		foreach($params as $k=>$v) {
			$piece[] = $k.'='.urlencode($v);
		}
		return implode('&',$piece);
	}
}
