<?php
class LANG_LANGUAGE{
	var $pro=array(
				   "LANGUAGE_MANAGER"=>"Quản lý ngôn ngữ",
				   "LANGUAGE_MANAGER_ADD"=>"Thêm mới ngôn ngữ",
				   "LANGUAGE_MANAGER_EDIT"=>"Sửa ngôn ngữ",
				   "TAB_SITE"=>"Trang chính",
				   "TAB_ADMIN"=>"Trang Quản trị",
				   "LANG_CODE"=>"Mã",
				   "LANG_NAME"=>"Tên",
				   "LANG_SITE"=>"Ngôn ngữ cho",
				   "LANG_FLAG"=>"Cờ",
				   "LANG_A01"=>"Thêm mới ngôn ngữ thành công",
				   "LANG_A02"=>"Lỗi. Thêm mới không thành công",
				   "LANG_U01"=>"Cập nhật ngôn ngữ thành công",
				   "LANG_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "LANG_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "LANG_D01"=>"Xóa ngôn ngữ thành công",
				   "LANG_D02"=>"Lỗi. Xóa ngôn ngữ không thành công",
				   "LANG_D03"=>"Lỗi. Không tìm thấy ngôn ngữ cần xóa.",		   
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "Không tìm thấy ngôn ngữ";
	}
}
?>