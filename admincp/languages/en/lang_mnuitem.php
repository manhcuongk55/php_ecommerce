<?php
class LANG_MNUITEMITEM{
	var $pro=array(
				   "MNUITEM_MANAGER"=>"MenuItem Manager",
				   "MNUITEM_MANAGER_EDIT"=>"Edit Menu",
				   "MNUITEM_MANAGER_ADD"=>"Add new Menu",	
				   
				   "MNUITEM_A01"=>"Thêm mới Menu thành công",
				   "MNUITEM_A02"=>"Lỗi. Thêm mới không thành công",
				   "MNUITEM_U01"=>"Cập nhật Menu thành công",
				   "MNUITEM_U02"=>"Lỗi. Thông tin chưa được cập nhật",
				   "MNUITEM_U03"=>"Lỗi. Không tìm thấy thông tin cần lưu trữ trong CSDL.",		
				   "MNUITEM_D01"=>"Xóa Menu thành công",
				   "MNUITEM_D02"=>"Lỗi. Xóa Menu không thành công",
				   "MNUITEM_D03"=>"Lỗi. Không tìm thấy Menu cần xóa.",	
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