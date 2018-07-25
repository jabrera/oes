<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>What's happening?</h1>
		</div>
		<?php
		$colors = array("#e01d1d", "#e01da2", "#b41de0", "#3d1de0", "#1d94e0", "#1de0b9", "#1de059", "#5de01d", "#c7e01d", "#e0a21d", "#e0541d");
		?>
		<div class="wrapper">
			<?php
			$snum = $oes->getNum("Account", "Type = 'Student' AND Status = 'Active'");
			$enum = $oes->getNum("Account", "Type = 'Enrollee' AND Status = 'Active'");
			if($snum != 0) {
			?>
			<div class="col-3-33">
				<div class="card">
					<h4>Gender Statistics</h4>
					<div>
						<canvas id="statistics1"></canvas>
					</div>
					<script>
					var barChartData1 = {
						labels : ["Male", "Female"],
						datasets : [
							{
								fillColor : "<?php 
								$rand = rand(0, sizeof($colors)-1);
								echo $colors[$rand];
								unset($colors[$rand]);
								?>",
								data : [<?php
								echo $oes->getNum("Account INNER JOIN Student", "Account.ID = Student.ID AND Student.Gender = 'Male'");
								?>,<?php
								echo $oes->getNum("Account INNER JOIN Student", "Account.ID = Student.ID AND Student.Gender = 'Female'");
								?>]
							}
						]

					}
					$(document).ready(function() {
						var ctx1 = document.getElementById("statistics1").getContext("2d");
						new Chart(ctx1).Bar(barChartData1, {responsive : true});
					})
					</script>
				</div>
			</div>
			<div class="col-3-33">
				<div class="card">
					<h4>Grade Level</h4>
					<div>
						<canvas id="statistics2"></canvas>
					</div>
					<script>
					var pieData = [
						<?php
						$first = true;
						for($i = 7; $i <= 10; $i++) {
							if($first)
								$first = false;
							else
								echo ',';
							$num = $oes->getNum("Account INNER JOIN Student", "Account.ID = Student.ID AND Student.GradeLevel = '$i'");
						?>
						{
							value: <?php echo $num; ?>,
							color:"<?php 
								$rand = rand(0, sizeof($colors)-1);
								echo $colors[$rand];
								unset($colors[$rand]);
								?>",
							label: "Grade <?php echo $i; ?>"
						}
						<?php
						}
						?>

					];
					$(document).ready(function() {
						var ctx2 = document.getElementById("statistics2").getContext("2d");
						new Chart(ctx2).Pie(pieData, {responsive : true});
					})
					</script>
				</div>
			</div>
			<?php 
			}
			if($enum != 0) {
			?>
			<div class="col-3-33">
				<div class="card">
					<h4>Enrollees' Status</h4>
					<div>
						<canvas id="statistics3"></canvas>
					</div>
					<script>
					var doughnutData = [
						<?php
						$first = true;
						$status = array("Pending", "Passed", "Failed");
						foreach($status as $s) {
							if($first)
								$first = false;
							else
								echo ',';
							$num = $oes->getNum("Account INNER JOIN Enrollee", "Account.ID = Enrollee.ID AND Enrollee.EnrollmentStatus = '$s'");
						?>
						{
							value: <?php echo $num; ?>,
							color:"<?php 
								$rand = rand(0, sizeof($colors)-1);
								echo $colors[$rand];
								unset($colors[$rand]);
								?>",
							label: "<?php echo $s; ?>"
						}
						<?php
						}
						?>

					];
					$(document).ready(function() {
						var ctx3 = document.getElementById("statistics3").getContext("2d");
						new Chart(ctx3).Doughnut(doughnutData, {responsive : true});
					})
					</script>
				</div>
			</div>
			<?php	
			}
			?>
		</div>
		<div class="wrapper">
			<div class="col-6-66">
				<div class="card">
					<h4>Website Statistics</h4>
					<div>
						<canvas id="statistics4"></canvas>
					</div>
					<script>
					var lineChartData4 = {
						labels : [<?php
						$labels = array();
						for($i = 6; $i >= 0; $i--) {
							$date = date("M d", strtotime("-".$i." days"));
							$labels[] = $date;
						}
						echo "\"".implode("\",\"", $labels)."\"";
						?>],
						datasets : [
							{
								label: "Student",
								fillColor : "rgba(220,220,220,0.2)",
								strokeColor : "rgba(220,220,220,1)",
								pointColor : "rgba(220,220,220,1)",
								pointStrokeColor : "#fff",
								pointHighlightFill : "#fff",
								pointHighlightStroke : "rgba(220,220,220,1)",
								data : [<?php
									$values = array();
									for($i = 6; $i >= 0; $i--) {
										$date = date("Y-m-d", strtotime("-".$i." days"));
										$values[] = $oes->getNum("PageVisit", "DateVisited = '$date'");
									}
									echo "\"".implode("\",\"", $values)."\"";
									?>]
							}
						]

					}
					$(document).ready(function() {
						var ctx4 = document.getElementById("statistics4").getContext("2d");
						new Chart(ctx4).Line(lineChartData4, {responsive: true});
					})
					</script>
				</div>
			</div>
			
			<div class="col-3-33">
				<div class="card">
					<h4>Login Count</h4>
					Today's count: <?php echo $oes->getNum("LoginCount", "DateLogin = '".date("Y-m-d")."'"); ?>
					<div>
						<canvas id="statistics5"></canvas>
					</div>
					<script>
					var barChartData2 = {
						labels : ["Success", "Fail"],
						datasets : [
							{
								fillColor : "<?php 
								$rand = rand(0, sizeof($colors)-1);
								echo $colors[$rand];
								unset($colors[$rand]);
								?>",
								data : [<?php
								echo $oes->getNum("LoginCount", "LoggedIn = '1'");
								?>,<?php
								echo $oes->getNum("LoginCount", "LoggedIn = '0'");
								?>]
							}
						]

					}
					$(document).ready(function() {
						var ctx5 = document.getElementById("statistics5").getContext("2d");
						new Chart(ctx5).Bar(barChartData2, {responsive : true});
					})
					</script>
				</div>
			</div>
			<script>
			window.onload = function() {
			}
			</script>
		</div>
	</div>
</div>
