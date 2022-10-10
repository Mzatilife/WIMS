<?php
include_once '../includes/classautoloader.inc.php';
include "../includes/session.inc.php";
$property = new ManageWarehouseContr();
$user = new ManageUserContr();
$payment = new PaymentContr();

if (isset($_POST['reserve'])) {
	$reference = $_POST['ref'];
	$row = $payment->checkPayment($reference);
	$prop = $property->viewWarehouseDetails($_SESSION['wareid']);
	$Generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$rental_code = substr(str_shuffle($Generator), 0, 6);

	if (!empty($row)) {
		if ($row['status'] == 1) {
			$msg2 = "The payment has already been used!";
		} else {
			$rec_amount = intval(preg_replace('/[^\d.]/', '', $row['amount']));
			if (intval($rec_amount) >= 1000) {
				$use = $user->viewUser($user_id);
				$result = $payment->reserveProperty($row['payment_id'], $prop['warehouse_id'], $user_id, $use['first_name'], $use['last_name'], $rental_code);
				$result2 = $payment->changePaymentStatus($row['payment_id'], 1);
				if ($result2 && $result) {
					$msg = "Property reserved! Rental Code is: " . $rental_code;
				} else {
					$msg2 = "Error, couldn't process payment";
				}
			} else {
				$msg2 = "The amount paid is not enough!";
			}
		}
	} else {
		$msg2 = "Payment was not done!";
	}
}
?>
<!Doctype HTML>
<html>

<head>
	<title>Warehouse Onwer</title>
	<link rel="stylesheet" href="../assets/css/dashboard-style.css" type="text/css" />
	<!-- font awesome file link  -->
	<link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
	<script src="../assets/js/jquery-1.10.2.min.js"></script>
	<style>
		:root {
			--main-color: #d3ad7f;
			--black: #13131a;
			--bg: #010103;
			--border: .1rem solid black;
		}

		.colu {
			width: 48%;
		}

		.inputBox2 {
			display: flex;
			align-items: center;
			margin-top: 1rem;
			margin-bottom: 5px;
			background: #fff;
			border: var(--border);
		}

		.inputBox2 span {
			color: black;
			font-size: 1.3rem;
			padding: 10px;
		}

		.inputBox2 input {
			width: 100%;
			padding: 10px;
			font-size: 1rem;
			color: black;
			border: none;
			text-transform: none;
			background: none;
		}

		.inputBox2 input:hover {
			border: none;
			padding: 10px;
		}

		.btn-stall {
			background-color: black;
			color: white;
			padding: 10px;
			margin-top: 5px;
		}

		.btn-stall:hover {
			background-color: white;
			color: black;
			border: 2px solid black;
			letter-spacing: 2.5px;
		}
	</style>
</head>


<body>
	<!-- header link file -->
	<?php include "header.customer.php" ?>
	<div class="clearfix"></div>
	</div>

	<div class="clearfix"></div>
	<br />

	<div class="clearfix"></div>
	<br />

	<?php
	if (!empty($_SESSION['wareid'])) {

		//object to access warehouse data ----------------------------------------------------------------------------------------->
		$warehouse = new ManageWarehouseContr();
		$row = $warehouse->viewWarehouseDetails($_SESSION['wareid']);

	?>
		<?php
		if (!empty($msg)) {
			echo "<p class='error_noti'>" . $msg . "</p>";
		} elseif (!empty($msg2)) {
			echo "<p class='error_noti'>" . $msg2 . "</p>";
		} else {
		}
		?>
		<div class="col-div-4-1">
			<div class="box-1">
				<div class="content-box-1">
					<p class="head-1"><b><?php echo $row['name']; ?> Warehouse</b></p>
					<br />
					<div class="m-box">
						<p><b>Location:<b></p>
						<span class="no"><?php echo $row['location'] . ", " . $row['area']; ?></span>
					</div>
					<hr>

					<div class="m-box">
						<p><b>Available:<b></p>
						<span class="no"><?php echo number_format($row['available']); ?>m<sup>2</sup></span>
					</div>
					<hr>

					<div class="m-box">
						<p><b>Price:<b></p>
						<span class="no">K<?php echo number_format($row['price']); ?> / m<sup>2</sup></span>
					</div>
					<hr>

				</div>
			</div>
		</div>
		<div class="col-div-4-1">
			<div class="box-1">
				<div class="content-box-1">
					<p class="head-1">Payment Method </p>

					<div class="m-box">
						<p>Reservation fee is: <b>1,000 MWK</b></p>
						<p>Please Make the Payment to this Mpamba Number<br><br><b>0884477711</b></p>
					</div>
					<hr>

				</div>
			</div>
		</div>
		<div class="col-div-4-1">
			<div class="box-1">
				<div class="content-box-1">
					<p class="head-1">Verify Payment</p>
					<br />
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
						<div class="inputBox2">
							<span class="fas fa-tag"></span>
							<input type="text" name="ref" placeholder="Enter the reference number" required>
						</div>
						<input type="submit" name="reserve" class="btn-stall">
					</form>

				</div>
			</div>
		</div>
	<?php } else { ?>
		<div class="col-div-12">
			<div class="box-8">
				<div class="content-box">
					<p class="head">Welcome <?php echo $username; ?> </p>
					<p>Select a warehouse on the home page to rent. Go to the "warehouses" link on the sidebar to access your rented propeties</p>

					<p style="margin-top: 80px;">Thank you for registering with <b>Warehouse Information Management System</b></p>

				</div>
			</div>
		</div>

	<?php } ?>

	<div class="clearfix"></div>
	<!-- footer link file -->
	<?php include "footer.customer.php" ?>
	</div>

	<div id="status">
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function() {
		setInterval(function() {
			$("#status").load("../includes/payment.inc.php");
			refresh();
		}, 500);
	});
</script>

</html>