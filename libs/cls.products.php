<?php
class CLS_PRODUCTS{
	private $objmysql = null;
	public function CLS_PRODUCTS(){
		$this->objmysql = new CLS_MYSQL;
	}
	public function getList($where=' ',$order=' ORDER BY RAND() ',$limit=' '){
		$sql = "SELECT * FROM `tbl_product` WHERE isactive=1 ".$where.$order.$limit;
		return $this->objmysql->Query($sql);
	}
	public function getPriceById($Pro_id){
		$sql = "SELECT `cur_price` FROM `tbl_product` WHERE pro_id=$Pro_id ";
		$this->objmysql->Query($sql);
		$row = $this->objmysql->Fetch_Assoc();
		return $row['cur_price'];
	}
	public function NumProByCatid($catid){
		$objdata = new CLS_MYSQL;
		$sql = "SELECT * FROM `tbl_product` WHERE isactive=1 AND cat_id='$catid' ";
		$objdata->Query($sql);
		return $objdata->Num_rows();
	}
	public function GetListPro($where=' ',$order=' ORDER BY RAND() ',$limit=' '){
		$sql = "SELECT * FROM `tbl_product` WHERE isactive=1 ".$where.$order.$limit;
		// echo $sql;
		$objdata = new CLS_MYSQL();
		$objcat = new CLS_CATALOGS;
		$objorder = new CLS_ORDER;
		$objdata->Query($sql);
		$clsimage = new SimpleImage;
		if(!isset($_SESSION['ORDER_NUM'])) {
			$_SESSION['ORDER_NUM']=array();
		}

		?>

		<div class="wrap">
			<div class="tab_list_catalog">
				<ul>
					<li class="all_items"><a href="#">Tất cả</a></li>
					<?php 
						if(isset($_GET['com'])) {
							$cat_id = $_GET['id'];
							$sql = "SELECT `cat_id`,`name`,`class` FROM `tbl_catalog`  WHERE isactive=1 AND par_id='$cat_id'";
	                        $obj_sub = new CLS_MYSQL;
	                        $obj_sub->Query($sql);
	                        $n = $obj_sub->Num_rows();
	                        for($i=0; $i<$n; $i++)
	                        {
	                            $row1=$obj_sub->Fetch_Assoc();
	                       	    echo "<li><a href='".ROOTHOST.un_unicode($row1['name']).'-np'.$row1['cat_id'].'-p'.$row1['cat_id'].".html' title='".$row1['name']."'><span>".$row1['name']."</span></a></li>";
	                        }
						}
					?>
				</ul>
			</div>
			<div class="list_item_product">
		<?php
		$stt = 0; 
		$total = $objdata->Num_rows();		
		$aryNumber = array();
		for ($i=1; $i < $total ; $i=$i+3) { 
			array_push($aryNumber, $i);
		}

		while($row = $objdata->Fetch_Assoc()) {
			$cls = '';
			if(in_array($stt, $aryNumber)) {
				$cls = 'middel';
			}

			$id = $row["pro_id"];
			$num_buy = rand(50, 200);
			$_SESSION['ORDER_NUM'][$id] = $num_buy;
			
			$catname = $objcat->getNameById($row["cat_id"]);
			$name = stripslashes($row["name"]);
			$code = stripslashes($row["code"]);
			$intro = stripslashes($row["intro"]);
			$clsColor = stripslashes($row["class"]);			

			$img = stripslashes($row["thumb"]);
			// if($img == '') {
			// 	$img = $clsimage->get_image(stripslashes($row["fulltext"]));
			// }

			if($img == '') {
				$img = ROOTHOST.'images/no_images.jpg';
				$cl = 'no_images';
			} else {
				$cl = '';
			}
			
			$imgtag ='<img src="'.$img.'" title="'.$name.'" alt="'.$name.'" class="'.$cl.'"/>';
		?>
			<div class="item <?php echo $cls ?>">
				<div class='content'>
					<div class='picture <?php echo $clsColor ?>'>
						<a href='<?php echo ROOTHOST.un_unicode($catname);?>/<?php echo un_unicode($name);?>-sp<?php echo $id;?>.html' class='view'>
							<?php echo $imgtag;?>
						</a>
						<div class="quick_intro <?php echo $clsColor ?>">
							<span>Thông tin ngắn gọn về sản phẩm.</span>
						</div>
					</div>
					<h2 title='<?php echo $name;?>'><a href="<?php echo ROOTHOST.un_unicode($catname);?>/<?php echo un_unicode($name);?>-sp<?php echo $id;?><?php echo $_SESSION['SALCD'];?><?php echo'.html';?>"><span class='pro_name'><?php echo $name;?></span></a> </h2>			
					<div class='clr'></div>
				</div>
			</div>
		<?php
			$stt++;
		}
		?>
		</div>
		</div>
		<!-- end wrap -->
		<?php
	}
	
