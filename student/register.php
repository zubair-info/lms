<?php
session_start();
require_once('../db.php');
if (isset($_SESSION['user_status'])) {

    header('location: index.php');
}

if (isset($_POST['submit'])) {
    // print_r($_POST);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $roll = $_POST['roll'];
    $reg = $_POST['reg'];
    $user_name = $_POST['user_name'];
    $phone = $_POST['phone'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email_lower = strtolower($email);
    $valid_email = filter_var($email_lower, FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];
    $pass_upper = preg_match('@[A-Z]@', $password);
    $pass_lower = preg_match('@[a-z]@', $password);
    $pass_num = preg_match('@[0-9]@', $password);
    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
    $pass_char = preg_match($pattern, $password);
    $confirm_password = $_POST['confirm_pass'];
    // $confirm_pass = $_POST['confirm_pass'];

    if ($first_name == '' && $last_name == '' && $email == '' && $roll == '' && $reg == '' && $user_name == '' && $phone == '' && $password == '' && $confirm_password == '') {
        $_SESSION['error_msg'] = "All Fill Are Requried";
    } else {
        if ($valid_email) {

            if (strlen($password) < 8) {
                $_SESSION['error_msg'] = 'Password should be at least 5 characters!';
                // header('location:register.php');
            } elseif (!$pass_upper == 1) {
                $_SESSION['error_msg'] = "Password must include at least  one upper letter!";
                // header('location:register.php');
            } elseif (!$pass_lower == 1) {
                $_SESSION['error_msg'] = "Password should include at least one lower case letter!";
                // header('location:register.php');
            } elseif (!$pass_num == 1) {
                $_SESSION['error_msg'] = "Password should include at least one number!";
                // header('location:register.php');
            } elseif (!$pass_char == 1) {
                $_SESSION['error_msg'] = "Password should include at least one doller sing!";
                // header('location:register.php');
            } else if ($password !== $confirm_password) {
                $_SESSION['error_msg'] = "Password Does not match!";
                // header('location:register.php');
            } else {

                $pass_encrypt = md5($password);
                $pass_encrypt = password_hash($pass_encrypt, PASSWORD_DEFAULT);

                // $conf_pass_encrypt = md5($confirm_password);
                // $conf_pass_encrypt = password_hash($conf_pass_encrypt, PASSWORD_DEFAULT);

                $duplicate_email_check = "SELECT COUNT(*) AS total_email FROM students WHERE email='$valid_email'";
                $db_query_result = mysqli_query($db_conect, $duplicate_email_check);

                $after_associte_res = mysqli_fetch_assoc($db_query_result);
                // print_r($after_associte_res);

                if ($after_associte_res['total_email'] == 0) {

                    // echo 'data insert kora jabe';

                    $insert_query = "INSERT INTO `students`(`first_name`, `last_name`, `email`, `roll`, `reg`, `user_name`, `password`, `phone`) VALUES ('$first_name','$last_name','$valid_email','$roll','$reg','$user_name','$pass_encrypt','$phone')";
                    mysqli_query($db_conect, $insert_query);
                    // $_SESSION['success_msg'] = 'Congarts!! Your Registration Sucessfully!!';

                    // header('location:register.php');
                } else {

                    $_SESSION['error_msg'] = 'Email Already Register';
                    // header('location:register.php');
                    // echo 'Email Already Register';
                }
                // echo 'Strong password.';

            }
        } else {
            // echo 'invalid email';
            $_SESSION['error_msg'] = 'Email Invalid';
            // header('location:register.php');
        }
    }
}
?>
<!doctype html>
<html lang="en" class="fixed accounts sign-in">


<!-- Mirrored from myiideveloper.com/helsinki/last-version/helsinki_green-dark/src/pages_sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Mar 2019 13:05:33 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Helsinki</title>
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body>
    <div class="wrap">
        <!-- page BODY -->
        <!-- ========================================================= -->
        <div class="page-body animated slideInDown">
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            <!--LOGO-->
            <div class="logo">
                <!-- <img alt="logo" src="images/logo-dark.png" /> -->
                <!-- <h1 class="text-center">LMS</h1> -->
            </div>
            <div class="box">
                <!--SIGN IN FORM-->
                <div class="panel mb-none">
                    <div class="panel-content bg-scale-0">
                        <?php

                        if (isset($_SESSION['error_msg'])) {

                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo $_SESSION['error_msg'];
                                unset($_SESSION['error_msg']);

                                ?>
                            </div>

                        <?php
                        }
                        ?>
                        <?php

                        if (isset($_SESSION['success_msg'])) {

                        ?>
                            <div class="alert alert-success" role="alert">
                                <?php
                                echo $_SESSION['success_msg'];
                                unset($_SESSION['success_msg']);

                                ?>
                            </div>

                        <?php
                        }

                        ?>

                        <form action="" method="POST">
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="first_name" placeholder=" First Name">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="number" class="form-control" pattern="[0-9]{6}" name="roll" placeholder="Roll Number">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="number" class="form-control" pattern="[0-9]{6}" name="reg" placeholder="Registration Number">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="user_name" placeholder="User Name">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group mt-md">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="phone" pattern="01[1|3|4|5|6|7|8|9][0-9]{8}" placeholder="phone number">
                                    <i class="fa fa-envelope"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-with-icon">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <i class="fa fa-key"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="input-with-icon">
                                    <input type="password" class="form-control" name="confirm_pass" placeholder="Confirm Password">
                                    <i class="fa fa-key"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <div class="checkbox-custom checkbox-primary">
                                    <input type="checkbox" id="terms" value="option1">
                                    <label class="check" for="terms">I agree </label> to the <a href="#">Terms and Conditions</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" name="submit">Register</button>
                            </div>
                            <div class="form-group text-center">
                                Have an account?, <a href="login.php">Sign In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        </div>
    </div>
    <!--BASIC scripts-->
    <!-- ========================================================= -->
    <script src="../assets/vendor/jquery/jquery-1.12.3.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/vendor/nano-scroller/nano-scroller.js"></script>
    <!--TEMPLATE scripts-->
    <!-- ========================================================= -->
    <script src="../assets/javascripts/template-script.min.js"></script>
    <script src="../assets/javascripts/template-init.min.js"></script>
    <!-- SECTION script and examples-->
    <!-- ========================================================= -->
</body>


<!-- Mirrored from myiideveloper.com/helsinki/last-version/helsinki_green-dark/src/pages_register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Mar 2019 13:06:17 GMT -->

</html>