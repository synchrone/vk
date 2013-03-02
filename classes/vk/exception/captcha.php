<?php
class VK_Exception_Captcha extends VK_Exception {
    protected $request_info;
    private $error;

    public function __construct($request_info,$error_array) {
        $this->error = $error_array;
        $this->request_info = $request_info;
        parent::__construct($this->__toString(),$error_array['error_code']);
    }

    public function __toString(){
        $msg = 'A captcha response query is needed: '.
            sprintf('%s&captcha_sid=%s&captcha_key=<human typed text from %s>',
                $this->getFailedCallUrl(),
                $this->getSid(),
                $this->getImgURL()
            );
        return $msg;
    }

    public function getFailedCallUrl(){
        $params = array();
        foreach($this->error['request_params'] as $param){
            if($param['key'] == 'method'){continue;}
            $params[] = sprintf('%s=%s',urlencode($param['key']),urlencode($param['value']));
        }
        $url = $this->request_info[count($this->request_info)-1]['url'].'?'.
            implode('&',$params);

        return $url;
    }

    public function getSid(){
        return $this->error['captcha_sid'];
    }
    public function getImgURL(){
        return $this->error['captcha_img'];
    }
}
