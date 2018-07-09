<?php
class LANG_USERS{
	var $pro=array(
				   "USER_MANAGER"=>"Users Manager",
				   "USER_MANAGER_EDIT"=>"Edit User",
				   "USER_MANAGER_ADD"=>"Add new User",	
				   
				   "USER_A01"=>"Thêm mới user thành công",
				   "USER_A02"=>"Lỗi. Thêm mới không thành công",
				   "USER_U01"=>"Cập nhật user thành công",
				   "USER_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "USER_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "USER_D01"=>"Xóa user thành công",
				   "USER_D02"=>"Lỗi. Xóa user không thành công",
				   "USER_D03"=>"Lỗi. Không tìm thấy user cần xóa.",
				   
				   "LANG_GUSER"=>"Guser"//,
				   //"LANG_FLAG"=>"Flag"
				   
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "can't find this lang";
	}
}
?>