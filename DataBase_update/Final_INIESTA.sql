-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2020 at 03:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iniesta`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(33, 175, 176, 'Hi debarshi sir', '2020-05-20 03:45:42', 0),
(34, 176, 175, 'hello! ', '2020-05-20 03:56:48', 0),
(35, 175, 176, 'welcome', '2020-05-24 12:51:04', 0),
(36, 176, 175, 'welcome thanks', '2020-05-24 12:53:07', 0),
(37, 175, 176, 'continue', '2020-05-24 12:55:15', 0),
(38, 175, 176, 'good', '2020-05-24 12:55:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `client_job_posting`
--

CREATE TABLE `client_job_posting` (
  `client_id` int(5) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `job_title` varchar(300) NOT NULL,
  `company_name` varchar(300) NOT NULL,
  `job_category` varchar(300) NOT NULL,
  `job_description` text NOT NULL,
  `job_details` varchar(255) NOT NULL,
  `job_expertise_skills` text NOT NULL,
  `job_vacanies` varchar(200) NOT NULL,
  `client_pay_like` varchar(255) NOT NULL,
  `client_req_experience` varchar(255) NOT NULL,
  `client_project_time` varchar(200) NOT NULL,
  `c_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_job_posting`
--

INSERT INTO `client_job_posting` (`client_id`, `client_name`, `date`, `job_title`, `company_name`, `job_category`, `job_description`, `job_details`, `job_expertise_skills`, `job_vacanies`, `client_pay_like`, `client_req_experience`, `client_project_time`, `c_token`) VALUES
(175, 'Debarshi', '2020-05-21 09:31:57', 'Andriod development', 'Mintlime', 'Web & Mobile Development', 'Web development is the work involved in developing a website for the Internet or an intranet. Web development can range from developing a simple single static page of plain text to complex web-based internet applications, ', 'On-going', 'Jquery, PHP/Node.js, AJAX, Mysql, Html5, Bootstarp', 'More', 'Pay-By-Fixed-Price', 'Intermediate', '1 Month Only', '5093718d55301e6255d34ba3c6dc2414a40816c2feb611c4409aa7c5cd7a');

-- --------------------------------------------------------

--
-- Table structure for table `client_profile`
--

CREATE TABLE `client_profile` (
  `client_id` int(4) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_mobile` varchar(255) NOT NULL,
  `client_company` varchar(255) NOT NULL,
  `company_address` text NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `client_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_profile`
--

INSERT INTO `client_profile` (`client_id`, `client_name`, `client_email`, `client_mobile`, `client_company`, `company_address`, `contact_email`, `contact_number`, `client_image`) VALUES
(175, 'Debarshi', 'debo22@gmail.com', '8989898990', 'Mintlime', 'Noida, Delhi-700123', 'debopiku@gmail.com', '8989898998', 'avatar_400x400.png');

-- --------------------------------------------------------

--
-- Table structure for table `eduactiontb`
--

