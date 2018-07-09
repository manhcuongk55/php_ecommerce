-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 26, 2018 lúc 08:27 AM
-- Phiên bản máy phục vụ: 10.1.32-MariaDB
-- Phiên bản PHP: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_tanvuong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_album`
--

CREATE TABLE `tbl_album` (
  `album_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `isactive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_catalog`
--

CREATE TABLE `tbl_catalog` (
  `cat_id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_catalog`
--

INSERT INTO `tbl_catalog` (`cat_id`, `par_id`, `name`, `intro`, `class`, `isactive`) VALUES
(8, 0, 'Máy bào', 'Máy bào<br>', 'cat_red', 1),
(9, 0, 'Máy cưa', 'Máy cưa<br>', 'cat_orange', 1),
(10, 0, 'Máy dán cạnh', 'Máy dán cạnh<br>', 'cat_ochre', 1),
(28, 8, 'Máy bào thẩm', '&nbsp;', 'cat_red ', 1),
(29, 8, 'Máy bào 1 mặt', '&nbsp;', 'cat_red ', 1),
(30, 8, 'Máy bào 2 mặt', '&nbsp;', 'cat_red', 1),
(31, 8, 'Máy bào 3 mặt', '&nbsp;', 'cat_red ', 1),
(32, 8, 'Máy bào 4 mặt', '&nbsp;', 'cat_red ', 1),
(33, 0, 'Máy phay', '&nbsp;', 'cat_yellow ', 1),
(34, 0, 'Máy khoan', '&nbsp;', 'cat_sand ', 1),
(35, 0, 'Máy chuốt tròn', '&nbsp;', 'cat_green ', 1),
(36, 0, 'Máy chà nhám', '&nbsp;', 'cat_olive ', 1),
(37, 0, 'Máy hút chân không', '&nbsp;', 'cat_greengrey ', 1),
(38, 0, 'Máy mài', '&nbsp;', 'cat_grey ', 1),
(39, 0, 'Máy tiện', '&nbsp;', 'cat_darkgrey ', 1),
(41, 0, 'Máy phay mộng', '&nbsp;Máy phay mộng', 'cat_green', 1),
(42, 0, 'Máy hút bụi', '&nbsp;Máy hút bụi', 'cat_darkgrey  ', 1),
(43, 0, 'Máy cưa bào liên hợp', '&nbsp;Máy cưa bào liên hợp', 'cat_grey', 0),
(44, 0, 'Máy ép', '&nbsp;Máy ép', 'cat_ochre ', 0),
(45, 0, 'Máy nén khí, máy rửa xe', '&nbsp;Máy nén khi rửa xe', 'cat_yellow', 0),
(46, 0, 'Máy ghép', '&nbsp;Máy ghép', 'cat_sand', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `par_id`, `isactive`) VALUES
(1, 0, 1),
(2, 0, 1),
(13, 0, 1),
(24, 0, 1),
(36, 0, 1),
(61, 13, 1),
(62, 62, 1),
(63, 13, 1),
(64, 13, 1),
(65, 13, 1),
(66, 13, 1),
(68, 13, 1),
(69, 13, 1),
(77, 0, 1),
(78, 0, 1),
(79, 0, 1),
(80, 0, 1),
(81, 0, 1),
(83, 0, 1),
(84, 0, 1),
(86, 0, 1),
(88, 0, 1),
(89, 0, 1),
(90, 0, 1),
(91, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category_text`
--

CREATE TABLE `tbl_category_text` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `lag_id` int(11) DEFAULT '0',
  `isactive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `tbl_category_text`
--

INSERT INTO `tbl_category_text` (`id`, `cat_id`, `name`, `desc`, `lag_id`, `isactive`) VALUES
(82, 88, 'Dịch vụ', '&nbsp;Giới thiệu dịch vụ của công ty', 0, 1),
(83, 89, 'Giới thiệu', '&nbsp;Giới thiệu công ty', 0, 1),
(84, 90, 'Công nghệ', 'Bản tin công nghệ', 0, 1),
(85, 91, 'Tuyển dụng', '&nbsp;', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comm_id` int(11) NOT NULL,
  `par_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `con_id` int(11) DEFAULT NULL,
  `mess` text COLLATE utf8_unicode_ci,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `joindate` datetime DEFAULT NULL,
  `isactive` int(11) DEFAULT '0',
  `thumb` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `tbl_comment`
--

INSERT INTO `tbl_comment` (`comm_id`, `par_id`, `pro_id`, `con_id`, `mess`, `name`, `email`, `joindate`, `isactive`, `thumb`) VALUES
(1, 0, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', 1, 'images/Image0728.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_comment_text`
--

CREATE TABLE `tbl_comment_text` (
  `comm_text_id` int(11) NOT NULL,
  `comm_id` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `lag_id` int(11) DEFAULT '0',
  `isactive` int(11) DEFAULT '1',
  `username` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `tbl_comment_text`
--

INSERT INTO `tbl_comment_text` (`comm_text_id`, `comm_id`, `content`, `lag_id`, `isactive`, `username`) VALUES
(1, 1, 'Â chÃºng em ráº¥t hÃ i lÃ²ng cÃ¡c tháº§y Ä‘Ã£ giáº£ng dáº¡y cho chÃºng em, chÃºng em mong ráº±ng tháº§y sáº½ truyá»n Ä‘áº¡t cho chÃºng em Ä‘áº§y Ä‘á»§ kiáº¿n thá»©c Ä‘á»ƒ Ä‘á»§ kháº£ nÄƒng lÃ m viá»‡c', 0, 1, 'nguyá»…n vÄƒn tam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_component`
--

CREATE TABLE `tbl_component` (
  `com_id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `site` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `issytem` int(11) NOT NULL DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_component`
--

INSERT INTO `tbl_component` (`com_id`, `code`, `name`, `desc`, `site`, `issytem`, `isactive`) VALUES
(1, 'components', 'components', 'Quản lý các thành phần website', 'site', 1, 1),
(2, 'menus', 'menus', 'Menu component', 'site', 0, 1),
(3, 'contact', 'Contact', 'Contact component', 'site', 1, 1),
(4, 'category', 'Category', 'Category component', 'site', 1, 1),
(5, 'menuitem', 'Menu Item', '&nbsp;Quản lý hệ thống menu It', 'site', 0, 1),
(6, 'contents', 'Contents', 'Content component', 'site', 0, 1),
(7, 'register', 'registers', 'Register component<br>', 'site', 1, 1),
(8, 'comments', 'comments', 'Comment component for content', 'site', 0, 1),
(9, 'document', 'document', 'Document Component', 'site', 0, 1),
(10, 'products', 'products', 'Production component ', 'site', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_configcontent`
--

CREATE TABLE `tbl_configcontent` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `show_name` int(11) NOT NULL DEFAULT '1',
  `show_icon` int(11) NOT NULL DEFAULT '1',
  `lang_id` int(11) NOT NULL DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_configcontent`
--

INSERT INTO `tbl_configcontent` (`id`, `name`, `icon`, `show_name`, `show_icon`, `lang_id`, `isactive`) VALUES
(1, 'NgÃ y Ä‘Äƒng', '', 1, 0, 0, 0),
(2, 'Cáº­p nháº­t láº§n cuá»‘i', '', 1, 0, 0, 0),
(3, 'NgÃ y Ä‘Äƒng', '', 1, 0, 0, 0),
(4, 'Tags', '', 1, 0, 0, 0),
(5, 'Ã kiáº¿n', 'images/icons/comment.png', 0, 1, 0, 0),
(6, 'Zing Me', 'images/icons/logozing.gif', 0, 1, 0, 1),
(7, 'Yahoo', 'images/icons/icon_yahoo.gif', 0, 1, 0, 1),
(8, 'Facebook', 'images/icons/icon_facebook.gif', 0, 1, 0, 1),
(9, 'Twitter', 'images/icons/icon_twitter.gif', 0, 1, 0, 1),
(10, 'Email', 'images/icons/icon_mail.gif', 0, 1, 0, 1),
(11, 'LÆ°u tin', 'images/icons/icon_star.gif', 0, 1, 0, 1),
(12, 'In', 'images/icons/icon-print.gif', 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_configsite`
--

CREATE TABLE `tbl_configsite` (
  `config_id` int(11) NOT NULL,
  `tem_id` int(11) DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intro` longtext COLLATE utf8_unicode_ci,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8_unicode_ci,
  `meta_keyword` longtext COLLATE utf8_unicode_ci,
  `meta_descript` longtext COLLATE utf8_unicode_ci,
  `lang_id` int(11) NOT NULL DEFAULT '0',
  `contact` text COLLATE utf8_unicode_ci NOT NULL,
  `footer` text COLLATE utf8_unicode_ci NOT NULL,
  `nick_yahoo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_yahoo` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `tbl_configsite`
--

INSERT INTO `tbl_configsite` (`config_id`, `tem_id`, `company_name`, `title`, `intro`, `address`, `phone`, `fax`, `email`, `website`, `banner`, `logo`, `meta_keyword`, `meta_descript`, `lang_id`, `contact`, `footer`, `nick_yahoo`, `name_yahoo`) VALUES
(1, 0, '', 'Công ty TNHH Tân Vương', '', '', '(04) 3633 4888', '', 'maychebiengo.tanvuong@gmail.com', '', '', '<br>', 'Chế biến gỗ, máy công nghiệp, máy chế biến gỗ, máy cưa, máy bào, máy khoan, máy chà nhám, máy chuốt cạnh...', 'Chuyên cung cấp các loại máy chế biến gỗ uy tín hàng đầu tại Việt Nam', 0, '<br>', '<br>', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_content`
--

CREATE TABLE `tbl_content` (
  `con_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(11) NOT NULL,
  `thumb_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creatdate` date NOT NULL,
  `modifydate` date NOT NULL,
  `gmem_id` int(11) NOT NULL DEFAULT '0',
  `metakey` text COLLATE utf8_unicode_ci NOT NULL,
  `metadesc` text COLLATE utf8_unicode_ci NOT NULL,
  `config` text COLLATE utf8_unicode_ci NOT NULL,
  `visited` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `isHot` int(11) NOT NULL DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_content`
--

INSERT INTO `tbl_content` (`con_id`, `code`, `cat_id`, `thumb_img`, `creatdate`, `modifydate`, `gmem_id`, `metakey`, `metadesc`, `config`, `visited`, `order`, `isHot`, `isactive`) VALUES
(176, 'cau-hinh-may-tuy-chon', 88, 'http://localhost/shoptuancua/images/dichvu/chose.jpg', '2016-01-11', '2016-01-13', 1, '', '', '', 114, 0, 0, 1),
(215, 'gioi-thieu', 89, 'http://localhost/shoptuancua/images/dichvu/customer.jpg', '2016-01-10', '2016-03-27', 1, '', '', '', 126, 0, 0, 1),
(221, 'cham-soc-khach-hang', 88, 'http://localhost/shoptuancua/images/dichvu/customer.jpg', '2012-05-18', '2016-01-25', 1, '', '', '', 86, 0, 0, 1),
(242, 'dich-vu-ki-thuat', 88, 'http://localhost/shoptuancua/images/dichvu/technical.jpg', '2016-01-13', '2016-01-25', 1, '<br />\r\n<b>Notice</b>:  Undefined index: metakey in <b>/opt/lampp/htdocs/shoptuancua/admincp/components/com_contents/task/edit.php</b> on line <b>120</b><br />\r\n', '<br />\r\n<b>Notice</b>:  Undefined index: metadesc in <b>/opt/lampp/htdocs/shoptuancua/admincp/components/com_contents/task/edit.php</b> on line <b>122</b><br />\r\n', '', 11, 0, 0, 1),
(243, 'webshop', 88, 'http://localhost/shoptuancua/images/dichvu/webshop.jpg', '2016-01-13', '2016-01-25', 1, '', '', '', 11, 0, 0, 1),
(244, 'comment', 88, 'http://localhost/shoptuancua/images/dichvu/comment.png', '2016-01-13', '2016-01-25', 1, '', '', '', 7, 0, 0, 1),
(245, 'video', 88, 'http://localhost/shoptuancua/images/dichvu/video.jpg', '2016-01-13', '2016-02-21', 1, '', '', '', 11, 0, 0, 1),
(246, 'thong-tin-tuyen-dung', 91, 'http://localhost/shoptuancua/images/service_sale.jpg', '2016-01-15', '2016-01-21', 1, '', '', '', 21, 0, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_content_text`
--

CREATE TABLE `tbl_content_text` (
  `con_text_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fulltext` longtext COLLATE utf8_unicode_ci,
  `author` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lag_id` int(11) DEFAULT NULL,
  `isactive` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_content_text`
--

INSERT INTO `tbl_content_text` (`con_text_id`, `con_id`, `intro`, `title`, `fulltext`, `author`, `lag_id`, `isactive`) VALUES
(198, 176, '&nbsp;Là một nhà sản xuất máy móc thiết bị chế biến gỗ cao cấp, MARTIN cung cấp một số lượng áp đảo của các tùy chọn khác nhau, phụ thuộc vào ứng dụng của bạn...', 'Cấu hình máy tùy chọn', 'Là một nhà sản xuất máy móc thiết bị chế biến gỗ cao cấp, MARTIN cung cấp một số lượng áp đảo của các tùy chọn khác nhau, phụ thuộc vào ứng dụng của bạn. MARTIN phục vụ cho ngành gỗ, các nhà sản xuất nội các, đồ ghỗ, đồ gỗ và nhựa cho khách hàng. Hãy để chúng tôi làm cho một báo giá cụ thể theo yêu cầu của bạn. Gửi yêu cầu của bạn và bao gồm càng nhiều thông tin càng tốt. Chúng tôi sẽ trả lời thường ngay ngày hôm sau!<div style=\"text-align: center;\"><img src=\"http://www.martin-usa.com/wp-content/uploads/2014/04/configurator.jpg\" alt=\"\" align=\"\" border=\"0px\" width=\"500\" height=\"500\"></div>', '', 0, NULL),
(237, 215, 'Công ty TNHH THƯƠNG MẠI TÂN VƯƠNG nhà cung cấp máy chế biến gỗ có uy tín tại Việt Nam. Chúng tôi đại diện phân phối độc quyền cho các hãng sản xuất lớn của Trung Quốc: Tập Đoàn GONGYOU. Bên cạnh đó, chúng tôi còn hợp tác làm đại lý cho các hãng khác nhằm thoản mãn mọi nhu cầu của khách hàng: hãng New Mas, New-Motivity, Zhanghongtu, Deshun, Funning … Các sản phẩm mà chúng tôi cung cấp đều đạt tiêu chuẩn chất lượng ISO9001...', 'Máy chế biến gỗ Công ty TNHH Tân Vương', ' <div class=\"std\"><div class=\"content-page\"><div class=\"content-page-right-column\"><div class=\"content-page-list\"><div class=\"block-content clearfix\"><div class=\"menu-left-nav\"><div style=\"text-align: justify;\"><span style=\"font-size: 12px; line-height: 22px; font-weight: bold; font-family: Arial, \'Century Gothic\', Tahoma; color: rgb(0, 0, 255);\"><div>Công ty TNHH THƯƠNG MẠI TÂN VƯƠNG nhà cung cấp máy chế biến gỗ có uy tín tại Việt Nam. Chúng tôi đại diện phân phối độc quyền cho các hãng sản xuất lớn của Trung Quốc: Tập Đoàn GONGYOU. Bên cạnh đó, chúng tôi còn hợp tác làm đại lý cho các hãng khác nhằm thoản mãn mọi nhu cầu của khách hàng: hãng New Mas, New-Motivity, Zhanghongtu, Deshun, Funning … Các sản phẩm mà chúng tôi cung cấp đều đạt tiêu chuẩn chất lượng ISO9001.</div><div>&nbsp;</div><div>Tân Vương tiền thân là Cửa hàng Tân Trường, thành lập năm 1995, ban đầu chỉ mới cung cấp 5 chủng loại sản phẩm cưa bào cho Đại lý ở các tỉnh phía Bắc. Đến năm 2001, theo đòi hỏi tất yếu của nền kinh tế thị trường, cửa hàng Tân Trường phát triển thành Công ty TNHH Tân Vương, với hai văn phòng đặt tại Hải Dương và Hà Nội. Năm 2004, ban lãnh đạo công ty quyết định lập văn phòng đại diện tại Tp Hồ Chí Minh, thị trường không còn hạn chế trong phạm vi Miền Bắc mà bao phủ cả thị trường Miền Nam với hàng trăm chủng loại sản phẩm khác nhau.</div><div>&nbsp;</div><div>Năm 2005, một lần nữa Công ty TNHH Tân Vương được đổi tên thành Công ty TNHH Thương Mại Tân Vương, đây là bước thay đổi lớn nhằm củng cố vững chắc thương hiệu “Tân Vương”, đưa Tân Vương trở thành Doanh nghiệp hàng đầu trong lĩnh vực cung cấp thiết bị chế biến gỗ tại Việt Nam.</div><div>&nbsp;</div><div>Với nhiều năm hoạt động trong lĩnh vực kinh doanh máy chế biến gỗ, chúng tôi đã có một thị trường ổn định trên toàn lãnh thổ Việt Nam. Chúng tôi có đội ngũ nhân viên kỹ thuật chuyên nghiệp, có nhiều kinh nghiệm và thường xuyên được đào tạo bởi các chuyên gia nước ngoài đảm bảo cho việc tư vấn, lắp đặt, vận hành, bảo dưỡng và chăm sóc khách hàng chu đáo. Chính vì vậy, khách hàng hoàn toàn có thể yên tâm khi hợp tác với chúng tôi.</div><div>&nbsp;</div><div>Chúng tôi cam kết:</div><div>Chúng tôi thực hiện trực tiếp việc tiêu thụ, lắp đặt và bảo hành máy cùng với sự tham gia của chuyên gia kỹ thuật nước ngoài và trong nước, đảm bảo lợi ích dịch vụ tối đa nhất tới khách hàng.</div><div>&nbsp;</div><div>Mục đích của chúng tôi là trở thành nhà cung cấp thiết bị máy chế biến gỗ hàng đầu tại Việt Nam không chỉ về chỉ tiêu doanh số bán hàng hay chủng loại sản phẩm mà quan trọng hơn đó chính là: chất lượng sản phẩm và dịch vụ của Tân Vương luôn được khách hàng khẳng định và tin dùng.</div><div>&nbsp;</div><div>Chúng tôi chỉ cung cấp công nghệ phù hợp nhu cầu khách hàng với chất lượng sản phẩm cao nhất, giá cả cạnh tranh và dịch vụ hậu mãi tốt nhất.</div><div>Tags: máy chế biến gỗ, may che bien go</div><div>&nbsp;</div><div><br></div></span></div></div></div></div></div></div></div>', 'hoatrinh', 0, NULL),
(265, 242, '&nbsp;<span style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18.2000007629395px; text-align: justify; background-color: rgb(248, 244, 241);\">Luôn cố gắng mang đến chất lượng dịch vụ tốt nhất cho Quý khách hàng. Do vậy, dù ở bất kỳ đâu tại Việt Nam, Quý khách đều nhận được sản phẩm...được sản phẩm...được sản phẩm...</span>', 'Dịch vụ kĩ thuật', '&nbsp;<span style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18.2000007629395px; text-align: justify; background-color: rgb(248, 244, 241);\">Luôn cố gắng mang đến chất lượng dịch vụ tốt nhất cho Quý khách hàng. Do vậy, dù ở bất kỳ đâu tại Việt Nam, Quý khách đều nhận được sản phẩm...được sản phẩm...được sản phẩm...</span>', '', 0, NULL),
(266, 243, '&nbsp;<span style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18.2000007629395px; text-align: justify; background-color: rgb(248, 244, 241);\">Luôn cố gắng mang đến chất lượng dịch vụ tốt nhất cho Quý khách hàng. Do vậy, dù ở bất kỳ đâu tại Việt Nam, Quý khách đều nhận được sản phẩm...được sản phẩm...được sản phẩm...</span>', 'Webshop', '&nbsp;<span style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18.2000007629395px; text-align: justify; background-color: rgb(248, 244, 241);\">Luôn cố gắng mang đến chất lượng dịch vụ tốt nhất cho Quý khách hàng. Do vậy, dù ở bất kỳ đâu tại Việt Nam, Quý khách đều nhận được sản phẩm...được sản phẩm...được sản phẩm...</span>', '', 0, NULL),
(267, 244, '&nbsp;<span style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18.2000007629395px; text-align: justify; background-color: rgb(248, 244, 241);\">Luôn cố gắng mang đến chất lượng dịch vụ tốt nhất cho Quý khách hàng. Do vậy, dù ở bất kỳ đâu tại Việt Nam, Quý khách đều nhận được sản phẩm...được sản phẩm...được sản phẩm...</span>', 'Comment', '&nbsp;<span style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18.2000007629395px; text-align: justify; background-color: rgb(248, 244, 241);\">Luôn cố gắng mang đến chất lượng dịch vụ tốt nhất cho Quý khách hàng. Do vậy, dù ở bất kỳ đâu tại Việt Nam, Quý khách đều nhận được sản phẩm...được sản phẩm...được sản phẩm...</span>', '', 0, NULL),
(268, 245, '&nbsp;<span style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18.2000007629395px; text-align: justify; background-color: rgb(248, 244, 241);\">Luôn cố gắng mang đến chất lượng dịch vụ tốt nhất cho Quý khách hàng. Do vậy, dù ở bất kỳ đâu tại Việt Nam, Quý khách đều nhận được sản phẩm...được sản phẩm...được sản phẩm...</span>', 'Video', '<div class=\"lst_video\"><div class=\"item_vd\"><iframe allowfullscreen=\"\" src=\"http://www.youtube.com/embed/pkuLZebvmVg\" frameborder=\"0\" height=\"210\" width=\"345\"></iframe></div><div class=\"item_vd second\"><iframe allowfullscreen=\"\" src=\"http://www.youtube.com/embed/pkuLZebvmVg\" frameborder=\"0\" height=\"210\" width=\"345\"></iframe></div><div class=\"item_vd\"><iframe allowfullscreen=\"\" src=\"http://www.youtube.com/embed/pkuLZebvmVg\" frameborder=\"0\" height=\"210\" width=\"345\"></iframe></div><div class=\"item_vd second\"><iframe allowfullscreen=\"\" src=\"http://www.youtube.com/embed/pkuLZebvmVg\" frameborder=\"0\" height=\"210\" width=\"345\"></iframe></div><div class=\"item_vd\"><iframe allowfullscreen=\"\" src=\"http://www.youtube.com/embed/pkuLZebvmVg\" frameborder=\"0\" height=\"210\" width=\"345\"></iframe></div><div class=\"item_vd second\"><iframe allowfullscreen=\"\" src=\"http://www.youtube.com/embed/pkuLZebvmVg\" frameborder=\"0\" height=\"210\" width=\"345\"></iframe></div></div>', '', 0, NULL),
(243, 221, 'Luôn cố gắng mang đến chất lượng dịch vụ tốt nhất cho Quý khách hàng. Do vậy, dù ở bất kỳ đâu tại Việt Nam, Quý khách đều nhận được sản phẩm...được sản phẩm...được sản phẩm...được sản phẩm...được sản phẩm...được sản phẩm...', 'Chăm sóc khách hàng', '<div class=\"std\"><div class=\"content-page\">\r\n<div class=\"content-page-main-column\">\r\n<p><span style=\"font-weight: bold;\">Miễn 100% chi phí giao hàng trên toàn quốc:</span></p>\r\n<p>Giaytot.com luôn cố gắng mang đến chất lượng dịch vụ tốt nhất cho Quý\r\n khách hàng. Do vậy, dù ở bất kỳ đâu tại Việt Nam, Quý khách đều nhận \r\nđược sản phẩm đúng với giá niêm yết trên Website. <span style=\"font-weight: bold;\">Giaytot.com đã thanh toán toàn bộ chi phí vận chuyển cho Quý khách!</span></p>\r\n<p><span style=\"font-weight: bold;\">Thời gian giao hàng:</span></p>\r\n<div class=\"faq_conent\">\r\n<p>Đối với các đơn hàng tại Hà Nội (áp dụng với các quận Ba Đình, Hoàn \r\nKiếm, Đống Đa, Hai Bà Trưng, Cầu Giấy, Tây Hồ, Hoàng Mai, Thanh Xuân), \r\nQuý khách sẽ nhận được sản phẩm trong ngày (đối với các đơn hàng phát \r\nsinh trong buổi sáng hoặc buổi chiều) hoặc dưới 24 tiếng (đối với các \r\nđơn hàng phát sinh sau 18h).</p>\r\n<p>Các đơn hàng tại TP. Hồ Chí Minh, thời gian giao hàng dưới 24 tiếng.</p>\r\n<p>Các tỉnh thành khác, thời gian giao hàng là từ 18 tiếng đến 72 tiếng.</p>\r\n<p><span style=\"font-style: italic;\">(Quý khách vui lòng cộng thêm 24 tiếng nếu thời gian đặt hàng nằm trong khoảng 18h Thứ bảy đến 12h trưa Chủ nhật).</span></p>\r\n<p>Đối với đơn hàng có địa chỉ giao nhận ở nước ngoài: Giaytot.com sẽ \r\n&nbsp;thông báo cụ thể tới quý khách thời gian giao nhận hàng sau khi \r\nGiaytot.com liên hệ với đối tác giao nhận.</p>\r\n<p>Nếu quá thời hạn giao hàng Giaytot.com đã cam kết mà Quý khách vẫn \r\nchưa nhận được sản phẩm đã đặt, Quý khách vui lòng thông báo tới bộ phận\r\n Chăm sóc khách hàng theo số điện thoại (04).6651.5675 để được hỗ trợ.</p>\r\n<p><span style=\"font-weight: bold;\">Địa điểm nhận hàng:</span></p>\r\n<p>Quý khách có thể nhận sản phẩm tại các địa chỉ khác, không phải nơi \r\nở. Khi đặt hàng, Quý khách vui lòng cung cấp số điện thoại người nhận, \r\nthời gian người nhận có mặt để Giaytot.com tiện liên hệ khi giao hàng.</p>\r\n</div>\r\n</div>\r\n<div class=\"content-page-right-column\">\r\n<div class=\"content-page-list\">\r\n<div class=\"block-title green-title clearfix\">Hỗ trợ mua hàng</div>\r\n<div class=\"block-content clearfix\">\r\n<div class=\"menu-left-nav\">\r\n<ul id=\"leftnav\" class=\"left-navigator clearfix\"><li class=\"level0 nav-1\"><a href=\"http://www.giaytot.com/quy-trinh-mua-hang.html/\"> Quy trình mua hàng </a></li><li class=\"level0 nav-2\"><a href=\"http://www.giaytot.com/phuong-thuc-thanh-toan.html/\"> Phương thức thanh toán </a></li><li class=\"level0 nav-3\"><a href=\"http://www.giaytot.com/chinh-sach-tra-lai-hang.html/\"> Chính sách trả lại hàng </a></li><li class=\"level0 nav-4 active\"><a href=\"http://www.giaytot.com/phuong-thuc-van-chuyen.html/\"> Phương thức vận chuyển </a></li><li class=\"level0 nav-5\"><a href=\"http://www.giaytot.com/chinh-sach-diem-thuong.html/\"> Chính sách điểm thưởng </a></li><li class=\"level0 nav-6\"><a href=\"http://www.giaytot.com/dia-diem-kho-hang.html/\">Địa điểm kho hàng </a></li></ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div></div>', '', 0, NULL),
(269, 246, '<span style=\"color: rgb(34, 34, 34); font-family: Arial, Helvetica, sans-serif; font-size: 14px; line-height: 18.2000007629395px; text-align: justify; background-color: rgb(248, 244, 241);\">Luôn cố gắng mang đến chất lượng dịch vụ tốt nhất cho Quý khách hàng. Do vậy, dù ở bất kỳ đâu tại Việt Nam, Quý khách đều nhận được sản phẩm...được sản phẩm...được sản phẩm..</span>', 'Thông tin tuyển dụng', '<div style=\"text-align: center;\"><img src=\"http://localhost/shoptuancua/images/download (1).jpg\" alt=\"\" align=\"\" border=\"0px\"></div>', '', 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_document`
--

CREATE TABLE `tbl_document` (
  `doc_id` int(11) NOT NULL,
  `par_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insite` int(11) DEFAULT '1',
  `assign` text COLLATE utf8_unicode_ci,
  `isactive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_gmember`
--

CREATE TABLE `tbl_gmember` (
  `gmem_id` int(11) NOT NULL,
  `par_id` int(11) DEFAULT '0',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `isadmin` int(11) DEFAULT '1',
  `isactive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `tbl_gmember`
--

INSERT INTO `tbl_gmember` (`gmem_id`, `par_id`, `name`, `intro`, `isadmin`, `isactive`) VALUES
(1, 0, 'Super Admin', '', 1, 1),
(2, 1, 'Admin', NULL, 1, 1),
(3, 2, 'Content Managers', 'Quản trị nội dung', 1, 1),
(4, 2, 'Product Manager', NULL, 1, 1),
(11, 2, 'Member Manager', '', 1, 1),
(13, 1, 'Public', 'ai cũng có quyền truy cập', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_indexlink`
--

CREATE TABLE `tbl_indexlink` (
  `index_id` int(11) NOT NULL,
  `keyword` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `target` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isactive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `tbl_indexlink`
--

INSERT INTO `tbl_indexlink` (`index_id`, `keyword`, `link`, `target`, `isactive`) VALUES
(1, 'GIS,gis,Gis', 'http://gis.com', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_language`
--

CREATE TABLE `tbl_language` (
  `lag_id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `flag` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'front_end',
  `isdefault` int(11) NOT NULL DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_language`
--

INSERT INTO `tbl_language` (`lag_id`, `code`, `name`, `flag`, `site`, `isdefault`, `isactive`) VALUES
(1, 'vi', 'Viá»‡t nam', 'vi.png', 'back_end', 1, 1),
(2, 'en', 'English', 'en.png', 'back_end', 0, 1),
(3, 'vi', 'Việt Nam', 'vi.png', 'front_end', 1, 1),
(4, 'en', 'Englishs', 'en.png', 'front_end', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_location`
--

CREATE TABLE `tbl_location` (
  `loc_id` int(11) NOT NULL,
  `loc_par` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` longtext COLLATE utf8_unicode_ci,
  `popula` text COLLATE utf8_unicode_ci,
  `lat` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poly` text COLLATE utf8_unicode_ci,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zoom` int(11) DEFAULT NULL,
  `isactive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_member`
--

CREATE TABLE `tbl_member` (
  `mem_id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `joindate` datetime NOT NULL,
  `lastlogin` datetime NOT NULL,
  `gmem_id` int(11) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_member`
--

INSERT INTO `tbl_member` (`mem_id`, `username`, `password`, `firstname`, `lastname`, `birthday`, `gender`, `address`, `phone`, `mobile`, `email`, `joindate`, `lastlogin`, `gmem_id`, `isactive`) VALUES
(6, 'tanvuong', 'd93a5def7511da3d0f2d171d9c344e91', 'admin', 'tanvuong', '2012-09-16', '0', 'Hà nội', '', '', 'maychebiengo.tanvuong@gmail.com', '2011-11-14 05:28:11', '2016-07-02 06:25:39', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_menus`
--

CREATE TABLE `tbl_menus` (
  `mnu_id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_menus`
--

INSERT INTO `tbl_menus` (`mnu_id`, `code`, `desc`, `isactive`) VALUES
(1, 'main-menu', 'Menu chính<br>', 1),
(2, 'test', '&nbsp;', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_menus_text`
--

CREATE TABLE `tbl_menus_text` (
  `mnu_id_text` int(11) NOT NULL,
  `mnu_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lag_id` int(11) DEFAULT NULL,
  `isactive` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_menus_text`
--

INSERT INTO `tbl_menus_text` (`mnu_id_text`, `mnu_id`, `name`, `lag_id`, `isactive`) VALUES
(1, 1, 'Main menu', 0, 1),
(6, 80, 'Sport menu', 0, NULL),
(20, 2, 'Menu Test', 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_mnuitem`
--

CREATE TABLE `tbl_mnuitem` (
  `mnuitem_id` int(11) NOT NULL,
  `par_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mnu_id` int(11) NOT NULL DEFAULT '0',
  `viewtype` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `cata_id` int(11) NOT NULL DEFAULT '0',
  `con_id` int(11) NOT NULL DEFAULT '0',
  `link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_mnuitem`
--

INSERT INTO `tbl_mnuitem` (`mnuitem_id`, `par_id`, `code`, `mnu_id`, `viewtype`, `cat_id`, `cata_id`, `con_id`, `link`, `class`, `order`, `isactive`) VALUES
(1, 0, 'Trang-chu', 1, 'link', 0, 0, 0, 'http://localhost/shoptuancua/index.php', 'home', 0, 1),
(2, 0, 'gioi-thieu', 1, 'article', 0, 0, 215, '', '', 0, 1),
(26, 3, 'tin-tuc-moi', 1, 'block', 7, 0, 0, '', '', 0, 1),
(27, 3, 'tin-tuyen-sinh', 1, 'block', 22, 0, 0, '', '', 0, 1),
(28, 3, 'hoat-dong-noi-bat', 1, 'block', 9, 0, 0, '', '', 0, 1),
(33, 0, 'may-bao', 5, 'link', 0, 0, 0, '#', '', 0, 1),
(35, 0, 'ten-mien-hosting', 4, 'link', 0, 0, 0, '#', '', 0, 1),
(50, 0, 'may-cua', 5, 'link', 0, 0, 0, '#', '', 0, 1),
(51, 0, 'Ve-chung-toi', 3, 'article', 0, 0, 183, '', '', 0, 1),
(53, 0, 'Dich-vu-ten-mien', 4, 'article', 0, 0, 177, '', '', 0, 1),
(58, 0, 'may-phay', 5, 'link', 0, 0, 0, '#', '', 0, 1),
(59, 0, 'may-dan-canh', 5, 'link', 0, 0, 0, '#', '', 0, 1),
(60, 0, 'Thu-gui-khach-hang', 3, 'article', 0, 0, 179, '', '', 0, 1),
(61, 0, 'Hosting', 4, 'article', 0, 0, 176, '', '', 0, 1),
(63, 0, 'dang-ky', 2, 'block', 1, 0, 0, '', '', 0, 1),
(64, 0, 'dang-nhap', 2, 'block', 1, 0, 0, '', '', 0, 1),
(65, 0, 'tro-giup', 2, 'block', 1, 0, 0, '', '', 0, 1),
(66, 0, 'Dedicated-Server', 4, 'article', 0, 0, 175, '', '', 0, 1),
(69, 0, 'may-khoan', 5, 'link', 0, 0, 0, '#', '', 0, 1),
(70, 0, 'san-pham', 1, 'link', 0, 0, 0, 'http://localhost/shoptuancua/index.php?com=products&viewtype=list', 'main_menu_product', 0, 1),
(71, 0, 'Hop-tac-kinh-doanh', 3, 'article', 0, 0, 181, '', '', 0, 1),
(72, 0, 'Mau-thiet-ke', 3, 'list', 13, 0, 0, '', '', 0, 1),
(73, 0, 'Noi-quy-quy-dinh', 3, 'list', 24, 0, 0, '', '', 0, 1),
(74, 0, 'Tin-tuc', 1, 'link', 0, 0, 0, 'http://localhost/shoptuancua/index.php?com=contents&viewtype=list', '', 0, 1),
(75, 0, 'dich-vu', 1, 'block', 88, 0, 0, '', '', 0, 1),
(84, 33, 'may-bamo-tha', 5, 'link', 0, 0, 0, 'http://#', 'item-may-bao', 0, 1),
(85, 33, 'may-bao-1-mat', 5, 'link', 0, 0, 0, 'http://#', 'item-may-bao', 0, 1),
(86, 33, 'may-bao-2-mat', 5, 'link', 0, 0, 0, 'http://#', 'item-may-bao', 0, 1),
(87, 33, 'may-bao-3-mat', 5, 'link', 0, 0, 0, 'http://#', 'item-may-bao', 0, 1),
(88, 33, 'may-bao-4-mat', 5, 'link', 0, 0, 0, 'http://#', 'item-may-bao', 0, 1),
(89, 0, 'may-phay-mong', 5, 'link', 0, 0, 0, 'http://#', '', 0, 1),
(90, 0, 'may-chot-tron', 5, 'link', 0, 0, 0, 'http://#', '', 0, 1),
(91, 0, 'may-tra-nham', 5, 'link', 0, 0, 0, 'http://#', '', 0, 1),
(92, 0, 'may-hut-chan-khong', 5, 'link', 0, 0, 0, 'http://#', '', 0, 1),
(93, 0, 'may-mai', 5, 'link', 0, 0, 0, 'http://#', '', 0, 1),
(94, 0, 'may-tien', 5, 'link', 0, 0, 0, 'http://#', '', 0, 0),
(95, 0, 'tuyen-dung', 1, 'article', 0, 0, 246, '', '', 0, 1),
(96, 0, 'lien-he', 1, 'link', 0, 0, 0, 'http://localhost/shoptuancua/index.php?com=contact', '', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_mnuitem_text`
--

CREATE TABLE `tbl_mnuitem_text` (
  `mnuitem_id_text` int(11) NOT NULL,
  `mnuitem_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `lag_id` int(11) DEFAULT NULL,
  `isactive` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_mnuitem_text`
--

INSERT INTO `tbl_mnuitem_text` (`mnuitem_id_text`, `mnuitem_id`, `name`, `intro`, `lag_id`, `isactive`) VALUES
(1, 1, 'Trang chủ', '', 0, 1),
(2, 2, 'Giới thiệu', 'Giới thiệu công ty', 0, 1),
(48, 35, 'Tên miền & Hosting', '<br>', 0, NULL),
(17, 8, 'fdfdfd', '', 0, NULL),
(36, 26, 'Tin tá»©c má»›i', '', 0, NULL),
(37, 27, 'Tin tuyá»ƒn sinh', '', 0, NULL),
(38, 28, 'Hoáº¡t Ä‘á»™ng ná»•i báº­t', '', 0, NULL),
(66, 53, 'Dịch vụ tên miền', '<br>', 0, NULL),
(46, 33, 'Máy bào', '', 0, NULL),
(63, 50, 'Máy cưa', '', 0, NULL),
(73, 59, 'Máy dán cạnh', '', 0, NULL),
(72, 58, 'Máy phay', '', 0, NULL),
(64, 51, 'Về chúng tôi', '<br>', 0, NULL),
(74, 60, 'Thư gửi khách hàng', '<br>', 0, NULL),
(75, 61, 'Hosting siêu rẻ', '<br>', 0, NULL),
(84, 70, 'Sản phẩm', '', 0, NULL),
(83, 69, 'Máy khoan', '', 0, NULL),
(85, 71, 'Hợp tác kinh doanh', '<br>', 0, NULL),
(80, 66, 'Dedicated Server', '<br>', 0, NULL),
(104, 84, 'Máy bào thẩm', '&nbsp;', 0, NULL),
(77, 63, 'Đăng ký', '<br>', 0, NULL),
(78, 64, 'Đăng nhập', '&nbsp;', 0, NULL),
(79, 65, 'Trợ giúp', '&nbsp;', 0, NULL),
(86, 72, 'Mẫu thiết kế', '&nbsp;', 0, NULL),
(87, 73, 'Nội quy quy định', '<br>', 0, NULL),
(88, 74, 'Tin tức', '', 0, NULL),
(89, 75, 'Dịch vụ', 'Dịch vụ cung cấp', 0, NULL),
(105, 85, 'Máy bào 1 mặt', '&nbsp;', 0, NULL),
(106, 86, 'Máy bào 2 mặt', '&nbsp;', 0, NULL),
(107, 87, 'Máy bào 3 mặt', '&nbsp;', 0, NULL),
(108, 88, 'Máy bào 4 mặt', '&nbsp;', 0, NULL),
(109, 89, 'Máy phay mộng', '&nbsp;', 0, NULL),
(110, 90, 'Máy chốt tròn', '&nbsp;', 0, NULL),
(111, 91, 'Máy trà nhám', '&nbsp;', 0, NULL),
(112, 92, 'Máy hút chân không', '&nbsp;', 0, NULL),
(113, 93, 'Máy mài', '&nbsp;', 0, NULL),
(114, 94, 'Máy tiện', '&nbsp;', 0, NULL),
(116, 95, 'Tuyển dụng', '', 0, NULL),
(117, 96, 'Liên hệ', '&nbsp;Liên hệ&nbsp;', 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_modtype`
--

CREATE TABLE `tbl_modtype` (
  `modtypeid` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_modtype`
--

INSERT INTO `tbl_modtype` (`modtypeid`, `code`, `name`) VALUES
(1, 'mainmenu', 'Main menu'),
(2, 'html', 'Use HTML'),
(3, 'login', 'Login'),
(4, 'banner', 'Banner'),
(5, 'latestnews', 'Latest News'),
(6, 'footer', 'Footer'),
(7, 'hotnews', 'Hot news'),
(8, 'support', 'Support'),
(9, 'comments', 'comments'),
(10, 'catalog', 'Catalog'),
(11, 'hotproduct', 'Hot Product'),
(12, 'visitcounter', 'Visit Counter'),
(13, 'menucat', 'Menu Category');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_modules`
--

CREATE TABLE `tbl_modules` (
  `mod_id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `viewtitle` int(11) NOT NULL DEFAULT '0',
  `mnu_id` int(11) NOT NULL,
  `cat_id` int(50) NOT NULL,
  `theme` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mnuids` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_modules`
--

INSERT INTO `tbl_modules` (`mod_id`, `type`, `viewtitle`, `mnu_id`, `cat_id`, `theme`, `position`, `mnuids`, `class`, `order`, `isactive`) VALUES
(38, 'visitcounter', 0, 0, 0, '', 'user2', 'all', 'visit_counter', 0, 1),
(51, 'mainmenu', 0, 1, 0, 'brow1', 'navitor', 'all', '', 0, 1),
(52, 'catalog', 0, 5, 0, 'brow1', 'user1', 'all', '', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_modules_text`
--

CREATE TABLE `tbl_modules_text` (
  `mod_text_id` int(11) NOT NULL,
  `mod_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `lag_id` int(11) DEFAULT NULL,
  `isactive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `tbl_modules_text`
--

INSERT INTO `tbl_modules_text` (`mod_text_id`, `mod_id`, `title`, `content`, `lag_id`, `isactive`) VALUES
(35, 38, 'Thống kê truy cập', '', 0, 1),
(45, 48, 'Khách hàng', '', 0, 1),
(46, 49, 'Đường dẫn', '', 0, 1),
(47, 50, 'Top20 Product', '', 0, 1),
(48, 51, 'Main menu', '', 0, 1),
(49, 52, 'Menu Catalog', '', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `config` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `cdate` datetime NOT NULL,
  `cname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cphone` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cemail` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `shiptype` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `add` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `totalmoney` decimal(10,0) NOT NULL,
  `salercode` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `pro_id`, `config`, `cdate`, `cname`, `cphone`, `cemail`, `note`, `shiptype`, `add`, `payment`, `totalmoney`, `salercode`, `status`) VALUES
(158, 31, '[\"Tính năng 1\",\"Tính năng 2\"]', '2016-01-15 10:57:56', 'Trần Xuân Bách', '01656241161', '', 'Giao hàng trong 1 tuần									\r\n								', '', 'Tăng Thiết Giáp Cổ Nhuế Hà Nôi', '', '0', '', 2),
(159, 31, '[\"Tính năng 1\",\"Tính năng 2\"]', '2016-01-19 04:45:32', 'Nguyễn Đức Diễn', '0987676767', '', '									\r\n								', '', 'Trần cung ', '', '0', '', 0),
(160, 54, '[\"xxxxxxxxxxxx\",\"ddddddddddddddddd\"]', '2016-03-27 05:47:16', 'Tran Cong Phuoc', '0987676767', '', 'oki									\r\n								', '', 'Ha noi', '', '0', '', 0),
(161, 20, '', '2016-03-27 01:52:23', 'ccccccccc', '0987676767', '', '									\r\n					ccccc			', '', 'ccccc', '', '0', '', 0),
(162, 30, '', '2016-03-27 02:16:56', 'xvxv', '0987676767', '', '									\r\n				cvcvcvcvv				', '', 'vcvc', '', '0', '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `quantity` decimal(10,0) NOT NULL,
  `price` int(11) NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_partners`
--

CREATE TABLE `tbl_partners` (
  `partner_id` int(11) NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isactive` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_partners`
--

INSERT INTO `tbl_partners` (`partner_id`, `company_name`, `intro`, `address`, `phone`, `fax`, `logo`, `website`, `lat`, `lng`, `isactive`) VALUES
(1, 'CÃ´ng Ty IGF', NULL, 'Sá»‘ 28/4 ÄÃª La ThÃ nh, Äá»‘ng Äa, HÃ  Ná»™i', '0936831277', NULL, 'igflogo.png', 'http://www.igf.com.vn', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pro_id` int(11) NOT NULL,
  `class` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isShow` tinyint(10) NOT NULL DEFAULT '1',
  `isConfigPro` tinyint(4) NOT NULL DEFAULT '1',
  `folder` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `imgslide` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intro` text COLLATE utf8_unicode_ci NOT NULL,
  `fulltext` longtext COLLATE utf8_unicode_ci NOT NULL,
  `thumb` text COLLATE utf8_unicode_ci NOT NULL,
  `old_price` decimal(10,0) NOT NULL,
  `cur_price` decimal(10,0) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `cdate` datetime NOT NULL,
  `mdate` datetime NOT NULL,
  `visited` int(11) NOT NULL,
  `order` int(11) DEFAULT '0',
  `meta_key` text COLLATE utf8_unicode_ci,
  `meta_desc` text COLLATE utf8_unicode_ci,
  `config` text COLLATE utf8_unicode_ci,
  `ishot` int(11) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `class`, `cat_id`, `code`, `isShow`, `isConfigPro`, `folder`, `imgslide`, `name`, `intro`, `fulltext`, `thumb`, `old_price`, `cur_price`, `quantity`, `cdate`, `mdate`, `visited`, `order`, `meta_key`, `meta_desc`, `config`, `ishot`, `isactive`) VALUES
(21, 'cat_grey ', 38, 'MB01', 1, 1, '', '', 'Máy bào MB1', '&nbsp;1. Máy cắt nhanh<div>2. Máy chém khỏe</div><div>3. Tiết kiệm điện năng</div>', '&nbsp;1. Máy cắt nhanh<div>2. Máy chém khỏe</div><div>3. Tiết kiệm điện năng</div>', 'http://localhost/shoptuancua/images/public/Maybao/pro.jpg', '0', '0', 0, '2013-03-18 00:00:00', '2013-03-18 00:00:00', 30, 0, '', '', '', 1, 1),
(20, 'cat_red', 8, 'MB2', 1, 0, 'maybao01', 'uploads/thang-diem-toeic-2015.png@uploads/thang-diem-toeic-2015.png@uploads/thang-diem-toeic-2015.png', 'Máy bào MB2', '&nbsp;1. Máy cắt nhanh<div>2. Máy chém khỏe</div><div>3. Tiết kiệm điện năng</div>', '1. Máy cắt nhanh<div>2. Máy chém khỏe</div><div>3. Tiết kiệm điện năng</div>', 'http://localhost/shoptuancua/images/public/Maybao/pro.jpg', '0', '0', 10, '2013-03-18 00:00:00', '2013-03-18 00:00:00', 41, 0, '', '', '', 1, 1),
(57, 'cat_red', 8, 'xxxxx', 1, 1, '', 'uploads/chose.jpg,uploads/newsletter_icon.png', 'xxxxxxx', '&nbsp;', '&nbsp;', 'http://localhost/shoptuancua/images/configurator.jpg', '0', '0', 0, '2016-03-28 00:00:00', '2016-03-28 00:00:00', 1, 0, '', '', '', 0, 1),
(19, 'cat_red', 8, 'MB3', 1, 1, '', 'uploads/BJC1128G.jpeg,uploads/11111.jpeg', 'Máy bào MB3', '&nbsp;1. Máy cắt nhanh<div>2. Máy chém khỏe</div><div>3. Tiết kiệm điện năng</div>', '&nbsp;1. Máy cắt nhanh<div>2. Máy chém khỏe</div><div>3. Tiết kiệm điện năng</div>', 'http://localhost/shoptuancua/images/public/Maybao/pro.jpg', '0', '0', 10, '2013-03-18 00:00:00', '2013-03-18 00:00:00', 30, 0, '', '', '', 1, 1),
(25, 'cat_ochre', 10, 'MBT1', 1, 1, '', '', 'Máy bào thẩm', '&nbsp;', '&nbsp;', 'http://localhost/shoptuancua/images/public/Maybao/pro2.jpg', '0', '0', 0, '2016-01-12 00:00:00', '2016-01-12 00:00:00', 10, 0, '', '', '', 0, 1),
(30, 'cat_orange', 9, 'MC01', 1, 1, '', '', 'Máy cưa MC01', '1. Máy cắt nhanh<div>2. Máy chém khỏe</div><div>3. Tiết kiệm điện năng</div>', '1.Điện áp 220A<div>2.Thông số Speed 8000/s</div><div>3.Quạt gió ISO 9001</div>', 'http://localhost/shoptuancua/images/public/Maycua/pro2.jpg', '0', '0', 0, '2016-01-13 00:00:00', '2016-01-13 00:00:00', 9, 0, '', '', '', 0, 1),
(31, 'cat_red', 30, 'T2', 1, 1, '', '', 'Máy bào 2 mặt T1', '&nbsp;', '&nbsp;', 'http://localhost/shoptuancua/images/public/Maybao/pro.jpg', '0', '0', 0, '2016-01-13 00:00:00', '2016-01-13 00:00:00', 27, 0, '', '', '', 0, 1),
(32, 'cat_sand ', 34, 'T02', 1, 1, '', '', 'Máy bào thẩm T02', '&nbsp;', '&nbsp;', 'http://localhost/shoptuancua/images/public/Maybao/pro2.jpg', '0', '0', 0, '2016-01-13 00:00:00', '2016-01-13 00:00:00', 4, 0, '', '', '', 0, 1),
(35, 'cat_red ', 29, 'T03', 1, 1, '', '', 'Máy bào 1 mặt T03', '&nbsp;', '&nbsp;', 'http://localhost/shoptuancua/images/public/Maybao/pro2.jpg', '0', '0', 0, '2016-01-13 00:00:00', '2016-01-13 00:00:00', 12, 0, '', '', '', 0, 1),
(37, 'cat_orange', 9, 'MC01', 1, 1, 'maycua', '', 'Máy cưa lưỡi to', '&nbsp;Mô tả tính năng sản phẩm<span class=\"Apple-tab-span\" style=\"white-space:pre\">		</span>', '&nbsp;Thông số kĩ thuật', 'http://localhost/shoptuancua/images/public/Maybao/pro.jpg', '0', '0', 0, '2016-01-25 00:00:00', '2016-01-25 00:00:00', 7, 0, '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_singers`
--

CREATE TABLE `tbl_singers` (
  `sing_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `isactive` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_template`
--

CREATE TABLE `tbl_template` (
  `tem_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `author_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `author_site` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `site` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mnuids` text COLLATE utf8_unicode_ci NOT NULL,
  `isdefault` int(11) NOT NULL DEFAULT '0',
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_template`
--

INSERT INTO `tbl_template` (`tem_id`, `name`, `desc`, `author`, `author_email`, `author_site`, `site`, `mnuids`, `isdefault`, `isactive`) VALUES
(2, 'default', 'Template máº·t Ä‘á»‹nh cá»§a admin', 'GFCMS TEAM', 'contact@gmail.com', 'glowfuture.com', 'admin', '', 1, 1),
(4, 'igf', '', 'IGF', 'thuynguyen2607@gmail.com', 'igf.com.vn', 'site', '', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_video`
--

CREATE TABLE `tbl_video` (
  `pic_id` int(11) NOT NULL,
  `album_id` int(11) DEFAULT NULL,
  `singer_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8_unicode_ci,
  `lyric` text COLLATE utf8_unicode_ci,
  `file_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isactive` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_visit`
--

CREATE TABLE `tbl_visit` (
  `id` int(11) NOT NULL,
  `ip` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `isonline` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_visit`
--

INSERT INTO `tbl_visit` (`id`, `ip`, `date`, `isonline`) VALUES
(1, '2130706433', '2012-11-08', 0),
(2, '2130706433', '2012-11-08', 0),
(3, '2130706433', '2012-11-08', 0),
(4, '2130706433', '2012-11-08', 0),
(5, '2130706433', '2012-11-14', 0),
(6, '2130706433', '2012-11-14', 0),
(7, '2130706433', '2012-11-14', 0),
(8, '2130706433', '2012-11-14', 0),
(9, '2130706433', '2012-11-15', 0),
(10, '2130706433', '2013-03-18', 0),
(11, '2130706433', '2013-03-18', 0),
(12, '2130706433', '2013-03-19', 0),
(13, '2130706433', '2013-03-19', 0),
(14, '2130706433', '2013-03-19', 0),
(15, '2130706433', '2013-03-19', 0),
(16, '2130706433', '2013-03-19', 0),
(17, '2130706433', '2013-03-19', 0),
(18, '2130706433', '2013-03-20', 0),
(19, '2130706433', '2013-03-20', 0),
(20, '2130706433', '2013-03-20', 0),
(21, '2130706433', '2013-03-20', 0),
(22, '2130706433', '2013-03-20', 0),
(23, '2130706433', '2013-03-20', 0),
(24, '2130706433', '2013-03-20', 0),
(25, '2130706433', '2013-03-21', 0),
(26, '2918999155', '2013-03-21', 0),
(27, '2918999152', '2013-03-21', 0),
(28, '3075556944', '2013-03-21', 0),
(29, '3075556944', '2013-03-21', 0),
(30, '3075556944', '2013-03-21', 0),
(31, '3075556944', '2013-03-21', 0),
(32, '3075556944', '2013-03-21', 0),
(33, '712088936', '2013-03-21', 0),
(34, '3075556944', '2013-03-21', 0),
(35, '3075556944', '2013-03-21', 0),
(36, '3075556944', '2013-03-21', 0),
(37, '712088936', '2013-03-21', 0),
(38, '3075556944', '2013-03-21', 0),
(39, '3075556944', '2013-03-22', 0),
(40, '712088936', '2013-03-22', 0),
(41, '3075556944', '2013-03-22', 0),
(42, '712088936', '2013-03-22', 0),
(43, '3075542383', '2013-03-22', 0),
(44, '3075542383', '2013-03-22', 0),
(45, '3075542383', '2013-03-22', 0),
(46, '3075542383', '2013-03-23', 0),
(47, '3075542383', '2013-03-23', 0),
(48, '3075542383', '2013-03-23', 0),
(49, '3075542383', '2013-03-23', 0),
(50, '3075556944', '2013-03-23', 0),
(51, '20408384', '2013-03-23', 0),
(52, '1168893041', '2013-03-23', 0),
(53, '3075556944', '2013-03-23', 0),
(54, '3075556944', '2013-03-23', 0),
(55, '3075556944', '2013-03-23', 0),
(56, '2927750557', '2013-03-24', 0),
(57, '2927750557', '2013-03-24', 0),
(58, '2927750557', '2013-03-24', 0),
(59, '2927750557', '2013-03-24', 0),
(60, '2927750557', '2013-03-24', 0),
(61, '3075540533', '2013-03-24', 0),
(62, '712089867', '2013-03-26', 0),
(63, '2927750557', '2013-03-26', 0),
(64, '2927750557', '2013-03-26', 0),
(65, '3706156526', '2013-03-26', 0),
(66, '3075554446', '2013-03-28', 0),
(67, '3075554446', '2013-03-29', 0),
(68, '2927750557', '2013-03-31', 0),
(69, '2927750557', '2013-03-31', 0),
(70, '457343002', '2013-04-01', 0),
(71, '3075563329', '2013-04-01', 0),
(72, '3075563329', '2013-04-01', 0),
(73, '3075563329', '2013-04-02', 0),
(74, '2927750557', '2013-04-02', 0),
(75, '712072398', '2013-04-08', 0),
(76, '20391260', '2013-04-09', 0),
(77, '3075550244', '2013-04-09', 0),
(78, '3075540314', '2013-04-10', 0),
(79, '712072398', '2013-04-13', 0),
(80, '712074872', '2013-04-19', 0),
(81, '2130706433', '2016-01-15', 0),
(82, '2130706433', '2016-01-15', 0),
(83, '2130706433', '2016-01-15', 0),
(84, '2130706433', '2016-01-15', 0),
(85, '2130706433', '2016-01-15', 0),
(86, '2130706433', '2016-01-15', 0),
(87, '2130706433', '2016-01-15', 0),
(88, '2130706433', '2016-01-15', 0),
(89, '2130706433', '2016-01-18', 0),
(90, '2130706433', '2016-01-18', 0),
(91, '2130706433', '2016-01-18', 0),
(92, '2130706433', '2016-01-18', 0),
(93, '2130706433', '2016-01-18', 0),
(94, '2130706433', '2016-01-18', 0),
(95, '2130706433', '2016-01-18', 0),
(96, '2130706433', '2016-01-18', 0),
(97, '2130706433', '2016-01-18', 0),
(98, '2130706433', '2016-01-18', 0),
(99, '2130706433', '2016-01-18', 0),
(100, '2130706433', '2016-01-18', 0),
(101, '2130706433', '2016-01-19', 0),
(102, '2130706433', '2016-01-19', 0),
(103, '2130706433', '2016-01-19', 0),
(104, '2130706433', '2016-01-19', 0),
(105, '2130706433', '2016-01-19', 0),
(106, '2130706433', '2016-01-19', 0),
(107, '2130706433', '2016-01-19', 0),
(108, '2130706433', '2016-01-20', 0),
(109, '2130706433', '2016-01-20', 0),
(110, '2130706433', '2016-01-20', 0),
(111, '2130706433', '2016-01-20', 0),
(112, '2130706433', '2016-01-21', 0),
(113, '2130706433', '2016-01-21', 0),
(114, '2130706433', '2016-01-21', 0),
(115, '2130706433', '2016-01-21', 0),
(116, '2130706433', '2016-01-21', 0),
(117, '2130706433', '2016-01-21', 0),
(118, '2130706433', '2016-01-21', 0),
(119, '2130706433', '2016-01-25', 0),
(120, '2130706433', '2016-01-25', 0),
(121, '2130706433', '2016-01-25', 0),
(122, '2130706433', '2016-01-25', 0),
(123, '2130706433', '2016-01-25', 0),
(124, '2130706433', '2016-01-25', 0),
(125, '2130706433', '2016-01-25', 0),
(126, '2130706433', '2016-01-25', 0),
(127, '2130706433', '2016-01-25', 0),
(128, '2130706433', '2016-01-25', 0),
(129, '2130706433', '2016-01-25', 0),
(130, '2130706433', '2016-01-25', 0),
(131, '2130706433', '2016-01-25', 0),
(132, '2130706433', '2016-01-25', 0),
(133, '2130706433', '2016-01-25', 0),
(134, '2130706433', '2016-01-25', 0),
(135, '2130706433', '2016-01-25', 0),
(136, '2130706433', '2016-01-25', 0),
(137, '2130706433', '2016-01-25', 0),
(138, '2130706433', '2016-01-25', 0),
(139, '', '2016-01-25', 0),
(140, '', '2016-01-25', 0),
(141, '', '2016-01-25', 0),
(142, '', '2016-01-25', 0),
(143, '', '2016-01-25', 0),
(144, '', '2016-02-21', 0),
(145, '', '2016-02-21', 0),
(146, '', '2016-02-21', 0),
(147, '', '2016-03-16', 0),
(148, '', '2016-03-18', 0),
(149, '', '2016-03-20', 0),
(150, '', '2016-03-20', 0),
(151, '', '2016-03-24', 0),
(152, '', '2016-03-24', 0),
(153, '', '2016-03-25', 0),
(154, '', '2016-03-26', 0),
(155, '', '2016-03-26', 0),
(156, '', '2016-03-27', 0),
(157, '', '2016-03-27', 0),
(158, '', '2016-03-27', 0),
(159, '', '2016-03-27', 0),
(160, '', '2016-03-27', 0),
(161, '', '2016-03-27', 0),
(162, '', '2016-03-28', 0),
(163, '', '2016-03-28', 0),
(164, '', '2016-03-30', 0),
(165, '', '2016-05-29', 0),
(166, '', '2016-06-01', 0),
(167, '', '2016-06-04', 0),
(168, '', '2018-05-26', 1);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `view_cate`
-- (See below for the actual view)
--
CREATE TABLE `view_cate` (
`cat_id` int(11)
,`par_id` int(11)
,`isactive` int(11)
,`name` varchar(100)
,`desc` text
,`lag_id` int(11)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `view_category`
-- (See below for the actual view)
--
CREATE TABLE `view_category` (
`cat_id` int(11)
,`name` varchar(100)
,`desc` text
,`lag_id` int(11)
,`isactive` int(11)
,`par_id` int(11)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `view_comments`
-- (See below for the actual view)
--
CREATE TABLE `view_comments` (
`comm_id` int(11)
,`par_id` int(11)
,`joindate` datetime
,`isactive` int(11)
,`thumb` varchar(225)
,`content` longtext
,`lag_id` int(11)
,`username` varchar(225)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `view_content`
-- (See below for the actual view)
--
CREATE TABLE `view_content` (
`con_id` int(11)
,`code` varchar(255)
,`cat_id` int(11)
,`thumb_img` varchar(255)
,`creatdate` date
,`modifydate` date
,`gmem_id` int(11)
,`metakey` text
,`metadesc` text
,`visited` int(11)
,`order` int(11)
,`isactive` int(11)
,`intro` text
,`title` varchar(255)
,`fulltext` longtext
,`author` varchar(50)
,`lag_id` int(11)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `view_menu`
-- (See below for the actual view)
--
CREATE TABLE `view_menu` (
`mnu_id` int(11)
,`code` varchar(50)
,`desc` text
,`isactive` int(11)
,`name` varchar(50)
,`lag_id` int(11)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `view_menuitem`
-- (See below for the actual view)
--
CREATE TABLE `view_menuitem` (
`mnuitem_id` int(11)
,`par_id` int(11)
,`code` varchar(50)
,`mnu_id` int(11)
,`viewtype` varchar(50)
,`cat_id` int(11)
,`cata_id` int(11)
,`con_id` int(11)
,`link` varchar(100)
,`class` varchar(50)
,`order` int(11)
,`isactive` int(11)
,`name` varchar(50)
,`intro` text
,`lag_id` int(11)
);

-- --------------------------------------------------------

--
-- Cấu trúc đóng vai cho view `view_module`
-- (See below for the actual view)
--
CREATE TABLE `view_module` (
`mod_id` int(11)
,`type` varchar(50)
,`viewtitle` int(11)
,`mnu_id` int(11)
,`cat_id` int(50)
,`theme` varchar(50)
,`position` varchar(50)
,`mnuids` varchar(100)
,`class` varchar(50)
,`order` int(11)
,`isactive` int(11)
,`title` varchar(255)
,`content` longtext
,`lag_id` int(11)
);

-- --------------------------------------------------------

--
-- Cấu trúc cho view `view_cate`
--
DROP TABLE IF EXISTS `view_cate`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_cate`  AS  (select `tbl_category`.`cat_id` AS `cat_id`,`tbl_category`.`par_id` AS `par_id`,`tbl_category`.`isactive` AS `isactive`,`tbl_category_text`.`name` AS `name`,`tbl_category_text`.`desc` AS `desc`,`tbl_category_text`.`lag_id` AS `lag_id` from (`tbl_category_text` join `tbl_category` on((`tbl_category_text`.`cat_id` = `tbl_category`.`cat_id`)))) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `view_category`
--
DROP TABLE IF EXISTS `view_category`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_category`  AS  (select `tbl_category_text`.`cat_id` AS `cat_id`,`tbl_category_text`.`name` AS `name`,`tbl_category_text`.`desc` AS `desc`,`tbl_category_text`.`lag_id` AS `lag_id`,`tbl_category_text`.`isactive` AS `isactive`,`tbl_category`.`par_id` AS `par_id` from (`tbl_category` join `tbl_category_text` on((`tbl_category`.`cat_id` = `tbl_category_text`.`cat_id`)))) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `view_comments`
--
DROP TABLE IF EXISTS `view_comments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_comments`  AS  (select `tbl_comment`.`comm_id` AS `comm_id`,`tbl_comment`.`par_id` AS `par_id`,`tbl_comment`.`joindate` AS `joindate`,`tbl_comment`.`isactive` AS `isactive`,`tbl_comment`.`thumb` AS `thumb`,`tbl_comment_text`.`content` AS `content`,`tbl_comment_text`.`lag_id` AS `lag_id`,`tbl_comment_text`.`username` AS `username` from (`tbl_comment_text` join `tbl_comment` on((`tbl_comment_text`.`comm_id` = `tbl_comment`.`comm_id`)))) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `view_content`
--
DROP TABLE IF EXISTS `view_content`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_content`  AS  (select `tbl_content`.`con_id` AS `con_id`,`tbl_content`.`code` AS `code`,`tbl_content`.`cat_id` AS `cat_id`,`tbl_content`.`thumb_img` AS `thumb_img`,`tbl_content`.`creatdate` AS `creatdate`,`tbl_content`.`modifydate` AS `modifydate`,`tbl_content`.`gmem_id` AS `gmem_id`,`tbl_content`.`metakey` AS `metakey`,`tbl_content`.`metadesc` AS `metadesc`,`tbl_content`.`visited` AS `visited`,`tbl_content`.`order` AS `order`,`tbl_content`.`isactive` AS `isactive`,`tbl_content_text`.`intro` AS `intro`,`tbl_content_text`.`title` AS `title`,`tbl_content_text`.`fulltext` AS `fulltext`,`tbl_content_text`.`author` AS `author`,`tbl_content_text`.`lag_id` AS `lag_id` from (`tbl_content` join `tbl_content_text` on((`tbl_content`.`con_id` = `tbl_content_text`.`con_id`)))) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `view_menu`
--
DROP TABLE IF EXISTS `view_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menu`  AS  (select `tbl_menus`.`mnu_id` AS `mnu_id`,`tbl_menus`.`code` AS `code`,`tbl_menus`.`desc` AS `desc`,`tbl_menus`.`isactive` AS `isactive`,`tbl_menus_text`.`name` AS `name`,`tbl_menus_text`.`lag_id` AS `lag_id` from (`tbl_menus` join `tbl_menus_text` on((`tbl_menus`.`mnu_id` = `tbl_menus_text`.`mnu_id`)))) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `view_menuitem`
--
DROP TABLE IF EXISTS `view_menuitem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menuitem`  AS  (select `tbl_mnuitem`.`mnuitem_id` AS `mnuitem_id`,`tbl_mnuitem`.`par_id` AS `par_id`,`tbl_mnuitem`.`code` AS `code`,`tbl_mnuitem`.`mnu_id` AS `mnu_id`,`tbl_mnuitem`.`viewtype` AS `viewtype`,`tbl_mnuitem`.`cat_id` AS `cat_id`,`tbl_mnuitem`.`cata_id` AS `cata_id`,`tbl_mnuitem`.`con_id` AS `con_id`,`tbl_mnuitem`.`link` AS `link`,`tbl_mnuitem`.`class` AS `class`,`tbl_mnuitem`.`order` AS `order`,`tbl_mnuitem`.`isactive` AS `isactive`,`tbl_mnuitem_text`.`name` AS `name`,`tbl_mnuitem_text`.`intro` AS `intro`,`tbl_mnuitem_text`.`lag_id` AS `lag_id` from (`tbl_mnuitem` join `tbl_mnuitem_text` on((`tbl_mnuitem`.`mnuitem_id` = `tbl_mnuitem_text`.`mnuitem_id`)))) ;

-- --------------------------------------------------------

--
-- Cấu trúc cho view `view_module`
--
DROP TABLE IF EXISTS `view_module`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_module`  AS  (select `tbl_modules`.`mod_id` AS `mod_id`,`tbl_modules`.`type` AS `type`,`tbl_modules`.`viewtitle` AS `viewtitle`,`tbl_modules`.`mnu_id` AS `mnu_id`,`tbl_modules`.`cat_id` AS `cat_id`,`tbl_modules`.`theme` AS `theme`,`tbl_modules`.`position` AS `position`,`tbl_modules`.`mnuids` AS `mnuids`,`tbl_modules`.`class` AS `class`,`tbl_modules`.`order` AS `order`,`tbl_modules`.`isactive` AS `isactive`,`tbl_modules_text`.`title` AS `title`,`tbl_modules_text`.`content` AS `content`,`tbl_modules_text`.`lag_id` AS `lag_id` from (`tbl_modules_text` join `tbl_modules` on((`tbl_modules_text`.`mod_id` = `tbl_modules`.`mod_id`)))) ;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_album`
--
ALTER TABLE `tbl_album`
  ADD PRIMARY KEY (`album_id`);

--
-- Chỉ mục cho bảng `tbl_catalog`
--
ALTER TABLE `tbl_catalog`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `tbl_category_text`
--
ALTER TABLE `tbl_category_text`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tbl_category_text` (`cat_id`);

--
-- Chỉ mục cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comm_id`);

--
-- Chỉ mục cho bảng `tbl_comment_text`
--
ALTER TABLE `tbl_comment_text`
  ADD PRIMARY KEY (`comm_text_id`);

--
-- Chỉ mục cho bảng `tbl_component`
--
ALTER TABLE `tbl_component`
  ADD PRIMARY KEY (`com_id`);

--
-- Chỉ mục cho bảng `tbl_configcontent`
--
ALTER TABLE `tbl_configcontent`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_configsite`
--
ALTER TABLE `tbl_configsite`
  ADD PRIMARY KEY (`config_id`);

--
-- Chỉ mục cho bảng `tbl_content`
--
ALTER TABLE `tbl_content`
  ADD PRIMARY KEY (`con_id`);

--
-- Chỉ mục cho bảng `tbl_content_text`
--
ALTER TABLE `tbl_content_text`
  ADD PRIMARY KEY (`con_text_id`);

--
-- Chỉ mục cho bảng `tbl_document`
--
ALTER TABLE `tbl_document`
  ADD PRIMARY KEY (`doc_id`);

--
-- Chỉ mục cho bảng `tbl_gmember`
--
ALTER TABLE `tbl_gmember`
  ADD PRIMARY KEY (`gmem_id`);

--
-- Chỉ mục cho bảng `tbl_indexlink`
--
ALTER TABLE `tbl_indexlink`
  ADD PRIMARY KEY (`index_id`);

--
-- Chỉ mục cho bảng `tbl_language`
--
ALTER TABLE `tbl_language`
  ADD PRIMARY KEY (`lag_id`);

--
-- Chỉ mục cho bảng `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`loc_id`);

--
-- Chỉ mục cho bảng `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`mem_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `tbl_menus`
--
ALTER TABLE `tbl_menus`
  ADD PRIMARY KEY (`mnu_id`);

--
-- Chỉ mục cho bảng `tbl_menus_text`
--
ALTER TABLE `tbl_menus_text`
  ADD PRIMARY KEY (`mnu_id_text`);

--
-- Chỉ mục cho bảng `tbl_mnuitem`
--
ALTER TABLE `tbl_mnuitem`
  ADD PRIMARY KEY (`mnuitem_id`);

--
-- Chỉ mục cho bảng `tbl_mnuitem_text`
--
ALTER TABLE `tbl_mnuitem_text`
  ADD PRIMARY KEY (`mnuitem_id_text`);

--
-- Chỉ mục cho bảng `tbl_modtype`
--
ALTER TABLE `tbl_modtype`
  ADD PRIMARY KEY (`modtypeid`);

--
-- Chỉ mục cho bảng `tbl_modules`
--
ALTER TABLE `tbl_modules`
  ADD PRIMARY KEY (`mod_id`);

--
-- Chỉ mục cho bảng `tbl_modules_text`
--
ALTER TABLE `tbl_modules_text`
  ADD PRIMARY KEY (`mod_text_id`),
  ADD KEY `FK_tbl_modules_text` (`mod_id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_partners`
--
ALTER TABLE `tbl_partners`
  ADD PRIMARY KEY (`partner_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pro_id`);

--
-- Chỉ mục cho bảng `tbl_singers`
--
ALTER TABLE `tbl_singers`
  ADD PRIMARY KEY (`sing_id`);

--
-- Chỉ mục cho bảng `tbl_template`
--
ALTER TABLE `tbl_template`
  ADD PRIMARY KEY (`tem_id`);

--
-- Chỉ mục cho bảng `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`pic_id`);

--
-- Chỉ mục cho bảng `tbl_visit`
--
ALTER TABLE `tbl_visit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_album`
--
ALTER TABLE `tbl_album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_catalog`
--
ALTER TABLE `tbl_catalog`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT cho bảng `tbl_category_text`
--
ALTER TABLE `tbl_category_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_comment_text`
--
ALTER TABLE `tbl_comment_text`
  MODIFY `comm_text_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_component`
--
ALTER TABLE `tbl_component`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_configcontent`
--
ALTER TABLE `tbl_configcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_configsite`
--
ALTER TABLE `tbl_configsite`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_content`
--
ALTER TABLE `tbl_content`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT cho bảng `tbl_content_text`
--
ALTER TABLE `tbl_content_text`
  MODIFY `con_text_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT cho bảng `tbl_document`
--
ALTER TABLE `tbl_document`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_gmember`
--
ALTER TABLE `tbl_gmember`
  MODIFY `gmem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tbl_indexlink`
--
ALTER TABLE `tbl_indexlink`
  MODIFY `index_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_language`
--
ALTER TABLE `tbl_language`
  MODIFY `lag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_menus`
--
ALTER TABLE `tbl_menus`
  MODIFY `mnu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_menus_text`
--
ALTER TABLE `tbl_menus_text`
  MODIFY `mnu_id_text` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbl_mnuitem`
--
ALTER TABLE `tbl_mnuitem`
  MODIFY `mnuitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT cho bảng `tbl_mnuitem_text`
--
ALTER TABLE `tbl_mnuitem_text`
  MODIFY `mnuitem_id_text` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT cho bảng `tbl_modtype`
--
ALTER TABLE `tbl_modtype`
  MODIFY `modtypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tbl_modules`
--
ALTER TABLE `tbl_modules`
  MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `tbl_modules_text`
--
ALTER TABLE `tbl_modules_text`
  MODIFY `mod_text_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT cho bảng `tbl_partners`
--
ALTER TABLE `tbl_partners`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `tbl_singers`
--
ALTER TABLE `tbl_singers`
  MODIFY `sing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_template`
--
ALTER TABLE `tbl_template`
  MODIFY `tem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `pic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_visit`
--
ALTER TABLE `tbl_visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
