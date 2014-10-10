<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Breadcrumb{
	private $breadcrumbs = array();
	private $separator = ' &nbsp; <img src="/frontend/assets/images/ico_next.png" /> &nbsp; ';
	private $start = '<div id="breadcrumb">';
	private $end = '</div>';

	public function __construct($params = array()){
		if (count($params) > 0){
			$this->initialize($params);
		}		
	}
	
	private function initialize($params = array()){
		if (count($params) > 0){
			foreach ($params as $key => $val){
				if (isset($this->{'_' . $key})){
					$this->{'_' . $key} = $val;
				}
			}
		}
	}

	function add($title, $href, $isLink=true){		
		if (!$title OR !$href) return;
                $this->breadcrumbs[] = array('title' => $title , 'href' => $href, 'isLink' => $isLink);
	}
	
	function output(){

		if ($this->breadcrumbs) {
			
			$output = $this->start;

			foreach ($this->breadcrumbs as $key => $crumb) {
				if ($key){ 
					$output .= $this->separator;
				}

				if (end(array_keys($this->breadcrumbs)) == $key) {
                                    if($crumb['isLink'])
                                        $output .= '<a style="font-weight: bold;" href="' . $crumb['href'] . '">' . $crumb['title'] . '</a>';
                                    else
					$output .= '<span>' . $crumb['title'] . '</span>';			
				} else {
                                    if($crumb['isLink'])
					$output .= '<a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a>';
                                    else
                                        $output .= '<span class="noLink">' . $crumb['title'] . '</span>';
				}
			}
		
			return $output . $this->end . PHP_EOL;
		}
		
		return '';
	}

}
