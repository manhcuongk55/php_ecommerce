<?php
class CLS_MENUITEM{
	private $objmysql=null;
	public function CLS_MENUITEM(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($mnuid=0,$where=""){
		if($where!="")
			$where=" WHERE `mnu_id`='$mnuid' AND ".$where;
		$sql="SELECT * FROM `view_menuitem` ".$where;
		return $this->objmysql->Query($sql);
	}
	function Num_rows() { 
		return $this->objmysql->Num_rows();
	}
	function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function ListMenuItem($mnuid=0,$par_id=0,$level=1){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1' ORDER BY `order`";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
        
		if($objdata->Num_rows()<=0)
			return;
		$style="";
		if($level==1)
			$style.='submenu';
		else if($level>1)
			$style.='submenu'.$level;
		$str="<ul class=\"$style menu genesis-nav-menu menu-primary\" id=\"menu-main-menu\">";
		$i=0;         
        
		while($rows=$objdata->Fetch_Assoc()){
			$urllink="";
			if($rows['viewtype']=='link'){
				if(trim($rows['link'])!=''){
					$urllink=$rows['link'];
				}else{
					$urllink=ROOTHOST.un_unicode($rows["name"])."-mnu".$rows["mnuitem_id"].".html";
				}
			}
			else if($rows['viewtype']=='article'){
				$urllink=ROOTHOST.un_unicode($rows['name']).'-post'.$rows['con_id'].'.html';
			}
			else if($rows['viewtype']=='block' || $rows['viewtype']=='list' ){
				$urllink=ROOTHOST.un_unicode($rows['name']).'-nb'.$rows['cat_id'].'.html';
			}
			$cls='';
			$curmenu=$_SESSION['CUR_MENU'];
			if(isset($curmenu) && $curmenu!='')
				$cls='';
			if($curmenu==$rows['mnuitem_id'])
				$cls='active ';
			$cls.=$rows['class'];
            $id=$rows['mnuitem_id'];
			$str.="<li class=\"$cls menu-item menu-item-type-custom menu-item-object-custom\"><a href=\"$urllink\" title='".$rows['name']."'><span>".$rows["name"]."</span></a>";			
                $str.='<ul id="menu-main-menu" class="menu genesis-nav-menu menu-primary">';
                        $sql="SELECT `mnuitem_id`,`code` FROM `view_menuitem`  WHERE isactive=1 AND par_id='$id'";
                        $obj_sub=new CLS_MYSQL;
                        $obj_sub->Query($sql);
                        $n=$obj_sub->Num_rows();
                        for($i=0;$i<$n;$i++)
                        {
                            $row1=$obj_sub->Fetch_Assoc();
                       	    $str.="<li class=\"menu-item menu-item-type-custom menu-item-object-custom\"><a href='#'><span>".$row1['code']."</span></a></li>";
                        }
                        
                    $str.= '</ul>';
			$str.='</li>';			
		}
		$str.='</ul>';
		return $str;
	}

	public function ListMenuItemCat($mnuid=0,$par_id=0,$level=1){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1' ORDER BY `order`";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
        
		if($objdata->Num_rows()<=0)
			return;
		$style="";
		if($level==1)
			$style.='submenu';
		else if($level>1)
			$style.='submenu'.$level;
		$str="<ul class=\"$style\" id=\"menu-cat\">";
		$i=0;
		$j=0;
        
        
        $aryCls = array('cat_red','cat_orange','cat_ochre','cat_yellow','cat_sand','cat_green','cat_olive','cat_greengrey','cat_grey','cat_darkgrey','cat_blue2');
        $src = ROOTHOST."images/public/sawing.png";

		while($rows=$objdata->Fetch_Assoc()){

			$urllink="";
			if($rows['viewtype']=='link'){
				if(trim($rows['link'])!=''){
					$urllink=$rows['link'];
				}else{
					$urllink=ROOTHOST.un_unicode($rows["name"])."-mnu".$rows["mnuitem_id"].".html";
				}
			}
			else if($rows['viewtype']=='article'){
				$urllink=ROOTHOST.un_unicode($rows['name']).'-b'.$rows['con_id'].'.html';
			}
			else if($rows['viewtype']=='block' || $rows['viewtype']=='list' ){
				$urllink=ROOTHOST.un_unicode($rows['name']).'-nb'.$rows['cat_id'].'.html';
			}
			$cls='';
			$curmenu=$_SESSION['CUR_MENU'];
			if(isset($curmenu) && $curmenu!='')
				$cls='';
			if($curmenu==$rows['mnuitem_id'])
				$cls='active ';
			$cls.=$rows['class'];
            $id=$rows['mnuitem_id'];
			$str.="<li class=\"$cls $aryCls[$j]\"><a href=\"$urllink\" title='".$rows['name']."'>";
			$str.="<div><span>".$rows['name']."</span></div>";
			$str.="<img src=\"$src\" />";
			$str.="</a>";		

				$str.="<div class=\"flyout $aryCls[$j]\">";
				$str.="<div class=\"wrap\">";
			            $str.="<p>With your MARTIN sliding table saw, you can be sure of achieving long-term performance. MARTIN stands for German precision, maximum longevity</p>";
			            $sql="SELECT `mnuitem_id`,`code`,`name` FROM `view_menuitem`  WHERE isactive=1 AND par_id='$id'";
                        $obj_sub=new CLS_MYSQL;
                        $obj_sub->Query($sql);
                        $n=$obj_sub->Num_rows();
                        for($i=0;$i<$n;$i++)
                        {
                            $row1=$obj_sub->Fetch_Assoc();
                       	    $str.="<a href='#'><span>".$row1['name']."</a>";
                        }
			        $str.="</div>";
				$str.="</div>";

                // $str.='<ul id="menu-main-menu" class="menu genesis-nav-menu menu-primary">';
                //         $sql="SELECT `mnuitem_id`,`code` FROM `view_menuitem`  WHERE isactive=1 AND par_id='$id'";
                //         $obj_sub=new CLS_MYSQL;
                //         $obj_sub->Query($sql);
                //         $n=$obj_sub->Num_rows();
                //         for($i=0;$i<$n;$i++)
                //         {
                //             $row1=$obj_sub->Fetch_Assoc();
                //        	    $str.="<li class=\"menu-item menu-item-type-custom menu-item-object-custom\"><a href='#'><span>".$row1['code']."</span></a></li>";
                //         }
                        
                //     $str.= '</ul>';
			$str.='</li>';

			$j++;			
		}
		$str.='</ul>';
		return $str;
	}
}
?>

<!-- <li  >
    <a class="cat_red" href="http://www.martin-usa.com/products/?type=sawing" ></a>
    <div class="flyout cat_red">
        <div class="wrap">
            <p>With your MARTIN sliding table saw, you can be sure of achieving long-term performance. MARTIN stands for German precision, maximum longevity and <strong>unique options for today&#8217;s woodworker</strong>.</p>
			<p>
			<a href="products/?type=sawing&#038;filter=saw-entry-level">Entry level</a>
			<a href="products/?type=sawing&#038;filter=saw-compact-level">Compact level</a>
			<a href="products/?type=sawing&#038;filter=saw-premium-level">Premium level</a>
			<a href="/products/?type=sawing">All Products</a></p>
        </div>
    </div>

</li> -->