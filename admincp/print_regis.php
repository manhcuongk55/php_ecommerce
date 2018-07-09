<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IN DANH SÁCH HỌC VIÊN ĐĂNG KÝ MỚI</title>

<div class="print">
	<a href="javascript:window.print()"><img src="../images/icons/icon-print.gif" border="1" align="middle"/>In trang này</a>
</div>
<?php
$strwhere='';
if(isset($_GET["str"]))
	$strwhere=$_GET["str"];
	
include_once("../includes/gfinnit.php");
include_once("libs/cls.data.php");
include_once("libs/cls.register.php");	
if(!isset($objregis)) $objregis=new CLS_REGISTER();
?>
<h3>DANH SÁCH HỌC VIÊN ĐĂNG KÝ MỚI</h3>
<table width="100%" border="0" cellspacing="1" cellpadding="5" style="border-top:1px solid #ccc; border-left:1px solid #ccc;">
  <tr class="header" bgcolor="#CCCCCC">
    <th width="30" align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">STT</th>
    <th align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">Họ tên</th>
    <th align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">Khóa học</th>
    <th align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">Ngày học</th>
    <th align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">Điện thoại</th>
    <th align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">Email</th>
    <th align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">Nơi học tập/<br />Công tác</th>
    <th align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">Thông tin thêm</th>
    <th align="center" style="border-bottom:1px solid #ccc; border-right:1px solid #ccc;">Ngày đký</th>
  </tr>
  <?php 
  $objregis->PrintRegis(stripslashes($strwhere));
  unset($objregis); unset($r);
  ?>
</table>