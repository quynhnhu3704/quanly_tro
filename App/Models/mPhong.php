<?php
include_once('mketnoi.php');

class modelPhong {
    public function selectAllPhong() {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM phong p
                    LEFT JOIN nguoidung nd ON nd.maNguoiDung = p.maNguoiThue";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01Phong($maPhong) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM phong p
                    LEFT JOIN nguoidung nd ON nd.maNguoiDung = p.maNguoiThue
                    WHERE maPhong = $maPhong";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchPhong($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM phong p
                    LEFT JOIN nguoidung nd ON nd.maNguoiDung = p.maNguoiThue
                    WHERE hoTen LIKE N'%$keyword%'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function selectPhongTheoTrangThai($trangThai) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM phong p
                    LEFT JOIN nguoidung nd ON nd.maNguoiDung = p.maNguoiThue
                    WHERE trangThai = N'$trangThai'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>