<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Curriculum Master Data</h1>
		</div>
		<div class="wrapper">
			<div class="col-3">
				<div class="card">
					<h4>Search Curriculum</h4>
					<hr>
					<table class="form-container" id="frmSearch">
						<tr>
							<td>
								<label>Search Grade Level</label>
								<select name="gradelevel">
								</select>
							</td>
						</tr>
					</table>
					<ul class="button-container block">
						<li><a id="btnSearchFilter" class="raised_button">View Curriculum</a></li>
					</ul>
					<script>
					function refreshListCurriculum() {
						$checkedData = [];
						$("#numDataSelected").html("");
						showDataAction(false);
						
						$("#lstCurriculum").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$gl = $("#frmSearch select[name='gradelevel']").val();
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=listcurriculum",
							data: {gradelevel: $gl},
							success: function(html) {
								$("#lstCurriculum").html(html)
							}
						});
					}
					$(document).ready(function() {
						$("#btnSearchFilter").click(function() {
							refreshListCurriculum();
						});
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=getgradelevel",
							success: function(html) {
								$("#frmSearch select[name='gradelevel']").html(html);
								refreshListCurriculum();
							}
						})
					});
					</script>
				</div>
			</div>
			<div class="col-7" id="lstCurriculum">
			</div>
			<script>
			$checkedData = [];
			</script>
		</div>
	</div>
</div>