<?php 
require_once(libs_path."gfclass/cls.simple_image.php");
if(!isset($clsimage)) $clsimage = new SimpleImage();

$catid=0;
if(isset($_GET["catid"])) $catid = (int)$_GET["catid"];
if(!isset($objmedia))
	$objmedia=new CLS_CONTENTS();
$total_rows="0";
if(!isset($_SESSION["CUR_PAGE_MNU"]))
	$_SESSION["CUR_PAGE_MNU"]=1;	
if(isset($_POST["cur_page"])){	$_SESSION["CUR_PAGE_MNU"]=$_POST["cur_page"];	}

$cur_page=$_SESSION["CUR_PAGE_MNU"];	
if(isset($_POST["txtCurnpage"])) $cur_page=(int)$_POST["txtCurnpage"];
	
if(!isset($objdata)) $objdata = new CLS_MYSQL;
if(!isset($objcat)) $objcat = new CLS_CATE;

$catid = $catid."','".$objmedia->getCatIDChild($catid);
$objmedia->getList($catid,'ORDER BY `con_id`');
if($objmedia->Numrows()>0){
	$total_rows=$objmedia->Numrows();
	$objmedia->ListByPaging($catid,'ORDER BY `con_id` DESC ',$cur_page);
	$i=1;
	while($rows=$objmedia->FetchArray())
	{
		$title = stripslashes($rows["title"]);
		$intro = stripslashes(trim($rows["intro"]));
		$img ='';
		$img = $rows["thumb_img"];
		$width="100%"; 
		if($img!='') $img='<img src="'.$img.'" title="'.$title.'" align="left" class="img_block"/>';
		
		if($i==2) $class='intro_right';
		else $class='';	
?>
<div class="content_body">
<div class="news <?php echo $class;?>">
    <div class="intro">
		<?php echo $img;?>
    	<h4><a class="news_title" href="index.php?com=contents&viewtype=article&item=<?php echo $rows["con_id"]; ?>">		
        <?php echo $title;?></a></h4>
		<?php echo $intro; ?>
    </div>
    <div style="float:right; pading-right:21px; color:#647F9F; margin-top: 0px;" class="readmore">		
        <a style="text-decoration: none; color:#647F9F;" class="btn_detail" href="index.php?com=contents&viewtype=article&item=<?php echo $rows["con_id"]; ?>">Đọc thêm</a>	
    </div>
</div>

<?php 
if($i==2) echo '<div class="course_space">&nbsp;</div>';
if($i==1) $i=2; else $i=1;
} 
?>
    <div id="paging_index">
    <?php 
        paging_index($total_rows,MAX_ROWS_INDEX,$cur_page);
    ?>
    </div>
</div>
<?php
} 
else { echo 'Hệ thống đang cập nhật. Vui lòng quay lại mục này sau.';}?>

