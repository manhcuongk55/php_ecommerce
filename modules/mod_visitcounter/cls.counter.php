<?php
class CLS_COUNTER{
	private $pro=array(	'id'=>0,
						'Ip'=>'',
						'Date'=>'',
						'isOnline'=>1);
	private $objmysql=null;
	public function CLS_COUNTER(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo 'Lỗi rồi';
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo 'Lỗi rồi';
			return;
		}
		return $this->pro[$proname];
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function getList($where=''){
		$sql="SELECT * FROM tbl_visit ".$where;
		return $this->objmysql->Query($sql);
	}
	public function addnew(){
		$sql="INSERT INTO tbl_visit(`ip`,`date`) VALUES('".$this->Ip."','".$this->Date."')";
		return $this->objmysql->Query($sql);
	}
	public function update($ip){
		$sql="UPDATE tbl_visit SET `isonline`='0' WHERE `ip`='$ip'";
		return $this->objmysql->Query($sql);
	}
	public function showvisit(){
		$sql="UPDATE tbl_visit SET `isonline`='0' WHERE `date`<'".date('Y-m-d')."'";
		$this->objmysql->Query($sql);
		$online=1;
		$today=5;
		$monday=5;
		$all=26584;
		$this->getList(' WHERE `isonline`=1');
		$online+=$this->Num_rows();
		$this->getList(" WHERE `date`='".date('Y-m-d')."'");
		$today+=$this->Num_rows();
		$this->getList(" WHERE month(`date`)='".date('m')."'");
		$monday+=$this->Num_rows();
		$this->getList();
		$all+=$this->Num_rows();
		$all="00000000".$all;
		$all=substr($all,strlen($all)-7,7);
		$root = ROOTHOST."images/public/newsletter_icon.png";

		$html = "";
		$html.="<section id=\"text-11\" class=\"widget widget_text visit\">";
	    	$html.="<div class=\"widget-wrap\">";
	    		$html.="<h4 class=\"widget-title widgettitle\">Thống kê truy cập</h4>";
				$html.="<div class=\"textwidget\">";
					$html.="<div class=\"widget_content\">";
						
						$html.= "<div class='online'><strong>Đang Online: </strong><span class='num'>$online</span></div>";
						$html.= "<div class='today'><strong>Today: </strong><span class='num'>$today</span></div>";
						$html.= "<div class='month'><strong>Monthly: </strong><span class='num'>$monday</span></div>";	
						
						$html.= "<div class='num_visit'>";
						for($i=0; $i<strlen($all); $i++){
							$arr[$i] = substr($all,$i,1);
							$img = ROOTHOST."images/icons/count/".$arr[$i].".png";
							$html.="<span class='num".$arr[$i]."'><img src='$img' width='25' height='45'/></span>";
						}
						$html.= "</div>";											
					$html.="</div>";					
				$html.="</div>";
			$html.="</div>";
		$html.="</section>";

		echo $html;
	}
}