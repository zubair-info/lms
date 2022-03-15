<?php include('header.php') ?>

<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
            <li><a href="javascript:avoid(0)">Issue Book</a></li>


        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInUp">
    <div class="col-md-6 col-sm-offset-3">
        <h4 class="section-subtitle"><b>Issue</b> Books</h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">
                    <div class="col-md-6">
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
                        <form class="form-inline" action="" method="POST">

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="student_id" id="select2-example-basic" class="form-control" style="width: 100%">
                                        <option value="Select Option">Please Select Option </option>
                                        <?php
                                        $get_query = "SELECT * FROM `students` WHERE sts=1";
                                        $result = mysqli_query($db_conect, $get_query);
                                        // $after_assoc = mysqli_fetch_assoc($result);
                                        while ($student = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <option value="<?= $student['id'] ?>"><?= ucwords($student['first_name'] . ' ' . $student['last_name']) . '-(' . $student['reg'] . ')'  ?></option>
                                        <?php } ?>



                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="search" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['search'])) {
                            $id = $_POST['student_id'];
                            $get_query_student = "SELECT * FROM `students` WHERE sts=1 AND id='$id'";
                            $result = mysqli_query($db_conect, $get_query_student);
                            $after_assoc = mysqli_fetch_assoc($result);
                            // print_r($after_assoc);
                        ?>

                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-12">

                                        <form action="issue_book_post.php" method="POST">

                                            <div class="form-group">
                                                <label for="email">Student Name</label>
                                                <input type="text" class="form-control" placeholder="Name" value="<?= ucwords($after_assoc['first_name'] . ' ' . $after_assoc['last_name'])  ?>" readonly>
                                                <input type="hidden" name="student_id" class="form-control" value="<?= $after_assoc['id'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Book Name</label>

                                                <select name="book_id" id="select2-example-basic" class="form-control" style="width: 100%" required>
                                                    <option value="AI">Please Select Option </option>
                                                    <?php
                                                    $get_query_book = "SELECT * FROM `books` WHERE active_sts=1 AND available_qty>0;";
                                                    $result = mysqli_query($db_conect, $get_query_book);
                                                    // $after_assoc_book = mysqli_fetch_assoc($result);
                                                    // $after_assoc = mysqli_fetch_assoc($result);
                                                    while ($book = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                        <option value="<?= $book['id'] ?>"><?= ucwords($book['book_name']) ?></option>
                                                    <?php } ?>



                                                </select>

                                            </div>




                                            <div class="form-group">
                                                <label for="email">Book Issue Date</label>
                                                <input type="text" name="book_issue_date" class="form-control" value="<?= date('d-M-Y') ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Book Issue Return Date</label>
                                                <input type="date" name="book_issue_return_date" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" name="issue_book" class="btn btn-primary"> <i class="fa fa-save"></i> Issue Book</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        <?php


                        }

                        ?>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php') ?>