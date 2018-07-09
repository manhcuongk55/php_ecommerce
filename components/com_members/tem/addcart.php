<?php
	$obj = new CLS_PRODUCTS;
	$clsimage = new SimpleImage;
	$objcat = new CLS_CATALOGS;

	if(isset($_POST['id_pro']))
		$ids = $_POST['id_pro'];
	
	if(isset($_POST['name']))
		$name = $_POST['name'];

	if(isset($_POST['codePro']))
		$codePro = $_POST['codePro'];

	if(isset($_POST['isConfigPro']))
		$isConfigPro = $_POST['isConfigPro'];

	if(isset($_POST['chk_cfig'])){
		$aryConfig = $_POST['chk_cfig'];	
	} else {
		$aryConfig = array();
	}
	

	$obj->getNewProduct();

?>

<script type="text/javascript">
	(function($) {
		$(function() {
			$("#scroller").simplyScroll({orientation:'vertical',customClass:'vert'});
		});
	})(jQuery);
</script>

<div class="wrap block_order_pro">
	<div class="left_order">
		<div class="hot_product">
			<h3 class="tab_title"><span style="margin-left:10px;">sản phẩm mới</span></h3>
			<div id="scroller">
			<?php 
				if($obj->Num_rows() > 0) {
					while($row = $obj->Fetch_Assoc()) {
						$catname = $objcat->getNameById($row["cat_id"]);
						$name = stripslashes($row["name"]);
						$id = $row["pro_id"];

						$img = stripslashes($row["thumb"]);
						if($img == '')
							$img = $clsimage->get_image(stripslashes($row["fulltext"]));
						$imgtag ='<img src="'.$img.'" title="'.$name.'" alt="'.$name.'" class="img_block"/>';
					?>
						<div class="item_hot">
							<?php echo $imgtag ?>
							<h2><a href="<?php echo ROOTHOST.un_unicode($catname);?>/<?php echo un_unicode($name);?>-sp<?php echo $id;?>.html"><?php echo $row['name']?></a></h2>
						</div>
					<?php
					}
				}
				unset($obj);
				unset($clsimage);
				unset($objcat);
			?>
			</div>
		</div>
		<div class="Advertisement">
			<h2>Cấu hình sản phẩm</h2>
			<a href="#" class="readmore">Xem thêm</a>
			<img src="<?php echo ROOTHOST?>images/configurator.jpg">
		</div>
	</div>
	<div class="right_order">
		<div class="info-pro">
			<h3><span>Thông tin sản phẩm</span></h3>
			<table class="tbl-info-pro-order">
				<thead>
					<tr>
						<th>STT</th>
						<th>Mã sản phẩm</th>
						<th>Tên</th>
						<?php 
						if ($isConfigPro == 1) {
							echo "<th>Thông tin cấu hình</th>"	;
						}
						?>
						
					</tr>							
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td><?php echo $codePro; ?></td>
						<td><?php echo $name; ?></td>
						<td><?php
						if (count($aryConfig) > 0 && $isConfigPro == 1) {						
							for ($i=0; $i < count($aryConfig) ; $i++) {  ?>
								<ul>
									<?php echo "<li>".$aryConfig[$i]."</li>";?>	
								</ul>
							<?php
								
							}
						} else { 
							echo "";
						}
						 ?></td>						
					</tr>
				</tbody>
			</table>
		</div>	

		<!-- Thong tin khach hang -->
		<div class="info-customer">
			<h3><span>Thông tin khách hàng</span></h3>
			<form method="POST" action="<?php echo ROOTHOST;?>index.php?com=members&viewtype=submitorder" id="frm_sumit_order">					
				<table class="tbl-info-pro-order">
					<tbody>
						<tr>
							<td width="150" class="td_title">Họ tên <label style="color: #ff0000">*</label></td>
							<td class="insert">
								<input type="text" name="txt_name_cus" class="txt_name_cus" />
							</td>
						</tr>
						<tr>
							<td width="150" class="td_title">Số điện thoại<label style="color: #ff0000">*</label></td>
							<td class="insert">
								<input type="text" name="txt_sdt_cus" class="txt_sdt_cus" />
							</td>
						</tr>	
						<tr>
							<td width="150" class="td_title">Địa chỉ<label style="color: #ff0000">*</label></td>
							<td class="insert">
								<input type="text" name="txt_add_cus" class="txt_add_cus" />
							</td>
						</tr>
						<tr>
							<td width="150" class="td_title">Ghi chú</td>
							<td class="insert">
								<textarea name="txt_note">
									
								</textarea>
							</td>
						</tr>						
					</tbody>
				</table>
				<input type="hidden" name="pro_id" value="<?php echo $ids; ?>" />
				<?php
					for ($i=0; $i < count($aryConfig) ; $i++) {  ?>						
						<input type="hidden" name="ary_config[]" value="<?php echo $aryConfig[$i] ?>"/>					
					<?php						
					}
				 ?>

			</form>
		</div>	
		<div class="div_send_order">
			<a href="#">Gửi đơn hàng</a>
		</div>	
	</div>
	

</div>