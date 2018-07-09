<?php include("helper.php");?>
<div class="module<?php echo " ".$r['class'];?>">
	<?php if($r['viewtitle']==1){?>
	<h3 class="title" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></h3>
    <?php }
	echo '<div class="content">';
    echo stripslashes($r['content']);
	echo '</div>';
	?>
</div>
<?php
unset($obj); unset($r);
?>