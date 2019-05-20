-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 20, 2019 at 12:13 PM
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
(1, 2, 1, 'moh! zo schoon!!', '2019-04-25 09:19:23'),
(2, 4, 2, 'no fuck you', '2019-04-29 11:10:29'),
(4, 4, 1, 'david doet dingen', '2019-04-30 08:58:05'),
(5, 4, 1, 'david doet dingen', '2019-04-30 09:00:49'),
(6, 4, 1, 'david doet dingen', '2019-04-30 09:02:08'),
(7, 4, 1, 'david doet dingen', '2019-04-30 09:02:28'),
(8, 4, 1, 'david doet dingen', '2019-04-30 09:07:01'),
(9, 4, 1, 'david doet dingen', '2019-04-30 09:12:02'),
(10, 4, 1, 'i won\'t', '2019-05-02 10:56:03'),
(11, 4, 1, 'i won\'t', '2019-05-02 10:56:03'),
(12, 4, 1, 'David heeft een vreemde mond', '2019-05-02 10:57:00'),
(13, 4, 1, 'David heeft een vreemde mond', '2019-05-02 11:06:55'),
(14, 4, 1, 'to much info', '2019-05-02 11:21:22'),
(18, 4, 1, 'jeeej', '2019-05-09 09:13:24'),
(19, 4, 1, 'dfghj', '2019-05-09 10:01:44'),
(20, 4, 1, 'dfghj', '2019-05-09 10:02:12'),
(21, 4, 1, 'dfghj', '2019-05-09 10:03:16'),
(22, 4, 1, 'fghj', '2019-05-09 10:03:33'),
(34, 4, 2, 'nice shoes', '2019-05-09 13:25:27'),
(35, 4, 2, 'how about these', '2019-05-09 13:26:08'),
(36, 4, 2, 'what do you think?', '2019-05-09 13:27:21'),
(37, 4, 2, '??????', '2019-05-09 13:28:14'),
(38, 4, 2, 'it\'s something', '2019-05-09 13:40:05'),
(39, 4, 2, 'let\'s try again', '2019-05-09 13:41:11'),
(40, 4, 2, '6', '2019-05-09 13:43:13'),
(54, 4, 63, 'how about this?', '2019-05-14 13:37:49'),
(55, 4, 63, 'this will', '2019-05-14 13:39:01'),
(56, 4, 63, 'this will', '2019-05-14 13:39:04'),
(57, 4, 63, 'qwertyuiop', '2019-05-14 13:40:03'),
(58, 4, 63, '1234567890', '2019-05-14 13:40:26'),
(59, 4, 63, '1234567890', '2019-05-14 13:40:29'),
(60, 4, 63, 'great', '2019-05-14 13:40:38'),
(61, 4, 61, '8765432', '2019-05-14 20:30:43'),
(62, 4, 61, 'snek', '2019-05-14 20:32:57'),
(63, 4, 54, 'please', '2019-05-14 20:34:29'),
(64, 4, 54, 'please', '2019-05-14 20:34:30'),
(65, 4, 54, 'now', '2019-05-14 20:35:02'),
(66, 4, 54, 'now', '2019-05-14 20:36:25'),
(70, 4, 2, '1234567890', '2019-05-16 08:25:48'),
(73, 4, 62, 'sd', '2019-05-16 09:23:54'),
(74, 4, 62, 'qwertyu', '2019-05-16 09:27:43'),
(75, 4, 62, '123456789', '2019-05-16 09:31:25'),
(76, 4, 62, '98765432', '2019-05-16 09:33:27'),
(77, 4, 62, 'qazwsx', '2019-05-16 09:36:33'),
(78, 4, 62, 'edcrfv', '2019-05-16 09:38:16'),
(79, 4, 62, '4rfv5tgb', '2019-05-16 09:38:54'),
(80, 4, 62, 'pl,okm', '2019-05-16 09:42:29'),
(81, 4, 62, 'please', '2019-05-16 09:43:55'),
(82, 4, 62, 'this is stupid', '2019-05-16 09:46:24'),
(83, 4, 62, 'now?', '2019-05-16 09:48:38'),
(84, 4, 62, 'something?', '2019-05-16 09:51:57'),
(85, 4, 62, 'group', '2019-05-16 09:53:04'),
(86, 4, 62, 'group', '2019-05-16 09:53:07'),
(87, 4, 62, 'test1bilj', '2019-05-16 09:53:36'),
(88, 4, 63, 'ertyui', '2019-05-16 09:59:51'),
(89, 4, 63, '6yhn', '2019-05-16 10:01:32'),
(90, 4, 2, 'asdfgh', '2019-05-16 10:42:59'),
(91, 4, 2, 'rtyuio', '2019-05-16 10:44:32'),
(92, 4, 2, 'qwer tyuio', '2019-05-16 10:49:03'),
(93, 4, 2, 'qwer tyuio', '2019-05-16 10:49:09'),
(94, 4, 63, 'zxcvbnm', '2019-05-16 10:49:42'),
(95, 4, 2, 'does this work', '2019-05-16 10:58:39'),
(96, 4, 2, 'and this??', '2019-05-16 11:01:43'),
(97, 4, 2, 'well????', '2019-05-16 11:02:25'),
(100, 4, 2, '5', '2019-05-16 11:42:49'),
(101, 7, 65, 'god that\'s so weird', '2019-05-17 21:38:54'),
(102, 7, 65, 'didn\'t i already comment on this?', '2019-05-17 21:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `follow_from` int(11) NOT NULL,
  `follow_to` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `follow_from`, `follow_to`) VALUES
