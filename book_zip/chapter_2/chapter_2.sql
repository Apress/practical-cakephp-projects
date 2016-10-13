-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 10, 2008 at 11:25 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `chapter_2`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `comments`
-- 

CREATE TABLE `comments` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `content` text,
  `post_id` int(11) unsigned default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `published` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `comments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `posts`
-- 

CREATE TABLE `posts` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) default NULL,
  `content` text,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `published` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `posts`
-- 

INSERT INTO `posts` VALUES (1, 'Another day Still Looking', 'My Lion ran off', '2008-06-19 18:26:11', '2008-06-19 18:26:11', 1);
INSERT INTO `posts` VALUES (2, 'A good day', 'The Lion is back in one piece.', '2008-06-19 18:31:50', '2008-06-19 18:31:50', 1);
INSERT INTO `posts` VALUES (3, 'Thank GOD', 'Everything belongs to my father', '2008-06-20 18:42:11', '2008-06-20 18:42:11', 1);
INSERT INTO `posts` VALUES (4, 'At the seaside', 'We went down to the sea side, then it started raining!', '2008-08-27 16:52:20', '2008-08-27 16:52:20', 1);
INSERT INTO `posts` VALUES (5, 'Getting close', 'We are getting close to the end of school break.', '2008-08-27 16:52:58', '2008-08-27 16:52:58', 0);
INSERT INTO `posts` VALUES (6, 'Boring posts', 'The events diary is not interesting', '2008-08-28 05:03:13', '2008-08-28 05:03:13', 1);
