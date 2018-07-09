<?php 
$clsimage = new SimpleImage();
$id = 0;
if(!isset($_SESSION['keyword'])) {
	$_SESSION['keyword'] = '';
} 

$key = $_SESSION['keyword'];
if(isset($_GET["id"])) 
	$id = (int)$_GET["id"];
if(isset($_POST["txt_keyword"])) {
	$key = addslashes($_POST["txt_keyword"]);
	$_SESSION['keyword'] = $key;
}
$total_rows = "0";
if (!isset($_SESSION["CUR_PAGE_PRO"]))
	$_SESSION["CUR_PAGE_PRO"] = 1;
if(isset($_POST["txtCurnpage"])){	
	$_SESSION["CUR_PAGE_PRO"] = $_POST["txtCurnpage"];
}
$cur_page = $_SESSION["CUR_PAGE_PRO"];
	
if(!isset($objcat)) $objcat = new CLS_CATALOGS;
$title = $objcat->getNameById($id);
$id = $id."','".$objcat->getCatIDChild('',$id);
unset($objcat);
?>
<style type="text/css">
	.result-search .tab_list_catalog {display: none;}
	.result-search h1 {
		font-size: 18px;
	    margin: 0px;
	    padding: 0px;
	    color: rgba(222, 78, 22, 1);
	    text-align: left;
	    text-decoration: underline;
	}
</style>
<div class="result-search" class="wrap">
	<div class="wrap" style="margin: 20px auto;">
		<h1 class="title" title='Kết quả tìm kiếm với từ khóa <?php	echo $key;?>'>Kết quả tìm kiếm với từ khóa 
	<?php echo $key; ?></h1>
	</div>
<?php
$strwhere = '';
if ($key != '')
	$strwhere .= " AND (`name` like '%$key%' OR `code` like '%$key%') ";
if ($id!='')
	$strwhere .= " AND `cat_id` in ('$id') ";
$obj->getList($strwhere);
$total_rows = $obj->Num_rows();
if ($total_rows > 0) {
	$max_page = ceil($total_rows/MAX_ITEM);
	if ($cur_page > $max_page) {
		$cur_page = $max_page;
		$_SESSION["CUR_PAGE_PRO"] = $cur_page;
	}
	$start_r = ($cur_page - 1) * MAX_ITEM;
	$obj->GetListPro($strwhere,' ORDER BY `mdate` DESC '," LIMIT $start_r,".MAX_ITEM)
?>
    <div id="paging_index"><?php paging_index($total_rows,MAX_ITEM,$cur_page); ?></div>
<?php
} 
else { echo '<div class="wrap" style="margin:20px auto;"><i>Không tìm thấy kết quả nào...</i></div>';}?>
</div>