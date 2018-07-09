<?php
	$orders="";
	$ids="";
	if(isset($_POST["txtorders"]))
		$orders=substr($_POST["txtorders"],0,strlen($_POST["txtorders"])-1);
	if(isset($_POST["txtids"]))
		$ids=substr($_POST["txtids"],0,strlen($_POST["txtids"])-1);// 1,2,3,,52,3,,2,4
		//echo $ids;
		//echo $orders;die();
	$arids=explode(",",$ids);
	$arods=explode(",",$orders);
	for($i=0;$i<count($arods);$i++)
		for($j=$i+1;$j<count($arods);$j++){
			if($arods[$i]>$arods[$j]){
				$tg=$arods[$i];
				$arods[$i]=$arods[$j];
				$arods[$j]=$tg;
				
				$tg=$arids[$i];
				$arids[$i]=$arids[$j];
				$arids[$j]=$tg;
			}
		}
/*for($i=0;$i<count($arods);$i++)
	{
		echo $arods[$i]."|".$arids[$i]."<br>";
	}die();*/
	$objcata->Orders($arids,$arods);
	
?>