<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=(int)$_GET["id"];
	$obj->getList(' WHERE `id`='.$id);
	$row = $obj->Fetch_Assoc();

	if ($row['config'] != null || $row['config'] != '')
		$aryCf = split('!@', $row['config']);
	else
		$aryCf = array();

?>
<h1 align='center'>CÔNG TY TNHH TÂN VƯƠNG</h2>
<div id='info' style='text-align:center;'>
Trụ sở: 199 Minh Khai - Q.Hai Bà Trưng - TP.Hà Nội 
.<br/>
Tel: 8 3729 3936 - 08 3729 3424 - Fax: 08.3729 4937<br/>
Email: kinhdoanhtanvuong6@gmail.com - Website:http://tanvuong.com.vn <br/>
</div>
<div style='text-align:left; height:60px; line-height:60px;'><strong>Hóa đơn số</strong>: HD<?php echo $row['id'];?>.../ <strong>Ngày:</strong> <?php echo date('d/m/Y', strtotime($row['cdate']));?>...</div>
<strong>Trạng thái đơn hàng:</strong> 
<?php if($row['status']==0){?>
<span style='color:red;'>Đang chờ xác nhận</span><br/>
<?php }else if($row['status']==1){?>
<span style='color:red;'>Đang sử lý</span><br/>
<?php }else if($row['status']==2){
	echo "<span style='color:red;'>Đã finish</span><br/>";
}else{
	echo "<span style='color:red;'>Đã hủy</span><br/>";
}?>
<fieldset>
   <legend><strong>Thông tin khách hàng</strong></legend>
   <table width="100%" border="0" cellspacing="1" cellpadding="3">
		<tr>
			<td width="200" align="right" bgcolor="#EEEEEE"><strong>Họ Và Tên:</strong></td>
			<td><?php echo $row['cname'];?></td>
		</tr>
		<tr>
			<td width="200" align="right" bgcolor="#EEEEEE"><strong>Số điện thoại:</strong></td>
			<td><?php echo $row['cphone'];?></td>
		</tr>
		<tr>
			<td width="200" align="right" bgcolor="#EEEEEE"><strong>Địa chỉ giao hàng:</strong></td>
			<td><?php echo $row['add'];?></td>
		</tr>
	</table>
</fieldset>
<fieldset>
   <legend><strong>Thông tin sản phẩm</strong></legend>
   <table width='100%' class='tbl_list list'>
	<tr>
		<th>STT</th>
		<th>Mã SP</th>
		<th>Tên sản phẩm</th>
		<th>Số lượng</th>
		<th>Thông tin cấu hình máy</th>
		<th>Ghi chú</th>
	</tr>
	<?php
		$objpro = new CLS_PRODUCTS;	
		$objpro->getList(' WHERE `pro_id`='.$row['pro_id']);
		$row_pro=$objpro->Fetch_Assoc();
	?>
	<tr>
		<td align='center'><?php echo "1";;?></td>
		<td><a href="<?php echo ROOTHOST ?><?php echo un_unicode($row_pro['code']);?>/<?php echo un_unicode($row_pro['name']);?>-sp<?php echo $row['pro_id'];?>.html" target="_blank"><?php echo $row_pro['code'];?></a></td>
		<td align='center'><a href="<?php echo ROOTHOST ?><?php echo un_unicode($row_pro['code']);?>/<?php echo un_unicode($row_pro['name']);?>-sp<?php echo $row['pro_id'];?>.html" target="_blank"><?php echo $row_pro['name'];?></a></td>
		<td align='center'>1</td>
		<td>
			<?php
				for ($i=0; $i < count($aryCf); $i++) {  ?>
					<ol>
						<?php echo "<li>".$aryCf[$i]."</li>"; ?>
					</ol>
				<?php }
			?>
		</td>
		<td align='center'><?php echo $row['note'];?>&nbsp;</td>
	</tr>
</table>
</fieldset> 
<div class='fun'>
	<a href='index.php?com=orders&task=toprocess&id=<?php echo $id;?>'>Xác nhận</a> | 
	<a href='index.php?com=orders&task=tofinished&id=<?php echo $id;?>'>Hoàn thành</a> | 
	<a href='index.php?com=orders&task=tocancel&id=<?php echo $id;?>'>Hủy đơn hàng</a> | 
	<a href='javascript:window.history.go(-1);'>Trở lại</a>
</div>