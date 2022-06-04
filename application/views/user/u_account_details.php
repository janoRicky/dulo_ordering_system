
<?php
$template_header;
?>

<body>
	<?php $this->load->view("user/template/u_t_api_scripts"); ?>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-12 content pt-2">
					<div class="row justify-content-center my-5 pb-3">
						<div class="col-11 col-lg-10 col-xl-8">
							<div class="row m-0 p-0">
								<?=form_open(base_url() . "update_personal_info", "class='col-12 col-lg-6 mb-3' method='POST'")?>
									<div class="row mt-2">
										<div class="col-12">
											<div class="card shadow" style="border-radius: 15px;">
												<div class="card-body mt-2 mx-3">
													<h5 class="card-title fw-bold">Update Personal Info</h5>
													<hr class="my-3 px-5">

													<div class="row justify-content-center item mb-4">
														<div class="col-12 text-center">
															<div class="row mt-2">
																<div class="col-12 text-start">
																	<h5 class="fw-bold">Last Name: </h5>
																</div>
																<div class="col-12">
																	<input class="form-control" type="text" name="inp_name_last" placeholder="*Last Name" value="<?=$account_details['name_last']?>" autocomplete="off" required="">
																</div>
															</div>
															<div class="row mt-2">
																<div class="col-12 text-start">
																	<h5 class="fw-bold">First Name: </h5>
																</div>
																<div class="col-12">
																	<input class="form-control" type="text" name="inp_name_first" placeholder="*First Name" value="<?=$account_details['name_first']?>" autocomplete="off" required="">
																</div>
															</div>
															<div class="row mt-2">
																<div class="col-12 text-start">
																	<h5 class="fw-bold">Middle Name: </h5>
																</div>
																<div class="col-12">
																	<input class="form-control" type="text" name="inp_name_middle" placeholder="Middle Name" value="<?=$account_details['name_middle']?>" autocomplete="off">
																</div>
															</div>
															<div class="row mt-2">
																<div class="col-12 text-start">
																	<h5 class="fw-bold">Name Extension: </h5>
																</div>
																<div class="col-12">
																	<input class="form-control" type="text" name="inp_name_extension" placeholder="Name Extension" value="<?=$account_details['name_extension']?>" autocomplete="off">
																</div>
															</div>
															<div class="row mt-2">
																<div class="col-12 text-start">
																	<h5 class="fw-bold">Gender: </h5>
																</div>
																<div class="col-12">
																	<select class="form-control" name="inp_gender" required>
																		<option value="male" <?=($account_details['gender'] == "male" ? "selected" : "")?>>Male</option>
																		<option value="female"<?=($account_details['gender'] == "female" ? "selected" : "")?>>Female</option>
																		<option value="other"<?=($account_details['gender'] == "other" ? "selected" : "")?>>Other</option>
																	</select>
																</div>
															</div>
															<hr>
															<div class="row mt-2">
																<div class="col-12 text-center">
																	<button class="btn fw-bold rounded-pill product_btn px-3 py-2" type="submit">
																		<i class="fa fa-pencil" aria-hidden="true"></i> Submit
																	</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?=form_close()?>
								<?=form_open(base_url() . "update_account_info", "class='col-12 col-lg-6 mb-3' method='POST'")?>
									<div class="row mt-2">
										<div class="col-12">
											<div class="card shadow" style="border-radius: 15px;">
												<div class="card-body mt-2 mx-3">
													<h5 class="card-title fw-bold">Update Account Info</h5>
													<hr class="my-3 px-5">

													<div class="row justify-content-center item mb-4">
														<div class="col-12 text-center">
															<div class="row mt-2">
																<div class="col-12 text-start">
																	<h5 class="fw-bold">Email: </h5>
																</div>
																<div class="col-12">
																	<input class="form-control" type="email" name="inp_email" placeholder="*Email Address" value="<?=$account_details['email']?>" autocomplete="off" required="">
																</div>
															</div>
															<div class="row mt-2">
																<div class="col-12 text-start">
																	<h5 class="fw-bold">Password: </h5>
																</div>
																<div class="col-12">
																	<input class="form-control" type="password" name="inp_password" placeholder="*Password" autocomplete="off" required="">
																</div>
															</div>
															<hr>
															<div class="row mt-2">
																<div class="col-12 text-center">
																	<button class="btn fw-bold rounded-pill product_btn px-3 py-2" type="submit">
																		<i class="fa fa-pencil" aria-hidden="true"></i> Submit
																	</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?=form_close()?>
								<?=form_open(base_url() . "update_contact_info", "class='col-12 col-lg-6 mb-3' method='POST'")?>
									<div class="row mt-2">
										<div class="col-12">
											<div class="card shadow" style="border-radius: 15px;">
												<div class="card-body mt-2 mx-3">
													<h5 class="card-title fw-bold">Update Contact Info</h5>
													<hr class="my-3 px-5">

													<div class="row justify-content-center item mb-4">
														<div class="col-12 text-center">
															<div class="row mt-2">
																<div class="col-12 text-start">
																	<h5 class="fw-bold">Contact Num: </h5>
																</div>
																<div class="col-12">
																	<input class="form-control" type="text" name="inp_contact_num" placeholder="Contact #" value="<?=$account_details['contact_num']?>" autocomplete="off">
																</div>
															</div>
															<hr>
															<div class="row mt-2">
																<div class="col-12 text-center">
																	<button class="btn fw-bold rounded-pill product_btn px-3 py-2" type="submit">
																		<i class="fa fa-pencil" aria-hidden="true"></i> Submit
																	</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?=form_close()?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
</html>