<?php 
/**
* Plugin: jQuery AJAX-ZOOM, xt:Commerce PHP helper file: xtc_head.php
* Copyright: Copyright (c) 2010-2013 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 4.0.1
* Date: 2013-02-18
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
*/

$axZm_BaseUrl = str_replace('\\','/',dirname($_SERVER["SCRIPT_NAME"]));
if ($axZm_BaseUrl == '/' || $axZm_BaseUrl == '\\'){$axZm_BaseUrl='';}
?>

<link rel="stylesheet" href="<?php echo $axZm_BaseUrl;?>/axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css" type="text/css">
<link rel="stylesheet" href="<?php echo $axZm_BaseUrl;?>/axZm/axZm.css" type="text/css">
<style type="text/css" media="screen"> 
.axZm_zoomLogHolder{width: 70px;}
</style>

<script type="text/javascript" src="<?php echo $axZm_BaseUrl;?>/axZm/plugins/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
	// Probleme mit thickbox.js in xtcmodified
	// In Veyton kann, ggf. sollte jQuery.noConflict(); gestartet werden
	//jQuery.noConflict(); 
</script>

<script type="text/javascript">var axZm_BaseUrl = '<?php echo $axZm_BaseUrl;?>';</script>
<script type="text/javascript" src="<?php echo $axZm_BaseUrl;?>/axZm/jquery.axZm.js"></script>
<script type="text/javascript" src="<?php echo $axZm_BaseUrl;?>/axZm/mods/xtc/xtc_axZm.js"></script>
<script type="text/javascript" src="<?php echo $axZm_BaseUrl;?>/axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.js"></script>