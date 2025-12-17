<?php
// 1. GỌI MODEL & XỬ LÝ DỮ LIỆU
include_once("App/Models/mPhong.php");
$p = new modelPhong();

// Lấy danh sách Dãy (A, B, C...) để đổ vào combobox
$dsDay = $p->getDanhSachDay();

// Kiểm tra xem người dùng có đang lọc theo dãy không
$dayHienTai = isset($_GET['day']) ? $_GET['day'] : '';

// Lấy danh sách phòng (Nếu có chọn dãy thì lọc, không thì lấy hết)
$dsPhong = $p->selectPhongTheoDay($dayHienTai);
?>

<style>
    /* Card đẹp, đổ bóng nhẹ */
    .card-modern {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: #fff;
    }

    /* Header gradient xanh dương */
    .card-header-modern {
        background: linear-gradient(135deg, #0d6efd 0%, #0043a8 100%);
        color: white;
        padding: 1.5rem;
    }

    /* Form lọc */
    .filter-box {
        background: rgba(255, 255, 255, 0.2);
        padding: 5px 15px;
        border-radius: 50px;
        backdrop-filter: blur(5px);
    }
    .filter-select {
        border: none;
        background: white;
        border-radius: 20px;
        color: #0d6efd;
        font-weight: 700;
        cursor: pointer;
    }
    .filter-select:focus {
        box-shadow: 0 0 0 2px rgba(255,255,255,0.5);
    }

    /* Table Styles */
    .table-modern thead th {
        background-color: #f8f9fa;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        color: #6c757d;
        font-weight: 700;
        border-bottom: 2px solid #eaecf4;
        vertical-align: middle;
        padding: 1rem;
    }
    .table-modern tbody td {
        padding: 1rem;
        vertical-align: middle;
        color: #5a5c69;
        border-bottom: 1px solid #eaecf4;
    }
    .table-modern tbody tr:hover {
        background-color: #f8f9fc;
    }

    /* Badge trạng thái */
    .badge-status {
        padding: 8px 12px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .badge-trong {
        background-color: #d1e7dd;
        color: #0f5132;
    }
    .badge-dangthue {
        background-color: #ffd9003b;
        color: #b47b08;
    }
    
    /* Số phòng to đẹp */
    .room-number {
        font-weight: 800;
        color: #4e73df;
        font-size: 1.1rem;
    }
    
    /* Giá tiền */
    .price-tag {
        font-family: 'Consolas', monospace;
        font-weight: 700;
        color: #e74a3b;
    }
</style>

<div class="container py-4">
    
    <div class="card card-modern">
        <div class="card-header-modern d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h4 class="mb-1 fw-bold"><i class="bi bi-grid-3x3-gap-fill me-2"></i>Quản Lý Danh Sách Phòng</h4>
                <p class="mb-0 opacity-75 small">Theo dõi trạng thái và thông tin người thuê</p>
            </div>
            
            <form action="index.php" method="GET" class="d-flex align-items-center filter-box">
                <input type="hidden" name="page" value="dsphong">
                
                <span class="fw-bold me-2 small text-white"><i class="bi bi-funnel-fill"></i> Lọc dãy:</span>
                <select name="day" class="form-select form-select-sm filter-select" style="width: 140px;" onchange="this.form.submit()">
                    <option value="">-- Tất cả --</option>
                    <?php
                    if($dsDay && mysqli_num_rows($dsDay) > 0) {
                        while($r = mysqli_fetch_assoc($dsDay)) {
                            $selected = ($dayHienTai == $r['tenDay']) ? 'selected' : '';
                            echo "<option value='".$r['tenDay']."' $selected>Dãy ".$r['tenDay']."</option>";
                        }
                    }
                    ?>
                </select>
            </form>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern mb-0 w-100">
                    <thead>
                        <tr class="text-center">
                            <th>STT</th>
                            <th>Số Phòng</th>
                            <th>Dãy</th>
                            <th>Số người</th>
                            <th>Giá Phòng</th>
                            <th>Trạng Thái</th>
                            <th>Người Thuê</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($dsPhong && mysqli_num_rows($dsPhong) > 0) {
                            $i = 1;
                            while($row = mysqli_fetch_assoc($dsPhong)) {
                        ?>
                            <tr>
                                <td class="text-center text-muted small"><?php echo $i++; ?></td>
                                
                                <td class="text-center">
                                    <span class="room-number"><?php echo $row['soPhong']; ?></span>
                                </td>
                                
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">
                                        <?php echo !empty($row['tenDay']) ? $row['tenDay'] : '-'; ?>
                                    </span>
                                </td>
                                
                                <td class="text-center">
                                    <i class="bi bi-people me-1 text-muted"></i>
                                    <b><?php echo $row['soNguoi']; ?></b>
                                </td>
                                
                                <td class="text-end">
                                    <span class="price-tag"><?php echo number_format($row['giaPhong'], 0, ',', '.'); ?></span> 
                                    <small class="text-muted">₫</small>
                                </td>
                                
                                <td class="text-center">
                                    <?php if($row['trangThai'] == 'trong'): ?>
                                        <span class="badge-status badge-trong">
                                            <i class="bi bi-check-circle-fill me-1"></i>Trống
                                        </span>
                                    <?php else: ?>
                                        <span class="badge-status badge-dangthue">
                                            <i class="bi bi-house-lock-fill me-1"></i>Đang thuê
                                        </span>
                                    <?php endif; ?>
                                </td>
                                
                                <td>
                                    <?php if(!empty($row['hoTen'])): ?>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width:30px; height:30px; font-size:12px;">
                                                <?php echo substr($row['hoTen'], 0, 1); ?>
                                            </div>
                                            <span class="fw-semibold text-dark"><?php echo $row['hoTen']; ?></span>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted fst-italic small">-- Chưa có --</span>
                                    <?php endif; ?>
                                </td>
                                
                                <td class="text-center">
                                    <a href="index.php?page=xemphong&maPhong=<?php echo $row['maPhong']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                                        <i class="bi bi-eye-fill me-1"></i> Xem
                                    </a>
                                </td>
                            </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center py-5 text-muted'>
                                    <i class='bi bi-inbox fs-1 d-block mb-2 opacity-25'></i>
                                    Không tìm thấy phòng nào phù hợp.
                                  </td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-light border-0 py-3">
            <div class="row text-center text-muted small">
                <div class="col">
                    <i class="bi bi-info-circle me-1"></i> Tổng số: <b><?php echo mysqli_num_rows($dsPhong); ?></b> phòng
                </div>
                </div>
        </div>
    </div>
</div>