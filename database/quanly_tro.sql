-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 17, 2025 at 08:46 AM
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
-- Database: `quanly_tro`
--

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `maHoaDon` int(11) NOT NULL,
  `maPhong` int(11) NOT NULL,
  `thang` int(2) NOT NULL,
  `nam` int(4) NOT NULL,
  `tienPhong` int(11) NOT NULL DEFAULT 0,
  `tienDien` int(11) NOT NULL DEFAULT 0,
  `tienNuoc` int(11) NOT NULL DEFAULT 0,
  `tongTien` int(11) NOT NULL DEFAULT 0,
  `trangThai` varchar(50) DEFAULT 'ChuaThanhToan',
  `maGiaoDichVNP` varchar(255) DEFAULT NULL,
  `ngayThanhToan` datetime DEFAULT NULL,
  `noiDung` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`maHoaDon`, `maPhong`, `thang`, `nam`, `tienPhong`, `tienDien`, `tienNuoc`, `tongTien`, `trangThai`, `maGiaoDichVNP`, `ngayThanhToan`, `noiDung`) VALUES
(1, 10, 12, 2025, 1800000, 150000, 80000, 2030000, 'DaThanhToan', '15349614', '2025-12-17 07:38:08', 'Tiền phòng tháng 12/2025'),
(2, 11, 12, 2025, 1700000, 120000, 60000, 1880000, 'ChuaThanhToan', NULL, NULL, 'Tiền phòng tháng 12/2025'),
(3, 10, 7, 2025, 1800000, 120000, 50000, 1970000, 'DaThanhToan', 'TEST_HISTORY_07', '2025-07-05 10:00:00', 'Tiền phòng tháng 7/2025'),
(4, 10, 8, 2025, 1800000, 150000, 80000, 2030000, 'DaThanhToan', 'TEST_HISTORY_08', '2025-08-04 14:30:00', 'Tiền phòng tháng 8/2025'),
(5, 10, 9, 2025, 1800000, 140000, 60000, 2000000, 'DaThanhToan', 'TEST_HISTORY_09', '2025-09-05 09:15:00', 'Tiền phòng tháng 9/2025'),
(6, 10, 10, 2025, 1800000, 110000, 40000, 1950000, 'DaThanhToan', 'TEST_HISTORY_10', '2025-10-03 16:45:00', 'Tiền phòng tháng 10/2025'),
(7, 10, 11, 2025, 1800000, 130000, 70000, 2000000, 'ChuaThanhToan', NULL, NULL, 'Tiền phòng tháng 11/2025'),
(8, 10, 1, 2025, 1800000, 200000, 12000, 2012000, 'DaThanhToan', '15349865', '2025-12-17 08:46:20', 'Tiền phòng tháng 1/2025');

-- --------------------------------------------------------

--
-- Table structure for table `khieunai`
--

