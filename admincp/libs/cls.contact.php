<?php
class CLS_CONTACT{
	private $pro=array( 'ID'=>'-1',
						'Name'=>'',
						'Phone'=>'',
						'Email'=>'',
						'Email'=>'',
						'Address'=>'',
						'Subject'=>'',
						'Text'=>'',
						'Time'=>''			
						);
	private $objmysql = NULL;
	public function CLS_CONTACT(){
		$this->objmysql = new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ('Can not found $proname member');
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ("Can not found $proname member");
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where = '', $limit = ''){
		$sql = "SELECT * FROM `tbl_contact` where 1=1 ORDER BY `time` DESC";
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}	
	function Delete($id){
		$sql="DELETE FROM `tbl_contact` WHERE `contact_id` in ('$id')";		
		// echo $sql;
		return $this->objmysql->Exec($sql);		
	}
	
}
?>