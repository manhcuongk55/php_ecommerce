<?php
class CLS_CONFIG{
	private $pro=array(
					  'ID'=>'-1',
					  'Title'=>'Công ty TNHH Tân Vương',
					  'CompanyName'=>'Công ty TNHH Tân Vương',
					  'Intro'=>'',
					  'Address'=>'',
					  'Phone'=>'(04) 3633 4888',
					  'Fax'=>'',
					  'Email'=>'maychebiengo.tanvuong@gmail.com',
					  'Meta_keyword'=>'Chế biến gỗ, máy công nghiệp, máy chế biến gỗ, máy cưa, máy bào, máy khoan, máy chà nhám, máy chuốt cạnh...',
					  'Meta_descript'=>'Chế biến gỗ, máy công nghiệp, máy chế biến gỗ, máy cưa, máy bào, máy khoan, máy chà nhám, máy chuốt cạnh...',
					  'Langid'=>'0',
					  'Website'=>'',
					  'Banner'=>'',
					  'Logo'=>'',
					  'Contact'=>'',
					  'Footer'=>'',
					  'Temid'=>'0'
					  );
	private $objmysql=null;
	public function CLS_CONFIG(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo "Error";
			return;
		}
		$this->pro[$proname]=$value;
	}
	function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ("$proname không phải là thành viên của class " );
			return;
		}
		return $this->pro[$proname];
	}
	function getList(){
		$sql="SELECT * FROM `tbl_configsite` WHERE `config_id`=1";
		return $this->objmysql->Query($sql);
	}
	function load_config(){
		$sql="SELECT * FROM `tbl_configsite` WHERE `config_id`=1";
		$this->objmysql->Query($sql);
		if($r=$this->objmysql->Fetch_Assoc()){
			$this->Title=stripslashes($r['title']);
			if($r['company_name']!='')
			$this->CompanyName=stripslashes($r['company_name']);
			$this->Meta_keyword=stripslashes($r['meta_keyword']);
			$this->Meta_descript=stripslashes($r['meta_descript']);
		}
		
		$com=isset($_GET['com'])?addslashes($_GET['com']):'';	
		$viewtype=isset($_GET['viewtype'])?addslashes($_GET['viewtype']):'';
		$id=isset($_GET['id'])?(int)$_GET['id']:0;
		if($com=='contents'){
			$objcon=new CLS_CONTENTS;
			$objcat=new CLS_CATE;
			if($viewtype!='article'){
				if($objcat->getList(' AND `cat_id`='.$id)){
					$r_cat=$objcat->Fetch_Assoc();
					$this->Title=$r_cat['name'].' : Tân vương';
					$this->Meta_keyword=$r_cat['name'].'Tân vương';
					//$this->Meta_descript=$r_cat['intro'];
				}
			}else{
				$objcon->getList(' AND `con_id`='.$id);
				$r_con=$objcon->Fetch_Assoc();
				$objcat->getList(' AND `cat_id`='.$r_con['cat_id']);
				$r_cat=$objcat->Fetch_Assoc();
				$this->Title=$r_cat['name'].' - '.$r_con['title'].' : Tân vương';
				$this->Meta_keyword=stripslashes($r_con['metakey']);
				$this->Meta_descript=stripslashes($r_con['metadesc']);
			}			
		}else if($com=='products'){
			$objpro=new CLS_PRODUCTS;
			$objcat=new CLS_CATALOGS;
			if($viewtype!='detail'){
				if($objcat->getList(' AND `cat_id`='.$id)){
					$r_cat=$objcat->Fetch_Assoc();
					$this->Title=$r_cat['name'];
					$this->Meta_keyword=$r_cat['name'];
					$this->Meta_descript=$r_cat['intro'];
				}
			}else{
				$objpro->getList(' AND `pro_id`='.$id);
				$r_con=$objpro->Fetch_Assoc();
				$objcat->getList(' AND `cat_id`='.$r_con['cat_id']);
				$r_cat=$objcat->Fetch_Assoc();
				$this->Title=$r_cat['name'].' - '.$r_con['name'].' : Tân vương';
				$this->Meta_keyword=stripslashes($r_con['meta_key']);
				$this->Meta_descript=stripslashes($r_con['meta_desc']);
			}	
		}else{
			$objmnu=new CLS_MENUITEM;
			$objmnu->getList($_SESSION['CUR_MENU']);
			$r_mnu=$objmnu->Fetch_Assoc();
			if($r_mnu['name']!='Trang chủ')
				$this->Title=$r_mnu['name'].' : Tân vương';
		}
	}
}
?>