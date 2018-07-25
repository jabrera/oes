$responsiveMenu = true;
// WHEN BROWSER IS LOADED
$(document).ready(function() {
	$except = 1;
	updateLayout("loaded");
	$(".full.cover").css("height",  $(window).height() - $("#action-bar").height());
	$("html").click(function(e) {
		if(!$(e.target).hasClass("ul.dropdownlist")){
			$("ul.dropdownlist").css("display", "none");
		}
	});
	$("#blackTrans").click(function() {
		if(!$("#loading").is(":visible")) {
			showElement("none");
		}
	});
	$.each([1,2,3,3.33,4,5,6,7,8,9,10], function(index, value) {
		$(".weight-"+value).css("width", value*10+"% !important").css("width", "-=16px !important");
		$(".weight-"+value).css({"margin": "0px 7px !important"});
	});
	$("#bottom-sheet").css("bottom", "-"+($(window).height()+200)+"px");
	$(".action_icon").each(function() {
		$(this).css("width", $(this).css("height"));
		$(this).css("min-width", $(this).css("height"));
	});
	$(".action_icon").children("span").each(function() {
		$(this).css("top",  ($(this).parent().height()/2)-($(this).height()/2)-1);
	});
	$("span").parent(".icons").css({
		"background-position": "15px center",
		"padding-left": "55px",
		"padding-right": "15px"
	});
	$("ul.dropdownlist").each(function() {
		$(this).siblings("a").click(function(e) {	
			$("ul.dropdownlist").css("display", "none");
			$(this).siblings("ul.dropdownlist").toggle();
			e.stopPropagation();
		});
	});
	$("#float-left-menu ul>li").click(function() {
		$("#float-left-menu ul>li>ul").animate({
			"max-height": "0px"
		}, 500);
		$("#float-left-menu ul a").css({
			"background-color": "rgba(0,0,0,0)"
		}, 500);
		$(this).find("> ul").animate({
			"max-height": "500px"
		}, 500);
		$(this).find("> a").css({
			"background-color": "rgba(0,0,0,.3)"
		}, 500);
	});
	$("#body-container .content .bg-cover").each(function() {
		$bg_height = $(this).height();
		$(this).siblings(".title").css("padding-top", $bg_height-170);
	});
	$("body").css("padding-top", $("#action-bar").height());
	$("#body-container .content .title").each(function() {
		if($(this).siblings(".bg-cover").length) {
			$(this).css({"color": "white"});
		}
	});
	var parent, ink, d, x, y;
	$(".raised_button, .flat_button").click(function(e){
		parent = $(this).parent();
		if(parent.find(".ink").length == 0) {
			if($(this).hasClass( "raised_button")) {
				parent.prepend("<span class=\"ink ink-white\"></span>");
			} else {
				parent.prepend("<span class=\"ink ink-black\"></span>");
			}
		}
		ink = parent.find(".ink");
		ink.removeClass("animate");
		if(!ink.height() && !ink.width()) {
			d = Math.max(parent.outerWidth(), parent.outerHeight());
			ink.css({height: d, width: d});
		}
		x = e.pageX - parent.offset().left - ink.width()/2;
		y = e.pageY - parent.offset().top - ink.height()/2;
		ink.css({top: y+"px", left: x+"px"}).addClass("animate");
	});
	$(".wrapper.no-breakedge").each(function() {
		$(this).siblings(".title").css({
			"padding-top": $(this).siblings(".bg-cover").height()-$(this).siblings(".title").height()-20+"px",
			"padding-bottom": "20px"
		});
	});
	$("ul.ripple>li>a").click(function(e){
		parent = $(this).parent();
		if(parent.find(".ink").length == 0) {
			parent.prepend("<span class=\"ink ink-black\"></span>");
		}
		ink = parent.find(".ink");
		ink.removeClass("animate");
		if(!ink.height() && !ink.width()) {
			d = Math.max(parent.outerWidth(), parent.outerHeight());
			ink.css({height: d, width: d});
		}
		x = e.pageX - parent.offset().left - ink.width()/2;
		y = e.pageY - parent.offset().top - ink.height()/2;
		ink.css({top: y+"px", left: x+"px"}).addClass("animate");
	});
	$("[id^=\"card-\"]").css("max-height", $(this).height());
	$("#snackbar").mouseover(function() {
		clearTimeout(to);
	}).mouseleave(function() {
		setTimeout(function() {
			$("#snackbar").css("bottom", "-100px");
		}, 1000);
	});
	$(".card.hide").css("overflow", "hidden");
	$(".card.hide").animate({
		"max-height": "0px",
		"padding-top": "0px",
		"padding-bottom": "0px",
		"margin-bottom": "0px"
	}, 0);
	if(isMobile()) {
		$("table.info td:not(.imp), table.info th:not(.imp)").css({"display": "none"});
	}
});


