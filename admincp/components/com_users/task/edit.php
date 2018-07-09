<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
$id='';
if(isset($_GET['id']))
	$id=$_GET['id'];
	
if($UserLogin->isAdmin()==false &&  $id!=$_SESSION['IGFUSERID']){
	echo ('<div id="action" style="background-color:#fff"><h3 align="center">Bạn không có quyền truy cập. <a href="index.php">Vui lòng quay lại trang chính</a></h3></div>');
}
else {
	if(isset($_GET['personal']) && $_GET['personal']==true)
	$id=$_SESSION['IGFUSERID'];
	$obj->getList(' WHERE mem_id='.$id,'');
	$row=$obj->Fetch_Assoc();
?>
<script language='javascript'>
function checkinput(){
	 return true;
}
$(document).ready(function(){	
	$('#txtbirthday').datepicker({
		changeMonth: true,
		changeYear: true,
		yearRange: '1900:<?php echo date("Y");?>'
    });
});
 </script>
<div id="action">
  <form id="frm_action" name="frm_action" method="post" action="">
    <fieldset>
	<legend><strong>Thông tin tài khoản người dùng</strong></legend>
	<div>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc<div>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="172" align="right" bgcolor="#EEEEEE"><strong>Tên đăng nhập<font color="red"> *</font></strong></td>
        <td width="744">
          <input type="text" class="required" name="txtusername" id="txtusername" readonly="true" value="<?php echo $row['username'];?>"/>
          <span id="msgbox" style="display:none"></span>
          <input type="hidden" name="checkuser" id="checkuser" value="" />
         <input type="hidden" name="txtuser" value="<?php echo $row['username'];?>" id="txtuser" />  
        </td>
      </tr>
    </table>
    </fieldset>
    <fieldset>
	<legend><strong>Thông tin chi tiết người dùng</strong></legend>
      <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="171" align="right" bgcolor="#EEEEEE"><strong>Họ &amp; đệm<font color="red"> *</font></strong></td>
        <td width="236"><input type="text" name="txtfirstname" id="txtfirstname" value="<?php echo $row['firstname'];?>" class="required" />
          <input name="txtid" type="hidden" id="txtid" value="<?php echo $row['mem_id'];?>" />
		</td>
        <td width="156" align="right" bgcolor="#EEEEEE"><strong>Ngày sinh&nbsp;</strong></td>
        <td width="339"><input type="text" name="txtbirthday" id="txtbirthday" value="<?php echo date("d-m-Y",strtotime($row['birthday']));?>" /></td>
      </tr>
      <tr>
        <td width="171" align="right" bgcolor="#EEEEEE"><strong>Tên <font color="red">*</font></strong></td>
        <td><strong>
          <input type="text" name="txtlastname" id="txtlastname" value="<?php echo $row['lastname'];?>" class="required"/>
          </strong></td>
        <td width="156" align="right" bgcolor="#EEEEEE"><strong>Giới tính&nbsp;</strong></td>
        <td>
          <input type="radio" name="optgender" value="0" <?php if($row['gender']==0) echo ' checked="checked"';?> /> Nam
          <input type="radio" name="optgender" value="1" <?php if($row['gender']==1) echo ' checked="checked"';?>/> N&#7919;</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Địa chỉ&nbsp;</strong></td>
        <td><label>
          <input type="text" name="txtaddress" id="txtaddress" value="<?php echo $row['address'];?>" />
        </label></td>
        <td align="right" bgcolor="#EEEEEE"><strong>Điện thoại bàn &nbsp;</strong></td>
        <td><input type="text" name="txtphone" id="txtphone" value="<?php echo $row['phone'];?>" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Email&nbsp;</strong></td>
        <td><input type="text" name="txtemail" id="txtemail" value="<?php echo $row['email'];?>" class="required email"/></td>
        <td align="right" bgcolor="#EEEEEE"><strong>Điện thoại di động &nbsp;</strong></td>
        <td><input type="text" name="txtmobile" id="txtmobile" value="<?php echo $row['mobile'];?>" class="required"/></td>
      </tr>
      <?php
	  if($UserLogin->isAdmin()==true) {
	  ?>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Nhóm quyền <font color="red">*</font></strong></td>
        <td>
        <select name="cbo_gmember" id="cbo_gmember">
         <?php 
			  if(!isset($obju)) $obju = new CLS_GUSER();
			  $obju->getListGmem(0,1); 
			  unset($obju);
			  ?>
			  <script language="javascript">
			  cbo_Selected('cbo_gmember',<?php echo $row['gmem_id'];?>);
			  </script>
        </select>
        </td>
        <td align="right" bgcolor="#EEEEEE"><strong>Tình trạng người dùng</strong></td>
        <td><input name="optactive" type="radio" value="1" <?php if($row['isactive']==1) echo ' checked="checked"';?> /> Active
          <input name="optactive" type="radio" value="0" <?php if($row['isactive']==0) echo ' checked="checked"';?> /> Deactive</td>
      </tr>
      <?php } 
	  else {
	  ?>
      <input type="hidden" id="cbo_gmember" name="cbo_gmember" value="<?php echo $obj->Gmember;?>" />
      <input type="hidden" name="optactive" value="<?php echo $row['isactive'];?>" />
      <?php } ?>
    </table>
      <label>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
      </label>
    </fieldset>
  </form>
</div>
<?php } 
unset($obj);
?>