<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Payment</h1>
		</div>
		<div class="wrapper">
			<div class="col-3">
				<div class="card">
					<h4>Search Student</h4>
					<hr>
					<table class="form-container" id="frmSearch">
						<tr>
							<td><label>Search</label>
							<input type="text" name="student" placeholder="Search Student No.">
							</td>
						</tr>
					</table>
					<ul class="button-container block">
						<li><a id="btnSearchFilter" class="raised_button">Search Student</a></li>
					</ul>
					<script>
					function refreshListStudentPayment($studentID) {
						$checkedData = [];
						$("#numDataSelected").html("");
						showDataAction(false);
						
						$("#lstStudentPayment").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
						$.ajax({
							type: "post",
							cache: true,
							url: "process.php?action=liststudentpayment",
							data: {student: $studentID},
							success: function(html) {
								$("#lstStudentPayment").html(html);
								$("#loading").hide("slow");
							}
						});
					}
					$(document).ready(function() {
						$("#btnSearchFilter").click(function() {
							$search = $("#frmSearch input[name=student]").val();
							showBottomSheet("liststudentpayment", $search);
						});
					});
					</script>
				</div>
				<div class="card compact button-container">
					<ul class="button-container block left">
						<li><a onclick="showBottomSheet('applysurcharges');" class="flat_button"><span class="flat_icon ic_cash"></span>Surcharge</a></li>
					</ul>
				</div>
			</div>
			<div class="col-7" id="lstStudentPayment">

			</div>
			<script>
			$checkedData = [];
			</script>
		</div>
	</div>
</div>