<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 1) {
    echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
    exit();
}

include_once('App/Controllers/cPhong.php');
$p = new controlPhong();

$maPhong = $_GET['maPhong'] ?? null;

if(!$maPhong) {
    echo "<script>alert('Không tìm thấy phòng.'); window.location.href='index.php?page=dsphong';</script>";
    exit();
}

$kq = $p->get01Phong($maPhong);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy phòng.'); window.location.href='index.php?page=dsphong';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4"
        onclick="window.location.href='index.php?page=dsphong'">
    <i class="bi bi-arrow-left"></i> Quay lại
</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">
                Thông tin chi tiết phòng
            </h3>

            <!-- Số phòng -->
            <div class="mb-3">
                <label class="form-label fw-medium">Số phòng</label>
                <input type="text" value="<?= $r['soPhong'] ?>" class="form-control" disabled>
            </div>

            <!-- Số người -->
            <div class="mb-3">
                <label class="form-label fw-medium">Số người</label>
                <input type="text" value="<?= $r['soNguoi'] ?>" class="form-control" disabled>
            </div>

            <!-- Người thuê -->
            <div class="mb-3">
                <label class="form-label fw-medium">Người thuê</label>
                <input type="text"
                       value="<?= $r['hoTen'] ?? 'Chưa có người thuê' ?>"
                       class="form-control" disabled>
            </div>

            <!-- Giá phòng -->
            <div class="mb-3">
                <label class="form-label fw-medium">Giá phòng (VNĐ)</label>
                <input type="text"
                       value="<?= number_format($r['giaPhong']) ?>"
                       class="form-control" disabled>
            </div>

            <!-- Tiền điện -->
            <div class="mb-3">
                <label class="form-label fw-medium">Tiền điện (VNĐ)</label>
                <input type="text"
                       value="<?= number_format($r['tienDien']) ?>"
                       class="form-control" disabled>
            </div>

            <!-- Tiền nước -->
            <div class="mb-3">
                <label class="form-label fw-medium">Tiền nước (VNĐ)</label>
                <input type="text"
                       value="<?= number_format($r['tienNuoc']) ?>"
                       class="form-control" disabled>
            </div>

            <!-- Trạng thái -->
            <div class="mb-3">
                <label class="form-label fw-medium">Trạng thái</label>
                <input type="text"
                       value="<?= $r['trangThai'] == 'trong' ? 'Trống' : 'Đang thuê' ?>"
                       class="form-control" disabled>
            </div>
        </div>
    </div>
</div>
