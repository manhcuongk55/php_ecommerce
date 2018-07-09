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
		$obj = $objcon->showContentOrder($objmodule->CatID,6);
		$i=1;
		echo '<div class="know_intro">';
		while ($rows = $obj->FetchArray()) {
			$title = stripslashes($rows["title"]);
			$intro = stripslashes(trim($rows["intro"]));
			$img = $rows["thumb_img"];
			$width="100%";
			if($img!='') $img='<img src="'.$img.'" title="'.$title.'" align="left" class="img_block"/>';
			
			if($i==2) $class='intro_right';
			else $class='';			
			?>
            <div class="news <?php echo $class;?>">
                <div class="intro">
                    <?php echo $img;?>
                    <h4><a class="news_title" href="index.php?com=contents&viewtype=article&item=<?php echo $rows["con_id"]; ?>">		
                    <?php echo $title;?>	
                </a></h4>
                    <div class="news_content"><?php echo $intro; ?></div>
                </div>
                <div class="contact_regis"><a href="?com=register&course=<?php echo $title;?>">Liên hệ đăng ký</a></div>
                <div class="readmore">		
                    <a style="text-decoration: none; color:#647F9F;" class="btn_detail" href="index.php?com=contents&viewtype=article&item=<?php echo $rows["con_id"]; ?>">Đọc thêm</a>	
                </div>
            </div>
            
            <?php 
            if($i==2) echo '<div class="course_space">&nbsp;</div>';
            if($i==1) $i=2; else $i=1;
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