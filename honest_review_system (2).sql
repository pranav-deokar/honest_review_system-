-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2024 at 04:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `honest_review_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `log_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `activity_description` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`log_id`, `teacher_id`, `activity_description`, `timestamp`) VALUES
(1, 1214, 'Viewed feedback for course X', '2024-11-16 14:49:08'),
(2, 1214, 'Viewed Rating Statistics', '2024-11-16 10:38:59'),
(3, 1214, 'Viewed Rating Statistics', '2024-11-16 15:10:20'),
(4, NULL, 'Logged in at 04:14 PM', '2024-11-16 15:14:43'),
(5, NULL, 'Logged in at 04:15 PM', '2024-11-16 15:15:32'),
(6, NULL, 'Logged in at 04:16 PM', '2024-11-16 15:16:20'),
(7, NULL, 'Logged in at 04:16 PM', '2024-11-16 15:16:21'),
(8, NULL, 'Logged in at 04:16 PM', '2024-11-16 15:16:21'),
(9, NULL, 'Logged in at 04:16 PM', '2024-11-16 15:16:21'),
(10, NULL, 'Logged in at 04:16 PM', '2024-11-16 15:16:57'),
(11, 1214, 'Viewed feedback for course X', '2024-11-16 15:17:29'),
(12, NULL, 'Logged in at 04:30 PM', '2024-11-16 15:30:35'),
(13, NULL, 'Logged in at 09:16 AM', '2024-11-17 08:16:32'),
(14, 0, 'Logged in at 09:16 AM', '2024-11-17 08:16:39'),
(15, 1214, 'Viewed latest feedbacks', '2024-11-17 08:16:56'),
(16, 1214, 'Viewed Rating Statistics', '2024-11-17 08:17:20'),
(17, 1214, 'Viewed Rating Statistics', '2024-11-17 08:17:43'),
(18, 1214, 'Viewed Rating Statistics', '2024-11-17 08:17:44'),
(19, 1214, 'Viewed Rating Statistics', '2024-11-17 08:17:44'),
(20, 1214, 'Viewed Rating Statistics', '2024-11-17 08:17:44'),
(21, 1214, 'Viewed Rating Statistics', '2024-11-17 08:17:44'),
(22, 1214, 'Viewed Rating Statistics', '2024-11-17 08:18:04'),
(23, 1214, 'Viewed Rating Statistics', '2024-11-17 08:18:09'),
(24, 1214, 'Viewed Rating Statistics', '2024-11-17 08:18:09'),
(25, 1214, 'Viewed Rating Statistics', '2024-11-17 08:18:13'),
(26, 1214, 'Viewed Rating Statistics', '2024-11-17 08:19:51'),
(27, 1214, 'Viewed Rating Statistics', '2024-11-17 08:21:47'),
(28, 1214, 'Viewed Rating Statistics', '2024-11-17 08:22:59'),
(29, 1214, 'Viewed Rating Statistics', '2024-11-17 08:24:04'),
(30, 1214, 'Viewed Rating Statistics', '2024-11-17 08:24:05'),
(31, 1214, 'Viewed Rating Statistics', '2024-11-17 08:24:05'),
(32, 1214, 'Viewed Rating Statistics', '2024-11-17 08:24:05'),
(33, 1214, 'Viewed Rating Statistics', '2024-11-17 08:24:06'),
(34, 1214, 'Viewed Rating Statistics', '2024-11-17 08:24:06'),
(35, 1214, 'Viewed Rating Statistics', '2024-11-17 08:24:06'),
(36, 1214, 'Viewed Rating Statistics', '2024-11-17 08:25:55'),
(37, 1214, 'Viewed Rating Statistics', '2024-11-17 08:26:12'),
(38, 1214, 'Viewed Rating Statistics', '2024-11-17 08:26:26'),
(39, 1214, 'Viewed Rating Statistics', '2024-11-17 08:26:26'),
(40, 1214, 'Viewed Rating Statistics', '2024-11-17 08:26:26'),
(41, 1214, 'Viewed Rating Statistics', '2024-11-17 08:26:26'),
(42, 1214, 'Viewed Rating Statistics', '2024-11-17 08:28:16'),
(43, 1214, 'Viewed Rating Statistics', '2024-11-17 08:28:23'),
(44, 1214, 'Viewed Rating Statistics', '2024-11-17 08:28:35'),
(45, 1214, 'Viewed Rating Statistics', '2024-11-17 08:29:32'),
(46, 1214, 'Viewed Rating Statistics', '2024-11-17 08:30:17'),
(47, 1214, 'Viewed Rating Statistics', '2024-11-17 08:30:18'),
(48, 1214, 'Viewed Rating Statistics', '2024-11-17 08:31:15'),
(49, 1214, 'Viewed Rating Statistics', '2024-11-17 08:33:32'),
(50, 1214, 'Viewed Rating Statistics', '2024-11-17 08:36:17'),
(51, 1214, 'Viewed Rating Statistics', '2024-11-17 08:36:18'),
(52, 1214, 'Viewed Rating Statistics', '2024-11-17 08:36:18'),
(53, 1214, 'Viewed Rating Statistics', '2024-11-17 08:36:18'),
(54, NULL, 'Logged in at 12:41 PM', '2024-11-17 11:41:11'),
(55, NULL, 'Logged in at 12:41 PM', '2024-11-17 11:41:11'),
(56, NULL, 'Logged in at 12:41 PM', '2024-11-17 11:41:11'),
(57, NULL, 'Logged in at 12:41 PM', '2024-11-17 11:41:11'),
(58, NULL, 'Logged in at 12:41 PM', '2024-11-17 11:41:11'),
(59, 0, 'Logged in at 12:41 PM', '2024-11-17 11:41:36'),
(60, NULL, 'Logged in at 12:41 PM', '2024-11-17 11:41:49'),
(61, 1214, 'Viewed Rating Statistics', '2024-11-17 11:42:27'),
(62, NULL, 'Logged in at 12:54 PM', '2024-11-17 11:54:55'),
(63, NULL, 'Logged in at 12:59 PM', '2024-11-17 11:59:52'),
(64, NULL, 'Logged in at 03:20 PM', '2024-11-18 14:20:49'),
(65, NULL, 'Logged in at 04:43 PM', '2024-11-18 15:43:53'),
(66, 555, 'Viewed latest feedbacks', '2024-11-18 15:44:13'),
(67, NULL, 'Logged in at 04:48 PM', '2024-11-18 15:48:58'),
(68, 555, 'Viewed latest feedbacks', '2024-11-18 15:49:15'),
(69, 555, 'Viewed latest feedbacks', '2024-11-18 15:49:22'),
(70, 555, 'Viewed latest feedbacks', '2024-11-18 15:50:06'),
(71, NULL, 'Logged in at 04:50 PM', '2024-11-18 15:50:09'),
(72, 0, 'Logged in at 04:50 PM', '2024-11-18 15:50:32'),
(73, 0, 'Logged in at 04:51 PM', '2024-11-18 15:51:03'),
(74, 0, 'Logged in at 04:51 PM', '2024-11-18 15:51:16'),
(75, 0, 'Logged in at 04:51 PM', '2024-11-18 15:51:36'),
(76, 0, 'Logged in at 04:51 PM', '2024-11-18 15:51:43'),
(77, 0, 'Logged in at 04:51 PM', '2024-11-18 15:51:52'),
(78, 8888, 'Viewed latest feedbacks', '2024-11-18 15:52:25'),
(79, 8888, 'Viewed Rating Statistics', '2024-11-18 15:52:37'),
(80, 8888, 'Viewed latest feedbacks', '2024-11-18 15:53:12'),
(81, 8888, 'Viewed Rating Statistics', '2024-11-18 15:53:27'),
(82, NULL, 'Logged in at 04:53 PM', '2024-11-18 15:53:47'),
(83, NULL, 'Logged in at 04:53 PM', '2024-11-18 15:53:47'),
(84, 8888, 'Viewed latest feedbacks', '2024-11-18 15:55:07'),
(85, 8888, 'Viewed latest feedbacks', '2024-11-18 15:55:12'),
(86, NULL, 'Logged in at 03:56 PM', '2024-11-22 14:56:49'),
(87, 1214, 'Viewed latest feedbacks', '2024-11-22 15:01:12'),
(88, 1214, 'Viewed Rating Statistics', '2024-11-22 15:01:35'),
(89, NULL, 'Logged in at 04:01 PM', '2024-11-22 15:01:44'),
(90, 1214, 'Viewed latest feedbacks', '2024-11-22 15:51:54'),
(91, NULL, 'Logged in at 03:39 PM', '2024-12-06 14:39:41'),
(92, 0, 'Logged in at 03:41 PM', '2024-12-06 14:41:51'),
(93, 0, 'Logged in at 03:41 PM', '2024-12-06 14:41:58'),
(94, 0, 'Logged in at 03:42 PM', '2024-12-06 14:42:07'),
(95, 1214, 'Viewed latest feedbacks', '2024-12-06 14:42:56'),
(96, 1214, 'Viewed latest feedbacks', '2024-12-06 14:43:32'),
(97, 1214, 'Viewed Rating Statistics', '2024-12-06 14:43:45'),
(98, NULL, 'Logged in at 03:52 PM', '2024-12-06 14:52:54'),
(99, NULL, 'Logged in at 04:07 PM', '2024-12-06 15:07:12'),
(100, NULL, 'Logged in at 04:38 PM', '2024-12-06 15:38:39'),
(101, NULL, 'Logged in at 05:40 AM', '2024-12-07 04:40:43'),
(102, 0, 'Logged in at 05:40 AM', '2024-12-07 04:40:50'),
(103, 1214, 'Viewed latest feedbacks', '2024-12-07 04:41:24'),
(104, 1214, 'Viewed Rating Statistics', '2024-12-07 04:41:41'),
(105, NULL, 'Logged in at 06:14 AM', '2024-12-07 05:14:21'),
(106, 0, 'Logged in at 06:14 AM', '2024-12-07 05:14:54'),
(107, NULL, 'Logged in at 07:48 AM', '2024-12-07 06:48:41'),
(108, 1214, 'Viewed latest feedbacks', '2024-12-07 08:22:23'),
(109, 1214, 'Viewed latest feedbacks', '2024-12-07 08:22:53'),
(110, 1214, 'Viewed Rating Statistics', '2024-12-07 08:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log_stud`
--

CREATE TABLE `activity_log_stud` (
  `log_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `additional_details` text DEFAULT NULL,
  `activity_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `feedback_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `student_id` int(11) NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `rating` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `teacher_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `teacher_id`, `student_id`, `feedback`, `rating`, `timestamp`, `teacher_name`) VALUES
(3, 121, 5, 'Great lecture, really enjoyed the examples!', 5, '2024-11-11 15:49:52', NULL),
(4, 1214, 5, 'The lecture was informative, but could use more practical examples.', 4, '2024-11-11 15:51:09', NULL),
(5, 1214, 5, 'Great lecture, I really enjoyed the examples and explanations!', 5, '2024-11-11 16:02:34', NULL),
(6, 1214, 5, 'ffvjk vrwrfwrfoi', 3, '2024-11-16 14:14:23', '1214'),
(7, 1214, 5, 'very good sir keep it up full support ', 5, '2024-11-16 14:16:56', '1214'),
(8, 1214, 5, 'very good sir keep it up full support ', 5, '2024-11-16 14:28:06', '1214'),
(9, 1214, 5, 'erjgrgj', 4, '2024-11-16 17:15:10', '1214'),
(10, 1214, 5, 'very  bad', 3, '2024-11-17 08:16:13', '1214'),
(11, 8888, 5, 'bogas sir ahe\r\n', 5, '2024-11-17 11:44:04', '8888'),
(12, 555, 5, 'odmqioed', 3, '2024-11-18 15:45:29', '555'),
(13, 121, 5, 'mast shikavtya sir', 3, '2024-11-18 15:49:59', '121'),
(14, 8888, 5, 'excellent', 3, '2024-11-18 15:55:02', '8888'),
(15, 8888, 5, 'awesome sir', 3, '2024-12-06 14:41:36', '8888'),
(16, 1214, 5, 'awesome sir', 4, '2024-12-06 14:43:27', '1214'),
(17, 1214, 5, 'good teaching', 4, '2024-12-07 04:40:26', '1214'),
(18, 1214, 5, 'awesome teaching ', 4, '2024-12-07 08:21:58', '1214');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `seen` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `teacher_id`, `message`, `seen`, `created_at`) VALUES
(1, 1214, 'You have received new feedback!', 1, '2024-11-16 14:28:06'),
(2, 1214, 'You have received new feedback!', 1, '2024-11-16 17:15:10'),
(3, 1214, 'You have received new feedback!', 1, '2024-11-17 08:16:13'),
(4, 1214, 'You have received new feedback!', 1, '2024-11-17 11:44:04'),
(5, 1214, 'You have received new feedback!', 1, '2024-11-18 15:45:29'),
(6, 1214, 'You have received new feedback!', 1, '2024-11-18 15:49:59'),
(7, 1214, 'You have received new feedback!', 1, '2024-11-18 15:55:02'),
(8, 1214, 'You have received new feedback!', 1, '2024-12-06 14:41:36'),
(9, 1214, 'You have received new feedback!', 1, '2024-12-06 14:43:27'),
(10, 1214, 'You have received new feedback!', 1, '2024-12-07 04:40:26'),
(11, 1214, 'You have received new feedback!', 1, '2024-12-07 08:21:58');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `name`, `email`, `password`, `department`) VALUES
(121, 'ishant ranjan jadhav', '1345@email.address', '$2y$10$Vyt2jpAdw3ggNWkSDP.dTuCTFjUxo5b56AoW0mET/JEJscMn408Yi', 'Computer Science'),
(555, 'Pranav', '12345@email.com', '$2y$10$nv0HxhhAIW6boaLYZHrE1.UPBv8P.jafK.yya4xL53RCg3H4c4p7O', 'Computer Science'),
(1214, 'Yogesh Sonawane', '1234@email.address', '$2y$10$fmgwPkPt083R2kJc2hphdebwWugqPCzqz4c8GCXGTYBOzhQJqDP5C', 'Computer Science'),
(8888, 'DEOKAR PRANAV BALASAHEB', 'pranav@gmail.com', '$2y$10$gISYmDIhLgIO5IXrmG7ytuV4Xnwi0oexx1ndUil0K4IXtjytlvq.K', 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female','other','prefer_not_to_say') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `mobile`, `dob`, `gender`, `password`, `created_at`) VALUES
(5, 'Pranav Deokar', 'pranavdeokar', 'pranavdeokar6@gmail.com', '07058751236', '2024-11-26', 'male', '$2y$10$1kiHNbqhuceNXc/OYIF1ZuzlltXXoa1l2Rza9s5POD.gfD3ebpPgy', '2024-11-08 16:56:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `activity_log_stud`
--
ALTER TABLE `activity_log_stud`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `feedback_id` (`feedback_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `activity_log_stud`
--
ALTER TABLE `activity_log_stud`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8889;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log_stud`
--
ALTER TABLE `activity_log_stud`
  ADD CONSTRAINT `activity_log_stud_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`feedback_id`) REFERENCES `feedback` (`feedback_id`) ON DELETE CASCADE;

--
-- Constraints for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `feedbacks_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
