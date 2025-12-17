<style>
    .card-profile { border: none; border-radius: 15px; background: #fff; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden; }
    .profile-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 100px; }
    .avatar-circle { width: 90px; height: 90px; background: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: #764ba2; border: 4px solid #fff; margin-top: -45px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .stat-item { background: #f8f9fa; border-radius: 10px; padding: 10px; text-align: center; }
    .bill-card { border-left: 5px solid; }
    .bill-unpaid { border-color: #dc3545; background: #fff5f5; }
    .bill-paid { border-color: #198754; background: #f0fff4; }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-0">Tổng Quan Của Bạn</h3>
            <p class="text-muted small mb-0">Xin chào, <b><?php echo $_SESSION['tenDangNhap']; ?></b>! 👋</p>
        </div>
        <div class="text-end">
            <span class="badge bg-primary rounded-pill px-3 py-2">
                <i class="bi bi-calendar-event me-1"></i> Hôm nay: <?php echo date('d/m/Y'); ?>
            </span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card card-profile mb-4 text-center">
                <div class="profile-header"></div>
                <div class="card-body pt-0">
                    <div class="d-flex justify-content-center">
                        <div class="avatar-circle"><i class="bi bi-person-fill"></i></div>
                    </div>
                    <h5 class="fw-bold mt-3 mb-1"><?php echo $_SESSION['tenDangNhap']; ?></h5>
                    <span class="badge bg-light text-dark border">Khách thuê trọ</span>
                    <hr class="my-3 opacity-25">
                    <div class="text-start px-2 small">
                        <div class="mb-2"><i class="bi bi-telephone me-2 text-primary"></i> 090xxxxxxx</div>
                        <div class="mb-2"><i class="bi bi-envelope me-2 text-primary"></i> user@email.com</div>
                    </div>
                    <div class="mt-4">
                        <a href="index.php?page=thongtincanhan" class="btn btn-outline-primary btn-sm w-100 rounded-pill mb-2">Thông tin tài khoản</a>
                        <a href="index.php?page=khieunai" class="btn btn-danger btn-sm w-100 rounded-pill shadow-sm">
                            <i class="bi bi-megaphone-fill me-1"></i> Gửi khiếu nại
                        </a>
                    </div>
                </div>
            </div>

            <div class="card card-profile">
                <div class="card-header bg-white border-0 fw-bold py-3">
                    <i class="bi bi-house-door-fill me-2 text-warning"></i>Thông Tin Phòng
                </div>
                <div class="card-body pt-0">
                    <?php if(isset($myRoom) && $myRoom): ?>
                        <div class="text-center mb-3">
                            <h2 class="fw-bold text-primary mb-0">P.<?php echo $myRoom['soPhong']; ?></h2>
                            <small class="text-muted">Dãy <?php echo $myRoom['tenDay']; ?></small>
                        </div>
                        <div class="row g-2">
                            <div class="col-6"><div class="stat-item"><small class="text-muted d-block">Giá thuê</small><b><?php echo number_format($myRoom['giaPhong']); ?></b></div></div>
                            <div class="col-6"><div class="stat-item"><small class="text-muted d-block">Số người</small><b><?php echo $myRoom['soNguoi']; ?></b></div></div>
                            <div class="col-6"><div class="stat-item"><small class="text-muted d-block">Điện</small><b>4k</b></div></div>
                            <div class="col-6"><div class="stat-item"><small class="text-muted d-block">Nước</small><b>20k</b></div></div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning small">Bạn chưa được gán vào phòng nào.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="mb-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-bell-fill text-primary me-2"></i>Thông báo mới nhất</h5>
                <?php if(isset($latestBill) && $latestBill): ?>
                    <div class="card card-profile bill-card <?php echo ($latestBill['trangThai'] == 'ChuaThanhToan') ? 'bill-unpaid' : 'bill-paid'; ?>">
                        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <h5 class="fw-bold <?php echo ($latestBill['trangThai'] == 'ChuaThanhToan') ? 'text-danger' : 'text-success'; ?> mb-1">
                                    Hóa đơn T<?php echo $latestBill['thang'].'/'.$latestBill['nam']; ?> 
                                    <?php echo ($latestBill['trangThai'] == 'ChuaThanhToan') ? 'chưa thanh toán' : 'đã hoàn thành'; ?>!
                                </h5>
                                <p class="mb-0 text-muted small">Cảm ơn bạn đã sử dụng dịch vụ của Sky Manager.</p>
                            </div>
                            <div class="text-end">
                                <h3 class="fw-bold mb-0"><?php echo number_format($latestBill['tongTien']); ?> đ</h3>
                                <?php if($latestBill['trangThai'] == 'ChuaThanhToan'): ?>
                                    <a href="index.php?page=hoadon" class="btn btn-danger btn-sm rounded-pill mt-2 px-3">Thanh toán ngay</a>
                                <?php else: ?>
                                    <span class="badge bg-success rounded-pill px-3 py-2 mt-2">Thành công</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info border-0 rounded-3 shadow-sm">Bạn chưa có hóa đơn nào.</div>
                <?php endif; ?>
            </div>

            <div class="card card-profile">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Lịch sử giao dịch</h6>
                    <a href="index.php?page=hoadon" class="btn btn-light btn-sm text-primary fw-bold rounded-pill">Xem tất cả</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light small">
                                <tr>
                                    <th class="ps-4">Tháng</th>
                                    <th>Giá thuê</th>
                                    <th>Dịch vụ</th>
                                    <th>Tổng tiền</th>
                                    <th class="text-center">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                                <?php if(isset($historyBills) && !empty($historyBills)): ?>
                                    <?php foreach(array_slice($historyBills, 0, 5) as $hd): ?>
                                        <tr>
                                            <td class="ps-4 fw-bold">T<?php echo $hd['thang'].'/'.$hd['nam']; ?></td>
                                            <td><?php echo number_format($hd['tienPhong']); ?></td>
                                            <td><?php echo number_format($hd['tienDien'] + $hd['tienNuoc']); ?></td>
                                            <td class="fw-bold text-dark"><?php echo number_format($hd['tongTien']); ?> đ</td>
                                            <td class="text-center">
                                                <span class="badge bg-<?php echo ($hd['trangThai']=='DaThanhToan')?'success':'danger'; ?> bg-opacity-10 text-<?php echo ($hd['trangThai']=='DaThanhToan')?'success':'danger'; ?> rounded-pill px-2">
                                                    <?php echo ($hd['trangThai']=='DaThanhToan')?'Thành công':'Chờ TT'; ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center py-4 text-muted">Chưa có dữ liệu.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>