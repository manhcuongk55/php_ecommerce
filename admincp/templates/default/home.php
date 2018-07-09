<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(!isset($_SESSION["CUR_MENU"]))
	$_SESSION["CUR_MENU"]="";
if(isset($_GET["cur_menu"]))
	$_SESSION["CUR_MENU"]=$_GET["cur_menu"];
$UserLogin=new CLS_USERS();
?>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="images/igf_logo.ico">
	<link rel="apple-touch-icon" href="images/igf_logo.ico">
	<link rel="apple-touch-icon" sizes="72x72" href="images/igf_logo.ico">
	<link rel="apple-touch-icon" sizes="114x114" href="images/igf_logo.ico">
	<title>CMS Control panel - IGF.COM.VN</title>
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH; ?>css/gfstyle.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH; ?>css/jquery-ui.css" type="text/css" media="all" /> 
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH; ?>css/ui.theme.css" type="text/css"/>

	<script language="javascript" src="../<?php echo JSC_PATH; ?>jquery-1.8.2.min.php"></script>
	<script language="javascript" src="../<?php echo JSC_PATH; ?>jquery-ui-1.8.24.custom.min.php"></script>
	<script language="javascript" src="<?php echo THIS_TEM_ADMIN_PATH; ?>js/calendar_vi.php"></script>
	<script language="javascript" src="<?php echo THIS_TEM_ADMIN_PATH; ?>js/function.php"></script>
	<script language="javascript" src="<?php echo THIS_TEM_ADMIN_PATH; ?>js/check_form.php"></script>
	<script language="javascript" src="<?php echo EDIT_FULL_PATH; ?>"></script>
	<script language="javascript" src="../<?php echo JSC_PATH; ?>gfscript.js"></script>
	<!--<script language="javascript" src="../<?php echo JSC_PATH; ?>jquery.validate.php"></script>-->

	<script language="javascript">
		$(document).ready(function(){
			$("#navitor ul li").each(function(){
				var popup= $(this).find(".submenu");
				if (popup){ 
					$(this).hover(function(){ 
						popup.show(); 
					},function(){ popup.hide(); });
				}else{
					alert("not exit");
				}
			});
		});
	</script>
</head>
<body>
<a name="top" title="site top" href="index.php#"></a>
<div id="wapper">
	<?php require_once(LAG_PATH."vi/general.php");?>
    <?php require_once(LAG_PATH."vi/lang_menu.php");?>
	<?php require_once(MOD_PATH."mod_mainmenu/layout.php");?>
    <div id="body">
   		<?php
    	if($UserLogin->isLogin()!=true){
			include_once(COM_PATH."com_users/task/login.php");
		}
		else{
        ?>
		<div id="path" style="text-align:right; height:30px; line-height:30px;background:#ddd;"><strong>Chào: <?php echo $_SESSION["IGFUSERLOGIN"];?></strong></div>
    	<div id="panel_main">
        	<div class="content" style="margin: 10px;">
                <?php 
					$com="";
					if(isset($_GET["com"]))
					$com=$_GET["com"];
					if(!is_file(COM_PATH."com_".$com."/layout.php"))
						$com='fronpage';
					include(COM_PATH."com_".$com."/layout.php");
				?>
            </div>   
			<div class="clr">&nbsp;</div>
        </div>
        <?php } ?>
    </div>
    <div id="footer"><?php //load_mod("footer");?><?php require_once(MOD_PATH."mod_footer/layout.php");?></div>
	<div class="clr">&nbsp;</div>
</div>
</body>
</html>