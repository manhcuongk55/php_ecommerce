<?php include("helper.php");include_once('cls.counter.php');?>
	<?php if($r['viewtitle']==1){?>
	<h3 class="title" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></h3>
    <?php }?>
	<?php
		//echo $_SERVER['PHP_SELF'];
		$obj=new CLS_COUNTER;
		$vis_ip = ip2long($_SERVER['REMOTE_ADDR']);
		$time = time();
		if(!isset($_SESSION['VISTIME']) || ($_SESSION['VISTIME']+10*60)<$time){
			// Thời gian
			$obj->update($vis_ip);
			$obj->Ip=$vis_ip;
			$obj->Date=date('Y-m-d h:i:s');
			$obj->addnew();
		}
		$_SESSION['VISTIME']=$time;

		
		$obj->showvisit();
		
	?>
<?php
unset($obj); unset($r);
?>