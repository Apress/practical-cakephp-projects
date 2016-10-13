-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 10, 2008 at 11:29 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `chapter_4`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `messages`
-- 

CREATE TABLE `messages` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `reply_to` char(36) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `t_created_at` datetime NOT NULL,
  `thread_id` char(36) NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `full_text_1` (`email`,`subject`,`message`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `messages`
-- 

INSERT INTO `messages` VALUES ('488da7c4-3f1c-48f7-9f80-0e54cbdd56cb', '111', '222', '<p>3333</p>', '488bb046-2ae8-43c2-af41-0154cbdd56cb', 'RE: Hyper Dimensional Resonator for sale', '2008-07-28 12:04:36', '488bb046-5004-44e2-9dbd-0154cbdd56cb');
INSERT INTO `messages` VALUES ('488bb046-2ae8-43c2-af41-0154cbdd56cb', 'John Titor', 'sfsd', '<p>Time travel machine. Good working order. Used only once. 10,000 Ningis ono. if you''re interested, please call me on 314 159 2653.</p>', '', 'Hyper Dimensional Resonator for sale', '2008-07-27 00:16:22', '488bb046-5004-44e2-9dbd-0154cbdd56cb');
INSERT INTO `messages` VALUES ('488bb08c-54cc-4c73-94a7-0154cbdd56cb', 'Joker', 'asdf', '<p>While shopping for my first CD player, I was able to decipher most of the  technicalese on the promotional signs. One designation had me puzzled, though,  so I called over a salesperson and asked, "What does ''hybrid pulse D/A  converter'' mean?" "That means", he said, "that this machine will read the  digital information that is encoded on CDs and convert it into an audio signal -  that is, into music." "In other words this CD player plays CDs." "Exactly."</p>', '', 'Its a CD Player', '2008-07-27 00:17:32', '488bb08c-79e8-45dd-a9fe-0154cbdd56cb');

-- --------------------------------------------------------

-- 
-- Table structure for table `threads`
-- 

CREATE TABLE `threads` (
  `id` char(36) NOT NULL,
  `first_message_id` char(36) NOT NULL,
  `last_message_date` datetime NOT NULL,
  `message_num` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `threads`
-- 

INSERT INTO `threads` VALUES ('488bb046-5004-44e2-9dbd-0154cbdd56cb', '488bb046-2ae8-43c2-af41-0154cbdd56cb', '2008-07-27 00:16:22', 2);
INSERT INTO `threads` VALUES ('488bb08c-79e8-45dd-a9fe-0154cbdd56cb', '488bb08c-54cc-4c73-94a7-0154cbdd56cb', '2008-07-27 00:17:32', 1);
