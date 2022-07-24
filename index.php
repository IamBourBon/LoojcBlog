<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png"> -->
  <!-- <link rel="icon" type="image/png" href="./assets/img/favicon.png"> -->

  <title>Loojc Blog</title>

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/material-kit.css" rel="stylesheet" />

  <style>
    .nav-link:hover {
      background-color: #adb5bd;
      color: #343a40;
      transition: color 0.4s ease-in-out, background-color 0.4s ease-in-out, border-color 0.4s ease-in-out;
      border-radius: 7px;
    }

    .set-h {
      /* background-color: red; */
      height: 300px !important;
    }

    .bg-secret {
      background-color: rgb(178, 164, 255) !important;
    }
  </style>
</head>


<body class="index-page bg-gray-400">


  <?php include "header.php" ?>


  <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">

    <section class="my-5 mb-n1 py-5">
      <div class="container">
        <div class="row">
          <div class="row justify-content-center text-center">
            <div class="col-lg-6">
              <span class="badge bg-primary mb-3">
                <h2 class="text-white mb-0 letter-spacing-5">Welcome My Blog</h2>
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="my-4 mb-n1 py-5">
      <div class="container">
        <div class="row">
          <div class="row justify-content-center text-center">
            <div class="col-lg-6">
              <h2 class="text-dark mb-0">All Categories</h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-6 position-relative ">
      <div id="carousel-testimonial-pricing" class=" carousel slide carousel-team" data-bs-ride="carousel">
        <div class="carousel-inner ">
          <?php
          $rs = $category->read();
          $item = $rs->rowCount();
          if ($item > 0) {
            while ($rows = $rs->fetch()) {

          ?>

              <div class="carousel-item active bg-gray-400 border-radius-md shadow-lg">
                <div class="container">
                  <div class="row align-items-center ">
                    <div class="col-md-8 p-lg-5 ms-lg-auto">
                      <div class="p-3 set-h">
                        <img class="w-90 border-radius-md shadow-lg" src="assets/img/upload/category/<?php echo $rows['v_category_image_url'] ?>" alt="First slide">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-7 me-lg-auto position-relative">
                      <a href="./category_content.php?id=<?php echo $rows['n_category_id'] ?>">
                        <h3 class="text-dark">
                          <?php echo $rows['v_category_title'] ?>
                        </h3>
                        <p class="my-4">
                          <?php echo $rows['v_category_meta_title'] ?>
                        </p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>

          <?php
            }
          }
          ?>
        </div>
        <a class="carousel-control-prev text-dark text-lg" href="#carousel-testimonial-pricing" role="button" data-bs-slide="prev">
          <i class="fas fa-chevron-left"></i>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next text-dark text-lg" href="#carousel-testimonial-pricing" role="button" data-bs-slide="next">
          <i class="fas fa-chevron-right"></i>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </section>

    <section class="my-4 mb-n1 py-5">
      <div class="container">
        <div class="row">
          <div class="row justify-content-center text-center">
            <div class="col-lg-6">
              <h2 class="text-dark mb-0">Top Blog View</h2>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="my-3 py-5">
      <div class="container">
        <div class="row align-items-center">
          <?php
          $rs = $blog->MostViewBlog();
          $item = $rs->rowCount();
          if ($item > 0) {
            while ($rows = $rs->fetch()) {

          ?>
              <div class="col-lg-4 ms-auto me-auto p-lg-4 mt-lg-0 mt-4">
                <div class="rotating-card-container">
                  <div class="card card-rotate card-background card-background-mask-primary shadow-primary mt-md-0 mt-5">
                    <div class="bg-gray-300">
                      <img class="w-100 h-100" src="./assets/img/upload/blog/<?php echo $rows['v_main_image_url']?>">
                      <div class="card-body py-7 text-center">
                        <h3 class="text-rose"><?php echo $rows['v_post_title'] ?></h3>
                      </div>
                    </div>
                    <div class="back back-background" >
                      <div class="card-body pt-7 text-center">
                        <h3 class="text-dark">
                          <?php echo $rows['v_post_meta_title'] ?>
                        </h3>
                        <p class="text-white opacity-8">
                          <?php echo $rows['v_post_summary'] ?>
                        </p>
                        <a href="./blog_content.php?id=<?php echo $rows['n_blog_post_id'] ?>" class="btn btn-white btn-sm w-50 mx-auto mt-3">Read more</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          <?php
            }
          }
          ?>


        </div>
      </div>
    </section>


    <section class="py-6 bg-gradient-dark position-relative overflow-hidden">
      <img src="assets/img/upload/blog/default.jpg" class="position-absolute top-0 d-lg-block d-none opacity-6 w-100" alt="pattern">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-8 mx-auto text-center">
            <h3 class="text-white">Latest Blog Posts</h3>
          </div>
        </div>
        <div class="row d-flex align-items-center">
          <?php
          $rs = $blog->ThreeLastestBlog();
          $item = $rs->rowCount();
          if ($item > 0) {
            while ($rows = $rs->fetch()) {
              @$category->n_category_id = $rows['n_category_id'];
              @$category->read_single();
          ?>
              <div class="col-lg-4 mb-lg-0 mb-4">
                <div class="card">
                  <div class="card-header p-0 m-3 mt-n4 position-relative z-index-2">
                    <a class="d-block blur-shadow-image">
                      <img src="./assets/img/upload/blog/<?php echo $rows['v_main_image_url']?>" alt="img-blur-shadow" class="img-fluid border-radius-lg">
                    </a>
                  </div>
                  <div class="card-body pt-2">
                    <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                      <?php echo $category->v_category_title ?>
                    </span>
                    <a href="./blog_content.php?id=<?php echo $rows['n_blog_post_id'] ?>" class="text-darker card-title h5 d-block">
                      <?php echo $rows['v_post_title'] ?>
                    </a>
                    <p class="card-description mb-4">
                      <?php echo $rows['v_post_summary'] ?>
                    </p>
                  </div>
                </div>
              </div>


          <?php
            }
          }
          ?>
        </div>
      </div>
    </section>

    <?php
    if (isset($flag)) {
    ?>
      <div class="alert alert-success text-white font-weight-bold" role="alert">
        <?php echo $flag; ?>
      </div>
    <?php
    }
    ?>


    <section class="py-9">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-4">
            <div class="icon icon-shape icon-md bg-gradient-primary shadow-warning mx-auto text-center mb-4">
              <i class="material-icons opacity-10">person</i>
            </div>
            <h3>Subscribe</h3>
            <p>This is the paragraph where you can write more details about your product.</p>
          </div>
        </div>
        <div class="row justify-content-center mt-4">
          <div class="col-lg-6">
            <form method="post" action="">
              <div class="row">
                <div class="col-sm-8">
                  <div class="input-group input-group-outline">
                    <label class="form-label">Your Email...</label>
                    <input name="email" class="form-control" type="email">
                  </div>
                </div>
                <div class="col-sm-4 ps-0">
                  <input type="hidden" name="sub_action">
                  <button type="submit" class="btn bg-gradient-primary w-100">Subscribe</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>


  <?php include "footer.php" ?>

  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>


  <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
  <script src="./assets/js/plugins/countup.min.js"></script>

  <script src="./assets/js/plugins/choices.min.js"></script>

  <script src="./assets/js/plugins/prism.min.js"></script>
  <script src="./assets/js/plugins/highlight.min.js"></script>

  <!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
  <script src="./assets/js/plugins/rellax.min.js"></script>
  <!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
  <script src="./assets/js/plugins/tilt.min.js"></script>
  <!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
  <script src="./assets/js/plugins/choices.min.js"></script>


  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="./assets/js/plugins/parallax.min.js"></script>

  <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
  <script src="./assets/js/material-kit.min.js?v=3.0.4" type="text/javascript"></script>


  <script type="text/javascript">
    if (document.getElementById('state1')) {
      const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
      if (!countUp.error) {
        countUp.start();
      } else {
        console.error(countUp.error);
      }
    }
    if (document.getElementById('state2')) {
      const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
      if (!countUp1.error) {
        countUp1.start();
      } else {
        console.error(countUp1.error);
      }
    }
    if (document.getElementById('state3')) {
      const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
      if (!countUp2.error) {
        countUp2.start();
      } else {
        console.error(countUp2.error);
      };
    }
  </script>


</body>

</html>