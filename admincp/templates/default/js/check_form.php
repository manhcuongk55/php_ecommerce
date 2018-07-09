<?php header("Content-type: text/javascript"); ?>
// JavaScript Document
function checkEmail(str) {
        var at="@"
        var dot="."
        var lat=str.indexOf(at)
        var lstr=str.length
        var ldot=str.indexOf(dot)
        if (str.indexOf(at)==-1){
           alert("Email không đúng định dạng. Email đúng định dạng ví dụ: abc@gmail.com")
           return false
        }

        if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
           alert("Email không đúng định dạng. Email đúng định dạng ví dụ: abc@gmail.com")
           return false
        }

        if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
            alert("Email không đúng định dạng. Email đúng định dạng ví dụ: abc@gmail.com")
            return false
        }

         if (str.indexOf(at,(lat+1))!=-1){
            alert("Email không đúng định dạng. Email đúng định dạng ví dụ: abc@gmail.com")
            return false
         }

         if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
            alert("Email không đúng định dạng. Email đúng định dạng ví dụ: abc@gmail.com")
            return false
         }

         if (str.indexOf(dot,(lat+2))==-1){
            alert("Email không đúng định dạng. Email đúng định dạng ví dụ: abc@gmail.com")
            return false
         }
        
         if (str.indexOf(" ")!=-1){
            alert("Email không đúng định dạng. Email đúng định dạng ví dụ: abc@gmail.com")
            return false
         }

          return true                    
    }


function checkPhone(phone){
   re=/^[0][1-9][0-9]{8,11}$/;
   if(!re.test(phone)){
	   alert("Số điện thoại của bạn không hợp lệ. \nSố điện thoại chỉ bao gồm các chữ số từ 0 đến 9, gồm 10 hoặc 11 số, bắt đầu bằng số 0");
   	   return false;
	}
   return true;
}

function checkField(field,name){
   if(field.value == ""){
      alert(name + ' không được bỏ trống');
      field.focus();
   }
}

function checkDate(input,age,year){
	var validformat=/^\d{2}\-\d{2}\-\d{4}$/ //Basic check for format validity
	if (!validformat.test(input)){
		alert("Định dạng ngày không hợp lệ. Vui lòng nhập lại chính xác ngày định dạng: dd-mm-YYYY (ngày-tháng-năm)")
		return false;
	}
	else{ //Detailed check for valid date ranges
		var dayfield=input.split("-")[0]
		var monthfield=input.split("-")[1]
		var yearfield=input.split("-")[2]
		var dayobj = new Date();
		//alert(yearfield+">="+dayobj.getFullYear());
		if (monthfield>13){
			alert("Tháng >12, không hợp lệ");
			return false;
		}
		if(dayfield>31) {
			alert("Ngày >31, không hợp lệ");
			return false;
		}
		if(monthfield=="02" && dayfield>29) {
			alert("Tháng 2: ngày không hợp lệ");
			return false;
		}
		if(year>0) {
			if( parseInt(yearfield)>parseInt(dayobj.getFullYear()-age)){
				alert("Năm không hợp lệ. Năm phải nhỏ hơn hoặc bằng "+(dayobj.getFullYear()-age))
				return false;
			}
		}
	}
	return true;
}