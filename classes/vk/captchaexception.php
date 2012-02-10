<?php
class VK_CaptchaException extends Exception {
    protected $request_info;
    private $error;

    public function __construct($request_info,$error_array) {
        parent::__construct($error_array['error_msg'],$error_array['error_code'],null);
        $this->error = $error_array;
        $this->request_info = $request_info;
    }

    public function __toString(){
        $params = array();

        foreach($this->error['request_params'] as $param){
            if($param['key'] == 'method'){continue;}
            $params[] = sprintf('%s=%s',urlencode($param['key']),urlencode($param['value']));
        }
        $url = $this->request_info[count($this->request_info)-1]['url'].'?'.
            implode('&',$params);

        $msg = 'A captcha response query is needed: '.
            sprintf('%s&captcha_sid=%s&captcha_key=<human typed text from %s>',
                $url,
                $this->error['captcha_sid'],
                $this->error['captcha_img']
            );
        return $msg;
    }
}
