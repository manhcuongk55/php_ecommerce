<?php
class CLS_LANGUAGE{
	private $pro_name=array('ID'=>'-1',
						'_Code'=>'',
						'_Name'=>'',
						'_Flag'=>'',
						'_Site'=>'front_end',
						'isDefault'=>'0',
						'isActive'=>'');
	private $objmysql=NULL;
	public function CLS_LANGUAGE(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function __set($proname,$value){
		if(!isset($this->pro_name[$proname])){
			echo $proname.' is not member of CLS_LANGUAGE';
			return;
		}
		$this->pro_name[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro_name[$proname])){
			echo $proname.' isn not member of CLS_LANGUAGE';
			return;
		}
		return $this->pro_name[$proname];
	}
	public function getList($strwhere='',$limit=''){
		$sql='SELECT * FROM `tbl_language` '.$strwhere.' ORDER BY `name` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function setCookie_LagID($id,$site){
		setcookie('COOKIE_LAG_ID_'.$site,$id, time()+3600*24*30);	
	}
	public function getCookie_LagID($site){
		$id='';
		if(isset($_COOKIE['COOKIE_LAG_ID_'.$site]))
			$id=$_COOKIE['COOKIE_LAG_ID_'.$site];
		return $id;
	}
	public function getDefault($site='front_end'){
		$sql="SELECT `lag_id` FROM `tbl_language` WHERE `isactive`='1' AND `isdefault`='1' AND `site`='$site'";
		$this->objmysql->Query($sql);
		$rows=$this->objmysql->Fetch_Assoc();
		return $rows['lag_id'];
	}
	public function curent_lang($site='front_end'){
		$id='';
		if($this->getCookie_LagID($site)!=''){
			$id=$this->getCookie_LagID($site);
		}
		else{
			$id=$this->getDefault($site);
		}
		$this->setCookie_LagID($id,$site);
		return $id;
	}
	public function setDefault($id,$site){
			$sql="UPDATE `tbl_language` SET `isdefault`=0 WHERE `isactive`='1' AND `site`='$site'";
			$this->objmysql->Query($sql);
			$sql="UPDATE `tbl_language` SET `isdefault`=1,`isactive`='1' WHERE `lag_id`='$id'";
			return $this->objmysql->Query($sql);
	}
	// set active template
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_language` SET `isactive`='$status' WHERE `lag_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_language` SET `isactive`=if(`isactive`=1,0,1) WHERE `lag_id` in ('$ids')";
		return $this->objmysql->Query($sql);
	}
	public function Add_new(){
		$sql="INSERT INTO `tbl_language` (`code`,`name`,`flag`,`site`,`isactive`) VALUES ('".$this->pro_name['_Code']."','".$this->pro_name['_Name']."','".$this->pro_name['_Code'].".png','".$this->pro_name['_Site']."','".$this->pro_name['isActive']."')";
		return $this->objmysql->Query($sql);
	}
	public function Update(){
		$sql="UPDATE `tbl_language` SET `code`='".$this->pro_name['_Code']."', `name`='".$this->pro_name['_Name']."', 
			`flag`='".$this->pro_name['_Code'].".png', `site`='".$this->pro_name['_Site']."', `isactive`='".$this->pro_name['isActive']."' WHERE lag_id='".$this->pro_name['ID']."'";
		return $this->objmysql->Query($sql);
	}
	public function Delete($ids){
		$sql="DELETE FROM `tbl_language` WHERE `lag_id` in ('$ids')";
		return $this->objmysql->Query($sql);
	}
}
?>