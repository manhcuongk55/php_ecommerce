/**
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.imageCropLoad.js
* Copyright: Copyright (c) 2010-2015 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 4.2.1
* Date: 2015-03-15
* Extension Version 1.2
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/index.php?cid=docs
* Example: http://www.ajax-zoom.com/examples/example35_clean.php
*/

;(function($){
	// Options
	var opt;
	
	// Get query string value
	var getParameterByName = function(name) {
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	        results = regex.exec(location.search);
	    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	};
	
	// Load json file with some error handling
	var getJSONdataFromFile = function(){
		var cropJsonURL = opt.cropJsonURL;
		
		if (cropJsonURL){
			//var url = cropJsonURL.replace(/[^a-zA-Z0-9-_:\/.?&=]/g, '');
			//aZcR_jsFileName
			$.ajax({
				url: cropJsonURL,
				dataType: 'json',
				cache: false,
				success: function(d){
					proceedJSONdata(d);
				},
				error: function(a){
 					var status = a.status;
 					var txt = 'Error loading JSON file!';
					if (status == '200'){
						$.fn.axZm.zoomAlert('Loaded JSON file ('+cropJsonURL+') contains errors', txt, false, false);
					}else{
						$.fn.axZm.zoomAlert('An error '+a.status+' occurred while loading JSON from '+cropJsonURL, txt, false, false);
					}
				}
			});		
		} else if (opt.cropJson){
			proceedJSONdata(opt.cropJson);
		} else {
			$.fn.axZm.zoomAlert('No JSON data defined for crop thumbnails', 'Error', false, false);
		}
	};
	
	// Click on thumb
	var thumbClick = function(_this){

		// Read data previously attached to the image
		var azJcrop = _this.data('crop');
		
		// handleDescr will be executed after spinTo or zoomTo
		var handleDescr = function(){
			if ($.isFunction(opt.handleTexts)){
				opt.handleTexts(azJcrop.title, azJcrop.descr);
			}else if ((azJcrop.title || azJcrop.descr) && typeof console != 'undefined'){
				console.log('AJAX-ZOOM: no function defined to handle title and desciption');
			}
		};
		
		// Parameters from JSON as object
		var zoomToParameters = {
			x1: azJcrop.crop[0],
			y1: azJcrop.crop[1],
			x2: azJcrop.crop[2],
			y2: azJcrop.crop[3]
		};
		
		// Callback for 2D
		var zoomToCallback = function(){
			// Trigger AJAX-ZOOM API 
			// http://www.ajax-zoom.com/index.php?cid=docs#api_zoomTo
			$.fn.axZm.zoomTo(
				// Add handleDescr as callback to the options object passed to zoomTo
				$.extend(true, {},zoomToParameters,{callback: handleDescr})
			);
		};
		

		// 2D image and same image from gallery selected
		if ($.axZm.zoomGA[$.axZm.zoomID]['img'] == azJcrop.imgName && !$.axZm.spinMod){
			zoomToCallback();
		}
		else{
			// 360 / 3D mode
			if ($.axZm.spinMod){
				// Trigger AJAX-ZOOM API 
				// http://www.ajax-zoom.com/index.php?cid=docs#api_spinTo
				$.fn.axZm.spinTo(
					azJcrop.imgName, 
					opt.spinToSpeed || 'auto', 
					opt.spinToMotion || null, // easing
					handleDescr, // callback
					zoomToParameters
				);
			}else{
				// Trigger AJAX-ZOOM API 
				// http://www.ajax-zoom.com/index.php?cid=docs#api_zoomSwitch
				$.fn.axZm.zoomSwitch(azJcrop.imgName, null, true, null, zoomToCallback);
			}
		}
	
	};
	
	// Process json data after loading
	var proceedJSONdata = function(d){
		var thumbsContainerID, thumbsContainerUL, sliderID;
		
		if (!$.isArray(d) || d.length == 0){
			// Alert directly in AJAX-ZOOM
			$.fn.axZm.zoomAlert(
				'JSON passed from url ('+opt.cropJsonURL+') or defined as cropJson is not an array or array is empty', 
				'Error loading crops', 
				false, 
				false
			);
			return;
		}
		
		var arrCount = d.length, // number of crops from json
			i = 0; // counter
		
		// Checks
		if (opt.thumbsContainerID) {
			thumbsContainerID = $('#'+opt.thumbsContainerID);
			if (!thumbsContainerID.length){
				$.fn.axZm.zoomAlert(
					'Element with ID '+opt.thumbsContainerID+' was not found', 
					'Error loading crops', 
					false, 
					false
				);
				return;
			}
			
			// Ul present?
			thumbsContainerUL = $('ul', thumbsContainerID);
			if (!thumbsContainerUL.length){
				thumbsContainerUL = $('<ul />')
				.addClass(opt.thumbsContainerUlClass)
				.appendTo(thumbsContainerID);
			}
		} 
		
		else if (opt.sliderID){
			sliderID = $('#'+opt.sliderID);
			if (!sliderID.length){
				$.fn.axZm.zoomAlert(
					'Element with ID '+opt.sliderID+' was not found', 
					'Error loading crops', 
					false, 
					false
				);
				return;
			}
			// Slider not inited ?
			if (!sliderID.data('axZmThumbSlider')){
				$.fn.axZm.zoomAlert(
					'axZmThumbSlider is not inited, can not add thumbs to the slider!', 
					'Error loading crops', 
					false, 
					false
				);
				return;
			}
		}
		
		$(d).each(function(m, o) {

			var dataObj = {
					thumbNumber: m+1,
					crop: o.crop,
					url: o.url ? o.url : null,
					qString: o.qString ? o.qString : null,
					zoomID: o.zoomID ? o.zoomID : null,
					imgName: o.imgName,
					contentLocation: o.contentLocation ? o.contentLocation : null,
					title: o.title ? o.title : null,
					descr: o.descr ? o.descr : null
				},
				imgCropperPath;
			
			// Look where to get the croped thumb from
			if (dataObj.url){
				imgCropperPath = dataObj.url;
				dataObj.qString = imgCropperPath.replace(opt.installPath+'zoomLoad.php?', '')
			}else if (dataObj.qString){
				imgCropperPath = opt.installPath+'zoomLoad.php?'+dataObj.qString;
				dataObj.url = imgCropperPath;
			} else if (o.contentLocation){
				// directly from cache 
				imgCropperPath = o.contentLocation;
			}
			
			if (!imgCropperPath){
				i++;
				return;
			}
			
			dataObj.imgCropperPath = imgCropperPath;

			// append thumbs to axZmThumbSlider
			if (opt.sliderID && sliderID.length){
				var tempImg = new Image();
				
				// Preload image
				$(tempImg)
				.error(function(a) {
					if (typeof console != 'undefined'){
						console.log('Error loading thumb: '+imgCropperPath);
					}
					i++;
				})
				.load(function(){
					// Create li ellement
					var newLi = $('<li />')
					// Set data attr to be able to fine it later over selector
					.attr('data-cropNum', dataObj.thumbNumber)
					// Crop data
					.data('crop', dataObj)
					// Append thumb image to li
					.append(
						$('<img>')
						.attr('src', imgCropperPath)
					);
					
					// Use axZmThumbSlider "appendThumb" API to add the thumb to the slider
					sliderID.axZmThumbSlider(
						'appendThumb', 
						newLi, 
						// Click event
						function(){
							thumbClick(newLi);
						}, 
						// Callback after thumb added
						function(el, no){
							// After thumb added
							i++;
							if (i == arrCount){
								// If it is last thumb sort them in the right order
								// (they are appended as sooon as the images are preloaded in the above code, 
								// so it is not guaranteed that they are appended in the correct order)
								$('#cropSlider').axZmThumbSlider('sortByData', 'data-cropNum');
							}
						}
					); 
				}).attr('src', imgCropperPath);
			} 
			
			// Append thumbs in UL LI structure to the container
			else if (thumbsContainerID) {
				var newLi = $('<li />')
				// Custom css
				.css(opt.thumbsContainerLiCss ? opt.thumbsContainerLiCss : {})
				// Set data attr to be able to fine it later over selector
				.attr('data-cropNum', dataObj.thumbNumber)
				// Crop data
				.data('crop', dataObj)
				// Append thumb image to li
				.append(
					$('<img>')
					.addClass('thumb')
					.attr('src', imgCropperPath)
				)
				.bind('click', function(){
					thumbClick(newLi);
					$('li', thumbsContainerID).removeClass('selected hover');
					newLi.addClass('selected');
				})
				.bind('mouseenter', function(){
					if (!newLi.hasClass('selected')){
						newLi.addClass('hover');
					}
				})
				.bind('mouseleave', function(){
					if (!newLi.hasClass('selected')){
						newLi.removeClass('hover');
					}
				});
				
				// For vertical align
				$('<span />').text(' ').addClass('vAlign').appendTo(newLi);
				
				// Description
				if (opt.thumbsContainerLiDescr && dataObj.title){
					$('<div />').addClass('descr').html(dataObj.title).appendTo(newLi);
				}

				newLi.appendTo(thumbsContainerUL);
			}
		
		});
	};
	
	// Call
	$.axZmImageCropLoad = function(o){
		var def = {
			installPath: 'auto', //Path to /axZm directory, e.g. /test/axZm/
			cropJsonURL: '', // url of the json with crop data
			cropJson: '', // data coming from elsewhere
			sliderID: null, // ID of axZmThumbSlider
			
			thumbsContainerID: null, // ID of some container to put thumbs into (no slider)
			thumbsContainerUlClass: 'azThumbCrop', // class which will be added to the UL element
			thumbsContainerLiCss: {}, // quickly overwrite css e.g. margin of the li (thumbs)
			thumbsContainerLiDescr: false, // add title from crop data to the thumb
			
			spinToSpeed: '2500', // optionally pass duration of spinning when clicked on the thumb
			spinToMotion: 'easeOutQuint', // optional pass easing type of the spinning animation
			handleTexts: null // function after spinTo or zoomTo; if defined in JSON title and description are passed as arguments
		};

		if (!o.cropJsonURL || o.cropJsonURL == 'auto'){
			o.cropJsonURL = getParameterByName('cropJsonURL');
		}

		if (!o.installPath || o.installPath == 'auto'){
			o.installPath = $.fn.axZm.installPath();
		}
		
		opt = $.extend({}, def, o, true),
		
		// Proceed
		getJSONdataFromFile();
	};
	
})(jQuery);