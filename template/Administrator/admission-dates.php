<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Admission Dates</h1>
		</div>
		<div class="wrapper">
			<div class="col-5" id="lstExamDate">
					
			</div>
			<div class="col-5" id="lstInterviewDate">
					
			</div>
			<script>
			refreshAdmissionDates();
			function refreshAdmissionDates() {
				$("#numDataSelected").html("");
				showDataAction(false);
				
				$("#lstExamDate").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
				$("#lstInterviewDate").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
				$.ajax({
					type: "post",
					cache: true,
					url: "process.php?action=listexamdate",
					success: function(html) {
						$("#lstExamDate").html(html);
					}
				});
				$.ajax({
					type: "post",
					cache: true,
					url: "process.php?action=listinterviewdate",
					success: function(html) {
						$("#lstInterviewDate").html(html);
					}
				});
			}
			</script>
		</div>
	</div>
</div>