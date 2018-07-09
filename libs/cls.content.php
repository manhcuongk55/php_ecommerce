<?php
class CLS_CONTENTS{
	private $objmysql=null;
	public function CLS_CONTENTS(){
		$this->objmysql=new CLS_MYSQL;
	}
	function getList($where=' ',$order=' ORDER BY RAND() ',$limit=' ',$lag_id='0'){
		$sql="SELECT * FROM `view_content` WHERE lag_id=$lag_id AND isactive=1 ".$where.$order.$limit;
		// echo $sql;		
		return $this->objmysql->Query($sql);
	}

	function getRamdom(){
		$sql = "SELECT * FROM `view_content` WHERE isactive = 1  ORDER BY `creatdate` DESC LIMIT 0,5";	
		return $this->objmysql->Query($sql);
	}

	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function setVisited($id){
		$sql='UPDATE tbl_content SET `visited`=`visited`+1 WHERE `con_id`='.$id;
		return $this->objmysql->Query($sql);
	}
}
?>