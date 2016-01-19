SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `article` (
  `article_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `article_id-unix` varchar(32) NOT NULL,
  `article_name_fr` tinytext NOT NULL,
  `article_name_en` tinytext NOT NULL,
  `article_body_fr` text NOT NULL,
  `article_body_en` text NOT NULL,
  PRIMARY KEY (`article_id`),
  UNIQUE KEY `article_unix_id` (`article_id-unix`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

INSERT INTO `article` (`article_id`, `article_id-unix`, `article_name_fr`, `article_name_en`, `article_body_fr`, `article_body_en`) VALUES
(18, 'welcome', 'Bienvenue !', 'Welcome!', 'Ceci est un progfolio vide. Visitez la [[page du projet sur GitHub][http://github.com/lorancou/progfolio]] pour plus de dÃ©tails.', 'This is a dummy progfolio. Check the [[GitHub project page][http://github.com/lorancou/progfolio]] for details.');

CREATE TABLE IF NOT EXISTS `file` (
  `file_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `file_id-unix` varchar(32) NOT NULL,
  `file_name` varchar(256) NOT NULL,
  `file_title_fr` varchar(256) NOT NULL,
  `file_title_en` varchar(256) NOT NULL,
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `fichier_id-unix` (`file_id-unix`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

CREATE TABLE IF NOT EXISTS `image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id-unix` varchar(32) NOT NULL,
  `image_name` varchar(256) NOT NULL,
  `image_title_fr` varchar(256) NOT NULL,
  `image_title_en` varchar(256) NOT NULL,
  `image_alt_fr` varchar(256) NOT NULL,
  `image_alt_en` varchar(256) NOT NULL,
  PRIMARY KEY (`image_id`),
  UNIQUE KEY `image_id-unix` (`image_id-unix`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `item_id-unix` varchar(32) NOT NULL,
  `item_order` tinyint(4) NOT NULL,
  `item_name_fr` text NOT NULL,
  `item_name_en` text NOT NULL,
  `item_url` text NOT NULL,
  `item_description_fr` text NOT NULL,
  `item_description_en` text NOT NULL,
  `item_type` varchar(32) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_id-unix` (`item_id-unix`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

INSERT INTO `item` (`item_id`, `item_id-unix`, `item_order`, `item_name_fr`, `item_name_en`, `item_url`, `item_description_fr`, `item_description_en`, `item_type`) VALUES
(21, 'welcome', 1, 'Bienvenue !', 'Welcome!', '?page=welcome', 'Page de bienvenue.', 'Welcome page.', ''),
(22, 'section1', 2, 'Section 1', 'Section 1', '?page=projects&type=section1', 'Intro section 1.', 'Section 1.', 'page-prj');

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id-unix` varchar(32) NOT NULL,
  `project_name_fr` text NOT NULL,
  `project_name_en` text NOT NULL,
  `project_uv` varchar(4) NOT NULL,
  `project_title_fr` text NOT NULL,
  `project_title_en` text NOT NULL,
  `project_type` tinyint(1) NOT NULL DEFAULT '0',
  `project_date_begin` date NOT NULL,
  `project_date_end` date DEFAULT NULL,
  `project_semester` char(1) NOT NULL,
  `project_year` int(11) NOT NULL DEFAULT '0',
  `project_url` text NOT NULL,
  `project_description_fr` text NOT NULL,
  `project_description_en` text NOT NULL,
  `project_body_fr` text NOT NULL,
  `project_body_en` text NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

INSERT INTO `project` (`project_id`, `project_id-unix`, `project_name_fr`, `project_name_en`, `project_uv`, `project_title_fr`, `project_title_en`, `project_type`, `project_date_begin`, `project_date_end`, `project_semester`, `project_year`, `project_url`, `project_description_fr`, `project_description_en`, `project_body_fr`, `project_body_en`) VALUES
(36, 'proj1', 'Projet 1', 'Project 1', '', '', '', 10, '1111-11-11', '1111-11-11', '', 0, 'http://example.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce consequat dolor eget nulla sollicitudin, et iaculis enim ornare. Cras dignissim quis mi a tempor. Quisque est magna, semper a eleifend ut, porttitor id ipsum. Vestibulum volutpat eros justo, suscipit egestas ipsum scelerisque sit amet. Vestibulum leo nunc, commodo ut erat vitae, laoreet congue nunc. Etiam et varius tortor. Sed tempor a eros id euismod. Donec hendrerit nulla et egestas imperdiet. Ut vitae felis ac lectus viverra pharetra. Aliquam a odio posuere lorem congue imperdiet.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce consequat dolor eget nulla sollicitudin, et iaculis enim ornare. Cras dignissim quis mi a tempor. Quisque est magna, semper a eleifend ut, porttitor id ipsum. Vestibulum volutpat eros justo, suscipit egestas ipsum scelerisque sit amet. Vestibulum leo nunc, commodo ut erat vitae, laoreet congue nunc. Etiam et varius tortor. Sed tempor a eros id euismod. Donec hendrerit nulla et egestas imperdiet. Ut vitae felis ac lectus viverra pharetra. Aliquam a odio posuere lorem congue imperdiet.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce consequat dolor eget nulla sollicitudin, et iaculis enim ornare. Cras dignissim quis mi a tempor. Quisque est magna, semper a eleifend ut, porttitor id ipsum. Vestibulum volutpat eros justo, suscipit egestas ipsum scelerisque sit amet. Vestibulum leo nunc, commodo ut erat vitae, laoreet congue nunc. Etiam et varius tortor. Sed tempor a eros id euismod. Donec hendrerit nulla et egestas imperdiet. Ut vitae felis ac lectus viverra pharetra. Aliquam a odio posuere lorem congue imperdiet.\r\n\r\nEtiam suscipit sed dolor vel tempor. Phasellus magna arcu, tincidunt id aliquet non, venenatis pulvinar tellus. Sed sollicitudin orci a pulvinar luctus. Duis a tempus arcu. Nunc non commodo turpis, ornare tempor magna. Aliquam sit amet euismod justo. Quisque in mi sollicitudin, pretium dolor eget, ornare lacus. Nunc sapien justo, imperdiet non mi nec, aliquet adipiscing nunc. Aliquam lectus nisl, vestibulum at volutpat quis, convallis ac ante. Morbi id lacus suscipit, hendrerit purus eu, volutpat ligula. Etiam mattis lobortis orci, at adipiscing turpis vulputate in. Vivamus scelerisque ac nunc vulputate convallis.\r\n\r\nCras sollicitudin tortor enim, at pretium nibh pharetra nec. Aenean tellus diam, interdum quis nunc eget, blandit euismod odio. Sed dignissim gravida neque, at ultrices massa gravida vitae. Donec in sem a nunc elementum facilisis eget eget nunc. Integer nisi erat, viverra a tincidunt a, lobortis vel nisl. Vestibulum est lectus, volutpat in ornare nec, varius ac velit. Suspendisse congue consectetur pharetra. Sed neque tellus, dignissim id cursus ut, mollis et justo. Cras fermentum ac est nec condimentum.\r\n\r\nDuis at leo condimentum, varius arcu vitae, vehicula arcu. Duis aliquet elit arcu, sed semper turpis scelerisque sed. Vivamus faucibus et neque at tempor. Fusce at est tempor, congue mi id, facilisis enim. Nam a lorem elementum, ultrices ante ullamcorper, sodales turpis. Nulla ut ligula imperdiet, sagittis tortor at, ultrices lacus. Maecenas in urna tincidunt ligula consectetur imperdiet eget in nisi. Nullam eleifend vestibulum diam et congue. Nulla aliquet nulla non metus condimentum, sed eleifend leo viverra. Integer vel nisl dapibus, auctor lorem non, mattis orci. Maecenas sapien metus, eleifend quis euismod in, feugiat porta nibh. Suspendisse eleifend, ipsum eget cursus consequat, mauris est pharetra tellus, nec tincidunt sem mi et mauris. Ut non diam sed est faucibus mattis eu id elit. Nam fermentum tellus nec leo porta, id sollicitudin eros vehicula.\r\n\r\nNulla bibendum dignissim convallis. Donec vestibulum, ligula quis vulputate tempor, lacus est eleifend est, euismod elementum nisl arcu consectetur risus. Vestibulum sapien eros, blandit eu rutrum sit amet, posuere eu enim. Mauris in egestas enim. Integer molestie metus id erat consequat, ullamcorper sagittis enim euismod. Nunc quis enim pellentesque massa euismod consequat. Maecenas scelerisque lectus ac neque porta, quis facilisis risus faucibus. Proin leo erat, interdum non augue at, semper ornare ipsum. Sed mollis libero tempor nisi eleifend dapibus. In hac habitasse platea dictumst. Suspendisse quis nisi magna.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce consequat dolor eget nulla sollicitudin, et iaculis enim ornare. Cras dignissim quis mi a tempor. Quisque est magna, semper a eleifend ut, porttitor id ipsum. Vestibulum volutpat eros justo, suscipit egestas ipsum scelerisque sit amet. Vestibulum leo nunc, commodo ut erat vitae, laoreet congue nunc. Etiam et varius tortor. Sed tempor a eros id euismod. Donec hendrerit nulla et egestas imperdiet. Ut vitae felis ac lectus viverra pharetra. Aliquam a odio posuere lorem congue imperdiet.\r\n\r\nEtiam suscipit sed dolor vel tempor. Phasellus magna arcu, tincidunt id aliquet non, venenatis pulvinar tellus. Sed sollicitudin orci a pulvinar luctus. Duis a tempus arcu. Nunc non commodo turpis, ornare tempor magna. Aliquam sit amet euismod justo. Quisque in mi sollicitudin, pretium dolor eget, ornare lacus. Nunc sapien justo, imperdiet non mi nec, aliquet adipiscing nunc. Aliquam lectus nisl, vestibulum at volutpat quis, convallis ac ante. Morbi id lacus suscipit, hendrerit purus eu, volutpat ligula. Etiam mattis lobortis orci, at adipiscing turpis vulputate in. Vivamus scelerisque ac nunc vulputate convallis.\r\n\r\nCras sollicitudin tortor enim, at pretium nibh pharetra nec. Aenean tellus diam, interdum quis nunc eget, blandit euismod odio. Sed dignissim gravida neque, at ultrices massa gravida vitae. Donec in sem a nunc elementum facilisis eget eget nunc. Integer nisi erat, viverra a tincidunt a, lobortis vel nisl. Vestibulum est lectus, volutpat in ornare nec, varius ac velit. Suspendisse congue consectetur pharetra. Sed neque tellus, dignissim id cursus ut, mollis et justo. Cras fermentum ac est nec condimentum.\r\n\r\nDuis at leo condimentum, varius arcu vitae, vehicula arcu. Duis aliquet elit arcu, sed semper turpis scelerisque sed. Vivamus faucibus et neque at tempor. Fusce at est tempor, congue mi id, facilisis enim. Nam a lorem elementum, ultrices ante ullamcorper, sodales turpis. Nulla ut ligula imperdiet, sagittis tortor at, ultrices lacus. Maecenas in urna tincidunt ligula consectetur imperdiet eget in nisi. Nullam eleifend vestibulum diam et congue. Nulla aliquet nulla non metus condimentum, sed eleifend leo viverra. Integer vel nisl dapibus, auctor lorem non, mattis orci. Maecenas sapien metus, eleifend quis euismod in, feugiat porta nibh. Suspendisse eleifend, ipsum eget cursus consequat, mauris est pharetra tellus, nec tincidunt sem mi et mauris. Ut non diam sed est faucibus mattis eu id elit. Nam fermentum tellus nec leo porta, id sollicitudin eros vehicula.\r\n\r\nNulla bibendum dignissim convallis. Donec vestibulum, ligula quis vulputate tempor, lacus est eleifend est, euismod elementum nisl arcu consectetur risus. Vestibulum sapien eros, blandit eu rutrum sit amet, posuere eu enim. Mauris in egestas enim. Integer molestie metus id erat consequat, ullamcorper sagittis enim euismod. Nunc quis enim pellentesque massa euismod consequat. Maecenas scelerisque lectus ac neque porta, quis facilisis risus faucibus. Proin leo erat, interdum non augue at, semper ornare ipsum. Sed mollis libero tempor nisi eleifend dapibus. In hac habitasse platea dictumst. Suspendisse quis nisi magna.'),
(37, 'proj2', 'Projet 2', 'Project 2', '', '', '', 10, '0222-02-02', '0222-02-02', '', 0, 'http://example.com', 'Nam sodales aliquam turpis, ac posuere lectus placerat in. Integer mollis ultricies ullamcorper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec leo erat. Nulla ligula mauris, facilisis non massa ornare, consectetur euismod urna. Nulla lobortis nisi at tincidunt blandit. Duis vitae luctus tortor. Suspendisse ut lectus fringilla, lobortis nisi sit amet, ultrices arcu. Morbi a aliquet turpis. Donec nulla augue, tincidunt et velit in, molestie tincidunt nibh. Aenean nulla velit, auctor eu odio in, laoreet ullamcorper orci. Ut posuere suscipit nulla, non bibendum enim. Nulla sed tortor id dui blandit ultricies at vitae justo.', 'Nam sodales aliquam turpis, ac posuere lectus placerat in. Integer mollis ultricies ullamcorper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec leo erat. Nulla ligula mauris, facilisis non massa ornare, consectetur euismod urna. Nulla lobortis nisi at tincidunt blandit. Duis vitae luctus tortor. Suspendisse ut lectus fringilla, lobortis nisi sit amet, ultrices arcu. Morbi a aliquet turpis. Donec nulla augue, tincidunt et velit in, molestie tincidunt nibh. Aenean nulla velit, auctor eu odio in, laoreet ullamcorper orci. Ut posuere suscipit nulla, non bibendum enim. Nulla sed tortor id dui blandit ultricies at vitae justo.', 'Nam sodales aliquam turpis, ac posuere lectus placerat in. Integer mollis ultricies ullamcorper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec leo erat. Nulla ligula mauris, facilisis non massa ornare, consectetur euismod urna. Nulla lobortis nisi at tincidunt blandit. Duis vitae luctus tortor. Suspendisse ut lectus fringilla, lobortis nisi sit amet, ultrices arcu. Morbi a aliquet turpis. Donec nulla augue, tincidunt et velit in, molestie tincidunt nibh. Aenean nulla velit, auctor eu odio in, laoreet ullamcorper orci. Ut posuere suscipit nulla, non bibendum enim. Nulla sed tortor id dui blandit ultricies at vitae justo.\r\n\r\nFusce porttitor et justo id viverra. Duis mattis purus dui, quis dapibus ante consequat ut. Vivamus malesuada odio fringilla tellus condimentum viverra. Integer mauris metus, vehicula volutpat viverra vitae, blandit a nulla. Nunc vehicula blandit elit quis dapibus. Pellentesque mattis diam et lacus cursus, quis sodales magna faucibus. Vivamus sollicitudin, augue eget porta semper, felis turpis tincidunt tellus, ac sollicitudin tortor turpis quis magna. Etiam convallis velit et velit consequat, nec ultrices urna tempus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris turpis quam, ultrices nec tristique vitae, venenatis vitae elit.\r\n\r\nNulla facilisi. Suspendisse in eros tortor. Curabitur non faucibus dui. Mauris placerat sed odio eu imperdiet. Morbi viverra venenatis porta. Nam fringilla justo eget bibendum adipiscing. Aenean tincidunt ante dictum elit accumsan, sit amet pretium quam ultricies. In dapibus purus ligula, sit amet interdum metus euismod vel. Suspendisse potenti. Praesent vestibulum viverra mauris vel molestie. Etiam at egestas purus, id adipiscing ante. Aenean dui lacus, vehicula quis consequat a, venenatis quis dolor.\r\n\r\nSed consectetur, arcu sed feugiat commodo, diam lorem ornare dui, eu convallis metus ante quis risus. Suspendisse luctus enim a est dignissim, vitae placerat tellus venenatis. Ut eu neque non tellus consectetur pretium sed consequat erat. Etiam eleifend mi et mi tincidunt, ac pulvinar nisl placerat. Integer rhoncus accumsan erat ultrices consequat. Praesent vel fringilla lectus. Sed sit amet arcu interdum, vehicula quam feugiat, ornare eros.\r\n\r\nSuspendisse vestibulum elementum velit, a porttitor metus suscipit in. Nunc purus urna, facilisis at purus eget, sagittis faucibus erat. Nunc vitae augue vel est mattis ultricies. Suspendisse aliquet sed lectus accumsan congue. Nam tincidunt mi ut odio venenatis adipiscing. Phasellus lacinia orci libero, vel gravida erat auctor ut. In porttitor massa nisi, ut adipiscing odio consectetur sed. Pellentesque nec eros eros. Vestibulum ligula libero, fermentum nec nisl auctor, congue fermentum purus.', 'Nam sodales aliquam turpis, ac posuere lectus placerat in. Integer mollis ultricies ullamcorper. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec leo erat. Nulla ligula mauris, facilisis non massa ornare, consectetur euismod urna. Nulla lobortis nisi at tincidunt blandit. Duis vitae luctus tortor. Suspendisse ut lectus fringilla, lobortis nisi sit amet, ultrices arcu. Morbi a aliquet turpis. Donec nulla augue, tincidunt et velit in, molestie tincidunt nibh. Aenean nulla velit, auctor eu odio in, laoreet ullamcorper orci. Ut posuere suscipit nulla, non bibendum enim. Nulla sed tortor id dui blandit ultricies at vitae justo.\r\n\r\nFusce porttitor et justo id viverra. Duis mattis purus dui, quis dapibus ante consequat ut. Vivamus malesuada odio fringilla tellus condimentum viverra. Integer mauris metus, vehicula volutpat viverra vitae, blandit a nulla. Nunc vehicula blandit elit quis dapibus. Pellentesque mattis diam et lacus cursus, quis sodales magna faucibus. Vivamus sollicitudin, augue eget porta semper, felis turpis tincidunt tellus, ac sollicitudin tortor turpis quis magna. Etiam convallis velit et velit consequat, nec ultrices urna tempus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris turpis quam, ultrices nec tristique vitae, venenatis vitae elit.\r\n\r\nNulla facilisi. Suspendisse in eros tortor. Curabitur non faucibus dui. Mauris placerat sed odio eu imperdiet. Morbi viverra venenatis porta. Nam fringilla justo eget bibendum adipiscing. Aenean tincidunt ante dictum elit accumsan, sit amet pretium quam ultricies. In dapibus purus ligula, sit amet interdum metus euismod vel. Suspendisse potenti. Praesent vestibulum viverra mauris vel molestie. Etiam at egestas purus, id adipiscing ante. Aenean dui lacus, vehicula quis consequat a, venenatis quis dolor.\r\n\r\nSed consectetur, arcu sed feugiat commodo, diam lorem ornare dui, eu convallis metus ante quis risus. Suspendisse luctus enim a est dignissim, vitae placerat tellus venenatis. Ut eu neque non tellus consectetur pretium sed consequat erat. Etiam eleifend mi et mi tincidunt, ac pulvinar nisl placerat. Integer rhoncus accumsan erat ultrices consequat. Praesent vel fringilla lectus. Sed sit amet arcu interdum, vehicula quam feugiat, ornare eros.\r\n\r\nSuspendisse vestibulum elementum velit, a porttitor metus suscipit in. Nunc purus urna, facilisis at purus eget, sagittis faucibus erat. Nunc vitae augue vel est mattis ultricies. Suspendisse aliquet sed lectus accumsan congue. Nam tincidunt mi ut odio venenatis adipiscing. Phasellus lacinia orci libero, vel gravida erat auctor ut. In porttitor massa nisi, ut adipiscing odio consectetur sed. Pellentesque nec eros eros. Vestibulum ligula libero, fermentum nec nisl auctor, congue fermentum purus.');

CREATE TABLE IF NOT EXISTS `project-file` (
  `project-file_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `project-file_id-project` smallint(6) NOT NULL,
  `project-file_id-file` smallint(6) NOT NULL,
  PRIMARY KEY (`project-file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

CREATE TABLE IF NOT EXISTS `project-image` (
  `project-image_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `project-image_id-project` smallint(6) NOT NULL,
  `project-image_id-image` smallint(6) NOT NULL,
  PRIMARY KEY (`project-image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

CREATE TABLE IF NOT EXISTS `typep` (
  `typep_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `typep_id-unix` varchar(32) NOT NULL,
  `typep_name_fr` text NOT NULL,
  `typep_name_en` text NOT NULL,
  `typep_description_fr` text NOT NULL,
  `typep_description_en` text NOT NULL,
  PRIMARY KEY (`typep_id`),
  UNIQUE KEY `projet-type_id-unix` (`typep_id-unix`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

INSERT INTO `typep` (`typep_id`, `typep_id-unix`, `typep_name_fr`, `typep_name_en`, `typep_description_fr`, `typep_description_en`) VALUES
(10, 'section1', 'Section 1.', 'Section 1', 'Intro section 1.', 'Section 1 intro.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
