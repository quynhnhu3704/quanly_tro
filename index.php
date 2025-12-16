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
    <meta name="description" content=""/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container-fluid px-5">
            <!-- Nút mở sidebar -->
       <button id="menuToggle" class="btn btn-outline-primary me-3">&#9776;</button>

            <a class="navbar-brand fw-bold ms-3" href="index.php">
                <i class="bi bi-house-gear me-2"></i>Sky - Quản lý phòng trọ
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
            <div id="nav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2">
                    <!-- Thanh tìm kiếm -->
                    <li class="nav-item me-5">
                        <form class="d-flex" action="#" method="get">
                            <input class="form-control me-2" type="text" name="keyword" placeholder="Tìm kiếm phòng trọ..." style="width: 220px;">
                            <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Phòng trọ</a></li>

                    <?php
                    if(isset($_SESSION['login'])) {
                    // if(isset($_SESSION['role_id'])) {
                        // if($_SESSION['role_id'] != 3) {
                            echo '
                            <li class="nav-item dropdown ms-lg-2">
                                <a class="btn btn-primary dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-2"></i>' . $_SESSION['tenDangNhap'] . '
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li><a class="dropdown-item" href="index.php?page=thongtincanhan">Thông tin cá nhân</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="index.php?page=dangxuat" onclick="return confirm(\'Bạn có chắc chắn muốn đăng xuất khỏi hệ thống không?\');"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a></li>
                                </ul>
                            </li>
                            ';

                        // }
                    } else {
                        echo '<li class="nav-item ms-lg-2">';
                            echo '<a class="btn btn-primary me-2" href="index.php?page=dangnhap"><i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập</a>';
                            echo '<a class="btn btn-outline-primary" href="index.php?page=dangky"><i class="bi bi-box-arrow-in-right me-2"></i>Đăng ký</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <div id="sidebar" class="bg-white shadow-sm">
        <h5 class="fw-bold px-3 pt-3 pb-1"><i class="bi bi-speedometer2 me-2"></i>DANH MỤC</h5>
        <ul class="list-unstyled px-3">
            <?php
            if(!isset($_SESSION['login'])) {
                echo '<li class="fst-italic text-center text-muted">Vui lòng đăng nhập</li>';
            } else if (isset($_SESSION['maVaiTro']) && $_SESSION['maVaiTro'] == 1) {
                echo '<li><a href="index.php?page=dsphong" class="text-decoration-none d-block text-dark py-2">Quản lý phòng trọ</a></li>';
                echo '<li><a href="index.php?page=dsnguoithue" class="text-decoration-none d-block text-dark py-2">Quản lý người thuê</a></li>';
            }
            ?>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div id="mainContent">
        <main>
            <!-- switch case -->
            <?php
            $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
            switch($page) {
                // Chức năng dùng chung
                // Đăng nhập
                case 'dangnhap': include_once('App/Views/dangnhap.php'); break;
                // Đăng ký
                case 'dangky': include_once('App/Views/dangky.php'); break;
                // Đăng xuất
                case 'dangxuat': include_once('App/Views/dangxuat.php'); break;
                // Xem thông tin cá nhân
                case 'thongtincanhan': include_once('App/Views/thongtincanhan.php'); break;
                // Xem chi tiết thiết bị
                case 'chitietphong': include_once('App/Views/chitietphong.php'); break;
                // Quản lý phòng
                case 'dsphong': include_once('App/Views/qlphong/dsphong.php'); break;
                case 'xemphong': include_once('App/Views/qlphong/xemphong.php'); break;

                // Quản lý người thuê
                case 'dsnguoithue': include_once('App/Views/qlnguoithue/dsnguoithue.php'); break;
                case 'xemnguoithue': include_once('App/Views/qlnguoithue/xemnguoithue.php'); break;


                // Mặc định
                default: include_once('App/Views/dashboard.php'); break;
            }
            ?>
        </main>

        <?php
        include_once('App/Views/layouts/footer.php');
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('mainContent');
            const toggleBtn = document.getElementById('menuToggle');

            // Tạm tắt transition để tránh thụt ra thụt vô
            document.body.classList.add('no-transition');

            // Kiểm tra trạng thái lưu
            if (localStorage.getItem('sidebarOpen') === 'true') {
                sidebar.classList.add('active');
                main.classList.add('shifted');
            }

            // Bật lại transition sau khi layout ổn định
            setTimeout(() => {
                document.body.classList.remove('no-transition');
            }, 100);

            // Toggle sidebar
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                main.classList.toggle('shifted');
                localStorage.setItem('sidebarOpen', sidebar.classList.contains('active'));
            });
        });
    </script>
</body>
<?php
ob_end_flush();
?>
</html>