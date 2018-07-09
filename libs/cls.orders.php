<?php
class CLS_ORDER{
	private $pro=array(	'Id'=>'0',
						'ProId'=>'',
						'Cdate'=>'',
						'Cname'=>'',
						'Cphone'=>'',
						'Cemail'=>'',
						'Note'=>'',
						'ShipType'=>'',
						'Add'=>'',
						'Config'=>'',
						'Payment'=>'',
						'TotalMoney'=>'0',
						'SalerCode'=>'0',
						'Status'=>'0',
						'Cart'=>null
					);
	private $objmysql=null;
	public function CLS_ORDER(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in set method of class';
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in get method of class';
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where=' ',$order=' ORDER BY cdate DESC ',$limit=' '){
		$sql="SELECT * FROM `tbl_order` ".$where.$order.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function Num_Buy($pro_id){
		$sql="SELECT SUM(`quantity`) as numbuy FROM `tbl_order_detail` WHERE `pro_id`=$pro_id";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['numbuy']+0;
	}
	public function Num_Person_Buy($pro_id){
		$sql="SELECT * FROM `tbl_order` WHERE `id` in (SELECT `order_id` FROM `tbl_order_detail` WHERE `pro_id`=$pro_id)";
		return $this->objmysql->Query($sql);
	}

	public function Add_new(){
		$sql = "INSERT INTO `tbl_order`(`pro_id`,`cdate`,`cname`,`cphone`,`add`,`config`,`note`,`status`) VALUES (
		'".$this->ProId."','".$this->Cdate."','".$this->Cname."','".$this->Cphone."','".$this->Add."','".$this->Config."','".$this->Note."','".$this->Status."')";	
		
		return $this->objmysql->Query($sql);
	}

	public function Add_new_old(){
		$sql="INSERT INTO `tbl_order`(`cdate`,`cname`,`cphone`,`cemail`,`shiptype`,`add`,`payment`,`totalmoney`,`salercode`,`status`) VALUES (
		'".$this->Cdate."','".$this->Cname."','".$this->Cphone."','".$this->Cemail."','".$this->ShipType."','".$this->Add."','".$this->Payment."','".$this->TotalMoney."','".$this->SalerCode."','".$this->Status."')";
		$this->objmysql->Exec('BEGIN');
		$result=$this->objmysql->Exec($sql);
		$order_id=$this->objmysql->LastInsertID();
		$sql="INSERT INTO `tbl_order_detail`(`order_id`,`pro_id`,`quantity`,`price`,`note`) VALUES ";
		$n=count($_SESSION['CART']);
		$objpro=new CLS_PRODUCTS;
		for($i=0;$i<$n;$i++){
			$price=$objpro->getPriceById($_SESSION['CART'][$i]['ID']);
			$sql.=" ('".$order_id."','".$_SESSION['CART'][$i]['ID']."','".$_SESSION['CART'][$i]['QUA']."','".$price."','".$_SESSION['CART'][$i]['NOTE']."') ";
			if($i<$n-1) $sql.=" , ";
		}
		//echo $sql; die();
		$result1=$this->objmysql->Exec($sql);
		
		if($result && $result1 ){
			$this->objmysql->Exec('COMMIT');
			return true;
		}else {
			$this->objmysql->Exec('ROLLBACK');
			return false;
		}
		unset($_SESSION['CART']);
	}
}
?>