<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=(int)$_GET["id"];
	$obj->getList(' WHERE `pro_id`='.$id);
	$row=$obj->Fetch_Assoc();
?>
<div id="action">
 <script language="javascript">
 function checkinput(){
	if($("#txttitle").val()==""){
	 	$("#txttitle_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập tên bài viết').fadeTo(900,1);
		});
	 	$("#txttitle").focus();
	 	return false;
	}
	if($("#txtcode").val()==""){
	 	$("#txtcode_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập mã cho bài viết').fadeTo(900,1);
		});
	 	$("#txtcode").focus();
	 	return false;
	}
	return true;
 }
$(function() {
	$( "#date1" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
$(function() {
	$( "#date2" ).datepicker({ dateFormat: 'dd-mm-yy' });
});

function deleteConfig (obj) {
	var self = $(obj);
	self.parent().remove();
}

$(document).ready(function() {
	$("#txttitle").blur(function(){
		if ($("#txttitle").val()=="") {
			$("#txttitle_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Vui lòng nhập tên bài viết').fadeTo(900,1);
			});
		}
	});
	$("#txtcode").blur(function(){
		if ($("#txtcode").val()=="") {
			$("#txtcode_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Vui lòng nhập mã bài viết').fadeTo(900,1);
			});
		}
	});

	$("#add_config").click(function(){
		var val_config = $("#cf_content").val();
		var html = "<div style='clear:both'><input type='text' name='array_cf[]' value='"+val_config+"' class='item_config'/><a href='#' class='del_config' onclick='deleteConfig(this);' >Xóa</a></div>";
		$("#list_config").append(html);
		$("#cf_content").val('');
		$("#cf_content").focus();
	})

	
});
 </script>
  <form id="frm_action" name="frm_action" method="post" action="">
  Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
  <fieldset>
   <legend><strong><?php echo CDETAIL;?>&nbsp;</strong></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
		<tr>
			<td width="127" align="right" bgcolor="#EEEEEE"><strong><?php echo CCATEGORY;?><font color="red">*</font></strong></td>
			<td>
			  <select name="cbo_cate" id="cbo_cate">
				<?php 
				  if(!isset($objcata)) $objcata=new CLS_CATALOGS();
					echo $objcata->getListCate("option");
				?>
				<script language="javascript">
				  cbo_Selected('cbo_cate',<?php echo $row['cat_id'];?>);
				</script>
			  </select></td>
			<td width='127' align="right" bgcolor="#EEEEEE"><strong>Ngày Tạo</strong></td>
			<td><input id = "date1" type="text" name="txtcreadate" value="<?php echo date('d-m-Y',strtotime($row['cdate']));?>"/></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Tên Sản phẩm<font color="red">*</font></strong></td>
			<td><input type="text" name="txttitle" id="txttitle" value='<?php echo stripslashes($row['name']);?>' size="35" />
				<label id="txttitle_err" class="check_error"></label>
				<input name="txtid" type="hidden" id="txtid" value="<?php echo $row['pro_id'];?>" />
			</td>
			<td align="right" bgcolor="#EEEEEE"><strong>Ngày cập nhập</strong></td>
			<td><input type="text" id = "date2" name="txtmodify" value="<?php echo date('d-m-Y',strtotime($row['mdate']));?>"/></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Mã sản phẩm<font color="red">*</font></strong></td>
			<td><input name="txtcode" type="text" id="txtcode" size="35" value='<?php echo stripslashes($row['code']);?>' />
			<label id="txtcode_err" class="check_error"></label></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Order</strong></td>
			<td><input name="txt_order" type="text" value='0' value='<?php echo $row['order'];?>'/></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Giá cũ</strong></td>
			<td><input name="txt_oldprice" type="text" value='<?php echo $row['old_price'];?>' />VNĐ</td>
			<td align="right" bgcolor="#EEEEEE"><strong>Ảnh  </strong></td>
			<td><input size="35" name="txtthumb" value="<?php echo stripslashes($row['thumb']);?>" type="text"><a href="#" onclick="OpenPopup('extensions/upload_image.php');">Chọn</a></td>
			
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Giá hiện tại</strong></td>
			<td><input name="txt_curprice" type="text" value='<?php echo $row['cur_price'];?>'/>VNĐ</td>
			<td align="right" bgcolor="#EEEEEE"><strong>isHot&nbsp;</strong></td>
			<td><input name="opt_hot" type="radio" id="radio" value="1" <?php if($row['ishot']==1) echo 'checked';?> />
			  <?php echo CYES;?>
			  <input name="opt_hot" type="radio" id="radio2" value="0" <?php if($row['ishot']==0) echo 'checked';?> />
			  <?php echo CNO;?></td>
        </tr>
	   <tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Số lượng:</strong></td>
			<td><input name="txt_quantity" type="text" value='<?php echo $row['quantity'];?>'/></td>
			<td align="right" bgcolor="#EEEEEE"><strong>isActive</strong></td>
			<td><input name="optactive" type="radio" value="1" <?php if($row['isactive']==1) echo 'checked';?> />
			<?php echo CYES;?>
			<input name="optactive" type="radio" value="0" <?php if($row['isactive']==0) echo 'checked';?>/>
			<?php echo CNO;?></td>
       </tr>
	   <tr>
         <td colspan="4" align="left"><hr size="1" color="#EEEEEE" width="100%" /></td>
        </tr>
       <tr>
         <td align="right" bgcolor="#EEEEEE"><strong><?php echo CMETAKEY;?>&nbsp;</strong></td>
         <td><textarea name="txtmetakey" cols="35" rows="3" id="txtmetakey"><?php echo stripslashes($row['meta_key']);?></textarea></td>
         <td align="right" bgcolor="#EEEEEE"><strong><?php echo CMETADESC;?></strong></td>
         <td><textarea name="textmetadesc" cols="35" rows="3" id="textmetadesc"><?php echo stripslashes($row['meta_desc']);?></textarea></td>
       </tr>
      </table>
      </fieldset>
    
	<br style="clear:both" />

    <div id="config_product">
    	<h3>Cấu hình sản phẩm</h3>
    	<div>
    		<input type="text" name="cf_content" id="cf_content" /> 
    		<a href="#" id="add_config">Add</a>
    	</div>
    	<div id="list_config">
    		<?php
    			if (!is_null($row['config'])) {
    				$json_config = json_decode($row['config'], JSON_UNESCAPED_UNICODE);	
	    			for ($i=0; $i < count($json_config); $i++) { 
					?>
						<div style='clear:both'><input type='text' name='array_cf[]' value="<?php echo $json_config[$i]; ?>" class='item_config'/><a href='#' class='del_config' onclick='deleteConfig(this);' >Xóa</a></div>
					<?php
					}
    			}    			
    		?>
    	</div>
    </div> 
	<br style="clear:both" />

    <strong><?php echo CINTRO.' tính năng';?></strong>
    <textarea name="txtintro" id="txtintro" cols="45" rows="5"><?php echo stripslashes($row['intro']);?></textarea>
     <script language="javascript">
            var oEdit2=new InnovaEditor("oEdit2");
            oEdit2.width="100%";
            oEdit2.height="100";
            oEdit2.cmdAssetManager ="modalDialogShow('<?php echo URLEDITOR;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
            oEdit2.REPLACE("txtintro");
			document.getElementById("idContentoEdit2").style.height="100px";
      </script>
    <br style="clear:both" />
    <strong><?php echo 'Thông số kĩ thuật';?>&nbsp;</strong></legend>
    <textarea name="txtfulltext" id="txtfulltext" cols="45" rows="5"><?php echo stripslashes($row['fulltext']);?></textarea>
    <script language="javascript">
            var oEdit1=new InnovaEditor("oEdit1");
            oEdit1.width="100%";
            oEdit1.height="300";
            oEdit1.cmdAssetManager ="modalDialogShow('<?php echo URLEDITOR;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
            oEdit1.REPLACE("txtfulltext");
            document.getElementById("idContentoEdit1").style.height="225px";
        </script>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>