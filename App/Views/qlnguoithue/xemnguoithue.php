<?php
if(!isset($_SESSION['login'])){
    echo "<script>alert('Vui lòng đăng nhập');location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 1) {
    echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
    exit();
}

include_once('App/Controllers/cNguoiDung.php');
$p = new controlNguoiDung();
$maNguoiDung = $_GET['maNguoiDung'] ?? null;
if(!$maNguoiDung){
    echo "<script>alert('Không tìm thấy người thuê');location.href='index.php?page=dsnguoithue'</script>";
    exit();
}
$kq = $p->get01NguoiDung($maNguoiDung);
if(!$kq || $kq->num_rows == 0){
    echo "<script>alert('Dữ liệu không tồn tại');location.href='index.php?page=dsnguoithue'</script>";
    exit();
}
$r = $kq->fetch_assoc();
?>

<button class="btn btn-outline-primary ms-4 my-4" onclick="location.href='index.php?page=dsnguoithue'">
    <i class="bi bi-arrow-left"></i> Quay lại
</button>

<div class="container d-flex justify-content-center mb-5">
    <div class="card-na" style="max-width:36rem;width:100%">
        <div class="card-body p-4">
            <h4 class="text-center fw-bold text-primary mb-4">Thông tin người thuê</h4>

            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input class="form-control" value="<?= $r['hoTen'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Tên đăng nhập</label>
                <input class="form-control" value="<?= $r['tenDangNhap'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" value="<?= $r['email'] ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input class="form-control" value="<?= $r['soDienThoai'] ?>" disabled>
            </div>
        </div>
    </div>
</div>
