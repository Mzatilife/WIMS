<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
if (isset($_GET['id'])) {
    $_SESSION['ware_id'] = $_GET['id'];
    header("location: viewwarehouse.admin.php");
}
?>
<!Doctype HTML>
<html>

<head>
	<title>Administrator</title>
	<link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
	<!-- font awesome file link  -->
	<link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
</head>


<body>
	<!-- header link file -->
	<?php include "header.admin.php" ?>
	<div class="clearfix"></div>
	</div>

	<div class="clearfix"></div>
	<br />

	<div class="col-div-4-1">
		<div class="box">
			<p class="head-1">Users</p>
			<?php
			//creating an object to access warehouse data from the "managewarehousecontr.php" class -------------------->
			$user = new ManageUserContr();
			$product = $user->countUsers('owner', 'customer');

			//viewing thr counted data --------------------------------------->
			echo "<p class='number'>" . $product . "</p>";
			?>
			<i class="fa fa-users box-icon"></i>
		</div>
	</div>
	<div class="col-div-4-1">
		<div class="box">
			<p class="head-1">Warehouses</p>
			<?php
			//creating an object to access warehouse data from the "managewarehousecontr.php" class -------------------->
			$count = new ManageWarehouseContr();
			$result = $count->countWarehouse(1);

			//viewing thr counted data --------------------------------------->
			echo "<p class='number'>" . $result . "</p>";
			?>
			<i class="fa fa-warehouse box-icon"></i>
		</div>
	</div>
	<div class="col-div-4-1">
		<div class="box">
			<p class="head-1">New uploads</p>
			<?php
			//counts the submitted warehouses -------------------->
			$result = $count->countWarehouse(0);

			//viewing thr counted data --------------------------------------->
			echo "<p class='number'>" . $result . "</p>";
			?>
			<i class="fa fa-upload box-icon"></i>
		</div>
	</div>

	<div class="clearfix"></div>
	<br />


	<div class="col-div-4-1">
		<div class="box-1">
			<div class="content-box-1">
				<p class="head-1">Users</p>
				<br />
				<div class="m-box">
					<p>Customers<br /><span class="no-1">system updates</span></p>
					<?php
					//counts the total number of customers -------------------->
					$customer = $user->countUsers('customer', 'customer');

					//viewing the counted data --------------------------------------->
					echo "<span class='no'>" . $customer . "</span>";
					?>
				</div>

				<div class="m-box">
					<p>Owners<br /><span class="no-1">system updates</span></p>
					<?php
					//counts the total number of owners -------------------->
					$owner = $user->countUsers('owner', 'owner');

					//viewing the counted data --------------------------------------->
					echo "<span class='no'>" . $owner . "</span>";
					?>
				</div>

				<div class="m-box active">
					<p>Total<br /><span class="no-1">system updates</span></p>
					<?php
					//counts total number of the system users -------------------->
					$total = $user->countUsers('owner', 'customer');

					//viewing the counted data --------------------------------------->
					echo "<span class='no'>" . $total . "</span>";
					?>
				</div>

			</div>
		</div>
	</div>
	<div class="col-div-4-1">
		<div class="box-1">
			<div class="content-box-1">
				<p class="head-1">The admin dashboard</p>

				<div class="circle-wrap">

				</div>
			</div>
		</div>
	</div>
	<div class="col-div-4-1">
		<div class="box-1">
			<div class="content-box-1">
				<p class="head-1">Recent Uploads <a href="uploads.admin.php"><span style="background-color: black;">View All</span></a></p>
				<br />
				<?php
				//creating an object to access warehouse data from the "managewarehousecontr.php" class -------------------->
				$warehouse = new ManageWarehouseContr();
				$row = $warehouse->viewWarehouseOwner(0, 0, 0, 8);

				//displaying the data ---------------------------------------------------------------------------------------->
				foreach ($row as $rw) {
					echo "<a href='index.admin.php?id=" . $rw['warehouse_id'] . "' style='text-decoration:none;'><p class='act-p'><i class='fa fa-circle' ></i>&nbsp;" . $rw['name'] . " warehouse,  &nbsp;&nbsp;&nbsp;&nbsp;" . $rw['location'] . ". </p></a>";
				}
				?>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<!-- footer link file -->
	<?php include "footer.admin.php" ?>
	</div>


</body>


</html>