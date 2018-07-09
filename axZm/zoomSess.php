<?php
/**
* Plugin: jQuery AJAX-ZOOM, zoomSess.php
* Copyright: Copyright (c) 2010-2015 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 4.2.1
* Date: 2015-03-15
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/
error_reporting(0);

if(!session_id()){session_start();}

foreach ($_POST as $k=>$v){$_GET[$k] = $v;}

// Zoom out org
if (isset($_GET['resetSess'])){
	unset ($_SESSION['imageZoom']);
}

if (isset($_GET['reset'])){
	unset ($_SESSION['imageZoom']);
	
	// Only once at beginning
	if (isset($_GET['randNumber'])){
		$_SESSION['randNumber'] = $_GET['randNumber'];
		unset ($_SESSION['imageTraffic']);
	}
	
	if (isset($_GET['firstLoad'])){
		$noObjectsInclude = true;
		include("zoomInc.inc.php");
		
		// Delte zoom cashe files
		if (!$zoom['config']['pyrLoadTiles']){
			$axZmH->delteZoomCache($zoom['config']['tempDir'], $zoom['config']['cacheTime']);
		}

		echo $axZm->demoWtr($zoom);
	}else{
		echo "jQuery.fn.axZm.zoomResetSession();";
	}
}


if (isset($_GET['sessionCheck'])){
	if ($_GET['sessionCheck'] != $_SESSION['randNumber']){
		?>
		if (jQuery.axZm['useSess']){
			jQuery.fn.axZm.zoomAlert('The browser you are using is rejecting session cookies. AJAX-ZOOM may not work properly. Please turn on session cookies.', 'Warning', false);
		}
		<?php
	}
}
?>