<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Hello, <?php echo $oes->getNameFormat("f", $_SESSION['loggedID']); ?>!
			<br><span style="font-size: 16px; color: #333;"><?php echo $_SESSION['loggedID']; ?></span></h1>
		</div>
		<div class="wrapper">
			<div class="col-4" id="lstFeed">
				
			</div>
			<script>
			$(document).ready(function() {
				$.ajax({
					type: "post",
					cache: true,
					url: "process.php?action=viewrecentfeed",
					data: {id: '<?php echo $_SESSION['loggedID']; ?>'},
					success: function(html) {
						$("#lstFeed").html(html);
					}
				})
			})
			</script>
		</div>
	</div>
</div>