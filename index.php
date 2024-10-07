<?php
require_once 'config/dbconfig.php';

ob_start();

if ($user->is_loggedin() != "") {
    if ($_GET["q"] == "") {
        $user->redirect('template/home?' . $_SERVER['QUERY_STRING'] . '');
    } else {
        $user->redirect('template/home?' . $_SERVER['QUERY_STRING'] . '&p=search');
    }
}
if (isset($_POST['btn-login'])) {
    $uname = $_POST['txt_uname_email'];
    $umail = $_POST['txt_uname_email'];
    $upass = $_POST['txt_password'];

    if ($_POST['remember_me'] == 1) {
        $ucheck = "1";
    } else {
        $ucheck = "0";
    }
    if ($user->login($uname, $umail, $upass, $ucheck)) {
        if ($_GET["q"] == "") {
            $user->redirect('template/home?' . $_SERVER['QUERY_STRING'] . '');
        } else {
            $user->redirect('template/home?' . $_SERVER['QUERY_STRING'] . '&p=search');
        }
    } else {
        $error = "Wrong Details !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TKN REPAIR</title>
    <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" />

</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
            <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auto-form-wrapper" style="background: rgba( 255, 255, 255, 0.3 );box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );backdrop-filter: blur( 20px );-webkit-backdrop-filter: blur( 20px );border-radius: 10px;border: 0px solid rgba( 255, 255, 255, 0.18 );color: #ffffff;"> 
                            <form method="post">
                                <div class="form-group">
                                    <label class="label">Your Username</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" value="<?php echo @$_COOKIE["userid"] ?>" name="txt_uname_email" class="form-control" placeholder="Enter Username">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-check-circle-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">Your Password</label>
                                    <div class="input-group">
                                        <input type="password" value="<?php echo @$_COOKIE["userpass"] ?>" name="txt_password" class="form-control" placeholder="Enter Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-check-circle-outline"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button name="btn-login" class="btn btn-primary submit-btn btn-block">Login</button>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <div class="form-check form-check-flat mt-0">
                                        <label class="form-check-label">
                                            <input value="1" name="remember_me" type="checkbox" class="form-check-input"> Remember me
                                        </label>
                                    </div>
                                    <a href="#" class="text-small forgot-password text-blue ">Forgot Password</a>
                                </div>
                                <!-- <div class="form-group">
                                    <button class="btn btn-block g-login">
                                        <img class="mr-3" src="../../images/file-icons/icon-google.svg" alt="">Log in with Google</button>
                                </div> -->
                                <div class="text-block text-center my-3">
                                    <span class="text-small font-weight-semibold">Not a member ?</span>
                                    <a href="register" class="text-blue text-small">Create new account</a>
                                    <?php
                                    $iPod    = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
                                    $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
                                    $iPad    = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
                                    $Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
                                    $webOS   = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");

                                    if ($iPod || $iPhone) {
                                        echo '<a href = "fb://profile/800652090037004">ios</a>';
                                    } else if ($iPad) {
                                        echo '<a href = "fb://profile/800652090037004">ios</a>';
                                    } else if ($Android) {
                                        echo '<a href = "fb://page/800652090037004">android</a>';
                                    } else if ($webOS) {
                                        echo "webOS";
                                    }
                                    ?>

                                    <script>
                                        var ua = navigator.userAgent.toLowerCase();
                                        var isAndroid = ua.indexOf("android") > -1;
                                        if (isAndroid) {
                                            document.write('<a href = "fb://page/800652090037004">android</a>');
                                        }
                                        var ub = navigator.userAgent.toLowerCase();
                                        var isIos = ub.indexOf("iphone") > -1;
                                        if (isIos) {
                                            document.write('<a href = "fb://profile/800652090037004">ios</a>');
                                        }
                                    </script>
                                </div>
                            </form>
                        </div>
                        <ul class="auth-footer">
                            <li>
                                <a href="#">Conditions</a>
                            </li>
                            <li>
                                <a href="#">Help</a>
                            </li>
                            <li>
                                <a href="#">Terms</a>
                            </li>
                        </ul>
                        <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/js/vendor.bundle.addons.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
</body>

</html>