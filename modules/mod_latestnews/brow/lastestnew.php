<div class="content">
<?php 
require_once(libs_path."cls.content.php");
require_once(libs_path."cls.category.php");

if(!isset($objcon)) $objcon = new CLS_CONTENTS();
if(!isset($objcat)) $objcat = new CLS_CATE();

$catid = $r['cat_id']."','".$objcat->getCatIDChild('',$r['cat_id']);
$objcon->getList(" AND cat_id IN ('$catid') ",' ORDER BY RAND() ',' LIMIT 0,'.MAX_ITEM);
while ($item_r = $objcon->Fetch_Assoc()) {
	$imgs=$item_r["thumb_img"];
	$title = Substring(stripslashes($item_r["title"]),0,10);
	$intro = Substring(stripslashes($item_r["intro"]),0,20);
	$link = 'index.php?com=contents&viewtype=article&item='.$item_r["con_id"];
	echo '<div class="item">
		<div class="tab_img"><a href="'.$link.'"><img src="'.$imgs.'"></a></div>
		<h4 class="title" title="'.$title.'"><a href="'.$link.'">'.$title.'</a></h4>
		<div class="intro">'.$intro.'</div>
		<div class="readmore"><a href="'.$link.'">Chi tiết <small>>></small></a></div>
	</div>';
}	
 ?>
</div>