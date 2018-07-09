<?php
class CLS_SALER{
	private $pro=array('ID'=>'0','CMT'=>'','Password'=>'','Fullname'=>'','Phone'=>'','Email'=>'','Code'=>'','isActive'=>0);
	private $objmysql=null;
	public function CLS_SALER(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ("Can not found $proname member");
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
	public function getList($where=' ',$limit=' '){
		$sql="SELECT * FROM `tbl_ctv` WHERE isactive=1 ".$where.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function Add_new(){
		$sql="INSERT INTO `tbl_ctv`(`cmt`,`password`,`fullname`,`phone`,`email`,`code`,`joindate`,`isactive`) VALUES ('".$this->CMT."','".$this->Password."','".$this->Fullname."','".$this->Phone."','".$this->Email."','".$this->Code."','".date('Y-m-d h:s:i')."','".$this->isActive."')";
		return $this->objmysql->Query($sql);
	}
	public function LOGIN($user,$pass){
		$flag=true;
		$user=md5(sha1($user));
		$pass=md5(sha1($pass));
		if($user=='' || $pass=='')
			$flag=false;
		$sql="SELECT * FROM `tbl_ctv` WHERE `cmt`='$user' AND `isactive`=1";
		$this->objmysql->Query($sql);
		if($this->objmysql->Num_rows()>0){
			$rows=$this->objmysql->Fetch_Assoc();
			if($rows['password']!=$pass)
				$flag=false;
		}
		else{
			$flag=false;
		}
		if($flag==true){
			$_SESSION['SALERISLOGIN']=true;
			$_SESSION['SALERCODE']=$rows['cmt'];
			$_SESSION['SALCODE']=$rows['cmt'];
			$_SESSION['FULLNAME']=$rows['fullname'];
		}
		return $flag;
	}
	public function isLogin(){
		if(isset($_SESSION['SALERISLOGIN']))
			return true;
		return false;
	}
	public function LOGOUT(){
		unset($_SESSION['SALERISLOGIN']);
		unset($_SESSION['SALERCODE']);
		unset($_SESSION['FULLNAME']);
	}
	public function setVisited($id){
		$sql='UPDATE `tbl_ctv` SET `visited`=`visited`+1 WHERE `pro_id`='.$id;
		return $this->objmysql->Query($sql);
	}
}
?>