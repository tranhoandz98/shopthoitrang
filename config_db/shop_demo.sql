-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 29, 2020 lúc 06:38 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop_demo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `status`) VALUES
(1, 'Tran Van Hoan', 'tranhoan.dz98@gmail.com', '$2y$10$nOclkr3z7RA.6UpEF2VAKOqalkHlWBwncj08jxJNn3QBfs6KNMSpy', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner`
--

INSERT INTO `banner` (`id`, `name`, `slug`, `image`, `status`) VALUES
(4, 'banner 1', 'banner-1', '1590333640banner.jpg', 1),
(5, 'banner 2', 'banner-2', '1590333655banner2.jpg', 1),
(9, 'banner 3', 'banner-3', '15904990761590333663banner3.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `status`) VALUES
(15, 'Áo nữ', 'ao-nu', 1),
(16, 'Quần nữ', 'quan-nu', 1),
(17, 'Váy đầm', 'vay-dam', 1),
(18, 'Bộ nữ', 'bo-nu', 1),
(19, 'Giày dép', 'giay-dep', 1),
(20, 'Sản phẩm khuyến mãi', 'san-pham-khuyen-mai', 1),
(21, 'Jum-Đồ liền', 'jum-do-lien', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `img_pro`
--

CREATE TABLE `img_pro` (
  `id` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `img_pro`
--

INSERT INTO `img_pro` (`id`, `id_pro`, `image`) VALUES
(138, 52, '1590336220m79-2.jpg'),
(139, 52, '1590336220m79-3.jpg'),
(140, 49, '1590335996gs1014-2.jpg'),
(141, 49, '1590335996gs1014-3.jpg'),
(142, 50, '1590336072gs1015-2.jpg'),
(143, 50, '1590336072gs1015-3.jpg'),
(144, 51, '1590336129gs1016-2.jpg'),
(145, 51, '1590336129gs1016-3.jpg'),
(146, 53, '1590396534tj1055-2.jpg'),
(147, 53, '1590396534tj1055-3.jpg'),
(148, 54, '1590397948tj1062-2.jpg'),
(149, 54, '1590397948tj1062-3.jpg'),
(150, 55, '1590398022g3110-den-2.jpg'),
(151, 55, '1590398022g3110-kem-1.jpg'),
(152, 55, '1590398022g3110-kem-2.jpg'),
(153, 56, '1590398093g3113-2.jpg'),
(154, 56, '1590398093g3113-3.jpg'),
(155, 56, '1590398093g3113-4.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_price` float NOT NULL,
  `address_ship` text COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `creadted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_cate` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL,
  `sale_price` float DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `dess` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `slug`, `id_cate`, `quantity`, `price`, `sale_price`, `image`, `status`, `dess`) VALUES
