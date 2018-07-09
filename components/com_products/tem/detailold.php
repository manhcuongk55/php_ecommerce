<?php
$id='';
if(isset($_GET['id']))
	$id=(int)$_GET['id'];
if($id!='' && $id!=0){
	//Dem luot xem bai viet
	if(!isset($_SESSION['VIEW_PRODUCT_ID']) || $_SESSION['VIEW_PRODUCT_ID']!=$id) {
		$_SESSION['VIEW_PRODUCT_ID']=$id;
		$obj->setVisited($id);
	}
	$obj->getList(' AND `pro_id`='.$id);
	$row=$obj->Fetch_Assoc();
	$proid=$row['pro_id'];
	$catid=$row['cat_id'];
	$cur_name=stripslashes($row['name']);
	$intro=stripslashes($row['intro']);
	$content=stripslashes($row['fulltext']);
	$old_price=$row['old_price'];
	$cur_price=$row['cur_price'];
	$prersen=ceil(($old_price-$cur_price)/$old_price*100);
	$visited=$row['visited'];
	$img = str_replace('thumb/','',stripslashes($row["thumb"]));
	if($img=='')
		$img=$clsimage->get_image(stripslashes($content));
	$imgs=$clsimage->get_images(stripslashes($content));
	//print_r($imgs);
?>
<div id='top_deal'>
	<div class='pro_info'>
		<img align='center' width='auto' height='auto' src='<?php echo $img;?>'/>
		<div class='info'>
		<div class='content'>
			<h1 title='<?php echo $cur_name;?>'><?php echo $cur_name;?></h1>
			<div id='bar' style='border-bottom:#ccc 1px solid;'><a href='#detail' style='margin-right:11px; '>Xem chi tiết</a> <a href='#comment' style=''>Thắc mắc về sản phẩm - Hỏi ngay ?</a></div>
			<div class='intro'><?php echo $intro;?></div>
			<div class='price'>
				<div class='content'>
					<div class="O_N"><div class="Old_new"><span class='cur_price'><?php echo number_format($cur_price);?></span> <span>đ</span></div>
					<div class="Old_new"><span class='old_price'><del><?php echo number_format($old_price);?></del> đ(-<?php echo $prersen;?>%)</span></div> </div>
					<div class="Ad_cart"><a href='<?php echo ROOTHOST;?>them-gio-hang-sp<?php echo $proid;?>.html' class='add_cart' title='Đặt mua Buffet Lẩu Nướng không khói Chef Dzung’s'></a></div>
				</div>
			</div>
			<div class='top_buy'>
				<h2 title='Người mua Buffet Lẩu Nướng không khói Chef Dzung’s'>Đã có <span class='number'>3</span> người đặt mua</h2>
				<ol start='315'>
					<li>.Lê hồng hạnh</li>
					<li>.Nguyễn Yến Vi</li>
					<li>.Hà Quỳnh Anh</li>
				</ol>
				<a href=''>Tất cả</a>
			</div>
			<div id='clock'>Chỉ còn 4 ngày 21:22’:19”</div>
		</div>
		</div>
	</div>
	<div class='like'>
		<span class='visit'>Lượt xem: <?php echo $visited;?></span>
		<span class='ads'> Lượt quảng cáo: 1.098.105</span>
		<span class='like'> Độ hấp dẫn: 30.888</span>
		<span class='like-fb'>
		<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style ">
			<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>Bạn thích!
			</div>
			<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
			<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50b1aac8190d6c29"></script>
			<!-- AddThis Button END -->
			
		</span>
	</div>
</div>
<?php // -------------------------LIKE------------------------------?>
<div class="like_product">
<h1 class="title" title='Sản phẩm tương tự với <?php echo $cur_name;?>'><a href='#'>Sản phẩm tương tự với "<?php echo $cur_name;?>"</a></h1>
<?php
$obj->GetListPro(" AND `cat_id` in ('$catid') ",' ORDER BY RAND() ',' LIMIT 0,4');
?>
<div class='clr'></div>
</div>
<?php // --------------------------END LIKE-----------------------------?>
<div class="detail_product" name='detail'><a href='#detail' name='detail'></a>
	<h1 class="title" title='chi tiết sản phẩm <?php echo $cur_name;?>'>Chi tiết sản phẩm "<?php echo $cur_name;?>"</h1>
	<p><?php echo $content;?></p>
	<hr/>
	<h3 title="" align="center">Bạn thích sản phẩm này <?php echo $cur_name;?>!</h3>
	<div class="" style="text-align:center;">
		<a href="<?php echo ROOTHOST;?>them-gio-hang-sp<?php echo $proid;?>.html" title="Mua ngay" style="width:150px; height:65px; border-radius:6px; text-align:center; color:#fff; background:#1199FF;line-height: 65px;text-transform: uppercase;font-size: 21px; font-weight: bold;display: inline-block;">Mua ngay</a>
	</div>
	<hr/>
	<div id='prodct_comment'><a href='#comment' name='comment'></a>
		<script language='javascript'>
		$(document).ready(function(){
			$('#txt_name').focus(function(){
				if($(this).val()=='Họ và tên')
					$(this).val('');
			});
			$('#txt_name').blur(function(){
				if($(this).val()=='')
					$(this).val('Họ và tên');
			});
			$('#txt_email').focus(function(){
				if($(this).val()=='Hộp thư')
					$(this).val('');
			});
			$('#txt_email').blur(function(){
				if($(this).val()=='')
					$(this).val('Hộp thư');
			});
			$('#txt_content').focus(function(){
				if($(this).val()=='Nội dung...')
					$(this).val('');
			});
			$('#txt_content').blur(function(){
				if($(this).val()=='')
					$(this).val('Nội dung...');
			});
			$('#txt_content').keypress(function(event){
				if (event.which == 13 ) {
					var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					if($('#txt_name').val()==''&& $('#txt_name').val()=='Họ và tên'){ alert('Bạn hãy nhập tên bạn'); return false;}
					if($('#txt_content').val()==''&& $('#txt_content').val()=='Nội dung...'){ alert('Bạn hãy nhập nội dung'); return false;}
					if(regex.test($('#txt_email').val())==false){ 
						alert('Email không đúng định dạng, bạn hãy kiểm tra và thử lại'); 
						return false;
					}
					var proid=$('#txt_proid').val();
					var mess=$('#txt_content').val();
					var name=$('#txt_name').val();
					var email=$('#txt_email').val();
					$('#txt_content').val('Loadding...');
					$.post('http://muathu7.vn/ajaxs/addcomment.php',{txt_pro: proid, txt_content: mess,txt_name: name,txt_email: email},function(data){
						if(data=='Success')
							alert('Cảm ởn bạn đã gửi bình luận tới muathu7.vn. Bình luận của bạn sẽ được hiển thị sau khi kiểm duyệt!');
						else{
							alert('Server đang quá tải, mời bạn chờ ít phút rồi thử lại');
						}
						$('#txt_content').val('Nội dung...');
					});
				}
			})
			$(".item_comment textarea").keypress(function(event) {
			  if (event.which == 13 ) {
				var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if($('#txt_name').val()==''&& $('#txt_name').val()=='Họ và tên'){ alert('Bạn hãy nhập tên bạn'); return false;}
				if($(this).val()==''){ alert('Bạn hãy nhập nội dung'); return false;}
				if(regex.test($('#txt_email').val())==false){ 
					alert('Email không đúng định dạng, bạn hãy kiểm tra và thử lại'); 
					return false;
				}
				var parid=$(this).attr("id"); 
				var proid=$('#txt_proid').val();
				var mess=$(this).val();
				var name=$('#txt_name').val();
				var email=$('#txt_email').val();
				$('#txt_content').val('Loadding...');
				$.post('http://muathu7.vn/ajaxs/addcomment.php',{txt_par:parid,txt_pro: proid, txt_content: mess,txt_name: name,txt_email: email},function(data){
					if(data=='Success')
						alert('Cảm ởn bạn đã gửi bình luận tới muathu7.vn. Bình luận của bạn sẽ được hiển thị sau khi kiểm duyệt!');
					else{
						alert('Server đang quá tải, mời bạn chờ ít phút rồi thử lại');
					}
					$('#txt_content').val('Nội dung...');
				});
			   }
			});
		});
		</script>
		<?php
		ini_set('display_errors',1);
		include_once('libs/cls.comment.php');
		$objcomm=new CLS_COMM;
		$objcomm->getList(' AND pro_id='.$proid);
		$name=isset($_SESSION['NAME_COMMENT'])?$_SESSION['NAME_COMMENT']:'Họ và tên';
		$email=isset($_SESSION['EMAIL_COMMENT'])?$_SESSION['EMAIL_COMMENT']:'Hộp thư';
		
		?>
		<h2 title='Hỏi đáp'>Hỏi đáp (<?php echo $objcomm->Num_rows();?>)</h2>
		<div class='name'>Hỏi đáp về <strong>"<?php echo $cur_name;?>"</strong> ở đây:</div>
		<form method='post' action=''>
			<table width='100%'>
				<tr><td width=150><input type='text' name='txt_name' id='txt_name' value='<?php echo $name;?>'/></td>
				<td><input type='text' name='txt_email' id='txt_email' value='<?php echo $email;?>'/></td></tr>
				<tr><td colspan=2><input type='hidden' name='txt_proid' id='txt_proid' value='<?php echo $proid;?>'/>
				<textarea name='txt_content' id='txt_content' style='width:100%; clear:both;' >Nội dung...</textarea>
				</td></tr>
			</table>
		</form>
		<div id='comment_wapper'>
		<table width='100%'>
			<?php 
				$objcomm->getCommentByProId($proid);
			?>
		</table>
		</div>
	</div>
</div>
<?php 
unset($row); unset($product); unset($title); unset($id);
} 
?>