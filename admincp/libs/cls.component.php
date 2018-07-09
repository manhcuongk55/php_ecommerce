<?php
class CLS_COMS{
	private $pro=array(
					  'ID'=>'-1',
					  'Code'=>'default',
					  'Name'=>'default',
					  'Desc'=>'',
					  'Site'=>'',
					  'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_COMS(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in component class';
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in component class';
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_component` ".$where.' ORDER BY `name` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function Add_new(){
		$sql='INSERT INTO `tbl_component`(`code`,`name`,`desc`,`site`,`isactive`) VALUES ';
		$sql.=" ('".$this->pro['Code']."','".$this->pro['Name']."','".$this->pro['Desc']."','".$this->pro['Site']."','".$this->pro['isActive']."') ";
		//echo $sql; die();
		return $this->objmysql->Query($sql);
	}
	function Update(){
		$sql="UPDATE `tbl_component` SET `code`='".$this->pro["Code"]."',`name`='".$this->pro["Name"]."',`desc`='".$this->pro["Desc"]."',`site`='".$this->pro["Site"]."',`isactive`='".$this->pro["isActive"]."' ";
		$sql.=" WHERE `com_id`='".$this->pro["ID"]."'";
		return $this->objmysql->Query($sql);
	}
	// set active template
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_component` SET `isactive`='$status' WHERE `com_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_component` SET `isactive`=if(`isactive`=1,0,1) WHERE `com_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Delete($ids){
		$sql="DELETE FROM `tbl_component` WHERE `com_id` in ('$ids')";
		return $this->objmysql->Query($sql);
	}
}
?>