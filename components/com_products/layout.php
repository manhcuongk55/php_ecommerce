<?php
$COM = 'products';
$obj = new CLS_PRODUCTS;
$clsimage = new SimpleImage;
?>
<div id="product_wapper">
	<?php
		$viewtype = '';
		if (isset($_GET['viewtype'])) {
			$viewtype = addslashes($_GET['viewtype']);
		}
		if (is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php'))
			include('tem/'.$viewtype.'.php');
		unset($viewtype); unset($obj); unset($COM);
	?>
</div>