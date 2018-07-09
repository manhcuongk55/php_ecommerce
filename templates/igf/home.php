<?php
//$this->getFullURL();
if(!isset($_SESSION['CUR_MENU']))
	$_SESSION['CUR_MENU']='';
if(!isset($_SESSION['CUR_MENU']))
	$_SESSION['CUR_MENU']='';
if(isset($_GET['cur_menu']))
	$_SESSION['CUR_MENU']=(int)$_GET['cur_menu'];
if(!isset($_SESSION['CUR_CAT']))
	$_SESSION['CUR_CAT']='8';
if(isset($_GET['cpar']))
	$_SESSION['CUR_CAT']=(int)$_GET['cpar'];
	
$conf = new CLS_CONFIG();
$conf->load_config();
?>
<!DOCTYPE html>
<html lang='vi' xml:lang='vi' xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="generator" content="HTML Tidy for Linux (vers 25 March 2009), see www.w3.org" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="robots" content="index, follow" >
		<meta name="author" content='<?php echo $conf->CompanyName;?>' >
		<meta name="keywords" content='<?php echo $conf->Meta_keyword;?>' >
		<meta name="description" content='<?php echo $conf->Meta_descript;?>' >
		<meta name="DC.title" content="Cong ty TNHH Tan Vuong chuyen cung cap cac san pham may che bien go uy tin chat luong hang dau Viet nam" >		
		<META NAME="DC.type" scheme="DCMIType" content="text"> 
		<meta name="DC.language" scheme="RFC1766" content="vi">
		<META NAME="DC.date" scheme="W3CDTF" content="2012-11-10"> 
		<META NAME="DC.format" scheme="IMT" content="text/html"> 
		<meta name="DC.identifier" content="/meta-tags/dublin/">
		<meta name="DC.source" content="/meta-tags/">
		<meta name="geo.region" content="VN-64" >
		<meta name="geo.placename" content="H&agrave; Nội" >
		<meta name="geo.position" content="20.9876;105.7973" >
		<meta name="ICBM" content="20.9876, 105.7973" >
		<meta name="alexaVerifyID" content="S95bdU2EC26P4hpeORb_yim5Wuc" >
		<meta name="msvalidate.01" content="D7AFAB199353195C18BA43F452CBBCCC" />
		<meta name="msvalidate.01" content="D7AFAB199353195C18BA43F452CBBCCC" />
		<title><?php echo $conf->Title;?></title>
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="shortcut icon" href="images/igf_logo.ico" type="image/x-icon">
		<link rel="apple-touch-icon" href="images/igf_logo.ico" type="image/x-icon">
		<link rel="apple-touch-icon" sizes="72x72" href="images/igf_logo.ico" type="image/x-icon">
		<link rel="apple-touch-icon" sizes="114x114" href="images/igf_logo.ico" type="image/x-icon">
		<link rel="author" href="https://plus.google.com/104865876192816973878/posts?hl=vi"/>

		<!-- css -->
		<link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/gf-style.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/main.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/jquery.bxslider.css" rel="stylesheet" type="text/css"/>
		<!-- javascript -->
		<script type="text/javascript" src="<?php echo ROOTHOST;?>js/jquery-1.12.0.min.js"></script>
		<script type="text/javascript" src='<?php echo ROOTHOST;?>js/jquery-1.8.2.min.php'></script>	
		<script type="text/javascript" src="<?php echo ROOTHOST; ?>js/gfscript.js"></script>		
		<script type="text/javascript"  src='<?php echo ROOTHOST;?>js/main.js'></script>

		<script type="text/javascript" src="<?php echo ROOTHOST; ?>js/jquery.bxslider.js"></script>

       <!-- slide -->
        <script type="text/javascript" src="<?php echo ROOTHOST;?>modules/mod_slide/js/slideshow.js"></script>

		<!-- Accordion -->
        <script type="text/javascript" src="<?php echo ROOTHOST;?>js/jquery-ui-1.8.13.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo ROOTHOST;?>js/jquery.multi-open-accordion-1.5.3.min.js"></script>
		
		<!-- Scroll jquery -->
		<link type="text/css" rel="stylesheet" href="<?php echo ROOTHOST; ?>css/jquery-ui-1.8.9.custom/jquery-ui-1.8.9.custom.css" />
		<link href="<?php echo ROOTHOST; ?>css/jquery.simplyscroll.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript"  src='<?php echo ROOTHOST;?>js/jquery.simplyscroll.js'></script>

		 <!-- jcarousel         -->
        <script type="text/javascript" src="<?php echo ROOTHOST;?>js/jcarousel/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="<?php echo ROOTHOST;?>js/jcarousel/jcarousel.basic.js"></script>

        <!-- search API -->
        <!--<script src="https://www.google.com/jsapi"></script>-->		
		<script type="text/javascript">
			// google.load('search', '1');
	  //       google.setOnLoadCallback(function(){
	  //         new google.search.CustomSearchControl('crefUrl':'http://tanvuong.com.vn/').draw('cse');
	  //       }, true);			
		</script>
