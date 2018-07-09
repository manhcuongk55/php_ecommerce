<link rel="stylesheet" href="../axZm/axZm.css" type="text/css">
<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
<link rel="stylesheet" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" type="text/css" />
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropLoad.js"></script>
<link rel="stylesheet" href="../axZm/extensions/jquery.axZm.expButton.css" type="text/css" />
<script type="text/javascript" src="../axZm/extensions/jquery.axZm.expButton.js"></script>

<div id="playerWrap" style="width: 800x; margin-left: 10px;">
	<div id="playerInnerWrap" style="min-height: 480px;">
		<div id="azPlayer" style="width:800px;">
			<!-- Content inside target will be removed -->
			<div style="padding: 20px">Loading, please wait...</div>
		</div>

		<!-- Thumb slider with croped images -->
		<div id="cropSliderWrap">
			<div id="cropSlider">
				<ul></ul>
			</div>
		</div>	
	</div>
</div>

<script type="text/javascript">
	// Init the slider
	// Thumbs will be appended instantly
	
	jQuery("#cropSlider").axZmThumbSlider({
		orientation: "vertical",
		btnOver: true,
		btnHidden: true,
		btnFwdStyle: {borderRadius: 0, height: 20, bottom: -1, lineHeight: "20px"},
		btnBwdStyle: {borderRadius: 0, height: 20, top: -1, lineHeight: "20px"},	

		thumbLiStyle: {
			height: 90,
			width: 90,
			lineHeight: 90,
			borderRadius: 0,
			margin: 3
		}
	});
	


	// Define callbacks, for complete list check the docs
	ajaxZoom.opt = {
		onLoad: function(){ 
			// Load crop thumbs
			// You can also pass the path over query string, e.g.
			// example35.php?cropJsonURL=../pic/cropJSON/eos_1100d.json 
			// and skip cropJsonURL key in $.axZmImageCropLoad
			$.axZmImageCropLoad({
				cropJsonURL: ajaxZoom.urlJson,
				sliderID: "cropSlider",
				spinToSpeed: "2500", // as string to override spinDemoTime when clicked on the thumbs
				spinToMotion: "easeOutQuint", // optionally pass spinToMotion to override spinToMotion set in config file, def. easeOutQuad
				handleTexts: function(title, description){
					// One of the possible things to do with title and description
					// e.g. display texts with jquery.axZm.expButton.js (AJAX-ZOOM additional plugin)
					$.axZmEb({
						title: title,
						descr: description,
						gravity: "top", // possible values: topLeft, top, topRight, bottomLeft, bottom, bottomRight, center
						marginY: 5,  // vertical margin depending on gravity
						zoomSpinPanRemove: "cropSlider", // removes button / layer when there is some action inside AJAX-ZOOM
						autoOpen: false, // button opens instantly; if no tilte but descr is defined, autoOpen executes instantly
						removeOnClose: false // removes button when extended state is closed
					});
				}
			});
			// Possible motions types: 
			// "swing", "linear", "easeInQuad", "easeOutQuad", "easeInOutQuad", "easeInCubic", "easeOutCubic", "easeInOutCubic", "easeInQuart", 
			// "easeOutQuart","easeInOutQuart", "easeInQuint","easeOutQuint", "easeInOutQuint", "easeInSine", "easeOutSine", "easeInOutSine", 
			// "easeInExpo", "easeOutExpo", "easeInOutExpo", "easeInCirc", "easeOutCirc", "easeInOutCirc", "easeInElastic", "easeOutElastic",
			// "easeInOutElastic", "easeInBack", "easeOutBack", "easeInOutBack", "easeInBounce", "easeOutBounce", "easeInOutBounce"
			
			
			// This would be the code for additionally loading hotspots made e.g. with example33.php
			//jQuery.aZcropEd.getJSONdataFromFile("../pic/cropJSON/eos_1100d.json");
		
			// $("#axZm_zoomLayer").children().last().hide();
		},
		onBeforeStart: function(){
			// Set background color, can also be done in css file
			jQuery(".axZm_zoomContainer").css({backgroundColor: "#FFFFFF"});	
 			
 			if ($.axZm.spinMod){
 				jQuery.axZm.restoreSpeed = 300;
			}else{
				jQuery.axZm.restoreSpeed = 0;
			}
 			
			//jQuery.axZm.fullScreenCornerButton = false;
			jQuery.axZm.fullScreenExitText = false;
			
			// Chnage position of the map
			//jQuery.axZm.mapPos = "bottomLeft";
			
			// Set extra space to the right at fullscreen mode for the crop gallery
			jQuery.axZm.fullScreenSpace = {
				right: $("#cropSlider").outerWidth(),
				top: 0, bottom: 0, left: 0, layout: 1
			};
		},
		onFullScreenSpaceAdded: function(){
			jQuery("#cropSlider")
			.css({bottom: 0,right: 0, height: "100%", zIndex: 555})
			.appendTo("#axZmFsSpaceRight");
		},
		onFullScreenClose: function(){
			jQuery.fn.axZm.tapShow();

			jQuery("#cropSlider")
			.css({bottom: "", right: "", zIndex: ""})
			.appendTo("#cropSliderWrap");
		},
		onFullScreenCloseEndFromRel: function(){
			// Restore position of the slider
			jQuery("#cropSlider")
			.css({bottom: "", right: "", zIndex: ""})
			.appendTo("#cropSliderWrap");
		}
	};
	
	// Load AJAX-ZOOM not responsive
	jQuery.fn.axZm.load({
	    opt: ajaxZoom.opt,
	    path: ajaxZoom.path,
	    postMode: false,
	    apiFullscreen: false,
	    parameter: ajaxZoom.parameter,
	    divID: ajaxZoom.divID
	});
	  
	// Load responsive
	//window.fullScreenStartSplash = {enable: false, className: false, opacity: 0.75};
	//jQuery.fn.axZm.openFullScreen(ajaxZoom.path, ajaxZoom.parameter, ajaxZoom.opt, ajaxZoom.divID, false, false);
 </script>
 