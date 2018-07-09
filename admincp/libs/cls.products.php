<?php
class CLS_PRODUCTS{
	private $pro=array(
			'ID'=>'-1',
			'CatID'=>'0',
			'Code'=>'0',
			'Name'=>'',
			'Intro'=>'',
			'Fulltext'=>'',
			'Config'=>'',
			'Thumb'=>'',
			'Old_price'=>'0',
			'Cur_price'=>'0',
			'Quantity'=>'0',
			'Cdate'=>'',
			'Mdate'=>'',
			'MKey'=>'',
			'MDesc'=>'',
			'Visit'=>'',
			'Order'=>'',
			'isHot'=>'0',
			'Class'=>'',
			'isActive'=>'1',
			'isShow'=>'1',
			'isConfigPro'=>'1',
			'imgSlide'=>'',
			'folder'=>'');
	private $objmysql;
	public function CLS_PRODUCTS(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PRODUCTS Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PRODUCTS Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	function getList($strwhere="",$lagid=0){
		$sql=" SELECT * FROM tbl_product $strwhere";
		// echo $sql;die;
		return $this->objmysql->Query($sql);
	}
	function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getCatName($catid) {
		$sql="SELECT name FROM tbl_catalog WHERE cat_id=$catid";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		if($objdata->Num_rows()>0) {
			$r=$objdata->Fetch_Assoc();
			return $r['name'];
		}
	}
	function getClass($catid) {
		$sql="SELECT `class` FROM tbl_catalog WHERE cat_id=$catid";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		if($objdata->Num_rows()>0) {
			$r=$objdata->Fetch_Assoc();
			return $r['class'];
		} else {
			return 'cat_red';
		}	

	}
	function listTablePro($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="	SELECT * FROM tbl_product $strwhere ORDER BY `order` DESC, cat_id LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
			$ids=$rows['pro_id'];
			$code=Substring(stripslashes($rows['code']),0,10);
			$title=Substring(stripslashes($rows['name']),0,10);
			include_once("../includes/simple_html_dom.php");
			$intro = Substring(stripslashes($rows['intro']),0,10);
			$intro = str_get_html($intro);
			$old_price = number_format($rows['old_price']).' <b>VNĐ</b>';
			$cur_price = number_format($rows['cur_price']).' <b>VNĐ</b>';
			$category = $this->getCatName($rows['cat_id']);
			
			$visited=$rows['visited'];
			$order=$rows['order'];
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
			echo "</label></td>";
			echo "<td title='$intro'>$code</td>";
			echo "<td title='$intro'>$title</td>";
			echo "<td>$category</td>";
			// echo "<td nowrap='nowrap'>$old_price</td>";
			// echo "<td nowrap='nowrap'>$cur_price</td>";
			echo "<td nowrap='nowrap' align='center'>$visited</td>";
			// echo "<td align=\"center\"><input type=\"text\" name=\"txtorder\" id=\"txtorder\" value=\"$order\" size=\"4\" class=\"order\"></td>";
			// echo "<td align=\"center\">";
		
			// echo "<a href=\"index.php?com=".COMS."&amp;task=hot&amp;id=$ids\">";
			// showIconFun('publish',$rows['ishot']);
			// echo "</a>";
		
			// echo "</td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$ids\">";
			showIconFun('publish',$rows['isactive']);
			echo "</a>";
		
			echo "</td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$ids\">";
			showIconFun('edit','');
			echo "</a>";
		
			echo "</td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"javascript:detele_field('index.php?com=".COMS."&amp;task=delete&amp;id=$ids')\" >";
			showIconFun('delete','');
			echo "</a>";
		
			echo "</td>";
			echo "</tr>";
		}
	}
	function Add_new(){				
		$sql="INSERT INTO tbl_product (`cat_id`,`code`,`class`,`isShow`,`isConfigPro`,`name`,`intro`,`fulltext`,`folder`,`imgslide`,`thumb`,`old_price`,`cur_price`,`quantity`,`cdate`,`mdate`,`order`,`meta_key`,`meta_desc`,`ishot`,`isactive`,`config`) VALUES ";
		$sql.="('".$this->CatID."','".$this->Code."','".$this->Class."','".$this->isShow."','".$this->isConfigPro."','".$this->Name."','".$this->Intro."','".$this->Fulltext."','".$this->folder."','".$this->imgSlide."','".$this->Thumb."','";
		$sql.=$this->Old_price."','".$this->Cur_price."','".$this->Quantity."','";
		$sql.=$this->Cdate."','".$this->Mdate."','".$this->Order."','";
		$sql.=$this->MKey."','".$this->MDesc."','".$this->isHot."','".$this->isActive."','".$this->Config."')";
		
		$result = $this->objmysql->Exec($sql);
		$idPro = $this->objmysql->LastInsertID();
		return $idPro;
	}
	function Update(){
		$sql="UPDATE tbl_product SET `cat_id`='".$this->CatID."',
									 `code`='".$this->Code."',
									 `class`='".$this->Class."',
									 `name`='".$this->Name."',
									 `intro`='".$this->Intro."',
									 `fulltext`='".$this->Fulltext."',
									 `thumb`='".$this->Thumb."',
									 `old_price`='".$this->Old_price."',
									 `cur_price`='".$this->Cur_price."',
									 `quantity`='".$this->Quantity."',
									 `cdate`='".$this->Cdate."',
									 `mdate`='".$this->Mdate."',
									 `order`='".$this->Order."',
									 `meta_key`='".($this->MKey)."',
									 `meta_desc`='".($this->MDesc)."',
									 `ishot`='".$this->isHot."',
									 `isactive`='".$this->isActive."',
									 `config` ='".$this->Config."',
									 `isShow`='".$this->isShow."',
									 `isConfigPro`='".$this->isConfigPro."',
									 `folder`='".$this->folder."',
									 `imgslide`='".$this->imgSlide."'
								WHERE `pro_id`='".$this->ID."'";

								// echo $sql;die;
		$this->objmysql->Exec($sql);
		return $this->ID;
	}
	function Delete($ids){
		$sql="DELETE FROM `tbl_product` WHERE `pro_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function setHot($ids){
		$sql="UPDATE `tbl_product` SET `ishot`=if(`ishot`=1,0,1) WHERE `pro_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_product` SET `isactive`='$status' WHERE `pro_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_product` SET `isactive`=if(`isactive`=1,0,1) WHERE `pro_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Order($ids,$order){
		$sql="UPDATE tbl_product SET `order`='".$order."' WHERE `pro_id`='".$ids."'";	
		return $this->objmysql->Exec($sql);
	}
	function Orders($arids,$arods){
		for($i=0;$i<count($arids);$i++){
			$this->Order($arids[$i],$arods[$i]);
		}
	}
}
?>