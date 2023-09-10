<?php

session_start();
if (!isset($_SESSION['username']) and !isset($_COOKIE['username'])) {
    header("Location:classimax-master/login.php");
    exit;
} ?>
<?php
include('./includeClasses/crud.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Atlantis Lite - Bootstrap 4 Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" />
    <!-- bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: { "families": ["Lato:300,400,700,900"] },
            custom: { "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css'] },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../assets/css/demo.css">
    <style>
        .img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="dashboard.php" class="logo">
                    <img src="../assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-target="collapse"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
                <h2 class="text-white">Home</h2>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">

                    <ul class="nav nav-primary">
                        <li class="nav-item active">
                            <a href="dashboard.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Home</p>
                            </a>

                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#base">
                                <i class="fas fa-layer-group"></i>
                                <p>Categories</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="base">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="show_categories.php">
                                            <span class="sub-item">Show Categories</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="create_category.php">
                                            <span class="sub-item">Create Category</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#sidebarLayouts">
                                <i class="fa-solid fa-store"></i>
                                <p>Stores</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="sidebarLayouts">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="show_stores.php">
                                            <span class="sub-item">Show Stores</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="create_stores.php">
                                            <span class="sub-item">Create Store</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="rating_admin.php">
                                <i class="fa-solid fa-star"></i>
                                <p>Rating</p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="classimax-master/logout.php">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <p>Logout</p>
                            </a>

                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <!-- third child -->
                <table class="table m-5 text-center table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Category</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $crud = new Crud();
                        $storesPerPage = 5;
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $startFrom = ($page - 1) * $storesPerPage;
                        // $query_pagination = "SELECT COUNT(store_id) as total FROM stores";
                        // $result_pagination = mysqli_query($con, $query_pagination);
                        // $row_pagination = mysqli_fetch_assoc($result_pagination);
                        // $totalStores = $row_pagination['total'];
                        // $totalPages = ceil($totalStores / $storesPerPage);
                        $totalPages = $crud->numTotalPagesStores($storesPerPage);
                        // $select = "SELECT * FROM stores ORDER BY store_id LIMIT $startFrom, $storesPerPage";
                        // $result = mysqli_query($con, $select);
                        $rows = $crud->showStorePerPage($startFrom, $storesPerPage);
                        $number = 0;
                        foreach ($rows as $row) {
                            $store_id = $row['store_id'];
                            $store_name = $row['store_name'];
                            $store_phone = $row['store_phone'];
                            $store_address = $row['store_address'];
                            $store_category = $row['category_id'];
                            // $select_cat_name = "SELECT category_name FROM categories WHERE category_id=$store_category";
                            // $result_cat_name = mysqli_query($con, $select_cat_name);
                            // $row_cat_name = mysqli_fetch_assoc($result_cat_name);
                            $row_cat_name = $crud->showCategories();
                            $category_name = $row_cat_name ? $row_cat_name[0]['category_name'] : "";

                            $store_image = $row['store_image'];
                            $number++;
                            echo "<tr>
                            <td>$number</td>
                            <td><img src='images/$store_image' alt='' class='img'></td>
                            <td>$store_name</td>
                            <td>$store_phone</td>
                            <td>$store_address</td>
                            <td>$category_name</td>
                            <td>
                                <form method='POST' action=''>
                                    <input type='submit' value='Edit' class='rounded bg-info px-3 py-2 mx-1 border-0 text-light' name='edit_store_$store_id'>
                                    <input type='submit' value='Delete' class='rounded bg-danger px-3 py-2 mx-1 border-0 text-light' name='delete_store_$store_id'>
                                </form>
                            </td>
                        </tr>";

                            if (isset($_POST["edit_store_$store_id"])) {
                                echo "<script>window.open('edit_store.php?store_id=$store_id', '_self')</script>";
                            }

                            if (isset($_POST["delete_store_$store_id"])) {
                                echo "
                            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6'></script>
                            <script>
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: 'You won\\'t be able to revert this!',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6                                    ',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, delete it!',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Execute the deletion operation
                                        deleteStore($store_id);
                                    }
                                });
                            </script>";
                            }
                        }

                        ?>

                    </tbody>
                </table>

                <footer class="text-center">
                    <div class="container text-center px-5">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                <li class="page-item <?php echo ($page >= $totalPages) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span> </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </footer>

                <style>
                    .pagination {
                        margin-left: 450px;
                    }
                </style>

            </div>


        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function deleteStore(storeID) {
            // Make an AJAX call or perform the deletion operation using JavaScript
            // Here's an example using AJAX and jQuery:

            $.ajax({
                url: 'delete_store.php', // Corrected URL
                method: 'POST',
                data: { storeID: storeID },
                success: function (response) {
                    // Handle the response from the server after deletion
                    if (response == 'success') {
                        // Display a success message
                        Swal.fire({
                            title: 'Good job!',
                            text: 'Store deleted successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Refresh the page
                        });
                    } else {
                        // Display an error message

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // Handle any errors that occur during the AJAX call
                    alert('An error occurred during deletion: ' + error);
                }
            });

        }
    </script>




    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


    <!-- Chart JS -->
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>



    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
    <script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Atlantis JS -->
    <script src="../assets/js/atlantis.min.js"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="../assets/js/setting-demo.js"></script>
    <script src="../assets/js/demo.js"></script>
    <script>
        Circles.create({
            id: 'circles-1',
            radius: 45,
            value: 60,
            maxValue: 100,
            width: 7,
            text: 5,
            colors: ['#f1f1f1', '#FF9E27'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        Circles.create({
            id: 'circles-2',
            radius: 45,
            value: 70,
            maxValue: 100,
            width: 7,
            text: 36,
            colors: ['#f1f1f1', '#2BB930'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        Circles.create({
            id: 'circles-3',
            radius: 45,
            value: 40,
            maxValue: 100,
            width: 7,
            text: 12,
            colors: ['#f1f1f1', '#F25961'],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        })

        var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

        var mytotalIncomeChart = new Chart(totalIncomeChart, {
            type: 'bar',
            data: {
                labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
                datasets: [{
                    label: "Total Income",
                    backgroundColor: '#ff9e27',
                    borderColor: 'rgb(23, 125, 255)',
                    data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            display: false //this will remove only the label
                        },
                        gridLines: {
                            drawBorder: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false
                        }
                    }]
                },
            }
        });

        $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: 'line',
            height: '70',
            width: '100%',
            lineWidth: '2',
            lineColor: '#ffa534',
            fillColor: 'rgba(255, 165, 52, .14)'
        });
    </script>
    <!-- bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>