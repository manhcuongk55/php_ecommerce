<?php
class CLS_MENU{
	private $objmysql=null;
	public function CLS_MENU(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_menus` ".$where.' ORDER BY `order` asc '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows() { 
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){ 
		return $this->objmysql->Fetch_Assoc();
	}
}
?>