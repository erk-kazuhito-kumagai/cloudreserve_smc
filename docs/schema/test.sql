-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017 年 7 朁E02 日 18:07
-- サーバのバージョン： 10.1.16-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `m_smc_checkup`
--

CREATE TABLE `m_smc_checkup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `seq` bigint(20) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_user` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `m_smc_checkup`
--

INSERT INTO `m_smc_checkup` (`id`, `name`, `detail`, `seq`, `from_date`, `to_date`, `status`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
(1, '塵肺', '塵肺', 1, NULL, NULL, 1, 'nologin_user', '2017-07-02 20:58:21', 'nologin_user', '2017-07-02 20:58:21');

-- --------------------------------------------------------

--
-- テーブルの構造 `m_smc_examination`
--

CREATE TABLE `m_smc_examination` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `seq` bigint(20) NOT NULL,
  `item1` char(1) NOT NULL,
  `item1_disp` varchar(100) DEFAULT NULL,
  `item1_class` varchar(512) DEFAULT NULL,
  `item1_valid` varchar(512) DEFAULT NULL,
  `item1_default` varchar(255) DEFAULT NULL,
  `item1_unit` varchar(50) DEFAULT NULL,
  `item1_detail` varchar(255) DEFAULT NULL,
  `item1_mime` varchar(30) DEFAULT NULL,
  `item2` char(1) NOT NULL,
  `item2_disp` varchar(100) DEFAULT NULL,
  `item2_class` varchar(512) DEFAULT NULL,
  `item2_valid` varchar(512) DEFAULT NULL,
  `item2_default` varchar(255) DEFAULT NULL,
  `item2_unit` varchar(50) DEFAULT NULL,
  `item2_detail` varchar(255) DEFAULT NULL,
  `item2_mime` varchar(30) DEFAULT NULL,
  `item3` char(1) NOT NULL,
  `item3_disp` varchar(100) DEFAULT NULL,
  `item3_class` varchar(512) DEFAULT NULL,
  `item3_valid` varchar(512) DEFAULT NULL,
  `item3_default` varchar(255) DEFAULT NULL,
  `item3_unit` varchar(50) DEFAULT NULL,
  `item3_detail` varchar(255) DEFAULT NULL,
  `item3_mime` varchar(30) DEFAULT NULL,
  `item4` char(1) NOT NULL,
  `item4_disp` varchar(100) DEFAULT NULL,
  `item4_class` varchar(512) DEFAULT NULL,
  `item4_valid` varchar(512) DEFAULT NULL,
  `item4_default` varchar(255) DEFAULT NULL,
  `item4_unit` varchar(50) DEFAULT NULL,
  `item4_detail` varchar(255) DEFAULT NULL,
  `item4_mime` varchar(30) DEFAULT NULL,
  `item5` char(1) NOT NULL,
  `item5_disp` varchar(100) DEFAULT NULL,
  `item5_class` varchar(512) DEFAULT NULL,
  `item5_valid` varchar(512) DEFAULT NULL,
  `item5_default` varchar(255) DEFAULT NULL,
  `item5_unit` varchar(50) DEFAULT NULL,
  `item5_detail` varchar(255) DEFAULT NULL,
  `item5_mime` varchar(30) DEFAULT NULL,
  `item6` char(1) NOT NULL,
  `item6_disp` varchar(100) DEFAULT NULL,
  `item6_class` varchar(512) DEFAULT NULL,
  `item6_valid` varchar(512) DEFAULT NULL,
  `item6_default` varchar(255) DEFAULT NULL,
  `item6_unit` varchar(50) DEFAULT NULL,
  `item6_detail` varchar(255) DEFAULT NULL,
  `item6_mime` varchar(30) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_user` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_user` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `m_smc_examination`
--

INSERT INTO `m_smc_examination` (`id`, `name`, `detail`, `seq`, `item1`, `item1_disp`, `item1_class`, `item1_valid`, `item1_default`, `item1_unit`, `item1_detail`, `item1_mime`, `item2`, `item2_disp`, `item2_class`, `item2_valid`, `item2_default`, `item2_unit`, `item2_detail`, `item2_mime`, `item3`, `item3_disp`, `item3_class`, `item3_valid`, `item3_default`, `item3_unit`, `item3_detail`, `item3_mime`, `item4`, `item4_disp`, `item4_class`, `item4_valid`, `item4_default`, `item4_unit`, `item4_detail`, `item4_mime`, `item5`, `item5_disp`, `item5_class`, `item5_valid`, `item5_default`, `item5_unit`, `item5_detail`, `item5_mime`, `item6`, `item6_disp`, `item6_class`, `item6_valid`, `item6_default`, `item6_unit`, `item6_detail`, `item6_mime`, `from_date`, `to_date`, `status`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
(1, '初めてのじん肺有所見の診断', '初めてのじん肺有所見の診断', 1, '3', '決定年月', 'col-md-4 ', '', '', '', NULL, 'image/png', '1', 'じん肺管理区分', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'PR', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'F', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-07-02 23:30:38'),
(2, '前２回の決定状況(前回)', '前２回の決定状況(前回)', 2, '1', '決定年月', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'じん肺管理区分', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'PR', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'F', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(3, '前２回の決定状況(前々回)', '前２回の決定状況(前々回)', 3, '1', '決定年月', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'じん肺管理区分', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'PR', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'F', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(4, '経過1', '経過1', 4, '1', '決定年月', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'じん肺管理区分', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'PR', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'F', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(5, '経過2', '経過2', 5, '1', '決定年月', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'じん肺管理区分', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'PR', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'F', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(6, '経過3', '経過3', 6, '1', '決定年月', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'じん肺管理区分', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'PR', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'F', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(7, '肺結核', '肺結核', 7, '1', '肺結核', 'col-md-4', NULL, NULL, '才', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(8, '胸膜炎', '胸膜炎', 8, '1', '胸膜炎', 'col-md-4', NULL, NULL, '才', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(9, '気管支炎', '気管支炎', 9, '1', '気管支炎', 'col-md-4', NULL, NULL, '才', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(10, '気管支喘息', '気管支喘息', 10, '1', '気管支喘息', 'col-md-4', NULL, NULL, '才', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(11, '肺気腫', '肺気腫', 11, '1', '肺気腫', 'col-md-4', NULL, NULL, '才', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(12, '心臓疾患1回目', '心臓疾患1回目', 12, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '才', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(13, '心臓疾患2回目', '心臓疾患2回目', 13, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '才', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(14, 'その他胸部疾患1', 'その他胸部疾患1', 14, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '才', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(15, 'その他胸部疾患1', 'その他胸部疾患1', 15, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '才', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(16, 'その他胸部疾患2', 'その他胸部疾患2', 16, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '才', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(17, '事業名及び粉じん作業名1（来る前）', '事業名及び粉じん作業名1（来る前）', 17, '1', '事業名 粉じん作業名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '号', NULL, NULL, '1', '期間', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '年数', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(18, '事業名及び粉じん作業名2（来る前）', '事業名及び粉じん作業名2（来る前）', 18, '1', '事業名 粉じん作業名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '号', NULL, NULL, '1', '期間', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '年数', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(19, '事業名及び粉じん作業名3（来る前）', '事業名及び粉じん作業名3（来る前）', 19, '1', '事業名 粉じん作業名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '号', NULL, NULL, '1', '期間', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '年数', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(20, '事業名及び粉じん作業名4（来る前）', '事業名及び粉じん作業名4（来る前）', 20, '1', '事業名 粉じん作業名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '号', NULL, NULL, '1', '期間', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '年数', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(21, '粉じん作業に従事した期間の合計', '粉じん作業に従事した期間の合計', 21, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(22, '事業名及び粉じん作業名1（来てから）', '事業名及び粉じん作業名1（来てから）', 22, '1', '事業名 粉じん作業名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '号', NULL, NULL, '1', '期間', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '年数', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(23, '事業名及び粉じん作業名2（来てから）', '事業名及び粉じん作業名2（来てから）', 23, '1', '事業名 粉じん作業名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '号', NULL, NULL, '1', '期間', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '年数', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(24, '事業名及び粉じん作業名3（来てから）', '事業名及び粉じん作業名3（来てから）', 24, '1', '事業名 粉じん作業名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '号', NULL, NULL, '1', '期間', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '年数', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(25, '事業名及び粉じん作業名4（来てから）', '事業名及び粉じん作業名4（来てから）', 25, '1', '事業名 粉じん作業名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '号', NULL, NULL, '1', '期間', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '年数', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(26, '事業名及び粉じん作業名5（来てから）', '事業名及び粉じん作業名5（来てから）', 26, '1', '事業名 粉じん作業名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '号', NULL, NULL, '1', '期間', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '年数', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(27, '事業名及び粉じん作業名6（来てから）', '事業名及び粉じん作業名6（来てから）', 27, '1', '事業名 粉じん作業名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '号', NULL, NULL, '1', '期間', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '年数', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(28, '肺', '肺', 28, '1', '胸部画像', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '1．撮影年月日', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '2．写真番号', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '3．撮影条件1', 'col-md-4', NULL, NULL, 'KV', NULL, NULL, '1', '3．撮影条件2', 'col-md-4', NULL, NULL, 'mAs', NULL, NULL, '1', '増〇紙', 'col-md-4', NULL, NULL, '', NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(29, '像 粒状形', '像 粒状形', 29, '1', '区分', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'タイプ', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(30, '不正形陰影', '不正形陰影', 30, '1', '区分', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', 'タイプ', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(31, 'ロ 大陰影の区分', 'ロ 大陰影の区分', 31, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(32, 'ハ 付加記載事項', 'ハ 付加記載事項', 32, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(33, 'サイン', 'サイン', 33, '1', '年月日', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '医療機関の名称及び所在地', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '医師氏名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '医師サイン', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:32'),
(34, '検査年月日', '検査年月日', 34, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(35, '呼吸困難', '呼吸困難', 35, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(36, 'せき', 'せき', 36, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(37, 'たん', 'たん', 37, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(38, '心悸亢進', '心悸亢進', 38, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(39, 'その他', 'その他', 39, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(40, 'チアノーゼ', 'チアノーゼ', 40, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(41, 'ばち状態', 'ばち状態', 41, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(42, '副雑音', '副雑音', 42, '1', '副雑音', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '部位', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(43, 'その他', 'その他', 43, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(44, 'なし/やめた/吸ってる', 'なし/やめた/吸ってる', 44, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(45, '喫煙状況', '喫煙状況', 45, '1', '', 'col-md-4', NULL, NULL, '本/日 X ', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '年', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '～', NULL, NULL, '1', '', 'col-md-4', NULL, NULL, '歳', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(46, 'サイン', 'サイン', 46, '1', '年月日', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '医療機関の名称及び所在地', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '医師氏名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '医師サイン', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(47, '肺機能（身体）', '肺機能（身体）', 47, '1', '身長', 'col-md-4', NULL, NULL, 'cm', NULL, NULL, '1', '年齢', 'col-md-4', NULL, NULL, '歳（満）', NULL, NULL, '1', '1秒予測値', 'col-md-4', NULL, NULL, 'l', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(48, '肺活量予測値', '肺活量予測値', 48, '1', '', 'col-md-4', NULL, NULL, 'l', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(49, '検査年月日', '検査年月日', 49, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(50, '肺活量', '肺活量', 50, '1', '', 'col-md-4', NULL, NULL, 'l', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(51, '努力肺活量', '努力肺活量', 51, '1', '', 'col-md-4', NULL, NULL, 'l', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(52, '一秒量', '一秒量', 52, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(53, '一秒率', '一秒率', 53, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(54, '％一秒量', '％一秒量', 54, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(55, '％肺活量', '％肺活量', 55, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(56, '検査年月日', '検査年月日', 56, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(57, '肺活量', '肺活量', 57, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(58, '努力肺活量', '努力肺活量', 58, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(59, '一秒量', '一秒量', 59, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(60, '一秒率', '一秒率', 60, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(61, '％一秒量', '％一秒量', 61, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(62, '％肺活量', '％肺活量', 62, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(63, 'サイン', 'サイン', 63, '1', '判定', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '年月日', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '医療機関の名称及び所在地', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '医師氏名', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '医師サイン', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(64, '検査年月日', '検査年月日', 64, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(65, '自覚症状', '自覚症状', 65, '1', '', 'col-md-4', NULL, NULL, '', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(66, '結核菌', '結核菌', 66, '1', '塗抹', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', '培養', 'col-md-4', NULL, NULL, '', NULL, NULL, '1', NULL, 'col-md-4', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32');

-- --------------------------------------------------------

--
-- テーブルの構造 `m_smc_examination_category`
--

CREATE TABLE `m_smc_examination_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `seq` bigint(20) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_user` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_user` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `m_smc_examination_category`
--

INSERT INTO `m_smc_examination_category` (`id`, `name`, `menu`, `detail`, `comment`, `seq`, `from_date`, `to_date`, `status`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
(1, 'じん肺の経過', 'じん肺の経過', 'じん肺の経過', '※　下記は、労働基準局より、決定通知がまいりましたら必ず記入して下さい。', 1, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(2, '前２回の決定状況', '前２回の決定状況', '前２回の決定状況', NULL, 2, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(3, '経過', '経過', '経過', NULL, 3, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(4, '既往歴', '既往歴', '既往歴', '', 4, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(5, '心臓疾患', '心臓疾患', '心臓疾患', NULL, 5, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(6, 'その他胸部疾患', 'その他胸部疾患', 'その他胸部疾患', NULL, 6, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(7, '粉じん作業歴', '粉じん作業歴', '粉じん作業歴', '', 7, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(8, '現場の事業場に来る前', '現場の事業場に来る前', '現場の事業場に来る前', NULL, 8, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(9, '現場の事業場に来てから', '現場の事業場に来てから', '現場の事業場に来てから', NULL, 9, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(10, '胸部', '胸部', '胸部', 'エックス線写真による検査', 10, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(11, 'イ 小陰影の区分', 'イ 小陰影の区分', 'イ 小陰影の区分', NULL, 11, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31'),
(12, '胸部に関する臨床検査', '胸部に関する臨床検査', '胸部に関する臨床検査', '', 12, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(13, '自覚症状', '自覚症状', '自覚症状', NULL, 13, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(14, '他覚症状', '他覚症状', '他覚症状', NULL, 14, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(15, '喫煙歴', '喫煙歴', '喫煙歴', NULL, 15, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(16, '肺機能検査', '肺機能検査', '肺機能検査', '', 16, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(17, '第一次検査', '第一次検査', '第一次検査', NULL, 17, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(18, '第2次検査', '第2次検査', '第2次検査', NULL, 18, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(19, '合併症に関する臨床検査', '合併症に関する臨床検査', '合併症に関する臨床検査', '', 19, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32'),
(20, '結核精密検査', '結核精密検査', '結核精密検査', NULL, 20, NULL, NULL, 1, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32');

-- --------------------------------------------------------

--
-- テーブルの構造 `m_smc_examination_classified`
--

CREATE TABLE `m_smc_examination_classified` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `item_type` char(1) NOT NULL COMMENT 'C:カテゴリー E:検査項目',
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `top_id` bigint(20) UNSIGNED NOT NULL,
  `sort` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `created_user` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_user` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL,
  `checkup_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `m_smc_examination_classified`
--

INSERT INTO `m_smc_examination_classified` (`id`, `item_id`, `item_type`, `parent_id`, `top_id`, `sort`, `created_user`, `created_date`, `updated_user`, `updated_date`, `checkup_id`) VALUES
(1, 1, 'C', 0, 1, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(2, 1, 'E', 1, 1, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(3, 2, 'C', 1, 1, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(4, 2, 'E', 2, 1, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(5, 3, 'E', 2, 1, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(6, 3, 'C', 2, 1, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(7, 4, 'E', 3, 1, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(8, 5, 'E', 3, 1, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(9, 6, 'E', 3, 1, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(10, 4, 'C', 0, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(11, 7, 'E', 4, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(12, 8, 'E', 4, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(13, 9, 'E', 4, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(14, 10, 'E', 4, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(15, 11, 'E', 4, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(16, 5, 'C', 4, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(17, 12, 'E', 5, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(18, 13, 'E', 5, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(19, 6, 'C', 5, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(20, 14, 'E', 6, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(21, 15, 'E', 6, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(22, 16, 'E', 6, 4, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(23, 7, 'C', 0, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(24, 8, 'C', 7, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(25, 17, 'E', 8, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(26, 18, 'E', 8, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(27, 19, 'E', 8, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(28, 20, 'E', 8, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(29, 21, 'E', 8, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(30, 9, 'C', 8, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(31, 22, 'E', 9, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(32, 23, 'E', 9, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(33, 24, 'E', 9, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(34, 25, 'E', 9, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(35, 26, 'E', 9, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(36, 27, 'E', 9, 7, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(37, 10, 'C', 0, 10, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(38, 28, 'E', 10, 10, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(39, 11, 'C', 10, 10, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(40, 29, 'E', 11, 10, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(41, 30, 'E', 11, 10, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(42, 31, 'E', 11, 10, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(43, 32, 'E', 11, 10, 0, 'nologin_user', '2017-03-08 01:17:31', 'nologin_user', '2017-03-08 01:17:31', 1),
(44, 33, 'E', 11, 10, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(45, 12, 'C', 0, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(46, 34, 'E', 12, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(47, 13, 'C', 12, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(48, 35, 'E', 13, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(49, 36, 'E', 13, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(50, 37, 'E', 13, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(51, 38, 'E', 13, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(52, 39, 'E', 13, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(53, 14, 'C', 13, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(54, 40, 'E', 14, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(55, 41, 'E', 14, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(56, 42, 'E', 14, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(57, 43, 'E', 14, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(58, 15, 'C', 14, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(59, 44, 'E', 15, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(60, 45, 'E', 15, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(61, 46, 'E', 15, 12, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(62, 16, 'C', 0, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(63, 47, 'E', 16, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(64, 48, 'E', 16, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(65, 17, 'C', 16, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(66, 49, 'E', 17, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(67, 50, 'E', 17, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(68, 51, 'E', 17, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(69, 52, 'E', 17, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(70, 53, 'E', 17, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(71, 54, 'E', 17, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(72, 55, 'E', 17, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(73, 18, 'C', 17, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(74, 56, 'E', 18, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(75, 57, 'E', 18, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(76, 58, 'E', 18, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(77, 59, 'E', 18, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(78, 60, 'E', 18, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(79, 61, 'E', 18, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(80, 62, 'E', 18, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(81, 63, 'E', 18, 16, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(82, 19, 'C', 0, 19, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(83, 64, 'E', 19, 19, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(84, 65, 'E', 19, 19, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(85, 20, 'C', 19, 19, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1),
(86, 66, 'E', 20, 19, 0, 'nologin_user', '2017-03-08 01:17:32', 'nologin_user', '2017-03-08 01:17:32', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `m_smc_examination_item`
--

CREATE TABLE `m_smc_examination_item` (
  `id` int(10) UNSIGNED NOT NULL,
  `examination_id` bigint(20) UNSIGNED NOT NULL,
  `item_num` tinyint(4) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `val` int(10) UNSIGNED NOT NULL,
  `seq` smallint(6) NOT NULL DEFAULT '0',
  `created_user` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_user` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `m_smc_examination_item`
--

INSERT INTO `m_smc_examination_item` (`id`, `examination_id`, `item_num`, `name`, `val`, `seq`, `created_user`, `created_date`, `updated_user`, `updated_date`, `status`) VALUES
(1, 1, 1, 'りんご', 1, 1, 'sa', '2017-02-08 00:00:00', 'nologin_user', '2017-04-17 23:20:01', 0),
(2, 1, 1, 'バナナ2', 2, 2, 'sa', '2017-02-08 00:00:00', 'nologin_user', '2017-04-18 00:45:00', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `m_smc_examination_record`
--

CREATE TABLE `m_smc_examination_record` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `seq` bigint(20) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_user` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `m_smc_examination_validation`
--

CREATE TABLE `m_smc_examination_validation` (
  `id` int(10) UNSIGNED NOT NULL,
  `examination_id` bigint(20) UNSIGNED NOT NULL,
  `item_num` int(11) NOT NULL,
  `type` int(10) UNSIGNED NOT NULL,
  `etc1` varchar(255) DEFAULT NULL,
  `etc2` varchar(255) DEFAULT NULL,
  `created_user` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_user` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `m_smc_examination_validation`
--

INSERT INTO `m_smc_examination_validation` (`id`, `examination_id`, `item_num`, `type`, `etc1`, `etc2`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
(5, 1, 1, 2, '1', '10', 'nologin_user', '2017-06-23 06:17:10', 'nologin_user', '2017-06-23 06:17:10'),
(6, 1, 1, 4, NULL, NULL, 'nologin_user', '2017-06-23 06:17:10', 'nologin_user', '2017-06-23 06:17:10'),
(7, 1, 1, 6, NULL, NULL, 'nologin_user', '2017-06-23 06:17:10', 'nologin_user', '2017-06-23 06:17:10'),
(8, 1, 1, 8, '0', '20', 'nologin_user', '2017-06-23 06:17:10', 'nologin_user', '2017-06-23 06:17:10');

-- --------------------------------------------------------

--
-- テーブルの構造 `m_smc_workitem`
--

CREATE TABLE `m_smc_workitem` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `seq` bigint(20) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_user` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `m_smc_workitem_category`
--

CREATE TABLE `m_smc_workitem_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `seq` int(10) UNSIGNED NOT NULL,
  `created_date` date NOT NULL,
  `created_user` varchar(50) NOT NULL,
  `updated_date` date NOT NULL,
  `updated_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `m_smc_work_classified`
--

CREATE TABLE `m_smc_work_classified` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `created_user` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkup_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `t_smc_header`
--

CREATE TABLE `t_smc_header` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `checkup_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_code` char(12) NOT NULL,
  `gender` char(1) NOT NULL,
  `birthday` date NOT NULL,
  `hire_date` date NOT NULL,
  `checkup_no` varchar(20) NOT NULL,
  `workplace_code` char(8) NOT NULL,
  `workplace_name` varchar(100) NOT NULL,
  `workplace_address` varchar(255) NOT NULL,
  `type` char(1) NOT NULL,
  `deteof` date NOT NULL,
  `work_from` varchar(20) NOT NULL,
  `work_to` varchar(20) DEFAULT NULL,
  `blood_sample` int(11) DEFAULT NULL,
  `urine_sample` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_user` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_user` varchar(50) NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `t_smc_record`
--

CREATE TABLE `t_smc_record` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `header_id` bigint(20) UNSIGNED NOT NULL,
  `examination_id` bigint(20) UNSIGNED NOT NULL,
  `object_no` char(5) NOT NULL,
  `examination_name` varchar(100) NOT NULL,
  `examination_template` varchar(255) DEFAULT NULL,
  `seq` int(11) NOT NULL,
  `top_category_id` bigint(20) UNSIGNED NOT NULL,
  `top_category_name` varchar(100) NOT NULL,
  `top_category_template` varchar(255) DEFAULT NULL,
  `middle_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `middle_category_name` varchar(100) DEFAULT NULL,
  `middle_category_template` varchar(255) DEFAULT NULL,
  `checkup_id` bigint(20) UNSIGNED NOT NULL,
  `vachar1` varchar(255) DEFAULT NULL,
  `vachar2` varchar(255) DEFAULT NULL,
  `vachar3` varchar(255) DEFAULT NULL,
  `vachar4` varchar(255) DEFAULT NULL,
  `vachar5` varchar(255) DEFAULT NULL,
  `integer1` int(11) DEFAULT NULL,
  `integer2` int(11) DEFAULT NULL,
  `integer3` int(11) DEFAULT NULL,
  `integer4` int(11) DEFAULT NULL,
  `integer5` int(11) DEFAULT NULL,
  `date1` date DEFAULT NULL,
  `date2` date DEFAULT NULL,
  `date3` date DEFAULT NULL,
  `date4` date DEFAULT NULL,
  `date5` date DEFAULT NULL,
  `text1` text,
  `text2` text,
  `text3` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `t_smc_reservation`
--

CREATE TABLE `t_smc_reservation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  `created_user` varchar(50) NOT NULL,
  `updated_date` datetime NOT NULL,
  `updated_user` varchar(50) NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_smc_examination_classified`
-- (See below for the actual view)
--
CREATE TABLE `v_smc_examination_classified` (
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_smc_header`
-- (See below for the actual view)
--
CREATE TABLE `v_smc_header` (
`id` bigint(20) unsigned
,`checkup_id` bigint(20) unsigned
,`user_id` bigint(20) unsigned
,`user_name` varchar(200)
,`user_code` char(12)
,`gender` char(1)
,`birthday` date
,`hire_date` date
,`checkup_no` varchar(20)
,`workplace_code` char(8)
,`workplace_name` varchar(100)
,`workplace_address` varchar(255)
,`type` char(1)
,`deteof` date
,`work_from` varchar(20)
,`work_to` varchar(20)
,`blood_sample` int(11)
,`urine_sample` int(11)
,`reservation_id` bigint(20) unsigned
,`checkup_name` varchar(100)
,`checkup_detail` varchar(255)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_smc_reservation`
-- (See below for the actual view)
--
CREATE TABLE `v_smc_reservation` (
`id` bigint(20) unsigned
,`reservation_date` date
,`vendor_id` bigint(20) unsigned
,`user_id` bigint(20) unsigned
,`name` varbinary(200)
,`kana` varbinary(600)
,`user_no` char(20)
,`status` char(1)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_smc_workitem`
-- (See below for the actual view)
--
CREATE TABLE `v_smc_workitem` (
`id` bigint(20) unsigned
,`name` varchar(100)
,`detail` varchar(255)
);

-- --------------------------------------------------------

--
-- ビュー用の代替構造 `v_smc_work_classified`
-- (See below for the actual view)
--
CREATE TABLE `v_smc_work_classified` (
`id` bigint(20) unsigned
,`item_id` bigint(20) unsigned
,`checkup_id` bigint(20) unsigned
,`name` varchar(100)
,`detail` varchar(255)
,`from_date` date
,`to_date` date
,`status` tinyint(4)
);

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_smc_examination_classified`
--
DROP TABLE IF EXISTS `v_smc_examination_classified`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_smc_examination_classified`  AS  select `cl1`.`id` AS `id`,`cl1`.`item_id` AS `item_id`,`cl1`.`parent_id` AS `parent_id`,`cl1`.`checkup_id` AS `checkup_id`,`i`.`name` AS `name`,`i`.`detail` AS `detail`,`i`.`from_date` AS `from_date`,`i`.`to_date` AS `to_date`,`i`.`status` AS `status`,`cl1`.`item_type` AS `item_type`,`cl1`.`template` AS `template` from (`m_smc_examination` `i` join `m_smc_examination_classified` `cl1` on(((`i`.`id` = `cl1`.`item_id`) and (`cl1`.`item_type` = 'i')))) union select `cl2`.`id` AS `id`,`cl2`.`item_id` AS `item_id`,`cl2`.`parent_id` AS `parent_id`,`cl2`.`checkup_id` AS `checkup_id`,`c`.`name` AS `name`,`c`.`detail` AS `detail`,`c`.`from_date` AS `from_date`,`c`.`to_date` AS `to_date`,`c`.`status` AS `status`,`cl2`.`item_type` AS `item_type`,`cl2`.`template` AS `template` from (`m_smc_examination_category` `c` join `m_smc_examination_classified` `cl2` on(((`c`.`id` = `cl2`.`item_id`) and (`cl2`.`item_type` = 'c')))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_smc_header`
--
DROP TABLE IF EXISTS `v_smc_header`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_smc_header`  AS  select `h`.`id` AS `id`,`h`.`checkup_id` AS `checkup_id`,`h`.`user_id` AS `user_id`,`h`.`user_name` AS `user_name`,`h`.`user_code` AS `user_code`,`h`.`gender` AS `gender`,`h`.`birthday` AS `birthday`,`h`.`hire_date` AS `hire_date`,`h`.`checkup_no` AS `checkup_no`,`h`.`workplace_code` AS `workplace_code`,`h`.`workplace_name` AS `workplace_name`,`h`.`workplace_address` AS `workplace_address`,`h`.`type` AS `type`,`h`.`deteof` AS `deteof`,`h`.`work_from` AS `work_from`,`h`.`work_to` AS `work_to`,`h`.`blood_sample` AS `blood_sample`,`h`.`urine_sample` AS `urine_sample`,`h`.`reservation_id` AS `reservation_id`,`c`.`name` AS `checkup_name`,`c`.`detail` AS `checkup_detail` from (`t_smc_header` `h` join `m_smc_checkup` `c` on((`h`.`checkup_id` = `c`.`id`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_smc_reservation`
--
DROP TABLE IF EXISTS `v_smc_reservation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_smc_reservation`  AS  select `r`.`id` AS `id`,`r`.`reservation_date` AS `reservation_date`,`r`.`vendor_id` AS `vendor_id`,`r`.`user_id` AS `user_id`,`u`.`name` AS `name`,`u`.`kana` AS `kana`,`u`.`user_no` AS `user_no`,`r`.`status` AS `status` from (`t_smc_reservation` `r` join `m_user` `u` on((`r`.`user_id` = `u`.`id`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_smc_workitem`
--
DROP TABLE IF EXISTS `v_smc_workitem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_smc_workitem`  AS  select distinct `w`.`id` AS `id`,`w`.`name` AS `name`,`w`.`detail` AS `detail` from (`m_smc_work_classified` `c` join `m_smc_workitem` `w` on((`c`.`item_id` = `w`.`id`))) where (((`w`.`from_date` >= curdate()) or isnull(`w`.`from_date`)) and ((`w`.`to_date` <= curdate()) or isnull(`w`.`to_date`))) ;

-- --------------------------------------------------------

--
-- ビュー用の構造 `v_smc_work_classified`
--
DROP TABLE IF EXISTS `v_smc_work_classified`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_smc_work_classified`  AS  select `cl1`.`id` AS `id`,`cl1`.`item_id` AS `item_id`,`cl1`.`checkup_id` AS `checkup_id`,`i`.`name` AS `name`,`i`.`detail` AS `detail`,`i`.`from_date` AS `from_date`,`i`.`to_date` AS `to_date`,`i`.`status` AS `status` from (`m_smc_workitem` `i` join `m_smc_work_classified` `cl1` on((`i`.`id` = `cl1`.`item_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_smc_checkup`
--
ALTER TABLE `m_smc_checkup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_smc_examination`
--
ALTER TABLE `m_smc_examination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_smc_examination_category`
--
ALTER TABLE `m_smc_examination_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_smc_examination_classified`
--
ALTER TABLE `m_smc_examination_classified`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_smc_examination_item`
--
ALTER TABLE `m_smc_examination_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_smc_examination_record`
--
ALTER TABLE `m_smc_examination_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_smc_examination_validation`
--
ALTER TABLE `m_smc_examination_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_smc_workitem`
--
ALTER TABLE `m_smc_workitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_smc_work_classified`
--
ALTER TABLE `m_smc_work_classified`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_smc_header`
--
ALTER TABLE `t_smc_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_smc_record`
--
ALTER TABLE `t_smc_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_smc_reservation`
--
ALTER TABLE `t_smc_reservation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_smc_checkup`
--
ALTER TABLE `m_smc_checkup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `m_smc_examination`
--
ALTER TABLE `m_smc_examination`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `m_smc_examination_category`
--
ALTER TABLE `m_smc_examination_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `m_smc_examination_classified`
--
ALTER TABLE `m_smc_examination_classified`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `m_smc_examination_item`
--
ALTER TABLE `m_smc_examination_item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_smc_examination_record`
--
ALTER TABLE `m_smc_examination_record`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_smc_examination_validation`
--
ALTER TABLE `m_smc_examination_validation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `m_smc_workitem`
--
ALTER TABLE `m_smc_workitem`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_smc_work_classified`
--
ALTER TABLE `m_smc_work_classified`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_smc_header`
--
ALTER TABLE `t_smc_header`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_smc_record`
--
ALTER TABLE `t_smc_record`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_smc_reservation`
--
ALTER TABLE `t_smc_reservation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
