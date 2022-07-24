<?php

include "./admin/includes/categories.php";
include "./admin/includes/database.php";
include "./admin/includes/blog.php";
include "./admin/includes/blog_contact.php";

$newDB = new database();
$db = $newDB->connect();
$category = new category($db);
$blog = new blog($db);
$contact = new contact($db);

if(isset($_POST['contact_action'])){
    $contact->v_email = $_POST['email'];
    $contact->v_fullname = $_POST['fullname'];
    $contact->v_message = $_POST['message'];
    $contact->v_favorite = $_POST['favorite'];
    $contact->d_date_created = date("Y-m-d", time());
    $contact->d_time_created = date("Y-m-d", time());
    $contact->f_contact_status = 1 ;

    if($contact->create()){
        $flag = "Thanks and We will contact you soon";
    }
}

?>

<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent ">
    <div class="container">
        <a class="navbar-brand text-white " href="./index.php">
            <h2 class="text-white">Loojc</h2>
        </a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0 ms-lg-12 ps-lg-5" id="navigation">
            <ul class="navbar-nav navbar-nav-hover ms-auto">
                <li class="nav-item dropdown dropdown-hover mx-2 ms-lg-6">
                    <a href="./index.php" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                        <i class="material-icons opacity-6 me-2 text-md">dashboard</i>
                        Home
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="./category.php" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                        <i class="material-icons opacity-6 me-2 text-md">article</i>
                        Categories
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="./blog.php" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                        <i class="material-icons opacity-6 me-2 text-md">view_day</i>
                        Blogs
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a href="./about.php" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                        <i class="material-icons opacity-6 me-2 text-md">article</i>
                        About
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div id="MyNavbar">
    <div class="row">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                <div class="container-fluid px-0">
                    <a class="navbar-brand font-weight-bolder ms-sm-3" href="./index.php" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom">
                        <h4>Loojc Blog</h4>
                    </a>

                    <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                        <ul class="navbar-nav navbar-nav-hover ms-auto">
                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a href="./index.php" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                                    <i class="material-icons opacity-6 me-2 text-md">dashboard</i>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a href="./category.php" class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuBlocks" aria-expanded="true">
                                    <i class="material-icons opacity-6 me-2 text-md">article</i>
                                    Categories
                                    <img src="./assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-auto ms-md-2">
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive p-3 border-radius-lg mt-0 mt-lg-3">
                                    <div class="d-none d-lg-block">
                                        <?php
                                        $rs = $category->read();
                                        $item = $rs->rowCount();
                                        if ($item > 0) {
                                            while ($rows = $rs->fetch()) {

                                        ?>
                                                <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                                                    <a href="./category_content.php?id=<?php echo $rows['n_category_id'] ?>" class="dropdown-item py-2 ps-3 border-radius-md" href="./category_content.php">
                                                        <div class="w-100 d-flex align-items-center justify-content-between">
                                                            <div>
                                                                <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">
                                                                    <?php echo $rows['v_category_title'] ?>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </ul>

                            </li>
                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a href="./blog.php" class="nav-link ps-2 d-flex cursor-pointer align-items-center" id="dropdownMenuBlocks" aria-expanded="false">
                                    <i class="material-icons opacity-6 me-2 text-md">view_day</i>
                                    Blogs
                                </a>
                            </li>

                            <li class="nav-item dropdown dropdown-hover mx-2">
                                <a href="./about.php" class="nav-link ps-2 d-flex cursor-pointer align-items-center">
                                    <i class="material-icons opacity-6 me-2 text-md">article</i>
                                    About
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>

<header>
    <div class="page-header min-height-400" style="background-image: url('./assets/img/city-profile.jpg');" loading="lazy">
        <span class="mask bg-gradient-dark opacity-8"></span>
    </div>
</header>

<script>
    window.onscroll = function() {
        myFunction()
    };

    // Get the header
    var header = document.getElementById("MyNavbar");

    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("container");
            header.classList.add("position-sticky");
            header.classList.add("z-index-sticky");
            header.classList.add("top-0");
        } else {
            header.classList.remove("container");
            header.classList.remove("position-sticky");
            header.classList.remove("z-index-sticky");
            header.classList.remove("top-0");
        }
    }
</script>