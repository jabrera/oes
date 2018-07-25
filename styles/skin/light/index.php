<?php 
header("Content-type: text/css"); 
if(isset($_GET['primary']))
	$__PRIMARY_COLOR = "#".$_GET['primary'];
else
	$__PRIMARY_COLOR = "#0f8a43"; 

if(isset($_GET['secondary']))
	$__SECONDARY_COLOR = "#".$_GET['secondary'];
else
	$__SECONDARY_COLOR = "#86c522"; 
$__MIN_WEBSITE_WIDTH = "360px"; 
$__MAX_WEBSITE_WIDTH = "960px"; 

function getTransition($attr, $time, $speed) {
	$x = "-webkit-transition: all time speed; 
	-moz-transition: all time speed; 
	-ms-transition: all time speed; 
	-o-transition: all time speed; 
	transition: all time speed;
"; 
	$x = str_replace("time", $time, $x); 
	$x = str_replace("speed", $speed, $x); 
	$x = str_replace("all", $attr, $x); 
	echo $x; 
} 
function getRotation($deg) {
	$x = "-webkit-transform: rotate(360deg); 
	-moz-: rotate(360deg); 
	-ms-transform: rotate(360deg);
	-o-transform: rotate(360deg); 
	transform: rotate(360deg);
"; 
	$x = str_replace("360", $deg, $x); 
	echo $x;
} 
function getBackgroundIcon($icon, $color) {
	echo 'background-image: url(../../../images/skin/oslo/icons/ic_'.$icon.'_'.$color.'.png);';
} 
?> 
.notransition {
  -webkit-transition: none !important;
  -moz-transition: none !important;
  -o-transition: none !important;
  -ms-transition: none !important;
  transition: none !important;
}
* {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box; 
	-ms-box-sizing: border-box;
	-o-box-sizing: border-box; 
	box-sizing: border-box;
} 
html::-webkit-scrollbar {
	width: 0px;
} 
body {
	background: #f0f0f0;
	margin: 0px; 
	padding: 0px; 
	font-family: Roboto; 
	font-size: 15px; 
} 
h1,h2,h3,h4,h5,h6 {
	padding: 0px; 
	margin: 0px; 
	margin-top: 10px; 
	margin-bottom: 15px; 
	padding-left: 20px; 
} 
.filter {
	position: absolute;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	background: rgba(0,0,0,.5);
}
<?php 
$directory = "../../../images/skin/oslo/icons/"; 
if(file_exists($directory)) {
	foreach (glob($directory."*.png") as $filename) {
		$icon = str_replace($directory, "", str_replace(".png", "", $filename));
?> 
.<?php echo $icon; ?> {
	background-image: url(<?php echo $filename; ?>); 
} 
<?php 
} 
	foreach (glob($directory."*_color.png") as $filename) {
	$icon = str_replace($directory, "", str_replace("_color.png", "", $filename));
?> 
.<?php echo $icon; ?> {
	background-image: url(<?php echo $filename; ?>); 
} 
<?php 
	} 
} 
for($i = 10; $i <= 48; $i++) {
?> .icon_<?php echo $i; ?> {
	background-size: <?php echo $i; ?>px <?php echo $i; ?>px;
} 
<?php 
} 
?> 
.icon_small {
	background-size: auto 40%;
} 
.icon_medium {
	background-size: auto 50%;
} 
.icon_large {
	background-size: auto 60%;
}
hr {
	margin: 0px;
	padding: 0px;
	border: 0px;
	border-top: 1px solid rgba(0,0,0,.1);
}
a {
	cursor: pointer; 
	text-decoration: none; 
	color: #333; 
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	-o-user-select: none;
	user-select: none;
}
.icons {
	position: relative; 
	display: inline-block; 
	vertical-align: middle; 
	background-position: center center; 
	background-repeat: no-repeat; 
} 
.icon_button {
	background-color: #bbb;
	background-size: contain; 
	background-repeat: no-repeat; 
	width: 36px; 
	height: 36px; 
	display: inline-block; 
	position: relative; 
	padding: 0px !important; 
	border-radius: 0px !important; 
} 
.icon_button.trans {
	background-color: transparent;
}
.icon_button[href]:not(.trans), .icon_button[onclick]:not(.trans), .icon_button[id]:not(.trans) {
	background-color: <?php echo $__PRIMARY_COLOR; ?>; 
} 
.icons span {
	position: relative; font-weight: 500;
} 
.float_button {
	position: relative; 
	display: inline-block; 
	vertical-align: middle; 
	background-position: center center; 
	background-repeat: no-repeat; 
	box-shadow: 0px 3px 5px rgba(0,0,0,.2); 
	z-index: 80; 
	width: 60px; 
	height: 60px; 
	display: block; 
	background-color: #999 !important; 
	border-radius: 100px; 
	box-shadow: inset 0px 2px 1px rgba(255,255,255,.4); 
} 
.float_button span {
	color: #bbb;
} 
.float_button[href], .float_button[onclick], .float_button[id] {
	background-color: #F44336 !important; 
} 
[class^="flat_icon"] {
	width: 24px; 
	height: 24px; 
	background-size: cover; 
	background-position: center center;
	background-repeat: no-repeat; 
	display: inline-block; 
	vertical-align: middle; 
	margin-right: 7px; 
	background-color: <?php echo $__PRIMARY_COLOR; ?>; 
	position: relative;
}
[class^="flat_icon"].compact {
	margin-right: 0px;
}
<?php 
for($i = 16; $i <= 48; $i++) {
?> 
.flat_icon_<?php echo $i; ?> {
	width: <?php echo $i; ?>px; 
	height: <?php echo $i; ?>px;
	background-size: cover; 
} 
<?php 
} 
?> 
.gray_icon {
	background-color: #000; 
	opacity: .5; 
} 
.circle_icon {
	border-radius: 50%; 
} 
.trans_icon {
	background-color: transparent; 
} 
.pos_top_left, .pos_top_right, .pos_bottom_left, .pos_bottom_right, .pos_left_top, .pos_left_bottom, .pos_right_top, .pos_right_bottom, .pos_top_center, .pos_bottom_center, .pos_left_center, .pos_right_center, .pos_top_left_corner, .pos_left_top_corner, .pos_top_right_corner, .pos_right_top_corner, .pos_bottom_left_corner, .pos_left_bottom_corner, .pos_bottom_right_corner, .pos_right_bottom_corner {
	position: absolute;
} 
.pos_top_left {
	top: -30px; 
	left: 30px; 
} 
.pos_top_right {
	top: -30px;
	right: 30px;
} 
.pos_bottom_left {
	bottom: -30px; 
	left: 30px;
} 
.pos_bottom_right {
	bottom: -30px;
	right: 30px;
} 
.pos_left_top {
	left: -30px;
	top: 30px;
} 
.pos_left_bottom {
	left: -30px;
	bottom: 30px;
} 
.pos_right_top {
	right: -30px;
	top: 30px;
} 
.pos_right_bottom {
	right: -30px;
	bottom: 30px;
} 
.pos_top_center {
	top: -30px;
	left: 50%; 
	margin-left: -30px; 
} 
.pos_bottom_center { 
	bottom: -30px; 
	left: 50%; 
	margin-left: -30px; 
} 
.pos_left_center { 
	left: -30px; 
	top: 50%; 
	margin-top: -30px; 
} 
.pos_right_center { 
	right: -30px; 
	top: 50%; 
	margin-top: -30px; 
} 
.pos_top_left_corner, .pos_left_top_corner { 
	left: -30px; 
	top: -30px; 
} 
.pos_top_right_corner, .pos_right_top_corner {
	right: -30px;
	top: -30px; 
} 
.pos_bottom_left_corner, .pos_left_bottom_corner {
	left: -30px; 
	bottom: -30px;
} 
.pos_bottom_right_corner, .pos_right_bottom_corner {
	right: -30px; 
	bottom: -30px; 
}
.raised_button, input[type="submit"] {
	color: rgba(0,0,0,.26); 
	background-color: rgba(0,0,0,.12);
}
.raised_button {
	font-weight: 700; 
	padding: 4px 13px; 
	display: inline-block;
	text-transform: uppercase; 
	border-radius: 3px;
	font-size: 14px;
	position: relative;
	top: 0px;
	box-shadow: 0px 3px 10px rgba(0,0,0,.2);
	<?php getTransition('all', '.3s', 'ease-in-out'); ?> 
}
.raised_button.block {
	display: block;
	width: 100%;
	text-align: center;
}
[href].raised_button, input[type="submit"], [onclick].raised_button, input[type="submit"], [id].raised_button {
	color: white !important; 
	top: 0px !important; 
	background-color: <?php echo $__PRIMARY_COLOR; ?> !important;
}
.raised_button:hover, .raised_button:hover {
	box-shadow: 0px 3px 15px rgba(0,0,0,.4); 
}
.flat_button {
	font-weight: 700; 
	padding: 8px 8px; 
	text-transform: uppercase; 
	border-radius: 3px;
	font-size: 14px; 
	color: rgba(0,0,0,.26); 
	<?php getTransition('all', '.3s', 'ease-in-out'); ?> 
}
[href].flat_button, [onclick].flat_button, [id].flat_button {
	color: <?php echo $__PRIMARY_COLOR; ?>; 
}
.flat_button>.flat_icon {
	background-color: #aaa;
}
[href].flat_button>.flat_icon, [onclick].flat_button>.flat_icon, [id].flat_button>.flat_icon {
	background-color: <?php echo $__PRIMARY_COLOR; ?>; 
} 
input[type="submit"] {
	font-weight: 700; 
	padding: 10px 13px; 
	text-transform: uppercase; 
	border-radius: 3px;
	font-size: 14px; 
	<?php getTransition('all', '.3s', 'ease-in-out'); ?> 
}
input[type="submit"].block {
	width: 100%;
	display: block;
}
.ink {
	display: block; position: absolute;
	border-radius: 100%;
	transform: scale(0);
	z-index: 99;
}
.ink.ink-white {
	background: rgba(255,255,255,.4);
}
.ink.ink-black {
	background: rgba(0,0,0,.2);
}
.ink.animate {
	animation: ripple 0.65s linear;
}
@keyframes ripple {
	100% {
		opacity: 0;
		transform: scale(2.5);
	}
}
.raised_button.small_button {
	font-size: 12px;
	padding: 6px 11px; 
}
.raised_button.large_button {
	font-size: 16px;
	padding: 15px 17px; 
}
.raised_button.xlarge_button {
	font-size: 20px;
	padding: 17px 19px; 
}
.raised_button.xxlarge_button {
	font-size: 25px;
	padding: 19px 21px; 
}
.loading {
	display: inline-block;
	width: 32px; 
	height: 32px; 
	background: url(../../../images/skin/oslo/bg/loading.gif); 
} 



