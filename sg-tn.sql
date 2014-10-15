-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2014 at 07:33 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sg-tn`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
`id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `alias`, `introtext`, `fulltext`, `status`, `catid`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, 'Giới Thiệu', 'gioi-thieu', 'InTRO Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. \r\n                Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis \r\n                dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. \r\n                Aliquam in felis sit amet augue.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. \r\n                Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis \r\n                dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. \r\n                Aliquam in felis sit amet augue.\r\n', 1, 0, '2014-09-24 13:56:12', 1, '2014-10-03 00:33:42', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
`id_contact` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `status` enum('on','off') NOT NULL DEFAULT 'on',
  `time_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_contact`, `name`, `email`, `subject`, `message`, `status`, `time_create`) VALUES
(1, 'dasdas', 'dasdasda@das', 'asda', 'dasdasd', 'off', '2014-10-03 17:23:23'),
(2, 'duocnt', 'duoc@duoa', 'auo', 'aod\r\n', 'off', '2014-10-03 17:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `contact_yahoo`
--

CREATE TABLE IF NOT EXISTS `contact_yahoo` (
`id` int(11) NOT NULL,
  `nick` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact_yahoo`
--

INSERT INTO `contact_yahoo` (`id`, `nick`, `date`) VALUES
(1, 'ngothanhduoc1991', '2014-10-14 17:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `function`
--

CREATE TABLE IF NOT EXISTS `function` (
`id_function` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `name_display` varchar(200) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `url` text,
  `order` int(11) DEFAULT NULL,
  `is_leaf` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `function`
--

INSERT INTO `function` (`id_function`, `name`, `name_display`, `alias`, `parent_id`, `url`, `order`, `is_leaf`, `create_time`, `update_time`) VALUES
(1, 'add', 'Thêm Menu', 'backend-menu-add', 3, '/backend/menu/add', 1, 1, '2014-08-29 10:10:00', '2014-08-29 10:10:00'),
(2, 'index', 'Danh sách menu', 'backend-menu-index', 3, '/backend/menu/index', 1, 1, '2014-08-29 10:10:00', '2014-08-29 10:10:00'),
(3, 'group', 'Nhóm menu', 'backend-menu-group', 3, '/backend/menu/group', NULL, 1, NULL, NULL),
(4, 'addgroup', 'Thêm nhóm menu', 'backend-menu-addgroup', 3, '/backend/menu/addgroup', NULL, 1, NULL, NULL),
(5, 'index', 'Danh sách User', 'backend-account-index', 2, '/backend/account/index', NULL, 1, NULL, NULL),
(6, 'add', 'Thêm User', 'backend-account-add', 2, '/backend/account/add', NULL, 1, NULL, NULL),
(7, 'index', 'Danh sách bài viết', 'backend-newsevent-index', 4, '/backend/newsevent/index', NULL, 1, NULL, NULL),
(8, 'add', 'Thêm bài viết', 'backend-newsevent-add', 4, '/backend/newsevent/add', NULL, 1, NULL, NULL),
(9, 'category', 'Danh mục bài viết', 'backend-newsevent-category', 4, '/backend/newsevent/category', NULL, 1, NULL, NULL),
(10, 'addcategory', 'Thêm danh mục bài viết', 'backend-newsevent-addcategory', 4, '/backend/newsevent/addcategory', NULL, 1, NULL, NULL),
(11, 'index', 'Danh sách game', 'backend-game-index', 1, '/backend/game/index', NULL, 1, NULL, NULL),
(12, 'add', 'Thêm game', 'backend-game-add', 1, '/backend/game/add', NULL, 1, NULL, NULL),
(13, 'gallery', 'Thư viện hình ảnh', 'backend-system-gallery', 5, '/backend/system/gallery', NULL, 1, NULL, NULL),
(14, 'category', 'Thể loại game', 'backend-game-category', 1, '/backend/game/category', NULL, 1, '2014-09-03 02:49:07', '2014-09-03 08:44:18'),
(15, 'addcategory', 'Thêm thể loại game', 'backend-game-addcategory', 1, '/backend/game/addcategory', NULL, 1, '2014-09-03 02:50:21', '2014-09-03 08:44:39'),
(16, 'publisher', 'Nhà phát hành', 'backend-game-publisher', 1, '/backend/game/publisher', NULL, 1, '2014-09-03 08:45:52', NULL),
(17, 'addpublisher', 'Thêm nhà phát hành', 'backend-game-addpublisher', 1, '/backend/game/addpublisher', NULL, 1, '2014-09-03 08:46:58', NULL),
(18, 'icon', 'Quản lý icons', 'backend-system-icon', 5, '/backend/system/icon', NULL, 1, '2014-09-06 09:06:40', '2014-09-06 10:15:39'),
(19, 'Platform', 'Quản lý Platform', 'backend-game-platform', 1, '/backend/game/platform', NULL, 1, '2014-09-09 15:34:30', '2014-09-09 16:48:41'),
(20, 'add platform', 'Thêm Platform', 'backend-game-add_platform', 1, '/backend/game/add_platform', NULL, 1, '2014-09-09 15:35:03', '2014-09-09 16:48:49'),
(24, 'index', 'Bài viết', 'backend-article-index', 6, '/backend/article/index', NULL, 1, '2014-09-24 12:11:01', '2014-09-24 13:35:43'),
(25, 'add', 'Thêm bài viết', 'backend-article-add', 6, '/backend/article/add', NULL, 1, '2014-09-24 13:37:30', NULL),
(27, 'add', 'ADD product', 'backend-product-add', 8, '/backend/product/add', NULL, 1, '2014-10-05 13:14:27', NULL),
(28, 'index', 'List Slide', 'backend-home-index', 7, '/backend/home/index', NULL, 1, '2014-10-05 13:17:15', '2014-10-05 18:10:17'),
(29, 'product', 'List Product', 'backend-product-index', 8, '/backend/product/index', NULL, 1, '2014-10-05 13:17:48', '2014-10-05 15:05:37'),
(30, 'index', 'List Contact', 'backend-contact-index', 9, '/backend/contact/index', NULL, 1, '2014-10-05 15:32:49', '2014-10-05 15:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `function_group`
--

CREATE TABLE IF NOT EXISTS `function_group` (
`id` int(11) NOT NULL,
  `display_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) DEFAULT '1',
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_display` int(2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `function_group`
--

INSERT INTO `function_group` (`id`, `display_name`, `order`, `class`, `alias`, `is_display`) VALUES
(2, 'Quản lý Tài khoản', 2, NULL, 'account', 1),
(3, 'Quản lý Menu', 3, NULL, 'menu', 1),
(6, 'Quản lý bài viết', 6, '', 'article', 1),
(8, 'Product', 1, 'product', 'product', 1),
(9, 'CONTACT', 1, 'contact', 'contact', 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` text NOT NULL,
  `type` enum('company','partner') NOT NULL DEFAULT 'company',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `image`, `type`, `date`) VALUES
