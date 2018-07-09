<?php
class LANG_CATEGORY{
	var $pro=array(
				   "CATE_MANAGER"=>"QUẢN LÝ NHÓM TIN",
				   "CATE_MANAGER_EDIT"=>"SỬA NHÓM TIN",
				   "CATE_MANAGER_ADD"=>"THÊM MỚI NHÓM TIN",	
				   
				   "CATE_A01"=>"Thêm mới nhóm tin thành công",
				   "CATE_A02"=>"Lỗi. Thêm mới không thành công",
				   "CATE_U01"=>"Cập nhật nhóm tin thành công",
				   "CATE_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "CATE_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "CATE_D01"=>"Xóa nhóm tin thành công",
				   "CATE_D02"=>"Lỗi. Xóa nhóm tin không thành công",
				   "CATE_D03"=>"Lỗi. Không tìm thấy nhóm tin cần xóa.",	
				   "CATE_D04"=>"Lỗi. Nhóm tin này đang có bài viết, nên bạn không thể xóa. Vui lòng xóa bài viết trước khi xóa nhóm tin",	
				   "CATE_D05"=>"Lỗi. Nhóm tin con của nhóm tin này đang có bài viết, nên bạn không thể xóa. Vui lòng xóa bài viết trước khi xóa nhóm tin",	
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