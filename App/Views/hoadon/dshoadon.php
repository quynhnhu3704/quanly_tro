<div class="container mt-5 mb-5">
    <div class="text-center mb-4">
        <h3 class="fw-bold text-primary text-uppercase">Hóa Đơn Của Bạn</h3>
        <p class="text-muted">Vui lòng thanh toán đúng hạn để tránh gián đoạn dịch vụ.</p>
    </div>
    
    <div class="row justify-content-center">
        <?php
        // Biến $dsHoaDon được truyền từ Controller (cThanhToan)
        if(isset($dsHoaDon) && mysqli_num_rows($dsHoaDon) > 0) {
            while($hd = mysqli_fetch_assoc($dsHoaDon)) {
        ?>
            <div class="col-md-6 col-lg-5 mb-4">
                <div class="card shadow-sm h-100 border-0 rounded-3 overflow-hidden">
                    <div class="card-header text-white fw-bold d-flex justify-content-between align-items-center py-3 <?php echo ($hd['trangThai']=='DaThanhToan') ? 'bg-success' : 'bg-danger'; ?>">
                        <span><i class="bi bi-receipt me-2"></i>Tháng <?php echo $hd['thang'].'/'.$hd['nam']; ?></span>
                        <span>P.<?php echo $hd['soPhong']; ?></span>
                    </div>
                    
                    <div class="card-body bg-light">
                        <ul class="list-group list-group-flush mb-3 rounded shadow-sm">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Tiền phòng:</span>
                                <strong><?php echo number_format($hd['tienPhong']); ?> đ</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Tiền điện:</span>
                                <span><?php echo number_format($hd['tienDien']); ?> đ</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Tiền nước:</span>
                                <span><?php echo number_format($hd['tienNuoc']); ?> đ</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-white">
                                <span class="fw-bold text-uppercase">Tổng cộng:</span>
                                <span class="fw-bold fs-5 text-danger"><?php echo number_format($hd['tongTien']); ?> VNĐ</span>
                            </li>
                        </ul>

                        <div class="d-grid gap-2">
                            <?php if($hd['trangThai'] == 'ChuaThanhToan'): ?>
                                <a href="index.php?page=thanhtoan&id=<?php echo $hd['maHoaDon']; ?>" class="btn btn-primary fw-bold py-2 shadow-sm">
                                    <i class="bi bi-credit-card-2-front-fill me-2"></i>Thanh toán VNPAY
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary py-2 border-0" disabled style="background-color: #198754; opacity: 0.8;">
                                    <i class="bi bi-check-circle-fill me-2"></i>Đã thanh toán thành công
                                </button>
                                
                                <a href="index.php?page=inhoadon&id=<?php echo $hd['maHoaDon']; ?>" target="_blank" class="btn btn-outline-dark fw-bold py-2">
                                    <i class="bi bi-printer-fill me-2"></i>In phiếu hóa đơn
                                </a>

                                <div class="text-center mt-2 p-2 bg-white rounded border border-dashed">
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        <strong>Mã GD:</strong> <?php echo $hd['maGiaoDichVNP']; ?><br>
                                        <strong>Ngày đóng:</strong> <?php echo date('d/m/Y H:i', strtotime($hd['ngayThanhToan'])); ?>
                                    </small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
        ?>
            <div class="col-12 text-center py-5">
                <div class="mb-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="120" alt="Empty" class="opacity-25">
                </div>
                <h5 class="text-muted fw-bold">Hiện tại bạn không có hóa đơn nào cần xử lý.</h5>
                <p class="text-muted small">Mọi hóa đơn mới sẽ xuất hiện tại đây sau khi chủ trọ lập phiếu.</p>
                <a href="index.php" class="btn btn-primary btn-sm rounded-pill px-4">Quay về trang chủ</a>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<style>
    /* Làm cho các viền bảng trông nét hơn */
    .list-group-item {
        border-color: rgba(0,0,0,0.05);
    }
    .card {
        transition: transform 0.3s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .border-dashed {
        border-style: dashed !important;
    }
</style>