<!-- App/Models/mketnoi.php -->
<?php
class clsKetNoi {
    public function moketnoi() {
        $host = 'localhost';
        $user = 'root';
        $pwd = '';
        $db = 'quanly_tro';
        
        $conn = mysqli_connect($host, $user, $pwd, $db);

        mysqli_set_charset($conn, 'utf8');
        return $conn;
    }

    public function dongketnoi($conn) {
        $conn->close();
    }
}
?>