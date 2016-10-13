-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 10, 2008 at 11:31 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `chapter_8`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `acos`
-- 

CREATE TABLE `acos` (
  `id` int(10) NOT NULL auto_increment,
  `parent_id` int(10) default NULL,
  `model` varchar(255) default NULL,
  `foreign_key` int(10) default NULL,
  `alias` varchar(255) default NULL,
  `lft` int(10) default NULL,
  `rght` int(10) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `acos`
-- 

INSERT INTO `acos` VALUES (1, 0, 'Widget', 0, 'Widgets', 1, 4);
INSERT INTO `acos` VALUES (2, 1, 'Widget', 0, 'someAction', 2, 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `aros`
-- 

CREATE TABLE `aros` (
  `id` int(10) NOT NULL auto_increment,
  `parent_id` int(10) default NULL,
  `model` varchar(255) default NULL,
  `foreign_key` int(10) default NULL,
  `alias` varchar(255) default NULL,
  `lft` int(10) default NULL,
  `rght` int(10) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `aros`
-- 

INSERT INTO `aros` VALUES (1, 0, 'User', 1, 'User:1', 1, 2);
INSERT INTO `aros` VALUES (2, 0, 'Group', 1, 'Group:1', 3, 6);
INSERT INTO `aros` VALUES (3, 0, 'Group', 2, 'Group:2', 7, 8);
INSERT INTO `aros` VALUES (4, 2, 'User', 2, 'User:2', 4, 5);

-- --------------------------------------------------------

-- 
-- Table structure for table `aros_acos`
-- 

CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL auto_increment,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL default '0',
  `_read` varchar(2) NOT NULL default '0',
  `_update` varchar(2) NOT NULL default '0',
  `_delete` varchar(2) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) TYPE=MyISAM  AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `aros_acos`
-- 

INSERT INTO `aros_acos` VALUES (1, 2, 2, '-1', '-1', '-1', '-1');

-- --------------------------------------------------------

-- 
-- Table structure for table `groups`
-- 

CREATE TABLE `groups` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `groups`
-- 

INSERT INTO `groups` VALUES (1, 'admin', 0);
INSERT INTO `groups` VALUES (2, 'user', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (1, 'temp', '055cd666a7840de8ae29d4477585480b08d1559c', 0);
INSERT INTO `users` VALUES (2, 'admin', '2799da9a73fdad3ae9af02a3bcadb204e1baf515', 1);
