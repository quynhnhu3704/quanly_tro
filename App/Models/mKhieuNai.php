<?php
include_once('mketnoi.php');

class modelKhieuNai {
    // Người thuê gửi phiếu
    public function guiPhieu($maNguoiDung, $tieuDe, $noiDung, $hinhAnh) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $sql = "INSERT INTO khieunai (maNguoiDung, tieuDe, noiDung, hinhAnh) 
                VALUES ('$maNguoiDung', N'$tieuDe', N'$noiDung', '$hinhAnh')";
        $kq = mysqli_query($con, $sql);
        $p->dongketnoi($con);
        return $kq;
    }

    // Lấy phiếu của cá nhân (Người thuê)
    public function getPhieuCuaToi($maNguoiDung) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $sql = "SELECT * FROM khieunai WHERE maNguoiDung = '$maNguoiDung' ORDER BY ngayGui DESC";
        $kq = mysqli_query($con, $sql);
        $p->dongketnoi($con);
        return $kq;
    }

    // Lấy tất cả phiếu (Chủ trọ)
    public function getAllPhieu() {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $sql = "SELECT kn.*, nd.hoTen FROM khieunai kn 
                JOIN nguoidung nd ON kn.maNguoiDung = nd.maNguoiDung 
                ORDER BY kn.trangThai ASC, kn.ngayGui DESC";
        $kq = mysqli_query($con, $sql);
        $p->dongketnoi($con);
        return $kq;
    }

    // Chủ trọ phản hồi
    public function phanHoiPhieu($maPhieu, $noiDungPhanHoi) {
        $p = new clsKetNoi();
        $con = $p->moketnoi();
        $ngay = date('Y-m-d H:i:s');
        $sql = "UPDATE khieunai SET phanHoi = N'$noiDungPhanHoi', ngayPhanHoi = '$ngay', trangThai = 'DaXuLy' 
                WHERE maPhieu = '$maPhieu'";
        $kq = mysqli_query($con, $sql);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>