<?php
include_once(libs_path.'cls.menuitem.php');
$objmenuitem=new CLS_MENUITEM;
echo $objmenuitem->ListMenuItemCat($r['mnu_id'],0,0,0);
unset($objmenuitem);
?>