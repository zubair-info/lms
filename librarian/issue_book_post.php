|<?php
    session_start();
    require_once '../db.php';

    if (isset($_POST['issue_book'])) {

        $student_id = $_POST['student_id'];
        $book_id = $_POST['book_id'];
        $book_issue_date  = $_POST['book_issue_date'];
        $book_issue_return_date  = date('d-M-Y', strtotime($_POST['book_issue_return_date']));


        if ($student_id == ' ' && $book_id == ' ' && $book_issue_date == ' ') {
            $_SESSION['error_msg'] = 'All fill are requried';
            header('location: issue_book.php');
        } else {
            $insert_query = "INSERT INTO `issue_books`( `student_id`, `book_id`, `book_issue_date`,`book_issue_return_date`) VALUES ('$student_id','$book_id','$book_issue_date','$book_issue_return_date')";
            $result = mysqli_query($db_conect, $insert_query);
            if ($result) {
                $update_query = "UPDATE books SET available_qty= available_qty-1 WHERE id='$book_id'";
                $result_qty = mysqli_query($db_conect, $update_query);
                // $_SESSION['success_msg'] = 'Book Issue Sucessfully!!';
                header('location: issue_book.php');
            }
            // if ($result_qty) {
            //     $update_aprove_sts = "UPDATE issue_books SET approve_sts=1 WHERE id='$student_id'";

            //     // $result_update_aprove_sts = mysqli_query($db_conect, $update_aprove_sts);
            //     // $_SESSION['success_msg'] = 'Book Issue Sucessfully!!';

            //     header('location: issue_book.php');
            // }
        }
    }


    // print_r($_POST);


    ?>