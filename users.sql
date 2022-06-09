-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 09, 2022 at 05:27 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(250) NOT NULL,
  `vkey` varchar(75) NOT NULL,
  `verified` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `phone`, `email`, `password`, `vkey`, `verified`) VALUES
('muneeb', '0332179998', 'muneeb1755@yahoo.com', 'abc123324y34637432', 'e92c99db4296d4c8dded79ebe3932996', 0),
('hassan', '03312179998', 'muneeb1755@yahoo.com', 'abc123', 'c11cce695836bebdbcdc9e64b6f60b06', 0),
('hassan', '03312179998', 'muneeb1755@yahoo.com', 'abc123', 'fd2f1dd901b467cc6f06a41566770683', 0),
('hassan', '03312179998', 'muneeb1755@yahoo.com', 'abc123', '3daacc9dcbd0445f1c4f6a926d477251', 0),
('hassan', '03312179998', 'muneeb1755@yahoo.com', 'abc123', '14d16b9488e849d382b05079bee95e79', 0),
('hassanrehman', '03312179998', 'muneeb1755@yahoo.com', 'abc1234543543', 'd0b7bbfb252003d04cec946eb3229a6b', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
