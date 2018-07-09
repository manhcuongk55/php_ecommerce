<?php
class LANG_COMMENTS{
	var $pro=array(
				   "COMMENT_MANAGER"=>"Contents Manager",
				   "COMMENT_MANAGER_EDIT"=>"Edit Comment",
				   "COMMENT_MANAGER_ADD"=>"Add new Comment",	
				   
				   "COMMENT_A01"=>"Thêm mới bài viết thành công",
				   "COMMENT_A02"=>"Lỗi. Thêm mới không thành công",
				   "COMMENT_U01"=>"Cập nhật bài viết thành công",
				   "COMMENT_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "COMMENT_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "COMMENT_D01"=>"Xóa bài viết thành công",
				   "COMMENT_D02"=>"Lỗi. Xóa bài viết không thành công",
				   "COMMENT_D03"=>"Lỗi. Không tìm thấy bài viết cần xóa.",
				   
				   "LANG_CODE"=>"Code",
				   "LANG_NAME"=>"Name",
				   "LANG_SITE"=>"Site",
				   "LANG_FLAG"=>"Flag"
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "can't find this lang";
	}
}
?>