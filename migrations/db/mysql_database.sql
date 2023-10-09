-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Oct 07, 2023 at 10:10 PM
-- Server version: 8.1.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysql_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `user_id` int NOT NULL,
  `film_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`user_id`, `film_id`) VALUES
(1, 1),
(2, 1),
(1, 3),
(2, 4),
(3, 5),
(1, 6),
(2, 7),
(3, 8),
(1, 9),
(2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `film_id` int NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `trailer_path` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `released_year` int NOT NULL,
  `director` varchar(255) NOT NULL,
  `description` text,
  `cast` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`film_id`, `image_path`, `trailer_path`, `title`, `released_year`, `director`, `description`, `cast`, `genre`) VALUES
(1, 'files/img/film1.jpg', 'files/trailer/film1.mp4', 'The Shawshank Redemption', 1994, 'Frank Darabont', 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 'Tim Robbins, Morgan Freeman', 'Drama'),
(2, 'files/img/film2.jpg', 'files/trailer/film2.mp4', 'The Godfather', 1972, 'Francis Ford Coppola', 'An organized crime dynasty\'s aging patriarch transfers control of his clandestine empire to his reluctant son.', 'Marlon Brando, Al Pacino', 'Crime'),
(3, 'files/img/film3.jpg', 'files/trailer/film3.mp4', 'Pulp Fiction', 1994, 'Quentin Tarantino', 'The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.', 'John Travolta, Uma Thurman', 'Crime'),
(4, 'files/img/film4.jpg', 'files/trailer/film4.mp4', 'The Dark Knight', 2008, 'Christopher Nolan', 'When the menace known as the Joker emerges from his mysterious past, he wreaks havoc and chaos on the people of Gotham. The Dark Knight must accept one of the greatest psychological and physical tests of his ability to fight injustice.', 'Christian Bale, Heath Ledger', 'Action'),
(5, 'files/img/film5.jpg', 'files/trailer/film5.mp4', 'Forrest Gump', 1994, 'Robert Zemeckis', 'The presidencies of Kennedy and Johnson, the events of Vietnam, Watergate, and other historical events unfold through the perspective of an Alabama man with an IQ of 75, whose only desire is to be reunited with his childhood sweetheart.', 'Tom Hanks, Robin Wright', 'Drama'),
(6, 'files/img/film6.jpg', 'files/trailer/film6.mp4', 'The Matrix', 1999, 'Lana Wachowski, Lilly Wachowski', 'A computer programmer discovers that reality as he knows it is a simulation created by machines to subjugate humanity.', 'Keanu Reeves, Laurence Fishburne', 'Action'),
(7, 'files/img/film7.jpg', 'files/trailer/film7.mp4', 'Schindler\'s List', 1993, 'Steven Spielberg', 'In German-occupied Poland during World War II, industrialist Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazis.', 'Liam Neeson, Ralph Fiennes', 'Biography'),
(8, 'files/img/film8.jpg', 'files/trailer/film8.mp4', 'Fight Club', 1999, 'David Fincher', 'An insomniac office worker and a devil-may-care soapmaker form an underground fight club that evolves into something much, much more.', 'Brad Pitt, Edward Norton', 'Drama'),
(9, 'files/img/film9.jpg', 'files/trailer/film9.mp4', 'Inception', 2010, 'Christopher Nolan', 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.', 'Leonardo DiCaprio, Joseph Gordon-Levitt', 'Action'),
(10, 'files/img/film10.jpg', 'files/trailer/film10.mp4', 'The Lord of the Rings: The Return of the King', 2003, 'Peter Jackson', 'Gandalf and Aragorn lead the World of Men against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.', 'Elijah Wood, Ian McKellen', 'Adventure');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `user_id` int NOT NULL,
  `film_id` int NOT NULL,
  `rating` int NOT NULL,
  `notes` text,
  `published_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`user_id`, `film_id`, `rating`, `notes`, `published_time`) VALUES
(1, 1, 5, 'A timeless classic!', '2023-09-20 03:00:00'),
(1, 4, 5, 'Heath Ledger was outstanding.', '2023-09-22 08:00:00'),
(1, 8, 4, 'Fight Club will be a cult classic.', '2023-10-07 21:06:57'),
(2, 1, 4, 'One of my favorites.', '2023-09-20 04:30:00'),
(2, 2, 5, 'Absolutely brilliant.', '2023-09-21 02:45:00'),
(2, 4, 4, 'Great storytelling.', '2023-09-22 09:30:00'),
(2, 8, 5, 'Brad Pitt gives stunning performance!', '2023-10-07 21:06:57'),
(3, 3, 4, 'Memorable performances.', '2023-09-21 07:20:00'),
(3, 8, 4, 'Edward Norton kills it.', '2023-10-07 21:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `username`, `password`, `role`) VALUES
(1, 'user1@example.com', 'user1', 'password1', 'user'),
(2, 'user2@example.com', 'user2', 'password2', 'user'),
(3, 'admin@example.com', 'admin', 'adminpassword', 'admin'),
(4, 'user3@mail.com', 'user3', '$2y$10$oM7.QX0tjl6j8EynYb69AuQYZ0q6sS5vEsxEOGgP78S4s88DZGGSa', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`user_id`,`film_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`film_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`user_id`,`film_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `film_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
