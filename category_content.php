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

        .img-blur {
            transition: 0.3s;
        }

        .img-blur:hover {
            filter: blur(3px);
        }

        .img-text-up {
            font-size: 30px;
            visibility: hidden;
            transition-delay: 0.2s;
            text-align: center;
            margin-top: -100px;
        }

        .img-text-down {
            font-size: 30px;
            visibility: hidden;
            transition-delay: 0.2s;
            text-align: center;
            margin-top: -100px;
        }

        .img-blur:hover~.img-text-up {
            visibility: visible;
            color: black;
            transition: 0.8s;
            margin-top: -185px;
        }

        .img-blur:hover~.img-text-down {
            visibility: visible;
            color: black;
            transition: 0.8s;
            margin-top: 0px;
        }
    </style>

</head>


<body onload="ActivePage()" class="index-page bg-gray-400">


    <?php include "header.php" ?>


    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">

        <section class="py-5">
            <div class="container">
                <?php
                    $category->n_category_id = $_GET['id'];

                    @$category->read_single();

                ?>
                <div class="page-header min-vh-85">
                    <div>
                        <img class="position-absolute fixed-top z-index-1 d-none d-sm-none d-md-block me-n4 w-80 h-80 border-radius-xl ms-auto" src="./assets/img/upload/category/<?php echo $category->v_category_image_url?>" alt="">
                    </div>
                    
                    <div class="container ">
                        <div class="row mt-7 mb-5 ">
                            <div class="col-lg-6 d-flex justify-content-center flex-column ">
                                <div class="card card-body d-flex justify-content-center shadow-lg border-radius-xl p-5 align-items-center z-index-2 bg-gradient-dark opacity-9">
                                    <h1 class=" text-white mb-4 text-uppercase"><?php echo $category->v_category_title ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <section class="py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 ms-auto me-auto">

                                <?php

                                $blog->n_category_id = $_GET['id'];
                                $rs = @$blog->read_same_category();
                                $totalItem = $rs->rowCount();
                                $totalpage = ceil($totalItem/5);
                                for($i = ($page-1)*5; $i< $pageset && $i< $totalItem; $i++)
                                {      
                                            
                                    $rows = $rs->fetch();
                                         

                                ?>

                                        <div class="card card-plain card-blog mt-5">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card-image position-relative border-radius-lg">
                                                        <div class="blur-shadow-image">
                                                            <a href="./blog_content.php?id=<?php echo $rows['n_blog_post_id'] ?>">
                                                                <img class="img border-radius-lg w-100" src="./assets/img/upload/blog/<?php echo $rows['v_main_image_url']?>">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7 my-auto ms-md-3 mt-md-auto mt-4">
                                                    <h3>
                                                        <a href="./blog_content.php?id=<?php echo $rows['n_blog_post_id'] ?>" class="text-dark font-weight-normal">
                                                            <?php echo $rows['v_post_title'] ?>
                                                        </a>
                                                    </h3>

                                                    <p>
                                                        <a href="./blog_content.php?id=<?php echo $rows['n_blog_post_id'] ?>" class="text-dark">
                                                            <?php echo $rows['v_post_summary'] ?>

                                                            <br>
                                                            <strong>Read More</strong>
                                                        </a>
                                                    </p>
                                                   
                                                    <p>
                                                        <?php echo $rows['d_date_created']?>
                                                    </p>
                                                
                                                </div>
                                            </div>
                                        </div>


                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </section>
        <!-- END Project section w/ 3 images & quote & text -->

        <!-- ---------- Pagination ------------ -->
        <section class="py-7">
            <div class="container">
                <div class="row justify-space-between py-2">
                    <div class="col-lg-4 mx-auto">
                        <ul class="pagination pagination-primary m-4">
                            <?php  
                                for($i=1;$i<=$totalpage;$i++)
                            {
                            ?>
                            <li class="page-item" id="Page">
                                <a class="page-link" href="./blog_content.php?id=<?php $_GET['id']?>&page=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                            <?php  
                            }
                            ?>
                        </ul>
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
    <script>
    function ActivePage(){
            var page = document.getElementById('Page') ; 
            page.classList.add("active");
        }
    </script>

</body>

</html>