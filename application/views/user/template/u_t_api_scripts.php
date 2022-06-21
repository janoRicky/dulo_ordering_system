<script type="text/javascript" src="<?=base_url()?>assets/js/user_facebook.js"></script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0&appId=321693583476006&autoLogAppEvents=1" nonce="6JYTGt2T"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0&appId=321693583476006&autoLogAppEvents=1" nonce="GcbgYYX0"></script>
<div style="display: none;">
	<?=form_open(base_url() . "login_with_fb", "id='form_fb_login' method='POST'")?>
		<input id="fb_id" type="hidden" name="fb_id">
		<input id="fb_email" type="hidden" name="fb_email">
		<input id="fb_first_name" type="hidden" name="fb_first_name">
		<input id="fb_last_name" type="hidden" name="fb_last_name">
		<input id="fb_middle_name" type="hidden" name="fb_middle_name">
	<?=form_close()?>
</div>