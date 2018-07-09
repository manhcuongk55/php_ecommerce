
 <script language="javascript">
 function checkinput(){
	if($("#txtusername").val()=="")
	{
		//alert("cgfdh");
	 	$("#txtusername_err").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Vui lòng nhập họ tên bạn').fadeTo(900,1);
		});
	 	$("#txtusername").focus();
	 	return false;
	}
	return true;
 }
$(document).ready(function() {
	$("#txtusername").blur(function(){
		if ($("#txtusername").val()=="") {
			$("#txtusername_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng nhập họ tên bạn').fadeTo(900,1);
			});
		}
	});	
});

</script>

  <form id="frm_action" name="frm_action" method="post" action=""  enctype="multipart/form-data" class="mod-pro mod-support box-module">
   <h2 class="header">Cảm nhận của học viên</h2>
   <div id="loginlayou" class="content box-module">
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="160" align="right"><strong>Họ tên</strong></td>
        <td width="788">
          <input name="txtusername" type="text" id="txtusername" size="30" class="required" minlength="3"/>
          <label id="txtusername_err" class="check_error"></label>
          <input name="txttask" type="hidden" id="txttask" value="1" />
          </td>
      </tr>
       <tr>
        <td align="right"><strong><?php echo 'Hình ảnh';?>&nbsp;</strong></td>
         <td>
            <?php
            if($_SESSION["NAME_FILEIMG"]!="")
            {
            ?>
            <?php } ?>
            <input type="file" name="hocvien" id="hocvien" value="<?php echo $_SESSION["NAME_FILEIMG"]; ?>" />
          </td>
      </tr>
      <tr>
     	<td> <legend><strong><?php echo "Cảm nhận";?>:</strong></legend></td>
       <td> <textarea name="txtdesc" id="txtdesc" cols="45" rows="5">&nbsp;</textarea>
            <script language="javascript">
                var oEdit1=new InnovaEditor("oEdit1");
                oEdit1.width="100%";
                oEdit1.height="300";
                oEdit1.cmdAssetManager ="modalDialogShow('<?php echo URLEDITOR;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
                oEdit1.REPLACE("txtdesc");
                document.getElementById("idContentoEdit1").style.height="225px";
            </script> 
          </td>
      </tr>
    </table>
     <input type="submit" onclick="return checkinput();" name="cmdsave" id="cmdsave" value="Gửi cảm nhận">
    </div>
  </form>