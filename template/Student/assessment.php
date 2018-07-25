<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Assessment</h1>
		</div>
		<div class="wrapper">
			<div class="col-6" id="lstAssessment">
				<div class="card">
					
				</div>
			</div>
			<div class="col-4">
				<div class="card button-container compact">
					<ul class="button-container block">
						<li><a href="paper.php?cor=<?php echo $_SESSION['loggedID']; ?>" target="_blank" class="flat_button">Certificate of Registration</a></li>
					</ul>
				</div>
			</div>
		</div>
		<script>
		function refreshAssessment() {
			$("#lstAssessment").html('<div class="card"><center><br><br><img src="images/skin/oslo/bg/loading.gif" /><br><br></center></div>');
			$.ajax({
				type: "post", 
				cache: true,
				url: "process.php?action=student_assessment",
				data: {id: '<?php echo $_SESSION['loggedID']; ?>'},
				success: function(html) {
					$("#lstAssessment").html(html);
				}
			})
		}
		$(document).ready(function() {
			refreshAssessment();
		})
		</script>
	</div>
</div>