-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 08, 2020 lúc 08:33 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `website-php-mvc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'vu', 'vu@gmail.com', 'vuadmin', 'e10adc3949ba59abbe56e057f20f883e', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandId` int(11) NOT NULL,
  `brandName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'Dell'),
(3, 'SamSung'),
(6, 'Khác'),
(8, 'Lai ASC'),
(9, 'ABC Sách');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `sessionId` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productImage` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `catId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(17, 'Thú cưng'),
(18, 'Hàng điện tử'),
(19, 'Hàng gia dụng'),
(20, 'Sách'),
(25, 'Khác');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_compare`
--

CREATE TABLE `tbl_compare` (
  `compareId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_compare`
--

INSERT INTO `tbl_compare` (`compareId`, `customerId`, `productId`, `productName`, `productPrice`, `productImage`) VALUES
(31, 5, 46, 'Điện Thoại GALAXY', '12999999', 'eb8f29c791.png'),
(32, 5, 50, 'Laptop Dell', '990000', '1c3cc3b6a9.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES
(5, 'vunguyen.vn70000', '123 DCBD', '28', 'Hà Tỉnh', '70000', '(+84) 333752939', 'vunguyen.vn7000@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'Vu', 'hn', 'Bình Dương', 'Nghệ An', '65000', '0924012223', 'abc@123', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `customerId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `productPrice` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `oderDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`orderId`, `productId`, `productName`, `customerId`, `quantity`, `productPrice`, `productImage`, `status`, `oderDate`) VALUES
(22, 50, 'Laptop Dell', 5, 1, '990000', '1c3cc3b6a9.png', 2, '2020-12-08 04:18:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `productId` int(11) NOT NULL,
  `productName` tinytext NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `productDesc` text NOT NULL,
  `productType` int(11) NOT NULL,
  `productPrice` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `productDesc`, `productType`, `productPrice`, `productImage`) VALUES
(45, 'Máy giặc', 18, 3, '<p>M&aacute;y giặc hiệu SAMSUNG</p>', 1, '1999999', '1c0f96131c.png'),
(46, 'Điện Thoại GALAXY', 18, 3, '<ul>\r\n<li>M&agrave;n h&igrave;nh:<span>&nbsp;</span>Ch&iacute;nh: Dynamic AMOLED, Phụ: Super AMOLED, Ch&iacute;nh 7.6\" &amp; Phụ 6.2\", Full HD+</li>\r\n<li>Hệ điều h&agrave;nh:<span>&nbsp;</span>Android 10</li>\r\n<li>Camera sau:<span>&nbsp;</span>Ch&iacute;nh 12 MP &amp; Phụ 12 MP, 12 MP Camera trước:<span>&nbsp;</span>10 MP</li>\r\n<li>CPU:<span>&nbsp;</span>Snapdragon 865+ 8 nh&acirc;n</li>\r\n<li>RAM:<span>&nbsp;</span>12 GB Bộ nhớ trong:<span>&nbsp;</span>256 GB</li>\r\n<li>Thẻ SIM: 1 eSIM &amp; 1 Nano SIM</li>\r\n<li>Dung lượng pin:<span>&nbsp;</span>4500 mAh, c&oacute; sạc nhanh</li>\r\n</ul>', 1, '12999999', 'eb8f29c791.png'),
(50, 'Laptop Dell', 18, 1, '<h1 class=\"name\">Dell G3 3500 70223130 : i5-10300H | 8GB RAM | 256GB SSD + 1TB HDD | GTX 1650 4GB + UHD Graphics 630 | 15.6 FHD IPS 120Hz | WIN 10 | Finger | Black</h1>', 1, '990000', '1c3cc3b6a9.png'),
(51, 'Quạt', 19, 3, '<p>đ&acirc;y l&agrave; c&acirc;y quạt c&oacute; 1 nhưng vẫn c&oacute; 2</p>', 1, '100000', '77ab5453d8.jpg'),
(53, 'Máy ép hoa quả', 19, 1, '<p>Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.&nbsp;Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.&nbsp;Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.Đ&acirc;y l&agrave; m&aacute;y &eacute;p hoa quả nha.</p>', 1, '600000', 'de60b965b3.png'),
(54, 'Wave', 25, 6, '<p><span>Gi&aacute; b&aacute;n xe đ&atilde; bao gồm thuế VAT, kh&ocirc;ng bao gồm thuế trước bạ v&agrave; chi ph&iacute; l&agrave;m giấy tờ, biển số</span><br /><span>Kh&aacute;ch h&agrave;ng nhận xe v&agrave; l&agrave;m thủ tục giấy tờ tại đại l&yacute; ủy nhiệm</span><br /><span>Kh&aacute;ch h&agrave;ng đ&atilde; nhận kh&ocirc;ng được đổi trả (điều kiện đổi trả theo quy định của Honda Việt Nam)</span><br /><span>Đối với đơn h&agrave;ng thanh to&aacute;n trả sau (COD), sau 5 ng&agrave;y nếu kh&aacute;ch h&agrave;ng kh&ocirc;ng đến nhận xe v&agrave; thanh to&aacute;n tại Head/Showroom th&igrave; Đơn h&agrave;ng sẽ tự động hủy</span></p>', 1, '20000', '81ff417822.png'),
(60, 'Máy ảnh Samsung', 18, 3, '<p>m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung,m&aacute;y ảnh SamSung.</p>', 1, '888000999000', 'a1f421ae3e.jpg'),
(61, 'Chó', 17, 8, '<p>Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.Con ch&oacute; sủa g&acirc;uuuuuuuuuuuuuuuuuuuu.</p>', 1, '1000001', '44e395b1d4.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `sliderId` int(11) NOT NULL,
  `sliderName` varchar(255) NOT NULL,
  `sliderImage` varchar(255) NOT NULL,
  `sliderType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`sliderId`, `sliderName`, `sliderImage`, `sliderType`) VALUES
(12, 'Slider 1', '110ce23d0c.jpg', 1),
(13, 'Slider 2', '39c921876a.jpg', 1),
(14, 'Slider 3', 'f5ad343664.jpg', 1),
(16, 'Slider 4', 'd9d3dee0fa.jpg', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `wishlistId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productPrice` varchar(255) NOT NULL,
  `productImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`wishlistId`, `customerId`, `productId`, `productName`, `productPrice`, `productImage`) VALUES
(11, 5, 46, 'Điện Thoại GALAXY', '12999999', 'eb8f29c791.png'),
(12, 5, 50, 'Laptop Dell', '990000', '1c3cc3b6a9.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`catId`);

--
-- Chỉ mục cho bảng `tbl_compare`
--
ALTER TABLE `tbl_compare`
  ADD PRIMARY KEY (`compareId`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderId`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`productId`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`sliderId`);

--
-- Chỉ mục cho bảng `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`wishlistId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `tbl_compare`
--
ALTER TABLE `tbl_compare`
  MODIFY `compareId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `sliderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `wishlistId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
