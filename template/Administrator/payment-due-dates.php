<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Payment Due Dates</h1>
		</div>
		<div class="wrapper">
			<div class="col-8 offset-1" id="lstPaymentDue">
					
			</div>
			<script>
			refreshPaymentDue();
			function refreshPaymentDue() {
				$("#numDataSelected").html("");
				showDataAction(false);
				
				$("#lstPaymentDue").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
				$.ajax({
					type: "post",
					cache: true,
					url: "process.php?action=listpaymentdue",
					success: function(html) {
						$("#lstPaymentDue").html(html);
					}
				});
			}
			</script>
		</div>
	</div>
</div>