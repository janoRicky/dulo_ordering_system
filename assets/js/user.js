
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

	$(document).on("click", ".btn_link", function() {
		window.location.href = $(this).data("href");
	});


	$(document).on("click", ".featured_type", function() {
		window.location.href = $(this).children("a").attr("href");
		// console.log($(this).children("a").attr("href"));
	});

	setTimeout(function() {
		$(".notice").fadeOut(12000, function() {
			$(this).remove();
		});
	}, 5000);




	$(document).on("submit", "#form_register_account", function(e) {
		var contact_num = $(this).find("[name='inp_contact_num']").val();
		var email = $(this).find("[name='inp_email']").val();
		var password = $(this).find("[name='inp_password']").val();

		if (!contact_num.startsWith("09")) {
			alert("Contact number must start with (09).");
			e.preventDefault();
		}
		if (isNaN(contact_num)) {
			alert("Contact number must be numerical (0-9).");
			e.preventDefault();
		}
		if (!email.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
			alert("Email must be properly formatted (example@email.com).");
			e.preventDefault();
		}

		var pass_strength = [/.{8,}/, /[a-z]+/, /[0-9]+/, /[A-Z]+/];
		if(!password.match(pass_strength[0])) {
			alert("Password must have more than 8 characters.");
			e.preventDefault();
		}
		if(!password.match(pass_strength[1])) {
			alert("Password must have atleast 1 lowercase (a-z) characters.");
			e.preventDefault();
		}
		if(!password.match(pass_strength[2])) {
			alert("Password must have atleast 1 numerical (0-9) characters.");
			e.preventDefault();
		}
		if(!password.match(pass_strength[3])) {
			alert("Password must have atleast 1 uppercase (A-Z) characters.");
			e.preventDefault();
		}



		e.preventDefault();
	});

});