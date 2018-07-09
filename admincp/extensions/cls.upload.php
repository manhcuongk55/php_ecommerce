<?php
class CLS_UPLOAD{
	var $file_name=NULL;
	var $file_type=NULL;
	var $file_size=NULL;
	var $file_error=NULL;
	var $array_type=array('image/jpg','image/jpeg','image/gif','image/png','image/x-png','application/x-shockwave-flash',
	'audio/x-ms-wma','audio/mpeg3','video/avi','application/octet-stream','video/x-ms-wmv','text/plain','application/rar',
	'application/pdf','application/vnd.ms-excel','application/octet-stream','application/msword','text/html',
	'application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.ms-powerpoint',
	'application/vnd.openxmlformats-officedocument.presentationml.presentation','');
	
	var $max_size=10000000; // 10MB
	var $_path="";
	
	function CLS_UPLOAD(){}
	function setType($array){
		$this->$array_type=$array;
	}
	function setMaxSize($maxsize){
		$this->$max_size=$maxsize;
	}
	function setPath($path){
		$this->_path=$path;
	}
	function checkType(){
		if(in_array($this->file_type,$this->array_type))
			return true;
		else
			die('die("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">File nguồn không tồn tại hoặc không phải định dạng cho phép !. Lỗi tại Image->checkType() for '.$this->file_type.'")');
	}
	function checkSize(){
		if($this->file_size < $this->max_size)
			return true;
		else
			die('die("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">File nguồn không quá lớn so với kích thước cho phép!. Lỗi tại Image->checkSize()");');
	}
	function checkError(){
		if($this->file_error==0)
			return true;
		else
			die('die("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">Có lỗi trong quá trình truyền file!. Lỗi tại Image->checkError()'.$this->file_error.'");');
	}
	function checkExistFile(){
		if(file_exists($this->_path.$this->file_name))
			return true;
		else
			return false;
	}
	function NewFile(){
		$this->file_name=date("dnYhis").$this->file_name;
	}
	function SaveFile(){
		move_uploaded_file($this->file_temp,$this->_path.$this->file_name);
	}
	function UploadFile($filename,$patch=''){
		$this->file_name=$_FILES[$filename]["name"];
		$this->file_type=$_FILES[$filename]["type"];
		$this->file_size=$_FILES[$filename]["size"];
		$this->file_error=$_FILES[$filename]["error"];
		$this->file_temp=$_FILES[$filename]["tmp_name"];
		$this->checkError();
		$this->checkType();
		$this->checkSize();
		$this->checkExistFile();
		$this->SaveFile();
		
		// Create Thumb images
        $MyImg = new Image;
        $MyImg->SrcFile = $this->_path.$this->file_name;
		$MyImg->DestFile = $this->_path.$this->file_name; 
		
        $param=getimagesize($MyImg->SrcFile); // 480*480
        $sizeW=$param[0];
        $sizeH=$param[1];
		$MyImg->WidthPercent=($sizeW<480)?$sizeW:480;
		$MyImg->HeightPercent=($sizeH<480)?$sizeH:480;
		
        if($sizeW/$sizeH<1.38)
            $MyImg->SaveFileH();
        else
            $MyImg->SaveFileW();
        
		$MyImg->WidthPercent=($sizeW<THUMB_WIDTH)?$sizeW:THUMB_WIDTH;;
    	$MyImg->HeightPercent=($sizeH<THUMB_HEIGHT)?$sizeH:THUMB_HEIGHT;
		
        if(!file_exists($this->_path."thumb")){ //200*145;
			mkdir($this->_path."thumb", 0777);
		}
        $MyImg->DestFile = $this->_path."thumb/".$this->file_name; 
        if($sizeW/$sizeH<1.38)
            $MyImg->SaveFileH();
        else
            $MyImg->SaveFileW();
			
		$file=$this->_path.$this->file_name;
		unset($MyImg);
		return $file;
	}
	function SaveDoc($path){
		move_uploaded_file($this->file_temp,$path);
	}
	function UploadFileDoc($filename,$path=''){
		$this->file_name=$_FILES[$filename]["name"];
		$this->file_type=$_FILES[$filename]["type"]; //echo $_FILES[$filename]["type"]; die;
		$this->file_size=$_FILES[$filename]["size"];
		$this->file_error=$_FILES[$filename]["error"];
		$this->file_temp=$_FILES[$filename]["tmp_name"];
		$this->checkError();
		$this->checkType();
		$this->checkSize();
		$this->checkExistFile();
		$this->SaveDoc($path);
	   	return $file;
	}
}
?>