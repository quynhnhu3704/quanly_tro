<?php
include_once('App/Models/mKhieuNai.php');

class controlKhieuNai {
    // Người thuê xem danh sách và form gửi
    public function indexKhach() {
        $m = new modelKhieuNai();
        $dsPhieu = $m->getPhieuCuaToi($_SESSION['maNguoiDung']);
        include_once('App/Views/khieunai/index_khach.php');
    }

    // Chủ trọ xem toàn bộ phiếu
    public function indexChu() {
        $m = new modelKhieuNai();
        $dsPhieu = $m->getAllPhieu();
        include_once('App/Views/khieunai/index_chu.php');
    }

    // Xử lý gửi phiếu có ảnh
    public function xuLyGuiPhieu() {
        if(isset($_POST['btnGuiPhieu'])) {
            $tieuDe = $_POST['tieuDe'];
            $noiDung = $_POST['noiDung'];
            $hinhAnh = "";

            if(isset($_FILES['anhPhanAnh']) && $_FILES['anhPhanAnh']['name'] != "") {
                // 1. ĐỊNH NGHĨA ĐƯỜNG DẪN THƯ MỤC
                $dir = "public/images/feedback/";

                // 2. TỰ ĐỘNG TẠO THƯ MỤC NẾU CHƯA CÓ
                // is_dir check xem folder tồn tại chưa, mkdir sẽ tạo folder mới
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true); 
                }

                // 3. XỬ LÝ FILE
                $file_name = $_FILES['anhPhanAnh']['name'];
                $tmp_name = $_FILES['anhPhanAnh']['tmp_name'];
                $hinhAnh = time() . "_" . $file_name;
                
                move_uploaded_file($tmp_name, $dir . $hinhAnh);
            }

            $m = new modelKhieuNai();
            $m->guiPhieu($_SESSION['maNguoiDung'], $tieuDe, $noiDung, $hinhAnh);
            echo "<script>alert('Gửi thành công!'); window.location.href='index.php?page=khieunai';</script>";
        }
    }

    // Chủ trọ trả lời
    public function xuLyPhanHoi() {
        if(isset($_POST['btnTraLoi'])) {
            $maPhieu = $_POST['maPhieu'];
            $noiDung = $_POST['noiDungPhanHoi'];
            $m = new modelKhieuNai();
            $m->phanHoiPhieu($maPhieu, $noiDung);
            echo "<script>alert('Đã gửi phản hồi cho khách!'); window.location.href='index.php';</script>";
        }
    }
}
?>