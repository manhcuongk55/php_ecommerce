<?php
class LANG_USERS{
	var $pro=array(
				   "USER_MANAGER"=>"Quản lý user",
				   "USER_MANAGER_EDIT"=>"Sửa user",
				   "USER_MANAGER_ADD"=>"Thêm mới user",	
				   
				   "USER_A01"=>"Thêm mới user thành công",
				   "USER_A02"=>"Lỗi. Thêm mới không thành công",
				   "USER_U01"=>"Cập nhật user thành công",
				   "USER_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "USER_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "USER_D01"=>"Xóa user thành công",
				   "USER_D02"=>"Lỗi. Xóa user không thành công",
				   "USER_D03"=>"Lỗi. Không tìm thấy user cần xóa.",
				   
				   "LANG_GUSER"=>"Nhóm user"//,
				   //"LANG_FLAG"=>"Flag"
				   
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "Không tìm thấy ngôn ngữ mặc định!";
	}
}
?>