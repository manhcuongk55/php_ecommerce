<?php
/**
* Plugin: jQuery AJAX-ZOOM, zoomDownload.php
* Copyright: Copyright (c) 2010-2015 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 4.2.1
* Date: 2015-03-15
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

if(!session_id()){session_start();}
error_reporting(0);
if (headers_sent()){exit;}
include_once ("zoomInc.inc.php");

if (isset($_GET['zoomID']) && $zoom['config']['allowDownload']){
	ob_start();
	$axZmH->downloadImage($zoom, $_GET['zoomID']);
	ob_end_flush();
}elseif (!$zoom['config']['allowDownload']){
	echo 'Download is not allowed.';
	exit;
}
?>