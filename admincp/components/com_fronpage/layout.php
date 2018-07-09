<?php
	defined("ISHOME") or die("Can't acess tdis page, please come back!");
?>
<style type="text/css">
fieldset{
	overflow: hidden;
	clear: both;
	display: block; border: 1px dotted #ccc
}
div.clear{ clear: both;}
div.fun_icon{
	width: 145px;
	height: 110px;
	text-align: center;
	display: block;
	float: left;
	margin: 10px;
	overflow: hidden;
	border: #DDDDDD 1px solid;
}
div.fun_icon img{ width: 80px; height: 80px; margin: 3px; border: none; clear:both}
</style>


<?php
if(!isset($objuser)) $objuser = new CLS_USERS();
$check_isadmin = $objuser->isAdmin();
?>
<table width="100%" border="0" cellpadding="5" cellspacing="0" widtd="100%">
  <tr>
    <td valign="top" scope="col">
    <?php if($check_isadmin==true){ ?>
    <div class="fun_icon"><a href="index.php?com=gusers"><img src="images/icon-user.jpg"/></a><div>Phân quyền người dùng</div></div>
    <div class="fun_icon"><a href="index.php?com=users"><img src="images/user-info-icon.png"/></a><div>Quản lý người dùng</div></div>
    <?php } else {?>
    <div class="fun_icon"><a href="index.php?com=users&task=edit&memid=<?php echo $_SESSION["IGFUSERID"];?>"><img src="images/user-info-icon.png"/></a><div>Quản lý người dùng</div></div>
    <?php } ?>
    <?php if($check_isadmin==true){ ?>
    <div class="fun_icon"><a href="index.php?com=config"><img src="images/icon_config.png"/></a><div>Cấu hình Website</div></div>
    <?php } ?>
    <div class="fun_icon"><a href="index.php?com=menus"><img src="images/icon_menu.png"/></a><div>Quản lý Menu</div></div>
    <div class="fun_icon"><a href="index.php?com=category"><img src="images/icon_category.gif"/></a><div>Nhóm tin</div></div>
    <div class="fun_icon"><a href="index.php?com=contents"><img src="images/icon_article.png"/></a><div>Bài viết</div></div>
    <?php if($check_isadmin==true){ ?>
    <div class="fun_icon"><a href="index.php?com=con_config"><img src="images/icon_config.gif"/></a><div>Cấu hình cho bài viết</div></div>
    <div class="fun_icon"><a href="index.php?com=components"><img src="images/component.png"/></a><div>Thành phần Website</div></div>
    <div class="fun_icon"><a href="index.php?com=module"><img src="images/icon_mod.png"/></a><div>Quản lý module</div></div>
    <div class="fun_icon"><a href="index.php?com=template"><img src="images/icon_template.png"/></a><div>Quản lý giao diện</div></div>
    <div class="fun_icon"><a href="index.php?com=language"><img src="images/language.png"/></a><div>Quản lý ngôn ngữ</div></div>
    <?php } ?>
	</td>
	<td width="270"></td>
</table>