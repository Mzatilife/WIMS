<?php
include_once '../includes/classautoloader.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
	<title>Terms and conditions</title>
</head>

<body>
	<div>
		<ncy-breadcrumb></ncy-breadcrumb>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default" style="margin-top:20px;">
					<div class="panel-body" style="max-height:550px; overflow-y:scroll; background-color:white;">
						<div style="text-align:center;">
							<h1>Terms and Conditions</h1>
							<p>
								<?php
								$profile =  new ProfileContr;

								$terms = $profile->viewTerms();

								foreach ($terms as $term) {
									echo $term['landlord'];
								}
								?>
							</p>
						</div>
					</div>
				</div>
				<div style="text-align:center; border-top: 1px solid black">
					<button style="margin-top: 20px"><a href="register_owner.php">Accept</a></button> <button onclick="return confirm('Accept terms and conditions to continue, else exit!')"><a href="../index.php">Decline</a></button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>