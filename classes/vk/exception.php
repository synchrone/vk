<?php defined('SYSPATH') OR die('No direct access allowed.');

class VK_Exception extends Exception{
    private $ainfo;
    public function __construct($message,$ainfo=''){
        parent::__construct($message);
        $this->ainfo = $ainfo;
    }
    public function getInfo(){
        return $this->ainfo;
    }
    public function __toString() {
        return $this->getMessage();
    }
}