input[type="range"] {
	width: 100%; 
	-webkit-appearance: none; 
} 
input[type=range]::-webkit-slider-runnable-track {
	width: 300px; 
	height: 3px; 
	background: rgba(0,0,0,.2); 
	margin: 20px 0px; 
} 
input[type=range]::-webkit-slider-thumb {
	-webkit-appearance: none; 
	height: 16px; 
	width: 16px; 
	border-radius: 50%; 
	margin-top: -6px; 
	background: white; 
	border: 3px solid <?php echo $__PRIMARY_COLOR; ?>;
} 
input[type=range]:focus {
	outline: none; 
} 
input[type=range]:active::-webkit-slider-thumb {
	background: <?php echo $__PRIMARY_COLOR; ?>; 
} 
input[type="submit"] {
	border: 0px; cursor: pointer; 
} 
input:not[type="checkbox"], select {
	width: 100%;
	display: block; 
	font-family: 'Roboto'; 
	font-weight: 500; 
	position: relative; 
} 
input[type="text"], input[type="password"], input[type="date"], input[type="time"], input[type="number"] {
	width: 100%;
	border: 0px; 
	padding: 5px 0px 10px 0px; 
	border-bottom: 1px solid #ccc; 
	font-family: 'Roboto';
} 
select {
	width: 100% !important;
	border: 0px; 
	border-bottom: 1px solid #ccc; 
	padding: 5px 0px 10px 0px;
	color: #444; 
} 
input[type="text"]:focus, input[type="text"]:active, select:focus, select:active, input[type="password"]:focus, input[type="password"]:active, input[type="date"]:focus, input[type="date"]:active, input[type="time"]:focus, input[type="time"]:active, input[type="number"]:focus, input[type="number"]:active {
	outline: 0px !important; 
	border-bottom: 1px solid <?php echo $__PRIMARY_COLOR; ?>; 
} 
ul.form-container {
	margin: 0px !important; 
	padding: 0px !important; 
	width: 100%; 
	display: table; 
	list-style-type: none; 
}
ul.form-container li {
	display: table-row; 
} 
ul.form-container li > div {
	display: table-cell; 
	vertical-align: middle; 
} 
ul.form-container li .icon-container {
	min-width: 0px; 
	max-width: 26px; 
} 
ul.form-container li .input-container {
	padding: 6px 0px; 
} 
ul.form-container li:first-child .input-container {
	padding-top: 0px; 
} 
ul.form-container li:last-child .input-container {
	padding-bottom: 0px; 
} 
ul.form-container li .input-container>label {
	display: block; 
	width: 100%; 
	float: left; 
	font-size: 12px; 
	padding: 0px 7px; 
	color: #888; 
	font-weight: 700; 
	text-transform: uppercase; 
	margin: 0px !important; 
	position: relative; 
	top: 3px; 
}
ul.form-container li .input-container div > label {
	cursor: pointer; 
	display: block; 
	width: 100%; 
	padding: 5px 0px; 
} 
table.form-container {
	width: 100%;
	border-collapse: collapse;
}
table.form-container td {
	padding: 6px 0px;
}
table.form-container label {
	font-size: 12px; 
	text-transform: uppercase; 
	color: #888; 
	font-weight: 700; 
}
label input[type="checkbox"] {
	display: none; 
} 
label:not(.switch) input[type="checkbox"] + span {
	display: inline-block; 
	width: 18px; 
	height: 18px; 
	margin: 0px; 
	margin-right: 10px; 
	margin-top: 5px; 
	vertical-align: middle; 
	cursor: pointer; 
	float: left; 
	border-radius: 3px; 
	background-color: transparent; 
	border: 2px solid rgba(0,0,0,.54); 
} 
label:not(.switch) input[type="checkbox"]:checked + span {
	border: 2px solid <?php echo $__PRIMARY_COLOR; ?>;
	background-color: <?php echo $__PRIMARY_COLOR; ?>; 
	background-image: url(../../../images/skin/oslo/icons/ic_done_white.png); 
	background-size: contain; 
	background-repeat: no-repeat;
	background-position: center center; 
}
label.switch {
	margin: 5px;
	display: inline-block;
}
label.switch input[type="checkbox"] + span {
	display: inline-block; 
	width: 38px; 
	height: 16px; 
	margin: 0px; 
	margin-right: 10px; 
	margin-top: 8px; 
	vertical-align: middle; 
	cursor: pointer; 
	float: left; 
	border-radius: 9px; 
	background-color: rgba(0,0,0,.2);
	box-shadow: 0px 0px 5px rgba(0,0,0,.2);
	position: relative;
}
label.switch input[type="checkbox"] + span div {
	background: rgba(255,255,255,.9);
	box-shadow: 0px 0px 5px rgba(0,0,0,.4);
	border-radius: 100%;
	position: absolute;
	left: -5px;
	top: -2px;
	width: 21px;
	height: 21px;
	<?php getTransition("all", ".2s", "ease-in-out"); ?>
}
label.switch input[type="checkbox"]:checked + span {
	background-color: <?php echo $__SECONDARY_COLOR; ?>; 
}
label.switch input[type="checkbox"]:checked + span div {
	background-color: <?php echo $__PRIMARY_COLOR; ?>;
	left: 20px;
}
label input[type="radio"] {
	display: none;
} 
label input[type="radio"] + span {
	display: inline-block; 
	width: 14px; 
	height: 14px;
	margin: 0px; 
	margin-right: 10px; 
	margin-top: 5px; 
	float: left; 
	vertical-align: middle; 
	cursor: pointer; 
	border-radius: 50%; 
	background-color: transparent; 
	border: 2px solid rgba(0,0,0,.54); 
} 
label input[type="radio"]:checked + span {
	border: 2px solid <?php echo $__PRIMARY_COLOR; ?>; 
	background-image: url(../../../images/skin/oslo/icons/ic_radio.png); 
	background-size: contain; 
	background-repeat: no-repeat; 
	background-position: center center; 
	background-color: <?php echo $__PRIMARY_COLOR; ?>; 
} 
label input[type="checkbox"][disabled] + span, label input[type="radio"][disabled] + span {
	border: 2px solid rgba(0,0,0,.26); 
} 
ul.form-container li .input-container div {
	float: left; 
} 







