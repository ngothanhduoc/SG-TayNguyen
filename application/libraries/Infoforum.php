<?php
class Infoforum {

    private $CI;

    function __construct() {
        $this->CI = & get_instance();        
    }
    public function getForum($link){
        ini_set('default_socket_timeout', 1);
        $result = array();
        $url = $link;
        $key = md5($url);
        
        $cache = $this->loadCache($key);
        if(!empty($cache))
            return $cache;
        
        $header = @get_headers($url);
        if ($header == FALSE) {
            $code = 404;
        } else {
            $code = explode(' ', $header[0]);
            $code = $code[1];
        }
        if($code = 200){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $res = curl_exec($ch);

            if(empty($res) === FALSE){
                $result['top'] = $this->getTopics($link, $res);
                $result['pos'] = $this->getPosts($link, $res);
            }else{
                $result['top'] = mt_rand(100,1000);
                $result['pos'] = mt_rand(100,1000);
            }
        }else{
            $result['top'] = mt_rand(100,1000);
            $result['pos'] = mt_rand(100,1000);
        }
        $timeout = 60*60*24;
        $this->saveCache($key, $result, $timeout);
        return $result;
    }
    public function getTopics($link,$subject){
        //$subject = @file_get_contents($link);
        $pattern = '#.*<td class="topics-count">(.*)<\/td>#imsU';
        if(strpos($link,'taydu') !== false){
            $pattern = '#.*Chủ đề.*<span>(.*)</span></p>#imsU';
        }
        if(strpos($link,'kytien') !== false || strpos($link,'thanhcat') !== false){
            //$pattern = '#.*<li>Chủ đề:(.*)<\/li>#imsU';
             $pattern = '#.*<dt>Chủ đề.*<dd>(.*)</dd>#imsU';
        }
	preg_match_all($pattern,$subject,$matches);
       
        if(empty($matches[1]) === FALSE){
            $arrR = array();
            $badchars = array(',','.');
            foreach($matches[1] as $val){
                $arrR[] = trim(str_replace($badchars, '', $val)); 
            }
            $total = array_sum($arrR);
        }else{
            $total = mt_rand(100,1000);
        }
        
        return $total;
    }
    public function getPosts($link, $subject){
        //$subject = @file_get_contents($link);
        $pattern = '#.*<td class="posts-count">(.*)<\/td>#imsU';
        if(strpos($link,'taydu') !== false){
            $pattern = '#.*Bài viết.*<span>(.*)</span></p>#imsU';
        }
        if(strpos($link,'kytien') !== false || strpos($link,'thanhcat') !== false){
            //$pattern = '#.*<li>Bài viết:(.*)<\/li>#imsU';
            $pattern = '#.*<dt>Bài viết.*<dd>(.*)</dd>#imsU';
        }
	preg_match_all($pattern,$subject,$matches);
        
        if(empty($matches[1]) === FALSE){
            $arrR = array();
            $badchars = array(',','.');
            foreach($matches[1] as $val){
                $arrR[] = trim(str_replace($badchars, '', $val)); 
            }
            $total = array_sum($arrR);
        }else{
            $total = mt_rand(100,1000);
        }
        
        return $total;
    }
    public function saveCache($key, $data, $timeout = 300) {
        $this->CI->load->driver('cache');
        $this->CI->cache->file->save($key, $data, $timeout);
    }

    public function loadCache($key) {
        $this->CI->load->driver('cache');
        return $this->CI->cache->file->get($key);
    }
}
?>
