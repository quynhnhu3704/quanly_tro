<?php
include_once('App/Models/mHoaDon.php');
include_once('App/Models/mPhong.php');

class controlHoaDon {
    
    // Hiển thị form lập hóa đơn
    public function hienThiFormLapHoaDon() {
        // Lấy danh sách phòng ĐANG CÓ NGƯỜI THUÊ để đổ vào Select box
        $mPhong = new modelPhong();
        $dsPhong = $mPhong->selectPhongTheoTrangThai('dangthue'); 
        
        include_once('App/Views/hoadon/laphoadon.php');
    }

    // Xử lý khi bấm nút "Lưu Hóa Đơn"
    public function xuLyLapHoaDon() {
        if(isset($_POST['btnLuuHoaDon'])) {
            $maPhong = $_POST['maPhong'];
            $thang = $_POST['thang'];
            $nam = $_POST['nam'];
            
            // Xử lý tiền (bỏ dấu phẩy nếu có)
            $tienPhong = str_replace(',', '', $_POST['tienPhong']);
            $tienDien = str_replace(',', '', $_POST['tienDien']);
            $tienNuoc = str_replace(',', '', $_POST['tienNuoc']);
            
            $tongTien = $tienPhong + $tienDien + $tienNuoc;
            $noiDung = "Tiền phòng tháng $thang/$nam";

            $m = new modelHoaDon();

            // Kiểm tra trùng
            if($m->checkHoaDonTonTai($maPhong, $thang, $nam)) {
                echo "<script>alert('Lỗi: Hóa đơn tháng $thang/$nam của phòng này ĐÃ TỒN TẠI!'); window.history.back();</script>";
            } else {
                $kq = $m->insertHoaDon($maPhong, $thang, $nam, $tienPhong, $tienDien, $tienNuoc, $tongTien, $noiDung);
                if($kq) {
                    echo "<script>alert('Lập hóa đơn thành công!'); window.location.href='index.php?page=hoadon';</script>";
                } else {
                    echo "<script>alert('Lỗi hệ thống, vui lòng thử lại.');</script>";
                }
            }
        }
    }
}
?>