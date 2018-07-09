function showdate(){
	var mydate = new Date()
	var year = mydate.getYear()
	if (year < 1000)
		year += 1900
	var month = mydate.getMonth() + 1
	if (month < 10)
		month = "0" + month
	var day = mydate.getDate()
	if (day < 10)
		day = "0" + day
	var dayw = mydate.getDay()
	var hour = mydate.getHours()
	if (hour < 10)
		hour = "0" + hour
	var minute=mydate.getMinutes()
	if (minute < 10)
		minute = "0" + minute
	var second=mydate.getSeconds()
	if (second < 10)
		second = "0" + second
	var dayarray = new Array("Chủ Nhật","Thứ Hai","Thứ Ba","Thứ Tư","Thứ Năm","Thứ Sáu","Thứ Bảy");
	var strtime = "<span class=date>"+dayarray[dayw]+", "+day+"/"+month+"/"+year+" "+hour+":"+minute+":"+minute+"</span>"
	document.getElementById("gf-clock").innerHTML=strtime;
	id = setTimeout("showdate()",1000);
}
function clock(){
	var now=new Date();
	var year=now.getFullYear();
	var month=now.getMonth();
	var date=now.getDate();
	var day=now.getDay();
	var hour=now.getHours();
	var minute=now.getMinutes();
	var second=now.getSeconds();
	var montharray=new Array("01","02","03","04","05","06","07","08","09","10","11","12");
	var dayarray=new Array("Chủ Nhật","Thứ Hai","Thứ Ba","Thứ Tư","Thứ Năm","Thứ Sáu","Thứ Bảy");
	var disptime="Hôm nay : "+dayarray[day]+", "+date+"/"+montharray[month]+"/"+year+" ";
	disptime+=((hour>12) ? hour-12 : hour)+((minute<10)?":0":":")+minute;
	disptime+=((second<10)? ":0":":")+second+((hour>=12) ? " PM" : " AM");
	document.getElementById("gf-clock").innerHTML=disptime;
	// getElementById(String elementId);
	id=setTimeout("clock()",1000);
}