CREATE TABLE `khieunai` (
  `maPhieu` int(11) NOT NULL,
  `maNguoiDung` int(11) NOT NULL,
  `tieuDe` varchar(255) NOT NULL,
  `noiDung` text NOT NULL,
  `hinhAnh` varchar(255) DEFAULT NULL,
  `ngayGui` datetime DEFAULT current_timestamp(),
  `phanHoi` text DEFAULT NULL,
  `ngayPhanHoi` datetime DEFAULT NULL,
  `trangThai` varchar(50) DEFAULT 'ChoXuLy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `khieunai`
--

INSERT INTO `khieunai` (`maPhieu`, `maNguoiDung`, `tieuDe`, `noiDung`, `hinhAnh`, `ngayGui`, `phanHoi`, `ngayPhanHoi`, `trangThai`) VALUES
(1, 2, 'hỏng bóng đèn ạ', 'aaaaaaaaaaaaaaaaa', '1765956832_flashhh.png', '2025-12-17 14:33:52', 'oke em nhé', '2025-12-17 08:34:24', 'DaXuLy'),
(2, 2, 'vòi nước bị hỏng ạ ', 'huhu', '1765957094_flashhh.png', '2025-12-17 14:38:14', 'kệ em', '2025-12-17 08:38:44', 'DaXuLy');

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `maNguoiDung` int(11) NOT NULL,
  `tenDangNhap` varchar(255) NOT NULL,
  `matKhau` varchar(255) NOT NULL,
  `hoTen` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `soDienThoai` varchar(255) DEFAULT NULL,
  `maVaiTro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`maNguoiDung`, `tenDangNhap`, `matKhau`, `hoTen`, `email`, `soDienThoai`, `maVaiTro`) VALUES
(1, 'chutro', '202cb962ac59075b964b07152d234b70', 'Nguyễn Chủ Trọ', 'chutro@gmail.com', '0901000001', 1),
(2, 'thuetro', '202cb962ac59075b964b07152d234b70', 'Trần Thuê Trọ', 'thuetro@gmail.com', '0902000001', 2),
(3, 'thuetro2', '202cb962ac59075b964b07152d234b70', 'Lê Người Thuê', 'thuetro2@gmail.com', '0903000001', 2),
(5, 'quynhnhu', '202cb962ac59075b964b07152d234b70', 'Nguyễn Quỳnh Như', 'quynhnhu@gmail.com', '0984624123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `maPhong` int(11) NOT NULL,
  `soPhong` varchar(20) NOT NULL,
  `tenDay` varchar(50) DEFAULT 'A',
  `soNguoi` int(11) NOT NULL DEFAULT 0,
  `giaPhong` int(11) NOT NULL,
  `trangThai` varchar(20) NOT NULL,
  `maNguoiThue` int(11) DEFAULT NULL,
  `tienDien` int(11) NOT NULL DEFAULT 0,
  `tienNuoc` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`maPhong`, `soPhong`, `tenDay`, `soNguoi`, `giaPhong`, `trangThai`, `maNguoiThue`, `tienDien`, `tienNuoc`) VALUES
(9, '101', 'A', 0, 1500000, 'trong', NULL, 0, 0),
(10, '102', 'A', 2, 1800000, 'dangthue', 2, 150000, 80000),
(11, '103', 'B', 1, 1700000, 'dangthue', 3, 120000, 60000),
(12, '104', 'B', 0, 1500000, 'trong', NULL, 0, 0),
(13, '201', 'B', 0, 1600000, 'trong', NULL, 0, 0),
(14, '202', 'B', 0, 1600000, 'trong', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vaitro`
--

CREATE TABLE `vaitro` (
  `maVaiTro` int(11) NOT NULL,
  `tenVaiTro` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vaitro`
--

INSERT INTO `vaitro` (`maVaiTro`, `tenVaiTro`) VALUES
(1, 'Chủ trọ'),
(2, 'Người thuê trọ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`maHoaDon`),
  ADD KEY `fk_hoadon_phong` (`maPhong`);

--
-- Indexes for table `khieunai`
--
ALTER TABLE `khieunai`
  ADD PRIMARY KEY (`maPhieu`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`maNguoiDung`),
  ADD KEY `fk_nguoidung_vaitro` (`maVaiTro`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`maPhong`),
  ADD KEY `fk_phong_nguoithue` (`maNguoiThue`);

--
-- Indexes for table `vaitro`
--
ALTER TABLE `vaitro`
  ADD PRIMARY KEY (`maVaiTro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `maHoaDon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `khieunai`
--
ALTER TABLE `khieunai`
  MODIFY `maPhieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `maNguoiDung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `phong`
--
ALTER TABLE `phong`
  MODIFY `maPhong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vaitro`
--
ALTER TABLE `vaitro`
  MODIFY `maVaiTro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `fk_hoadon_phong` FOREIGN KEY (`maPhong`) REFERENCES `phong` (`maPhong`) ON DELETE CASCADE;

--
-- Constraints for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `fk_nguoidung_vaitro` FOREIGN KEY (`maVaiTro`) REFERENCES `vaitro` (`maVaiTro`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `phong`
--
ALTER TABLE `phong`
  ADD CONSTRAINT `fk_phong_nguoithue` FOREIGN KEY (`maNguoiThue`) REFERENCES `nguoidung` (`maNguoiDung`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
