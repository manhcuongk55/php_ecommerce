<?php
class LANG_CATALOGS{
	var $pro=array(
				   "CATE_MANAGER"=>"QUẢN LÝ NHÓM SẢN PHẨM",
				   "CATE_MANAGER_EDIT"=>"SỬA NHÓM SẢN PHẨM",
				   "CATE_MANAGER_ADD"=>"THÊM MỚI NHÓM SẢN PHẨM",	
				   
				   "CATE_A01"=>"Thêm mới nhóm sản phẩm thành công",
				   "CATE_A02"=>"Lỗi. Thêm mới không thành công",
				   "CATE_U01"=>"Cập nhật nhóm sản phẩm thành công",
				   "CATE_U02"=>"Lỗi. Thông sản phẩm chưa được cập nhật",
				   "CATE_U03"=>"Lỗi. Không tìm thấy thông sản phẩm cần lưu trữ trong CSDL.",		
				   "CATE_D01"=>"Xóa nhóm sản phẩm thành công",
				   "CATE_D02"=>"Lỗi. Xóa nhóm sản phẩm không thành công",
				   "CATE_D03"=>"Lỗi. Không tìm thấy nhóm sản phẩm cần xóa.",	
				   "CATE_D04"=>"Lỗi. Nhóm sản phẩm này đang có bài viết, nên bạn không thể xóa. Vui lòng xóa bài viết trước khi xóa nhóm sản phẩm",	
				   "CATE_D05"=>"Lỗi. Nhóm sản phẩm con của nhóm sản phẩm này đang có bài viết, nên bạn không thể xóa. Vui lòng xóa bài viết trước khi xóa nhóm sản phẩm",	
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