#app-container {
	width: 100%; 
	height: 100%; 
	position: relative; 
	background-color: <?php echo $__PRIMARY_COLOR; ?>; 
} 
#action-bar {
	position: fixed; 
	top: 0px; 
	left: 0px; 
	z-index: 98; 
	width: 100%; 
	height: auto;
	background-color: <?php echo $__PRIMARY_COLOR; ?>; 
	color: white; 
	box-shadow: 0px 0px 15px rgba(0,0,0,.5); 
	<?php getTransition('top', '.6s', 'ease'); ?> 
} 
#action-bar .row {
	display: table;
	position: relative;
	width: 100%;
}
#action-bar .menu-title {
	display: table-cell;
	height: 60px;
	position: relative; 
} 
#action-bar .menu-title .icons {
	height: 100%; 
} 
#action-bar .menu-title .title {
	font-size: 18px; 
	height: 100%;
	display: inline-block;
	vertical-align: middle;
	padding-top: 17px;
	padding-left: 17px;
	white-space: nowrap; 
	overflow: hidden;
    text-overflow: ellipsis;
}
#action-bar .actions {
	height: 40px;
	position: relative; 
	display: table-cell;
}
#action-bar ul {
	list-style-type: none !important;
	padding: 0px; 
	margin: 0px; 
	height: 100%; 
	display: block; 
	position: relative; 
}
#action-bar .actions ul {
	float: right;
}
#action-bar .menu-title ul {
	float: left;
}
#action-bar .row:first-child ul>li {
	height: 100%; 
	float: left; 
	display: inline-block;
	overflow: visible;
	position: relative; 
	padding: 0px; 
	margin: 0px; 
}
#action-bar .row:first-child ul>li>a {
	position: relative;
	display: block;
	float: left;
}
#action-bar ul>li>ul {
	list-style-type: none;
	background: #fefefe; 
	min-width: 150px; 
	max-width: 500px; 
	height: auto;
	z-index: 90;
	box-shadow: 0px 0px 15px #888; 
	border-radius: 2px; 
	position: absolute;
	top: 50%; 
	right: 50%; 
	margin: 0px; 
	padding: 0px;  
	display: none;
	overflow: hidden;
}
#action-bar ul>li>ul>li {
	display: block;
	overflow: visible;
	position: relative; 
	margin: 0px;
	float: left;
	width: 100%;
}
#action-bar ul>li>ul>li>a {
	position: relative;
	display: block;
	float: left;
	width: 100%;
	display: block; 
	padding: 12px; 
	color: #222 !important;
	padding-right: 30px;
	white-space: nowrap; 
	<?php getTransition('all', '.2s', 'ease-in-out'); ?> 
}
#action-bar ul>li>ul>li>a .img {
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center center;
	margin-right: 10px;
	vertical-align: middle;
	width: 24px;
	height: 24px;
	position: relative;
	display: inline-block;
}
#action-bar ul>li>ul>li:hover>a {
	background: rgba(0,0,0,.1); 
}
#action-bar .icons {
	height: 100%; 
	color: white; 
}
#action-bar .icons:hover {
	background-color: rgba(0,0,0,.3); 
} 
#action-bar .navigation {
	height: 60px;
	width: auto;
	display: table-cell;
	position: relative;
}
#action-bar .navigation::-webkit-scrollbar {
	height: 0px;
}
#action-bar .second .next {
	transform: rotate(180deg);
}
#action-bar .navigation>ul {
	position: relative;
	float: left;
	display: block;
}
#action-bar .navigation>ul>li {
	float: left;
	position: relative;
}
#action-bar .navigation>ul>li>a {
	padding: 19px;
	color: white;
	display: block;
	border-bottom: 5px solid transparent;
	<?php getTransition('all', '.3s', 'ease-in-out'); ?>
}
#action-bar .navigation>ul>li>a:hover, #action-bar .navigation>ul>li>a.selected {
	border-bottom: 5px solid white;
}
#data-action-bar {
	position: fixed; 
	top: -100px; 
	left: 0px; 
	z-index: 99; 
	width: 100%; 
	height: auto;
	background-color: white; 
	color: #888; 
	<?php getTransition('top', '.6s', 'ease'); ?> 
} 
#data-action-bar .row {
	display: table;
	position: relative;
	width: 100%;
}
#data-action-bar .menu-title {
	display: table-cell;
	height: 10px;
	position: relative; 
	vertical-align: top;
	padding-top: 17px;
} 
#data-action-bar .menu-title .icons {
	height: 100%; 
} 
#data-action-bar .menu-title .title {
	font-size: 18px; 
	float: left;
}
#data-action-bar .actions {
	height: 60px;
	position: relative; 
	display: table-cell;
}
#data-action-bar ul {
	list-style-type: none;
	padding: 0px; 
	margin: 0px; 
	height: 100%; 
	display: block; 
	position: relative; 
}
#data-action-bar .actions ul {
	float: right;
}
#data-action-bar .menu-title ul {
	float: left;
}
#data-action-bar .row:first-child ul>li {
	height: 100%; 
	float: left; 
	display: inline-block;
	overflow: visible;
	position: relative; 
	padding: 0px; 
	margin: 0px; 
}
#data-action-bar .row:first-child ul>li>a {
	position: relative;
	display: block;
	float: left;
}
#data-action-bar ul>li>ul {
	list-style-type: none;
	background: #fefefe; 
	min-width: 150px; 
	max-width: 500px; 
	height: auto;
	z-index: 90;
	box-shadow: 0px 0px 15px #888; 
	border-radius: 2px; 
	position: absolute;
	top: 50%; 
	right: 50%; 
	margin: 0px; 
	padding: 0px;  
	display: none;
	overflow: hidden;
}
#data-action-bar ul>li>ul>li {
	display: block;
	overflow: visible;
	position: relative; 
	margin: 0px;
	float: left;
	width: 100%;
}
#data-action-bar ul>li>ul>li>a {
	position: relative;
	display: block;
	float: left;
	width: 100%;
	display: block; 
	padding: 12px; 
	color: #222 !important;
	padding-right: 30px;
	white-space: nowrap; 
	<?php getTransition('all', '.2s', 'ease-in-out'); ?> 
}
#data-action-bar ul>li>ul>li>a .img {
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center center;
	margin-right: 10px;
	vertical-align: middle;
	width: 24px;
	height: 24px;
	position: relative;
	display: inline-block;
}
#data-action-bar ul>li>ul>li:hover>a {
	background: rgba(0,0,0,.1); 
}
#data-action-bar .icons {
	height: 100%; 
	color: white; 
} 
#data-action-bar .icons.gray_icon {
	opacity: .5;
	background-color: transparent !important;
}
#data-action-bar .icons:hover {
	background-color: rgba(0,0,0,.3); 
} 
#data-action-bar .icons.gray_icon:hover {
	background-color: rgba(0,0,0,.3) !important; 
} 
#data-action-bar .navigation {
	height: 60px;
	width: auto;
	display: table-cell;
	position: relative;
}
#data-action-bar .navigation::-webkit-scrollbar {
	height: 0px;
}
#data-action-bar .second .next {
	transform: rotate(180deg);
}
#data-action-bar .navigation>ul {
	position: relative;
	float: left;
	display: block;
}
#data-action-bar .navigation>ul>li {
	float: left;
	position: relative;
}
#data-action-bar .navigation>ul>li>a {
	padding: 19px;
	color: white;
	display: block;
	border-bottom: 5px solid transparent;
	<?php getTransition('all', '.3s', 'ease-in-out'); ?>
}
#data-action-bar .navigation>ul>li>a:hover, #data-action-bar .navigation>ul>li>a.selected {
	border-bottom: 5px solid white;
}


