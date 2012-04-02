<?php

class MyStr extends Str
{
	static public function remove_junk($string, $truncate = false)
	{
		$string = trim(str_replace(array("\n","&nbsp;"), "", strip_tags(htmlspecialchars_decode($string))));
		if($truncate != false) self::truncate($string, $truncate);
		return $string;
	}
}