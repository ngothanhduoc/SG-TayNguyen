<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function utf8_to_ascii($str = ''){
		$str_lower = convert($str);
		
		$chars = array
		(
		'a'	=>	array('a', 'á', 'à', 'ả', 'ạ', 'ã', 'â', 'ấ', 'ầ', 'ẩ', 'ậ', 'ẫ', 'ă', 'ắ', 'ằ', 'ẳ', 'ặ', 'ẵ'),
		'b'	=>	array('b'),
		'c'	=>	array('c'),
		'd'	=>	array('d', 'đ'),
		'e' =>	array('e', 'é', 'è', 'ẻ', 'ẹ', 'ẽ', 'ê', 'ế', 'ề', 'ể', 'ệ', 'ễ'),
		'f'	=>	array('f'),
		'g'	=>	array('g'),
		'h'	=>	array('h'),
		'j'	=>	array('j'),
		'k'	=>	array('k'),
		'l'	=>	array('l'),
		'm'	=>	array('m'),
		'n'	=>	array('n'),
		'i'	=>	array('i', 'í', 'ì', 'ỉ', 'ị', 'ỹ'),
		'o'	=>	array('o', 'ó', 'ò', 'ỏ', 'ọ', 'ỡ', 'ơ', 'ớ', 'ờ', 'ở', 'ợ', 'ỡ', 'ô', 'ố', 'ồ', 'ổ', 'ộ', 'ỗ'),
		'u'	=>	array('u', 'ú', 'ù', 'ủ', 'ụ', 'ú', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự'),
		'y'	=>	array('y', 'ý', 'ỳ', 'ỵ', 'ỷ', 'ỹ'),
		'q'	=>	array('q'),
		'w'	=>	array('w'),
		'r'	=>	array('r'),
		't'	=>	array('t'),
		'p'	=>	array('p'),
		's'	=>	array('s'),
		'z'	=>	array('z'),
		'x'	=>	array('x'),
		'v'	=>	array('v'),
		'-'	=>	array(' '),
		);
		foreach ($chars as $k => $v)
		{
		foreach ($v as $char)
		{
		$str_lower = str_replace($char, $k, $str_lower);
		}
		}
		$str_lower = preg_replace('/[^a-z0-9\s-.]/i', NULL, $str_lower);
		
		return trim($str_lower);
	}
	
	function convert($text = NULL, $type = NULL) 
	{
		switch ($type)
		{
		case 'upper': $html = mb_convert_case($text, MB_CASE_UPPER, 'utf-8'); break;
		case 'title': $html = mb_convert_case($text, MB_CASE_TITLE, 'utf-8'); break;
		default: $html = mb_convert_case($text, MB_CASE_LOWER, 'utf-8'); break;
		}
		return $html;
	}
	


?>