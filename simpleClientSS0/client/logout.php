<?php

require 'helper.php';

session_start();

$sessionCookie = @$_COOKIE['scn_session'];
$secretKey = '12345678';
$data = callApiWithSession($_ENV['URL_SERVER_SSO'].'/api/log-out', $sessionCookie, $secretKey);

if($data['code'] === 200){
    session_destroy();
}
?>

<script type="text/javascript">
alert("Logout ok!");
document.location.href = "home.php";
</script>