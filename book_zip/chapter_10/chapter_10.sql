-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 10, 2008 at 11:31 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `chapter_10`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `your_tables`
-- 

CREATE TABLE `your_tables` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `m_lock` varchar(255) NOT NULL,
  `m_record_order` int(11) NOT NULL,
  `m_security` varchar(255) NOT NULL,
  `m_display_record` int(11) NOT NULL,
  `m_accessed` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `your_tables`
-- 

INSERT INTO `your_tables` VALUES (1, 'test reocrdxxxxxxxxxxxxxxx123', 'aasdfasd', 0, '0', 1, 32, '2008-08-13 23:07:07', '2008-08-11 21:10:16');
