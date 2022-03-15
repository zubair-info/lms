<?php
session_start();
// print_r($_GET);
require_once('../db.php');

$id = $_GET['student_id'];
$update_sts_query = "UPDATE students SET sts=1 WHERE id=$id";
mysqli_query($db_conect, $update_sts_query);

header('location: student.php');