(1, 3, 4),
(2, 5, 10),
(3, 12, 4),
(4, 8, 4),
(5, 16, 10),
(6, 7, 7),
(7, 7, 7),
(8, 7, 7),
(9, 4, 4),
(10, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `inappropriate`
--

CREATE TABLE `inappropriate` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `type`, `date_created`) VALUES
(34, 1, 4, 1, '2019-05-16 20:52:07'),
(35, 2, 4, 0, '2019-05-16 20:58:12'),
(37, 65, 4, 0, '2019-05-16 21:01:29'),
(38, 63, 4, 0, '2019-05-16 23:33:22'),
(39, 66, 4, 0, '2019-05-16 23:34:11'),
(40, 67, 4, 0, '2019-05-16 23:37:29'),
(41, 68, 4, 0, '2019-05-16 23:54:20'),
(42, 62, 4, 0, '2019-05-17 13:20:43'),
(43, 69, 4, 0, '2019-05-17 13:29:45'),
(44, 68, 7, 1, '2019-05-17 21:48:30'),
(45, 67, 7, 1, '2019-05-17 21:48:33'),
(46, 70, 7, 1, '2019-05-17 21:48:34'),
(47, 62, 7, 1, '2019-05-17 21:48:36'),
(48, 71, 7, 1, '2019-05-17 21:48:38');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` decimal(9,6) NOT NULL,
  `lat` decimal(9,6) NOT NULL,
  `hashtag1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashtag2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashtag3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `description`, `image`, `city`, `lng`, `lat`, `hashtag1`, `hashtag2`, `hashtag3`, `date_created`, `type`) VALUES
