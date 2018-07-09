<?php
class CLS_REGISTER{
	private $pro=array(
				  'ID'=>'-1',
				  'Name'=>'',
				  'Gender'=>'',
				  'Address'=>'',
				  'Email'=>'',
				  'Mobile'=>'',
				  'School'=>'',
				  'CourseIDs'=>'',
				  'CourseRegis'=>'',
				  'Dayofweek'=>'',
				  'Timeday'=>'',
				  'Notes'=>'',
				  'CreateDate'=>'',
				  'isActive'=>1
				  );
 	private $objmysql=null;
	public function CLS_REGISTER(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_REGISTER Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_REGISTER Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `edu_register` ".$where;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function cboCourse($id=0) {
		$sql = "SELECT * FROM edu_course WHERE isactive=1 ";
		$objdata=new CLS_MYSQL();
		$this->result=$objdata->Query($sql);
		while ($r=$objdata->Fetch_Assoc()) {
			if($id==$r["id"]) 
				echo '<option value="'.$r["id"].'" selected="selected">'.$r["name"].'</option>';
			else 
				echo '<option value="'.$r["id"].'">'.$r["name"].'</option>';
		}
	}
	function PrintRegis($strwhere=""){
		$sql="SELECT * FROM `edu_register` $strwhere"; //echo $sql;
		$objdata=new CLS_MYSQL();
		$this->result=$objdata->Query($sql);
		$i=0;
		while($r=$objdata->Fetch_Assoc())
		{	$i++;
			echo '<tr>
					<td align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">'.$i.'</td>
					<td style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">'.$r["name"].'&nbsp;</td>
					<td style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">'.$this->CourseName($r["course_regis"]).'&nbsp;</td>
					<td style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">'.$r["dayofweek"].'&nbsp;</td>
					<td style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">'.$r["mobile"].'&nbsp;</td>
					<td style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">'.$r["email"].'&nbsp;</td>
					<td style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">'.$r["school"].'&nbsp;</td>
					<td style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">'.$r["notes"].'&nbsp;</td>
					<td style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">'.$r["create_date"].'&nbsp;</td>
				  </tr>';
		}
	}
	function listTable($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="SELECT edu_register.*,edu_course.name as course_name FROM `edu_register` LEFT JOIN `edu_course` ON edu_register.course_regis=edu_course.id $strwhere";
		
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
			$id=$rows["id"];
			$name=$rows["name"];
			$tel=$rows["mobile"];
			$email=$rows["email"];
			$school=$rows["school"];
			$day=$rows["dayofweek"];
			$course = $rows["course_name"];
			$createdate = $rows["create_date"];
			
			
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"checkid\" id=\"checkid\" onclick=\"docheckonce('checkid');\" value=\"$id\" />";
			echo "</label></td>";
			echo "<td><a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$id\">$name</a></td>";
			echo "<td>$course</td>";
			echo "<td>$day</td>";
			echo "<td>$tel</td>";
			echo "<td>$email</td>";
			echo "<td>$school</td>";
			echo "<td>$createdate</td>";
			echo "<td align=\"center\"><a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$id\">";
			showIconFun('publish',$rows["isactive"]);
			echo "</a></td>";
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
	function Add_new(){
		$sql="INSERT INTO `edu_register` (`name`,`gender`,`address`,`email`,`mobile`,`school`,`course_ids`,`course_regis`,`create_date`,`dayofweek`,`timeday`,`notes`) VALUES ";
		$sql.=" (\"".$this->pro["Name"]."\",\"".$this->pro["Gender"]."\",\"".$this->pro["Address"]."\",\"";
		$sql.=$this->pro["Email"]."\",\"".$this->pro["Mobile"]."\",\"".$this->pro["School"]."\",\"".$this->pro["CourseIDs"]."\",\"";
		$sql.=$this->pro["CourseRegis"]."\",\"".$this->pro["CreateDate"]."\",\"".$this->pro["Dayofweek"]."\",\"";
		$sql.=$this->pro["Timeday"]."\",\"".$this->pro["Notes"]."\") ";
		
		$objdata=new CLS_MYSQL();
		$this->result=$objdata->Query($sql);
		return $this->result;
	}

	function Update(){		 
		$sql="UPDATE `edu_register` SET `name`=\"".$this->pro["Name"]."\",`address`=\"".$this->pro["Address"]."\",`email`=\"".$this->pro["Email"]."\",`mobile`=\"".$this->pro["Mobile"]."\",`gender`=\"".$this->pro["Gender"]."\",`School`=\"".$this->pro["School"]."\",`course_ids`=\"".$this->pro["CourseIDs"]."\",`course_regis`=\"".$this->pro["CourseRegis"]."\",`dayofweek`=\"".$this->pro["Dayofweek"]."\",`isactive`=\"".$this->pro["isActive"]."\", `timeday`=\"".$this->pro["Timeday"]."\"";
		$sql.=" WHERE `id`=\"".$this->pro["ID"]."\"";
		//echo $sql;die;
		$objdata=new CLS_MYSQL();
		$this->result=$objdata->Query($sql);
		return $this->result;
	}
	function ActiveOnce($id){
		$sql="UPDATE `edu_register` SET `isactive` = IF(isactive=1,0,1) WHERE `id` in ('$id')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function Publish($id){
		$sql="UPDATE `edu_register` SET `isactive` = \"1\" WHERE `id` in ('$id')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function UnPublish($id){
		$sql="UPDATE `edu_register` SET `isactive` = \"0\" WHERE `id` in ('$id')";
		$objdata=new CLS_MYSQL();
		return $objdata->Query($sql);
	}
	function Delete($id){
		$sql="DELETE FROM `edu_register` WHERE `id` in ('$id')";
		$objdata=new CLS_MYSQL();
		$this->result=$objdata->Query($sql);
		return $this->result;
	}
}
?>