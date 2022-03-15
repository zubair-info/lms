<?php
session_start();
require_once '../db.php';
$id = $_POST['id'];
$book_issue_return_date    = $_POST['book_issue_return_date	'];
$update_query = "UPDATE issue_books SET book_issue_return_date= '$book_issue_return_date' WHERE id='$id'";
$result = mysqli_query($db_conect, $update_query);
if ($result) {
    $update_query_qty = "UPDATE books SET available_qty= available_qty-1 WHERE id='$book_id'";
    $result_qty = mysqli_query($db_conect, $update_query_qty);
    // $_SESSION['success_msg'] = 'Book Issue Sucessfully!!';
    // header('location: return_book_view.php');
}
if ($result_qty) {
    $update_aprove_sts = "UPDATE issue_books SET approve_sts=1 WHERE id='$id'";

    $result_update_aprove_sts = mysqli_query($db_conect, $update_aprove_sts);
    header('location: return_book_view.php');
}
