<?php
include_once('App/Models/mPhong.php');

class controlPhong {
    public function getAllPhong() {
        $p = new modelPhong();
        $kq = $p->selectAllPhong();

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function get01Phong($maThietBi) {
        $p = new modelPhong();
        $kq = $p->select01Phong($maThietBi);
        return $kq;
    }

    public function searchPhong($keyword) {
        $p = new modelPhong();
        $kq = $p->searchPhong($keyword);

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function getPhongTheoTrangThai($trangThai) {
        $p = new modelPhong();
        $kq = $p->selectPhongTheoTrangThai($trangThai);

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }
}
?>