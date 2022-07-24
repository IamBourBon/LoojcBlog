<?php

include "./includes/database.php";
include "./includes/blog_comment.php";
include "./check_login.php";

$newDB = new database();
$db = $newDB->connect();

$comment = new blog_comment($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['comment_action'] == 'del_comment') {

        $comment->n_blog_comment_id = $_POST['comment_id'];
       
        
        if ($comment->delete()) {
            $flag = "Delete comment success";
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
                                    <h2 class="title-1">Blog Contact</h2>
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
                            <div class="table-responsive m-b-30">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Parent ID</th>
                                            <th>Blog_Id</th>
                                            <th>Author</th>
                                            <th>Email</th>
                                            <th>Comment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $result = $comment->read();
                                        $num = $result->rowCount();
                                        if ($num > 0) {
                                            while ($rows = $result->fetch()) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $rows['n_blog_comment_id'] ?></td>
                                                    <td><?php echo $rows['n_blog_comment_parent_id'] ?></td>
                                                    <td><?php echo $rows['n_blog_post_id'] ?></td>
                                                    <td><?php echo $rows['v_comment_author'] ?></td>
                                                    <td><?php echo $rows['v_comment_author_email'] ?></td>
                                                    <td><?php echo $rows['v_comment'] ?></td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Del_category<?php echo $rows['n_blog_comment_id'] ?>">Delete</button>
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
                $result = $comment->read();
                $num = $result->rowCount();
                if ($num > 0) {
                    while ($rows = $result->fetch()) {
                ?>

                        <div class="modal fade" id="Del_category<?php echo $rows['n_blog_comment_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
                                            Do you want to delete this comment ?
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="comment_action" value="del_comment">
                                            <input type="hidden" name="comment_id" value="<?php echo $rows['n_blog_comment_id'] ?>">
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