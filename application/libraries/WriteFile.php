<?php
class WriteFile{
    /**
* Author: tailm
* @var CI_Controller
*/
   private $CI;
  
   function __construct(){
           $this->CI = & get_instance();
   }
   function _write_file ($fileName, $fileContent)
    {
    	if (! $handle = fopen($fileName, 'w'))
    	{
    		return "Cannot open file ($fileName)";
    	}
    	if (fwrite($handle, $fileContent) === FALSE)
    	{
    		return "Cannot write to file ($fileName)";
    	}
    	return "";
    	fclose($handle);
    }
}