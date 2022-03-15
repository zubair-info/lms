<?php
session_start();
require_once "../db.php";
// print_r($_POST);
// echo $_FILES['book_image']['name'];
if (isset($_POST['submit'])) {
    $book_name = $_POST['book_name'];
    $book_image = $_FILES['book_image'];
    $book_author_name = $_POST['book_author_name'];
    $book_publication_name = $_POST['book_publication_name'];
    $book_purchase_date = $_POST['book_purchase_date'];
    $book_price = $_POST['book_price'];
    $book_qty = $_POST['book_qty'];
    $available_qty = $_POST['available_qty'];
    $libraian_username = $_POST['libraian_username'];
    // die();

    // && $book_author_name == '' && $book_publication_name == '' && $book_purchase_date == '' && $book_price == '' && $book_qty == '' && $available_qty == '' && $libraian_username == ''
    if ($book_name == ' ' && $book_image == ' ' && $book_author_name == '' && $book_publication_name == '' && $book_purchase_date == '' && $book_price == '' && $book_qty == '' && $available_qty == '' && $libraian_username == '') {
        $_SESSION['error_msg'] = "All Fill Are Requried";
        header('location: add_book.php');
    } else {
        // die();
        $upload_image_orginal_name = $_FILES['book_image']['name'];
        $upload_image_orginal_size = $_FILES['book_image']['size'];
        if ($upload_image_orginal_size <= 2000000) {
            $after_explode = explode('.', $upload_image_orginal_name);
            // print_r($after_explode);
            $image_extention = end($after_explode);
            // echo $image_extention;
            $allow_image_extention = array('png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG');
            if (in_array($image_extention, $allow_image_extention)) {
                $insert_query = "INSERT INTO `books`(`book_name`, `image_location`, `book_author_name`, `book_publication_name`, `book_purchase_date`, `book_price`, `book_qty`, `available_qty`, `libraian_username`) VALUES ('$book_name','Primary Location','$book_author_name','$book_publication_name','$book_purchase_date','$book_price','$book_qty','$available_qty','$libraian_username')";
                mysqli_query($db_conect, $insert_query);
                $id_from_db = mysqli_insert_id($db_conect);
                // if ($id_from_db) {
                //     echo $id_from_db;
                // } else {
                //     echo 'nai';
                // }
                $image_new_name = $id_from_db  . "." . $image_extention;
                $save_location = "../uploads/book/" . $image_new_name;
                move_uploaded_file($_FILES['book_image']['tmp_name'], $save_location);
                $image_location = "uploads/book/" . $image_new_name;
                $update_image_location_query = "UPDATE books SET image_location='$image_location' WHERE id=$id_from_db";
                mysqli_query($db_conect, $update_image_location_query);
                $_SESSION['success_msg'] = "Book Update Sucessfully!!";

                header('location: add_book.php');
            } else {
                $_SESSION['error_msg'] = "Plase Valid Extention Png,Jpg,Jpeg";
                header('location: add_book.php');
            }
        } else {
            $_SESSION['error_msg'] = "Image File Is too Big";
            header('location: add_book.php');
        }
    }
}
