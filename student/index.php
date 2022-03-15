<?php include('header.php'); ?>

<!-- content HEADER -->
<!-- ========================================================= -->
<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>

        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <div class="col-sm-12">
        <h4>All Issue Book</h4>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Book Name</th>
                                <th>Book Image</th>
                                <th>Book Issue Date</th>
                                <th>Book Issue Return Date</th>
                                <th>Book Return Date</th>

                            </tr>
                        </thead>
                        <?php
                        $student_id = $_SESSION['student_id'];
                        $get_query = "SELECT issue_books.book_issue_date,issue_books.book_issue_return_date,issue_books.book_return_date,books.book_name,books.image_location
                                      FROM books 
                                      INNER JOIN issue_books ON issue_books.book_id=books.id 
                                      WHERE issue_books.student_id='$student_id'";
                        $result = mysqli_query($db_conect, $get_query);
                        // $after_assoc = mysqli_fetch_assoc($result);
                        // print_r($after_assoc);
                        foreach ($result as $key => $row) :
                        ?>

                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $row['book_name'] ?></td>
                                <td>
                                    <img src="../<?= $row['image_location'] ?>" alt="" width="50px;" height="50px">

                                </td>
                                <td><?= $row['book_issue_date'] ?></td>
                                <td><?= $row['book_issue_return_date'] ?></td>
                                <td><?= $row['book_return_date'] ?></td>

                            </tr>


                        <?php endforeach ?>

                    </table>
                </div>
            </div>
        </div>

    </div>
</div>



<?php include('footer.php') ?>