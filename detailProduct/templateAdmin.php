
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<link rel="stylesheet" href="../axZm/axZm.css" type="text/css" media="screen">
	<script type="text/javascript" src="../axZm/jquery.axZm.js"></script>
	<link type="text/css" href="../axZm/plugins/jCrop/css/jquery.Jcrop.css" rel="stylesheet" />
	<script type="text/javascript" src="../axZm/plugins/jCrop/js/jquery.Jcrop.js"></script>
	<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.mousewheel.min.js"></script>
	<link href="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.zIndex.css" type="text/css" media="screen" rel="stylesheet">
	<script type="text/javascript" src="../axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.js"></script>
	<link rel="stylesheet" type="text/css" href="../axZm/extensions/axZmThumbSlider/skins/default/jquery.axZm.thumbSlider.css" />
	<script type="text/javascript" src="../axZm/extensions/axZmThumbSlider/lib/jquery.axZm.thumbSlider.js"></script>
	<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.imageCropEditor.css">
	<script type="text/javascript" src="../axZm/extensions/jquery.axZm.imageCropEditor.js"></script>
	<link rel="stylesheet" type="text/css" href="../axZm/extensions/jquery.axZm.expButton.css">
	<script type="text/javascript" src="../axZm/extensions/jquery.axZm.expButton.js"></script>
	<script type="text/javascript" src="../axZm/plugins/JSON/jquery.json-2.3.min.js"></script>
	<script type="text/javascript" src="../axZm/plugins/js-beautify/beautify-all.min.js"></script>
	<script type="text/javascript" src="../axZm/plugins/jquery.scrollTo.min.js"></script>
	<link href="../axZm/plugins/jquery.ui/themes/ajax-zoom/jquery-ui.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="../axZm/plugins/jquery.ui/js/jquery-ui-1.8.24.custom.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../axZm/plugins/CLEditor/jquery.cleditor.css" />
	<script type="text/javascript" src="../axZm/plugins/CLEditor/jquery.cleditor.min.js"></script>
	<script type="text/javascript" src="../axZm/plugins/CLEditor/jquery.cleditor.table.min.js"></script>	

 
