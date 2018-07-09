<?php
$id = '';
if(isset($_GET['id'])) {
	$id = (int)$_GET['id'];
}

if($id!= '' && $id!= 0) {	
	if(!isset($_SESSION['VIEW_PRODUCT_ID']) || $_SESSION['VIEW_PRODUCT_ID']!=$id) {
		$_SESSION['VIEW_PRODUCT_ID']=$id;
		$obj->setVisited($id);
	}

	$obj->getList(' AND `pro_id`='.$id);
	// start if
	if ($obj->Num_rows() > 0) {
		$row = $obj->Fetch_Assoc();
		$proid = $row['pro_id'];
		$catid = $row['cat_id'];
		$cur_name = stripslashes($row['name']);
		$intro = stripslashes($row['intro']);
		$content = stripslashes($row['fulltext']);
		$old_price = $row['old_price'];
		$cur_price = $row['cur_price'];

		if ($row['isConfigPro'] == 1) {
			if ($row['config'] != null) {
				$json_config = split('!@', $row['config']);	
			} else {
				$json_config = array();
			}	
		}
		
		$prersen = 0;
		if ($old_price != 0) {
			$prersen = ceil(($old_price-$cur_price)/$old_price*100);	
		}
		
		$visited = $row['visited'];
		$img = str_replace('thumb/','',stripslashes($row["thumb"]));
		if($img== ''){
			$img = $clsimage->get_image(stripslashes($content));
		}
		$imgs=$clsimage->get_images(stripslashes($content));
	?>

		<script type="text/javascript">
			//longvt
			var ajaxZoom = {}; 
			ajaxZoom.path = "../axZm/"; 
			ajaxZoom.divID = "azPlayer";
			ajaxZoom.parameter = "example=spinIpad";
			ajaxZoom.parameter += "&3dDir=/pic/zoom3d/matbaoT1";
			ajaxZoom.urlJson += "../../../pic/cropJSON/eos_1100d_demo.json";
			//end longvt

			$(document).ready(function(){
				$('html, body').animate({ scrollTop: $("#detail_product").offset().top }, 2000);
				$("#order_product").click(function(){
					$("#frm_order").submit();
				})
			})	

			$(function(){
				$('#multiOpenAccordion').multiOpenAccordion({
					active: [1, 2],
					click: function(event, ui) {
						//console.log('clicked')
					},
					init: function(event, ui) {
						//console.log('whoooooha')
					},
					tabShown: function(event, ui) {
						//console.log('shown')
					},
					tabHidden: function(event, ui) {
						//console.log('hidden')
					}
					
				});
				
				$('#multiOpenAccordion').multiOpenAccordion("option", "active", [0]);
			});		
		</script>

		<div class="breadcrumb">
			<ul class="breadcrumbs wrap">
		        <li class="start">
		            <a href="<?php echo ROOTHOST?>index.php">Trang chủ</a> 
		            <div class="arrow"></div>
		            <div class="block light"></div>
		            <div class="arrow light"></div>
		        </li>
		        <li>
		            <a><?php echo $cur_name; ?></a>
		        </li>
		    </ul>
			
		</div> 
		<div id="detail_product" class="wrap">
			<div class="cls_top"></div>
			<div class="panorama_product pro_info">
				<?php
					// 1 - slide; 2- 360
					if($row['isShow'] == 1) { ?>
						<div>
							<div class="left_block">
								<div class="Advertisement">
					                <h2>Cấu hình sản phẩm</h2>
					                <a href="#" class="readmore">Xem thêm</a>
					                <img src="<?php echo ROOTHOST?>images/configurator.jpg">
					            </div>
							</div>
							<div class="right_block">
								<?php
									if ($row['imgslide'] != '' || $row['imgslide'] != null) {
										$aryImg = split('@', $row['imgslide']);	
									} else {
										$aryImg = array();
									}
									
									if(count($aryImg) > 0) { ?>
											<ul class="bxslider">
											<?php
												for ($i=0; $i < count($aryImg); $i++) { 
													$src = ROOTHOST . 'admincp/' . $aryImg[$i];
													echo "<li><img src=".$src." alt='IMAGES'/></li>";
												}
											?>
											</ul>

											<script type="text/javascript">
												$('.bxslider').bxSlider({
												  auto: true,
												});
											</script>
									<?php } 
									else {	
										echo "<img src=".$row['thumb']." alt='IMAGES' width='100%' height='95%' class='default_images_detail'/>";								
									} ?>
								
							</div>
						</div>
								
					<?php } else {
						include($_SERVER['DOCUMENT_ROOT'].'/demo/detailProduct/template.php');											
					}
				?>
				
			</div>
			<div class="cls"></div>
			<div>
				<div class="pro_info">

					<!-- left block -->
					<div class="left_block">
						<div class="support_order">
							<h3 class="tab_title"><span>Hỗ trợ đặt hàng</span></h3>
							<div class="info_order">
								<ol>
									<li>
										<img src="<?php echo ROOTHOST;?>images/icons/icon_facebook.gif">
										<span>Tanvuong</span>
									</li>
									<li>
										<img src="<?php echo ROOTHOST;?>images/icons/icon-mobile.gif">
										<span>04 3633 4888 - Fax: 04 3633 4899</span>
									</li>
									<li>
										<img src="<?php echo ROOTHOST;?>images/icons/icon-mail-02.jpg">
										<span>maychebiengo.tanvuong@gmail.com</span>
									</li>
								</ol>
								<div class="btn_order" style="text-align:center;">
									<!-- <a href="<?php echo ROOTHOST;?>them-gio-hang-sp<?php echo $proid;?>.html" title="Mua ngay">Đặt hàng</a> -->
									<a href="#" id="order_product" title="Mua ngay">Đặt hàng</a>
								</div>
							</div>
						</div>				
					</div>
					<!-- left block end -->
					<!-- right block -->
					<form id="frm_order" method="POST" action="<?php echo ROOTHOST;?>them-gio-hang-sp<?php echo $proid;?>.html">
						<div class="right_block">
						<div id="multiOpenAccordion">
							<?php 
							if ($row['isConfigPro'] ==1) { ?>
								<h3 ><a href="#">Tùy chọn cấu hình sản phẩm</a></h3>
								<div class="config_pro">
									
									<?php
										for ($i=0; $i < count($json_config); $i++) { 
									?>
										<div class="item_config">
											<div class="l_cf">
												<label><?php echo $json_config[$i]; ?></label>		
											</div>
											<div class="r_cf">
												<label class="checkbox">
					                                <input type="checkbox" checked="checked" name="chk_cfig[]" id="" value="<?php echo $json_config[$i]; ?>">	                               
					                            </label>                                    		
											</div>
										</div>

									<?php
									}
									?>					
								</div>

							<?php }
							?>

							<h3><a href="#">Thông số kĩ thuật</a></h3>
							<div>
								<?php echo $content ?>
							</div>
							<h3><a href="#">Tính năng</a></h3>
							<div>
								<?php echo $intro ?>
							</div>
						</div>
					
					</div>

						<input type="hidden" name="id_pro" value="<?php echo $proid; ?>" />
						<input type="hidden" name="name" value="<?php echo $cur_name; ?>" />
						<input type="hidden" name="codePro" value="<?php echo $row['code']; ?>" />
						<input type="hidden" name="isConfigPro" value="<?php echo $row['isConfigPro']; ?>" />
					</form>
					
					 <!-- end right block -->

				</div>
			</div>
			
			<!-- thong tin khach hang -->
			<div id="info_customer">
				
			</div>
			<!-- end -->
			<div style="height:20px;clear:both"></div>
			<!-- san pham tuong tu -->
			<div class="like_product" style="clear:both;">
				<h3 class="title" title='Sản phẩm tương tự'><a href='#'>Sản phẩm tương tự</a></h3>
				<?php
					$obj->GetListPro(" AND `cat_id` in ('$catid') ",' ORDER BY RAND() ',' LIMIT 0,3');
				?>
				<div class='clr'></div>
			</div>
		</div>

	<?php 
		unset($row); unset($product); unset($title); unset($id);
	}
	// end if
	else {
		?>
		<div class="like_product">
			<h3>Không tìm thấy sản phẩm bạn yêu cầu! Có thể sản phẩm đã hết hạn hoặc được loại bỏ khỏi hệ thống!</h3>
			<?php
			$obj->GetListPro(" ",' ORDER BY RAND() ',' LIMIT 0,30');
			?>
			<div class='clr'></div>
		</div>
		<?php
	}
} 

?>