// WHEN BROWSER IS ZOOMED
var zoom = document.documentElement.clientWidth / window.innerWidth;
$(window).resize(function() {
	var zoomNew = document.documentElement.clientWidth / window.innerWidth;
	updateLayout("resized");
});



// WHEN BROWSER IS SCROLLED
$before = 0;
$snackbar = 0;
$(window).scroll(function() { 
	$x = $(window).height();
	$pos = $(window).scrollTop();
	if($snackbar == 0) {
		if($pos > 200) {
			if($pos > $(document).height()-$(window).height()-$("#footer").height()-30) {
				$("#goTop").css("bottom", "80px");
				$("#goTop").css("position", "absolute");
			} else {
				$("#goTop").css("position", "fixed");
				$("#goTop").css("bottom", "30px");
			}
		} else {
			$("#goTop").css("position", "fixed");
			$("#goTop").css("bottom", "-100px");
		}
	}
	if(isMobile()) {
		$("#action-bar").css("top", "0px");
	} else {
		if($("#float-left-menu").width()+960 >= $(window).width()) {
			if($before < $pos) {
				if($pos > 200) {
					$("#action-bar").css("top", "-"+$("#action-bar").height()+"px");
					$before = $pos;
				}
			} else {
				$("#action-bar").css("top", "0px");
				$before = $pos;
			}
		}
	}
});


function dismissCard(cardID, effect) {
	$("#card-"+cardID).css("overflow", "hidden");
	if(effect == "swipe-left") {
		$("#card-"+cardID).animate({
			"right": "300px",
			"opacity": "0"
		}, 500, function() {
			$("#card-"+cardID).animate({
				"max-height": "0px",
				"padding-top": "0px",
				"padding-bottom": "0px",
				"margin-bottom": "0px"
			}, 2000);
		});
	} else if(effect == "swipe-right") {
		$("#card-"+cardID).animate({
			"left": "300px",
			"opacity": "0"
		}, 500, function() {
			$("#card-"+cardID).animate({
				"max-height": "0px",
				"padding-top": "0px",
				"padding-bottom": "0px",
				"margin-bottom": "0px"
			}, 2000);
		});
	} else if(effect == "fast") {
		$("#card-"+cardID+":not(.button-container)").animate({
			"max-height": "0px",
			"padding-top": "0px",
			"padding-bottom": "0px",
			"margin-bottom": "0px"
		}, 1);
		$("#card-"+cardID+".button-container").animate({
			"max-height": "0px",
			"padding-top": "0px",
			"padding-bottom": "0px",
			"margin-bottom": "0px"
		}, 1);
	} else {
		$("#card-"+cardID+":not(.button-container)").animate({
			"max-height": "0px",
			"padding-top": "0px",
			"padding-bottom": "0px",
			"margin-bottom": "0px"
		}, 2000);
		$("#card-"+cardID+".button-container").animate({
			"max-height": "0px",
			"padding-top": "0px",
			"padding-bottom": "0px",
			"margin-bottom": "0px"
		}, 100);
	}
}

