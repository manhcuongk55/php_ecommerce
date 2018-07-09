<?php
class CLS_CONFIGCONTENT{
	private $pro=array(
			'ID'=>-1,
			'Name'=>'',
			'Icon'=>'',
			'ShowName'=>'',
			'ShowIcon'=>'',
			'LangID'=>0,
			'isActive'=>1
			);
	private $objmysql=null;
	public function CLS_CONFIGCONTENT(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=''){
		$sql='SELECT * FROM `tbl_configcontent` '.$where;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc() {
		return $this->objmysql->Fetch_Assoc();
	}
}
?>