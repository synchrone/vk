<?php defined('SYSPATH') OR die('No direct access allowed.');

class Vk_Date extends Kohana_Date{
	public static function parse($datetime,$format,$locale=null)
	{
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
			throw new DateTimeException('Couldnt parse all the time',null,null,$t);
		}

		return mktime($t['tm_hour'],$t['tm_min'], $t['tm_sec'],
					  $t['tm_mon']+1, $t['tm_mday'],1900+$t['tm_year']);
	}
}
