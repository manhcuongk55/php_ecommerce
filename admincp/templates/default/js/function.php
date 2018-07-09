<?php header("Content-type: text/javascript"); ?>
// JavaScript Document
function selectall(status){
	var obj=document.getElementById("cbo_menus");
	var objopt=obj.getElementsByTagName("option");
	for(i=0;i<objopt.length;i++){
		if(status==1 && objopt[i].value!="")
		objopt[i].selected=true;
		else
		objopt[i].selected=false;
	}
	if(status==0){
		obj.disabled=true;
		obj.style.backgroundColor="#ccc";
	}
	else if(status==1){
		obj.disabled=true;
		obj.style.backgroundColor="#fff";
	}
	else{
		obj.disabled=false;
		obj.style.backgroundColor="#fff";
	}
	getIDs();
}
function getIDs(){
	var obj=document.getElementById("cbo_menus");
	var objopt=obj.getElementsByTagName("option");
	var strids="";
	var flag=true;
	for(i=0;i<objopt.length;i++){
		if(objopt[i].selected==true &&  objopt[i].value!="")
			strids+=objopt[i].value+",";
		else
			objopt[i].selected=false;
		if(objopt[i].selected==false &&  objopt[i].value!="")
		flag=false;
	}
	if(flag==true)
		document.getElementById("txtmenus").value="all";
	else
		document.getElementById("txtmenus").value=strids;
}
function selectedIDs(flag) {
	var ids=document.getElementById("txtmenus").value;
	var obj=document.getElementById("cbo_menus");
	var objopt=obj.getElementsByTagName("option");
	
	if(flag==1) {
		for(i=0;i<objopt.length;i++){
			objopt[i].selected==true;
		}
	}
	else if(flag==3) {
		var arr = new Array();
		arr = ids.split(",");
		for(i=0;i<objopt.length;i++){ 
			for(j=0;j<arr.length-1;j++) {
				if(objopt[i].value==arr[j]){
					objopt[i].selected=true;
				}
			}
		}
	}
}
function detele_field(url) {
	if(confirm("Bạn có chắc chắn muốn xóa thông tin này không?")) {
		window.location=url;
	}
}

function getID_Order_Category() {
	var ctr = document.getElementsByName("order"); //alert(ctr.length);
	var txtids=''; var txtorder = ''; var str='';
	for(var i=0;i<ctr.length;i++){
		txtorder +=ctr[i].value+";";
		txtids +=ctr[i].id+";";
	}
	document.getElementById("txtIDs").value = txtids;
	document.getElementById("txtOrder").value = txtorder;
	frmlist.submit();
}
function getID_Order_Content() {
	var ctr = document.getElementsByName("order"); //alert(ctr.length);
	var txtids=''; var txtorder = ''; var str='';
	for(var i=0;i<ctr.length;i++){
		txtorder +=ctr[i].value+";";
		txtids +=ctr[i].id+";";
		//alert(ctr[i].innerHTML);
	}
	document.getElementById("txtIDs").value = txtids;
	document.getElementById("txtOrder").value = txtorder;
	frmlist.submit();
}
function getID_Order_Menu() {
	var ctr = document.getElementsByName("order"); //alert(ctr.length);
	var txtids=''; var txtorder = ''; var str='';
	
	for(var i=0;i<ctr.length;i++){
		txtorder +=ctr[i].value+";";
		txtids +=ctr[i].id+";";
		//alert(ctr[i].innerHTML);
	}
	document.getElementById("txtIDs").value = txtids;
	document.getElementById("txtOrder").value = txtorder;
	frmlist.submit();
	
}
function getID_Order(cur_id,str) {
	document.getElementById("txtIDs").value = cur_id;
	document.getElementById("txtType").value = str;
	frmlist.submit();
}

function showCombobox(){
	var value = document.getElementById("style").value; //alert(value);
	var title =''; var input ='';
	
	switch(value) {
		case 'blog': 
		case 'list':
			title ="Chủ đề :";
			input = document.getElementById("cbo_showCateID").innerHTML;
			break;
		case 'detail': {
			title ="Bài viết :";
			input ='<input name="con_id" id="con_id" type="text" size="30" value="Chọn bài viết" readonly=""/><input type="button" name="choice_Content" value="Lựa chọn" onclick="javascript:popup_choiceContent();" />';
			break;}
		case 'link': {
			title ="Liên kết :";
			input ='<input name="link" type="text" id="link" size="30" value="Nhập đường dẫn..." onfocus="'+"javascript:this.value=''"+';"/>';
			break;}
	}
	document.getElementById("rowChoice1").innerHTML = title;
	document.getElementById("rowChoice2").innerHTML = input;
	
}
function popup_choiceContent(){
	window.open("contents_manager/list_choice.php","LIST CHOICE","top=200,left=250,height=400,width=500,status=0,toolbar=0,scrollbars=1");
}

function close_ChoiceContent(str,title) {
	//alert(str);
	window.opener.document.getElementById('txtcontentID').value = str;
	window.opener.document.getElementById('con_id').value = title;
	window.close();
}


function explode (delimiter, string, limit) {
     var emptyArray = { 0: '' };
    
    // third argument is not required
    if ( arguments.length < 2 ||
        typeof arguments[0] == 'undefined' || typeof arguments[1] == 'undefined' ) {
        return null;
    }
 
    if ( delimiter === '' ||        delimiter === false ||
        delimiter === null ) {
        return false;
    }
     if ( typeof delimiter == 'function' ||
        typeof delimiter == 'object' ||
        typeof string == 'function' ||
        typeof string == 'object' ) {
        return emptyArray;    }
 
    if ( delimiter === true ) {
        delimiter = '1';
    }    
    if (!limit) {
        return string.toString().split(delimiter.toString());
    } else {
        // support for limit argument        var splitted = string.toString().split(delimiter.toString());
        var partA = splitted.splice(0, limit - 1);
        var partB = splitted.join(delimiter.toString());
        partA.push(partB);
        return partA;    }
}

function choose_showon(str,ids){
	var cbo = document.getElementById("mnu_id[]");
	var ctr ='';
	switch (str) {
		case 'all': {
			cbo.disabled=true;
			ctr = cbo.getElementsByTagName("option");
			for(var i=0;i<ctr.length;i++) {
				ctr[i].selected="selected";
			}
			break; }
		case 'none': {
			cbo.disabled=true;
			ctr = cbo.getElementsByTagName("option");
			for(var i=0;i<ctr.length;i++) {
				ctr[i].selected=false;
			}
			break;}
		case 'multi': {
			ctr = cbo.getElementsByTagName("option");
			cbo.disabled=false;
			if(ids!='0') {
				var id= new Array();
				id= explode(',',ids);
				j=0;
				for(var i=0;i<ctr.length;i++) {
					if(id[j]==ctr[i].value){
						ctr[i].selected="selected"; j++;
					}
				}
			}
			break;}
	}
}