<div id="body-container">
	<div class="content">
		<div class="bg-cover"></div>
		<div class="title">
			<h1>Icons</h1>
		</div>
		<div class="wrapper">
			<div class="col-10">
				<div class="card">
					<ul class="button-container">
					<?php
					$dir = "images/skin/oslo/icons/";
					if(file_exists($dir)) {
						foreach(glob("*".$dir."*_color.png") as $file) {
							$filename = str_replace("_", " ", str_replace($dir."ic_", "", str_replace("_color.png", "", $file)));
							$span = str_replace($dir, "", str_replace("_color.png", "", $file));
							echo '<li><a onclick="" class="flat_button"><span class="flat_icon '.$span.'"></span>'.$filename.'</a></li>';
						}
					}
					?></ul>
				</div>
			</div>
		</div>
	</div>
</div>