<?php header("Content-type: text/javascript"); ?>
/*** Editor Script Wrapper ***/
var oScripts=document.getElementsByTagName("script");	
var sEditorPath;
for(var i=0;i<oScripts.length;i++)
	{
	var sSrc=oScripts[i].src.toLowerCase();
	if(sSrc.indexOf("scripts/innovaeditor.php")!=-1) sEditorPath=oScripts[i].src.replace(/innovaeditor.php/,"");
	}
if(navigator.appName.indexOf('Microsoft')!=-1)
	document.write("<scr"+"ipt src='"+sEditorPath+"editor.js'></scr"+"ipt>");
else
	document.write("<scr"+"ipt src='"+sEditorPath+"moz/editor.js'></scr"+"ipt>");