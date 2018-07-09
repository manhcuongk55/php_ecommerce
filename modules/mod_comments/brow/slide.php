<?php
require_once(libs_path."gfclass/cls.simple_image.php");

if(!isset($clsimage)) $clsimage = new SimpleImage();
if(!isset($objcon)) $objcon = new CLS_CONTENTS();
$objcon->getList($objmodule->CatID," ORDER BY `order` ASC");
?>
<div class="slide">
    <div class="slidepad">
        <div class="slideshow">
            <?php if($objmodule->ViewTitle==1)
            {?>
            	<h3 class="title"><?php echo $objmodule->Title;?></h3>
            <?php 
            }
            $n = $objcon->Numrows();
            while($rows = $objcon->FetchArray()) {
                $intro = stripslashes(uncodeHTML($rows["intro"]));
                $link = 'index.php?com=contents&viewtype=article&item='.$rows["con_id"];
                echo '<div class="slideitem">'.$intro.'</div>';
            } 
            ?>
        </div>
        <div class="slide_paging" style="display: block;">
			<?php 
            for($i=1;$i<=$n;$i++) { 
                if($i==1)
                    echo '<a rel="'.$i.'" href="#" class="active"></a>';
                else
                    echo '<a rel="'.$i.'" href="#" class=""></a>';
            } ?>
        </div>
    </div>
    
</div>

<?php
unset($objcon);
unset($objmodule);
unset($clsimage);
?>