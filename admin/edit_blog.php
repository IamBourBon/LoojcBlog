<?php

include "./includes/database.php";
include "./includes/categories.php";
include "./includes/blog.php";
include "./check_login.php";

$newDB = new database();
$db = $newDB->connect();

$category = new category($db);
$blog = new blog($db);

if(isset($_GET['id'])){
    $blog->n_blog_post_id = $_GET['id'];
    $blog->read_single() ;                            
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
                                    <h2 class="title-1">Edit Blog</h2>
                                </div>
                            </div>
                        </div>


                       
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Blog Info</strong>
                                </div>
                                <div class="card-body card-block">
                                    <form action="./blog.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="title" class=" form-control-label">Title</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="text" id="title" name="title" 
                                                value="<?php echo $blog->v_post_title?>" placeholder="Enter Title category" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="meta_title" class=" form-control-label">Meta title</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="text" id="meta_title" name="meta_title" 
                                                value="<?php echo $blog->v_post_meta_title?>" placeholder="Enter Meta title" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="select" class=" form-control-label">Blog Categories</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <select name="select_category" id="select" class="form-control">
                                                    <?php
                                                    $rs = $category->read();
                                                    $num = $rs->rowCount();

                                                    if ($num > 0) {
                                                        while ($rows = $rs->fetch()) {

                                                    ?>
                                                        <option value="<?php echo $rows['n_category_id'] ?>">
                                                        <?php echo $rows['v_category_title'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="main_image" class=" form-control-label">Main Image</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="file" id="main_image" name="main_image" multiple="" class="form-control-file">
                                            </div>
                                            <?php  
                                            if($blog->v_main_image_url != ""){
                                            ?>
                                            <br>
                                            <img src="../assets/img/upload/blog/<?php echo $blog->v_main_image_url?>" width="400px">
                                            <input type="hidden" name="old_main_image" value="<?php echo $blog->v_main_image_url ?>">
                                            <?php  
                                            }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="alt_image" class=" form-control-label">Alt Image</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="file" id="alt_image" name="alt_image" multiple="" class="form-control-file">
                                            </div>
                                            <?php  
                                            if($blog->v_alt_image_url != ""){
                                            ?>
                                            <br>
                                            <img src="../assets/img/upload/blog/<?php echo $blog->v_alt_image_url?>" width="400px">
                                            <input type="hidden" name="old_alt_image" value="<?php echo $blog->v_alt_image_url ?>">
                                            <?php  
                                            }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="summernote_summary" class=" form-control-label">Summary</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <textarea name="blog_summary" id="summernote_summary" 
                                                rows="9" class="form-control"><?php echo htmlspecialchars_decode($blog->v_post_summary) ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="summernote_content" class=" form-control-label">Blog Content</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <textarea name="blog_content" id="summernote_content" 
                                                rows="9" class="form-control"><?php echo htmlspecialchars_decode($blog->v_post_content) ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="blog_tag" class=" form-control-label">Blog Tags</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="text" id="blog_tag" name="blog_tag" placeholder="Enter Title category" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-3">
                                                <label for="blog_path" class=" form-control-label">Blog Path</label>
                                            </div>
                                            <div class="col-12 col-md-11">
                                                <input type="text" id="blog_path" name="blog_path"
                                                value="<?php echo $blog->v_post_path ?>" placeholder="Enter Title category" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col col-md-12">
                                                <label class=" form-control-label">Home Page Placement</label>
                                            </div>
                                            <div class="col col-md-11">
                                                <div class="form-check-inline form-check">
                                                    <label for="inline-radio1" class="form-check-label ">
                                                        <input type="radio" id="inline-radio1" name="opt_place" value="1" class="form-check-input">One
                                                    </label>
                                                    <label for="inline-radio2" class="form-check-label ">
                                                        <input type="radio" id="inline-radio2" name="opt_place" value="2" class="form-check-input">Two
                                                    </label>
                                                    <label for="inline-radio3" class="form-check-label ">
                                                        <input type="radio" id="inline-radio3" name="opt_place" value="3" class="form-check-input">Three
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="blog_action" value="Edit_blog">
                                        <input type="hidden" name="blog_id" value="<?php echo $blog->n_blog_post_id?>">
                                        <input type="hidden" name="post_view" value="<?php echo $blog->n_blog_post_views?>">
                                        <input type="hidden" name="status" value="<?php echo $blog->f_post_status?>">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Edit Blog
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
        $('#summernote_summary').summernote({
            placeholder: 'Blog summary',
            height: 100
        });

        $('#summernote_content').summernote({
            placeholder: 'Blog content',
            height: 200
        })

    </script>

</body>

</html>
<!-- end document-->