#float-left-menu {
	width: 300px; 
	height: 100%; 
	position: fixed; 
	z-index: 105; 
	top: 0px;
	left: -350px;
	background: #233444;
	color: #fff;
	overflow: hidden;
	box-shadow: 0px 0px 15px rgba(0,0,0,.5); 
	<?php getTransition('all', '.5s','ease'); ?>
} 
#float-left-menu .wrapper {
	position: absolute;
	top: 0px;
	left: 0px;
	right: -17px;
	height: 100%;
	overflow-y: scroll;
} 
#float-left-menu .wrapper::-webkit-scrollbar {
	width: 0px; 
} 
#float-left-menu .copyright {
	font-size: 11px;
	margin-bottom: 20px;
	line-height: 200%;
	width: 100%;
	padding: 20px;
	color: rgba(255,255,255,.5);
}
#float-left-menu .copyright a {
	color: inherit;
	font-weight: bold;
}
#float-left-menu .copyright a:hover {
	text-decoration: underline;
}
#float-left-menu .title {
	font-weight: 700; 
	width: 100%; 
	margin-bottom: 10px; 
	padding: 5px 0px; 
	display: block; 
	position: relative;
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center center;
}
#float-left-menu .title.cover {
	height: 150px;
}
#float-left-menu .title .name {
	position: absolute;
	bottom: 20px;
	left: 20px;
	right: 35px;
	white-space: nowrap; 
	font-size: 20px;
	overflow: hidden;
	text-overflow: ellipsis;
}
#float-left-menu .title .icons {
	margin-bottom: 3px; 
} 
#float-left-menu .title .icons {
	width: 48px;
	height: 48px; 
	<?php getBackgroundIcon('menu', 'white'); ?>
	<?php getTransition('all', '.4s', 'ease'); ?>
	<?php getRotation('180'); ?>
}
#float-left-menu .title .icons.hover:hover {
	<?php getRotation('0'); ?>
	<?php getBackgroundIcon('arrow-left', 'white'); ?>
}
#float-left-menu ul {
	list-style-type: none; 
	padding: 0px; 
	margin: 0px; 
	display: block; 
} 
#float-left-menu ul li {
	padding: 0px; 
	margin: 0px;
	position: relative;
	overflow: hidden;
} 
#float-left-menu ul li a {
	display: block; 
	font-size: 13px; 
	padding: 17px; 
	font-weight: 700; 
	color: inherit;
	opacity: .8;
	position: relative;
	<?php getTransition('all', '.2s', 'ease-in-out'); ?>
}
#float-left-menu ul li a:hover {
	background: rgba(0,0,0,.2);
	opacity: 1;
}
#float-left-menu ul a .img {
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center center;
	margin-right: 10px;
	vertical-align: middle;
	width: 24px;
	height: 24px;
	position: relative;
	display: inline-block;
}
#float-left-menu ul ul {
	max-height: 0px; 
	overflow: hidden;
}
#float-left-menu ul ul a {
	padding-left: 40px; 
	font-weight: 500;
} 
#float-left-menu ul ul a:hover {
	background: rgba(0,0,0,.15) !important;
} 










