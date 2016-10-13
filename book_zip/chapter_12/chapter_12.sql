-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 10, 2008 at 11:33 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `chapter_12`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `field_type_groups`
-- 

CREATE TABLE `field_type_groups` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `field_type_groups`
-- 

INSERT INTO `field_type_groups` VALUES (1, 'Decimal Field');
INSERT INTO `field_type_groups` VALUES (3, 'Varchar Field');
INSERT INTO `field_type_groups` VALUES (4, 'Television Brands');

-- --------------------------------------------------------

-- 
-- Table structure for table `field_type_values`
-- 

CREATE TABLE `field_type_values` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `field_type_group_id` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `field_type_values`
-- 

INSERT INTO `field_type_values` VALUES (3, 'Panasonic', '4');
INSERT INTO `field_type_values` VALUES (4, 'Samsung', '4');
INSERT INTO `field_type_values` VALUES (5, '[DECIMAL]', '1');
INSERT INTO `field_type_values` VALUES (6, '[VARCHAR]', '3');

-- --------------------------------------------------------

-- 
-- Table structure for table `product_field_groups`
-- 

CREATE TABLE `product_field_groups` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `product_field_groups`
-- 

INSERT INTO `product_field_groups` VALUES (1, 'Television Data');

-- --------------------------------------------------------

-- 
-- Table structure for table `product_field_values`
-- 

CREATE TABLE `product_field_values` (
  `id` int(11) NOT NULL auto_increment,
  `product_field_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `field_type_value_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `product_field_values`
-- 

INSERT INTO `product_field_values` VALUES (1, 1, 'Panasonic', 3, 1);
INSERT INTO `product_field_values` VALUES (2, 2, '600', 5, 1);
INSERT INTO `product_field_values` VALUES (3, 1, 'Panasonic', 3, 2);
INSERT INTO `product_field_values` VALUES (4, 2, '5000', 5, 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `product_fields`
-- 

CREATE TABLE `product_fields` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `field_type_group_id` varchar(255) NOT NULL,
  `product_field_group_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `product_fields`
-- 

INSERT INTO `product_fields` VALUES (1, 'Product Brand', '4', 1);
INSERT INTO `product_fields` VALUES (2, 'Product Price', '1', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `product_groups`
-- 

CREATE TABLE `product_groups` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `product_group_id` int(11) NOT NULL,
  `product_field_group_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `product_groups`
-- 

INSERT INTO `product_groups` VALUES (1, 'LCD Displays', '', 9, 1);
INSERT INTO `product_groups` VALUES (6, 'Home', 'All Products', 0, 0);
INSERT INTO `product_groups` VALUES (9, 'Televisions', '', 8, 0);
INSERT INTO `product_groups` VALUES (8, 'Electronics', '', 6, 0);
INSERT INTO `product_groups` VALUES (13, 'Computer Monitors', '', 8, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `product_searches`
-- 

CREATE TABLE `product_searches` (
  `id` int(11) NOT NULL auto_increment,
  `product_field_id` int(255) NOT NULL,
  `field_type_value_id` int(11) NOT NULL,
  `value_less` varchar(255) NOT NULL,
  `value_from` varchar(255) NOT NULL,
  `value_to` varchar(255) NOT NULL,
  `value_more` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `product_searches`
-- 

INSERT INTO `product_searches` VALUES (1, 1, 3, '', '', '', '');
INSERT INTO `product_searches` VALUES (2, 1, 4, '', '', '', '');
INSERT INTO `product_searches` VALUES (3, 2, 5, '', '500', '1000', '');
INSERT INTO `product_searches` VALUES (6, 2, 5, '', '1001', '10000', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `products`
-- 

CREATE TABLE `products` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `product_field_group_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `products`
-- 

INSERT INTO `products` VALUES (1, 'Panasonic AB-12XY34', 1);
INSERT INTO `products` VALUES (2, 'Panasonic AB-78XY89', 1);
INSERT INTO `products` VALUES (3, 'Panasonic AB-WOW', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `products_product_groups`
-- 

CREATE TABLE `products_product_groups` (
  `id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL,
  `product_group_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `products_product_groups`
-- 

INSERT INTO `products_product_groups` VALUES (1, 1, 1);
INSERT INTO `products_product_groups` VALUES (2, 1, 9);
INSERT INTO `products_product_groups` VALUES (3, 2, 1);
INSERT INTO `products_product_groups` VALUES (4, 2, 9);
INSERT INTO `products_product_groups` VALUES (5, 3, 1);
INSERT INTO `products_product_groups` VALUES (6, 3, 9);
