<?php
class LANG_TEM{
	var $pro=array(
				   "TEM_MANAGER"=>"Quản lý Template",
				   "TEM_MANAGER_EDIT"=>"Sửa Template",
				   "TEM_MANAGER_ADD"=>"Thêm mới Template",				   
				   "TEM_CODE"=>"Mã",
				   "TEM_NAME"=>"Tên",
				   "TEM_SITE"=>"Trang chính",
				   "TEM_FLAG"=>"Ngôn ngữ",
				   "TEM_A01"=>"Thêm mới Template thành công",
				   "TEM_A02"=>"Lỗi. Thêm mới không thành công",
				   "TEM_U01"=>"Cập nhật Template thành công",
				   "TEM_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "TEM_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "TEM_D01"=>"Xóa Template thành công",
				   "TEM_D02"=>"Lỗi. Xóa Template không thành công",
				   "TEM_D03"=>"Lỗi. Không tìm thấy Template cần xóa.",	
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "";
	}
}
?>