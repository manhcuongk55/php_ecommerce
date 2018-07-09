<?php
require_once(libs_path."cls.content.php");
if(!isset($objcon)) $objcon = new CLS_CONTENTS();
?>
<div class="content">
	<?php 
	$objcon->getList(" AND cat_id=".$r['cat_id'],' ORDER BY RAND() ', ' LIMIT 0,5');
	while ($rows = $objcon->Fetch_Assoc()) {
		$title = stripslashes($rows["title"]);
		$link ='index.php?com=contents&viewtype=article&item='.$rows["con_id"];
		?>
		<div class="intro"><?php echo ' <a href="'.$link.'">'.$title.'</a> ';?></div>
		<?php } ?>
</div>