function showCard(cardID) {
	if($("#card-"+cardID).css("left") == "300px") {
		$("#card-"+cardID).css("left", "0px");
	} else {
		$("#card-"+cardID).css("right", "0px");
	}
	$("#card-"+cardID+":not(.button-container)").animate({
		"overflow": "visible",
		"max-height": $(this).height()+"px",
		"opacity": "1",
		"padding": "25px",
		"margin-bottom": "30px"
	}, 1000);
	$("#card-"+cardID+".button-container").animate({
		"overflow": "visible",
		"max-height": $(this).height()+"px",
		"opacity": "1",
		"margin-bottom": "40px"
	}, 100);
}

function showElement(sel) {
	if(sel != "none") {
		$("#blackTrans").css("display", "block");
		$("html").css({
			"position": "static",
			"overflow-y": "hidden",
			"width": "100%",
			"height": "100%"
		});
	}
	if(sel == "#float-left-menu") {
		$(sel).css("left", "0px");
	} else if(sel == "#bottom-sheet") {
		$(sel).css("bottom", "0px");
	} else if(sel == "#dialog-box") {
		$(sel).css("display", "block");
	} else if(sel = "none") {
		$("html").css({
			"position": "relative",
			"overflow-y": "scroll",
			"width": "auto",
			"height": "auto"
		});
		$("#loading").hide("slow");
		$("#blackTrans").css("display", "none");
		$("#dialog-box").css("display", "none");
		if($responsiveMenu) {
			if($("#float-left-menu").width()+960 >= $(window).width()) {
				$("#float-left-menu").css("left", "-350px");
			}
		}
		$("#dialog-box").html("<div class=\"wrapper\"><center><div class=\"loading\"></div></center></div>");
		$("#dialog-box").css({
			"margin-top": "-"+(($("#dialog-box").height()/2).toFixed())+"px"
		});
		$("#bottom-sheet").css("bottom", "-"+($(window).height()+200)+"px");
	}
}

function hideElement(sel) {
	if(sel == "#float-left-menu") {
		if($responsiveMenu) {
			if($("#float-left-menu").width()+960 >= $(window).width()) {
				$("#float-left-menu").css("left", "-350px");
			}
		}
	} else if(sel == "#bottom-sheet") {
		$("#bottom-sheet").css("bottom", "-"+($(window).height()+200)+"px");
	} else if(sel == "#dialog-box") {
		$("#dialog-box").html("<div class=\"wrapper\"><center><div class=\"loading\"></div></center></div>");
		$("#dialog-box").css({
			"margin-top": "-"+(($("#dialog-box").height()/2).toFixed())+"px"
		});
		$("#dialog-box").css("display", "none");
	}
}

function showDataAction(show) {
	if(show) {
		$("#data-action-bar").animate({
			"top": "0px"
		}, 500);
	} else {
		$("#data-action-bar").animate({
			"top": "-100px"
		}, 500);
	}
}

function showLoading(show) {
	if(show) {
		$("#loading").show("slow");
	} else {
		$("#loading").hide("slow");
	}
}

function showBottomSheet(show, actionID) {
	showLoading(true);
	$("#bottom-sheet").html("<div class=\"loading\"></div>");
	if(actionID == "") {
		$.ajax({
			type: "POST",
			cache: true,
			url: "process.php?action=show-bottom-sheet",
			data: {name: show},
			success: function(html) {
				$("#bottom-sheet").html(html);
				showElement("#bottom-sheet");
				showLoading(false);
			}
		});
	} else {
		$.ajax({
			type: "POST",
			cache: true,
			url: "process.php?action=show-bottom-sheet",
			data: {name: show, id: actionID},
			success: function(html) {
				$("#bottom-sheet").html(html);
				showElement("#bottom-sheet");
				showLoading(false);
			}
		});
	}
}

