<div class='content'>
	<div id='col_main'>
	<?php
		$COM = 'contents';
		$obj = new CLS_CONTENTS;
		$viewtype = '';
		if(isset($_GET['viewtype'])){
			$viewtype = addslashes($_GET['viewtype']);
		}
		if(is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php'))
			include('tem/'.$viewtype.'.php');
		unset($viewtype); unset($obj); unset($COM);
	?>
	</div>
<div class='clr'></div>
</div>