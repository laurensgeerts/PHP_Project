# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.25)
# Database: InspHunter_Jonas
# Generation Time: 2019-05-18 13:32:15 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `date_created`)
VALUES
	(1,2,1,'moh! zo schoon!!','2019-04-25 09:19:23');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table followers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `followers`;

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `follow_from` int(11) NOT NULL,
  `follow_to` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `followers` WRITE;
/*!40000 ALTER TABLE `followers` DISABLE KEYS */;

INSERT INTO `followers` (`id`, `follow_from`, `follow_to`)
VALUES
	(1,3,4),
	(2,5,10),
	(3,12,4),
	(4,8,4),
	(5,16,10);

/*!40000 ALTER TABLE `followers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id_link` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;

INSERT INTO `posts` (`id`, `user_id`, `description`, `image`, `date_created`)
VALUES
	(1,3,'onze David se','data/uploads/Screenshot 2019-03-22 at 19.47.22.png','2019-04-18 17:19:32'),
	(2,4,'ghost-boy, idont eat and get no belly aches','data/uploads/Screen Shot 2018-07-07 at 23.39.24.png','2019-04-11 16:23:30'),
	(3,4,'kat hangt uit boom','data/uploads/fullsizeoutput_6c2.jpeg','2019-04-20 12:48:08'),
	(6,4,'SAAAAAAAM','data/uploads/47341225_1686258341480766_6832591591186628608_n.jpg','2019-04-20 13:10:49'),
	(50,4,'omg look at this css fail','data/uploads/Screenshot 2018-11-05 at 21.07.39.png','2019-04-25 11:52:56'),
	(51,4,'omg look at this css fail','data/uploads/Screenshot 2018-11-05 at 21.07.39.png','2019-04-25 11:54:46'),
	(52,4,'omg look at this css fail','data/uploads/Screenshot 2018-11-05 at 21.07.39.png','2019-04-25 11:56:21'),
	(53,4,'daph on a pony. poor pony','data/uploads/Screenshot 2019-01-09 at 17.18.27.png','2019-04-25 12:03:10'),
	(54,4,'daph on a pony. poor pony','data/uploads/Screenshot 2019-01-09 at 17.18.27.png','2019-04-25 12:04:49'),
	(55,4,'my barbie dream house','data/uploads/Screen Shot 2018-07-07 at 23.45.59.png','2019-04-25 12:06:15'),
	(58,10,'test','data/uploads/test2.png','2019-01-01 13:00:00'),
	(59,10,'test','data/uploads/test.png','2019-05-05 13:00:00'),
	(60,10,'test','data/uploads/test.png','2019-05-05 13:00:00'),
	(61,10,'test','data/uploads/test.png','2019-05-05 13:00:00'),
	(62,10,'test','data/uploads/test.png','2019-05-05 13:00:00'),
	(83,8,'den andere','data/uploads/56592017_2815739688443814_8623986286723596288_n.jpg','2019-05-09 08:37:13'),
	(84,8,'den andere','data/uploads/56592017_2815739688443814_8623986286723596288_n.jpg','2019-05-09 08:59:09'),
	(85,8,'den andere','data/uploads/56592017_2815739688443814_8623986286723596288_n.jpg','2019-05-09 09:38:15');

/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `bio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `password`, `bio`, `picture`)
VALUES
	(3,'jonasdebruyn1@telenet.be','Jonas','Bruyn','$2y$10$Fpz9IBB3/ASVgRaijE43FOHWKSAHWhGUMSvQrxVTo5jUbj8iOg0yi','hallo ik ben jonas','data/profiel/3-1555259689-photo_jonas.jpg'),
	(4,'test@email.com','test1','T1','$2y$10$FyXDLQE4uhyFR.sY6po6de2XRnWuSyqJdQz5g3un6bwgYStPsTkDq','',''),
	(5,'1234@emial.com','foep','floep','$2y$10$fqaFlrDYuF1iUJPX4utWX.q5azDBUfybvHug5A7TfVWkBICrWzU4G','',''),
	(6,'testboy2','lol','','','',''),
	(7,'testboy2','lol','','','',''),
	(8,'r0627643@student.thomasmore.be','Laurens','Geerts','$2y$10$eE4friCtNPoZ80yTG.2CPeL/8zheE7QjnvGWSr5lz/ywmJDO2v1Cu','',''),
	(9,'testboy2','lol','','','',''),
	(10,'huts@huts.com','huts','huts','$2y$10$GcJlSz5YZwUAgOrsenInV.LcLUoS8bbrz/3FAb.vQEvmlNS0eN1qy','',''),
	(11,'testboy2','lol','','','',''),
	(12,'r0627643@student.thomasmore.be','Laurens','Geerts','$2y$10$uaL/9xPBXP5ngTgf9ZsUuOVYe6Er2R9DfO3gn3n9VYdJecmtQLdbu','',''),
	(13,'testboy2','lol','','','',''),
	(14,'tester@tester.com','Laurens','Geerts','$2y$10$vRRz8RVqmEpEd1UVAFSBEubQV.4alOjg3pP0Bhr56/xImM3ale4nO','',''),
	(15,'testboy2','lol','','','',''),
	(16,'13@13.com','Laurens','Geerts','$2y$10$rHHH5FE0ZDbWR8ExIxO60e.M2fhlFRguAoTMTl0wjHQTrdG2IB95C','','');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
