<?php
require_once("library/OES.php");
require_once("library/Database.php");
require_once("library/ExcelReader.php");
date_default_timezone_set('Asia/Manila');

ini_set('display_errors', 0);
ini_set('max_execution_time', 600);
error_reporting(0);


if($_SERVER["HTTP_HOST"] == "localhost") {
	$mysql_host = "localhost:3306";
	$mysql_database = "dlsudhs";
	$mysql_user = "root";
	$mysql_password = "";
} else {
	$mysql_host = "127.0.0.1";
	$mysql_database = "juvarabr_oes";
	$mysql_user = "juvarabr_cms";
	$mysql_password = "r4A10v1U9j96";
}


	$mysql_host = "localhost:3306";
	$mysql_database = "dlsudhs";
	$mysql_user = "root";
	$mysql_password = "";

$oes_db = new Database($mysql_user, $mysql_password, $mysql_host, $mysql_database);
$oes_db->ConnectDB();
$oes = new OES();
$excel = new Spreadsheet_Excel_Reader();

session_start();
$loggedIn = false;

// Assigning of icons for menu
$menuIcon = array(
	"Dashboard" => "ic_dashboard_white",
	"Administration" => "ic_supervisor_account_white",
	"School Year Settings" => "ic_settings_input_svideo_white",
	"Admission Dates" => "ic_event_white",
	"Assessment" => "ic_payment_white",
	"Enrollment" => "ic_face_white",
	"Enrollee Master Data" => "ic_face_white",
	"Confirmation" => "ic_verified_user_white",
	"Schedule" => "ic_schedule_white",
	"Section Schedule" => "ic_schedule_white",
	"Faculty Schedule" => "ic_schedule_white",
	"Grades" => "ic_assessment_white",
	"Student" => "ic_pencil_white",
	"Student Master Data" => "ic_perm_identity_white",
	"Faculty" => "ic_perm_identity_white",
	"Faculty Master Data" => "ic_perm_identity_white",
	"Building Master Data" => "ic_city_white",
	"Room Master Data" => "ic_crop-free_white",
	"Settings" => "ic_settings_white",
	"Reports" => "ic_clipboard-text_white",
	"Curriculum" => "ic_book_white",
	"Subject Master Data" => "ic_book_white",
	"Location" => "ic_room_white",
	"Section" => "ic_dns_white",
	"Section Master Data" => "ic_dns_white",
	"Payment" => "ic_cash_white",
	"Breakdown of Fees" => "ic_receipt_white",
	"Payment Terms" => "ic_history_white",
	"Admin Accounts" => "ic_account-multiple_white",
	"Class List" => "ic_account_balance_white"
);

$loggedID = "";
if(isset($_SESSION['loggedID'])) {
	$loggedIn = true;
	$loggedID = $_SESSION["loggedID"];
	$oes->loggedUser($_SESSION["loggedID"]);
	if(isset($_GET['logout']) || !$oes->isExists("Account", array("ID"), array($_SESSION['loggedID']))) {
		header("Location: process.php?action=logout");
	}
}


$__CURDATE = date("Y-m-d");
$__CURTIME = date("H:i:s");

?>