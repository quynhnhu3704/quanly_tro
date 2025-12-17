<?php
include_once('mketnoi.php');

class modelHoaDon {
    // Lấy hóa đơn của một người dùng (dựa vào phòng họ đang thuê)
    public function getHoaDonCuaNguoiDung($maNguoiDung) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        // Join bảng hóa đơn với phòng, kiểm tra maNguoiThue
        $truyvan = "SELECT hd.*, p.soPhong, p.tenDay 
                    FROM hoadon hd
                    JOIN phong p ON hd.maPhong = p.maPhong
                    WHERE p.maNguoiThue = '$maNguoiDung'
                    ORDER BY hd.nam DESC, hd.thang DESC";
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    // Lấy chi tiết 1 hóa đơn
    public function get01HoaDon($maHoaDon) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "SELECT * FROM hoadon WHERE maHoaDon = '$maHoaDon'";
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return mysqli_fetch_assoc($kq);
    }

    // Cập nhật trạng thái sau khi thanh toán thành công
    public function updateThanhToan($maHoaDon, $maGiaoDich) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $ngayGio = date('Y-m-d H:i:s');
        $truyvan = "UPDATE hoadon 
                    SET trangThai = 'DaThanhToan', 
                        maGiaoDichVNP = '$maGiaoDich',
                        ngayThanhToan = '$ngayGio'
                    WHERE maHoaDon = '$maHoaDon'";
        $result = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $result;
    }


    // 1. Kiểm tra xem hóa đơn tháng này của phòng này đã có chưa
    public function checkHoaDonTonTai($maPhong, $thang, $nam) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $sql = "SELECT * FROM hoadon WHERE maPhong = '$maPhong' AND thang = '$thang' AND nam = '$nam'";
        $kq = mysqli_query($con, $sql);
        $p->dongketnoi($con);
        return mysqli_num_rows($kq) > 0;
    }

    // 2. Thêm hóa đơn mới
    public function insertHoaDon($maPhong, $thang, $nam, $tienPhong, $tienDien, $tienNuoc, $tongTien, $noiDung) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        
        $sql = "INSERT INTO hoadon (maPhong, thang, nam, tienPhong, tienDien, tienNuoc, tongTien, trangThai, noiDung, ngayThanhToan) 
                VALUES ('$maPhong', '$thang', '$nam', '$tienPhong', '$tienDien', '$tienNuoc', '$tongTien', 'ChuaThanhToan', N'$noiDung', NULL)";
        
        $kq = mysqli_query($con, $sql);
        $p->dongketnoi($con);
        return $kq;
    }

    // Hàm lấy chi tiết hóa đơn để in (bao gồm tên khách và số phòng)
    public function getChiTietHoaDonDeIn($maHoaDon) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        
        // Câu lệnh SQL JOIN để lấy tên người dùng và số phòng
        $sql = "SELECT h.*, n.hoTen, p.soPhong, p.tenDay 
                FROM hoadon h 
                JOIN phong p ON h.maPhong = p.maPhong 
                JOIN nguoidung n ON p.maNguoiThue = n.maNguoiDung 
                WHERE h.maHoaDon = '$maHoaDon'";
                
        $kq = mysqli_query($con, $sql);
        $p->dongketnoi($con);
        
        if($kq && mysqli_num_rows($kq) > 0) {
            return mysqli_fetch_assoc($kq); // Trả về 1 mảng chứa dữ liệu hóa đơn
        }
        return false;
    }
}
?>