<?php 
include("helper.php");

if(!isset($objcon)) $objcon = new CLS_CONTENTS();
$objcon->getList($objmodule->CatID," isactive=1 LIMIT 0,5");
?>

<div id="service_box">
<div class="module <?php echo " ".$objmodule->Class;?>">
	<?php if($objmodule->ViewTitle==1)
	{?>
	<h3 class="title"><?php echo $objmodule->Title;?></h3>
    <?php 
	}
	while($rows = $objcon->Fecth_Array()) {
		$title = stripslashes($rows["title"]);
		$intro = Substring(stripslashes($rows["intro"]),0,35);
		$fulltext = stripslashes($rows["fulltext"]);
		$link = 'index.php?com=contents&viewtype=article&item='.$rows["con_id"];
		
		echo '<div class="service">
				<div class="serpad">
					<a href="'.$link.'"><h1>'.$title.'</h1></a>
		  	  		<div class="serconent">'.$intro.'</div>
					<a href="'.$link.'" class="readmore"><small>>></small> Chi tiết <small><<</small> </a>
		  	  		<div class="serprice">$80/mo</div>
				</div>
			</div>';
    } 
	?>
</div>
</div>
<?php
unset($objcon);
unset($objmodule);
?>