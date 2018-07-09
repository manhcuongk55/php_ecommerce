<?php
class LANG_LANGUAGE{
	var $pro=array(
				   "LANGUAGE_MANAGER"=>"Language Manager",
				   "LANGUAGE_MANAGER_ADD"=>"Add new Language",
				   "LANGUAGE_MANAGER_EDIT"=>"Edit Language",
				   "TAB_SITE"=>"Site",
				   "TAB_ADMIN"=>"Administrator",
				   "LANG_CODE"=>"Code",
				   "LANG_NAME"=>"Name",
				   "LANG_SITE"=>"Site",
				   "LANG_FLAG"=>"Flag",
				   "LANG_A01"=>"Thêm mới ngôn ngữ thành công",
				   "LANG_A02"=>"Lỗi. Thêm mới không thành công",
				   "LANG_U01"=>"Cập nhật ngôn ngữ thành công",
				   "LANG_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "LANG_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "LANG_D01"=>"Xóa ngôn ngữ thành công",
				   "LANG_D02"=>"Lỗi. Xóa ngôn ngữ không thành công",
				   "LANG_D03"=>"Lỗi. Không tìm thấy ngôn ngữ cần xóa.",		   
				   );
	function __get($proname){
		if(isset($this->pro[$proname]))
			return $this->pro[$proname];
		else
			return "can't find this lang";
	}
}
?>