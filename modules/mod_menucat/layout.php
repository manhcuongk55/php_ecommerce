<?php include("helper.php");
?>
<div class="module<?php echo " ".$r['class'];?>">
	<?php if($r['viewtitle']==1){?>
	<h3 class="title" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></h3>
    <?php }?>
    <nav>
        <?php include(MOD_PATH."mod_menucat/brow/".$theme.'.php'); ?>
    </nav>
</div>
<?php unset($obj); unset($r);?>