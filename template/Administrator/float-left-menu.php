<div id="float-left-menu">
	<div class="wrapper">
		<div class="title cover">
			<div class="filter"></div>
			<div style="position: relative"><a class="icons icon_medium" onclick="showElement('none')"></a>Main Menu</div>
			<div class="name">
			<?php
			if($oes->getLoggedUserInfo("Type") == "Administrator")
				echo $oes->getLoggedUserInfo("Type");
			else
				echo $oes->getLoggedUserInfo("Username");
			?>
			</div>
		</div>
		<?php
		$status = $oes->getSYStatus();
		if($status == 0) {
		?>
			<span style="color: #d94239; font-weight: bold; font-size: 12px; display: block; padding: 5px 50px;">S.Y. <?php echo $oes->getSchoolYear()." - ".($oes->getSchoolYear()+1); ?></span>
		<?php	
		} else {
		?>
			<span style="color: #069952; font-weight: bold; font-size: 12px; display: block; padding: 5px 50px;">S.Y. <?php echo $oes->getSchoolYear()." - ".($oes->getSchoolYear()+1); ?></span>
		<?php	
		}
		?>
		<ul class="ripple">
		<?php
		foreach($mainMenu as $menu) {
			if(is_array($menu)) {
				if(isset($menuIcon[$menu[0]]))
					$icon = $menuIcon[$menu[0]];
				else 
					$icon = "ic_dashboard_white";
				echo '
				<li><a><span class="img '.$icon.'"></span>'.$menu[0].'</a>
				<ul>';
				foreach($menu[1] as $submenu) {
					if(isset($menuIcon[$submenu]))
						$icon = $menuIcon[$submenu];
					else 
						$icon = "ic_dashboard_white";
					echo '
					<li><a href="?'.str_replace(" ", "-", strtolower($submenu)).'"><span class="img '.$icon.'"></span>'.$submenu.'</a></li>';
				}
				echo '
				</ul></li>';
			} else {
				if(isset($menuIcon[$menu]))
					$icon = $menuIcon[$menu];
				else 
					$icon = "ic_dashboard_white";
				echo '
				<li><a href="?'.str_replace(" ", "-", strtolower($menu)).'"><span class="img '.$icon.'"></span>'.$menu.'</a></li>';
			}
		}
		?>
		</ul>
		<div class="copyright">
			&copy; 2015 Online Enrollment System<br>
			<a href="http://www.juvarabrera.com/" target="_blank">Juvar Abrera</a> • Jarrell Maverick Remulla
		</div>
	</div>
</div>