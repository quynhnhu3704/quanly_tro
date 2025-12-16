<!-- App/Models/mNguoiDung.php -->
<?php
include_once('mketnoi.php');

class modelNguoiDung {
    public function mLogin($tenDangNhap, $matKhau) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nguoidung WHERE tenDangNhap = N'$tenDangNhap' AND matKhau = N'$matKhau'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function mCheckTenDangNhap($tenDangNhap) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nguoidung WHERE tenDangNhap = N'$tenDangNhap'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function mRegis($hoTen, $tenDangNhap, $matKhau, $soDienThoai, $email) {
        $p = new clsKetNoi();
        $truyvan = "INSERT INTO nguoidung(hoTen, tenDangNhap, matKhau, soDienThoai, email, maVaiTro)
                    VALUES(N'$hoTen', N'$tenDangNhap', N'$matKhau', N'$soDienThoai', N'$email', 2)";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function selectAllNguoiDung() {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nguoidung nd
                    LEFT JOIN vaitro vt ON vt.maVaiTro = nd.maVaiTro
                    ORDER BY tenDangNhap";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function searchNguoiDung($keyword) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nguoidung nd
                    LEFT JOIN vaitro vt ON vt.maVaiTro = nd.maVaiTro
                    WHERE hoTen LIKE N'%$keyword%'";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }

    public function select01NguoiDung($maNguoiDung) {
        $p = new clsKetNoi();
        $truyvan = "SELECT * FROM nguoidung nd
                    LEFT JOIN vaitro vt ON vt.maVaiTro = nd.maVaiTro
                    WHERE maNguoiDung = $maNguoiDung";
        $con = $p->moketnoi();
        $kq = mysqli_query($con, $truyvan);
        $p->dongketnoi($con);
        return $kq;
    }
}
?>