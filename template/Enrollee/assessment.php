<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Assessment</h1>
		</div>
		<div class="wrapper">
			<div class="col-5" id="lstAssessment">
				<div class="card">
					
				</div>
			</div>
			<div class="col-5" id="lstPaymentTerm">
				<div class="card">
					<h4>Check Payment Terms</h4>
					<hr>
					<select name="paymentterms">
						<option value="none">- Select Payment Terms -</option>
						<option value="Full Payment">Full Payment</option>
						<option value="Monthly Installment">Monthly Installment</option>
						<option value="Quarterly Installment">Quarterly Installment</option>
						<option value="Semi-annually Installment">Semi-annually Installment</option>
					</select>
					<table class="list" id="tableListPaymentTerm">
					</table>
				</div>
			</div>
		</div>
		<script>
		function refreshAssessment() {
			$("#lstAssessment").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
			$.ajax({
				type: "post", 
				cache: true,
				url: "process.php?action=enrollee_assessment",
				data: {id: '<?php echo $_SESSION['loggedID']; ?>'},
				success: function(html) {
					$("#lstAssessment").html(html);
				}
			})
		}
		$(document).ready(function() {
			refreshAssessment();
			$("#lstPaymentTerm select[name=paymentterms]").change(function() {
				$val = $(this).val();
				$.ajax({
					type: "post",
					cache: true,
					url: "process.php?action=checkpaymentterm",
					data: {id: '<?php echo $_SESSION['loggedID']; ?>', pt: $val},
					success: function(html) {
						$("#lstPaymentTerm #tableListPaymentTerm").html(html);
					}
				})
			})
		})
		</script>
	</div>
</div>