<!doctype html>
<html lang="vi">
<?php
ob_start();
session_start();
?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Sky - Quản lý phòng trọ</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/jquery-3.7.1.min.js"></script>
    <style>
        body { background-color: #f8f9fc; }
        /* Hiệu ứng hover cho nút chức năng */
        .btn-quick-action {
            transition: all 0.3s;
            border: none;
        }
        .btn-quick-action:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container"> <a class="navbar-brand fw-bold" href="index.php">
                <i class="bi bi-buildings-fill me-2 text-primary"></i>Sky Manager
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
            
            <div id="nav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <?php if(isset($_SESSION['login']) && $_SESSION['login'] == true): ?>
                        <li class="nav-item">
                            <span class="nav-link text-dark fw-bold me-3">
                                Xin chào, <?php echo isset($_SESSION['tenDangNhap']) ? $_SESSION['tenDangNhap'] : 'User'; ?>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-danger btn-sm rounded-pill px-3" href="index.php?page=dangxuat" onclick="return confirm('Đăng xuất?');">
                                <i class="bi bi-box-arrow-right me-1"></i>Đăng xuất
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm px-4 rounded-pill" href="index.php?page=dangnhap">Đăng nhập</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <main>
            <?php
            $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
            switch($page) {
                // --- AUTH ---
                case 'dangnhap': include_once('App/Views/dangnhap.php'); break;
                case 'dangky': include_once('App/Views/dangky.php'); break;
                case 'dangxuat': include_once('App/Views/dangxuat.php'); break;
                case 'thongtincanhan': include_once('App/Views/thongtincanhan.php'); break;

                // --- QUẢN LÝ PHÒNG ---
                case 'dsphong': include_once('App/Views/qlphong/dsphong.php'); break;
                case 'chitietphong':
                case 'xemphong': include_once('App/Views/qlphong/xemphong.php'); break;

                // --- QUẢN LÝ NGƯỜI THUÊ ---
                case 'dsnguoithue': include_once('App/Views/qlnguoithue/dsnguoithue.php'); break;
                case 'xemnguoithue': include_once('App/Views/qlnguoithue/xemnguoithue.php'); break;

                // --- HÓA ĐƠN (CHỦ) ---
                case 'laphoadon':
                    include_once('App/Controllers/cHoaDon.php');
                    $c = new controlHoaDon();
                    $c->hienThiFormLapHoaDon();
                    break;
                case 'xulylaphoadon':
                    include_once('App/Controllers/cHoaDon.php');
                    $c = new controlHoaDon();
                    $c->xuLyLapHoaDon();
                    break;

                case 'khieunai':
                    include_once('App/Controllers/cKhieuNai.php');
                    $c = new controlKhieuNai();
                    if($_SESSION['maVaiTro'] == 1) $c->indexChu();
                    else $c->indexKhach();
                    break;

                case 'xulyguikhieunai':
                    include_once('App/Controllers/cKhieuNai.php');
                    $c = new controlKhieuNai();
                    $c->xuLyGuiPhieu();
                    break;

                case 'xulyphanhoikhieunai':
                    include_once('App/Controllers/cKhieuNai.php');
                    $c = new controlKhieuNai();
                    $c->xuLyPhanHoi();
                    break;

                // --- CHỨC NĂNG KHÁCH ---
                case 'hoadon':
                    include_once('App/Controllers/cThanhToan.php');
                    $c = new controlThanhToan();
                    $c->xemHoaDonCaNhan();
                    break;
                case 'thanhtoan':
                    include_once('App/Controllers/cThanhToan.php');
                    $c = new controlThanhToan();
                    $c->taoThanhToanVNPAY();
                    break;
                case 'xulyvnpay':
                    include_once('App/Controllers/cThanhToan.php');
                    $c = new controlThanhToan();
                    $c->xuLyKetQuaVNPAY();
                    break;
                
                case 'inhoadon':
                    include_once('App/Controllers/cThanhToan.php');
                    $c = new controlThanhToan();
                    $c->inHoaDon();
                    break;

                // --- DASHBOARD ---
                default: 
                    include_once('App/Controllers/cDashboard.php');
                    $dash = new controlDashboard();
                    if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
                        $role = $_SESSION['maVaiTro'];
                        if($role == 1) $dash->hienThiDashboardChuTro();
                        else if($role == 2) $dash->hienThiDashboardKhach();
                    } else {
                        echo "<script>window.location.href='index.php?page=dangnhap';</script>";
                    }
                    break;
            }
            ?>
        </main>
        
        <footer class="mt-5 text-center text-muted small">
            © 2025 Sky Manager - Hệ thống quản lý phòng trọ
        </footer>
    </div>
</body>
<?php
ob_end_flush();
?>
</html>