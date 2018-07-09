<?php
$clsimage = new SimpleImage;
if(!isset($obj))
    $obj = new CLS_CONTENTS();

$id = ''; $lagid = 0;
if(isset($_GET['id']))
	$id = (int)$_GET['id'];

if($id!= '' && $id!=0) {
	//Dem luot xem bai viet
    	if(!isset($_SESSION['VIEW_ARTICLE_ID']) || $_SESSION['VIEW_ARTICLE_ID']!=$id) {
    		$_SESSION['VIEW_ARTICLE_ID']=$id;
    		$obj->setVisited($id);
    	}
    	$obj->getList(' AND `con_id`='.$id);
    	$row = $obj->Fetch_Assoc();
    	$title = stripslashes($row['title']);
    	$content = stripslashes($row['fulltext']);
    ?>
    <script type="text/javascript">
        (function($) {
            $(function() {
                $(".scroller").simplyScroll({orientation:'vertical',customClass:'vert'});
            });
        })(jQuery);
    </script>

    <div class="breadcrumb">
        <ul class="breadcrumbs wrap">
            <li class="start">
                <a href="<?php echo ROOTHOST?>index.php">Trang chủ</a> 
                <div class="arrow"></div>
                <div class="block light"></div>
                <div class="arrow light"></div>
            </li>
            <li>
                <a><?php echo $title; ?></a>
            </li>
        </ul>
    	<!-- <div class="wrap">
    		<span class="path_breadcrumb" title='<?php	echo $title;?>'>Trang chủ &raquo; <?php	echo $title; ?></span>	
    	</div> -->
    </div>

    <div class="wrap content_body">
        
        <div class="article_col_left">
        	<div class="ls_hot_new">
        		<h3 class="tab_title"><span style="margin-left:10px;">Tin tức</span></h3>
                <div class="scroller">
                <?php
                    $obj->getRamdom();                    
                    if($obj->Num_rows() > 0){
                        while ($row = $obj->Fetch_Assoc()) {
                            $title_r = stripslashes($row["title"]);
                            $intro_r = stripslashes($row["intro"]);                            
                            $img_r = $row["thumb_img"];
                        ?>
                          <div class="item_new_random">
                              <div class="img">
                                    <img src="<?php echo $img_r;?>">  
                              </div>
                              <div class="intro">
                                <h2 class='title' title='<?php echo $title_r;?>'>
                                    <a class="news_title" href="<?php echo ROOTHOST;?><?php echo un_unicode($title_r);?>-post<?php echo $row["con_id"]; ?>.html">        
                                        <?php echo $title_r;?>
                                    </a>
                                </h2>
                                <span><?php echo $intro_r;?></span>
                              </div>
                          </div>  
                        <?php
                        }
                    }

                ?>
                </div>
        	</div>
        	<div class="Advertisement">
                <h2>Cấu hình sản phẩm</h2>
                <a href="#" class="readmore">Xem thêm</a>
                <img src="<?php echo ROOTHOST?>images/configurator.jpg">
            </div>
        </div>
        <div class="content_article">
            <div class="detail_article" style="padding-left:20px;">
                <div class="title">
                    <h3><?php echo $title;?></h3>
                </div>
                <div>
                    <?php echo $content;?>
                </div>    
            </div>
        	
        </div>
    </div>
    <div class="comment">
    </div>
    <?php 
    unset($row); unset($content); unset($title); unset($id); unset($obj);
    } 
?>