	public function GetAllProducts($where=' ',$order=' ORDER BY RAND() ',$limit=' '){
		$sql = "SELECT * FROM `tbl_product` WHERE isactive=1 ".$where.$order.$limit;
		$objdata = new CLS_MYSQL();
		$objcat = new CLS_CATALOGS;
		$objorder = new CLS_ORDER;
		$objdata->Query($sql);
		$clsimage = new SimpleImage;
		if(!isset($_SESSION['ORDER_NUM'])) {
			$_SESSION['ORDER_NUM']=array();
		}

		?>
		<div class="wrap">
			<div class="tab_list_catalog_all">
				<h3 class=""><span style="margin-left:10px;">Tất cả</span></h3>				
			</div>
			<div class="list_item_product">
		<?php
		$stt = 0; 
		$total = $objdata->Num_rows();		
		$aryNumber = array();
		for ($i=1; $i < $total ; $i=$i+3) { 
			array_push($aryNumber, $i);
		}

		while($row = $objdata->Fetch_Assoc()) {
			$cls = '';
			if(in_array($stt, $aryNumber)) {
				$cls = 'middel';
			}

			$id = $row["pro_id"];
			$num_buy = rand(50, 200);
			$_SESSION['ORDER_NUM'][$id] = $num_buy;
			$catname = $objcat->getNameById($row["cat_id"]);
			$name = stripslashes($row["name"]);
			$code = stripslashes($row["code"]);
			$intro = stripslashes($row["intro"]);
			$clsColor = stripslashes($row["class"]);
			$old_price = number_format($row["old_price"]);
			$cur_price = number_format($row["cur_price"]);
			$cur_price =($cur_price==0)?'Gọi điện':$cur_price." đ";
			$persen = "0";
			if($cur_price!=0 && $old_price!=0)
				$persen = ceil(($row["old_price"]-$row["cur_price"])/$row["old_price"]*100);
			$img = stripslashes($row["thumb"]);
			$clsNoImg = '';
			if($img == '') {
				$img = ROOTHOST.'images/no_images.jpg';
				$clsNoImg = 'no_images_available';
			}
			$imgtag ='<img src="'.$img.'" title="'.$name.'" alt="'.$name.'" class="img_block '.$clsNoImg.'"/>';
		?>
			<div class="item <?php echo $cls ?>">
				<div class='content'>
					<div class='picture <?php echo $clsColor ?>'>
						<a href='<?php echo ROOTHOST.un_unicode($catname);?>/<?php echo un_unicode($name);?>-sp<?php echo $id;?>.html' class='view'>
							<?php echo $imgtag;?>
						</a>
						<div class="quick_intro <?php echo $clsColor ?>">
							<span>Thông tin nhanh về sản phẩm.</span>
						</div>
					</div>
					<h2 title='<?php echo $name;?>'><a href="<?php echo ROOTHOST.un_unicode($catname);?>/<?php echo un_unicode($name);?>-sp<?php echo $id;?><?php echo $_SESSION['SALCD'];?><?php echo'.html';?>"><span class='pro_name'><?php echo $name;?></span></a> </h2>			
					<div class='clr'></div>
				</div>
			</div>
		<?php
			$stt++;
		}
		?>
		</div>
		</div>
		<!-- end wrap -->
		<?php
	}

	public function GetNewProduct(){
		$sql = "SELECT * FROM `tbl_product` WHERE ishot =1  ORDER BY `cdate` DESC LIMIT 0,10";
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function setVisited($id){
		$sql='UPDATE tbl_product SET `visited`=`visited`+1 WHERE `pro_id`='.$id;
		return $this->objmysql->Query($sql);
	}
}
?>