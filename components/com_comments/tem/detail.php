<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php
	$conid="";
	if(isset($_GET["conid"]))
		$conid=(int)$_GET["conid"];
	if(isset($_GET["item"]))
		$conid=$_GET["item"];	
	$objcontent = new CLS_CONTENTS;
	$objcontent -> getListCont($conid,'isactive=1');
	while($rows=$objcontent->FetchArray())
	{
?>
	<div class="blog">
	<h2 class="title"><?php echo $rows["title"];?></h2>
    <div class="img">image here if have</div>
    <p class="intro"><?php echo $rows["intro"];?></p>
</div>
<?php
}
?>