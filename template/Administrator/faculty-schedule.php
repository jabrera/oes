<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Schedule</h1>
		</div>
		<div class="wrapper">
			<div class="col-3">
				<div class="card">
					<h4>Search Faculty</h4>
					<hr>
					<table class="form-container" id="frmSearch">
						<tr>
							<td><label>Search</label>
							<input type="text" name="faculty" placeholder="Search Name or Faculty No.">
							</td>
						</tr>
					</table>
					<ul class="button-container block">
						<li><a id="btnSearchFilter" class="raised_button">List Faculty</a></li>
					</ul>
					<script>
					function refreshListFacultySchedule($facultyID) {
						$checkedData = [];
						$("#numDataSelected").html("");
						showDataAction(false);
						
						$("#lstFacultySchedule").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=listfacultyschedule",
							data: {faculty: $facultyID},
							success: function(html) {
								$("#lstFacultySchedule").html(html);
								$("#loading").hide("slow");
							}
						});
					}
					$(document).ready(function() {
						$("#btnSearchFilter").click(function() {
							$search = $("#frmSearch input[name=faculty]").val();
							showBottomSheet("listfaculty", $search);
						});
					});
					</script>
				</div>
			</div>
			<div class="col-7" id="lstFacultySchedule">
				<?php
				$check = $oes->getData("Schedule", "*", "FacultyID IS NULL AND Break IS NULL");
				$check2 = $oes->getData("Faculty", "*", "ID NOT IN (SELECT FacultyID FROM Expertise)");
				if(sizeof($check) > 0 && sizeof($check2) == 0) {
				?>
				<div class="card" id="card-generateschedule">
					<h4><span class="flat_icon ic_info_outline"></span>Notice</h4>
					<p>Some schedule doesn't have a faculty assigned. We can automatically assign faculty to subjects for you.</p>
					<ul class="button-container right">
						<li><a onclick="dismissCard('generateschedule', 'swipe-left');" class="flat_button">Dismiss</a></li>
						<li><a onclick="showDialogBox('auto_generate_schedule_to_faculty');" class="raised_button">Generate Schedule</a></li>
					</ul>
				</div>
				<?php
				} elseif(sizeof($check2) > 0) {
				?>
				<div class="card" id="card-generateschedule">
					<h4><span class="flat_icon ic_info_outline"></span>Notice</h4>
					<p>Assign an expertise first to faculty before generating a schedule.</p>
					<ul class="button-container right">
						<li><a onclick="dismissCard('generateschedule', 'swipe-left');" class="flat_button">Dismiss</a></li>
						<li><a href="?faculty-master-data" class="raised_button">Assign Expertise</a></li>
					</ul>
				</div>
				<?php
				}
				?>
			</div>
			<script>
			$checkedData = [];
			</script>
		</div>
	</div>
</div>