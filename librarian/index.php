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
    <div class="col-sm-12 col-lg-9">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
                    <a href="#">
                        <div class="panel-content">
                            <?php
                            // include('../db.php');
                            $get_query = "SELECT * FROM `libraians`";
                            $result = mysqli_query($db_conect, $get_query);
                            $after_assoc_lib = mysqli_num_rows($result);
                            ?>
                            <div class="row">
                                <div class="col-xs-4">
                                    <span class="icon fa fa-user color-darker-2"></span>
                                </div>
                                <div class="col-xs-8">
                                    <h4 class="subtitle color-darker-2">Libraians</h4>
                                    <h1 class="title color-w"><?= $after_assoc_lib; ?></h1>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="panel widgetbox wbox-2 bg-scale-0">
                    <a href="#">
                        <div class="panel-content">
                            <?php
                            // include('../db.php');
                            $get_query = "SELECT * FROM `students`";
                            $result = mysqli_query($db_conect, $get_query);
                            $after_assoc_student = mysqli_num_rows($result);
                            ?>
                            <div class="row">
                                <div class="col-xs-4">
                                    <span class="icon fa fa-user color-darker-1"></span>
                                </div>
                                <div class="col-xs-8">
                                    <h4 class="subtitle color-darker-1">Total Student</h4>
                                    <h1 class="title color-primary"> <?= $after_assoc_student; ?></h1>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-sm-12 col-md-4">
                <div class="panel widgetbox wbox-2 bg-lighter-2 color-light">
                    <a href="#">
                        <div class="panel-content">
                            <?php
                            // include('../db.php');
                            $get_query = "SELECT * FROM `books` Where active_sts=1";
                            $result = mysqli_query($db_conect, $get_query);
                            $after_assoc_book = mysqli_num_rows($result);
                            $book_qty = "SELECT SUM(`book_qty`) as total FROM books";
                            $result_book_qty = mysqli_query($db_conect, $book_qty);
                            $after_assoc_book_qty = mysqli_fetch_assoc($result_book_qty);

                            $avl_qty = "SELECT SUM(`available_qty`) as total FROM books";
                            $result_avl_qty = mysqli_query($db_conect, $avl_qty);
                            $after_assoc_avl_qty = mysqli_fetch_assoc($result_avl_qty);
                            ?>
                            <div class="row">
                                <div class="col-xs-4">
                                    <span class="icon fa fa-user color-darker-2"></span>
                                </div>
                                <div class="col-xs-8">
                                    <h4 class="subtitle color-darker-2">Total Books</h4>
                                    <h1 class="title color-w"><?= $after_assoc_book  . ' -(' . $after_assoc_book_qty['total'] . ' - ' . $after_assoc_avl_qty['total'] . ')' ?></h1>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>



</div>



<?php include('footer.php') ?>