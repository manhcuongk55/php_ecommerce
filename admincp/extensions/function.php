<?php
function listDir($urldir,$level){
		$objdir=dir($urldir);
		$char="";
		for($i=1;$i<=$level;$i++)
		{
			$char.="&nbsp;&nbsp;";
		}
		while($file=$objdir->read()){
			$fullurl=$urldir.$file."/";
			if(is_dir($fullurl) && $file!="." && $file!=".."&& $file!="_notes" && $file!="thumb")
			{
				echo "<option value=\"$fullurl\">$char$file</option>";
				listdir($fullurl,++$level);
			}
		}
	}
function listFile($urldir){
    if(is_dir($urldir))
    {
        $objdir=dir($urldir);
        $count=0;
        while($file=$objdir->read()){
            $fullurl=$urldir.$file;
			$str=strstr($urldir,"/images");
			//echo $str."<br>";
            // $vitue_url=str_replace("/images/",$str,ROOT_BASE_PATH)."thumb/$file";
            $vitue_url=str_replace("/images/",$str,ROOT_BASE_PATH)."$file";
			//echo $vitue_url;
			//echo $vitue_url."<br>";
            //echo ($fullurl);
            if(is_file($fullurl) && $file!="Thumb.db" && $file!=".htaccess" && $file!="Thumbs.db")
            {
                ++$count;
                echo "<tr>";
                echo "<td align=\"center\">$count</td>";
                echo "<td><a href=\"#\" onclick=\"setlink('$vitue_url');\">$file".$_SERVER['QUERY_STRING']."</a></td>";
                echo "<td width=\"50\" align=\"center\"><a href=\"?file=$file\">delete</a></td>";
                echo "</tr>";
            }
        }
    }
}

function listFileDoc($urldir){
    if(is_dir($urldir)){
        $objdir=dir($urldir);
        $count=0;
        while($file=$objdir->read()){
            $fullurl=$urldir.$file;
			$str=strstr($urldir,"/tailieu");
			//echo $str."<br>";
            $vitue_url=str_replace("/tailieu/",$str,ROOT_BASE_PATH)."$file";
			//echo $vitue_url."<br>";
            //echo ($fullurl);
            if(is_file($fullurl) && $file!="Thumb.db" && $file!=".htaccess" && $file!="Thumbs.db")
            {
                ++$count;
                echo "<tr>";
                echo "<td align=\"center\">$count</td>";
                echo "<td><a href=\"#\" onclick=\"setlink('".$urldir.$file."','".$urldir."');\">$file".$_SERVER['QUERY_STRING']."</a></td>";
                echo "<td width=\"50\" align=\"center\"><a href=\"?file=$file\">Xóa file</a></td>";
                echo "</tr>";
            }
        }
    }
}


function getExt($sFileName)//ffilter
{
	$sTmp=$sFileName;
	while($sTmp!="") 
		{
		$sTmp=strstr($sTmp,".");
		if($sTmp!="")
			{
			$sTmp=substr($sTmp,1);
			$sExt=$sTmp;
			}
		}
	return strtolower($sExt);
}
?>