<?php
include('../includeClasses/crud.php');
?>
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
            margin-left: 110px;
            margin-top: 50px;
        }

        .row2 {
            margin-left: 203px;
        }

        .font {
            font-size: 14px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .star-rating .hidden {
            display: none;
        }



        .star-rating label {
            padding: 5px;
            float: right;
            font-size: 35px;
            color: #eee;
        }

        .star-rating input:not(:checked)~label:hover,
        .star-rating input:not(:checked)~label:hover~label {
            color: #ffc107;
        }

        .star-rating input:checked {
            color: #ffc107;
        }

        .star-rating {
            display: inline-block;
            font-size: 0;
            margin-bottom: 0;
            padding: 0;
            position: relative;
            vertical-align: middle;
            text-align: center;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label.star {
            color: #bbb;
            font-size: 4rem;
            font-style: normal;
            font-weight: normal;
            line-height: .1;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .star-rating label.star:hover,
        .star-rating label.star:hover~label.star,
        .star-rating input[type="radio"]:checked~label.star {
            color: #f90;
        }

        /* .second {
            height: 500px;
        } */

        .footer {
            position: fixed;
            bottom: 0;
        }

        .card-body {
            height: 250px;
            /* Change the height value to your desired height */
            /* overflow: hidden; */
            /* Add overflow property to enable scrolling if content overflows */
        }

        input {
            cursor: pointer;
        }

        .img2 {
            width: 200px;
            height: 200px;
            object-fit: contain;
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
                                        $showCategories = $crud->showCategories();
                                        foreach ($showCategories as $row_categories) {
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
    <div class="col-md-10 first ">
        <div class="card ">
            <!-- php code -->
            <?php
            if (isset($_GET['store_id'])) {
                $store_id = $_GET['store_id'];
                // $select_store_info = "SELECT * FROM stores WHERE store_id = $store_id";
                // $result_info = mysqli_query($con, $select_store_info);
                // $row_info = mysqli_fetch_array($result_info);
                $row_info = $crud->showStoresWithCondition($store_id);
                $store_name = $row_info[0]['store_name'];
                $category_id = $row_info[0]['category_id'];
                // $select_category_name = "SELECT * FROM categories WHERE category_id = $category_id";
                // $result_category_name = mysqli_query($con, $select_category_name);
                // $row_category_name = mysqli_fetch_array($result_category_name);
                $row_category_name = $crud->showCategoriesWithCondition($store_id);
                $category_name = $row_category_name[0]['category_name'];
                $store_phone = $row_info[0]['store_phone'];
                $store_address = $row_info[0]['store_address'];
                $store_image = $row_info[0]['store_image'];
            }
            ?>
            <div class="card-body d-flex">
                <div>
                    <img src="../images/<?= $store_image ?>" class="img2" alt="">
                </div>

                <div class="row row2 p-1">
                    <div class="col-md-6 d-flex flex-column justify-content-around">
                        <div>
                            <h2 class="fw-bold">
                                <?= $store_name ?>
                            </h2>
                            <p class="font">
                                <a href="filter_category.php?category_id=<?= $category_id ?>">
                                    <i class="fa fa-folder-open-o"></i>
                                    <?= $category_name ?>
                                </a>
                            </p>
                        </div>
                        <div>
                            <p>phone:
                                <?= $store_phone ?>
                            </p>
                            <p>address:
                                <?= $store_address ?>
                            </p>
                        </div>
                        <div class="product-ratings">
                            <ul class="list-inline">
                                <?php
                                $user_ip = $_SERVER['REMOTE_ADDR'];
                                // $select_check_ip = "SELECT * FROM rating WHERE user_ip='$user_ip' AND store_id=$store_id";
                                // $result_check_ip = mysqli_query($con, $select_check_ip);
                                $row = $crud->ratingUser($user_ip, $store_id);
                                $rating = 0;
                                if (!empty($row)) {
                                    $rating = $row[0]['rating_value'];

                                    for ($i = 1; $i <= 5; $i++) {
                                        $selected = ($i <= $rating) ? 'selected' : '';
                                        echo '<li class="list-inline-item ' . $selected . '"><i class="fa fa-star"></i></li>';
                                    }
                                } else {
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo '<li class="list-inline-item"><i class="fa fa-star"></i></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <style>
                            .selected {
                                color: #5672f9;
                            }
                        </style>
                    </div>
                    <div class="col-md-6">
                        <div id="chart-container">
                            <canvas id="totalIncomeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2 -->

    <div class="col-md-10 first my-5">
        <div class="card full-height">
            <div class="card-body text-center">
                <div class="row row2 second p-1">
                    <div class="col-md-10 d-flex flex-column justify-content-around">
                        <div>
                            <h6 class="">What would you rate this store</h6>
                            <hr>
                            <div class="star-rating">
                                <form action="" method="post">
                                    <?php
                                    $rating = isset($_POST['rating_value']) ? $_POST['rating_value'] : 0;

                                    for ($i = 5; $i >= 1; $i--) {
                                        $checked = ($i == $rating) ? 'checked' : '';

                                        echo '<input id="star-' . $i . '" type="radio" name="rating_value" value="' . $i . '" class="hidden" ' . $checked . ' />';
                                        echo '<label for="star-' . $i . '" class="star">&#9733;</label>';
                                    }
                                    ?>

                            </div>
                            <!-- php code -->
                            <?php
                            // if (mysqli_num_rows($result_check_ip) == 0) {
                            if (count($row) == 0) {
                                echo '<br><input type="submit" class="my-3 mt-5 bg-primary p-3 text-white border-0 rounded" name="rate" value="Rate Now">';
                                if (isset($_POST['rate'])) {
                                    //$rating = $_POST['rating_value'];
                                    if (!empty($rating)) {
                                        $crud->insertRate($rating, $user_ip, $store_id);
                                        //     $insert = "INSERT INTO rating (`rating_value`, `user_ip`, `store_id`) VALUES ($rating, '$user_ip', $store_id)";
                                        //     $result_insert = mysqli_query($con, $insert);
                                        //     if ($result_insert) {
                                        ?>
                                        <!-- //         <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6'></script>
                                    //         <script>
                                    //             Swal.fire({
                                    //                 title: 'Good job!',
                                    //                 text: 'Your Rating added successfully!',
                                    //                 icon: 'success',
                                    //                 confirmButtonText: 'OK'
                                    //             }).then(() => {
                                    //                 location.reload(); // Refresh the page
                                    //             });
                                    //         </script> -->
                                        <?php
                                        //     }
                                    }
                                }
                            } else {
                                //$row = mysqli_fetch_array($result_check_ip);
                                $current_rating = $row[0]['rating_value'];
                                echo '<h6 class="mt-5 mb-3">YOUR CURRENT RATE: ' . $current_rating . '</h6>';
                                echo '<input type="submit" class="my-0 bg-primary p-3 text-white border-0 rounded" name="change_rate" value="Change your rate">';

                            }

                            ?>

                            </form>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div id="chart-container">
                            <canvas id="totalIncomeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>








    <!--============================
=            Footer            =
=============================-->

    <footer class=" p-3 text-center footer" style="background-color: rgb(86, 114, 249);">
        <p class="text-white fw-bold"> All rights reserved ©- Made with love by Yousef Zaqout-
            <?= date("Y") ?>
        </p>
    </footer>

    <!-- JAVASCRIPTS -->

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