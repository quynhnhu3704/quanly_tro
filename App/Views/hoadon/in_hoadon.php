<?php
// Dữ liệu $hd được truyền từ Controller
if (!$hd) { echo "Không tìm thấy hóa đơn"; exit; }
?>
<!DOCTYPE html>
<html>
<head>
    <title>In Hoa Don #<?php echo $hd['maHoaDon']; ?></title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <style>
        body { background: #fff; font-family: "Times New Roman", Times, serif; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; }
        .header { text-align: center; margin-bottom: 20px; }
        .table-info { width: 100%; margin-bottom: 20px; }
        
        /* CSS Quan trọng để chỉ in nội dung hóa đơn */
        @media print {
            .no-print { display: none; }
            .invoice-box { border: none; }
        }
    </style>
</head>
<body onload="window.print()"> <div class="container mt-3 no-print">
    <button onclick="window.history.back()" class="btn btn-secondary btn-sm"> Quay lại</button>
    <button onclick="window.print()" class="btn btn-primary btn-sm"> In lại</button>
</div>

<div class="invoice-box mt-4">
    <div class="header">
        <h4>SKY MANAGER - QUẢN LÝ PHÒNG TRỌ</h4>
        <p>Địa chỉ: 123 Đường ABC, Quận X, TP. HCM</p>
        <hr>
        <h3>HÓA ĐƠN TIỀN PHÒNG</h3>
        <p>Tháng <?php echo $hd['thang']; ?> năm <?php echo $hd['nam']; ?></p>
    </div>

    <table class="table-info">
        <tr>
            <td><strong>Khách thuê:</strong> <?php echo $hd['hoTen']; ?></td>
            <td class="text-end"><strong>Mã HĐ:</strong> #<?php echo $hd['maHoaDon']; ?></td>
        </tr>
        <tr>
            <td><strong>Số phòng:</strong> <?php echo $hd['soPhong']; ?></td>
            <td class="text-end"><strong>Ngày thanh toán:</strong> <?php echo date('d/m/Y', strtotime($hd['ngayThanhToan'])); ?></td>
        </tr>
    </table>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Hạng mục</th>
                <th class="text-end">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiền thuê phòng</td>
                <td class="text-end"><?php echo number_format($hd['tienPhong']); ?> đ</td>
            </tr>
            <tr>
                <td>Tiền điện</td>
                <td class="text-end"><?php echo number_format($hd['tienDien']); ?> đ</td>
            </tr>
            <tr>
                <td>Tiền nước</td>
                <td class="text-end"><?php echo number_format($hd['tienNuoc']); ?> đ</td>
            </tr>
            <tr class="fw-bold">
                <td>TỔNG CỘNG</td>
                <td class="text-end text-danger"><?php echo number_format($hd['tongTien']); ?> đ</td>
            </tr>
        </tbody>
    </table>

    <div class="row mt-5">
        <div class="col-6 text-center">
            <p><strong>Người thuê</strong></p>
            <br><br><br>
            <p><?php echo $hd['hoTen']; ?></p>
        </div>
        <div class="col-6 text-center">
            <p><strong>Chủ trọ</strong></p>
            <br><br><br>
            <p>Ký tên</p>
        </div>
    </div>
</div>

</body>
</html>