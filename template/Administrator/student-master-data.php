<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<?php
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
			$check = $oes->getRow("Student INNER JOIN Account", "*", "Account.ID = Student.ID AND Account.ID = '$id'");
			$type = $oes->getSingleData("Account", "Type", "ID = '$id'");
			if(!empty($check)) {
			?>
		<div class="title">
			<h1><?php echo $oes->getNameFormat('f M. l', $id); ?></h1>
		</div>
		<div class="wrapper">
			<div class="col-3" id="studentMenu">
				<div class="card button-container compact">
					<ul class="button-container block left">
						<li><a onclick="viewStudent('info');" class="flat_button"><span class="flat_icon ic_account_circle"></span>Information</a></li>
						<?php
						if($type == "Student") {
						?>
						<li><a onclick="viewStudent('assessment');" class="flat_button"><span class="flat_icon ic_payment"></span>Assessment</a></li>
						<li><a onclick="viewStudent('schedule');" class="flat_button"><span class="flat_icon ic_assignment"></span>Schedule</a></li>
						<li><a onclick="viewStudent('grades');" class="flat_button"><span class="flat_icon ic_assessment"></span>Grades</a></li>
						<?php
						}
						?>
					</ul>
					<script>
					$(document).ready(function() {
						viewStudent('info');
					})
					function viewStudent($view) {
						$("#studentInfo").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$.ajax({
							type: "post", 
							cache: true,
							url: "process.php?action=viewstudent_"+$view,
							data: {id: '<?php echo $id; ?>'},
							success: function(html) {
								$("#studentInfo").html(html);
							}
						})
					}
					</script>
				</div>
			</div>
			<div class="col-7" id="studentInfo">
				
			</div>
		</div>
			<?php
			} else {
			?>
		<div class="title">
			<h1>Student Not Found</h1>
		</div>
		<div class="wrapper">
			<div class="col-3">
				<div class="card button-container compact">
					<ul class="button-container block">
						<li><a href="?student-master-data" class="flat_button">Go back</a></li>
					</ul>
				</div>
			</div>
		</div>
			<?php
			}
		} else {
		?>
		<div class="title">
			<h1>Student Master Data</h1>
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
								<option value="all">All sections</option>
								<option value="null">No sections</option>
							</select><input type="hidden" name="p" value="1"></td>
						</tr>
					</table>
					<ul class="button-container block">
						<li><a id="btnSearchFilter" class="raised_button">Search and Filter</a></li>
					</ul>
					<script>
					function refreshListStudent() {
						$checkedData = [];
						$("#numDataSelected").html("");
						showDataAction(false);
						
						$("#lstStudent").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$p = $("#frmSearch input[name='p']").val();
						$search = $("#frmSearch input[name='search']").val();
						$pp = $("#frmSearch select[name='pp']").val();
						$gl = $("#frmSearch select[name='gradelevel']").val();
						$section = $("#frmSearch select[name='section']").val();
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=liststudent",
							data: {p: $p, search: $search, pp: $pp, gl: $gl, section: $section},
							success: function(html) {
								$("#lstStudent").html(html)
							}
						});
					}
					$(document).ready(function() {
						$("#btnSearchFilter").click(function() {
							refreshListStudent();
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
				<div class="card button-container compact">
					<ul class="button-container block left">
						<li><a onclick="showBottomSheet('addstudent');" class="flat_button"><span class="flat_icon ic_plus_color"></span>Add Student</a></li>
						<li><a onclick="showBottomSheet('addstudent_excel');" class="flat_button"><span class="flat_icon ic_excel_color"></span>Import Data</a></li>
					</ul>
				</div>
			</div>
			<div class="col-7" id="lstStudent">
			</div>
			<script>
			$checkedData = [];
			refreshListStudent();
			</script>
		</div>
		<?php
		}
		?>
	</div>
</div>