<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Course Master Data</h1>
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
								<input type="text" name="search" placeholder="Course Name or Course Code"<?php if(isset($_POST['search'])) echo 'value="'.$_POST['search'].'"'; ?>>
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
							<td><label>College</label>
							<select name="college" id="ddlCollege">
							<?php
							$options = $oes->getData("College", "*", "");
							array_unshift($options, array("ID" => "all", "Code" => "All colleges"));
							foreach($options as $option) {
								echo '<option value="'.$option["ID"].'">'.$option["Code"].'</option>';
							}
							?>
							</select><input type="hidden" name="p" value="1">
							</td>
						</tr>
					</table>
					<ul class="button-container block">
						<li><a id="btnSearchFilter" class="raised_button">Search and Filter</a></li>
					</ul>
					<script>
					function refreshListCourse() {
						$checkedData = [];
						$("#numDataSelected").html("");
						showDataAction(false);
						
						$("#lstCourse").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$p = $("#frmSearch input[name='p']").val();
						$search = $("#frmSearch input[name='search']").val();
						$pp = $("#frmSearch select[name='pp']").val();
						$college = $("#frmSearch select[name='college']").val();
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=listcourse",
							data: {p: $p, search: $search, pp: $pp, college: $college},
							success: function(html) {
								$("#lstCourse").html(html)
							}
						});
					}
					$(document).ready(function() {
						$("#btnSearchFilter").click(function() {
							refreshListCourse();
						});
					});
					</script>
				</div>
			</div>
			<div class="col-7" id="lstCourse">
					
			</div>
			<script>
			$checkedData = [];
			refreshListCourse();
			</script>
		</div>
	</div>
</div>