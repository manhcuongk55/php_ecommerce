<?php
/**
* Plugin: jQuery AJAX-ZOOM, zoomConfigCustom.inc.php
* Copyright: Copyright (c) 2010-2015 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 4.2.13
* Date: 2015-11-09
* Review: 2015-11-09
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////// Reading this will save your time and protect your nerves //////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Each example in the download package as well as e-commerce plugins use a special configuration options set. 
Default options in "/axZm/zoomConfig.inc.php" are overridden in "/axZm/zoomConfigCustom.inc.php" which is included at the bottom of "zoomConfig.inc.php". 
This happens by passing an extra parameter "example=[some value]" to AJAX-ZOOM directly from examples or plugins over query string. 
To find out which "example" value is used see sourcecode of the implementation in question or inspect an ajax call to "/axZm/zoomLoad.php" with Firebug or an other developer tool. 
Thus your specific options set can be found in "zoomConfigCustom.inc.php" after elseif ($_GET['example'] == [some value]){. 
Please note that the value of example parameter passed over the query string to AJAX-ZOOM does not always correspond to the number of an example found in /examples folder of the download package.

Because AJAX-ZOOM is updated very frequently and its options base grows accordingly, 
the best practice is to copy options you need to change from "zoomConfig.inc.php" to "zoomConfigCustom.inc.php" 
after elseif ($_GET['example'] == [some value]). 
Ofcourse you can create your own [some value] in "zoomConfigCustom.inc.php". 
By keeping "zoomConfig.inc.php" as it is ($zoom['config']['licenceKey'] and $zoom['config']['licenceType'] 
can be copied as well at the beginning of zoomConfigCustom.inc.php before the if statement to serve all examples) 
you will be able to update your customized implementation by simply overwriting all files except "zoomConfigCustom.inc.php" and custom css file.

#######################################################################################################################
######### Following "configuration sets" are for the examples provided in "examples" folder.###########################
#######################################################################################################################
*/

///////////////////////////////////////////////////////////////
///////// you can copy / uncomment some options here //////////
///////////////////////////////////////////////////////////////
// $zoom['config']['licenceKey'] = 'demo'; 
// $zoom['config']['licenceType'] = 'Basic';
// $zoom['config']['iMagick'] = true;
// $zoom['config']['imPath'] = '/usr/bin/convert'; 
// $zoom['config']['memory_limit'] = '8512M'; 
/* $zoom['config']['licenses'] = array(
	'yourDomainName.com' => array(
		'licenceType' => 'Basic',
		'licenceKey' => 'demo'
	),
	'otherDomainName.com' => array(
		'licenceType' => 'Basic',
		'licenceKey' => 'demo'
	)
	
);*/


if ($_GET['example'] == 1){
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 5;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['galleryThumbOverOpaque'] = 1;
	$zoom['config']['galleryThumbOutOpaque'] = 1;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
	$zoom['config']['displayNavi'] = true; 
	$zoom['config']['fullScreenNaviBar'] = true; 
	$zoom['config']['useGallery'] = true; 
	$zoom['config']['fullScreenApi'] = true;  
}

