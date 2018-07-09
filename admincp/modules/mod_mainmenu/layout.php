<?php
$obj_mnulang=new LANG_MENU;	
$check_isadmin = $UserLogin->isAdmin();
$userlogin=isset($_SESSION["IGFUSERID"])?$_SESSION["IGFUSERID"]:'';
?>
<div id="navitor">
<?php if($UserLogin->isLogin()){?>
    <ul>
        <li>
            <a href="index.php" class="active"><span><?php echo $obj_mnulang->SYSTEM;?></span></a>
            <ul class="submenu">
                <?php if($check_isadmin==true){ ?>
				<li class="space"><a href="index.php?com=config"><span><?php echo $obj_mnulang->SITE_CONFIG;?></span></a></li>
                <li><a href="index.php?com=gusers"><span>Nhóm users</span></a></li>
                <li><a href="index.php?com=users"><span>Quản lý users</span></a></li>
                <?php }?>
                <li><a href="index.php?com=users&task=edit&memid=<?php echo $userlogin;?>"><span>Thông tin cá nhân</span></a></li>
				<li class="space"><a href="index.php?com=users&task=changepass&memid=<?php echo $userlogin;?>"><span>Đổi mật khẩu</span></a></li>
                <li><a href="index.php?com=users&task=logout"><span><?php echo $obj_mnulang->LOGOUT;?></span></a></li>
            </ul>
        </li>
        <li>
            <a href="#"><span><?php echo $obj_mnulang->MENUS;?></span></a>
            <ul class="submenu">
                <li class="space"><a href="index.php?com=menus"><span><?php echo $obj_mnulang->MENUS_MANAGER;?></span></a></li>
                <?php 
                $objmnu=new CLS_MENU();
                $str=$objmnu->getListmenu("list");
				unset($objmnu);
                echo $str;
                ?>
            </ul>
        </li>
        <li>
            <a href="#"><span><?php echo MCONTENT;?></span></a>
            <ul class="submenu">
                <li><a href="index.php?com=category&task=add"><span>Thêm nhóm tin</span></a></li>
                <li class="space"><a href="index.php?com=category"><span>Danh sách nhóm tin</span></a></li>
                <li><a href="index.php?com=contents&task=add"><span>Thêm mới bài viết</span></a></li>
                <li><a href="index.php?com=contents"><span>Danh sách bài viết</span></a></li>
                <li><a href="index.php?com=con_config"><span><?php echo "Cấu hình bài viết";?></span></a></li>
            </ul>
        </li>
		<li>
            <a href="#"><span>Danh mục sản phẩm</span></a>
            <ul class="submenu">
                <li><a href="index.php?com=catalogs&task=add"><span>Thêm Nhóm sản phẩm</span></a></li>
                <li class="space"><a href="index.php?com=catalogs"><span>Danh sách Nhóm sản phẩm</span></a></li>
                <li><a href="index.php?com=products&task=add"><span>Thêm mới sản phẩm</span></a></li>
                <li><a href="index.php?com=products"><span>Danh sách sản phẩm</span></a></li>
                <li><a href="index.php?com=comments"><span>Nhận xét sản phẩm</span></a></li>
            </ul>
        </li>
		<li>
            <a href="#"><span>Quản lý đơn hàng</span></a>
            <ul class="submenu">
                <li><a href="index.php?com=orders"><span>Đơn đặt hàng mới</span></a></li>
                <li><a href="index.php?com=orders&task=process"><span>Đơn hàng đang sử lý</span></a></li>
                <li><a href="index.php?com=orders&task=finished"><span>Đơn hàng đã hoàn thành</span></a></li>
                <li><a href="index.php?com=orders&task=cancel"><span>Đơn hàng đã hủy bỏ</span></a></li>
				<li class="space"><a href="index.php?com=order&task=report"><span>Thống kê & Báo cáo</span></a></li>
            </ul>
        </li>
        <li>
            <a href="index.php?com=contact&task=list"><span>Quản lý liên hệ</span></a>
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
        <li style="display:none;">
            <a href="#"><span><?php echo MHELP;?></span></a>
            <ul class="submenu">
                <li><a href="index.php?com=install"><span><?php echo MABOUT;?></span></a></li>
                <li class="space"><a href="index.php?com=module"><span><?php echo MVERSTION;?></span></a></li>
                <li><a href="index.php?com=module"><span><?php echo MHELP;?></span></a></li>
            </ul>
        </li>
    </ul>
<?php }?>
</div>