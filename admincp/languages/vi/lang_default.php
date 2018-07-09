<?php
class LANG_DEFAULT{
	var $pro=array(
				   "DEFAULT_MANAGER"=>"Cấu hình nội dung",
				   "DEFAULT_MANAGER_EDIT"=>"Sửa nội dung",
				   "DEFAULT_MANAGER_ADD"=>"Thêm mới nội dung",				   
				   "DEFAULT_CODE"=>"Mã",
				   "DEFAULT_NAME"=>"Tên",
				   "DEFAULT_A01"=>"Thêm mới bản ghi thành công",
				   "DEFAULT_A02"=>"Lỗi. Thêm mới không thành công",
				   "DEFAULT_U01"=>"Cập nhật thông tin thành công",
				   "DEFAULT_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "DEFAULT_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "DEFAULT_D01"=>"Xóa bản ghi thành công",
				   "DEFAULT_D02"=>"Lỗi. Xóa bản ghi không thành công",
				   "DEFAULT_D03"=>"Lỗi. Không tìm thấy bản ghi cần xóa.",
				   "DEFAULT_D04"=>"Đây là thông tin cấu hình. Không được phép xóa !"	
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "";
	}
}
?>