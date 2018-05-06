-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2018 at 08:13 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bettingtime`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblAds`
--

CREATE TABLE `tblAds` (
  `id` int(11) UNSIGNED NOT NULL,
  `adsImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `adsLink` mediumtext COLLATE utf8_unicode_ci,
  `sequence` int(11) NOT NULL,
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblAds`
--

INSERT INTO `tblAds` (`id`, `adsImage`, `imageName`, `adsLink`, `sequence`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(2, 'images/adds/banner_one.gif', 'banner_one.gif', 'www.google.com', 1, '0000-00-00 00:00:00', 1, 1, '2017-02-26 14:17:30'),
(3, 'images/adds/test.png', 'test.png', 'www.google.com', 4, '0000-00-00 00:00:00', 1, 1, '2017-02-26 14:30:59'),
(4, 'images/adds/bannerthree.png', 'bannerthree.png', 'www.google.com', 2, '0000-00-00 00:00:00', 1, 1, '2017-02-26 14:26:44'),
(5, 'images/adds/bannerfour.png', 'bannerfour.png', 'www.google.com', 3, '0000-00-00 00:00:00', 1, 1, '2017-02-26 14:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `tblBonusCards`
--

CREATE TABLE `tblBonusCards` (
  `id` int(11) UNSIGNED NOT NULL,
  `joinCode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sportsName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bonusName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bonusCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bonustype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bonusAmount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `wageringRequirements` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bonusImage` mediumtext COLLATE utf8_unicode_ci,
  `rating` int(11) NOT NULL DEFAULT '3',
  `bonusOtherDetails` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `minDepositeAmpount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rollingCondition` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bonusConUtilization` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maxBonusAmount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `maxCashout` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bonusWithdrawlCondition` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isPopular` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblBonusCards`
--

INSERT INTO `tblBonusCards` (`id`, `joinCode`, `sportsName`, `bonusName`, `bonusCode`, `bonustype`, `bonusAmount`, `description`, `wageringRequirements`, `link`, `imageName`, `bonusImage`, `rating`, `bonusOtherDetails`, `minDepositeAmpount`, `rollingCondition`, `bonusConUtilization`, `maxBonusAmount`, `maxCashout`, `bonusWithdrawlCondition`, `isPopular`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, '69696', 'BettingWays Casino', 'pinacle', 'ASOP67TY', 'Welcome Bonus', '200%', 'This is test for a welcome bonusThis is test for a welcome bonus', '23x', 'www.google.com', 'royal_casino.jpg', 'images/royal_casino.jpg', 3, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\",\"test\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\",\"test\"]', '', '', '', '0', '', '', '', '0000-00-00 00:00:00', 0, 1, '2018-01-27 09:18:23'),
(2, '69696968', 'test casino', 'ask gambler', 'DEFG67', 'First Deposite Bonus', '200%', 'test free spintest free spintest free spintest free spin', '35X', 'www.google.com', 'get_casino.jpg', 'images/get_casino.jpg', 3, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\"]', '', '', '', '0', '', '', 'N', '0000-00-00 00:00:00', 0, 0, '2016-05-18 04:54:31'),
(3, '696964', 'royal casino', 'Ask gambler', 'ASOP67TY', 'Welcome Bonus', '200%', 'this is test bonus code this is test bonus code this is test bonus code ', '45x', 'www.google.com', 'sadari_sports.jpg', 'images/sadari_sports.jpg', 1, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\"]', '', '', '', '0', '', '', 'Y', '0000-00-00 00:00:00', 0, 0, '2016-05-18 04:56:03'),
(4, '12356', 'ì•ˆì „í•œë†€ì´í„°', 'ì•ˆì „ë†€ì´í„°', 'ASOP67TY', 'Rolling Bonus', '150%', 'this is test bonus code this is test bonus code', '23x', 'www.google.com', 'royal_casino.gif', 'images/royal_casino.gif', 2, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\"]', '', '5X(ìž…ê¸ˆì•¡+ë³´ë„ˆìŠ¤)', '4í´ë” ì´ìƒ', '150', '', 'Bet over 2.00', '', '0000-00-00 00:00:00', 0, 1, '2017-01-23 10:40:44'),
(6, '58964', 'Drake Casino', 'Ask gambler', 'ASOP67TY', 'Combo Bonus', '110%', 'this is test bonus code this is test bonus code this is test bonus code', '23x', 'www.google.com', 'new_image.jpg', 'images/new_image.jpg', 3, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\"]', '200000', '', '', '0', '', '', '', '0000-00-00 00:00:00', 0, 1, '2017-02-04 13:18:15'),
(7, '69696', 'Sadari Sports', 'Ask gambler', 'ASOP67TY', 'Every Time Bonus', '210%', 'this is test bonus code this is test bonus code this is test bonus code this is test bonus code ', '35X', 'www.google.com', 'new_image.png', 'images/new_image.png', 5, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\"]', '', '', '', '0', '', '', 'Y', '0000-00-00 00:00:00', 0, 0, '2016-05-18 06:31:27'),
(9, '696966', 'ì•ˆì „í•œë†€ì¶”ì²œí•¨', 'ì•ˆì „í•œë†€ì´í„°ì¶”ì²œ', 'ASOP67TY', 'First Deposite Bonus', '90%', 'test free spintest free spintest free spintest free spin', '23x', 'www.google.com', 'new_sports5.png', 'images/new_sports5.png', 1, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\"]', '100000', '1X(ìž…ê¸ˆì•¡+ë³´ë„ˆìŠ¤)', '3í´ë” ì´ìƒ', '200', '100000', 'Bet over 1.50', '', '0000-00-00 00:00:00', 0, 1, '2017-01-23 10:42:24'),
(11, '696964', 'Sadari Sports', 'pinnacle', 'ASOP67TY', 'Rolling Bonus', '110%', 'test for free spin test for free spin test for free spin test for free spin', '35X', 'www.google.com', 'bit_coin1.png', 'images/bit_coin1.png', 4, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\"]', '', '', '', '0', '', '', 'Y', '0000-00-00 00:00:00', 0, 0, '2016-05-19 13:16:54'),
(12, '4294967295', 'Drake Casino', 'Drek', 'ASD678G5', 'Free Money', '150USD', 'this is test bonus for dark casino', '30x(d+b)', 'www.google.com', 'Drek.jpg', 'images/bonus/Drek.jpg', 4, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\"]', '', '', '', '0', '', '', '', '0000-00-00 00:00:00', 1, 1, '2017-02-26 03:43:53'),
(13, 'FGT44D', 'ì•ˆì „í•œë†€ì´í„°ì¶”ì²œí•¨', 'ì•ˆì „ë†€ì´í„°', 'AYU678G5', 'Combo Bonus', '25%', 'test bonus', '30x', 'www.gool.com', '12.jpg', 'images/bonus/12.jpg', 5, '[\"Establish\"]+[\"2014\"]', '', '', '', '', '', '', 'N', '0000-00-00 00:00:00', 1, 1, '2017-02-26 06:54:59'),
(14, 'ASD456', 'ì•ˆì „í•œë†€ì´í„°ì¶', 'ì•ˆì „í•œë†€ì´í„°ì¶', 'AYU678G5', 'Every Time Bonus', '25%', 'zdfsdfsdfsd', '30x', 'www.googl.com', '09.jpg', 'images/bonus/09.jpg', 5, '[\"Establish\"]+[\"2016\"]', '', '', '', '', '', '', '', '0000-00-00 00:00:00', 1, 1, '2017-02-26 07:30:53'),
(15, 'ASD45645', 'BetKings', 'ì•ˆì „ë†€ì´í„°', 'ASD678G5', 'Other Bonus', '25%', 'gdfgdfgdsgsdgfsdgfsdgsdgdgd fgdsfgdfgdsgsdg dfgdgfsdfg', '30x', 'www.googl.com', '13.jpg', 'images/bonus/13.jpg', 5, '[\"Establish\"]+[\"2016\"]', '100000', '', '', '', '', '', '', '0000-00-00 00:00:00', 1, 1, '2017-02-26 07:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `tblBonusComment`
--

CREATE TABLE `tblBonusComment` (
  `id` int(11) UNSIGNED NOT NULL,
  `bonusId` int(11) UNSIGNED NOT NULL,
  `userId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gdComments` mediumtext COLLATE utf8_unicode_ci,
  `badComments` mediumtext COLLATE utf8_unicode_ci,
  `rating` int(11) NOT NULL DEFAULT '3',
  `isRecommanded` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkUser` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checksiteAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblBonusComment`
--

INSERT INTO `tblBonusComment` (`id`, `bonusId`, `userId`, `gdComments`, `badComments`, `rating`, `isRecommanded`, `checkUser`, `checkAdmin`, `checksiteAdmin`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, 11, '22', 'lorem ipsum dollar set emetlorem ipsum dollar set emetlorem ipsum dollar set emet', 'lorem ipsum dollar set emetlorem ipsum dollar set emetlorem ipsum dollar set emetlorem ipsum dollar set emetlorem ipsum dollar set emet', 4, 'Y', 'N', 'Y', 'Y', '0000-00-00 00:00:00', 3, 3, '2016-05-31 13:52:59'),
(2, 12, '22', 'i like this website', 'i dont like this website', 5, 'N', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-05-30 22:55:26'),
(3, 9, '22', 'love this sports', 'this sports does not have free spin bonus', 2, 'N', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-05-30 22:58:46'),
(4, 11, '22', 'test bonus1', 'testbonus1', 5, 'Y', 'N', 'Y', 'Y', '0000-00-00 00:00:00', 22, 22, '2016-06-30 03:33:41'),
(6, 7, '3', 'test', 'tesdt', 5, 'Y', 'N', 'Y', 'Y', '0000-00-00 00:00:00', 3, 3, '2016-10-31 03:53:42'),
(7, 7, '3', 'test3', 'test3', 5, 'N', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-10-31 04:00:38'),
(8, 7, '3', 'This is test for good comment', 'this is test for bad comment', 5, 'N', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-10-31 04:06:31'),
(9, 1, '22', 'Sadari sports bonus', 'Sadari sports bonus bad', 2, 'Y', 'N', 'Y', 'Y', '0000-00-00 00:00:00', 22, 22, '2017-02-04 13:03:14'),
(10, 6, '3', 'Royal casino is the best', 'royal casion is bad', 4, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2017-02-05 14:14:42'),
(11, 3, '22', 'test royal casino', 'test royal casino bad', 5, 'N', 'N', 'Y', 'N', '0000-00-00 00:00:00', 22, 22, '2017-02-04 13:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `tblBonusCommentResponse`
--

CREATE TABLE `tblBonusCommentResponse` (
  `id` int(11) UNSIGNED NOT NULL,
  `responseId` int(11) NOT NULL COMMENT '`tblBonusComment`->`id`',
  `bonusId` int(11) NOT NULL,
  `userId` int(11) NOT NULL COMMENT '`tblUser`->`id`',
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `checkUser` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkSiteAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblCommentResponse`
--

CREATE TABLE `tblCommentResponse` (
  `id` int(11) UNSIGNED NOT NULL,
  `responseId` int(11) NOT NULL COMMENT '`comment table`->`id`',
  `category` tinyint(4) NOT NULL DEFAULT '1' COMMENT '`1`->`sports`,`2`->`bonus`,`3`->`sadari`,`4`->`news`',
  `categoryId` int(11) NOT NULL COMMENT '`category` -> `id`, from individual `category`',
  `userId` int(11) NOT NULL COMMENT '`tblUser`->`id`',
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `isVerified` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT NULL,
  `checkUser` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkSiteAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblCommentResponse`
--

INSERT INTO `tblCommentResponse` (`id`, `responseId`, `category`, `categoryId`, `userId`, `comment`, `isVerified`, `checkUser`, `checkAdmin`, `checkSiteAdmin`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(2, 1, 2, 11, 1, 'Hi vbb89,  Thank You for your comment....', 'Y', 'Y', 'Y', 'Y', '0000-00-00 00:00:00', 1, 1, '2017-02-04 04:29:14'),
(3, 6, 3, 6, 1, 'Hi vbb89, Thanks for your comment', 'Y', 'Y', 'Y', 'Y', '0000-00-00 00:00:00', 1, 1, '2017-02-04 04:32:00'),
(4, 3, 1, 26, 1, 'Thanks again for your 5 start rating', 'Y', 'Y', 'Y', 'N', '0000-00-00 00:00:00', 1, 1, '2017-02-05 02:34:06'),
(6, 13, 1, 17, 24, 'Hi vbb89,\r\nThanks for your comment', 'Y', 'N', 'N', 'Y', '0000-00-00 00:00:00', 24, 24, '2017-02-05 11:22:57'),
(8, 6, 3, 6, 24, 'test', 'N', 'N', 'Y', 'Y', '0000-00-00 00:00:00', 24, 24, '2017-02-05 13:24:46'),
(21, 1, 2, 11, 1, 'thanks', 'Y', 'Y', 'Y', 'Y', '0000-00-00 00:00:00', 1, 1, '2017-02-07 14:50:05'),
(22, 6, 3, 6, 24, 'try', 'N', 'N', 'Y', 'Y', '0000-00-00 00:00:00', 24, 24, '2017-02-19 01:21:40'),
(23, 4, 2, 11, 3, 'thanks for your', 'N', 'N', 'Y', 'Y', '0000-00-00 00:00:00', 3, 3, '2018-01-22 15:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `tblComplaintContent`
--

CREATE TABLE `tblComplaintContent` (
  `id` int(11) NOT NULL,
  `categoryComplaint` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `categoryComplaintContent` text COLLATE utf8_unicode_ci NOT NULL,
  `UpdatedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblComplaintContent`
--

INSERT INTO `tblComplaintContent` (`id`, `categoryComplaint`, `categoryComplaintContent`, `UpdatedOn`) VALUES
(1, '입출금 지연', '<p>&nbsp;</p>\r\n<p>TeTest</p>\r\n<div id=\"accordion\" class=\"panel-group\">&nbsp;</div>', '2018-01-30 18:11:41'),
(2, 'ìž…ì¶œê¸ˆ ê±°ì ˆ', '<p>í•´ë‹¹ ë¬¸ì œëŠ” ì‚¬ì´íŠ¸ì™€ ìœ ì € ì‚¬ì´ì—ì„œ ë§Œì¡±ìŠ¤ë¡œìš´ ê²°ê³¼ë¥¼ ê°€ì ¸ì˜¤ê¸° ì–´ë ¤ìš´ íŽ¸ìž…ë‹ˆë‹¤.</p>\r\n<p>ì´ ë¬¸ì œë¥¼ í•´ê²°í•˜ê¸° ìœ„í•´ì„œëŠ” ë§Žì€ ì¦ê±° ìžë£Œê°€ í•„ìš”í•  ìˆ˜ ìžˆìœ¼ë©°, ì„œë¡œê°€ ì œì‹œí•˜ëŠ” ê²ƒë“¤ì´ ë¶ˆì¼ì¹˜ í•œë‹¤ë©´ ë³´íŽ¸ì ìœ¼ë¡œ í•´ê²°ë˜ê¸° ì–´ë µê¸° ë•Œë¬¸ìž…ë‹ˆë‹¤.&nbsp; ê°„í˜¹ ì‚¬ì´íŠ¸ì—ì„œ ì•„ë¬´ëŸ° ì´ìœ ë„ ì—†ì´ ê±°ì ˆí•˜ëŠ” ê²½ìš°ë„ ìžˆì§€ë§Œ, ì¼ë°˜ì ìœ¼ë¡œ ì‚¬ì´íŠ¸ ìž…ìž¥ì—ì„œ ì¶œê¸ˆì„ ê±°ì ˆí•˜ëŠ” ì´ìœ ëŠ” í•´ë‹¹ ì‚¬ì´íŠ¸ì˜ ë³´ë„ˆìŠ¤ ë° ë°°íŒ… ê·œì •ì„ ìœ„ë°˜í–ˆë‹¤ê³  ì£¼ìž¥í•˜ê¸° ë•Œë¬¸ìž…ë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ì¶œê¸ˆì´ ê±°ì ˆë  ê²½ìš°, í•´ë‹¹ ì‚¬ì´íŠ¸ì—ì„œëŠ” ê±°ì ˆí•œ ì´ìœ ë¥¼ ìœ ì €ì—ê²Œ ì•Œë ¤ì¤˜ì•¼ í•©ë‹ˆë‹¤. ë§Œì•½ ì–´ë– í•œ ì´ìœ ë„ ìœ ì €ì—ê²Œ ë§í•´ì£¼ì§€ ì•Šì•˜ë‹¤ë©´ ì´ëŠ” ë¬¸ì œê°€ ë  ìˆ˜ ìžˆìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ì‚¬ì´íŠ¸ ë¶„ìŸ í•´ê²°ì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì—</strong><strong>&hellip;</strong></p>\r\n<p>ìœ ì € ë¶„ì˜ ë¬¸ì œë¥¼ ì›í™œí•˜ê²Œ í•´ê²°í•˜ê¸° ìœ„í•´ì„œëŠ” ë¨¼ì € í•´ë‹¹ ì‚¬ì´íŠ¸ ê·œì •ì— ìœ„ë°˜ëœ ë°°íŒ…ì„ í•˜ê±°ë‚˜ ë¬¸ì œê°€ ë ë§Œí•œ í–‰ìœ„ë¥¼ í•˜ì…¨ëŠ”ì§€ë¥¼ í™•ì¸í•˜ì…”ì•¼ í•©ë‹ˆë‹¤. í•´ë‹¹ ì‚¬ì´íŠ¸ ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê²Œ ëœ ê²°ì •ì ì¸ ì´ìœ ê°€ ë°˜ë“œì‹œ í•„ìš”í•˜ë©°, ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì— ì•„ëž˜ ì§ˆë¬¸ê³¼ ë‹µì„ í™•ì¸í•´ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ë§Œì•½ ì•…ì˜ì ìœ¼ë¡œ ë‚´ìš©ì„ ë¶€í’€ë¦¬ê±°ë‚˜ ì‚¬ì´íŠ¸ë¥¼ í˜‘ë°•í•˜ëŠ” ë‚´ìš©ì´ í¬í•¨ë˜ì—ˆì„ ê²½ìš°, í•´ë‹¹ íšŒì›ì€ ì œìž¬ ëŒ€ìƒìž…ë‹ˆë‹¤.</li>\r\n<li>ê¸€ ìž‘ì„±ì„ í•˜ì‹¤ ë•Œ, ì¦ê±°ìžë£Œë¥¼ ê°™ì´ ì œì¶œí•´ì£¼ì‹œë©´ í•´ê²°ì— ë§Žì€ ë„ì›€ì´ ë©ë‹ˆë‹¤.</li>\r\n<li>ì €í¬ ì‚¬ì´íŠ¸ì— ì—†ëŠ” ë°°íŒ…ì‚¬ì´íŠ¸ì— ëŒ€í•´ì„œëŠ” ë¶„ìŸ í•´ê²° ì‹ ì²­ì„ í•˜ì‹¤ ìˆ˜ ì—†ìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ìžì£¼ ë¬»ëŠ” ì§ˆë¬¸ ë° í•´ê²°ì•ˆ ì œì‹œ</strong></p>\r\n<p><strong>í•´ë‹¹ ì‚¬ì´íŠ¸ì—ì„œ ë¬¸ì œê°€ ë˜ëŠ” í–‰ìœ„ ë° ë¶€ì • ë°°íŒ…ì„ í•˜ì…¨ëŠ”ì§€ í™•ì¸ í•˜ì…¨ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ë§Žì€ ìœ ì €ë“¤ì´ í•´ë‹¹ ì‚¬ì´íŠ¸ì˜ ë°°íŒ… ê·œì • ë° ê³µì§€ì‚¬í•­ì„ ì½ì–´ë³´ì§€ ì•Šê³  ë°°íŒ…ì„ í•˜ì—¬ ì‹¤ìˆ˜</p>\r\n<p>ë¥¼ ë²”í•˜ê³¤ í•©ë‹ˆë‹¤. ë•Œë¬¸ì— ë§Œì•½ ì´ ë¬¸ì œì— ì†í•˜ì‹ ë‹¤ë©´, ë‹¤ì‹œ í•œë²ˆ í•´ë‹¹ ì‚¬ì´íŠ¸ì˜ ë°°íŒ… ê·œì • ë° ì‚¬ì´íŠ¸ ê·œì¹™ì„ ìˆ™ì§€í•˜ì‹œì–´ ì´ìš© ë¶€íƒë“œë¦¬ê² ìŠµë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>ë³´ë„ˆìŠ¤ë¥¼ ì§€ê¸‰ë°›ê³  í•´ë‹¹ ê¸ˆì•¡ë„ ê°™ì´ ì¶œê¸ˆ ì‹ ì²­ì„ í•˜ì…¨ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ë§Œì•½ ë§žë‹¤ë©´, í•´ë‹¹ ë³´ë„ˆìŠ¤ì˜ ë¡¤ë§ ì¡°ê±´ì„ ë‹¤ì‹œ í•œë²ˆ í™•ì¸ ë°”ëžë‹ˆë‹¤. ê° ì‚¬ì´íŠ¸ë§ˆë‹¤ ë³´ë„ˆìŠ¤ ë¡¤ë§ ì¡°ê±´ì´ ì¡´ìž¬í•˜ê¸° ë•Œë¬¸ì— ì´ì— ì¶©ì¡±ë˜ì§€ ì•Šì•˜ë‹¤ë©´ ì¶œê¸ˆì´ ê±°ì ˆë  ìˆ˜ ìžˆìŠµë‹ˆë‹¤.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>í•´ë‹¹ ì‚¬ì´íŠ¸ì—ì„œ í•œê°œ ì´ìƒì˜ ì•„ì´ë””ë¥¼ ë§Œë“œì…¨ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ë§Œì•½ ë§žë‹¤ë©´, ì¼ë°˜ì ìœ¼ë¡œ ëª¨ë“  ì‚¬ì´íŠ¸ì—ì„œëŠ” í•˜ë‚˜ ì´ìƒì˜ ì•„ì´ë””ë¥¼ ì¸ì •í•˜ì§€ ì•ŠìŠµë‹ˆë‹¤. ì´ëŠ” ì‚¬ì´íŠ¸ ê·œì¹™ì— ìœ„ë°˜ë˜ëŠ” í–‰ìœ„ìž„ìœ¼ë¡œ ìµœì†Œí•œ ìž…ê¸ˆ í•˜ì…¨ë˜ ê¸ˆì•¡ì´ë¼ë„ í™˜ê¸‰ ë°›ìœ¼ì‹œê¸¸ í¬ë§í•˜ê² ìŠµë‹ˆë‹¤.</p>', '2017-02-18 13:21:25'),
(3, 'ì¶”ê°€ìž…ê¸ˆ ìš”êµ¬', '<p>ê·œì •ì— ì–´ê¸‹ë‚˜ëŠ” ë°°íŒ…ì„ í•˜ì§€ ì•Šì•˜ëŠ”ë°ë„ ì¶œê¸ˆì„ ìœ„í•´ ì¶”ê°€ ìž…ê¸ˆì„ ìš”ì²­í•˜ëŠ” ê³³ì´ ìžˆë‹¤ë©´, í•´ë‹¹ ì—…ì²´ëŠ” ìœ ì € ë¶„ì„ ìƒëŒ€ë¡œ ì‚¬ê¸°ë¥¼ ì¹˜ê³  ìžˆëŠ” ê²ƒìž…ë‹ˆë‹¤. ì •ìƒì ì¸ ë°°íŒ… ì‚¬ì´íŠ¸ì—ì„œëŠ” ì ˆëŒ€ë¡œ ì¶”ê°€ ìž…ê¸ˆì„ ìš”ì²­í•˜ì§€ ì•Šìœ¼ë©° ì ˆëŒ€ë¡œ ê·¸ëŸ° ì¼ì´ ìžˆì–´ì„œëŠ” ì•ˆë©ë‹ˆë‹¤. í•´ë‹¹ ì—…ì²´ë¥¼ ê¼­ ê³ ë°œí•˜ì…”ì„œ ë‹¤ë¥¸ í”¼í•´ìžê°€ ì—†ë„ë¡ ë„ì™€ì£¼ì‹œê¸¸ ë°”ëžë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ì¶”ê°€ ìž…ê¸ˆì„ ìš”ì²­í•˜ë©´ ì¦‰ê° í•´ë‹¹ ìžë£Œë“¤ì„ ìˆ˜ì§‘í•´ ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ì‚¬ì´íŠ¸ ë¶„ìŸ í•´ê²°ì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì—</strong><strong>&hellip;</strong></p>\r\n<p>ìœ ì € ë¶„ì˜ ë¬¸ì œë¥¼ ì›í™œí•˜ê²Œ í•´ê²°í•˜ê¸° ìœ„í•´ì„œëŠ” ë¨¼ì € í•´ë‹¹ ì‚¬ì´íŠ¸ ê·œì •ì— ìœ„ë°˜ëœ ë°°íŒ…ì„ í•˜ê±°ë‚˜ ë¬¸ì œê°€ ë ë§Œí•œ í–‰ìœ„ë¥¼ í•˜ì…¨ëŠ”ì§€ë¥¼ í™•ì¸í•˜ì…”ì•¼ í•©ë‹ˆë‹¤. í•´ë‹¹ ì‚¬ì´íŠ¸ ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê²Œ ëœ ê²°ì •ì ì¸ ì´ìœ ê°€ ë°˜ë“œì‹œ í•„ìš”í•˜ë©°, ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì— ì•„ëž˜ ì§ˆë¬¸ê³¼ ë‹µì„ í™•ì¸í•´ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ë§Œì•½ ì•…ì˜ì ìœ¼ë¡œ ë‚´ìš©ì„ ë¶€í’€ë¦¬ê±°ë‚˜ ì‚¬ì´íŠ¸ë¥¼ í˜‘ë°•í•˜ëŠ” ë‚´ìš©ì´ í¬í•¨ë˜ì—ˆì„ ê²½ìš°, í•´ë‹¹ íšŒì›ì€ ì œìž¬ ëŒ€ìƒìž…ë‹ˆë‹¤.</li>\r\n<li>ê¸€ ìž‘ì„±ì„ í•˜ì‹¤ ë•Œ, ì¦ê±°ìžë£Œë¥¼ ê°™ì´ ì œì¶œí•´ì£¼ì‹œë©´ í•´ê²°ì— ë§Žì€ ë„ì›€ì´ ë©ë‹ˆë‹¤.</li>\r\n<li>ì €í¬ ì‚¬ì´íŠ¸ì— ì—†ëŠ” ë°°íŒ…ì‚¬ì´íŠ¸ì— ëŒ€í•´ì„œëŠ” ë¶„ìŸ í•´ê²° ì‹ ì²­ì„ í•˜ì‹¤ ìˆ˜ ì—†ìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ìžì£¼ ë¬»ëŠ” ì§ˆë¬¸ ë° í•´ê²°ì•ˆ ì œì‹œ</strong></p>\r\n<p><em><strong>ì¶œê¸ˆ ì‹ ì²­ì„ í–ˆëŠ”ë° í†µìž¥ë¡¤ë§ì„ í•´ì•¼í•œë‹¤ê³  í•˜ë‚˜ìš”</strong><strong>? (drop box)</strong></em></p>\r\n<p>ê·¸ë ‡ë‹¤ë©´ í•´ë‹¹ ì‚¬ì´íŠ¸ëŠ” ì‚¬ê¸°ìž…ë‹ˆë‹¤. íšŒì›ê°€ìž… í›„, ì²« ì¶œê¸ˆì„ ìœ„í•´ì„œëŠ” í†µìž¥ ë¡¤ë§ì´ í•„ìš”í•˜ë‹¤ë©° ì¶”ê°€ ìž…ê¸ˆì„ ìš”ì²­í•©ë‹ˆë‹¤. í•˜ì§€ë§Œ ì ˆëŒ€ë¡œ í•´ì£¼ì‹œë©´ ì•ˆë˜ë©°, í•´ì£¼ì‹¤ ê²½ìš° ë” ë§Žì€ í”¼í•´ë¥¼ ë³´ì‹¤ ìˆ˜ ìžˆìŠµë‹ˆë‹¤.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>ì¶œê¸ˆ ì‹ ì²­ì„ í–ˆëŠ”ë°</strong><strong> VIP ì½”ë“œë¥¼ ì–¸ê¸‰ í•˜ë‚˜ìš”? (drop box)</strong></p>\r\n<p>ê·¸ë ‡ë‹¤ë©´ í•´ë‹¹ ì‚¬ì´íŠ¸ëŠ” ì‚¬ê¸°ìž…ë‹ˆë‹¤.&nbsp; VIP ì½”ë“œì˜ í˜œíƒì„ ì„¤ëª…í•˜ë©´ì„œ ì›í™œí•œ ì¶œê¸ˆì„ ìœ„í•´ì„œëŠ” ìµœì†Œ ì–¼ë§ˆ ì´ìƒ ìž…ê¸ˆì´ í•„ìš”í•˜ë‹¤ê³  í•©ë‹ˆë‹¤. í•˜ì§€ë§Œ ì ˆëŒ€ë¡œ í•´ì£¼ì‹œë©´ ì•ˆë˜ë©°, í•´ì£¼ì‹¤ ê²½ìš° ë” ë§Žì€ í”¼í•´ë¥¼ ë³´ì‹¤ ìˆ˜ ìžˆìŠµë‹ˆë‹¤.</p>', '2017-02-18 14:14:21'),
(4, 'ë³´ë„ˆìŠ¤ ì¡°ê±´ ìœ„ë°˜', '<p>ì‚¬ì´íŠ¸ë¥¼ ì´ìš©í•˜ì‹œë©´ì„œ ì§€ì—° ë° ê±°ì ˆ ì™¸ì— ë‹¤ì–‘í•œ ìž…ì¶œê¸ˆ ë¬¸ì œê°€ ë°œìƒí•  ìˆ˜ ìžˆìŠµë‹ˆë‹¤. ê·¸ëŸ´ ê²½ìš° í•´ë‹¹ ì˜µì…˜ì„ ì„ íƒí•´ì£¼ì„¸ìš”.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ë§Œì•½ í•´ë‹¹ ë¶„ìŸì´ ìž…ì¶œê¸ˆ ê´€ë ¨ëœ ê²ƒì´ ì•„ë‹ˆë¼ë©´ &ldquo;ìž…ì¶œê¸ˆ ê¸°íƒ€&rdquo;ê°€ ì•„ë‹Œ, &ldquo;ê¸°íƒ€&rdquo; ì˜µì…˜ì„ ì„ íƒí•´ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ì‚¬ì´íŠ¸ ë¶„ìŸ í•´ê²°ì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì—</strong><strong>&hellip;</strong></p>\r\n<p>ìœ ì € ë¶„ì˜ ë¬¸ì œë¥¼ ì›í™œí•˜ê²Œ í•´ê²°í•˜ê¸° ìœ„í•´ì„œëŠ” ë¨¼ì € í•´ë‹¹ ì‚¬ì´íŠ¸ ê·œì •ì— ìœ„ë°˜ëœ ë°°íŒ…ì„ í•˜ê±°ë‚˜ ë¬¸ì œê°€ ë ë§Œí•œ í–‰ìœ„ë¥¼ í•˜ì…¨ëŠ”ì§€ë¥¼ í™•ì¸í•˜ì…”ì•¼ í•©ë‹ˆë‹¤. í•´ë‹¹ ì‚¬ì´íŠ¸ ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê²Œ ëœ ê²°ì •ì ì¸ ì´ìœ ê°€ ë°˜ë“œì‹œ í•„ìš”í•˜ë©°, ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì— ì•„ëž˜ ì§ˆë¬¸ê³¼ ë‹µì„ í™•ì¸í•´ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ë§Œì•½ ì•…ì˜ì ìœ¼ë¡œ ë‚´ìš©ì„ ë¶€í’€ë¦¬ê±°ë‚˜ ì‚¬ì´íŠ¸ë¥¼ í˜‘ë°•í•˜ëŠ” ë‚´ìš©ì´ í¬í•¨ë˜ì—ˆì„ ê²½ìš°, í•´ë‹¹ íšŒì›ì€ ì œìž¬ ëŒ€ìƒìž…ë‹ˆë‹¤.</li>\r\n<li>ê¸€ ìž‘ì„±ì„ í•˜ì‹¤ ë•Œ, ì¦ê±°ìžë£Œë¥¼ ê°™ì´ ì œì¶œí•´ì£¼ì‹œë©´ í•´ê²°ì— ë§Žì€ ë„ì›€ì´ ë©ë‹ˆë‹¤.</li>\r\n<li>ì €í¬ ì‚¬ì´íŠ¸ì— ì—†ëŠ” ë°°íŒ…ì‚¬ì´íŠ¸ì— ëŒ€í•´ì„œëŠ” ë¶„ìŸ í•´ê²° ì‹ ì²­ì„ í•˜ì‹¤ ìˆ˜ ì—†ìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ìžì£¼ ë¬»ëŠ” ì§ˆë¬¸ ë° í•´ê²°ì•ˆ ì œì‹œ</strong></p>\r\n<p><strong>í•´ë‹¹ ì‚¬ì´íŠ¸ì—ì„œ ë¬¸ì œê°€ ë˜ëŠ” í–‰ìœ„ ë° ë¶€ì • ë°°íŒ…ì„ í•˜ì…¨ëŠ”ì§€ í™•ì¸ í•˜ì…¨ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ë§Žì€ ìœ ì €ë“¤ì´ í•´ë‹¹ ì‚¬ì´íŠ¸ì˜ ë°°íŒ… ê·œì • ë° ê³µì§€ì‚¬í•­ì„ ì½ì–´ë³´ì§€ ì•Šê³  ë°°íŒ…ì„ í•˜ì—¬ ì‹¤ìˆ˜</p>\r\n<p>ë¥¼ ë²”í•˜ê³¤ í•©ë‹ˆë‹¤. ë•Œë¬¸ì— ë§Œì•½ ì´ ë¬¸ì œì— ì†í•˜ì‹ ë‹¤ë©´, ë‹¤ì‹œ í•œë²ˆ í•´ë‹¹ ì‚¬ì´íŠ¸ì˜ ë°°íŒ… ê·œì • ë° ì‚¬ì´íŠ¸ ê·œì¹™ì„ ìˆ™ì§€í•˜ì‹œì–´ ì´ìš© ë¶€íƒë“œë¦¬ê² ìŠµë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>ë³´ë„ˆìŠ¤</p>', '2017-02-18 13:22:09'),
(5, 'ë³´ë„ˆìŠ¤ ì§€ë¶ˆ ê±°ì ˆ', '<p>ë§Žì€ ìœ ì € ë¶„ë“¤ì´ ë³´ë„ˆìŠ¤ë¥¼ ë°›ê¸° ì „ì— ë³´ë„ˆìŠ¤ ê·œì •ì„ í™•ì¸í•˜ì§€ ì•ŠìŠµë‹ˆë‹¤. í™•ì¸ì„ í• ë ¤ê³  í•´ë„ ìˆ¨ì–´ìžˆê±°ë‚˜ ë‚´ìš©ì´ ì–´ë µê²Œ ë˜ì–´ ìžˆëŠ” ê²½ìš°ê°€ ìžˆì–´ì„œ ì¶œê¸ˆì„ ì‹ ì²­í•  ë•Œ ë³´ë„ˆìŠ¤ ë•Œë¬¸ì— ì¶œê¸ˆì´ ê±°ì ˆë˜ê±°ë‚˜ ì§€ì—°ë˜ëŠ” ì¼ì´ ì¢…ì¢… ë°œìƒ í•©ë‹ˆë‹¤. ë³´ë„ˆìŠ¤ ê·œì • ì•ˆì—ëŠ” ë§ë„ ì•ˆë˜ëŠ” í„´ì˜¤ë²„ ì¡°ê±´ì´ ì¡´ìž¬í•  ìˆ˜ ìžˆìœ¼ë©°, ìœ ì €ì—ê²Œ ë¶ˆí•©ë¦¬í•œ ì¡°ê±´ë“¤ì´ ìˆ¨ì–´ ìžˆì„ ìˆ˜ ìžˆìŠµë‹ˆë‹¤. ê·¸ë ‡ê¸° ë•Œë¬¸ì— ìœ ì € ë¶„ë“¤ê»˜ì„œëŠ” ë³´ë„ˆìŠ¤ë¥¼ ë°›ê¸° ì „ì— í•´ë‹¹ ë³´ë„ˆìŠ¤ì˜ ê·œì •ì„ ì œëŒ€ë¡œ ì´í•´í•˜ê³  ë°›ìœ¼ì…”ì•¼ ë‚˜ì¤‘ì— ë¬¸ì œê°€ ìƒê¸°ì§€ ì•ŠìŠµë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ìœ ì € ë¶„ê»˜ì„œ ë¶ˆí•©ë¦¬í•œ ì¼ì„ ë‹¹í•˜ì‹œê¸° ì „ì— í•­ìƒ ë³´ë„ˆìŠ¤ ê·œì •ì„ ì‚´íŽ´ë³´ëŠ” ê²ƒì„ ê¶Œìœ  ë“œë¦½ë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ì‚¬ì´íŠ¸ ë¶„ìŸ í•´ê²°ì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì—</strong><strong>&hellip;</strong></p>\r\n<p>ìœ ì € ë¶„ì˜ ë¬¸ì œë¥¼ ì›í™œí•˜ê²Œ í•´ê²°í•˜ê¸° ìœ„í•´ì„œëŠ” ë¨¼ì € í•´ë‹¹ ì‚¬ì´íŠ¸ ê·œì •ì— ìœ„ë°˜ëœ ë°°íŒ…ì„ í•˜ê±°ë‚˜ ë¬¸ì œê°€ ë ë§Œí•œ í–‰ìœ„ë¥¼ í•˜ì…¨ëŠ”ì§€ë¥¼ í™•ì¸í•˜ì…”ì•¼ í•©ë‹ˆë‹¤. í•´ë‹¹ ì‚¬ì´íŠ¸ ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê²Œ ëœ ê²°ì •ì ì¸ ì´ìœ ê°€ ë°˜ë“œì‹œ í•„ìš”í•˜ë©°, ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì— ì•„ëž˜ ì§ˆë¬¸ê³¼ ë‹µì„ í™•ì¸í•´ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ë§Œì•½ ì•…ì˜ì ìœ¼ë¡œ ë‚´ìš©ì„ ë¶€í’€ë¦¬ê±°ë‚˜ ì‚¬ì´íŠ¸ë¥¼ í˜‘ë°•í•˜ëŠ” ë‚´ìš©ì´ í¬í•¨ë˜ì—ˆì„ ê²½ìš°, í•´ë‹¹ íšŒì›ì€ ì œìž¬ ëŒ€ìƒìž…ë‹ˆë‹¤.</li>\r\n<li>ê¸€ ìž‘ì„±ì„ í•˜ì‹¤ ë•Œ, ì¦ê±°ìžë£Œë¥¼ ê°™ì´ ì œì¶œí•´ì£¼ì‹œë©´ í•´ê²°ì— ë§Žì€ ë„ì›€ì´ ë©ë‹ˆë‹¤.</li>\r\n<li>ì €í¬ ì‚¬ì´íŠ¸ì— ì—†ëŠ” ë°°íŒ…ì‚¬ì´íŠ¸ì— ëŒ€í•´ì„œëŠ” ë¶„ìŸ í•´ê²° ì‹ ì²­ì„ í•˜ì‹¤ ìˆ˜ ì—†ìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ìžì£¼ ë¬»ëŠ” ì§ˆë¬¸ ë° í•´ê²°ì•ˆ ì œì‹œ</strong></p>\r\n<p><strong>ë³´ë„ˆìŠ¤ ì² íšŒê°€ ê±°ì ˆ ë‹¹í•˜ì…¨ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ë§Œì•½ ë³´ë„ˆìŠ¤ë¥¼ ë°›ê³  ë°°íŒ…ì„ í•˜ì…¨ë‹¤ë©´ ì² íšŒê°€ ê±°ì ˆë‹¹í•  ìˆ˜ ìžˆìŠµë‹ˆë‹¤. ë°°íŒ…ì„ í•œ ìˆœê°„,</p>\r\n<p>ì•”ë¬µì ìœ¼ë¡œ í•´ë‹¹ ë³´ë„ˆìŠ¤ ê·œì •ì— ë™ì˜ë¥¼ í•œ ê²ƒì´ê¸° ë•Œë¬¸ì— ì¶œê¸ˆ íŽ˜ì´ì§€ì—ì„œ &ldquo;ë³´ë„ˆìŠ¤ ì œì™¸&rdquo; ê¸°ëŠ¥ì´ ì—†ë‹¤ë©´ ë³´ë„ˆìŠ¤ ì² íšŒë¥¼ í•˜ê¸´ ì–´ë µìŠµë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>ë³´ë„ˆìŠ¤ë¥¼ ë‚¨ìš©í•˜ì…¨ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ë§Œì•½ ìœ ì € ë¶„ê»˜ì„œ ë™ì¼ ëŒ€ì—­ëŒ€ë¡œ ì—¬ëŸ¬ê°œì˜ ì•„ì´ë””ë¥¼ ìƒì„± í›„ ë³´ë„ˆìŠ¤ë¥¼ ë‚¨ìš©í•˜ì…¨ê±°ë‚˜ ì•…ìš©í•˜ì…¨ì„ ê²½ìš°, í•´ë‹¹ ì‚¬ì´íŠ¸ì—ì„œëŠ” ìœ ì € ë¶„ì„ ì œí•œí•  ê¶Œë¦¬ê°€ ìžˆìŠµë‹ˆë‹¤.</p>', '2017-02-18 13:22:25'),
(6, 'ë³´ë„ˆìŠ¤ ì§€ë¶ˆ ê±°ì ˆ', '<p>ì‚¬ì´íŠ¸ì˜ ê·œì •ì„ ì¤€ìˆ˜í•˜ë©° ì˜¬ë°”ë¥¸ ë°°íŒ…ì„ í–ˆìŒì—ë„ ë¶ˆêµ¬í•˜ê³ , ì ì¤‘ ê¸ˆì•¡ì„ ì¶œê¸ˆí•  ìˆ˜ ì—†ë‹¤ë©´ ì´ë³´ë‹¤ ë” ì–µìš¸í•œ ì¼ì€ ì—†ì„ ê²ƒìž…ë‹ˆë‹¤. ì¼ë¶€ ì‚¬ì´íŠ¸ì—ì„œëŠ” ìž¥ê¸°ê°„ ì´ìš©í•œ ìœ ì € ì¼ì§€ë¼ë„ ê°‘ìžê¸° ë§Žì€ ê¸ˆì•¡ì„ ë”°ë©´ ì•„ì´í”¼ë¥¼ ì°¨ë‹¨í•˜ê±°ë‚˜ ì¼ë¶€ë¡œ ì—°ë½ì„ ë¬´ì‹œí•˜ëŠ” í–‰ë™ì„ ì·¨í•˜ê³¤ í•©ë‹ˆë‹¤.ì´ëŸ¬í•œ ë¬¸ì œ ë•Œë¬¸ì— ì•ˆì „í•œ ì‚¬ì´íŠ¸ë¼ ë¯¿ê³  ì´ìš©í•œ ìœ ì €ë“¤ì´ í”¼í•´ë¥¼ ë³´ê³  ìžˆìœ¼ë©°, í˜„ìž¬ê¹Œì§€ë„ ì‹¬ê°í•œ ë¬¸ì œê°€ ë˜ê³  ìžˆìŠµë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ì‚¬ì´íŠ¸ ì •ì±…ì— ë”°ë¼ í•´ë‹¹ ê²½ê¸°ê°€ ì íŠ¹ ë° ì·¨ì†Œ ì²˜ë¦¬ê°€ ë  ìˆ˜ ìžˆìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ì‚¬ì´íŠ¸ ë¶„ìŸ í•´ê²°ì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì—</strong><strong>&hellip;</strong></p>\r\n<p>ìœ ì € ë¶„ì˜ ë¬¸ì œë¥¼ ì›í™œí•˜ê²Œ í•´ê²°í•˜ê¸° ìœ„í•´ì„œëŠ” ë¨¼ì € í•´ë‹¹ ì‚¬ì´íŠ¸ ê·œì •ì— ìœ„ë°˜ëœ ë°°íŒ…ì„ í•˜ê±°ë‚˜ ë¬¸ì œê°€ ë ë§Œí•œ í–‰ìœ„ë¥¼ í•˜ì…¨ëŠ”ì§€ë¥¼ í™•ì¸í•˜ì…”ì•¼ í•©ë‹ˆë‹¤. í•´ë‹¹ ì‚¬ì´íŠ¸ ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê²Œ ëœ ê²°ì •ì ì¸ ì´ìœ ê°€ ë°˜ë“œì‹œ í•„ìš”í•˜ë©°, ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì— ì•„ëž˜ ì§ˆë¬¸ê³¼ ë‹µì„ í™•ì¸í•´ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ë§Œì•½ ì•…ì˜ì ìœ¼ë¡œ ë‚´ìš©ì„ ë¶€í’€ë¦¬ê±°ë‚˜ ì‚¬ì´íŠ¸ë¥¼ í˜‘ë°•í•˜ëŠ” ë‚´ìš©ì´ í¬í•¨ë˜ì—ˆì„ ê²½ìš°, í•´ë‹¹ íšŒì›ì€ ì œìž¬ ëŒ€ìƒìž…ë‹ˆë‹¤.</li>\r\n<li>ê¸€ ìž‘ì„±ì„ í•˜ì‹¤ ë•Œ, ì¦ê±°ìžë£Œë¥¼ ê°™ì´ ì œì¶œí•´ì£¼ì‹œë©´ í•´ê²°ì— ë§Žì€ ë„ì›€ì´ ë©ë‹ˆë‹¤.</li>\r\n<li>ì €í¬ ì‚¬ì´íŠ¸ì— ì—†ëŠ” ë°°íŒ…ì‚¬ì´íŠ¸ì— ëŒ€í•´ì„œëŠ” ë¶„ìŸ í•´ê²° ì‹ ì²­ì„ í•˜ì‹¤ ìˆ˜ ì—†ìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ìžì£¼ ë¬»ëŠ” ì§ˆë¬¸ ë° í•´ê²°ì•ˆ ì œì‹œ</strong></p>\r\n<p><strong>í•´ë‹¹ ì‚¬ì´íŠ¸ì—ì„œ ë¬¸ì œê°€ ë˜ëŠ” í–‰ìœ„ ë° ë¶€ì • ë°°íŒ…ì„ í•˜ì…¨ëŠ”ì§€ í™•ì¸ í•˜ì…¨ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ë§Žì€ ìœ ì €ë“¤ì´ í•´ë‹¹ ì‚¬ì´íŠ¸ì˜ ë°°íŒ… ê·œì • ë° ê³µì§€ì‚¬í•­ì„ ì½ì–´ë³´ì§€ ì•Šê³  ë°°íŒ…ì„ í•˜ì—¬ ì‹¤ìˆ˜</p>\r\n<p>ë¥¼ ë²”í•˜ê³¤ í•©ë‹ˆë‹¤. ë•Œë¬¸ì— ë§Œì•½ ì´ ë¬¸ì œì— ì†í•˜ì‹ ë‹¤ë©´, ë‹¤ì‹œ í•œë²ˆ í•´ë‹¹ ì‚¬ì´íŠ¸ì˜ ë°°íŒ… ê·œì • ë° ì‚¬ì´íŠ¸ ê·œì¹™ì„ ìˆ™ì§€í•˜ì‹œì–´ ì´ìš© ë¶€íƒ ë“œë¦¬ê² ìŠµë‹ˆë‹¤.</p>', '2017-02-18 13:22:50'),
(7, 'ê³„ì • ìž ê¸ˆ', '<p>ì–‘ë°©ë°°íŒ…ì€ ì–‘ìª½ ëª¨ë‘ ë°°íŒ…í•˜ì—¬ ì°¨ì•¡ì„ ë¨¹ëŠ” ë°°íŒ…ë°©ë²•ì„ ë§í•©ë‹ˆë‹¤. ëŒ€ë¶€ë¶„ì˜ ì‚¬ì´íŠ¸ì—ì„œëŠ” ì–‘ë°©ë°°íŒ…ì„ ê¸ˆì§€í•˜ê³  ìžˆìœ¼ë©°, ìžì²´ì ìœ¼ë¡œ ì‚¬ì´íŠ¸ ê·œì •ì„ ë§Œë“¤ì–´ ì œìž¬í•˜ê³  ìžˆìŠµë‹ˆë‹¤. í•˜ì§€ë§Œ ì–‘ë°©ë°°íŒ…ì˜ ì¢…ë¥˜ëŠ” ì›Œë‚™ ë‹¤ì–‘í•˜ê¸° ë•Œë¬¸ì— ì‚¬ì´íŠ¸ì—ì„œ ëšœë ·í•œ ì¦ê±°ë¥¼ ë³´ì—¬ì¤„ ìˆ˜ ì—†ì„ ë•Œê°€ ì¢…ì¢… ìžˆìŠµë‹ˆë‹¤. ê·¸ëž˜ì„œ ì•…ì˜ì ì¸ ë§ˆìŒì„ ê°€ì§„ ìœ ì €ë“¤ì€ ìžì‹ ë“¤ì´ ê·œì • ìœ„ë°˜ì„ í–ˆìŒì—ë„ ë¶ˆêµ¬í•˜ê³  ë¨¹íŠ€ì‚¬ì´íŠ¸ë¡œ ì‹ ê³ ë¥¼ í•˜ê³¤ í•©ë‹ˆë‹¤. ê·¸ëŸ°ë° ë°˜ëŒ€ë¡œ ìžì‹ ì€ ì–‘ë°©ë°°íŒ…ì„ í•˜ì§€ ì•Šì•˜ìŒì—ë„ ì‚¬ì´íŠ¸ì˜ ì˜¤í•´ë¡œ ì¸í•´ ëª°ìˆ˜ ì²˜ë¦¬ë˜ëŠ” ê²½ìš°ë„ ìžˆìŠµë‹ˆë‹¤. í•´ë‹¹ ë¬¸ì œê°€ ì›í™œí•˜ê²Œ í•´ê²°ë˜ê¸° ìœ„í•´ì„  ì‚¬ì´íŠ¸ì—ì„œ í•´ë‹¹ ìœ ì €ê°€ ì–‘ë°© ìœ ì €ë¡œ ì˜ì‹¬ë  ê²½ìš°, ì„ ê²½ê³ ë¥¼ í•´ì¤„ ìˆ˜ ìžˆì–´ì•¼ í•©ë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ë§Œì•½ ì„ ê²½ê³ ë¥¼ ë°›ì•˜ìŒì—ë„ ì§€ì†ì ìœ¼ë¡œ ê·œì •ì— ì–´ê¸‹ë‚œ ë°°íŒ…ì„ í•˜ì—¬ ì œìž¬ë¥¼ ë‹¹í•˜ì…¨ì„ ê²½ìš°, í•´ë‹¹ ë¶€ë¶„ì˜ ì±…ìž„ì€ ìœ ì €ì—ê²Œ ìžˆìŒì„ ì•Œë ¤ë“œë¦½ë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ì‚¬ì´íŠ¸ ë¶„ìŸ í•´ê²°ì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì—</strong><strong>&hellip;</strong></p>\r\n<p>ìœ ì € ë¶„ì˜ ë¬¸ì œë¥¼ ì›í™œí•˜ê²Œ í•´ê²°í•˜ê¸° ìœ„í•´ì„œëŠ” ë¨¼ì € í•´ë‹¹ ì‚¬ì´íŠ¸ ê·œì •ì— ìœ„ë°˜ëœ ë°°íŒ…ì„ í•˜ê±°ë‚˜ ë¬¸ì œê°€ ë ë§Œí•œ í–‰ìœ„ë¥¼ í•˜ì…¨ëŠ”ì§€ë¥¼ í™•ì¸í•˜ì…”ì•¼ í•©ë‹ˆë‹¤. í•´ë‹¹ ì‚¬ì´íŠ¸ ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê²Œ ëœ ê²°ì •ì ì¸ ì´ìœ ê°€ ë°˜ë“œì‹œ í•„ìš”í•˜ë©°, ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì— ì•„ëž˜ ì§ˆë¬¸ê³¼ ë‹µì„ í™•ì¸í•´ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ë§Œì•½ ì•…ì˜ì ìœ¼ë¡œ ë‚´ìš©ì„ ë¶€í’€ë¦¬ê±°ë‚˜ ì‚¬ì´íŠ¸ë¥¼ í˜‘ë°•í•˜ëŠ” ë‚´ìš©ì´ í¬í•¨ë˜ì—ˆì„ ê²½ìš°, í•´ë‹¹ íšŒì›ì€ ì œìž¬ ëŒ€ìƒìž…ë‹ˆë‹¤.</li>\r\n<li>ê¸€ ìž‘ì„±ì„ í•˜ì‹¤ ë•Œ, ì¦ê±°ìžë£Œë¥¼ ê°™ì´ ì œì¶œí•´ì£¼ì‹œë©´ í•´ê²°ì— ë§Žì€ ë„ì›€ì´ ë©ë‹ˆë‹¤.</li>\r\n<li>ì €í¬ ì‚¬ì´íŠ¸ì— ì—†ëŠ” ë°°íŒ…ì‚¬ì´íŠ¸ì— ëŒ€í•´ì„œëŠ” ë¶„ìŸ í•´ê²° ì‹ ì²­ì„ í•˜ì‹¤ ìˆ˜ ì—†ìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ìžì£¼ ë¬»ëŠ” ì§ˆë¬¸ ë° í•´ê²°ì•ˆ ì œì‹œ</strong></p>\r\n<p><strong>í•´ë‹¹ ì‚¬ì´íŠ¸ì—ì„œ ë¬¸ì œê°€ ë˜ëŠ” í–‰ìœ„ ë° ë¶€ì • ë°°íŒ…ì„ í•˜ì…¨ëŠ”ì§€ í™•ì¸ í•˜ì…¨ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ë§Žì€ ìœ ì €ë“¤ì´ í•´ë‹¹ ì‚¬ì´íŠ¸ì˜ ë°°íŒ… ê·œì • ë° ê³µì§€ì‚¬í•­ì„ ì½ì–´ë³´ì§€ ì•Šê³  ë°°íŒ…ì„ í•˜ì—¬ ì‹¤ìˆ˜</p>\r\n<p>ë¥¼ ë²”í•˜ê³¤ í•©ë‹ˆë‹¤. ë•Œë¬¸ì— ë§Œì•½ ì´ ë¬¸ì œì— ì†í•˜ì‹ ë‹¤ë©´, ë‹¤ì‹œ í•œë²ˆ í•´ë‹¹ ì‚¬ì´íŠ¸ì˜ ë°°íŒ… ê·œì • ë° ì‚¬ì´íŠ¸ ê·œì¹™ì„ ìˆ™ì§€í•˜ì‹œì–´ ì´ìš© ë¶€íƒ ë“œë¦¬ê² ìŠµë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>ë³¸ì¸ì˜ ê²½ê¸°ê°€ ì„ ì íŠ¹ í˜¹ì€ í›„ì íŠ¹ì„ ë‹¹í•˜ì˜€ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; í•´ë‹¹ ë¬¸ì œëŠ” ê° ì‚¬ì´íŠ¸ì˜ ì •ì±…ì— ë”°ë¼ ê²°ê³¼ ì²˜ë¦¬ê°€ ë°”ë€” ìˆ˜ ìžˆìŠµë‹ˆë‹¤. ì˜ˆë¥¼ ë“¤ì–´ ë°°ë‹¹ ì˜¤ë¥˜ í˜¹ì€ ê²½ê¸°ëª…ì´ ìž˜ëª» ìž…ë ¥ëì„ ê²½ìš°, ì‚¬ì´íŠ¸ì˜ ì •ì±…ì— ë”°ë¼ ì íŠ¹ ë° ì·¨ì†Œ ì²˜ë¦¬ë  ìˆ˜ ìžˆìŠµë‹ˆë‹¤. ë˜í•œ ì–‘ë°©ë°°íŒ…ìœ¼ë¡œ ì„ ê²½ê³ ë¥¼ ë°›ì•˜ìŒì—ë„ ì§€ì†ì ìœ¼ë¡œ ë°°íŒ… í–ˆì„ ê²½ìš°, ì„ ì íŠ¹ í˜¹ì€ í›„ì íŠ¹ ì²˜ë¦¬ê°€ ë  ìˆ˜ë„ ìžˆìŒì„ ì•Œë ¤ë“œë¦½ë‹ˆë‹¤. ë³´ë‹¤ ì •í™•í•œ ì´ìœ ëŠ” í•´ë‹¹ ì‚¬ì´íŠ¸ ê³ ê°ì„¼í„°ë¥¼ í†µí•´ ì•ˆë‚´ ë°›ìœ¼ì‹¤ ìˆ˜ ìžˆìŠµë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>ê³„ì •</p>', '2017-02-18 13:23:05'),
(8, 'ì‚¬ì´íŠ¸ ê·œì • ìœ„ë°˜', '<p>ìžì‹ ì˜ ì•„ì´ë””ê°€ ì´ìœ ë„ ëª¨ë¥¸ ì±„ ì°¨ë‹¨ì´ ë˜ì—ˆë‹¤ë©´, ìš°ë¦¬ëŠ” ì–´ë”œ ê°€ì„œ ì´ ë¬¸ì œë¥¼ ê³µìœ í•˜ê³  ë”°ì§ˆ ìˆ˜ ìžˆì„ê¹Œìš”? ìš”ì¦˜ ë‚ ì—ë„ ê³„ì • ì°¨ë‹¨ ë° ì•„ì´í”¼ ì°¨ë‹¨ì€ í”í•œ ì¼ì´ ëìŠµë‹ˆë‹¤. ì–´ë– í•œ ë¶€ë¶„ ë•Œë¬¸ì— ì°¨ë‹¨ì´ ëëŠ”ì§€ ì•„ë¬´ ê²ƒë„ ì•Œì§€ ëª»í•œë‹¤ë©´ ë„ˆë¬´ë‚˜ ì–µìš¸í•  ê²ƒìž…ë‹ˆë‹¤. ì‚¬ì´íŠ¸ì—ì„œëŠ” í•´ë‹¹ ìœ ì €ê°€ ì–´ë– í•œ ë¬¸ì œ ë•Œë¬¸ì— ê³„ì •ì´ ì°¨ë‹¨ ë˜ì—ˆëŠ”ì§€ ë§í•´ì¤„ ìˆ˜ ìžˆì–´ì•¼ í•©ë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ì‚¬ì´íŠ¸ ê·œì •ì— ë”°ë¼ ì¼ë°©ì ì¸ í†µë³´ê°€ ìžˆì„ ìˆ˜ ìžˆìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ì‚¬ì´íŠ¸ ë¶„ìŸ í•´ê²°ì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì—</strong><strong>&hellip;</strong></p>\r\n<p>ìœ ì € ë¶„ì˜ ë¬¸ì œë¥¼ ì›í™œí•˜ê²Œ í•´ê²°í•˜ê¸° ìœ„í•´ì„œëŠ” ë¨¼ì € í•´ë‹¹ ì‚¬ì´íŠ¸ ê·œì •ì— ìœ„ë°˜ëœ ë°°íŒ…ì„ í•˜ê±°ë‚˜ ë¬¸ì œê°€ ë ë§Œí•œ í–‰ìœ„ë¥¼ í•˜ì…¨ëŠ”ì§€ë¥¼ í™•ì¸í•˜ì…”ì•¼ í•©ë‹ˆë‹¤. í•´ë‹¹ ì‚¬ì´íŠ¸ ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê²Œ ëœ ê²°ì •ì ì¸ ì´ìœ ê°€ ë°˜ë“œì‹œ í•„ìš”í•˜ë©°, ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì— ì•„ëž˜ ì§ˆë¬¸ê³¼ ë‹µì„ í™•ì¸í•´ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ë§Œì•½ ì•…ì˜ì ìœ¼ë¡œ ë‚´ìš©ì„ ë¶€í’€ë¦¬ê±°ë‚˜ ì‚¬ì´íŠ¸ë¥¼ í˜‘ë°•í•˜ëŠ” ë‚´ìš©ì´ í¬í•¨ë˜ì—ˆì„ ê²½ìš°, í•´ë‹¹ íšŒì›ì€ ì œìž¬ ëŒ€ìƒìž…ë‹ˆë‹¤.</li>\r\n<li>ê¸€ ìž‘ì„±ì„ í•˜ì‹¤ ë•Œ, ì¦ê±°ìžë£Œë¥¼ ê°™ì´ ì œì¶œí•´ì£¼ì‹œë©´ í•´ê²°ì— ë§Žì€ ë„ì›€ì´ ë©ë‹ˆë‹¤.</li>\r\n<li>ì €í¬ ì‚¬ì´íŠ¸ì— ì—†ëŠ” ë°°íŒ…ì‚¬ì´íŠ¸ì— ëŒ€í•´ì„œëŠ” ë¶„ìŸ í•´ê²° ì‹ ì²­ì„ í•˜ì‹¤ ìˆ˜ ì—†ìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ìžì£¼ ë¬»ëŠ” ì§ˆë¬¸ ë° í•´ê²°ì•ˆ ì œì‹œ</strong></p>\r\n<p><strong>ì‚¬ì´íŠ¸ ê·œì •ì„ ì–´ê¸°ì…¨ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; í•´ë‹¹ ì‚¬ì´íŠ¸ì—ì„œ ë¬¸ì œê°€ ë˜ëŠ” í–‰ìœ„ë¥¼ í•˜ì…¨ë‹¤ë©´, ì‚¬ì´íŠ¸ ê·œì • ìœ„ë°˜ìœ¼ë¡œ ê²½ê³  ì—†ì´ ì¼ë°©ì ì¸ í†µë³´ë¥¼ ì „ë‹¬ ë°›ì„ ìˆ˜ ìžˆìŠµë‹ˆë‹¤. ë•Œë¬¸ì— ëŒ€í™”ë¥¼ í†µí•´ ì›ê¸ˆì´ë¼ë„ ëŒë ¤ë°›ìœ¼ì‹œê¸¸ ê¸°ì›í•˜ê² ìŠµë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>ì¶œê¸ˆ ì‹ ì²­ì„ í–ˆëŠ”ë° ëª‡ ì‹œê°„ í›„ì— ì°¨ë‹¨ì´ ë˜ì…¨ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ë§Œì•½ ì–´ë– í•œ ì´ìœ ë„ ì•Œì§€ ëª»í•œ ì±„ ê°‘ìžê¸° ì°¨ë‹¨ ë˜ê±°ë‚˜ ì‚¬ì´íŠ¸ ê·œì •ì—ë„ ì—†ëŠ” ë§ì„ ì§€ì–´ë‚´ë©° ë„ë¬´ì§€ ì´í•´í•  ìˆ˜ ì—†ëŠ” ë§ì„ í•œë‹¤ë©´, í•´ë‹¹ ì‚¬ì´íŠ¸ëŠ” ìœ ì €ë¥¼ ê¸°ë§Œí•˜ëŠ” ì‚¬ì´íŠ¸ìž…ë‹ˆë‹¤. ì´ëŠ” ì •ìƒì ì¸ ì‚¬ì´íŠ¸ê°€ ì•„ë‹˜ìœ¼ë¡œ í•´ë‹¹ ì‚¬ì´íŠ¸ë¥¼ ê¼­ ì‹ ê³ í•´ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>ê¸°íƒ€</p>', '2017-02-18 13:23:20'),
(9, 'ê¸°íƒ€', '<p>* í•´ë‹¹ í•­ëª©ì€ ì´íŒ ë¶„ë“¤ì„ ìœ„í•œ ê²ƒìž…ë‹ˆë‹¤. ì¼ë°˜ ìœ ì € ë¶„ë“¤ê»˜ì„œëŠ” ë‹¤ë¥¸ í•­ëª©ì„ ì´ìš©í•´ì£¼ì„¸ìš”.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ì°¾ìœ¼ì‹œëŠ” í•­ëª©ì´ ì—†ìœ¼ì‹¤ ê²½ìš°, ë©”ì„¸ì§€ë¥¼ ë‚¨ê²¨ì£¼ì‹œë©´ ê²€í†  í›„ì— ì¶”ê°€í•˜ë„ë¡ í•˜ê² ìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong>ì‚¬ì´íŠ¸ ë¶„ìŸ í•´ê²°ì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì—</strong><strong>&hellip;</strong></p>\r\n<p>ìœ ì € ë¶„ì˜ ë¬¸ì œë¥¼ ì›í™œí•˜ê²Œ í•´ê²°í•˜ê¸° ìœ„í•´ì„œëŠ” ë¨¼ì € í•´ë‹¹ ì‚¬ì´íŠ¸ ê·œì •ì— ìœ„ë°˜ëœ ë°°íŒ…ì„ í•˜ê±°ë‚˜ ë¬¸ì œê°€ ë ë§Œí•œ í–‰ìœ„ë¥¼ í•˜ì…¨ëŠ”ì§€ë¥¼ í™•ì¸í•˜ì…”ì•¼ í•©ë‹ˆë‹¤. í•´ë‹¹ ì‚¬ì´íŠ¸ ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê²Œ ëœ ê²°ì •ì ì¸ ì´ìœ ê°€ ë°˜ë“œì‹œ í•„ìš”í•˜ë©°, ë¶„ìŸì„ ì‹ ì²­í•˜ì‹œê¸° ì „ì— ì•„ëž˜ ì§ˆë¬¸ê³¼ ë‹µì„ í™•ì¸í•´ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>ë§Œì•½ ì•…ì˜ì ìœ¼ë¡œ ë‚´ìš©ì„ ë¶€í’€ë¦¬ê±°ë‚˜ ì‚¬ì´íŠ¸ë¥¼ í˜‘ë°•í•˜ëŠ” ë‚´ìš©ì´ í¬í•¨ë˜ì—ˆì„ ê²½ìš°, í•´ë‹¹ íšŒì›ì€ ì œìž¬ ëŒ€ìƒìž…ë‹ˆë‹¤.</li>\r\n<li>ê¸€ ìž‘ì„±ì„ í•˜ì‹¤ ë•Œ, ì¦ê±°ìžë£Œë¥¼ ê°™ì´ ì œì¶œí•´ì£¼ì‹œë©´ í•´ê²°ì— ë§Žì€ ë„ì›€ì´ ë©ë‹ˆë‹¤.</li>\r\n<li>ì €í¬ ì‚¬ì´íŠ¸ì— ì—†ëŠ” ë°°íŒ…ì‚¬ì´íŠ¸ì— ëŒ€í•´ì„œëŠ” ë¶„ìŸ í•´ê²° ì‹ ì²­ì„ í•˜ì‹¤ ìˆ˜ ì—†ìŠµë‹ˆë‹¤.</li>\r\n</ul>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>ìžì£¼ ë¬»ëŠ” ì§ˆë¬¸ ë° í•´ê²°ì•ˆ ì œì‹œ</strong></p>\r\n<p><strong>í•´ë‹¹ ì‚¬ì´íŠ¸ì—ì„œ ë¬¸ì œê°€ ë˜ëŠ” í–‰ìœ„ ë° ë¶€ì • ë°°íŒ…ì„ í•˜ì…¨ëŠ”ì§€ í™•ì¸ í•˜ì…¨ë‚˜ìš”</strong><strong>? (drop box)</strong></p>\r\n<p>-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ë§Žì€ ìœ ì €ë“¤</p>', '2017-02-18 13:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `tblComplaints`
--

CREATE TABLE `tblComplaints` (
  `id` int(11) UNSIGNED NOT NULL,
  `userId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `siteName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `complaintTitle` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `complaintText` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(150) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `complaintFiles` mediumtext COLLATE utf8_unicode_ci,
  `onSiteAccountName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `onSiteEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isVerified` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `status` enum('P','S','U') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'P',
  `checkUser` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checksiteAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `statusText` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblComplaints`
--

INSERT INTO `tblComplaints` (`id`, `userId`, `siteName`, `link`, `reason`, `complaintTitle`, `complaintText`, `amount`, `complaintFiles`, `onSiteAccountName`, `onSiteEmail`, `isVerified`, `status`, `checkUser`, `checkAdmin`, `checksiteAdmin`, `statusText`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, '3', 'crystal Casino', 'www.google.com', 'ìž…ì¶œê¸ˆ ì§€ì—°', 'Unjustified confiscation of 2799e and account closure', 'Hello. I played a bonus on askgambler. When i was done i took very long time to get my payment. It was a totally withdraw of 2799.', '2799', NULL, 'CortesRico', 'admin@test.com', 'Y', 'U', 'N', 'Y', 'N', 'Need more time', '0000-00-00 00:00:00', 3, 3, '2018-01-27 21:16:50'),
(2, '3', 'crystal Casino', 'www.google.com', 'ìž…ì¶œê¸ˆ ì§€ì—°', 'Unjustified confiscation of 2799e and account closure', 'Hello. I played a bonus on crystal casino. When i was done i took very long time to get my payment. It was a totally withdraw of 2799.', '2799', NULL, 'CortesRico', 'admin@test.com', 'Y', 'U', 'N', 'Y', 'N', 'Need to investigate more', '0000-00-00 00:00:00', 3, 3, '2017-02-07 14:33:35'),
(3, '3', 'crystal Casino', 'www.google.com', 'ìž…ì¶œê¸ˆ ì§€ì—°', 'Unjustified confiscation of 2799e and account closure', 'Hello. I played a bonus on 24Bettle. When i was done i took very long time to get my payment. It was a totally withdraw of 2799.', '2799', NULL, 'CortesRico', 'admin@test.com', 'Y', 'P', 'N', 'Y', 'N', 'Waiting for response', '0000-00-00 00:00:00', 3, 3, '2018-01-22 15:28:28'),
(4, '3', 'crystal Casino', 'www.google.com', 'ìž…ì¶œê¸ˆ ì§€ì—°', 'Unjustified confiscation of 2799e and account closure', 'Hello. I played a bonus on 24Bettle. When i was done i took very long time to get my payment. It was a totally withdraw of 2799.', '2799', NULL, 'CortesRico', 'admin@test.com', 'Y', 'U', 'N', 'Y', 'N', 'Need more time', '0000-00-00 00:00:00', 3, 3, '2018-01-27 17:53:11'),
(5, '22', 'Betting ways', 'http://bettingways.com', 'ìž…ì¶œê¸ˆ ì§€ì—°', 'Unfair confiscation based on ridiculous reason', 'Got some situation on chance hill casino what made me very disappointed', '450', NULL, 'vip123', 'test@gmail.com', 'Y', 'S', 'N', 'Y', 'Y', 'Congratulation!!!!', '0000-00-00 00:00:00', 1, 1, '2018-01-22 15:28:49'),
(6, '1', 'Askgambler', 'http://bettingways.com', 'ë³´ë„ˆìŠ¤ ì² íšŒ ê±°ì ˆ', 'Test Title', 'this is test complaint', '1300', NULL, 'Bunny34', 'test@gmail.com', 'Y', 'P', 'N', 'Y', 'N', '', '0000-00-00 00:00:00', 1, 1, '2018-01-22 15:26:13'),
(7, '1', 'Betting ways', 'http://bettingways.com', 'ê¸°íƒ€', 'Test Title one', 'this is also test for complaint', '2500', NULL, 'Bunny34', 'test@gmail.com', 'N', 'P', 'N', 'Y', 'Y', '', '0000-00-00 00:00:00', 1, 1, '2017-02-18 16:26:07'),
(8, '22', 'royal casino', 'www.google.com', 'ë³´ë„ˆìŠ¤ ì² íšŒ ê±°ì ˆ', 'Test Title two', 'one more test', '2500', NULL, 'Bunny34', 'test@gmail.com', 'Y', 'P', 'N', 'Y', 'Y', '', '0000-00-00 00:00:00', 1, 1, '2018-01-28 08:49:56'),
(9, '1', 'Askgambler', 'http://bettingways.com', 'ìž…ì¶œê¸ˆ ì§€ì—°', 'Test Title Last', 'this is the last submit complaint test', '263', NULL, 'Bunny34', 'test@gmail.com', 'Y', 'P', 'N', 'Y', 'N', 'Due to inactive sports', '0000-00-00 00:00:00', 1, 1, '2017-02-07 14:34:06'),
(16, '22', 'royal casino', 'www.google.com', 'ìž…ì¶œê¸ˆ ê±°ì ˆ', 'Test Title', 'dasfsdfsdfsdf', '2500', 'http://localhost/_gambling/your-project/images/complaint/Ergomedia-Airspan-Big3.jpg', 'Bunny34', 'test@gmail.com', 'Y', 'U', 'N', 'Y', 'Y', 'Need more time', '0000-00-00 00:00:00', 1, 1, '2018-01-28 08:05:08'),
(17, '1', 'Drake Casino', 'http://www.drakecasino.eu', 'ìž…ì¶œê¸ˆ ì§€ì—°', 'Where&#039;s my money?', 'So I deposited Â£10 on two occasions. Went onto online roulette, lost my first Â£10 so deposited another 10 which I got to Â£220. When I went to withdraw this cash it did not allow me. Went back to my main screen to see that I was left with Â£67. How? I bet with my own money, nothing was given to me to make my stakes any higher. Was given nothing. Netbet you have very poor customer services as you never pick the phone. I want to know what has happen?', '153', NULL, 'Kayd187', 'admin@test.com', 'Y', 'P', 'N', 'Y', 'N', '', '0000-00-00 00:00:00', 1, 1, '2017-02-07 14:41:05'),
(18, '1', 'ì•ˆì „í•œë†€ì´í„°', 'www.gogl.com', 'ìž…ì¶œê¸ˆ ê±°ì ˆ', '500ë§Œì› ë¨¹íŠ€ë‹¹í–ˆìŠµë‹ˆë‹¤.', 'ì§€ë‚œ 5ì›”21ì¼ì— í‰í™”ë¡­ê²Œ ê²Œìž„ì„ í•˜ë˜ ë„ì¤‘ì— ì¶œê¸ˆ ì‹ ì²­ì„ í–ˆìœ¼ë‚˜ ë¨¹íŠ€ë¥¼ ë‹¹í–ˆìŠµë‹ˆë‹¤. ì €ë„ ì™œê·¸ëŸ°ì§€ëŠ” ìž˜ ëª¨ë¥´ê² ëŠ”ë° ì´ ì”¨ë°œìƒˆë¼ë“¤ì´ ì œ ëˆì„ ë¨¹íŠ€í•˜ê³  ì—°ë½ì´ ì•ˆë˜ëŠ” ê±¸ í™•ì¸í–ˆìŠµë‹ˆë‹¤. ì–´ë–»ê²Œí•˜ë©´ ì´ ì”¨ë°œ ìƒˆë¼ë“¤ì„ ì¡°ì§ˆ ìˆ˜ ìžˆì„ê¹Œìš”? ë‚´ ëˆ ë‚´ë†“ìœ¼ì„¸ìš” ê°œìƒˆë¼ë“¤ì•„!!!!!!', '100', '[\"images/complaint/20170328_856065.jpg\"]', 'tip', 'awef@gmail.com', 'Y', 'P', 'N', 'Y', 'N', '', '0000-00-00 00:00:00', 1, 1, '2018-01-27 06:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `tblComplaintsResponse`
--

CREATE TABLE `tblComplaintsResponse` (
  `id` int(11) UNSIGNED NOT NULL,
  `complaintId` int(11) UNSIGNED NOT NULL,
  `userId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `siteName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `responsText` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `responsFiles` mediumtext COLLATE utf8_unicode_ci,
  `isVerified` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkUser` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checksiteAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblComplaintsResponse`
--

INSERT INTO `tblComplaintsResponse` (`id`, `complaintId`, `userId`, `siteName`, `responsText`, `responsFiles`, `isVerified`, `checkUser`, `checkAdmin`, `checksiteAdmin`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, 1, '23', 'crystal Casino', '<p>24Bettle Casino requests more time to investigate this case.</p>', NULL, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-06-07 20:33:15'),
(2, 1, '23', 'crystal Casino', '<p>Hello there,<br /> <br /> Please allow us some more of your patience.<br /> At this moment we are gathering all relevant information and proves regarding this complaint which will be provided directly to the Askgamblers Team soon.</p>', NULL, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-06-07 20:37:22'),
(3, 2, '23', 'crystal Casino', '<p>Hello. I played a bonus on 24Bettle. When i was done i took very long time to get my payment. It was a totally withdraw of 2799.</p>', NULL, 'N', 'N', 'Y', 'N', '0000-00-00 00:00:00', 2, 3, '2016-06-07 21:56:08'),
(4, 1, '3', 'royal casino', 'Please response to corectly', NULL, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-06-23 10:53:50'),
(5, 16, '3', 'royal casino', '&lt;p&gt;dfsdfsdf&#039;s&lt;/p&gt;', NULL, 'Y', 'Y', 'Y', 'Y', '0000-00-00 00:00:00', 3, 3, '2016-06-30 07:20:34'),
(6, 16, '3', 'royal casino', 'test', NULL, 'Y', 'Y', 'Y', 'Y', '0000-00-00 00:00:00', 3, 3, '2016-06-30 07:23:06'),
(7, 5, '1', 'Betting Time Admin', 'Thank You for solving my problem', NULL, 'Y', 'Y', 'Y', 'Y', '0000-00-00 00:00:00', 22, 22, '2017-02-07 12:20:36'),
(8, 5, '1', 'Betting Time Admin', 'Thank You once again', NULL, 'Y', 'Y', 'Y', 'Y', '0000-00-00 00:00:00', 22, 22, '2017-02-07 12:20:42'),
(9, 5, '24', 'Betting ways', 'You are Welcome!!!', NULL, 'Y', 'Y', 'Y', 'Y', '0000-00-00 00:00:00', 24, 24, '2016-07-05 07:56:03'),
(12, 5, '1', 'Betting Time Admin', 'Thank you guys for using my portal', NULL, 'Y', 'Y', 'Y', 'Y', '0000-00-00 00:00:00', 0, 0, '2016-07-05 09:35:36'),
(13, 16, '1', 'Betting Time Admin', 'test', NULL, 'Y', 'Y', 'N', 'Y', '0000-00-00 00:00:00', 1, 1, '2018-01-28 08:05:08'),
(14, 16, '', 'royal casino', 'hello', '[]', 'N', 'N', 'N', 'Y', '0000-00-00 00:00:00', 3, 3, '2018-01-27 12:56:55'),
(15, 16, '', 'royal casino', 'hello', '[]', 'N', 'N', 'N', 'Y', '0000-00-00 00:00:00', 3, 3, '2018-01-27 12:59:25'),
(16, 8, '', 'royal casino', 'hello', '[]', 'N', 'N', 'N', 'Y', '0000-00-00 00:00:00', 3, 3, '2018-01-27 13:23:46'),
(17, 16, '', 'royal casino', 'hello', '[]', 'N', 'N', 'N', 'Y', '0000-00-00 00:00:00', 3, 3, '2018-01-27 13:29:42'),
(18, 16, '', 'royal casino', 'hello', '[]', 'N', 'N', 'N', 'Y', '0000-00-00 00:00:00', 3, 3, '2018-01-27 13:36:17');

-- --------------------------------------------------------

--
-- Table structure for table `tblContent`
--

CREATE TABLE `tblContent` (
  `id` int(11) UNSIGNED NOT NULL,
  `categoryPage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categoryTitle` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `categoryContent` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblContent`
--

INSERT INTO `tblContent` (`id`, `categoryPage`, `categoryTitle`, `categoryContent`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, 'sports', 'Livebetting Sports', '<p>here&nbsp;Livebetting Sports&nbsp;</p>', '0000-00-00 00:00:00', 1, 1, '2018-01-28 12:55:29'),
(3, 'Newest sport', 'Newest Sport', '<p>This page contain Newest Sport</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:25:33'),
(4, 'Verified sport', 'Verified Sport', '<p>This page contain Verified Sport</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:25:55'),
(5, 'Bitcoin sport', 'Bitcoin Sport', '<p>This page contain Bitcoin Sport</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:26:26'),
(6, 'Mobile sport', 'Mobile sport', '<p>This page contain Mobile Sport</p>', '0000-00-00 00:00:00', 1, 1, '2018-01-28 09:29:12'),
(7, 'Sadari sport', 'Sadari Sport', '<p>This page contain Sadari Sport</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:27:06'),
(8, 'bonus', 'Bonus', '<p>This page contain Bonus Cards</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:28:06'),
(9, 'Welcome Bonus', 'Wecome Bonus', '<p>This Page contain Welcome Bonus Cards</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:28:52'),
(10, 'First Deposite Bonus', 'Firest Deposite Bonus', '<p>This Page contain Firest Deposite Bonus</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:29:21'),
(11, 'Every Time Bonus', 'Every Time Bonus', '<p>This page contain Every time Bonus</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:30:22'),
(12, 'Rolling Bonus', 'Rolling Bonus', '<p>Rolling Bonus</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:30:45'),
(13, 'Free Money', 'Free Money', '<p>Free Money</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:31:01'),
(14, 'Combo Bonus', 'Combo Bonus', '<p>This page contain Combo Bonus</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:31:24'),
(15, 'Rebate Bonus', 'Rebate Bonus', '<p>This page contain Rebate Bonus</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:31:48'),
(16, 'Other Bonus', 'Other Bonus', '<p>Other Bonus</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:32:12'),
(17, 'N', 'News', '<p>News</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:32:37'),
(18, 'B', '테스트', '<p>테스트</p>', '0000-00-00 00:00:00', 1, 1, '2018-01-23 22:43:25'),
(19, 'complaint', 'Complaint', '<p>This is Complaint Page Listing</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:33:46'),
(20, 'contact', 'Contact Us', '<h2 style=\"text-align: center;\"><span style=\"text-decoration: underline;\"><strong>How can we help you?</strong></span></h2>\r\n<h2>Ways to contact us</h2>\r\n<p>Send us an email and we&rsquo;ll get back to you shortly.</p>\r\n<p>Support: <a href=\"mailto:support@askgamblers.com\">support@sportstimbetting.com</a><a href=\"mailto:marketing@askgamblers.com\"><br /></a>Partnerships: <a href=\"mailto:affiliate@askgamblers.com\">affiliate@</a><a href=\"mailto:support@askgamblers.com\">sportstimbetting</a><a href=\"mailto:affiliate@askgamblers.com\">.com<br /></a>Finance: <a href=\"mailto:finance@askgamblers.com\">finance@</a><a href=\"mailto:support@askgamblers.com\">sportstimbetting</a><a href=\"mailto:finance@askgamblers.com\">.com<br /></a>Sales: <a href=\"mailto:sales@askgamblers.com\">sales@</a><a href=\"mailto:support@askgamblers.com\">sportstimbetting</a><a href=\"mailto:sales@askgamblers.com\">.com</a></p>\r\n<p>Please visit our <a href=\"http://support.askgamblers.com/\">Support Center</a> for issues or <a>submit</a> a support request.</p>\r\n<p>If you have any specific inquiries, or would like to talk with an <a href=\"mailto:support@askgamblers.com\">Sportstimbetting</a> support representative, we are available over <a href=\"https://secure.livechatinc.com/licence/2005061/open_chat.cgi?groups=0\">live chat</a>.</p>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:37:26'),
(21, 'privacy Policy', 'Privacy Policy', '<div class=\"row wrapper narrow\">\r\n<div class=\"large-12 small-12 columns\">\r\n<div class=\"complaint-guidelines term-lists\">\r\n<h4>General Policy and Information</h4>\r\n<ul class=\"list\">\r\n<li>AskGamblers.com collect your personal information when you use our services.</li>\r\n<li>AskGamblers.com uses information for several purposes: â€¨- customizing ads â€¨- fulfilling your requests â€¨- improving our services â€¨- contact you â€¨- perform research â€¨- unnamed reporting for various clients.</li>\r\n<li>Internet users under 18 years are not allowed to register with AskGamblers.com.</li>\r\n<li>Any user can, at any time, change his AskGamblers.com account data.</li>\r\n<li>AskGamblers.com user can ask that we de-activate or delete his account. AskGamblers.com can retain information regarding de-activated and deleted accounts in AskGamblers.com information archives.</li>\r\n<li>If you do not want to receive any email from AskGamblers.com in the future, please <a href=\"http://www.askgamblers.com/contact\">contact us</a>.</li>\r\n</ul>\r\n<h4>Disclosure</h4>\r\n<p>AskGamblers.com gives personal information, only with your permission, or under the following exceptions:â€¨</p>\r\n<ul class=\"list\">\r\n<li>We provide the information to trusted companies, under confidentiality agreements. These companies do not have any autonomous right to distribute this information.</li>\r\n<li>Court orders, legal process or else required by law.</li>\r\n<li>Users information will be transferred if AskGamblers.com is acquired by or merged with another company. In this case, AskGamblers.com will inform users before personal information becomes subject to a different privacy policy.</li>\r\n<li>AskGamblers.com runs targeted advertisements based on users personal information. By interacting with or viewing an ad you are accepting the possibility that the advertiser will make the assumption that you meet the targeting criteria used to display the ad.</li>\r\n</ul>\r\n<h4>Confidentiality</h4>\r\n<ul class=\"list\">\r\n<li>AskGamblers.com limit access to personal information about users to employees who we believe reasonably need to come into contact with that information to provide services, in order to do their jobs.</li>\r\n<li>AskGamblers.com all required safeguards that act in accordance with with regulations to protect personal information.</li>\r\n<li>AskGamblers.com Account Information is completely password-protected.</li>\r\n</ul>\r\n<h4>Changes to this Privacy Policy</h4>\r\n<ul class=\"list\">\r\n<li>AskGamblers.com can change Privacy Policy. We will notify our users about important changes by placing a prominent notice on our site.</li>\r\n</ul>\r\n<h4>Content Condition</h4>\r\n<ul class=\"list\">\r\n<li>AskGamblers.com does not warrant that the content herein is accurate.</li>\r\n<li>Users responsibility is, to validate information before taking action on it.</li>\r\n<li>AskGamblers.com reserves the right to adjust information contained within this site without prior notice.</li>\r\n<li>Some services are subject to regulatory or other restrictions and are not available in all markets.</li>\r\n</ul>\r\n<h4>Security</h4>\r\n<ul class=\"list\">\r\n<li>AskGamblers.com has adequate security procedures in place in our physical IT facilities to protect against the loss, misuse or alteration of information that we have collected from users at our site.</li>\r\n</ul>\r\n<h4>Complaint Section</h4>\r\n<ul class=\"list\">\r\n<li>AskGamblers.com does not give advises on how to solve problems between players and online gambling Companies.</li>\r\n<li>Our mission is to provide Fair Games within gambling industry.</li>\r\n<li>AskGamblers.com helps to establish good and quality communication between sides in order to finish all disputes as fast as possible.</li>\r\n<li>AskGamblers.com do not charge this process and any side cannot pay it. There is no money being processed through AskGamblers.com between Players or Companies regarding to Complaint section (feature).</li>\r\n</ul>\r\n<h4>Submit your site</h4>\r\n<ul class=\"list\">\r\n<li>The cost to submit your web site to be included in the AskGamblers list depends of chosen package.</li>\r\n<li>Once we have successfully received payment your web site will be reviewed and published to the AskGamblers list within 3 business days.</li>\r\n<li>If your site does not meet the above guidelines you will recieve a full Moneybookers (only) refund and your website will not be published to the list.</li>\r\n<li>All fees are added on top of current commission.</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>', '0000-00-00 00:00:00', 0, 0, '2016-06-09 09:38:13'),
(22, 'Online sport', 'this is online sports', '<p>lorem ipsum its a dummy text for testing</p>', '0000-00-00 00:00:00', 1, 1, '2016-06-10 09:48:39'),
(23, 'terms and condition', 'Terms and Condition', '<p>&nbsp;</p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>\r\n<div>\r\n<h2>Where can I get some?</h2>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#039;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#039;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n</div>', '0000-00-00 00:00:00', 1, 1, '2017-04-09 13:48:38'),
(24, 'certificate of trust', 'Certificate of trust', '<p>&nbsp;</p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>\r\n<div>\r\n<h2>Where can I get some?</h2>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#039;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#039;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n</div>', '0000-00-00 00:00:00', 1, 1, '2017-04-09 13:49:42'),
(25, 'posting guidlince', 'Posting Guidlinces', '<p>&nbsp;</p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>\r\n<div>\r\n<h2>Where can I get some?</h2>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#039;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#039;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n</div>', '0000-00-00 00:00:00', 1, 1, '2017-04-09 13:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `tblFilter`
--

CREATE TABLE `tblFilter` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `display` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblFilter`
--

INSERT INTO `tblFilter` (`id`, `name`, `value`, `display`) VALUES
(13, 'mini-game', 'Power ball', 'Y'),
(14, 'mini-game', 'pinball', 'Y'),
(18, 'mini-game', 'Spin', 'Y'),
(31, 'betting-option', 'Each Way', 'Y'),
(32, 'betting-option', 'First half bet', 'Y'),
(34, 'betting-option', '안녕하세요.', 'Y'),
(35, 'betting-option', '안녕하세요.', 'Y'),
(36, 'betting-option', '안녕하세요.', 'Y'),
(37, 'betting-option', '안녕하세요. 반갑습니다.', 'Y'),
(39, 'betting-option', '안녕하세요. 반갑습니다.', 'Y'),
(42, 'mini-game', 'test', 'Y'),
(43, 'mini-game', 'test', 'Y'),
(44, 'mini-game', 'testefwfa', 'Y'),
(45, 'mini-game', 'weffe', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tblNewsBlog`
--

CREATE TABLE `tblNewsBlog` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `newsDesc` mediumtext COLLATE utf8_unicode_ci,
  `newsImage` mediumtext COLLATE utf8_unicode_ci,
  `newsImageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isNews` enum('B','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblNewsBlog`
--

INSERT INTO `tblNewsBlog` (`id`, `title`, `author`, `newsDesc`, `newsImage`, `newsImageName`, `isNews`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(3, 'Summer Cruise anirban', 'Anirban', '<p>Ever fancied just packing up your stuff and getting away for the summer? When you play at <a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/online-casinos/vegas-crest-casino-casino-review/\" data-name=\"Vegas Crest Casino\" data-url=\"/online-casinos/vegas-crest-casino-casino-review/\" data-logo=\"/uploads/casino-logos/vegas-crest-casino-539ee4bc70a0f871478b4569.png\" data-rating=\"5.63\" data-visit-url=\"/visit/vegas-crest-casino-casino-casino-review\">Vegas Crest Casino</a>&nbsp;over the next few weeks you could be doing just that with their <strong>Summer Cruise Giveaway</strong>.</p>\r\n<h2>Set sail on a Summer Cruise</h2>\r\n<p>With summer just around the corner the <a class=\"internal-link\" href=\"http://www.askgamblers.com/online-casinos-p10\">online casino</a>&nbsp;have decided to get you in the mood with their summer giveaway. You could be starting your summer holidays on a sunny cruise to the gorgeous Royal Caribbean. It&rsquo;s set to be an experience of a lifetime and one where memories will be made that will last forever.</p>\r\n<blockquote>Enjoy the ultimate summer cruise with a friend or loved one</blockquote>\r\n<p>If you&rsquo;re the lucky winner of this once in a lifetime opportunity you&rsquo;ll be setting sail for a total of 8 days and 7 nights on board for 2 people. The hardest part will be picking who you want to take with you! You&rsquo;ll set sail from Fort Lauderdale and visit Nassau, Bahamas &ndash; Charlottel Amalie, St. Thomas and Basseterre St. Kitts.</p>\r\n<h2>Earn as many entries as you can</h2>\r\n<p>To be in with a chance of winning you&rsquo;ll need to start earning entries into the draw and you&rsquo;ve got until June 20th to get as many as you can. Every time you fund your account you&rsquo;ll get rewarded with free tickets, the more you deposit the more entries you&rsquo;ll get. Here&rsquo;s how it works:<br />1. Deposit between &pound;10 and &pound;29.99 and you&rsquo;ll get 1 entry into the draw<br />2. Deposit between &pound;30 and &pound;59.99 and you&rsquo;ll get 3 entries<br />3. Deposit between &pound;60 and &pound;179.99 and you&rsquo;ll get 7 entries<br />4. Deposit between &pound;180 and &pound;299.99 and you&rsquo;ll get 10 entries<br />5. Deposit &pound;300 or more and you&rsquo;ll get a massive 20 entries<br />Each deposit you make makes a difference to your total entries, it just depends on how bad you want to win!</p>\r\n<h2>An unforgettable experience</h2>\r\n<p>If you&rsquo;re the lucky winner, you and one friend will be relaxing in the ultimate comfort. You&rsquo;ll have an Outside Stateroom for 2 with convenience and luxury and staff waiting on you hand and foot 24/7.</p>\r\n<blockquote>You&rsquo;ll be dazzled onboard with gorgeous views, world-class performers and awe-inspiring shows!</blockquote>\r\n<p>When it comes to dining, this of course is all part of the journey. You&rsquo;ll enjoy a complete luxury dining experience in the perfect ambience of the ship. There&rsquo;s activates to keep you going from a day at the pool, aqua aerobics, rock wall climbing and lots more. And if you want to keep fit you can benefit from state-of-the-art equipment, fitness class and more!<br />It all sounds like the perfect setting, we only wish we could enter ourselves! Head over to <a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/visit/vegas-crest-casino-casino-casino-review\" rel=\"nofollow\" data-name=\"Vegas Crest Casino\" data-url=\"/online-casinos/vegas-crest-casino-casino-review/\" data-logo=\"/uploads/casino-logos/vegas-crest-casino-539ee4bc70a0f871478b4569.png\" data-rating=\"5.63\" data-visit-url=\"/visit/vegas-crest-casino-casino-casino-review\">Vegas Crest Casino</a>&nbsp;today and start collecting those entries.</p>', 'images/news/Summer_Cruise.jpg', 'Summer_Cruise.jpg', 'N', '0000-00-00 00:00:00', 0, 3, '2016-05-30 22:57:48'),
(4, 'Tickets to the semi-finals', 'Anirban', '<p>The most talked about sporting event of the year is just around the corner, the Euro 2016. And NetEnt have released their brand new game just in time for some great promotions. This week has been the perfect opportunity to get your hands on some free tickets. But don&rsquo;t worry if you missed it we&rsquo;ll go through it again in this recap. We&rsquo;ll also take a look at some of the newest online casinos and games that were added this week.</p>\r\n<h2>Catch up on some of the headlines this week</h2>\r\n<h3>2 Tickets to the semi-finals could be yours!</h3>\r\n<p>Play NetEnt&rsquo;s Football: Champions Cup Slot at VideoSlots Casino and you could win 2 tickets to the Euro 2016 semi-finals in Marseille. You&rsquo;ve got until the 10th June to wager at least &euro;10 on the game which will guarantee yourself entry into the prize draw. Full details can be found by reading our story <a class=\"internal-link\" href=\"http://www.askgamblers.com/gambling-news/promotions/play-football-champions-cup-to-win-2-tickets-for-the-euro-2016-semi-finals/\">Play Football: Champions Cup to win 2 tickets for the Euro 2016 semi-finals</a>.</p>\r\n<h3>It&rsquo;s your last day to grab a 50% reload bonus</h3>\r\n<p>All week NextCasino have been hosting their very own music festival. Playing tribute to some great slots with great soundtracks. Today marks the last day of the festival and an opportunity for you to claim a 50% reload bonus. Just read our story <a class=\"internal-link\" href=\"http://www.askgamblers.com/gambling-news/promotions/enjoy-sweet-music-free-spins-and-bonuses-with-nextcasino-s-music-festival/\">Enjoy sweet music, free spins and bonuses with the NextCasino&rsquo;s music festival for your bonus code</a>.</p>\r\n<h3>End your weekend with some free spins at Kaboo</h3>\r\n<p>It&rsquo;s the last day of the weekend but there&rsquo;s no need to be sad because there&rsquo;s still time for you to win some Super Spins at Kaboo Casino. Simply make a deposit of at least &euro;50 today and you&rsquo;ll get 1 entry into the prize draw. 100 players will be picked at random and you could win &euro;100 worth of spins! Our story <a class=\"internal-link\" href=\"http://www.askgamblers.com/gambling-news/promotions/enjoy-a-weekend-filled-with-free-spins-and-super-spins-at-kaboo-casino/\">Enjoy a weekend filled with free spins and super spins at Kaboo Casino</a>&nbsp;has all the details you need to get started.</p>\r\n<h2>Get to know our newest casinos</h2>\r\n<h3>Cool Play Casino</h3>\r\n<p>A multi-platform casino home to a huge range of games from the likes of NetEnt, Microgaming, Nyx Interactive, Genesis Gaming and Thunderkick. Play straight from your web browser or enjoy an assortment of mobile games with their state-of-the-art lobby. Keep up to speed with all the newest games in the industry and friendly support 24/7. <a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/online-casinos/cool-play-casino-review/\" data-name=\"Cool Play Casino\" data-url=\"/online-casinos/cool-play-casino-review/\" data-logo=\"/uploads/casino-logos/cool-play-casino-logo-573ee50d7528f7fde68b45ae.png\" data-rating=\"7.13\" data-visit-url=\"/visit/cool-play-casino-casino-review\">Read our Cool Play Casino Review for more information</a>.</p>\r\n<h3>Kudos Casino</h3>\r\n<p>Here we have a Real Time Gaming Casino giving you three different ways to play, from your mobile, your browser or through their download client. Whichever way you choose to play you&rsquo;ll be greeted with plenty of games from videos slots to blackjack and video poker.&nbsp;<a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/online-casinos/kudos-casino-review/\" data-name=\"Kudos Casino\" data-url=\"/online-casinos/kudos-casino-review/\" data-logo=\"/uploads/casino-logos/kudos-casino-logo-5746c7007528f7698e8b45f5.png\" data-rating=\"7.13\" data-visit-url=\"/visit/kudos-casino-casino-review\">Your welcome bonus can be found by reading our Kudos Casino Review.</a></p>\r\n<h2>Spin for free with our newest games</h2>\r\n<h3>Football: Champions Cup</h3>\r\n<p>NetEnt&rsquo;s newest game is a must try at the moment. The football themed slot with 20 paylines across 5 reels will have you scoring goals with wild symbols, scoring wilds and overlay wilds. Enter free spins and a bonus game to increase your chances of winning.&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/football-champions-cup-netent-game-review/\">Try Football: Champions Cup Slot for free.</a></p>\r\n<p><a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/football-champions-cup-netent-game-review/\"><img style=\"width: 100%; max-width: 800px;\" src=\"http://www.askgamblers.com/uploads/football-champins-cup-3-5742d9467528f7f8488b4567.png\" alt=\"Football: Champions Cup\" width=\"800\" height=\"438\" /></a></p>\r\n<h3>Alaskan Husky</h3>\r\n<p>This new game from Nyx Interactive boasts an impressive 100 paylines and of course is themed around the beautiful Alaskan Huskys. Land three or more scatters and you&rsquo;ll win 10 free spins with both expanding and random wilds.&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/alaskan-husky-nyx-interactive-game-review/\">Play Alaskan Husky for free before trying it for real.</a></p>\r\n<h3>Ultimate Dream Team</h3>\r\n<p>With stacked wilds you can become part of the dream team when you play this 25-lined slot from Push Gaming. Enjoy a dream team bonus feature and free spins as you head to the field to score some goals.&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/ultimate-dream-team-push-gaming-game-review/\" rel=\"nofollow\">Use our links to play the Ultimate Dream Team Slot for free.</a></p>\r\n<p><a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/ultimate-dream-team-push-gaming-game-review/\"><img style=\"width: 100%; max-width: 800px;\" src=\"http://www.askgamblers.com/uploads/ultimate-dream-team-5748128a7528f770fd8b45ba.png\" alt=\"Ultimate Dream Team\" width=\"800\" height=\"530\" /></a></p>', 'images/news/Tickets_to_the_semi-finals.jpg', 'Tickets_to_the_semi-finals.jpg', 'N', '0000-00-00 00:00:00', 0, 3, '2016-05-30 22:59:47'),
(5, 'The latest jackpot winner', 'Anirban', '<p><a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/casino/bgo-casino-review-r4421\" data-name=\"BGO Casino\" data-url=\"/casino/bgo-casino-review-r4421\" data-logo=\"/uploads/casino-logos/bgo-casino-logo-5372285070a0f8f6378b4567.png\" data-rating=\"3.75\" data-visit-url=\"/visit/bgo-casino-review-rv4421\">BGO Casino</a>&nbsp;have their next big winner! 52ALM from Bedfordshire managed to take from the <a class=\"internal-link\" href=\"http://www.askgamblers.com/online-casinos-p10\">online casino</a>&nbsp;a life changing &pound;1.6 million playing one of Playtech&rsquo;s popular games, their <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/gladiator-jackpot-g4231\">Gladiator Jackpot Slot</a>. Just how does a win like this change your life?</p>\r\n<h2>The latest jackpot winner</h2>\r\n<p>It all happened from his mobile device. One lucky player at BGO Casino was spinning the reels of Gladiator Jackpot when the big moment happened. A moment that is sure to change the player&rsquo;s life forever. Off the back of a very modest &pound;6.25 bet from his iPhone, player 52ALM hit the jackpot and is now enjoying &pound;1.6 million in his bank account!</p>\r\n<blockquote>Those big wins can come wherever you are, you&rsquo;ve just got to play</blockquote>\r\n<p>Shortly after the win the player told the casino he was absolutely thrilled. He plans on buying his dream car, a nice house and sharing some of his windfall with those closest to him! We&rsquo;re sending him a huge congratulations from the entire AskGamblers team.&nbsp;<br />Now we think it&rsquo;s your turn to win big and to do that you need to be a member at BGO Casino. So if you&rsquo;ve yet to sign up there we&rsquo;ve got an incredible welcome package for you to enjoy. That means you&rsquo;ll get to play with more funds to try for those all-important big wins.</p>\r\n<h2>Triple your first deposit</h2>\r\n<p>All new players signing up to BGO Casino for the first time get to enjoy their welcome package. You&rsquo;ll be treated to a bonus not just on your first deposit, but on your first four deposits. And to make the package even more rewarding, you&rsquo;ll also get 20 free spins just for signing up.</p>\r\n<blockquote>Free spins with no deposit required followed by four welcome bonuses sounds like a pretty good deal!</blockquote>\r\n<p>You&rsquo;ll kick things off when you make your first deposit. The casino will match it with an impressive 200% welcome bonus and they&rsquo;ll also throw in 180 free spins on <a class=\"internal-link\" href=\"http://www.askgamblers.com/software/netent\">NetEnt</a>&rsquo;s popular <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/starburst-g4022\">Starburst Slot</a>. Here&rsquo;s how you get it:<br />1. Sign up to BGO Casino<br />2. Play your <a class=\"internal-link\" href=\"http://www.askgamblers.com/bonus/free-spins/bgo-casino-no-deposit-20-free-spins-on-registration/\">20 free spins</a>, no deposit needed<br />3. Visit the cashier and make your first deposit<br />4. Enjoy a&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/bonus/welcome/bgo-casino-200percent-up-to-gbp100/\">200% welcome bonus up to &pound;100</a><br />5. Play 20 free spins on Starburst every day for the next 9 days<br />All the casino ask is that you make a minimum &pound;10 deposit and that you wager your bonus 35x before requesting a withdrawal.</p>\r\n<h2>The rest of your welcome package follows</h2>\r\n<p>When you&rsquo;re ready to move on to your next deposits the casino will be on hand to give out your bonuses. You&rsquo;ll need to make a minimum &pound;10 deposit for your second bonus and both your third and fourth bonus will require a &pound;30 deposit. Here&rsquo;s what you&rsquo;ll get:<br />1. Make your second deposit to enjoy a&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/bonus/2nd-deposit/bgo-casino-100percent-up-to-gbp500/\">100% bonus up to &pound;500</a><br />2. Make your third deposit and you&rsquo;ll get another 100% bonus up to &pound;500<br />3. Finally when you make your fourth deposit you&rsquo;ll get to play with a 100% bonus up to &pound;400<br />Each bonus you receive will need to be wagered 35x and when you&rsquo;re playing with a bonus your bets must not exceed &pound;10 on any game.&nbsp;<br />Sign up to <a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/visit/bgo-casino-review-rv4421\" rel=\"nofollow\" data-name=\"BGO Casino\" data-url=\"/casino/bgo-casino-review-r4421\" data-logo=\"/uploads/casino-logos/bgo-casino-logo-5372285070a0f8f6378b4567.png\" data-rating=\"3.75\" data-visit-url=\"/visit/bgo-casino-review-rv4421\">BGO Casino</a>&nbsp;today.</p>', 'images/news/The_latest_jackpot_winner.jpg', 'The_latest_jackpot_winner.jpg', 'N', '0000-00-00 00:00:00', 0, 3, '2016-05-30 23:01:56'),
(6, 'Euro 2016 Finals', 'Anirban', '<p><a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/online-casinos/21-casino-review/\" data-name=\"21 Casino\" data-url=\"/online-casinos/21-casino-review/\" data-logo=\"/uploads/casino-logos/wenty-ne-asino-2-55a374277528f724218b4575.png\" data-rating=\"7.63\" data-visit-url=\"/visit/21-casino-casino-review\">21 Casino</a>&nbsp;are going one step further than other <a class=\"internal-link\" href=\"http://www.askgamblers.com/online-casinos-p10\">online casinos</a>. They&rsquo;re not just giving away one or two tickets to the Euro 2016, they&rsquo;re giving away 26 tickets. <strong>Including tickets to the final!</strong> There&rsquo;s a series of challenges you can complete to be in with a chance of winning and if you don&rsquo;t win first time round you can just try again!</p>\r\n<h2>Can you win tickets to the Euro 2016?</h2>\r\n<p>Over the course of the next few weeks 21 Casino are setting you a number of challenges. The winners of these challenges will win tickets to the Euro 2016, so if you want the tickets you need to listen up. The first challenge is almost over but there&rsquo;s still today and tomorrow to complete it.</p>\r\n<blockquote>Refer your friends and you could be watching Belgium vs. Italy</blockquote>\r\n<p>Simply refer as many friends as you can before the end of the day tomorrow and those tickets could be yours. You can ask them to use our links to get to the casino, the more friends you refer the higher your chances are of winning the tickets.</p>\r\n<h2>Spain VS. Turkey tickets</h2>\r\n<p>Next week, complete the 5-day challenge and you could win tickets to the Spain vs. Turkey match. Just log into the casino every day between the 30th May and 6th June. It&rsquo;s you, head to head against the casino all week. There&rsquo;ll be a 25% deposit bonus waiting along with free spins when you play <a class=\"internal-link\" href=\"http://www.askgamblers.com/software/netent\">NetEnt</a>&rsquo;s <a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/football-champions-cup-netent-game-review/\">Football: Champions Cup Slot</a>. And of course there&rsquo;s still those all-important tickets to win as well.</p>\r\n<p><a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/football-champions-cup-netent-game-review/\"><img style=\"width: 100%; max-width: 800px;\" src=\"http://www.askgamblers.com/uploads/football-champins-cup-3-5742d9467528f7f8488b4567.png\" alt=\"Football: Champions Cup\" width=\"800\" height=\"493\" /></a></p>\r\n<h2>Switzerland VS. France</h2>\r\n<p>For these tickets you&rsquo;ll have to take part in the 48-hour social media challenge. You&rsquo;ll need to head to the casinos Facebook page and complete a challenge to be in with a chance of winning.</p>\r\n<h2>Euro 2016 Finals</h2>\r\n<p>Between the 8th of June and the 28th of June it&rsquo;s the big one. Tickets to the Euro 2016 final. All you have to do is collect as many loyalty points as you can. You&rsquo;ll have almost three weeks to gather as many points as you can and you can do that by playing your favourite games.</p>\r\n<blockquote>It&rsquo;s a race against your fellow players to accumulate the most points</blockquote>\r\n<p>Whichever player collects the most loyalty points by the end of June will win the tickets to the finals. You can check all the ways you can earn loyalty points over at the casino website.<br />Sign up to <a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/visit/21-casino-casino-review\" rel=\"nofollow\" data-name=\"21 Casino\" data-url=\"/online-casinos/21-casino-review/\" data-logo=\"/uploads/casino-logos/wenty-ne-asino-2-55a374277528f724218b4575.png\" data-rating=\"7.63\" data-visit-url=\"/visit/21-casino-casino-review\">21 Casino</a>&nbsp;and win your tickets today.</p>', 'images/news/Euro_2016_Finals.jpg', 'Euro_2016_Finals.jpg', 'N', '0000-00-00 00:00:00', 0, 3, '2016-05-30 23:03:31'),
(7, 'A royal experience', 'Anirban', '<p>Check it out! We recently added another online casino to our directory. This time it&rsquo;s <a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/online-casinos/royalio-casino-review/\" data-name=\"Royalio Casino\" data-url=\"/online-casinos/royalio-casino-review/\" data-logo=\"/uploads/casino-logos/royalio-logo-573b00c07528f712198b45d3.png\" data-rating=\"7.38\" data-visit-url=\"/visit/royalio-casino-casino-review\">Royalio Casino</a>, home to <strong>over 500+ games</strong> from <a class=\"internal-link\" href=\"http://www.askgamblers.com/software/microgaming/games\">Microgaming</a>, <strong>Rival</strong>, <strong>Cozy Games</strong> and <strong>iSoftBet.</strong> We&rsquo;ve taken a look around already and it certainly ticks all the boxes!</p>\r\n<h2>A royal experience</h2>\r\n<p>Whether its slots, table games or scratch games you&rsquo;ll have your pick of some of the best games in the industry at Royalio Casino. And playing is literally just a click away. So that the casino is literally compatible for everyone there&rsquo;s three ways in which you can play. Open the casino straight from your web browser, download the casino or play straight from their impressive <a class=\"internal-link\" href=\"http://www.askgamblers.com/mobile-casinos\">mobile casino</a>.</p>\r\n<blockquote>Convenience is certainly no object at Royalio Casino</blockquote>\r\n<p>Taking the casino with you wherever you are brings you complete freedom. So if it&rsquo;s from your mobile device you want to play you certainly won&rsquo;t be disappointed. Just download their app from your iOS, Android, Windows or Blackberry device, sign up and play an assortment of games where ever you are.</p>\r\n<h2>Stylish and Sleek</h2>\r\n<p>As with any new casino nowadays you&rsquo;d expect nothing less than quality and that&rsquo;s exactly what you&rsquo;ll get every time you play at Royalio Casino. Their easy to use and friendly interface lets you search for any game, saving you time going through games you just know you aren&rsquo;t going to play. Or if its variety you like then why not use their A-Z search function and work your way through their games seeing where lady luck will land.</p>\r\n<p>You can indulge in seamless gaming sessions around the clock and it doesn&rsquo;t matter whether you&rsquo;re a newbie or a pro you&rsquo;re guaranteed to find a game you like here.</p>\r\n<h2>Getting started is easy!</h2>\r\n<p>Once you&rsquo;re a member you&rsquo;ll instantly be able to start enjoying player benefits, bonuses and more. Signing up is easy and takes just a few moments, you can even use these links to get you to where you need to be.</p>\r\n<blockquote>Play with a 100% welcome bonus on your first two deposits</blockquote>\r\n<p>As you&rsquo;re a new player you&rsquo;ll get to try out the casino with a welcome bonus on your first two deposits. The casino will match your first and second deposit with a 100% bonus and did we mention you&rsquo;ll also get &pound;10 free just for signing up? Here&rsquo;s how you can get started today:</p>\r\n<ol>\r\n<li><a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/visit/royalio-casino-casino-review\" rel=\"nofollow\" data-name=\"Royalio Casino\" data-url=\"/online-casinos/royalio-casino-review/\" data-logo=\"/uploads/casino-logos/royalio-logo-573b00c07528f712198b45d3.png\" data-rating=\"7.38\" data-visit-url=\"/visit/royalio-casino-casino-review\">Sign up to Royalio Casino</a></li>\r\n<li>Enjoy a <a class=\"internal-link\" href=\"http://www.askgamblers.com/bonus/no-deposit/royalio-casino-gbp10-free/\">&pound;10 no deposit bonus</a></li>\r\n<li>Visit the cashier and make your first deposit (no bonus code required)</li>\r\n<li>Instantly start playing with a <a class=\"internal-link\" href=\"http://www.askgamblers.com/bonus/welcome/royalio-casino-100percent-up-to-gbp500/\">100% welcome bonus up to &pound;500</a></li>\r\n</ol>\r\n<p>A minimum &pound;10 deposit will trigger your bonus and all the casino ask is that you <strong>wager your bonus 30x</strong> before requesting a withdrawal. Then when you&rsquo;re ready to claim your second bonus just visit the cashier, make another deposit, &pound;10 or more and the casino will match it with another 100%!</p>\r\n<p>We&rsquo;ll leave the rest to you. Sign up to Royalio Casino today.</p>', 'images/news/A_royal_experience.jpg', 'A_royal_experience.jpg', 'B', '0000-00-00 00:00:00', 0, 3, '2016-05-30 23:05:06'),
(8, 'Play Mr Greenâ€™s Exclusive New Slot', 'Anirban', '<p><a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/casino/mr-green-casino-review-r4217\" data-name=\"Mr Green Casino\" data-url=\"/casino/mr-green-casino-review-r4217\" data-logo=\"/uploads/casino-logos/mr-green-casino-logo-53e4ccc370a0f87e738b4572.png\" data-rating=\"6.63\" data-visit-url=\"/visit/mr-green-casino-review-rv4217\">Mr Green Casino</a>&nbsp;are celebrating the exclusive release of their new slot&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/peter-and-the-lost-boys-push-gaming-game-review/\">Peter and the Lost Boys</a> by <strong>Push Gaming</strong> and you have a chance to win some truly fantastic cash prizes. Moreover, if you play another new game by the name of&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/michael-jackson-king-of-pop-bally-game-review/\">Michael Jackson: King of Pop</a> you might snag tickets to Cirque du Soleil&rsquo;s popular Michael Jacksons ONE show. To learn how to get one step closer to a share of &euro;20,000 in cash prizes and the Cirque du Soleil tickets, just keep reading.</p><h2>Play Mr Green&rsquo;s Exclusive New Slot</h2><p>The stunning&nbsp;<span class=\"internal-link\">Peter and the Lost Boys slot</span> is out and Mr Green Casino would like to give out some amazing cash prizes as part of their celebration. If you&rsquo;re up for a trip to Neverland, then this promo is just the thing you need! Your time with Peter Pan and his buddies might even bring you closer to Captain Hook&rsquo;s incredible &euro;20,000 treasure trove.</p><p><a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/peter-and-the-lost-boys-push-gaming-game-review/\"><img style=\"width: 100%; max-width: 800px; display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.askgamblers.com/uploads/peter-and-the-lost-boys-574542347528f74b878b45fd.png\" alt=\"Peter and the Lost Boys Slot\" width=\"800\" height=\"515\" /></a></p><h2>How to Win the Cash Drop Prizes</h2><p>The slot itself is exclusive to Mr Green and you have a special shot at the prizes at the <a class=\"internal-link\" href=\"http://www.askgamblers.com/online-casinos-p10\">online casino</a>. All you need to do is play a minimum of 20 spins on Peter and the Lost Boys and, if you&rsquo;re one of the 50 randomly selected Mr Green players, you&rsquo;ll have a chance to win anything from &euro;50 all the way up to an amazing &euro;5000.</p><blockquote>Play a minimum of 20 spins on Peter and the Lost Boys to win between &euro;50 and &euro;5000.</blockquote><p>The promo started on the 24th of May and it will last till the 30th of May, so make sure you don&rsquo;t waste another minute&mdash;go spin those reels and good luck!</p><h2>Michael Jackson Prize Draw</h2><p>Gather round, Michael Jackson fans! Mr Green has an incredible offer for you. <strong>Between the 25th of May and the 5th of June, 2016</strong> you might snag tickets to Las Vegas to see Cirque du Soleil&rsquo;s Michael Jacksons ONE show live. And here&rsquo;s how.</p><blockquote>Wager &euro;10 on the Michael Jackson: King of Pop slot and earn 1 entry ticket to the prize draw.</blockquote><p>For every &euro;10 you wager on the new game Michael Jackson: King of Pop during the promo period, you&rsquo;ll receive 1 entry ticket to the Mr Green Casino prize draw. If you happen to be the lucky winner, you&rsquo;ll receive 2x tickets for the Cirque du Soleil show, flights and accommodation at the Mandalay Bay Resort &amp; Casino in Las Vegas. So, Thriller-ites, fingers crossed!</p><p><a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/michael-jackson-king-of-pop-bally-game-review/\"><img style=\"width: 100%; max-width: 800px; display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.askgamblers.com/uploads/michael-jackson-king-of-pop-5746a4887528f700968b458b.png\" alt=\"Michael Jackson King of Pop\" width=\"800\" height=\"461\" /></a></p><p><a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/visit/mr-green-casino-review-rv4217\" rel=\"nofollow\" data-name=\"Mr Green Casino\" data-url=\"/casino/mr-green-casino-review-r4217\" data-logo=\"/uploads/casino-logos/mr-green-casino-logo-53e4ccc370a0f87e738b4572.png\" data-rating=\"6.63\" data-visit-url=\"/visit/mr-green-casino-review-rv4217\">Join Mr Green Casino today</a>&nbsp;and good luck winning their incredible prizes!</p>', 'images/news/play.jpg', 'Play_Mr_Greenâ€™s_Exclusive_New_Slot.jpg', 'B', '0000-00-00 00:00:00', 0, 3, '2016-05-30 23:08:07'),
(9, 'Welcomed with open arms', 'Anirban', '<p>Another new and modern&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/online-casinos-p10\">online casino</a> has just been added to AskGamblers, this time we welcome on-board <a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/online-casinos/galaxypig-casino-review/\" data-name=\"GalaxyPig Casino\" data-url=\"/online-casinos/galaxypig-casino-review/\" data-logo=\"/uploads/casino-logos/galaxypig-casino-logo-5742ea9e7528f7e8488b45a8.png\" data-rating=\"7\" data-visit-url=\"/visit/galaxypig-casino-casino-review\">GalaxyPig Casino</a>. You&rsquo;ll find a large assortment of games from the likes of <strong><a class=\"internal-link\" href=\"http://www.askgamblers.com/software/netent/games\">NetEnt</a>, Playson</strong> and <strong>Yggdrasil Gaming</strong> and there&rsquo;s plenty to enjoy once you get there.</p>\r\n<h2>Welcomed with open arms</h2>\r\n<p>Upon arrival at our newest casino you&rsquo;ll have instant access 24/7 to some of the most popular games in the industry. You won&rsquo;t need to worry about the hassle of a download since every game can be played straight from your webs browser. And if it&rsquo;s convenience you want why not get out your mobile device and sign up through their <a class=\"internal-link\" href=\"http://www.askgamblers.com/mobile-casinos\">mobile casino</a>.</p>\r\n<blockquote>Simply pick the best way to play, sign up and enjoy!</blockquote>\r\n<p>Whichever way you decide to play you can benefit from their state-of-the art lobby, easy access games and friendly interface. There&rsquo;s over 150 games to choose from including the newest video slots, table games and video pokers. Browse through their games or use their in-built search engine to get to your favourite games, faster! And if it&rsquo;s a jackpot win you&rsquo;re after why not try out their&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/progressive-slots/arabian-nights-netent-game-review/\">Arabian Nights Slot</a> or <a class=\"internal-link\" href=\"http://www.askgamblers.com/progressive-slots/cosmic-fortune-netent-game-review/\">Cosmic Fortune Slot</a>, both boasting huge jackpots just waiting to be won.</p>\r\n<p>When it comes to support it&rsquo;s just another thing you don&rsquo;t need to worry about. You can easily access the casino live chat facility where a friendly agent will be on hand to answer your questions. And if there isn&rsquo;t a support agent available you can still use the casinos online contact form for a quick response.</p>\r\n<h2>All players get a welcome bonus</h2>\r\n<p>No casino would be complete without a welcome bonus right? If you are a new player at GalaxyPig Casino you can get started straight away with a 100% welcome bonus. The casino will even throw in some free spins depending on how much you deposit. Here&rsquo;s how you give it a go:</p>\r\n<ol>\r\n<li><a class=\"internal-link casino-details\" href=\"http://www.askgamblers.com/visit/galaxypig-casino-casino-review\" rel=\"nofollow\" data-name=\"GalaxyPig Casino\" data-url=\"/online-casinos/galaxypig-casino-review/\" data-logo=\"/uploads/casino-logos/galaxypig-casino-logo-5742ea9e7528f7e8488b45a8.png\" data-rating=\"7\" data-visit-url=\"/visit/galaxypig-casino-casino-review\">Sign up to GalaxyPig Casino</a></li>\r\n<li>Visit the cashier and make your first deposit</li>\r\n<li>Enjoy a <a class=\"internal-link\" href=\"http://www.askgamblers.com/bonus/welcome/galaxypig-casino-100percent-up-to-eur250/\">100% welcome bonus up to &euro;250</a></li>\r\n</ol>\r\n<p>In the spirit of fairness the casino ask that you <strong>wager both your bonus and deposit 35x</strong> before requesting a withdrawal. You&rsquo;ll get your free spins based on your deposit amount as follows:</p>\r\n<ol>\r\n<li>Deposit &euro;10 and you&rsquo;ll get 10 free spins</li>\r\n<li>Deposit &euro;25 to get 20 free spins</li>\r\n<li>Deposit &euro;50 to get 35 free spins</li>\r\n<li>Deposit &euro;100 and you&rsquo;ll get a cool 50 free spins</li>\r\n</ol>\r\n<p>Your free spins will be credited the following day by 12:00 GMT unless your deposit was not made within business hours. You may need to wait up to 72 hours if it was. You&rsquo;ll be able to use your free spins on NetEnt&rsquo;s <a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/aliens-game-review/\">Aliens Slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/fruit-shop-g3972\">Fruit Shop Slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/gonzos-quest-g3275\">Gonzo&rsquo;s Quest Slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/south-park-g4452\">South Park Slot</a>,&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/piggy-riches-g3285\">Piggy Riches Slot</a> or <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/starburst-g4022\">Starburst Slot</a>. Enjoy!</p>\r\n<p>That&rsquo;s it from us, all you have to do now is head to the casino and try them out today! You can let us know what you think of the casino in the comments below or <a href=\"http://www.askgamblers.com/forum/\" target=\"_blank\">over at our forum</a>.</p>', 'images/news/Welcomed_with_open_arms.jpg', 'Welcomed_with_open_arms.jpg', 'N', '0000-00-00 00:00:00', 0, 3, '2016-05-31 04:56:23'),
(10, 'test', 'test', '<p>test</p>', NULL, 'test.png', 'N', '0000-00-00 00:00:00', 1, 1, '2018-01-30 18:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `tblNewsComment`
--

CREATE TABLE `tblNewsComment` (
  `id` int(11) UNSIGNED NOT NULL,
  `newsId` int(11) UNSIGNED NOT NULL,
  `userId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gdComments` mediumtext COLLATE utf8_unicode_ci,
  `badComments` mediumtext COLLATE utf8_unicode_ci,
  `rating` int(11) NOT NULL DEFAULT '3',
  `isRecommanded` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblNewsComment`
--

INSERT INTO `tblNewsComment` (`id`, `newsId`, `userId`, `gdComments`, `badComments`, `rating`, `isRecommanded`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, 3, '3', 'test', 'test', 4, 'Y', '0000-00-00 00:00:00', 3, 3, '2017-02-19 13:51:48'),
(2, 8, '3', 'test', 'testtest', 5, 'N', '0000-00-00 00:00:00', 3, 3, '2018-01-28 08:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `tblNotice`
--

CREATE TABLE `tblNotice` (
  `id` int(11) UNSIGNED NOT NULL,
  `userId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noticeTitle` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `noticeText` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `isPined` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblNotice`
--

INSERT INTO `tblNotice` (`id`, `userId`, `noticeTitle`, `noticeText`, `isPined`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, '1', 'New Day rocks', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Y', '0000-00-00 00:00:00', 1, 1, '2016-06-08 09:32:03'),
(2, '1', 'Exciting Bonus Offers', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Y', '0000-00-00 00:00:00', 1, 1, '2016-06-08 09:43:12'),
(3, '1', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummyLorem Ipsum is simply dummy', 'N', '0000-00-00 00:00:00', 1, 1, '2016-06-08 10:09:22'),
(4, '1', 'test', 'tesetaetast', 'N', '0000-00-00 00:00:00', 1, 1, '2018-01-30 18:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `tblSadariCards`
--

CREATE TABLE `tblSadariCards` (
  `id` int(11) UNSIGNED NOT NULL,
  `joinCode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `siteName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sportsName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sportsType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wager` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maximumBetting` bigint(150) NOT NULL,
  `minBettingAmount` bigint(150) NOT NULL,
  `maxAwardAmount` bigint(150) NOT NULL,
  `ruMatin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sadariOdd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `closingTime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sportsImage` mediumtext COLLATE utf8_unicode_ci,
  `rating` int(11) NOT NULL DEFAULT '3',
  `sportsOtherDetails` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bettingOption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rollingCondition` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sportsReview` mediumtext COLLATE utf8_unicode_ci,
  `isRecommanded` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `isHot` enum('H','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'H',
  `isPin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblSadariCards`
--

INSERT INTO `tblSadariCards` (`id`, `joinCode`, `siteName`, `sportsName`, `sportsType`, `description`, `link`, `wager`, `maximumBetting`, `minBettingAmount`, `maxAwardAmount`, `ruMatin`, `sadariOdd`, `closingTime`, `imageName`, `sportsImage`, `rating`, `sportsOtherDetails`, `bettingOption`, `rollingCondition`, `sportsReview`, `isRecommanded`, `isHot`, `isPin`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, '69696', 'Askgambler', 'BetKings', 'Sadari sport', 'BetKings Casino is an online casino suited for casino game lovers and sportsbook aficionados alike.', 'http://www.askgamblers.com', '30x', 500000, 15000, 6000000, 'Allow', '1.95', '30', 'betking.jpg', 'images/sadari/betking.jpg', 4, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\"]', 'í¬ë¡œìŠ¤ë°°íŒ…', '100%', '<div>\r\n<p><strong>BetKings Casino</strong> is an <a class=\"internal-link\" href=\"http://www.askgamblers.com/online-casinos-p10\">online casino</a>&nbsp;suited for casino game lovers and sportsbook aficionados alike. The extensive list of games offered includes various online slots and table games powered by <a class=\"internal-link\" href=\"http://www.askgamblers.com/software/netent\">NetEnt</a>&nbsp;and <strong>Portomaso Gaming</strong> all available in instant play. The casino offers both the option of live gambling and gaming on the go, as it is both a live casino and a mobile casino. BetKings Casino is licensed and regulated by Curacao eGaming.</p>\r\n<h2>Restricted Countries and Territories</h2>\r\n<p>Players who reside in France, Turkey and the United States of America cannot currently play at BetKings Casino.</p>\r\n<h2>Virtual Games</h2>\r\n<p>BetKings Casino are supplied with a variety of Portomaso Gaming and NetEnt slots - ranging from the most popular <strong>video slots</strong> to the newest titles. Players can enjoy a range of widely beloved slots like the <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/dead-or-alive-g4493\">Dead or Alive slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/gonzos-quest-g3275\">Gonzo&rsquo;s Quest slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/fisticuffs-g4418\">Fisticuffs slot</a>&nbsp;and more. The selection also includes diverse progressive slots, such as the <a class=\"internal-link\" href=\"http://www.askgamblers.com/progressive-slots/arabian-nights-netent-game-review/\">Arabian Nights slot</a>&nbsp;and <a class=\"internal-link\" href=\"http://www.askgamblers.com/progressive-slots/super-lucky-frog-netent-game-review/\">Super Lucky Frog slot</a>.</p>\r\n<p>The <strong>table game</strong> section features several different variants of roulette and blackjack, including American Roulette, European Roulette, French Roulette, Blackjack Professional Series, 60s Blackjack and Single Deck Blackjack.</p>\r\n<p><strong>Video poker</strong> fans can play different types of Jacks or Better and Joker Wild Double Up, amongst others.</p>\r\n<p>Players looking for specialty games can play keno and scratch cards at the casino.&nbsp;</p>\r\n<h2>Live Games</h2>\r\n<p>BetKings Casino includes the option of gambling against a live dealer. When players open the <strong>live casino</strong> section, they can choose between different tables and several diverse types of live roulette.</p>\r\n<h2>Mobile Gaming</h2>\r\n<p>The BetKings Casino website has a responsive design, which means players can access the casino on all kinds of devices&mdash;from desktop and laptop computers to <strong>tablets</strong>, <strong>iPads</strong> and <strong>smartphones</strong>.</p>\r\n<h2>Support</h2>\r\n<p>The casino includes a FAQ section where players can go through the previous answered questions in order to find the solution to the issue they might be experiencing. Alternatively, they can reach the <strong>customer support team via email</strong> at all hours. Unfortunately, there is no live chat available at the moment.</p>\r\n<h2>Security and Fairness</h2>\r\n<p>Since the casino website implements the most up-to-date <strong>SSL encryption technology</strong>, players can rest assured their <strong>sensitive data remains safe and intact</strong>.</p>\r\n<p>Moreover, the fact that BetKings Casino features NetEnt slots serves as another proof of the casino&rsquo;s safety. Namely, the NetEnt software is <strong>regularly tested for fairness</strong> and guarantees regularity through random spins.</p>\r\n</div>\r\n<h2>Pros</h2>\r\n<ul class=\"uilist\">\r\n<li>Available in instant play</li>\r\n<li>Supports gaming on the go</li>\r\n<li>Live casino present</li>\r\n<li>SSL encryption supported</li>\r\n</ul>\r\n<h2>Cons</h2>\r\n<ul class=\"uilist\">\r\n<li>No live chat available</li>\r\n</ul>\r\n<h2>Website Preview</h2>\r\n<div class=\"screenshot__casino\"><a class=\"image-popup-vertical-fit\" title=\"BetKings Casino\" href=\"http://www.askgamblers.com/uploads/screencapture-www-betkings-eu-en-casino-1465377238661-5757e1ee7528f7e62f8b4568.png\"> <img src=\"http://www.askgamblers.com/uploads/casino-screenshots/screencapture-www-betkings-eu-en-casino-1465377238661-5757e1ee7528f7e62f8b4568.png\" height=\"120\" /> </a></div>', 'N', 'N', 'Y', '0000-00-00 00:00:00', 1, 1, '2017-01-23 06:26:39'),
(5, '45689', 'Askgambler', 'Deal or No Deal', 'Sadari sport', 'Deal or No Deal Spins is an online casino built and developed around the popular TV game show Deal or No Deal. It features diverse selection of online slots, offering top titles from leading software providers including NetEnt', 'http://www.askgamblers.com', '30x', 2000000, 0, 0, 'Allow', '1.95', '30', 'Deal_or_No_Deal_Spins_Casino.jpg', 'images/sadari/Deal_or_No_Deal_Spins_Casino.jpg', 3, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\"]', '', '', '<div>\r\n<p><strong>Deal or No Deal Spins</strong> is an&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/online-casinos-p10\">online casino</a> built and developed around the popular TV game show Deal or No Deal. It features diverse selection of online slots, offering top titles from leading software providers including <a class=\"internal-link\" href=\"http://www.askgamblers.com/software/netent\">NetEnt</a>, <strong>IGT, WMS, Amaya, Bally, SG Games,</strong> and <strong>Barcrest Games.</strong> In addition, there are several other casino games. Deal or No Deal Spins is licensed by the Gibraltar Regulatory Authority, and the UK Gambling Commission.</p>\r\n<h2>Restricted Countries and Territories</h2>\r\n<p>Unfortunately, Deal or No Deal Spins does not accept players who reside in a number of restricted regions. These include, but are not limited to, United States of America, Israel, Turkey, Spain, France, Italy, Denmark, Belgium, Gibraltar and Antigua. For the full list of restricted countries, see the Casino Details bellow.</p>\r\n<h2>Virtual Games</h2>\r\n<p>Deal or No Deal Spins is home to over 300 well-known<strong> online slots</strong>. Plenty of favorites are available, including high-quality titles such as&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/starburst-g4022\">Starburst slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/blood-suckers-netent-game-review/\">Bloodsuckers slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/druidess-gold-amaya-chartwell-game-review/\">Druidess Gold slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/kiss-g4371\">Kiss slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/zeus-iii-wms-williams-interactive-game-review/\">Zeus III slot</a>,&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/sunshine-reef-microgaming-game-review/\">Sunshine Reef slot</a> among others.</p>\r\n<p>However, Deal or No Deal Spins has only several<strong> table games</strong> to offer. These include Baccarat, European Roulette, Oasis Poker, and Texas Hold&rsquo;em.</p>\r\n<p>Players also have access to limited selection of<strong> video poker games</strong>, which includes Tens or Better, and Deuces Wild.</p>\r\n<h2>Mobile Gaming</h2>\r\n<p>Deal or No Deal Spins is available to players via their mobile devices. Those who are interested need only to load the casino on their mobile browser. Practically all modern <strong>smartphones</strong> and <strong>tablets</strong> are supported, and no downloads are needed to get in on the action.</p>\r\n<h2>Support</h2>\r\n<p>Deal or No Deal Spins Casino has support agents <strong>available 24/7</strong>. The fastest way to get in touch is through their <strong>help room</strong>, however, players need to be logged in to have access to this feature. Alternatively, UK players have the toll-free number at their disposal. Furthermore, players can also get in touch with the support team via e-mail or see the FAQ section.</p>\r\n<h2>Security and Fairness</h2>\r\n<p>Deal or No Deal Spins protects players on all parts of the website with <strong>SSL encryption.</strong> This technology makes it practically <strong>impossible for anyone to be able to read any information sent to the casino</strong> for any purpose, including personal and financial details.</p>\r\n<p>All of the games at Deal or No Deal Spins meet the strict <strong>fairness standards of the UKGC</strong>.</p>\r\n</div>\r\n<h2>Pros</h2>\r\n<ul class=\"uilist\">\r\n<li>Includes top slots from leading providers</li>\r\n<li>Live chat, phone, and email support available 24/7</li>\r\n<li>Available on desktop and mobile</li>\r\n<li>Secured with SSL encryption</li>\r\n<li>Meets the strict requirements of UKGC</li>\r\n</ul>\r\n<h2>Cons</h2>\r\n<ul class=\"uilist\">\r\n<li>Limited range of virtual table games video poker</li>\r\n<li>48-72 hours pending period</li>\r\n<li>Long withdrawal hours</li>\r\n</ul>\r\n<h2>Website Preview</h2>\r\n<div class=\"screenshot__casino\"><a class=\"image-popup-vertical-fit\" title=\"Deal or No Deal Spins Casino\" href=\"http://www.askgamblers.com/uploads/dealornodealspins-ss-5756ba4c7528f725688b4596.jpg\"> <img src=\"http://www.askgamblers.com/uploads/casino-screenshots/dealornodealspins-ss-5756ba4c7528f725688b4596.jpg\" height=\"120\" /> </a></div>', 'Y', 'H', 'Y', '0000-00-00 00:00:00', 1, 1, '2016-06-09 03:39:55'),
(6, '696964', 'Betting ways', 'BettingWays Casino', 'Sadari sport', 'BettingWays Casino is an online casino with a wide selection of casino games and a well-developed sportsbook.', 'http://bettingways.com', '30x', 500000, 0, 0, 'Allow', '1.95', '100', 'BettingWays_Casino.png', 'images/sadari/BettingWays_Casino.png', 4, '[\"Languages\",\"Established\",\"Maximum Cashout\",\"Maximum Bonus Amount\"]+[\"English\",\"2015\",\"5000 EUR per week\",\"150%\"]', 'test', '', '<div>\r\n<p><strong>BettingWays Casino</strong> is an&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/online-casinos-p10\">online casino</a> with a wide selection of casino games and a well-developed sportsbook. Since BettingWays Casino is a <a class=\"internal-link\" href=\"http://www.askgamblers.com/software/netent\">NetEnt</a>&nbsp;casino, players can enjoy a wide range of <a class=\"internal-link\" href=\"http://www.askgamblers.com/software/netent/games\">NetEnt slots</a>, as well as slots by <strong>Portomaso Gaming</strong> and <strong>Euro Games Technology.</strong> The casino offers both live games and the option of gambling on the move. BettingWays Casino is licensed by Curacao eGaming.</p>\r\n<h2>Restricted Countries and Territories</h2>\r\n<p>Players from France, Turkey and the United States of America cannot be accepted at the online casino.</p>\r\n<h2>Virtual Games</h2>\r\n<p>BettingWays Casino offers a large selection of<strong> video slots</strong> by NetEnt, Portomaso Gaming and Euro Games Technology. Their offer includes popular online casino games like <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/gonzos-quest-g3275\">Gonzo&rsquo;s Quest slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/jack-hammer-g3387\">Jack Hammer slot</a>,&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/big-bang-g1003\">Big Bang slot</a> and more. The casino also features progressive slots such as the&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/progressive-slots/arabian-nights-netent-game-review/\">Arabian Nights slot</a> and <a class=\"internal-link\" href=\"http://www.askgamblers.com/progressive-slots/geisha-wonders-netent-game-review/\">Geisha Wonders slot</a>.</p>\r\n<p>The casino&rsquo;s selection of<strong> table games</strong> includes different variants of roulette, blackjack, baccarat and poker, including American Roulette, Double Exposure Blackjack and Oasis Poker.</p>\r\n<p><strong>The video poker category</strong> is scarce and includes Deuces Wild, Jacks or Better, Joker Wild and All American.</p>\r\n<p>Players looking for<strong> specialty games</strong> can play keno at the casino.</p>\r\n<h2>Live Games</h2>\r\n<p>BettingWays Casino offers <strong>a live casino</strong> where players can engage in gambling with live dealers. The games available include several diverse types of live roulette at different tables.</p>\r\n<h2>Mobile Gaming</h2>\r\n<p>Players who enjoy gaming on the move can access BettingWays Casino&rsquo;s selection of casino games and online slots via their <strong>mobile device</strong>.</p>\r\n<h2>Support</h2>\r\n<p>Unfortunately, the casino doesn&rsquo;t offer multiple ways in which players can reach the customer support team. For the time being the only option available is contacting the <strong>customer support via email</strong>.</p>\r\n<h2>Security and Fairness</h2>\r\n<p>The website is secured with the advanced <strong>SSL encryption</strong> <strong>which protects players&rsquo; private information and data</strong>.</p>\r\n<p>While BettingWays Casino hasn&rsquo;t been audited by any third parties, it is the home of NetEnt games which employ <strong>the highly secure RNG technology</strong> and are regularly reviewed in order to be proven fair, thus guaranteeing players&rsquo; safety.</p>\r\n</div>\r\n<h2>Pros</h2>\r\n<ul class=\"uilist\">\r\n<li>Instant play available</li>\r\n<li>Live casino included</li>\r\n<li>Mobile casino open</li>\r\n<li>SSL encryption technology utilized</li>\r\n</ul>\r\n<h2>Cons</h2>\r\n<ul class=\"uilist\">\r\n<li>No live chat available</li>\r\n<li>No third-party certificates present</li>\r\n</ul>\r\n<h2>Website Preview</h2>\r\n<div class=\"screenshot__casino\"><a class=\"image-popup-vertical-fit\" title=\"BettingWays Casino\" href=\"http://www.askgamblers.com/uploads/bettingways-casino-ss-575550527528f7fc108b4687.jpg\"> <img src=\"http://www.askgamblers.com/uploads/casino-screenshots/bettingways-casino-ss-575550527528f7fc108b4687.jpg\" height=\"120\" /> </a></div>', 'Y', 'N', 'Y', '0000-00-00 00:00:00', 1, 1, '2017-02-26 01:14:27'),
(7, 'ASD456', 'bet 365', 'ì•ˆì „í•œë†€ì´í„°ì¶”ì²œí•¨', 'Sadari sport', 'test', 'www.googl.com', 'test', 456789, 15000, 6000000, 'test', 'test', 'test', '', 'images/sadari/test.png', 5, '[\"Establish\"]+[\"2016\"]', 'ë‹¨í´ë”ë°°íŒ…,Each Way', '1X(ìž…ê¸ˆì•¡+ë³´ë„ˆìŠ¤)', '<p>test</p>', 'N', 'N', 'N', '0000-00-00 00:00:00', 1, 1, '2017-02-26 12:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `tblSadariSportsComment`
--

CREATE TABLE `tblSadariSportsComment` (
  `id` int(11) UNSIGNED NOT NULL,
  `sportsId` int(11) UNSIGNED NOT NULL,
  `userId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gdComments` mediumtext COLLATE utf8_unicode_ci,
  `badComments` mediumtext COLLATE utf8_unicode_ci,
  `rating` int(11) NOT NULL DEFAULT '3',
  `isRecommanded` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkUser` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checksiteAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblSadariSportsComment`
--

INSERT INTO `tblSadariSportsComment` (`id`, `sportsId`, `userId`, `gdComments`, `badComments`, `rating`, `isRecommanded`, `checkUser`, `checkAdmin`, `checksiteAdmin`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(2, 1, '3', 'i like this website', 'i dont like this website', 3, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-05-30 22:55:26'),
(3, 5, '3', 'love this sports', 'this sports does not have free spin bonus', 3, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-05-30 22:58:46'),
(4, 6, '3', 'test1', 'test1', 5, 'Y', 'N', 'Y', 'Y', '0000-00-00 00:00:00', 3, 3, '2017-02-05 14:18:56'),
(6, 6, '22', 'test3', 'test3', 4, 'Y', 'N', 'Y', 'Y', '0000-00-00 00:00:00', 3, 3, '2016-06-30 10:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `tblSlider`
--

CREATE TABLE `tblSlider` (
  `id` int(11) UNSIGNED NOT NULL,
  `sliderImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sliderRespImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sliderImageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sliderHeading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sliderText` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buttonOne` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buttonTwo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblSlider`
--

INSERT INTO `tblSlider` (`id`, `sliderImage`, `sliderRespImage`, `sliderImageName`, `sliderHeading`, `sliderText`, `buttonOne`, `buttonTwo`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(0, '', '', 'tesatebwebae.png', 'test', '<p>testetsateset</p>', 'test+www.google.com+green', 'test+www.google.com+red', '0000-00-00 00:00:00', 1, 1, '2018-01-30 18:09:37'),
(1, 'images/slider/slider_01.png', 'images/slider/responsive/slider_01.png', 'slider_01.png', 'This is first slider', 'first test slider', 'read more+www.google.com+red', 'read more+www.google.com+green', '0000-00-00 00:00:00', 0, 0, '2016-05-24 14:46:04'),
(2, 'images/slider/slider_02.png', 'images/slider/responsive/slider_02.png', 'slider_02.png', 'Play your Beloved Sports and get free Spin Daily', 'Sed ut perspiciatis unde omnis iste natus error sit accusantium dolore', 'read more+www.google.com+green', 'read more+www.google.com+green', '0000-00-00 00:00:00', 0, 0, '2016-05-24 14:50:14'),
(3, 'images/slider/slider_03.png', 'images/slider/responsive/slider_03.png', 'slider_03.png', 'Play your Beloved Sports and get free Spin Daily', 'Sed ut perspiciatis unde omnis iste natus\r\nerror sit accusantium dolore', 'read more+www.google.com+red', 'read more+www.google.com+green', '0000-00-00 00:00:00', 0, 0, '2016-05-24 14:51:03'),
(4, 'images/slider/slider_04.png', 'images/slider/responsive/slider_04.png', 'slider_04.png', 'Play your Beloved Sports and get free Spin Daily', '<p>Ha haaa this is <a href=\"http://www.google.com\" target=\"_blank\">HOT AS HADEX ONLINE SALOT</a></p>', 'read more+www.google.com+red', 'JOIN US HADEX ONLINE+www.google.com+green', '0000-00-00 00:00:00', 0, 1, '2016-06-13 03:37:11');

-- --------------------------------------------------------

--
-- Table structure for table `tblSportsComment`
--

CREATE TABLE `tblSportsComment` (
  `id` int(11) UNSIGNED NOT NULL,
  `sportsId` int(11) UNSIGNED NOT NULL,
  `userId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gdComments` mediumtext COLLATE utf8_unicode_ci,
  `badComments` mediumtext COLLATE utf8_unicode_ci,
  `rating` int(11) NOT NULL DEFAULT '3',
  `isRecommanded` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkUser` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checkAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `checksiteAdmin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblSportsComment`
--

INSERT INTO `tblSportsComment` (`id`, `sportsId`, `userId`, `gdComments`, `badComments`, `rating`, `isRecommanded`, `checkUser`, `checkAdmin`, `checksiteAdmin`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(3, 26, '22', 'love this sports', 'this sports does not have free spin bonus', 3, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-05-30 22:58:46'),
(6, 14, '3', 'i like this sports', 'i dont like its bonus', 3, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-05-31 04:49:45'),
(7, 26, '22', 'I like this sports', 'i dont like this sports', 4, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-06-28 05:55:02'),
(8, 17, '22', 'This sports is good', 'Bonus are bad for this sports', 3, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 22, 22, '2016-06-28 05:57:47'),
(9, 17, '23', 'everything about this sports is very good', '', 2, 'Y', 'N', 'Y', 'Y', '0000-00-00 00:00:00', 23, 23, '2016-06-28 05:59:18'),
(10, 1, '3', 'Test 1', 'Test 1', 3, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-06-29 12:02:09'),
(11, 1, '3', 'Test 1', 'Test 1', 3, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 3, 3, '2016-06-29 12:05:25'),
(13, 17, '22', 'test4', 'test4', 5, 'Y', 'N', 'Y', 'Y', '0000-00-00 00:00:00', 22, 22, '2016-06-30 03:04:53'),
(15, 2, '3', 'Hi Test 1', 'Hi Test 1', 5, 'Y', 'N', 'N', 'N', '0000-00-00 00:00:00', 3, 3, '2016-06-30 06:45:24'),
(16, 2, '3', 'Hi Test 2', 'Hi Test 2', 3, 'Y', 'N', 'N', 'N', '0000-00-00 00:00:00', 3, 3, '2016-06-30 06:49:20'),
(17, 29, '1', 'test', 'tres', 4, 'Y', 'N', 'Y', 'N', '0000-00-00 00:00:00', 1, 1, '2017-02-18 11:30:28'),
(18, 29, '3', 'ㅈㄷㄹㅈㄷㄹ', 'ㅈㄷㄹㅈㄷㄹ', 5, 'N', 'N', 'N', 'N', '0000-00-00 00:00:00', 3, 3, '2018-01-23 19:27:53'),
(21, 32, '1', '테스트중입니ㅏㄷ.', '테스트중입니ㅏㄷ.', 5, 'N', 'N', 'N', 'N', '0000-00-00 00:00:00', 1, 1, '2018-01-27 18:22:55'),
(22, 29, '3', '테스트중중', '테스트중중', 5, 'N', 'N', 'N', 'N', '0000-00-00 00:00:00', 3, 3, '2018-01-28 08:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `tblUser`
--

CREATE TABLE `tblUser` (
  `id` int(11) UNSIGNED NOT NULL,
  `parentId` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `userId` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nickName` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `groupId` int(11) UNSIGNED NOT NULL DEFAULT '3' COMMENT '`tblUserGroup`->`id`',
  `siteName` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdOn` datetime NOT NULL,
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the modifier of user',
  `isActive` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `isDelete` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `emailValid` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `secureLog` int(11) DEFAULT NULL,
  `hash` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblUser`
--

INSERT INTO `tblUser` (`id`, `parentId`, `userId`, `nickName`, `email`, `password`, `groupId`, `siteName`, `createdOn`, `updatedOn`, `createdBy`, `updatedBy`, `isActive`, `isDelete`, `emailValid`, `secureLog`, `hash`) VALUES
(1, 0, 'brandhot100', 'Harry', 'koge4561@gmail.com', 'test123', 0, '', '2016-05-24 17:50:12', '2016-05-26 17:51:31', 0, 1, 'Y', 'N', 'Y', 210347, NULL),
(3, 0, 'dpi90', 'test', 'ani12081@gmail.com', 'test123', 2, 'royal casino', '0000-00-00 00:00:00', '2016-05-26 17:11:15', 0, 0, 'Y', 'N', 'Y', NULL, NULL),
(22, 0, 'vbb89', 'test123', 'admin@gmail.com', 'test1234', 3, NULL, '0000-00-00 00:00:00', '2018-01-27 20:56:22', 0, 22, 'Y', 'N', 'Y', NULL, NULL),
(23, 0, 'bunny89', 'Bunny', 'bunny@gmail.com', 'test123', 2, 'Drake Casino', '0000-00-00 00:00:00', '2016-05-26 23:27:47', 0, 1, 'Y', 'N', 'Y', NULL, NULL),
(24, 0, 'tom67', 'tommy', 'test@bettingway.com', 'test123', 2, 'Betting ways', '0000-00-00 00:00:00', '2016-07-05 06:39:35', 0, 1, 'Y', 'N', 'Y', NULL, NULL),
(28, 0, 'test123', 'test123', 'ani1208123@gmail.com', 'test123', 3, NULL, '0000-00-00 00:00:00', '2017-02-25 06:48:35', 0, 0, 'Y', 'N', 'N', NULL, '8fecb20817b3847419bb3de39a609afe'),
(29, 0, 'test', 'test', 'ani12@gmail.com', 'test123', 3, NULL, '0000-00-00 00:00:00', '2017-02-25 08:30:19', 0, 0, 'Y', 'N', 'Y', NULL, '1bb91f73e9d31ea2830a5e73ce3ed328'),
(30, 0, 'anirban67', 'anirban paul', 'anirban67@gmail.com', 'test123', 3, NULL, '0000-00-00 00:00:00', '2017-02-25 12:31:05', 0, 0, 'Y', 'N', 'Y', NULL, '6c3cf77d52820cd0fe646d38bc2145ca'),
(31, 0, 'anirban76', 'Anirban', 'anirban.ivanweb@gmail.com', 'test123', 3, NULL, '0000-00-00 00:00:00', '2017-02-26 20:54:30', 0, 0, 'Y', 'N', 'Y', NULL, 'a01a0380ca3c61428c26a231f0e49a09'),
(32, 0, 'test123', 'kevin', 'skdkxlwkd22@gmail.com', 'sss12345', 3, NULL, '0000-00-00 00:00:00', '2017-02-28 04:14:19', 0, 0, 'Y', 'N', 'Y', NULL, '7fa732b517cbed14a48843d74526c11a'),
(33, 0, 'sam123', '???', 'greaggplumb@gmail.com', 'sss12345', 3, NULL, '0000-00-00 00:00:00', '2018-01-22 09:03:29', 0, 0, 'Y', 'N', 'Y', NULL, '218a0aefd1d1a4be65601cc6ddc1520e');

-- --------------------------------------------------------

--
-- Table structure for table `tblUserAccess`
--

CREATE TABLE `tblUserAccess` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '`tblUser`->`id`',
  `role` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `modifiedBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id',
  `updateOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblUserDetails`
--

CREATE TABLE `tblUserDetails` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '`tblUser`->`id`',
  `firstName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` enum('M','F','T') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'M' COMMENT 'M = Male, F = Female, T = Transgender/Other',
  `dob` date DEFAULT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `settings` mediumtext COLLATE utf8_unicode_ci,
  `zipCodeId` int(11) NOT NULL COMMENT '`tblZipCode`->`id`',
  `cityId` int(11) NOT NULL COMMENT '`tblCity`->`id`',
  `stateId` int(11) NOT NULL COMMENT '`tblState`->`id`',
  `countryId` int(11) NOT NULL COMMENT '`tblCountries`->`id`',
  `mobileNo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `landlineNo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternateNo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblUserDetails`
--

INSERT INTO `tblUserDetails` (`id`, `firstName`, `lastName`, `designation`, `gender`, `dob`, `address`, `settings`, `zipCodeId`, `cityId`, `stateId`, `countryId`, `mobileNo`, `landlineNo`, `alternateNo`, `updatedBy`, `updatedOn`) VALUES
(1, 'Anirban', 'Paul', 'Administrator', 'M', '1993-03-29', '1/10, East Boalia, Garia Sation', NULL, 1, 1, 1, 99, '+919830344377', '', '', 0, '2016-05-24 12:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblUserGroup`
--

CREATE TABLE `tblUserGroup` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `createdBy` int(11) NOT NULL,
  `updateOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblUserGroup`
--

INSERT INTO `tblUserGroup` (`id`, `title`, `role`, `createdBy`, `updateOn`) VALUES
(1, 'Administrator', '{}', 0, '2016-05-24 12:20:12'),
(2, 'Site Admin', '{}', 0, '2016-05-24 12:20:12'),
(3, 'User', '{}', 0, '2016-05-24 12:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblWebCards`
--

CREATE TABLE `tblWebCards` (
  `id` int(11) UNSIGNED NOT NULL,
  `joinCode` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `siteName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sportsName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sportsType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maxPrizeMoney` varbinary(255) NOT NULL,
  `singleBet` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `crossBetting` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `welcomeBonus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `miniGame` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sportsImage` mediumtext COLLATE utf8_unicode_ci,
  `sportsReview` mediumtext COLLATE utf8_unicode_ci,
  `rating` int(11) NOT NULL DEFAULT '3',
  `sportsOtherDetails` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isRecommanded` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `isHot` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'H',
  `bettingOption` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dwMethods` varbinary(100) DEFAULT NULL,
  `maxWithdrawlLimit` varbinary(255) DEFAULT NULL,
  `maxBettingAmount` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `minBettingAmount` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstDepositeBonus` varbinary(100) DEFAULT NULL,
  `dailyBonus` varbinary(100) DEFAULT NULL,
  `rebateBonus` varbinary(100) DEFAULT NULL,
  `rollingBonus` varbinary(100) DEFAULT NULL,
  `established` varbinary(100) DEFAULT NULL,
  `liveChat` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT NULL,
  `liveChatText` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `isPin` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL COMMENT '`tblUser`->`id`, Logged In user Id, Who is the creator of the user for first time',
  `updatedBy` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblWebCards`
--

INSERT INTO `tblWebCards` (`id`, `joinCode`, `siteName`, `sportsName`, `sportsType`, `description`, `link`, `maxPrizeMoney`, `singleBet`, `crossBetting`, `welcomeBonus`, `miniGame`, `imageName`, `sportsImage`, `sportsReview`, `rating`, `sportsOtherDetails`, `isRecommanded`, `isHot`, `bettingOption`, `dwMethods`, `maxWithdrawlLimit`, `maxBettingAmount`, `minBettingAmount`, `firstDepositeBonus`, `dailyBonus`, `rebateBonus`, `rollingBonus`, `established`, `liveChat`, `liveChatText`, `isPin`, `createdOn`, `createdBy`, `updatedBy`, `updatedOn`) VALUES
(1, '69696', '안전한놀이터추천함', '안전한놀이터추천함', 'Newest sport,Verified sport,Sports', 'online sports test online sports testonline sports testonline sports testonline sports test', 'www.google1.com', 0x38303030303030, '50%', 'Allow', '10%', 'Power ball', 'online_sports1.jpg', 'images/online_sports1.jpg', '<p>BettingWays Casino is an online casino with a wide selection of casino games and a well-developed sportsbook. Since BettingWays Casino is a NetEnt casino, players can enjoy a wide range of NetEnt slots, as well as slots by Portomaso Gaming and Euro Games Technology. The casino offers both live games and the option of gambling on the move. BettingWays Casino is licensed by Curacao eGaming. Restricted Countries and Territories Players from France, Turkey and the United States of America cannot be accepted at the online casino. Virtual Games BettingWays Casino offers a large selection of video slots by NetEnt, Portomaso Gaming and Euro Games Technology. Their offer includes popular online casino games like Gonzo&iuml;&iquest;&frac12;s Quest slot, Jack Hammer slot, Big Bang slot and more. The casino also features progressive slots such as the Arabian Nights slot and Geisha Wonders slot. The casino&iuml;&iquest;&frac12;s selection of table games includes different variants of roulette, blackjack, baccarat and poker, including American Roulette, Double Exposure Blackjack and Oasis Poker. The video poker category is scarce and includes Deuces Wild, Jacks or Better, Joker Wild and All American. Players looking for specialty games can play keno at the casino. Live Games BettingWays Casino offers a live casino where players can engage in gambling with live dealers. The games available include several diverse types of live roulette at different tables. Mobile Gaming Players who enjoy gaming on the move can access BettingWays Casino&iuml;&iquest;&frac12;s selection of casino games and online slots via their mobile device. Support Unfortunately, the casino doesn&iuml;&iquest;&frac12;t offer multiple ways in which players can reach the customer support team. For the time being the only option available is contacting the customer support via email. Security and Fairness The website is secured with the advanced SSL encryption which protects players&iuml;&iquest;&frac12; private information and data. While BettingWays Casino hasn&iuml;&iquest;&frac12;t been audited by any third parties, it is the home of NetEnt games which employ the highly secure RNG technology and are regularly reviewed in order to be proven fair, thus guaranteeing players&iuml;&iquest;&frac12; safety. Pros Instant play available Live casino included Mobile casino open SSL encryption technology utilized Cons No live chat available No third-party certificates present Website Preview</p>', 4, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'N', 'N', '', 0xec98a4ebb0b1eba78cec9b90, 0xec98a4ebb0b1eba78cec9b90, '0', '0', 0xec98a4ebb0b1eba78cec9b90, 0xec98a4ebb0b1eba78cec9b90, 0xec98a4ebb0b1eba78cec9b90, 0xec98a4ebb0b1eba78cec9b90, 0xec98a4ebb0b1eba78cec9b90, 'Y', '', 'Y', '0000-00-00 00:00:00', 0, 1, '2018-01-28 08:21:31'),
(2, '69696968', ' name royal casino', 'Sadari Sports', 'Online sport,Sports', 'online sports testonline sports testonline sports test', 'www.google2.com', 0x38303030303030, '50%', 'Allow', '10%', 'Power ball', 'online_sports2.png', 'images/online_sports2.png', '\n\nBettingWays Casino is an online casino with a wide selection of casino games and a well-developed sportsbook. Since BettingWays Casino is a NetEnt casino, players can enjoy a wide range of NetEnt slots, as well as slots by Portomaso Gaming and Euro Games Technology. The casino offers both live games and the option of gambling on the move. BettingWays Casino is licensed by Curacao eGaming.\nRestricted Countries and Territories\n\nPlayers from France, Turkey and the United States of America cannot be accepted at the online casino.\nVirtual Games\n\nBettingWays Casino offers a large selection of video slots by NetEnt, Portomaso Gaming and Euro Games Technology. Their offer includes popular online casino games like Gonzo’s Quest slot, Jack Hammer slot, Big Bang slot and more. The casino also features progressive slots such as the Arabian Nights slot and Geisha Wonders slot.\n\nThe casino’s selection of table games includes different variants of roulette, blackjack, baccarat and poker, including American Roulette, Double Exposure Blackjack and Oasis Poker.\n\nThe video poker category is scarce and includes Deuces Wild, Jacks or Better, Joker Wild and All American.\n\nPlayers looking for specialty games can play keno at the casino.\nLive Games\n\nBettingWays Casino offers a live casino where players can engage in gambling with live dealers. The games available include several diverse types of live roulette at different tables.\nMobile Gaming\n\nPlayers who enjoy gaming on the move can access BettingWays Casino’s selection of casino games and online slots via their mobile device.\nSupport\n\nUnfortunately, the casino doesn’t offer multiple ways in which players can reach the customer support team. For the time being the only option available is contacting the customer support via email.\nSecurity and Fairness\n\nThe website is secured with the advanced SSL encryption which protects players’ private information and data.\n\nWhile BettingWays Casino hasn’t been audited by any third parties, it is the home of NetEnt games which employ the highly secure RNG technology and are regularly reviewed in order to be proven fair, thus guaranteeing players’ safety.\nPros\n\n    Instant play available\n    Live casino included\n    Mobile casino open\n    SSL encryption technology utilized\n\nCons\n\n    No live chat available\n    No third-party certificates present\n\nWebsite Preview\n', 4, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'Y', 'H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'N', '0000-00-00 00:00:00', 0, 0, '2016-05-17 01:32:52'),
(4, '69696', 'royal casino', 'Sadari Sports', 'Online sport,Mobile sport,Sports', 'online sports testonline sports test', 'www.google3.com', 0x38303030303030, '50%', 'Allow', '10%', 'Power ball,pinball', 'get_casino.png', 'images/get_casino.png', '\n\nBettingWays Casino is an online casino with a wide selection of casino games and a well-developed sportsbook. Since BettingWays Casino is a NetEnt casino, players can enjoy a wide range of NetEnt slots, as well as slots by Portomaso Gaming and Euro Games Technology. The casino offers both live games and the option of gambling on the move. BettingWays Casino is licensed by Curacao eGaming.\nRestricted Countries and Territories\n\nPlayers from France, Turkey and the United States of America cannot be accepted at the online casino.\nVirtual Games\n\nBettingWays Casino offers a large selection of video slots by NetEnt, Portomaso Gaming and Euro Games Technology. Their offer includes popular online casino games like Gonzo’s Quest slot, Jack Hammer slot, Big Bang slot and more. The casino also features progressive slots such as the Arabian Nights slot and Geisha Wonders slot.\n\nThe casino’s selection of table games includes different variants of roulette, blackjack, baccarat and poker, including American Roulette, Double Exposure Blackjack and Oasis Poker.\n\nThe video poker category is scarce and includes Deuces Wild, Jacks or Better, Joker Wild and All American.\n\nPlayers looking for specialty games can play keno at the casino.\nLive Games\n\nBettingWays Casino offers a live casino where players can engage in gambling with live dealers. The games available include several diverse types of live roulette at different tables.\nMobile Gaming\n\nPlayers who enjoy gaming on the move can access BettingWays Casino’s selection of casino games and online slots via their mobile device.\nSupport\n\nUnfortunately, the casino doesn’t offer multiple ways in which players can reach the customer support team. For the time being the only option available is contacting the customer support via email.\nSecurity and Fairness\n\nThe website is secured with the advanced SSL encryption which protects players’ private information and data.\n\nWhile BettingWays Casino hasn’t been audited by any third parties, it is the home of NetEnt games which employ the highly secure RNG technology and are regularly reviewed in order to be proven fair, thus guaranteeing players’ safety.\nPros\n\n    Instant play available\n    Live casino included\n    Mobile casino open\n    SSL encryption technology utilized\n\nCons\n\n    No live chat available\n    No third-party certificates present\n\nWebsite Preview\n', 2, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'N', 'H', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'N', '0000-00-00 00:00:00', 0, 0, '2016-05-17 09:13:16'),
(14, '69696', 'sports name', 'sports name', 'Online sport,Mobile sport,Sports', 'this is just a dummy description for mobile sports', 'www.google.com4', 0x3530303030303030, '10%', '50%', '10%', 'pinball', 'mobile_sports.jpg', 'images/mobile_sports.jpg', '<div>\r\n<p><strong>RealBet Casino</strong> is a desktop and&nbsp;<a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/mobile-casinos.html\">mobile casino</a> integrated alongside the popular RealBet sportsbook. Players here will find top-of-the-line <strong>Betsoft 3D slots,</strong> numerous casino games, and other favorites from <strong>AceGaming.</strong> The <a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/online-casinos-p10.html\">online casino</a>&nbsp;is instant-play and requires no download on any device. RealBet Casino is licensed under the jurisdiction of Curacao.</p>\r\n<h2>Restricted Countries and Territories</h2>\r\n<p>RealBet Casino is not currently open to residents of several countries and territories. These include Bolivia, Bulgaria, France, Latvia, Lithuania, Nigeria, Peru, Romania, Serbia, Ukraine, and Vietnam, among many others. See our restricted countries list in the casino details section for more details.</p>\r\n<h2>Games</h2>\r\n<p>RealBet Casino provides players with a wide array of <strong>3D video slots</strong> from Betsoft. These include dozens of popular titles with innovative features and stunning graphics, such as <a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/game/slots/madder-scientist-g3990.html\">Madder Scientist slot</a>, <a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/video-slots/pinocchio-betsoft-game-review/index.html\">Pinocchio slot</a>, and <a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/game/slots/paco-and-the-popping-peppers-g3376.html\">Paco and the Popping Peppers slot</a>. A good number of titles from AceGaming are also available, such as&nbsp;<a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/game/slots/the-kings-causdhtle-g4078.html\">King&rsquo;s Ca$tle slot</a> and <strong>Samurai Slot</strong>.</p>\r\n<p>A good number of<strong> table games</strong> are available at RealBet Casino. These include favorites like Baccarat, Craps, Pai Gow Poker, Red Dog, War, and Triple Card Poker, plus multiple Roulette and Blackjack variants. Video poker players also have access to single-hand and multi-hand versions of Double Barrel Bonus, Deuces Wild, Wild Joker, and Jacks or Better.</p>\r\n<p>RealBet Casino is home to <strong>two keno variants</strong>: Instant Keno and Shockwave Keno.</p>\r\n<h2>Mobile Gaming</h2>\r\n<p>A fair number of RealBet Casino&rsquo;s games can be accessed on the go. Players just have to open up the casino&rsquo;s website on their <strong>smartphone</strong> or <strong>tablet</strong> to get started. The touch-based interface makes it easy to go through the different parts of the website.</p>\r\n<h2>Support</h2>\r\n<p>RealBet Casino offers assistance through <strong>a North American toll-free phone number</strong> or an international tolled number. When agents are available this can be a fast way to get help for any particular problem or question. However, support hours are not specified. Players can also reach the support staff via email. No live chat service is offered at this time.</p>\r\n<h2>Security and Fairness</h2>\r\n<p>RealBet Casino uses <strong>SSL encryption</strong> for all financial transactions. However, the website itself is not protected, which does leave players vulnerable to certain kinds of malicious activity.</p>\r\n<p>RealBet Casino&rsquo;s games are provided by <strong>two highly trusted studios that have been audited by independent agencies</strong>. As such, players can count on getting a fair gaming experience.</p>\r\n</div>\r\n<h2>Pros</h2>\r\n<ul class=\"uilist\">\r\n<li>Available to US players</li>\r\n<li>Features top 3D slots and other games from Betsoft and AceGaming</li>\r\n<li>Totally instant-play</li>\r\n<li>Available on desktop and mobile</li>\r\n<li>Toll-free North American phone and international phone support</li>\r\n<li>Proven fair by independent audits</li>\r\n</ul>\r\n<h2>Cons</h2>\r\n<ul class=\"uilist\">\r\n<li>Unavailable to residents of Bulgaria, France, Nigeria, Romania, and several other regions</li>\r\n<li>No live chat support</li>\r\n<li>SSL encryption not implemented on the main website</li>\r\n</ul>\r\n<h2>Website Preview</h2>\r\n<div class=\"screenshot__casino\"><a class=\"image-popup-vertical-fit\" title=\"RealBet Casino\" href=\"file:///E:/rip/gambler/www.askgamblers.com/uploads/original/other/54/d6/32/2c43eb1af49211924f7bb603772140ba39.jpg\"> <img src=\"file:///E:/rip/gambler/www.askgamblers.com/uploads/casino_screenshots/other/54/d6/32/2c43eb1af49211924f7bb603772140ba39.jpg\" height=\"120\" /> </a></div>', 3, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'N', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0x313725, 0x302e3925, 0x312e3225, 0x32303135, 'N', '', 'N', '0000-00-00 00:00:00', 0, 1, '2017-01-20 23:39:55'),
(16, '696964', 'Askgambler', 'BetKings', 'Newest sport,Mobile sport,Sports', 'BettingWays Casino is an online casino with a wide selection of casino games and a well-developed sportsbook. Since BettingWays Casino is a NetEnt casino, players can enjoy a wide range of NetEnt slots', 'http://bettingways1.com', 0x38303030303030, '50%', 'Allow', '20%', 'sadari', 'BetKings_img1.png', 'images/BetKings_img1.png', '<div>\r\n<p><strong>BettingWays Casino</strong> is an&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/online-casinos-p10\">online casino</a> with a wide selection of casino games and a well-developed sportsbook. Since BettingWays Casino is a <a class=\"internal-link\" href=\"http://www.askgamblers.com/software/netent\">NetEnt</a>&nbsp;casino, players can enjoy a wide range of <a class=\"internal-link\" href=\"http://www.askgamblers.com/software/netent/games\">NetEnt slots</a>, as well as slots by <strong>Portomaso Gaming</strong> and <strong>Euro Games Technology.</strong> The casino offers both live games and the option of gambling on the move. BettingWays Casino is licensed by Curacao eGaming.</p>\r\n<h2>Restricted Countries and Territories</h2>\r\n<p>Players from France, Turkey and the United States of America cannot be accepted at the online casino.</p>\r\n<h2>Virtual Games</h2>\r\n<p>BettingWays Casino offers a large selection of<strong> video slots</strong> by NetEnt, Portomaso Gaming and Euro Games Technology. Their offer includes popular online casino games like <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/gonzos-quest-g3275\">Gonzo&rsquo;s Quest slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/jack-hammer-g3387\">Jack Hammer slot</a>,&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/big-bang-g1003\">Big Bang slot</a> and more. The casino also features progressive slots such as the&nbsp;<a class=\"internal-link\" href=\"http://www.askgamblers.com/progressive-slots/arabian-nights-netent-game-review/\">Arabian Nights slot</a> and <a class=\"internal-link\" href=\"http://www.askgamblers.com/progressive-slots/geisha-wonders-netent-game-review/\">Geisha Wonders slot</a>.</p>\r\n<p>The casino&rsquo;s selection of<strong> table games</strong> includes different variants of roulette, blackjack, baccarat and poker, including American Roulette, Double Exposure Blackjack and Oasis Poker.</p>\r\n<p><strong>The video poker category</strong> is scarce and includes Deuces Wild, Jacks or Better, Joker Wild and All American.</p>\r\n<p>Players looking for<strong> specialty games</strong> can play keno at the casino.</p>\r\n<h2>Live Games</h2>\r\n<p>BettingWays Casino offers <strong>a live casino</strong> where players can engage in gambling with live dealers. The games available include several diverse types of live roulette at different tables.</p>\r\n<h2>Mobile Gaming</h2>\r\n<p>Players who enjoy gaming on the move can access BettingWays Casino&rsquo;s selection of casino games and online slots via their <strong>mobile device</strong>.</p>\r\n<h2>Support</h2>\r\n<p>Unfortunately, the casino doesn&rsquo;t offer multiple ways in which players can reach the customer support team. For the time being the only option available is contacting the <strong>customer support via email</strong>.</p>\r\n<h2>Security and Fairness</h2>\r\n<p>The website is secured with the advanced <strong>SSL encryption</strong> <strong>which protects players&rsquo; private information and data</strong>.</p>\r\n<p>While BettingWays Casino hasn&rsquo;t been audited by any third parties, it is the home of NetEnt games which employ <strong>the highly secure RNG technology</strong> and are regularly reviewed in order to be proven fair, thus guaranteeing players&rsquo; safety.</p>\r\n</div>\r\n<h2>Pros</h2>\r\n<ul class=\"uilist\">\r\n<li>Instant play available</li>\r\n<li>Live casino included</li>\r\n<li>Mobile casino open</li>\r\n<li>SSL encryption technology utilized</li>\r\n</ul>\r\n<h2>Cons</h2>\r\n<ul class=\"uilist\">\r\n<li>No live chat available</li>\r\n<li>No third-party certificates present</li>\r\n</ul>\r\n<h2>Website Preview</h2>\r\n<div class=\"screenshot__casino\"><a class=\"image-popup-vertical-fit\" title=\"BettingWays Casino\" href=\"http://www.askgamblers.com/uploads/bettingways-casino-ss-575550527528f7fc108b4687.jpg\"> <img src=\"http://www.askgamblers.com/uploads/casino-screenshots/bettingways-casino-ss-575550527528f7fc108b4687.jpg\" height=\"120\" /> </a></div>', 5, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'Y', 'N', NULL, NULL, NULL, NULL, NULL, NULL, 0x313225, 0x302e3425, 0x312e3225, 0x32303132, 'N', '', 'Y', '0000-00-00 00:00:00', 0, 1, '2016-06-08 20:11:31'),
(17, '69696968', 'Betting ways', 'BettingWays Casino', 'Online sport,Verified sport,Sports', 'The casinoâ€™s selection of table games includes different variants of roulette, blackjack, baccarat and poker, including American Roulette, Double Exposure Blackjack and Oasis Poker.', 'http://bettingways.com', 0x353030, 'ìž…ê¸ˆì•¡ì˜ 50%', 'ê°€ëŠ¥', '20%', 'sadari', 'bettingways_img.jpg', 'images/bettingways_img.jpg', '\n\nBettingWays Casino is an online casino with a wide selection of casino games and a well-developed sportsbook. Since BettingWays Casino is a NetEnt casino, players can enjoy a wide range of NetEnt slots, as well as slots by Portomaso Gaming and Euro Games Technology. The casino offers both live games and the option of gambling on the move. BettingWays Casino is licensed by Curacao eGaming.\nRestricted Countries and Territories\n\nPlayers from France, Turkey and the United States of America cannot be accepted at the online casino.\nVirtual Games\n\nBettingWays Casino offers a large selection of video slots by NetEnt, Portomaso Gaming and Euro Games Technology. Their offer includes popular online casino games like Gonzo’s Quest slot, Jack Hammer slot, Big Bang slot and more. The casino also features progressive slots such as the Arabian Nights slot and Geisha Wonders slot.\n\nThe casino’s selection of table games includes different variants of roulette, blackjack, baccarat and poker, including American Roulette, Double Exposure Blackjack and Oasis Poker.\n\nThe video poker category is scarce and includes Deuces Wild, Jacks or Better, Joker Wild and All American.\n\nPlayers looking for specialty games can play keno at the casino.\nLive Games\n\nBettingWays Casino offers a live casino where players can engage in gambling with live dealers. The games available include several diverse types of live roulette at different tables.\nMobile Gaming\n\nPlayers who enjoy gaming on the move can access BettingWays Casino’s selection of casino games and online slots via their mobile device.\nSupport\n\nUnfortunately, the casino doesn’t offer multiple ways in which players can reach the customer support team. For the time being the only option available is contacting the customer support via email.\nSecurity and Fairness\n\nThe website is secured with the advanced SSL encryption which protects players’ private information and data.\n\nWhile BettingWays Casino hasn’t been audited by any third parties, it is the home of NetEnt games which employ the highly secure RNG technology and are regularly reviewed in order to be proven fair, thus guaranteeing players’ safety.\nPros\n\n    Instant play available\n    Live casino included\n    Mobile casino open\n    SSL encryption technology utilized\n\nCons\n\n    No live chat available\n    No third-party certificates present\n\nWebsite Preview\n', 3, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'N', 'H', NULL, NULL, NULL, NULL, NULL, NULL, 0x3525, 0x302e3325, 0x312e3125, 0x32303133, 'Y', '', 'N', '0000-00-00 00:00:00', 0, 1, '2016-06-09 02:07:17'),
(26, '789456', 'Drake Casino', 'Drake Casino', 'Online sport,Newest sport,Verified sport,Mobile sport,Sports', 'Drake Casino is an online casino with a sleek design powered by the Betsoft platform. The casino offers 3D video slots and other casino games directly through its website, available either on a computer or on the go. Drake Casino is licensed by the government of Curacao.', 'http://www.drakecasino.eu', 0x35303030303030, '75%', 'Allow', '65%', 'Power Ball', 'Dark_casino.jpg', 'images/web/Dark_casino.jpg', '<div>\r\n<div>\r\n<p><strong>Drake Casino</strong> is an <a class=\"internal-link\" href=\"http://www.askgamblers.com/online-casinos-p10\">online casino</a>&nbsp;with a sleek design powered by the <a class=\"internal-link\" href=\"http://www.askgamblers.com/software/betsoft\">Betsoft</a>&nbsp;platform. The casino offers 3D video slots and other casino games directly through its website, available either on a computer or on the go. Drake Casino is licensed by the government of Curacao.</p>\r\n<h2>Restricted Countries</h2>\r\n<p>Drake Casino cannot accept players in any of the following countries: Antigua and Barbuda, China, Curacao, Israel, Libya, Myanmar, the Netherlands, Nigeria, North Korea, Sierra Leone, Somalia, and Syria.</p>\r\n<h2>Games</h2>\r\n<p>Drake Casino is most well-known for its extensive collection of <strong>3D bonus video slots</strong> from Betsoft. These include titles such as <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/mr-vegas-g3227\">Mr. Vegas slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/arrival-g3377\">Arrival slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/the-exterminator-g4157\">The Exterminator slot</a>, <a class=\"internal-link\" href=\"http://www.askgamblers.com/video-slots/viking-age-betsoft-game-review/\">Viking Age slot</a>, and <a class=\"internal-link\" href=\"http://www.askgamblers.com/game/slots/whospunit-g4429\">Who Spun It slot</a>. The casino also offers more traditional slots for players who prefer a more simple gaming experience.</p>\r\n<p>The selection of <strong>table games</strong> at Drake Casino is one of the most diverse in the online gaming world. A wide range of games are available, and most of the games have several different variants. Keep things simple with games like baccarat, American blackjack, craps, and European roulette, or try something more unique like Common Draw Roulette, Top Card Trumps, Oasis Poker, and Pirate 21, among many others.</p>\r\n<p>Drake Casino&#039;s <strong>video poker selection</strong> is also impressive. Players can choose to play almost any of the variants in single-hand mode, multi-hand mode, or Pyramid Poker mode. Available variants include standard games like Jacks or Better and All-American Poker, wildcard games like Joker Poker and Deuces Wild, and several jackpot and bonus pokers.</p>\r\n<h2>Mobile Gaming</h2>\r\n<p>Many of Drake Casino&#039;s most popular slots and table games are available for mobile users. The games are compatible with most <strong>Apple</strong> and <strong>Android devices</strong>. To play, simply visit the Drake Casino website while on your device. You&#039;ll instantly be redirected to the mobile version of the casino, where you can log in with your existing account information or create an account if you do not already have one.</p>\r\n<h2>Support</h2>\r\n<p>We are pleased with the quality and availability of Drake Casino&#039;s support staff. During most hours (<strong>9AM to midnight GMT, 7 days a week</strong>), representatives are available through the casino&#039;s online <strong>live chat</strong> interface. Players can also call the casino using a toll-free North American number or international number during these hours. Four different email addresses are available as well to assist with different types of inquiries.</p>\r\n<h2>Security and Fairness</h2>\r\n<p>Drake Casino does all of the things that an online casino should do to protect its players. <strong>Any sensitive data is kept encrypted through 128-bit SSL technology</strong> from VeriSign, one of the world&#039;s best online security companies. Additionally, Drake Casino is bound by a privacy policy to prevent third parties from obtaining your personal information.</p>\r\n<p>The Betsoft platform used by Drake Casino is continually <strong>audited by TST for fairness purposes</strong>. While it would be nice if this information was available on Drake Casino&#039;s website, players can go to Betsoft&#039;s site to quickly see the most recent audit. All tests meet the high standards of the Alderney Gambling Control Commission.</p>\r\n</div>\r\n</div>\r\n<h2>Pros</h2>\r\n<ul class=\"uilist\">\r\n<li>Available to US players</li>\r\n<li>Instant-play gaming</li>\r\n<li>Select games on Apple and Android devices</li>\r\n<li>Full range of 3D video slots, table games, and video pokers, among others</li>\r\n<li>Live chat and phone support available during most hours of each day</li>\r\n<li>Secured with 128-bit SSL encryption</li>\r\n<li>Proven fair by TST</li>\r\n</ul>\r\n<h2>Cons</h2>\r\n<ul class=\"uilist\">\r\n<li>Unavailable to residents of the Netherlands, China, and some other countries</li>\r\n<li>Live chat not available between midnight and 9AM</li>\r\n<li>Users outside of North America may be charged for international phone support</li>\r\n</ul>\r\n<h2>Website Preview</h2>\r\n<div class=\"screenshot__casino\"><a class=\"image-popup-vertical-fit\" title=\"Drake Casino\" href=\"http://www.askgamblers.com/uploads/drake-casino-ss-5357b6e770a0f8450d8b518a.png\"> <img src=\"http://www.askgamblers.com/uploads/casino-screenshots/drake-casino-ss-5357b6e770a0f8450d8b518a.png\" height=\"120\" /> </a></div>', 4, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'N', 'N', NULL, NULL, 0x3130302c3030302c30303020706572207765656b, NULL, NULL, NULL, 0x313025, 0x302e3225, 0x312e3025, 0x32303130, 'Y', '', 'Y', '0000-00-00 00:00:00', 1, 1, '2016-11-02 00:33:39'),
(29, '123546', '안전한놀이터', '안전한놀이터', 'Online sport,Newest sport,Verified sport,Bitcoin sport,Sports', 'ê°„í˜¹ ë°°íŒ… ì‚¬ì´íŠ¸ì—ì„œëŠ” ë‹¤ì–‘í•œ ì´ìœ ë¥¼ ë“¤ë¨¹ì´ë©° ì¶œê¸ˆì„ ì§€ì—°í•˜ëŠ” ê²½ìš°ê°€ ë§ŽìŠµë‹ˆë‹¤. ì¶œê¸ˆ ì§€ì—°ì€ ì–¸ì œë‚˜ ìœ ì €ë“¤ì„ ê´´ë¡­ê²Œí•˜ë©° ê°€ìž¥ ì‹ ê²½ì“°ì´ê²Œ ë§Œë“œëŠ” ë¶€ë¶„ ì¤‘ í•˜ë‚˜ ì¼ ê²ƒìž…ë‹ˆë‹¤.', 'www.google.com', 0x35303030303030, '10%', '45%', '20%', '', 'í•´ì™¸ë°°íŒ…ì‚¬ì´íŠ¸.jpg', 'images/web/í•´ì™¸ë°°íŒ…ì‚¬ì´íŠ¸.jpg', '<div>\r\n<p><strong>RealBet Casino</strong> is a desktop and&nbsp;<a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/mobile-casinos.html\">mobile casino</a> integrated alongside the popular RealBet sportsbook. Players here will find top-of-the-line <strong>Betsoft 3D slots,</strong> numerous casino games, and other favorites from <strong>AceGaming.</strong> The <a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/online-casinos-p10.html\">online casino</a>&nbsp;is instant-play and requires no download on any device. RealBet Casino is licensed under the jurisdiction of Curacao.</p>\r\n<h2>Restricted Countries and Territories</h2>\r\n<p>RealBet Casino is not currently open to residents of several countries and territories. These include Bolivia, Bulgaria, France, Latvia, Lithuania, Nigeria, Peru, Romania, Serbia, Ukraine, and Vietnam, among many others. See our restricted countries list in the casino details section for more details.</p>\r\n<h2>Games</h2>\r\n<p>RealBet Casino provides players with a wide array of <strong>3D video slots</strong> from Betsoft. These include dozens of popular titles with innovative features and stunning graphics, such as <a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/game/slots/madder-scientist-g3990.html\">Madder Scientist slot</a>, <a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/video-slots/pinocchio-betsoft-game-review/index.html\">Pinocchio slot</a>, and <a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/game/slots/paco-and-the-popping-peppers-g3376.html\">Paco and the Popping Peppers slot</a>. A good number of titles from AceGaming are also available, such as&nbsp;<a class=\"internal-link\" href=\"file:///E:/rip/gambler/www.askgamblers.com/game/slots/the-kings-causdhtle-g4078.html\">King&rsquo;s Ca$tle slot</a> and <strong>Samurai Slot</strong>.</p>\r\n<p>A good number of<strong> table games</strong> are available at RealBet Casino. These include favorites like Baccarat, Craps, Pai Gow Poker, Red Dog, War, and Triple Card Poker, plus multiple Roulette and Blackjack variants. Video poker players also have access to single-hand and multi-hand versions of Double Barrel Bonus, Deuces Wild, Wild Joker, and Jacks or Better.</p>\r\n<p>RealBet Casino is home to <strong>two keno variants</strong>: Instant Keno and Shockwave Keno.</p>\r\n<h2>Mobile Gaming</h2>\r\n<p>A fair number of RealBet Casino&rsquo;s games can be accessed on the go. Players just have to open up the casino&rsquo;s website on their <strong>smartphone</strong> or <strong>tablet</strong> to get started. The touch-based interface makes it easy to go through the different parts of the website.</p>\r\n<h2>Support</h2>\r\n<p>RealBet Casino offers assistance through <strong>a North American toll-free phone number</strong> or an international tolled number. When agents are available this can be a fast way to get help for any particular problem or question. However, support hours are not specified. Players can also reach the support staff via email. No live chat service is offered at this time.</p>\r\n<h2>Security and Fairness</h2>\r\n<p>RealBet Casino uses <strong>SSL encryption</strong> for all financial transactions. However, the website itself is not protected, which does leave players vulnerable to certain kinds of malicious activity.</p>\r\n<p>RealBet Casino&rsquo;s games are provided by <strong>two highly trusted studios that have been audited by independent agencies</strong>. As such, players can count on getting a fair gaming experience.</p>\r\n</div>\r\n<h2>Pros</h2>\r\n<ul class=\"uilist\">\r\n<li>Available to US players</li>\r\n<li>Features top 3D slots and other games from Betsoft and AceGaming</li>\r\n<li>Totally instant-play</li>\r\n<li>Available on desktop and mobile</li>\r\n<li>Toll-free North American phone and international phone support</li>\r\n<li>Proven fair by independent audits</li>\r\n</ul>\r\n<h2>Cons</h2>\r\n<ul class=\"uilist\">\r\n<li>Unavailable to residents of Bulgaria, France, Nigeria, Romania, and several other regions</li>\r\n<li>No live chat support</li>\r\n<li>SSL encryption not implemented on the main website</li>\r\n</ul>\r\n<h2>Website Preview</h2>\r\n<div class=\"screenshot__casino\">&nbsp;</div>', 5, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'N', 'N', 'ë‹¨í´ë”ë°°íŒ…', 0xc3abc2b9e2809ec3adc5a0c2b8c3acc2bde2809dc3acc29dc2b8, 0x3130302c3030302c3030302070657220646179, '1000000', '100000', 0x313025, 0x313525, 0x302e3125, 0x302e3925, 0x32303134, 'Y', '', 'N', '0000-00-00 00:00:00', 1, 1, '2018-01-22 17:14:42'),
(32, 'ASD456', '테스트중입니다', '테스트중입니다', 'Bitcoin sport,Mobile sport,Sports', 'test', 'www.googl.com', 0x35303030303030, '10%', '45%', '22%', 'Power ball,pinball,Spin,Test,test5', 'red.png', 'images/web/red.png', '<p>sdvjsfogvsdhfopgjdofpgd sfgouhdfgiouhdfgopudhfgㄷ테스트중입니다. 안녕하세요. dsup</p>', 5, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'N', 'N', 'ë‹¨í´ë”ë°°íŒ…,Each Way,First half bet', 0xc3abc2b9e2809ec3adc5a0c2b8c3acc2bde2809dc3acc29dc2b8, 0x3130302c3030302c3030302070657220646179, '1000000', '15000', 0x3825, 0x313225, 0x302e3725, 0x302e3925, 0x32303134, 'N', '', 'N', '0000-00-00 00:00:00', 1, 1, '2018-01-22 17:15:37'),
(33, 'FGR4594D', '안전한놀이터', '안전한놀이터', 'Mobile sport,Sports', 'rtezdfsdfbnvbnvbnvbn ghghfghf', 'www.gogl.com', 0x37303030303030, '7%', '34%', '45%', 'pinball', '27.jpg', 'images/web/27.jpg', '<p>asdasdfhyoaushfosudhfisadhfiusadhfuioasdhfoasdhfoidushfdas sdfiuhsdoiufhasdiufhasoidfhsadioufhsdifhsdaifads sdhfiausdhfuisdhfoaiusdhfoaihdufioasdhfasd fiuhsdfiouashdfoiuashdfiuoashdfiuashdfiusahdfaisdf iohsdfoiuashfdiuashdfiuhsadfiuhsdfiuhsadf iusdfhasiudfhisuadfhsiaudfh</p>', 5, 'a:1:{s:4:\"test\";s:16:\"배팅 보너스\";}', 'Y', 'H', '', '', '', '0', '0', '', '', '', '', '', 'Y', '', 'N', '0000-00-00 00:00:00', 1, 1, '2018-01-29 15:43:52'),
(34, '515211', '안전한놀이터', '?????', 'Online sport,Bitcoin sport,Sports', '????? ???????.', 'wepfeaee2.com', 0x35303030, '10', '10', '10', 'pinball,Test2', 'diflswfw.5a4cdae4f24dc', NULL, '<p>????? ???????.</p>', 3, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'N', 'H', '', '', '', '0', '0', '', '', '', '', '', '', '', 'N', '0000-00-00 00:00:00', 1, 1, '2018-01-22 09:06:53'),
(35, '54651', '테스트중입니다', '테스트중입니다', 'Verified sport,Sports', '안녕하세요. 테스트중입니다.', 'www.google.com', 0x353030eba78c, '가능합니다', '가능합니다', '20%', 'Spin', 'seianeitime.jpg', NULL, '<p>안녕하세요 테스트중입니ㅏㄷ.</p>', 4, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'Y', 'H', '안녕하세요.,안녕하세요.,안녕하세요.,안녕하세요. 반갑습니다.,안녕하세요. 반갑습니다.', 0x3530eba78c, 0x3530eba78c, '50', '50', 0x3530eba78c, 0x3530eba78c, 0x3530eba78c, 0x3530eba78c, 0x3530eba78c, 'Y', '', 'N', '0000-00-00 00:00:00', 1, 1, '2018-01-27 10:54:56'),
(36, '515121', '안녕하세요텟', '안녕하세요텟', 'Verified sport,Bitcoin sport,Sports', '궁금하나요. 테스트중입니다.', 'https://www.google.com', 0x3530eba78c, '가능합니다', '가능합니다', '10%', 'Power ball,pinball,Spin', 'weiflzbizdb.5a4cdae4f24dc', NULL, '<p>안녕하세요 테스트중입니다.</p>', 5, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'Y', 'N', '안녕하세요.,안녕하세요.,안녕하세요.,안녕하세요. 반갑습니다.,안녕하세요. 반갑습니다.', '', '', '사이트 분쟁', '사이트 분쟁', '', '', '', '', '', '', '', 'N', '0000-00-00 00:00:00', 1, 1, '2018-01-28 16:41:21'),
(37, '54521', '테스트중입니', '테스트중입니', 'Newest sport,Verified sport,Sports', '안녕하세요 테스트중입', 'www.google.com', 0x353030, '50만원부터 가능', '가능합니다', '', 'Spin', 'wefaefaef.5a4cdae4f24dc', 'images/web/wefaefaef.5a4cdae4f24dc', '<p>테스트중입니다</p>', 4, 'a:4:{s:4:\"test\";s:16:\"배팅 보너스\";s:16:\"배팅 보너스\";s:5:\"test2\";s:28:\"안녕하세요 테스트중\";s:28:\"안녕하세요 테스트중\";s:34:\"안녕하세요 테스트중ㅇㅇ\";s:34:\"안녕하세요 테스트중ㅇㅇ\";}', 'N', '비공개', '안녕하세요.,안녕하세요.,안녕하세요.,안녕하세요. 반갑습니다.,안녕하세요. 반갑습니다.', 0x353030, 0xec98a4ebb0b1eba78cec9b90, '0', '0', 0x353030, 0x353030, 0x353030, 0x353030, 0x353030, 'Y', 'test', 'N', '0000-00-00 00:00:00', 1, 1, '2018-01-28 13:35:17'),
(41, '테스트중', '테스트중', '테스트중', 'Newest sport,Bitcoin sport,Sports', '테스트중', '테스트중', 0xed858cec8aa4ed8ab8eca491, '테스트중', '테스트중', '테스트중', 'Spin,test', 'ewfaefawfea.5a4cdae4f24dc', 'images/web/ewfaefawfea.5a4cdae4f24dc', '<p>테스트중</p>', 5, 'a:1:{s:12:\"테스트중\";s:12:\"테스트중\";}', 'N', 'N', '안녕하세요.,안녕하세요. 반갑습니다.', 0xed858cec8aa4ed8ab8eca491, 0xed858cec8aa4ed8ab8eca491, '테스트중', '테스트중', 0xed858cec8aa4ed8ab8eca491, 0xed858cec8aa4ed8ab8eca491, 0xed858cec8aa4ed8ab8eca491, 0xed858cec8aa4ed8ab8eca491, 0xed858cec8aa4ed8ab8eca491, 'Y', '테스트중', 'N', '0000-00-00 00:00:00', 1, 1, '2018-01-29 15:43:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblAds`
--
ALTER TABLE `tblAds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblBonusCards`
--
ALTER TABLE `tblBonusCards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_tblBonusCards_imageName` (`imageName`);

--
-- Indexes for table `tblBonusComment`
--
ALTER TABLE `tblBonusComment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblBonusCommentResponse`
--
ALTER TABLE `tblBonusCommentResponse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblCommentResponse`
--
ALTER TABLE `tblCommentResponse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblComplaintContent`
--
ALTER TABLE `tblComplaintContent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblComplaints`
--
ALTER TABLE `tblComplaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblComplaintsResponse`
--
ALTER TABLE `tblComplaintsResponse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblContent`
--
ALTER TABLE `tblContent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_tblContent_categoryPage` (`categoryPage`);

--
-- Indexes for table `tblFilter`
--
ALTER TABLE `tblFilter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblNewsBlog`
--
ALTER TABLE `tblNewsBlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblNewsComment`
--
ALTER TABLE `tblNewsComment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblNotice`
--
ALTER TABLE `tblNotice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblSadariCards`
--
ALTER TABLE `tblSadariCards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_tblSadariCards_imageName` (`imageName`);

--
-- Indexes for table `tblSadariSportsComment`
--
ALTER TABLE `tblSadariSportsComment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblSlider`
--
ALTER TABLE `tblSlider`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_tblSlider_sliderImageName` (`sliderImageName`);

--
-- Indexes for table `tblSportsComment`
--
ALTER TABLE `tblSportsComment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblUser`
--
ALTER TABLE `tblUser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_tblUser_siteName` (`siteName`);

--
-- Indexes for table `tblUserAccess`
--
ALTER TABLE `tblUserAccess`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblUserDetails`
--
ALTER TABLE `tblUserDetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblUserGroup`
--
ALTER TABLE `tblUserGroup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_tblUserGroup_title` (`title`);

--
-- Indexes for table `tblWebCards`
--
ALTER TABLE `tblWebCards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_tblWebCards_imageName` (`imageName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblAds`
--
ALTER TABLE `tblAds`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblBonusCards`
--
ALTER TABLE `tblBonusCards`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblBonusComment`
--
ALTER TABLE `tblBonusComment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblBonusCommentResponse`
--
ALTER TABLE `tblBonusCommentResponse`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblCommentResponse`
--
ALTER TABLE `tblCommentResponse`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblComplaintContent`
--
ALTER TABLE `tblComplaintContent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblComplaints`
--
ALTER TABLE `tblComplaints`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblComplaintsResponse`
--
ALTER TABLE `tblComplaintsResponse`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblContent`
--
ALTER TABLE `tblContent`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblFilter`
--
ALTER TABLE `tblFilter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tblNewsBlog`
--
ALTER TABLE `tblNewsBlog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblNewsComment`
--
ALTER TABLE `tblNewsComment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblNotice`
--
ALTER TABLE `tblNotice`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblSadariCards`
--
ALTER TABLE `tblSadariCards`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblSadariSportsComment`
--
ALTER TABLE `tblSadariSportsComment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblSportsComment`
--
ALTER TABLE `tblSportsComment`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblUser`
--
ALTER TABLE `tblUser`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tblUserGroup`
--
ALTER TABLE `tblUserGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblWebCards`
--
ALTER TABLE `tblWebCards`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
