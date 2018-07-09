<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
?>

<div id="action">
 <script language="javascript">
 function checkinput(){
	 var name=document.getElementById("txtname");
	 if(name.value=="")
	 {
		 alert("Mời bạn nhập tên!");
		 name.focus();
		 return false;
	 }
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
 </script>
 <?php
 $id=0;
 if(isset($_GET["id"])) $id=$_GET["id"];
 if(!isset($objdoc)) $objdoc=new CLS_DOCUMENT();
 $objdoc->getCateByID($id);
 ?>
  <form id="frm_action" name="frm_action" method="post" action="" enctype="multipart/form-data">
 	<table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Tệp tin hiện tại:</strong></td>
        <td>
        <input name="txtcode" type="text" id="txtcode" value="<?php echo $objdoc->Code;?>" size="30" readonly="readonly">
        </td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Chọn tệp tin khác:</strong></td>
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
			  cbo_Selected('cbo_cate','<?php echo $objdoc->ParID;?>');
			  </script>
            </select>
		</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong>Tên hiển thị:</strong></td>
        <td>
          <input name="txtname" type="text" id="txtname" size="30" value="<?php echo $objdoc->Name;?>">
          <input name="txttaskfile" type="hidden" id="txttaskfile" value="1" />
          <input name="txtfolder" type="hidden" id="txtfolder" value="0" />
          <input name="txtid" type="hidden" id="txtid" value="<?php echo $id;?>" />
		</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPUBLIC;?>:</strong></td>
        <td><input name="optactive" type="radio" id="radio" value="1" <?php if($objdoc->isActive==1) echo " checked";?> />
          <?php echo CYES;?>
          <input name="optactive" type="radio" id="radio2" value="0" <?php if($objdoc->isActive==0) echo " checked";?> />
        <?php echo CNO;?></td>
      </tr>
      <tr>
        <td align="right" valign="top" bgcolor="#EEEEEE"><strong>Gán quyền Download:</strong></td>
        <td valign="top">
        <select name="cboguser" size="10" id="cboguser" onchange="javascript:getUserID();">
		<?php 
			  if(!isset($obju)) $obju = new CLS_GUSER();
			  $obju->getName(0,trim($objdoc->Assign),'');
			  unset($obju);
		?>
        </select>
        <input type="hidden" name="txtguser" id="txtguser" value="<?php echo $objdoc->Assign;?>" /></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top" bgcolor="#EEEEEE"><strong><?php echo CDESC;?>:</strong></td>
        <td>
            <textarea name="txtdesc" id="txtdesc" cols="45" rows="3"><?php echo $objdoc->Intro;?></textarea>
      </td>
      </tr>
    </table>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>
<?php unset($obju); unset($objCate); ?>
