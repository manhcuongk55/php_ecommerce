<?php
class LANG_MENU{
	var $pro=array(
				   "SYSTEM"=>"Hệ thống",
				   "ADMIN_MANAGER"=>"Quản lý thành viên",
				   "SITE_CONFIG"=>"Cấu hình website",
				   "LOGOUT"=>"Thoát",
				   
				   "DATA"=>"Dữ liệu",
				   "LOCATIONS"=>"Địa danh",
				   "DOCUMENT_MANAGER"=>"Quản lý tài liệu",
				   
				   "MENUS"=>"Menus",
				   "MENUS_MANAGER"=>"Quản lý menu",
				   "MENU_MANAGER"=>"Quản lý menu",
				   "MENU_MANAGER_EDIT"=>"Sửa menu",
				   "MENU_MANAGER_ADD"=>"Thêm mới menu",	
				   
				   "MENU_A01"=>"Thêm mới Menu thành công",
				   "MENU_A02"=>"Lỗi. Thêm mới không thành công",
				   "MENU_U01"=>"Cập nhật Menu thành công",
				   "MENU_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "MENU_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "MENU_D01"=>"Xóa Menu thành công",
				   "MENU_D02"=>"Lỗi. Xóa Menu không thành công",
				   "MENU_D03"=>"Lỗi. Không tìm thấy Menu cần xóa.",	
				   
				   "CONTENTS"=>"Nội dung",
				   "PRODUCTS"=>"Sản phẩm",
				   "PA_MANAGER"=>"Quản lý quảng cáo",
				   "EMAIL_MARKETING"=>"Email Marketing",
				   "EXTENSIONS"=>"Mở rộng",
				   "Help"=>"Trợ giúp"
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "Không tìm thấy ngôn ngữ";
	}
}
?>