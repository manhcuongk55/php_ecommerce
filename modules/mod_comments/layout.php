<div class="module tab_news tab_comment">
<?php include("helper.php");
$theme = 'default';
if($objmodule->Theme!='') $theme = $objmodule->Theme;
if($objmodule->ViewTitle==1)
	{?>
	<h3 class="title"><span><?php echo $objmodule->Title;?></span></h3>
    <?php 
	}

?>
 <?php include(MOD_PATH."mod_comments/brow/".$theme.".php"); ?>
<?php unset($objmodule);?>
</div>