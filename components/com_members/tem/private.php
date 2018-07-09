<?php
$objsaler=new CLS_SALER;
if($objsaler->isLogin()){
?>
<div class='order_list'>
	<h1 class='title'>Đặt hàng mới nhất</h1>
	<fieldset>
		<legend>Danh sách đặt hàng</legend>
		<table width='100%' class='tbl_list'>
			<tr>
				<th width='5%'>STT</th>
				<th width='15%'>Số hóa đơn</th>
				<th width='30%'>Khách hàng</th>
				<th width='20%'>Ngày mua</th>
				<th width='20%'>Trị giá đơn hàng</th>
				<th width='10%'>Tình trạng</th>
			</tr>
			<?php
			$objorder=new CLS_ORDER;
			$objorder->getList(" WHERE salercode='".$_SESSION['SALERCODE']."'");
			$num=0;
			while($row=$objorder->Fetch_Assoc()){
			$num++;
			?>
			<tr>
				<td align='center' width='5%'><?php echo $num;?></td>
				<td align='center' width='15%'><?php echo 'HD'.$row['id'];?></td>
				<td align='center' width='30%'><?php echo $row['cname'];?></td>
				<td align='center' width='20%'><?php echo date('d/m/Y',strtotime($row['cdate']));?></td>
				<td align='center' width='20%'><?php echo number_format($row['totalmoney']);?> đ</td>
				<td align='center' width='10%'><?php echo $row['status'];?></td>
			</tr>
			<?php }?>
		</table>
	</fieldset>
</div>
<div class='product_list'>
	<h1 class='title'>Sản phẩm mới nhất hôm nay</h1>
	<fieldset>
		<legend>Danh sách sản phẩm mới</legend>
		<table width='100%' class='tbl_list'>
			<tr>				
				<th width='5%'>STT</th>
				<th width='45%'>Tên sản phẩm</th>
				<th width='20%'>Mã số</th>
				<th width='20%'>Giá bán</th>
				<th width='10%'>Chi tiết</th>
			</tr>
			<?php
			$objpro=new CLS_PRODUCTS;
			$objpro->getList('',' ORDER BY cdate DESC',' LIMIT 0,10');
			$num=0;
			while($row=$objpro->Fetch_Assoc()){
			$num++;
			?>
			<tr>
				<td align='center' width='5%'><?php echo $num;?></td>
				<td width='45%'><?php echo $row['name'];?></td>
				<td width='20%'><?php echo $row['code'];?></td>
				<td align='center' width='20%'><?php echo number_format($row['cur_price']);?>đ</td>
				<td align='center' width='10%'>Chi tiết</td>
			</tr>
			<?php }?>
		</table>
	</fieldset>
</div>
<div class='members_list'>
	<h1 class='title'>Thành viên mới đăng ký</h1>
	<fieldset>
		<legend>Danh sách thành viên</legend>
		<table width='100%' class='tbl_list'>
			<tr>
				<th width='5%'>STT</th>
				<th width='30%'>Họ và tên</th>
				<th width='15%'>Điện thoại</th>
				<th width='20%'>Email</th>
				<th width='15%'>Join date</th>
				<th width='15%'>Trạng thái</th>
			</tr>
			<?php
			$objsale=new CLS_SALER;
			$objsale->getList(" AND code='".$_SESSION['SALERCODE']."'");
			if($objsale->Num_rows()>0){
			$num=0;
			while($row=$objsale->Fetch_Assoc()){
				$num++;
			?>
			<tr>
				<td align='center' width='5%'><?php echo $num;?></td>
				<td width='30%'><?php echo $row['fullname'];?></td>
				<td align='right' width='15%'><?php echo $row['phone'];?></td>
				<td align='left' width='20%'><?php echo $row['email'];?></td>
				<td align='center' width='15%'><?php echo date('d/m/Y',strtotime($row['joindate']));?></td>
				<td align='center' width='15%'>Chính thức</td>
			</tr>
			<?php } 
			}else{
				echo "<tr><td colspan='6'><em>Bạn chưa có ai đăng ký thành viên! Hãy giới thiệu thành viên ngay nhé!</em></td></tr>";
			}?>
		</table>
	</fieldset>
</div>
<?php } ?>