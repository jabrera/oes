<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Schedule</h1>
		</div>
		<div class="wrapper">
			<div class="col-3">
				<div class="card">
					<h4>Search and Filter</h4>
					<hr>
					<table class="form-container" id="frmSearch">
						<tr>
							<td><label>Grade Level</label>
							<select name="gradelevel" id="ddlGradeLevel">
							<?php
							$options = mysql_query("SELECT DISTINCT GradeLevel FROM Student WHERE GradeLevel != '0' ORDER BY GradeLevel ASC");
							while($row = mysql_fetch_array($options)) {
								echo '<option value="'.$row["GradeLevel"].'">Grade '.$row["GradeLevel"].'</option>';
							}
							?>
							</select>
							</td>
						</tr>
						<tr>
							<td><label>Section</label>
							<select name="section" id="ddlSection">
							</select><input type="hidden" name="p" value="1"></td>
						</tr>
					</table>
					<ul class="button-container block">
						<li><a id="btnSearchFilter" class="raised_button">See Schedule</a></li>
					</ul>
					<script>
					function refreshListSectionSchedule() {
						$checkedData = [];
						$("#numDataSelected").html("");
						showDataAction(false);
						
						$("#lstSectionSchedule").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$gl = $("#frmSearch select[name='gradelevel']").val();
						$section = $("#frmSearch select[name='section']").val();
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=listsectionschedule",
							data: {gl: $gl, section: $section},
							success: function(html) {
								$("#lstSectionSchedule").html(html)
							}
						});
					}
					$(document).ready(function() {
						$gl = $("#ddlGradeLevel").val();
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=getsection",
							data: {gl: $gl},
							success: function(html) {
								$("#ddlSection").html(html);
								$("#btnSearchFilter").show();
							}
						});
						$("#ddlGradeLevel").change(function() {
							$("#btnSearchFilter").hide();
							$gl = $(this).val();
							$.ajax({
								type: "post",
								cache: true,
								url: "process.php?action=getsection",
								data: {gl: $gl},
								success: function(html) {
									$("#ddlSection").html(html);
									$("#btnSearchFilter").show();
								}
							});
						});
						$("#btnSearchFilter").click(function() {
							refreshListSectionSchedule();
						});
					});
					</script>
				</div>
			</div>
			<div class="col-7" id="lstSectionSchedule">
			
			</div>
			<script>
			$checkedData = [];
			</script>
		</div>
	</div>
</div>