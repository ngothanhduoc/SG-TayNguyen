<?php
class UploadImage{
	 /**
     * Author: tailm
     * @var CI_Controller
     */
	private $CI;
	private $_error;
	private $_dataimage;
	
	function __construct(){
		$this->CI = & get_instance();
	}
	public function do_upload($field){
		//$config['upload_path'] = './assets/images/upload/';
		$config['upload_path'] = FCPATH . 'assets/images/upload/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '500';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->CI->load->library('upload', $config);
		if ( ! $this->CI->upload->do_upload($field))
		{
			$this->_error = $this->CI->upload->display_errors();
			$result = 0;
		}
		else
		{
			$result = 1;
			//$data = array('upload_data' => $this->upload->data());
			$this->_dataimage = $this->CI->upload->data();
		}
		
		return $result;		
	}
	public function getError(){
		return $this->_error;
	}
	public function getData(){
		return $this->_dataimage;
	}
	public function copyandresize($originalName,$dirUpload,$dirFix,$widthSize,$heightSize)
	{
		$original =  $dirUpload . $originalName;
		$fix =  $dirFix . $originalName;
		list($width, $height,$type) = getimagesize($original);
		
		if($width <= $widthSize && $height <= $heightSize)
		{
		$ChoiceWith = $width;
		$ChoiceHeight = $height;
		}else{

		if($width > $height && $width > $widthSize)
		{
		$radioWidth = $widthSize/$width;
		$ChoiceWith = $radioWidth * $width;
		$ChoiceHeight = $radioWidth * $height;
		}
		
		if($width > $height && $width < $widthSize)
		{
		$ChoiceWith = $width;
		$ChoiceHeight = $height;
		}
		if($height > $width && $height > $heightSize)
		{
		$radioHeight = $heightSize/$height;
		$ChoiceWith = $radioHeight * $width;
		$ChoiceHeight = $radioHeight * $height;
		}
		if($height > $width && $height < $heightSize)
		{
		$ChoiceWith = $width;
		$ChoiceHeight = $height;
		}
		}
		if($width == $height)
		{
		$radioWidth = $widthSize/$width;
		$ChoiceWith = $radioWidth * $width;
		$ChoiceHeight = $radioWidth * $height;
		}
		
		/*
		if($width > $height){
			$ChoiceWith = $height;
			$ChoiceHeight = $height;
		}
		if($width < $height){
			$ChoiceWith = $width;
			$ChoiceHeight = $width;
		}
		if($width == $height){
			$ChoiceWith = $width;
			$ChoiceHeight = $width;
		}
		*/
		/*
                $ChoiceWith = $widthSize;
		$ChoiceHeight = $heightSize;
		*/
                if($type == 2)
                {
		//@header("Content-type: image/jpeg");
		$tn = imagecreatetruecolor($ChoiceWith, $ChoiceHeight) ;
		$image = imagecreatefromjpeg($original) ;
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $ChoiceWith,
		$ChoiceHeight, $width, $height) ;
		imagejpeg($tn, $fix, 100) ;
		}
		if($type == 1)
		{
		//@header("Content-type: image/gif");
		$tn = imagecreatetruecolor($ChoiceWith, $ChoiceHeight) ;
		$image = imagecreatefromgif($original) ;
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $ChoiceWith,
		$ChoiceHeight, $width, $height) ;
		imagegif($tn, $fix) ;
		}
		if($type == 3)
		{
		//@header("Content-type: image/png");
		$tn = imagecreatetruecolor($ChoiceWith, $ChoiceHeight) ;
		$image = imagecreatefrompng($original) ;
		imagecopyresampled($tn, $image, 0, 0, 0, 0, $ChoiceWith,
		$ChoiceHeight, $width, $height) ;
		imagepng($tn, $fix) ;
		}
		
	}
}