</head>
<body class="home blog header-image full-width-content">
    <div id="outer_wrap">
        <div id="wrap">
			<!-- header -->
			<header class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
				<div class="wrap">
					<div class="title-area">
						<a title="martin" class="martin_logo" href="<?php echo ROOTHOST?>index.php">
				        	<img src="<?php echo ROOTHOST;?>images/logo_2.png" alt="Logo">				        	
			    		</a>			    		
		    		</div>
		    		<aside class="widget-area header-widget-area">
		    			<!-- <div id="cse">
					        <script>
							      (function() {
							        var cx = '006954037637331151363:lzoy6xubmgs';
							        var gcse = document.createElement('script');
							        gcse.type = 'text/javascript';
							        gcse.async = true;
							        gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
							            '//cse.google.com/cse.js?cx=' + cx;
							        var s = document.getElementsByTagName('script')[0];

							        s.parentNode.insertBefore(gcse, s);
							      })();
						    </script>
						    <gcse:search></gcse:search>
						</div> -->

						<section id="search-3" class="">
							<div class="widget-wraps" style="width: 270px;">
								<form method="POST" id="search_form" action="<?php echo ROOTHOST;?>tim-kiem-san-pham.html" style="margin-top: -10px;">
									<input type="search" name="txt_keyword" placeholder="Search..."  style="height: 32px; line-height: 32px;" />
									<input type="submit" name="btn_search" value="Tìm kiếm" style="text-transform: none;" />
								</form>
								<div id="gf-clock" style="margin-top: 10px"></div>
							</div>
						</section>
					</aside>
				</div>
			</header>
			
			<!-- wrapper -->
			<div id="nav_wrapper" >
		        <div class="nav_bg">&nbsp;</div>
		        <div class="static_nav_bg">&nbsp;</div>
		        <div class="wrap">
		        	<!-- Top menu -->
			    	<nav class="nav-primary" role="navigation" itemscope="itemscope">
					    <div class="wrap">						   
							<?php $this->loadModule("navitor");?>
							<div id="google_translate_element"></div>
								<script type="text/javascript">
									function googleTranslateElementInit() {
										new google.translate.TranslateElement({pageLanguage: 'vi', includedLanguages: 'en,ja,ko,vi,zh-TW', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
									}
								</script>
								<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
							<!-- <div class="language">
								<ul>
									<li class="vi"><a href=""><img src="<?php echo ROOTHOST;?>images/icons/flag_vn.png"></a></li>
									<li class="en"><a href=""><img src="<?php echo ROOTHOST;?>images/icons/flag_en.png"></a></li>
								</ul>
							</div> -->
						</div>
					</nav>        
					<!-- end top menu -->

					<!-- menu product category-->
					<div id="static_menu"> 
        				<?php $this->loadModule("user1");?>
						<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
		                <a href="#" class="jcarousel-control-next">&rsaquo;</a>
			        </div>
			        <!-- end menu product category -->
			        		     
		    	</div>
		    </div>
			<!-- intro & list block -->
			<?php $this->loadComponent();?>
			<!-- end list block -->

		</div>

	<!-- footer -->
	<div class="footer-widgets">
        <div class="wrap">
            <div class="footer-widgets-1 widget-area">
               <section id="nav_menu-2" class="widget widget_nav_menu">
                  <div class="widget-wrap" id="tv_map">    
                  	<h4 class="widget-title widgettitle">Bản đồ</h4>                 
                    <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:300px;width:660px;'><div id='gmap_canvas' style='height:300px;width:660px;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='https://embed-map.org/'>embedding google maps</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=800eaa38ff9ab974c5e73e884eaf399ef31c8f05'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:18,center:new google.maps.LatLng(20.995945,105.86112200000002),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(20.995945,105.86112200000002)});infowindow = new google.maps.InfoWindow({content:'<strong>Công ty TNHH TM Tân Vương</strong><br>199 Minh Khai Quận Hai Bà Trưng Hà Nội<br> Hanoi<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                  </div>
               </section>
            </div>
            <div class="footer-widgets-3 widget-area">
               <section id="text-14" class="widget widget_text">
                  <div class="widget-wrap">
                      <h4 class="widget-title widgettitle">VP Hà Nội</h4>
                     <div class="textwidget">
                        Địa chỉ     : 199 Minh Khai - Q.Hai Bà Trưng - TP.Hà Nội <br/>
                  		Điện thoại: 04 3633 4888 - Fax: 04 3633 4899<br/>
                  		Email       : maychebiengo.tanvuong@gmail.com<br/>
                     </div>
                     <div style="clear:both; height:20px;"></div>
                     <h4 class="widget-title widgettitle">VP Hồ Chí Minh</h4>
                     <div class="textwidget">
                     	Địa chỉ         : 182 QL1A - P.Tam Bình - Q.Thủ Đức - TP.HCM</br>
		                Điện thoại    : 08 3729 3936 - 08 3729 3424  - Fax: 08.3729 4937</br>
		                Đt Bảo Hành : 08 3729 7061</br>
		                Email           : kinhdoanhtanvuong6@gmail.com</br>
                        <a href="http://tanvuong.com.vn">tanvuong.com.vn</a><br/>
                     </div>

                  </div>
               </section>

                <div class="copyright_footer">
				    © 2016 Công ty TNHH TM  Tân Vương<br />
				 </div>
            </div>
        </div>
    </div>
    <!-- end footer -->
	</div>  

	<div id="content"></div>
	<a href="#" id="back-to-top" title="Back to top">
		<img src="<?php echo ROOTHOST;?>images/back.png" alt="Logo">				        	
	</a>
</body>
</html>