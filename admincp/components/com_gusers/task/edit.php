<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=$_GET["id"];
	$obj->getList(" WHERE `gmem_id`='$id' ",' LIMIT 0,1');
	$row=$obj->Fetch_Assoc();
?>
<div id="action">
<script language="javascript">
function checkinput(){
	if($("#txtname").val()==""){
	 	$("#txtname_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập tên').fadeTo(900,1);
		});
	 	$("#txtname").focus();
	 	return false;
	}
	return true;
}
$(document).ready(function(){
	$("#txtname").blur(function() {
		if( $(this).val()=='') {
			$("#txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Vui lòng nhập tên').fadeTo(900,1);
			});
		}
		else {
			$("#txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('').fadeTo(900,1);
			});
		}
	})
})
</script>
  <form id="frm_action" name="frm_action" method="post" action="">
	<p>Các mục đánh dấu <font color="red">*</font> là thông tin bắt buộc</p>
    <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td width="150" align="right" bgcolor="#EEE"><strong><?php echo CNAME;?> <font color="red">*</font></strong></td>
        <td>
          <input name="txtname" type="text" id="txtname" value="<?php echo $row['name'];?>" size="30">
          <label id="txtname_err" class="check_error"></label>
	      <input type="hidden" name="txtid" id="txtid" value="<?php echo $row['gmem_id'];?>"></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEE"><strong><?php echo "ParID";?>:</strong></td>
        <td>
            <select name="cbo_parid" id="cbo_parid">
              <option value="0" selected="selected" style="font-weight:bold"><?php echo "Root";?></option>
              <?php 
			  if(!isset($obju)) $obju = new CLS_GUSER();
			  $obju->getListGmem(0,1); 
			  unset($obju);
			  ?>
			  <script language="javascript">
			  cbo_Selected('cbo_parid',<?php echo $row['par_id'];?>);
			  </script>
            </select>
		</td>
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEE"><strong><?php echo CPUBLIC;?>:</strong></td>
        <td>
        <input name="optactive" type="radio" id="radio" value="1" <?php if($row['isactive']==1) echo "checked";?>>
			<?php echo CYES;?>
        <input name="optactive" type="radio" id="radio2" value="0" <?php if($row['isactive']==0) echo "checked";?>>
			<?php echo CNO;?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEE"><strong><?php echo CDESC;?>:</strong></td>
        <td><textarea name="txtdesc" cols="50" rows="3" id="txtdesc"><?php echo $row['intro'];?></textarea></td>
      </tr>
    </table>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>
<?php unset($obj); unset($row); ?>