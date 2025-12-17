<?php
include_once('mketnoi.php');

class modelPhong {
    // 1. Lấy tất cả phòng
    public function selectAllPhong() {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM phong p LEFT JOIN nguoidung nd ON nd.maNguoiDung = p.maNguoiThue";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    // 2. Lấy 1 phòng chi tiết
    public function select01Phong($maPhong) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM phong p LEFT JOIN nguoidung nd ON nd.maNguoiDung = p.maNguoiThue WHERE maPhong = $maPhong";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    // 3. Tìm kiếm phòng
    public function searchPhong($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM phong p LEFT JOIN nguoidung nd ON nd.maNguoiDung = p.maNguoiThue WHERE soPhong LIKE '%$keyword%'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    // 4. Lọc phòng theo trạng thái (HÀM BỊ THIẾU GÂY LỖI NÈ)
    public function selectPhongTheoTrangThai($trangThai) {
        $p = new clsKetNoi();
        // Lấy phòng theo trạng thái (trong hoặc dangthue)
        $truyvan = "SELECT * FROM phong p LEFT JOIN nguoidung nd ON nd.maNguoiDung = p.maNguoiThue WHERE trangThai = '$trangThai'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    // --- CÁC HÀM MỚI (LỌC DÃY) ---

    // 5. Lấy danh sách các Dãy
    public function getDanhSachDay() {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $truyvan = "SELECT DISTINCT tenDay FROM phong WHERE tenDay IS NOT NULL AND tenDay != '' ORDER BY tenDay";
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    // 6. Lọc phòng theo tên Dãy
    public function selectPhongTheoDay($tenDay) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        
        if(empty($tenDay)) {
            $truyvan = "SELECT * FROM phong p LEFT JOIN nguoidung nd ON nd.maNguoiDung = p.maNguoiThue ORDER BY soPhong";
        } else {
            $truyvan = "SELECT * FROM phong p LEFT JOIN nguoidung nd ON nd.maNguoiDung = p.maNguoiThue WHERE tenDay = '$tenDay' ORDER BY soPhong";
        }
        
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>