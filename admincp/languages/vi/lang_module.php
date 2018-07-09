<?php
class LANG_MODULE{
	var $pro=array(
				   "MODULE_MANAGER"=>"Quản lý Module",
				   "MODULE_MANAGER_EDIT"=>"Sửa Module",
				   "MODULE_MANAGER_ADD"=>"Thêm mới Module",				   
				   "MODULE_CODE"=>"Mã",
				   "MODULE_NAME"=>"Tên",
				   "MODULE_SITE"=>"Trang chính",
				   "MODULE_FLAG"=>"Ngôn ngữ",
				   "MODULE_A01"=>"Thêm mới Module thành công",
				   "MODULE_A02"=>"Lỗi. Thêm mới không thành công",
				   "MODULE_U01"=>"Cập nhật Module thành công",
				   "MODULE_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "MODULE_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "MODULE_D01"=>"Xóa Module thành công",
				   "MODULE_D02"=>"Lỗi. Xóa Module không thành công",
				   "MODULE_D03"=>"Lỗi. Không tìm thấy Module cần xóa.",	
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "";
	}
}
?>