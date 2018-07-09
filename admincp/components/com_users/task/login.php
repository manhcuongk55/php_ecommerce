<?php
	defined('ISHOME') or die("Can't acess this page, please come back!");
	$err='';
	if(isset($_POST['submit']))
	{
		$user=addslashes($_POST['txtuser']);
		$pass=
		
		($_POST['txtpass']);
		$serc=addslashes($_POST['txt_sercurity']);
		if($_SESSION['SERCURITY_CODE']!=$serc)
			$err='<font color="red">Mã bảo mật không chính xác</font>';
		else{
			global $UserLogin;
			if($UserLogin->LOGIN($user,$pass)==true)
				echo '<script language="javascript">window.location="index.php"</script>';
			else
				$err='<font color="red">Đăng nhập không thành công.</font>';
		}
	}
?>
<form id="frm_login" name="frm_login" method="post" action="">
    <h3 class="header">ĐĂNG NHẬP </h3>
   <div id="loginlayou">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr><td>&nbsp;</td><td align="center"><?php echo $err;?></td></tr>
    <tr>
      <td align="right">Tên đăng nhập</td>
      <td width="50%"><input type="text" name="txtuser" id="txtuser" class="text" AUTOCOMPLETE="off"  /></td>
    </tr>
    <tr>
      <td align="right">Mật khẩu</td>
      <td><input type="password" name="txtpass" id="txtpass" class="text" AUTOCOMPLETE="off"/></td>
    </tr>
	<tr>
      <td align="right">Mã bảo mật</td>
      <td>
	  <input style="float:left;" type="text" size="7" name="txt_sercurity" id="txt_sercurity" class="text" AUTOCOMPLETE="off"/>
	  <img src="../extensions/captcha/CaptchaSecurityImages.php?width=75&height=24" align="left" alt="" />
	  </td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>
        <input type="submit" name="submit" id="submit" value="Đăng nhập" class="button">
        <input type="reset" name="reset" id="reset" value="Hủy bỏ" class="button">
        </td>
    </tr>
  </table>
  </div>
</form>