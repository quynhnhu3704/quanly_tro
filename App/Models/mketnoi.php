<?php
class clsKetNoi {
    public function moketnoi() {
        $host = 'localhost';
        $user = 'root';
        $pwd = '';
        $db = 'quanly_tro';
        
        // Tắt báo lỗi warning mặc định của PHP để tự xử lý
        $driver = new mysqli_driver();
        $driver->report_mode = MYSQLI_REPORT_OFF;

        // TH1: Thử kết nối Port mặc định (3306) cho bạn của bạn
        $conn = @mysqli_connect($host, $user, $pwd, $db, 3306);

        // Nếu TH1 thất bại, thử TH2: Port 3307 cho bạn
        if (!$conn) {
            $conn = @mysqli_connect($host, $user, $pwd, $db, 3307);
        }

        // Nếu cả 2 đều tạch
        if (!$conn) {
            die("Chịu chết, không kết nối được cả port 3306 lẫn 3307: " . mysqli_connect_error());
        }

        mysqli_set_charset($conn, 'utf8');
        return $conn;
    }

    public function dongketnoi($conn) {
        if ($conn) $conn->close();
    }
}
?>