<div id="outerWrap" style="width: 100%; margin: 0px;">
	<div id="playerWrap" style="width: 100%;">
		<div id="playerInnerWrap" style="min-height: 538px;">
			<div id="abc" style="width: 959px;">
				<!-- Content inside target will be removed -->
				<div style="padding: 20px">Loading, please wait...</div>
			</div>
			<div id='testCustomNavi' class="ui-widget-header" style="width: 959px;"></div>

			<!-- Thumb slider with croped images -->
			<div id="cropSliderWrap">
				<div id="cropSlider">
					<ul></ul>
				</div>
			</div>	
		</div>
		<div id="marginAfter" style="display: none; margin-bottom: 300px;"></div>
	</div>

	
	
	<!-- Tabs wrapper -->
	<div id="aZcR_tabs" style="width: 100%; margin-top: 0px !important">
	
		<!-- Tab titles -->
		<ul>
			<li><a href="#aZcR_tabs-about">About</a></li>
			<li><a href="#aZcR_tabs-sel">Crop settings</a></li>
			<li><a href="#aZcR_tabs-crops">Cropped images</a></li>
			<li><a href="#aZcR_tabs-descr">Description</a></li>
			<li><a href="#aZcR_tabs-import">Import / Save</a></li>
			<li><a href="#aZcR_tabs-load">Load content</a></li>
		</ul>
		
		<!-- About -->
		<div id="aZcR_tabs-about">
			<div class="legend">About AJAX-ZOOM crop editor [Last updated: 2015-02-25]</div>
			<p>With this tool you can easily create several crops from 2D images / galleries, 
				360 spins or 3D multirow which are loaded into AJAX-ZOOM player. 
				Besides other thinkable purposes the goal here is to make a "crop gallery" placed outside of the AJAX-ZOOM player. 
				Clicking on the cropped thumb will zoom and for 360/3D spin & zoom to specified area of the image. 
				This is a really nice looking effect where the user is guided to the highlights of the product 
				by simply clicking on the thumbs in familiar manner.
			</p>
			<p>In the frontend where you will show this product tour to your customers AJAX-ZOOM can be  
				integrated into responsive layout, shown in a lightbox, fullscreen etc. 
				Also the cropped thumbs do not necessarily need to be loaded into the slider used here. 
				The simple JSON produced by this configurator gives enough information to place these cropped thumbs wherever on the page.
				The basic functionality for the onclick / click events are AJAX-ZOOM API functions 
				<a href="http://www.ajax-zoom.com/index.php?cid=docs#api_zoomTo">$.fn.axZm.zoomTo()</a> for plain 2D and  
				<a href="http://www.ajax-zoom.com/index.php?cid=docs#api_spinTo">$.fn.axZm.spinTo()</a> 
				for 360 turn able objects. You can also test and see the very basics of this editor including zoomTo in 
				<a href="example10.php">example10.php</a>;
			</p>

			<div class="legend">How to</div>
			<ol>
				<li style="margin-bottom: 10px">
					<img src="../axZm/icons/default/button_iPad_settings.png" width="25" style="vertical-align: middle; margin: 2px 5px 2px 0px"> 
					Hit crop settings button or <a class="linkShowTab" href="javascript: void(0)" onclick="jQuery('#aZcR_tabs').tabs('select','#aZcR_tabs-sel');">crop settings</a>tab to adjust crop selector e.g. set aspect ratio and output parameters for the thumbnail.
				</li>
				<li style="margin-bottom: 10px">
					<img src="../axZm/icons/default/button_iPad_jcrop.png" width="25" style="vertical-align: middle; margin: 2px 5px 2px 0px"> 
					Hit the crop button to toggle crop and select region to crop. 
				</li>
				<li style="margin-bottom: 10px">
					<img src="../axZm/icons/default/button_iPad_fire.png" width="25" style="vertical-align: middle; margin: 2px 5px 2px 0px"> 
					When ready hit the red "fire crop" button. 
				</li>
				<li style="margin-bottom: 10px">
					At the <a class="linkShowTab" href="javascript: void(0)" onclick="jQuery('#aZcR_tabs').tabs('select','#aZcR_tabs-crops');">cropped images</a>tab 
					you can view the crops in real size, delete and reorder the crops.
				</li>
				<li style="margin-bottom: 10px">
					Optionally add descriptions to the crop regions in 
					<a class="linkShowTab" href="javascript: void(0)" onclick="jQuery('#aZcR_tabs').tabs('select','#aZcR_tabs-descr');">description</a>tab.
				</li>
				<li>
					<a class="linkShowTab" href="javascript: void(0)" onclick="jQuery('#aZcR_tabs').tabs('select','#aZcR_tabs-import');">Save</a> 
					the created setup e.g. in a JSON file to reproduce the work at some other frontend.
				</li>
			</ol>

			
			<div class="legend">"Clean" examples</div>
			<p>This file (example35.php) is the actual crop editor to define the copped thumbs and optionally descriptions. 
			It is supposed to be in some restricted area of your page. For showing the results and 
			integration of the player into your frontend please use one of the following "clean" examples as the starting point. 
			Also please be aware of that AJAX-ZOOM is highly configurable so you can change the look and feel of nearly everything 
			you could think of. 
			</p>
			
		</div>

		<!-- Crop settings -->
		<div id="aZcR_tabs-sel">

			<!-- Crop options for Jcrop selector and AJAX-ZOOM thumbnail generator-->
			<div id="cropOptionsParent">
				<div id="cropOptions">
					<div class="legend">Jcrop (selector) settings</div>
					
					<div style="clear: both; margin: 5px 0px 5px 0px;">
						<label>Selection:</label>
						<select id="cropOpt_selection" onchange="jQuery.aZcropEd.jCropHandleSelection()">
							<option value="">normal</option>
							<option value="aspectRatio">Aspect ratio</option>
							<option value="fixedSize">Fixed size</option>
						</select>
					</div>
					
					<div id="cropOpt_ratioBox" style="clear: both; margin: 5px 0px 5px 0px; display: none;">
						<label>Aspect ratio:</label>
						W: <input id="cropOpt_ratio1" type="text" value="1" style="width: 50px" onchange="jQuery.aZcropEd.jCropAspectRatio()"> 
						<input type="button" style="width: 30px;" value="&#8660;" onclick="jQuery.aZcropEd.jCropAspectFlipValues()">
						H: <input id="cropOpt_ratio2" type="text" value="1" style="width: 50px" onchange="jQuery.aZcropEd.jCropAspectRatio()"> 
						<div>
							<label></label>
							<input type="button" value="as thumb" style="margin-top: 3px; width: 80px;" onclick="jQuery.aZcropEd.jCropAspectAsThumb()">
							<input type="button" value="as image" style="margin-top: 3px; width: 80px;" onclick="jQuery.aZcropEd.jCropAspectAsImage()">
						</div>
					</div>
					<div id="cropOpt_sizeBox" style="clear: both; margin: 5px 0px 5px 0px; display: none;">
						<label>Fixed size:</label>
						W: <input id="cropOpt_sizeW" type="text" value="" style="width: 50px" onchange="jQuery.aZcropEd.jCropFixedSize()"> 
						H: <input id="cropOpt_sizeH" type="text" value="" style="width: 50px" onchange="jQuery.aZcropEd.jCropFixedSize()"> px
					</div>
					
					<div class="legend">Thumbnail settings</div>
					
					<div style="clear: both; margin: 5px 0px 5px 0px;">
						<label>Thumbnail size:</label>
						W: <input id="cropOpt_thumbSizeW" type="text" value="180" style="width: 50px" onchange="jQuery.aZcropEd.jCropInitSettings()">  
						H: <input id="cropOpt_thumbSizeH" type="text" value="180" style="width: 50px" onchange="jQuery.aZcropEd.jCropInitSettings()"> px
					</div>
					
					<div style="clear: both; margin: 5px 0px 5px 0px;">
						<label>Thumbnail mode:</label>
						<select id="cropOpt_thumbMode" onchange="jQuery.aZcropEd.jCropInitSettings()">
							<option value="">-</option>
							<option value="contain">contain</option>
							<option value="cover">cover</option>
						</select>
					</div>
					<div id="cropOpt_colorBox" style="clear: both; margin: 5px 0px 5px 0px; display: none;">
						<label>Background color (hex):</label>
						#<input id="cropOpt_backColor" type="text" value="FFFFFF" style="width: 100px" onchange="jQuery.aZcropEd.jCropInitSettings()">
					</div>
					<div style="clear: both; margin: 5px 0px 5px 0px;">
						<label>Jpeg quality:</label>
						<input id="cropOpt_jpgQual" type="text" value="90" style="width: 40px" onchange="jQuery.aZcropEd.jCropInitSettings()"> 
						(10 - 100)
					</div>	
					<div style="clear: both; margin: 5px 0px 5px 0px;">
						<label>Cache (can be set later):</label>
						<input id="cropOpt_cache" type="checkbox" value="1" onchange="jQuery.aZcropEd.jCropInitSettings()">
					</div>
				</div>
			</div>

		</div>
		
		<!-- Cropped images -->
		<div id="aZcR_tabs-crops">
			<div class="legend">Crop results (real size)</div>
			
			<div class="azMsg">Drag & drop to reorder the thumbs, click to get the paths and other information (see below), 
			double click to zoom.
			</div>
			
			<!-- Crop results real size -->
			<div id="aZcR_cropResults"></div>
			<input type="button" value="Reamove all crops" style="margin-top: 5px" onclick="$.aZcropEd.clearAll()" /> 
			- crops will be not deleted physically here!
			<!-- alternativ horizontal thumb slider below
			<div style="height: 58px; padding: 0px; background-color: #CCCCCC; "><ul></ul></div>
			-->
			
			<div class="legend">Paths</div>
			
			<div style="clear: both; margin: 5px 0px 5px 0px;">
				<label>Query string:</label>
				<input id="aZcR_qString" type="text" onClick="this.select();" style="margin-bottom: 5px; width: 100%" value="">
			</div>
			
			<div style="clear: both; margin: 5px 0px 5px 0px;">
				<label>Url:</label>
				(please note that full Url might differ if this editor is implemented in a backend of some CMS)
				<input id="aZcR_url" type="text" onClick="this.select();" style="margin-bottom: 5px; width: 100%" value="">
			</div>
			
			<div style="clear: both; margin: 5px 0px 5px 0px;">
				<label>Cached image url:</label>
				(only available if "cache" option is chacked under "crop settings" tab)
				<input id="aZcR_contentLocation" type="text" onClick="this.select();" style="margin-bottom: 5px; width: 100%" value="">
			</div>
			
		</div>
		
		<!-- Description -->
		<div id="aZcR_tabs-descr">
			<div class="legend">Crop description</div>
			<div class="azMsg">Optionally add a title || description to use them later in various ways. 
				In this editor and also in the derived "clean" examples like 
				<a href="example35_clean.php">example35_clean.php</a> 
				we use "axZmEb" - expandable button (AJAX-ZOOM additional plugin) to display these titles || descriptions 
				over the image respectively inside the player. You could however easily change the usage of title || description in your implementation, 
				e.g. display them under the player or whatever. Just change the "handleTexts" property of the options object 
				when passing it to $.axZmImageCropLoad - see source code of e.g. <a href="example35_clean.php">example35_clean.php</a>;
			</div>
			<div id="aZcR_descrWrap">
				<!-- Tables with title and description field will be added here -->
			</div>
		</div>

		<!-- Import / Save -->
		<div id="aZcR_tabs-import">
			<div class="legend">Import all thumbs</div>
			
			<!-- Import form, do not change order of the fields-->
			<div id="aZcR_getAllThumbsForm">
				<input type="button" value="Get all" onclick="$.aZcropEd.getAllThumbs()">
				<select onchange="$.aZcropEd.getAllThumbs()">
					<option value="qString">Query string</option>
					<option value="url">Url</option>
					<option value="contentLocation">Cached image url</option>
				</select> 

				<select onchange="$(this).val() == 'CSV' ? $(this).next().css('display', '') : $(this).next().css('display', 'none'); $.aZcropEd.getAllThumbs();">
					<option value="JSON_data">JSON with data</option>
					<option value="JSON">JSON</option>
					<option value="CSV">CSV</option>
				</select> 
				<span style="display: none;">separated with <input type="text" value="|" style="width: 20px;" onchange="$.aZcropEd.getAllThumbs()"></span> 
				<br>and convert to be cached 
				<input type="checkbox" value="1" onclick="$.aZcropEd.getAllThumbs()">
				and replace thumb size 
				<input type="checkbox" value="1" onclick="$(this).next().toggle(); $.aZcropEd.getAllThumbs();">
				<span style="display: none">
					W: <input type="text" style="width: 50px" onchange="$.aZcropEd.getAllThumbs();" />
					H: <input type="text" style="width: 50px" onchange="$.aZcropEd.getAllThumbs();" /> px
				</span>
				<br>and convert px coordinates to percentage 
				<input type="checkbox" value="1" onclick="$.aZcropEd.getAllThumbs();">
			</div>
			
			<form action="../axZm/saveCropJSON.php" id="aZcR_saveJSON">
				<textarea id="aZcR_getAllThumbs" style="width: 100%; height: 250px; font-size: 10px;"></textarea>
			</form>
			
			<!-- Just a button to select text in the textarea above, can be removed -->
			<input type="button" value="Select text" style="margin-top: 5px;" onclick="$('#aZcR_getAllThumbs')[0].select()">
			
			<!-- Save -->
			<div class="legend">Save JSON to file</div>
			
			<div style="margin-top: 10px"><label>Password for saving:</label><input type="password" id="aZcR_jsFilePass" value=""> (can be set or disabled inside '/axZm/saveCropJSON.php')</div>
			<div style="margin-top: 10px"><label>Keep formated:</label><input type="checkbox" id="aZcR_jsKeepFormated" value="1"> - keep linebreaks, tab stops etc.</div>
			<div style="margin-top: 10px"><label>Create backup:</label><input type="checkbox" id="aZcR_jsBackUp" value="1" checked> - creates backup of the current JSON file if present with a timestamp in file name</div>
			<div style="margin-top: 10px"><label>Save JSON:</label>
			<input style="width: 100px;" type="button" value="Save" onClick="jQuery.aZcropEd.saveJSONtoFile();"> 
			to <input type="text" value="" id="aZcR_jsFileName">.json (a-zA-Z0-9-_)
			</div>
			
			<div style="margin-top: 10px"><label></label>
				e.g. "eos_1100d" 
				(on default the file is saved into "pic/cropJSON" folder)
			</div>
			
			<div style="margin: 10px 0px;">
				<div id="aZcR_saveToJSONresults"></div> 
			</div>
				
			<div class="legend">Notes</div>
			<ul>
				<li>In your final frontend presentation you can compose url out of query string with js 
					<code>$.fn.axZm.installPath()+'zoomLoad.php?'+queryString</code>
				</li>
			</ul>
		</div>
		
		<!-- Load content -->
		<div id="aZcR_tabs-load">
			<div class="legend">Load a different 2D / 360 or 3D content</div>
				
				<div class="azMsg">You do not need to edit html of this file in order to load a different 2D / 360 or 3D content into the editor. 
				Just enter a path into one of the fields below and press "LOAD" button. 
				Press "GET" button to see what is currently loaded.
				</div>
				
				<div style="clear: both; margin: 5px 0px 5px 0px;">
				<label>1. Path for 2D:</label> <input type="text" value="" id="aZcR_pathToLoad2D" style="width: 400px;">  or
				</div>
				
				<div style="clear: both; margin: 5px 0px 5px 0px;">
				<label>2. Path for 360 or 3D:</label> <input type="text" value="" id="aZcR_pathToLoad360" style="width: 400px;"> 
				</div>

				<div style="clear: both; margin: 15px 0px 5px 0px;">
				<label>3. Hotspot file path:</label> <input type="text" value="" id="aZcR_hotspotFileToLoad" style="width: 350px;"> (optional)
				</div>
				
				<div style="clear: both; margin: 5px 0px 5px 0px;">
				<label>4. Crop file path:</label> <input type="text" value="" id="aZcR_cropFileToLoad" style="width: 350px;"> (optional)
				</div>
				
				<div style="clear: both; margin: 5px 0px 5px 0px;">
				<input type="button" value="LOAD" onClick="jQuery.aZcropEd.changeAxZmContentPHP();">&nbsp;&nbsp;
				<input type="button" value="GET" onClick="jQuery.aZcropEd.getLoadedParameters();">
				</div>
				
				<div id="aZcR_pathToParameter"></div>
				
			<div class="legend">How does it work:</div>
				
				<div style="clear: both; margin: 5px 0px 5px 0px;">
					<ol> 
						<li>
							<ul>
								<li><strong>For 2D</strong> (single image or gallery with more images) 
								please enter local path(s) to the image(s), e.g. <br>
								"<code>/pic/zoom/animals/test_animals1.png</code>"<br>
								or image set with image paths separated with vertical dash e.g.<br>
								"<code>/pic/zoom/animals/test_animals1.png|/pic/zoom/animals/test_animals2.png</code>"<br> 
								If you want to load all images from a folder please just enter the path to this folder e.g. <br>
								"<code>/pic/zoom/animals</code>"
								</li>
							</ul>
						</li>
						<li style="margin-top: 10px;">
							<ul>
								<li style="margin-top: 5px;"><strong>For 360</strong> (single row 360 object) please enter only the path to the folder 
								where your 360 images are located e.g. <br>
								"<code>/pic/zoom3d/Uvex_Occhiali</code>";
								</li>
								<li style="margin-top: 5px;"><strong>For 3D</strong> (multi row turnable object) please enter the path to the folder 
								where subfolders with each row of 3D are located.<br> 
								On <a href="http://www.ajax-zoom.com/examples/example35.php" target="_blank">http://www.ajax-zoom.com/examples/example35.php</a> 
								this could be <br>
								"<code>/pic/zoomVR/nike</code>" <br>
								(not provided with the download package)
								</li>
							</ul>
	 					</li>
						<li style="margin-top: 10px;">
							<ul>
								<li style="margin-top: 5px;">
									<strong>Hotspot file path</strong> is the path to the file with hotspot configurations and positions, e.g.<br>
									"<code>../pic/hotspotJS/eos_1100D.js</code>"<br> 
									You can create such a file in <a href="example33.php">example33.php</a>
								</li>
							</ul>
						</li>
						
						<li style="margin-top: 10px;">
							<ul>
								<li style="margin-top: 5px;">
									<strong>Crop file path</strong> is the path to the file with crop data which can be created with this editor, e.g.<br>
									"<code>../pic/hotspotJS/eos_1100d.json</code>"<br> 
 
								</li>
							</ul>
						</li>
					</ol>
				</div>
				
			<div class="legend">Load only JSON data from file into editor</div>
				<div style="margin-top: 10px">
					<label>Crop JSON file path:</label>
					<input type="text" value="" id="aZcR_onlyJSONcropFile" style="width: 350px;">
				</div>
				<label></label>e.g.: "../pic/cropJSON/eos_1100d.json"
				<div style="margin-top: 10px">
					<label></label>
					<input type="button" value="Load" onclick="$.aZcropEd.getJSONdataFromFile($('#aZcR_onlyJSONcropFile').val())">
				</div>
				
		</div>
	
	<!-- end Tabs wrapper -->
	</div>
	