#body-container {
	width: 100%; 
	min-width: <?php echo $__MIN_WEBSITE_WIDTH; ?>; 
	position: relative;  
	overflow: hidden;
} 
#body-container .spacer {
	width: 100%; 
	height: 60px; 
	display: block;
} 
#body-container .cover {
	width: 100%; 
	position: relative;
	background-size: cover; 
	background-repeat: no-repeat;
	background-position: center center; 
	background-color: #222;
	box-shadow: 0px 0px 15px rgba(0,0,0,.4); 
}
#body-container .wide {
	height: 400px;
} 
#body-container .cover .wrapper {
	max-width: <?php echo $__MAX_WEBSITE_WIDTH; ?>; 
	min-width: <?php echo $__MIN_WEBSITE_WIDTH; ?>; 
	height: 100%; 
	position: relative; 
	margin: 0px auto; 
} 
#body-container .cover .logo {
	background-image: url(../../../images/resources/logo.png); 
	min-width: <?php echo $__MIN_WEBSITE_WIDTH; ?>; 
	max-width: <?php echo $__MAX_WEBSITE_WIDTH; ?>; 
	height: 40%; 
	display: block; 
	margin: 0px auto; 
	background-size: auto 50%;
	background-position: center bottom; 
	background-repeat: no-repeat;
} 
#body-container .cover .wrapper .text {
	color: white;
	font-weight: 300;
	font-size: 2em;
	padding: 0px 30px;
	text-align: center;
}
#body-container .cover .icons {
	background-color: #F44336; 
	width: 60px; 
	height: 60px;
} 
#body-container .content {
	max-width: 100%; 
	background: #f0f0f0;
	min-width: <?php echo $__MIN_WEBSITE_WIDTH; ?>; 
	margin: 0px auto; 
	position: relative; 
	overflow: hidden; 
	padding-bottom: 30px;
	background-repeat: no-repeat;
	background-size: cover;
	background-attachment: fixed;
	background-position: center center;
}
#body-container .content>.title {
	max-width: <?php echo $__MAX_WEBSITE_WIDTH; ?>; 
	min-width: <?php echo $__MIN_WEBSITE_WIDTH; ?>; 
	display: block; 
	position: relative; 
	margin: 0px auto; 
	color: <?php echo $__PRIMARY_COLOR; ?>;
	padding-top: 50px; 
	text-shadow: 0px 2px 2px rgba(0,0,0,.3); 
} 
#body-container .content .wrapper {
	max-width: <?php echo $__MAX_WEBSITE_WIDTH; ?>; 
	min-width: <?php echo $__MIN_WEBSITE_WIDTH; ?>; 
	margin: 0px auto; 
	padding: 0px;
	line-height: 150%;
	overflow: visible; 
	position: relative; 
} 
#body-container .content .bg-cover {
	background-color: <?php echo $__SECONDARY_COLOR; ?>;
	width: 100%;
	min-height: 200px; 
	position: absolute; 
	background-size: cover; 
	background-repeat: no-repeat; 
	background-position: center center;
} 
#body-container .content .wrapper>div {
	float: left; 
	line-height: 200%;
} 
<?php 
$column_sizes = array(1,2,3,3.33,4,5,6,6.66,7,8,9,10);
foreach($column_sizes as $column_size) {
?> 
#body-container .content .col-<?php echo str_replace(".", "-", $column_size) ?> {
	width: <?php echo $column_size*10; ?>%; 
	padding: 15px;
} 
<?php 
} 
?>
<?php 
$offset_sizes = array(1,2,3,3.33,4,5,6,7,8,9,10);
foreach($offset_sizes as $offset_size) {
?> 
#body-container .content .offset-<?php echo str_replace(".", "-", $offset_size) ?> {
	margin-left: <?php echo $offset_size*10; ?>%;
}
<?php 
} 
?>
#body-container .content [class^="col-"] h1 {
	color: white !important; 
	margin-bottom: 30px;
	text-shadow: 0px 2px 5px rgba(0,0,0,.6); 
}
#body-container .content .card {
	background: white; 
	box-shadow: 0px 0px 15px rgba(153,153,153,.30);
	padding: 25px;
	border-radius: 5px; 
	margin-bottom: 30px; 
	position: relative; 
	word-wrap: break-word;
} 
#body-container .content .card.green {
	background: #cbffd5 !important;
}
#body-container .content .card.red {
	background: #ffcbcb !important;
}
#body-container .content .card.compact {
	padding: 15px;
}
#body-container .content .card.button-container {
	padding: 0px;
	margin-bottom: 40px;
	overflow: hidden;
}
#body-container .content .card.button-container .table .row .cell.compact {
	padding: 0px;
}
#body-container .content .card.button-container .table .row .cell:not(.compact) {
	padding-left: 15px;
	vertical-align: middle;
}
#body-container .content .card.button-container ul.button-container li {
	margin: 0px;
	border-radius: 0px;
}
#body-container .content .card.button-container ul.button-container.divider li {
	border-top: 0px;
	border-left: 0px;
	border-right: 1px solid rgba(0,0,0,.15);
	border-bottom: 0px;
}
#body-container .content .card.button-container ul.button-container.right.divider li {
	border-top: 0px;
	border-left: 1px solid rgba(0,0,0,.15);
	border-right: 0px;
	border-bottom: 0px;
	border-radius: 0px;
}
#body-container .content .card.button-container ul.button-container li a {
	padding: 10px 15px;
}
#body-container .content .card.hide {
	max-height: 0;
	padding: 0px;
	margin: 0px;
}
<?php 
$column_sizes = array(2,3,4,5);
foreach($column_sizes as $column_size) {
?> 
#body-container .content .column-count-<?php echo str_replace(".", "-", $column_size) ?> {
	-webkit-column-count: <?php echo $column_size; ?>;
	-moz-column-count: <?php echo $column_size; ?>;
	-ms-column-count: <?php echo $column_size; ?>;
	-o-column-count: <?php echo $column_size; ?>;
	column-count: <?php echo $column_size; ?>;
	-webkit-column-gap: 20px;
	-moz-column-gap: 20px;
	-ms-column-gap: 20px;
	-o-column-gap: 20px;
	column-gap: 20px;
} 
<?php 
} 
?>
#body-container .content .card .icons {
	width: 60px; 
	height: 60px; 
	background-color: #F44336;
} 
#body-container .content .wrapper>div h1, 
#body-container .content .wrapper>div h2, 
#body-container .content .wrapper>div h3, 
#body-container .content .wrapper>div h4, 
#body-container .content .wrapper>div h5, 
#body-container .content .wrapper>div h6 {
	padding: 0px;
	color: <?php echo $__PRIMARY_COLOR; ?>;
}
ul.button-container {
	list-style-type: none; 
	width: 100%; 
	margin: 0px; 
	padding: 0px; 
	display: block; 
	font-size: 0px;
}
ul.button-container.top {
	margin-bottom: 15px;
}
ul.button-container.bottom {
	margin-top: 15px;
}
ul.button-container.vertical>li {
	width: 100%;
	display: block;
}
ul.button-container.vertical>li>a {
	width: 100%;
	text-align: center;
	display: block;
}
ul.right {
	text-align: right;
} 
ul.button-container>li {
	display: inline-flex; 
	margin: 0px; 
	padding: 0px; 
	margin-top: 10px;
	margin-right: 12px; 
	border-radius: 3px;
	position: relative;
	overflow: hidden;
} 
ul.right>li {
	margin-left: 12px; 
	margin-right: 0px; 
} 
ul.button-container>li>a {
	position: relative;
	display: block;
	float: left;
} 
ul.button-container.block>li {
	width: 100% !important;
}
ul.button-container.block>li>a {
	width: 100% !important;
	text-align: center;
}
ul.button-container.block.left>li>a {
	text-align: left;
}
#footer-container {
	background: #232323; 
	width: 100%; 
	color: #bbb; 
} 
#footer-container .wrapper {
	width: 100%; 
	overflow: hidden; 
} 
#footer-container .wrapper .col {
	width: 50%; 
	float: left; 
	padding: 20px; 
	font-weight: 500; 
	font-size: 13px; 
} 
#footer-container .wrapper .col:last-child {
	text-align: right; 
}
#footer-container a {
	color: <?php echo $__PRIMARY_COLOR; ?>;
}
#goTop {
	width: 60px; 
	height: 60px;
	background-color: #F44336; 
	background-repeat: no-repeat; 
	background-position: center center; 
	position: fixed; 
	z-index: 80; 
	bottom: -100px; 
	right: 30px; 
	<?php getTransition('all', '.5s', 'ease'); ?>
} 
ul.list {
	list-style-type: none; 
	padding: 0px; 
	overflow: hidden; 
	width: 100%; 
	display: table;
} 
ul.list li {
	display: table-row;
} 
ul.list li div {
	padding: 18px 0px; 
	display: table-cell; 
	vertical-align: middle; 
}
ul.list li:not(:last-child) .primary, ul.list li:not(:last-child) .secondary {
	border-bottom: 1px solid rgba(0,0,0,.12);
}
ul.list li.title div {
	padding: 0px; 
	font-size: 13px; 
	font-weight: 600; 
	text-transform: uppercase; 
	color: rgba(0,0,0,.6); 
	padding: 0px 10px; 
}
ul.list li.title div:not(:first-child) {
	border-bottom: 1px solid rgba(0,0,0,.12);
}
ul.list li .icon {
	width: 1%; 
}
ul.list li .secondary {
	width: auto;
	text-align: right;
}
ul.list li .secondary .showhover {
	opacity: 0;
	<?php getTransition("all", ".2s", "ease-in-out"); ?>
}
ul.list li:hover .secondary .showhover {
	opacity: .8;
}
ul.list li .primary {
	padding: 5px 10px; 
	line-height: 130%; 
} 
ul.list li .primary span {
	display: inline-block; 
	width: 100%; 
	font-size: 12px; 
} 
ul.list li .primary span:first-child {
	font-size: 14px; 
	font-weight: 700; 
} 
ul.list-option {
	width: 100%;
	list-style-type: none;
	padding: 0px;
	margin: 0px;
	overflow: hidden;
}
ul.list-option li {
	width: 100%;
	float: left;
	border-bottom: 1px solid rgba(0,0,0,.15);
}
ul.list-option li a {
	padding: 10px;
	width: 100%;
	display: block;
}
table.list {
	width: 100%;
	border-collapse: collapse;
}
table.list.small tr:not(.title) td {
	font-size: 12px;
}
table.list td {
	padding: 8px;
}
table.list tr.title td:not(:first-child) {
	font-weight: bold;
	font-size: 13px;
	text-transform: uppercase;
	color: rgba(0,0,0,.6); 
}
table.list td.primary span {
	display: block;
	width: 100%;
}
table.list td.primary span:first-child {
	font-weight: bold;
}
table.list td.primary span:not(:first-child) {
	font-size: 12px;
}
table.list tr:not(last-child) td:not(:first-child) {
	border-bottom: 1px solid #e0e0e0;
}
table.list .showhover {
	opacity: 0;
	<?php getTransition("all", ".2s", "ease-in-out"); ?>
}
table.list tr:hover .showhover {
	opacity: 1;
}
#blackTrans {
	position: fixed; 
	z-index: 100; 
	width: 100%; 
	height: 100%; 
	top: 0px; 
	left: 0px; 
	display: none; 
	background: rgba(0,0,0,.5); 
	cursor: pointer; 
}
#loading {
	display: none;
	z-index: 101;
	position: fixed;
	box-shadow: 0px 0px 10px rgba(0,0,0,.5);
	width: 60px;
	height: 60px;
	right: 30px;
	bottom: 30px;
	background-color: white;
	background-image: url(../../../images/skin/oslo/bg/loading.gif);
	background-repeat: no-repeat;
	background-position: center center;
	border-radius: 100%;
}
#bottom-sheet {
	position: fixed; 
	width: <?php echo $__MIN_WEBSITE_WIDTH; ?>;
	min-height: 300px; 
	max-height: 80%; 
	overflow-y: scroll; 
	background: white;
	border-radius: 4px 4px 0px 0px; 
	box-shadow: 0px 0px 20px rgba(0,0,0,.5); 
	left: 50%;
	bottom: -100%;
	z-index: 101;
	margin-left: -<?php echo $__MIN_WEBSITE_WIDTH/2; ?>px; 
	<?php getTransition('bottom', '.7s', 'ease'); ?> 
} 
#bottom-sheet::-webkit-scrollbar {
	width: 0px;
} 
#bottom-sheet::-webkit-scrollbar-track {
	background: rgba(0,0,0,.1);
} 
#bottom-sheet::-webkit-scrollbar-thumb {
	border-radius: 10px; 
	background: rgba(0,0,0,.1); 
} 
#bottom-sheet .cover {
	background-color: <?php echo $__SECONDARY_COLOR; ?>; 
	background-repeat: no-repeat; 
	background-size: cover; 
	background-position: center center; 
	width: 100%; 
	height: 200px; 
	position: relative;
} 
#bottom-sheet .cover .title {
	position: absolute; 
	left: 30px; 
	right: 30px;
	bottom: 30px; 
	color: white; 
	font-weight: 500; 
	font-size: 28px; 
	text-shadow: 0px 2px 2px rgba(0,0,0,.5); 
} 
#bottom-sheet .cover .shadow {
	width: 100%; 
	height: 100px;
	position: absolute; 
	left: 0px; 
	bottom: 0px; 
	background-image: url(../../../images/skin/oslo/bg/shadow-bottom.png); 
	opacity: .5; 
} 
#bottom-sheet a.icons {
	width: 48px; 
	height: 48px; 
	display: block; 
	position: absolute; 
	top: 0px; 
	right: 0px;
} 
#bottom-sheet .content {
	padding: 25px; 
	line-height: 200%; 
	font-size: 14px; 
} 
#bottom-sheet .content h3 {
	padding: 0px;
	color: <?php echo $__PRIMARY_COLOR; ?>;
} 
#bottom-sheet .loading {
	position: absolute; 
	top: 50%; 
	left: 50%; 
	margin-top: -16px; 
	margin-left: -16px; 
} 
#dialog-box {
	width: 300px;
	height: auto;
	position: fixed; 
	top: 50%; 
	left: 50%; 
	display: none; 
	margin-left: -150px; 
	margin-top: -50px; 
	background: white; 
	border-radius: 4px; 
	box-shadow: 0px 0px 20px rgba(0,0,0,.5); 
	z-index: 101; 
	overflow: hidden; 
	<?php getTransition('all', '.5s', 'ease-in-out'); ?> 
} 
#dialog-box .wrapper {
	padding: 20px; 
} 
#dialog-box .wrapper .title {
	font-size: 18px; 
	padding-top: 10px; 
	display: block; 
	font-weight: 700; 
	color: <?php echo $__PRIMARY_COLOR; ?>; 
} 
#dialog-box .wrapper p {
	line-height: 150%;
} 
#dialog-box .loading {
	margin: 50px;
}
#snackbar {
	background-color: #323232;
	min-width: 288px;
	max-width: 568px;
	position: fixed;
	bottom: -100px;
	left: 50%;
	border-radius: 2px 2px 0px 0px;
	color: white;
	font-size: 14px;
	display: table;
	z-index: 102;
	<?php getTransition('bottom', '.5s', 'ease-in-out'); ?>
}
#snackbar .wrapper {
	display: table-row;
}
#snackbar .primary {
	display: table-cell;
	padding: 16px;
	vertical-align: middle;
}
#snackbar .secondary {
	display: table-cell;
	padding-right: 16px;
	vertical-align: middle;
}
#snackbar .secondary ul {
	margin-top: 0px;
}
#snackbar .secondary ul li {
	margin-top: 0px;
}
table.info {
	width: 100%;
	border-collapse: collapse;
	font-size: 14px;
}
table.info td {
	padding: 8px;
}
table.info tr {
	border-bottom: 1px solid rgba(0,0,0,.1);
}
table.info th {
	text-align: left;
	padding: 8px;
	color: <?php echo $__PRIMARY_COLOR; ?>;
}
#numDataSelected {
	font-size: 12px;
	text-transform: uppercase;
	font-weight: bold;
	color: gray;
}
.hide {
	display: none;
}


