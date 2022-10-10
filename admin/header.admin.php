<div id="mySidenav" class="sidenav">
	<p class="logo">WIMS <span class="menu">&#9776;</span></p>
	<p class="logo1"> <span class="menu1">&#9776;</span></p>
	<a href="index.admin.php" class="icon-a"><i class="fa fa-home icons"></i> &nbsp;&nbsp;Dashboard</a>
	<a href="users.admin.php" class="icon-a"><i class="fa fa-users icons"></i> &nbsp;&nbsp;Users</a>
	<a href="uploads.admin.php" class="icon-a"><i class="fa fa-upload icons"></i> &nbsp;&nbsp;Uploads</a>
	<a href="warehouses.admin.php" class="icon-a"><i class="fa fa-warehouse icons"></i> &nbsp;&nbsp;Warehouses</a>
	<?php
	$conver = new MessagesContr();
	$new = $conver->countMessagesUp($user_id, 0);
	?>
	<a href="messages.admin.php" class="icon-a"><i class="fa fa-envelope icons"></i> &nbsp;&nbsp;Messages <i style="color: greenyellow;"><?php echo $new ?></i></a>
	<a href="accounts.admin.php" class="icon-a"><i class="fa fa-briefcase icons"></i> &nbsp;&nbsp;Accounts</a>
	<a href="reports.admin.php" class="icon-a"><i class="fa fa-list-alt icons"></i> &nbsp;&nbsp;Reports</a>


</div>
<div id="main">

	<div class="head">
		<div class="col-div-6">
			<p class="nav"> welcome</p>

		</div>

		<div class="col-div-6">

			<div class="profile">
				<p><?php echo $_SESSION['username']; ?><i class="fa fa-ellipsis-v dots" aria-hidden="true"></i></p>
				<div class="profile-div">
					<a href="profile.admin.php" style="text-decoration: none;">
						<p><i class="fa fa-user"></i> &nbsp;&nbsp;Profile</p>
					</a>
					<a href="../includes/logout.inc.php" style="text-decoration: none;" onclick="return confirm('are you sure you want to logout?')">
						<p><i class="fa fa-power-off"></i> &nbsp;&nbsp;Log Out</p>
					</a>
				</div>
			</div>
		</div>