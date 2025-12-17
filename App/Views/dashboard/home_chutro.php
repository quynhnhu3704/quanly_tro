<div class="mb-4">
    <h3 class="fw-bold text-dark border-start border-4 border-primary ps-3">Tổng Quan Quản Lý</h3>
</div>

<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 py-2 bg-primary text-white shadow border-0 rounded-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-uppercase small fw-bold text-white-50 mb-1">Tổng số phòng</div>
                        <div class="h2 mb-0 fw-bold"><?php echo $totalPhong; ?></div>
                    </div>
                    <div class="col-auto"><i class="bi bi-houses-fill fs-1 text-white-50"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 py-2 bg-success text-white shadow border-0 rounded-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-uppercase small fw-bold text-white-50 mb-1">Đang thuê</div>
                        <div class="h2 mb-0 fw-bold"><?php echo $dangThue; ?></div>
                    </div>
                    <div class="col-auto"><i class="bi bi-people-fill fs-1 text-white-50"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 py-2 bg-warning text-dark shadow border-0 rounded-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-uppercase small fw-bold text-dark-50 mb-1">Phòng trống</div>
                        <div class="h2 mb-0 fw-bold"><?php echo $trong; ?></div>
                    </div>
                    <div class="col-auto"><i class="bi bi-door-open-fill fs-1 text-dark-50"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card h-100 py-2 bg-danger text-white shadow border-0 rounded-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-uppercase small fw-bold text-white-50 mb-1">Tháng <?php echo date('m'); ?></div>
                        <div class="h2 mb-0 fw-bold">---</div>
                    </div>
                    <div class="col-auto"><i class="bi bi-currency-dollar fs-1 text-white-50"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<h5 class="fw-bold text-secondary mb-3"><i class="bi bi-grid-fill me-2"></i>Chức năng nhanh</h5>
<div class="row g-3 mb-5">
    <div class="col-md-3">
        <a href="index.php?page=dsphong" class="btn btn-white w-100 h-100 p-4 shadow-sm rounded-4 btn-quick-action text-start bg-white border">
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle me-3">
                    <i class="bi bi-house-gear-fill fs-3"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1 text-dark">Quản lý phòng</h6>
                    <small class="text-muted">Thêm, sửa, xóa</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="index.php?page=dsnguoithue" class="btn btn-white w-100 h-100 p-4 shadow-sm rounded-4 btn-quick-action text-start bg-white border">
            <div class="d-flex align-items-center">
                <div class="bg-info bg-opacity-10 text-info p-3 rounded-circle me-3">
                    <i class="bi bi-people-fill fs-3"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1 text-dark">Người thuê</h6>
                    <small class="text-muted">Xem danh sách</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="index.php?page=laphoadon" class="btn btn-white w-100 h-100 p-4 shadow-sm rounded-4 btn-quick-action text-start bg-white border">
            <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle me-3">
                    <i class="bi bi-receipt-cutoff fs-3"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1 text-dark">Lập hóa đơn</h6>
                    <small class="text-muted">Điện, nước...</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="index.php?page=khieunai" class="btn btn-white w-100 h-100 p-4 shadow-sm rounded-4 btn-quick-action text-start bg-white border">
            <div class="d-flex align-items-center">
                <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-circle me-3">
                    <i class="bi bi-megaphone-fill fs-3"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1 text-dark">Khiếu nại</h6>
                    <small class="text-muted">Phản hồi khách</small>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 fw-bold text-primary"><i class="bi bi-list-task me-2"></i>Trạng thái phòng hiện tại</h6>
        <a href="index.php?page=dsphong" class="btn btn-sm btn-outline-primary rounded-pill">Quản lý chi tiết</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-center">
                    <tr>
                        <th>Phòng</th>
                        <th>Dãy</th>
                        <th>Giá thuê</th>
                        <th>Trạng thái</th>
                        <th>Người thuê</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if(!empty($dsPhongArray)): ?>
                        <?php foreach($dsPhongArray as $room): ?>
                            <tr>
                                <td><span class="fw-bold text-primary fs-5"><?php echo $room['soPhong']; ?></span></td>
                                <td><span class="badge bg-light text-dark border"><?php echo $room['tenDay']; ?></span></td>
                                <td class="fw-bold text-secondary"><?php echo number_format($room['giaPhong']); ?> ₫</td>
                                <td>
                                    <?php if($room['trangThai'] == 'trong'): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Trống</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Đang thuê</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($room['hoTen']): ?>
                                        <span class="small fw-bold text-dark"><?php echo $room['hoTen']; ?></span>
                                    <?php else: ?>
                                        <span class="text-muted small fst-italic">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($room['trangThai'] == 'dangthue'): ?>
                                        <a href="index.php?page=laphoadon&maPhong=<?php echo $room['maPhong']; ?>" class="btn btn-sm btn-success rounded-pill px-3">Lập HĐ</a>
                                    <?php endif; ?>
                                    <a href="index.php?page=xemphong&maPhong=<?php echo $room['maPhong']; ?>" class="btn btn-sm btn-light text-primary border rounded-circle ms-1"><i class="bi bi-arrow-right"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="py-5">Chưa có dữ liệu.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>