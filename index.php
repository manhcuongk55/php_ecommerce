<?php
//ini_set('zlib_output_compression','On');
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) 
	ob_start("ob_gzhandler"); 
else ob_start();
session_start();

header("Expires:".gmdate("D, d M Y H:i:s", time()+15360000)."GMT");
header("Cache-Control: max-age=315360000");
//ini_set('display_errors', '1');
if(!isset($_SESSION['SALCODE'])){
	$_SESSION['SALCODE']='';
}
if(isset($_GET['scode']) && $_GET['scode']!=''){
	$_SESSION['SALCODE']=substr($_GET['scode'],6,strlen($_GET['scode'])-6);
}
$_SESSION['SALCD']='';
if($_SESSION['SALCODE']!=''){
	$_SESSION['SALCD']='-scode'.$_SESSION['SALCODE'];
}
// include config
define('incl_path','includes/');
define('libs_path','libs/');

require_once(incl_path.'simple_html_dom.php');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinnit.php');
require_once(incl_path.'gffunction.php');
// include libs
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.template.php');
require_once(libs_path.'cls.module.php');
require_once(libs_path.'cls.menuitem.php');
require_once(LIB_PATH.'cls.category.php');
require_once(LIB_PATH.'cls.content.php');
require_once(LIB_PATH.'cls.catalogs.php');
require_once(LIB_PATH.'cls.products.php');
require_once(LIB_PATH.'cls.simple_image.php');
require_once(LIB_PATH.'cls.saler.php');
require_once(LIB_PATH.'cls.orders.php');
require_once(libs_path.'cls.configsite.php');
require_once(libs_path.'cls.mail.php');

$tmp=new CLS_TEMPLATE();
$tmp_name=$tmp->Load_defaul_tem('site');
$this_tem_path=TEM_PATH.$tmp_name.'/';
// Define this template path
define('THIS_TEM_PATH',$this_tem_path);
$tmp->WapperTem();
ob_end_flush();
?>