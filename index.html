<?php
// 1. CẤU HÌNH AZURE
$key = '5VwnDuWTIxbBnobiJeTlRwuox8R3LFWYcnnIq7qSEszo4BGXmfdbJQQJ99CBACxCCsyXJ3w3AAAEACOGlPml'; 
$endpoint = 'https://vision-manh-final.cognitiveservices.azure.com/'; 

// 2. CẤU HÌNH DATABASE (Mạnh điền thông tin Database đã tạo ở Bước 2 vào đây)
$db_host = 'TÊN_SERVER_CỦA_MẠNH.mysql.database.azure.com';
$db_user = 'adminmanh';
$db_pass = 'MẬT_KHẨU_CỦA_BẠN';
$db_name = 'TÊN_DATABASE';

$logFile = 'ocr.log';
$csvFile = 'results.csv';
$extractedData = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['receipts'])) {
    $all_log = "";
    $csv_rows = [];

    foreach ($_FILES['receipts']['tmp_name'] as $tmpName) {
        if (!$tmpName) continue;

        // Gọi Azure AI Vision API
        $url = rtrim($endpoint, '/') . '/vision/v3.2/ocr?language=ja';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/octet-stream',
            'Ocp-Apim-Subscription-Key: ' . $key
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($tmpName));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $all_log .= "--- LOG RECEIPT ---\n" . $response . "\n";
        
        $data = json_decode($response, true);
        if (isset($data['regions'])) {
            foreach ($data['regions'] as $region) {
                foreach ($region['lines'] as $line) {
                    $lineText = "";
                    foreach ($line['words'] as $word) { $lineText .= $word['text']; }
                    
                    // Xóa chữ "軽"
                    $cleanText = str_replace('軽', '', $lineText);
                    
                    // Lọc Tên sản phẩm và Giá (Chứa ¥ hoặc 合計)
                    if (preg_match('/¥|\d+|合計/', $cleanText)) {
                        $extractedData[] = $cleanText;
                        $csv_rows[] = [$cleanText];
                    }
                }
            }
        }
    }

    // Ghi file
    file_put_contents($logFile, $all_log);
    $fp = fopen($csvFile, 'w');
    fputcsv($fp, ['Result']);
    foreach ($csv_rows as $row) { fputcsv($fp, $row); }
    fclose($fp);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>FamilyMart OCR</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .box { background: #f8f9fa; border: 1px solid #ddd; padding: 15px; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>FamilyMart Receipt OCR</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="receipts[]" multiple accept="image/*" required>
        <button type="submit">Upload & Process</button>
    </form>

    <?php if (!empty($extractedData)): ?>
        <div class="box">
            <h3>Kết quả trích xuất:</h3>
            <?php foreach ($extractedData as $line): ?>
                <p><?= htmlspecialchars($line) ?></p>
            <?php endforeach; ?>
        </div>
        <div style="margin-top: 20px;">
            <a href="ocr.log" target="_blank">Xem ocr.log</a> | 
            <a href="results.csv" download>Tải results.csv</a>
        </div>
    <?php endif; ?>
</body>
</html>
