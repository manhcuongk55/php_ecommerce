<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
?>
<div id="action">
 <script language="javascript">
 function checkinput(){
	 var name=document.getElementById("txtname");
	 if(name.value=="")
	 {
		 alert("Mời bạn nhập tên thư mục!");
		 name.focus();
		 return false;
	 }
	 return true;
 }
 </script>
 
  <?php 
  if(isset($_GET["err"]) && $_GET["err"]=="exist") 
  	echo '<h4 style="color:red"><img src="images/Icon_Warning_Red.png" width="30" align="middle">Tên thư mục này đã có. Vui lòng nhập tên thư mục khác.</h4>'; ?> 
  <form id="frm_action" name="frm_action" method="post" action="">
    <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
    <tr></tr>
    <tr>
      <td align="right" bgcolor="#EEEEEE"><strong>Tên thư mục thực:</strong></td>
      <td><input name="txtcode" type="text" id="txtcode" size="30" />
        <input name="txttask" type="hidden" id="txttask" value="1" />
        <input name="txtfolder" type="hidden" id="txtfolder" value="1" />
        <br /><span style="color:gray">(Tên thư mục không dấu, không chứa các ký tự đặc biệt)</span></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EEEEEE"><strong>Tên thư mục hiển thị trên Website:</strong></td>
      <td><input name="txtname" type="text" id="txtname" size="30" /> <br /><span style="color:gray">(Tên có thể viết Tiếng Việt)</span>  </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EEEEEE"><strong>Thuộc thư mục:</strong></td>
      <td><select name="cbo_cate" id="cbo_cate">
        <option value="0" selected="selected"><?php echo "Root";?></option>
        <?php
                if(!isset($objCate))
                $objCate=new CLS_DOCUMENT();
                $objCate->getListDoc(0,1);
               ?>
        <script language="javascript">
			  cbo_Selected('cbo_cate','<?php echo $objcate->ParID;?>');
			  </script>
      </select></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPUBLIC;?>:</strong></td>
      <td><input name="optactive" type="radio" id="radio" value="1" checked />
        <?php echo CYES;?>
        <input name="optactive" type="radio" id="radio2" value="0" />
        <?php echo CNO;?></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#EEEEEE"><strong><?php echo CDESC;?>:</strong></td>
      <td><textarea name="txtdesc" id="txtdesc" cols="45" rows="3">&nbsp;</textarea></td>
    </tr>
    </table>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>