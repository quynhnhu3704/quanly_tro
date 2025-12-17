<?php
include_once('App/Models/mHoaDon.php');
include_once('App/Libs/VNPAYHelper.php');

class controlThanhToan {
    
    // 1. Hiển thị danh sách hóa đơn cá nhân
    public function xemHoaDonCaNhan() {
        if(!isset($_SESSION['maNguoiDung'])) {
            echo "<script>alert('Vui lòng đăng nhập!'); window.location='index.php?page=dangnhap';</script>";
            return;
        }
        $m = new modelHoaDon();
        $dsHoaDon = $m->getHoaDonCuaNguoiDung($_SESSION['maNguoiDung']);
        include_once('App/Views/hoadon/dshoadon.php');
    }

    // 2. Tạo URL thanh toán và chuyển hướng sang VNPAY
    public function taoThanhToanVNPAY() {
        if(isset($_GET['id'])) {
            $maHoaDon = $_GET['id'];
            $m = new modelHoaDon();
            $hd = $m->get01HoaDon($maHoaDon);

            if($hd && $hd['trangThai'] == 'ChuaThanhToan') {
                $amount = $hd['tongTien'];
                $order_desc = "Thanh toan hoa don #$maHoaDon";
                $returnUrl = "http://localhost:88/An_QL_PhongTro/quanly_tro/index.php?page=xulyvnpay"; 
                $vnp_TxnRef = $maHoaDon . "_" . time();
                $url = VNPAYHelper::createPaymentUrl($vnp_TxnRef, $amount, $order_desc, $returnUrl);
                header("Location: " . $url);
                exit;
            } else {
                echo "<script>alert('Hóa đơn không hợp lệ hoặc đã thanh toán!'); window.location='index.php?page=hoadon';</script>";
            }
        }
    }

    // --- HÀM IN HÓA ĐƠN ---
    public function inHoaDon() {
        if(isset($_GET['id'])) {
            $maHoaDon = $_GET['id'];
            $m = new modelHoaDon();
            // Lấy thông tin chi tiết (JOIN bảng người dùng/phòng để lấy tên và số phòng)
            $hd = $m->getChiTietHoaDonDeIn($maHoaDon); 
            include_once('App/Views/hoadon/in_hoadon.php');
        }
    }

    // 3. Xử lý kết quả trả về từ VNPAY (ĐÃ CẬP NHẬT ĐỂ TỰ BẬT TRANG IN)
    public function xuLyKetQuaVNPAY() {
        if (isset($_GET['vnp_ResponseCode'])) {
            $vnp_Data = $_GET;
            if (isset($vnp_Data['page'])) {
                unset($vnp_Data['page']);
            }
            
            if (VNPAYHelper::checkSignature($vnp_Data)) {
                if ($_GET['vnp_ResponseCode'] == '00') {
                    // Tách lấy mã hóa đơn gốc
                    $vnp_TxnRef = $_GET['vnp_TxnRef']; 
                    $parts = explode('_', $vnp_TxnRef);
                    $maHoaDon = $parts[0]; 
                    
                    $maGD = $_GET['vnp_TransactionNo'];
                    $m = new modelHoaDon();
                    $m->updateThanhToan($maHoaDon, $maGD);
                    
                    // --- SỬA Ở ĐÂY: Bật popup in và chuyển hướng trang gốc ---
                    echo "<script>
                        alert('Thanh toán thành công! Hệ thống sẽ mở hóa đơn để bạn in.');
                        // Mở trang in hóa đơn ở tab mới
                        window.open('index.php?page=inhoadon&id=$maHoaDon', '_blank');
                        // Chuyển trang hiện tại về danh sách hóa đơn
                        window.location.href='index.php?page=hoadon';
                    </script>";
                } else {
                    echo "<script>alert('Giao dịch thất bại hoặc bị hủy.'); window.location='index.php?page=hoadon';</script>";
                }
            } else {
                echo "<script>alert('Lỗi xác thực chữ ký!'); window.location='index.php?page=hoadon';</script>";
            }
        }
    }
}
?>