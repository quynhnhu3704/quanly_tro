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
$kq = $p->getAllNguoiDung(); // chỉ maVaiTro = 2
?>

<h2 class="text-center fw-semibold my-4">Danh sách người thuê trọ</h2>

<div class="d-flex mx-auto justify-content-between align-items-center" style="width: 95%">
    <!-- Thanh tìm kiếm -->
    <form class="d-flex ms-auto" action="index.php" method="get">
        <input type="hidden" name="page" value="dsphong">

        <input class="form-control me-2" type="text" name="keyword"
               placeholder="Tìm theo người thuê..." style="width: 220px;">
        <button class="btn btn-outline-primary" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>
</div>

<div class="d-flex justify-content-center">
    <div class="table-responsive my-5" style="width: 95%;">
        <table class="table table-striped table-hover table-borderless align-middle" style="font-size: 0.85em;">
            <thead class="text-center">
            <tr>
                <th>STT</th>
                <th>Họ tên</th>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if($kq && $kq->num_rows > 0){
            $i = 0;
            while($r = $kq->fetch_assoc()){
                // Ẩn chủ trọ khỏi danh sách
                if ($r['maVaiTro'] == 1) continue;

                $i++;
                echo '<tr>';
                echo '<td class="text-center">'.$i.'</td>';
                echo '<td>'.$r['hoTen'].'</td>';
                echo '<td>'.$r['tenDangNhap'].'</td>';
                echo '<td>'.$r['email'].'</td>';
                echo '<td>'.$r['soDienThoai'].'</td>';
                echo '<td class="text-center">';
                echo '<a href="index.php?page=xemnguoithue&maNguoiDung='.$r['maNguoiDung'].'" class="btn btn-sm btn-primary">Xem</a>';
                echo '</td>';
                echo '</tr>';
            }  if ($i == 0) {
                    echo '<tr><td colspan="10"><h5 class="text-center text-muted">Chưa có người thuê.</h5></td></tr>';
                }
        }else{
            echo '<tr><td colspan="6" class="text-center text-muted">Chưa có người thuê</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>