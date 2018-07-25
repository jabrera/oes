<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>What's happening?</h1>
		</div>
		<div class="wrapper">
			<div class="col-6 offset-2">
				<?php
				$enrollee = $oes->getRow("Enrollee", "*", "ID = '".$_SESSION['loggedID']."'");
				if($enrollee["EnrollmentStatus"] == "Pending") {
				?>
				<div class="card">
					<h4>Interview/Exam Schedule</h4>
					<p>You are schedule for an exam/interview on <?php echo date("F d, Y", strtotime($oes->getSingleData("Admission", "ScheduleDate", "ID = '".$enrollee["AdmissionID"]."'"))); ?>.</p>
					<ul class="button-container right">
						<li><a href="paper.php?permit=<?php echo $_SESSION['loggedID']; ?>" target="_blank" class="raised_button">View Permit</a></li>
					</ul>
				</div>
				<?php
				} elseif($enrollee["EnrollmentStatus"] == "Passed") {
				?>
				<div class="card">
					<h4>Congratulations!</h4>
					<p>You passed the exam/interview! You may now confirm your enrollment in the admin building.</p>
					<ul class="button-container right">
						<li><a href="paper.php?confirm=<?php echo $_SESSION['loggedID']; ?>" target="_blank" class="raised_button">View Confirmation Slip</a></li>
					</ul>
				</div>
				<?php
				} elseif($enrollee["EnrollmentStatus"] == "Failed") {
				?>
				<div class="card">
					<h4>We're sorry!</h4>
					<p>You did not pass our exam/interview. Better luck next time. HAHAHAHAHA</p>
				</div>
				<?php
				}
				?>
				<?php
				$istemp = $oes->isTemporary($_SESSION['loggedID']);
				if($istemp) {
				?>
				<div class="card">
					<h4>Welcome to your Portal!</h4>
					<p>This is your temporary portal until you have confirmed your enrollment here in De La Salle University Dasmariñas High School!<br><br>Your username is <?php echo $oes->getLoggedUserInfo("Username"); ?>. This will change when you are officially enrolled and we will notify you through email.</p>
				</div>
				<?php
				} else {
				?>
				<div class="card">
					<h4>Welcome to your Portal!</h4>
					<p>Please confirm your account.</p>
				</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>