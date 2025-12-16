<!-- App/Views/phong/index.php -->
<section id="phong" class="py-4">
    <div class="container-fluid px-4">
        <div class="row">
            <!-- Sidebar trạng thái phòng -->
            <div class="col-md-3 mb-4">
                <div class="card position-sticky" style="top: 4em">
                    <div class="card-header fw-bold">Trạng thái</div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="index.php?page=phong" class="text-decoration-none">Tất cả</a></li>
                        <li class="list-group-item"><a href="index.php?page=phong&trangthai=trong" class="text-decoration-none">Phòng trống</a></li>
                        <li class="list-group-item"><a href="index.php?page=phong&trangthai=dangthue" class="text-decoration-none">Đang thuê</a></li>
                    </ul>
                </div>
            </div>

            <!-- Danh sách phòng -->
            <div class="col-md-9">
                <div class="d-flex align-items-end justify-content-between mb-4">
                    <div>
                        <?php
                        $title = 'Danh sách phòng trọ';
                        if(isset($_GET['trangthai'])){
                            $title = $_GET['trangthai'] == 'trong' ? 'Danh sách phòng trống' : 'Danh sách phòng đang thuê';
                        }
                        ?>
                        <h4 class="fw-bold mb-1"><?= $title ?></h4>
                        <div class="text-muted">Quản lý thông tin cơ bản các phòng</div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Số phòng</th>
                                <th>Số người</th>
                                <th>Chủ phòng</th>
                                <th>Giá phòng (VNĐ)</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once('App/Controllers/cPhong.php');
                            $p = new controlPhong();

                            if(isset($_GET['keyword']) && $_GET['keyword'] !== ''){
                                $kq = $p->searchPhong($_GET['keyword']);
                            } 
                            else if(isset($_GET['trangthai'])){
                                $kq = $p->getPhongTheoTrangThai($_GET['trangthai']);
                            } 
                            else {
                                $kq = $p->getAllPhong();
                            }

                            if($kq && $kq->num_rows > 0){
                                while($r = $kq->fetch_assoc()){
                                    echo '<tr>';
                                    echo '<td>'.$r['soPhong'].'</td>';
                                    echo '<td>'.$r['soNguoi'].'</td>';
                                    echo '<td>'.$r['hoTen'].'</td>';
                                    echo '<td>'.number_format($r['giaPhong']).'</td>';
                                    echo '<td>';
                                        echo $r['trangThai'] == 'trong'
                                            ? '<span class="badge bg-success">Trống</span>'
                                            : '<span class="badge bg-warning text-dark">Đang thuê</span>';
                                    echo '</td>';
                                    echo '<td class="text-center">';
                                        echo '<a href="index.php?page=chitietphong&maPhong='.$r['maPhong'].'" class="btn btn-sm btn-primary">Xem</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="5" class="text-center text-muted">Chưa có phòng nào</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>