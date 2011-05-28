<?php defined('SYSPATH') or die('No direct script access.');

class DateTimeException extends Exception{
	private $parsed_date;

	public function __construct($message,$code=null,$prev=null,$date = array())
	{
		parent::__construct($message,$code,$prev);
		$this->parsed_date = $date;
	}

	public function getDate(){
		return $this->parsed_date;
	}
}
?>