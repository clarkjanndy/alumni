-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 01:47 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

set global sql_mode = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
START TRANSACTION;
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnus_bio`
--

CREATE TABLE `alumnus_bio` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `batch` year(4) NOT NULL,
  `course_id` int(30) NOT NULL,
  `email` varchar(250) NOT NULL,
  `connected_to` text NOT NULL,
  `avatar` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= Unverified, 1= Verified',
  `date_created` date NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alumnus_bio`
--

INSERT INTO `alumnus_bio` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `batch`, `course_id`, `email`, `connected_to`, `avatar`, `status`, `date_created`) VALUES
(23, 'Christian', 'D', 'Doblas', 'Male', 2019, 8, 'Christian@gmail.com', '', '', 1, '2023-01-16'),
(24, 'Ariel', 'B', 'Rosalada', 'Male', 2022, 8, 'Ariel@gmail.com', '', '1674014580_325089857_750049192725626_2993132277715938116_n.jpg', 1, '2023-01-16'),
(25, 'Jhunfiel', 'B', 'Castro', 'Male', 2022, 8, 'Jhunfiel@gmail.com', '', '', 1, '2023-01-16'),
(26, 'Regie', '.', 'Suello', 'Male', 2020, 8, 'regie@gmail.com', 'Businessman', '1674013860_325646683_714869823319702_5408105530145003306_n.jpg', 1, '2023-01-18'),
(27, 'Janriel', 'V', 'Orjaliza', 'Male', 2022, 6, 'Janriel@gmail.com', 'Giant Moto Pro Corporation', '', 1, '2023-01-18'),
(28, 'Janice', 'T', 'Unabia', 'Female', 2018, 8, 'Janice@gmail.com', 'Giant Moto Pro Corporation', '1674014100_325973685_1879446722407194_4222945229226470716_n.jpg', 1, '2023-01-18'),
(29, 'Junjie', '.', 'Hagnaya', 'Male', 2022, 3, 'junjie@gmail.com', 'Security Guard', '', 1, '2023-01-18'),
(30, 'Leonard', 'B', 'Dagatan', 'Male', 2022, 3, 'Leonard@gmail.com', 'LCP', '', 1, '2023-01-18'),
(33, 'bernard', 'b', 'cellan', 'Male', 2023, 8, 'bernard@gmail.com', '', '', 1, '2023-02-02'),
(34, 'Julito', 'B', 'Aparece', 'Male', 2023, 8, 'julito@gmail.com', '', '', 1, '2023-02-07'),
(62, 'Sherwin', 'V', 'Cabugnason', 'Male', 2023, 8, 'ishe271@gmail.com', '', '', 1, '2023-04-10'),
(63, 'jericho', 'lugo', 'bautista', 'Male', 2023, 8, 'jericho@gmail.com', '', '', 1, '2023-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `audience`
--

CREATE TABLE `audience` (
  `id` int(30) NOT NULL,
  `event` varchar(100) NOT NULL,
  `event_id` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `schedule` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audience`
--

INSERT INTO `audience` (`id`, `event`, `event_id`, `payment_type`, `type`, `amount`, `schedule`, `name`, `email`, `contact`, `address`, `payment_status`, `status`) VALUES
(3, 'Bisag Unsa', '3', 'Free', 'Public Event', '300', '4:00 PM', 'Admin', 'admin@gmail.com', '0909', 'buenavista, bohol', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` int(30) NOT NULL,
  `company` varchar(250) NOT NULL,
  `location` text NOT NULL,
  `job_title` text NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `company`, `location`, `job_title`, `description`, `user_id`, `date_created`) VALUES
(14, 'STANDFAST', 'Pan Arts Compound,P. Remedio St, Banila, Mandauem, Cebu City', 'Encoder', '&quot;QUALIFICATION&quot;&lt;p&gt;- Graduate of Accountancy, Management Accounting or any related course&lt;/p&gt;&lt;p&gt;-&lt;/p&gt;', 9, '2023-04-10 10:12:44'),
(15, 'E-Innovative Solutions Cebu City', '2nd Floor, E-Novative Centre-1 Building, 219-D Jakosalem St. Zapatera, Cebu City', 'Soundboard Specialist Non - Voice Agents', 'Please bring your updated resume.&lt;p&gt;(Landmark: Google Map - The Premier Business Loft)&lt;/p&gt;', 9, '2023-04-12 08:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(30) NOT NULL,
  `course` text NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `about`) VALUES
(1, 'Bachelor of Science in Elementary Educations (BEED)', 'Sample'),
(3, 'Bachelor of Science Criminology (BSCRIM)', ''),
(6, 'Bachelor of Science Hospitality Management (BSHM)', ''),
(7, 'Bachelor of Science in Secondary Education (BSED)', ''),
(8, 'Bachelor of Science in Information Technology (BSIT)', '');

-- --------------------------------------------------------

--
-- Table structure for table `employment_status`
--

CREATE TABLE `employment_status` (
  `id` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `date_started` varchar(100) NOT NULL,
  `sector` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `react_counter` varchar(100) NOT NULL,
  `counter` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employment_status`
--

INSERT INTO `employment_status` (`id`, `company`, `position`, `address`, `date_started`, `sector`, `status`, `react_counter`, `counter`) VALUES
('4', 'ssdas1234', 'Teacher', 'dasd', '2022-10-12', 'Government', 'Part-time', '', 12),
('7', 'palawan', 'Police', '099999999', '2024-01-01', 'NGO', 'Permanent/Regular', '', 13),
('9', 'mlueller', 'palawan', '09999999', '2222-01-13', 'Private', '', '', 14),
('29', 'n/n', 'security guard', 'n/n', '2022-05-24', 'Private', 'Self-Employed', '', 18),
('28', 'GIANT MOTO PRO CORP', 'Loans officer', '', '2019-09-23', 'Private', 'Permanent/Regular', '', 19),
('27', 'GIANT MOTO PRO CORP', 'Credit Investigator', '', '2022-09-16', 'Private', 'Permanent/Regular', '', 20),
('32', 'GIANT MOTO PRO CORP', 'manager', '0999999', '2022-05-06', 'Private', 'Permanent/Regular', '', 21),
('32', 'GIANT MOTO PRO CORP', 'general manager', '099', '2023-06-12', 'Private', 'Permanent/Regular', '', 22),
('37', 'bisu clarin campus', 'teller', '0999999', '2023-09-01', 'Government', '', '', 23),
('39', 'GIANTt MOTO PRO CORP', 'Manager', '0999999999', '2023-01-13', 'Private', '', '', 24),
('62', 'IT COMPANY', 'programmer', '09999', '2023-02-11', 'Private', 'Permanent/Regular', '', 26),
('34', 'it company', 'programmer', '0999', '2023-02-12', 'Government', 'Temporary', '', 27),
('65', 'IT company', 'Teacher 2', 'IT company', '2023-02-01', 'Private', 'Permanent/Regular', '', 28),
('62', 'DEPED', 'Teacher 1', '99999', '0003-02-01', 'Government', 'Permanent/Regular', '', 29),
('66', 'IT company', 'Teacher 2', '11233', '2022-04-04', 'Government', 'Permanent/Regular', '', 30);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(30) NOT NULL,
  `event_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `schedule` datetime NOT NULL,
  `banner` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_id`, `title`, `content`, `schedule`, `banner`, `date_created`) VALUES
(26, 0, 'homecoming reuneun', 'basta kay sample rani', '2023-05-09 10:53:00', '1682823180_Buenavista-Community-College-BCC.jpg', '2023-04-30 10:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `event_commits`
--

CREATE TABLE `event_commits` (
  `id` int(30) NOT NULL,
  `event_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_commits`
--

INSERT INTO `event_commits` (`id`, `event_id`, `user_id`) VALUES
(1, 1, 3),
(2, 2, 1),
(3, 4, 5),
(4, 5, 6),
(5, 7, 9),
(6, 8, 6),
(7, 9, 6),
(8, 8, 13),
(9, 8, 9),
(10, 10, 6),
(11, 11, 74),
(12, 11, 9),
(13, 12, 84),
(14, 13, 9),
(15, 11, 79),
(16, 14, 74),
(17, 15, 9),
(18, 14, 9),
(19, 16, 9),
(20, 16, 74),
(21, 16, 79),
(22, 18, 79),
(23, 19, 9),
(24, 20, 9),
(25, 21, 9),
(26, 22, 108);

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `id` int(30) NOT NULL,
  `topic_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_comments`
--

INSERT INTO `forum_comments` (`id`, `topic_id`, `comment`, `user_id`, `date_created`) VALUES
(1, 3, 'Sample updated Comment', 3, '2020-10-15 15:46:03'),
(3, 3, 'Sample', 1, '2020-10-16 08:48:02'),
(5, 0, '', 1, '2020-10-16 09:49:34'),
(7, 1, 'dsada', 5, '2022-10-14 13:55:52'),
(9, 6, 'eggjku', 6, '2022-11-03 15:38:57'),
(10, 6, 'tyftio;l', 13, '2022-11-03 15:41:58'),
(11, 6, 'sample rani&amp;nbsp;', 9, '2022-12-06 11:17:39'),
(14, 77, 'ddfsdf', 77, '2023-01-19 09:54:10'),
(15, 77, '', 9, '2023-02-04 13:23:26'),
(20, 83, 'srdggf', 83, '2023-02-13 10:01:23'),
(21, 83, 'sample ra&amp;nbsp;', 84, '2023-02-15 14:57:18'),
(22, 83, '', 74, '2023-03-12 10:00:38'),
(23, 83, 'sdfghjk', 79, '2023-03-17 14:35:00'),
(24, 79, 'jhhugyuguyh', 74, '2023-03-24 20:01:58'),
(27, 9, 'comment', 110, '2023-04-13 10:25:25'),
(28, 9, 'sample rani', 110, '2023-04-13 10:35:55'),
(29, 9, 'jfhasgdiuXHDJASMDNASJFKGOHCFWLEFNHILU', 113, '2023-04-27 16:16:08'),
(30, 9, 'CPWEUFCYWOEKICFWGNEJMCHUWYEKFGUYHG', 74, '2023-04-27 16:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`id`, `title`, `description`, `user_id`, `date_created`) VALUES
(25, 'topic', 'hgfhj g', 9, '2023-04-13 10:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(30) NOT NULL,
  `about` text NOT NULL,
  `created` datetime NOT NULL DEFAULT (CURRENT_DATE)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `about`, `created`) VALUES
(11, 'Buenavista Community College\r\nsample ra gfsfjsd hbsdfijdhbjhfdjkhf jdshfj hsdjfhsdjhfdsjkhfjdsbhf sdih', '2023-04-12 18:32:41'),
(12, 'sampleeeeeeeeeeeeeeeeee', '2023-04-27 15:43:07'),
(13, '', '2023-05-26 11:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `counter` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`id`, `position`, `name`, `counter`) VALUES
('1', 'President', 'JOE FAITH DEGAMO', 1),
('2', 'Alumni Vice President', 'JOE FAITH DEGAMO', 2),
('3', 'Alumni Secretary', 'TESSIE VIODOR', 3),
('4', 'Alumni Assistant Secretary', 'LOVELLA   ANORA ', 4),
('5', 'Alumni Treasurer', 'AZENITH INOJOKS', 5),
('6', 'Alumni Assistant Treasurer', 'ANA MAY CENABRE', 6),
('7', 'Alumni Auditor', 'JEWARD TORREGOSA', 7),
('8', 'Alumni Assistant Auditor', 'ELIZABETH TORREGOSA', 8),
('9', 'Alumni PIO', 'JOE FAITH DEGAMO', 9),
('10', 'Alumni PIO', '', 10),
('11', 'Alumni PIO', '', 11),
('12', 'Alumni Muse', '', 12),
('13', 'Alumni Prince Charming', '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `reaction_counter`
--

CREATE TABLE `reaction_counter` (
  `data_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `counter` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reaction_counter`
--

INSERT INTO `reaction_counter` (`data_id`, `count`, `counter`) VALUES
(11, 55, 1),
(12, 98, 3),
(0, 4, 4),
(13, 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'BCC ALUMNI TRACKING SYSTEM', 'alumni@sample.comm', '+69705646960', '1684903080_11_img.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;text-align: center; background: transparent; position: relative; font-size: 12px;&quot;&gt;&lt;span style=&quot;font-size:16px;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;p style=&quot;background: transparent; position: relative; font-size: 16px; text-align: center;&quot;&gt;&lt;span style=&quot;text-align: left; background: transparent; position: relative; font-size: 16px;&quot;&gt;Buenavista Community College tracks its graduates manually and it requires a lot of manual effort to maintain. One of the common problems of having a manual alumnus tracking system is the potential for inaccurate or outdated information. It can be difficult to keep track of accurate and up-to-date information about alumni when using manual system. This can lead to issues with data analytics, as well as difficulties in reaching out to alumni for events or fundraising campaigns. Another one is it is not possible to offer job opportunities to alumni in an efficient and effective ways. This makes&amp;nbsp;it difficult for the school to keep track of accurate and up-to-date information about its alumni, especially on their career interests and job preferences. In addition, the college may also face challenges in organizing events and reunions for its alumni using a manual system. This can include everything&amp;nbsp;from small gatherings to large-scale events, and it can be difficult to keep track of who is interested in attending on the said upcoming events. Finally, a paper-based or manual system may be vulnerable to security breaches, as&amp;nbsp;paper documents can be lost or stolen. This can be a concern, as it may contain&amp;nbsp;sensitive information about its alumni.&amp;nbsp;&lt;/span&gt;&lt;br style=&quot;font-size: 16px;&quot;&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot; style=&quot;font-size: 16px;&quot;&gt;&lt;o:p style=&quot;font-size: 16px;&quot;&gt;&lt;/o:p&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative; font-size: 16px;&quot;&gt;&lt;/p&gt;&lt;p class=&quot;MsoNormal&quot; style=&quot;font-size: 16px;&quot;&gt;Therefore, the researcher would like to develop an Alumni Tracking System in Buenavista Community College to stay connected with their alumni, build a strong network and to keep track of the whereabouts, accomplishments, and contact information of all their former students. Having access to accurate data about one&rsquo;s alumni is essential in creating meaningful connections between the school and its graduates. In conclusion, having an effective alumnus tracking system is essential and it is clear that developing such a system would provide immense value both financially and socially within any educational environment today.&lt;span style=&quot;font-size:16px;text-align: center; background: transparent; position: relative;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;&lt;/span&gt;&lt;p class=&quot;MsoNormal&quot;&gt;&lt;o:p&gt;&lt;/o:p&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `top_jobs`
--

CREATE TABLE `top_jobs` (
  `job_name` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `counter` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `top_jobs`
--

INSERT INTO `top_jobs` (`job_name`, `course`, `counter`) VALUES
('Police', '3', 1),
('Fire Officer', '3', 2),
('Police', '1', 3),
('yuyu', '1', 4),
('teacher', '1', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Alumni officer, 3= alumnus',
  `auto_generated_pass` text NOT NULL,
  `alumnus_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `auto_generated_pass`, `alumnus_id`) VALUES
(9, 'sherwin', 'sherwin', '202cb962ac59075b964b07152d234b70', 1, '', 0),
(69, 'Ariel Rosalada', 'Ariel@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 24),
(70, 'Jhunfiel Castro', 'Jhunfiel@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 25),
(71, 'Regie Suello', 'regie@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 26),
(72, 'Janriel Orjaliza', 'Janriel@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 27),
(73, 'Janice Unabia', 'Janice@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 28),
(74, 'Junjie Hagnaya', 'junjie@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, '', 29),
(75, 'Leonard Dagatan', 'Leonard@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 30),
(78, 'bernard cellan', 'bernard@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 33),
(79, 'Julito Aparece', 'julito@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 34),
(80, 'Kenneth Suarez', 'kenneth@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 35),
(81, 'Christine Marie Historia', 'crislehistoria@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 36),
(84, 'loeulgeyy aupe', 'loeulgeey@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 39),
(107, 'Sherwin Cabugnason', 'ishe271@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '', 62),
(108, 'jericho bautista', 'jericho@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, '', 63),
(115, 'Maam che', 'Maam che', '202cb962ac59075b964b07152d234b70', 1, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audience`
--
ALTER TABLE `audience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_status`
--
ALTER TABLE `employment_status`
  ADD UNIQUE KEY `counter` (`counter`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_commits`
--
ALTER TABLE `event_commits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD UNIQUE KEY `counter` (`counter`);

--
-- Indexes for table `reaction_counter`
--
ALTER TABLE `reaction_counter`
  ADD UNIQUE KEY `counter` (`counter`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_jobs`
--
ALTER TABLE `top_jobs`
  ADD UNIQUE KEY `counter` (`counter`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `employment_status`
--
ALTER TABLE `employment_status`
  MODIFY `counter` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `event_commits`
--
ALTER TABLE `event_commits`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `counter` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reaction_counter`
--
ALTER TABLE `reaction_counter`
  MODIFY `counter` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `top_jobs`
--
ALTER TABLE `top_jobs`
  MODIFY `counter` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
