<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Building Master Data</h1>
		</div>
		<div class="wrapper">
			<div class="col-7" id="lstBuilding">
					
			</div>
			<script>
			$checkedData = [];
			refreshListBuilding();
			function refreshListBuilding() {
				$checkedData = [];
				$("#numDataSelected").html("");
				showDataAction(false);
				
				$("#lstBuilding").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
				$.ajax({
					type: "post",
					cache: true,
					url: "process.php?action=listbuilding",
					success: function(html) {
						$("#lstBuilding").html(html);
					}
				});
			}
			</script>
		</div>
	</div>
</div>