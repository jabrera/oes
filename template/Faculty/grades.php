<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Encode Grades</h1>
		</div>
		<div class="wrapper">
			<div class="col-3">
				<div class="card">
					<h4>Search Class</h4>
					<hr>
					<table class="form-container" id="frmSearch">
						<tr>
							<td>
								<label>Grade Level/Section</label>
								<select name="gradelevel">
									<?php
									$faculty = $_SESSION['loggedID'];
									$gradelevels = $oes->getData("GLS", "*", "ID IN (SELECT SectionID FROM Schedule WHERE FacultyID = '$faculty')");
									foreach($gradelevels as $gl) {
										echo '<option value="'.$gl["ID"].'">Grade '.$gl["GradeLevel"].$gl["Section"].'</option>';
									}
									?>
								</select>
							</td>
						</tr>
					</table>
					<ul class="button-container block">
						<li><a id="btnSearchFilter" class="raised_button">Search and Filter</a></li>
					</ul>
					<script>
					$(document).ready(function() {
						$("#btnSearchFilter").click(function() {
							$gls = $("#frmSearch select[name=gradelevel]").val();
							showBottomSheet('listschedule', ['<?php echo $faculty; ?>', $gls]);
						});
					})
					</script>
				</div>
			</div>
			<div class="col-7" id="lstGrades">
			</div>
		</div>
		<script>
		function refreshGrades($section, $subject) {
			$("#lstGrades").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
			$.ajax({
				type: "post", 
				cache: true,
				url: "process.php?action=liststudentforgrades",
				data: {section: $section, subject: $subject},
				success: function(html) {
					$("#loading").hide("slow");
					$("#lstGrades").html(html);
				}
			});
		}
		$(document).ready(function() {

		})
		</script>
	</div>
</div>