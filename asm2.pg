-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 14, 2022 lúc 12:04 PM
-- Phiên bản máy phục vụ: 10.1.29-MariaDB
-- Phiên bản PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `asm2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `catID` varchar(10) NOT NULL,
  `catName` varchar(30) NOT NULL,
  `catDes` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`catID`, `catName`, `catDes`) VALUES
('Ap', 'Airpods', 'Wireless earbuds');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `cusName` varchar(60) NOT NULL,
  `address` varchar(200) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `SSN` varchar(10) DEFAULT NULL,
  `activeCode` varchar(100) DEFAULT NULL,
  `State` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`username`, `password`, `cusName`, `address`, `telephone`, `email`, `SSN`, `activeCode`, `State`) VALUES
('Admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'NK,CT', '0101010101', 'admin@gmail.com', '', '', 1),
('Customer', 'e10adc3949ba59abbe56e057f20f883e', 'Customer', 'CL, DT', '0909090909', 'customer@gmail.com', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `orderID` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `orderDate` datetime NOT NULL,
  `deliveryDate` datetime NOT NULL,
  `deliveryAdress` int(11) NOT NULL,
  `payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `catID` varchar(10) NOT NULL,
  `proID` varchar(10) NOT NULL,
  `proName` varchar(30) NOT NULL,
  `price` bigint(20) NOT NULL,
  `oldPrice` decimal(12,2) NOT NULL,
  `shortDesc` varchar(30) NOT NULL,
  `detailDesc` varchar(200) NOT NULL,
  `proQty` int(3) NOT NULL,
  `proDate` datetime NOT NULL,
  `proImg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`catID`, `proID`, `proName`, `price`, `oldPrice`, `shortDesc`, `detailDesc`, `proQty`, `proDate`, `proImg`) VALUES
('Ap', 'a', 'a', 3, '0.00', 'a', 'a', 3, '2022-05-14 11:49:39', 'iPad.PNG'),
('Ap', 'abc', 'abc', 11, '0.00', 'haha', 'a', 1, '2022-05-14 11:49:17', 'AirpodsMax.PNG'),
('Ap', 'Ap3G', 'Airpods 3G', 30, '0.00', 'Wireless earbuds 3G', 'Wireless earbuds designed by Apple in third generation....', 20, '2022-05-10 16:15:51', 'Airpods3g.PNG'),
('Ap', 'b', 'b', 2, '0.00', 'b', 'b', 3, '2022-05-14 11:49:55', 'Ip13Pro.PNG');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catID`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `username` (`username`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`proID`),
  ADD KEY `cat_id` (`catID`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`catID`) REFERENCES `category` (`catID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
