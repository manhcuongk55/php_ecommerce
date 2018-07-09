<?php
ini_set('display_errors',1);
$COM='members';
?>

<div class="breadcrumb">
	<ul class="breadcrumbs wrap">
        <li class="start">
            <a href="<?php echo ROOTHOST?>index.php">Trang chủ</a> 
            <div class="arrow"></div>
            <div class="block light"></div>
            <div class="arrow light"></div>
        </li>
        <li>
            <a>Đặt hàng</a>
        </li>
    </ul>	
</div>
<div class='content'style="margin-top: 20px;">
	<div id="col_main">
		<div class='content' style='padding:0px;'>
		<?php
			$viewtype = '';
			if(isset($_GET['viewtype'])){
				$viewtype = addslashes($_GET['viewtype']);
			}
			if(is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php'))
				include_once('tem/'.$viewtype.'.php');	
			unset($viewtype); unset($obj); unset($COM);
		?>
		</div>
	</div>
<div class='clr'></div>
</div>