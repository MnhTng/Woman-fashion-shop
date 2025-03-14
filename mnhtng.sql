-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 12, 2025 lúc 03:42 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mnhtng`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id` int(2) NOT NULL,
  `src` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id`, `src`) VALUES
(1, 'https://file.hstatic.net/200000182297/file/1__6_.png'),
(2, 'https://file.hstatic.net/200000182297/file/1920x500_1419eff661374b32aa624729627c58ad.jpg'),
(3, 'https://file.hstatic.net/200000182297/file/2__6_.png'),
(4, 'https://file.hstatic.net/200000182297/file/1_copy_4__1__b7b351b0f18f41eea96fd04f20aeda60.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cancel_order`
--

CREATE TABLE `cancel_order` (
  `id` int(10) NOT NULL,
  `user` int(10) NOT NULL,
  `order_code` char(10) NOT NULL,
  `reason` enum('Change your mind','Confusion when ordering','Unable to contact customer','Refuse to receive goods','Unable to pay','Out of stock','System error','Invalid order information','Fraud suspected','Sales Refusal Policy','Unable to deliver','Delivery time too long','Product damage during transportation') NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `cancel_order`
--

INSERT INTO `cancel_order` (`id`, `user`, `order_code`, `reason`, `date`) VALUES
(2, 1, '86EEAE300E', 'Unable to pay', '2025-02-10 18:54:43'),
(3, 1, 'BE0141932A', 'Confusion when ordering', '2025-02-12 00:44:15'),
(4, 1, 'B06E84F15D', 'Change your mind', '2025-02-12 00:44:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `pcode` char(10) NOT NULL,
  `productID` int(11) NOT NULL,
  `productType` varchar(500) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(12) NOT NULL,
  `sale` int(12) DEFAULT NULL,
  `size` varchar(30) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `quantity` int(9) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `checkout` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `pcode`, `productID`, `productType`, `name`, `price`, `sale`, `size`, `image`, `quantity`, `subtotal`, `checkout`) VALUES
(1, 'SM00072', 1, 'Long Sleeve', 'áo sơ mi kẻ', 899000, 499000, 'm', 'https://product.hstatic.net/200000182297/product/8_d85bc088106c46caba010f919eb51c93_master.jpg', 1, 499000, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `type`) VALUES
(1, 'Shirts', 'Short Sleeve, Medium Sleeve, Long Sleeve'),
(2, 'T-shirt', ''),
(3, 'Pants', 'Shorts, Capri Pants, Trousers, Jeans');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `code` char(10) NOT NULL,
  `product` char(10) NOT NULL,
  `size` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` bigint(20) NOT NULL,
  `user` int(10) NOT NULL,
  `order_date` datetime NOT NULL,
  `payment_method` enum('COD','VnPay') NOT NULL,
  `status` enum('Pending','Awaiting Payment','Payment Failed','Paid','Processing','On Hold','Pre-Order','Backordered','Shipped','Out for Delivery','Delivery Attempt Failed','Partially Shipped','Delivered','Completed','Closed','Cancelled','Return Requested','Return in Progress','Returned','Refunded') NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`code`, `product`, `size`, `quantity`, `total`, `user`, `order_date`, `payment_method`, `status`, `delivery_address`, `email`, `tel`, `message`) VALUES
('0E1DC372D8', 'SM00512', 'm', 1, 919000, 1, '2025-02-11 23:07:57', 'VnPay', 'Awaiting Payment', 'sdf', 'domanhtung321@gmail.com', '0777888999', ''),
('0EADCEDEA0', 'Q14512', '2xl', 1, 449000, 1, '2025-02-12 00:42:15', 'VnPay', 'Paid', 'asdasd', 'domanhtung321@gmail.com', '0777888999', 'asdasd'),
('17541B3268', 'SM00103', 'm', 2, 799000, 1, '2025-02-12 00:43:28', 'VnPay', 'Payment Failed', 'zxczxc', 'domanhtung321@gmail.com', '0777888999', 'zxczxvs'),
('23B47BC45E', 'Q16822', 'xl', 2, 898000, 1, '2025-02-12 00:30:29', 'VnPay', 'Paid', 'Xala', 'domanhtung321@gmail.com', '0777888999', 'Mau Luong'),
('28908B8F9F', 'Q67192', 'l', 3, 2577000, 1, '2025-02-12 00:43:28', 'VnPay', 'Payment Failed', 'zxczxc', 'domanhtung321@gmail.com', '0777888999', 'zxczxvs'),
('36F433F3C1', 'Q03472', 'l', 2, 1598000, 1, '2025-02-12 00:42:15', 'VnPay', 'Paid', 'asdasd', 'domanhtung321@gmail.com', '0777888999', 'asdasd'),
('3A6066C176', 'Q67142', 'xl', 3, 1197000, 1, '2025-02-11 10:01:24', 'COD', 'Pending', 'Tay Son - Ha Noi', 'domanhtung321@gmail.com', '0777888999', 'abc'),
('3AC8317C74', 'Q67082', 's', 2, 758000, 1, '2025-02-10 20:22:58', 'COD', 'Pending', 'PTIT', 'domanhtung321@gmail.com', '0777888999', 'Quay tít'),
('3C75CCD4C5', 'SM03242', 'm', 1, 719000, 1, '2025-02-10 18:49:43', 'COD', 'Pending', 'Mỹ Đình', 'domanhtung321@gmail.com', '0777888999', ''),
('40E69BCB8D', 'Q67192', 'm', 2, 1718000, 1, '2025-02-12 00:35:00', 'VnPay', 'Payment Failed', 'hkjrtyh', 'domanhtung321@gmail.com', '0777888999', 'rtert'),
('45A9092CE7', 'TS60042', 'l', 1, 329000, 1, '2025-02-11 10:01:24', 'COD', 'Pending', 'Tay Son - Ha Noi', 'domanhtung321@gmail.com', '0777888999', 'abc'),
('484E88682C', 'SM01872', 'm', 1, 919000, 1, '2025-02-11 11:04:50', 'VnPay', 'Awaiting Payment', 'asdasd', 'domanhtung321@gmail.com', '0777888999', ''),
('51091F075D', 'Q41092', 'm', 4, 1996000, 1, '2025-02-10 20:21:04', 'COD', 'Pending', 'Ha Noi', 'domanhtung321@gmail.com', '0777888999', ''),
('775AA99EAD', 'SM42172', 'xl', 2, 598000, 1, '2025-02-10 18:47:55', 'COD', 'Pending', 'Tân Tiến - An Dương - Hải Phòng', 'domanhtung321@gmail.com', '0777888999', 'Giao hàng nhanh em còn có đồ chơi tết'),
('7B3172D59B', 'TS60072', 'm', 1, 349000, 1, '2025-02-10 23:51:15', 'COD', 'Pending', 'Thanh Xuan', 'domanhtung321@gmail.com', '0777888999', ''),
('86EEAE300E', 'Q02802', 'm', 3, 2397000, 1, '2025-02-10 18:52:40', 'COD', 'Cancelled', 'Ha Noi', 'domanhtung321@gmail.com', '0777888999', 'Đẹp phết'),
('95F996FBB9', 'Q67082', 's', 4, 1516000, 1, '2025-02-12 00:26:59', 'VnPay', 'Paid', 'tung', 'domanhtung321@gmail.com', '0777888999', 'abc'),
('A4F6B61344', 'SM05372', 'm', 1, 819000, 1, '2025-02-12 00:33:50', 'VnPay', 'Payment Failed', 'asd', 'domanhtung321@gmail.com', '0777888999', 'asd'),
('AD975B12E9', 'Q67031', 's', 1, 509000, 1, '2025-02-11 10:57:51', 'VnPay', 'Awaiting Payment', 'Hai Phong city', 'domanhtung321@gmail.com', '0777888999', ''),
('B06E84F15D', 'SM01872', 'm', 1, 919000, 1, '2025-02-11 11:07:51', 'VnPay', 'Cancelled', 'asda', 'domanhtung321@gmail.com', '0777888999', ''),
('B0709B73AF', 'SM16592', 'xl', 1, 819000, 1, '2025-02-10 20:23:35', 'COD', 'Pending', 'Ngọc Trục ', 'domanhtung321@gmail.com', '0777888999', 'PTIT '),
('B221B340DA', 'Q67031', 's', 1, 489000, 1, '2025-02-12 00:30:29', 'VnPay', 'Paid', 'Xala', 'domanhtung321@gmail.com', '0777888999', 'Mau Luong'),
('BAFF629B03', 'TS60042', 'l', 2, 658000, 1, '2025-02-11 10:13:35', 'VnPay', 'Awaiting Payment', 'asd', 'domanhtung321@gmail.com', '0777888999', ''),
('BC4B35CAC3', 'SM16592', '2xl', 2, 1598000, 1, '2025-02-11 11:23:02', 'VnPay', 'Awaiting Payment', 'aaaaa', 'domanhtung321@gmail.com', '0777888999', ''),
('BE0141932A', 'SM05372', 'l', 2, 1598000, 1, '2025-02-12 00:06:28', 'VnPay', 'Cancelled', 'sdfsdff', 'domanhtung321@gmail.com', '0777888999', ''),
('C9FBBAE1C0', 'Q00672', 'm', 1, 259000, 1, '2025-02-11 09:54:33', 'COD', 'Pending', 'asdasd', 'domanhtung321@gmail.com', '0777888999', 'asd'),
('CBEA2A4DFF', 'SM01872', 'm', 1, 919000, 1, '2025-02-11 11:03:48', 'VnPay', 'Awaiting Payment', 'asda', 'domanhtung321@gmail.com', '0777888999', ''),
('D476EC6833', 'SM01872', 'm', 1, 919000, 1, '2025-02-11 11:01:52', 'VnPay', 'Awaiting Payment', 'asd', 'domanhtung321@gmail.com', '0777888999', ''),
('D9905E1A01', 'Q67031', 's', 1, 509000, 1, '2025-02-12 00:40:12', 'VnPay', 'Payment Failed', 'asdads', 'domanhtung321@gmail.com', '0777888999', ''),
('DD353523D9', 'Q02802', 'm', 1, 819000, 1, '2025-02-11 23:30:28', 'VnPay', 'Awaiting Payment', 'asd', 'domanhtung321@gmail.com', '0777888999', ''),
('E41F9761B6', 'Q02432', 'm', 3, 2097000, 1, '2025-02-12 00:33:01', 'VnPay', 'Payment Failed', 'ahsidh', 'domanhtung321@gmail.com', '0777888999', 'sdfyoi'),
('E4390F2313', 'SM05372', 'l', 1, 819000, 1, '2025-02-10 20:22:21', 'COD', 'Pending', 'ABCXYZ', 'domanhtung321@gmail.com', '0777888999', 'Alooooooooo'),
('E8703E22EB', 'Q16822', 'l', 1, 469000, 1, '2025-02-12 00:28:47', 'VnPay', 'Paid', 'asd', 'domanhtung321@gmail.com', '0777888999', 'asd');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `pcode` char(10) NOT NULL,
  `id` int(11) NOT NULL,
  `type` varchar(500) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int(12) NOT NULL,
  `sale` int(12) DEFAULT NULL,
  `intro` varchar(500) NOT NULL,
  `des` text NOT NULL,
  `color` varchar(200) NOT NULL,
  `size` varchar(30) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `thumb` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`pcode`, `id`, `type`, `name`, `price`, `sale`, `intro`, `des`, `color`, `size`, `image`, `thumb`) VALUES
('AK02672', 1, 'Medium Sleeve', 'áo cổ vest dáng suông', 999000, 0, 'áo thiết kế cổ bẻ 2 ve, tay lỡ, tone màu nâu be.', '<p><b>Material</b>: vải tổng hợp cao cấp</p><p><b>Style</b>: áo thiết kế cổ bẻ 2 ve, tay lỡ, tone màu nâu be</p><p><b>Production Company</b>: DMT</p>', '#ece3d3', 's, m, l', 'https://product.hstatic.net/200000182297/product/12_56728c74ceca4500a5bc72fce9a050b1_master.jpg', 'https://product.hstatic.net/200000182297/product/12_56728c74ceca4500a5bc72fce9a050b1_master.jpg, https://product.hstatic.net/200000182297/product/sm026721322412040218p999dt_q159821722212110201p799dt_3__0814d5989a4a453daa917b1b6a299888_master.jpg, https://product.hstatic.net/200000182297/product/sm026721322412040218p999dt_q159821722212110201p799dt_2__9591c510f37b4559a7c9ab4aad0f21cd_master.jpg, https://product.hstatic.net/200000182297/product/sm026721322412040218p999dt_q159821722212110201p799dt_4__6c7d803a8920449eb9d0f8d1f511ced0_master.jpg, https://product.hstatic.net/200000182297/product/sm026721322412040218p999dt_q159821722212110201p799dt_5__4fadc47f60fe4598a6b9667e5bae96c9_master.jpg'),
('Q00672', 3, 'Capri Pants', 'quần baggy trắng', 799000, 239000, 'quần baggy thiết kế tone màu trắng trơn, độ dài trên mắt cá chân.', '<p><b>Material</b>: vải tổng hợp cao cấp</p><p><b>Style</b>: quần baggy thiết kế tone màu trắng trơn, độ dài trên mắt cá chân</p><p><b>Production Company</b>: DMT</p>', '#e6e8ec', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/2_0ddbc63a27a04fbe84363ad1a84b9b11_master.jpg', 'https://product.hstatic.net/200000182297/product/2_0ddbc63a27a04fbe84363ad1a84b9b11_master.jpg, https://product.hstatic.net/200000182297/product/sm197521202312000401p799dt_q006721712322130447p799dt_213d2bc3ca9d4ee982655c0ba6983bd3_master.jpg, https://product.hstatic.net/200000182297/product/sm197521202312000401p799dt_q006721712322130447p799dt_4__08a175dc061546f6b13307fe089890d1_master.jpg, https://product.hstatic.net/200000182297/product/sm197521202312000401p799dt_q006721712322130447p799dt_3__5b482f933ed34e6b9ac098b15e54dda7_master.jpg'),
('Q00682', 3, 'Capri Pants', 'quần lửng xanh', 799000, 239000, 'quần lửng thiết kế cạp cao, ống đứng, tone màu xanh trơn.', '<p><b>Material</b>: vải tổng hợp cao cấp</p><p><b>Style</b>: quần lửng thiết kế cạp cao, ống đứng, tone màu xanh trơn</p><p><b>Production Company</b>: DMT</p>', '#21512a', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/4_373ccede3e4c43c190b346bd2405a4b8_master.jpg', 'https://product.hstatic.net/200000182297/product/4_373ccede3e4c43c190b346bd2405a4b8_master.jpg, https://product.hstatic.net/200000182297/product/sm184721212382400474p799dt_q006821712322160447p799dt_69432f70b3e04f83b7d6678ef5093f38_master.jpg, https://product.hstatic.net/200000182297/product/sm184721212382400474p799dt_q006821712322160447p799dt_2__4628310a70674226bf9c9cbe0db2af81_master.jpg, https://product.hstatic.net/200000182297/product/sm184721212382400474p799dt_q006821712322160447p799dt_1__134ad0b859924adbb62edcbf512dc26c_master.jpg'),
('Q00722', 3, 'Shorts', 'quần short vàng', 699000, 349000, 'quần short thiết kế gập gấu, tone màu vàng trơn.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần short thiết kế gập gấu, tone màu vàng trơn</p><p><b>Production Company</b>: DMT</p>', '#eec978', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/12_d41832836afd40428321991a0805c664_master.jpg', 'https://product.hstatic.net/200000182297/product/12_d41832836afd40428321991a0805c664_master.jpg, https://product.hstatic.net/200000182297/product/sm008021202462400410p799dt_q007221702432050201p699dt_3__fd633e55eb3d4267867912808d67c1c2_master.jpg, https://product.hstatic.net/200000182297/product/sm008021202462400410p799dt_q007221702432050201p699dt_7__8582d736a9cb425dbe8b965385bfa729_master.jpg, https://product.hstatic.net/200000182297/product/sm008021202462400410p799dt_q007221702432050201p699dt_4__546f0ac6900e41bdb9d9aee193220889_master.jpg'),
('Q01232', 3, 'Trousers', 'quần ống đứng', 899000, 0, 'quần dài thiết kế dáng ống đứng, tone màu xanh trơn.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần dài thiết kế dáng ống đứng, tone màu xanh trơn</p><p><b>Production Company</b>: DMT</p>', '#a8bcca', 'm, l, xl', 'https://product.hstatic.net/200000182297/product/11_c097e50a82e34ad787eaa13d323f729f_master.jpg', 'https://product.hstatic.net/200000182297/product/11_c097e50a82e34ad787eaa13d323f729f_master.jpg, https://product.hstatic.net/200000182297/product/ak012421312452160474p899dt_q012321722412160474p899dt_2__c88792fc64364050b85d53df4dd78dd4_master.jpg, https://product.hstatic.net/200000182297/product/ak012421312452160474p899dt_q012321722412160474p899dt_1__97c4b4806da94d83a603dd8385750c86_master.jpg, https://product.hstatic.net/200000182297/product/ak012421312452160474p899dt_q012321722412160474p899dt_81e6ff84ff35432593c45d8cef9eb260_master.jpg, https://product.hstatic.net/200000182297/product/ak012421312452160474p899dt_q012321722412160474p899dt_5__f8fe6e61cf124b4983286ef3ed141ad6_master.jpg'),
('Q01622', 3, 'Shorts', 'quần short cạp cao', 699000, 419000, 'quần short thiết kế gập gấu, tone màu xanh bơ, cạp bản to.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần short thiết kế gập gấu, tone màu xanh bơ, cạp bản to</p><p><b>Production Company</b>: DMT</p>', '#c4d399', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/11_52c1c836087d42318d2a261123d25434_master.jpg', 'https://product.hstatic.net/200000182297/product/11_52c1c836087d42318d2a261123d25434_master.jpg, https://product.hstatic.net/200000182297/product/sm016121212422160274p699dt_q016221702422060274p699dt_2__56381d33abaa4af2b88a8b54b3a74414_master.jpg, https://product.hstatic.net/200000182297/product/sm016121212422160274p699dt_q016221702422060274p699dt_6__7d8c82e79b7f4fb293c6b4bfb4a3918b_master.jpg, https://product.hstatic.net/200000182297/product/sm016121212422160274p699dt_q016221702422060274p699dt_7__f78b4774ddac440e9d5de252fcf674cf_master.jpg'),
('Q02432', 3, 'Shorts', 'quần short vàng', 699000, 0, 'quần short thiết kế dáng ống rộng, tone màu vàng trơn.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần short thiết kế dáng ống rộng, tone màu vàng trơn</p><p><b>Production Company</b>: DMT</p>', '#c5ae4d', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/1_a23d5d2f1b294cdb902eb58b2b342a20_master.jpg', 'https://product.hstatic.net/200000182297/product/1_a23d5d2f1b294cdb902eb58b2b342a20_master.jpg, https://product.hstatic.net/200000182297/product/sm024221212412150201p899dt_q024321702412150201p699dt_7__eb1d8e7117894a7c8a7f5cbb280281ed_master.jpg, https://product.hstatic.net/200000182297/product/sm024221212412150201p899dt_q024321702412150201p699dt_747fd08e0db248869bdaef5d61507eba_master.jpg, https://product.hstatic.net/200000182297/product/sm024221212412150201p899dt_q024321702412150201p699dt_3__4031f2d661ec42dd9fe39f40990ca712_master.jpg, https://product.hstatic.net/200000182297/product/sm024221212412150201p899dt_q024321702412150201p699dt_6__eaa2bf37d1734460bfa80110c031e80d_master.jpg'),
('Q02802', 3, 'Shorts', 'quần short hồng', 799000, 0, 'quần short thiết kế gập gấu, tone màu hồng nhạt.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần short thiết kế gập gấu, tone màu hồng nhạt</p><p><b>Production Company</b>: DMT</p>', '#e8c8ca', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/2_8e39b833d756485c8b71218caf800136_master.jpg', 'https://product.hstatic.net/200000182297/product/2_8e39b833d756485c8b71218caf800136_master.jpg, https://product.hstatic.net/200000182297/product/ts600321902432030462p359d_q028021702412020257p799dt___32__1__b70239e8a3224491b7816eadbcd19557_master.jpg, https://product.hstatic.net/200000182297/product/ts600321902432030462p359d_q028021702412020257p799dt___32__4__635bf58ed7564859ab5a84b8d9e056c7_master.jpg, https://product.hstatic.net/200000182297/product/ts600321902432030462p359d_q028021702412020257p799dt___32__2__fb7cfa49fe14463ab9ffd802feb0e51c_master.jpg, https://product.hstatic.net/200000182297/product/ts600321902432030462p359d_q028021702412020257p799dt___32__3__ca3f5004a410470eadf2409e175262e0_master.jpg'),
('Q03392', 3, 'Shorts', 'quần short kẻ', 699000, 0, 'quần short thiết kế dáng ống rộng, kết hợp họa tiết kẻ.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần short thiết kế dáng ống rộng, kết hợp họa tiết kẻ</p><p><b>Production Company</b>: DMT</p>', '#a97a79, #c4aba1', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/12_92cf2a46943b41f19454b93f74f37078_master.jpg', 'https://product.hstatic.net/200000182297/product/12_92cf2a46943b41f19454b93f74f37078_master.jpg, https://product.hstatic.net/200000182297/product/ak033821312442190257p999dt_z033921702422190257p699dt__3__2b2969d67cc54eefb015a6c524ed248a_master.jpg, https://product.hstatic.net/200000182297/product/ak033821312442190257p999dt_z033921702422190257p699dt__10__8d4f8ca5792c4d0e852a04d92673e98e_master.jpg, https://product.hstatic.net/200000182297/product/ak033821312442190257p999dt_z033921702422190257p699dt__4__c694c3515b124d93bc509961f01790e4_master.jpg, https://product.hstatic.net/200000182297/product/ak033821312442190257p999dt_z033921702422190257p699dt__5__1a808cf1c5ac465b87a26e8a4bf5c5a6_master.jpg'),
('Q03472', 3, 'Shorts', 'quần short ống rộng', 799000, 0, 'quần short thiết kế dáng ống rộng, tone màu trắng kem.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần short thiết kế dáng ống rộng, tone màu trắng kem</p><p><b>Production Company</b>: DMT</p>', '#d8d2ce', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/21_a5940dd737724f77a81ed09a0913289f_master.jpg', 'https://product.hstatic.net/200000182297/product/21_a5940dd737724f77a81ed09a0913289f_master.jpg, https://product.hstatic.net/200000182297/product/ak034621312412130201p1099dt_q034721702412130201p799dt_4__00f78b9ef1c04dcfb8a53b0b1ea63540_master.jpg, https://product.hstatic.net/200000182297/product/ak034621312412130201p1099dt_q034721702412130201p799dt_2__9eb795b2cfe848ef89e79d1996bab8e8_master.jpg, https://product.hstatic.net/200000182297/product/ak034621312412130201p1099dt_q034721702412130201p799dt_3__6af7bff016af47479029aa799514be21_master.jpg'),
('Q04402', 3, 'Trousers', 'quần cullotes xẻ ống', 799000, 0, 'quần thiết kế ống rộng, tone màu đen trơn, xẻ ống.', '<p><b>Material</b>: vải voan pha ren</p><p><b>Style</b>: quần thiết kế ống rộng, tone màu đen trơn, xẻ ống</p><p><b>Production Company</b>: DMT</p>', '#111111', 'm, xl, 2xl', 'https://product.hstatic.net/200000182297/product/11_e1b5fe0388024778bd65756e2c92b9c0_master.jpg', 'https://product.hstatic.net/200000182297/product/11_e1b5fe0388024778bd65756e2c92b9c0_master.jpg, https://product.hstatic.net/200000182297/product/sm041121212432000410p799dt_q044021712422010401p799dt_1__7e3645530e414a7ca17891b4dcb49394_master.jpg, https://product.hstatic.net/200000182297/product/sm041121212432000410p799dt_q044021712422010401p799dt_3__d4b6e726128f4dafb8de11e845021d9f_master.jpg, https://product.hstatic.net/200000182297/product/sm041121212432000410p799dt_q044021712422010401p799dt_2__00585616c65744e2b06797cb8283c7f7_master.jpg, https://product.hstatic.net/200000182297/product/sm041121212432000410p799dt_q044021712422010401p799dt_7__db5b542372b04dd98c205e4532431d62_master.jpg'),
('Q04542', 3, 'Shorts', 'quần short kẻ', 699000, 0, 'quần short thiết kế dáng ống rộng, kết hợp họa tiết kẻ.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần short thiết kế dáng ống rộng, kết hợp họa tiết kẻ</p><p><b>Production Company</b>: DMT</p>', '#eae6e2, #bbb8ad', 'm, l', 'https://product.hstatic.net/200000182297/product/2_8798b609584f4f5e8749b17994635c59_master.jpg', 'https://product.hstatic.net/200000182297/product/2_8798b609584f4f5e8749b17994635c59_master.jpg, https://product.hstatic.net/200000182297/product/ak045321302442190401p99dt_q045421702412190401p699dt_2__341fc7f6faad4a2cb8364cd90b8c4bc0_master.jpg, https://product.hstatic.net/200000182297/product/ak045321302442190401p99dt_q045421702412190401p699dt_5__a51778cf220c4a238d2beea3ad06848f_master.jpg, https://product.hstatic.net/200000182297/product/ak045321302442190401p99dt_q045421702412190401p699dt_9__31c1fa3066c14c56b5fced8c59b5537c_master.jpg, https://product.hstatic.net/200000182297/product/ak045321302442190401p99dt_q045421702412190401p699dt_10__26616838f91247fc8b680b6315bc869a_master.jpg'),
('Q05212', 3, 'Trousers', 'quần ống rộng', 899000, 0, 'quần dài thiết kế dáng ống suông rộng, tone màu xanh đậm.', '<p><b>Material</b>: vải denim</p><p><b>Style</b>: quần dài thiết kế dáng ống suông rộng, tone màu xanh đậm</p><p><b>Production Company</b>: DMT</p>', '#2f3c6b', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/17_9ecefc572b4945b99772fd1c632103d8_master.jpg', 'https://product.hstatic.net/200000182297/product/17_9ecefc572b4945b99772fd1c632103d8_master.jpg, https://product.hstatic.net/200000182297/product/sm007821212442190201p799dt_q052121722442960274p899dt__27__9465fd8d2d794f7fa39047411be5a127_master.jpg, https://product.hstatic.net/200000182297/product/sm007821212442190201p799dt_q052121722442960274p899dt__25__3a64025a23984cf88c18a2ddc104c512_master.jpg, https://product.hstatic.net/200000182297/product/sm007821212442190201p799dt_q052121722442960274p899dt__24__ea2367ba73e540e8a44dffc74c8c8517_master.jpg'),
('Q14512', 3, 'Trousers', 'quần thiết kế', 899000, 449000, 'quần dài thiết kế dáng ống loe, tone màu đen trơn.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần dài thiết kế dáng ống loe, tone màu đen trơn</p><p><b>Production Company</b>: DMT</p>', '#13151b', '2xl', 'https://product.hstatic.net/200000182297/product/7_b3a0203983424184be34c525565ac154_master.jpg', 'https://product.hstatic.net/200000182297/product/7_b3a0203983424184be34c525565ac154_master.jpg, https://product.hstatic.net/200000182297/product/ak145021612451110474p1599dt_q145121722411110474p899dt__6__9a4d7c839ba14df7a33ef1fa7b2b0f8b_master.jpg, https://product.hstatic.net/200000182297/product/ak145021612451110474p1599dt_q145121722411110474p899dt__7__1f23e9d591744eec9738be8b09a50962_master.jpg'),
('Q15932', 3, 'Capri Pants', 'quần ống đứng', 799000, 239000, 'quần thiết kế ống đứng, độ dài trên mắt cá chân, tone màu đỏ trơn, cạp phối đỉa.', '<p><b>Material</b>: vải tổng hợp cao cấp</p><p><b>Style</b>: quần thiết kế ống đứng, độ dài trên mắt cá chân, tone màu đỏ trơn, cạp phối đỉa</p><p><b>Production Company</b>: DMT</p>', '#db0635', 's, m, l, xl, 2xl', 'https://product.hstatic.net/200000182297/product/164_581abb492a584835a04195f997d78524_master.jpg', 'https://product.hstatic.net/200000182297/product/164_581abb492a584835a04195f997d78524_master.jpg, https://product.hstatic.net/200000182297/product/sm044621212282410603p599dt_q159321722212120474p799dt_2__17b100e4da7a4e1685f4f06b0e077bab_master.jpg, https://product.hstatic.net/200000182297/product/sm044621212282410603p599dt_q159321722212120474p799dt_ebc3f29f59dc4740b960ecd2c8b6a741_master.jpg, https://product.hstatic.net/200000182297/product/sm044621212282410603p599dt_q159321722212120474p799dt_1__d032a39b76ca4fe4bf98a72ae72b9bf1_master.jpg'),
('Q16252', 3, 'Trousers', 'quần ống đứng', 899000, 449000, 'quần dài thiết kế dáng ống đứng, tone màu nâu be.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần dài thiết kế dáng ống đứng, tone màu nâu be</p><p><b>Production Company</b>: DMT</p>', '#e5d2bb', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/11_89678a0b662b415ea5311d61c6646a57_master.jpg', 'https://product.hstatic.net/200000182297/product/11_89678a0b662b415ea5311d61c6646a57_master.jpg, https://product.hstatic.net/200000182297/product/ak162421312422140457p1199dt_kem_hoa_q162521722422040257p899dt.jpg_5__1f7f58f028144eab8425ffc45e7a0fe5_master.jpg, https://product.hstatic.net/200000182297/product/ak162421312422140457p1199dt_kem_hoa_q162521722422040257p899dt.jpg_4__e7b106bea6084ed5bed52fe629cf9af5_master.jpg, https://product.hstatic.net/200000182297/product/ak162421312422140457p1199dt_kem_hoa_q162521722422040257p899dt.jpg_3__b399ca1b43134df68122601539dcf527_master.jpg'),
('Q16822', 3, 'Trousers', 'quần ống loe', 899000, 449000, 'quần dài thiết kế dáng ống loe, tone màu xám trơn.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần dài thiết kế dáng ống loe, tone màu xám trơn</p><p><b>Production Company</b>: DMT</p>', '#d6d6d9', 'm, l, xl', 'https://product.hstatic.net/200000182297/product/8_9ffca3bb5c6a4331a4fa1daa3602f982_master.jpg', 'https://product.hstatic.net/200000182297/product/8_9ffca3bb5c6a4331a4fa1daa3602f982_master.jpg, https://product.hstatic.net/200000182297/product/sm007821212442190201p799dt_q052121722442960274p899dt__27__9465fd8d2d794f7fa39047411be5a127_master.jpg, https://product.hstatic.net/200000182297/product/sm007821212442190201p799dt_q052121722442960274p899dt__25__3a64025a23984cf88c18a2ddc104c512_master.jpg, https://product.hstatic.net/200000182297/product/sm007821212442190201p799dt_q052121722442960274p899dt__24__ea2367ba73e540e8a44dffc74c8c8517_master.jpg'),
('Q18482', 3, 'Shorts', 'quần short kẻ', 699000, 489000, 'quần short thiết kế ống rộng, tone màu đen trơn.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần short thiết kế ống rộng, tone màu đen trơn</p><p><b>Production Company</b>: DMT</p>', '#252429', 's, m, xl, 2xl', 'https://product.hstatic.net/200000182297/product/12_71321b62b32944839de2346e3ba8933e_master.jpg', 'https://product.hstatic.net/200000182297/product/12_71321b62b32944839de2346e3ba8933e_master.jpg, https://product.hstatic.net/200000182297/product/ts601621912432830407p399dt_q184821702422910247p699dt__7__6be2f10303484cfbab379bec9c9b25b8_master.jpg, https://product.hstatic.net/200000182297/product/ts601621912432830407p399dt_q184821702422910247p699dt__6__fb6ae9ffe68549a68acd41f880e2cc71_master.jpg, https://product.hstatic.net/200000182297/product/ts601621912432830407p399dt_q184821702422910247p699dt__5__487303e10b914cf184a54ba815039d16_master.jpg, https://product.hstatic.net/200000182297/product/ts601621912432830407p399dt_q184821702422910247p699dt__3__fe5e46173e9b4a67b45e3e9eab12e65d_master.jpg'),
('Q41092', 3, 'Trousers', 'quần ống đứng', 499000, 0, 'quần dài thiết kế dáng ống đứng, tone màu đen trơn.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: quần dài thiết kế dáng ống đứng, tone màu đen trơn</p><p><b>Production Company</b>: DMT</p>', '#0d0e0b', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/4_05d38b5a25bd4bb89e91bdb79db7e450_master.jpg', 'https://product.hstatic.net/200000182297/product/4_05d38b5a25bd4bb89e91bdb79db7e450_master.jpg, https://product.hstatic.net/200000182297/product/sm402121212482450201p499dt_q410921722442110274p499dt__4__cf8b256b3c794c77884dd6d4a1e5eb9d_master.jpg, https://product.hstatic.net/200000182297/product/sm402121212482450201p499dt_q410921722442110274p499dt__2__1e7dedc9be364d21a20b50f62ff0fbf8_master.jpg, https://product.hstatic.net/200000182297/product/sm402121212482450201p499dt_q410921722442110274p499dt__3__ec5a64b690a543ada39aa0ca29376e27_master.jpg, https://product.hstatic.net/200000182297/product/sm402121212482450201p499dt_q410921722442110274p499dt__1__0972eb9d14614b1c85a49b8a32a91191_master.jpg'),
('Q67031', 3, 'Jeans', 'quần jeans ống loe', 699000, 489000, 'quần dài thiết kế cạp cao, dáng baggy, xếp ly phía trước.', '<p><b>Material</b>: vải jeans</p><p><b>Style</b>: quần dài thiết kế cạp cao, dáng baggy, xếp ly phía trước</p><p><b>Production Company</b>: DMT</p>', '#0d1215', 's', 'https://product.hstatic.net/200000182297/product/sm027721212332020474p699ct_q670321732332910291p699dt__2_.jpg_1__6556f47c0e9841fea23972e9743fd3d0_master.jpg', 'https://product.hstatic.net/200000182297/product/sm027721212332020474p699ct_q670321732332910291p699dt__2_.jpg_1__6556f47c0e9841fea23972e9743fd3d0_master.jpg, https://product.hstatic.net/200000182297/product/sm027721212332020474p699ct_q670321732332910291p699dt__2__b334130c5b594ca78d9be615de692b2a_master.jpg, https://product.hstatic.net/200000182297/product/sm027721212332020474p699ct_q670321732332910291p699dt__2_.jpg_c23dcdeca62b45839a47edf315bd1e8a_master.jpg, https://product.hstatic.net/200000182297/product/sm027721212332020474p699ct_q670321732332910291p699dt__2_.jpg_2__7556ee6e368b4df6bc91993d7f5ce93d_master.jpg'),
('Q67032', 3, 'Jeans', 'quần jeans trắng', 699000, 489000, 'quần dài thiết kế dáng ống loe, tone màu trắng trơn.', '<p><b>Material</b>: vải jeans</p><p><b>Style</b>: quần dài thiết kế dáng ống loe, tone màu trắng trơn</p><p><b>Production Company</b>: DMT</p>', '#ebeef3', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/2_6df44ad4fc854aab8c405c2ad7f10bb4_master.jpg', 'https://product.hstatic.net/200000182297/product/2_6df44ad4fc854aab8c405c2ad7f10bb4_master.jpg, https://product.hstatic.net/200000182297/product/sm023421212332060205p799dt_q670321732332930291p699dt_copy_bbbe3f4a2e31487486a45f5a328a72f4_master.jpg, https://product.hstatic.net/200000182297/product/sm023421212332060205p799dt_q670321732332930291p699dt_4__copy_c60d21496e9a4cdbba2898bb28a8845b_master.jpg, https://product.hstatic.net/200000182297/product/sm023421212332060205p799dt_q670321732332930291p699dt_3__copy_35b6ad246b2e4101a5a6cb62729a6bae_master.jpg'),
('Q67042', 3, 'Jeans', 'quần jeans gập gấu', 699000, 0, 'quần jeans thiết kế dáng ống suông, tone màu xanh nhạt.', '<p><b>Material</b>: vải jeans</p><p><b>Style</b>: quần jeans thiết kế dáng ống suông, tone màu xanh nhạt</p><p><b>Production Company</b>: DMT</p>', '#9ab2cb', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/3_29341ae3b8554c0bab27da0cd935bde7_master.jpg', 'https://product.hstatic.net/200000182297/product/3_29341ae3b8554c0bab27da0cd935bde7_master.jpg, https://product.hstatic.net/200000182297/product/sm060521212332150418p699dt_q670421732332900291p699dt_2__e6572ef0e9b34bfba66772a97bed2abc_master.jpg, https://product.hstatic.net/200000182297/product/sm060521212332150418p699dt_q670421732332900291p699dt_4__aca96a33d5984633a01fb459c091cd78_master.jpg, https://product.hstatic.net/200000182297/product/sm060521212332150418p699dt_q670421732332900291p699dt_3__29b2c564a9d642d8aee9837e3048050a_master.jpg'),
('Q67052', 3, 'Jeans', 'quần jeans lật gấu', 759000, 379000, 'quần jeans thiết kế dáng suông, lật gấu, tone màu xanh nhạt.', '<p><b>Material</b>: vải jeans</p><p><b>Style</b>: quần jeans thiết kế dáng suông, lật gấu, tone màu xanh nhạt</p><p><b>Production Company</b>: DMT</p>', '#778ea9', 'm, xl', 'https://product.hstatic.net/200000182297/product/3_258548d9e99640bb8db950f63f61b41c_master.jpg', 'https://product.hstatic.net/200000182297/product/3_258548d9e99640bb8db950f63f61b41c_master.jpg, https://product.hstatic.net/200000182297/product/sm054621222382130418p799dt_q670521732332960291p759dt_5__316ff9a045da4d8f8666e92567f219fb_master.jpg, https://product.hstatic.net/200000182297/product/sm054621222382130418p799dt_q670521732332960291p759dt_3__02748ce6de354ab190f258877bff289b_master.jpg, https://product.hstatic.net/200000182297/product/sm054621222382130418p799dt_q670521732332960291p759dt_2__abc55aeba64a4268813a8d2c4a1749fa_master.jpg'),
('Q67053', 3, 'Jeans', 'quần jeans ống rộng', 759000, 379000, 'quần dài thiết kế cạp cao, ống suông rộng, tone màu khói.', '<p><b>Material</b>: vải jeans</p><p><b>Style</b>: quần dài thiết kế cạp cao, ống suông rộng, tone màu khói</p><p><b>Production Company</b>: DMT</p>', '#646771', 'l', 'https://product.hstatic.net/200000182297/product/4_b1a418c8c1e447f4bfe938642c8eb48d_master.jpg', 'https://product.hstatic.net/200000182297/product/4_b1a418c8c1e447f4bfe938642c8eb48d_master.jpg, https://product.hstatic.net/200000182297/product/sm024421212322120274p599dt_q670521732332980291p759dt_7c99833698a742b494a1e7c570f452ba_master.jpg, https://product.hstatic.net/200000182297/product/sm024421212322120274p599dt_q670521732332980291p759dt_2__7cfc3f00bdf64f46ad352d9c0b6dcd1f_master.jpg, https://product.hstatic.net/200000182297/product/sm024421212322120274p599dt_q670521732332980291p759dt_3__5bbf226aec804c6386ce04c8919dc84e_master.jpg'),
('Q67082', 3, 'Jeans', 'quần jeans cạp chun', 759000, 379000, 'quần jeans thiết kế dáng baggy, tone màu xanh đậm, cạp phối chun bản to.', '<p><b>Material</b>: vải jeans</p><p><b>Style</b>: quần jeans thiết kế dáng baggy, tone màu xanh đậm, cạp phối chun bản to</p><p><b>Production Company</b>: DMT</p>', '#2f4a68', 's', 'https://product.hstatic.net/200000182297/product/4_a62df6b239da468ebb0258dd2605c6fc_master.jpg', 'https://product.hstatic.net/200000182297/product/4_a62df6b239da468ebb0258dd2605c6fc_master.jpg, https://product.hstatic.net/200000182297/product/ts601621902332030462p299dt_q670821732332960283p759dt_f67283ef8fbd43198789c6744c759b9f_master.jpg, https://product.hstatic.net/200000182297/product/ts601621902332030462p299dt_q670821732332960283p759dt_1__24c021b495b14dfa9f42bbcfb24cd9ee_master.jpg, https://product.hstatic.net/200000182297/product/ts601621902332030462p299dt_q670821732332960283p759dt_2__4e896aa7856048aab6584512fccd3731_master.jpg'),
('Q67112', 3, 'Jeans', 'quần jeans rách gối', 799000, 399000, 'quần jeans thiết kế dáng ống rộng, tone màu xanh nhạt.', '<p><b>Material</b>: vải jeans</p><p><b>Style</b>: quần jeans thiết kế dáng ống rộng, tone màu xanh nhạt</p><p><b>Production Company</b>: DMT</p>', '#7d9cbb', 's, m, xl', 'https://product.hstatic.net/200000182297/product/2_21fef9b276c247599dc7f357e893a417_master.jpg', 'https://product.hstatic.net/200000182297/product/2_21fef9b276c247599dc7f357e893a417_master.jpg, https://product.hstatic.net/200000182297/product/al621721932333060480p399dt_q671121732333900463p799dt_880d7b93ec654a68bbe024279cf758f0_master.jpg, https://product.hstatic.net/200000182297/product/al621721932333060480p399dt_q671121732333900463p799dt_2__542a53a6836947bc8736da6d13ca699d_master.jpg, https://product.hstatic.net/200000182297/product/al621721932333060480p399dt_q671121732333900463p799dt_1__d52e30ae99154a249c87b6f52dd43069_master.jpg'),
('Q67132', 3, 'Jeans', 'quần jeans rách gối', 799000, 399000, 'quần jeans thiết kế dáng skinny, tone màu đen trơn.', '<p><b>Material</b>: vải jeans</p><p><b>Style</b>: quần jeans thiết kế dáng skinny, tone màu đen trơn</p><p><b>Production Company</b>: DMT</p>', '#101012', 'm', 'https://product.hstatic.net/200000182297/product/2_fade49121757463788b50e44d77a43bc_master.jpg', 'https://product.hstatic.net/200000182297/product/2_fade49121757463788b50e44d77a43bc_master.jpg, https://product.hstatic.net/200000182297/product/al620121932333040480p399dt_q671321732333910263p799dt__15__1__4d321ab1ef32466cb2d194a126f897d5_master.jpg, https://product.hstatic.net/200000182297/product/al620121932333040480p399dt_q671321732333910263p799dt__15__98e4b05aecfc48c294c72316075591d9_master.jpg, https://product.hstatic.net/200000182297/product/al620121932333040480p399dt_q671321732333910263p799dt__15__4__5b222a903ae0491b964f4cbad6c86bc8_master.jpg'),
('Q67142', 3, 'Capri Pants', 'quần jeans lửng', 799000, 399000, 'quần jeans thiết kế cạp đôi, tone màu xanh.', '<p><b>Material</b>: vải jeans</p><p><b>Style</b>: quần jeans thiết kế cạp đôi, tone màu xanh</p><p><b>Production Company</b>: DMT</p>', '#2b3a53', 's, xl', 'https://product.hstatic.net/200000182297/product/3_0b22ab20dd3c4733be2fb0c9415a23fb_master.jpg', 'https://product.hstatic.net/200000182297/product/3_0b22ab20dd3c4733be2fb0c9415a23fb_master.jpg, https://product.hstatic.net/200000182297/product/al621821932333050480p399dt_q671421732334900463p799dt_1827be2ffba14223aaca1569500b91ad_master.jpg, https://product.hstatic.net/200000182297/product/al621821932333050480p399dt_q671421732334900463p799dt_1__27a18bb650b249718f920e7db3385f12_master.jpg, https://product.hstatic.net/200000182297/product/al621821932333050480p399dt_q671421732334900463p799dt_2__377f72b79688421eb1c6edfdce1f7db2_master.jpg'),
('Q67192', 3, 'Jeans', 'quần jeans đáp gấu', 859000, 0, 'quần jeans thiết kế dáng ống đứng, tone màu xanh mài.', '<p><b>Material</b>: vải jeans</p><p><b>Style</b>: quần jeans thiết kế dáng ống đứng, tone màu xanh mài</p><p><b>Production Company</b>: DMT</p>', '#57789a', 's, m, l', 'https://product.hstatic.net/200000182297/product/4_b635187f471a45509b1ed6855bc1b6fb_master.jpg', 'https://product.hstatic.net/200000182297/product/4_b635187f471a45509b1ed6855bc1b6fb_master.jpg, https://product.hstatic.net/200000182297/product/al623421942334060480p559dt_q671921732334960263p859dt_4__5a09edd26cb94f989441070a4a567748_master.jpg, https://product.hstatic.net/200000182297/product/al623421942334060480p559dt_q671921732334960263p859dt_6__8ee55b4a85fa44d299e8ea63055b8e4d_master.jpg, https://product.hstatic.net/200000182297/product/al623421942334060480p559dt_q671921732334960263p859dt_5__7837f5e0bcfc45539b4765405b7f3b28_master.jpg'),
('SM00072', 1, 'Long Sleeve', 'áo sơ mi kẻ', 899000, 499000, 'áo thiết kế dáng suông, cổ bẻ, kết hợp họa tiết kẻ xanh.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: áo thiết kế dáng suông, cổ bẻ, kết hợp họa tiết kẻ xanh</p><p><b>Production Company</b>: DMT</p>', '#cbdbdd, #eaf3f6', 's, m, l', 'https://product.hstatic.net/200000182297/product/8_d85bc088106c46caba010f919eb51c93_master.jpg', 'https://product.hstatic.net/200000182297/product/8_d85bc088106c46caba010f919eb51c93_master.jpg, https://product.hstatic.net/200000182297/product/sm000721232452190218p899dt_q670321732332930291p699dt__5__25f83361efe64292b4edead0afa8b2f9_master.jpg, https://product.hstatic.net/200000182297/product/sm000721232452190218p899dt_q670321732332930291p699dt__3__4f5edab4fd2b454daae11cad1241be3f_master.jpg'),
('SM00102', 1, 'Medium Sleeve', 'áo tay lỡ', 799000, 0, 'áo thiết kế cổ tròn, tay lỡ, tone màu đen trơn.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: áo thiết kế cổ tròn, tay lỡ, tone màu đen trơn</p><p><b>Production Company</b>: DMT</p>', '#2f2f2f', 's, l, xl', 'https://product.hstatic.net/200000182297/product/sm001021222432010201p799dt_z001121542462010201p799dt_1__a42bcfeb2b6640e4b1cbf99aa87822d2_master.jpg', 'https://product.hstatic.net/200000182297/product/sm001021222432010201p799dt_z001121542462010201p799dt_1__a42bcfeb2b6640e4b1cbf99aa87822d2_master.jpg, https://product.hstatic.net/200000182297/product/sm001021222432010201p799dt_z001121542462010201p799dt_2__ed0fa09664154ddd8b51076a4b5ea156_master.jpg, https://product.hstatic.net/200000182297/product/sm001021222432010201p799dt_z001121542462010201p799dt_6__39eb767cd8ed48b9b2d3c853103e653e_master.jpg, https://product.hstatic.net/200000182297/product/sm001021222432010201p799dt_z001121542462010201p799dt_5__41fbe9dc42e24c5a882eb04ba1df211a_master.jpg, https://product.hstatic.net/200000182297/product/sm001021222432010201p799dt_z001121542462010201p799dt_9__bcf1df80242c4eb390983b83e2866e75_master.jpg, https://product.hstatic.net/200000182297/product/sm001021222432010201p799dt_z001121542462010201p799dt_04449e2500c94058923695df300a6d16_master.jpg'),
('SM00103', 1, 'Medium Sleeve', 'áo tay lỡ', 799000, 399500, 'áo thiết kế bo gấu, tay lỡ bồng nhẹ, cổ bẻ, kết hợp họa tiết.', '<p><b>Material</b>: vải lụa</p><p><b>Style</b>: áo thiết kế bo gấu, tay lỡ bồng nhẹ, cổ bẻ, kết hợp họa tiết</p><p><b>Production Company</b>: DMT</p>', '#f3e9e4, #bba199', 's, m, l, xl, 2xl', 'https://product.hstatic.net/200000182297/product/12_810084d42fab46238943f4b7e349c084_master.jpg', 'https://product.hstatic.net/200000182297/product/12_810084d42fab46238943f4b7e349c084_master.jpg, https://product.hstatic.net/200000182297/product/sm001221222462000218p799dt_q159821722212110201p799dt_4__b78f13237b904d8eba063b4de1756bd2_master.jpg, https://product.hstatic.net/200000182297/product/sm001221222462000218p799dt_q159821722212110201p799dt_2__a586b780710f4c319e84c2987116cf79_master.jpg, https://product.hstatic.net/200000182297/product/sm001221222462000218p799dt_q159821722212110201p799dt_3__8a107fd981ea4f08a0030716fac4ea68_master.jpg'),
('SM00232', 1, 'Medium Sleeve', 'sơ mi tay bồng thắt dây', 899000, 0, 'áo sơ mi thiết kế cổ bẻ, tay bồng, tone màu nâu be, thắt nơ phía trước.', '<p><b>Material</b>: vải tơ</p><p><b>Style</b>: áo sơ mi thiết kế cổ bẻ, tay bồng, tone màu nâu be, thắt nơ phía trước</p><p><b>Production Company</b>: DMT</p>', '#e5d4bc', 'm, l, xl', 'https://product.hstatic.net/200000182297/product/sm002321222432040457p899dt_q670321732332910291p699dt___27__1__f6f5108603dc4a5581405650cd6dc5b2_master.jpg', 'https://product.hstatic.net/200000182297/product/sm002321222432040457p899dt_q670321732332910291p699dt___27__1__f6f5108603dc4a5581405650cd6dc5b2_master.jpg, https://product.hstatic.net/200000182297/product/sm002321222432040457p899dt_q670321732332910291p699dt___27__2__dce747ab541042b891c3f6ebf4a7c87e_master.jpg, https://product.hstatic.net/200000182297/product/sm002321222432040457p899dt_q670321732332910291p699dt___27__3__3bd1bef9c2f547d8afbd8790bc96cf7d_master.jpg, https://product.hstatic.net/200000182297/product/sm002321222432040457p899dt_q670321732332910291p699dt___27__5__35a29ec0e80241d8bf676ec4eca86b44_master.jpg'),
('SM00472', 1, 'Medium Sleeve', 'áo sơ mi trắng cổ bèo', 1099000, 769000, 'áo thiết kế dáng suông, cổ phối bèo, tone màu trắng trơn.', '<p><b>Material</b>: vải tơ hoa</p><p><b>Style</b>: áo thiết kế dáng suông, cổ phối bèo, tone màu trắng trơn</p><p><b>Production Company</b>: DMT</p>', '#f3f3f3', 'm, l, 2xl', 'https://product.hstatic.net/200000182297/product/sm004721222432030257p1099dt_q026221512432030258p699dt_1__bfb65f1427a245588f10e68b4936638d_master.jpg', 'https://product.hstatic.net/200000182297/product/sm004721222432030257p1099dt_q026221512432030258p699dt_1__bfb65f1427a245588f10e68b4936638d_master.jpg, https://product.hstatic.net/200000182297/product/sm004721222432030257p1099dt_q026221512432030258p699dt_3__1302d738e7e441e4a574fccfd661d175_master.jpg, https://product.hstatic.net/200000182297/product/sm004721222432030257p1099dt_q026221512432030258p699dt_4__29afeb9c5fa5466bb2aa94306d157193_master.jpg, https://product.hstatic.net/200000182297/product/sm004721222432030257p1099dt_q026221512432030258p699dt_2__6e9741f4d197424c9d1778d501713a8e_master.jpg'),
('SM00482', 1, 'Medium Sleeve', 'sơ mi hoa nhí', 1099000, 769000, 'áo thiết kế bo gấu, tay lỡ bồng nhẹ, cổ bẻ, kết hợp họa tiết.', '<p><b>Material</b>: vải voan tơ</p><p><b>Style</b>: áo thiết kế bo gấu, tay lỡ bồng nhẹ, cổ bẻ, kết hợp họa tiết</p><p><b>Production Company</b>: DMT</p>', '#c2d7e2', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/12_880311af5ab74e34887ad9e53d0b07de_master.jpg', 'https://product.hstatic.net/200000182297/product/12_880311af5ab74e34887ad9e53d0b07de_master.jpg, https://product.hstatic.net/200000182297/product/sm004821222432000257p1099dt_z006421512482130201p699dt_29fb7598cefb4e2b928ce325e95680d7_master.jpg, https://product.hstatic.net/200000182297/product/sm004821222432000257p1099dt_z006421512482130201p699dt_4__75014145d8114c428b041a5b0cd50be9_master.jpg, https://product.hstatic.net/200000182297/product/sm004821222432000257p1099dt_z006421512482130201p699dt_1__cf3c782f588c49348130d2329085ace9_master.jpg'),
('SM00512', 1, 'Long Sleeve', 'áo sơ mi hồng oversize', 899000, 0, 'áo sơ mi thiết kế dáng oversize, tone màu vàng.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: áo sơ mi thiết kế dáng oversize, tone màu vàng</p><p><b>Production Company</b>: DMT</p>', '#fd4e81', 'm, l', 'https://product.hstatic.net/200000182297/product/15_d04f620fbf484876bc3845d44125f3f4_master.jpg', 'https://product.hstatic.net/200000182297/product/15_d04f620fbf484876bc3845d44125f3f4_master.jpg, https://product.hstatic.net/200000182297/product/sm180021222432020418p899dt_q670321732332910291p699dt_43d7b45d18af4a17b69b0dabf3d9cad3_master.jpg, https://product.hstatic.net/200000182297/product/sm180021222432020418p899dt_q670321732332910291p699dt__6__972ec72e270044188129a33cef02c832_master.jpg'),
('SM01322', 1, 'Short Sleeve', 'áo peplum cổ vest', 999000, 0, 'áo sơ mi thiết kế peplum, tone màu vàng nhạt, kèm đai như hình.', '<p><b>Material</b>: vải tổng hợp cao cấp</p><p><b>Style</b>: áo sơ mi thiết kế peplum, tone màu vàng nhạt, kèm đai như hình</p><p><b>Production Company</b>: DMT</p>', '#f5dc53', 's, m, l, xl', 'https://product.hstatic.net/200000182297/product/29_1c749c08588744c88cb3398ce18372d3_master.jpg', 'https://product.hstatic.net/200000182297/product/29_1c749c08588744c88cb3398ce18372d3_master.jpg, https://product.hstatic.net/200000182297/product/ak013221312442150405p999dt_kem_dai___z013321542492050205p799dt_6__3__31c04ed422d145a2bc1a1d7af317beb4_master.jpg, https://product.hstatic.net/200000182297/product/ak013221312442150405p999dt_kem_dai___z013321542492050205p799dt_6__6__d3a975ceb2d649668c4fd62f8767757e_master.jpg, https://product.hstatic.net/200000182297/product/ak013221312442150405p999dt_kem_dai___z013321542492050205p799dt_6__2__1aaa35b52ca94baa95ca9dbf384feb78_master.jpg, https://product.hstatic.net/200000182297/product/ak013221312442150405p999dt_kem_dai___z013321542492050205p799dt_6__311a42c899d3416797d976897e2aa030_master.jpg'),
('SM01872', 1, 'Short Sleeve', 'sơ mi vạt bầu', 899000, 0, 'áo sơ mi thiết kế dáng suông, vạt bầu, tone màu nâu.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: áo sơ mi thiết kế dáng suông, vạt bầu, tone màu nâu</p><p><b>Production Company</b>: DMT</p>', '#ecdcca', 's, m, l', 'https://product.hstatic.net/200000182297/product/3_eddb682c1073458d90b2f8d603b22882_master.jpg', 'https://product.hstatic.net/200000182297/product/3_eddb682c1073458d90b2f8d603b22882_master.jpg, https://product.hstatic.net/200000182297/product/sm018721212442140401p899dt_q068321722353110274p799dt_1__b8b127a110de425aaeea84caf1ff07e1_master.jpg, https://product.hstatic.net/200000182297/product/sm018721212442140401p899dt_q068321722353110274p799dt_2__abe1bb71101c4419af236eed83a32209_master.jpg, https://product.hstatic.net/200000182297/product/sm018721212442140401p899dt_q068321722353110274p799dt_766e060e64e34b0a9dcac63911683775_master.jpg'),
('SM02042', 1, 'Medium Sleeve', 'sơ mi tay lỡ', 899000, 269000, 'áo thiết kế dáng suông rộng, tay lỡ bồng nhẹ, tone màu xanh lá đậm.', '<p><b>Material</b>: vải voan</p><p><b>Style</b>: áo thiết kế dáng suông rộng, tay lỡ bồng nhẹ, tone màu xanh lá đậm</p><p><b>Production Company</b>: DMT</p>', '#02734d', 's, m, l, xl, 2xl', 'https://product.hstatic.net/200000182297/product/2_472db81e8a6047efb86fed290a7e4aeb_master.jpg', 'https://product.hstatic.net/200000182297/product/2_472db81e8a6047efb86fed290a7e4aeb_master.jpg, https://product.hstatic.net/200000182297/product/sm020421212332460201p899dt_q205821702312130657p599dt__3__0466c4f4ea124ae2acb125295203aef7_master.jpg, https://product.hstatic.net/200000182297/product/sm020421212332460201p899dt_q205821702312130657p599dt__1__1e1409e28d9c44a0a032758dff4741e8_master.jpg, https://product.hstatic.net/200000182297/product/sm020421212332460201p899dt_q205821702312130657p599dt__2__6182d90811944f478b85b3b032d3fabf_master.jpg'),
('SM03242', 1, 'Short Sleeve', 'sơ mi phối kẻ', 699000, 0, 'áo sơ mi thiết kế tay bồng, phối họa tiết kẻ.', '<p><b>Material</b>: vải tổng hợp cao cấp</p><p><b>Style</b>: áo sơ mi thiết kế tay bồng, phối họa tiết kẻ</p><p><b>Production Company</b>: DMT</p>', '#eeedec, #c7cede', 's, m, l', 'https://product.hstatic.net/200000182297/product/2_ff2fb085954b435faf676f6c4c333eb2_master.jpg', 'https://product.hstatic.net/200000182297/product/2_ff2fb085954b435faf676f6c4c333eb2_master.jpg, https://product.hstatic.net/200000182297/product/sm032421212442190257p699dt_q185121702412030247p799dt_ac4a3495826247d6ba52a3141b96e8c0_master.jpg, https://product.hstatic.net/200000182297/product/sm032421212442190257p699dt_q185121702412030247p799dt_3__12b4569380c4430290ee67336efa35f2_master.jpg'),
('SM04692', 1, 'Short Sleeve', 'sơ mi hoa vai bồng', 799000, 0, 'áo sơ mi thiết kế dáng suông, vai bồng, kết hợp họa tiết hoa in.', '<p><b>Material</b>: vải voan</p><p><b>Style</b>: áo sơ mi thiết kế dáng suông, vai bồng, kết hợp họa tiết hoa in</p><p><b>Production Company</b>: DMT</p>', '#f5f5ee, #cfcebc', 'm, l, xl, 2xl', 'https://product.hstatic.net/200000182297/product/11_41e9a82052494f648b9b64c7a7504b08_master.jpg', 'https://product.hstatic.net/200000182297/product/11_41e9a82052494f648b9b64c7a7504b08_master.jpg, https://product.hstatic.net/200000182297/product/sm046921412442400474p799dt_z165621542412160218p999dt.jpg_4__ca9ac6882d8b40d5b729dd172cb856b2_master.jpg, https://product.hstatic.net/200000182297/product/sm046921412442400474p799dt_z165621542412160218p999dt.jpg_1__978f12a3a09e42d0aa5bd44d8d8b5ce6_master.jpg, https://product.hstatic.net/200000182297/product/sm046921412442400474p799dt_z165621542412160218p999dt.jpg_97a0bdb861374437882a5e59bcf6425d_master.jpg, https://product.hstatic.net/200000182297/product/sm046921412442400474p799dt_z165621542412160218p999dt.jpg_2__73f02ef38f5b44cda32d96f94ef10c92_master.jpg, https://product.hstatic.net/200000182297/product/sm046921412442400474p799dt_z165621542412160218p999dt.jpg_5__b7055833a3824f09a1f851abbc3ddfdd_master.jpg'),
('SM05232', 1, 'Short Sleeve', 'sơ mi cổ bẻ', 799000, 0, 'áo sơ thiết kế cổ bẻ, tone màu xanh in họa tiết hoa.', '<p><b>Material</b>: vải thô</p><p><b>Style</b>: áo sơ thiết kế cổ bẻ, tone màu xanh in họa tiết hoa</p><p><b>Production Company</b>: DMT</p>', '#a5cee9', 's, m, l, xl, 2xl', 'https://product.hstatic.net/200000182297/product/5_e8741dbbd81f490ab2fae8d4af5f96cb_master.jpg', 'https://product.hstatic.net/200000182297/product/5_e8741dbbd81f490ab2fae8d4af5f96cb_master.jpg, https://product.hstatic.net/200000182297/product/sm052321212442160257p799dt_z052421512442160257p799dt_5__07caf88ae5824e6ca5de11d34d013bfe_master.jpg, https://product.hstatic.net/200000182297/product/sm052321212442160257p799dt_z052421512442160257p799dt_6__8c03da41143f4cda86a6bb698a479a71_master.jpg, https://product.hstatic.net/200000182297/product/sm052321212442160257p799dt_z052421512442160257p799dt_4__f96bedcbe85342a78d9a5eb6515f7d6f_master.jpg'),
('SM05372', 1, 'Short Sleeve', 'sơ mi họa tiết', 799000, 0, 'áo sơ mi thiết kế ngắn tay, cổ tròn, kết hợp họa tiết.', '<p><b>Material</b>: vải tổng hợp cao cấp</p><p><b>Style</b>: áo sơ mi thiết kế ngắn tay, cổ tròn, kết hợp họa tiết</p><p><b>Production Company</b>: DMT</p>', '#b8b5b6, #676767', 'm, l, xl, 2xl', 'https://product.hstatic.net/200000182297/product/16_64fd01eefa1647f8a07f564df3949f50_master.jpg', 'https://product.hstatic.net/200000182297/product/16_64fd01eefa1647f8a07f564df3949f50_master.jpg, https://product.hstatic.net/200000182297/product/sm053721212442400458p799dt_z052521542442110258p999dt_2__ae2f082c08ee47a68339e4ceea0b439c_master.jpg, https://product.hstatic.net/200000182297/product/sm053721212442400458p799dt_z052521542442110258p999dt_3__cf3c410d4c3147c295dc6b0a5aa985ec_master.jpg, https://product.hstatic.net/200000182297/product/sm053721212442400458p799dt_z052521542442110258p999dt_4__220755afb69e4c449f257b5cb92e5cf7_master.jpg, https://product.hstatic.net/200000182297/product/sm053721212442400458p799dt_z052521542442110258p999dt_5__8e0face35d084a6eaad82010a7ee5fe3_master.jpg'),
('SM16592', 1, 'Long Sleeve', 'áo hoa tay bồng', 799000, 0, 'áo thiết kế dáng suông rộng, tay lỡ bồng nhẹ, tone màu xanh lá đậm.', '<p><b>Material</b>: vải voan</p><p><b>Style</b>: áo thiết kế dáng suông rộng, tay lỡ bồng nhẹ, tone màu xanh lá đậm</p><p><b>Production Company</b>: DMT</p>', '#e1e4ef, #c388c6, #d1cfed, #6f85c3, #b9bde3', 'm, l, xl, 2xl', 'https://product.hstatic.net/200000182297/product/13_ce5fba1068664d18a5a1351a2ca8f650_master.jpg', 'https://product.hstatic.net/200000182297/product/13_ce5fba1068664d18a5a1351a2ca8f650_master.jpg, https://product.hstatic.net/200000182297/product/sm165921232422400458p799dt_z166021542412400458p999dt__6__2e189144b25c4f5d85b89580b873e5f2_master.jpg, https://product.hstatic.net/200000182297/product/sm165921232422400458p799dt_z166021542412400458p999dt__4__b0777d7ae157448b95fb3b77ff78f8a0_master.jpg, https://product.hstatic.net/200000182297/product/sm165921232422400458p799dt_z166021542412400458p999dt__5__d1caa42783de41a5bdf982ce164225c8_master.jpg'),
('SM40882', 1, 'Short Sleeve', 'sơ mi họa tiết chun eo', 499000, 0, 'áo sơ mi thiết kế phối chun eo, tone màu trắng phối họa tiết in.', '<p><b>Material</b>: vải tổng hợp cao cấp</p><p><b>Style</b>: áo sơ mi thiết kế phối chun eo, tone màu trắng phối họa tiết in</p><p><b>Production Company</b>: DMT</p>', '#d4d2cf, #52504a', 'm, l, xl, 2xl', 'https://product.hstatic.net/200000182297/product/13_bdebb74528b748fbbf688cb241a2675c_master.jpg', 'https://product.hstatic.net/200000182297/product/13_bdebb74528b748fbbf688cb241a2675c_master.jpg, https://product.hstatic.net/200000182297/product/sm408821212442100401p499dt_q402221722422110247p599dt_3__86a005927b3a44e8a0ad28b778097cd2_master.jpg, https://product.hstatic.net/200000182297/product/sm408821212442100401p499dt_q402221722422110247p599dt_4__66b28681054c420db13708feed94cb21_master.jpg, https://product.hstatic.net/200000182297/product/sm408821212442100401p499dt_q402221722422110247p599dt_1__61a37fbe245a4f668ee9ebb39a32142d_master.jpg'),
('SM40892', 1, 'Medium Sleeve', 'sơ mi chấm bi', 499000, 0, 'áo sơ mi thiết kế cổ tròn, tone màu xanh than phối họa tiết chấm bi trắng.', '<p><b>Material</b>: vải voan</p><p><b>Style</b>: áo sơ mi thiết kế cổ tròn, tone màu xanh than phối họa tiết chấm bi trắng</p><p><b>Production Company</b>: DMT</p>', '#85848b, #cdccd1', 'm, l, xl, 2xl', 'https://product.hstatic.net/200000182297/product/6_8821cdd64ad04fd19b6de82c393bb449_master.jpg', 'https://product.hstatic.net/200000182297/product/6_8821cdd64ad04fd19b6de82c393bb449_master.jpg, https://product.hstatic.net/200000182297/product/sm408921212432000418p499dt_z408621542482110218p499dt_6__d90f8b6b1a744142ab71e3c9e31ffb5d_master.jpg, https://product.hstatic.net/200000182297/product/sm408921212432000418p499dt_z408621542482110218p499dt_5__9351a4871e6f4d9c815658b59828e8b0_master.jpg, https://product.hstatic.net/200000182297/product/sm408921212432000418p499dt_z408621542482110218p499dt_3__32e6442e14eb46d199b218337b15101e_master.jpg, https://product.hstatic.net/200000182297/product/sm408921212432000418p499dt_z408621542482110218p499dt_4__026915c8f5df473981ef3c04b4b24811_master.jpg'),
('SM42172', 1, 'Long Sleeve', 'sơ mi trắng tay bồng', 499000, 299000, 'áo thiết kế dáng suông, cổ bẻ, tone màu trắng trơn.', '<p><b>Material</b>: vải tổng hợp cao cấp</p><p><b>Style</b>: áo thiết kế dáng suông, cổ bẻ, tone màu trắng trơn</p><p><b>Production Company</b>: DMT</p>', '#fafafa', 'm, l, xl, 2xl', 'https://product.hstatic.net/200000182297/product/3_965c5c5fe08b45448e22484cd0160d32_master.jpg', 'https://product.hstatic.net/200000182297/product/3_965c5c5fe08b45448e22484cd0160d32_master.jpg, https://product.hstatic.net/200000182297/product/sm421721232412030218p499dt_z418121522311110410p359dt__3__76bc38bb63834551a236a22357e070a5_master.jpg, https://product.hstatic.net/200000182297/product/sm421721232412030218p499dt_z418121522311110410p359dt__2__ba308b2dd64c4b9691c598c3b9051be3_master.jpg, https://product.hstatic.net/200000182297/product/sm421721232412030218p499dt_z418121522311110410p359dt__1__09cc18fb40194e0dbe7982677975f024_master.jpg, https://product.hstatic.net/200000182297/product/sm421721232412030218p499dt_z418121522311110410p359dt__6__20015b303c544c509fe417d1606b7102_master.jpg'),
('SM62412', 1, 'Medium Sleeve', 'sơ mi phối hoa cắt lazer', 999000, 599000, 'áo sơ mi thiết kế dáng suông, tay bồng, tone màu tím kết hợp hoa cắt lazer.', '<p><b>Material</b>: vải voan</p><p><b>Style</b>: áo sơ mi thiết kế dáng suông, tay bồng, tone màu tím kết hợp hoa cắt lazer</p><p><b>Production Company</b>: DMT</p>', '#caa9b5', 's, m', 'https://product.hstatic.net/200000182297/product/3_c5684d900b834a499849627da472ca68_master.jpg', 'https://product.hstatic.net/200000182297/product/3_c5684d900b834a499849627da472ca68_master.jpg, https://product.hstatic.net/200000182297/product/sm624121222331070263p999dt_z049621542382070801p799dt_5bf969cd11f841cda5096d5aab166255_master.jpg, https://product.hstatic.net/200000182297/product/sm624121222331070263p999dt_z049621542382070801p799dt_3__952f6c82ebed448685335f118b480a5f_master.jpg, https://product.hstatic.net/200000182297/product/sm624121222331070263p999dt_z049621542382070801p799dt_1__8ddd1eb7dfbc404abdd89396cf3aafa4_master.jpg'),
('TS60040', 2, '', 'áo thun cổ tim', 329000, 0, 'áo phông thiết kế dáng suông, cổ tim, tone màu xanh kết hợp họa tiết.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, cổ tim, tone màu xanh kết hợp họa tiết</p><p><b>Production Company</b>: DMT</p>', '#a9e9d9', 'm, l, xl', 'https://product.hstatic.net/200000182297/product/3_6f87db09d02040f8834ca4ac5ecbca24_master.jpg', 'https://product.hstatic.net/200000182297/product/3_6f87db09d02040f8834ca4ac5ecbca24_master.jpg, https://product.hstatic.net/200000182297/product/ts600421902402060462p329dt_q078521702362130401p499dt_6befb6151de945b48ac0411636cf440c_master.jpg, https://product.hstatic.net/200000182297/product/ts600421902402060462p329dt_q078521702362130401p499dt_3__16bc51aa45dc443d96e551201cea1e5e_master.jpg'),
('TS60041', 2, '', 'áo thun cổ tim', 329000, 0, 'áo phông thiết kế dáng suông, cổ tim, tone màu vàng cam kết hợp họa tiết.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, cổ tim, tone màu vàng cam kết hợp họa tiết</p><p><b>Production Company</b>: DMT</p>', '#ffb349', 'm, l, xl', 'https://product.hstatic.net/200000182297/product/4_2a8c5444136b4e7280b46c8226baf934_master.jpg', 'https://product.hstatic.net/200000182297/product/4_2a8c5444136b4e7280b46c8226baf934_master.jpg, https://product.hstatic.net/200000182297/product/ts600421902402050462p329dt_q670421732332900291p699dt.jpg_2__b7ac56d88f6848fea4425e9c486b3b3e_master.jpg, https://product.hstatic.net/200000182297/product/ts600421902402050462p329dt_q670421732332900291p699dt.jpg_5__3d6fad30d3044bd0a7619156663463a6_master.jpg');
INSERT INTO `product` (`pcode`, `id`, `type`, `name`, `price`, `sale`, `intro`, `des`, `color`, `size`, `image`, `thumb`) VALUES
('TS60042', 2, '', 'áo thun cổ tim', 329000, 0, 'áo phông thiết kế dáng suông, cổ tim, tone màu hồng đậm kết hợp họa tiết.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, cổ tim, tone màu hồng đậm kết hợp họa tiết</p><p><b>Production Company</b>: DMT</p>', '#fb4068', 'l', 'https://product.hstatic.net/200000182297/product/ts600421902402020462p329dt_q185021702412010247p799dt_5__5ef8b87294a74c93a3fd9d64fc58eb65_master.jpg', 'https://product.hstatic.net/200000182297/product/ts600421902402020462p329dt_q185021702412010247p799dt_5__5ef8b87294a74c93a3fd9d64fc58eb65_master.jpg, https://product.hstatic.net/200000182297/product/ts600421902402020462p329dt_q185021702412010247p799dt_9__3f9ffd13d781415494e771e9ad225506_master.jpg, https://product.hstatic.net/200000182297/product/ts600421902402020462p329dt_q185021702412010247p799dt_4__3e632907b2454c9fbeee707cd1507a6f_master.jpg'),
('TS60051', 2, '', 'áo phông trắng in họa tiết', 329000, 0, 'áo phông thiết kế dáng suông, tone màu trắng kết hợp họa tiết in mặt trước.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, tone màu trắng kết hợp họa tiết in mặt trước</p><p><b>Production Company</b>: DMT</p>', '#fafafe', 'l', 'https://product.hstatic.net/200000182297/product/11_8e0e7b8d4cae4d65a64309849766f94e_master.jpg', 'https://product.hstatic.net/200000182297/product/11_8e0e7b8d4cae4d65a64309849766f94e_master.jpg, https://product.hstatic.net/200000182297/product/ts600521902432010423p329dt_z185821542312400257p799dt__3__d989d301516847bf8c3433304f5b20e2_master.jpg, https://product.hstatic.net/200000182297/product/ts600521902432010423p329dt_z185821542312400257p799dt__1__626356b44bba4e268d89c8ac2e9ea958_master.jpg'),
('TS60052', 2, '', 'áo phông in họa tiết', 329000, 0, 'áo phông thiết kế dáng suông, tone màu xanh kết hợp họa tiết in mặt trước.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, tone màu xanh kết hợp họa tiết in mặt trước</p><p><b>Production Company</b>: DMT</p>', '#303c5d', 'm, l, xl', 'https://product.hstatic.net/200000182297/product/ts600521902432060423p329dt_q671021732334960477p599dt__8__1bdc97a717fb4e72ae0c66c61a7260f7_master.jpg', 'https://product.hstatic.net/200000182297/product/ts600521902432060423p329dt_q671021732334960477p599dt__8__1bdc97a717fb4e72ae0c66c61a7260f7_master.jpg, https://product.hstatic.net/200000182297/product/ts600521902432060423p329dt_q671021732334960477p599dt__3__c1ac0c6d58344448a6855d0432cf4d94_master.jpg, https://product.hstatic.net/200000182297/product/ts600521902432060423p329dt_q671021732334960477p599dt__7__3561df8352d54ef5adb5e7171bb94fb5_master.jpg'),
('TS60072', 2, '', 'áo phông in họa tiết', 329000, 0, 'áo phông thiết kế dáng suông, tone màu xanh kết hợp họa tiết in.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, tone màu xanh kết hợp họa tiết in</p><p><b>Production Company</b>: DMT</p>', '#cce3e7', 'm, l, xl', 'https://product.hstatic.net/200000182297/product/12_204fce1dba244975b7c7be0f7cac35bd_master.jpg', 'https://product.hstatic.net/200000182297/product/12_204fce1dba244975b7c7be0f7cac35bd_master.jpg, https://product.hstatic.net/200000182297/product/ts600721902432060423p329dt_q670321732332930291p699dt__4__2a2ee878108e48eaa922cd8f157daafb_master.jpg, https://product.hstatic.net/200000182297/product/ts600721902432060423p329dt_q670321732332930291p699dt__3__b42a9512d3a54bbaa97a428de3510d13_master.jpg'),
('TS60122', 2, '', 'áo phông trắng viền đỏ', 299000, 0, 'áo phông thiết kế dáng suông, tone màu trắng kết hợp viền đỏ.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, tone màu trắng kết hợp viền đỏ</p><p><b>Production Company</b>: DMT</p>', '#f7f6fb, #d7733b', 'l, xl', 'https://product.hstatic.net/200000182297/product/12_d5a6620fd93a43b280a70ec1601a4b98_master.jpg', 'https://product.hstatic.net/200000182297/product/12_d5a6620fd93a43b280a70ec1601a4b98_master.jpg, https://product.hstatic.net/200000182297/product/ts601221902432030462p299dt_q671021732334900477p599dt_4__e91fe243a8cc48da8e5ddaf095ef87f1_master.jpg, https://product.hstatic.net/200000182297/product/ts601221902432030462p299dt_q671021732334900477p599dt_7__3dd28782f7a7429aaafbde9f548441b6_master.jpg'),
('TS60131', 2, '', 'áo thun in chữ', 329000, 0, 'áo phông thiết kế dáng suông, kết hợp chữ in phía trước.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, kết hợp chữ in phía trước</p><p><b>Production Company</b>: DMT</p>', '#e9ee6d', 'l, xl', 'https://product.hstatic.net/200000182297/product/12_d52f086514614860bafec6df2a2de34b_master.jpg', 'https://product.hstatic.net/200000182297/product/12_d52f086514614860bafec6df2a2de34b_master.jpg, https://product.hstatic.net/200000182297/product/ts601321902432860423p329dt_z006821512492130218p699dt_7__cd03ca2b3da9445eb38ee2d47328f3b3_master.jpg, https://product.hstatic.net/200000182297/product/ts601321902432860423p329dt_z006821512492130218p699dt_3__d7bb122738d84a62a1e889a8fc165797_master.jpg'),
('TS60132', 2, '', 'áo thun tím in chữ', 329000, 0, 'áo phông thiết kế dáng suông, tone màu tím kết hợp chữ in phía trước.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, tone màu tím kết hợp chữ in phía trước</p><p><b>Production Company</b>: DMT</p>', '#c3a6d3', 'l, xl', 'https://product.hstatic.net/200000182297/product/14_731cd8dd9cce469096a35dd3e8ba1f7f_master.jpg', 'https://product.hstatic.net/200000182297/product/14_731cd8dd9cce469096a35dd3e8ba1f7f_master.jpg, https://product.hstatic.net/200000182297/product/ts601321902432870423p329dt_z006721512492110218p699dt_7__102378e96c084e7abbbf5d401c908191_master.jpg, https://product.hstatic.net/200000182297/product/ts601321902432870423p329dt_z006721512492110218p699dt_2__9d2fd256489e4f72b7fa6f8a5deb34ef_master.jpg'),
('TS60142', 2, '', 'áo phông in họa tiết', 329000, 0, 'áo phông thiết kế dáng suông, tone màu vàng kết hợp họa tiết in mặt trước.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, tone màu vàng kết hợp họa tiết in mặt trước</p><p><b>Production Company</b>: DMT</p>', '#f5dc53', 'l, xl', 'https://product.hstatic.net/200000182297/product/10_47721c7499f44612be9672abae4a6a4a_master.jpg', 'https://product.hstatic.net/200000182297/product/10_47721c7499f44612be9672abae4a6a4a_master.jpg, https://product.hstatic.net/200000182297/product/ts601421902432850423p329dt_q078521702362130401p499dt__3__4f147d0d99164d9fa4a75505d885e52d_master.jpg, https://product.hstatic.net/200000182297/product/ts601421902432850423p329dt_q078521702362130401p499dt__1__c2aac9df6bc741a6812390cbbaa376ee_master.jpg'),
('TS62022', 2, '', 'áo phông in họa tiết', 359000, 0, 'áo phông thiết kế dáng suông, tone màu đỏ kết hợp họa tiết in.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, tone màu đỏ kết hợp họa tiết in</p><p><b>Production Company</b>: DMT</p>', '#bc3943', 'l, xl', 'https://product.hstatic.net/200000182297/product/7_6384a39d208f422a9507da28c38ca995_master.jpg', 'https://product.hstatic.net/200000182297/product/7_6384a39d208f422a9507da28c38ca995_master.jpg, https://product.hstatic.net/200000182297/product/ts620221902332020462p359dt_z023121542382111074p999dt__3__489bcbce8d9b4aca820944f378f6bcc2_master.jpg, https://product.hstatic.net/200000182297/product/ts620221902332020462p359dt_z023121542382111074p999dt__1__e3842b42bd5445d296db51889393d883_master.jpg'),
('TS62042', 2, '', 'áo phông in họa tiết', 359000, 0, 'áo phông thiết kế dáng suông, tone màu be kết hợp họa tiết in.', '<p><b>Material</b>: vải thun cao cấp</p><p><b>Style</b>: áo phông thiết kế dáng suông, tone màu be kết hợp họa tiết in</p><p><b>Production Company</b>: DMT</p>', '#d8c1a9', 'm, l, xl', 'https://product.hstatic.net/200000182297/product/ts620421902432840462p359dt_z169821542452400274p999dt__11__b0eb1005584740099ab0a71445851100_master.jpg', 'https://product.hstatic.net/200000182297/product/ts620421902432840462p359dt_z169821542452400274p999dt__11__b0eb1005584740099ab0a71445851100_master.jpg, https://product.hstatic.net/200000182297/product/ts620421902432840462p359dt_z169821542452400274p999dt__10__154fba3d8a324489a850eabf33275362_master.jpg, https://product.hstatic.net/200000182297/product/ts620421902432840462p359dt_z169821542452400274p999dt__6__7ca12d35a2ff454c9d961a0d24274370_master.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `gender` enum('male','female','other') DEFAULT 'male',
  `birthday` date DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `avt` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `fullname`, `gender`, `birthday`, `email`, `tel`, `avt`) VALUES
(1, 'mnhtngdev', '$2y$10$mZBEZ7zFuFM7UtPKYsQiKe2hc.Cw.CwGTuHiu7pz2sIkt2XqyTpZa', 'Manh Tung', 'male', '0000-00-00', 'domanhtung321@gmail.com', '0777888999', './src/assets/images/anh1.jpg'),
(2, 'mnhtng', '$2y$10$OUSyqyjUgiXgK36oOQg20uyADzOGRsj8l//5Ey2DCT6SLlJ8vtzOK', 'Đỗ Mạnh Tùng', 'male', '2003-04-14', 'domanhtung123@gmail.com', '08913293823', './src/assets/images/anh2.jpg'),
(15, 'blackwukong', '$2y$10$FeMjKQDEsc4Kj5Y8ml5u.OdyxgeWc2.CT8ytZw09aoLGxMXsMoO7G', 'Black Myth Wukong', '', '0000-00-00', 'domanhtung1442003@gmail.com', '08123812837', NULL),
(16, 'saitama', '$2y$10$fW1kDeobG3K20NbFYR/NDu.OprsfDO5iGw5GJGryg9aykNJCG1d3y', 'saitama', '', '0000-00-00', 'domanhtung1404@gmail.com', '0127381273', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cancel_order`
--
ALTER TABLE `cancel_order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`,`type`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`code`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pcode`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `cancel_order`
--
ALTER TABLE `cancel_order`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
