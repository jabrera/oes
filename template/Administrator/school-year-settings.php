<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>School Year</h1>
		</div>
		<div class="wrapper">
			<div class="col-5">
				<div class="card" id="card-settings">
					<?php if($oes->getSYStatus() == 1) { ?>
					<a id="btnChangeSchoolYear" onclick="showDialogBox('changeschoolyear');" class="float_button pos_top_right ic_restore_white icon_medium"></a>
					<?php } ?>
					<h4>Current School Year</h4>
					<hr>
					<center>
					<p><span style="font-size: 30px; font-weight: bold;"><?php echo $sy = $oes->getSchoolYear(); echo ' - '.($sy+1)?></span></p>
					</center>
					<hr>
					<table class="list">
						<tr>
							<td class="hide"></td>
							<td>School Year Status</td>
							<td width="1px"><label class="switch"><input type="checkbox" name="status"<?php if($oes->getSYStatus() == 1) echo 'checked' ?>><span><div></div></span></label></td>
						</tr>
					</table>
					<p>
					<?php
					$status = $oes->getSYStatus();
					if($status == 0) {
					?>
					<span id="settings-status">Current status is inactive. Registration is open. You can maintain modules while the school year hasn't started.<br><br>
					The following requirements needed to change the status into active are:</span>
					<table class="list">
						<tr class="title">
							<td width="1px"></td>
							<td>Requirements</td>
						</tr>
						<?php
						$okay = true;
						?>
						<tr>
							<td>
								<?php
								$check = $oes->getData("Account INNER JOIN Student", "*", "Student.ID = Account.ID AND Account.Type = 'Student' AND Account.Status = 'Active' AND GLS = '0'");
								if(sizeof($check) == 0)
									echo '<i class="flat_icon ic_done"></i>';
								else 
									$okay = false;
								?>
							</td>
							<td>All students must be in a section.</td>
						</tr>
						<tr>
							<td>
								<?php
								$check = $oes->getData("Account INNER JOIN Faculty", "*", "Faculty.ID = Account.ID AND Account.Type = 'Faculty' AND Account.Status = 'Active' AND Faculty.ID NOT IN (SELECT FacultyID FROM Expertise)");
								if(sizeof($check) == 0)
									echo '<i class="flat_icon ic_done"></i>';
								else 
									$okay = false;
								?>
							</td>
							<td>All faculty must have an expertise.</td>
						</tr>
						<tr>
							<td>
								<?php
								$check = $oes->getData("GLS", "*", "FacultyID = '0'");
								$check2 = $oes->getData("GLS", "*", "1=1");
								if(sizeof($check) == 0 && !empty($check2))
									echo '<i class="flat_icon ic_done"></i>';
								else 
									$okay = false;
								?>
							</td>
							<td>All sections must have an adviser.</td>
						</tr>
						<tr>
							<td>
								<?php
								$check = $oes->getData("GLS", "*", "RoomID = '0'");
								$check2 = $oes->getData("GLS", "*", "1=1");
								if(sizeof($check) == 0 && !empty($check2))
									echo '<i class="flat_icon ic_done"></i>';
								else 
									$okay = false;
								?>
							</td>
							<td>All sections must have a default room.</td>
						</tr>
						<tr>
							<td>
								<?php
								$check = $oes->getData("GLS", "*", "ID NOT IN (SELECT SectionID FROM Schedule)");
								$check2 = $oes->getData("GLS", "*", "1=1");
								if(sizeof($check) == 0 && !empty($check2))
									echo '<i class="flat_icon ic_done"></i>';
								else 
									$okay = false;
								?>
							</td>
							<td>All sections must have a schedule.</td>
						</tr>
						<tr>
							<td>
								<?php
								$check = $oes->getData("Schedule", "*", "Break IS NULL AND (FacultyID IS NULL OR FacultyID = '0')");
								$check2 = $oes->getData("Schedule", "*", "1=1");
								if(sizeof($check) == 0 && !empty($check2))
									echo '<i class="flat_icon ic_done"></i>';
								else 
									$okay = false;
								?>
							</td>
							<td>All schedule must have a faculty assigned.</td>
						</tr>
					</table>
					<?php
					} else {
						$okay = true;
					?>
					<span id="settings-status">Current status is active. Registration is closed. You can't change most of the modules since school year has started.</span>
					<?php
					}
					?>
					</p>
					<?php
					if($okay) {
					?>
					<ul class="button-container right">
						<li><a id="btnSave" class="flat_button">Save</a></li>
					</ul>
					<?php
					}
					?>
					<script>
					$(document).ready(function() {
						$("#card-settings #btnSave").click(function() {
							$status = $("#card-settings input[name=status]").is(":checked");
							$.ajax({
								type: "post",
								cache: true,
								url: "process.php?action=changeschoolyearstatus",
								data: {status: $status},
								success: function(html) {
									window.location.href = "?school-year-settings";
									showSnackbarMsg("Saved.");
								}
							})
						})
					})
					</script>
				</div>
			</div>
			<div class="col-5" id="card-grades">
				<div class="card">
					<h4>Encoding of Grades</h4>
					<table class="list">
						<tr class="title">
							<td class="hide"></td>
							<td>Quarter</td>
							<td width="1px">Status</td>
						</tr>
						<?php
						$qs = array("First Quarter", "Second Quarter", "Third Quarter", "Fourth Quarter");
						$sy = $oes->getSchoolYear();
						foreach($qs as $q) {
							$qstatus = $oes->getSingleData("Administration", str_replace(" ", "", $q), "SchoolYear = '$sy'");
						?>
						<tr>
							<td class="hide"></td>
							<td><?php echo $q; ?></td>
							<td><label class="switch"><input type="checkbox" name="<?php echo str_replace(" ", "", strtolower($q)); ?>"<?php if($qstatus == 1) echo 'checked' ?>><span><div></div></span></label></td>
						</tr>
						<?php
						}
						?>
					</table>
					<ul class="button-container right">
						<li><a id="btnSave" class="flat_button">Save</a></li>
					</ul>
					<script>
					$(document).ready(function() {
						$("#card-grades #btnSave").click(function() {
							$q1 = $("#card-grades input[name=firstquarter]").is(":checked");
							$q2 = $("#card-grades input[name=secondquarter]").is(":checked");
							$q3 = $("#card-grades input[name=thirdquarter]").is(":checked");
							$q4 = $("#card-grades input[name=fourthquarter]").is(":checked");
							$.ajax({
								type: "post",
								cache: true,
								url: "process.php?action=changegradesettings",
								data: {q1: $q1, q2: $q2, q3: $q3, q4: $q4},
								success: function() {
									showSnackbarMsg("Saved.");
								}
							})
						})
					})
					</script>
				</div>
			</div>
			<script>
			</script>
		</div>
	</div>
</div>