@media screen and (max-width: 800px) {
	#body-container .content>.wrapper>div {
		width: 100% !important;
		margin-left: 0%; 
	}
	#body-container .content .wrapper>div:first-child>div:last-child {
		margin-bottom: 15px !important;
	} 
	#body-container .content .wrapper>div:not(:first-child) {
		padding-top: 0px !important; 
	} 
	<?php 
	$column_sizes = array(2,3,4,5);
	foreach($column_sizes as $column_size) {
	?> 
	#body-container .content .column-count-<?php echo str_replace(".", "-", $column_size) ?> {
		-webkit-column-count: 1;
		-moz-column-count: 1;
		-ms-column-count: 1;
		-o-column-count: 1;
		column-count: 1;
		-webkit-column-gap: 0px;
		-moz-column-gap: 0px;
		-ms-column-gap: 0px;
		-o-column-gap: 0px;
		column-gap: 0px;
	} 
	<?php 
	} 
	?>
} 
<?php $useragent=$_SERVER['HTTP_USER_AGENT']; if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
?> 
#body-container .content .wrapper>div:first-child>div:last-child {
	margin-bottom: 15px !important;
} 
#body-container .content .wrapper>div:not(:first-child) {
	padding-top: 0px !important; 
} 
#body-container .cover .logo {
	height: 35%;
}
<?php 
$column_sizes = array(2,3,4,5);
foreach($column_sizes as $column_size) {
?> 
#body-container .content .column-count-<?php echo str_replace(".", "-", $column_size) ?> {
	-webkit-column-count: 1;
	-moz-column-count: 1;
	-ms-column-count: 1;
	-o-column-count: 1;
	column-count: 1;
	-webkit-column-gap: 0px;
	-moz-column-gap: 0px;
	-ms-column-gap: 0px;
	-o-column-gap: 0px;
	column-gap: 0px;
} 
<?php 
} 
?>
#snackbar {
	min-width: 360px;
	max-width: 360px;
	border-radius: 0px;
}
#float-left-menu .title .icons {
	<?php getRotation('0'); ?>
	<?php getBackgroundIcon('arrow-left', 'white'); ?>
}
table.info {
	font-size: 12px;
}
.showhover {
	opacity: 1 !important
}
#data-action-bar .menu-title {
	padding-top: 20px !important;
}
.hideinmobile {
	display: none;
}
<?php 
} 
?>