(1, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'company', '0000-00-00 00:00:00'),
(2, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'company', '0000-00-00 00:00:00'),
(3, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'company', '0000-00-00 00:00:00'),
(4, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'company', '0000-00-00 00:00:00'),
(5, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'company', '0000-00-00 00:00:00'),
(6, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'company', '0000-00-00 00:00:00'),
(7, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'company', '0000-00-00 00:00:00'),
(8, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'partner', '2014-10-13 17:00:00'),
(9, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'partner', '0000-00-00 00:00:00'),
(10, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'partner', '0000-00-00 00:00:00'),
(11, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'partner', '0000-00-00 00:00:00'),
(12, 'abc', '/public/assets/images/20080513_4D3SD1BQ_tb.jpg', 'partner', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id_news` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_news`, `name`, `image`, `content`, `create_time`) VALUES
(1, 'Tin Tức Nông Nghiệp', '/public/assets/images/12.jpg', 'Thông tin nông nghiệp', '2014-10-14 17:00:00'),
(2, 'Thông tin thị trường', '/public/assets/images/12.jpg', 'Thông tin nông nghiệp', '2014-10-14 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id_product` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `image_small` varchar(200) NOT NULL,
  `image_big` varchar(200) NOT NULL,
  `status` enum('on','off') NOT NULL DEFAULT 'on',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `name`, `description`, `image_small`, `image_big`, `status`, `create_time`) VALUES
