<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location:classimax-master/login.php");
    exit;
}
include('includeClasses/crud.php');
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
                <form action="" method="post" class="form form-outline m-2" enctype="multipart/form-data">
                    <div class="mx-5">
                        <label for="store_name" class="form-label my-2 fw-bold">Name</label>
                        <input type="text" name="store_name" id="store_name" placeholder="Enter store name"
                            class="form-control">
                    </div>
                    <div class="mx-5 ">
                        <label for="store_phone" class="form-label my-2 fw-bold">Phone</label>
                        <input type="text" name="store_phone" id="store_phone" placeholder="Enter store phone"
                            class="form-control">
                    </div>
                    <div class="mx-5">
                        <label for="store_address" class="form-label my-2 fw-bold">Address</label>
                        <input type="text" name="store_address" id="store_address" placeholder="Enter store address"
                            class="form-control">
                    </div>
                    <div class="mx-5">
                        <label for="store_category" class="form-label my-2 fw-bold">Category</label>
                        <select name="store_category" class="form-select">
                            <?php
                            // $select_cat = "select * from categories";
                            // $result_cat = mysqli_query($con, $select_cat);
                            // while ($row = mysqli_fetch_array($result_cat)) {
                            //     $cat_name = $row['category_name'];
                            //     $cat_id = $row['category_id'];
                            //     echo "<option value='$cat_id'>$cat_name</option>";
                            // }
                            $crud = new Crud();
                            $rows = $curd->getCategories();
                            foreach ($rows as $row) {
                                $cat_name = $row['category_name'];
                                $cat_id = $row['category_id'];
                                echo "<option value='$cat_id'>$cat_name</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mx-5">
                        <label for="store_image" class="form-label my-2 fw-bold">Image</label>
                        <input type="file" name="store_image" id="store_image" class="form-control">
                    </div>
                    <input type="submit" value="Add Store" class="mx-5 my-2 bg-primary p-3 text-white border-0 rounded"
                        name="add_store">
                </form>
            </div>
        </div>

        <!-- php code -->
        <?php
        if (isset($_POST['add_store'])) {
            // if (!empty($_POST['store_name']) && !empty($_POST['store_phone']) && !empty($_POST['store_address']) && !empty($_POST['store_category'])) {
            $store_name = $_POST['store_name'];
            $store_phone = $_POST['store_phone'];
            $store_address = $_POST['store_address'];
            $store_category = $_POST['store_category'];
            $crud->createStore($store_name, $store_phone, $store_address, $store_category);
        }
        // if (isset($_FILES['store_image'])) {
        //     $store_image = $_FILES['store_image']['name'];
        //     $store_image_tmp = $_FILES['store_image']['tmp_name'];
        
        //     // Get the file extension
        //     $fileExtension = strtolower(pathinfo($store_image, PATHINFO_EXTENSION));
        
        //     // Define the accepted file extensions
        //     $acceptedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        
        //     // Check if the file extension is in the accepted extensions array
        //     if (in_array($fileExtension, $acceptedExtensions)) {
        //         // Generate a unique name for the image file
        //         $uniqueImageName = generateUniqueImageName($store_image);
        
        //         // Determine the destination path
        //         $destination = "images/$uniqueImageName";
        
        //         // Move the uploaded file to the destination
        //         if (move_uploaded_file($store_image_tmp, $destination)) {
        //             $insert = "INSERT INTO stores (`store_name`, `store_phone`, `store_address`, `category_id`, `store_image`) VALUES ('$store_name','$store_phone','$store_address','$store_category','$uniqueImageName')";
        //             $result = mysqli_query($con, $insert);
        //             if ($result) {
        // ?>
        <!-- <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6'></script>
                                <script>
                                    Swal.fire({
                                        title: 'Good job!',
                                        text: 'Stores added successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });
                                </script> -->
        <!-- <?php
        // } else {
        // ?>
                                 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                                <script>
                                    swal("Error", "Stores failed to add", "error");
                                </script> -->
        <!-- <?php
        // }
        // } else {
        // ?>
                      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        swal("Error", "Failed to move the uploaded image.", "error");
                    </script> -->
        <!-- <?php
        // }
        // } else {
        // The file is not accepted, show an error message
        //    ?>
               <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script>
                    swal("Error", "Image not accepted. Please choose a JPG, JPEG, PNG, or GIF file.", "error");
                </script> -->
        <!-- <?php
        // }
        // } else {
        // ?>
              <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                swal("Error", "Please select an image.", "error");
            </script> -->
        <!-- <?php
        // }
        // } else {
        // ?>
         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            swal("Error", "Please fill in all the input fields.", "error");
        </script> -->
        <!-- <?php
        // }
        // } -->
        
        // function generateUniqueImageName($imageName)
        // {
        //     $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        //     $basename = basename($imageName, '.' . $extension);
        //     $uniqueName = $basename . '_' . uniqid() . '.' . $extension;
        
        //     // Check if the file already exists
        //     while (file_exists('images/' . $uniqueName)) {
        //         $uniqueName = $basename . '_' . uniqid() . '.' . $extension;
        //     }
        
        //     return $uniqueName;
        // }
        
        // ?>





    </div>


        -->

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