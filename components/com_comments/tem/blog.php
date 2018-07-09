<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php
	$catid="";
	if(isset($_GET["catid"]))
		$catid=(int)$_GET["catid"];
	if(isset($_GET["item"]))
		$catid=(int)$_GET["item"];	
	$objcontent = new CLS_CONTENTS;
	$objcontent -> getList($catid,'isactive=1');
	while($rows=$objcontent->FetchArray())
	{
		$url="#";
		$url="index.php?com=content&viewtype=detail&conid=".$rows["con_id"];	
?>
	<div class="blog">
	<h2 class="title"><?php echo $rows["title"];?></h2>
    <div class="img">image here if have</div>
    <p class="intro"><?php echo $rows["intro"];?></p>
   <div class="readmore"><a href="<?php echo $url;?>">Detail>></a></div>
</div>
<?php
	}
	?>