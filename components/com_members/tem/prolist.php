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
<div class='product_list'>
	<h1 class='title'>Sản phẩm mới nhất hôm nay</h1>
	<fieldset>
		<legend>Danh sách sản phẩm mới</legend>
		<table width='100%' class='tbl_list'>
			<tr>
				<th width='5%'>STT</th>
				<th width='40%'>Tên sản phẩm</th>
				<th width='20%'>Mã số</th>
				<th width='20%'>Giá bán</th>
				<th width='15%'>Chi tiết</th>
			</tr>
			<?php
			$objpro=new CLS_PRODUCTS;
			$objpro->getList('',' ORDER BY cdate DESC',' LIMIT 0,20');
			$num=0;
			while($row=$objpro->Fetch_Assoc()){
			$num++;
			?>
			<tr>
				<td align='center' width='5%'><?php echo $num;?></td>
				<td width='40%'><?php echo $row['name'];?></td>
				<td width='20%'><?php echo $row['code'];?></td>
				<td align='center' width='20%'><?php echo number_format($row['cur_price']);?>đ</td>
				<td align='center' width='15%'>Chi tiết</td>
			</tr>
			<?php }?>
		</table>
	</fieldset>
</div>
<?php } ?>