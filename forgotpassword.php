<?php 
	$backDir = '';
	if(file_exists($backDir."library/Config.php")) {
		require_once($backDir."library/Config.php"); 
	}
	if($loggedIn) 
		header("Location: index.php");
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<title>De La Salle University Dasmari&ntilde;as High School - Portal</title>
	<script src="<?php echo $backDir; ?>scripts/jquery.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo $backDir; ?>styles/skin/light/">
	<link rel="stylesheet" href="<?php echo $backDir; ?>styles/style.php">
	<script src="<?php echo $backDir; ?>scripts/smooth_scroll.js"></script>
	<script src="<?php echo $backDir; ?>scripts/oslo-ui.js"></script>
</head>
<body name="tp">
<div id="app-container">
		<div id="action-bar">
		<div class="row">
			<div class="menu-title">
				<ul>
					<li><a onclick="showElement('#float-left-menu', 1)" class="action_icon ic_menu_white icons icon_medium"></a></li>
					<li><span class="title">Forgot Password</span></li>
				</ul>
			</div>
			<div class="actions">
			</div>
		</div>
	</div>
	<div id="float-left-menu">
		<div class="wrapper">
			<div class="title">
				<div style="position: relative"><a class="icons icon_medium" onclick="showElement('none')"></a>Main Menu</div>
			</div>
			<ul class="ripple">
				<li><a href="index.php?login"><span class="img ic_dashboard_white"></span>Login</a></li>
				<li><a href="index.php?register"><span class="img ic_account_circle_white"></span>Register</a></li>
			</ul>
			<div class="copyright">
				&copy; 2015 Online Enrollment System<br>
				Juvar Abrera • Jarrell Maverick Remulla
			</div>
		</div>
	</div>
	<div id="body-container">
		<div class="content">
			<div class="bg-cover" style="background-image: url(images/skin/oslo/bg/cover1.jpg); height: 500px;"></div>
			<div class="title">
			</div>
			<div class="wrapper">
				<div class="col-4 offset-3">
					<?php
					if(isset($_GET['sent'])) {
					?>
					<div class="card">
						<h2>Success</h2>
						<p>We've sent you an email of the link to change your password.</p>
					</div>
					<?php
					} elseif(isset($_GET['error'])) {
					?>
					<div class="card">
						<h2>Message</h2>
						<p>Error. The email you entered is invalid or not found.</p>
					</div>
					<?php
					}
					?>
					<div class="card">
						<h2>Forgot password</h2>
						<form id="loginForm" action="process.php?action=forgotpassword" method="post">
							<table width="100%" cellpadding="10px" cellspacing="0px">
								<tr>
									<td><input type="text" placeholder="Email" name="email"></td>
								</tr>
								<tr>
									<td><input type="submit" value="Reset password" class="block"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="blackTrans"></div>
	<div id="bottom-sheet"><div class="loading"></div></div>
	<div id="dialog-box">
		<div class="wrapper">
			<center><div class="loading"></div></center>
		</div>
	</div>
	<div id="snackbar">
		<div class="wrapper">
		</div>
	</div>
	<div id="loading"></div>
	<div id="data-action-bar">
		<div class="row">
			<div class="menu-title">
				<span class="title"></span>
			</div>
			<div class="actions">
				<ul>
					<li><a id="btnSelectAll" class="icons action_icon ic_select-all_black gray_icon icon_medium"></a></li>
					<li><a id="btnSelectOff" class="icons action_icon ic_select-off_black gray_icon icon_medium"></a></li>
					<li><a class="icons action_icon ic_dots-vertical_black gray_icon icon_medium"></a>
					<ul class="dropdownlist" id="actions">

					</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</body>
</html>