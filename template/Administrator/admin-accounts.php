<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Admin Accounts</h1>
		</div>
		<div class="wrapper">
			<div class="col-6 offset-2" id="lstAdmin">
					
			</div>
			<script>
			refreshListAdmin();
			function refreshListAdmin() {
				$checkedData = [];
				$("#numDataSelected").html("");
				showDataAction(false);
				
				$("#lstAdmin").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
				$.ajax({
					type: "post",
					cache: true,
					url: "process.php?action=listadmin",
					success: function(html) {
						$("#lstAdmin").html(html);
					}
				});
			}
			</script>
		</div>
	</div>
</div>