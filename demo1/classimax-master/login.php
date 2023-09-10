<?php
include('../includeClasses/crud.php');
session_start();
if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    header("Location:../dashboard.php");
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- SITE TITTLE -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calssimax</title>

    <!-- PLUGINS CSS STYLE -->
    <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Owl Carousel -->
    <link href="plugins/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
    <!-- Fancy Box -->
    <link href="plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet">
    <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="plugins/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet">
    <!-- CUSTOM CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- FAVICON -->
    <link href="img/favicon.png" rel="shortcut icon">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- style -->
    <style>
        body {
            overflow-x: hidden;
        }

        .first {
            margin-left: 400px;



        }

        .row2 {
            margin-left: 203px;
        }

        .font {
            font-size: 14px;
        }



        .second {
            height: 220px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .bg-log {
            padding: 0;
            width: 100%;
            background-color: grey;
        }

        .border {
            border-color: gray;
            border-width: .2px;
        }

        .log {
            background-color: lightgray;
        }
    </style>
</head>

<body class="body-wrapper">

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg  navigation">
                        <a class="navbar-brand" href="index.php">
                            <img src="images/logo.png" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto main-nav ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>



                                <li class="nav-item dropdown dropdown-slide">
                                    <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Categories <span><i class="fa fa-angle-down"></i></span>
                                    </a>
                                    <!-- Dropdown list -->
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <?php
                                        // $select_categories = "SELECT * FROM categories";
                                        // $result_categories = mysqli_query($con, $select_categories);
                                        // while ($row_categories = mysqli_fetch_array($result_categories)) {
                                        $crud = new Crud();
                                        $rows = $crud->showCategories();
                                        foreach ($rows as $row_categories) {
                                            $cat_name = $row_categories['category_name'];
                                            $cat_id = $row_categories['category_id'];
                                            echo "<a class='dropdown-item' href='filter_category.php?category_id=$cat_id'>$cat_name</a>";
                                        }
                                        ?>
                                    </div>

                                </li>
                            </ul>
                            <ul class="navbar-nav ml-auto mt-10">
                                <li class="nav-item">
                                    <a class="nav-link login-button" href="login.php">Login</a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- body -->


    <!-- 2 -->


    <div class="container-fluid col-md-5 border px-0 my-5">
        <h5 class="  px-4 py-3 log">Login Now</h5>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-10">
                <form action="" method="post">
                    <div class="form-outline mb-4">
                        <!-- username field -->
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Enter your username"
                            autocomplete="off" required name="username" />
                    </div>
                    <div class="form-outline mb-4">

                        <div class="form-outline mb-4">
                            <!-- password field -->
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Enter your password"
                                autocomplete="off" required name="password" />
                        </div>
                        <div class="form-outline mb-4">
                            <label for="keep_log" class="form-label ">
                                <input type="checkbox" name="keep_log" id="keep_log"><span class="px-2">Keep me logged
                                    in</span></label>
                            <div class="mt-4 pt-2 ">
                                <input type="submit" value="Login" style="background-color: rgb(86, 114, 249);"
                                    class="text-white  py-2 px-5 border-0" name="login_admin">

                            </div>
                </form>
            </div>
        </div>
    </div>
    <!-- php code -->
    <?php
    if (isset($_POST['login_admin'])) {
        $username = trim(strtolower($_POST['username']));
        $password = $_POST['password'];
        // $select = "SELECT * FROM login WHERE username='$username' AND password='$password'";
        // $result = mysqli_query($con, $select);
        // $row = mysqli_num_rows($result);
        $row = $crud->isLogin($username, $password);
        if ($row > 0) {
            if (isset($_POST['keep_log'])) {
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie('username', $username, $cookie_time, '/');
            }
            $_SESSION['username'] = $username;
            echo "<script>window.open('../dashboard.php','_self');</script>";
        } else {
            ?>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6'></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Username or password is invalid!',
                });
            </script>
            <?php
        }
    }
    ?>

    <!--============================
=            Footer            =
=============================-->

    <footer class=" p-3 text-center footer" style="background-color: rgb(86, 114, 249);">
        <p class="text-white fw-bold"> All rights reserved ©- Made with love by Yousef Zaqout-
            <?= date("Y") ?>
        </p>
    </footer>
    <!-- JAVASCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".star-rating input").click(function () {
                var rating = $(this).val();
                alert("You rated this " + rating + " stars.");
            });
        });
    </script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="plugins/tether/js/tether.min.js"></script>
    <script src="plugins/raty/jquery.raty-fa.js"></script>
    <script src="plugins/bootstrap/dist/js/popper.min.js"></script>
    <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="plugins/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>
    <script src="plugins/slick-carousel/slick/slick.min.js"></script>
    <script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
    <script src="plugins/smoothscroll/SmoothScroll.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
    <script src="js/scripts.js"></script>

</body>

</html>