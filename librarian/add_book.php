<?php include('header.php') ?>


<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
            <li><a href="javascript:avoid(0)">Add Book</a></li>


        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInRight">
    <div class="col-md-6 col-sm-offset-3">
        <h4 class="section-subtitle"><b>Add</b> Books</h4>
        <div class="panel">
            <div class="panel-content">
                <div class="row">

                    <form class="form-horizontal form-stripe" action="add_book_post.php" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Book Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="book_name" placeholder="Book Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-sm-4 control-label">Book Image</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" name="book_image" placeholder="Book Image">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Book Author Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="book_author_name" placeholder="Book Author Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Book Publication Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="book_publication_name" placeholder="Book Publication Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Book Purchase Date</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="book_purchase_date" placeholder="Book Purchase Date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Book Price</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="book_price" placeholder="Book  Price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Book Book Qty</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="book_qty" placeholder="Book Book Qty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Book Available Qty</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="available_qty" placeholder="Book Available Qty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Libraian Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="libraian_username" placeholder="Libraian Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" class="btn btn-primary" name="submit"> <i class="fa fa-save"></i> Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include('footer.php') ?>