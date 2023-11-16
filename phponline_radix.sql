-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 12:27 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phponline_radix`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `category_id` int(11) DEFAULT 0,
  `duplicate` int(11) DEFAULT 0,
  `content` text DEFAULT NULL,
  `view_count` int(11) DEFAULT 0,
  `thumbnail` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `slug`, `user_id`, `category_id`, `duplicate`, `content`, `view_count`, `thumbnail`, `description`, `create_at`, `update_at`) VALUES
(2, 'Cấp biển số xe máy tại TP.HCM như thế nào?', 'bai-viet-1', 1, 2, 4, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 40, '/php_unitop/module_6/radix/uploads/files/blog2.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-04-04 22:02:13', '2023-04-23 10:55:25'),
(4, 'Cấp biển số xe máy tại TP.HCM như thế nào?(1)', 'bai-viet-1', 5, 2, 1, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 16, '/php_unitop/module_6/radix/uploads/files/blog6.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-04-03 21:28:32', '2023-04-23 10:56:02'),
(5, 'Cấp biển số xe máy tại TP.HCM như thế nào?(2)', 'bai-viet-1', 5, 2, 2, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 12, '/php_unitop/module_6/radix/uploads/files/blog1.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-04-03 21:28:38', '2023-04-23 10:55:46'),
(6, 'eque porro quisquam est qui dolorem ipsum quia dolor sit amet', 'eque-porro-quisquam-est-qui-dolorem-ipsum-quia-dolor-sit-amet', 5, 13, 5, '&#60;p&#62;&#38;nbsp;is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout&#60;/p&#62;&#13;&#10;', 56, '/php_unitop/module_6/radix/uploads/files/blog3.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting', '2023-04-23 11:07:25', '2023-04-23 12:41:46'),
(7, 'eque porro quisquam est qui dolorem ipsum quia dolor sit amet(3)', 'eque-porro-quisquam-est-qui-dolorem-ipsum-quia-dolor-sit-amet', 5, 13, 3, '&#60;p&#62;&#38;nbsp;is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout&#60;/p&#62;&#13;&#10;', 14, '/php_unitop/module_6/radix/uploads/files/blog3.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting', '2023-05-02 21:06:00', NULL),
(8, 'Cấp biển số xe máy tại TP.HCM như thế nào?(4)', 'bai-viet-1', 5, 2, 6, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 12, '/php_unitop/module_6/radix/uploads/files/blog2.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-05-02 21:06:02', NULL),
(9, 'Cấp biển số xe máy tại TP.HCM như thế nào?(2)(2)', 'bai-viet-1', 5, 2, 2, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 12, '/php_unitop/module_6/radix/uploads/files/blog1.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-05-02 21:06:04', NULL),
(10, 'Cấp biển số xe máy tại TP.HCM như thế nào?(1)(1)', 'bai-viet-1', 5, 2, 1, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 8, '/php_unitop/module_6/radix/uploads/files/blog6.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-05-02 21:06:06', NULL),
(11, 'Cấp biển số xe máy tại TP.HCM như thế nào?(2)(2)(2)', 'bai-viet-1', 5, 2, 3, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 10, '/php_unitop/module_6/radix/uploads/files/blog1.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-05-02 21:06:08', NULL),
(12, 'Cấp biển số xe máy tại TP.HCM như thế nào?(2)(2)(2)(2)', 'bai-viet-1', 5, 2, 1, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 8, '/php_unitop/module_6/radix/uploads/files/blog1.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-05-02 21:06:09', NULL),
(13, 'Cấp biển số xe máy tại TP.HCM như thế nào?(1)(1)(1)', 'bai-viet-1', 5, 2, 0, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 10, '/php_unitop/module_6/radix/uploads/files/blog6.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-05-02 21:06:12', NULL),
(14, 'Cấp biển số xe máy tại TP.HCM như thế nào?(4)(4)', 'bai-viet-1', 5, 2, 3, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 8, '/php_unitop/module_6/radix/uploads/files/blog2.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-05-02 21:06:13', NULL),
(15, 'Cấp biển số xe máy tại TP.HCM như thế nào?(2)(2)(2)(3)', 'bai-viet-1', 5, 2, 2, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 8, '/php_unitop/module_6/radix/uploads/files/blog1.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-05-02 21:06:15', NULL),
(16, 'eque porro quisquam est qui dolorem ipsum quia dolor sit amet(4)', 'eque-porro-quisquam-est-qui-dolorem-ipsum-quia-dolor-sit-amet', 5, 13, 3, '&#60;p&#62;&#38;nbsp;is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout&#60;/p&#62;&#13;&#10;', 10, '/php_unitop/module_6/radix/uploads/files/blog3.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting', '2023-05-02 21:06:16', NULL),
(17, 'Cấp biển số xe máy tại TP.HCM như thế nào?(4)(5)', 'bai-viet-1', 5, 2, 4, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 98, '/php_unitop/module_6/radix/uploads/files/blog2.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-05-02 21:06:18', NULL),
(18, 'eque porro quisquam est qui dolorem ipsum quia dolor sit amet(3)(3)', 'eque-porro-quisquam-est-qui-dolorem-ipsum-quia-dolor-sit-amet', 5, 13, 2, '&#60;p&#62;&#38;nbsp;is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout&#60;/p&#62;&#13;&#10;', 14, '/php_unitop/module_6/radix/uploads/files/blog3.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting', '2023-05-02 21:06:21', NULL),
(19, 'eque porro quisquam est qui dolorem ipsum quia dolor sit amet(5)', 'eque-porro-quisquam-est-qui-dolorem-ipsum-quia-dolor-sit-amet', 5, 13, 4, '&#60;p&#62;&#38;nbsp;is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout&#60;/p&#62;&#13;&#10;', 132, '/php_unitop/module_6/radix/uploads/files/blog3.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting', '2023-05-02 21:06:23', NULL),
(20, 'Cấp biển số xe máy tại TP.HCM như thế nào?(4)(6)', 'bai-viet-1', 5, 2, 5, '&#60;p&#62;Hiện nay, người d&#38;acirc;n tại 5 huyện của TP.HCM: Cần Giờ, Nh&#38;agrave; B&#38;egrave;, Củ Chi, H&#38;oacute;c M&#38;ocirc;n, B&#38;igrave;nh Ch&#38;aacute;nh c&#38;oacute; thể đến c&#38;ocirc;ng an c&#38;aacute;c x&#38;atilde; để đăng k&#38;yacute;, cấp biển số xe m&#38;aacute;y, kể cả xe m&#38;aacute;y điện (ở c&#38;aacute;c quận nội th&#38;agrave;nh TP.HCM th&#38;igrave; đến trụ sở Đội CSGT C&#38;ocirc;ng an quận đăng k&#38;yacute; cấp biển số xe m&#38;aacute;y).&#60;/p&#62;&#13;&#10;', 1218, '/php_unitop/module_6/radix/uploads/files/blog2.jpg', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', '2023-05-02 21:06:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(2, 'nhân sự', 'nhan-su', 1, 3, '2023-04-02 20:45:00', '2023-07-03 14:51:48'),
(13, 'nhân sự mới', 'nhan-su-moi', 1, 0, '2023-04-02 21:08:49', '2023-07-03 14:49:11'),
(14, 'sự kiện blog', 'su-kien-blog', 1, 0, '2023-04-02 21:10:32', '2023-04-02 21:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `blog_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 0 COMMENT 'trạng thái bình luận :\r\n0: chưa duyẹt\r\n1: đã duyệt',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `website`, `content`, `parent_id`, `blog_id`, `user_id`, `status`, `create_at`, `update_at`) VALUES
(2, 'To Duy Duc', 'dduy8195@gmail.com', 'https://www.youtube.com/', 'fdfsfsfdsfdsfdsfs', 0, 20, NULL, 1, '2023-05-14 16:33:56', NULL),
(3, 'Nguyễn Đức Anh hào', 'anhhao@gmai.com', 'https://www.youtube.com/', 'hãy liên hệ cho tôi qua số điện thoại 043424343433', 0, 20, NULL, 1, '2023-05-14 16:35:40', NULL),
(4, 'Nguyễn Tiến Hữu', 'toduyduc9999@gmail.com', 'https://www.youtube.com/', 'bình luận của hữu', 0, 20, NULL, 1, '2023-05-14 17:32:12', NULL),
(5, 'nguyễn duy anh', 'duyanh@gmail.com', 'https://www.youtube.com/', 'bình luận luôn đa chiều', 4, 20, NULL, 1, '2023-05-16 10:26:05', NULL),
(6, 'anh hào', 'haoanh@gmail.com', 'https://www.youtube.com/', 'bình luận tốt', 4, 20, NULL, 0, '2023-05-16 10:40:52', NULL),
(11, 'Le Trung hieu', 'letrunghieu@gmail.com', 'https://www.youtube.com/', 'bình luận đúng ý của tôi', 0, 20, NULL, 0, '2023-05-16 21:02:44', NULL),
(12, 'Le Trung hieu', 'letrunghieu@gmail.com', 'https://www.youtube.com/', 'fdfsfsdfdsfdsfdsfdf', 5, 20, NULL, 0, '2023-05-16 21:18:40', NULL),
(13, 'Le Trung hieu', 'letrunghieu@gmail.com', 'https://www.youtube.com/', 'fdfdsfsfsf', 5, 20, NULL, 0, '2023-05-16 21:20:33', NULL),
(14, 'To Duy Duc', 'toduyduc0@gmail.com', 'https://www.youtube.com/', 'như này vẫn chưa được', 0, 20, NULL, 0, '2023-05-16 21:24:04', NULL),
(15, NULL, NULL, NULL, 'binh luan cua ban rat la hay', 0, 20, 1, 0, '2023-05-19 20:58:03', NULL),
(16, NULL, NULL, NULL, 'bài viết không hay', 11, 20, 1, 1, '2023-05-19 21:48:48', '2023-06-25 16:42:33'),
(18, 'Tô Anh Đức', 'toanhduc0@gmail.com', 'https://www.youtube.com.vn', 'bình luận linh tinh', 0, 20, NULL, 0, '2023-05-19 22:18:19', '2023-06-25 16:39:09'),
(19, NULL, NULL, NULL, 'ăn nói lảm nhảm', 2, 20, 1, 1, '2023-06-26 14:30:13', NULL),
(20, NULL, NULL, NULL, 'Thật là nhảm nhí&#13;&#10;', 19, 20, 1, 1, '2023-07-03 14:36:01', NULL),
(21, NULL, NULL, NULL, 'Bình luận đầu tiên', 0, 19, 1, 0, '2023-07-04 16:19:35', NULL),
(22, NULL, NULL, NULL, 'của mình', 0, 19, 1, 0, '2023-07-04 16:19:56', NULL),
(23, NULL, NULL, NULL, 'của mình', 0, 19, 1, 1, '2023-07-04 16:21:04', '2023-07-04 16:30:06'),
(24, NULL, NULL, NULL, 'Bình luận rất hay', 0, 19, 1, 1, '2023-07-04 16:22:59', '2023-07-04 16:30:05'),
(25, NULL, NULL, NULL, 'xin chào bạn', 0, 19, 1, 1, '2023-07-04 16:26:18', '2023-07-04 16:30:03'),
(26, NULL, NULL, NULL, 'duyệt được chưa', 0, 19, 1, 0, '2023-07-04 16:29:45', '2023-07-10 21:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `type_id` int(11) DEFAULT 0,
  `message` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT 'Trạng thái xử lý:\r\n0: chưa xử lý\r\n1: đang xử lý\r\n2: đang xử lý',
  `note` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `fullname`, `email`, `type_id`, `message`, `status`, `note`, `create_at`, `update_at`) VALUES
