<?php
class LANG_PRODUCTS{
	var $pro=array(
				   "CONTENT_MANAGER"=>"Quản lý sản phẩm",
				   "CONTENT_MANAGER_EDIT"=>"Sửa sản phẩm",
				   "CONTENT_MANAGER_ADD"=>"Thêm mới sản phẩm",	
				   
				   "CONTENT_A01"=>"Thêm mới sản phẩm thành công",
				   "CONTENT_A02"=>"Lỗi. Thêm mới không thành công",
				   "CONTENT_U01"=>"Cập nhật sản phẩm thành công",
				   "CONTENT_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "CONTENT_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "CONTENT_D01"=>"Xóa sản phẩm thành công",
				   "CONTENT_D02"=>"Lỗi. Xóa sản phẩm không thành công",
				   "CONTENT_D03"=>"Lỗi. Không tìm thấy sản phẩm cần xóa.",
				   
				   "LANG_CODE"=>"Mã",
				   "LANG_NAME"=>"Tên",
				   "LANG_SITE"=>"Trang chính",
				   "LANG_FLAG"=>"Ngôn ngữ"
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "Không tim thấy ngôn ngữ mặc định!";
	}
}
?>