<!-- end outerWrap -->
</div>

<script type="text/javascript">

	ajaxZoom.opt = {
 		// First json to load
		onLoad: function(){ // onSpinPreloadEnd
			jQuery.aZcropEd.getJSONdataFromFile(ajaxZoom.cropJsonURL);
		},
		
		onCropEnd: function(){
			jQuery.aZcropEd.jCropOnChange();
		},
		
		onFullScreenResizeEnd: function(){
			// Toggle Jcrop
			if (jcrop_api){
				jQuery.aZcropEd.jCropMethod('destroy');
			}
		},
		
		onBeforeStart: function(){
			// Set background color, can also be done in css file
			jQuery('.axZm_zoomContainer').css({backgroundColor: '#FFFFFF'});	
 			
 			if ($.axZm.spinMod){
 				jQuery.axZm.restoreSpeed = 300;
			}else{
				jQuery.axZm.restoreSpeed = 0;
			}
			
			// Set extra space to the right at fullscreen mode for the crop gallery
			jQuery.axZm.fullScreenSpace = {
				top: 0,
				right: 100,
				bottom: 0,
				left: 0,
				layout: 1
			};
			
			//jQuery.axZm.fullScreenApi = true;

			//jQuery.axZm.fullScreenCornerButton = false;
			jQuery.axZm.fullScreenExitText = false;
			
			// Chnage position of the map
			//jQuery.axZm.mapPos = 'bottomLeft';
			
			// Set mNavi buttons here if you want, can be done in the config file too
			if (typeof jQuery.axZm.mNavi == 'object'){
				jQuery.axZm.mNavi.enabled = true; // enable AJAX-ZOOM mNavi
				jQuery.axZm.mNavi.alt.enabled = true; // enable button descriptions
				jQuery.axZm.mNavi.fullScreenShow = true; // show at fullscreen too
				jQuery.axZm.mNavi.mouseOver = true; // should be alsways visible
				jQuery.axZm.mNavi.gravity = 'bottom'; // position of AJAX-ZOOM mNavi
				jQuery.axZm.mNavi.offsetVert = 5; // vertical offset
				jQuery.axZm.mNavi.offsetVertFS = 30; // vertical offset at fullscreen
				jQuery.axZm.mNavi.parentID = 'testCustomNavi';
				
				// Define order and space between the buttons
				if (jQuery.axZm.spinMod){ // if it is 360 or 3D
					jQuery.axZm.mNavi.order = {mSpin: 5, mPan: 20, mZoomIn: 5, mZoomOut: 20, mReset: 5, mMap: 20, mCustomBtn1: 5, mCustomBtn2: 5, mCustomBtn3: 5};
				}else{
					jQuery.axZm.mNavi.order = {mZoomIn: 5, mZoomOut: 5, mReset: 20, mGallery: 5, mMap: 20, mCustomBtn1: 5, mCustomBtn2: 5, mCustomBtn3: 5};
				}

				// Define images for custom button to toggle Jcrop (see below)
				jQuery.axZm.icons.mCustomBtn1 = {file: 'default/button_iPad_jcrop', ext: 'png', w: 50, h: 50};
				jQuery.axZm.mapButTitle.customBtn1 = 'Toggle jCrop';
				
				// Define image for settings button
				jQuery.axZm.icons.mCustomBtn2 = {file: 'default/button_iPad_settings', ext: 'png', w: 50, h: 50};
				jQuery.axZm.mapButTitle.customBtn2 = 'jCrop settings';
				
				// Define image for 
				jQuery.axZm.icons.mCustomBtn3 = {file: 'default/button_iPad_fire', ext: 'png', w: 50, h: 50};		
				jQuery.axZm.mapButTitle.customBtn3 = 'Fire crop!';

				// function when clicked on this custom button (mCustomBtn1)
				jQuery.axZm.mNavi.mCustomBtn1 = function(){
					jQuery.aZcropEd.jCropMethod('toggle');
					return false;
				};
				
				// Toggle Jcrop and AJAX-ZOOM thumbnail settings popup
				jQuery.axZm.mNavi.mCustomBtn2 = function(){
					jQuery.aZcropEd.jCropSettingsPopup();
					return false;
				};	
				
				// Function when clicked on the fire crop button
				jQuery.axZm.mNavi.mCustomBtn3 = function(){
					jQuery.aZcropEd.jCropFire();
					return false;
				};
			}
		},
		
		onFullScreenSpaceAdded: function(){
				jQuery('#cropSlider')
				.css({
					bottom: 0,
					right: 0,
					height: '100%',
					zIndex: 555
				})
				.appendTo('#axZmFsSpaceRight');
		},
		
		onFullScreenStart: function(){
			jQuery.aZcropEd.jCropMethod('destroy');
		},
		
		onFullScreenClose: function(){
			jQuery.aZcropEd.jCropMethod('destroy');
			jQuery.fn.axZm.tapShow();

			jQuery('#cropSlider')
			.css({
				bottom: '',
				right: '',
				zIndex: ''
			})
			.appendTo('#cropSliderWrap');
		},
		onFullScreenCloseEndFromRel: function(){

			// Restore position of the slider
			jQuery('#cropSlider')
			.css({
				bottom: '',
				right: '',
				zIndex: ''
			})
			.appendTo('#cropSliderWrap');
		}
		
	};
	
	// Load not responsive
	jQuery.fn.axZm.load({
	    opt: ajaxZoom.opt,
	    path: ajaxZoom.path,
	    postMode: false,
	    apiFullscreen: false,
	    parameter: ajaxZoom.parameter,
	    divID: ajaxZoom.divID
	});
	  

 </script>


