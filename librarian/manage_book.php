<?php include('header.php') ?>

<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
            <li><a href="javascript:avoid(0)">Manage Book</a></li>

        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInRight">
    <div class="col-sm-12">
        <!-- <h4 class="section-subtitle"><b>Searching, ordering and paging</b></h4> -->
        <div class="panel">
            <div class="panel-content">
                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Book Name</th>
                                <th>Book Image</th>
                                <th>B.Author Name</th>
                                <th>Publication Name</th>
                                <th>Purchase Date</th>
                                <th>Book Price</th>
                                <th>Book Qty</th>
                                <th>Available Qty</th>
                                <th>Libraian Username</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // include('../db.php');
                            $get_query = "SELECT * FROM `books`";
                            $result = mysqli_query($db_conect, $get_query);
                            // $after_assoc = mysqli_fetch_assoc($result);
                            ?>
                            <?php foreach ($result as $key => $books) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $books['book_name']; ?></td>
                                    <td>
                                        <img src="../<?= $books['image_location'] ?>" alt="" style="width: 100px; height:100px;">

                                    </td>
                                    <td><?= $books['book_author_name']; ?></td>
                                    <td><?= $books['book_publication_name']; ?></td>
                                    <td><?= date('d-M-Y', strtotime($books['book_purchase_date'])) ?></td>
                                    <td><?= $books['book_price']; ?></td>
                                    <td><?= $books['book_qty']; ?></td>
                                    <td>
                                        <?php
                                        if ($books['available_qty'] == 0) :
                                        ?>
                                            <span class="badge bg-danger">Out Of Stock</span>

                                        <?php
                                        else :
                                        ?>
                                            <span><?= $books['available_qty']; ?></span>


                                        <?php
                                        endif

                                        ?>
                                        <!-- <?= $books['available_qty']; ?> -->
                                    </td>
                                    <td><?= $books['libraian_username']; ?></td>
                                    <td>
                                        <!-- <?= $books['active_sts'] == 1 ? 'Active' : 'Inactive' ?> -->
                                        <?php
                                        if ($books['active_sts'] == 1) :
                                        ?>
                                            <span class="badge bg-success">active</span>

                                        <?php
                                        else :
                                        ?>
                                            <span class="badge bg-danger">Deactive</span>


                                        <?php
                                        endif

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($books['active_sts'] == 1) {
                                        ?>
                                            <a href="books_active.php?books_id=<?= $books['id'] ?>" class="btn btn-primary"> <i class="fa fa-arrow-down"></i> Active</a>

                                        <?php

                                        } else {

                                        ?>
                                            <a href="books_inactive.php?books_id=<?= $books['id'] ?>" class="btn btn-warning"> <i class="fa fa-arrow-up"></i> Inactive</a>

                                        <?php


                                        }
                                        ?>
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#book<?= $books['id'] ?>"> <i class="fa fa-eye"></i></a>
                                        <!--INFO modal-->
                                        <!-- <button type="button" class="btn btn-wide btn-info" data-toggle="modal" data-target="#info-modal">Info</button> -->
                                        <!-- Modal -->

                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#book-update<?= $books['id'] ?>"> <i class="fa fa-pencil"></i></a>
                                        <a href="books_delete.php?books_id=<?= $books['id'] ?>" onclick="return confirm('Are You Sure to Delete?')" class="btn btn-danger">Delete</a>

                                    </td>

                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal view/info -->
<?php
// include('../db.php');
$get_query = "SELECT * FROM `books`";
$result = mysqli_query($db_conect, $get_query);
// $after_assoc = mysqli_fetch_assoc($result);
?>
<?php foreach ($result as $key => $books) : ?>
    <div class="modal fade" id="book<?= $books['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header state modal-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Info</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Book Name</th>
                            <td><?= $books['book_name']; ?></td>

                        </tr>
                        <tr>
                            <th>Book Image</th>
                            <td>
                                <img src="../<?= $books['image_location'] ?>" alt="" style="width: 100px; height:100px;">

                            </td>
                        </tr>
                        <tr>
                            <th>B.Author Name</th>
                            <td><?= $books['book_author_name']; ?></td>

                        </tr>
                        <tr>
                            <th>Publication Name</th>
                            <td><?= $books['book_publication_name']; ?></td>

                        </tr>
                        <tr>
                            <th>Purchase Date</th>
                            <td><?= date('d-M-Y', strtotime($books['book_purchase_date'])) ?></td>

                        </tr>
                        <tr>
                            <th>Book Price</th>
                            <td> <?= $books['book_price']; ?> /-</td>

                        </tr>
                        <tr>
                            <th>Book Qty</th>
                            <td><?= $books['book_qty']; ?></td>

                        </tr>
                        <tr>
                            <th>Available Qty</th>
                            <td><?= $books['available_qty']; ?></td>

                        </tr>
                        <tr>
                            <th>Libraian Username</th>
                            <td><?= $books['libraian_username']; ?></td>

                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <!-- <?= $books['active_sts'] == 1 ? 'Active' : 'Inactive' ?> -->
                                <?php
                                if ($books['active_sts'] == 1) :
                                ?>
                                    <span class="badge bg-success">active</span>

                                <?php
                                else :
                                ?>
                                    <span class="badge bg-danger">Deactive</span>


                                <?php
                                endif

                                ?>
                            </td>
                        </tr>

                    </table>


                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button> -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- modal Edit -->
<?php
// include('../db.php');
$get_query = "SELECT * FROM `books`";
$result = mysqli_query($db_conect, $get_query);
// $after_assoc = mysqli_fetch_assoc($result);
?>
<?php foreach ($result as $key => $books) : ?>
    <?php
    $id = $books['id'];
    $get_query_book = "SELECT * FROM `books` WHERE id='$id'";
    $result_book = mysqli_query($db_conect, $get_query_book);
    $after_assoc = mysqli_fetch_assoc($result_book);
    // print_r($after_assoc);
    ?>
    <div class="modal fade" id="book-update<?= $books['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
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
                                    <form class="form-horizontal form-stripe" action="book_update_post.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" class="form-control" name="id" value="<?= $after_assoc['id'] ?>" placeholder="Book Name">

                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">Book Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="<?= $after_assoc['book_name'] ?>" name="book_name" placeholder="Book Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="col-sm-4 control-label">Book Image</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control" value="<?= $after_assoc['book_name'] ?>" name="book_image" placeholder="Book Image">
                                                <img src="../<?= $books['image_location'] ?>" alt="" style="width: 100px; height:100px;">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">Book Author Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="<?= $after_assoc['book_author_name'] ?>" name="book_author_name" placeholder="Book Author Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">Book Publication Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="<?= $after_assoc['book_publication_name'] ?>" name="book_publication_name" placeholder="Book Publication Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">Book Purchase Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" value="<?= $after_assoc['book_purchase_date'] ?>" name="book_purchase_date" placeholder="Book Purchase Date" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">Book Price</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="<?= $after_assoc['book_price'] ?>" name="book_price" placeholder="Book  Price" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">Book Qty</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" value="<?= $after_assoc['book_qty'] ?>" name="book_qty" placeholder="Book Book Qty" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">Book Available Qty</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" value="<?= $after_assoc['available_qty'] ?>" name="available_qty" placeholder="Book Available Qty" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="col-sm-4 control-label">Libraian Username</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="<?= $after_assoc['libraian_username'] ?>" name="libraian_username" placeholder="Libraian Username" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <button type="submit" class="btn btn-primary" name="submit"> <i class="fa fa-save"></i> Update Book</button>
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
    </div>
<?php endforeach ?>
<?php include('footer.php') ?>