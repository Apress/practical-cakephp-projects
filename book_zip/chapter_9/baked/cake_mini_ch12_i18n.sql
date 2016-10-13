-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Aug 09, 2008 at 12:58 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `cake_mini_ch12_i18n`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `i18n`
-- 

CREATE TABLE `i18n` (
  `id` int(10) NOT NULL auto_increment,
  `locale` varchar(6) collate latin1_general_ci NOT NULL,
  `model` varchar(255) collate latin1_general_ci NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) collate latin1_general_ci NOT NULL,
  `content` mediumtext collate latin1_general_ci,
  PRIMARY KEY  (`id`),
  KEY `locale` (`locale`),
  KEY `model` (`model`),
  KEY `row_id` (`foreign_key`),
  KEY `field` (`field`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=33 ;

-- 
-- Dumping data for table `i18n`
-- 

INSERT INTO `i18n` VALUES (1, 'en_us', 'Story', 1, 'title', 'Manned Mars Mission');
INSERT INTO `i18n` VALUES (2, 'en_us', 'Story', 1, 'body', 'After an epic 2 year voyage, our astronauts are a week away from landing on the red planet.');
INSERT INTO `i18n` VALUES (3, 'en_us', 'Story', 2, 'title', 'The Large Hydron Collider');
INSERT INTO `i18n` VALUES (4, 'en_us', 'Story', 2, 'body', 'Scientists working on the world''s largest atom smasher have finally cracked the secret to dark matter, but its not what they thought it was.');
INSERT INTO `i18n` VALUES (5, 'en_us', 'Story', 3, 'title', 'Mind to Machine Programming');
INSERT INTO `i18n` VALUES (6, 'en_us', 'Story', 3, 'body', 'Neuro engineers have developed a new technique to map cognitive processes to computer programs.');

-- --------------------------------------------------------

-- 
-- Table structure for table `stories`
-- 

CREATE TABLE `stories` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci NOT NULL,
  `body` mediumtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `stories`
-- 

INSERT INTO `stories` VALUES (1, 'Manned Mars Mission', 'After an epic 2 year voyage, our astronauts are a week away from landing on the red planet.');
INSERT INTO `stories` VALUES (2, 'The Large Hydron Collider', 'Scientists working on the world''s largest atom smasher have finally cracked the secret to dark matter, but its not what they thought it was.');
INSERT INTO `stories` VALUES (3, 'Mind to Machine Programming', 'Neuro engineers have developed a new technique to map cognitive processes to computer programs.');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate latin1_general_ci NOT NULL,
  `username` varchar(255) collate latin1_general_ci NOT NULL,
  `password` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'Joe Bloggs', 'test', '098f6bcd4621d373cade4e832627b4f6');
