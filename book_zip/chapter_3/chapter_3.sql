-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 10, 2008 at 11:29 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `chapter_3`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `carts`
-- 

CREATE TABLE `carts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `product_id` int(10) unsigned NOT NULL default '0',
  `qty` mediumint(8) unsigned NOT NULL default '1',
  `ct_session_id` char(32) NOT NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `pd_id` (`product_id`),
  KEY `ct_session_id` (`ct_session_id`)
) TYPE=MyISAM  AUTO_INCREMENT=64 ;

-- 
-- Dumping data for table `carts`
-- 

INSERT INTO `carts` VALUES (46, 0, 1, '', '2008-10-16 20:17:06');
INSERT INTO `carts` VALUES (54, 0, 1, '', '2008-10-17 00:07:16');
INSERT INTO `carts` VALUES (47, 0, 1, '', '2008-10-16 20:17:09');
INSERT INTO `carts` VALUES (48, 0, 1, '', '2008-10-16 20:17:12');
INSERT INTO `carts` VALUES (49, 0, 1, '', '2008-10-16 20:17:47');
INSERT INTO `carts` VALUES (50, 0, 1, '', '2008-10-16 20:18:16');
INSERT INTO `carts` VALUES (51, 0, 1, '', '2008-10-16 20:18:19');
INSERT INTO `carts` VALUES (52, 22, 2, '589a9765d2cf767c3f770eb45ee35890', '2008-10-16 20:18:44');
INSERT INTO `carts` VALUES (53, 1, 2, '589a9765d2cf767c3f770eb45ee35890', '2008-10-16 20:18:53');
INSERT INTO `carts` VALUES (55, 0, 1, '', '2008-10-17 00:07:33');
INSERT INTO `carts` VALUES (56, 0, 1, '', '2008-10-17 00:07:53');
INSERT INTO `carts` VALUES (57, 0, 1, '', '2008-10-17 00:09:22');
INSERT INTO `carts` VALUES (58, 0, 1, '', '2008-10-17 00:09:51');
INSERT INTO `carts` VALUES (59, 0, 1, '', '2008-10-17 00:10:35');
INSERT INTO `carts` VALUES (60, 0, 1, '', '2008-10-17 00:10:49');
INSERT INTO `carts` VALUES (61, 0, 1, '', '2008-10-17 00:11:50');
INSERT INTO `carts` VALUES (62, 0, 1, '', '2008-10-17 00:12:01');
INSERT INTO `carts` VALUES (63, 22, 3, 'cf240d7db383ef52cf14f4a97c0ed692', '2008-10-17 00:13:06');

-- --------------------------------------------------------

-- 
-- Table structure for table `categories`
-- 

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `name` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cat_parent_id` (`parent_id`),
  KEY `cat_name` (`name`)
) TYPE=MyISAM  AUTO_INCREMENT=18 ;

-- 
-- Dumping data for table `categories`
-- 

INSERT INTO `categories` VALUES (17, 0, 'Jazz', 'Everything from 1890s', '');
INSERT INTO `categories` VALUES (12, 0, 'Classical', 'From Medieval to Contemporary', '');
INSERT INTO `categories` VALUES (13, 17, 'Dizzy Gillespie', 'The Trumpeter Master', '');
INSERT INTO `categories` VALUES (14, 12, 'Mozart', 'The Old Favourite', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `customers`
-- 

CREATE TABLE `customers` (
  `id` int(11) NOT NULL auto_increment,
  `customers_gender` char(1) NOT NULL,
  `customers_firstname` varchar(32) NOT NULL,
  `customers_lastname` varchar(32) NOT NULL,
  `customers_dob` datetime NOT NULL default '0000-00-00 00:00:00',
  `customers_email_address` varchar(96) NOT NULL,
  `customers_default_address_id` int(11) default NULL,
  `customers_telephone` varchar(32) NOT NULL,
  `customers_fax` varchar(32) default NULL,
  `customers_password` varchar(40) NOT NULL,
  `customers_newsletter` char(1) default NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_customers_email_address` (`customers_email_address`)
) TYPE=MyISAM  AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `customers`
-- 

INSERT INTO `customers` VALUES (1, 'm', 'John', 'doe', '2001-01-01 00:00:00', 'root@localhost', 1, '12345', '', 'd95e8fa7f20a009372eb3477473fcd34:1c', '0');
INSERT INTO `customers` VALUES (2, '', '', '', '2028-01-01 00:00:00', '', 0, '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `order_items`
-- 

CREATE TABLE `order_items` (
  `id` int(10) unsigned NOT NULL default '0',
  `product_id` int(10) unsigned NOT NULL default '0',
  `qty` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`,`product_id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `order_items`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `orders`
-- 

CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `date` datetime default NULL,
  `last_update` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` enum('New','Paid','Shipped','Completed','Cancelled') NOT NULL default 'New',
  `memo` varchar(255) NOT NULL default '',
  `shipping_first_name` varchar(50) NOT NULL default '',
  `shipping_last_name` varchar(50) NOT NULL default '',
  `shipping_address1` varchar(100) NOT NULL default '',
  `shipping_address2` varchar(100) NOT NULL default '',
  `shipping_phone` varchar(32) NOT NULL default '',
  `shipping_city` varchar(100) NOT NULL default '',
  `shipping_state` varchar(32) NOT NULL default '',
  `shipping_postal_code` varchar(10) NOT NULL default '',
  `shipping_cost` decimal(5,2) default '0.00',
  `payment_first_name` varchar(50) NOT NULL default '',
  `payment_last_name` varchar(50) NOT NULL default '',
  `payment_address1` varchar(100) NOT NULL default '',
  `payment_address2` varchar(100) NOT NULL default '',
  `payment_phone` varchar(32) NOT NULL default '',
  `payment_city` varchar(100) NOT NULL default '',
  `payment_state` varchar(32) NOT NULL default '',
  `payment_postal_code` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=1001 ;

-- 
-- Dumping data for table `orders`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `products`
-- 

CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `category_id` int(10) unsigned NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `description` text NOT NULL,
  `price` decimal(9,2) NOT NULL default '0.00',
  `qty` smallint(5) unsigned NOT NULL default '0',
  `image` varchar(200) default NULL,
  `thumbnail` varchar(200) default NULL,
  `created` datetime NOT NULL default '0000-00-00 00:00:00',
  `modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `cat_id` (`category_id`),
  KEY `name` (`name`)
) TYPE=MyISAM  AUTO_INCREMENT=23 ;

-- 
-- Dumping data for table `products`
-- 

INSERT INTO `products` VALUES (1, 13, 'Dizzy 1990s', 'Best of Dizzy Gillespie in the 1990s', 12.00, 10, NULL, '1.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `products` VALUES (2, 14, 'Mozart for Lovers', 'Relax with your loved one with this double CD.', 15.00, 5, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `products` VALUES (22, 13, 'Dizzy and Stan', 'Live with Dizzy Gillespie and Stan Getz.', 13.00, 10, NULL, '1.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `gender` char(1) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `dob` datetime NOT NULL default '0000-00-00 00:00:00',
  `email_address` varchar(96) NOT NULL,
  `default_address_id` int(11) default NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) default NULL,
  `password` varchar(40) NOT NULL,
  `newsletter` char(1) default NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_email_address` (`email_address`)
) TYPE=MyISAM  AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `users`
-- 

