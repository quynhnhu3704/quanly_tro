<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 1) {
    echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
    exit();
}
?>

<h2 class="text-center fw-semibold my-3">Danh sách phòng trọ</h2>

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
                    <th>Số phòng</th>
                    <th>Số người</th>
                    <th>Người thuê</th>
                    <th>Giá phòng</th>
                    <th>Tiền điện</th>
                    <th>Tiền nước</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
            <?php
            include_once('App/Controllers/cPhong.php');
            $p = new controlPhong();

            if(isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $kq = $p->searchPhong($keyword);
            } else {
                $kq = $p->getAllPhong();
            }

            if ($kq && $kq->num_rows > 0) {
                $dem = 0;
                while ($r = $kq->fetch_assoc()) {
                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>'.$dem.'</strong></td>';
                        echo '<td class="text-center">'.$r['soPhong'].'</td>';
                        echo '<td class="text-center">'.$r['soNguoi'].'</td>';
                        echo '<td>'.($r['hoTen'] ?? '<span class="text-muted">Chưa có</span>').'</td>';
                        echo '<td class="text-end">'.number_format($r['giaPhong']).'</td>';
                        echo '<td class="text-end">'.number_format($r['tienDien']).'</td>';
                        echo '<td class="text-end">'.number_format($r['tienNuoc']).'</td>';

                        echo '<td class="text-center">';
                            echo $r['trangThai'] == 'trong'
                                ? '<span class="badge bg-success">Trống</span>'
                                : '<span class="badge bg-warning text-dark">Đang thuê</span>';
                        echo '</td>';

                        echo '<td class="text-center">';
                            echo '<a href="index.php?page=xemphong&maPhong='.$r['maPhong'].'"
                                    class="btn btn-sm btn-warning" style="font-size:0.95em;">
                                    <i class="bi bi-eye"></i> Xem
                                  </a>';
                        echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="9">
                        <h5 class="text-center text-muted">Hiện chưa có phòng nào.</h5>
                      </td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    th, td {
        max-width: 12.5em;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>