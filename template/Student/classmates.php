<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Classmates</h1>
		</div>
		<div class="wrapper">
			<div class="col-6" id="lstClassmates">
				<div class="card">
					
				</div>
			</div>
		</div>
		<script>
		function refreshClassmates() {
			$("#lstClassmates").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
			$.ajax({
				type: "post", 
				cache: true,
				url: "process.php?action=student_classmates",
				data: {id: '<?php echo $_SESSION['loggedID']; ?>'},
				success: function(html) {
					$("#lstClassmates").html(html);
				}
			})
		}
		$(document).ready(function() {
			refreshClassmates();
		})
		</script>
	</div>
</div>