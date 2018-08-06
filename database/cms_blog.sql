-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2018 at 05:59 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(5) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'PHP'),
(3, 'Javascript'),
(16, 'JAVA'),
(22, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL DEFAULT '1920-05-20',
  `comment_content` varchar(255) NOT NULL DEFAULT 'NOTHING'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_status`, `comment_date`, `comment_content`) VALUES
(1, 1, 'no one', 'something@something.something', 'approved', '1920-05-20', 'NOTHING'),
(3, 1, 'asd', 'asd@asd.as', 'approved', '2018-08-03', 'asd'),
(5, 2, 'someone', 'asdf@ads.asd', 'approved', '2018-08-03', 'nice car'),
(6, 1, 'someone', 'patrawalamurtaza52@gmail.com', 'approved', '2018-08-03', 'wow Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua'),
(7, 1, 'new', 'new@sad.a', 'unapproved', '2018-08-03', 'asdnjasdkjljka abdskka sd ajksbdka sd a skjdka csmajkb dsk asdc kajd ka sdkj'),
(8, 1, 'new', 'new@sad.a', 'unapproved', '2018-08-03', 'asdnjasdkjljka abdskka sd ajksbdka sd a skjdka csmajkb dsk asdc kajd ka sdkj'),
(9, 1, 'asd', 'patrawalamurtaza52@gmail.com', 'unapproved', '2018-08-03', 'asd'),
(10, 1, 'asd', 'patrawalamurtaza52@gmail.com', 'unapproved', '2018-08-03', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL DEFAULT '0',
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL DEFAULT 'Anonymous',
  `post_date` date NOT NULL DEFAULT '1920-05-28',
  `post_image` varchar(512) NOT NULL DEFAULT 'sample_1.jpg',
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL DEFAULT 'None',
  `post_comment_count` int(11) NOT NULL DEFAULT '0',
  `post_status` varchar(255) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`) VALUES
(1, 1, 'Title 1', 'Anonymouss', '2018-08-03', 'sample_1.jpg', 'Title one content It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy																												', 'tag1,tag2', 4, 'published'),
(2, 1, 'Title 2', 'Anonymous', '2018-08-03', 'sample_2.jpg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancyIt is a long established fact that b sites still in their infancy				', 'tag2', 0, 'published'),
(6, 1, 'sad', 'sadasd', '2018-08-03', 'handwritten-note_wide-941ca37f3638dca912c8b9efda05ee9fefbf3147.jpg', 'asjbdjkk		', 'asd', 4, 'published'),
(7, 1, 'asdasd', 'asd', '2018-08-03', 'sample_2.jpg', 'asdlnasfnilasndl		', 'asda', 4, 'published'),
(8, 1, 'as', 'asdasd', '2018-08-03', 'sample_1.jpg', 'asbdkjbkabdkabsjdbasdbui  sjabldbja s ajshdvh				', 'demo', 4, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL DEFAULT 'default_user.png',
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL,
  `join_date` date NOT NULL DEFAULT '1920-05-20'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`, `user_email`, `user_image`, `user_role`, `randSalt`, `join_date`) VALUES
(3, 'test', '1234', 'Lewis', 'patrawalamurtaza52@gmail.com', 'asd', 'default_user.png', 'subscriber', '', '2018-08-04'),
(9, 'test1', '1234', 'Lewis', 'patrawalamurtaza52@gmail.com', 'asdasd@asdf.asd', 'default_user.png', 'admin', '', '2018-08-04'),
(10, 'admin', 'admin', 'admin', 'admin', 'admin@admin.admin', 'default_user.png', 'admin', '', '2018-08-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
