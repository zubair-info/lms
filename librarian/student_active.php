<?php
session_start();
// print_r($_GET);
require_once('../db.php');

$id = $_GET['student_id'];
echo $update_sts_query = "UPDATE students SET sts=0 WHERE id=$id";
mysqli_query($db_conect, $update_sts_query);

header('location: student.php');
// $_SESSION['make_active_sts_sucess'] = "Active Sucessfully!!";