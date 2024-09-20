<?php
require 'helper.php';
session_start();
error_reporting(1);

$secretKey = '12345678';
$token = @$_GET['token'];
$sig = @$_GET['sig'];

if ($token && $sig) {
    if (hash_equals(hash_hmac('sha256', $token, $secretKey), $sig)) {
        $_SESSION['token'] = $token;
    }
}

if (@$_COOKIE['scn_session']) {
    $sessionCookie = $_COOKIE['scn_session'];
    // Gọi API get-session
    $data = callApiWithSession($_ENV['URL_SERVER_SSO'] . '/api/get-session', $sessionCookie, $secretKey);
    // Kiểm tra phản hồi từ API đầu tiên
    if (@$data['code'] === 200) {
        $user = $data['data']['user'];
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Simple SSO System</title>
    <link rel="stylesheet" href="css/main.css">
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="./asset/css/bootstrap-theme.min.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Nút bấm</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Bảng điều khiển</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if ($_SESSION['token']) {
                    ?>
                        <li><a href="logout.php">Đăng xuất</a></li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a
                                href='<?php echo $_ENV['URL_SERVER_SSO']; ?>/login?redirect_url=<?php echo $_ENV['URL_CLIENT1']; ?>'>Đăng
                                nhập</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <br>
            <center>
                <h1>Trang chủ</h1>
                <br>
                <?php
                if ($_SESSION['token']) {

                ?>
                    <br>
                    <strong>Tên : </strong>
                    <br>
                    <?php echo $user['name'] ?>
                    <br>
                    <br>

                    <strong>Email : </strong>
                    <br>
                    <?php echo $user['email'] ?>
                    <br>
                    <br>

                    <!--                <strong>Secret Key : </strong>-->
                    <!--                <br>-->
                    <!--                --><?php //echo $user->secret_key 
                                            ?>
                    <!--                <br>-->
                    <br>

                    <strong>Token : </strong>
                    <br>
                    <?php echo $_SESSION['token'] ?>

                <?php

                } else {
                ?>
                    Chưa đăng nhập
                <?php
                }
                // function hash_equals($a, $b) {
                //     $key = mcrypt_create_iv(128, MCRYPT_DEV_URANDOM);
                //     return hash_hmac('sha512', $a, $key) === hash_hmac('sha512', $b, $key);
                // }
                ?>
            </center>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="./asset/js/bootstrap.min.js"></script>
</body>

</html>