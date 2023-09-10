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
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1;
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
    <section class="page-search">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Advance Search -->
                    <div class="advance-search">
                        <form method="GET">
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <!-- search -->
                                    <input type="search" name="search_value" class="form-control" id="inputtext4"
                                        placeholder="What are you looking for" list="storeList" autocomplete="off">
                                    <datalist id="storeList">
                                        <?php
                                        // $select_name_store = "SELECT * FROM stores";
                                        // $result_name_store = mysqli_query($con, $select_name_store);
                                        // while ($row_name_store = mysqli_fetch_array($result_name_store)) {
                                        $rows = $crud->showStores();
                                        foreach ($rows as $row_name_store) {
                                            $name_store = $row_name_store['store_name'];
                                            echo "<option value='$name_store'>$name_store</option>";
                                        }
                                        ?>
                                    </datalist>
                                </div>
                                <!-- submit -->
                                <div class="form-group col-md-1">
                                    <input type="submit" class="btn btn-primary" name="search"
                                        value="Search Now"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-sm">
        <div class="container">
            <div class="row">

            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="category-sidebar">
                        <div class="widget category-list">
                            <h4 class="widget-header">All Category</h4>
                            <ul class="category-list">
                                <!-- php code -->
                                <?php
                                // $select_categories = "SELECT * FROM categories";
                                // $result_categories = mysqli_query($con, $select_categories);
                                // $select_count_store = "SELECT COUNT(store_id) FROM stores";
                                // $result_count_store = mysqli_query($con, $select_count_store);
                                // $row_count_store = mysqli_fetch_array($result_count_store);
                                // $count_store = $row_count_store[0];
                                $count_store = $crud->getNumStores();
								echo "<li><a href='index.php'>All <span>$count_store</span></a></li>";
                                // while ($row_categories = mysqli_fetch_array($result_categories)) {
                                foreach ($showCategories as $row_categories) {
                                    $cat_name = $row_categories['category_name'];
                                    $cat_id = $row_categories['category_id'];
                                    // $select_count_store = "SELECT COUNT(store_id) FROM stores WHERE category_id=$cat_id GROUP BY category_id";
                                    // $result_count_store = mysqli_query($con, $select_count_store);
                                    // $row_count_store = mysqli_fetch_array($result_count_store);
                                    $count_store = $crud->getNumStoresWithCondition($cat_id);
                                    echo "<li><a href='filter_category.php?category_id=$cat_id'>$cat_name <span>$count_store</span></a></li>";
                                }
                                ?>






                            </ul>
                        </div>


                    </div>
                </div>
                <div class="col-md-9">

                    <div class="product-grid-list">
                        <div class="row mt-30">

                            <!-- php code -->
                            <?php $totalPages = 0;
                            if (isset($_GET['category_id'])) {
                                $category_id = $_GET['category_id'];
                                $storesPerPage = 3;
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $startFrom = ($page - 1) * $storesPerPage;
                                // $query_pagination = "SELECT COUNT(store_id) as total FROM stores where category_id=$category_id";
                                // $result_pagination = mysqli_query($con, $query_pagination);
                                // $row_pagination = mysqli_fetch_assoc($result_pagination);
                                // $totalStores = $row_pagination['total'];
                                // $totalPages = ceil($totalStores / $storesPerPage)
                                $totalPages = $crud->numTotalPagesStores($storesPerPage);

                                $category_id = $_GET['category_id'];
                                // $select_stores = "SELECT * FROM stores where category_id=$category_id limit $startFrom,$storesPerPage";
                                // $result_stores = mysqli_query($con, $select_stores);
                                // while ($row_stores = mysqli_fetch_array($result_stores)) {
                                $rows = $crud->getCategoriesFilter($category_id, $startFrom, $storesPerPage);
                                foreach ($rows as $row_stores) {
                                    $store_id = $row_stores['store_id']; // sent to page rating_store
                                    $store_name = $row_stores['store_name'];
                                    $store_phone = $row_stores['store_phone'];
                                    $store_address = $row_stores['store_address'];
                                    $store_image = $row_stores['store_image'];
                                    $category_id = $row_stores['category_id'];
                                    // $category_name = "SELECT category_name FROM categories WHERE category_id=$category_id";
                                    // $result_cat_name = mysqli_query($con, $category_name);
                                    // $row_count_store = mysqli_fetch_array($result_cat_name);
                                    // $cat_name = $row_count_store[0]; 
                                    $cat_name = $crud->category_name($category_id);
                                    ?>
                                    <div class="col-sm-12 col-lg-4 col-md-6">
                                        <!-- store card -->
                                        <div class="product-item bg-light">
                                            <div class="card">
                                                <div class="thumb-content">
                                                    <a href="rating_user.php?store_id=<?= $store_id ?>">
                                                        <img class="card-img-top img-fluid" src="../images/<?= $store_image ?>"
                                                            alt="Card image cap">
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title"><a
                                                            href="rating_user.php?store_id=<?= $store_id ?>"><?= $store_name ?></a></h4>
                                                    <ul class="list-inline product-meta">
                                                        <li class="list-inline-item">
                                                            <a href="filter_category.php?category_id=<?= $cat_id ?>"><i
                                                                    class="fa fa-folder-open-o"></i>
                                                                <?= $cat_name ?>
                                                            </a>
                                                        </li>

                                                    </ul>
                                                    <p class="card-text">Phone:
                                                        <?= $store_phone ?>
                                                    </p>
                                                    <p class="card-text">Address:
                                                        <?= $store_address ?>
                                                    </p>
                                                    <div class="product-ratings">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item selected"><i class="fa fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item selected"><i class="fa fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item selected"><i class="fa fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item selected"><i class="fa fa-star"></i>
                                                            </li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                <?php }
                            }
                            ?>








                            <style>
                                */ .pagination {
                                    bottom: 20px;
                                    left: 100%;
                                    transform: translateX(-50%);
                                    z-index: 9999;
                                }

                                .footer {
                                    position: relative;
                                    z-index: 1;
                                }

                                .img-fluid {
                                    width: 300px;
                                    height: 200px;
                                    object-fit: contain;
                                }

                                .pagination {
                                    margin-left: 250px;
                                }
                            </style>
                        </div>
                    </div>
                    <footer class="text-center">
                        <div class="container text-center px-5">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                        <a class="page-link"
                                            href="?page=<?php echo $page - 1; ?>&category_id=<?php echo $category_id; ?>"
                                            aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                            <a class="page-link"
                                                href="?page=<?php echo $i . '&category_id=' . $category_id; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                                        <a class="page-link"
                                            href="?page=<?php echo $page + 1; ?>&category_id=<?php echo $category_id; ?>"
                                            aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span> </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </section>
    <!--============================
=            Footer            =
=============================-->

    <footer class=" p-3 text-center footer" style="background-color: rgb(86, 114, 249)">
        <p class="text-white fw-bold"> All rights reserved ©- Made with love by Yousef Zaqout-
            <?= date("Y") ?>
        </p>
    </footer>

    <!-- JAVASCRIPTS -->
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