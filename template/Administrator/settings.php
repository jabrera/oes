<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Settings</h1>
		</div>
		<div class="wrapper">
			<div class="col-4 offset-3">
			<?php
			if(isset($_GET['pass_success'])) {
			?>
			<div class="card" id="card-pass_success">
				<h4>Success</h4>
				<p>You have successfully changed your password!</p>
			</div>
			<script>
			$(document).ready(function() {
				setTimeout(function() {
					dismissCard("pass_success", "shrink", false);
				}, 1000)
			})
			</script>
			<?php
			} elseif(isset($_GET['pass_error'])) {
			?>
				<div class="card" id="card-pass_error">
					<h4>Error</h4>
					<p>Error changing your password!</p>
				</div>
				<script>
				$(document).ready(function() {
					setTimeout(function() {
						dismissCard("pass_error", "shrink", false);
					}, 1000)
				})
				</script>
			<?php
			}
			?>
				<div class="card">
					<h4>Change Password</h4>
					<hr>
					<form action="process.php?action=changepassword" method="post">
					<table class="form-container">
						<tr>
							<td>
								<label>Old Password</label>
								<input type="password" name="old">
							</td>
						</tr>
						<tr>
							<td>
								<label>New Password</label>
								<input type="password" name="new">
							</td>
						</tr>
						<tr>
							<td>
								<label>Retype New Password</label>
								<input type="password" name="new2">
							</td>
						</tr>
					</table>
					<ul class="button-container right">
						<li><input type="submit" value="Update password"></li>
					</ul>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>