<?php
include_once('App/Controllers/cPhong.php');
$p = new controlPhong();

if (isset($_GET['maPhong'])) {
    $maPhong = $_GET['maPhong'];
    $kq = $p->get01Phong($maPhong);
} else {
    echo "<h4>Không tìm thấy phòng.</h4>";
    exit();
}

if ($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<h4>Dữ liệu phòng không tồn tại.</h4>";
    exit();
}
?>

<div class="container my-5">
    <button type="button" class="btn btn-outline-primary mb-4"
            onclick="window.history.back()">
        ← Quay lại
    </button>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card p-4">
                <h3 class="fw-bold text-primary mb-4">
                    Phòng số <?= $r['soPhong'] ?>
                </h3>

                <div class="row g-3">
                    <div class="col-md-6">
                        <strong>Số người:</strong>
                        <?= $r['soNguoi'] ?>
                    </div>

                    <div class="col-md-6">
                        <strong>Giá phòng:</strong>
                        <?= number_format($r['giaPhong']) ?> VNĐ
                    </div>

                    <div class="col-md-6">
                        <strong>Tiền điện:</strong>
                        <?= number_format($r['tienDien']) ?> VNĐ
                    </div>

                    <div class="col-md-6">
                        <strong>Tiền nước:</strong>
                        <?= number_format($r['tienNuoc']) ?> VNĐ
                    </div>

                    <div class="col-md-6">
                        <strong>Trạng thái:</strong>
                        <?php
                        echo $r['trangThai'] == 'trong'
                            ? '<span class="badge bg-success">Trống</span>'
                            : '<span class="badge bg-warning text-dark">Đang thuê</span>';
                        ?>
                    </div>

                    <div class="col-md-6">
                        <strong>Người thuê:</strong>
                        <?= $r['hoTen'] ?? '<span class="text-muted">Chưa có</span>' ?>
                    </div>

                    <div class="col-md-6">
                        <strong>Số điện thoại:</strong>
                        <?= $r['soDienThoai'] ?? '<span class="text-muted">—</span>' ?>
                    </div>

                    <div class="col-md-6">
                        <strong>Email:</strong>
                        <?= $r['email'] ?? '<span class="text-muted">—</span>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
