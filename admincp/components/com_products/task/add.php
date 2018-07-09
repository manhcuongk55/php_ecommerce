<?php
	defined("ISHOME") or die("Can't acess this page, please come back!")
?>
<div id="action">
<script language="javascript">
function checkinput(){
	if($("#txttitle").val()==""){
	 	$("#txttitle_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập tên sản phẩm').fadeTo(900,1);
		});
	 	$("#txttitle").focus();
	 	return false;
	}
	if($("#txtcode").val()=="")
	{
	 	$("#txtcode_err").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Vui lòng nhập mã cho sản phẩm').fadeTo(900,1);
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

var abc = 0;	 
$(document).ready(function() {
	$('.isshow_360').hide();
	$(".optShow").change(function(){
		var val = $(this).val();
		if (val == 0) {
			$('.isshow_360').show();
			$('.isshow_slide').hide();
		} else {
			$('.isshow_360').hide();
			$('.isshow_slide').show();
		}
	})

	$(".optConfigPro").change(function(){
		var val = $(this).val();
		if (val == 1) {
			$('#config_product').show();
		} else {
			$('#config_product').hide();
		}
	})

	$("#txttitle").blur(function(){
		if ($("#txttitle").val()=="") {
			$("#txttitle_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng nhập tên bài viết').fadeTo(900,1);
			});
		}
	});

	$("#txtcode").blur(function(){
		if ($("#txtcode").val()=="") {
			$("#txtcode_err").fadeTo(200,0.1,function()
			{ 
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
	});	

	// UPLOAD MULTI IMAGES
	$('#add_more').click(function() {
		$(this).before($("<div/>", {
			id: 'filediv'
		}).fadeIn('slow').append($("<input/>", {
			name: 'file[]',
			type: 'file',
			id: 'file'
		}), $("<br/><br/>")));
	});
	// Following function will executes on change event of file input to select different file.
	$('body').on('change', '#file', function() {
		if (this.files && this.files[0]) {
			abc += 1; // Incrementing global variable by 1.
			var z = abc - 1;
			var x = $(this).parent().find('#previewimg' + z).remove();
			$(this).before("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
			$(this).hide();
			$("#abcd" + abc).append($("<img/>", {
				id: 'img',
				src: 'http://tanvuong.com.vn/demo/images/x.png',
				alt: 'delete'
			}).click(function() {
				$(this).parent().parent().remove();
			}));
		}
	});
	// To Preview Image
	function imageIsLoaded(e) {
		$('#previewimg' + abc).attr('src', e.target.result);
	};
	$('#upload').click(function(e) {
		var name = $(":file").val();
		if (!name) {
			alert("First Image Must Be Selected");
			e.preventDefault();
		}
	});
	
});

</script>

  <form id="frm_action" enctype="multipart/form-data" name="frm_action" method="post" action="">
  Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
  <fieldset>
   <legend><strong><?php echo CDETAIL;?>&nbsp;</strong></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
      <tr>
        <td width="126" align="right" bgcolor="#EEEEEE"><strong>Nhóm sản phẩm<font color="red">*</font></strong></td>
        <td>
          <select name="cbo_cate" id="cbo_cate">
            <?php 
			  if(!isset($objcata)) $objcata=new CLS_CATALOGS();
			  	echo $objcata->getListCate("option");
			?>
          </select></td>
		<td width='126' align="right" bgcolor="#EEEEEE"><strong>Ngày Tạo</strong></td>
        <td><input id = "date1" type="text" name="txtcreadate" value="<?php echo date("d-m-Y");?>"/></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Tên Sản phẩm<font color="red">*</font></strong></td>
			<td>
			  <input name="txttitle" type="text" id="txttitle" size="35" />
			  <label id="txttitle_err" class="check_error"></label></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Ngày cập nhập</strong></td>
			<td><input id = "date2" type="text" name="txtmodify" value="<?php echo date("d-m-Y");?>"/></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Mã sản phẩm<font color="red">*</font></strong></td>
			<td><input name="txtcode" type="text" id="txtcode" size="35" />
			<label id="txtcode_err" class="check_error"></label></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Order</strong></td>
			<td><input name="txt_order" type="text" value='0' /></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Giá cũ</strong></td>
			<td><input name="txt_oldprice" type="text" value='0' />VNĐ</td>
			<td align="right" bgcolor="#EEEEEE"><strong>Ảnh  </strong></td>
			<td><input size="35" name="txtthumb" value="" type="text"><a href="#" onclick="OpenPopup('extensions/upload_image.php');">Chọn</a></td>
			
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Giá hiện tại</strong></td>
			<td><input name="txt_curprice" type="text" value='0'/>VNĐ</td>
			<td align="right" bgcolor="#EEEEEE"><strong>isHot&nbsp;</strong></td>
			<td><input name="opt_hot" type="radio" id="radio" value="1" />
			  <?php echo CYES;?>
			  <input name="opt_hot" type="radio" id="radio2" value="0" checked='true' />
			  <?php echo CNO;?></td>
        </tr>
	   <tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Số lượng:</strong></td>
			<td><input name="txt_quantity" type="text" value='0'/></td>
			<td align="right" bgcolor="#EEEEEE"><strong>isActive</strong></td>
			<td><input name="optactive" type="radio" value="1" checked='true' />
			<?php echo CYES;?>
			<input name="optactive" type="radio" value="0" />
			<?php echo CNO;?></td>
       </tr>
       <tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Kiểu hiển thị:</strong></td>
			<td><input name="optShow" class="optShow" type="radio" value="1" checked='true' />
			<?php echo 'slide';?>
			<input name="optShow" class="optShow" type="radio" value="0" />
			<?php echo '360 3D';?></td>

			<!-- slide -->
			<td align="right" bgcolor="#EEEEEE" class="isshow_slide"><strong>Upload ảnh slide</strong></td>
			<td class="isshow_slide">
				<div id="filediv">
					<input name="file[]" type="file" id="file"/>
				</div>
				<input type="button" id="add_more" class="upload" value="Thêm file"/>
			</td>

			<!-- 360 -->
			<td align="right" bgcolor="#EEEEEE" class="isshow_360"><strong>Thư mục 360</strong></td>
			<td class="isshow_360"><input type="text" name="txtFolder" value="" class="txtFolder" />
			
			<br/>
			<label><i>Thư mục được tạo vào đường dẫn:<?php echo ROOTHOST.'pic/zoom3d/'?></i></label>
			</td>
       </tr>
       <tr>
       		<td>
       			
       		</td>
       </tr>
       <tr>
         <td colspan="4" align="left"><hr size="1" color="#EEEEEE" width="100%" /></td>
        </tr>
       <tr>
         <td align="right" bgcolor="#EEEEEE"><strong><?php echo CMETAKEY;?>&nbsp;</strong></td>
         <td><textarea name="txtmetakey" cols="35" rows="3" id="txtmetakey"></textarea></td>
         <td align="right" bgcolor="#EEEEEE"><strong><?php echo CMETADESC;?></strong></td>
         <td><textarea name="textmetadesc" cols="35" rows="3" id="textmetadesc"></textarea></td>
       </tr>

      </table>
      </fieldset>
	
    <br style="clear:both" />
	<fieldset>
		<legend><strong>Cấu hình sản phẩm</strong></legend>
		<table width="100%" border="0" cellspacing="1" cellpadding="3">
			<tr>
				<td width="200" align="right" bgcolor="#EEEEEE"><strong>Tùy chọn cấu hình sản phẩm<font color="red">*</font></strong>
				</td>
				<td>
					<input name="optConfigPro" class="optConfigPro" type="radio" value="1" checked='true' />
					<?php echo 'Có';?>
					<input name="optConfigPro" class="optConfigPro" type="radio" value="0" />
					<?php echo 'Không';?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div id="config_product">
				    	<div>
				    		<input type="text" name="cf_content" id="cf_content" /> 
				    		<a href="#" id="add_config">Add</a>
				    	</div>
				    	<div id="list_config"></div>
				    </div> 
				</td>
			</tr>
		</table>
	</fieldset>
    
	<br style="clear:both" />
    <strong><?php echo CINTRO.' tính năng';?></strong>
    <textarea name="txtintro" id="txtintro" cols="45" rows="5">&nbsp;</textarea>
     <script language="javascript">
            var oEdit2=new InnovaEditor("oEdit2");
            oEdit2.width="100%";
            oEdit2.height="100";
            oEdit2.cmdAssetManager ="modalDialogShow('<?php echo URLEDITOR;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
            oEdit2.REPLACE("txtintro");
			document.getElementById("idContentoEdit2").style.height="100px";
      </script>
    <br style="clear:both" />
    <strong><?php echo "Thông số kĩ thuật";?>&nbsp;</strong></legend>
    <textarea name="txtfulltext" id="txtfulltext" cols="45" rows="5">&nbsp;</textarea>
    <script language="javascript">
            var oEdit1=new InnovaEditor("oEdit1");
            oEdit1.width="100%";
            oEdit1.height="300";
            oEdit1.cmdAssetManager ="modalDialogShow('<?php echo URLEDITOR;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
            oEdit1.REPLACE("txtfulltext");
            document.getElementById("idContentoEdit1").style.height="225px";
    </script>

    <input type="hidden" name="isPageEdit"></input>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>