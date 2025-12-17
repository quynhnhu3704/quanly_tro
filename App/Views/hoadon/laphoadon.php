<div class="container py-4">
    <div class="card card-modern shadow-lg border-0">
        <div class="card-header bg-primary text-white py-3">
            <h4 class="mb-0 fw-bold"><i class="bi bi-receipt-cutoff me-2"></i>Lập Hóa Đơn Mới</h4>
        </div>
        <div class="card-body p-4">
            
            <form action="index.php?page=xulylaphoadon" method="POST" id="formInvoice">
                
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Chọn Phòng <span class="text-danger">*</span></label>
                        <select name="maPhong" id="selectPhong" class="form-select form-select-lg" required onchange="updateGiaPhong()">
                            <option value="" data-gia="0">-- Chọn phòng --</option>
                            <?php 
                            if(isset($dsPhong) && mysqli_num_rows($dsPhong) > 0) {
                                while($r = mysqli_fetch_assoc($dsPhong)) {
                                    // [QUAN TRỌNG] Lưu giá phòng vào data-gia để Javascript lấy
                                    $giaPhong = $r['giaPhong'];
                                    echo "<option value='".$r['maPhong']."' data-gia='".$giaPhong."'>Phòng ".$r['soPhong']." - ".$r['hoTen']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Tháng</label>
                        <select name="thang" class="form-select">
                            <?php 
                            for($i=1; $i<=12; $i++) {
                                $sel = ($i == date('m')) ? 'selected' : '';
                                echo "<option value='$i' $sel>Tháng $i</option>";
                            } 
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Năm</label>
                        <input type="number" name="nam" class="form-control" value="<?php echo date('Y'); ?>">
                    </div>
                </div>

                <hr class="text-muted">

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded border h-100">
                            <label class="form-label fw-bold text-primary">1. Tiền Phòng (VNĐ)</label>
                            <input type="number" name="tienPhong" id="inputTienPhong" class="form-control fw-bold fs-5 text-end text-primary" value="0" oninput="tinhTong()">
                            <div class="form-text small">Tự động điền theo giá phòng, có thể sửa.</div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded border h-100">
                            <label class="form-label fw-bold text-warning"><i class="bi bi-lightning-fill"></i> 2. Tiền Điện (4.000đ/số)</label>
                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <input type="number" id="dienCu" class="form-control form-control-sm" placeholder="Số cũ" oninput="tinhTienDien()">
                                </div>
                                <div class="col-6">
                                    <input type="number" id="dienMoi" class="form-control form-control-sm" placeholder="Số mới" oninput="tinhTienDien()">
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="number" name="tienDien" id="ketQuaTienDien" class="form-control fw-bold text-end text-warning" value="0" readonly>
                                <span class="input-group-text small">đ</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded border h-100">
                            <label class="form-label fw-bold text-info"><i class="bi bi-droplet-fill"></i> 3. Tiền Nước (VNĐ)</label>
                            <div class="mb-2 text-muted small">Nhập trực tiếp số tiền nước:</div>
                            <input type="number" name="tienNuoc" id="inputTienNuoc" class="form-control fw-bold text-end text-info" value="0" oninput="tinhTong()">
                        </div>
                    </div>
                </div>

                <div class="alert alert-primary d-flex justify-content-between align-items-center shadow-sm">
                    <span class="fs-4 fw-bold">TỔNG CỘNG:</span>
                    <span class="fs-2 fw-bold text-danger" id="txtTongTien">0 VNĐ</span>
                </div>

                <div class="text-end mt-4">
                    <a href="index.php?page=hoadon" class="btn btn-secondary me-2 rounded-pill px-4">Hủy bỏ</a>
                    <button type="submit" name="btnLuuHoaDon" class="btn btn-primary btn-lg px-5 rounded-pill shadow fw-bold">
                        <i class="bi bi-save me-2"></i>LƯU HÓA ĐƠN
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Hàm format tiền tệ (Ví dụ: 1000000 -> 1.000.000)
    function formatCurrency(number) {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number);
    }

    // 1. Tự động điền giá phòng khi chọn phòng từ danh sách
    function updateGiaPhong() {
        var select = document.getElementById('selectPhong');
        // Lấy option đang được chọn
        var option = select.options[select.selectedIndex];
        
        // Lấy giá trị từ thuộc tính data-gia (được PHP in ra)
        var gia = option.getAttribute('data-gia');
        
        // Nếu có giá thì điền vào ô input, ngược lại điền 0
        if(gia) {
            document.getElementById('inputTienPhong').value = gia;
        } else {
            document.getElementById('inputTienPhong').value = 0;
        }
        
        // Tính lại tổng tiền sau khi giá phòng thay đổi
        tinhTong();
    }

    // 2. Tính tiền điện = (Mới - Cũ) * 4000
    function tinhTienDien() {
        var cu = document.getElementById('dienCu').value;
        var moi = document.getElementById('dienMoi').value;
        var donGia = 4000; // Giá điện cố định

        if(cu != "" && moi != "") {
            var soDien = parseInt(moi) - parseInt(cu);
            
            // Nếu nhập số mới nhỏ hơn số cũ (vô lý) thì coi như 0
            if(soDien < 0) soDien = 0;
            
            var thanhTien = soDien * donGia;
            document.getElementById('ketQuaTienDien').value = thanhTien;
        } else {
            document.getElementById('ketQuaTienDien').value = 0;
        }
        tinhTong();
    }

    // 3. Tính tổng tiền = Phòng + Điện + Nước
    function tinhTong() {
        // Lấy giá trị các ô, nếu rỗng thì tính là 0
        var p = parseInt(document.getElementById('inputTienPhong').value) || 0;
        var d = parseInt(document.getElementById('ketQuaTienDien').value) || 0;
        var n = parseInt(document.getElementById('inputTienNuoc').value) || 0;

        var tong = p + d + n;
        
        // Hiển thị ra text đẹp mắt
        document.getElementById('txtTongTien').innerText = formatCurrency(tong);
    }
</script>