(1, 'Hana Special 1 Hana Special 1', 'I''m a description. Click to edit I''m a description. Click to edit I''m a description. Click to edit I''m a description. Click to edit I''m a description. Click to edit I''m a description. Click to edit I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:25:38'),
(2, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:25'),
(3, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:32'),
(4, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:32'),
(5, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:32'),
(6, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:32'),
(7, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:32'),
(8, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:32'),
(9, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:32'),
(10, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:32'),
(11, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:32'),
(12, 'Hana Special 12', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:43'),
(13, 'Hana Special13', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:43'),
(14, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:43'),
(15, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:43'),
(16, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:43'),
(17, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:43'),
(18, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:43'),
(19, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:43'),
(20, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:43'),
(21, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:47'),
(22, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:47'),
(23, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:47'),
(24, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:47'),
(25, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:47'),
(26, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:47'),
(27, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:47'),
(28, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:47'),
(29, 'Hana Special', 'I''m a description. Click to edit', '/public/assets/images/12.jpg', '/public/frontend/assets/images/IMG (68).jpg', 'on', '2014-10-04 16:27:47'),
(30, 'sa=p mơi', '<p>đấ đ&aacute; rưẻ fwrg&nbsp;</p>\r\n', '/public/assets/images/12.jpg', '/public/assets/images/news/images/flower_branch_stem_petals_background_66692_1920x1080.jpg', 'on', '2014-10-05 08:27:08'),
(31, 'sa=p mơi 1 2', '<p>đấ đ&aacute; rưẻ fwrg&nbsp;</p>\r\n', '/public/assets/images/12.jpg', '/public/assets/images/news/images/flower_branch_stem_petals_background_66692_1920x1080.jpg', 'on', '2014-10-05 08:28:55'),
(32, 'đâsd', '<p>adấd</p>\r\n', '/public/assets/images/news/images/12.jpg', '', 'on', '2014-10-14 17:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
`id_slide` int(11) NOT NULL,
  `image` text NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` enum('on','off') NOT NULL DEFAULT 'on',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id_slide`, `image`, `name`, `description`, `status`, `create_time`) VALUES
(1, '/public/assets/images/news/images/IMG (68).jpg', 'slide 1 2', '<p>I&#39;m a description. Click to edit &nbsp;đasdsđa 423423 ể các Tướng Quân nhanh chóng thưởng thức đầy đủ tính năng mới của phiên bản " Đại Chiến Vượt Thời Gian", Tam Quốc sứ giả xin được hướng dẫn việc cập nhật phiên bản mới như sau:</p>\r\n', 'on', '2014-10-04 18:17:11'),
(2, '/public/frontend/assets/images/IMG (46).jpg', 'Slide 2', 'I''m a description. Click to edit ', 'on', '2014-10-04 18:17:11'),
(3, '/public/frontend/assets/images/IMG (68).jpg', 'Slide 3', 'I''m a description. Click to edit ', 'on', '2014-10-04 18:17:11'),
(4, '/public/frontend/assets/images/flower_branch_stem_petals_background_66692_1920x1080.jpg', 'Slide 4', 'I''m a description. Click to edit ', 'on', '2014-10-04 18:17:11'),
(5, '/public/assets/images/news/images/IMG (45).jpg', 'duoc', '<p>duoc duoc</p>\r\n', 'on', '2014-10-05 07:47:25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_admin` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  `description` text,
  `status` varchar(45) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `permission` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_admin`, `username`, `password`, `full_name`, `description`, `status`, `create_time`, `update_time`, `permission`) VALUES
(2, 'duocnt', 'e10adc3949ba59abbe56e057f20f883e', 'Ngô Thành Được', NULL, '1', '2014-08-29 00:00:00', '2014-10-05 15:33:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_function`
--

CREATE TABLE IF NOT EXISTS `user_has_function` (
  `id_admin` int(11) NOT NULL,
  `id_function` int(11) NOT NULL,
  `allow` text,
  `create_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_has_function`
--

INSERT INTO `user_has_function` (`id_admin`, `id_function`, `allow`, `create_date`) VALUES
(2, 1, NULL, NULL),
(2, 2, NULL, NULL),
(2, 3, NULL, NULL),
(2, 4, NULL, NULL),
(2, 5, NULL, NULL),
(2, 6, NULL, NULL),
(2, 24, NULL, NULL),
(2, 25, NULL, NULL),
(2, 27, NULL, NULL),
(2, 28, NULL, NULL),
(2, 29, NULL, NULL),
(2, 30, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
 ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `contact_yahoo`
--
ALTER TABLE `contact_yahoo`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `function`
--
ALTER TABLE `function`
 ADD PRIMARY KEY (`id_function`), ADD UNIQUE KEY `alias_UNIQUE` (`alias`), ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `function_group`
--
ALTER TABLE `function_group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id_news`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
 ADD PRIMARY KEY (`id_slide`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_admin`), ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- Indexes for table `user_has_function`
--
ALTER TABLE `user_has_function`
 ADD PRIMARY KEY (`id_admin`,`id_function`), ADD KEY `fk_user_has_function_function1_idx` (`id_function`), ADD KEY `fk_user_has_function_user1_idx` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contact_yahoo`
--
ALTER TABLE `contact_yahoo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `function`
--
ALTER TABLE `function`
MODIFY `id_function` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `function_group`
--
ALTER TABLE `function_group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `id_news` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
MODIFY `id_slide` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_has_function`
--
ALTER TABLE `user_has_function`
ADD CONSTRAINT `user_has_function_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `user` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_has_function_ibfk_2` FOREIGN KEY (`id_function`) REFERENCES `function` (`id_function`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
