-- phpMyAdmin SQL Dump
-- version 3.3.7deb6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 16, 2011 at 05:50 PM
-- Server version: 5.0.51
-- PHP Version: 5.3.3-7+squeeze3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `progfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` smallint(6) NOT NULL auto_increment,
  `article_id-unix` varchar(32) NOT NULL,
  `article_name_fr` tinytext NOT NULL,
  `article_name_en` tinytext NOT NULL,
  `article_body_fr` text NOT NULL,
  `article_body_en` text NOT NULL,
  PRIMARY KEY  (`article_id`),
  UNIQUE KEY `article_unix_id` (`article_id-unix`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_id-unix`, `article_name_fr`, `article_name_en`, `article_body_fr`, `article_body_en`) VALUES
(18, 'welcome', 'Bienvenue !', 'Welcome!', 'Ceci est un progfolio vide. Visitez la page du projet pour plus de dÃ©tails: [[github.com/lorancou/progfolio]].', 'This is an empty progfolio. Check the project page for details: [[github.com/lorancou/progfolio]].');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `file_id` smallint(6) NOT NULL auto_increment,
  `file_id-unix` varchar(32) NOT NULL,
  `file_name` varchar(256) NOT NULL,
  `file_title_fr` varchar(256) NOT NULL,
  `file_title_en` varchar(256) NOT NULL,
  PRIMARY KEY  (`file_id`),
  UNIQUE KEY `fichier_id-unix` (`file_id-unix`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `file`
--


-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `image_id` int(11) NOT NULL auto_increment,
  `image_id-unix` varchar(32) NOT NULL,
  `image_name` varchar(256) NOT NULL,
  `image_title_fr` varchar(256) NOT NULL,
  `image_title_en` varchar(256) NOT NULL,
  `image_alt_fr` varchar(256) NOT NULL,
  `image_alt_en` varchar(256) NOT NULL,
  PRIMARY KEY  (`image_id`),
  UNIQUE KEY `image_id-unix` (`image_id-unix`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `image`
--


-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` smallint(6) NOT NULL auto_increment,
  `item_id-unix` varchar(32) NOT NULL,
  `item_order` tinyint(4) NOT NULL,
  `item_name_fr` text NOT NULL,
  `item_name_en` text NOT NULL,
  `item_url` text NOT NULL,
  `item_description_fr` text NOT NULL,
  `item_description_en` text NOT NULL,
  `item_type` varchar(32) NOT NULL,
  PRIMARY KEY  (`item_id`),
  UNIQUE KEY `item_id-unix` (`item_id-unix`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `item`
--


-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(11) NOT NULL auto_increment,
  `project_id-unix` varchar(32) NOT NULL,
  `project_name_fr` text NOT NULL,
  `project_name_en` text NOT NULL,
  `project_uv` varchar(4) NOT NULL,
  `project_title_fr` text NOT NULL,
  `project_title_en` text NOT NULL,
  `project_type` tinyint(1) NOT NULL default '0',
  `project_date_begin` date NOT NULL,
  `project_date_end` date default NULL,
  `project_semester` char(1) NOT NULL,
  `project_year` int(11) NOT NULL default '0',
  `project_url` text NOT NULL,
  `project_description_fr` text NOT NULL,
  `project_description_en` text NOT NULL,
  `project_body_fr` text NOT NULL,
  `project_body_en` text NOT NULL,
  PRIMARY KEY  (`project_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `project`
--


-- --------------------------------------------------------

--
-- Table structure for table `project-file`
--

CREATE TABLE IF NOT EXISTS `project-file` (
  `project-file_id` smallint(6) NOT NULL auto_increment,
  `project-file_id-project` smallint(6) NOT NULL,
  `project-file_id-file` smallint(6) NOT NULL,
  PRIMARY KEY  (`project-file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `project-file`
--


-- --------------------------------------------------------

--
-- Table structure for table `project-image`
--

CREATE TABLE IF NOT EXISTS `project-image` (
  `project-image_id` smallint(6) NOT NULL auto_increment,
  `project-image_id-project` smallint(6) NOT NULL,
  `project-image_id-image` smallint(6) NOT NULL,
  PRIMARY KEY  (`project-image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `project-image`
--


-- --------------------------------------------------------

--
-- Table structure for table `typep`
--

CREATE TABLE IF NOT EXISTS `typep` (
  `typep_id` tinyint(4) NOT NULL auto_increment,
  `typep_id-unix` varchar(32) NOT NULL,
  `typep_name_fr` text NOT NULL,
  `typep_name_en` text NOT NULL,
  `typep_description_fr` text NOT NULL,
  `typep_description_en` text NOT NULL,
  PRIMARY KEY  (`typep_id`),
  UNIQUE KEY `projet-type_id-unix` (`typep_id-unix`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `typep`
--

