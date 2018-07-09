<?php 
if(!isset($_SESSION['CART']) || count($_SESSION['CART'])<=0){
	echo "Bạn chưa đặt hàng! Hãy trở lại gian hàng và chọn mua sản phẩm!";
}else{
if(!isset($_POST['cmd_order'])){?>
<div class='mess'>
</div>
<style>
    fieldset{background: #fff;}
    fieldset legend{font-weight: bold;}
</style>
<fieldset><legend>Danh sách sản phẩm trong giỏ hàng</legend>
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
		<td align='center'><?php echo $_SESSION['CART'][$i]['QUA'];?></td>
		<td align='center'><?php echo number_format($price);?> <strong>đ</strong></td>
		<td align='center'><?php echo number_format($amount);?> <strong>đ</strong></td>
		<td align='center'><?php echo $_SESSION['CART'][$i]['NOTE'];?></td>
		<td align='center'><a href='<?php echo ROOTHOST.'del-cart-sp'.$_SESSION['CART'][$i]['ID'];?>.html'>Xóa</a></td>
	</tr>
	<?php }?>
	<tr>
		<td colspan='4' align='right'><strong>Tổng thành tiền</strong></td>
		<td colspan='3'><?php echo number_format($total);?> <strong>đ</strong></td>
	</tr>
</table>
</fieldset>
<?php
}
if(isset($_POST['cmd_confirm'])){
	if($_POST['sercury_code']!=$_SESSION['SERCURITY_CODE']){
		$_SESION['ERROR']='Mã xác nhận không đúng, mời bạn thử lại';
		?>
		<script language='javascript'>window.history.go(-1);</script>
		<?php
	}else{
		$_SESION['ERROR']='';
		if(isset($_SESSION['ORDER'])){
			unset($_SESSION['ORDER']);
		}
		$_SESSION['ORDER']['NAME']=$_POST['txt_name'];
		$_SESSION['ORDER']['PHONE']=$_POST['txt_tel'];
		$_SESSION['ORDER']['EMAIL']=$_POST['txt_email'];
		$_SESSION['ORDER']['SHIP']=$_POST['opt_ship'];
		$_SESSION['ORDER']['ADD']=$_POST['txt_address'];
		$_SESSION['ORDER']['PAYMENT']=$_POST['opt_payment'];
		?>
		<form method='POST' action=''>
		<fieldset>
			<legend>Thông tin khách hàng</legend>
			<table width="100%">
				<tr>
					<th align='right' width=150>Họ Và Tên<span class='star'>*</span>:</th>
					<td><?php echo $_SESSION['ORDER']['NAME'];?></td>
				</tr>
				<tr>
					<th align='right'>Số Điện Thoại<span class='star'>*</span>:</th>
					<td><?php echo $_SESSION['ORDER']['PHONE'];?></td>
				</tr>
				<tr>
					<th align='right'>Hòm thư:</th>
					<td><?php echo $_SESSION['ORDER']['EMAIL'];?></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
			<legend>Hình thức nhận hàng</legend>
			<h4><?php echo $_SESSION['ORDER']['SHIP'];?></h4>
			<?php if($_SESSION['ORDER']['SHIP']=='Giao hàng tận nơi'){
				echo '<strong>Địa chỉ nhận hàng:</strong> '.$_SESSION['ORDER']['ADD'];
			}?>
		</fieldset>
		<fieldset>
			<legend>Hình thức thanh toán</legend>
			<h4><?php //echo $_SESSION['ORDER']['PAYMENT'];?></h4>
		</fieldset>
		<input type='submit' name='cmd_order' id='cmd_order' value='Giửi đơn hàng'/>
		<input type='button' name='cmd_back' id='cmd_back' value='Trở lại' onclick="window.history.go(-1);"/>
		<br/>
		</form>
<?php
	}
}else if(isset($_POST['cmd_order']) && isset($_SESSION['CART']) && isset($_SESSION['ORDER'])){
	include_once('libs/cls.orders.php');
	$obj=new CLS_ORDER;
	$obj->Cdate=date('Y-m-d h:i:s');
	$obj->Cname=$_SESSION['ORDER']['NAME'];
	$obj->Cphone=$_SESSION['ORDER']['PHONE'];
	$obj->Cemail=$_SESSION['ORDER']['EMAIL'];
	$obj->ShipType=$_SESSION['ORDER']['SHIP'];
	$obj->Add=$_SESSION['ORDER']['ADD'];
	$obj->Payment=$_SESSION['ORDER']['PAYMENT'];
	$obj->SalerCode='';
	$total=0;
	$objpro=new CLS_PRODUCTS;
	$n=count($_SESSION['CART']);
	for($i=0;$i<$n;$i++){
		$price=$objpro->getPriceById($_SESSION['CART'][$i]['ID']);
		$total+=$_SESSION['CART'][$i]['QUA']*$price;
	}
	$obj->TotalMoney=$total;
	$obj->Add_new();
	unset($_SESSION['CART']); unset($_SESSION['ORDER']);
	?>
	<div class='info_order'>
	<h3 align='center'>Bạn đã gửi đơn hàng thành công! Chúng tôi sẽ xác nhận lại thông tin đặt hàng sớm nhất!</h3>
	<h1 align='center'>Chúc bạn có một ngày thật nhiều niềm vui!</h1>
	<h4>Bạn muốn tiếp tục ngắm đồ ? <a style='color:red;' href='<?php echo ROOTHOST;?>'>Click here!</a></h4>
	</div>
	<?php
}else{
?>
	<script language="">
	$(document).ready(function(){
		$('#opt_ship1').click(function(){$('#address').show();});
		$('#opt_ship2').click(function(){$('#address').hide();});
	});
	function checkinput_order(){
		var error=false;
		if($('#txt_name').val()==''){
			error=true;
			$('#txt_name').css({'border':'1px solid #f00;'});
		}
		if($('#txt_tel').val()==''){
			error=true;
			$('#txt_tel').css({'border':'1px solid #f00;'});
		}
		if($('#sercury_code').val()==''){
			error=true;
			$('#sercury_code').css({'border':'1px solid #f00;'});
		}
		if(error){
			$('#error').show();
			$('#error').html('Có những trường yêu cầu chưa được điền, bạn hãy điền đầy đủ trước khi đặt hàng');
			return false;
		}
		return true;
	}
	</script>
	<form method='POST' action=''>
	<span class='star' style='display:block;' id='error'><?php if(isset($_SESION['ERROR'])){echo $_SESION['ERROR'];}?></span>
	<fieldset>
		<legend>Thông tin khách hàng</legend>
		<table width="100%">
			<tr>
				<td align='right'>Họ Và Tên<span class='star'>*</span>:</td>
				<td><input type='text' style='float:left;margin-right:5px;' name='txt_name' id='txt_name'/></td>
			</tr>
			<tr>
				<td align='right'>Số Điện Thoại<span class='star'>*</span>:</td>
				<td><input type='text' style='float:left;margin-right:5px;'name='txt_tel' id='txt_tel'/></td>
			</tr>
            
			<tr>
				<td align='right'>Hòm thư:</td>
				<td><input style='float:left;margin-right:5px;' type='text' name='txt_email' id='txt_email'/></td>
			</tr>
			<tr>
				<td align='right'>Mã bảo mật <span class='star'>*</span>:</td>
				<td><input type='text' name='sercury_code' id="sercury_code" style="float:left;margin-right:5px;" /> <img style="float:left;margin-right:5px;" height='21' src='<?php echo ROOTHOST;?>/extensions/captcha/CaptchaSecurityImages.php' alt='sercury code muathu7.vn' /></td>
			</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Hình thức nhận hàng</legend>
		<h4 style="float: left;">1. <label><input type='radio' name='opt_ship' style="float: left;" id='opt_ship1' value='Giao hàng tận nơi'/>Giao hàng tận nơi</label></h4>
		<table width="100%" id="address" style="display:none;">
			<tr>
				<td>Nhập đầy đủ địa chỉ giao hàng<span class='star'>*</span>:<br/>
				<textarea rows='3' style='width:100%' name='txt_address' id='txt_address'></textarea></td>
			</tr>
		</table>
		<h4 style=" float: left;">2. <label><input type='radio' checked='true' name='opt_ship' id='opt_ship2' value='Nhận hàng tận văn phòng của muathu7.vn'/>Nhận hàng tận văn phòng của chúng tôi !</label></h4>
	</fieldset>
	<fieldset>
		<legend>Hình thức thanh toán</legend>
		<table width="100%">
			<tr>
				<td style="float: left;"><label><input type='radio' checked='true'  name='opt_payment' id='opt_payment' value='Giao hàng và thu tiền tận nơi'/> Giao hàng và thu tiền tại nơi!</label></td>
			</tr>
			<tr>
				<td style="float: left;">
				<label><input type='radio' name='opt_payment' id='opt_payment' value='Chuyển khoản'/> Chuyển khoản (Quý khách vui lòng điền mã đơn hàng để  kiểm tra nhanh hơn)</label>
				<?php //$this->LoadModule('user3');?>	
				</td>
			</tr>
		</table>
	</fieldset>
	<input type='submit' name='cmd_confirm' id='cmd_confirm' value='Xác nhận đơn hàng' onclick="return checkinput_order();"/>
	<input type='reset' name='cmd_reset' id='cmd_reset' value='Làm lại'/>
	<input type='button' name='cmd_back' id='cmd_back' value='Trở lại' onclick="window.history.go(-1);"/>
	<br/>
	</form>
<?php }
}// end if first
?>