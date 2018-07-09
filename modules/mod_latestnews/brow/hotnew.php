<div class="content">
	<?php 
	require_once(libs_path."cls.content.php");
	if(!isset($objcon)) $objcon = new CLS_CONTENTS();
	
	$objcon->getList(' AND `cat_id`='.$r['cat_id']);
	while ($item_r = $objcon->Fetch_Assoc()) {
		$title = stripslashes($item_r["title"]);
		$intro = stripslashes(trim($item_r["intro"]));
		$img = stripslashes($item_r["thumb_img"]);
		if($img!='') $img='<img src="'.$img.'" title="'.$title.'" align="left" class="img_block"/>';
		?>
		<div class="item">
			<div class='intro'>
				<?php echo $img;?>
				<h4 title='<?php echo $title;?>'><a class="news_title" href="index.php?com=contents&viewtype=article&item=<?php echo $item_r["con_id"]; ?>">		
				<?php echo $title;?>
				</a></h4>
				<div class="news_content"><?php echo $intro; ?></div>
			</div>
			<div class="contact_regis"><a href="?com=register&course=<?php echo $title;?>">Liên hệ đăng ký</a></div>
			<div class="readmore">		
				<a class="btn_detail" href="index.php?com=contents&viewtype=article&item=<?php echo $item_r["con_id"]; ?>" title='Đọc thêm'>Đọc thêm</a>	
			</div>
		</div>
		<?php }
	?>
</div>
<?php
unset($objcon);
?>