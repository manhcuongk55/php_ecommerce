<?php 
if(!isset($objcon)) $objcon = new CLS_CONTENTS();
if(!isset($objcat)) $objcat = new CLS_CATE();

$catid = $objmodule->CatID."','".$objcat->getCatIDChild(" WHERE par_id=".$objmodule->CatID." AND isactive=1");
?>
<div class="module <?php echo " ".$objmodule->Class;?>">
	<?php if($objmodule->ViewTitle==1)
	{
		echo '<a href="index.php?com=contents&viewtype=block&catid='.$objmodule->CatID.'"><h3><span>'.$objmodule->Title.'</span></h3></a>';
	}
	
	$objcon->getAllList(" AND cat_id IN ('$catid') ORDER BY visited DESC LIMIT 0,8");
	echo '<ul>';
	while($rows = $objcon->FetchArray()) {
		$conid = $rows["con_id"];
		$link = 'index.php?com=contents&viewtype=article&item='.$conid;
		$title = stripslashes($rows["title"]);
		echo '<li><a href="'.$link.'" title="'.stripslashes($rows["title"]).'">'.$title.'</a></li>';			
	}
	echo '</ul>';
	?>
</div>

<?php
unset($objcat);
unset($objcon);
unset($objmodule);
?>