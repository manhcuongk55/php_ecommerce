<?php
if(isset($_SESSION['ERROR'])){
	if($_SESSION['ERROR']=='001'){
		echo "<h1 align='center'>Lỗi đăng ký (Mã 001): Mã bảo mật không chính xác</h1>";
		echo "<p align='center'> Click vào <a href='http://muathu7.vn/dang-ky.html'><strong>đây</strong></a> để đăng ký lại</p>";
	}
	if($_SESSION['ERROR']=='002'){
		echo "<h1 align='center'>Lỗi đăng ký (Mã 002): Email của bạn đã đăng ký.</h1>";
		echo "<p align='center'> Nếu bạn chưa nhận được email click vào <a href='http://muathu7.vn/dang-ky.html'><strong>đây</strong></a> để nhận lại email xác nhận</p>";
	}
}

if(isset($_SESSION['SUCCESS'])){
	if($_SESSION['SUCCESS']=='001'){
		echo "<h1 align='center'>Bạn đã đăng ký nhận quà thành công!</h1>";
		echo "<p align='center'> Hãy truy cập email của bạn để xác nhận lại thông tin đăng ký của bạn!</p>";
		echo "<p align='center'> Hãy tìm hiểu thêm các chương trình, chính sách của MUATHU7.VN dành cho thành viên tại đay!</p>";
		echo "<p align='center'> Hãy ghé thăm kênh bán hàng của MUATHU7.VN để chọn mua cho bạn những sản phẩm yêu thích!</p>";
	}
	if($_SESSION['SUCCESS']=='002'){
		echo "<h1 align='center'>Xác nhận thông tin thành công!</h1>";
		echo "<p align='center'>!</p>";
	}
}