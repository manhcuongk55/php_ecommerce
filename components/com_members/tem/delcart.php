<?php
$id=0;
if(isset($_GET['id'])){
	$id=$_GET['id'];
}
$vt=-1;
if(isset($_SESSION['CART'])){
	$n=count($_SESSION['CART']);
	for($i=0;$i<$n;$i++){
		if($_SESSION['CART'][$i]['ID']==$id){
			$vt=$i; break;
		}
	}
	if($vt>=0){
		for($i=$vt;$i<$n-1;$i++){
			$_SESSION['CART'][$i]=$_SESSION['CART'][($i+1)];
		}
		unset($_SESSION['CART'][$n-1]);
	}
}
header('location:'.ROOTHOST.'gio-hang.html');
?>