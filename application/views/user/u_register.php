
<?php
$template_header;
?>

<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-sm-1"></div>
				<div class="col-12 col-sm-10 content py-4">
					<?=form_open(base_url() . "register_account", "method='POST'")?>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; Register &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-sm-3"></div> 
						<div class="col-10 col-sm-6">
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Last Name: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="text" name="inp_name_last" placeholder="*Last Name" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">First Name: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="text" name="inp_name_first" placeholder="*First Name" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Middle Name: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="text" name="inp_name_middle" placeholder="Middle Name" autocomplete="off">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Name Extension: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="text" name="inp_name_extension" placeholder="e.g. Jr., Sr., etc." autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; Account Info &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-sm-3"></div> 
						<div class="col-10 col-sm-6">
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Email: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="email" name="inp_email" placeholder="*Email Address" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Password: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="password" name="inp_password" placeholder="*Password" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Gender: </h5>
								</div>
								<div class="col-8 col-md-9">
									<select class="form-control" name="inp_gender" required="">
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
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; Address Info &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-sm-3"></div> 
						<div class="col-10 col-sm-6">
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Zip Code: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="text" name="inp_zip_code" placeholder="*Zip Code" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Country: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="text" name="inp_country" placeholder="*Country" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Province: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="text" name="inp_province" placeholder="*Province" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">City: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="text" name="inp_city" placeholder="*City" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Street / Road: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="text" name="inp_street" placeholder="*Street/Road" autocomplete="off" required="">
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">House Number / Floor / Bldg. / etc.: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="text" name="inp_address" placeholder="Address" autocomplete="off">
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; Contact Info &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-sm-3"></div> 
							<div class="col-10 col-sm-6">
								<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Contact Num: </h5>
								</div>
								<div class="col-8 col-md-9">
									<input class="form-control" type="text" name="inp_contact_num" placeholder="*Contact #" autocomplete="off" required="">
								</div>
							</div>
						</div>
						<div class="col-1 col-sm-3"></div> 
					</div>
					<hr>
					<div class="row mt-4 mb-3">
						<div class="col-12 text-center">
							<button class="button b_p b_lg" type="submit">
								<i class="fa fa-user" aria-hidden="true"></i> Register
							</button>
						</div>
					</div>
					<?=form_close()?>
				</div>
				<div class="col-0 col-sm-1"></div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
</html>