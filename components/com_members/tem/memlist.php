<?php
$objsaler=new CLS_SALER;
if($objsaler->isLogin()){
	$objsale=new CLS_SALER;
	$strwhere=" AND code='".$_SESSION['SALERCODE']."'";
	$month=date('m');
	$year=date('Y');
	if(isset($_POST['cbo_month'])){
		$month=$_POST['cbo_month'];
		$year=$_POST['txt_year'];
		$strwhere.=' AND month(`joindate`)='.$month;
		$strwhere.=' AND year(`joindate`)='.$year;
	}
	$objsale->getList($strwhere);
?>
<style type="text/css">

</style>
<div class='members_list'>
	<h1 class='title'>Thành viên mới đăng ký</h1>
	<fieldset>
		<legend>Danh sách thành viên</legend>
		<form method="POST" action='' name='frm'>
		<table width='100%'>
			<tr><td align='right'><strong> Danh sách thành viên trong tháng : </strong>
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
				<th width='5%'>STT</th>
				<th width='30%'>Họ và tên</th>
				<th width='20%'>Điện thoại</th>
				<th width='20%'>Email</th>
				<th width='20%'>Join date</th>
				<th width='5%'>Trạng thái</th>
			</tr>
			<?php
			if($objsale->Num_rows()>0){
			$num=0;
			while($row=$objsale->Fetch_Assoc()){
				$num++;
			?>
			<tr>
				<td align='center' width='5%'><?php echo $num;?></td>
				<td width='30%'><?php echo $row['fullname'];?></td>
				<td align='right'width='20%'><?php echo $row['phone'];?></td>
				<td align='left' width='20%'><?php echo $row['email'];?></td>
				<td align='center' width='20%'><?php echo date('d/m/Y',strtotime($row['joindate']));?></td>
				<td align='center' width='5%'>Chính thức</td>
			</tr>
			<?php } 
			}else{
				echo "<tr><td colspan='6'><em>Bạn chưa có ai đăng ký thành viên! Hãy giới thiệu thành viên ngay nhé!</em></td></tr>";
			}?>
		</table>
	</fieldset>
</div>
<?php } ?>