<script type="text/javascript">
	// this is only for responsive editor layout
	window.thisLayoutAdjusted = false;
	var adjustThisLayout = function(){
		var winW = jQuery(window).innerWidth();
		if (winW >= 1490){
			jQuery('#playerWrap').css({'float': 'left'});
			jQuery('#aZcR_tabs').css({'float': 'right', marginTop: 35, width: winW - jQuery('#playerWrap').outerWidth() - 50});
			jQuery('#outerWrap').css({margin: '', width: '', paddingLeft: 10, paddingRight: 10});
			jQuery('#marginAfter').css({display: 'block'});
			window.thisLayoutAdjusted = true;
		}else{
			if (window.thisLayoutAdjusted){
				jQuery('#outerWrap').css({margin: '0 auto', width: jQuery('#playerWrap').outerWidth(), paddingLeft: '', paddingRight: ''});
				
				jQuery('#aZcR_tabs').css({'float': '', width: '', marginTop: 20});
				jQuery('#playerWrap').css({'float': ''});
				jQuery('#marginAfter').css({display: 'none'});
				//jQuery('#aZcomments').css({'float': 'left', width: 722})
				window.thisLayoutAdjusted = false;
			}
		}
	};
	
	jQuery(document).ready(function(){
		adjustThisLayout();
		setTimeout(adjustThisLayout, 1); // repeat once
		jQuery(window).bind('resize', adjustThisLayout);
		// Tabs can change document height
		$('a[href^="#aZcR_tabs-"]').bind('click', adjustThisLayout);
	});

</script>
