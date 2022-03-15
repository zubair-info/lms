<?php
session_start();
require_once '../db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $book_id = $_GET['bookid'];
    $date = date('d-M-Y');
    $update_query_return_issue_book = "UPDATE issue_books SET book_return_date='$date' WHERE id='$id'";
    $result = mysqli_query($db_conect, $update_query_return_issue_book);
    if ($result) {
        $update_query_qty = "UPDATE books SET available_qty= available_qty+1 WHERE id='$book_id'";
        $result_qty = mysqli_query($db_conect, $update_query_qty);
        header('location: return_book_view.php');
    }
}
