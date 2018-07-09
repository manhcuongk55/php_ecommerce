<?php
//file download.php
//echo 'id='.$_GET["id"];
 
header("Content-type: application/octet-stream");
header("Content-length: " . filesize($filename));
 
fpassthru($fp);
fclose($fp);
?>