(1, 3, 'onze David se', 'data/uploads/Screenshot 2019-03-22 at 19.47.22.png', '', '0.000000', '0.000000', '', '', '', '2019-04-18 17:19:32', 0),
(2, 4, 'ghost-boy, idont eat and get no belly aches', 'data/uploads/Screen Shot 2018-07-07 at 23.39.24.png', '', '0.000000', '0.000000', '', '', '', '2019-04-11 16:23:30', 0),
(59, 6, 'David is BACK!!!!!', 'data/uploads/Screenshot 2019-03-22 at 19.47.22.png', '', '0.000000', '0.000000', '', '', '', '2019-04-25 13:53:40', 0),
(61, 6, 'lego\'s are cool', 'data/uploads/Nathan-Sawaya-societeperrier.com_.jpg', '', '0.000000', '0.000000', '', '', '', '2019-05-02 13:57:47', 0),
(62, 6, 'lego\'s are cool', 'data/uploads/Nathan-Sawaya-societeperrier.com_.jpg', '', '0.000000', '0.000000', '', '', '', '2019-05-02 13:58:38', 0),
(63, 6, 'lego\'s are cool', 'data/uploads/Nathan-Sawaya-societeperrier.com_.jpg', '', '0.000000', '0.000000', '', '', '', '2019-05-02 14:00:43', 0),
(65, 4, '&lt;script type=\'text/javascript\'&gt;alert(\'you fucked\');&lt;/script&gt;', 'data/uploads/6C7m.gif', '', '0.000000', '0.000000', '', '', '', '2019-05-16 11:49:42', 0),
(66, 4, 'i just needed another post', 'data/uploads/source.gif', '', '0.000000', '0.000000', '', '', '', '2019-05-16 19:55:08', 0),
(67, 4, 'i just needed another post', 'data/uploads/source.gif', '', '0.000000', '0.000000', '', '', '', '2019-05-16 19:55:21', 0),
(68, 4, 'do many things to play yet nothing at all', 'data/uploads/source1.gif', '', '0.000000', '0.000000', '', '', '', '2019-05-16 23:40:29', 0),
(69, 4, 'IT\'S LINK', 'data/uploads/download.jpeg', '', '0.000000', '0.000000', '', '', '', '2019-05-17 13:28:29', 0),
(70, 4, 'IT\'S LINK', 'data/uploads/download.jpeg', '', '0.000000', '0.000000', '', '', '', '2019-05-17 13:29:48', 0),
(71, 7, 'my weird bird thing', 'data/uploads/IMG_4299.JPG', '', '0.000000', '0.000000', '', '', '', '2019-05-17 21:48:03', 0),
(72, 7, 'mezelf', 'data/uploads/jonas2.jpg', 'Leuven', '4.731252', '50.877933', '#cool', '#mooi', '#', '2019-05-20 10:54:18', 0),
(73, 7, 'kijk deze auto loop op gsm bediening', 'data/uploads/IMG_4733.JPG', '', '0.000000', '0.000000', '', '', '', '2019-05-20 11:33:49', 0),
(74, 7, 'informatie architectuur enzeu', 'data/uploads/IMG_4740.JPG', '', '0.000000', '0.000000', '', '', '', '2019-05-20 11:34:16', 0),
(75, 7, 'kijk hoe mooi!!!', 'data/uploads/IMG_4715.JPG', '', '0.000000', '0.000000', '#vince', '#red', '#weird', '2019-05-20 11:58:07', 0);

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
(4, 'test@email.com', 'test1', 'T1', '$2y$10$FyXDLQE4uhyFR.sY6po6de2XRnWuSyqJdQz5g3un6bwgYStPsTkDq', '', 'http://i.imgur.com/YdhUZdZ.png'),
(5, '1234@emial.com', 'foep', 'floep', '$2y$10$fqaFlrDYuF1iUJPX4utWX.q5azDBUfybvHug5A7TfVWkBICrWzU4G', '', 'https://cdn1.iconfinder.com/data/icons/technology-devices-2/100/Profile-512.png'),
(6, '123456@12.com', 'foep', 'floep', '$2y$10$zmeHrwUmz/8kTNSlfqMituub71nSelh.pXkwEE7U.uqOS7BWzGyK6', '', 'https://cdn3.iconfinder.com/data/icons/avatars-9/145/Avatar_Penguin-512.png'),
(7, 'mvo@email.com', 'Margot', 'VO', '$2y$10$6qxbXgt04V0Jpxw94/0jce/98id8CO.vEaQGwKD4aAmsAIfz1dvoC', 'I am Margot VO, the great destroyer, ruler of the seven sea\'s, conquerer of the Ilse of men, vanquisher of the north, Lord in the land of VO and future master of the universe', 'data/profiel/7-1558342800-jonas.jpg');

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
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inappropriate`
--
ALTER TABLE `inappropriate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inappropriate`
--
ALTER TABLE `inappropriate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inappropriate`
--
ALTER TABLE `inappropriate`
  ADD CONSTRAINT `inappropriate_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `inappropriate_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
