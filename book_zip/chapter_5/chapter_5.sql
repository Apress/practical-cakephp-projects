-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 10, 2008 at 11:30 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `chapter_5`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `journeys`
-- 

CREATE TABLE `journeys` (
  `id` int(11) NOT NULL auto_increment,
  `journey_name` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `journeys`
-- 

INSERT INTO `journeys` VALUES (1, '111aaa', '444ddd', '1dee873f135857ecd3a80a9ac64ed99f');
INSERT INTO `journeys` VALUES (2, 'Our European Vacation', 'Having lots of fun!', '68264bdb65b97eeae6788aa3348e553c');

-- --------------------------------------------------------

-- 
-- Table structure for table `locations`
-- 

CREATE TABLE `locations` (
  `id` int(11) NOT NULL auto_increment,
  `location_name` varchar(255) NOT NULL,
  `comments` varchar(255) default NULL,
  `coord` varchar(255) NOT NULL,
  `journey_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `locations`
-- 

INSERT INTO `locations` VALUES (1, 'liverpool', '555eee', '53.410777,-2.977838', 1);
INSERT INTO `locations` VALUES (2, 'london', '666fff', '51.500152,-0.126236', 1);
INSERT INTO `locations` VALUES (3, 'Marseille', 'Nice to be by the coast.', '43.298344,5.383221', 2);
INSERT INTO `locations` VALUES (4, 'Paris', 'So romantic!', '48.856667,2.350987', 2);
INSERT INTO `locations` VALUES (5, 'Madrid', 'Amazing food.', '40.416741,-3.70325', 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `tags`
-- 

CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tag_name` varchar(100) default NULL,
  `journey_id` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `tags`
-- 

INSERT INTO `tags` VALUES (2, '333ccc', '1');
INSERT INTO `tags` VALUES (3, 'Marseille', '2');
INSERT INTO `tags` VALUES (4, 'Madrid', '2');
INSERT INTO `tags` VALUES (5, 'Paris', '2');
