<?php
require_once(libs_path."gfclass/cls.simple_image.php");
if(!isset($clsimage)) $clsimage = new SimpleImage();
if(!isset($objcon)) $objcon = new CLS_CONTENTS();
if(!isset($obj)) $obj = new CLS_MYSQL;

$objcon->getList($objmodule->CatID," order by `con_id` DESC LIMIT 0,1");
$class=$objmodule->Class;
?>
<div class="module <?php echo $objmodule->Class;?>">
	<div class="kienthuc_h">
	<?php if($objmodule->ViewTitle==1)
	{?>
    <h3><span><?php echo $objmodule->Title;?> </span></h3>
    <?php 
	}	
	?>
    <ul><?php $objcon->CatalogChild($objmodule->CatID);?></ul>
    </div>
    <div class="content">
    	<?php 
		$obj = $objcon->showContent($objmodule->CatID,11);
		$i=1;
		echo '<div class="know_intro">';
		while ($rows = $obj->FetchArray()) {
			$link = 'index.php?com=contents&viewtype=article&item='.$rows["con_id"];
			if($i==1) {
				$intro = stripslashes($rows["intro"]);
				$imgs=$rows["thumb_img"];
				$width = "100%";
				if($imgs!='') {
					$imgs ='<a href="'.$link.'" title="'.stripslashes($rows["title"]).'"><img src="'.$imgs.'" align="top" width="140" style="float:left; margin-right:5px" class="img_block"/></a>';
					$width="550px";
				}		
				
				if($imgs!='') echo $imgs;
				echo '<div style="float:right; width:'.$width.'; text-align:justify;"><a href="'.$link.'" title="'.stripslashes($rows["title"]).'"><h4 class="know_h">'. stripslashes($rows["title"]).'</a></h4>';
				echo '<div>'.$intro.'</div>';
				echo '<a href="'.$link.'" class="readmore">Đọc thêm</a>';
				echo '</div><div style="clear:both; height:20px;">&nbsp;</div><ul>';
			}
			if($i>1) {
				echo '<li><a href="'.$link.'" title="'.stripslashes($rows["title"]).'">'.stripslashes($rows["title"]).'</a></li>';
			}
			
			$i++;
		}
		echo '</ul></div>';
		?>
    </div>
</div>


<?php
unset($obj);
unset($objcon);
unset($objmodule);
unset($clsimage);
?>