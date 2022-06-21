<!-- SIGN UP MODAL -->
<div id="modal_sign_up" class="modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content text-light" style="background-color: #000;">
			<?=form_open(base_url() . "register_account", "method='POST'")?>
				<div class="modal-body">
					<div class="row justify-content-end pe-3 pt-2">
						<button type="button" class="btn-close btn-close-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="row">
						<div class="col-3 pt-4 mx-auto">
							<img class="w-100" src="<?=base_url()?>assets/img/dulo-logo.png">
						</div>
						<div class="col-12 text-light pt-3 text-center">
							<h2 class="fw-bold">WELCOME!</h2>
							<p>Create new account.</p>
						</div>
					</div>
					<div class="row mt-1 px-5">
						<div class="col-12 px-3">
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Last Name: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="text" name="inp_name_last" placeholder="*Last Name" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">First Name: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="text" name="inp_name_first" placeholder="*First Name" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Middle Name: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="text" name="inp_name_middle" placeholder="Middle Name" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Name Extension: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="text" name="inp_name_extension" placeholder="e.g. Jr., Sr., etc." autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div>
								<h4 class="fw-bold"> Account Info </h4>
							</div>
						</div>
					</div>
					<div class="row mt-1 px-5">
						<div class="col-12 px-3">
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Email: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="email" name="inp_email" placeholder="*Email Address" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Password: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="password" minlength="8" name="inp_password" placeholder="*Password" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Gender: </h6>
								</div>
								<div class="col-12">
									<select class="form-control bg-dark text-light border-dark" name="inp_gender" required="">
										<option value="male">Male</option>
										<option value="female">Female</option>
										<option value="other">Other</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div>
								<h4 class="fw-bold"> Contact Info </h4>
							</div>
						</div>
					</div>
					<div class="row mt-1 px-5">
						<div class="col-12 px-3">
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Contact Num: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="text" name="inp_contact_num" placeholder="Contact #" autocomplete="off">
								</div>
							</div>
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-12 px-3 text-center">
							<button class="btn btn-light btn-lg rounded-pill fw-bold px-5" type="submit">
								<i class="mdi" aria-hidden="true"></i> Register
							</button>
						</div>
					</div>
					<div class="row mt-4 mb-4 text-center">
						<span>Already have an account? <a data-bs-target="#modal_sign_in" data-bs-toggle="modal" data-bs-dismiss="modal" style="color: red;" href="#">Sign In Here.</a></span>
					</div>
					<div class="row mt-1 mb-4 text-center">
						<span>Haven't received account verification email yet? <a data-bs-target="#modal_resend_verification" data-bs-toggle="modal" data-bs-dismiss="modal" style="color: red;" href="#">Click Here.</a></span>
					</div>
				</div>
			<?=form_close()?>
		</div>
	</div>
</div>

<!-- SIGN IN MODAL -->
<div id="modal_sign_in" class="modal">
	<div class="modal-dialog modal-md">
		<div class="modal-content text-light" style="background-color: #000;">
			<?=form_open(base_url() . "login_verify", "method='POST'")?>
				<div class="modal-body">
					<div class="row justify-content-end pe-3 pt-2">
						<button type="button" class="btn-close btn-close-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="row">
						<div class="col-3 pt-4 mx-auto">
							<img class="w-100" src="<?=base_url()?>assets/img/dulo-logo.png">
						</div>
						<div class="col-12 text-light pt-3 text-center">
							<h2 class="fw-bold">WELCOME BACK!</h2>
							<p>Sign in to your account.</p>
						</div>
					</div>
					<div class="row mt-1 px-5">
						<div class="col-12 px-3">
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Email: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="email" name="inp_email" placeholder="*Email Address" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Password: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="password" minlength="8" name="inp_password" placeholder="*Password" required="">
								</div>
							</div>
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-12 px-3 text-center">
							<button class="btn btn-light btn-lg rounded-pill fw-bold px-5" type="submit">
								<i class="mdi" aria-hidden="true"></i> Log In
							</button>
						</div>
						<div class="col-12 px-1 text-center my-2">
							<button class="fb_login btn btn-lg rounded-pill fw-bold px-5 text-light" type="button" style="background-color: #4267b2;">
								<i class="mdi mdi-facebook mdi-24px" aria-hidden="true"></i> Log in With Facebook
							</button>
						</div>
					</div>
					<div class="row mt-4 mb-4 text-center">
						<span>Don't have an account? <a data-bs-target="#modal_sign_up" data-bs-toggle="modal" data-bs-dismiss="modal" style="color: red;" href="#">Sign Up Here.</a></span>
					</div>
					<div class="row mt-1 mb-4 text-center">
						<span>Forgot Password? <a data-bs-target="#modal_forgot_password" data-bs-toggle="modal" data-bs-dismiss="modal" style="color: red;" href="#">Click Here.</a></span>
					</div>
				</div>
			<?=form_close()?>
		</div>
	</div>