elseif ($_GET['example'] == 2){
	$zoom['config']['picDim'] = '720x480';
	$zoom['config']['galleryFullPicDim'] = "100x100";
	$zoom['config']['useGallery'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['help'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false; 
	$zoom['config']['galleryThumbOverOpaque'] = 1; 
	$zoom['config']['galleryThumbOutOpaque'] = 1; 
	$zoom['config']['displayNavi'] = true; 
	$zoom['config']['fullScreenNaviBar'] = true; 
	$zoom['config']['fullScreenApi'] = true;  
}

elseif ($_GET['example'] == 3){
	$zoom['config']['displayNavi'] = true; 
	$zoom['config']['fullScreenNaviBar'] = true; 
	$zoom['config']['useGallery'] = true; 
	$zoom['config']['fullScreenApi'] = true;  
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['help'] = true;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 5;
	$zoom['config']['dragMap'] = true;
	$zoom['config']['zoomMapAnimate'] = true;
	$zoom['config']['zoomMapVis'] = true; 
	$zoom['config']['galleryPicDim'] = '80x80';
	$zoom['config']['galleryLines'] = 3; 
	$zoom['config']['galleryThumbOverOpaque'] = 1;
	$zoom['config']['galleryThumbOutOpaque'] = 1; 
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 4){
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['cornerRadius'] = 5;
	$zoom['config']['innerMargin'] = 5;
	$zoom['config']['dragMap'] = true;
	$zoom['config']['galleryThumbOverOpaque'] = 1; 
	$zoom['config']['galleryThumbOutOpaque'] = 1;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
	$zoom['config']['displayNavi'] = true; 
	$zoom['config']['fullScreenNaviBar'] = true; 
	$zoom['config']['useGallery'] = true; 
}

elseif ($_GET['example'] == 5){
	$zoom['config']['useGallery'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['galFullAutoStart'] = true;
	$zoom['config']['help'] = false;
	$zoom['config']['cornerRadius'] = 5;
	$zoom['config']['innerMargin'] = 5;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false; 
	$zoom['config']['galleryThumbOverOpaque'] = 1;
	$zoom['config']['galleryThumbOutOpaque'] = 1;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true; 
	$zoom['config']['displayNavi'] = true; 
	$zoom['config']['fullScreenNaviBar'] = true; 
}

elseif ($_GET['example'] == 6){
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['help'] = true;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 5;
	$zoom['config']['dragMap'] = true;
	$zoom['config']['zoomMapAnimate'] = true;
	$zoom['config']['zoomMapVis'] = true; 
	$zoom['config']['galleryPicDim'] = '70x70'; 
	$zoom['config']['galleryLines'] = 3; 
	$zoom['config']['galleryThumbOverOpaque'] = 1;
	$zoom['config']['galleryThumbOutOpaque'] = 1; 
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 7){
	$zoom['config']['picDim'] = "480x320";
	$zoom['config']['naviPos'] = "top";
	$zoom['config']['naviFloat'] = "right";
	$zoom['config']['useHorGallery'] = true;
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['help'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 5;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['zoomMapAnimate'] = true;
	$zoom['config']['zoomMapVis'] = false; 
	$zoom['config']['useGallery'] = false; 
	$zoom['config']['galleryThumbOverOpaque'] = 1;
	$zoom['config']['galleryThumbOutOpaque'] = 1;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 8){
	$zoom['config']['galleryPicDim'] = '100x100';
	$zoom['config']['galleryFullPicDim'] = '75x60';
	$zoom['config']['galleryNavi'] = true; 
	$zoom['config']['galleryNaviPos'] = 'bottom'; 
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['cornerRadius'] = 5;
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['dragMap'] = true;
	$zoom['config']['zoomSlider'] = true;
	$zoom['config']['gallerySlideNavi'] = false;
	$zoom['config']['displayNavi'] = true; 
	$zoom['config']['fullScreenNaviBar'] = true;
	$zoom['config']['useGallery'] = true;  
}

elseif ($_GET['example'] == 9){
	$zoom['config']['picDim'] = '320x480';
	$zoom['config']['buttonSet'] = 'flat';
	$zoom['config']['help'] = false;
	$zoom['config']['galFullButton'] = false;
	$zoom['config']['naviGroupSpace'] = 10;
	
	$zoom['config']['useGallery'] = false;
	$zoom['config']['galleryPicDim'] = '70x70';
	$zoom['config']['galleryPos'] = 'left';
	$zoom['config']['galleryFullPicDim'] = '70x70';
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['galleryNaviPos'] = 'bottom'; 
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['naviMinPadding'] = 0;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['mapButton'] = false;
	$zoom['config']['fullScreenNaviButton'] = false;
	$zoom['config']['gallerySlideNavi'] = false;
	$zoom['config']['displayNavi'] = true; 
	$zoom['config']['fullScreenNaviBar'] = true; 
}

elseif ($_GET['example'] == 'new9'){ // 4.2.1
	$zoom['config']['picDim'] = '400x600';
	$zoom['config']['zoomSlider'] = true;
	$zoom['config']['zoomSliderHorizontal'] = true;
	$zoom['config']['zoomSliderPosition'] = 'bottom';
	$zoom['config']['zoomSliderMarginV'] = 10;
	
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['displayNavi'] = false;
	
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['mapBorder']['top'] = 0; 
	$zoom['config']['mapBorder']['right'] = 0; 
	$zoom['config']['mapBorder']['bottom'] = 0; 
	$zoom['config']['mapBorder']['left'] = 0; 
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['mapWidth'] = 50;
	$zoom['config']['mapHeight'] = 70;
	$zoom['config']['fullScreenMapFract'] = 0.2;
	$zoom['config']['mapSelSmoothDrag'] = false;
	
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['galleryFadeInSize'] = 1;
	$zoom['config']['galleryFadeInSpeed'] = 300;
	$zoom['config']['galleryFadeInOpacity'] = 0.5;

	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
	
	$zoom['config']['useGallery'] = false;
	$zoom['config']['galleryFullPicDim'] = '90x90';
	$zoom['config']['galleryNavi'] = false;
	$zoom['config']['fullScreenVertGallery'] = true;
}

elseif ($_GET['example'] == 10){
	$zoom['config']['visualConf'] = true;
	$zoom['config']['zoomSlider'] = true;
	
	$zoom['config']['displayNavi'] = true; 
	$zoom['config']['fullScreenNaviBar'] = true; 
	$zoom['config']['useGallery'] = true; 
	
	$zoom['config']['pssBar'] = true;
	$zoom['config']['cropNoObj'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	
	// do not load image tiles directly block
	$zoom['config']['pyrLoadTiles'] = false;
	$zoom['config']['pyrQual'] = 100;
	$zoom['config']['pyrTilesPath'] = '/pic/zoomtiles/';
	$zoom['config']['zoomDragSpeed'] = 500; 
	$zoom['config']['zoomDragAjax'] = 1000;
	
	$zoom['config']['gallerySlideNavi'] = false;
}

elseif ($_GET['example'] == 11){ 
	$zoom['config']['picDim'] = '450x300'; 
	
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['useGallery'] = false;
	
	$zoom['config']['useHorGallery'] = true;
	$zoom['config']['galHorPosition'] = 'bottom2';
	$zoom['config']['galHorFlow'] = false;
	$zoom['config']['galHorArrows'] = false;
	$zoom['config']['galHorInnerCorner'] = false;
	$zoom['config']['galHorMarginTop'] = 0;
	$zoom['config']['galHorMarginBottom'] = 0; 
	$zoom['config']['galHorCssPadding'] = 0;
	$zoom['config']['galHorCssDescrPadding'] = 0; 
	$zoom['config']['galHorHeight'] = 85;
	
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['naviBigZoom'] = false;
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['gallerySlideNavi'] = false;
	$zoom['config']['help'] = false;

	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['dragMap'] = false;

	$zoom['config']['zoomSlider'] = true;
	$zoom['config']['zoomSliderHeight'] = 100;
	$zoom['config']['zoomSliderHandleSize'] = 11;
	$zoom['config']['zoomSliderWidth'] = 5;
	$zoom['config']['zoomSliderMarginH'] = 10;
	$zoom['config']['zoomSliderPosition'] = 'right';
	$zoom['config']['zoomSliderMouseOver'] = true;
	
	// Step zoom
	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 11;
	$zoom['config']['scrollAjax'] = 200;
	$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
	$zoom['config']['pyrTilesFadeLoad'] = 300; 
}

elseif ($_GET['example'] == 'clb'){ // 4.2.1
	$zoom['config']['picDim'] = '570x380'; 
	
	$zoom['config']['useFullGallery'] = true;
	$zoom['config']['useGallery'] = false;
	
	$zoom['config']['useHorGallery'] = true;
	$zoom['config']['galHorPosition'] = 'bottom2';
	$zoom['config']['galHorFlow'] = false;
	$zoom['config']['galHorArrows'] = true;
	$zoom['config']['galHorInnerCorner'] = false;
	$zoom['config']['galHorMarginTop'] = 0;
	$zoom['config']['galHorMarginBottom'] = 0; 
	$zoom['config']['galHorCssPadding'] = 0;
	$zoom['config']['galHorCssDescrPadding'] = 0; 
	$zoom['config']['galHorHeight'] = 85;
	
	$zoom['config']['displayNavi'] = true;
	$zoom['config']['fullScreenNaviBar'] = true;
	$zoom['config']['naviBigZoom'] = true;
	$zoom['config']['galleryNavi'] = true; 
	$zoom['config']['gallerySlideNavi'] = false;
	$zoom['config']['help'] = false;

	$zoom['config']['zoomMapVis'] = true;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['dragMap'] = false;

	$zoom['config']['zoomSlider'] = true;
	$zoom['config']['zoomSliderHeight'] = 100;
	$zoom['config']['zoomSliderHandleSize'] = 11;
	$zoom['config']['zoomSliderWidth'] = 5;
	$zoom['config']['zoomSliderMarginH'] = 10;
	$zoom['config']['zoomSliderPosition'] = 'right';
	$zoom['config']['zoomSliderMouseOver'] = true;
	
	// Step zoom
	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 11;
	$zoom['config']['scrollAjax'] = 200;
	$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
	$zoom['config']['pyrTilesFadeLoad'] = 300; 
}

elseif ($_GET['example'] == 12){
	$zoom['config']['picDim'] = '420x280';
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['help'] = false;
	$zoom['config']['galleryPicDim'] = '70x70';	
	$zoom['config']['galleryNavi'] = false; 
	
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['cornerRadius'] = 5;
	$zoom['config']['innerMargin'] = 5;
	$zoom['config']['dragMap'] = false; 
	$zoom['config']['naviBigZoom'] = false;
}

elseif ($_GET['example'] == 13){
	$zoom['config']['picDim'] = '420x280';
	$zoom['config']['galHorPosition'] = 'bottom2';
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['help'] = false;
	$zoom['config']['useGallery'] = false;
	$zoom['config']['scrollPane'] = false;
	$zoom['config']['galleryNavi'] = false;
	$zoom['config']['dragMap'] = false; 
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['zoomMapContainment'] = 'body';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['naviBigZoom'] = false;
	$zoom['config']['zoomLoaderEnable'] = false;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 'testZoomTo'){ // Ver. 4.2.1+
	$zoom['config']['picDim'] = '510x340';
	$zoom['config']['galHorPosition'] = 'bottom2';
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['help'] = false;
	$zoom['config']['useGallery'] = false;
	$zoom['config']['scrollPane'] = false;
	$zoom['config']['galleryNavi'] = false;
	$zoom['config']['dragMap'] = false; 
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['zoomMapContainment'] = 'body';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['naviBigZoom'] = false;
	$zoom['config']['zoomLoaderEnable'] = false;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
	$zoom['config']['displayNavi'] = true;
	$zoom['config']['fullScreenNaviBar'] = true;
}

elseif ($_GET['example'] == 14){
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['galleryPos'] = 'left';
	$zoom['config']['galleryPicDim'] = '100x100';
	$zoom['config']['galleryFullPicDim'] = '75x60';
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['galleryNaviPos'] = 'bottom'; 
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 5;
	$zoom['config']['innerMargin'] = 5;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true; 
}

elseif ($_GET['example'] == 15){
	$zoom['config']['picDim'] = "480x360";
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['mapPos'] = 'bottomRight';
	$zoom['config']['galleryPos'] = 'left';
	$zoom['config']['naviFloat'] = 'left';
	$zoom['config']['galleryLines'] = 4;
	$zoom['config']['galleryPicDim'] = '80x80';
	$zoom['config']['galleryNavi'] = true; 
	$zoom['config']['galleryNaviPos'] = 'navi'; 
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 5;
	$zoom['config']['innerMargin'] = 5;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['galleryThumbOverOpaque'] = 1; 
	$zoom['config']['galleryThumbOutOpaque'] = 1;	
	$zoom['config']['helpMargin'] = 0;
	$zoom['config']['help'] = false;
	$zoom['config']['mapButton'] = false;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true; 
}

elseif ($_GET['example'] == 16){
	$zoom['config']['picDim'] = "480x320";
	$zoom['config']['useGallery'] = false; 
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['help'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;  
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = true;
	$zoom['config']['dragMap'] = false;
}

// 3D Zoom & Spin
elseif ($_GET['example'] == 17){
	$zoom['config']['picDim'] = "600x400";
	$zoom['config']['galFullButton'] = false;
	$zoom['config']['naviFloat'] = 'right';
	$zoom['config']['galleryPicDim'] = '80x80';
	$zoom['config']['displayNavi'] = true; 
	$zoom['config']['fullScreenNaviBar'] = true; 
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['useGallery'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['helpMargin'] = 0;
	$zoom['config']['help'] = false;
	$zoom['config']['mapButton'] = true;
	$zoom['config']['spinMod'] = true;
	$zoom['config']['galleryNoThumbs'] = true;
	$zoom['config']['firstMod'] = 'spin';
	$zoom['config']['zoomSlider'] = true;
	$zoom['config']['gallerySlideNavi'] = false;
}

elseif ($_GET['example'] == 18){ 
	$zoom['config']['picDim'] = '400x600';
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['zoomSlider'] = true;
	$zoom['config']['zoomSliderPosition'] = 'topLeft';
	$zoom['config']['zoomSliderMarginV'] = 10;
	$zoom['config']['zoomSliderMarginH'] = 10;
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['useGallery'] = false;
	$zoom['config']['mapParent'] = 'mapContainer';
	$zoom['config']['mapParCenter'] = false;
	$zoom['config']['mapWidth'] = 160;
	$zoom['config']['mapHeight'] = 240;
	$zoom['config']['mapOwnImage'] = '160x240';
	$zoom['config']['mapSelSmoothDrag'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = false;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['mapBorder']['top'] = 1; 
	$zoom['config']['mapBorder']['right'] = 1; 
	$zoom['config']['mapBorder']['bottom'] = 1; 
	$zoom['config']['mapBorder']['left'] = 1; 
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['galleryFadeInSize'] = 1;
	$zoom['config']['galleryFadeInSpeed'] = 300;
	$zoom['config']['galleryFadeInOpacity'] = 0.5;
	$zoom['config']['galleryFadeInAnm'] = 'Right';
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

elseif ($_GET['example'] == 19){ 
	$zoom['config']['picDim'] = '360x540';
	$zoom['config']['speedOptSet'] = true; 
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['mapParent'] = 'mapContainer';
	$zoom['config']['mapFract'] = 1;
	$zoom['config']['mapSelSmoothDrag'] = false;
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['useGallery'] = false;	
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = false;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['mapBorder']['top'] = 0; 
	$zoom['config']['mapBorder']['right'] = 0; 
	$zoom['config']['mapBorder']['bottom'] = 0; 
	$zoom['config']['mapBorder']['left'] = 0; 
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = true;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['gallerySlideNavi'] = false;
	
 	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 11;
	$zoom['config']['scrollAjax'] = 200;
	$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
	$zoom['config']['pyrTilesFadeLoad'] = 300;
}

elseif ($_GET['example'] == 20){
	$zoom['config']['picDim'] = '600x400';  
	$zoom['config']['displayNavi'] = true; 
	$zoom['config']['useHorGallery'] = true;
	$zoom['config']['useGallery'] = false;
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['galleryNaviPos'] = 'bottom'; 
	$zoom['config']['dragMap'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['zoomSlider'] = true;
	$zoom['config']['gallerySlideNavi'] = true;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
}

// Animation
elseif ($_GET['example'] == 21){
	$zoom['config']['picDim'] = "600x400";
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['galFullButton'] = false;
	$zoom['config']['naviFloat'] = 'right';
	$zoom['config']['galleryNoThumbs'] = false;
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['useGallery'] = false;
	$zoom['config']['galleryPicDim'] = '80x80';
	$zoom['config']['useHorGallery'] = true;
	$zoom['config']['galleryHorPicDim'] = '60x60';
	$zoom['config']['galHorHeight'] = 70;
	$zoom['config']['galHorCssPadding'] = 0;
	$zoom['config']['galHorCssDescrHeight'] = 0;
	$zoom['config']['galHorCssDescrPadding'] = 0;
	$zoom['config']['galHorScrollToCurrent'] = false;
	$zoom['config']['galHorInnerCorner'] = false;
	$zoom['config']['galHorArrows'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['helpMargin'] = 0;
	$zoom['config']['help'] = false;
	$zoom['config']['mapButton'] = true;
	$zoom['config']['spinMod'] = true;
	$zoom['config']['firstMod'] = 'spin';
	$zoom['config']['spinSlider'] = true;
	$zoom['config']['spinSliderPosition'] = 'naviTop'; 
	$zoom['config']['spinSliderWidth'] = false; 
	$zoom['config']['spinSliderContainerPadding'] = array('top'=>5, 'right'=>20, 'bottom'=>5, 'left' =>10);
	$zoom['config']['spinSliderContainerHeight'] = 42;
	$zoom['config']['spinDemoTime'] = 4000; 
	$zoom['config']['naviSpinButSwitch'] = false;
	$zoom['config']['naviTopMargin'] = 0; 
	$zoom['config']['cueFrames'] = false;  
	$zoom['config']['spinSliderPlayButton'] = true;  
	$zoom['config']['spinSliderTopMargin'] = 10; 
	$zoom['config']['spinToMotion'] = 'easeOutQuad';  
}

// Mouse hover zoom
elseif ($_GET['example'] == 22){
	$zoom['config']['picDim'] = '530x500';
	$zoom['config']['mapWidth'] = 250;
	$zoom['config']['mapHeight'] = false;
	$zoom['config']['mapParent'] = 'mapContainer';
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['mapFract'] = 0.7;
	$zoom['config']['restoreSpeed'] = 1;
	$zoom['config']['zoomMapSwitchSpeed'] = 1; 
	$zoom['config']['galleryInnerFade'] = false;
	$zoom['config']['galleryFadeInSpeed'] = 1;
	$zoom['config']['galleryFadeOutSpeed'] = 1;
	$zoom['config']['pZoom'] = 25;
	$zoom['config']['pZoomOut'] = 25;
	$zoom['config']['mapSelSmoothDrag'] = false;
	$zoom['config']['autoZoom']['enabled'] = true; 
	$zoom['config']['autoZoom']['onlyFirst'] = false; 
	$zoom['config']['autoZoom']['speed'] = 1; 
	$zoom['config']['autoZoom']['motion'] = 'swing'; 
	$zoom['config']['autoZoom']['pZoom'] = 'max'; 
	$zoom['config']['galleryNoThumbs'] = false;
	$zoom['config']['galleryFullPicDim'] = "62x62"; 
	$zoom['config']['useGallery'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = false;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['mapBorder']['top'] = 0; 
	$zoom['config']['mapBorder']['right'] = 0; 
	$zoom['config']['mapBorder']['bottom'] = 0; 
	$zoom['config']['mapBorder']['left'] = 0; 
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;

	$zoom['config']['allowDynamicThumbs'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['mapMouseOver'] = true;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
	
	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 25; 
	$zoom['config']['scrollSpeed'] = 500;
}

elseif ($_GET['example'] == 'mouseOverTiles'){ // Ver. 4.2.1
	$zoom['config']['picDim'] = '530x500';

	$zoom['config']['displayNavi'] = false;
	$zoom['config']['restoreSpeed'] = 1;
	$zoom['config']['zoomMapSwitchSpeed'] = 1; 
	
	$zoom['config']['galleryInnerFade'] = false;
	$zoom['config']['galleryFadeInSpeed'] = 1;
	$zoom['config']['galleryFadeOutSpeed'] = 1;
	
	$zoom['config']['pZoom'] = 25;
	$zoom['config']['pZoomOut'] = 25;
	$zoom['config']['mapSelSmoothDrag'] = false;
	
	$zoom['config']['galleryNoThumbs'] = false;
	$zoom['config']['galleryFullPicDim'] = "62x62"; 
	$zoom['config']['useGallery'] = false;

	$zoom['config']['mapBorder']['top'] = 0; 
	$zoom['config']['mapBorder']['right'] = 0; 
	$zoom['config']['mapBorder']['bottom'] = 0; 
	$zoom['config']['mapBorder']['left'] = 0; 

	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;

	$zoom['config']['allowDynamicThumbs'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
	
 	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 11;
	$zoom['config']['scrollAjax'] = 200;
	$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
	$zoom['config']['pyrTilesFadeLoad'] = 300;
}

elseif ($_GET['example'] == 23){
	$zoom['config']['picDim'] = '600x400';
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['mapSelSmoothDrag'] = false;	
	$zoom['config']['galHorMarginBottom'] = 0;
	$zoom['config']['galHorFlow'] = true;
	$zoom['config']['galHorArrows'] = false;
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['galleryFullPicDim'] = '120x120';
	$zoom['config']['galFullAutoStart'] = true;
	$zoom['config']['galleryPicDim'] = '120x120'; 
	$zoom['config']['galleryScrollbarWidth'] = 10;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = false;
	$zoom['config']['dragMap'] = false; 	
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 0; 
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['galleryFadeInSize'] = 1;
	$zoom['config']['zoomFadeIn'] = 1000;
	$zoom['config']['galleryFadeInSpeed'] = 1000;
	$zoom['config']['galleryFadeInOpacity'] = 0.0;
	$zoom['config']['galleryFadeInAnm'] = 'Center';
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['fullScreenMapFract'] = false;
	$zoom['config']['fullScreenMapWidth'] = false;
	$zoom['config']['fullScreenMapHeight'] = 120;
	$zoom['config']['galleryNavi'] = false;
	
	$zoom['config']['fullScreenNaviBar'] = false;
	
	$zoom['config']['mNavi']['enabled'] = true;
	$zoom['config']['mNavi']['offsetVertFS'] = 10;
	$zoom['config']['mNavi']['fullScreenShow'] = true;
	$zoom['config']['mNavi']['gravity'] = 'bottom';
	$zoom['config']['mNavi']['mouseOver'] = true;
	$zoom['config']['mNavi']['order'] = array(
		'mZoomIn' => 5, 
		'mZoomOut' => 0
	);	
	$zoom['config']['fullScreenVertGallery'] = true;
	$zoom['config']['useGallery'] = true; 
}

elseif ($_GET['example'] == 24){
	$zoom['config']['picDim'] = '600x600';
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['useGallery'] = false;
	$zoom['config']['mapSelSmoothDrag'] = false;	
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['galleryNavi'] = false;
	$zoom['config']['help'] = false;
	$zoom['config']['fullScreenNaviButton'] = false;
	$zoom['config']['fullScreenCornerButton'] = false;
	$zoom['config']['fullScreenExitText'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
}

elseif ($_GET['example'] == 25){
	$zoom['config']['picDim'] = '520x412'; 
	$zoom['config']['galHorPosition'] = 'bottom2';
	$zoom['config']['useFullGallery'] = false;
	$zoom['config']['help'] = false;
	$zoom['config']['galleryPicDim'] = '70x70';
	$zoom['config']['galleryLines'] = 2;
 	$zoom['config']['galleryNavi'] = true;
	$zoom['config']['galleryNaviPos'] = 'navi';
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['naviBigZoom'] = true;
	$zoom['config']['galleryFadeInAnm'] = 'Right';
	$zoom['config']['galleryFadeInSize'] = 1; 	 
	$zoom['config']['zoomSliderPosition'] = 'topLeft';
	$zoom['config']['zoomSliderMarginV'] = 150;
	$zoom['config']['fullScreenGallery'] = false;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
	$zoom['config']['useGallery'] = true; 
	$zoom['config']['fullScreenApi'] = true;  
}

elseif ($_GET['example'] == 'spinIpad'){ 
	$zoom['config']['picDim'] = "720x480";
	$zoom['config']['galFullButton'] = false;
	$zoom['config']['naviFloat'] = 'right';
	$zoom['config']['galleryPicDim'] = '80x80';
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['useGallery'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['helpMargin'] = 0;
	$zoom['config']['help'] = false;
	$zoom['config']['mapButton'] = true;
	$zoom['config']['spinMod'] = true;
	$zoom['config']['galleryNoThumbs'] = true;
	$zoom['config']['firstMod'] = 'spin';
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['spinSlider'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
	
	$zoom['config']['mNavi']['enabled'] = true;
	$zoom['config']['mNavi']['ellementRows'] = 1;
	$zoom['config']['mNavi']['offsetVertFS'] = 10;
	$zoom['config']['mNavi']['fullScreenShow'] = true;
	$zoom['config']['mNavi']['gravity'] = 'bottomLeft';
	$zoom['config']['mNavi']['mouseOver'] = false;
	$zoom['config']['mNavi']['cssClass'] = '';
	$zoom['config']['mNavi']['order'] = array(
		'mPan' => 5, 
		'mSpin' => 0
	);
	
	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 11;
	$zoom['config']['scrollAjax'] = 200;
	$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
	$zoom['config']['pyrTilesFadeLoad'] = 300; 
	
	if (isset($_GET['zoomDir']) || isset($_GET['zoomData'])){
		$zoom['config']['useFullGallery'] = true; 
		$zoom['config']['galleryNoThumbs'] = false;
		$zoom['config']['galleryFullPicDim'] = '200x200';

		$zoom['config']['zoomMapSwitchSpeed'] = 0;
		$zoom['config']['restoreSpeed'] = 300;
		$zoom['config']['pyrTilesFadeInSpeed'] = 200;
		$zoom['config']['pyrTilesFadeLoad'] = 200;
		$zoom['config']['galleryFadeOutSpeed'] = 0;
		$zoom['config']['galleryFadeInSpeed'] = 100;
		$zoom['config']['galleryInnerFade'] = 100;
		$zoom['config']['galleryInnerFadeCut'] = 100;
		$zoom['config']['galleryFadeInSize'] = 1;
		$zoom['config']['zoomFadeIn'] = 100;
		$zoom['config']['gallerySlideSwipeSpeed'] = 400;
	}
}

elseif ($_GET['example'] == 'spinAnd2D'){ // Ver. 4.2.1
	$zoom['config']['picDim'] = '600x400';
	$zoom['config']['galFullButton'] = false;
	$zoom['config']['naviFloat'] = 'right';
	$zoom['config']['galleryPicDim'] = '80x80';
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['useGallery'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['mapBorder']['top'] = 1; 
	$zoom['config']['mapBorder']['right'] = 1; 
	$zoom['config']['mapBorder']['bottom'] = 1; 
	$zoom['config']['mapBorder']['left'] = 1; 
	$zoom['config']['mapFract'] = 0.20;	
	$zoom['config']['zoomShowButtonDescr'] = false;	
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['helpMargin'] = 0;
	$zoom['config']['help'] = false;
	$zoom['config']['mapButton'] = true;
	$zoom['config']['galleryNoThumbs'] = true;
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;

	$zoom['config']['mNavi']['enabled'] = true;
	$zoom['config']['mNavi']['ellementRows'] = 1;
	$zoom['config']['mNavi']['offsetVertFS'] = 10;
	$zoom['config']['mNavi']['fullScreenShow'] = true;
	$zoom['config']['mNavi']['gravity'] = 'bottomLeft';
	$zoom['config']['mNavi']['mouseOver'] = true;
	$zoom['config']['mNavi']['cssClass'] = '';
	$zoom['config']['mNavi']['alt']['enabled'] = false;
	$zoom['config']['mNavi']['order'] = array(
		'mPan' => 5, 
		'mSpin' => 0
	);
	
	$zoom['config']['galleryFadeInSize'] = 1.0;
	$zoom['config']['spinSlider'] = false;
	$zoom['config']['gallerySlideNavi'] = false;
	
	// 360 settings
	if (isset($_GET['image360']) || isset($_GET['3dDir'])){
		$zoom['config']['spinMod'] = true;
		$zoom['config']['firstMod'] = 'spin';
	}else{
		$zoom['config']['mNavi']['order'] = array(
			'mPrev' => 5,
			'mNext' => 0
		);
	}
	
 	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 11;
	$zoom['config']['scrollAjax'] = 200;
	$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
	$zoom['config']['pyrTilesFadeLoad'] = 300;
}

elseif ($_GET['example'] == 'spinAnd2D_easy'){ // Ver. 4.2.6
	$zoom['config']['picDim'] = '600x400';
	$zoom['config']['galFullButton'] = false;
	$zoom['config']['naviFloat'] = 'right';
	$zoom['config']['galleryPicDim'] = '80x80';
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['useGallery'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['mapBorder']['top'] = 1; 
	$zoom['config']['mapBorder']['right'] = 1; 
	$zoom['config']['mapBorder']['bottom'] = 1; 
	$zoom['config']['mapBorder']['left'] = 1; 
	$zoom['config']['mapFract'] = 0.20;	
	$zoom['config']['zoomShowButtonDescr'] = false;	
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['helpMargin'] = 0;
	$zoom['config']['help'] = false;
	$zoom['config']['mapButton'] = true;
	$zoom['config']['galleryNoThumbs'] = true;
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;

	$zoom['config']['mNavi']['enabled'] = true;
	$zoom['config']['mNavi']['ellementRows'] = 1;
	$zoom['config']['mNavi']['offsetVertFS'] = 10;
	$zoom['config']['mNavi']['fullScreenShow'] = true;
	$zoom['config']['mNavi']['gravity'] = 'bottomLeft';
	$zoom['config']['mNavi']['mouseOver'] = false;
	$zoom['config']['mNavi']['cssClass'] = '';
	$zoom['config']['mNavi']['alt']['enabled'] = false;
	$zoom['config']['mNavi']['order'] = array(
		'mReset' => 0
	);
	
	$zoom['config']['galleryFadeInSize'] = 1.0;
	$zoom['config']['spinSlider'] = false;
	$zoom['config']['gallerySlideNavi'] = false;
	
	// 360 settings
	if (isset($_GET['image360']) || isset($_GET['3dDir'])){
		$zoom['config']['spinMod'] = true;
		$zoom['config']['firstMod'] = 'spin';
		$zoom['config']['icons']['mReset'] = array('file'=>'button_iPad_spin', 'ext'=>'png', 'w'=>'{mWidth}', 'h'=>'{mHeight}');
	}else{
		$zoom['config']['mNavi']['order'] = array(
			'mReset' => 0
		);
	}
	
	$zoom['config']['touchSettings'] = array(
		'zoomDoubleClickTap' => 350,
		'tapHideAll' => false,
		'useMap' => false,
		'zoomSlider' => false,
		'spinSlider' => false,
		'zoomOutClick' => true
	);
	
	$zoom['config']['scroll'] = true;
	$zoom['config']['mouseScrollEnable'] = false;
	
	$zoom['config']['tapHideAll'] = false; // bool
	$zoom['config']['zoomDoubleClickTap'] = 350;
	$zoom['config']['pZoom'] = 999999;
	$zoom['config']['pZoomOut'] = 999999;
	$zoom['config']['forceToPan'] = false;
	$zoom['config']['zoomOutClick'] = true;
	$zoom['config']['zoomSpeed'] = 500;
	$zoom['config']['zoomOutSpeed'] = 500; 
	$zoom['config']['restoreSpeed'] = 500;
		
 	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 11;
	$zoom['config']['scrollAjax'] = 200;
	$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
	$zoom['config']['pyrTilesFadeLoad'] = 300;
}


elseif ($_GET['example'] == 'modal'){ 
	$zoom['config']['picDim'] = "790x480";
	$zoom['config']['galFullButton'] = false;
	$zoom['config']['naviFloat'] = 'right';
	$zoom['config']['galleryPicDim'] = '80x80';
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['useGallery'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['helpMargin'] = 0;
	$zoom['config']['help'] = false;
	$zoom['config']['mapButton'] = true;
	$zoom['config']['spinMod'] = true;
	$zoom['config']['galleryNoThumbs'] = true;
	$zoom['config']['firstMod'] = 'spin';
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['spinSlider'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
	
	$zoom['config']['gallerySlideNavi'] = true;
	$zoom['config']['gallerySlideNaviMargin'] = 5;
	$zoom['config']['mapButTitle']['slideNext'] = ""; 
	$zoom['config']['mapButTitle']['slidePrev'] = ""; 
	$zoom['config']['icons']['slideNext'] = array('file'=>'zoombutton_big_next', 'ext'=>'png', 'w'=>42, 'h'=>84);
	$zoom['config']['icons']['slidePrev'] = array('file'=>'zoombutton_big_prev', 'ext'=>'png', 'w'=>42, 'h'=>84);	
	
	$zoom['config']['fullScreenCornerButtonMouseOver'] = true;
	$zoom['config']['icons']['fullScreenCornerInit'] = array('file'=>'zoombutton_fsc1_init', 'ext'=>'png', 'w'=>42, 'h'=>42);
	$zoom['config']['icons']['fullScreenCornerRestore'] = array('file'=>'zoombutton_fsc1_restore', 'ext'=>'png', 'w'=>42, 'h'=>42);
	$zoom['config']['mapButTitle']['fullScreenCornerInit'] = ""; 
	$zoom['config']['mapButTitle']['fullScreenCornerRestore'] = ""; 
	
	$zoom['config']['mNavi']['enabled'] = false;
	$zoom['config']['mNavi']['ellementRows'] = 1;
	$zoom['config']['mNavi']['offsetVertFS'] = 10;
	$zoom['config']['mNavi']['fullScreenShow'] = true;
	$zoom['config']['mNavi']['gravity'] = 'bottomLeft';
	$zoom['config']['mNavi']['mouseOver'] = false;
	$zoom['config']['mNavi']['cssClass'] = '';
	$zoom['config']['mNavi']['order'] = array();
	$zoom['config']['mNavi']['orderDefault'] = array();
	
	if (isset($_GET['3dDir'])){	
		$zoom['config']['dragToSpin']['enabled'] = true;
			
		$zoom['config']['spinSlider'] = false;
		
		$zoom['config']['mNavi']['enabled'] = true;
		$zoom['config']['mNavi']['order'] = array(
			'mPan' => 5, 
			'mSpin' => 0
		);
		
		$zoom['config']['spinPreloaderSettings']['text'] = ' ';
		$zoom['config']['spinPreloaderSettings']['width'] = '100%'; 
		$zoom['config']['spinPreloaderSettings']['height'] = 7;
		$zoom['config']['spinPreloaderSettings']['gravity'] = 'bottom'; 
		$zoom['config']['spinPreloaderSettings']['gravityMargin'] = 0; 
		$zoom['config']['spinPreloaderSettings']['borderW'] = 0; 
		$zoom['config']['spinPreloaderSettings']['margin'] = 5;
		$zoom['config']['spinPreloaderSettings']['countMsg'] = false; 
		$zoom['config']['spinPreloaderSettings']['statusMsg'] = false; 
		$zoom['config']['spinPreloaderSettings']['barH'] = 7; 
		$zoom['config']['spinPreloaderSettings']['barOpacity'] = 1; 
	}
	
	// 4.2.1
	if (isset($_GET['disableScrollAnm']) && $_GET['disableScrollAnm'] == 'true'){
 		$zoom['config']['scrollAnm'] = false;
		$zoom['config']['scrollZoom'] = 11;
		$zoom['config']['scrollAjax'] = 200;
		$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
		$zoom['config']['pyrTilesFadeLoad'] = 300;
	}
}

elseif ($_GET['example'] == 'imageSlider'){
	$zoom['config']['picDim'] = '800x400';
	$zoom['config']['useGallery'] = false;
	
	$zoom['config']['mNavi']['enabled'] = false;
	
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['galleryFullPicDim'] = "170x100";
	$zoom['config']['galFullCssMargin'] = 7;
	$zoom['config']['galFullCssPadding'] = 7;
	if (isset($_GET['autoPlay']) && $_GET['autoPlay'] == 'true'){
		$zoom['config']['galleryAutoPlay'] = true;
	}
	
	if (isset($_GET['playPauseInterval']) && intval($_GET['playPauseInterval'])){
		$zoom['config']['galleryPlayInterval'] = intval($_GET['playPauseInterval']);
	}
	$zoom['config']['fullScreenEnable'] = false;
	
	if (isset($_GET['fullScreen']) && $_GET['fullScreen'] != 'false'){
		$zoom['config']['fullScreenEnable'] = true;
		$zoom['config']['fullScreenCornerButton'] = true;
		$zoom['config']['fullScreenCornerButtonPos'] = $_GET['fullScreen']; 
	}
	
	if (isset($_GET['openAsFullscreen']) && $_GET['openAsFullscreen'] == 'true'){
		$zoom['config']['fullScreenEnable'] = true;
		$zoom['config']['fullScreenExitText'] = false;
		$zoom['config']['fullScreenCornerButton'] = false;
	}
	
	$zoom['config']['help'] = false;
	$zoom['config']['zoomLoaderEnable'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['galleryFadeInAnm'] = 'SwipeHorz';
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
	
	// zoomSlider
	$zoom['config']['zoomSliderContainerPadding'] = 10;
	if (isset($_GET['zoomSliderPos']) && $_GET['zoomSliderPos'] != 'false'){
		$zoom['config']['zoomSlider'] = true;
	}
	
	// Prev/Next arrows
	$zoom['config']['gallerySlideNavi'] = isset($_GET['prevNextArrows']) && $_GET['prevNextArrows'] == 'true' ? true : false;
	$zoom['config']['gallerySlideNaviMouseOver'] = isset($_GET['prevNextArrowsAutoHide']) && $_GET['prevNextArrowsAutoHide'] == 'true' ? true : false;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = false;
}

elseif ($_GET['example'] == 'mouseOverExtension360'){ // 4.2.5
	$zoom['config']['picDim'] = '375x375';
	
	$zoom['config']['stepPicDim'] = array(
		1 => array('w' => 600, 'h' => 600, 'q' => 80),
		2 => array('w' => 900, 'h' => 900, 'q' => 70)
	);
	
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;

	$zoom['config']['fullScreenCornerButtonPos'] = 'bottomRight';
	$zoom['config']['fullScreenCornerButtonMarginX'] = 0; // int
	$zoom['config']['fullScreenCornerButtonMarginY'] = 0; // int
	$zoom['config']['icons']['fullScreenCornerInit'] = array('file'=>'zoombutton_fsc2_init', 'ext'=>'png', 'w'=>50, 'h'=>50);
	$zoom['config']['icons']['fullScreenCornerRestore'] = array('file'=>'zoombutton_fsc2_restore', 'ext'=>'png', 'w'=>50, 'h'=>50);
	
	$zoom['config']['useMap'] = false;
	$zoom['config']['dragMap'] = false;
	
	// disable all galleries
	$zoom['config']['useGallery'] = false;
	$zoom['config']['fullScreenVertGallery'] = false;
	$zoom['config']['useHorGallery'] = false; 
	$zoom['config']['fullScreenHorzGallery'] = false;
	$zoom['config']['useFullGallery'] = false;
	
	$zoom['config']['galleryFadeInSize'] = 1.0;
	$zoom['config']['speedOptSet'] = true;
	 
	$zoom['config']['mNavi']['enabled'] = false;
	$zoom['config']['spinMod'] = true;
	$zoom['config']['firstMod'] = 'spin';
	
	$zoom['config']['spinSlider'] = false;
	
	$zoom['config']['gallerySlideNavi'] = false;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
	$zoom['config']['icons']['slideNext'] = array('file'=>'zoombutton_big_next', 'ext'=>'png', 'w'=>42, 'h'=>84);
	$zoom['config']['icons']['slidePrev'] = array('file'=>'zoombutton_big_prev', 'ext'=>'png', 'w'=>42, 'h'=>84);	
	
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	
	$zoom['config']['dragToSpin']['enabled'] = true;
	
	$zoom['config']['spinPreloaderSettings']['text'] = ' ';
	$zoom['config']['spinPreloaderSettings']['width'] = '100%'; 
	$zoom['config']['spinPreloaderSettings']['height'] = 7; 
	$zoom['config']['spinPreloaderSettings']['gravity'] = 'bottom'; 
	$zoom['config']['spinPreloaderSettings']['gravityMargin'] = 0; 
	$zoom['config']['spinPreloaderSettings']['borderW'] = 0;
	$zoom['config']['spinPreloaderSettings']['margin'] = 5; 
	$zoom['config']['spinPreloaderSettings']['countMsg'] = false; 
	$zoom['config']['spinPreloaderSettings']['statusMsg'] = false; 
	$zoom['config']['spinPreloaderSettings']['barH'] = 7; 
	$zoom['config']['spinPreloaderSettings']['barOpacity'] = 1; 
	
	$zoom['config']['mNavi']['enabled'] = false;
	$zoom['config']['mNavi']['offsetHorz'] = 5;
	$zoom['config']['mNavi']['offsetVert'] = 5;
	$zoom['config']['mNavi']['offsetVertFS'] = 5;
	$zoom['config']['mNavi']['offsetHorzFS'] = 5;
	$zoom['config']['mNavi']['fullScreenShow'] = true;
	$zoom['config']['mNavi']['onlyFullScreen'] = true;
	$zoom['config']['mNavi']['gravity'] = 'bottom';
	$zoom['config']['mNavi']['mouseOver'] = true;
	$zoom['config']['mNavi']['cssClass'] = '';
	$zoom['config']['mNavi']['cssClassFS'] = '';
	$zoom['config']['mNavi']['gravity'] = 'bottomLeft';
	$zoom['config']['mNavi']['order'] = array(
		'mPan' => 5, 
		'mSpin' => 5
	);
	
	$zoom['config']['forceToPan'] = false; 
	$zoom['config']['galleryNoThumbs'] = true; 
	
	if (isset($_GET['disableScrollAnm']) && $_GET['disableScrollAnm'] == 'true'){
 		$zoom['config']['scrollAnm'] = false;
		$zoom['config']['scrollZoom'] = 11;
		$zoom['config']['scrollAjax'] = 200;
		$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
		$zoom['config']['pyrTilesFadeLoad'] = 300;
	}
	
	$zoom['config']['buttonSet'] = 'flat'; 
	
	$zoom['config']['spinCirclePreloader'] = array(
		'enabled' => true, // if spinCirclePreloader is enabled the horizontal preloader bar indicator is instatly disabled;
		'diameter' => '25%', // diameter of the preloader, integer if you want fixed px size
		'stroke' => 3, // width of the progressive status line around the preloader, css: .axZm_circlePreloader_barCircle (color change there too)
		'rotate' => 0, // rotate progressive preloader line, e.g. 90 will start at 3 o'clock
		'prc' => false, // show percentage value over or instead img, css: .axZm_circlePreloader_prc
		'prcFontSize' => 0.3, // float: font size relative to diameter or string, e.g. 0.3 which is 30%, or just '20px' for a fixed value, css: .axZm_circlePreloader_prc
		'img' => true, // show image which is preloading inside this round preloader; instantly disables spinWhilePreload option
		'imgCover' => false, // if false it will "contain" - simmilar to css3 background-size properties contain and cover
		'countMsg' => false, // display counter message (Loading frrames m / n) under the circle
		'statusMsg' => false, // display status message, e.g. "Preloading image" or other depending on what AZ is doing
		'autoStatus' => true, // if it is not only "Preloading image" but "Making tiles" or other and statusMsg is disabled, then statusMsg is instantly enabled!
		'text' => array('en' => 'Loading frames', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
		'L1' => array('en' => 'Preloading image', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
		'L2' => array('en' => 'Making pyramid', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
		'L3' => array('en' => 'Making tiles', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
		'L4' => array('en' => 'Making first image', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => ''),
		'L5' => array('en' => 'and first image', 'de' => '', 'fr' => '', 'es' => '', 'it' => '', 'pt' => '', 'ru' => '', 'cn'=>'', 'jp' => '')
	);
}

elseif ($_GET['example'] == 'mouseOverExtension'){ 
	$zoom['config']['picDim'] = '800x800';
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['mapSelSmoothDrag'] = false;	
	$zoom['config']['galHorMarginBottom'] = 0;
	$zoom['config']['galHorFlow'] = true;
	$zoom['config']['galHorArrows'] = false;
	$zoom['config']['useFullGallery'] = false;
	
	$zoom['config']['useGallery'] = true; 
	$zoom['config']['fullScreenVertGallery'] = false;
	$zoom['config']['galleryPicDim'] = '120x120'; 
	$zoom['config']['galleryScrollbarWidth'] = 10;

	$zoom['config']['galleryThumbDesc'] = create_function('$pic_list_data, $k', 'return "&#160;";');
	$zoom['config']['galleryThumbFullDesc'] = create_function('$pic_list_data, $k', 'return false;');
	
	$zoom['config']['fullScreenCornerButtonPos'] = 'bottomRight';
	$zoom['config']['fullScreenCornerButtonMarginX'] = 0; // int
	$zoom['config']['fullScreenCornerButtonMarginY'] = 0; // int
	$zoom['config']['icons']['fullScreenCornerInit'] = array('file'=>'zoombutton_fsc2_init', 'ext'=>'png', 'w'=>50, 'h'=>50);
	$zoom['config']['icons']['fullScreenCornerRestore'] = array('file'=>'zoombutton_fsc2_restore', 'ext'=>'png', 'w'=>50, 'h'=>50);
		
	$zoom['config']['gallerySlideNavi'] = true;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
	$zoom['config']['icons']['slideNext'] = array('file'=>'zoombutton_big_next', 'ext'=>'png', 'w'=>42, 'h'=>84);
	$zoom['config']['icons']['slidePrev'] = array('file'=>'zoombutton_big_prev', 'ext'=>'png', 'w'=>42, 'h'=>84);	
	
	// disable vertical gallery for low screen resolutions
	if (isset($_GET['screenW']) && intval($_GET['screenW']) < 800){
		$zoom['config']['useGallery'] = false;
		$zoom['config']['fullScreenVertGallery'] = false;
	}
	
	// disable vertical gallery if there is only one image
	if (count(explode('|', $_GET['zoomData'])) < 2){
		$zoom['config']['useGallery'] = false;
	}

	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = false;
	$zoom['config']['dragMap'] = false; 	
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['galleryFadeInOpacity'] = 0.0;
	$zoom['config']['galleryFadeInAnm'] = 'Center';
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['fullScreenMapFract'] = false;
	$zoom['config']['fullScreenMapWidth'] = false;
	$zoom['config']['fullScreenMapHeight'] = 120;
	$zoom['config']['galleryNavi'] = false;

	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['speedOptSet'] = true;
	
	$zoom['config']['mNavi']['enabled'] = true;
	$zoom['config']['mNavi']['offsetHorz'] = 5;
	$zoom['config']['mNavi']['offsetVert'] = 5;
	$zoom['config']['mNavi']['offsetVertFS'] = 5;
	$zoom['config']['mNavi']['offsetHorzFS'] = 5;
	$zoom['config']['mNavi']['fullScreenShow'] = true;
	$zoom['config']['mNavi']['gravity'] = 'bottom';
	$zoom['config']['mNavi']['mouseOver'] = true;
	$zoom['config']['mNavi']['cssClass'] = '';
	$zoom['config']['mNavi']['cssClassFS'] = '';
	$zoom['config']['mNavi']['gravity'] = 'bottomLeft';
	$zoom['config']['mNavi']['order'] = array(
		'mZoomIn' => 5, 
		'mZoomOut' => 0
	);	
	
	if (isset($_GET['3dDir'])){
		$zoom['config']['dragToSpin']['enabled'] = true;
		
		$zoom['config']['useGallery'] = false;
		$zoom['config']['fullScreenVertGallery'] = false;
		$zoom['config']['useHorGallery'] = false; 
		$zoom['config']['fullScreenHorzGallery'] = false;
		$zoom['config']['useFullGallery'] = false;
		
		$zoom['config']['spinSlider'] = false;
		
		$zoom['config']['mNavi']['order'] = array(
			'mPan' => 5, 
			'mSpin' => 0
		);
		
		$zoom['config']['spinPreloaderSettings']['text'] = ' ';
		$zoom['config']['spinPreloaderSettings']['width'] = '100%'; 
		$zoom['config']['spinPreloaderSettings']['height'] = 7; 
		$zoom['config']['spinPreloaderSettings']['gravity'] = 'bottom'; 
		$zoom['config']['spinPreloaderSettings']['gravityMargin'] = 0; 
		$zoom['config']['spinPreloaderSettings']['borderW'] = 0; 
		$zoom['config']['spinPreloaderSettings']['margin'] = 5; 
		$zoom['config']['spinPreloaderSettings']['countMsg'] = false; 
		$zoom['config']['spinPreloaderSettings']['statusMsg'] = false; 
		$zoom['config']['spinPreloaderSettings']['barH'] = 7; 
		$zoom['config']['spinPreloaderSettings']['barOpacity'] = 1; 
	}
	
	if (isset($_GET['disableScrollAnm']) && $_GET['disableScrollAnm'] == 'true'){
 		$zoom['config']['scrollAnm'] = false;
		$zoom['config']['scrollZoom'] = 11;
		$zoom['config']['scrollAjax'] = 200;
		$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
		$zoom['config']['pyrTilesFadeLoad'] = 300;
	}
	
	$zoom['config']['buttonSet'] = 'flat'; 
}

elseif ($_GET['example'] == 'hotSpotEdit'){
	$zoom['config']['picDim'] = "720x480";
	$zoom['config']['galFullButton'] = false;
	$zoom['config']['naviFloat'] = 'right';
	$zoom['config']['galleryPicDim'] = '80x80';
	$zoom['config']['galleryNavi'] = false; 
	$zoom['config']['useGallery'] = false;
	
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['helpMargin'] = 0;
	$zoom['config']['help'] = false;
	$zoom['config']['mapButton'] = true;

	if (!isset($_GET['zoomData'])){
		$zoom['config']['spinMod'] = true;
		$zoom['config']['firstMod'] = 'spin';
	}
	
	$zoom['config']['galleryNoThumbs'] = true;
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['spinSlider'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['fullScreenApi'] = false;
	
	$zoom['config']['mNavi']['enabled'] = true;
	$zoom['config']['mNavi']['gravity'] = 'bottom';
	$zoom['config']['mNavi']['alignment'] = 'horz';
	$zoom['config']['mNavi']['padding'] = 5;
	$zoom['config']['mNavi']['offsetHorz'] = 0;
	$zoom['config']['mNavi']['offsetVert'] = -10;
	$zoom['config']['mNavi']['offsetVertFS'] = 10;
	$zoom['config']['mNavi']['hover'] = true;
	$zoom['config']['mNavi']['parentID'] = 'testCustomNavi';
	$zoom['config']['mNavi']['order'] = array( 
		'mPan' => 5, 
		'mSpin' => 5, 
		'mCrop' => 25, 
		'mZoomOut' => 5, 
		'mZoomIn' => 25, 
		'mReset' => 25, 
		'mSpinPlay' => 5, 
		'mPrev' => 5, 
		'mNext' => 25, 
		'mHotspots' => 5, 
		'mMap' => 0
	);
	
	if (isset($zoom['config']['touchSettings']['mNavi'])){
		$zoom['config']['touchSettings']['mNavi']['enabled'] = true;
	}
	
	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 11;
	$zoom['config']['scrollAjax'] = 200;
	$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
	$zoom['config']['pyrTilesFadeLoad'] = 300; 
}

// example34.php
elseif ($_GET['example'] == 'ocr'){
	$zoom['config']['picDim'] = '800x600';
	$zoom['config']['pyrQual'] = 85;

	$zoom['config']['gallerySlideNavi'] = true;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
	
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['mapSelSmoothDrag'] = false;	
	$zoom['config']['galHorMarginBottom'] = 0;
	$zoom['config']['galHorFlow'] = true;
	$zoom['config']['galHorArrows'] = false;
	$zoom['config']['useGallery'] = true;
	$zoom['config']['galleryPicDim'] = '86x120'; 
	
	$zoom['config']['useFullGallery'] = true;
	$zoom['config']['galleryFullPicDim'] = '224x312';
	$zoom['config']['galFullAutoStart'] = false;
	
	$zoom['config']['galleryScrollbarWidth'] = 10;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = false;
	$zoom['config']['dragMap'] = false; 	
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['mapOpacity'] = 0.75; 
	
	$zoom['config']['zoomMapVis'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	$zoom['config']['galleryFadeInSize'] = 1;
	
	$zoom['config']['galleryCssPadding'] = 2; 
	$zoom['config']['galleryFadeInSpeed'] = 300;
	$zoom['config']['galleryFadeInOpacity'] = 0.0;
	$zoom['config']['galleryFadeInAnm'] = 'Center';
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['fullScreenMapFract'] = false;
	$zoom['config']['fullScreenMapWidth'] = false;
	$zoom['config']['fullScreenMapHeight'] = 120;
	$zoom['config']['fullScreenNaviBar'] = false;
	$zoom['config']['galleryNavi'] = false;
	
	// toolbar
	$zoom['config']['mNavi']['enabled'] = true;
	$zoom['config']['mNavi']['gravity'] = 'bottom';
	$zoom['config']['mNavi']['setParentWidth'] = true;
	$zoom['config']['mNavi']['setParentHeight'] = false;
	
	$zoom['config']['mNavi']['offsetVertFS'] = 10;
	$zoom['config']['mNavi']['fullScreenShow'] = true;
	$zoom['config']['mNavi']['gravity'] = 'bottom';
	$zoom['config']['mNavi']['mouseOver'] = true;
	$zoom['config']['mNavi']['parentID'] = 'mNaviParentContainer';
	$zoom['config']['mNavi']['alt']['enabled'] = false;
	$zoom['config']['mNavi']['buttonDescr'] = true;
	
	$zoom['config']['mNavi']['order'] = array(
		'mZoomIn' => 3, 
		'mZoomOut' => 10,
		'mCrop' => 3,
		'mPan' => 10,
		'mHotspots' => 3,
		'mMap' => 3,
		'mGallery' => 10,
		'mReset' => 0
	);	
	
	
	$zoom['config']['gallerySlideNavi'] = true;
	$zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
	$zoom['config']['gallerySlideNaviMouseOver'] = true;
	$zoom['config']['gallerySlideSwipeSpeed'] = 300;
	$zoom['config']['gallerySlideNaviAnm'] = 'SwipeHorz';
	
	$zoom['config']['speedOptSet'] = true;
	
	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 11;
	$zoom['config']['scrollAjax'] = 200;
	$zoom['config']['zoomSpeed'] = 400;
	$zoom['config']['zoomOutSpeed'] = 400;
}

// example35.php
elseif ($_GET['example'] == 'imageCrop'){
	$zoom['config']['picDim'] = "720x480";
	$zoom['config']['useGallery'] = false;
	
	$zoom['config']['dragMap'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false;
	
	$zoom['config']['mapBorder']['top'] = 1; 
	$zoom['config']['mapBorder']['right'] = 1; 
	$zoom['config']['mapBorder']['bottom'] = 1; 
	$zoom['config']['mapBorder']['left'] = 1; 
	$zoom['config']['mapFract'] = 0.2;	
	$zoom['config']['fullScreenMapFract'] = 0.12; 
	$zoom['config']['mapOpacity'] = 0.5;
 
	$zoom['config']['fullScreenMapWidth'] = 200; 
	$zoom['config']['fullScreenMapHeight'] = 200; 
	$zoom['config']['mapWidth'] = 100;
	$zoom['config']['mapHeight'] = 100;

	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 0;
	
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
	
	$zoom['config']['gallerySlideNavi'] = false;
	
	$zoom['config']['speedOptSet'] = true;
	
	// 360 settings
	if (isset($_GET['3dDir'])){
		$zoom['config']['spinMod'] = true;
		$zoom['config']['firstMod'] = 'spin';
		$zoom['config']['spinSlider'] = true;
		
		$zoom['config']['useFullGallery'] = false;
	}else{
		$zoom['config']['useFullGallery'] = true;
	}
 	
 	// No scroll animation
 	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 11;
	$zoom['config']['scrollAjax'] = 200;
	$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
	$zoom['config']['pyrTilesFadeLoad'] = 300;
}

elseif ($_GET['example'] == 'tagging'){ // 4.2.1
	$zoom['config']['picDim'] = '720x480';
	$zoom['config']['useGallery'] = false;
	$zoom['config']['useMap'] = false;
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = true;
	$zoom['config']['displayNavi'] = false;
	$zoom['config']['fullScreenNaviBar'] = false;
	
 	$zoom['config']['scrollAnm'] = false;
	$zoom['config']['scrollZoom'] = 11;
	$zoom['config']['scrollAjax'] = 200;
	$zoom['config']['pyrTilesFadeInSpeed'] = 300; 
	$zoom['config']['pyrTilesFadeLoad'] = 300;
}

elseif ($_GET['example'] == 'colorSwatch'){ // 4.2.13
    $zoom['config']['picDim'] = '600x600';
    
    $zoom['config']['stepPicDim'] = array(
        1 => array('w' => 900, 'h' => 900, 'q' => 70)
    );
    
    $zoom['config']['displayNavi'] = false;
    $zoom['config']['fullScreenNaviBar'] = false;

    $zoom['config']['fullScreenCornerButtonPos'] = 'bottomRight';
    $zoom['config']['fullScreenCornerButtonMarginX'] = 0; // int
    $zoom['config']['fullScreenCornerButtonMarginY'] = 0; // int
    $zoom['config']['icons']['fullScreenCornerInit'] = array('file'=>'zoombutton_fsc2_init', 'ext'=>'png', 'w'=>50, 'h'=>50);
    $zoom['config']['icons']['fullScreenCornerRestore'] = array('file'=>'zoombutton_fsc2_restore', 'ext'=>'png', 'w'=>50, 'h'=>50);
    
    $zoom['config']['useMap'] = false;
    $zoom['config']['dragMap'] = false;
    
    // disable all galleries
    $zoom['config']['useGallery'] = false;
    $zoom['config']['fullScreenVertGallery'] = false;
    $zoom['config']['useHorGallery'] = false; 
    $zoom['config']['fullScreenHorzGallery'] = false;
    $zoom['config']['useFullGallery'] = false;
    
    $zoom['config']['galleryFadeInSize'] = 1.0;
    $zoom['config']['speedOptSet'] = true;
     
    $zoom['config']['mNavi']['enabled'] = false;
    $zoom['config']['spinMod'] = true;
    $zoom['config']['firstMod'] = 'spin';
    
    $zoom['config']['spinSlider'] = false;
    
    $zoom['config']['gallerySlideNavi'] = false;
    $zoom['config']['gallerySlideNaviOnlyFullScreen'] = true;
    $zoom['config']['icons']['slideNext'] = array('file'=>'zoombutton_big_next', 'ext'=>'png', 'w'=>42, 'h'=>84);
    $zoom['config']['icons']['slidePrev'] = array('file'=>'zoombutton_big_prev', 'ext'=>'png', 'w'=>42, 'h'=>84);    
    
    $zoom['config']['cornerRadius'] = 0;
    $zoom['config']['innerMargin'] = 0;
    
    $zoom['config']['dragToSpin']['enabled'] = true;
    
    $zoom['config']['spinPreloaderSettings']['text'] = ' ';
    $zoom['config']['spinPreloaderSettings']['width'] = '100%'; 
    $zoom['config']['spinPreloaderSettings']['height'] = 7; 
    $zoom['config']['spinPreloaderSettings']['gravity'] = 'bottom'; 
    $zoom['config']['spinPreloaderSettings']['gravityMargin'] = 0; 
    $zoom['config']['spinPreloaderSettings']['borderW'] = 0;
    $zoom['config']['spinPreloaderSettings']['margin'] = 5; 
    $zoom['config']['spinPreloaderSettings']['countMsg'] = false; 
    $zoom['config']['spinPreloaderSettings']['statusMsg'] = false; 
    $zoom['config']['spinPreloaderSettings']['barH'] = 7; 
    $zoom['config']['spinPreloaderSettings']['barOpacity'] = 1; 
    
    $zoom['config']['mNavi']['enabled'] = false;
    $zoom['config']['mNavi']['offsetHorz'] = 5;
    $zoom['config']['mNavi']['offsetVert'] = 5;
    $zoom['config']['mNavi']['offsetVertFS'] = 5;
    $zoom['config']['mNavi']['offsetHorzFS'] = 5;
    $zoom['config']['mNavi']['fullScreenShow'] = true;
    $zoom['config']['mNavi']['onlyFullScreen'] = true;
    $zoom['config']['mNavi']['gravity'] = 'bottom';
    $zoom['config']['mNavi']['mouseOver'] = true;
    $zoom['config']['mNavi']['cssClass'] = '';
    $zoom['config']['mNavi']['cssClassFS'] = '';
    $zoom['config']['mNavi']['gravity'] = 'bottomLeft';
    $zoom['config']['mNavi']['order'] = array(
        'mPan' => 5, 
        'mSpin' => 5
    );    
    
    $zoom['config']['forceToPan'] = false; 
    $zoom['config']['galleryNoThumbs'] = true; 
    
    $zoom['config']['scrollSpeed'] = 250;
    $zoom['config']['scrollZoom'] = 25;
    $zoom['config']['scrollAjax'] = $zoom['config']['scrollSpeed'] + 200;
    $zoom['config']['zoomSpeed'] = 250;
    $zoom['config']['zoomOutSpeed'] = 250; 
    $zoom['config']['cropSpeed'] = 250; 
    $zoom['config']['zoomSpeedGlobal'] = 250;
    $zoom['config']['restoreSpeed'] = 250;
    $zoom['config']['buttonAjax'] = 750;
    
    $zoom['config']['buttonSet'] = 'flat'; 
    
    $zoom['config']['spinCirclePreloader']['enabled'] = true;
}




#################################################################################################################
##################################### CMS & WEBSHOP MODULES / PLUGINS ###########################################
#################################################################################################################


// Magento implementation, see mods/magento/readme_manual.txt
// The following configuration parameters are overrides of the above.
// You can change or add any parameter.
elseif ($_GET['example'] == 'magento'){
	$zoom['config']['picDim'] = "780x450"; 
	$zoom['config']['jsUiAll'] = true;
	$zoom['config']['pic'] = $zoom['config']['installPath'].'/media/catalog/product/';
    $zoom['config']['thumbs'] = '/axZm/pic/zoomthumb/';
	$zoom['config']['gallery'] = '/axZm/pic/zoomgallery/';
    $zoom['config']['temp'] = '/axZm/pic/temp/';
	$zoom['config']['pyrTilesPath'] = '/axZm/pic/zoomtiles/';
	$zoom['config']['icon'] = '/axZm/icons/'; 
	$zoom['config']['js'] = '/axZm/'; 
	$zoom['config']['fontPath'] = '/axZm/fonts/';
	$zoom['config']['tempCache'] = "/axZm/cache/";
	$zoom['config']['mapPath'] = '/axZm/pic/zoommap/';
	
	$zoom['config']['galleryNavi'] = true;
	$zoom['config']['useFullGallery'] = false; 
	$zoom['config']['galleryPicDim'] = '100x100';
	$zoom['config']['galleryMarginLeft'] = 5; 
	$zoom['config']['galleryCssPadding'] = 5; 
	$zoom['config']['galleryCssBorderWidth'] = 1; 
	$zoom['config']['galleryCssDescrHeight'] = 1; 
	$zoom['config']['galleryCssDescrPadding'] = 2; 
	$zoom['config']['galleryCssMargin'] = 6; 
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['mapSelSmoothDrag'] = false;
	$zoom['config']['help'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false; 
	$zoom['config']['galleryThumbOverOpaque'] = 1;  
	$zoom['config']['galleryThumbOutOpaque'] = 1;  
	
	// Settings for 360 spin
	if (isset($_GET['3dDir'])){
		$zoom['config']['picDim'] = "740x430"; 
		$zoom['config']['galFullButton'] = false;
		$zoom['config']['naviFloat'] = 'right';
		$zoom['config']['galleryNavi'] = false; 
		$zoom['config']['useGallery'] = false;
		$zoom['config']['helpMargin'] = 0;
		$zoom['config']['help'] = false;
		$zoom['config']['mapButton'] = true;
		$zoom['config']['spinMod'] = true;
		$zoom['config']['galleryNoThumbs'] = true;
		$zoom['config']['firstMod'] = 'spin';
		$zoom['config']['zoomSlider'] = true;		
	} 
	
	// Width and Height if embedded, it is set in media.phtml
	if (isset($_GET['embedWidth']) && isset($_GET['embedHeight'])){
		$_GET['embedWidth'] = intval($_GET['embedWidth']);
		$_GET['embedHeight'] = intval($_GET['embedHeight']);
		$zoom['config']['picDim'] = ($_GET['embedWidth']-$zoom['config']['innerMargin']*2).'x'.($_GET['embedHeight']-$zoom['config']['innerMargin']*2);
		$zoom['config']['useGallery'] = false;
		
		$zoom['config']['zoomMapSwitchSpeed'] = 1; 
		$zoom['config']['galleryInnerFade'] = true;
		$zoom['config']['galleryFadeInSize'] = 1;
		$zoom['config']['galleryFadeInSpeed'] = 1;
		$zoom['config']['galleryFadeOutSpeed'] = 1;
	}
	
	// Different display modi, it is set in media.phtml
	if (isset($_GET['displayModus'])){
		if ($_GET['displayModus'] == 'left'){
			if (!isset($_GET['3dDir'])){
				$zoom['config']['naviPanButSwitch'] = false; 
			}
			$zoom['config']['zoomLogInfoDisabled'] = true;
			$zoom['config']['naviPanBut'] = false;
			$zoom['config']['naviBigZoom'] = true;
			$zoom['config']['naviCropButSwitch'] = false; 
			
			//$zoom['config']['galleryNavi'] = true; 
			$zoom['config']['galleryPlayButton'] = false;
		} 
		elseif ($_GET['displayModus'] == 'flyout'){
			
			if (isset($_GET['mapWidth']) && isset($_GET['mapHeight'])){
				$zoom['config']['mapWidth'] = intval($_GET['mapWidth']);
				$zoom['config']['mapHeight'] = intval($_GET['mapHeight']);
	 		}
			
			if (isset($_GET['flyoutWidth']) && isset($_GET['flyoutHeight'])){
			
				$_GET['flyoutWidth'] = intval($_GET['flyoutWidth']);
				$_GET['flyoutHeight'] = intval($_GET['flyoutHeight']);
				if ($_GET['flyoutWidth']  > 800){$_GET['flyoutWidth']  = 800;}
				if ($_GET['flyoutHeight'] > 800){$_GET['flyoutHeight'] = 800;}
 
				$zoom['config']['picDim'] = $_GET['flyoutWidth'].'x'.$_GET['flyoutHeight'];
			}
			
			$zoom['config']['useGallery'] = false;
			$zoom['config']['displayNavi'] = false;
			$zoom['config']['fullScreenNaviBar'] = true;
			$zoom['config']['naviPanBut'] = false;
			$zoom['config']['naviPanButSwitch'] = false;
			$zoom['config']['naviCropButSwitch'] = false; 
			$zoom['config']['mapButton'] = false;
			$zoom['config']['mapParent'] = 'mapContainer';
			$zoom['config']['mapFract'] = 0.7;
			$zoom['config']['restoreSpeed'] = 1;
			$zoom['config']['zoomMapSwitchSpeed'] = 1; 
			$zoom['config']['galleryInnerFade'] = false;
			$zoom['config']['galleryFadeInSpeed'] = 1;
			$zoom['config']['galleryFadeOutSpeed'] = 1;
			$zoom['config']['pZoom'] = 25;
			$zoom['config']['pZoomOut'] = 25;
			$zoom['config']['mapSelSmoothDrag'] = false;
			$zoom['config']['autoZoom']['enabled'] = true; 
			$zoom['config']['autoZoom']['onlyFirst'] = false; 
			$zoom['config']['autoZoom']['speed'] = 1; 
			$zoom['config']['autoZoom']['motion'] = 'swing'; 
			$zoom['config']['autoZoom']['pZoom'] = 'max'; 
			$zoom['config']['zoomMapRest'] = false;
			$zoom['config']['zoomMapContainment'] = false;
			$zoom['config']['dragMap'] = false;
			$zoom['config']['mapBorder']['top'] = 0; 
			$zoom['config']['mapBorder']['right'] = 0; 
			$zoom['config']['mapBorder']['bottom'] = 0; 
			$zoom['config']['mapBorder']['left'] = 0; 
			$zoom['config']['zoomMapAnimate'] = false;
			$zoom['config']['zoomMapVis'] = true;
			$zoom['config']['cornerRadius'] = 0;
			$zoom['config']['innerMargin'] = 0;
			$zoom['config']['mapMouseOver'] = true;
		}
	}
	
	// Remove toolbar etc for "TouchStyle" option, it is set in media.phtml
	if (isset($_GET['zoomTouchStyle']) && $_GET['zoomTouchStyle'] == 'yes'){
		$zoom['config']['cornerRadius'] = 0;
		$zoom['config']['innerMargin'] = 0;
		
		$zoom['config']['spinSlider'] = false;
		$zoom['config']['displayNavi'] = false;
		$zoom['config']['fullScreenNaviBar'] = false;
		
		if (isset($_GET['displayModus'])){
			if ($_GET['displayModus'] == 'embedded' || $_GET['displayModus'] == 'left'){
				$zoom['config']['galleryNavi'] = true;
			}else{
				$zoom['config']['galleryNavi'] = false;
			}
		}else{
			$zoom['config']['galleryNavi'] = false;
		}
		
		
		$zoom['config']['mapBorder']['top'] = 1; 
		$zoom['config']['mapBorder']['right'] = 1; 
		$zoom['config']['mapBorder']['bottom'] = 1; 
		$zoom['config']['mapBorder']['left'] = 1; 
		
		
		$zoom['config']['mNavi']['enabled'] = true;
		$zoom['config']['mNavi']['ellementRows'] = 1;
		$zoom['config']['mNavi']['offsetVertFS'] = 10;
		$zoom['config']['mNavi']['fullScreenShow'] = true;
		$zoom['config']['mNavi']['gravity'] = 'bottomLeft';
		$zoom['config']['mNavi']['mouseOver'] = false;
		$zoom['config']['mNavi']['cssClass'] = '';
		$zoom['config']['mNavi']['cssClassFS'] = '';
		
		if (!isset($_GET['3dDir'])){
			$zoom['config']['mNavi']['order'] = array(
				'mReset' => 5, 
				'mZoomIn' => 5, 
				'mZoomOut' => 0
			);		
		}else{
			$zoom['config']['mNavi']['order'] = array(
				'mSpin' => 5, 
				'mPan' => 10
			);
		}

	}
}

// xt:Commerce implementation, see mods/xtc/readme_manual.txt
// The following configuration parameters are overrides of the above.
// You can change or add any parameter.
elseif ($_GET['example'] == 'xtc'){
	$zoom['config']['picDim'] = "800x450";
	$zoom['config']['cTimeCompare'] = true;	 
	$zoom['config']['jsUiAll'] = true;
	$zoom['config']['pic'] = $zoom['config']['installPath'];
    $zoom['config']['thumbs'] = '/axZm/pic/zoomthumb/';
	$zoom['config']['gallery'] = '/axZm/pic/zoomgallery/';
    $zoom['config']['temp'] = '/axZm/pic/temp/';
	$zoom['config']['pyrTilesPath'] = '/axZm/pic/zoomtiles/';
	$zoom['config']['icon'] = '/axZm/icons/'; 
	$zoom['config']['js'] = '/axZm/'; 
	$zoom['config']['fontPath'] = '/axZm/fonts/'; 
	$zoom['config']['tempCache'] = "/axZm/cache/";
	$zoom['config']['mapPath'] = '/axZm/pic/zoommap/';
	
	$zoom['config']['galleryNavi'] = true;
	$zoom['config']['useFullGallery'] = false; 
	$zoom['config']['galleryPicDim'] = '100x100';
	$zoom['config']['galleryMarginLeft'] = 5; 
	$zoom['config']['galleryCssPadding'] = 5; 
	$zoom['config']['galleryCssBorderWidth'] = 1; 
	$zoom['config']['galleryCssDescrHeight'] = 1; 
	$zoom['config']['galleryCssDescrPadding'] = 2; 
	$zoom['config']['galleryCssMargin'] = 6; 
	
	$zoom['config']['zoomMapRest'] = false;
	$zoom['config']['zoomMapContainment'] = '#axZm_zoomAll';
	$zoom['config']['mapSelSmoothDrag'] = false;
	
	$zoom['config']['help'] = false;
	$zoom['config']['cornerRadius'] = 0;
	$zoom['config']['innerMargin'] = 1;
	$zoom['config']['dragMap'] = false;
	$zoom['config']['zoomMapAnimate'] = false;
	$zoom['config']['zoomMapVis'] = false; 
	$zoom['config']['galleryThumbOverOpaque'] = 1;  
	$zoom['config']['galleryThumbOutOpaque'] = 1;  
	
	// Settings for 360 spin
	if ($_GET['3dDir']){
		$zoom['config']['picDim'] = "760x430"; 
		$zoom['config']['galFullButton'] = false;
		$zoom['config']['naviFloat'] = 'right';
		$zoom['config']['galleryNavi'] = false; 
		$zoom['config']['useGallery'] = false;
		$zoom['config']['helpMargin'] = 0;
		$zoom['config']['help'] = false;
		$zoom['config']['mapButton'] = true;
		$zoom['config']['spinMod'] = true;
		$zoom['config']['galleryNoThumbs'] = true;
		$zoom['config']['firstMod'] = 'spin';
		$zoom['config']['zoomSlider'] = true;
	} 
}


// Do not set picDim dynamically for responsive layouts!
// Use jQuery.fn.axZm.openFullScreen instead!!!
// http://www.ajax-zoom.com/index.php?cid=docs#api_openFullScreen
// http://www.ajax-zoom.com/index.php?kw=responsive&lang=en
/*
if (isset($_GET['picDim'])){
	// Wordpress plugin
	$picDim = explode('x', $_GET['picDim']);
	$picDim[0] = intval($picDim[0]);
	$picDim[1] = intval($picDim[1]);
	if ($picDim[0] > 800){$picDim[0] = 800;}
	if ($picDim[1] > 800){$picDim[1] = 800;}
	$zoom['config']['picDim'] = $picDim[0].'x'.$picDim[1];
	$zoom['config']['cTimeCompare'] = true;
}
*/
?>