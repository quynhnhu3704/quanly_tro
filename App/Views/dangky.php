<div class="container d-flex justify-content-center align-items-center my-5">
    <div class="card-na border-0" style="max-width: 28em; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Đăng ký tài khoản</h3>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label fw-medium">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" name="hoTen" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">Tên đăng nhập <span class="text-danger">*</span></label>
                    <input type="text" name="tenDangNhap" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">Mật khẩu <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" name="matKhau" id="matKhau" class="form-control" required>
                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;"><i class="bi bi-eye-slash"></i></span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium">Số điện thoại</label>
                    <input type="text" name="soDienThoai" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <button type="submit" name="btndangky" class="btn btn-primary w-100">
                    Đăng ký
                </button>

                <div class="text-center mt-3">
                    <a href="index.php?page=dangnhap" class="text-decoration-none">
                        Đã có tài khoản? Đăng nhập
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['btndangky'])) {
    include_once('App/Controllers/cNguoiDung.php');
    $p = new controlNguoiDung();

    $hoTen        = trim($_POST['hoTen']);
    $tenDangNhap  = trim($_POST['tenDangNhap']);
    $matKhau      = trim($_POST['matKhau']);
    $soDienThoai  = trim($_POST['soDienThoai']);
    $email  = trim($_POST['email']);

    $p->cRegis($hoTen, $tenDangNhap, $matKhau, $soDienThoai, $email);
}
?>

<script>
// Con mắt ẩn hiện mật khẩu
$(document).ready(function () {
    $('#togglePassword').click(function () {
        const input = $('#matKhau');
        const icon = $(this).find('i');

        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('bi-eye-slash').addClass('bi-eye');
        } else {
            input.attr('type', 'password');
            icon.removeClass('bi-eye').addClass('bi-eye-slash');
        }
    });
});
</script>