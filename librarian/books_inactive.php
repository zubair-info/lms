<?php
session_start();
// print_r($_GET);
require_once('../db.php');

$id = $_GET['books_id'];
$update_sts_query = "UPDATE books SET active_sts=1 WHERE id=$id";
mysqli_query($db_conect, $update_sts_query);

header('location: manage_book.php');