</div>
<!-- SIGN IN CART MODAL -->
<div id="modal_sign_in_cart" class="modal">
	<div class="modal-dialog modal-md">
		<div class="modal-content text-light" style="background-color: #000;">
			<?=form_open(base_url() . "login_verify", "method='POST'")?>
				<input type="hidden" name="from_cart" value="1">
				<div class="modal-body">
					<div class="row justify-content-end pe-3 pt-2">
						<button type="button" class="btn-close btn-close-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="row">
						<div class="col-12 text-light pt-3 text-center">
							<h2 class="fw-bold">Sign in to your account to Place Order.</h2>
						</div>
					</div>
					<div class="row mt-5 mb-5 px-5">
						<div class="col-12 px-3">
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Email: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="email" name="inp_email" placeholder="*Email Address" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Password: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="password" name="inp_password" placeholder="*Password" required="">
								</div>
							</div>
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-12 px-3 text-center">
							<button class="btn btn-light btn-md rounded-pill fw-bold px-5" type="submit">
								<i class="mdi" aria-hidden="true"></i> Log In
							</button>
						</div>
						<div class="col-12 px-1 text-center my-2">
							<button class="fb_login btn btn-md rounded-pill fw-bold px-5 text-light" type="button" style="background-color: #4267b2;">
								<i class="mdi mdi-facebook mdi-24px" aria-hidden="true"></i> Log in With Facebook
							</button>
						</div>
					</div>
					<div class="row mt-4 mb-4 text-center">
						<span>Don't have an account? <a data-bs-target="#modal_sign_up" data-bs-toggle="modal" data-bs-dismiss="modal" style="color: red;" href="#">Sign Up Here.</a></span>
					</div>
					<div class="row mt-1 mb-4 text-center">
						<span>Forgot Password? <a data-bs-target="#modal_forgot_password" data-bs-toggle="modal" data-bs-dismiss="modal" style="color: red;" href="#">Click Here.</a></span>
					</div>
				</div>
			<?=form_close()?>
		</div>
	</div>
</div>
<!-- RESEND EMAIL MODAL -->
<div id="modal_resend_verification" class="modal">
	<div class="modal-dialog modal-md">
		<div class="modal-content text-light" style="background-color: #000;">
			<?=form_open(base_url() . "resend_email", "method='POST'")?>
				<div class="modal-body">
					<div class="row justify-content-end pe-3 pt-2">
						<button type="button" class="btn-close btn-close-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="row text-center">
						<div class="col-12 text-light pt-3 text-center">
							<h2 class="fw-bold">Resend account verification email.</h2>
						</div>
					</div>
					<div class="row mt-5 mb-5 px-5">
						<div class="col-12 px-3">
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Email: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="email" name="inp_email" placeholder="*Email Address" required="">
								</div>
							</div>
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-12 px-3 text-center">
							<button class="btn btn-light btn-md rounded-pill fw-bold px-5" type="submit">
								<i class="mdi" aria-hidden="true"></i> Resend Email
							</button>
						</div>
					</div>
					<div class="row mt-4 mb-4 text-center">
						<span><a data-bs-target="#modal_sign_up" data-bs-toggle="modal" data-bs-dismiss="modal" style="color: red;" href="#">Return to Sign Up.</a></span>
					</div>
				</div>
			<?=form_close()?>
		</div>
	</div>
</div>
<!-- FORGOT PASSWORD MODAL -->
<div id="modal_forgot_password" class="modal">
	<div class="modal-dialog modal-md">
		<div class="modal-content text-light" style="background-color: #000;">
			<?=form_open(base_url() . "forgot_password", "method='POST'")?>
				<div class="modal-body">
					<div class="row justify-content-end pe-3 pt-2">
						<button type="button" class="btn-close btn-close-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="row text-center">
						<div class="col-12 text-light pt-3 text-center">
							<h2 class="fw-bold">Forgot password?</h2>
							<p>Enter your email and we'll send you a link to reset your account password.</p>
						</div>
					</div>
					<div class="row mt-5 mb-5 px-5">
						<div class="col-12 px-3">
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Email: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="email" name="inp_email" placeholder="*Email Address" required="">
								</div>
							</div>
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-12 px-3 text-center">
							<button class="btn btn-light btn-md rounded-pill fw-bold px-5" type="submit">
								<i class="mdi" aria-hidden="true"></i> Send Email
							</button>
						</div>
					</div>
					<div class="row mt-4 mb-4 text-center">
						<span><a data-bs-target="#modal_sign_in" data-bs-toggle="modal" data-bs-dismiss="modal" style="color: red;" href="#">Return to Sign In.</a></span>
					</div>
				</div>
			<?=form_close()?>
		</div>
	</div>
</div>
<?php if ($this->input->get("em") && $this->input->get("rc")): ?>
	<!-- RESET PASSWORD MODAL -->
	<div id="modal_reset_password" class="modal">
		<div class="modal-dialog modal-md">
			<div class="modal-content text-light" style="background-color: #000;">
				<?=form_open(base_url() . "reset_password", "method='POST'")?>
					<input type="hidden" name="inp_email" value="<?=$this->input->get("em")?>">
					<input type="hidden" name="inp_verification_code" value="<?=$this->input->get("rc")?>">

					<div class="modal-body">
						<div class="row justify-content-end pe-3 pt-2">
							<button type="button" class="btn-close btn-close-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="row text-center">
							<div class="col-12 text-light pt-3 text-center">
								<h2 class="fw-bold">Enter your new account password.</h2>
							</div>
						</div>
						<div class="row mt-5 mb-5 px-5">
							<div class="col-12 px-3">
								<div class="row mt-2">
									<div class="col-12">
										<h6 class="fw-bold">Password: </h6>
									</div>
									<div class="col-12">
										<input class="form-control bg-dark text-light border-dark" type="password" minlength="8" name="inp_password" placeholder="*Password" required="">
									</div>
								</div>
							</div>
						</div>

						<div class="row mt-4 mb-4">
							<div class="col-12 px-3 text-center">
								<button class="btn btn-light btn-md rounded-pill fw-bold px-5" type="submit">
									<i class="mdi" aria-hidden="true"></i> Reset Password
								</button>
							</div>
						</div>
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#modal_reset_password').modal('show');
		});
	</script>
<?php endif; ?>