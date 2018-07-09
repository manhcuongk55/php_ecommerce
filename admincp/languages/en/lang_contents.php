<?php
class LANG_CONTENTS{
	var $pro=array(
				   "CONTENT_MANAGER"=>"Contents Manager",
				   "CONTENT_MANAGER_EDIT"=>"Edit Content",
				   "CONTENT_MANAGER_ADD"=>"Add new Content",	
				   
				   "CONTENT_A01"=>"Thêm mới bài viết thành công",
				   "CONTENT_A02"=>"Lỗi. Thêm mới không thành công",
				   "CONTENT_U01"=>"Cập nhật bài viết thành công",
				   "CONTENT_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "CONTENT_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "CONTENT_D01"=>"Xóa bài viết thành công",
				   "CONTENT_D02"=>"Lỗi. Xóa bài viết không thành công",
				   "CONTENT_D03"=>"Lỗi. Không tìm thấy bài viết cần xóa.",
				   
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