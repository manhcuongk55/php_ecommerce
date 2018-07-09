<?php 
	$clsimage = new SimpleImage();
	$id = 0; 

	if (isset($_GET["id"])) {
		$id = (int)$_GET["id"];
	} 	
	$total_rows = "0";

	if (!isset($_SESSION["CUR_PAGE_PRO"]))
		$_SESSION["CUR_PAGE_PRO"] = 1;
	if(isset($_POST["txtCurnpage"])) {	
		$_SESSION["CUR_PAGE_PRO"] = $_POST["txtCurnpage"];
	}
	$cur_page=$_SESSION["CUR_PAGE_PRO"];
		
	if (!isset($objcat)) 
		$objcat = new CLS_CATALOGS;

	$title = $objcat->getNameById($id);
	$id = $id."','".$objcat->getCatIDChild('',$id);
	unset($objcat);
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
            <a><?php	echo $title; ?></a>
        </li>
    </ul>	
</div>

<?php
	$obj->getList(" AND `cat_id` in ('$id') ");
	$total_rows = $obj->Num_rows();
	if($total_rows > 0) {
		$max_page = ceil($total_rows/MAX_ITEM);
		if($cur_page >= $max_page){
			$cur_page = $max_page;
			$_SESSION["CUR_PAGE_PRO"]=$cur_page;
		}
		$start_r = ($cur_page-1)*MAX_ITEM;
		// $obj->getList(" AND `cat_id` in ('$id') ",' ORDER BY `mdate` DESC '," LIMIT $start_r,".MAX_ITEM);
		$obj->GetListPro(" AND `cat_id` in ('$id') ",' ORDER BY `mdate` DESC '," LIMIT $start_r,".MAX_ITEM)
?>
    <div id="paging_index"><?php paging_index($total_rows,MAX_ITEM,$cur_page); ?></div>
<?php
} 
else { 
	echo "<div class=\"wrap result_empty\">";
	echo 'Hệ thống đang cập nhật. Vui lòng quay lại mục này sau.';
	echo "</div>";
}
?>