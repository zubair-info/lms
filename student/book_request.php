<?php
session_start();
require_once '../db.php';

$student_id = $_SESSION['student_id'];
$book_issue_date = date('d-M-Y');
echo $book_id = $_GET['books_id'];


$insert_query = "INSERT INTO `issue_books`( `student_id`, `book_id`, `book_issue_date`,`book_issue_return_date`) VALUES ('$student_id','$book_id','$book_issue_date','$book_issue_return_date')";
$result = mysqli_query($db_conect, $insert_query);
if ($result) {
    $update_query = "UPDATE books SET available_qty= available_qty-1 WHERE id='$book_id'";
    $result = mysqli_query($db_conect, $update_query);
    header('location: books.php');
}
