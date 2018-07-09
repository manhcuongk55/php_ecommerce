<?php
class CLS_COMM{
	private $pro=array(
			'Id'=>'01',
			'Parid'=>'0',
			'Pro_id'=>'0',
			'Con_id'=>'0',
			'Mess'=>'',
			'Name'=>'',
			'Email'=>'',
			'Joindate'=>'',
			'isActive'=>'1'
	);
	private $objmysql=null;
	public function CLS_COMM(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_COMM Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_COMM Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	public function getList($where=""){
		$sql="SELECT * FROM `tbl_comment` ".$where;
		return $this->objmysql->Query($sql);
	}
	public function getCommentByProId($proid){
		$sql="SELECT * FROM tbl_comment WHERE AND pro_id='$proid' AND par_id=0";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		while($row=$objdata->Fetch_Assoc()){
			echo "<tr>
				<td width='50' valign='top'><div class='img_avata'></div></td>
				<td>
				<div class='item_comment'>
					<strong>".$row['name']."</strong> (".$row['joindate'].")<br/>".$row['mess']."
				</div>";
			$this->getCommentByPar($row['comm_id']);
			echo "</td></tr>";
		}
	}
	public function getCommentByPar($par){
		$sql="SELECT * FROM tbl_comment WHERE par_id='$par'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		while($row=$objdata->Fetch_Assoc()){
			echo "<div class='item_comment'>
				<div class='img_avata'></div>
				<div class='mess'>
				<strong>".$row['name']."</strong> (".$row['joindate'].")<br/>".$row['mess']."
				</div></div>";
		}
		echo "<div class='item_comment'>
				<textarea style='width:100%' id='$par' rows='2'></textarea>
			</div>";
	}
	function Num_rows() { 
		return $this->objmysql->Num_rows();
	}
	function Fecth_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function listTableComm($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="	SELECT * FROM tbl_comment $strwhere ORDER BY `joindate` DESC LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
			$ids=$rows['comm_id'];
			$name=Substring(stripslashes($rows['name']),0,10);
			$email=$rows['email'];
			$mess=$rows['mess'];
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
			echo "</label></td>";
			echo "<td>$name&nbsp;</td>";
			echo "<td>$email&nbsp;</td>";
			echo "<td>$mess &nbsp;</td>";
			
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
	function Delete($ids){
		$sql="DELETE FROM `tbl_comment` WHERE `comm_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_comment` SET `isactive`='$status' WHERE `comm_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_comment` SET `isactive`=if(`isactive`=1,0,1) WHERE `comm_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function Add_New(){
		$sql="INSERT INTO tbl_comment(`par_id`,`pro_id`,`con_id`,`mess`,`name`,`email`,`joindate`,`isactive`) VALUES 
			('".$this->Parid."','".$this->Pro_id."','".$this->Con_id."','".$this->Mess."','".$this->Name."','".$this->Email."','".$this->Joindate."','".$this->isActive."')";
		return $this->objmysql->Query($sql);
			
	}
}
?>