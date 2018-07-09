<?php
class CLS_CATALOGS{
	private $objmysql=null;
	public function CLS_CATALOGS(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=''){
		$sql="SELECT `cat_id`,`name`,`intro` FROM `tbl_catalog`  WHERE isactive=1 ".$where; 
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}

	public function getListCategory(){
		$j=0;              
        $aryCls = array('cat_red','cat_orange','cat_ochre','cat_yellow','cat_sand','cat_green','cat_olive','cat_greengrey','cat_grey','cat_darkgrey','cat_blue2');
        $aryImg = array('sawing.png','drilling.png','edgebanding.png','handling.png','planing.png','pressing.png','recycling.png','safety-accessories.png','sanding.png','shaping.png','recycling.png','safety-accessories.png','sanding.png','shaping.png','planing.png','pressing.png','recycling.png');
        
		$objdata = new CLS_MYSQL;
		$objpro = new CLS_PRODUCTS;
		$sql = "SELECT `cat_id`,`name`,`class` FROM `tbl_catalog`  WHERE isactive=1 AND par_id='0' "; 
		$objdata->Query($sql);
		$clsConfig = "cat_orange";
		
		if($objdata->Num_rows()>0){
			$subHtml = "";
			echo '<div class="jcarousel-wrapper">';
        			echo '<div class="jcarousel">';
			echo '<ul>';
			while($row=$objdata->Fetch_Assoc()){
				$src = ROOTHOST."images/icon_product/".$aryImg[$j];
				$class='';
                $id=$row['cat_id'];                
                if (!is_null($row['class']))
                	$clsConfig = $row['class'];
                
				if($_SESSION['CUR_CAT']==$row['cat_id'])
					$class='';

				echo "<li class=\"$clsConfig $class\" id='".$row['cat_id']."'>";
				echo "<a href='".ROOTHOST.un_unicode($row['name']).'-np'.$row['cat_id'].'-p'.$row['cat_id'].".html' title='".$row['name']."'>";
					echo "<div><span>".$row['name']."</span></div>";
					echo "<img src=\"$src\" />";
				echo "</a>";	
					$subHtml.= "<div class=\"flyout $clsConfig ".$row['cat_id']."\" style=\"display:none;\">";
						$subHtml.= "<div class=\"wrap\">";
			            	$subHtml.="<p class='sologan'>Công ty TNHH Tân vương chuyên cung cấp các sản phẩm máy chế biến gỗ uy tín, chất lượng hàng đầu tại Việt Nam</p>";
			              	$sql="SELECT `cat_id`,`name` FROM `tbl_catalog`  WHERE isactive=1 AND par_id='$id'";
	                        $obj_sub = new CLS_MYSQL;
	                        $obj_sub->Query($sql);
	                        $n = $obj_sub->Num_rows();
	                        for ($i = 0; $i < $n; $i++)
	                        {
	                            $row1 = $obj_sub->Fetch_Assoc();
	                       	    $subHtml.= "<a href='".ROOTHOST.un_unicode($row1['name']).'-np'.$row1['cat_id'].'-p'.$row1['cat_id'].".html' title='".$row1['name']."'><span>".$row1['name']."</span></a>";
	                        }
			        $subHtml.= "</div>";
				$subHtml.="</div>";                    
                    
                echo "</li>";
                $j++;
			}
			echo '</ul>';
			echo '</div></div>';
			echo $subHtml;
		}
	}

	public function getListByParId($par_id){
		$objdata=new CLS_MYSQL;
		$objpro=new CLS_PRODUCTS;
		$sql="SELECT `cat_id`,`name` FROM `tbl_catalog`  WHERE isactive=1 AND par_id='$par_id' "; 
		$objdata->Query($sql);
		if($objdata->Num_rows()>0){
			echo '<ul>';
			while($row=$objdata->Fetch_Assoc()){
				echo "<li><a href='".ROOTHOST.un_unicode($row['name']).'-np'.$row['cat_id'].".html' title='".$row['name']."'><span>".$row['name'];
				echo " (".$objpro->NumProByCatid($row['cat_id']).")</span></a>";
				echo "</li>";
			}
			echo '</ul>';
		}
	}
	
	function getCatIDChild($where='',$parid){
		$sql="SELECT * FROM `tbl_catalog` WHERE isactive=1 AND par_id='$parid' ".$where;
		$objdata=new CLS_MYSQL();
		$this->result=$objdata->Query($sql);
		$str='';
		if($objdata->Num_rows()>0) {
			while ($rows=$objdata->Fetch_Assoc()) {
				$str.=$rows['cat_id']."','";
				$str.=$this->getCatIDChild($where,$rows['cat_id']);
			}
		}
		return $str;
	}
	public function getNameById($cat_id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_catalog`  WHERE isactive=1 AND `cat_id` = '$cat_id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
}
?>