<!-- SIGN UP MODAL -->
<div id="modal_sign_up" class="modal">
	<div class="modal-dialog modal-md">
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
									<input class="form-control bg-dark text-light border-dark" type="password" name="inp_password" placeholder="*Password" autocomplete="off" required="">
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
								<h4 class="fw-bold"> Address Info </h4>
							</div>
						</div>
					</div>
					<div class="row mt-1 px-5">
						<div class="col-12 px-3">
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Province: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="text" name="inp_province" placeholder="*Province" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">City: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="text" name="inp_city" placeholder="*City" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">Street / Road: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="text" name="inp_street" placeholder="*Street/Road" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h6 class="fw-bold">House Number / Floor / Bldg. / etc.: </h6>
								</div>
								<div class="col-12">
									<input class="form-control bg-dark text-light border-dark" type="text" name="inp_address" placeholder="Address" autocomplete="off">
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
									<input class="form-control bg-dark text-light border-dark" type="text" name="inp_contact_num" placeholder="*Contact #" autocomplete="off" required="">
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
					<div class="row mt-2 mb-4 text-center">
						<span>Already have an account? <a id="" data-bs-target="#modal_sign_in" data-bs-toggle="modal" data-bs-dismiss="modal" style="color: red;" href="#">Sign In Here.</a></span>
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
									<input class="form-control bg-dark text-light border-dark" type="password" name="inp_password" placeholder="*Password" required="">
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
							<button id="fb_login" class="btn btn-lg rounded-pill fw-bold px-5 text-light" type="button" style="background-color: #4267b2;">
								<i class="mdi mdi-facebook mdi-24px" aria-hidden="true"></i> Log in With Facebook
							</button>
						</div>
					</div>
					<div class="row mt-2 mb-4 text-center">
						<span>Don't have an account? <a id="" data-bs-target="#modal_sign_up" data-bs-toggle="modal" data-bs-dismiss="modal" style="color: red;" href="#">Sign Up Here.</a></span>
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
							<button id="fb_login" class="btn btn-md rounded-pill fw-bold px-5 text-light" type="button" style="background-color: #4267b2;">
								<i class="mdi mdi-facebook mdi-24px" aria-hidden="true"></i> Log in With Facebook
							</button>
						</div>
					</div>
					<div class="row mt-2 mb-4 text-center">
						<span>Don't have an account? <a id="" data-bs-target="#modal_sign_up" data-bs-toggle="modal" data-bs-dismiss="modal" style="color: red;" href="#">Sign Up Here.</a></span>
					</div>
				</div>
			<?=form_close()?>
		</div>
	</div>
</div>