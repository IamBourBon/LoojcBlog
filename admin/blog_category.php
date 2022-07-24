<?php

include "./includes/database.php";
include "./includes/categories.php";
include "./check_login.php";

$newDB = new database();
$db = $newDB->connect();

$category = new category($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if ($_POST['category_action'] == 'add_category') {

        $target_file = "../assets/img/upload/category/";
        $main_image = "";
        if (!empty($_FILES['url_main_image']['name'])) {
            $main_image = $_FILES['url_main_image']['name'];
            move_uploaded_file($_FILES['url_main_image']['tmp_name'], $target_file . $main_image);
        } else {
            $main_image = "default.jpg";
        }

        $category->v_category_title = $_POST['title'];
        $category->v_category_meta_title = $_POST['meta_title'];
        $category->v_category_path = $_POST['path'];
        $category->v_category_image_url = $main_image;
        $category->d_date_created = date("Y-m-d",time());
        $category->d_time_created = date("Y-m-d",time());

        if ($category->create()) {
            $flag = "Create category success";
        }
    }

    if ($_POST['category_action'] == 'edit_category') {
        
        $target_file = "../assets/img/upload/category/";
        $main_image = "";
    
        if (!empty($_FILES['url_main_image']['name'])) {
            $main_image = $_FILES['url_main_image']['name'];
            move_uploaded_file($_FILES['url_main_image']['tmp_name'], $target_file . $main_image);
            if(in_array('old_main_image', $_POST)){
                if(!empty($_POST['old_main_image'])){
                    unlink($target_file.$_POST['old_main_image']);
                }
            }
        } else if(!empty($_POST['old_main_image'])) {
            $main_image = $_POST['old_main_image'];
        }else {
            $main_image = "default.jpg";
        }

        $category->n_category_id = $_POST['category_id'];
        $category->v_category_title = $_POST['title'];
        $category->v_category_meta_title = $_POST['meta_title'];
        $category->v_category_image_url = $main_image;
        $category->v_category_path = $_POST['path'];

        if ($category->update()) {
            $flag = "Update category success";
        }
    }

    if ($_POST['category_action'] == 'del_category') {
        
        $target_file = "../assets/img/upload/category/";
        $category->n_category_id = $_POST['category_id'];
        if(in_array('category_image', $_POST)){
            if(!empty($_POST['category_image'])){
                unlink($target_file.$_POST['category_image']);
            }
        }
        
        if ($category->delete()) {
            $flag = "Delete category success";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="./index.php">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list">
                        <li>
                            <a href="./index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="./blog_category.php">
                                <i class="fas fa-chart-bar"></i>Blog Categories
                            </a>
                        </li>
                        <li>
                            <a href="./blog.php">
                                <i class="fas fa-table"></i>Blogs
                            </a>
                        </li>
                        <li>
                            <a href="./write_blog.php">
                                <i class="far fa-check-square"></i>Write Blog
                            </a>
                        </li>
                        <li>
                            <a href="./blog_contact.php">
                                <i class="fas fa-calendar-alt"></i>Blog Contact
                            </a>
                        </li>
                        <li>
                            <a href="./blog_comment.php">
                                <i class="fas fa-map-marker-alt"></i>Blog Comments
                            </a>
                        </li>
                        <li>
                            <a href="./blog_subcribers.php">
                                <i class="fas fa-map-marker-alt"></i>Blog Subcribers
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- SIDEBAR -->
        <?php include "./sidebar.php" ?>

        <!-- PAGE CONTAINER-->
        <div class="page-container">

            <!-- HEADER DESKTOP-->
            <?php include "./header.php" ?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Blog Categories</h2>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($flag)) {

                        ?>
                            <div class="alert alert-success" role="alert">
                                <strong><?php echo $flag ?></strong>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Add Category</strong>
                                </div>
                                <div class="card-body card-block">
                                    <form enctype="multipart/form-data" action="" method="POST">
                                        <div class="form-group">
                                            <label for="title" class=" form-control-label">Category Title</label>
                                            <input type="text" name="title" id="title" placeholder="Enter your title" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_title" class=" form-control-label">Category Meta Title</label>
                                            <input type="text" name="meta_title" id="meta_title" placeholder="Enter your meta title" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="path" class=" form-control-label">Category Path</label>
                                            <input type="text" name="path" id="path" placeholder="Enter your path" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="url_main_image" class=" form-control-label">Main Image</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="file" id="url_main_image" name="url_main_image" multiple="" class="form-control-file">
                                            </div>
                                        </div>
                                        <input type="hidden" name="category_action" value="add_category">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="table-responsive m-b-30">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Meta title</th>
                                            <th>Category Path</th>
                                            <th>Category Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $result = $category->read();
                                        $num = $result->rowCount();
                                        if ($num > 0) {
                                            while ($rows = $result->fetch()) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $rows['n_category_id'] ?></td>
                                                    <td><?php echo $rows['v_category_title'] ?></td>
                                                    <td><?php echo $rows['v_category_meta_title'] ?></td>
                                                    <td><?php echo $rows['v_category_path'] ?></td>
                                                    <td><?php echo $rows['v_category_image_url'] ?></td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm">View</button>
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Edit_category<?php echo $rows['n_category_id'] ?>">Edit</button>
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Del_category<?php echo $rows['n_category_id'] ?>">Delete</button>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                $result = $category->read();
                $num = $result->rowCount();
                if ($num > 0) {
                    while ($rows = $result->fetch()) {
                ?>
                        <div class="modal fade" id="Edit_category<?php echo $rows['n_category_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mediumModalLabel">Edit Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>


                                    <form enctype="multipart/form-data" action="" method="POST">
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="title" class=" form-control-label">Category Title</label>
                                                <input type="text" name="title" id="title" value="<?php echo $rows['v_category_title'] ?>" placeholder="Enter your title" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_title" class=" form-control-label">Category Meta Title</label>
                                                <input type="text" name="meta_title" id="meta_title" value="<?php echo $rows['v_category_meta_title'] ?>" placeholder="Enter your meta title" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="path" class=" form-control-label">Category Path</label>
                                                <input type="text" name="path" id="path" value="<?php echo $rows['v_category_path'] ?>" placeholder="Enter your path" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <div class="col col-md-3">
                                                    <label for="main_image" class=" form-control-label">Main Image</label>
                                                </div>
                                                <div class="col-12 col-md-11">
                                                    <input type="file" id="main_image" name="url_main_image" class="form-control-file">
                                                </div>
                                                <?php
                                                if ($category->v_category_image_url != "") {
                                                ?>
                                                    <input type="hidden" name="old_main_image" value="<?php echo $category->v_category_image_url ?>">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="category_action" value="edit_category">
                                            <input type="hidden" name="category_id" value="<?php echo $rows['n_category_id'] ?>">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="Del_category<?php echo $rows['n_category_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="mediumModalLabel">Delete Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            Do you want to delete this category ?
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="category_action" value="del_category">
                                            <input type="hidden" name="category_id" value="<?php echo $rows['n_category_id'] ?>">
                                            <input type="hidden" name="category_image" value="<?php echo $rows['v_category_image_url'] ?>">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

            </div>

            <?php include "./footer.php" ?>

            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>


</html>
<!-- end document-->