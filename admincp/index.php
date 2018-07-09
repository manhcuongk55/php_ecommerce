<?php
session_start();
ini_set('display_errors', '1');
// include config
define('incl_path','../includes/');
define('libs_path','libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinnit.php');
require_once(incl_path.'gffunction.php');
// include libs
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.users.php');
require_once(libs_path.'cls.menu.php');
require_once(libs_path.'cls.template.php');
// include language
$UserLogin=new CLS_USERS;
$tmp=new CLS_TEMPLATE;

$tmp->Load_defaul_tem('admin');
$tmp->Load_lang_default();
$tmp->Load_Extension();

$this_tem_path=TEM_PATH.$tmp->Name.'/';
// Define this template path
define('ISHOME',true);
define('THIS_TEM_ADMIN_PATH',$this_tem_path);
// Getinfo
$tmp->WapperTem();