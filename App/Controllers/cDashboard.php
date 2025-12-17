<?php
include_once('App/Models/mPhong.php');
include_once('App/Models/mHoaDon.php');

class controlDashboard {
    
    // --- DASHBOARD CHỦ TRỌ ---
    // File: App/Controllers/cDashboard.php

    public function hienThiDashboardChuTro() {
        $mPhong = new modelPhong();
        $mHoaDon = new modelHoaDon();
        
        // 1. Lấy tất cả phòng
        $kq = $mPhong->selectAllPhong();
        
        $totalPhong = 0;
        $trong = 0; 
        $dangThue = 0;
        $dsPhongArray = []; // Mảng chứa dữ liệu để gửi sang View

        if($kq && mysqli_num_rows($kq) > 0) {
            $totalPhong = mysqli_num_rows($kq);
            while($r = mysqli_fetch_assoc($kq)) {
                // Lưu từng dòng dữ liệu vào mảng
                $dsPhongArray[] = $r;

                // Tính toán thống kê
                if($r['trangThai'] == 'trong') $trong++;
                else $dangThue++;
            }
        }
        
        // 2. Doanh thu (Demo logic)
        // Bạn có thể query sum(tongTien) from hoadon where thang = now()
        
        // Gọi View
        include_once('App/Views/dashboard/home_chutro.php');
    }

    // --- DASHBOARD KHÁCH THUÊ ---
    // File: App/Controllers/cDashboard.php

    public function hienThiDashboardKhach() {
        if(!isset($_SESSION['maNguoiDung'])) return;
        
        $mPhong = new modelPhong();
        $mHoaDon = new modelHoaDon();
        
        // 1. Lấy thông tin phòng (Giữ nguyên)
        $dsPhong = $mPhong->selectAllPhong();
        $myRoom = null;
        while($r = mysqli_fetch_assoc($dsPhong)) {
            if($r['maNguoiThue'] == $_SESSION['maNguoiDung']) {
                $myRoom = $r;
                break;
            }
        }
        
        // 2. Lấy TOÀN BỘ hóa đơn để làm Lịch Sử (Thay đổi đoạn này)
        $dsHoaDon = $mHoaDon->getHoaDonCuaNguoiDung($_SESSION['maNguoiDung']);
        
        $latestBill = null;
        $historyBills = []; // Mảng chứa lịch sử

        if($dsHoaDon && mysqli_num_rows($dsHoaDon) > 0) {
            // Lấy tất cả hóa đơn vào mảng
            while($row = mysqli_fetch_assoc($dsHoaDon)) {
                $historyBills[] = $row;
            }
            // Hóa đơn mới nhất là phần tử đầu tiên (do SQL order DESC)
            $latestBill = $historyBills[0];
        }

        // Gọi View
        include_once('App/Views/dashboard/home_khach.php');
    }
}
?>