CREATE TABLE `eduactiontb` (
  `profile_id` int(3) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `college_name` varchar(255) NOT NULL,
  `area_study` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eduactiontb`
--

INSERT INTO `eduactiontb` (`profile_id`, `firstname`, `college_name`, `area_study`, `degree`, `from_date`, `to_date`) VALUES
(176, 'Rohit', 'APSN', 'CSE', 'B.Tech', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `employmenttb`
--

CREATE TABLE `employmenttb` (
  `profile_id` int(3) NOT NULL,
  `employ_company` varchar(300) NOT NULL,
  `employ_city` varchar(255) NOT NULL,
  `employ_state` varchar(255) NOT NULL,
  `employ_country` varchar(255) NOT NULL,
  `employ_job_title` varchar(255) NOT NULL,
  `employ_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employmenttb`
--

INSERT INTO `employmenttb` (`profile_id`, `employ_company`, `employ_city`, `employ_state`, `employ_country`, `employ_job_title`, `employ_description`) VALUES
(176, 'INIESTA', 'Kolkata', 'West Bengal', 'India', 'Web Developer', '');

-- --------------------------------------------------------

--
-- Table structure for table `e_leveltb`
--

CREATE TABLE `e_leveltb` (
  `profile_id` int(3) NOT NULL,
  `expertise_level` varchar(255) NOT NULL,
  `user_token_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `e_leveltb`
--

INSERT INTO `e_leveltb` (`profile_id`, `expertise_level`, `user_token_id`) VALUES
(176, 'Begineer', '');

-- --------------------------------------------------------

--
-- Table structure for table `hourlytb`
--

CREATE TABLE `hourlytb` (
  `profile_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `hourly_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hourlytb`
--

INSERT INTO `hourlytb` (`profile_id`, `firstname`, `hourly_rate`) VALUES
(176, 'Rohit', 56);

-- --------------------------------------------------------

--
-- Table structure for table `imagetb`
--

CREATE TABLE `imagetb` (
  `profile_id` int(4) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `user_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `imagetb`
--

INSERT INTO `imagetb` (`profile_id`, `firstname`, `user_image`) VALUES
(176, 'Rohit', '');

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `client_profile` varchar(255) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `invitation` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `invite_date` date NOT NULL,
  `client_status` varchar(255) NOT NULL,
  `user_accepted_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `languagetb`
--

CREATE TABLE `languagetb` (
  `profile_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lang_profiency` varchar(255) NOT NULL,
  `other_lang` varchar(250) NOT NULL,
  `other_lang_prof` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `languagetb`
--

INSERT INTO `languagetb` (`profile_id`, `firstname`, `lang_profiency`, `other_lang`, `other_lang_prof`) VALUES
(176, 'Rohit', 'basic', 'punjabi', '');

-- --------------------------------------------------------

--
-- Table structure for table `locationtb`
--

CREATE TABLE `locationtb` (
  `profile_id` int(4) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `street_address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `locationtb`
--

INSERT INTO `locationtb` (`profile_id`, `firstname`, `street_address`, `city`, `state`, `country`, `pincode`) VALUES
(176, 'Rohit', 'Kolkata', 'Kolkata', 'West Bengal', 'India', '700001');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`, `is_type`) VALUES
(70, 175, '2020-05-19 04:34:04', 'no'),
(71, 176, '2020-05-19 05:45:48', 'no'),
(72, 176, '2020-05-19 06:08:50', 'no'),
(73, 175, '2020-05-19 06:45:04', 'no'),
(74, 176, '2020-05-19 06:51:02', 'no'),
(75, 176, '2020-05-19 06:52:26', 'no'),
(76, 176, '2020-05-19 09:05:53', 'no'),
(77, 176, '2020-05-19 09:13:32', 'no'),
(78, 175, '2020-05-19 09:15:07', 'no'),
(79, 176, '2020-05-19 09:16:21', 'no'),
(80, 175, '2020-05-19 09:17:26', 'no'),
(81, 175, '2020-05-19 12:46:17', 'no'),
(82, 176, '2020-05-19 12:46:54', 'no'),
(83, 175, '2020-05-20 02:56:14', 'no'),
(84, 176, '2020-05-20 03:00:44', 'no'),
(85, 175, '2020-05-20 03:03:10', 'no'),
(86, 176, '2020-05-20 03:07:59', 'no'),
(87, 175, '2020-05-20 03:12:47', 'no'),
(88, 176, '2020-05-20 03:14:32', 'no'),
(89, 175, '2020-05-20 03:20:19', 'no'),
(90, 176, '2020-05-20 03:29:26', 'no'),
(91, 175, '2020-05-20 03:36:31', 'no'),
(92, 175, '2020-05-20 03:39:35', 'no'),
(93, 176, '2020-05-20 03:39:52', 'no'),
(94, 176, '2020-05-20 03:41:22', 'no'),
(95, 175, '2020-05-20 03:42:20', 'no'),
(96, 176, '2020-05-20 03:45:41', 'no'),
(97, 176, '2020-05-20 03:45:58', 'no'),
(98, 175, '2020-05-20 03:56:50', 'no'),
(99, 176, '2020-05-20 03:57:03', 'no'),
(100, 175, '2020-05-20 04:41:02', 'no'),
(101, 176, '2020-05-21 03:12:09', 'no'),
(102, 176, '2020-05-21 03:22:22', 'no'),
(103, 176, '2020-05-21 03:41:15', 'no'),
(104, 175, '2020-05-21 03:41:45', 'no'),
(105, 176, '2020-05-21 03:42:49', 'no'),
(106, 175, '2020-05-21 03:47:09', 'no'),
(107, 175, '2020-05-21 03:49:36', 'no'),
(108, 175, '2020-05-21 03:56:48', 'no'),
(109, 176, '2020-05-21 04:09:25', 'no'),
(110, 175, '2020-05-24 12:07:29', 'no'),
(111, 175, '2020-05-24 12:47:08', 'no'),
(112, 176, '2020-05-24 12:51:03', 'no'),
(113, 175, '2020-05-24 12:51:16', 'no'),
(114, 175, '2020-05-24 12:51:24', 'no'),
(115, 175, '2020-05-24 12:53:10', 'no'),
(116, 176, '2020-05-24 12:55:18', 'no'),
(117, 175, '2020-05-24 12:56:47', 'no'),
(118, 175, '2020-05-24 12:59:10', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `phonetb`
--

CREATE TABLE `phonetb` (
  `profile_id` int(4) NOT NULL,
  `phone_number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `phonetb`
--

INSERT INTO `phonetb` (`profile_id`, `phone_number`) VALUES
(176, '78787878781');

-- --------------------------------------------------------

--
-- Table structure for table `profilee`
--

CREATE TABLE `profilee` (
  `profile_id` int(3) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `expertise` varchar(250) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `user_token_id` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profilee`
--

INSERT INTO `profilee` (`profile_id`, `firstname`, `expertise`, `skills`, `user_token_id`) VALUES
(176, 'Rohit', 'Web & Mobile Development', 'Jquery, Html, Bootstrap, Ajax', 'fc2c494305c2cc7aa3cf0e8fbb4634d3c352a8b2fa422f92b56044dfeb29c9864c991fa5991b1eb02b47b0f0be1d72b43bb2');

-- --------------------------------------------------------

--
-- Table structure for table `regestration`
--

CREATE TABLE `regestration` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL DEFAULT '',
  `Admin_Status` varchar(255) NOT NULL,
  `Approved_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regestration`
--

INSERT INTO `regestration` (`user_id`, `firstname`, `lastname`, `user_email`, `user_role`, `user_password`, `token`, `Admin_Status`, `Approved_date`) VALUES
(174, 'iniesta', 'company', 'iniesta@gmail.com', 'Admin', '$2y$10$iusesomecrazystrings2usKuLzzXJurttuH8KZdwOtIQnga4utKK', '', 'Approved', '2020-05-18'),
(175, 'Debarshi', 'Mondal', 'debo22@gmail.com', 'Client', '$2y$10$iusesomecrazystrings2uY/7wAP2gRfKeIRLk9Pl6YYFHAJh5L6C', '', 'Approved', '2020-05-19'),
(176, 'Rohit', 'kumar', 'rohit2020@gmail.com', 'Freelancer', '$2y$10$iusesomecrazystrings2ubOe.J.jKjGBqpOM7so4S6h.K5YMHhmS', '', 'Approved', '2020-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `titletb`
--

CREATE TABLE `titletb` (
  `profile_id` int(3) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `professional_overview` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `titletb`
--

INSERT INTO `titletb` (`profile_id`, `firstname`, `title`, `professional_overview`) VALUES
(176, 'Rohit', 'Web Developer', 'The main purpose of a professional summary is to give the hiring manager a quick overview of your skills and achievements without having to dive into the rest of your resume. ... It sums up your top skills, experiences, and achievements as they pertain to a job opening.');

-- --------------------------------------------------------

--
-- Table structure for table `users_applied_jobs`
--

CREATE TABLE `users_applied_jobs` (
  `user_profile_id` int(3) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `client_token` varchar(300) NOT NULL,
  `user_token_id` varchar(300) NOT NULL,
  `applied_for` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `apply_date` date NOT NULL,
  `hire_status` varchar(300) NOT NULL,
  `hired_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_applied_jobs`
--

INSERT INTO `users_applied_jobs` (`user_profile_id`, `user_name`, `client_token`, `user_token_id`, `applied_for`, `status`, `apply_date`, `hire_status`, `hired_date`) VALUES
(176, 'Rohit', '5093718d55301e6255d34ba3c6dc2414a40816c2feb611c4409aa7c5cd7a', 'fc2c494305c2cc7aa3cf0e8fbb4634d3c352a8b2fa422f92b56044dfeb29c9864c991fa5991b1eb02b47b0f0be1d72b43bb2', 'Andriod development', 'read', '2020-05-19', 'Hired', '2020-05-19 12:15:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `client_job_posting`
--
ALTER TABLE `client_job_posting`
  ADD KEY `client_id` (`client_id`) USING BTREE;

--
-- Indexes for table `client_profile`
--
ALTER TABLE `client_profile`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `eduactiontb`
--
ALTER TABLE `eduactiontb`
  ADD PRIMARY KEY (`profile_id`) USING BTREE;

--
-- Indexes for table `employmenttb`
--
ALTER TABLE `employmenttb`
  ADD PRIMARY KEY (`profile_id`) USING BTREE;

--
-- Indexes for table `e_leveltb`
--
ALTER TABLE `e_leveltb`
  ADD UNIQUE KEY `Unique` (`profile_id`) USING BTREE;

--
-- Indexes for table `hourlytb`
--
ALTER TABLE `hourlytb`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `imagetb`
--
ALTER TABLE `imagetb`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `languagetb`
--
ALTER TABLE `languagetb`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `locationtb`
--
ALTER TABLE `locationtb`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `phonetb`
--
ALTER TABLE `phonetb`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `profilee`
--
ALTER TABLE `profilee`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `regestration`
--
ALTER TABLE `regestration`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `titletb`
--
ALTER TABLE `titletb`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `users_applied_jobs`
--
ALTER TABLE `users_applied_jobs`
  ADD KEY `user_profile_id` (`user_profile_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `hourlytb`
--
ALTER TABLE `hourlytb`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `regestration`
--
ALTER TABLE `regestration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
