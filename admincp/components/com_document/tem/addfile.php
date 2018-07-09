<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
?>

<div id="action">
 <script language="javascript">
 function checkinput(){
	 var name		= document.getElementById("txtname");
	 var opt 		= document.getElementsByName("opt");
	 var linkweb	= document.getElementById("txtlinkweb");
	 var urlfile	= document.getElementById("txturlfile");
	 
	 if(name.value=="")
	 {
		 alert("Mời bạn nhập tên!");
		 name.focus();
		 return false;
	 }
	 /*if(opt.value==1 && linkweb.value=='') {
		 alert("Mời bạn nhập đường dẫn từ Website khác");
		 linkweb.focus();
		 return false;
	 }
	 if(opt.value==2 && urlfile.value=='') {
		 alert("Mời bạn chọn 1 tệp tin từ máy tính");
		 linkweb.focus();
		 return false;
	 }*/
	 //getUserID();
	 return true;
 }
 function getUserID() {
	 //var ids = document.getElementById("txtguser");
	 var cbo = document.getElementById("cboguser");
	 var str='';
	 for(var i=0;i<cbo.length;i++){
		 
	 	if(cbo[i].selected==true) {
			//alert(cbo[i].value);
			str = str+cbo[i].value+',';
		}
	 }
	document.getElementById("txtguser").value=str;
 }
 
 function enableContent(n) {
	 if(n==1) {
	 	document.getElementById("txturlfile").disabled=true;
		document.getElementById("txtlinkweb").disabled=false;
		document.getElementById("txtlinkweb").focus();
	 }
	 else
	 {
		document.getElementById("txturlfile").disabled=false;
		document.getElementById("txtlinkweb").disabled=true;
		document.getElementById("txturlfile").focus();
	 }
 }
 </script>
 
 <?php 
 if(isset($_GET["err"]) && $_GET["err"]=="exist") 
	echo '<h4 style="color:red"><img src="images/Icon_Warning_Red.png" width="30" align="middle">Tên thư mục này đã có. Vui lòng nhập tên thư mục khác.</h4>'; ?> 
  <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
 	<table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Đường dẫn từ Website khác: 
            <input type="radio" name="opt" id="radio3" value="1" onclick="javascript:enableContent(1)"/>
        </strong></td>
        <td><input name="txtlinkweb" type="text" id="txtlinkweb" size="30" disabled=""/></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Chọn tệp tin từ máy tính: 
          
          <input name="opt" type="radio" id="radio4" onclick="javascript:enableContent(2)" value="2" checked="checked"/>
        </strong></td>
        <td>
        <input type="file" id="txturlfile" name="txturlfile">
       <input type="button" value="Bắt đầu tải lên" onclick="">  

       
        </td>
      </tr>

      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Tải lên thư mục:</strong></td>
        <td>
            <select name="cbo_cate" id="cbo_cate">
              <option value="0" selected="selected"><?php echo "Root";?></option>
               <?php
                if(!isset($objCate))
                $objCate=new CLS_DOCUMENT();
                $objCate->getListDoc(0,1);
               ?>
              <script language="javascript">
			  cbo_Selected('cbo_cate','');
			  </script>
            </select>
		</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Tên hiển thị:</strong></td>
        <td>
          <input name="txtname" type="text" id="txtname" size="30">
          <input name="txttaskfile" type="hidden" id="txttaskfile" value="1" />
          <input name="txtfolder" type="hidden" id="txtfolder" value="0" />
		</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPUBLIC;?>:</strong></td>
        <td><input name="optactive" type="radio" id="radio" value="1" checked />
          <?php echo CYES;?>
          <input name="optactive" type="radio" id="radio2" value="0" />
        <?php echo CNO;?></td>
      </tr>
      <tr>
        <td align="right" valign="top" bgcolor="#EEEEEE"><strong>Gán quyền Download:</strong></td>
        <td valign="top">
        <select name="cboguser" size="10" id="cboguser" onchange="javascript:getUserID();">
		<?php 
			  if(!isset($obju)) $obju = new CLS_GUSER();
			  $obju->getName(0,trim($obj->Gmember),'');
			  unset($obju);
		?>
        </select>
        <input type="hidden" name="txtguser" id="txtguser" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top" bgcolor="#EEEEEE"><strong><?php echo CDESC;?>:</strong></td>
        <td>
            <textarea name="txtdesc" id="txtdesc" cols="45" rows="3">&nbsp;</textarea>
      </td>
      </tr>
    </table>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>
<?php unset($obju); unset($objCate); ?>
