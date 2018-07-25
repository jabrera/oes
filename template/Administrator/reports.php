<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Report Generation</h1>
		</div>
		<div class="wrapper">
			<div class="col-3">
				<div class="card" id="tableListReport">
					<h4>Select Report</h4>
					<table class="form-container">
						<tr>
							<td><label>Report Name</label>
							<select name="report">
							<?php
							$reports = array("Examinees Report", "Interviewees Report", "Passers Report", "Student List Report", "Section Schedule Report", "Faculty Schedule Report", "Incomplete Documents");
							foreach($reports as $r) {
								echo '<option value="'.$r.'">'.$r.'</option>';
							}
							?>
							</select>
							</td>
						</tr>
					</table>
					<ul class="button-container block">
						<li><a id="btnSelect" class="raised_button">Select</a></li>
					</ul>
				</div>
			</div>
			<div class="col-7" id="lstReportSettings">
			</div>
			<script>
			function refreshReport() {
				$("#lstReportSettings").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
				$report = $("#tableListReport select[name=report]").val();
				$.ajax({
					type: "post",
					cache: true,
					url: "process.php?action=lstreport",
					data: {report: $report},
					success: function(html) {
						$("#lstReportSettings").html(html);
					}
				});
			}
			$(document).ready(function() {
				$("#btnSelect").click(function() {
					refreshReport();
				})
			})
			</script>
		</div>
	</div>
</div>