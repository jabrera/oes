<?php 
	$backDir = '';
	if(file_exists($backDir."library/Config.php")) {
		require_once($backDir."library/Config.php"); 
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
	<script src="<?php echo $backDir; ?>scripts/chart.js"></script>
</head>
<body name="tp">
<script src="<?php echo $backDir; ?>scripts/oslo-ui.js"></script>
<div id="app-container">
	<?php
	if($loggedIn) {
		$displayPage = "Dashboard";
		if($oes->getLoggedUserInfo("Type") == "Administrator") {
			$mainMenu = array(
				"Dashboard",
				array(
					"Administration",
					array(
						"School Year Settings", 
						"Admission Dates",
						"Admin Accounts"
					)
				),
				array(
					"Assessment",
					array(
						"Payment",
						"Breakdown of Fees",
						"Payment Terms"
					)
				),
				array("Enrollment",
					array(
						"Enrollee Master Data",
						"Confirmation"
					)
				),
				array("Student",
					array(
						"Student Master Data"
					)
				),
				array("Faculty",
					array(
						"Faculty Master Data",
						"Faculty Schedule"
					)
				),
				array("Section",
					array(
						"Section Master Data",
						"Section Schedule"
					)
				),
				array("Curriculum",
					array(
						"Subject Master Data"
					)
				),
				array("Location",
					array(
						"Building Master Data",
						"Room Master Data"
					)
				),
				"Reports",
				"Settings"
			);
		} elseif($oes->getLoggedUserInfo("Type") == "Faculty") {
			$mainMenu = array(
				"Dashboard",
				"Schedule",
				"Class List",
				"Grades",
				"Settings"
			);
		} elseif($oes->getLoggedUserInfo("Type") == "Student") {
			$mainMenu = array(
				"Dashboard",
				"Assessment",
				"Schedule",
				"Classmates",
				"Grades",
				"Settings"
			);
		} elseif($oes->getLoggedUserInfo("Type") == "Enrollee") {
			$mainMenu = array(
				"Dashboard",
				"Assessment",
				"Settings"
			);
		} elseif($oes->getLoggedUserInfo("Type") == "Custom") {
			$availmodules = array(
				array(
					"Administration",
					array(
						"School Year Settings", 
						"Admission Dates"
					)
				),
				array(
					"Assessment",
					array(
						"Payment",
						"Breakdown of Fees",
						"Payment Terms"
					)
				),
				array("Enrollment",
					array(
						"Enrollee Master Data",
						"Confirmation"
					)
				),
				array("Student",
					array(
						"Student Master Data"
					)
				),
				array("Faculty",
					array(
						"Faculty Master Data",
						"Faculty Schedule"
					)
				),
				array("Section",
					array(
						"Section Master Data",
						"Section Schedule"
					)
				),
				array("Curriculum",
					array(
						"Subject Master Data"
					)
				),
				array("Location",
					array(
						"Building Master Data",
						"Room Master Data"
					)
				),
				"Reports"
			);
			$currentmodule = $oes->convertSQLToArray($oes->getSingleData("Administrator", "Module", "Username = '".$oes->getLoggedUserInfo("Username")."'"));
			$mainMenu = array(
				"Dashboard"
			);
			foreach($availmodules as $am) {
				if(is_array($am)) {
					$temp = array();
					$exist = false;
					foreach($am[1] as $sm) {
						if(in_array($sm, $currentmodule)) {
							array_push($temp, $am[0]);
							$exist = true;
							break;
						}
					}
					if($exist) {
						$temp2 = array();
						foreach($am[1] as $sm) {
							if(in_array($sm, $currentmodule)) {
								array_push($temp2, $sm);
							}
						}
						array_push($temp, $temp2);
						array_push($mainMenu, $temp);
					}
				} else {
					if(in_array($am, $currentmodule))
						array_push($mainMenu, $am);
				}
			}
			array_push($mainMenu, "Settings");
		}
		foreach ($mainMenu as $menu) {
			if(is_array($menu)) {
				foreach($menu[1] as $submenu) {
					if(isset($_GET[str_replace(" ", "-", strtolower($submenu))])) {
						$displayPage = $submenu;
						break;
					}
				}
			} else {
				if(isset($_GET[str_replace(" ", "-", strtolower($menu))])) {
					$displayPage = $menu;
					break;
				}
			}
		}
		$pageCode = str_replace(" ", "-", strtolower($displayPage));
		$typefolder = $oes->getLoggedUserInfo("Type");
		if($oes->getLoggedUserInfo("Type") == "Custom")
			$typefolder = "Administrator";
		require_once("template/".$typefolder."/action-bar.php");
		require_once("template/".$typefolder."/float-left-menu.php");
		if(file_exists("template/".$typefolder."/".$pageCode.".php")) {
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			mysql_query("INSERT INTO PageVisit (UserID, Module, DateVisited, TimeVisited, IP_Address) VALUES ('$loggedID', '$pageCode', '".$__CURDATE."', '".$__CURTIME."', '$ip')");
			require_once("template/".$typefolder."/".$pageCode.".php");
		}
		else
			require_once("template/notfound.php");
	} else {
		if(isset($_GET['login']))
			require_once("login.php");
		elseif(isset($_GET['register']))
			require_once("register.php");
		else
			require_once("login.php");
	}
	?>
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