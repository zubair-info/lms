
<?php
session_start();

require('../db.php');
// print_r($_POST);
if (isset($_SESSION['user_status'])) {

    header('location: index.php');
}

$email = $_POST['email'];
$password = $_POST['password'];

$password_encypt = md5($_POST['password']);

if (empty($email)) {
    $_SESSION['error_msg_email'] = 'Email is Required!';
    header('location:login.php');
} elseif (empty($password)) {
    $_SESSION['error_msg_pass'] = 'Password is Required!';
    header('location:login.php');
} else {

    $check_query = "SELECT COUNT(*) AS total_user FROM students WHERE email='$email'";

    $db_form = mysqli_query($db_conect, $check_query);
    // print_r($db_form);

    $after_assoc = mysqli_fetch_assoc($db_form);

    // print_r($after_assoc);

    if ($after_assoc['total_user'] == 1) {
        // echo 'ok';

        $select_email2 = "SELECT * FROM students WHERE email='$email'";
        $select_email2_result = mysqli_query($db_conect, $select_email2);
        $after_assoc_email2 = mysqli_fetch_assoc($select_email2_result);

        if (password_verify($password_encypt, $after_assoc_email2['password'])) {
            if ($after_assoc_email2['sts'] == 1) {
                $_SESSION['user_status'] = 'yes';
                $_SESSION['email'] = $email;
                $_SESSION['student_id'] = $after_assoc_email2['id'];
                // $_SESSION['login_korche'] = 'login korche';
                header('location:index.php');
            } else {
                // echo "inactive";

                $_SESSION['login_error'] = 'You Are Inactive';
                header('location:login.php');
            }
        } else {
            $_SESSION['login_error'] = 'Password are Invalid';
            header('location:login.php');
        }
    } else {
        // echo 'login kora jabe na';
        $_SESSION['login_error'] = 'Your Email and Password are Invalid';
        header('location:login.php');
    }
}
