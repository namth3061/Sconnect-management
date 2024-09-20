<?php
require '../env.php';

try {
    loadEnv(__DIR__ . '/../.env');
} catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}

function callApiWithSession($url, $sessionCookie, $secretKey)
{
    $ch = curl_init($url);
    // Cấu hình cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIE, 'scn_session=' . $sessionCookie);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Origin:".$_ENV['URL_CLIENT1'],
        "Site-Access:" . hash_hmac('sha256', $_ENV['URL_CLIENT1'], $secretKey),
    ]);
    // Thực thi cURL và lấy phản hồi
    $response = curl_exec($ch);
    curl_close($ch);

    // Xử lý phản hồi từ server
    return json_decode($response, true);
}