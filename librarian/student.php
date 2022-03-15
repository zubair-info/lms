<?php include('header.php') ?>

<div class="content-header">
    <!-- leftside content header -->
    <div class="leftside-content-header">
        <ul class="breadcrumbs">
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
            <li><a href="javascript:avoid(0)">Student</a></li>

        </ul>
    </div>
</div>
<!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
<div class="row animated fadeInRight">
    <div class="col-sm-12">
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
                                <th>User Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // include('../db.php');
                            $get_query = "SELECT * FROM `students`";
                            $result = mysqli_query($db_conect, $get_query);
                            // $after_assoc = mysqli_fetch_assoc($result);
                            ?>
                            <?php foreach ($result as $key => $student) : ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $student['first_name']; ?></td>
                                    <td><?= $student['roll']; ?></td>
                                    <td><?= $student['reg']; ?></td>
                                    <td><?= $student['phone']; ?></td>
                                    <td><?= $student['email']; ?></td>
                                    <td><?= $student['user_name']; ?></td>
                                    <td><?= $student['image_location']; ?></td>
                                    <td>

                                        <?= $student['sts'] == 1 ? 'Active' : 'Inactive' ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($student['sts'] == 1) {
                                        ?>
                                            <a href="student_active.php?student_id=<?= $student['id'] ?>" class="btn btn-primary"> <i class="fa fa-arrow-down"></i> Active</a>

                                        <?php

                                        } else {

                                        ?>
                                            <a href="student_inactive.php?student_id=<?= $student['id'] ?>" class="btn btn-warning"> <i class="fa fa-arrow-up"></i> Inactive</a>

                                        <?php


                                        }
                                        ?>

                                        <a href="#" class="btn btn-danger">Delete</a>
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
<?php include('footer.php') ?>