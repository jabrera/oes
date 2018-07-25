<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Grades</h1>
		</div>
		<div class="wrapper">
			<div class="col-6" id="lstGrades">
				<div class="card">
					
				</div>
			</div>
		</div>
		<script>
		function refreshGrades() {
			$("#lstGrades").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
			$.ajax({
				type: "post", 
				cache: true,
				url: "process.php?action=student_grades",
				data: {id: '<?php echo $_SESSION['loggedID']; ?>'},
				success: function(html) {
					$("#lstGrades").html(html);
				}
			})
		}
		$(document).ready(function() {
			refreshGrades();
		})
		</script>
	</div>
</div>