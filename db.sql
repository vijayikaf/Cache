
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(300) DEFAULT NULL,
  `description` text NOT NULL,
  `link` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `companies` (`id`, `title`, `description`, `link`) VALUES
(1, 'Google', 'desc 1', 'http://google.com'),
(2, 'Facebook', 'desc 2', 'http://facebook.com');