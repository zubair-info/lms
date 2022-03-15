<?php include('header.php') ?>

<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
            <li><a href="javascript:avoid(0)">Books</a></li>

        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

<div class="animated fadeInUp">
    <!--SEARCH-->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-content">
                    <form class="" method="POST" action="">
                        <div class="row pt-md">
                            <div class="form-group col-sm-9 col-lg-10">
                                <span class="input-with-icon">
                                    <input type="text" class="form-control" name="search_result" id="lefticon" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                            <div class="form-group col-sm-3  col-lg-2 ">
                                <button type="submit" name="books_search" class="btn btn-primary btn-block">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    <!--RESULTS-->

    <?php

    if (isset($_POST['books_search'])) {
        $result = $_POST['search_result'];

    ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-content">
                        <div class="search-results-grid">
                            <div class="row">

                                <?php
                                // $get_query_boook_search = "SELECT * FROM `books` WHERE book_name LIKE '%$result%'";
                                $get_query_boook_search = "SELECT * FROM `books`";
                                $result_search = mysqli_query($db_conect, $get_query_boook_search);
                                // $after_assoc_book = mysqli_fetch_assoc($result);

                                $student_id = $_SESSION['student_id'];
                                $get_query_issue = "SELECT book_id FROM issue_books  WHERE student_id='$student_id' AND approve_sts=1 GROUP BY book_id";
                                $result_query_issue = mysqli_query($db_conect, $get_query_issue);


                                //     $p = $issue_book['book_id'];
                                //     print_r($issue_book['book_id']);
                                //     echo "-";

                                //     // if ($aab['id'] != $issue_book['book_id']) {
                                //     //     $active = 'disabled btn-danger';
                                //     //     $title = 'Allready';
                                //     // } else {
                                //     //     $active = " btn-primary";
                                //     //     $title = 'Book Request';
                                //     // }
                                // }



                                // $issue_book_issue = $issue_book['book_id'];
                                // if ($after_assoc_book_check['id'] == $issue_book_issue) {
                                // echo '</br>';
                                // echo $after_assoc_book_check['id'];

                                // echo $issue_book['book_id'];

                                // echo $issue_book['book_id'];

                                foreach ($result_search as $after_assoc_book) : //book list =5 output=1,2,3,4,5
                                    // print_r($after_assoc_book['id']); foreach //issue book=4 output=1,2,3,4

                                    // $issue_book = mysqli_fetch_assoc($result_query_issue); //issue book=1>5
                                    // echo '</br>';
                                    // print_r($issue_book);
                                    // $bk = array_column($issue_book, 'book_id');
                                    // echo $issue_book['book_id'];
                                    // echo '</br>';
                                    // echo $after_assoc_book['id'];
                                    // if ($issue_book == NULL) {
                                    //     $issue_book['book_id'] = 0;
                                    // }
                                    // $bid = array_column($after_assoc_book, 'book_name');
                                    // print_r($bid);
                                    foreach ($result_query_issue as $issue_book) {
                                        print_r($after_assoc_book['id']);
                                        echo ">|";
                                        print_r($issue_book['book_id']);

                                        if (array_search($after_assoc_book['id'], $issue_book)) {
                                            $active = 'disabled btn-danger';
                                            $title = 'Allready';
                                            // echo 'ok';
                                        } else {
                                            $active = " btn-primary";
                                            $title = 'Book Request';
                                            // echo 'milenai';
                                            // echo '</br>';
                                        }
                                    }



                                ?>
                                    <div class="col-sm-6 col-md-3">
                                        <a href="#"><img alt="photo" src="../<?= $after_assoc_book['image_location'] ?>" class="img-responsive"></a>
                                        <div class="search-item-content">
                                            <p> <b style="font-size: 16px; margin:15px;">Book Name:</b><span style="font-size: 16px; "><?= $after_assoc_book['book_name'] ?></span></p>
                                            <p> <b style="font-size: 16px; margin:15px;">Book Qty:</b><span style="font-size: 16px; "><?= $after_assoc_book['book_qty'] ?></span></p>
                                            <p> <b style="font-size: 16px; margin:15px;">Book Avl.Qty:</b><span style="font-size: 16px; ">
                                                    <?php
                                                    if ($after_assoc_book['available_qty'] == 0) :
                                                    ?>
                                                        <span class="badge bg-danger">Out Of Stock</span>

                                                    <?php
                                                    else :
                                                    ?>
                                                        <span><?= $after_assoc_book['available_qty']; ?></span>


                                                    <?php
                                                    endif

                                                    ?>
                                                </span></p>
                                            <!-- <p>Book Qty: <?= $after_assoc_book['book_qty'] ?></p> -->
                                            <!-- <a href="book_request.php?books_id=<?= $after_assoc_book['id'] ?>" class="btn btn-primary ">Book Request</a> -->
                                            <!-- <?php
                                                    if ($after_assoc_book['available_qty'] == 0) :
                                                    ?>
                                                <span class="btn btn-danger">Out Of Stock</span>

                                            <?php
                                                    else :
                                            ?>
                                                <a href="book_request.php?books_id=<?= $after_assoc_book['id'] ?>" class="btn  <?= $active ?>"><?= $title ?></a>


                                            <?php
                                                    endif

                                            ?> -->
                                            <a href="book_request.php?books_id=<?= $after_assoc_book['id'] ?>" class="btn  <?= $active ?>"><?= $title ?></a>


                                        </div>
                                    </div>
                                <?php endforeach ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php
    }
    ?>
</div>


<?php include('footer.php') ?>