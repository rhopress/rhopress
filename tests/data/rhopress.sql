-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-01-22 22:51:32
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
-- 表的结构 `user`
--
-- 创建时间： 2016-01-22 14:51:06
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
