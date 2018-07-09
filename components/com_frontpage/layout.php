<?php
$obj = new CLS_CONTENTS;
$obj->getList(" AND `cat_id` in ('89') ");
$item_r = $obj->Fetch_Assoc();

?>
<div id='frontpage'>
	<div class="wrap">
		<!-- slide -->
	        <div class="tv_slide">
	        	<?php require_once MOD_PATH.'mod_slide/layout.php';?>
	        </div>
        <!-- end slide -->	
		<!-- introduction -->
        <div class="widget_introduction">
        	<div class="left_intro">
        		<h2><span style="margin-left:15px;">Video</span></h2>
				<div class="cls_content">
					<iframe src="http://www.youtube.com/embed/pkuLZebvmVg"
   						width="380" height="230" frameborder="0" allowfullscreen>
   					</iframe>
					<!-- <video width="380" height="300" controls>
					  <source src="movie.mp4" type="video/mp4">					  		
					</video> -->
				</div>	
        	</div>
		    <div class="right_intro">
                <div>
					<h3><strong><?php echo $item_r['title']?></strong></h3>
					<p><?php echo $item_r['intro']?><br />
					<a href="index.php?com=contents&viewtype=article&id=<?php echo $item_r['con_id'] ;?>">Xem thêm...</a>
				</div>							
            </div>
        </div>
        <!-- end -->
	</div>
	<div id="inner">    
		<div class="content-sidebar-wrap">
			<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
				<div class="wrap home_rows">

			        <div class="blue_border"></div>
			        <div class="home_first_row">
			        	<?php
			        		$obj = new CLS_CONTENTS;
							$obj->getList(" AND `cat_id` in ('88') ");
							$i=1;
							while ($row = $obj->Fetch_Assoc()) {
								$j = $i+1;	

								$title = stripslashes($row["title"]);
								$intro = stripslashes($row["intro"]);
								$img = $row["thumb_img"];
								if($img == '')
									$img = $clsimage->get_image($fulltext);
								if(is_file($img)) {
									$img = '<img src="'.$img.'" title="'.$title.'" align="left" class="img_block" width="321" height="200"/>';						
								}
			        	?>
						    <section id="home_center_content-<?php echo $j;?>" class="widget home_center_content">
						    	<div class="widget-wrap">
						            <a href="<?php echo ROOTHOST;?><?php echo un_unicode($title);?>-post<?php echo $row["con_id"]; ?>.html">
							            <img src="<?php echo $img;?>"> 
						            </a>
						    		<a href="<?php echo ROOTHOST;?><?php echo un_unicode($title);?>-post<?php echo $row["con_id"]; ?>.html"><h4 class="widget-title"><?php echo $title?></h4>
						    		</a>
						            <div class="intro_service">
						            	<p>
							                <?php echo $intro; ?>
							            </p>
						            </div>						            
						    		<div class="shadow-wrap"></div>
						        </div>
						    </section>
					    <?php 
					    	$i++;
					    	} 
					    ?>					    

			        	<div style="clear:both"></div>
			       	</div>

					
			        <div class="blue_border bottom"></div>
			        <div class="home_second_row">
			        	<!-- module thong ke truy cap -->
			        	<?php $this->loadModule("user2");?>				    	
			        	<!-- end -->
						<section id="text-12" class="widget widget_text">
					    	<div class="widget-wrap">
					    		<h4 class="widget-title widgettitle">Liên kết</h4>
								<div class="textwidget">
									<div class="widget_content link">
										<ul>
											<li>
												<img src="<?php echo ROOTHOST;?>images/icons/facebook.png" />
												<a href="#">http://facebook.com.vn/tanvuong</a>
											</li>
											<li>
												<img src="<?php echo ROOTHOST;?>images/icons/twitter.png" />
												<a href="#">http://facebook.com.vn/tanvuong</a>
											</li>
											<li>
												<img src="<?php echo ROOTHOST;?>images/icons/google.png" />
												<a href="#">http://facebook.com.vn/tanvuong</a>
											</li>

										</ul>
									</div>									
								</div>
							</div>
						</section>

						<section id="text-13" class="widget widget_text">
					    	<div class="widget-wrap">
					    		<h4 class="widget-title widgettitle">Văn phòng</h4>
								<div class="textwidget">
									<div class="widget_content">
										<p>Bạn có thể liên hệ với chúng tôi thông qua các văn phòng đại diện Miền Bắc và Miền Nam</p>
										<a href="/newsletter"><img src="<?php echo ROOTHOST;?>images/public/dealer_map.png" /></a>
									</div>
									<a class="bottom_link" href="#">Go to</a>
								</div>
							</div>
						</section>
			            <div style="clear:both"></div>
		           	</div>

		        </div>
		    </main>
	    </div>
	</div>
</div>