<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Faculty Master Data</h1>
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
								<input type="text" name="search" placeholder="Search Name or Faculty No."<?php if(isset($_POST['search'])) echo 'value="'.$_POST['search'].'"'; ?>>
							</td>
						</tr>
						<tr>
							<td><label>Results per page</label>
							<select name="pp">
							<?php
							$options = array(25,100,250,"All");
							foreach($options as $option) {
								$selected = "";
								if(isset($_POST['pp']))
									if($option == $_POST['pp'])
										$selected = " selected";
								echo '<option value="'.$option.'"'.$selected.'>'.$option.'</option>';
							}
							?>
							</select></td>
						</tr>
						<tr>
							<td><label>College</label>
							<select name="college" id="ddlCollege">
							<?php
							$options = $oes->getData("College", "*", "");
							$selectedCollegeID = 0;
							array_unshift($options, array("ID" => "all", "Code" => "All colleges"));
							foreach($options as $option) {
								$selected = "";
								if(isset($_POST['college']))
									if($option["ID"] == $_POST['college']) {
										$selected = " selected";
										$selectedCollegeID = $_POST['college'];
									}
								echo '<option value="'.$option["ID"].'"'.$selected.'>'.$option["Code"].'</option>';
							}
							?>
							</select>
							</td>
						</tr>
						<tr>
							<td><label>Department</label>
							<select name="department" id="ddlDepartment">
							<?php
							$options = $oes->getData("Department", "*", "");
							array_unshift($options, array("ID" => "null", "Code" => "No department"));
							array_unshift($options, array("ID" => "all", "Code" => "All departments"));
							foreach($options as $option) {
								$selected = "";
								if(isset($_POST['department']))
									if($option["ID"] == $_POST['department'])
										$selected = " selected";
								echo '<option value="'.$option["ID"].'"'.$selected.'>'.$option["Code"].'</option>';
							}
							?>
							</select><input type="hidden" name="p" value="<?php if(isset($_POST['p'])) echo $_POST['p']; else echo '1'; ?>"></td>
						</tr>
					</table>
					<ul class="button-container block">
						<li><a id="btnSearchFilter" class="raised_button">Search and Filter</a></li>
					</ul>
					<script>
					function refreshListFaculty() {
						$checkedData = [];
						$("#numDataSelected").html("");
						showDataAction(false);
						
						$("#lstFaculty").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$p = $("#frmSearch input[name='p']").val();
						$search = $("#frmSearch input[name='search']").val();
						$pp = $("#frmSearch select[name='pp']").val();
						$college = $("#frmSearch select[name='college']").val();
						$department = $("#frmSearch select[name='department']").val();
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=listfaculty",
							data: {p: $p, search: $search, pp: $pp, college: $college, department: $department},
							success: function(html) {
								$("#lstFaculty").html(html)
							}
						});
					}
					$(document).ready(function() {
						$("#btnSearchFilter").click(function() {
							refreshListFaculty();
						});
						$("#ddlCollege").change(function() {
							$collegeID = $(this).val();
							$.ajax({
								type: "post",
								cache: true,
								url: "process.php?action=getdepartment",
								data: {collegeID: $collegeID, alloption: 1},
								success: function(html) {
									$("#ddlDepartment").html(html);
								}
							});
						});
					});
					</script>
				</div>
			</div>
			<div class="col-7" id="lstFaculty">
			</div>
			<script>
			$checkedData = [];
			refreshListFaculty();
			</script>
		</div>
	</div>
</div>