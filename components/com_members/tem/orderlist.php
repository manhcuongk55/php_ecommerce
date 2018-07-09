<?php
$objsaler=new CLS_SALER;
if($objsaler->isLogin()){
	$objorder=new CLS_ORDER;
	$strwhere=" WHERE salercode='".$_SESSION['SALERCODE']."'";
	$month=date('m');
	$year=date('Y');
	if(isset($_POST['cbo_month'])){
		$month=$_POST['cbo_month'];
		$year=$_POST['txt_year'];
		$strwhere.=' AND month(`cdate`)='.$month;
		$strwhere.=' AND year(`cdate`)='.$year;
	}
?>
<style type="text/css">
table.tbl_list{
	border-top:#ccc 1px solid;
	border-left:#ccc 1px solid;
}
table.tbl_list th,table.tbl_list td{
	border-bottom:#ccc 1px solid;
	border-right:#ccc 1px solid;
	padding:3px;
}
table.tbl_list th{
	text-align: center;
	background:#39a3e4
}
table.tbl_list tr:hover td{
	background:#dedede;
	cursor:pointer;
}
div.order_list h1, div.product_list h1, div.members_list h1{
	color:#034B8A;
	font-size:21px;
	font-weight: normal;
}
</style>
<div class='order_list'>
	<h1 class='title'>Đặt hàng mới nhất</h1>
	<fieldset>
		<legend>Danh sách đặt hàng</legend>
		<form method="POST" action='' name='frm'>
		<table width='100%'>
			<tr><td align='right'><strong> Danh sách đơn hàng trong tháng : </strong>
				<select name='cbo_month' onchange='document.frm.submit();'>
					<?php for($i=1;$i<=12;$i++){ $item=$i<10?"0".$i:$i;
					$check='';
					if($i==$month) $check="selected='true'";
					echo "<option value='$i' $check>$item</option>";
					}?>
				</select> / <input type='text' value='<?php echo $year;?>' name='txt_year' size='4'/>
			</td></tr>
		</table>
		</form>
		<table width='100%' class='tbl_list'>
			<tr>
				<th>STT</th>
				<th>Số hóa đơn</th>
				<th>Ngày mua</th>
				<th>Trị giá đơn hàng</th>
				<th>Tình trạng</th>
			</tr>
			<?php
			$objorder->getList($strwhere);
			$num=0;
			while($row=$objorder->Fetch_Assoc()){
			$num++;
			?>
			<tr>
				<td align='center'><?php echo $num;?></td>
				<td align='center'><?php echo 'HD'.$row['id'];?></td>
				<td align='center'><?php echo date('d/m/Y',strtotime($row['cdate']));?></td>
				<td align='center'><?php echo number_format($row['totalmoney']);?> đ</td>
				<td align='center'><?php echo $row['status'];?></td>
			</tr>
			<?php }?>
		</table>
	</fieldset>
</div>
<?php } ?>