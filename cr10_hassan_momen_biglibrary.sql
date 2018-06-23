-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2018 at 10:08 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr10_hassan_momen_biglibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `name`, `surname`) VALUES
(1, 'liz', 'pichon'),
(2, 'Augusto ', 'Cury'),
(3, 'Robert', 'Ardrey'),
(4, 'Rihito', 'Takarai'),
(5, 'Neil', 'Gaiman'),
(6, 'Michael', 'Reaves'),
(7, 'Grace', 'Dent'),
(8, 'Mary', 'Casanova'),
(9, 'Evelyn', 'Coleman'),
(10, 'Valerie', 'Tripp');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `ISBN_code` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `fk_author` int(11) DEFAULT NULL,
  `fk_publisher` int(11) DEFAULT NULL,
  `short_description` varchar(150) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `type` enum('book','cd','dvd') DEFAULT NULL,
  `status` enum('available','reserved') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`ISBN_code`, `img`, `fk_author`, `fk_publisher`, `short_description`, `publish_date`, `type`, `status`) VALUES
(1001, 'https://img.thriftbooks.com/api/images/l/4ebd4f252a1ffc369d1c4f406b55424f882a9a85.jpg', 1, 1, 'It is a wonderful cultural book consisting of 150 pages', '2018-06-11', 'book', 'available'),
(1002, 'http://www.euam.org/img/good-vampire-romance-books-for-adults.jpg', 2, 2, 'It is a fantastic romantic book consisting of 220 pages', '2018-06-01', 'book', 'reserved'),
(1003, 'https://cdn.images.express.co.uk/img/dynamic/39/590x/secondary/169693.jpg', 3, 3, 'According to the Romance Writers of America, \"Two basic elements comprise every romance novel: a central love story and an emotionally-satisfying and ', '2018-01-13', 'book', 'available'),
(1004, 'https://cdn.shopify.com/s/files/1/1402/3931/products/thatsmyboy.jpg?v=1488685827', 4, 4, 'That\'s My Boy is a 2012 American satirical dark comedy film directed by Sean Anders and stars Adam Sandler', '2018-05-07', 'dvd', 'reserved'),
(1005, 'https://m.media-amazon.com/images/M/MV5BMTk3OTM5Njg5M15BMl5BanBnXkFtZTYwMzA0ODI3._V1_UX182_CR0,0,182,268_AL_.jpg', 5, 5, 'In a nursing home, resident Duke reads a romance story to an old woman who has senile dementia with memory loss. In the late 1930s', '2016-06-05', 'dvd', 'reserved'),
(1006, 'http://www.radiosaw.de/sites/default/files/22-jump-street-poster.jpg', 6, 6, 'Dave Lizewski is an unnoticed high school student and comic book fan with a few friends and who lives alone with his father. His life is not very diff', '2018-03-07', 'dvd', 'available'),
(1007, 'https://upload.wikimedia.org/wikipedia/en/thumb/c/c1/The_Matrix_Poster.jpg/220px-The_Matrix_Poster.jpg', 7, 7, 'The Matrix is a 1999 science fiction action film written and directed by The Wachowskis (credited as The Wachowski Brothers)', '2012-01-03', 'cd', 'available'),
(1008, 'https://musicimage.xboxlive.com/catalog/video.movie.8D6KGWZL5953/image?locale=en-us&mode=scale&purposes=BoxArt&w=180&h=270&q=60', 8, 8, 'The Mask is a 1994 American dark fantasy superhero comedy film directed by Charles Russell, produced by Bob Engelman,', '2015-06-18', 'cd', 'reserved'),
(1009, 'https://www.slantmagazine.com/images/made/assets/dvd/sonofthemask_260_371_90_s_c1.jpg', 9, 9, 'Tim Avery, an aspiring cartoonist, finds himself in a predicament when his dog stumbles upon the mask of Loki. Then after conceiving an infant son \"bo', '2005-02-16', 'cd', 'reserved'),
(1010, 'https://upload.wikimedia.org/wikipedia/en/3/30/Kick-Ass_film_poster.jpg', 10, 10, 'The Vow is a 2012 American romantic drama film directed by Michael Sucsy and written by Abby Kohn, Marc Silverstein, and Jason Katims, inspired by the', '2010-06-18', 'dvd', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publisher_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `size` enum('big','medium','small') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisher_id`, `name`, `address`, `size`) VALUES
(1, 'alroqe', 'bagdad street/88/12,damascus, syira ', 'big'),
(2, 'alkateb', 'hamra strret 150/50, damascus,syira', 'medium'),
(3, 'dar alhaethm', 'bab toma 225/10, damasucus, syria', 'small'),
(4, 'al kanon', 'altala street 20/5 aleppo,syria', 'big'),
(5, 'alkudos', 'martiny 105/22 aleppo,syria', 'medium'),
(6, 'library', 'street neel 25/5 aleppo,syria', 'small'),
(7, 'books', 'hums street 17/6 aleppo,syria', 'big'),
(8, 'kutob', 'altlal street 44/13 homs,syria', 'small'),
(9, 'media book', 'längenfieldgasse 14/22 wien österreich', 'big'),
(10, 'lebro', 'geblergasse 44/13 wien,österreich', 'small');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`) VALUES
(1, 'hassan', 'Momen@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`ISBN_code`),
  ADD KEY `fk_author` (`fk_author`),
  ADD KEY `fk_publisher` (`fk_publisher`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`fk_author`) REFERENCES `authors` (`author_id`),
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`fk_publisher`) REFERENCES `publisher` (`publisher_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
