<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';
    $timestamp = date("Y-m-d H:i:s");

    // Chuẩn bị dòng dữ liệu để lưu vào CSV
    $data = [$timestamp, $name, $email, $message];

    // Tên file CSV
    $filename = "data.csv";

    // Mở file ở chế độ "a" (append - viết tiếp vào cuối file)
    $file = fopen($filename, "a");

    if ($file) {
        // Ghi dòng dữ liệu vào file CSV
        fputcsv($file, $data);
        fclose($file);
        
        // Thông báo thành công
        echo "<h1>送信完了 (Gửi thành công)</h1>";
        echo "<p>お問い合わせ cảm ơn bạn, dữ liệu đã được lưu.</p>";
        echo '<a href="index.html">Quay lại trang chủ</a>';
    } else {
        echo "Lỗi: Không thể lưu dữ liệu.";
    }
} else {
    // Nếu truy cập trực tiếp file PHP mà không qua form
    header("Location: index.html");
    exit();
}
?>
