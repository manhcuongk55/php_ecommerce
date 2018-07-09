<?php
class CLS_DOCUMENT{
	var $obj=array(
					  "ID"=>"-1",
					  "ParID"=>"0",
					  "Loai"=>"0",
					  "Code"=>"",
					  "Name"=>"",
					  "Intro"=>"",
					  "Urlfile"=>"tailieu/",
					  "Outsite"=>"",
					  "Type"=>"",
					  "FileSize"=>"",
					  "CreateDate"=>"",
					  "ModifyDate"=>"",
					  "Author"=>"",
					  "Assign"=>"",
					  "Downloads"=>"0",
					  "isActive"=>1
					  );
	function CLS_DOCUMENT()
	{
	}
	// property set value
	function __set($proname,$value)
	{
		if(!isset($this->obj[$proname]))
		{
			echo "Error";
			return;
		}
		$this->obj[$proname]=$value;
	}
	function __get($proname)
	{
		if(!isset($this->obj[$proname]))
		{
			$this->callmess("$proname ". IS_NOT_MEMBER_IN_CLASS_MYSQL. " " );
			return;
		}
		return $this->obj[$proname];
	}
	
	function getURL ($docid) {
		$sql="SELECT code,par_id FROM `tbl_document` WHERE `doc_id`='$docid'";
		//echo $sql;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		
		$url='';
		
		if($objdata->Numrows()>0)
		{
			$rows=$objdata->FetchArray();
			$url.=$rows["code"]."/";
			$url=$this->getURL($rows["par_id"]).$url;
			if($rows["par_id"]==0)
				$url="tailieu/".$url;
		}
		return $url;
	}
	function getList($where="",$limit=''){
		$sql="SELECT * FROM `tbl_document` ".$where;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		return $objdata;
	}

	function getListDoc($parid=0,$level=0,$select='')
	{
		$sql="SELECT * FROM `tbl_document` WHERE `par_id`='$parid' AND loai=1";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$char="";
		if($level>0)
		{
			for($i=0;$i<$level;$i++)
				$char.=".....";
				$char.="";
		}
		while($rows=$objdata->FetchArray())
		{
			$catid=$rows["doc_id"];
			$name=$rows["name"];
			if($rows["doc_id"]==$select)
				echo "<option value=\"$catid\" selected=\"selected\">$char$name</option>";
			else echo "<option value=\"$catid\">$char$name</option>";
			$this->getListDoc($catid,$level+1,$select);
		}
	}
	
