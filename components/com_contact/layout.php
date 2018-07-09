<script language="javascript">
	function chechemail()
	{
		var phone=document.getElementById("phone");
		var subject=document.getElementById("subject");
		var content=document.getElementById("content");
		var email=document.getElementById("email");
		reg1=/^[0-9A-Za-z]+[0-9A-Za-z_]*@[\w\d.]+.\w{2,4}$/;
        testmail=reg1.test(email.value);
		if(!testmail){
            alert("Địa chỉ email không hợp lệ!");
            email.focus();
            return false;
        }
		if(isNaN(phone.value)){
            alert("Số điện thoại chưa chính xác!");
            phone.focus();
            return false;
        }
		if(subject.value==""){
            alert("Vui lòng nhập tiêu đề thư!");
            subject.focus();
            return false;
        }
		if(content.value==""){
            alert("Vui lòng nhập nội dung thư!");
            content.focus();
            return false;
        }
	}
</script>
<?php
require_once 'libs/cls.contact.php';
$noidung="";
$obj = new CLS_CONTACT();
if(isset($_POST["ok"]))
{
    $obj->Name = addslashes($_POST["name"]);
    $obj->Email = addslashes($_POST["email"]);
    $obj->Phone = addslashes($_POST["phone"]);
    $obj->Address = addslashes($_POST["address"]);
    $obj->Subject = addslashes($_POST["txt_subject"]);    
    $obj->Text = addslashes($_POST["text"]);
    $obj->Time = date('Y-m-d h:i:s');

    $obj->Add_New();
    echo "<script type=\"text/javascript\">alert('Bạn đã gửi thông tin liên hệ thành công !')</script>";
}
?>	

<div class="breadcrumb">
    <ul class="breadcrumbs wrap">
        <li class="start">
            <a href="<?php echo ROOTHOST?>index.php">Trang chủ</a> 
            <div class="arrow"></div>
            <div class="block light"></div>
            <div class="arrow light"></div>
        </li>
        <li>
            <a>Liên hệ</a>
        </li>
    </ul>   
</div>
<div class="wrap">
    <div class="left_contact">
        <div class="Advertisement">
            <h2>Cấu hình sản phẩm</h2>
            <a href="#" class="readmore">Xem thêm</a>
            <img src="<?php echo ROOTHOST?>images/configurator.jpg">
        </div>
    </div>
    <div class="right_contact">
        <div class="form_contact wrap">
        <h3 class=""><span style="margin-left:10px;">Liên hệ</span></h3>
        <fieldset>       
            <form action="" method="post" >            
                <table  width="70%" border="0" cellpadding="5" cellspacing="1">
                    <tr>
                        <td width="150" align="right"><strong>Họ và Tên:</strong></td>
                        <td align="left"><input type="text" name="name" size="50" /></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><strong>Hòm thư:<font color="#FFFF00">*</font></strong></td>
                        <td align="left"><input type="text" name="email" size="50" id="email" /></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><strong>Điện Thoại:<font color="#FFFF00">*</font></strong></td>
                        <td align="left"><input type="text" name="phone" size="50" id="phone" /></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><strong>Địa chỉ:</strong></td>
                        <td align="left"><input type="text" name="address" size="50" /></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><strong>Tiêu đề:<font color="#FFFF00">*</font></strong></td>
                        <td align="left"><input name="txt_subject" type="text" id="subject" size="50"/></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"><strong>Nội dung:<font color="#FFFF00">*</font></strong></td>
                        <td align="left"><textarea cols="50" rows="10" name="text" id="content"></textarea></td>
                    </tr>
                    <tr>
                        <td width="150" align="right"></td>
                        <td align="left">
                            <input type="submit" name="ok" value="Gửi" class="btninput" onclick="return chechemail();" />
                            <input type="reset" value="Làm lại" class="btninput btnright" style="margin-left:10px;" />
                        </td>
                    </tr>
                </table>
           </form>
        </fieldset>
    </div>
    </div>
</div>


    