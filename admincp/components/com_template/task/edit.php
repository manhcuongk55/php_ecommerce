<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="0";
	if(isset($_GET["id"]))
		$id=(int)$_GET["id"];
	$obj->getList(" WHERE `tem_id`='$id' ");
	$row=$obj->Fetch_Assoc();
?>
<div id="action">
 <script language="javascript">
 function checkinput(){
	 return true;
 }
 </script>
  <form id="frm_action" name="frm_action" method="post" action="">
  	<fieldset><legend><strong>Template infomation:</strong></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
		<tr>
			<td width="150" align="right" bgcolor="#EEEEEE"><strong><?php echo CNAME;?>:</strong></td>
			<td>
				<input type="text" name="txtname" id="txtname" value="<?php echo $row['name'];?>">
				<input type="hidden" name="txtid" id="txtid" value="<?php echo $row['tem_id'];?>"></td>
			<td align="right" bgcolor="#EEEEEE"><strong><?php echo CAUTHOR;?>:</strong></td>
			<td><input type="text" name="txtauthor" id="txtauthor" value="<?php echo $row['author'];?>"></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Email:</strong></td>
			<td><input type="text" name="txtemail" id="txtemail" value="<?php echo $row['author_email'];?>" /></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Website:</strong></td>
			<td><input type="text" name="txtwebsite" id="txtwebsite" value="<?php echo $row['author_site'];?>" /></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>isDefault:</strong></td>
			<td>
				<label><input name="optactive" type="radio" id="radio" value="1" <?php if($row['isdefault']==1) echo "checked";?>><?php echo CYES;?></label>
				<label><input name="optactive" type="radio" id="radio2" value="0" <?php if($row['isdefault']==0) echo "checked";?>><?php echo CNO;?></label>
			</td>
			<td align="right" bgcolor="#EEEEEE"><strong>&nbsp;</strong></td>
			<td><strong>&nbsp;</strong></td>
		</tr>
    </table>
    </fieldset>
    <fieldset><legend><strong><?php echo CDESC;?>:</strong></legend>
            <textarea name="txtdesc" id="txtdesc" cols="45" rows="5"><?php echo $row['desc'];?></textarea>
        	<script language="javascript">
				var oEdit1=new InnovaEditor("oEdit1");
				oEdit1.width="100%";
				oEdit1.height="300";
				oEdit1.cmdAssetManager ="modalDialogShow('<?php echo URLEDITOR;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
				oEdit1.REPLACE("txtdesc");
				document.getElementById("idContentoEdit1").style.height="225px";
			</script>
      <label>
        <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
      </label>
    </fieldset>
  </form>
</div>