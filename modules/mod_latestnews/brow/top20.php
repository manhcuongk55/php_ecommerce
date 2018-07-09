<?php
if(!isset($objcon)) $objcon = new CLS_CONTENTS();
if(!isset($objcat)) $objcat = new CLS_CATE();

$catid = $r['cat_id']."','".$objcat->getCatIDChild('',$r['cat_id']);
$objcon->getList(" AND cat_id IN ('$catid') ",' ORDER BY RAND() ',' LIMIT 0,20');
?>
<article id='top-20'>
	<h2 class='title'>Top 20</h2>
	<?php while($item_r = $objcon->Fetch_Assoc()){	?>
	<div class='item'>
		<div class='content-inner'>
			<a href='index.php?com=contents&viewtype=article&id=<?php echo $item_r['con_id'] ;?>'>
			<img src='<?php echo $item_r['thumb_img'];?>' height='145' width='200' title='<?php echo $item_r['title'];?>'/>
			</a>
			<h4 title='<?php echo $item_r['title'];?>'><strong>Mã số:<?php echo $item_r['code'];?></strong></h4>
			<div class='share'>Like(145) | Bình luận(2) | chia sẻ</div>
		</div>
	</div>
	<?php } // endwhile?>
</article>
<?php
unset($objcon); unset($objcat);
?>