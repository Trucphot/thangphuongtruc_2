-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2025 at 02:41 PM
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
-- Database: `project2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_code` varchar(20) DEFAULT NULL,
  `job_description` text DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `offers` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_title`, `job_code`, `job_description`, `responsibilities`, `requirements`, `offers`) VALUES
(25, 'Cybersecurity Specialist', 'CS360', 'Cybersecurity refers to the process of keeping technological systems safe from outside forces. Successful cybersecurity efforts can protect sensitive information and allow organizations and businesses to build trust with their customers. Any organization that uses technology and regularly collects information uses some form of cybersecurity to keep that information safe.', '<ul>\r\n        <li>Analyze cybersecurity specifications and design security features for automotive systems.</li>\r\n        <li>Develop and implement cybersecurity solutions for ECUs.</li>\r\n        <li>Conduct cybersecurity testing, including penetration testing, fuzzing tests, and static code analysis.</li>\r\n        <li>Ensure compliance with ISO/SAE 21434 standards.</li>\r\n        <li>Collaborate with cross-functional teams to integrate and improve cybersecurity measures.</li>\r\n    </ul>', '<ul>\r\n        <li>Bachelor\'s or Master\'s degree in Computer Science, Electrical Engineering, or related field.</li>\r\n        <li>Certification in ISO/SAE 21434.</li>\r\n        <li>Proven experience in automotive cybersecurity development for ECUs.</li>\r\n        <li>Strong knowledge of embedded systems and automotive communication protocols (CAN, LIN, FlexRay, Ethernet).</li>\r\n        <li>Proficiency in C and C++ programming languages.</li>\r\n        <li>Experience with cybersecurity testing methods such as penetration testing, fuzzing tests, and static code analysis.</li>\r\n        <li>Good English communication skills, both written and verbal.</li>\r\n    </ul>', '<ol>\r\n        <li>Salary range: 30,000,000 VNĐ</li>\r\n        <li>Work-life balance benefits with a flexible leave policy and annual health check-ups to support employee well-being.</li>\r\n        <li>Attractive annual summer vacation allowance.</li>\r\n        <li>Sponsored training courses for personal growth and up to 100% coverage for certification costs.</li>\r\n    </ol>'),
(26, 'Data Analyst', 'DA180', 'Data Analysis is the process of collecting, cleaning, and interpreting data to help businesses make informed decisions. Data Analysts turn raw data into actionable insights through reports, dashboards, and visualizations.', '<ul>\r\n        <li>Collect, clean, and validate large datasets from multiple sources.</li>\r\n        <li>Analyze data to identify trends, patterns, and business opportunities.</li>\r\n        <li>Develop and maintain interactive dashboards and reports using BI tools.</li>\r\n        <li>Collaborate with cross-functional teams to support data-driven decision making.</li>\r\n        <li>Provide recommendations for business improvements based on data insights.</li>\r\n    </ul>', '<ul>\r\n        <li>Bachelor\'s degree in Statistics, Mathematics, Computer Science, Economics, or related field.</li>\r\n        <li>Strong analytical skills with proficiency in SQL and data visualization tools (Power BI, Tableau, Excel).</li>\r\n        <li>Experience with programming languages such as Python or R for data analysis.</li>\r\n        <li>Good knowledge of statistical methods and data modeling techniques.</li>\r\n        <li>Strong communication skills to explain complex data in simple terms.</li>\r\n    </ul>', '<ol>\r\n        <li>Salary range: 25,000,000 - 35,000,000 VNĐ</li>\r\n        <li>Opportunities to work with large-scale datasets in diverse industries.</li>\r\n        <li>Flexible working hours and remote work options.</li>\r\n        <li>Annual performance bonus and sponsored training in advanced analytics.</li>\r\n    </ol>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
