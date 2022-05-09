
$(document).ready(function () {
	$(document).on("click", "#sidebar_toggle, #sidebar_out", function() {
		$("#sidebar_out").fadeToggle(100);
		$("#sidebar .list-group").fadeToggle(200);
		$("#sidebar").animate({
                width: "toggle"
            });
		$("#navbar-title").animate({
                width: "toggle"
            });
	});

	$(document).on("click", ".img_zoomable", function() {
		$("body").append($("<div>").attr({
			class: "img_zoom"
		}).append($("<img>").attr({
			src: $(this).attr("src")
		})));
	});
	$(document).on("click", ".img_zoom", function() {
		$(".img_zoom").fadeOut(200, function() {
			$(".img_zoom").remove()
		});;
	});

	$(document).on("focus change paste keyup", "input", function() {
		var attr = $(this).attr("required");
		if (typeof attr !== "undefined" && attr !== false) {
			if ($(this).val().length < 1) {
				$(this).css("box-shadow", "0 0 0.3rem red");
			} else {
				$(this).css("box-shadow", "0 0 0");
			}
		}
	});

	
});