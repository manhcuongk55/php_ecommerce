<meta charset='utf-8'>
<?php
//Nhúng thư viện phpmailer
require_once('phpmailer/class.phpmailer.php');
//Khởi tạo đối tượng
$mail = new PHPMailer();
/*=====================================
 * THIET LAP THONG TIN GUI MAIL
 *=====================================*/
$mail->IsSMTP(); // Gọi đến class xử lý SMTP
$mail->Mailer = "smtp";
$mail->Host       = "smtp.gmail.com"; // tên SMTP server
$mail->SMTPDebug  = 1;                    // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // Sử dụng đăng nhập vào account
$mail->SMTPSecure = "ssl";
$mail->Host       = "smtp.gmail.com";     // Thiết lập thông tin của SMPT
$mail->Port       = 465;                    // Thiết lập cổng gửi email của máy
$mail->Username   = "txbachit@gmail.com"; // SMTP account username
$mail->Password   = "Adfectiver@1";            // SMTP account password
//Thiet lap thong tin nguoi gui va email nguoi gui
// $mail->SetFrom($contact->email,$contact->name);
$mail->SetFrom("mte1991@gmail.com", "Mai EN");
//Thiết lập thông tin người nhận
$mail->addAddress('txbachit@gmail.com', '');
//Thiết lập email nhận email hồi đáp
//nếu người nhận nhấn nút Reply
$mail->AddReplyTo('mte1991@gmail.com','Support Team');
/*=====================================
 * THIET LAP NOI DUNG EMAIL
 *=====================================*/
//Thiết lập tiêu đề
// $mail->Subject    = "[".$contact->reason."] ".$contact->subject;
$mail->Subject    = "Lien he";
//Thiết lập định dạng font chữ
$mail->CharSet = "utf-8";
//Thiết lập nội dung chính của email
// $body = $contact->message;
$body = "content";
$mail->Body = $body;
echo "send....";
if ($mail->send()) 
{
	echo "send success!";
	echo "<script>alert('Your message has been sent. Thank you!');</script>";
}
else {echo "<script>alert('There are some errors occured. Your message has not been sent. Please try again later.');</script>";
}

?>