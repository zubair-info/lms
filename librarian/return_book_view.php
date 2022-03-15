<?php include('header.php') ?>

<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
            <li><a href="javascript:avoid(0)">Return Book</a></li>

        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <?php

        if (isset($_SESSION['success_msg'])) {

        ?>
            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success_msg'];
                unset($_SESSION['success_msg']);

                ?>
            </div>

        <?php
        }

        ?>
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Roll</th>
                                <th>Reg.No</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Book Name</th>
                                <th>Image</th>
                                <th>Book Issue Date</th>
                                <th>Book Issue Return Date</th>
                                <th>Approve</th>
                                <th>Return Book</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // include('../db.php');
                            $get_query = "SELECT issue_books.id,issue_books.book_id, issue_books.book_issue_date,issue_books.book_issue_return_date,students.first_name,students.last_name,students.roll,students.reg,students.phone,students.email,books.book_name,books.image_location
                                            FROM issue_books
                                            INNER JOIN students ON students.id=issue_books.student_id
                                            INNER JOIN books ON books.id=issue_books.book_id
                                            WHERE issue_books.book_return_date=''";
                            $result = mysqli_query($db_conect, $get_query);
                            // $after_assoc = mysqli_fetch_assoc($result);
                            ?>
                            <?php foreach ($result as $key => $return_book) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $return_book['first_name'] . ' ' . $return_book['first_name']; ?></td>
                                    <td><?= $return_book['roll']; ?></td>
                                    <td><?= $return_book['reg']; ?></td>
                                    <td><?= $return_book['phone']; ?></td>
                                    <td><?= $return_book['email']; ?></td>
                                    <td><?= $return_book['book_name']; ?></td>
                                    <td>
                                        <img src="../<?= $return_book['image_location']; ?>" alt="" width="80px;" height="80px;">
                                    </td>
                                    <td><?= $return_book['book_issue_date']; ?></td>

                                    <td>
                                        <?php
                                        $book_return = $return_book['book_issue_return_date'];
                                        if ($book_return) {
                                            echo $book_return;
                                        } else {
                                            echo '-';
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <?php
                                        if ($return_book['book_issue_return_date'] == '') {
                                        ?>
                                            <!-- <a class="btn btn-danger" href="approve_book.php?id=<?= $return_book['id']; ?>">Approve</a> -->
                                            <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#book-update<?= $return_book['id'] ?>"> <i class="fa fa-check"></i>Approve</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="javascript:avoid(0)" class="btn btn-success">Approved</a>
                                        <?php
                                        }
                                        ?>

                                    </td>
                                    <td><a class="btn btn-primary" href="return_book.php?id=<?= $return_book['id']; ?>&bookid=<?= $return_book['book_id']; ?>">Return Book</a></td>


                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- return book  -->

<?php foreach ($result as $return_book) : ?>
    <div class="modal fade" id="book-update<?= $return_book['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header state modal-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal form-stripe" action="approve_book_post.php" method="POST">
                                        <input type="hidden" class="form-control" name="id" value="<?= $return_book['id'] ?>">

                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">Book Return Issue Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" name="book_issue_return_date	" placeholder="Book Return  Date" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <button type="submit" class="btn btn-primary" name="submit"> <i class="fa fa-save"></i>Book Approved</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
<?php endforeach ?>
<?php include('footer.php') ?>