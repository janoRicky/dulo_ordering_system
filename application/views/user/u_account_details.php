
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
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; Update Personal Info &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row my-5">
						<div class="col-1"></div>
						<div class="col-10">
							<?=form_open(base_url() . "update_personal_info", "method='POST'")?>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Last Name: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_name_last" placeholder="*Last Name" value="<?=$account_details['name_last']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">First Name: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_name_first" placeholder="*First Name" value="<?=$account_details['name_first']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Middle Name: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_name_middle" placeholder="Middle Name" value="<?=$account_details['name_middle']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Name Extension: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_name_extension" placeholder="Name Extension" value="<?=$account_details['name_extension']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Gender: </h5>
									</div>
									<div class="col-8 col-md-9">
										<select class="form-control" name="inp_gender" required="">
											<option value="male" <?=($account_details['gender'] == "male" ? "selected" : "")?>>Male</option>
											<option value="female"<?=($account_details['gender'] == "female" ? "selected" : "")?>>Female</option>
											<option value="other"<?=($account_details['gender'] == "other" ? "selected" : "")?>>Other</option>
										</select>
									</div>
								</div>
								<hr>
								<div class="row mt-2">
									<div class="col-12 text-center">
										<button class="button b_p" type="submit">
											<i class="fa fa-pencil" aria-hidden="true"></i> Submit
										</button>
									</div>
								</div>
							<?=form_close()?>
						</div>
						<div class="col-1"></div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; Update Account Info &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row my-5">
						<div class="col-1"></div>
						<div class="col-10">
							<?=form_open(base_url() . "update_account_info", "method='POST'")?>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Email: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="email" name="inp_email" placeholder="*Email Address" value="<?=$account_details['email']?>" autocomplete="off" required="">
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
								<hr>
								<div class="row mt-2">
									<div class="col-12 text-center">
										<button class="button b_p" type="submit">
											<i class="fa fa-pencil" aria-hidden="true"></i> Submit
										</button>
									</div>
								</div>
							<?=form_close()?>
						</div>
						<div class="col-1"></div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; Update Address Info &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row my-5">
						<div class="col-1"></div>
						<div class="col-10">
							<?=form_open(base_url() . "update_address_info", "method='POST'")?>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Zip Code: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_zip_code" placeholder="*Zip Code" value="<?=$account_details['zip_code']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Country: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_country" placeholder="*Country" value="<?=$account_details['country']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Province: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_province" placeholder="*Province" value="<?=$account_details['province']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">City: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_city" placeholder="*City" value="<?=$account_details['city']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Street / Road: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_street" placeholder="*Street/Road" value="<?=$account_details['street']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">House Number / Floor / Bldg. / etc.: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_address" placeholder="House Number/Floor/Bldg./etc." value="<?=$account_details['address']?>" autocomplete="off" required="">
									</div>
								</div>
								<hr>
								<div class="row mt-2">
									<div class="col-12 text-center">
										<button class="button b_p" type="submit">
											<i class="fa fa-pencil" aria-hidden="true"></i> Submit
										</button>
									</div>
								</div>
							<?=form_close()?>
						</div>
						<div class="col-1"></div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; Update Contact Info &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row my-5">
						<div class="col-1"></div>
						<div class="col-10">
							<?=form_open(base_url() . "update_contact_info", "method='POST'")?>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Contact Num: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_contact_num" placeholder="*Contact #" value="<?=$account_details['contact_num']?>" autocomplete="off" required="">
									</div>
								</div>
								<hr>
								<div class="row mt-2">
									<div class="col-12 text-center">
										<button class="button b_p" type="submit">
											<i class="fa fa-pencil" aria-hidden="true"></i> Submit
										</button>
									</div>
								</div>
							<?=form_close()?>
						</div>
						<div class="col-1"></div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
</html>