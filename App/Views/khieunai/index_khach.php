<style>
    .card-feedback { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    .status-wait { background: #fff3cd; color: #856404; padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; }
    .status-done { background: #d4edda; color: #155724; padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; }
    .img-preview { width: 100%; max-height: 150px; object-fit: cover; border-radius: 10px; cursor: pointer; border: 1px solid #ddd; }
</style>

<div class="container py-4">
    <a href="index.php" class="btn btn-link text-decoration-none text-muted mb-3 p-0">
        <i class="bi bi-arrow-left"></i> Quay lại trang chủ
    </a>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card card-feedback">
                <div class="card-header bg-danger text-white py-3 rounded-top-4">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Tạo Khiếu Nại / Góp Ý</h5>
                </div>
                <div class="card-body p-4">
                    <form action="index.php?page=xulyguikhieunai" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Vấn đề gặp phải</label>
                            <input type="text" name="tieuDe" class="form-control" placeholder="Ví dụ: Hỏng bóng đèn, vòi nước rò rỉ..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Chi tiết nội dung</label>
                            <textarea name="noiDung" class="form-control" rows="5" placeholder="Hãy mô tả rõ tình trạng để chúng tôi xử lý..." required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-uppercase">Hình ảnh minh chứng</label>
                            <input type="file" name="anhPhanAnh" class="form-control" accept="image/*">
                            <div class="form-text">Định dạng: JPG, PNG. Dung lượng < 2MB.</div>
                        </div>
                        <button type="submit" name="btnGuiPhieu" class="btn btn-danger w-100 py-2 fw-bold rounded-pill shadow-sm">
                            GỬI YÊU CẦU CHO CHỦ TRỌ
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <h5 class="fw-bold mb-3">Lịch sử phản hồi</h5>
            <?php if(isset($dsPhieu) && mysqli_num_rows($dsPhieu) > 0): ?>
                <?php while($p = mysqli_fetch_assoc($dsPhieu)): ?>
                    <div class="card card-feedback mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold text-primary"><?php echo $p['tieuDe']; ?></span>
                                <span class="<?php echo ($p['trangThai']=='DaXuLy')?'status-done':'status-wait'; ?>">
                                    <?php echo ($p['trangThai']=='DaXuLy')?'<i class="bi bi-check-circle-fill"></i> Đã xử lý':'<i class="bi bi-hourglass-split"></i> Đang chờ'; ?>
                                </span>
                            </div>
                            
                            <p class="text-dark small mb-3"><?php echo $p['noiDung']; ?></p>
                            
                            <?php if($p['hinhAnh']): ?>
                                <div class="mb-3" style="max-width: 200px;">
                                    <img src="public/images/feedback/<?php echo $p['hinhAnh']; ?>" class="img-preview" onclick="window.open(this.src)">
                                </div>
                            <?php endif; ?>

                            <div class="small text-muted py-2 border-top">
                                <i class="bi bi-clock me-1"></i> Ngày gửi: <?php echo date('d/m/Y H:i', strtotime($p['ngayGui'])); ?>
                            </div>

                            <?php if($p['phanHoi']): ?>
                                <div class="mt-3 p-3 bg-light rounded-3 border-start border-4 border-success">
                                    <div class="fw-bold text-success mb-1 small"><i class="bi bi-reply-fill"></i> Phản hồi từ Chủ trọ:</div>
                                    <p class="mb-1 small italic"><?php echo $p['phanHoi']; ?></p>
                                    <small class="text-muted" style="font-size: 10px;"><?php echo date('d/m/Y H:i', strtotime($p['ngayPhanHoi'])); ?></small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="card card-feedback p-5 text-center text-muted">
                    <i class="bi bi-chat-left-dots fs-1 opacity-25"></i>
                    <p class="mt-3">Bạn chưa có khiếu nại nào.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>