<?php
class CLS_COMS extends CLS_MYSQL{
	var $pro_com=array(
					  "ID"=>"-1",
					  "Code"=>"default",
					  "Name"=>"default",
					  "Desc"=>"",
					  "Site"=>"",
					  "isActive"=>1
					  );
	function CLS_COMS()
	{
	}
	// property set value
	function __set($proname,$value)
	{
		if(!isset($this->pro_com[$proname]))
		{
			echo "Error";
			return;
		}
		$this->pro_com[$proname]=$value;
	}
	function __get($proname)
	{
		if(!isset($this->pro_com[$proname]))
		{
			$this->callmess("$proname ". IS_NOT_MEMBER_IN_CLASS_MYSQL. " " );
			return;
		}
		return $this->pro_com[$proname];
	}
	function getComByID($comid){
		$sql="SELECT * FROM `tbl_component` WHERE `com_id`='$comid' ";
		parent::query($sql);
		if(parent::Numrows()>0)
		{
			$rows=parent::FetchArray();
			$this->pro_com["ID"]=$rows["com_id"];
			$this->pro_com["Code"]=$rows["code"];
			$this->pro_com["Name"]=$rows["name"];
			$this->pro_com["Desc"]=$rows["desc"];
			$this->pro_com["Site"]=$rows["site"];
			$this->pro_com["isActive"]=$rows["isactive"];
		}
	}
	function getList($where=""){
		$sql="SELECT * FROM `tbl_component` ".$where;
		parent::query($sql);
	}
	
	function getListCom($type)
	{
		$this->getList(" WHERE `isactive`='1'");
		if($this->Numrows()<=0)
			return;
		$str="";
		while($rows=parent::FetchArray())
		{
			if($type=="list")
			$str.="<li>".$rows["name"]."</li>";
			else if($type=="option")
			$str.="<option value=\"".$rows["com_id"]."\">".$rows["name"]."</option>";
			else 
			$str.=$rows["name"];
		}
		return $str;
	}
	function listTableCom($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="SELECT * FROM `tbl_component` ".$strwhere ." LIMIT $star,$leng";
		//echo $sql; exit();
		parent::query($sql);
		$i=0;
		while($rows=parent::FetchArray())
		{	$i++;
			$comid=$rows["com_id"];$code=$rows["code"];$name=Substring($rows["name"],0,10);$desc=$rows["desc"];
			$site=$rows["site"];
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"checkid\" id=\"checkid\" onclick=\"docheckonce('checkid');\" value=\"$comid\" />";
			echo "</label></td>";
			echo "<td width=\"75\" align=\"center\">$code</td>";
			echo "<td nowrap=\"nowrap\">$name</td>";
			echo "<td nowrap=\"nowrap\">$desc &nbsp;</td>";
			echo "<td width=\"50\" align=\"center\">$site &nbsp;</td>";
			echo "<td width=\"50\" align=\"center\">";
			echo "<a href=\"index.php?com=components&amp;task=active&amp;comid=$comid\">";
			showIconFun('publish',$rows["isactive"]);
			echo "</a>";
			
			echo "</td>";
			echo "<td width=\"50\" align=\"center\">";
			echo "<a href=\"index.php?com=components&amp;task=edit&amp;comid=$comid\">";
			showIconFun('edit','');
			echo "</a>";
			
			echo "</td>";
			echo "<td width=\"50\" align=\"center\">";
			
			echo "<a href=\"index.php?com=components&amp;task=delete&amp;comid=$comid\">";
			showIconFun('delete','');
			echo "</a>";
			
			echo "</td>";
		  	echo "</tr>";
		}
	}
	function Numrows() { 
		return parent::Numrows();
	}
	function Add_new(){
		$sql="INSERT INTO `tbl_component`(`code`,`name`,`desc`,`site`,`isactive`) VALUES ";
		$sql.=" ('".$this->pro_com["Code"]."','".$this->pro_com["Name"]."','".$this->pro_com["Desc"]."','".$this->pro_com["Site"]."','".$this->pro_com["isActive"]."') ";
		return parent::query($sql);
	}
	function Update(){
		$sql="UPDATE `tbl_component` SET `code`='".$this->pro_com["Code"]."',`name`='".$this->pro_com["Name"]."',`desc`='".$this->pro_com["Desc"]."',`site`='".$this->pro_com["Site"]."',`isactive`='".$this->pro_com["isActive"]."' ";
		$sql.=" WHERE `com_id`='".$this->pro_com["ID"]."'";
		return parent::query($sql);
	}
	function ActiveOnce($comids){
		$sql="UPDATE `tbl_component` SET `isactive` = IF(isactive=1,0,1) WHERE `com_id` in ('$comids')";
		//echo $sql; exit();
		return parent::query($sql);
	}
	function Publish($comids){
		$sql="UPDATE `tbl_component` SET `isactive` = '1' WHERE `com_id` in ('$comids')";
		return parent::query($sql);
	}
	function UnPublish($comids){
		$sql="UPDATE `tbl_component` SET `isactive` = '0' WHERE `com_id` in ('$comids')";
		return parent::query($sql);
	}
	function Delete($comids){
		$sql="DELETE FROM `tbl_component` WHERE `com_id` in ('$comids')";
		return parent::query($sql);
	}
}
?>