function showDialogBox(show, actionID) {
	$("#dialog-box .wrapper").html("<center><div class=\"loading\"></div></center>");
	showElement("#dialog-box");
	if(actionID == null) {
		$.ajax({
			type: "POST",
			cache: true,
			url: "process.php?action=show-dialog-box",
			data: {name: show},
			success: function(html) {
				$("#dialog-box .wrapper").html(html);
				$("#dialog-box").css({
					"margin-top": "-"+(($("#dialog-box").height()/2).toFixed())+"px"
				});
			}
		});
	} else {
		$.ajax({
			type: "POST",
			cache: true,
			url: "process.php?action=show-dialog-box",
			data: {name: show, id: actionID},
			success: function(html) {
				$("#dialog-box .wrapper").html(html);
				$("#dialog-box").css({
					"margin-top": "-"+(($("#dialog-box").height()/2).toFixed())+"px"
				});
			}
		});
	}
}

var to;
function showSnackbar(show, actionID) {
	clearTimeout(to);
	if($("#snackbar").css("bottom") == "0px") {
		$("#snackbar").css("bottom", "-100px");
		if(isMobile()) {
			$("#goTop").css("bottom", "-="+$("#snackbar").height());
			$snackbar = 0;
		}
		setTimeout(function() {
			snackbarEffects(show, actionID);
		}, 500);
	} else {
		snackbarEffects(show, actionID);
	}
}
function showSnackbarMsg(msg) {
	clearTimeout(to);
	$("#snackbar .wrapper").html('<div class="primary"></div>');
	if($("#snackbar").css("bottom") == "0px") {
		$("#snackbar").css("bottom", "-100px");
		if(isMobile()) {
			$("#goTop").css("bottom", "-="+$("#snackbar").height());
			$snackbar = 0;
		}
		setTimeout(function() {
			$("#snackbar .wrapper .primary").html(msg);
			$("#snackbar").css({
				"margin-left": "-"+($("#snackbar").outerWidth()/2)+"px",
				"bottom": "0px"
			});
			if(isMobile()) {
				$("#goTop").css("bottom", "+="+$("#snackbar").height());
				$snackbar = 1;
			}
			to = setTimeout(function() {
				$("#snackbar").css("bottom", "-100px");
				if(isMobile()) {
					$("#goTop").css("bottom", "-="+$("#snackbar").height());
					$snackbar = 0;
				}
			}, 5000);
		}, 500);
	} else {
		$("#snackbar .wrapper .primary").html(msg);
		$("#snackbar").css({
			"margin-left": "-"+($("#snackbar").outerWidth()/2)+"px",
			"bottom": "0px"
		});
		if(isMobile()) {
			$("#goTop").css("bottom", "+="+$("#snackbar").height());
			$snackbar = 1;
		}
		to = setTimeout(function() {
			$("#snackbar").css("bottom", "-100px");
			if(isMobile()) {
				$("#goTop").css("bottom", "-="+$("#snackbar").height());
				$snackbar = 0;
			}
		}, 5000);
	}
}
function snackbarEffects(show, actionID) {
	if(actionID == null) {
		$.ajax({
			type: "POST",
			cache: true,
			url: "process.php?action=show-snackbar",
			data: {name: show},
			success: function(html) {
				$("#snackbar .wrapper").html(html);
				$("#snackbar").css({
					"margin-left": "-"+($("#snackbar").outerWidth()/2)+"px",
					"bottom": "0px"
				});
				if(isMobile()) {
					$("#goTop").css("bottom", "+="+$("#snackbar").height());
					$snackbar = 1;
				}
				to = setTimeout(function() {
					$("#snackbar").css("bottom", "-100px");
					if(isMobile()) {
						$("#goTop").css("bottom", "-="+$("#snackbar").height());
						$snackbar = 0;
					}
				}, 5000);
			}
		});
	} else {
		$.ajax({
			type: "POST",
			cache: true,
			url: "process.php?action=show-snackbar",
			data: {name: show, id: actionID},
			success: function(html) {
				$("#snackbar .wrapper").html(html);
				$("#snackbar").css({
					"margin-left": "-"+($("#snackbar").outerWidth()/2)+"px",
					"bottom": "0px"
				});
				$snackbar = 1;
				if(isMobile()) {
					$("#goTop").css("bottom", "+="+$("#snackbar").height());
					$snackbar = 1;
				}
				to = setTimeout(function() {
					$("#snackbar").css("bottom", "-100px");
					if(isMobile()) {
						$("#goTop").css("bottom", "-="+$("#snackbar").height());
						$snackbar = 0;
					}
				}, 5000);
			}
		});
	}
}
function isMobile() {
	return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}
