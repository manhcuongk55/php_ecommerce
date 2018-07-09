/**
* Plugin: jQuery AJAX-ZOOM, jquery.axZm.mouseOverZoomInit.js
* Copyright: Copyright (c) 2010-2015 Vadim Jacobi
* License Agreement: http://www.ajax-zoom.com/index.php?cid=download
* Version: 4.2.9
* Date: 2015-09-23
* Extension Version: 3.4
* Extension Date: 2015-09-23
* URL: http://www.ajax-zoom.com
* Documentation: http://www.ajax-zoom.com/examples/example32.php
*/

/**
This file is needed to init mouseOverZoom (jquery.axZm.mouseOverZoom.js)
*/

(function($){$.mouseOverZoomInit=function(options){var defaults={axZmPath:"auto",divID:"",galleryDivID:"",hideGalleryOneImage:true,images:{},firstImageToLoad:1,images360:{},images360firstToLoad:false,images360Opt:["spinReverse","spinReverseZ","spinBounce","spinDemoRounds","spinDemoTime","spinWhilePreload"],images360Thumb:false,images360Preview:true,images360PreviewResponsive:true,images360examplePreview:"mouseOverExtension360",galleryAxZmThumbSlider:true,preloadMouseOverImages:false,noImageAvailableClass:"axZm_mouseOverNoImage",
width:"auto",height:"auto",mouseOverZoomWidth:1200,mouseOverZoomHeight:1200,ajaxZoomOpenMode:"fullscreen",example:"mouseOverExtension",exampleFancyboxFullscreen:"mouseOverExtension",exampleFancybox:"modal",exampleColorbox:"modal",fullScreenApi:false,disableScrollAnm:true,axZmCallBacks:{},thumbW:50,thumbH:80,thumbRetina:true,quality:90,qualityZoom:80,adjustContainer:false,mouseOverZoomParam:{position:"right",posAutoInside:150,autoFlip:200,biggestSpace:false,zoomFullSpace:false,zoomWidth:530,zoomHeight:450,
autoMargin:15,adjustX:15,adjustY:-1,lensOpacity:.3,zoomAreaBorderWidth:1,galleryFade:300,shutterSpeed:150,showFade:300,hideFade:300,smoothMove:6,tint:false,tintOpacity:.5,showTitle:true,titleOpacity:.5,titlePosition:"top",cursorPositionX:.5,cursorPositionY:.55,touchClickAbort:500,loading:true,loadingMessage:"Loading...",loadingWidth:90,loadingHeight:20,loadingOpacity:1,zoomHintEnable:true,zoomHintText:"Zoom",onLoad:function(){},onImageChange:function(){},onMouseOver:function(){},onMouseOut:function(){},
spinner:true,spinnerParam:{lines:11,length:3,width:3,radius:4,corners:1,rotate:0,color:"#FFFFFF",speed:1,trail:90,shadow:false,hwaccel:false,className:"spinner",zIndex:2E9,top:0,left:1}},fancyBoxParam:{boxMargin:0,boxPadding:10,boxCenterOnScroll:true,boxOverlayShow:true,boxOverlayOpacity:.75,boxOverlayColor:"#777",boxTransitionIn:"fade",boxTransitionOut:"fade",boxSpeedIn:300,boxSpeedOut:300,boxEasingIn:"swing",boxEasingOut:"swing",boxShowCloseButton:true,boxEnableEscapeButton:true,boxOnComplete:function(){},
boxTitleShow:false,boxTitlePosition:"float",boxTitleFormat:null},colorBoxParam:{transition:"elastic",speed:300,scrolling:true,title:true,opacity:.9,className:false,current:"image {current} of {total}",previous:"previous",next:"next",close:"close",onOpen:false,onLoad:false,onComplete:false,onClosed:false,overlayClose:true,escKey:true},galleryAxZmThumbSliderParam:{},data:{}};var op=$.extend(true,{},defaults,options);var uniqueZoomID="",showGallery=false,imagesObj={},images360Obj={},images360Data=null,
divID,w,h,prevW,prevH,allImagesCsvArr=[],allImagesCsv="",galContainer,ul=$("<ul />");var fancyBoxResponsiveWarning="Please include following scripts in the head section:\n\n/axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.css \n/axZm/plugins/demo/jquery.fancybox/jquery.fancybox-1.3.4.pack.js \n/axZm/extensions/jquery.axZm.openAjaxZoomInFancyBox.js \n\nImportant: it has to be adjusted Fancybox from AJAX-ZOOM package!\n";uniqueZoomID="zoom_"+Math.floor(Math.random()*999999)+(new Date).getTime();
if(!window.ajaxZoomUniqueZoomID)window.ajaxZoomUniqueZoomID=[];if($.inArray(uniqueZoomID,window.ajaxZoomUniqueZoomID)==-1)window.ajaxZoomUniqueZoomID.push(uniqueZoomID);var consoleLog=function(a){if(typeof console!="undefined")console.log(a)};var getl=function(sep,str){return str.substring(str.lastIndexOf(sep)+1)};var getf=function(sep,str){var extLen=getl(sep,str).length;return str.substring(0,str.length-extLen-1)};var stripLastSlash=function(str){if(str.substr(str.length-1,1)=="/")return str.substr(0,
str.length-1);return str};var passOtherParam=function(){return"&screenW="+$(window).width()+"&screenH="+$(window).height()+"&disableScrollAnm="+op.disableScrollAnm};var countObj=function(obj){var n=0;if(typeof obj=="object")$.each(obj,function(i){n++});return n};var removeAZ=function(){$.fn.axZm.spinStop();$.fn.axZm.remove();$("#axZmTempBody").axZmRemove(true);$("#axZmTempLoading").axZmRemove(true);$("#axZmWrap").axZmRemove(true)};var imageSrc=function(num,kind){var imageServer=op.axZmPath+"zoomLoad.php?azImg=",
path="";if(imagesObj[num]){var v=imagesObj[num];if(v[kind])path=v[kind];else{if(kind=="zoom")path=imageServer+v.img+"&qual="+op.qualityZoom+"&width="+op.mouseOverZoomWidth+"&height="+op.mouseOverZoomHeight;else if(kind=="preview")path=imageServer+v.img+"&qual="+op.quality+"&width="+w+"&height="+h;else if(kind=="thumb")path=imageServer+v.img+"&qual="+op.quality+"&width="+op.thumbW*(op.thumbRetina?2:1)+"&height="+op.thumbH*(op.thumbRetina?2:1);path=path.split(" ").join("%20")}}return path};var image360Src=
function(num,kind){var imageServer=op.axZmPath+"zoomLoad.php?azImg=",path="";if(images360Obj[num]){var v=images360Obj[num];if(v.thumb)path=v.thumb;else if(v.thumbImg)path=imageServer+v.thumbImg+"&qual="+op.quality+"&width="+op.thumbW*(op.thumbRetina?2:1)+"&height="+op.thumbH*(op.thumbRetina?2:1);else if(images360Data&&images360Data[num]&&images360Data[num][1]&&images360Data[num][1]["fileName"]){if(kind=="thumb")path=imageServer+images360Data[num][1]["path"]+images360Data[num][1]["fileName"]+"&qual="+
op.quality+"&width="+op.thumbW*(op.thumbRetina?2:1)+"&height="+op.thumbH*(op.thumbRetina?2:1)}else path=op.axZmPath+"icons/empty.gif"}return path};if(op.preloadMouseOverImages)op.mouseOverZoomParam.preloadGalleryImages=function(){if(op.preloadMouseOverImages=="oneByOne"){var preloadMouseOverImage=function(num){if(imagesObj[num]){$("<img>").attr("src",imageSrc(num,"preview"));$("<img>").load(function(){if(imagesObj[num+1])preloadMouseOverImage(num+1)}).attr("src",imageSrc(num,"zoom"))}};preloadMouseOverImage(1)}else{var nnn=
1;$.each(imagesObj,function(k,v){if(k!=op.firstImageToLoad){nnn++;setTimeout(function(){$("<img>").attr("src",imageSrc(k,"zoom"));$("<img>").attr("src",imageSrc(k,"preview"))},nnn*100)}})}};var initMouseOverZoom=function(){var num=op.firstImageToLoad;if(!imagesObj[num])return;var a=$("<a />").addClass("axZm_mouseOverImg").data("zoomid",parseInt(num)).attr({href:imageSrc(num,"zoom"),id:uniqueZoomID});$("<img>").attr({"src":imageSrc(num,"preview"),"title":imagesObj[num]["title"],"border":0}).css("opacity",
0).appendTo(a);a.appendTo(divID)};$.fn[uniqueZoomID]=function(event){event.stopPropagation();var thisZoomID=$("#"+uniqueZoomID).data("zoomid");window.fullScreenStartSplash={enable:true,className:false,opacity:1};var onBoxesClose=function(){if($.axZm){$(".axZm_mouseOverThumb:eq("+($.axZm.zoomID-1)+")","#"+op.galleryDivID).trigger("click");if(showGallery&&op.galleryAxZmThumbSlider&&$.isFunction($.fn.axZmThumbSlider)){var posOnClick=$("#"+op.galleryDivID).data("axZmThumbSlider").opt.posOnClick;if(!posOnClick)$("#"+
op.galleryDivID).axZmThumbSlider("scrollTo",$.axZm.zoomID)}}};var onVertGalLoaded=function(){$.each(imagesObj,function(k,v){$.fn.axZm.setDescr(getl("/",v.img),"unset",v.title||"&nbsp;")})};if(op.ajaxZoomOpenMode=="fullscreen"){var aZcallBacks=$.fn.axZm.mergeCallBackObj(op.axZmCallBacks,{onFullScreenClose:onBoxesClose,onVertGalLoaded:onVertGalLoaded});$.fn.axZm.openFullScreen(op.axZmPath,"zoomID="+thisZoomID+"&zoomData="+allImagesCsv+"&example="+op.example+passOtherParam(),aZcallBacks,"window",op.fullScreenApi,
false)}else if(op.ajaxZoomOpenMode=="fancyboxFullscreen"){if(!$.isFunction($.openAjaxZoomInFancyBox)){alert(fancyBoxResponsiveWarning);return false}$("#axZmTempBody, #axZmWrap").axZmRemove(true);var aZcallBacks=$.fn.axZm.mergeCallBackObj(op.axZmCallBacks,{onVertGalLoaded:onVertGalLoaded});var thisParam={axZmPath:op.axZmPath,queryString:"example="+op.exampleFancyboxFullscreen+"&zoomID="+thisZoomID+"&zoomData="+allImagesCsv+passOtherParam(),fullScreenApi:op.fullScreenApi,ajaxZoomCallbacks:aZcallBacks,
boxOnClosed:onBoxesClose};$.openAjaxZoomInFancyBox($.extend(true,{},thisParam,aZcallBacks))}else if(op.ajaxZoomOpenMode=="fancybox"){$("#axZmTempBody, #axZmWrap").axZmRemove(true);var axZmWrap=$("<div />").css({display:"none"}).attr("id","axZmWrap").appendTo("body");var onStart=function(){axZmWrap.css("display","");var thisParam={showNavArrows:false,enableKeyboardNav:false,hideOnContentClick:false,scrolling:"no",width:"auto",height:"auto",autoScale:false,autoDimensions:true,href:"#axZmWrap",titleShow:true,
title:op.fancyBoxParam.boxTitleShow?imagesObj[thisZoomID]["title"]||"Image No. "+thisZoomID:null,onClosed:function(){onBoxesClose();removeAZ()},beforeClose:function(){onBoxesClose();removeAZ()}};var fancyBoxParam={};$.each(op.fancyBoxParam,function(k,v){k=k.substr(3);fancyBoxParam[k.charAt(0).toLowerCase()+k.slice(1)]=v});$.fancybox($.extend(true,{},fancyBoxParam,thisParam))};var onImageChange=function(){if(op.fancyBoxParam.boxTitleShow)if($.fancybox.init){var titleDivMap={"float":"fancybox-title-float-main",
"outside":"fancybox-title-outside","inside":"fancybox-title-inside","over":"fancybox-title-over"};if(imagesObj[$.axZm.zoomID]["title"])$("#"+titleDivMap[op.fancyBoxParam.boxTitlePosition]).html(imagesObj[$.axZm.zoomID]["title"]);else $("#"+titleDivMap[op.fancyBoxParam.boxTitlePosition]).html("Image No. "+$.axZm.zoomID);if(op.fancyBoxParam.boxTitlePosition=="float")$("#fancybox-title").css("left",$("#fancybox-wrap").outerWidth()/2-$("#fancybox-title").outerWidth()/2)}else{var ourTitleDiv=$(".fancybox-title");
var ourTitle="";if(imagesObj[$.axZm.zoomID]["title"])ourTitle=imagesObj[$.axZm.zoomID]["title"];else ourTitle="Image No. "+$.axZm.zoomID;if(ourTitleDiv.length)if(ourTitleDiv.children().first().length)ourTitleDiv.children().first().html(ourTitle);else ourTitleDiv.html(ourTitle)}};var aZcallBacks=$.extend(true,{},op.axZmCallBacks);aZcallBacks=$.fn.axZm.mergeCallBackObj(aZcallBacks,{onStart:onStart,onImageChange:onImageChange});$.fn.axZm.load({opt:aZcallBacks,path:op.axZmPath,parameter:"zoomID="+thisZoomID+
"&zoomData="+allImagesCsv+"&example="+op.exampleFancybox+passOtherParam(),divID:"axZmWrap",apiFullscreen:op.fullScreenApi})}else if(op.ajaxZoomOpenMode=="colorbox"){$("#axZmTempBody, #axZmWrap").axZmRemove(true);var axZmWrap=$("<div />").css({display:"none"}).attr("id","axZmWrap").appendTo("body");var onStart=function(){axZmWrap.css("display","");var thisParam={opacity:.9,initialWidth:300,initialHeight:300,preloading:false,scrolling:false,scrollbars:false,title:op.colorBoxParam.title?imagesObj[thisZoomID]["title"]:
false,onCleanup:function(){onBoxesClose();removeAZ()},inline:true,href:"#axZmWrap",ajax:false};$.colorbox($.extend(true,{},op.colorBoxParam,thisParam))};var onImageChange=function(){if(op.colorBoxParam.title)if(imagesObj[$.axZm.zoomID]["title"])$("#cboxTitle").html(imagesObj[$.axZm.zoomID]["title"]);else $("#cboxTitle").html("")};var aZcallBacks=$.extend(true,{},op.axZmCallBacks);aZcallBacks=$.fn.axZm.mergeCallBackObj(aZcallBacks,{onStart:onStart,onImageChange:onImageChange});$.fn.axZm.load({opt:aZcallBacks,
path:op.axZmPath,parameter:"zoomID="+thisZoomID+"&zoomData="+allImagesCsv+"&example="+op.exampleColorbox+passOtherParam(),divID:"axZmWrap",apiFullscreen:op.fullScreenApi})}else if($.isFunction(op.ajaxZoomOpenMode)){if(op.data.axZmCallbacks)$.extend(op.data.axZmCallbacks,op.axZmCallBacks);else op.data.axZmCallbacks=$.extend(true,{},op.axZmCallBacks);op.data.zoomID=thisZoomID;op.ajaxZoomOpenMode(op.data)}else alert('Sorry, but at this point there are no other mods than (AJAX-ZOOM) "fullscreen", "fancyboxFullscreen", "fancybox" and "colorbox".');
$(".axZm_mouseOverTrap","#"+uniqueZoomID).trigger("mouseout")};var trigger360=function(key){var obj360=images360Obj[key];if(!obj360||$.axZm&&$.axZm.spinPreloading)return false;$(".axZm_mouseOverTrap","#"+uniqueZoomID).trigger("mouseout");var azCallbacks360={onBeforeStart:function(){$.each(op.images360Opt,function(a,b){if(obj360[b]!==undefined)$.axZm[b]=obj360[b]})},onLoad:function(){if(obj360.hotspotFilePath)$.fn.axZm.loadHotspotsFromJsFile(obj360.hotspotFilePath,false,function(){})}};var onBoxesClose=
function(){var imgData=$("#"+uniqueZoomID).data();if(imgData&&imgData.zoomid)if(showGallery&&op.galleryAxZmThumbSlider&&$.isFunction($.fn.axZmThumbSlider))$("#"+op.galleryDivID).axZmThumbSlider("select","#"+uniqueZoomID+"_"+imgData.zoomid,false);else if(showGallery&&!op.galleryAxZmThumbSlider){$("li",ul).removeClass("selected");$("#"+uniqueZoomID+"_"+imgData.zoomid,ul).addClass("selected")}$(".axZm_mouseOverWrapper",divID).css("display","block")};if(op.images360Preview){if($(".axZm_mouseOverSpinWrapper:not([data-uniqueZoomID='"+
uniqueZoomID+"'])").length>0){removeAZ();$(".axZm_mouseOverSpinWrapper").axZmRemove()}var qString="3dDir="+obj360.path+"&example="+op.images360examplePreview+passOtherParam();if($.axZm&&$(".axZm_mouseOverSpinWrapper",divID).length==1)$.fn.axZm.loadAjaxSet(qString,null,function(){azCallbacks360.onBeforeStart();azCallbacks360.onLoad()});else{$(".axZm_mouseOverSpinWrapper").axZmRemove();removeAZ();$("<div>").addClass("axZm_mouseOverSpinWrapper").attr("data-uniqueZoomID",uniqueZoomID).attr("id","axZm_mouseOverSpinWrapper").appendTo(divID);
if(op.images360PreviewResponsive)$.fn.axZm.openFullScreen(op.axZmPath,qString,azCallbacks360,"axZm_mouseOverSpinWrapper",op.fullScreenApi,true);else $.fn.axZm.load({opt:azCallbacks360,path:op.axZmPath,parameter:qString,divID:"axZm_mouseOverSpinWrapper",apiFullscreen:op.fullScreenApi})}}else{removeAZ();$(".axZm_mouseOverSpinWrapper").axZmRemove();window.fullScreenStartSplash={enable:true,className:false,opacity:1};if(op.ajaxZoomOpenMode=="fullscreen"){var aZcallBacks=$.fn.axZm.mergeCallBackObj(op.axZmCallBacks,
{onFullScreenClose:onBoxesClose});aZcallBacks=$.fn.axZm.mergeCallBackObj(aZcallBacks,azCallbacks360);$.fn.axZm.openFullScreen(op.axZmPath,"3dDir="+obj360.path+"&example="+op.example+passOtherParam(),aZcallBacks,"window",op.fullScreenApi,false)}else if(op.ajaxZoomOpenMode=="fancyboxFullscreen"){if(!$.isFunction($.openAjaxZoomInFancyBox)){alert(fancyBoxResponsiveWarning);return false}$("#axZmTempBody, #axZmWrap").axZmRemove(true);var aZcallBacks=$.extend(true,{},op.axZmCallBacks);aZcallBacks=$.fn.axZm.mergeCallBackObj(aZcallBacks,
azCallbacks360);var thisParam={axZmPath:op.axZmPath,queryString:"example="+op.exampleFancyboxFullscreen+"&3dDir="+obj360.path+passOtherParam(),fullScreenApi:op.fullScreenApi,ajaxZoomCallbacks:aZcallBacks,boxOnClosed:onBoxesClose};$.openAjaxZoomInFancyBox($.extend(true,{},thisParam,aZcallBacks))}else if(op.ajaxZoomOpenMode=="fancybox"){$("#axZmTempBody, #axZmWrap").axZmRemove(true);var axZmWrap=$("<div />").css({display:"none"}).attr("id","axZmWrap").appendTo("body");var onStart=function(){axZmWrap.css("display",
"");var thisParam={showNavArrows:false,enableKeyboardNav:false,hideOnContentClick:false,scrolling:"no",width:"auto",height:"auto",autoScale:false,autoDimensions:true,href:"#axZmWrap",titleShow:true,title:null,onClosed:function(){onBoxesClose();removeAZ()}};var fancyBoxParam={};$.each(op.fancyBoxParam,function(k,v){k=k.substr(3);fancyBoxParam[k.charAt(0).toLowerCase()+k.slice(1)]=v});$.fancybox($.extend(true,{},fancyBoxParam,thisParam))};var aZcallBacks=$.extend(true,{},op.axZmCallBacks);aZcallBacks=
$.fn.axZm.mergeCallBackObj(aZcallBacks,azCallbacks360);aZcallBacks=$.fn.axZm.mergeCallBackObj(aZcallBacks,{onStart:onStart});$.fn.axZm.load({opt:aZcallBacks,path:op.axZmPath,parameter:"&example="+op.exampleFancybox+"&3dDir="+obj360.path+passOtherParam(),divID:"axZmWrap",apiFullscreen:op.fullScreenApi})}else if(op.ajaxZoomOpenMode=="colorbox"){$("#axZmTempBody, #axZmWrap").axZmRemove(true);var axZmWrap=$("<div />").css({display:"none"}).attr("id","axZmWrap").appendTo("body");var onStart=function(){axZmWrap.css("display",
"");var thisParam={opacity:.9,initialWidth:300,initialHeight:300,preloading:false,scrolling:false,scrollbars:false,title:false,onCleanup:function(){onBoxesClose();removeAZ()},inline:true,href:"#axZmWrap",ajax:false};$.colorbox($.extend(true,{},op.colorBoxParam,thisParam))};var aZcallBacks=$.extend(true,{},op.axZmCallBacks);aZcallBacks=$.fn.axZm.mergeCallBackObj(aZcallBacks,azCallbacks360);aZcallBacks=$.fn.axZm.mergeCallBackObj(aZcallBacks,{onStart:onStart});$.fn.axZm.load({opt:aZcallBacks,path:op.axZmPath,
parameter:"example="+op.exampleColorbox+"&3dDir="+obj360.path+passOtherParam(),divID:"axZmWrap",apiFullscreen:op.fullScreenApi})}}};var add360=function(o){$.each(o,function(k,v){var li=$("<li />").attr("id",uniqueZoomID+"_360_"+images360Obj[k]["n"]);var img=$("<img src='"+image360Src(k,"thumb")+"'>");var spinOverl=$("<div />").addClass("spinOverl");if(op.galleryAxZmThumbSlider)if(galContainer.data("axZmThumbSlider"))galContainer.axZmThumbSlider(images360Obj[k]["position"]=="first"?"prependThumb":
"appendThumb",li.append(img).append(spinOverl),function(){trigger360(k)},function(el,no){});else{li.bind("click",function(){trigger360(k)}).append(img).append(spinOverl);if(images360Obj[k]["position"]=="first")li.prependTo(ul);else li.appendTo(ul)}else{img.addClass("thumb");li.css({width:op.thumbW,height:op.thumbH}).append(img).append(spinOverl).bind("click",function(){trigger360(k);$("li",ul).removeClass("selected");$(this).addClass("selected")});$("<span />").text(" ").addClass("vAlign").appendTo(li);
if(images360Obj[k]["position"]=="first")li.prependTo(ul);else li.appendTo(ul)}})};var initThis=function(){if(op.axZmPath=="auto")if($.isFunction($.fn.axZm))op.axZmPath=$.fn.axZm.installPath();else{alert("jquery.axZm.js is not loaded");return}divID=$("#"+op.divID);if(divID.length<=0){alert("Element with ID "+op.divID+" was not found.");return}divID.data("aZ","").empty();var m=0;$.each(op.images,function(k,v){if(!$.isEmptyObject(v)&&v.img){m++;imagesObj[m]=v}});if($.isEmptyObject(imagesObj))if(!$.isEmptyObject(op.images360)){op.images360firstToLoad=
1;op.images360Preview=true}else{consoleLog("[AJAX-ZOOM] no images or 360/3D identified");$("<div />").addClass(op.noImageAvailableClass).appendTo(divID);return}w=op.width=="auto"?divID.innerWidth():op.width;h=op.height=="auto"?divID.innerHeight():op.height;prevW=divID.width();prevH=divID.height();if(op.width!="auto")divID.css("width",w);if(op.height!="auto")divID.css("height",h);if(op.galleryDivID&&$("#"+op.galleryDivID).length!=-1)showGallery=true;if(!op.galleryDivID)op.galleryDivID="gal_"+uniqueZoomID;
if(showGallery&&!op.galleryAxZmThumbSlider)$("#"+op.galleryDivID).css({display:"block"});if(showGallery)galContainer=$("#"+op.galleryDivID).empty();else galContainer=$("<div />").attr("id",op.galleryDivID);if(countObj(op.images)<op.firstImageToLoad)op.firstImageToLoad=1;$.each(imagesObj,function(k,v){allImagesCsvArr.push(v["img"]);var li=$("<li />"),relBind;if(showGallery&&op.galleryAxZmThumbSlider){var img=$("<img src='"+imageSrc(k,"thumb")+"'>");li.addClass("axZm_mouseOverThumb").append(img).appendTo(ul);
relBind=li}else if(showGallery&&!op.galleryAxZmThumbSlider){var img=$("<img src='"+imageSrc(k,"thumb")+"'>").addClass("thumb");li.addClass("axZm_mouseOverThumb").css({width:op.thumbW,height:op.thumbH}).append(img);$("<span />").text(" ").addClass("vAlign").appendTo(li);li.appendTo(ul);relBind=li}else{var img=$("<div />").addClass("axZm_mouseOverThumb");relBind=img}relBind.attr({id:uniqueZoomID+"_"+k,title:imagesObj[k]["title"]}).data("href",imageSrc(k,"zoom")).data("relZoom",uniqueZoomID).data("zoomid",
parseInt(k)).data("smallImage",imageSrc(k,"preview")).bind("click",function(){$(".axZm_mouseOverWrapper",divID).css("display","block");if($(".axZm_mouseOverSpinWrapper",divID).length){removeAZ();$(".axZm_mouseOverSpinWrapper").axZmRemove()}$("#"+uniqueZoomID).data("previd",$("#"+uniqueZoomID).data("zoomid"));$("#"+uniqueZoomID).data("zoomid",parseInt(k));$("#"+uniqueZoomID+" img").attr("title",v.title||"");if(showGallery&&!op.galleryAxZmThumbSlider){$("li",ul).removeClass("selected");$(this).addClass("selected")}})});
allImagesCsv=allImagesCsvArr.join("|");if(showGallery&&op.galleryAxZmThumbSlider)galContainer.removeData("axZmThumbSlider").append(ul);else if(showGallery&&!op.galleryAxZmThumbSlider)ul.addClass("azThumb").appendTo(galContainer);var tempImages360={};if(typeof op.images360=="object"){var m=0;$.each(op.images360,function(k,v){if(v.path){m++;v.path=stripLastSlash(v.path);v.ident=getl("/",v.path);v.n=m;images360Obj[v.ident]=v;tempImages360[m]=v}});op.images360=tempImages360}else op.images360={};if(showGallery&&
!$.isEmptyObject(images360Obj)){var zoomMixedDataArr=[];var hasThumbLink=true;$.each(images360Obj,function(k,v){if(v.path){zoomMixedDataArr.push("image360*"+v.path);if(!(v.thumbImg||v.thumb))hasThumbLink=false}});if(op.images360Thumb&&!hasThumbLink&&zoomMixedDataArr[0])$.ajax({url:op.axZmPath+"zoomLoad.php",data:"zoomMixedData="+zoomMixedDataArr.join("|")+"&qq=firstImageFromMixedData",cache:false,dataType:"JSON",success:function(data){if(data.error)$.each(data.error,function(k,v){consoleLog("[AJAX-ZOOM] "+
k+": "+v)});if(data.image360&&!$.isEmptyObject(data.image360)){images360Data=data.image360;add360(images360Data);if(op.images360firstToLoad){var num360=parseInt(op.images360firstToLoad)==op.images360firstToLoad?op.images360firstToLoad:1;$("#"+uniqueZoomID+"_360_"+num360).trigger("click")}}}});else add360(images360Obj)}if(!showGallery)galContainer.css("display","none").appendTo("body");op.uniqueZoomID=uniqueZoomID;divID.data("aZ",op)};var docReady=function(){initThis();initMouseOverZoom();$("#"+uniqueZoomID).axZmMouseOverZoom(op.mouseOverZoomParam);
$.each(imagesObj,function(k,v){$("#"+uniqueZoomID+"_"+k).axZmMouseOverZoom(op.mouseOverZoomParam)});if(showGallery&&op.galleryAxZmThumbSlider&&$.isFunction($.fn.axZmThumbSlider)){var defaultAxZmThumbSliderParam={firstThumb:"#"+uniqueZoomID+"_"+op.firstImageToLoad,firstThumbPos:"middle",firstThumbTriggerClick:false,firstThumbHighlight:true};galContainer.axZmThumbSlider($.extend(true,{},defaultAxZmThumbSliderParam,op.galleryAxZmThumbSliderParam))}else if(showGallery){$("li",ul).removeClass("selected");
$("#"+uniqueZoomID+"_"+op.firstImageToLoad,ul).addClass("selected")}if(op.images360firstToLoad&&!$.isEmptyObject(op.images360)){var num360=parseInt(op.images360firstToLoad)==op.images360firstToLoad?op.images360firstToLoad:1;$(".axZm_mouseOverWrapper",divID).css("display","none");$("#"+uniqueZoomID+"_360_"+num360).trigger("click")}if(op.hideGalleryOneImage)if(countObj(op.images)+countObj(op.images360)<2&&galContainer&&galContainer.length)galContainer.css("display","none");if(op.adjustContainer){var hhh=
10;setTimeout(function(){$.each(divID.parent().children(),function(){hhh+=$(this).outerHeight()});divID.parent().css("height",hhh)},100)}};if(document.readyState=="complete")docReady();else $(document).ready(function(){docReady()})};$.mouseOverZoomInit.getParam=function(obj){var ref=$("#"+obj);if(ref.length>0)return ref.data("aZ");return{}};$.mouseOverZoom_setOpt=function(rel,opt,key,val,reload){var param=$.mouseOverZoomInit.getParam(rel),val;if(typeof param!="object"||typeof opt==="undefined")return false;
if(typeof val==="undefined"||$("input[name='"+opt+"']").length){val=$("input[name='"+opt+"']:checked").val();if(!val)val=$("input[name='"+opt+"']").val();if(!val)val=$("select[name='"+opt+"']").val()}if(val=="true")val=true;if(val=="false")val=false;if(parseInt(val)==val)val=parseInt(val);if(parseFloat(val)==val)val=parseFloat(val);if(key)if(typeof param[key]=="object"&&param[key][opt]!=="undefined")param[key][opt]=val;else return false;else if(typeof param[opt]!=="undefined")param[opt]=val;else return false;
if(reload)$.mouseOverZoom_reload(rel);return true};$.mouseOverZoom_reload=function(rel){var param=$.mouseOverZoomInit.getParam(rel);if(typeof param=="object"){var uniqueZoomID=param.uniqueZoomID;var curData=$("#"+uniqueZoomID).data();var curID=curData.zoomid;curData.reload=true;$("#"+uniqueZoomID+"_"+curID).trigger("click")}};$.fn.mouseOverZoomInit=function(options){if(this.jquery)$.mouseOverZoomInit(options);else return this.each(function(){if($(this).attr("id"))options.divID=$(this).attr("id");
$.mouseOverZoomInit(options)})}})(jQuery);