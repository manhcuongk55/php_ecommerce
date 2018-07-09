<?php
class LANG_TEM{
	var $pro=array(
				   "TEM_MANAGER"=>"Template Manager",
				   "TEM_MANAGER_EDIT"=>"Edit Template",
				   "TEM_MANAGER_ADD"=>"Add new Template",				   
				   "TEM_CODE"=>"Code",
				   "TEM_NAME"=>"Name",
				   "TEM_SITE"=>"Site",
				   "TEM_FLAG"=>"Flag",
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