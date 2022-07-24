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


<body onload="hide_form_reply()" class="index-page bg-gray-400">


    <?php include "header_blog.php" ?>

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
        <section class="py-5">

            <!-- ------------ Blog Title ----------- -->
            <?php
            $blog->n_blog_post_id = $_GET['id'];
            $blog->read_single();

            ?>
            <section class="py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 mx-auto text-center">
                            <div class="card card-blog card-plain">
                                <div class="card-header p-0 position-relative z-index-2">
                                    <a class="d-block blur-shadow-image">
                                        <img src="./assets/img/upload/blog/<?php echo $blog->v_main_image_url?>" alt="img-blur-shadow" class="img-fluid border-radius-lg">
                                    </a>
                                </div>
                                <div class="card-body px-0 pt-4">
                                    <p class="text-gradient text-primary text-gradient font-weight-bold text-sm text-uppercase">Enterprise</p>
                                    <h2>
                                        <?php echo $blog->v_post_title ?>
                                    </h2>
                                    <p>
                                        <strong>
                                            <?php echo $blog->v_post_summary ?>
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ----------- Blog Content ----------- -->
            <section class="py-7">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-11 col-md-12 ms-auto order-1 order-md-1 order-lg-1">
                            <div class="p-3 pt-0">
                                <h4 class="mb-4"><?php echo $blog->v_post_meta_title ?></h4>
                                <p>
                                    <?php echo $blog->v_post_content ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ----------- Comment ------------- -->
            <?php
            $comment->n_blog_post_id = $_GET['id'];
            $rs = $comment->read_in_blog();
            $num_comment = $rs->rowCount();
            ?>
            <section class="py-7">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ms-auto me-auto">
                            <div>
                                <h4 class="text-center mb-5">
                                    <?php echo empty($num_comment) ? "Comments" : "$num_comment Comments" ?>
                                </h4>
                                <?php

                                if ($num_comment > 0) {
                                    while ($rows = $rs->fetch()) {
                                        if ($rows['n_blog_comment_parent_id'] == 0) {



                                ?>
                                            <div class="d-flex">
                                                <div>

                                                    <div class="position-relative">
                                                        <div class="blur-shadow-avatar rounded-circle">
                                                            <img class="avatar" src="assets/img/team-4.jpg" alt="...">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="ms-3">
                                                    <h6><?php echo $rows['v_comment_author'] ?><span class="text-muted text-xs"><?php echo " | " . $rows['d_date_created'] ?></span></h6>

                                                    <p><?php echo $rows['v_comment'] ?></p>

                                                    <div class="ms-auto text-end">
                                                        <a href="#reply" class="btn text-dark px-2 btn-link" onclick="reply_comment(<?php echo $rows['n_blog_comment_id']?>)">
                                                            <i class="fa fa-reply"></i>Reply
                                                        </a>
                                                    </div>
                                                    <?php 
                                                    $comment->n_blog_post_id = $_GET['id'];
                                                    $comment->n_blog_comment_parent_id = $rows['n_blog_comment_id'];
                                                    
                                                    $result = $comment->reply_comment();
                                                    
                                                    $item = $result->rowCount();
                                                    if($item > 0){
                                                        while($rows = $result->fetch()){
                                                   
                                                    ?>
                                                    
                                                    <div class="d-flex">
                                                        <div>

                                                            <div class="position-relative">
                                                                <div class="blur-shadow-avatar rounded-circle">
                                                                    <img class="avatar" src="assets/img/team-2.jpg" alt="...">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="ms-3">
                                                            <h6><?php echo $rows['v_comment_author']?><span class="text-muted text-xs"><?php echo " | ".$rows['d_date_created']?></span></h6>

                                                            <p><?php echo $rows['v_comment']?></p>

                                                        </div>
                                                    </div>
                                                   
                                                    <?php         
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                <?php
                                        }
                                    }
                                }
                                ?>


                            </div>

                            <div id="comment">
                                <h4 class="text-center mb-4 mt-5">Post your comment</h4>
                                <div class="container py-4">
                                    <div class="row">
                                        <div class="col-lg-12 mx-auto d-flex justify-content-center flex-column">
                                            <form name="c_form" onsubmit="return check_respond()" role="form" id="contact-form" method="POST" autocomplete="off">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <label class="form-label">Name</label>
                                                                <input name="c_name" class="form-control" aria-label="Your Name" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="input-group input-group-dynamic">
                                                            <label class="form-label">Email</label>
                                                            <input name="c_email" type="email" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-4 input-group-static">
                                                        <label>Your message</label>
                                                        <textarea name="c_message" class="form-control" id="message" rows="4"></textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-9 mx-auto">
                                                            <button name="submit_comment" type="submit" class="btn bg-gradient-dark w-100">Send Message</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="reply">
                                <h4 class="text-center mb-4 mt-5" id="reply">Reply Comment</h4>
                                <div class="container py-4">
                                    <div class="row">
                                        <div class="col-lg-12 mx-auto d-flex justify-content-center flex-column">
                                            <form name="c_form_reply" onsubmit="return check_reply()" role="form" id="contact-form" method="post" autocomplete="off">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="input-group input-group-dynamic mb-4">
                                                                <label class="form-label">Name</label>
                                                                <input name="c_name_reply" class="form-control" aria-label="Your Name" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="input-group input-group-dynamic">
                                                            <label class="form-label">Email</label>
                                                            <input name="c_email_reply" type="email" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="input-group mb-4 input-group-static">
                                                        <label>Your message</label>
                                                        <textarea name="c_message_reply" class="form-control" id="message" rows="4"></textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="hidden" name="blog_comment_id">
                                                            <button name="submit_comment_reply" type="submit" class="btn bg-gradient-dark w-100">Send Message</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


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
    <script src="./assets/js/material-kit.js" type="text/javascript"></script>
    <script src="./assets/js/material-kit.min.js" type="text/javascript"></script>
    <script src="./assets/js/material-kit.js.map" type="text/javascript"></script>
    
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
        function check_respond() {
            if (document.c_form.c_name.value == "") {
                alert("Author name is not empty!");
                document.c_form.c_name.focus();
                return false;
            }
            if (document.c_form.c_email.value == "") {
                alert("Author email is not empty!");
                document.c_form.c_email.focus();
                return false;
            }
            if (document.c_form.c_message.value == "") {
                alert("Author message is not empty!");
                document.c_form.c_message.focus();
                return false;
            }
            return true;
        }

        var blog_comment_id;

        function reply_comment(comment_id) {
            blog_comment_id = comment_id;
            document.getElementById("comment").style.display = "none";
            document.getElementById("reply").style.display = "block";
        }


        function hide_form_reply() {
            document.getElementById("reply").style.display = "none";
        }

        function check_reply() {
            if (document.c_form_reply.c_name_reply.value == "") {
                alert("Author name is not empty!");
                document.c_form_reply.c_name_reply.focus();
                return false;
            }
            if (document.c_form_reply.c_email_reply.value == "") {
                alert("Author email is not empty!");
                document.c_form_reply.c_email_reply.focus();
                return false;
            }
            if (document.c_form_reply.c_message_reply.value == "") {
                alert("Author message is not empty!");
                document.c_form_reply.c_message_reply.focus();
                return false;
            }
            document.c_form_reply.blog_comment_id.value = blog_comment_id;
            return true;
        }
    </script>


</body>

</html>