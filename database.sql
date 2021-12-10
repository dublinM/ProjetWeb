-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Dec 09, 2021 at 11:30 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE DATABASE IF NOT EXISTS `projetweb`;

USE `projetweb`;

CREATE TABLE IF NOT EXISTS `users` (
	`user_id`       INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`user_created`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`user_updated`  DATETIME     NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	`user_name`     VARCHAR(255) NOT NULL,
	`user_email`    VARCHAR(255) NOT NULL,
	`user_password` VARCHAR(255) NOT NULL,
	`user_role`     VARCHAR(20)  NOT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `posts` (
	`post_id`      INT(11)      NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`post_created` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`post_updated` DATETIME     NOT NULL ON UPDATE CURRENT_TIMESTAMP,
	`post_title`   VARCHAR(255) NOT NULL,
	`post_author`  INT(11)      NOT NULL,
	`post_content` TEXT         NOT NULL,
	`post_cover`   VARCHAR(255) NOT NULL
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_created`, `user_updated`, `user_name`, `user_email`, `user_password`, `user_role`) VALUES
(1, '2021-12-07 18:03:59', '2021-12-10 00:29:44', 'admin', 'root@gmail.com', '$2y$10$HqiM1Y2BAtkkLlyzbD6Z7eqQ.MAXbNsXx8cfVaF.9dO/1xByThZjK', 'admin');
COMMIT;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_created`, `post_updated`, `post_title`, `post_author`, `post_content`, `post_cover`) VALUES
(1, '2021-12-10 16:22:32', '0000-00-00 00:00:00', 'Project delivery', 1, 'La dernière ligne droite :)', './public/uploads/F7agfPbijT.jpeg');
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
