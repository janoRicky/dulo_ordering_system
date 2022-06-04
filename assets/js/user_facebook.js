window.fbAsyncInit = function() {
	FB.init({
		appId            : '321693583476006',
		autoLogAppEvents : true,
		xfbml            : true,
		version          : 'v14.0'
	});
};

function login_with_fb() {
	FB.api('/me', {fields: 'first_name,last_name,middle_name,email'}, function(response) {
		
		$('#fb_id').val(response.id);
		$('#fb_email').val(response.email);
		$('#fb_first_name').val(response.first_name);
		$('#fb_last_name').val(response.last_name);
		$('#fb_middle_name').val(response.middle_name);

		$('#form_fb_login').submit();
	});
}

$(document).on('click', '.fb_login', function() {
  	FB.login(function(response) {
		if (response.status === 'connected') {
			login_with_fb();
		} else {
			FB.getLoginStatus(function (response) {
				if (response.status === 'connected') {
					FB.logout();
					window.location.replace("logout");
				} else {
					window.location.replace("home");
				}
			});
		}
	}, {scope: 'public_profile,email'});
});
$(document).on('click', '#logout', function() {
	FB.getLoginStatus(function (response) {
		if (response.status === 'connected') {
			FB.logout();
		}
	});
	window.location.replace("logout");
});

$(document).on('click', '.fb_share', function() {
    FB.ui({
        method: 'share',
        href: $(this).data('href'),
        hashtag: '#DuloByTheAs',
        quote: 'Look at what I ordered!',
    });
});
