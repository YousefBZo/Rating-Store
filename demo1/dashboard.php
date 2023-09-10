<?php

session_start();
if (!isset($_SESSION['username']) and !isset($_COOKIE['username'])) {
	header("Location:classimax-master/login.php");
	exit;
}
include("includeClasses/crud.php");
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
							<a data-toggle="collapse" href="show_categories.php">
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
							<a data-toggle="collapse" href="show_stores.php">
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
				<!-- php code -->
				<?php
				// include('include/DB.php');
				// $select_count_categories = "select count(*) from categories";
				// $result_count_categories = mysqli_query($con, $select_count_categories);
				// $count_categries = mysqli_fetch_array($result_count_categories)[0];
				$crud = new Crud();
				$count_categries = $crud->getNumCategories();
				// $select_count_stores = "select count(*) from stores";
				// $result_count_stores = mysqli_query($con, $select_count_stores);
				// $count_stores = mysqli_fetch_array($result_count_stores)[0];
				$count_stores = $crud->getNumStores();

				?>

				<div class="page-inner mt-3">
					<div class="row ">
						<div class="col-md-6">
							<div class="card bg-primary">
								<div class="card-body d-flex flex-column align-items-center justify-content-center">
									<div class="text-white d-flex align-items-center justify-content-between ">
										<i class="fas fa-layer-group" style="font-size: 30px;"></i>
										<div class="card-title text-center text-white  "
											style="padding-left: 100px;font-size: 15px;">
											Categories</div>
									</div>
									<div class="card-title text-center text-white"
										style="font-size: 20px;padding-left: 120px;"><?= $count_categries ?>
									</div>
								</div>


							</div>
						</div>
						<div class="col-md-6">
							<div class="card bg-primary">
								<div class="card-body d-flex flex-column align-items-center justify-content-center">
									<div class="text-white d-flex align-items-center justify-content-between ">
										<i class="fa-solid fa-store" style="font-size: 30px;"></i>
										<div class="card-title text-center text-white  "
											style="padding-left: 100px;font-size: 15px;">
											Stores</div>
									</div>
									<div class="card-title text-center text-white"
										style="font-size: 20px;padding-left: 120px;"><?= $count_stores ?>
									</div>
								</div>


							</div>
						</div>
					</div>
					<!-- 
					<div class="row">
						<hr class="bg-secondary">
						<h2 class="text-black fw-bold my-3">Stores Rating Trend</h2>

						<?php
						$select_name_stores = "select * from stores";
						$result_name_stores = mysqli_query($con, $select_name_stores);
						while ($row = mysqli_fetch_array($result_name_stores)) {
							echo "<div class='col-md-2'>
								<div class='card bg-white'>
									<div class='card-category text-center text-dark mt-3 '>
										{$row['store_name']}</div>
									<div class='card-title text-center text-dark mb-3 text-danger'>
										.1<i class='px-1 fa-solid fa-arrow-down'></i></div>
								</div>
							</div>";
						}
						?>


					</div> -->
					<!-- third child-->

				</div>
			</div>
		</div>

	</div>



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