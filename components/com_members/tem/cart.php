<?php
if(isset($_POST['update_car'])){
	$ids=$_POST['txt_id'];
	$qua=$_POST['txt_qua'];
	$note=$_POST['txt_note'];
	for($i=0;$i<count($ids);$i++){
		$item=array('ID'=>$ids[$i],'QUA'=>$qua[$i],'NOTE'=>$note[$i]);
		$_SESSION['CART'][$i]=$item;
	}
}
?>
<fieldset style="background: #fff;"><legend><strong>Danh sách sản phẩm trong giỏ hàng</strong></legend>
<style type='text/css'>
table.tbl_list{
	border-top:#ccc 1px solid;
	border-left:#ccc 1px solid;
}
table.tbl_list th,table.tbl_list td{
	border-bottom:#ccc 1px solid;
	border-right:#ccc 1px solid;
}
table.tbl_list th{
	text-align: center;
}
</style>
<form method='POST' action=''>
<table width='100%' class='tbl_list'>
	<tr>
		<th>STT</th>
		<th>Tên sản phẩm</th>
		<th>Số lượng</th>
		<th>Đơn giá</th>
		<th>Thành tiền</th>
		<th>Ghi chú</th>
		<th>&nbsp;</th>
	</tr>
	<?php
	$n=count($_SESSION['CART']);
	$objcon=new CLS_PRODUCTS;
	$total=0;
	for($i=0;$i<$n;$i++){
		$objcon->getList(' AND pro_id='.$_SESSION['CART'][$i]['ID']);
		$row=$objcon->Fetch_Assoc();
		$price=$row['cur_price'];
		$amount=$row['cur_price']*$_SESSION['CART'][$i]['QUA'];
		$total+=$amount;
	?>
	<tr>
		<td align='center'><?php echo ($i+1);?></td>
		<td><?php echo $row['name'];?></td>
		<td align='center'>
			<input type='hidden' name='txt_id[]' value='<?php echo $_SESSION['CART'][$i]['ID'];?>'/>
			<input type='text' size='2' style='text-align:center' name='txt_qua[]' value='<?php echo $_SESSION['CART'][$i]['QUA'];?>'/>
		</td>
		<td align='center'><?php echo number_format($price);?> <strong>đ</strong></td>
		<td align='center'><?php echo number_format($amount);?> <strong>đ</strong></td>
		<td align='center'><textarea name='txt_note[]' rows='1'><?php echo $_SESSION['CART'][$i]['NOTE'];?></textarea></td>
		<td align='center'><a href='<?php echo ROOTHOST.'del-cart-sp'.$_SESSION['CART'][$i]['ID'];?>.html'>Xóa</a></td>
	</tr>
	<?php }?>
	<tr>
		<td colspan='4' align='right'><strong>Tổng thành tiền</strong></td>
		<td colspan='3'><?php echo number_format($total);?> <strong>đ</strong></td>
	</tr>
</table>
<script language='javascript'>
	$(document).ready(function(){
		$('#order').click(function(){window.location='<?php echo ROOTHOST.'dat-hang.html';?>';});
		$('#continue').click(function(){window.location='<?php echo ROOTHOST.'san-pham.html';?>';});
	});
</script>
<input type='button' id='order' value='Đặt hàng'/>
<input type='submit' name='update_car'  value='Cập nhập giỏ hàng'/>
<input type='button' id='continue' value='Tiếp tục mua hàng'/>
</form>
</fieldset>