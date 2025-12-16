<!-- App/Controllers/cNguoiDung.php -->
<?php
include_once('App/Models/mNguoiDung.php');

class controlNguoiDung {
    public function cLogin($tenDangNhap, $matKhau) {
        $p = new modelNguoiDung();
        $matKhau = md5($matKhau);
        $kq = $p->mLogin($tenDangNhap, $matKhau);

        if(!$kq) {
            echo "<script>alert('Không thể kết nối đến hệ thống. Vui lòng thử lại sau.')</script>";
        } else if($kq->num_rows > 0) {
            $r = $kq->fetch_assoc();
            
            $_SESSION['login'] = true;
            $_SESSION['maVaiTro'] = $r['maVaiTro'];
            $_SESSION['tenDangNhap'] = $r['tenDangNhap'];
            $_SESSION['maNguoiDung'] = $r['maNguoiDung'];
            echo "<script>alert('Đăng nhập thành công! Chào mừng bạn trở lại.'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng kiểm tra và thử lại.')</script>";
        }
    }

    public function cRegis($hoTen, $tenDangNhap, $matKhau, $soDienThoai, $email) {
        $p = new modelNguoiDung();
        $matKhau = md5($matKhau);

        $kq = $p->mCheckTenDangNhap($tenDangNhap);

        if ($kq->num_rows > 0) {
            echo "<script>alert('Tài khoản đã tồn tại!')</script>";
        } else {
            $kq = $p->mRegis($hoTen, $tenDangNhap, $matKhau, $soDienThoai, $email);
            if ($kq) {
                $_SESSION['regis'] = true;
                echo "<script>
                    alert('Đăng ký thành công!');
                    window.location.href='index.php?page=dangnhap';
                </script>";
            } else {
                echo "<script>alert('Đăng ký thất bại!')</script>";
            }
        }
    }

    public function getAllNguoiDung() {
        $p = new modelNguoiDung();
        $kq = $p->selectAllNguoiDung();

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function searchNguoiDung($keyword) {
        $p = new modelNguoiDung();
        $kq = $p->searchNguoiDung($keyword);

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function get01NguoiDung($maNguoiDung) {
        $p = new modelNguoiDung();
        $kq = $p->select01NguoiDung($maNguoiDung);
        return $kq;
    }
}
?>