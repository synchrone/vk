<?php defined('SYSPATH') OR die('No direct access allowed.');

class VK_Date extends Kohana_Date{
	public static $format = '%e %h %Y в %H:%M'; //TODO: Russian hardcode
	public static function parse($datetime,$format=null,$locale=null)
	{
        if($format === null){$format = self::$format;}

		if(!$locale)
		{
			$t = strptime($datetime,$format);
		}else{
			$old_locale = setlocale  (LC_ALL,"0");
			setlocale(LC_ALL,$locale);
			$t = strptime($datetime,$format);
			setlocale(LC_ALL,$old_locale);
		}

		if($t['unparsed'] != ''){
			throw new VK_Exception('Couldnt parse all the time',null,null,$t);
		}

		return mktime($t['tm_hour'],$t['tm_min'], $t['tm_sec'],
					  $t['tm_mon']+1, $t['tm_mday'],1900+$t['tm_year']);
	}

	public static function ts_to_human($timestamp){
		return strftime(VK_Date::$format, $timestamp);
	}
}
