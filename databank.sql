-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 25, 2019 at 12:40 PM
-- Server version: 5.6.38
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `InspHunter_Jonas`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `date_created`) VALUES
(1, 2, 1, 'moh! zo schoon!!', '2019-04-25 09:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `description`, `image`, `date_created`) VALUES
(1, 3, 'onze David se', 'data/uploads/Screenshot 2019-03-22 at 19.47.22.png', '2019-04-18 17:19:32'),
(2, 4, 'ghost-boy, idont eat and get no belly aches', 'data/uploads/Screen Shot 2018-07-07 at 23.39.24.png', '2019-04-11 16:23:30'),
(3, 4, 'kat hangt uit boom', 'data/uploads/fullsizeoutput_6c2.jpeg', '2019-04-20 12:48:08'),
(6, 4, 'SAAAAAAAM', 'data/uploads/47341225_1686258341480766_6832591591186628608_n.jpg', '2019-04-20 13:10:49'),
(50, 4, 'omg look at this css fail', 'data/uploads/Screenshot 2018-11-05 at 21.07.39.png', '2019-04-25 11:52:56'),
(51, 4, 'omg look at this css fail', 'data/uploads/Screenshot 2018-11-05 at 21.07.39.png', '2019-04-25 11:54:46'),
(52, 4, 'omg look at this css fail', 'data/uploads/Screenshot 2018-11-05 at 21.07.39.png', '2019-04-25 11:56:21'),
(53, 4, 'daph on a pony. poor pony', 'data/uploads/Screenshot 2019-01-09 at 17.18.27.png', '2019-04-25 12:03:10'),
(54, 4, 'daph on a pony. poor pony', 'data/uploads/Screenshot 2019-01-09 at 17.18.27.png', '2019-04-25 12:04:49'),
(55, 4, 'my barbie dream house', 'data/uploads/Screen Shot 2018-07-07 at 23.45.59.png', '2019-04-25 12:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `password`, `bio`, `picture`) VALUES
(3, 'jonasdebruyn1@telenet.be', 'Jonas', 'Bruyn', '$2y$10$Fpz9IBB3/ASVgRaijE43FOHWKSAHWhGUMSvQrxVTo5jUbj8iOg0yi', 'hallo ik ben jonas', 'data/profiel/3-1555259689-photo_jonas.jpg'),
(4, 'test@email.com', 'test1', 'T1', '$2y$10$FyXDLQE4uhyFR.sY6po6de2XRnWuSyqJdQz5g3un6bwgYStPsTkDq', '', ''),
(5, '1234@emial.com', 'foep', 'floep', '$2y$10$fqaFlrDYuF1iUJPX4utWX.q5azDBUfybvHug5A7TfVWkBICrWzU4G', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
