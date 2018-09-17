-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 17, 2018 lúc 05:11 AM
-- Phiên bản máy phục vụ: 10.1.28-MariaDB
-- Phiên bản PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `booksc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `books`
--

CREATE TABLE `books` (
  `isbn` char(13) NOT NULL,
  `author` char(100) DEFAULT NULL,
  `title` char(100) DEFAULT NULL,
  `catid` int(10) UNSIGNED DEFAULT NULL,
  `price` float(4,2) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `books`
--

INSERT INTO `books` (`isbn`, `author`, `title`, `catid`, `price`, `description`) VALUES
('0672317842', 'Luke Welling and Laura Thomson', 'PHP and MySQL Web Development', 1, 49.99, 'PHP & MySQL Web Development teaches the reader to develop dynamic, secure e-commerce web sites. You will learn to integrate and implement these technologies by following real-world examples and working sample projects.'),
('0672318040', 'Matt Zandstra', 'Sams Teach Yourself PHP4 in 24 Hours', 1, 24.99, 'Consisting of 24 one-hour lessons, Sams Teach Yourself PHP4 in 24 Hours is divided into five sections that guide you through the language from the basics to the advanced functions.'),
('0672319241', 'Sterling Hughes and Andrei Zmi', 'PHP Developer\'s Cookbook', 1, 39.99, 'Provides a complete, solutions-oriented guide to the challenges most often faced by PHP developers\r\nWritten specifically for experienced Web developers, the book offers real-world solutions to real-world needs\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `catname` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `catname`) VALUES
(1, 'Internet'),
(2, 'Self-help'),
(4, 'Gardening'),
(5, 'Fiction');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `customerid` int(10) UNSIGNED NOT NULL,
  `name` char(60) NOT NULL,
  `address` char(80) NOT NULL,
  `city` char(30) NOT NULL,
  `state` char(20) DEFAULT NULL,
  `phonenum` char(20) DEFAULT NULL,
  `country` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`customerid`, `name`, `address`, `city`, `state`, `phonenum`, `country`) VALUES
(6, 'Thai', 'aaaaa', 'aaaaaaaa', 'aaaaaaaaa', '09786885', 'aaaaaaaaa'),
(7, 'Thai', 'ab', 'abc', 'abcd', '09786885', 'abcde'),
(8, 'Thai', 'ab', 'abc', 'abcd', 'dddd', 'abcde');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `orderid` int(10) UNSIGNED NOT NULL,
  `customerid` int(10) UNSIGNED NOT NULL,
  `amount` float(6,2) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` char(10) DEFAULT NULL,
  `ship_name` char(60) NOT NULL,
  `ship_address` char(80) NOT NULL,
  `ship_city` char(30) NOT NULL,
  `ship_state` char(20) DEFAULT NULL,
  `phonenum` char(20) DEFAULT NULL,
  `ship_country` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`orderid`, `customerid`, `amount`, `created`, `order_status`, `ship_name`, `ship_address`, `ship_city`, `ship_state`, `phonenum`, `ship_country`) VALUES
(65, 6, 49.98, '2018-08-03 00:00:00', 'PARTIAL', 'Thai', 'aaaaa', 'aaaaaaaa', 'aaaaaaaaa', '09786885', 'aaaaaaaaa'),
(66, 6, 49.98, '2018-08-03 00:00:00', 'PARTIAL', 'Thai', 'aaaaa', 'aaaaaaaa', 'aaaaaaaaa', '09786885', 'aaaaaaaaa'),
(67, 6, 49.98, '2018-08-03 00:00:00', 'PARTIAL', 'Thai', 'aaaaa', 'aaaaaaaa', 'aaaaaaaaa', '09786885', 'aaaaaaaaa'),
(68, 6, 49.98, '2018-08-03 00:00:00', 'PARTIAL', 'Thai', 'aaaaa', 'aaaaaaaa', 'aaaaaaaaa', '09786885', 'aaaaaaaaa'),
(69, 6, 49.98, '2018-08-03 00:00:00', 'PARTIAL', 'Thai', 'aaaaa', 'aaaaaaaa', 'aaaaaaaaa', '09786885', 'aaaaaaaaa'),
(70, 6, 49.98, '2018-08-03 00:00:00', 'PARTIAL', 'Thai', 'aaaaa', 'aaaaaaaa', 'aaaaaaaaa', '09786885', 'aaaaaaaaa'),
(71, 6, 49.98, '2018-08-03 00:00:00', 'PARTIAL', 'Thai', 'aaaaa', 'aaaaaaaa', 'aaaaaaaaa', '09786885', 'aaaaaaaaa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `orderid` int(10) UNSIGNED NOT NULL,
  `isbn` char(13) NOT NULL,
  `item_price` float(4,2) NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `contact_number` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(512) NOT NULL,
  `access_level` varchar(16) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending,1=confirmed',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='admin and customer users';

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerid`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`orderid`,`isbn`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `customerid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
