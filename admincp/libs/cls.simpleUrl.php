<?php
class CLS_SIMPLE_URL{
	private $site_path;
	public function CLS_SIMPLE_URL($site_path){
		$this->site_path=$this->removeSlash($site_path);
	}
	private function removeSlash($string){
		if($string[strlen($string)-1]=="/"){
			$string=rtrim($string,'/');
		}
		return $string;
	}
	function segzent($segzent){
		$url=str_replace($this->site_path,"",$_SERVER['REQUEST_URI']);
		$url=explode("/",$url);
		if(isset($url[$segzent])){
			return $url[$segzent];
		}else{
			return false;
		}
	}
}
$site=new CLS_SIMPLE_URL('/');
echo $site->segzent(1);
echo addslashes('im >"tuyen');
$string="im >'<h1><em>tuyen</em></h1>";
echo htmlspecialchars($string);
echo (int)"12h";

// Create DOM from URL or file
$html = file_get_html('http://www.igf.com.vn/');
// Find all images
foreach($html->find('img') as $element)
       echo "<img src=\"$element->src\">". '<br>';
// Find all links
foreach($html->find('a') as $element)
       echo $element->href . '<br>'; 
?>