<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>College Master Data</h1>
		</div>
		<div class="wrapper">
			<div class="col-7" id="lstCollege">
					
			</div>
			<script>
			$checkedData = [];
			refreshListCollege();
			function refreshListCollege() {
				$checkedData = [];
				$("#numDataSelected").html("");
				showDataAction(false);
				
				$("#lstCollege").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
				$.ajax({
					type: "post",
					cache: true,
					url: "process.php?action=listcollege",
					success: function(html) {
						$("#lstCollege").html(html);
					}
				});
			}
			</script>
		</div>
	</div>
</div>