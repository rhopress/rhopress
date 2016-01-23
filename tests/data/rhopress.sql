-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-01-23 15:07:17
-- 服务器版本： 5.7.10
-- PHP Version: 5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rhopress`
--
CREATE DATABASE IF NOT EXISTS `rhopress` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rhopress`;

-- --------------------------------------------------------

--
-- 表的结构 `email`
--
-- 创建时间： 2016-01-23 04:56:36
-- 最后更新： 2016-01-23 07:04:26
--

DROP TABLE IF EXISTS `email`;
CREATE TABLE IF NOT EXISTS `email` (
  `guid` varchar(36) NOT NULL,
  `user_guid` varchar(36) NOT NULL,
  `id` varchar(4) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` varchar(255) NOT NULL,
  `enable_login` bit(1) NOT NULL DEFAULT b'0',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00',
  `permission` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`),
  UNIQUE KEY `user_email_id_unique` (`id`,`user_guid`) USING BTREE,
  KEY `user_email_guid_fkey` (`user_guid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `profile`
--
-- 创建时间： 2016-01-23 04:37:36
-- 最后更新： 2016-01-23 07:04:26
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `guid` varchar(36) CHARACTER SET utf8 NOT NULL,
  `nickname` varchar(355) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `first_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `last_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `icon` varchar(36) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `display_name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `website` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `individual_sign` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`guid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--
-- 创建时间： 2016-01-22 14:51:06
-- 最后更新： 2016-01-23 07:04:26
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `guid` varchar(36) NOT NULL DEFAULT '00000000-0000-0000-0000-000000000000' COMMENT 'User''s Universally Unique IDentifier',
  `id` varchar(32) NOT NULL DEFAULT '0' COMMENT 'IDentifier No.',
  `pass_hash` varchar(80) NOT NULL DEFAULT '' COMMENT 'User''s Password Hash',
  `ip_1` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ip_1',
  `ip_2` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ip_2',
  `ip_3` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ip_3',
  `ip_4` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ip_4',
  `ip_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '4' COMMENT 'IP Address Type',
  `create_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Register Time',
  `update_time` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT 'Update Time',
  `auth_key` varchar(255) NOT NULL DEFAULT '' COMMENT 'Authentication Key',
  `access_token` varchar(255) NOT NULL DEFAULT '' COMMENT 'Access Token',
  `password_reset_token` varchar(255) NOT NULL DEFAULT '' COMMENT 'Password Reset Token',
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT 'User Status',
  `source` varchar(255) NOT NULL DEFAULT '0' COMMENT 'User Source',
  PRIMARY KEY (`guid`),
  UNIQUE KEY `user_id_unique` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User';

--
-- 限制导出的表
--

--
-- 限制表 `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `user_email_guid_fkey` FOREIGN KEY (`user_guid`) REFERENCES `user` (`guid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_guid_fkey` FOREIGN KEY (`guid`) REFERENCES `user` (`guid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
