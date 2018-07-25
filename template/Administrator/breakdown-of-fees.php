<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Breakdown of Fees</h1>
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
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select>
							</td>
						</tr>
					</table>
					<ul class="button-container block">
						<li><a id="btnSearchFilter" class="raised_button">View Fees</a></li>
					</ul>
					<script>
					function refreshListBreakdown() {
						$checkedData = [];
						$("#numDataSelected").html("");
						showDataAction(false);
						
						$("#lstBreakdown").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$gl = $("#frmSearch select[name='gradelevel']").val();
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=listbreakdown",
							data: {gl: $gl},
							success: function(html) {
								$("#lstBreakdown").html(html)
							}
						});
					}
					$(document).ready(function() {
						$("#btnSearchFilter").click(function() {
							refreshListBreakdown();
						});
					});
					</script>
				</div>
			</div>
			<div class="col-7" id="lstBreakdown">
			
			</div>
			<script>
			$checkedData = [];
			</script>
		</div>
	</div>
</div>