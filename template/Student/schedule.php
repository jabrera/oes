<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Schedule</h1>
		</div>
		<div class="wrapper">
			<div class="col-10" id="lstSchedule">
				<div class="card">
					
				</div>
			</div>
		</div>
		<script>
		function refreshSchedule() {
			$("#lstSchedule").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
			$.ajax({
				type: "post", 
				cache: true,
				url: "process.php?action=student_schedule",
				data: {id: '<?php echo $_SESSION['loggedID']; ?>'},
				success: function(html) {
					$("#lstSchedule").html(html);
				}
			})
		}
		$(document).ready(function() {
			refreshSchedule();
		})
		</script>
	</div>
</div>