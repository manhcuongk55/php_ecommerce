<?php
$objsaler=new CLS_SALER;
if($objsaler->isLogin()){
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
		<table width='100%' class='tbl_list'>
			<tr>
				<th>STT</th>
				<th>Số hóa đơn</th>
				<th>Ngày mua</th>
				<th>Trị giá đơn hàng</th>
				<th>Tình trạng</th>
			</tr>
			<?php
			$objorder=new CLS_ORDER;
			$objorder->getList(" WHERE salercode='".$_SESSION['SALERCODE']."'");
			$num=0;
			while($row=$objorder->Fetch_Assoc()){
			$num++;
			?>
			<tr>
				<td align='center'><?php echo $num;?></td>
				<td><?php echo 'HD'.$row['id'];?></td>
				<td><?php echo date('d/m/Y',strtotime($row['cdate']));?></td>
				<td align='right'><?php echo $row['totalmoney'];?>đ</td>
				<td align='center'><?php echo $row['status'];?></td>
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
				<th>STT</th>
				<th>Tên sản phẩm</th>
				<th>Mã số</th>
				<th>Giá bán</th>
				<th>Chi tiết</th>
			</tr>
			<?php
			$objpro=new CLS_PRODUCTS;
			$objpro->getList('',' ORDER BY cdate DESC',' LIMIT 0,10');
			$num=0;
			while($row=$objpro->Fetch_Assoc()){
			$num++;
			?>
			<tr>
				<td align='center'><?php echo $num;?></td>
				<td><?php echo $row['name'];?></td>
				<td><?php echo $row['code'];?></td>
				<td align='center'><?php echo $row['cur_price'];?>đ</td>
				<td align='center'>Chi tiết</td>
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
				<th>STT</th>
				<th>Họ và tên</th>
				<th>Điện thoại</th>
				<th>Email</th>
				<th>Join date</th>
				<th>Trạng thái</th>
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
				<td align='center'><?php echo $num;?></td>
				<td><?php echo $row['fullname'];?></td>
				<td align='right'><?php echo $row['phone'];?></td>
				<td align='left'><?php echo $row['email'];?></td>
				<td align='center'><?php echo date('d/m/Y',strtotime($row['joindate']));?></td>
				<td align='center'>Chính thức</td>
			</tr>
			<?php } 
			}else{
				echo "<tr><td colspan='6'><em>Bạn chưa có ai đăng ký thành viên! Hãy giới thiệu thành viên ngay nhé!</em></td></tr>";
			}?>
		</table>
	</fieldset>
</div>
<?php } ?>