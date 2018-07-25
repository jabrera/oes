<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Confirmation</h1>
		</div>
		<div class="wrapper">
			<div class="col-3">
				<div class="card">
					<h4>Search and Filter</h4>
					<hr>
					<table class="form-container" id="frmSearch">
						<tr>
							<td>
								<label>Search</label>
								<input type="text" name="search" placeholder="Search Name or Student No."<?php if(isset($_POST['search'])) echo 'value="'.$_POST['search'].'"'; ?>>
							</td>
						</tr>
						<tr>
							<td><label>Results per page</label>
							<select name="pp">
							<?php
							$options = array(25,100,250,"All");
							foreach($options as $option) {
								echo '<option value="'.$option.'">'.$option.'</option>';
							}
							?>
							</select></td>
						</tr>
						<tr>
							<td><label>Grade Level</label>
							<select name="gradelevel" id="ddlGradeLevel">
								<option value="all">All grade levels</option>
							<?php
							$options = mysql_query("SELECT DISTINCT GradeLevel FROM Student INNER JOIN Account WHERE Student.ID = Account.ID AND Account.Type = 'Enrollee' AND  GradeLevel != '0' ORDER BY GradeLevel ASC");
							while($row = mysql_fetch_array($options)) {
								echo '<option value="'.$row["GradeLevel"].'">Grade '.$row["GradeLevel"].'</option>';
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
					function refreshListPassedEnrollee() {
						$checkedData = [];
						$("#numDataSelected").html("");
						showDataAction(false);
						
						$("#lstPassedEnrollee").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$p = $("#frmSearch input[name='p']").val();
						$search = $("#frmSearch input[name='search']").val();
						$pp = $("#frmSearch select[name='pp']").val();
						$gl = $("#frmSearch select[name='gradelevel']").val();
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=listpassedenrollee",
							data: {p: $p, search: $search, pp: $pp, gl: $gl},
							success: function(html) {
								$("#lstPassedEnrollee").html(html)
							}
						});
					}
					$(document).ready(function() {
						$("#btnSearchFilter").click(function() {
							refreshListPassedEnrollee();
						});
						$("#ddlGradeLevel").change(function() {
							$("#btnSearchFilter").hide();
							$gl = $(this).val();
							$.ajax({
								type: "post",
								cache: true,
								url: "process.php?action=getsection",
								data: {gl: $gl, alloption: 1, nooption: 1},
								success: function(html) {
									$("#ddlSection").html(html);
									$("#btnSearchFilter").show();
								}
							});
						});
					});
					</script>
				</div>
			</div>
			<div class="col-7" id="lstPassedEnrollee">
			</div>
			<script>
			$checkedData = [];
			refreshListPassedEnrollee();
			</script>
		</div>
	</div>
</div>