<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-danger mb-0">
            <i class="bi bi-megaphone-fill me-2"></i>Danh Sách Khiếu Nại & Phản Ánh
        </h4>
        <span class="badge bg-secondary rounded-pill">Tổng cộng: <?php echo mysqli_num_rows($dsPhieu); ?> phiếu</span>
    </div>
    
    <?php if($dsPhieu && mysqli_num_rows($dsPhieu) > 0): ?>
        <div class="row g-4">
        <?php while($p = mysqli_fetch_assoc($dsPhieu)): 
            $isDone = ($p['trangThai'] == 'DaXuLy');
        ?>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 position-relative <?php echo !$isDone ? 'border-start border-danger border-4' : ''; ?>" 
                     style="transition: transform 0.2s; cursor: default;" 
                     onmouseover="this.style.transform='translateY(-5px)'" 
                     onmouseout="this.style.transform='translateY(0)'">
                    
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="fw-bold text-primary mb-0"><?php echo $p['hoTen']; ?></h6>
                                <small class="text-muted" style="font-size: 0.75rem;">
                                    <i class="bi bi-clock me-1"></i><?php echo date('H:i - d/m/Y', strtotime($p['ngayGui'])); ?>
                                </small>
                            </div>
                            <span class="badge <?php echo $isDone ? 'bg-success' : 'bg-danger'; ?> rounded-pill px-3">
                                <?php echo $isDone ? '<i class="bi bi-check-circle me-1"></i>Đã xong' : 'Chưa xử lý'; ?>
                            </span>
                        </div>

                        <div class="bg-light p-3 rounded-3 mb-3">
                            <div class="fw-bold mb-1" style="font-size: 0.9rem; color: #444;">
                                <i class="bi bi-info-circle me-1"></i><?php echo $p['tieuDe']; ?>
                            </div>
                            <p class="mb-0 text-dark" style="font-size: 0.85rem; line-height: 1.5;">
                                <?php echo nl2br($p['noiDung']); ?>
                            </p>
                        </div>
                        
                        <?php if(!empty($p['hinhAnh'])): ?>
                            <div class="mb-3">
                                <label class="small text-muted d-block mb-1">Hình ảnh đính kèm:</label>
                                <img src="public/images/feedback/<?php echo $p['hinhAnh']; ?>" 
                                     class="rounded border shadow-sm img-fluid" 
                                     style="max-height: 180px; object-fit: cover; cursor: zoom-in;"
                                     onclick="window.open(this.src)"
                                     onerror="this.parentElement.style.display='none'">
                            </div>
                        <?php endif; ?>

                        <div class="mt-auto">
                            <?php if(!$isDone): ?>
                                <form action="index.php?page=xulyphanhoikhieunai" method="POST" class="mt-3">
                                    <input type="hidden" name="maPhieu" value="<?php echo $p['maPhieu']; ?>">
                                    <div class="form-floating mb-2">
                                        <textarea name="noiDungPhanHoi" class="form-control" placeholder="Trả lời khách..." id="reply_<?php echo $p['maPhieu']; ?>" style="height: 100px" required></textarea>
                                        <label for="reply_<?php echo $p['maPhieu']; ?>">Nội dung trả lời...</label>
                                    </div>
                                    <button type="submit" name="btnTraLoi" class="btn btn-primary w-100 rounded-pill fw-bold shadow-sm">
                                        <i class="bi bi-send-fill me-2"></i>Gửi phản hồi cho khách
                                    </button>
                                </form>
                            <?php else: ?>
                                <div class="p-3 rounded-3 border-start border-4 border-success bg-success bg-opacity-10">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small class="fw-bold text-success"><i class="bi bi-chat-left-text-fill me-1"></i>Nội dung phản hồi:</small>
                                        <small class="text-muted" style="font-size: 10px;">
                                            <?php echo date('d/m/Y', strtotime($p['ngayPhanHoi'])); ?>
                                        </small>
                                    </div>
                                    <p class="mb-0 small italic text-dark"><?php echo $p['phanHoi']; ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5 bg-white rounded-4 shadow-sm">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076432.png" width="80" class="opacity-25 mb-3">
            <p class="text-muted fw-bold">Hiện tại không có khiếu nại nào cần xử lý.</p>
            <a href="index.php" class="btn btn-outline-primary btn-sm rounded-pill">Về Trang Chủ</a>
        </div>
    <?php endif; ?>
</div>