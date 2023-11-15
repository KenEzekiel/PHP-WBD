
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: letterpaw
-- ------------------------------------------------------
-- Server version	5.5.5-10.6.12-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `favorite`
--

DROP TABLE IF EXISTS `favorite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorite` (
  `user_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`film_id`),
  KEY `film_id` (`film_id`),
  CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorite`
--

LOCK TABLES `favorite` WRITE;
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
INSERT INTO `favorite` VALUES (1,1),(1,3),(1,6),(1,9),(2,1),(2,4),(2,7),(2,10),(3,5),(3,8);
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film`
--

DROP TABLE IF EXISTS `film`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `film` (
  `film_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) DEFAULT NULL,
  `trailer_path` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `released_year` int(11) NOT NULL,
  `director` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cast` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`film_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film`
--

LOCK TABLES `film` WRITE;
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` VALUES (1,'files/img/film1.jpg','files/trailer/film1.mp4','The Shawshank Redemption',1994,'Frank Darabont','Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.','Tim Robbins, Morgan Freeman','Drama','2023-11-13 19:32:23'),(2,'files/img/film2.jpg','files/trailer/film2.mp4','The Godfather',1972,'Francis Ford Coppola','An organized crime dynasty\'s aging patriarch transfers control of his clandestine empire to his reluctant son.','Marlon Brando, Al Pacino','Crime','2023-11-13 19:32:23'),(3,'files/img/film3.jpg','files/trailer/film3.mp4','Pulp Fiction',1994,'Quentin Tarantino','The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.','John Travolta, Uma Thurman','Crime','2023-11-13 19:32:23'),(4,'files/img/film4.jpg','files/trailer/film4.mp4','The Dark Knight',2008,'Christopher Nolan','When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham. The Dark Knight must accept one of the greatest psychological and physical tests of his ability to fight injustice.','Christian Bale, Heath Ledger','Action','2023-11-13 19:32:23'),(5,'files/img/film5.jpg','files/trailer/film5.mp4','Forrest Gump',1994,'Robert Zemeckis','The presidencies of Kennedy and Johnson, the events of Vietnam, Watergate, and other historical events unfold through the perspective of an Alabama man with an IQ of 75, whose only desire is to be reunited with his childhood sweetheart.','Tom Hanks, Robin Wright','Drama','2023-11-13 19:32:23'),(6,'files/img/film6.jpg','files/trailer/film6.mp4','The Matrix',1999,'Lana Wachowski, Lilly Wachowski','A computer programmer discovers that reality as he knows it is a simulation created by machines to subjugate humanity.','Keanu Reeves, Laurence Fishburne','Action','2023-11-13 19:32:23'),(7,'files/img/film7.jpg','files/trailer/film7.mp4','Schindler\'s List',1993,'Steven Spielberg','In German-occupied Poland during World War II, industrialist Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazis.','Liam Neeson, Ralph Fiennes','Biography','2023-11-13 19:32:23'),(8,'files/img/film8.jpg','files/trailer/film8.mp4','Fight Club',1999,'David Fincher','An insomniac office worker and a devil-may-care soapmaker form an underground fight club that evolves into something much, much more.','Brad Pitt, Edward Norton','Drama','2023-11-13 19:32:23'),(9,'files/img/film9.jpg','files/trailer/film9.mp4','Inception',2010,'Christopher Nolan','A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.','Leonardo DiCaprio, Joseph Gordon-Levitt','Action','2023-11-13 19:32:23'),(10,'files/img/film10.jpg','files/trailer/film10.mp4','The Lord of the Rings: The Return of the King',2003,'Peter Jackson','Gandalf and Aragorn lead the World of Men against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.','Elijah Wood, Ian McKellen','Adventure','2023-11-13 19:32:23');
/*!40000 ALTER TABLE `film` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `user_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `published_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`,`film_id`),
  KEY `film_id` (`film_id`),
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `review_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (1,1,5,'A timeless classic!','2023-09-20 03:00:00'),(1,4,5,'Heath Ledger was outstanding.','2023-09-22 08:00:00'),(2,1,4,'One of my favorites.','2023-09-20 04:30:00'),(2,2,5,'Absolutely brilliant.','2023-09-21 02:45:00'),(2,4,4,'Great storytelling.','2023-09-22 09:30:00'),(3,3,4,'Memorable performances.','2023-09-21 07:20:00');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'user1@example.com','user1','password1','user'),(2,'user2@example.com','user2','password2','user'),(3,'admin@example.com','admin','adminpassword','admin');
insert into user values(4, 'adm@email.com', 'adm', '$2y$10$gRlxyhscKHw7pB0IkgjxZOBVQStt2ZibucW5/RQVpQxuv4de8Bcm.', 'admin');
insert into user values(5, 'user@email.com', 'user', '$2y$10$X8g3G.L0hrdUMbvMrBhXDulbjeYV5XgBTg/CMYzlMpC/jUht9ZYB2', 'user');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-13 19:44:16

