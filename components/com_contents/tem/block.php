<?php 
	include_once(libs_path.'cls.simple_image.php');
	$clsimage = new SimpleImage();

	$id = 0;
	if(isset($_GET["id"])) 
		$id = (int)$_GET["id"];
		
	$total_rows = "0";
	if(!isset($_SESSION["CUR_PAGE_MNU"]))
		$_SESSION["CUR_PAGE_MNU"] = 1;
	if(isset($_POST["txtCurnpage"])){	
		$_SESSION["CUR_PAGE_MNU"] = $_POST["txtCurnpage"];
	}

	$cur_page = $_SESSION["CUR_PAGE_MNU"];
		
	if(!isset($objcat)) 
		$objcat = new CLS_CATE;
	$id = $id."','".$objcat->getCatIDChild('',$id);
	unset($objcat);

	$obj->getList(" AND `cat_id` in ('$id') ");
?>

<div class="breadcrumb">
	<ul class="breadcrumbs wrap">
        <li class="start">
            <a href="<?php echo ROOTHOST?>index.php">Trang chủ</a> 
            <div class="arrow"></div>
            <div class="block light"></div>
            <div class="arrow light"></div>
        </li>
        <li>
            <a>Dịch vụ</a>
        </li>
    </ul>
	
</div>

<div class="content_body wrap">
	<div class="article_col_left">
		<div class="cover_block_left">			
	        <?php
	        	if($id == 88) {?>
					<div class="list_post_service">
					<h3 class="tab_title"><span style="margin-left:10px;"> Dịch vụ</span></h3>
						<ul>
						<?php
							while ($r = $obj->Fetch_Assoc()) { ?>
								<li class="post_list_item" conId="<?php echo $r['con_id']?>"><a href="#"><?php echo $r['title']?></a></li>
						<?php }
						?>
						</ul>
					</div>
	        	<?php }
	        ?>
	        <div class="Advertisement">
	            <h2>Cấu hình sản phẩm</h2>
	            <a href="#" class="readmore">Xem thêm</a>
	            <img src="<?php echo ROOTHOST?>images/configurator.jpg">
	        </div>
		</div>
		
	</div>

	<div class="content_article">
		<div class="cover_right_new">	
	
<?php
	
	$total_rows = $obj->Num_rows();	
	$stt = 0; 
	$aryNumber = array();
	for ($i=1; $i < $total_rows ; $i=$i+2) { 
		array_push($aryNumber, $i);
	}

	if($total_rows>0){
		$max_page = ceil($total_rows/MAX_ROWS_INDEX);
		if($cur_page >= $max_page){
			$cur_page = $max_page;
			$_SESSION["CUR_PAGE_PRO"]=$cur_page;
		}	
		$start_r=($cur_page-1)*MAX_ROWS_INDEX;

		$obj->getList(" AND `cat_id` in ('$id') ",' ORDER BY `modifydate` DESC '," LIMIT $start_r,".MAX_ROWS_INDEX);
		while($rows=$obj->Fetch_Assoc()) {		
			$cls = '';
			if(in_array($stt, $aryNumber)) {
				$cls = 'middel';
			}

			$title = stripslashes($rows["title"]);
			$intro = stripslashes($rows["intro"]);

			$fulltext=stripslashes($rows["fulltext"]);
			$img = $rows["thumb_img"];
			if($img=='')
				$img=$clsimage->get_image($fulltext);
			if(is_file($img)) $img = '<img src="'.$img.'" title="'.$title.'" align="left" class="img_block"/>';

			if ($id == 88) { ?>

				<div class="item_post_service <?php echo $rows['con_id']?>">				    
					<div class="content_post_service">
						<h2 class='title' title='<?php echo $title;?>'>
							<?php echo $title;?>
						</h2>
						<span><?php echo $intro;?></span>							
					</div>				    
				    
				</div>
		
			<?php }		
			
			else { ?>
				<div class="item">
				    <div class="intro">
						<div class="img_post">
							<?php if($img == ''): ?>
								<?php echo $img?>
							<?php else: ?>
								<img src="<?php echo $img;?>"> 	
							<?php endif;?>
							
						</div>
						<div class="intro_post">
							<h2 class='title' title='<?php echo $title;?>'>
								<a class="news_title" href="<?php echo ROOTHOST;?><?php echo un_unicode($title);?>-post<?php echo $rows["con_id"]; ?>.html">		
									<?php echo $title;?>
								</a>
							</h2>
							<span><?php echo $intro;?></span>
							</br>							
						</div>
						<div class="readmore">		
					        <a class="news_title" href="<?php echo ROOTHOST;?><?php echo un_unicode($title);?>-post<?php echo $rows["con_id"]; ?>.html">Đọc thêm</a>	
					    </div>
				    		
				    </div>
				    
				</div>
			<?php  }
			
			$stt++;
		} 
?>
		</div>
		</div>
	</div>
    <div id="paging_index"><?php paging_index($total_rows, MAX_ROWS_INDEX,$cur_page); ?></div>
<?php
} 
	else { echo 'Hệ thống đang cập nhật. Vui lòng quay lại mục này sau.';}?>
</div>