<?php

include "./includes/database.php";
include "./includes/edit_user.php";
include "./check_login.php";

$newDB = new database();
$db = $newDB->connect();
$new_user = new user($db);
$new_user->n_user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Update_Profile'])) {

        $file_upload = $_FILES['ImageProfile'];
        $image_name = "";


        if (!empty($file_upload['name'])) {
            //clean file upload 
            $file = pathinfo($file_upload['name']);
            $extension = $file['extension'];
            $access_extension = array('jpg', 'png');
            if (in_array($extension, $access_extension)) {
                $target_file = "./images/";
                $image_name = $file_upload['name'];
                move_uploaded_file($file_upload['tmp_name'], $target_file . $image_name);
            }
        } else {
            $image_name = $_POST['old_image_profile'];
        }

        $new_user->n_user_id = $_SESSION['user_id'];
        $new_user->v_fullname = $_POST['Fullname'];
        $new_user->v_email = $_POST['Email'];
        $new_user->v_username = $_POST['Username'];
        if ($_POST['Password'] != $_POST['Old_password']) {
            $new_user->v_password = md5($_POST['Password']);
        } else {
            $new_user->v_password = $_POST['Old_password'];
        }
        $new_user->v_phone = $_POST['PhoneNumber'];
        $new_user->v_image = $image_name;
        $new_user->v_message = $_POST['AboutProfile'];
        $new_user->d_date_updated = date("Y-m-d", time());
        $new_user->d_time_updated = date("Y-m-d", time());

        if ($new_user->update()) {
            $flag = "Update success";
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

    <link href="summernote/summernote.min.css" rel="stylesheet">
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
        <?php
        $result = $new_user->ReadSingle();
        $row = $result->fetch();
        ?>
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
                                    <h2 class="title-1">User Profile</h2>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($flag)) {
                        ?>
                            <div class="alert alert-success">
                                <strong><?php echo $flag ?></strong>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>User Info</strong>
                                </div>
                                <div class="card-body card-block">
                                    <form action="./blog_user.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="title" class=" form-control-label">Fullname</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="text" id="title" name="Fullname" value="<?php echo $row['v_fullname'] ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="meta_title" class=" form-control-label">Email</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="email" id="meta_title" name="Email" value="<?php echo $row['v_email'] ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="user_name" class=" form-control-label">Username</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="text" id="user_name" value="<?php echo $row['v_username'] ?>" name="Username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="password" class=" form-control-label">Password</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="password" value="<?php echo $row['v_password'] ?>" id="password" name="Password" class="form-control">
                                                <input type="hidden" value="<?php echo $row['v_password'] ?>" name="Old_password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="phone" class=" form-control-label">Phone Number</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="text" id="phone" name="PhoneNumber" class="form-control" value="<?php echo $row['v_phone'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="main_image" class=" form-control-label">Image Profile</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="file" id="main_image" name="ImageProfile" class="form-control-file">
                                                <input type="hidden" name="old_image_profile" class="form-control-file" value="<?php echo $row['v_image'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="summernote_content" class=" form-control-label">About me</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <textarea name="AboutProfile" id="summernote_content" rows="9" class="form-control">
                                                    <?php echo $row['v_message'] ?>
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="Update_Profile">
                                            <input type="hidden" name="user_id" value="<?php $row['n_user_id'] ?>">
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Update Profile
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <?php include "./footer.php" ?>
                    </div>
                </div>
            </div>
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
    <script src="summernote/summernote.min.js"></script>
    <script>
        $('#summernote_content').summernote({
            placeholder: 'About me',
            height: 200
        })
    </script>

</body>

</html>
<!-- end document-->