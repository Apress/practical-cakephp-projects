-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 10, 2008 at 11:31 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `chapter_9`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `i18n`
-- 

CREATE TABLE `i18n` (
  `id` int(10) NOT NULL auto_increment,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` mediumtext,
  PRIMARY KEY  (`id`),
  KEY `locale` (`locale`),
  KEY `model` (`model`),
  KEY `row_id` (`foreign_key`),
  KEY `field` (`field`)
) TYPE=MyISAM  AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `i18n`
-- 

INSERT INTO `i18n` VALUES (1, 'en_us', 'Story', 1, 'title', 'Manned Mars Mission');
INSERT INTO `i18n` VALUES (2, 'en_us', 'Story', 1, 'body', 'After an epic 2 year voyage, our astronauts are a week away from landing on the red planet.');
INSERT INTO `i18n` VALUES (3, 'en_us', 'Story', 2, 'title', 'The Large Hydron Collider');
INSERT INTO `i18n` VALUES (4, 'en_us', 'Story', 2, 'body', 'Scientists working on the world''s largest atom smasher have finally cracked the secret to dark matter, but its not what they thought it was.');
INSERT INTO `i18n` VALUES (5, 'en_us', 'Story', 3, 'title', 'Mind to Machine Programming');
INSERT INTO `i18n` VALUES (6, 'en_us', 'Story', 3, 'body', 'Neuro engineers have developed a new technique to map cognitive processes to computer programs.');
INSERT INTO `i18n` VALUES (7, 'jpn', 'Story', 1, 'title', 'ãƒ³ãƒ„ã‚¢ã‚¯ã‚»ã‚·');
INSERT INTO `i18n` VALUES (8, 'jpn', 'Story', 1, 'body', 'ã®ãª æ‹¡ãªãƒž ã«ã«ã‚ˆã‚‹ ãƒžãƒ«ãƒãƒ¡ ã‚ªãƒ–ã‚¸ã‚§ã‚¯, ã‚·ãƒ“ãƒªãƒ†ã‚£ã‚¬ ã‚¢ã‚­ãƒ†ã‚¯ãƒãƒ£ ã‚¯ã» å†…å‡†å‰› ãµã¹ã‹ã‚‰ãš ã‚µã‚¤ãƒˆã‚’ã‚¢ã‚¯ã‚»ã‚·ãƒ– å¯›ä¼š ã‚ã£ãŸ, ã‚’ãƒž ã‚·ãƒˆã‚’ ãƒã‚¸ãƒ§ãƒ³ ã‚³ãƒ³ãƒ†ãƒ³ ãƒ³ã‚¿ãƒãƒƒãƒˆå”ä¼š');

-- --------------------------------------------------------

-- 
-- Table structure for table `stories`
-- 

CREATE TABLE `stories` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `body` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `stories`
-- 

INSERT INTO `stories` VALUES (1, 'ãƒ³ãƒ„ã‚¢ã‚¯ã‚»ã‚·', 'ã®ãª æ‹¡ãªãƒž ã«ã«ã‚ˆã‚‹ ãƒžãƒ«ãƒãƒ¡ ã‚ªãƒ–ã‚¸ã‚§ã‚¯, ã‚·ãƒ“ãƒªãƒ†ã‚£ã‚¬ ã‚¢ã‚­ãƒ†ã‚¯ãƒãƒ£ ã‚¯ã» å†…å‡†å‰› ãµã¹ã‹ã‚‰ãš ã‚µã‚¤ãƒˆã‚’ã‚¢ã‚¯ã‚»ã‚·ãƒ– å¯›ä¼š ã‚ã£ãŸ, ã‚’ãƒž ã‚·ãƒˆã‚’ ãƒã‚¸ãƒ§ãƒ³ ã‚³ãƒ³ãƒ†ãƒ³ ãƒ³ã‚¿ãƒãƒƒãƒˆå”ä¼š');
INSERT INTO `stories` VALUES (2, 'The Large Hydron Collider', 'Scientists working on the world''s largest atom smasher have finally cracked the secret to dark matter, but its not what they thought it was.');
INSERT INTO `stories` VALUES (3, 'Mind to Machine Programming', 'Neuro engineers have developed a new technique to map cognitive processes to computer programs.');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'Joe Bloggs', 'test', '098f6bcd4621d373cade4e832627b4f6');
