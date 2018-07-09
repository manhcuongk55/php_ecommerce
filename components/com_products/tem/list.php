<script type="text/javascript">
	$(document).ready(function(){
		$('html, body').animate({ scrollTop: $("#product_wapper .tab_list_catalog_all").offset().top }, 2000);
	})
</script>
<?php 
	$clsimage = new SimpleImage();	
	$total_rows = "0";

	if (!isset($_SESSION["CUR_PAGE_PRO"]))
		$_SESSION["CUR_PAGE_PRO"] = 1;
	if(isset($_POST["txtCurnpage"])) {	
		$_SESSION["CUR_PAGE_PRO"] = $_POST["txtCurnpage"];
	}
	$cur_page = $_SESSION["CUR_PAGE_PRO"];

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
            <a><?php echo "Sản phẩm"; ?></a>
        </li>
    </ul>

</div>

<?php
	$obj->getList();
	$total_rows = $obj->Num_rows();
	if($total_rows > 0) {
		$max_page = ceil($total_rows/MAX_ITEM);
		if($cur_page >= $max_page){
			$cur_page = $max_page;
			$_SESSION["CUR_PAGE_PRO"]=$cur_page;
		}
		$start_r = ($cur_page-1)*MAX_ITEM;		
		$obj->GetAllProducts(" ",' ORDER BY `mdate` DESC '," LIMIT $start_r,".MAX_ITEM)
?>
    <div id="paging_index"><?php paging_index($total_rows, MAX_ITEM, $cur_page); ?></div>
<?php
} 
else { 
	echo "<div class=\"wrap result_empty\">";
	echo 'Hệ thống đang cập nhật. Vui lòng quay lại mục này sau.';
	echo "</div>";
}
?>