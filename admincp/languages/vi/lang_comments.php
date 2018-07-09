<?php
class LANG_COMMENTS{
	var $pro=array(
				   "COMMENT_MANAGER"=>"QUẢN LÝ COMMENT",
				   "COMMENT_MANAGER_EDIT"=>"SỬA COMMENT",
				   "COMMENT_MANAGER_ADD"=>"THÊM MỚI COMMENT",	
				   
				   "COMMENT_A01"=>"Thêm mới comment thành công",
				   "COMMENT_A02"=>"Lỗi. Thêm mới không thành công",
				   "COMMENT_U01"=>"Cập nhật danh mục comment thành công",
				   "COMMENT_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "COMMENT_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "COMMENT_D01"=>"Xóa danh mục comment thành công",
				   "COMMENT_D02"=>"Lỗi. Xóa danh mục comment không thành công",
				   "COMMENT_D03"=>"Lỗi. Không tìm thấy danh mục comment cần xóa.",	
				   "COMMENT_D04"=>"Danh mục comment này đang có sản phẩm, Bạn có chắc muốn xóa không?",	
				   "COMMENT_D05"=>"Danh mục comment con của danh mục comment này đang có sản phẩm, Bạn có muốn xóa không?",	
				   "LANG_CODE"=>"Code",
				   "LANG_NAME"=>"Name",
				   "LANG_SITE"=>"Site",
				   "LANG_FLAG"=>"Flag"
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "";
	}
}
?>