function hideSnackbar() {
	$("#snackbar").css("bottom", "-100px");
	if(isMobile()) {
		$("#goTop").css("bottom", "-="+$("#snackbar").height());
		$snackbar = 0;
	}
}

function updateLayout(event) {
	if($responsiveMenu) {
		if($("#float-left-menu").width()+960 < $(window).width() && $except == 1) {
			$("#float-left-menu .title .icons").removeClass("hover");
			$("#app-container").width($(window).width()-$("#float-left-menu").width());
			$("#app-container").css("left", $("#float-left-menu").width());
			$("#action-bar").width($(window).width()-$("#float-left-menu").width());
			$("#action-bar").css({"left": $("#float-left-menu").width(), "top": "0px"});
			$("#float-left-menu").css("left", "0px");
			$("#action-bar .menu-title [onclick]").css("display", "none");
			$("#action-bar .menu-title .title").css("padding-left", $("#action-bar .menu-title .title").css("padding-top"));
			$("#action-bar").addClass("notransition");
			$("#float-left-menu").addClass("notransition");
			$("#bottom-sheet").css("left", ($("#app-container").width()/2)+$("#float-left-menu").width());
			$("#dialog-box").css("left", ($("#app-container").width()/2)+$("#float-left-menu").width());
			$("#snackbar").css("left", ($("#app-container").width()/2)+$("#float-left-menu").width());
			$("#data-action-bar").width($(window).width()-$("#float-left-menu").width());
			$("#data-action-bar").css({"left": $("#float-left-menu").width()});
			$("#data-action-bar").addClass("notransition");
		} else {
			$("#float-left-menu .title .icons").addClass("hover");
			$("#app-container").width("100%");
			$("#app-container").css("left", "0px");
			$("#action-bar").width("100%");
			$("#action-bar").css("left", "0px");
			if(!isMobile()) {
				$("#float-left-menu").css("left", "-350px");
			}
			$("#action-bar .menu-title [onclick]").css("display", "block");
			$("#action-bar .menu-title .title").css("padding-left", "0px");
			$("#action-bar").removeClass("notransition");
			$("#float-left-menu").removeClass("notransition");
			$("#bottom-sheet").css("left", "50%");
			$("#dialog-box").css("left", "50%");
			$("#snackbar").css("left", "50%");
			$("#data-action-bar").width("100%");
			$("#data-action-bar").css("left", "0px");
			$("#data-action-bar").removeClass("notransition");
		}
	}
	if(event != "resized") {
		$("#blackTrans").hide();
	}
	if(event == "resized") {
		if($("#bottom-sheet").css("bottom") != "0px") {
			$("#bottom-sheet").css("bottom", "-"+($(window).height()+200)+"px");
			$("html").css({
				"position": "relative",
				"overflow-y": "scroll",
				"width": "auto",
				"height": "auto"
			});
		}
	}	
	if(event == "loaded") {
		$("#data-action-bar").css({"top": "-100px"});
		$("#data-action-bar .menu-title .title").css("padding-left", $("#action-bar .menu-title .title").css("padding-top"));
	}
}