(49, 'Sơ mi lụa tay dài GS1014', 'so-mi-lua-tay-dai-gs1014', 15, 0, 210000, 0, '1590335996gs1014-1.jpg', 1, '																																<p>Chất liệu: Lụa satin Size M, L CHỌN SIZE: + Size M: 46-52kg + Size L: 53-57kg Kiểu Dáng :Form chuẩn phù hợp với vóc dáng phụ nữ Việt Nam...</p>\r\n																												'),
(50, 'Áo sơ mi nữ chấm bi tay dài GS1015', 'ao-so-mi-nu-cham-bi-tay-dai-gs1015', 15, 0, 210000, 0, '1590336072gs1015-1.jpg', 1, '<p>Chất liệu: Voan H&agrave;n Size M, L, XL CHỌN SIZE: + Size M: 46-52kg + Size L: 53-57kg +Size XL: 58-62kg Kiểu D&aacute;ng :Form chuẩn ph&ugrave; hợp với v&oacute;c d&aacute;ng phụ nữ Việt Nam...</p>\r\n'),
(51, 'Áo sơ mi nữ chấm bi tay dài GS1016', 'ao-so-mi-nu-cham-bi-tay-dai-gs1016', 15, 0, 100000, 80000, '1590336129gs1016-1.jpg', 1, '<p>Chất liệu: Lụa H&agrave;n Size M, L, XL CHỌN SIZE: + Size M: 46-52kg + Size L: 53-57kg +Size XL: 58-62kg Kiểu D&aacute;ng :Form chuẩn ph&ugrave; hợp với v&oacute;c d&aacute;ng phụ nữ Việt Nam..</p>\r\n'),
(52, 'Áo thun nữ cao cấp M79', 'ao-thun-nu-cao-cap-m79', 15, 0, 99000, 0, '1590336220m79-1.jpg', 1, '<p>Chất liệu: thun cotton 4 chiều co gi&atilde;n tốt, thấm h&uacute;t mồ h&ocirc;i hiệu quả K&iacute;ch thước: Size M, Size L Size M: 43-54kg. D&agrave;i 64cm Size L: 55-64kg. D&agrave;i 68cm D&agrave;i tay 23cm...</p>\r\n'),
(53, 'Jum dài ống suông cổ đổ kẽ sọc xinh xắn sành điệu cá tính TJ1055', 'jum-dai-ong-suong-co-do-ke-soc-xinh-xan-sanh-dieu-ca-tinh-tj1055', 21, 0, 320000, 0, '1590396534tj1055-3.jpg', 1, '																<p>Chất liệu:  Vãi Đũi Kích thước: Size M, Size L, Size XL Size M: Eo 66-71cm Size L: Eo 72-76cm Size XL: Eo 77-80cm...</p>\r\n														'),
(54, 'Jum short chấm bi to nhỏ phối đen thắt nơ eo xinh xắn TJ1062', 'jum-short-cham-bi-to-nho-phoi-den-that-no-eo-xinh-xan-tj1062', 21, 0, 29000, 0, '1590397948tj1062-2.jpg', 1, '<p>Chất liệu: Vải Mango K&iacute;ch thước: Size M, Size L, Size XL Size M: Eo 66-71cm Size L: Eo 72-76cm Size XL: Eo 77-80cm Kiểu D&aacute;ng :Form chuẩn ph&ugrave; hợp với v&oacute;c d&aacute;ng phụ nữ Việt Nam Sản Xuất : Sản xuất trực tiếp tại xưởng - h&agrave;ng Việt Nam Xuất Khẩu...</p>\r\n'),
(55, 'Giày gót Mika tròn quai kim tuyến G3110', 'giay-got-mika-tron-quai-kim-tuyen-g3110', 19, 0, 260000, 0, '1590398022g3110-den-1.jpg', 1, '<p>Gi&agrave;y g&oacute;t Mika tr&ograve;n quai kim tuyến Gi&agrave;y được thiết kế &ocirc;m ch&acirc;n, được l&agrave;m từ chất liệu kim tuyến lấp l&aacute;nh, gi&uacute;p tăng vẻ đẹp v&agrave; sang trọng của đ&ocirc;i ch&acirc;n. C&oacute; 2 m&agrave;u kim tuyến đen v&agrave; v&agrave;ng l&agrave;m nổi bật đ&ocirc;i ch&acirc;n của bạn. Tạo n&ecirc;n 1 vẻ đẹp mềm mại v&agrave; quyến rũ G&oacute;t bằng chất liệu Mika trong...</p>\r\n'),
(56, 'Giày cao gót phối màu 7cm G3113', 'giay-cao-got-phoi-mau-7cm-g3113', 19, 0, 260000, 0, '1590398093g3113-1.jpg', 1, '<p>Gi&agrave;y cao g&oacute;t phối m&agrave;u g&oacute;t 7cm. Gi&agrave;y được l&agrave;m từ chất liệu da mờ cao cấp đi &ecirc;m ch&acirc;n. Phối m&agrave;u h&agrave;i h&ograve;a tạo n&ecirc;n vẻ đẹp của đ&ocirc;i ch&acirc;n bạn. Gi&agrave;y được thiết kế kiều b&iacute;t mũi thanh lịch trang nh&atilde;. G&oacute;t cao vừa phải gi&uacute;p bạn dễ d&agrave;ng di chuyển cũng như t&ocirc;n th&ecirc;m đ&aacute;ng kể chiều cao...</p>\r\n');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`) VALUES
(45, 'tranhoan', 'kh@gmail.com', '123', '123', 'adb');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Chỉ mục cho bảng `img_pro`
--
ALTER TABLE `img_pro`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_or` (`id_user`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_or` (`id_order`),
  ADD KEY `fk_detail_pro` (`id_pro`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `fk_pro_cate` (`id_cate`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `img_pro`
--
ALTER TABLE `img_pro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user_or` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_detail_or` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `fk_detail_pro` FOREIGN KEY (`id_pro`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_pro_cate` FOREIGN KEY (`id_cate`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
