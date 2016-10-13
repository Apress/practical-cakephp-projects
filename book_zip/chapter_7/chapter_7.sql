-- phpMyAdmin SQL Dump
-- version 3.0.0
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2008 at 08:17 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cakephp_prod`
--

-- --------------------------------------------------------

--
-- Table structure for table `accomplishments`
--

CREATE TABLE IF NOT EXISTS `accomplishments` (
  `id` int(11) NOT NULL auto_increment,
  `team_member` varchar(30) collate utf8_unicode_ci NOT NULL,
  `description` varchar(140) collate utf8_unicode_ci NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=56 ;

--
-- Dumping data for table `accomplishments`
--

INSERT INTO `accomplishments` (`id`, `team_member`, `description`, `created`, `modified`) VALUES
(54, 'Heather', 'Developed beautiful new WordPress template', '2008-10-08 09:13:14', '2008-10-08 09:13:14'),
(53, 'Fabiola', 'Helped Neil with Spanish translation', '2008-10-07 13:12:45', '2008-10-07 13:12:45'),
(52, 'Richard', 'Met with guy from newspaper', '2008-10-07 14:12:04', '2008-10-07 14:12:04'),
(51, 'Richard', 'Developed new WordPress plugin', '2008-10-08 09:11:56', '2008-10-08 09:11:56'),
(55, 'Heather', 'Uploaded new video to YouTube', '2008-10-07 10:14:06', '2008-10-07 10:14:06');
