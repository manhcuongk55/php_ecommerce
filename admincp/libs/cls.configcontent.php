<?php
class CLS_CONFIGCONTENT{
	var $pro_menu=array(
					  "ID"=>"-1",
					  "Name"=>"",
					  "Icon"=>"",
					  "ShowName"=>"",
					  "ShowIcon"=>"",
					  "LangID"=>"0",
					  "isActive"=>1
					  );
	var $result;
	var $result1;
	function CLS_CONFIGCONTENT()
	{
	}
	// property set value
	function __set($proname,$value)
	{
		if(!isset($this->pro_menu[$proname]))
		{
			echo "Error";
			return;
		}
		$this->pro_menu[$proname]=$value;
	}
	function __get($proname)
	{
		if(!isset($this->pro_menu[$proname]))
		{
			$this->callmess("$proname ". IS_NOT_MEMBER_IN_CLASS_MYSQL. " " );
			return;
		}
		return $this->pro_menu[$proname];
	}
	function getMenuByID($id){
		$sql="SELECT * FROM `tbl_configcontent` WHERE `id`='$id' ";
		$objdata=new CLS_MYSQL;
		$objdata->query($sql);
		if($objdata->Numrows()>0)
		{
			$rows=$objdata->FetchArray();
			$this->pro_menu["ID"]=$rows["id"];
			$this->pro_menu["Name"]=$rows["name"];
			$this->pro_menu["Icon"]=$rows["icon"];
			$this->pro_menu["ShowName"]=$rows["show_name"];
			$this->pro_menu["ShowIcon"]=$rows["show_icon"];
			$this->pro_menu["LangID"]=$rows["lang_id"];
			$this->pro_menu["isActive"]=$rows["isactive"];
		}
	}
	function getList($where=""){
		$sql="SELECT * FROM `tbl_configcontent` ".$where;
		$objdata=new CLS_MYSQL;
		$this->result=$objdata->query($sql);
	}
	function listTable($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="SELECT * FROM `tbl_configcontent` ".$strwhere ." LIMIT $star,$leng";
		$objdata=new CLS_MYSQL;
		$objdata->query($sql);
		$i=0;
		while($rows=$objdata->FetchArray())
		{	$i++;
			$id=$rows["id"];
			$name=$rows["name"];
			$icon=$rows["icon"];
			if($icon!='') $icon='<img src="../'.$icon.'"/>';
			
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"checkid\" id=\"checkid\" onclick=\"docheckonce('checkid');\" value=\"$id\" />";
			echo "</label></td>";
			echo "<td>$name&nbsp;</td>";
			echo "<td>$icon&nbsp;</td>";
			echo "<td align=\"center\"><a href=\"index.php?com=".COMS."&amp;task=showname&amp;id=$id\">";
			showIconFun('show',$rows["show_name"]);
			echo "</a></td>";
			echo "<td align=\"center\"><a href=\"index.php?com=".COMS."&amp;task=showicon&amp;id=$id\">";
			showIconFun('show',$rows["show_icon"]);
			echo "</a></td>";
			echo "<td width=\"50\" align=\"center\">";
			echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$id\">";
			showIconFun('publish',$rows["isactive"]);
			echo "</a>";
			
			echo "</td>";
			echo "<td width=\"50\" align=\"center\">";
			
			echo "<a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$id\">";
			showIconFun('edit','');
			echo "</a>";
			
			echo "</td>";
			echo "<td width=\"50\" align=\"center\">";
			
			echo "<a href=\"javascript:detele_field('index.php?com=".COMS."&amp;task=delete&amp;id=$id')\">";
			showIconFun('delete','');
			echo "</a>";
			
			echo "</td>";
		  	echo "</tr>";
		}
	}
	function Numrows(){
		if(@mysql_num_rows($this->result)>0)
			return @mysql_num_rows($this->result);
		else 
			return 0;
	}
	function Add_new(){
		$sql="INSERT INTO `tbl_configcontent`(`name`,`icon`,`show_name`,`show_icon`,`lang_id`,`isactive`) VALUES ";
		$sql.=" ('".$this->pro_menu["Name"]."','".$this->pro_menu["Icon"]."','".$this->pro_menu["ShowName"]."','";
		$sql.=$this->pro_menu["ShowIcon"]."','".$this->pro_menu["LangID"]."','".$this->pro_menu["isActive"]."') ";
		$objdata=new CLS_MYSQL;
		$this->result=$objdata->Query($sql);
		return $this->result;
	}
	function Update(){
		$sql="UPDATE `tbl_configcontent` SET `name`='".$this->pro_menu["Name"]."',
									 `icon`='".$this->pro_menu["Icon"]."',
									 `show_name`='".$this->pro_menu["ShowName"]."',
									 `show_icon`='".$this->pro_menu["ShowIcon"]."',
									 `lang_id`='".$this->pro_menu["LangID"]."',
									 `isactive`='".$this->pro_menu["isActive"]."' ";
		$sql.=" WHERE `id`='".$this->pro_menu["ID"]."'";
		$objdata=new CLS_MYSQL;
		$this->result=$objdata->Query($sql);
		return $this->result;
	}
	function ActiveOnce($ids){
		$sql="UPDATE `tbl_configcontent` SET `isactive` = IF(isactive=1,0,1) WHERE `id` in ('$ids')";
		$objdata=new CLS_MYSQL;
		$result=$objdata->query($sql);
	}
	function ShowNameOnce($ids){
		$sql="UPDATE `tbl_configcontent` SET `show_name` = IF(show_name=1,0,1) WHERE `id` in ('$ids')";
		$objdata=new CLS_MYSQL;
		$result=$objdata->query($sql);
	}
	function ShowIconOnce($ids){
		$sql="UPDATE `tbl_configcontent` SET `show_icon` = IF(show_icon=1,0,1) WHERE `id` in ('$ids')";
		$objdata=new CLS_MYSQL;
		$result=$objdata->query($sql);
	}
	function Publish($ids){
		$sql="UPDATE `tbl_configcontent` SET `isactive` = '1' WHERE `id` in ('$ids')";
		$objdata=new CLS_MYSQL;
		$result=$objdata->query($sql);
	}
	function UnPublish($ids){
		$sql="UPDATE `tbl_configcontent` SET `isactive` = '0' WHERE `id` in ('$ids')";
		$objdata=new CLS_MYSQL;
		$result=$objdata->query($sql);
	}
	function Delete($ids){
		$objdata=new CLS_MYSQL;
		$objdata->Query("BEGIN");
		$sql="DELETE FROM `tbl_configcontent` WHERE `id` in ('$ids')";
		$result=$objdata->Query($sql);
		$sql="DELETE FROM `tbl_configcontent_text` WHERE `id` in ('$ids')";
		$result1=$objdata->Query($sql);
		
		if($result && $result1 ){
			$objdata->Query('COMMIT');
			$this->result = $result;
		}
		else {
			$objdata->Query('ROLLBACK');
		}
		return $this->result;
	}
}
?>