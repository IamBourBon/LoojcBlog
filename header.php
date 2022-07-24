<?php

include "./admin/includes/categories.php";
include "./admin/includes/database.php";
include "./admin/includes/blog.php";
include "./admin/includes/blog_sub.php";

$newDB = new database();
$db = $newDB->connect();

$category = new category($db);
$blog = new blog($db);
$sub = new subscriber($db);

if(isset($_POST['sub_action'])){

    $sub->v_sub_email = $_POST['email'];
    $sub->d_date_created = date("Y-m-d", time());
    $sub->d_time_created = date("Y-m-d", time());
    $sub->f_sub_status = 1 ;

    if($sub->create()){
        $flag = "Thanks for subscribe";
    }
}

$page = isset($_GET['page'])?$_GET['page']:1;
$pageset = (5)*$page;


?>

<!-- Navbar -->
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
                                  
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animation dropdown-md dropdown-md-responsive p-3 border-radius-lg mt-0 mt-lg-3" >
                                        <div class="d-none d-lg-block">
                                        <?php 
                                            $rs = $category->read();
                                            $item = $rs->rowCount();
                                            if($item > 0){
                                                while($rows = $rs->fetch()){
                 
                                            ?>
                                            <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                                                <a href="./category_content.php?id=<?php echo $rows['n_category_id']?>" class="dropdown-item py-2 ps-3 border-radius-md" href="./category_content.php">
                                                    <div class="w-100 d-flex align-items-center justify-content-between">
                                                        <div>
                                                            <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">
                                                                <?php echo $rows['v_category_title']?>
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
      <nav class="navbar navbar-expand-lg navbar-dark navbar-absolute bg-transparent shadow-none">
        <div class="container">
            <a class="navbar-brand text-white" href="./index.php">
                <h2 class="text-white">Loojc</h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-header-2" aria-controls="navbar-header-2" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-header-2">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./category.php">
                            Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./blog.php">
                            Blogs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./about.php">
                            About
                        </a>
                    </li>
                </ul>

                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white mx-2" href="#">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
      <div class="page-header min-vh-100" style="background-image: url('./assets/img/header/header1.jpg');" loading="lazy">
          <span class="mask bg-gradient-dark opacity-5"></span>
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 col-md-7 d-flex justify-content-center flex-column">
                      <h1 class="text-white text-center mb-4">Loojc Blog</h1>
                  </div>
              </div>
          </div>
      </div>
  </header>
  <!-- -------- END HEADER 1 w/ text and image on right ------- -->

  <!-- Scroll Page -->

<script>
        window.onscroll = function () { myFunction() };

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