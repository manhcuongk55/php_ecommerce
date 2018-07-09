<?php
class CLS_MENUITEM{
	private $pro=array(
					  'ID'=>'-1',
					  'Par_ID'=>'0',
					  'Code'=>'',
					  'Name'=>'default',
					  'Intro'=>'',
					  'Mnu_ID'=>'0',
					  'Viewtype'=>'block',
					  'Cat_ID'=>'0',
					  'Con_ID'=>'0',
					  'Link'=>'',
					  'Class'=>'',
					  'Order'=>'',
					  'LangID'=>'0',
					  'isActive'=>1
					  );
	private $rowcount=0;
	private $objmysql=NULL;
	public function CLS_MENUITEM(){
		$this->objmysql=new CLS_MYSQL;
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
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `view_menuitem` ".$where.' ORDER BY `order` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getListMenuItem($mnuid,$par_id,$level){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0)
			return;
		$strspace="";
		if($level!=0){
			for($i=0;$i<$level;$i++)
				$strspace.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$strspace.="|---";
		}
		$str="";
		while($rows=$objdata->Fetch_Assoc()){
			$str.="<option onclick=\"getIDs();\" value=\"".$rows["mnuitem_id"]."\" >".$strspace.$rows["name"]."</option>";
			$nextlevel=$level+1;
			$str.=$this->getListMenuItem($mnuid,$rows["mnuitem_id"],$nextlevel);
		}
		return $str;
	}
	function listTableItemMenu($strwhere="",$page,$par_id,$level){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND ".$strwhere;
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$str_space="";
		if($level!=0){
			for($i=0;$i<$level;$i++)
				$str_space.="&nbsp;&nbsp;&nbsp;";
			$str_space.="|---";
		}
		while($rows=$objdata->Fetch_Assoc())
		{	$this->rowcount++;
			$mnuids=$rows['mnuitem_id'];
			$par_id=$rows['par_id'];
			$code=$rows['code'];
			$name=Substring($rows['name'],0,10);
			$type=$rows['viewtype'];
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" onclick=\"docheckonce('chk');\" value=\"$mnuids\" />";
			echo "</label></td>";
			echo "<td width=\"50\" align=\"center\">$par_id</td>";
			echo "<td align=\"left\">$str_space $code</td>";
			echo "<td>$str_space $name</td>";
			echo "<td width=\"100\" align=\"center\">$type &nbsp;</td>";
			echo "<td width=\"50\" align=\"center\"><input type=\"text\" name=\"txtorder\" id=\"txtorder\" value=\"0\" size=\"4\" class=\"order\"></td>";
			echo "<td width=\"50\" align=\"center\">";
				echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$mnuids\">";
				showIconFun('publish',$rows["isactive"]);
				echo "</a>";
			echo "</td>";
			echo "<td width=\"50\" align=\"center\">";
				echo "<a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$mnuids\">";
				showIconFun('edit','');
				echo "</a>";			
			echo "</td>";
			echo "<td width=\"50\" align=\"center\">";
				echo "<a href=\"index.php?com=".COMS."&amp;task=delete&amp;id=$mnuids\" onclick=\"return confirm('Do you want to delete this record?');\">";
				showIconFun('delete','');
				echo "</a>";
			echo "</td>";
		  	echo "</tr>";
			$nextlevel=$level+1;
			$this->listTableItemMenu($strwhere,$page,$mnuids,$nextlevel);
		}
	}
	function getChildID($parid) {
		$sql = "SELECT mnuitem_id FROM tbl_mnuitem WHERE par_id IN ('$parid')"; 
		$this->objmysql->Query($sql);
		$ids='';
		if($this->objmysql->Num_rows()>0) {
			while($r = $this->objmysql->Fetch_Assoc()) {
				$ids.=$r[0]."','";
				$ids.=$this->getChildID($r[0]);
			}
		}
		return $ids;
	}
	public function Add_new(){
		$sql="INSERT INTO `tbl_mnuitem`(`par_id`,`code`,`mnu_id`,`viewtype`,`cat_id`,`con_id`,`link`,`class`,`isactive`) VALUES ";
		$sql.=" ('".$this->Par_ID."','".$this->Code."','".$this->Mnu_ID."','".$this->Viewtype."','".$this->Cat_ID."','".$this->Con_ID."','".$this->Link."','".$this->Class."','".$this->isActive."') ";
		
		$this->objmysql->Exec("BEGIN");
		$result = $this->objmysql->Exec($sql);
		$mnuitemid=$this->objmysql->LastInsertID();
		
		$sql="INSERT INTO 	`tbl_mnuitem_text`(`mnuitem_id`,`name`,`intro`,`lag_id`) VALUES ";
		$sql.=" ('$mnuitemid','".$this->Name."','".$this->Intro."','".$this->LangID."')";
		$result1=$this->objmysql->Exec($sql);
		
		if($result && $result1){
			$this->objmysql->Exec('COMMIT');
			return true;
		}else{
			$this->objmysql->Exec('ROLLBACK');
			return false;
		}
	}
	function Update(){
		$sql="UPDATE `tbl_mnuitem` SET  `par_id`='".$this->Par_ID."',
										`code`='".$this->Code."',
										`mnu_id`='".$this->Mnu_ID."',
									    `viewtype`='".$this->Viewtype."',
										`cat_id`='".$this->Cat_ID."',
										`con_id`='".$this->Con_ID."',
										`link`='".$this->Link."',
										`class`='".$this->Class."',
										`isactive`='".$this->isActive."'";
		$sql.=" WHERE `mnuitem_id`='".$this->ID."'";
		$this->objmysql->Exec("BEGIN");
		$result=$this->objmysql->Exec($sql);
		$sql="UPDATE `tbl_mnuitem_text` SET `intro`='".$this->Intro."',`name`='".$this->Name."'";
		$sql.=" WHERE `mnuitem_id`='".$this->ID."'";
		$result1=$this->objmysql->Exec($sql);
		if($result && $result1){
			$this->objmysql->Exec('COMMIT');
			return true;
		}else{
			$this->objmysql->Exec('ROLLBACK');
			return false;
		}
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_mnuitem` SET `isactive`='$status' WHERE `mnuitem_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_mnuitem` SET `isactive`=if(`isactive`=1,0,1) WHERE `mnuitem_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Delete($ids){
		$sql="DELETE FROM `tbl_mnuitem` WHERE `mnuitem_id` in ('$ids')";
		$this->objmysql->Exec('BEGIN');
		$result=$this->objmysql->Exec($sql);
		
		$sql="DELETE FROM `tbl_mnuitem_text` WHERE `mnuitem_id` in ('$ids')";
		$result1=$this->objmysql->Exec($sql);
		
		if($result && $result1 ){
			$this->objmysql->Exec('COMMIT');
			return true;
		}else {
			$this->objmysql->Exec('ROLLBACK');
			return false;
		}
	}
}
?>