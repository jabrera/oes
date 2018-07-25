<?php 
	$backDir = '';
	if(file_exists($backDir."library/Config.php")) {
		require_once($backDir."library/Config.php"); 
	}
	if($loggedIn || !isset($_GET['h'])) 
		header("Location: index.php");
	$hash = $_GET['h'];
	$exists = $oes->isExists("ResetPassword", array("Hash"), array($hash));
	if(!$exists) {
		header("Location: index.php");
	}
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
					<li><span class="title">Change Password</span></li>
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
					<div class="card" id="frmReset">
						<h2>Change password</h2>
						<?php
						$data = $oes->getRow("ResetPassword", "*", "Hash = '$hash'");
						?>
						<p>Hello, <?php echo $oes->getNameFormat("f", $data["AccountID"]); ?>! You can now reset your password here!</p>
						<table width="100%" cellpadding="10px" cellspacing="0px">
							<tr>
								<td><input type="password" placeholder="New Password" name="pass1"></td>
							</tr>
							<tr>
								<td><input type="password" placeholder="Re-enter new password" name="pass2"></td>
							</tr>
						</table>
						<ul class="button-container block">
							<li><a id="btnReset" class="raised_button">Reset Password</a></li>
						</ul>
						<script>
						$(document).ready(function() {
							$("#frmReset #btnReset").click(function() {
								$pass1 = $("#frmReset input[name=pass1]").val();
								$pass2 = $("#frmReset input[name=pass2]").val();
								if($pass1 != "" && $pass2 != "" && $pass1 == $pass2) {
									$("#frmReset ul.button-container").hide();
									$("#loading").show("slow");
									$.ajax({
										type: "post",
										cache: false,
										url: "process.php?action=changepassword1",
										data: {pass: $pass1, hash: '<?php echo $hash; ?>'},
										success: function(html) {
											$("#loading").hide("slow");
											showDialogBox('changepassword1');
											$("#snackbar .wrapper").html(html);
										}
									})
								} else {
									showSnackbarMsg("Passwords does not match.");
								}
							})
						})
						</script>
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