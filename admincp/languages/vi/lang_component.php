<?php
class LANG_COMPONENT{
	var $pro=array(
				   "COMPONENT_MANAGER"=>"Quản lý Component",
				   "COMPONENT_MANAGER_EDIT"=>"Sửa Component",
				   "COMPONENT_MANAGER_ADD"=>"Thêm mới Component",				   
				   "COMPONENT_CODE"=>"Mã",
				   "COMPONENT_NAME"=>"Tên",
				   "COMPONENT_SITE"=>"Trang chính",
				   "COMPONENT_FLAG"=>"Ngôn ngữ",
				   "COMPONENT_A01"=>"Thêm mới Component thành công",
				   "COMPONENT_A02"=>"Lỗi. Thêm mới không thành công",
				   "COMPONENT_U01"=>"Cập nhật Component thành công",
				   "COMPONENT_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "COMPONENT_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "COMPONENT_D01"=>"Xóa Component thành công",
				   "COMPONENT_D02"=>"Lỗi. Xóa Component không thành công",
				   "COMPONENT_D03"=>"Lỗi. Không tìm thấy Component cần xóa."
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "";
	}
}
?>