	function getURLdoc($id) {
		$sql="SELECT urlfile FROM `tbl_document` WHERE `doc_id`='$id'";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$str='';
		$rows=$objdata->FetchArray();
		$str=$rows["urlfile"];

		return $str;
	}
	function haveChild($id) {
		$sql="SELECT doc_id FROM `tbl_document` WHERE `par_id`='$id'"; //echo $sql;die;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Numrows()>0)
			return $objdata->Numrows();
		else 
			return 0;
	}
	function getCode($code) {
		$sql="SELECT code FROM `tbl_document` WHERE `code`='$code'"; //echo $sql;die;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Numrows()>0)
			return $objdata->Numrows();
		else 
			return 0;
	}
	function Numrows() { 
		return parent::Numrows();
	}
	function Add_new(){
		$sql='INSERT INTO `tbl_document`(`par_id`,`loai`,`code`,`name`,`intro`,`type`,`outsite`,`urlfile`,`file_size`,`create_date`,`modify_date`,`author`,`assign`,`isactive`) VALUES ';
		$sql.=' ("'.$this->obj["ParID"].'","'.$this->obj["Loai"].'","'.$this->obj["Code"].'","'.$this->obj["Name"].'","'.$this->obj["Intro"].'","'.$this->obj["Type"].'","';
		$sql.= $this->obj["Outsite"].'","'.$this->obj["Urlfile"].'","'.$this->obj["FileSize"].'","'.$this->obj["CreateDate"].'","'.$this->obj["ModifyDate"].'","';
		$sql.=$this->obj["Author"].'","'.$this->obj["Assign"].'","'.$this->obj["isActive"].'") ';
		
		//echo $sql;die;
		
		$objdata=new CLS_MYSQL();
		if($objdata->Query($sql)) 
			return true;
		else return false;
	}
	function Update(){
		$sql='UPDATE `tbl_document` SET `par_id`="'.$this->obj["ParID"].'",`code`="'.$this->obj["Code"].'",`name`="'.$this->obj["Name"].'",`intro`="'.$this->obj["Intro"].'",';
		$sql.='`type`="'.$this->obj["Type"].'",`outsite`="'.$this->obj["Outsite"].'",`urlfile`="'.$this->obj["Urlfile"].'",`file_size`="'.$this->obj["FileSize"].'",`create_date`="'.$this->obj["CreateDate"].'",';
		$sql.='`modify_date`="'.$this->obj["ModifyDate"].'",`author`="'.$this->obj["Author"].'",`assign`="'.$this->obj["Assign"].'",`isactive`="'.$this->obj["isActive"].'" ';
		$sql.=' WHERE `doc_id`="'.$this->obj["ID"].'"';
		$objdata=new CLS_MYSQL();
		if($objdata->Query($sql)) 
			return true;
		else return false;
	}
	function ActiveOnce($id){
		$sql="UPDATE `tbl_document` SET `isactive` = IF(isactive=1,0,1) WHERE `doc_id` in ('$id')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function Publish($id){
		$sql="UPDATE `tbl_document` SET `isactive` = \"1\" WHERE `doc_id` in ('$id')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function UnPublish($id){
		$sql="UPDATE `tbl_document` SET `isactive` = \"0\" WHERE `doc_id` in ('$id')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	
	function getFileSize($size, $retstring = null)
	{
		$sizes = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		if ($retstring === null) { $retstring = '%01.2f %s'; }
		$lastsizestring = end($sizes);
		foreach ($sizes as $sizestring) {
				if ($size < 1024) { break; }
				if ($sizestring != $lastsizestring) { $size /= 1024; }
		}
		if ($sizestring == $sizes[0]) { $retstring = '%01d %s'; } // Bytes aren't normally fractional
		return sprintf($retstring, $size, $sizestring);
	}


	function getFileType($file="") {
		
		// get file name 
		$filearray = explode("/", $file);
		$filename = array_pop($filearray);
		
		// condition : if no file extension, return
		if(strpos($filename, ".") === false) return false;
		
		// get file extension
		$filenamearray = explode(".", $filename);
		$extension = $filenamearray[(count($filenamearray) - 1)];
		return $extension;
	
	}

	
	function fileName($id,$HOST_URL="http://hmongbeef.vn/"){
		$sql = "SELECT loai,code,urlfile FROM `tbl_document` WHERE `doc_id`=$id";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$rows=$objdata->FetchArray();
		
		//loai=1: kieu thu muc, loai=0: kieu tep tin
		$dirname = $HOST_URL.$rows["urlfile"].$rows["code"];
		return $dirname;
	}
	function Delete($id,$HOST_URL="/home/hmongbee/public_html/"){
		//chmod thu muc chua tai lieu download
		//chmod("/home/hmongbee/public_html/tailieu",0777);
		
		$dirname = $this->fileName($id,"/home/hmongbee/public_html/"); 
		chmod($dirname, 0777);
		
		if(is_dir($dirname)) { 
			rmdir($dirname);
		}
		if(is_file($dirname) && file_exists($dirname)) {
			unlink($dirname);
		}
		// Read and write for owner, read for everybody else
		//chmod("/home/hmongbee/public_html/tailieu",0644);
		
		$sql="DELETE FROM `tbl_document` WHERE `doc_id` in ('$id')"; //echo $sql; die;
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	/*
	function Delete($id,$HOST_URL="http://hmongbeef.vn/"){
		$dirname = $this->fileName($id,$HOST_URL); 
		//$dirname = $this->fileName($id,"/home/hmongbee/public_html/");
		echo $dirname."<br>";
		
		chmod($dirname, 0777);
		if($rows["loai"]==1) {
		  	//$this->delete_directory($dirname);
			if (is_dir($dirname))
				rmdir($dirname);
		}
		else
		{
			if(is_file($dirname))
			{
				unlink($dirname);
			}
		}
		
		$sql="DELETE FROM `tbl_document` WHERE `doc_id` in ('$id')";echo $sql; die;
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}

	 function delete_directory($dirname) {
		if (is_dir($dirname))
		   $dir_handle = opendir($dirname);
		if (!$dir_handle)
		   return false;
		while($file = readdir($dir_handle)) {
		   if ($file != "." && $file != "..") {
			  if (!is_dir($dirname."/".$file)){
			  	 chmod($dirname."/".$file,0777);
				 unlink($dirname."/".$file);
			  }
			  else {
				 chmod($dirname.'/'.$file,0777);
				 $this->delete_directory($dirname.'/'.$file);  
			  }
		   }
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	 }
	 */
	 
	 
	function DeleteFile($id) {
		$sql = "DELETE FROM tbl_document WHERE doc_id=$id";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
}
?>