<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
define("incl_path","includes/");
define("libs_path","libs/");

require_once(incl_path."gfconfig.php");
require_once(incl_path."gfinnit.php");
require_once(incl_path."gffunction.php");

// include libs
require_once(libs_path."innit_libs.php");
// include language
$tmp=new CLS_TEMPLATE();
$tmp->Load_defaul_tem('site');
$this_tem_path=TEM_PATH.$tmp->Name."/";

$item=""; $lagid=0;
if(isset($_GET["item"]))
	$item=(int)$_GET["item"];

if($item!="" && $item!==0)
{
	if(!isset($objitem))
	$objitem=new CLS_CONTENTS();
	$objitem->getConByID($item,$lagid);
?>
<link href="<?php echo $this_tem_path;?>css/style_igf.css" rel="stylesheet" type="text/css" />
<div class="content_body">
	<div class="print"><a href="javascript:window.print();"><img src="images/icons/icon-print.gif" border="1" align="middle"/>In trang này</a></div>
    <div class="title"><h3><?php echo stripslashes(uncodeHTML($objitem->Title)); ?></h3></div>
    <div class="content">
        <?php echo stripslashes(uncodeHTML($objitem->Fulltext));?>
    </div>
</div>
<?php 
} 
unset($objitem);
unset($item);
unset($lagid);
?>