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
    $id = $_POST['id'];
    // die();

    // echo 'update kora jabe';
    $update_query = "UPDATE `books` SET `book_name`='$book_name',`book_author_name`='$book_author_name',`book_publication_name`='$book_publication_name',`book_purchase_date`='$book_purchase_date',`book_price`='$book_price',`book_qty`='$book_qty',`available_qty`='$available_qty',`libraian_username`='$libraian_username' WHERE id=$id";
    mysqli_query($db_conect, $update_query);
    header('location: manage_book.php');

    if ($_FILES['book_image']['name']) {
        $image_orginal_name = $_FILES['book_image']['name'];
        $image_orginal_size = $_FILES['book_image']['size'];


        if ($image_orginal_size <= 2000000) {

            $after_explode = explode('.', $image_orginal_name);
            // print_r($after_explode);
            $image_extention = end($after_explode);
            // print_r($image_extention);
            $allow_extention = array('jpg', 'png', 'jpeg', 'PNG', 'JPEG', 'JPG');
            if (in_array($image_extention, $allow_extention)) {

                $get_image_location = "SELECT image_location FROM books WHERE id=$id";

                $image_location_form_db = mysqli_query($db_conect, $get_image_location);

                $after_assoc_image_location = mysqli_fetch_assoc($image_location_form_db);
                // echo $after_assoc_image_location['image_location'];

                unlink('../' . $after_assoc_image_location['image_location']);
                $image_new_name = $id . "." . $image_extention;
                $save_location = "../uploads/book/" . $image_new_name;
                move_uploaded_file($_FILES['book_image']['tmp_name'], $save_location);
                $image_location = "uploads/book/" . $image_new_name;
                $update_new_image_query = "UPDATE books SET image_location='$image_location' WHERE id=$id";
                mysqli_query($db_conect, $update_new_image_query);
                $_SESSION['success_msg'] = "Data Update Sucessfully!!";
                header('location: manage_book.php');
            }
        }
    }
}
