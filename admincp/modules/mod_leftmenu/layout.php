<style type="text/css">
ul#main{
	margin: 0px;
	padding: 0px;
	background-color: #EEE;	
}
ul#main li{
	display: block;
	list-style: none;
}
ul#main li a{
	height: 27px;
	display: block;
	line-height: 27px;
	padding-left: 11px;
	border-bottom:  #CCC 1px dashed;
}
ul#main li a:hover{
	background-color: #CCC;
}
ul#main ul.level1,ul#main ul.level2{
	margin: 0px;
	padding: 0px;
	position: absolute;
	z-index: 999px;
	margin-left: 200px;
	margin-top: -27px;
	width: 200px;
	background-color: #EEE;
	border: #036 1px solid;
	display: none;
}
</style>

<?php 
if(!isset($objuser)) $objuser = new CLS_USERS();
$check_isadmin = $objuser->isAdmin();
?>
<ul id="main">
    <li>
        <a href="index.php" class="active"><span><?php echo $obj_mnulang->SYSTEM;?></span></a>
        <ul class="submenu">
            <li><a href="index.php">Bảng điều khiển</a></li>
            <?php if($check_isadmin==true){ ?>
            <li><a href="index.php?com=gusers"><span>Phân quyền người dùng</span></a></li>
            <li><a href="index.php?com=users"><span>Quản lý người dùng</span></a></li>
            <li class="space"><a href="index.php?com=config"><span><?php echo $obj_mnulang->SITE_CONFIG;?></span></a></li>
            <?php }
			else {?>
            <li><a href="index.php?com=users&task=edit&memid=<?php echo $_SESSION["IGFUSERID"];?>"><span>Thông tin người dùng</span></a></li>
            <?php } ?>
        </ul>
    </li>
    <li>
        <a href="index.php?com=register"><span>DS đăng ký học</span></a>
    </li>
    <li>
        <a href="#"><span><?php echo $obj_mnulang->MENUS;?></span></a>
        <ul class="submenu">
            <li class="space"><a href="index.php?com=menus"><span><?php echo $obj_mnulang->MENUS_MANAGER;?></span></a></li>
            <?php 
            $mnuobj=new CLS_MENU();
            $str=$mnuobj->getListmenu("list");
            echo $str;
            ?>
        </ul>
    </li>
    <li>
        <a href="#"><span><?php echo MCONTENT;?></span></a>
        <ul>
            <li class="space"><a href="index.php?com=category"><span><?php echo MCATEGORY;?></span></a></li>
            <li><a href="index.php?com=contents"><span><?php echo MARTICLE;?></span></a></li>
        </ul>
    </li>
    <?php if($check_isadmin==true){ ?>
    <li>
        <a href="#"><span><?php echo MEXTENSION;?></span></a>
        <ul class="submenu">
            <li><a href="index.php?com=components"><span><?php echo MCOMPONENT;?></span></a></li>
            <li><a href="index.php?com=module"><span><?php echo MMODULES;?></span></a></li>
            <li><a href="index.php?com=template"><span><?php echo MTEMPLATE;?></span></a></li>
            <li><a href="index.php?com=language"><span><?php echo MLANGUAGE;?></span></a></li>
        </ul>
    </li>
    <?php } ?>
</ul>