(2, 'nguyen tien huu', 'toduyduc0@gmail.com', 2, 'chào các bạn đã đến với lập trình dự án radix', 0, 'fdsfsfsffs', '2023-03-22 20:28:53', NULL),
(9, 'tô duy đức', 'toduyduc0@gmail.com', 2, 'hãy quên tên anh', 0, NULL, '2023-06-25 00:00:00', NULL),
(10, 'Nguyễn Đức Anh Hào', 'anhhao@gmai.com', 3, 'hãy liên hệ sớm cho tôi', 0, NULL, '2023-06-25 22:20:52', NULL),
(12, 'tô duy đức', 'toduyduc0@gmail.com', 2, 'fdsfsdfsdfsd', 0, NULL, '2023-06-26 14:58:38', NULL),
(13, 'tô duy đức', 'toduyduc0@gmail.com', 2, 'fdsfsdfsdfsd', 0, NULL, '2023-06-26 14:58:54', NULL),
(14, 'tô duy đức', 'toduyduc0@gmail.com', 2, 'fdsfsdfsdfsd', 0, NULL, '2023-06-26 14:59:39', NULL),
(15, 'tô duy đức', 'toduyduc0@gmail.com', 2, 'fdsfsdfsdfsd', 0, NULL, '2023-06-26 14:59:49', NULL),
(16, 'tô duy đức', 'toduyduc0@gmail.com', 2, 'đeadsađá', 0, NULL, '2023-06-26 15:00:23', NULL),
(17, 'tô duy đức', 'toduyduc0@gmail.com', 2, 'đeadsađá', 0, NULL, '2023-06-26 15:01:33', '2023-07-10 20:15:21'),
(18, 'tô duy đức', 'toduyduc0@gmail.com', 2, 'đeadsađá', 0, NULL, '2023-06-26 15:07:24', NULL),
(19, 'Nguyễn Văn Quân', 'vanquannguyen@gmail.com', 3, 'vui lòng liên hệ lại cho tôi qua số điện thoại 039987389949', 0, NULL, '2023-06-26 15:09:22', NULL),
(20, 'nguyễn gia phong', 'giaphong@gmail.com', 2, 'gửi tin nhắn cho tôi', 1, '', '2023-07-04 16:09:43', '2023-07-10 20:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `contact_type`
--

CREATE TABLE `contact_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_type`
--

INSERT INTO `contact_type` (`id`, `name`, `duplicate`, `create_at`, `update_at`) VALUES
(2, 'khách hàng', 3, '2023-04-17 21:59:48', '2023-04-12 22:23:03'),
(3, 'nhân sự', 1, '2023-04-12 22:12:03', NULL),
(7, 'nhân sự(1)', 0, '2023-04-12 22:47:21', '2023-07-10 21:53:57');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `permission` text DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permission`, `create_at`, `update_at`) VALUES
(1, 'subper admin', NULL, '2023-03-01 20:29:24', '2023-01-16 20:29:32'),
(2, 'Admin', '{\"pages\":[\"lists\",\"edit\"],\"services\":[\"lists\"],\"portfolios\":[\"lists\"],\"portfolio_categories\":[\"lists\",\"edit\"],\"blog\":[\"lists\"],\"blog_categories\":[\"lists\"],\"users\":[\"lists\"],\"contacts\":[\"lists\"],\"contact_type\":[\"lists\",\"edit\",\"delete\",\"duplicate\"],\"comments\":[\"lists\"],\"subscribe\":[\"lists\"],\"options\":[\"general\",\"header\",\"footer\",\"home\",\"about\",\"team\",\"service\",\"portfolio\",\"blog\",\"contact\",\"menu\"]}', '2023-03-22 20:28:53', '2023-07-10 22:21:13'),
(3, 'Manager', NULL, '2023-03-22 20:28:53', '2023-07-08 13:35:57'),
(5, 'Development', NULL, '2023-03-22 20:28:53', '2023-07-08 13:37:28'),
(6, 'Maketing', NULL, '2023-03-22 20:28:53', '2023-07-08 13:37:35'),
(7, 'contruct', NULL, '2023-03-01 20:29:24', '2023-01-16 20:29:32'),
(8, 'bike', NULL, '2023-03-22 20:28:53', '2023-03-29 20:28:53'),
(9, 'employ', NULL, '2023-03-22 20:28:53', '2023-03-29 20:28:53'),
(15, 'Sales', '{\"pages\":[\"lists\"],\"services\":[\"lists\"]}', '2023-03-22 21:44:43', '2023-07-08 20:43:31'),
(16, 'Design', NULL, '2023-07-08 15:47:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_token`
--

CREATE TABLE `login_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `token` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_token`
--

INSERT INTO `login_token` (`id`, `user_id`, `token`, `create_at`) VALUES
(122, 1, 'eca9776d08492e44bd01b56785971135fff7efe1', '2023-11-16 18:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `actions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `title`, `actions`) VALUES
(0, 'groups', 'Quản lý nhóm người dùng', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"permission\":\"Phân quyền\"}'),
(1, 'pages', 'Quản lý trang', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(2, 'services', 'Quản lý dịch vụ', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(3, 'portfolios', 'Quản lý dự án', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(4, 'portfolio_categories', 'Quản lý danh mục dự án', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(5, 'blog', 'Quản lý blog', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(6, 'blog_categories', 'Quản lý danh muc blog', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(8, 'users', 'Quản lý người dùng', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\"}'),
(9, 'contacts', 'Quản lý liên hệ', '{\"lists\":\"Xem\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"status\":\"Xử lý duyệt\"}'),
(10, 'contact_type', 'Quản lý phòng ban', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"duplicate\":\"Nhân bản\"}'),
(11, 'comments', 'Quản lý bình luận', '{\"lists\":\"Xem\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"status\":\"Duyệt\"}'),
(12, 'subscribe', 'Quản lý đăng ký nhận tin', '{\"lists\":\"Xem\",\"add\":\"Thêm\",\"edit\":\"Sửa\",\"delete\":\"Xóa\",\"status\":\"Trạng thái\"}'),
(13, 'options', 'Thiết lập website', '{\"general\":\"Chung\",\"header\":\"Header\",\"footer\":\"Footer\",\"home\":\"Home\",\"about\":\"Giới thiệu\",\"team\":\"Đội ngũ\",\"service\":\"Dịch vụ\",\"portfolio\":\"Danh mục\",\"blog\":\"Blog\",\"contact\":\"Liên hệ\",\"menu\":\"Menu\"}');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `opt_key` varchar(100) DEFAULT NULL,
  `opt_value` text DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `opt_key`, `opt_value`, `name`) VALUES
(1, 'general_twitter', 'https://twitter.com/ToDuyDuc2001?ref_src=twsrc%5Etfw', 'Twitter'),
(2, 'general_facebook', 'https://facebook.com', 'Facebook'),
(3, 'general_linkedin', 'https://linkedin.com', 'Linkedin'),
(4, 'general_behance', 'https://behance.com', 'Behance'),
(5, 'header_search', 'Từ khóa tìm kiếm', 'Tìm kiếm'),
(6, 'general_time', '7AM-11PM', 'Thời gian làm việc'),
(7, 'general_email', 'toduyduc0@gmail.com', 'Email'),
(8, 'general_hotline', '0966149525', 'Số điện thoại'),
(9, 'general_youtube', 'https://youtube.com', 'Youtube'),
(10, 'header_quote_text', 'Báo giá', 'Nút báo giá'),
(11, 'header_quote_link', '#', 'Link báo giá'),
(12, 'header_logo', '/php_unitop/module_6/radix/uploads/images/logo.png', 'Logo'),
(13, 'header_favicon', '/php_unitop/module_6/radix/uploads/images/logo.png', 'Favicon'),
(14, 'general_sitedesc', 'abcd', 'Mô tả website'),
(15, 'general_sitename', 'Radi', 'Tên website'),
(16, 'home_slide', '[{\"slide_title\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"slide_button_text\":\"Our Portfolio\",\"slide_button_link\":\"#\",\"slide_video\":\"https:\\/\\/www.youtube.com\\/watch?v=FZQPhrdKjow\",\"slide_image_1\":\"\\/php_unitop\\/module_6\\/radix\\/uploads\\/files\\/gallery-image1.jpg\",\"slide_image_2\":\"\\/php_unitop\\/module_6\\/radix\\/uploads\\/files\\/gallery-image2(1).jpg\",\"slide_bg\":\"\\/php_unitop\\/module_6\\/radix\\/uploads\\/files\\/slider-image1(1).jpg\",\"slide_desc\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi laoreet urna ante, quis luctus nisi sodales sit amet. Aliquam a enim in massa molestie mollis Proin quis velit at nisl vulputate egestas non in arcu Proin a magna hendrerit, tincidunt neque sed.\",\"slide_position\":\"left\"},{\"slide_title\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"slide_button_text\":\"Our Portfolio\",\"slide_button_link\":\"#\",\"slide_video\":\"https:\\/\\/www.youtube.com\\/watch?v=FZQPhrdKjow\",\"slide_image_1\":\"\\/php_unitop\\/module_6\\/radix\\/uploads\\/files\\/gallery-image1.jpg\",\"slide_image_2\":\"\\/php_unitop\\/module_6\\/radix\\/uploads\\/files\\/gallery-image2(1).jpg\",\"slide_bg\":\"\\/php_unitop\\/module_6\\/radix\\/uploads\\/files\\/slider-image1(1).jpg\",\"slide_desc\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi laoreet urna ante, quis luctus nisi sodales sit amet. Aliquam a enim in massa molestie mollis Proin quis velit at nisl vulputate egestas non in arcu Proin a magna hendrerit, tincidunt neque sed.\",\"slide_position\":\"right\"},{\"slide_title\":\"Radix &#60;span&#62;Business&#60;\\/span&#62; World That Possible anything&#60;span&#62;!&#60;\\/span&#62;\",\"slide_button_text\":\"Our Portfolio\",\"slide_button_link\":\"#\",\"slide_video\":\"https:\\/\\/www.youtube.com\\/watch?v=FZQPhrdKjow\",\"slide_image_1\":\"\",\"slide_image_2\":\"\",\"slide_bg\":\"\\/php_unitop\\/module_6\\/radix\\/uploads\\/files\\/slider-image1(1).jpg\",\"slide_desc\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi laoreet urna ante, quis luctus nisi sodales sit amet. Aliquam a enim in massa molestie mollis Proin quis velit at nisl vulputate egestas non in arcu Proin a magna hendrerit, tincidunt neque sed.\",\"slide_position\":\"center\"}]', 'Slide'),
(17, 'home_about', '{\"information\":\"{\\\"title_bg\\\":\\\"RADIX\\\",\\\"desc\\\":\\\"&#60;h1&#62;About Company&#60;\\\\\\/h1&#62;&#13;&#10;&#13;&#10;&#60;p&#62;contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old&#60;\\\\\\/p&#62;&#13;&#10;\\\",\\\"image\\\":\\\"\\\\\\/php_unitop\\\\\\/module_6\\\\\\/radix\\\\\\/uploads\\\\\\/files\\\\\\/gallery-4.jpg\\\",\\\"video\\\":\\\"https:\\\\\\/\\\\\\/www.youtube.com\\\\\\/watch?v=dq1a1mMRk_k\\\",\\\"content\\\":\\\"&#60;h2&#62;We Are Professional Website Design &#38;amp; Development Company!&#60;\\\\\\/h2&#62;&#13;&#10;&#13;&#10;&#60;p&#62;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. You think water moves fast? You should see ice.&#60;\\\\\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a weeked do incididunt magna Lorem&#60;\\\\\\/p&#62;&#13;&#10;&#13;&#10;&#60;p&#62;You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalancip isicing elit, sed do eiusmod tempor incididunt&#60;\\\\\\/p&#62;&#13;&#10;\\\",\\\"skill\\\":{\\\"name\\\":[\\\"n\\\\u0103ng l\\\\u1ef1c 1\\\",\\\"n\\\\u0103ng l\\\\u1ef1c 2\\\",\\\"n\\\\u0103ng l\\\\u1ef1c 3\\\",\\\"n\\\\u0103ng l\\\\u1ef1c 4\\\"],\\\"value\\\":[\\\"94\\\",\\\"81\\\",\\\"42\\\",\\\"64\\\"]}}\",\"skill\":\"[{\\\"name\\\":\\\"n\\\\u0103ng l\\\\u1ef1c 1\\\",\\\"value\\\":\\\"94\\\"},{\\\"name\\\":\\\"n\\\\u0103ng l\\\\u1ef1c 2\\\",\\\"value\\\":\\\"81\\\"},{\\\"name\\\":\\\"n\\\\u0103ng l\\\\u1ef1c 3\\\",\\\"value\\\":\\\"42\\\"},{\\\"name\\\":\\\"n\\\\u0103ng l\\\\u1ef1c 4\\\",\\\"value\\\":\\\"64\\\"}]\"}', 'Thiết lập giới thiệu'),
(18, 'home_service_title_bg', 'Services', 'Tiêu đề nền'),
(19, 'home_service_title', 'What we provide', 'Tiêu đề'),
(20, 'home_service_desc', '&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(34, 'home_fact', '{\"left\":\"{\\\"title\\\":\\\"With Smooth Animation Numbering\\\",\\\"sub_title\\\":\\\"Our Achievements\\\",\\\"desc\\\":\\\"&#60;p&#62;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.&#60;\\\\\\/p&#62;&#13;&#10;\\\",\\\"btn_text\\\":\\\"CONTACT\\\",\\\"btn_link\\\":\\\"http:\\\\\\/\\\\\\/localhost\\\\\\/php_unitop\\\\\\/module_6\\\\\\/radix\\\\\\/lien-he.html\\\"}\",\"right\":\"[{\\\"icon\\\":\\\"&#60;i class=&#34;fa fa-clock-o&#34;&#62;&#60;\\\\\\/i&#62;\\\",\\\"number\\\":\\\"25\\\",\\\"unit\\\":\\\"\\\",\\\"award\\\":\\\"years of success\\\"},{\\\"icon\\\":\\\"&#60;i class=&#34;fa fa-bullseye&#34;&#62;&#60;\\\\\\/i&#62;\\\",\\\"number\\\":\\\"45\\\",\\\"unit\\\":\\\"K\\\",\\\"award\\\":\\\"Project Complete\\\"},{\\\"icon\\\":\\\"&#60;i class=&#34;fa fa-dollar&#34;&#62;&#60;\\\\\\/i&#62;\\\",\\\"number\\\":\\\"66\\\",\\\"unit\\\":\\\"M\\\",\\\"award\\\":\\\"Total Earnings\\\"},{\\\"icon\\\":\\\"&#60;i class=&#34;fa fa-trophy&#34;&#62;&#60;\\\\\\/i&#62;\\\",\\\"number\\\":\\\"44\\\",\\\"unit\\\":\\\"\\\",\\\"award\\\":\\\"Winning Awards\\\"},{\\\"icon\\\":\\\"&#60;i class=&#34;fa fa-trophy&#34;&#62;&#60;\\\\\\/i&#62;\\\",\\\"number\\\":\\\"66\\\",\\\"unit\\\":\\\"M\\\",\\\"award\\\":\\\"Total Earnings\\\"}]\"}', 'Thành tích'),
(35, 'home_Portfolio_title', 'Our Portfolio', 'Tiêu đề'),
(36, 'home_Portfolio_desc', '&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(37, 'home_Portfolio_title_bg', 'Projects', 'Tiêu đề nền'),
(38, 'home_Portfolio_more_link', 'http://localhost/php_unitop/module_6/radix/du-an.html', 'Link xem thêm dự án'),
(39, 'home_Portfolio_more_text', 'MORE PORTFOLIO', 'Nút xem dự án'),
(40, 'home_cta_content', '&#60;p&#62;Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim feugiat, facilisis arcu vehicula, consequat sem. Cras et vulputate nisi, ac dignissim mi. Etiam laoreet&#60;/p&#62;&#13;&#10;', 'Nội dung'),
(41, 'home_cta_btn_text', 'ĐẶT HÀNG NGAY', 'Nút kêu gọi'),
(42, 'home_cta_btn_link', 'http://localhost/php_unitop/module_6/radix/lien-he.html', 'Link kêu gọi'),
(43, 'home_cta_title', 'We Have 35+ Years Of Experiences For Creating Creative Website Project.', 'Tiêu đề hành động'),
(44, 'home_blog_title', 'Latest Blogs', 'Tiêu đề'),
(45, 'home_blog_desc', '&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(46, 'home_blog_title_bg', 'News', 'Tiêu đề nền'),
(47, 'home_partner_title', 'Our Partners', 'Tiêu đề'),
(48, 'home_partner_desc', '&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(49, 'home_partner_title_bg', 'Clients', 'Tiêu đề nền'),
(50, 'home_partner_content', '[{\"logo\":\"\\/php_unitop\\/module_6\\/radix\\/uploads\\/files\\/partner-1.png\",\"link\":\"#\"},{\"logo\":\"\\/php_unitop\\/module_6\\/radix\\/uploads\\/files\\/partner-2.png\",\"link\":\"#\"}]', 'Danh sách đối tác'),
(51, 'general_address', 'House 20, Sector-7, Road-5, California, US', 'Địa chỉ'),
(52, 'footer_1_title', 'Office Location', 'Tiêu đề'),
(53, 'footer_1_content', '&#60;p&#62;Maecenas sapien erat, porta non porttitor non, dignissim et enim.&#60;/p&#62;&#13;&#10;', 'Nội dung'),
(54, 'footer_2_title', 'Quick Links', 'Tiêu đề'),
(55, 'footer_2_content', '&#60;ul&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;#&#34;&#62;About Our Company&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;#&#34;&#62;Our Latest services&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;#&#34;&#62;Our Recent Project&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;#&#34;&#62;Latest Blog&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;#&#34;&#62;Help Desk&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#9;&#60;li&#62;&#60;a href=&#34;#&#34;&#62;Contact With Us&#60;/a&#62;&#60;/li&#62;&#13;&#10;&#60;/ul&#62;&#13;&#10;', 'Nội dung'),
(56, 'footer_3_title', 'Recent Tweets', 'Tiêu đề'),
(57, 'footer_3_twitter', 'ToDuyDuc2001', 'Tài khoản twitter'),
(58, 'footer_4_title', 'Newsletter', 'Tiêu đề'),
(59, 'footer_4_content', '&#60;p&#62;consectetur adipiscing elit. Vestibulum vel sapien et lacus tempus varius. In finibus lorem vel.&#60;/p&#62;&#13;&#10;', 'Nội dung'),
(60, 'footer_copyright', '&#60;p&#62;&#38;copy; 2020 All Right Reserved. Design &#38;amp; Development By&#38;nbsp;&#60;a href=&#34;http://themelamp.com/&#34; target=&#34;_blank&#34;&#62;ThemeLamp.Com&#60;/a&#62;, Theme Provided By&#38;nbsp;&#60;a href=&#34;https://codeglim.com/&#34; target=&#34;_blank&#34;&#62;CodeGlim.Com&#60;/a&#62;&#60;/p&#62;&#13;&#10;', 'Copyright'),
(61, 'about_title', 'Giới thiệu', 'Tiêu đề trang'),
(62, 'team_title', 'Đội ngũ', 'Tiêu đề trang'),
(63, 'team_title_bg', 'Team', 'Tiêu đề nền'),
(64, 'team_desc', '&#60;p&#62;Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(65, 'team_primary_title', 'Our Leaders', 'Tiêu đề chính'),
(66, 'team_content', '[{\"name\":\"Collis Molate\",\"position\":\"Founder\",\"image\":\"\\/php_unitop\\/module_6\\/radix\\/uploads\\/files\\/t1.jpg\",\"facebook\":\"#\",\"twitter\":\"#\",\"behance\":\"#\",\"linkedin\":\"#\"},{\"name\":\"Domani Plavon\",\"position\":\"Co-Founder\",\"image\":\"\\/php_unitop\\/module_6\\/radix\\/uploads\\/files\\/t2.jpg\",\"facebook\":\"#\",\"twitter\":\"#\",\"behance\":\"#\",\"linkedin\":\"\"}]', 'Danh sách đội ngũ'),
(67, 'service_title', 'Dịch Vụ', 'Tên dịch vụ'),
(68, 'portfolio_title', 'Dự án', 'Tên danh mục đầu tư'),
(69, 'blog_title', 'Blog', 'Tên bài viết'),
(70, 'blog_per_page', '2', 'Số lượng bài viết trên mỗi trang'),
(71, 'contact_title', 'Liên hệ', 'Tiêu đề trang'),
(72, 'contact_title_bg', 'Radix', 'Tiêu đề nền'),
(73, 'contact_desc', '&#60;p&#62;contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old&#60;/p&#62;&#13;&#10;', 'Mô tả'),
(74, 'contact_primary_title', 'Contact Us', 'Tiêu đề chính'),
(75, 'menu', '[{&#34;text&#34;:&#34;Trang chủ&#34;,&#34;href&#34;:&#34;http://localhost/php_unitop/module_6/radix&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Giới thiệu&#34;,&#34;href&#34;:&#34;http://localhost/php_unitop/module_6/radix/gioi-thieu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;children&#34;:[{&#34;text&#34;:&#34;Giới thiệu chung&#34;,&#34;href&#34;:&#34;http://localhost/php_unitop/module_6/radix/gioi-thieu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Đội ngũ&#34;,&#34;href&#34;:&#34;http://localhost/php_unitop/module_6/radix/doi-ngu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;}]},{&#34;text&#34;:&#34;Dịch vụ&#34;,&#34;href&#34;:&#34;http://localhost/php_unitop/module_6/radix/dich-vu.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Dự án&#34;,&#34;href&#34;:&#34;http://localhost/php_unitop/module_6/radix/du-an.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Bài viết&#34;,&#34;href&#34;:&#34;http://localhost/php_unitop/module_6/radix/blog.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;,&#34;children&#34;:[{&#34;text&#34;:&#34;Nhân sự&#34;,&#34;href&#34;:&#34;http://localhost/php_unitop/module_6/radix/danh-muc-blog/nhan-su-2.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Nhân sự mới&#34;,&#34;href&#34;:&#34;http://localhost/php_unitop/module_6/radix/danh-muc-blog/nhan-su-moi-13.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;},{&#34;text&#34;:&#34;Sự kiện blog&#34;,&#34;href&#34;:&#34;http://localhost/php_unitop/module_6/radix/danh-muc-blog/su-kien-blog-14.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;}]},{&#34;text&#34;:&#34;Liên hệ&#34;,&#34;href&#34;:&#34;http://localhost/php_unitop/module_6/radix/lien-he.html&#34;,&#34;icon&#34;:&#34;empty&#34;,&#34;target&#34;:&#34;_self&#34;,&#34;title&#34;:&#34;&#34;}]', 'Thiết lập menu');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(3, 'hướng dẫn mua hàng(1)', 'huong-dan-mua-hang', 'Đang cập nhật', 1, 0, '2023-03-30 20:28:11', NULL),
(4, 'hướng dẫn mua hàng nguoi di mua', 'huong-dan-mua-hang-nguoi-di-mua', '&#60;p&#62;Đang cập nhật&#60;/p&#62;&#13;&#10;', 1, 1, '2023-03-30 20:28:16', '2023-04-02 21:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `thumbnail` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `portfolio_category_id` int(11) DEFAULT 0,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `name`, `slug`, `thumbnail`, `description`, `video`, `content`, `user_id`, `portfolio_category_id`, `duplicate`, `create_at`, `update_at`) VALUES
(16, 'Creative Work', 'creative-work', '/php_unitop/module_6/radix/uploads/files/p1.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=ZhDO16FDmxA', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 1, 10, 4, '2023-04-22 15:15:29', NULL),
(17, 'Responsive Design', 'responsive-design', '/php_unitop/module_6/radix/uploads/files/p1.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=ZhDO16FDmxA', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 1, 10, 0, '2023-04-22 15:17:30', '2023-04-22 15:20:53'),
(18, 'Bootstrap Based', 'bootstrap-based', '/php_unitop/module_6/radix/uploads/files/p1.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=ZhDO16FDmxA', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 1, 10, 1, '2023-04-22 15:22:28', '2023-05-02 17:22:24'),
(19, 'Clean Design', 'clean-design', '/php_unitop/module_6/radix/uploads/files/p4.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', NULL, '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 1, 10, 3, '2023-04-22 15:23:17', '2023-04-22 15:24:19'),
(20, 'Animation', 'animation', '/php_unitop/module_6/radix/uploads/files/p5.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=ZhDO16FDmxA', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 1, 10, 2, '2023-04-22 15:24:31', '2023-04-22 15:25:27'),
(21, 'Parallax', 'parallax', '/php_unitop/module_6/radix/uploads/files/p6.jpg', 'Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim', 'https://www.youtube.com/watch?v=ZhDO16FDmxA', '&#60;p&#62;&#60;strong&#62;Lorem Ipsum&#60;/strong&#62;&#38;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#38;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&#60;/p&#62;&#13;&#10;', 1, 10, 3, '2023-04-22 15:25:30', '2023-04-22 15:26:27');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_categories`
--

CREATE TABLE `portfolio_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `name`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(2, 'marketing', 5, 0, '2023-03-30 21:59:26', NULL),
(3, 'relax', 5, 0, '2023-03-31 00:00:00', NULL),
(4, 'đầu tư', 1, 2, '2023-04-01 20:05:29', NULL),
(9, 'Đào tạo lập trình', 1, 0, '2023-04-22 15:06:29', NULL),
(10, 'Thiết kế website', 1, 0, '2023-04-22 15:06:41', NULL),
(11, 'Tư vấn doanh nghiệp', 1, 0, '2023-04-22 15:07:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_images`
--

CREATE TABLE `portfolio_images` (
  `id` int(11) NOT NULL,
  `portfolio_id` int(11) DEFAULT 0,
  `image` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `portfolio_images`
--

INSERT INTO `portfolio_images` (`id`, `portfolio_id`, `image`, `create_at`, `update_at`) VALUES
(27, 16, '/php_unitop/module_6/radix/uploads/files/slider-image1.jpg', '2023-04-22 15:15:29', NULL),
(28, 16, '/php_unitop/module_6/radix/uploads/files/gallery-image1.jpg', '2023-04-22 15:15:29', NULL),
(32, 18, '/php_unitop/module_6/radix/uploads/files/clement-fusil-Fpqx6GGXfXs-unsplash.jpg', NULL, '2023-05-02 17:22:00'),
(33, 18, '/php_unitop/module_6/radix/uploads/files/johann-siemens-EPy0gBJzzZU-unsplash.jpg', NULL, '2023-05-02 17:22:00'),
(34, 18, '/php_unitop/module_6/radix/uploads/files/clement-fusil-Fpqx6GGXfXs-unsplash.jpg', NULL, '2023-05-02 17:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `duplicate` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `slug`, `icon`, `description`, `content`, `user_id`, `duplicate`, `create_at`, `update_at`) VALUES
(11, 'Creative Idea', 'creative-idea', '&#60;i class=&#34;fa fa-lightbulb-o&#34;&#62;&#60;/i&#62;', '&#60;p&#62;Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin&#60;/p&#62;&#13;&#10;', '&#60;p&#62;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#38;#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#38;#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.&#60;/p&#62;&#13;&#10;', 1, 1, '2023-04-21 15:21:08', NULL),
(12, 'Development', 'development', '&#60;i class=&#34;fa fa-wordpress&#34;&#62;&#60;/i&#62;', '&#60;p&#62;just fine erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin&#60;/p&#62;&#13;&#10;', '&#60;p&#62;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#38;#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#38;#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.&#60;/p&#62;&#13;&#10;', 1, 0, '2023-04-21 15:22:06', NULL),
(13, 'Marketing', 'marketing', '&#60;i class=&#34;fa fa-bullhorn &#34;&#62;&#60;/i&#62;', '&#60;p&#62;Possible of erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin&#60;/p&#62;&#13;&#10;', '&#60;p&#62;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#38;#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#38;#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.&#60;/p&#62;&#13;&#10;', 1, 0, '2023-04-21 15:23:25', NULL),
(14, 'Consulting', 'consulting', '&#60;i class=&#34;fa fa-magic&#34;&#62;&#60;/i&#62;', '&#60;p&#62;welcome to our consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt&#60;/p&#62;&#13;&#10;', '&#60;p&#62;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#38;#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#38;#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.&#60;/p&#62;&#13;&#10;', 1, 0, '2023-04-21 15:25:13', NULL),
(15, 'Creative Idea(1)', 'creative-idea', '&#60;i class=&#34;fa fa-lightbulb-o&#34;&#62;&#60;/i&#62;', '&#60;p&#62;Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin&#60;/p&#62;&#13;&#10;', '&#60;p&#62;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#38;#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#38;#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.&#60;/p&#62;&#13;&#10;', 1, 0, '2023-04-21 16:36:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT 'Trạng thái xử lý:\r\n0: chưa xử lý\r\n1: đang xử lý\r\n2: đang xử lý',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `fullname`, `email`, `status`, `create_at`, `update_at`) VALUES
(1, 'tô duy duc', 'toduyduc0@gmail.com', 1, '2023-06-26 21:08:07', NULL),
(2, 'nguyễn đức anh hào', 'nguyenanhhao@gmail.com', 0, '2023-06-26 21:15:01', NULL),
(4, 'Hồ Văn A', 'vana@gmail.com', 0, '2023-06-27 16:02:43', '2023-06-27 16:26:54'),
(5, 'Nguyễn văn công', 'vancongnguyen@gmail.com', 0, '2023-06-27 16:03:32', NULL),
(6, 'Nguyễn Văn Hoàng', 'vanhoangnguyen@gmail.com', 0, '2023-06-27 16:04:36', NULL),
(8, 'nguyễn gia phong', 'giaphong@gmail.com', 0, '2023-07-04 16:55:54', NULL),
(9, 'đức tô', 'toduyduc@gmail.com', 0, '2023-07-04 16:58:38', '2023-07-10 21:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `about_content` text DEFAULT NULL,
  `contact_facebook` varchar(100) DEFAULT NULL,
  `contact_twitter` varchar(100) DEFAULT NULL,
  `contact_linkedin` varchar(100) DEFAULT NULL,
  `contact_pinterest` varchar(100) DEFAULT NULL,
  `forget_token` varchar(100) DEFAULT NULL,
  `group_id` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 0 COMMENT 'trạng thái bình luận :\r\n0: chưa duyẹt\r\n1: đã duyệt',
  `last_activity` datetime DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `about_content`, `contact_facebook`, `contact_twitter`, `contact_linkedin`, `contact_pinterest`, `forget_token`, `group_id`, `status`, `last_activity`, `create_at`, `update_at`) VALUES
(1, 'duy duc', 'dduy8195@gmail.com', '$2y$10$kVH29BAD6mx.2hExMfrBhuio0p/hkqyb4XeWty739FajK.ATS81Wa', 'Hi My name is Lamp! quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alterations. Vivamus vehicula quis cursus. In hac habitasse platea dictumst Aenean tristique odio id lectus solmania trundard lamp!', 'https://www.facebook.com/profile.php?id=100011350965099', 'toduyduc.twitter', 'https://www.linkedin.com/', 'https://www.pinterest.com/', NULL, 2, 1, '2023-11-16 18:16:14', NULL, '2023-07-08 21:23:08'),
(5, 'To Duy Duc', 'toduyduc0@gmail.com', '$2y$10$iItQRNKvaVprZO4EZe8fF.0IXJ6VV/p4kKYKDnw0NV5bj6h8lkx7C', 'Hi My name is Lamp! quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula There are many variations of passages of Lorem Ipsum available, but the majority have suffered alterations. Vivamus vehicula quis cursus. In hac habitasse platea dictumst Aenean tristique odio id lectus solmania trundard lamp!', NULL, NULL, NULL, NULL, NULL, 8, 0, NULL, '2023-03-25 20:17:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `contact_type`
--
ALTER TABLE `contact_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_category_id` (`portfolio_category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_id` (`portfolio_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contact_type`
--
ALTER TABLE `contact_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `login_token`
--
ALTER TABLE `login_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `blog_categories` (`id`),
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD CONSTRAINT `blog_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `contact_type` (`id`);

--
-- Constraints for table `login_token`
--
ALTER TABLE `login_token`
  ADD CONSTRAINT `login_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_ibfk_1` FOREIGN KEY (`portfolio_category_id`) REFERENCES `portfolio_categories` (`id`),
  ADD CONSTRAINT `portfolios_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
  ADD CONSTRAINT `portfolio_categories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `portfolio_images`
--
ALTER TABLE `portfolio_images`
  ADD CONSTRAINT `portfolio_images_ibfk_1` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
