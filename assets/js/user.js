
$(document).ready(function () {
	// $("#sign_in_from_sign_up").on("click", function() {
	// 	$("#modal_sign_up").data("view", "modal_sign_in");
	// 	$("#modal_sign_up").modal("toggle");
	// });

	// $("#sign_up_from_sign_in").on("click", function() {
	// 	$("#modal_sign_in").data("view", "modal_sign_up");
	// 	$("#modal_sign_in").modal("toggle");
	// });

	// $("#modal_sign_up").on("hidden.bs.modal", function() {
	// 	if ($(this).data("view") == "modal_sign_in") {
	// 		$("#modal_sign_in").modal("toggle");
	// 		$(this).data("view", "");
	// 	}
	// });
	// $("#modal_sign_in").on("hidden.bs.modal", function() {
	// 	if ($(this).data("view") == "modal_sign_up") {
	// 		$("#modal_sign_up").modal("toggle");
	// 		$(this).data("view", "");
	// 	}
	// });

	$(document).on("click", ".featured_type", function() {
		window.location.href = $(this).children("a").attr("href");
		// console.log($(this).children("a").attr("href"));
	});
});