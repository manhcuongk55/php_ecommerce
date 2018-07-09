<?php
class CLS_TEMPLATE{
	private $pro=array(
					  'ID'=>'1',
					  'Name'=>'default',
					  'Desc'=>'',
					  'Author'=>'GF-TEAM',
					  'Email'=>'contact@glowfuture.com',
					  'Website'=>'glowfuture.com',
					  'isDefault'=>0,
					  'isActive'=>1
					  );
	private $objmysql=NULL;
	public function CLS_TEMPLATE(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo $proname. ' is not member in class Template';
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo $proname. ' is not member in class Template';
			return;
		}
		return $this->pro[$proname];
	}
	public function Load_Extension(){
		define('EDIT_FULL_PATH',EDI_PATH.'innovar/scripts/innovaeditor.php');
	}
	public function Load_lang_default(){
		define('CURENT_LANG','vi');
		require_once(LAG_PATH.CURENT_LANG.'/general.php');
	}
	// Test template
	public function error(){
		if(!is_file(THIS_TEM_ADMIN_PATH.'template.xml'))
		{
			echo 'template.xml is not exist';
			return false;
		}
		if(!is_file(THIS_TEM_ADMIN_PATH.'home.php'))
		{
			echo 'home.php is not exist';
			return false;
		}
	}
	public function WapperTem(){
		if($this->error())
			return;
		require_once(THIS_TEM_ADMIN_PATH.'home.php');
	}
	// Check Module
	public function isModule($position){
		$sql="SELECT * FROM tbl_modules WHERE `isactive`=1 AND `position`='$position' ORDER BY `order`,`title`";
		$this->objmysql->Query($sql);
		unset($sql);
		if($this->objmysql->Num_rows()>0)
			return true;
			
		return false;
	}
	// load defaut template
	public function Load_defaul_tem($site='site'){
		$sql="SELECT * FROM `tbl_template` WHERE `isactive`=1 AND `site`='$site' AND`isdefault`=1";
		$this->objmysql->Query($sql);
		$rows=$this->objmysql->Fetch_Assoc();
		$this->pro['ID']=$rows['tem_id'];
		$this->pro['Name']=$rows['name'];
		$this->pro['Desc']=$rows['desc'];
		$this->pro['Author']=$rows['author'];
		$this->pro['Author_Email']=$rows['author_email'];
		$this->pro['Author_Site']=$rows['author_site'];
		$this->pro['isDefault']=$rows['isdefault'];
		$this->pro['isActive']=$rows['isactive'];
		unset($sql);
		unset($rows);
	}
	// Load Module
	public function loadModule($position,$site='site'){
		$position=trim($position); $site=trim($site);
		$sql="SELECT `mod_id`,`type` FROM `tbl_modules` WHERE `isactive`=1 AND `position`='$position'";
		$this->objmysql->Query($sql);
		while($rows=$this->objmysql->Fetch_Assoc()){
			if(is_file(MOD_PATH.'mod_'.trim($rows['type']).'/layout.php')==true)			
				include(MOD_PATH.'mod_'.trim($rows['type']).'/layout.php');
			else
				echo '<br> Module is not exist!';
		}
		unset($sql);
		unset($rows);
	}
	public function getFullURL(){
		echo '<br>HostName:'. $_SERVER['HTTP_HOST'];
		echo '<br>Rquest:'. $_SERVER['QUERY_STRING'];
		echo '<br>Rquest URI:'. $_SERVER['REQUEST_URI'];
		echo '<br>Script file:'. $_SERVER['SCRIPT_FILENAME'];
	}
	// isfronpage
	public function isfronpage(){
		echo $_SERVER['QUERY_STRING'];
		if($_SERVER['QUERY_STRING']=='')
			return true;
		return false;
	}
	// iscomponent
	public function isComponent($comname){
		
	}
	/*-------------------------------------------------------*/
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_template` ".$where." ORDER BY `name` ".$limit;
		//echo $sql;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	// set active template
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_template` SET `isactive`='$status' WHERE `tem_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_template` SET `isactive`=if(`isactive`=1,0,1) WHERE `tem_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	// set default template
	public function setDefault($id,$site)
	{
		$sql="UPDATE `tbl_template` SET `isdefault`=0 WHERE `site`='$site' AND 1=1";
		$this->objmysql->Exec($sql);
		$sql="UPDATE `tbl_template` SET `isdefault`=1 WHERE `tem_id`='$id'";
		return $this->objmysql->Exec($sql);
	}
	public function Add_new(){
	}
	public function Update(){
		$sql="UPDATE `tbl_template` SET `name`='".$this->Name."',`desc`='".$this->Desc."',`author`='".$this->Author."',
				`author_email`='".$this->Email."',`author_site`='".$this->Website."',`isdefault`='".$this->isDefault."' WHERE `tem_id` ='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}
	public function Delete($ids){
		$sql="DELETE FROM `tbl_template` WHERE `tem_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
}
?>