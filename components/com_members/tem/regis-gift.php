<?php 
include_once(libs_path.'cls.products.php');
include_once(libs_path.'cls.simple_image.php');
$clsimage = new SimpleImage();
$obj=new CLS_PRODUCTS();
?>
<script language='javascript'>
function checkinput(){
	
	if($('#txt_email').val()==''){
		alert('Bạn phải nhập chính xác email của bạn!');$('#txt_pas').focus(); return false;
	}
	if($('#txt_name').val()==''){
		alert('Hãy nhập tên đầy đủ của bạn!'); $('#txt_name').focus();return false;
	}
	if($('#txt_phone').val()==''){
		alert('Bạn hãy nhập số điện thoại trước khi gửi!'); $('#txt_tel').focus();return false;
	}
	return true;
}
</script>
<form method='post' action='' autocomplete="off">
<h1 align='center' style='text-tranform:uppercase'>Đăng ký tham gia chương trình</h1>
<h2 align='center'>	"Trao yêu thương-Thay lời muốn nói" </h2>
<p align='center'>Nhân ngày lễ tình nhân VALENTINE. Muathu7 dành tặng 5 phần quà có ý nghĩa để bạn trao tặng cho người mình thương
yêu thay cho những lời thổ lộ tâm tình ngọt ngào nhất.<br/> Hãy đăng ký ngay để chở thành người may mắn nhất trong ngày trọng đại này! 
Thời gian đăng ký bắt đầu 26/01/2013 tới ngày 05/02/2013. Thời gian quay thưởng từ ngày 05/02/2013 tới ngày 06/02/2013</p>
<p align='left'>Các bạn vui lòng điền đúng và đủ thông tin. Dấu * là trường bắt buộc!</p>
<fieldset>
	<legend>Thông tin đăng ký</legend>
	<table width="100%">
		<tr><th align='right'>Họ và tên<span class='star'>*</span>:</th>
			<td><input type='text' name='txt_name' id='txt_name' /></td>
		</tr>
		<tr><th align='right'>Email<span class='star'>*</span>:</th>
			<td><input type='text' name='txt_email' id='txt_email' /> điền email chính xác vì quyền lợi của bạn</td>
		</tr>
		<tr><th align='right'>Phone<span class='star'>*</span>:</th>
			<td><input type='text' name='txt_phone' id='txt_phone' /></td>
		</tr>
		<tr>
			<th align='right'>Mã bảo mật<span class='star'>*</span>:</th>
			<td><input style='float:left;margin-right:5px;' type='text' name='txt_code' id='txt_code'/><img style='float:left;' height='21' src='http://muathu7.vn/extensions/captcha/CaptchaSecurityImages.php'/></td>
		</tr>
		<tr>
			<th align='right'>&nbsp;</th>
			<td>
				<input type='submit' name='cmd_register' id='cmd_register' value='Đăng ký' onclick='return checkinput();'/>
				<input type='reset' name='cmd_reset' id='cmd_reset' value='Làm lại'/>
			</td>
		</tr>
	</table>
</fieldset>
</form>

<fieldset>
	<legend>Danh sách các sản phẩm bạn có cơ hội được nhận</legend>
<div id='product-gift'>
	<div class='top4' style="clear:both;">
		<?php 
		$catids="'339','329','336','343'";
		$obj->GetListPro(" AND `cat_id` in ('$catids')",' ORDER BY RAND() ',' LIMIT 0,5 ');	?>
	</div>
</div>
</fieldset>

<fieldset>
	<legend>Các sản phẩm khác</legend>
<div id='product'>
	<?php 
	$catids="'301','329','336','343'";
	$obj->GetListPro(" AND `cat_id` in ('$catids')",' ORDER BY RAND() ',' LIMIT 0,12 ');	?>
</div>
</fieldset>
