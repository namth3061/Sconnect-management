<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    redirectHome();
}

function redirectHome()
{
    $redirectUrl = 'http://sconnect.local/system/dashboard';
    $token = "token_sso";
    $sign = "sign_sso";
    $redirectUrlWithParams = $redirectUrl . "?token=" . urlencode($token) . "&sign=" . urlencode($sign);
    header("Location: " . $redirectUrlWithParams);
    exit();
}
