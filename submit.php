<?php
// Thiết lập múi giờ Việt Nam hoặc Nhật Bản
date_default_timezone_set('Asia/Tokyo');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Nhận dữ liệu từ form (khớp với thuộc tính 'name' trong HTML)
    $name    = $_POST['student_name'] ?? 'N/A';
    $email   = $_POST['student_email'] ?? 'N/A';
    $content = $_POST['content'] ?? 'N/A';
    $date    = date("Y-m-d H:i:s");

    // 2. Tên file CSV sẽ lưu
    $filename = "contacts.csv";

    // 3. Chuẩn bị dữ liệu để ghi vào CSV
    $data_row = [$date, $name, $email, $content];

    // 4. Mở file (chế độ 'a' để ghi thêm vào cuối file)
    $file = fopen($filename, "a");

    if ($file) {
        // Thêm BOM UTF-8 để file CSV hiển thị đúng tiếng Việt/Nhật khi mở bằng Excel
        if (filesize($filename) == 0) {
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
        }

        // Ghi dữ liệu vào file
        fputcsv($file, $data_row);
        fclose($file);

        // 5. Hiển thị thông báo thành công cho Mạnh
        echo "<!DOCTYPE html>
        <html lang='ja'>
        <head>
            <meta charset='UTF-8'>
            <title>送信完了</title>
            <style>
                body { font-family: sans-serif; text-align: center; padding: 50px; background-color: #f4f7f9; }
                .card { background: white; padding: 30px; border-radius: 10px; display: inline-block; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                h1 { color: #28a745; }
                a { color: #0078d4; text-decoration: none; font-weight: bold; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h1>送信に成功しました！</h1>
                <p>お問い合わせ内容を受け付けました。</p>
                <p><strong>名前:</strong> $name</p>
                <hr>
                <p><a href='index.html'>← フォームに戻る</a></p>
                <p><small>CSVを確認する: <a href='contacts.csv' target='_blank'>contacts.csv</a></small></p>
            </div>
        </body>
        </html>";
    } else {
        echo "エラー: ファイルに書き込めませんでした。";
    }
} else {
    // Nếu truy cập trực tiếp file này, sẽ tự động chuyển về trang chủ index.html
    header("Location: index.html");
    exit();
}
?>