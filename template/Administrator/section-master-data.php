<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Section Master Data</h1>
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
								<input type="text" name="search" placeholder="Section Name"<?php if(isset($_POST['search'])) echo 'value="'.$_POST['search'].'"'; ?>>
							</td>
						</tr>
						<tr>
							<td><label>Grade Level</label>
							<select name="gradelevel">
								<option value="all">All grade level</option>
							<?php
							for($i = 7; $i <= 12; $i++) {
								echo '<option value="'.$i.'">'.$i.'</option>';
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
					function refreshListSection() {
						$checkedData = [];
						$("#numDataSelected").html("");
						showDataAction(false);
						
						$("#lstSection").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$search = $("#frmSearch input[name='search']").val();
						$gl = $("#frmSearch select[name='gradelevel']").val();
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=listsection",
							data: {search: $search, gl: $gl},
							success: function(html) {
								$("#lstSection").html(html)
							}
						});
					}
					$(document).ready(function() {
						$("#btnSearchFilter").click(function() {
							refreshListSection();
						});
					});
					</script>
				</div>
			</div>
			<div class="col-7" id="lstSection">
					
			</div>
			<script>
			$checkedData = [];
			refreshListSection();
			</script>
		</div>
	</div>
</div>