
<?php
$template_header;
?>
<body>
	<div class="wrapper h-100">
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view("admin/template/a_t_sidebar"); ?>
				<?php $this->load->view("admin/template/a_t_navbar", $nav); ?>
				<div class="col-12 text-center">
					<div class="container-fluid p-2 py-5 p-sm-5 justify-content-center">
						<?php if ($this->session->flashdata("alert")): ?>
							<?php $alert = $this->session->flashdata("alert"); ?>
							<div class="alert alert-<?=$alert[0]?> alert-dismissible">
								<?=$alert[1]?>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-12 text-start">
								<h2>Update User #<?=$row_info["user_id"]?> <?=($row_info["email"] == NULL ? "[NO ACCOUNT]" : "")?></h2>
							</div>
							<div class="col-12">
								<?=form_open(base_url() . "admin/user_update", "method='POST'"); ?>
									<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$row_info["user_id"]?>">
									<?php if ($row_info["email"] != NULL): ?>
										<div class="form-group">
											<label for="inp_email">Email:</label>
											<input type="email" class="form-control" name="inp_email" placeholder="*Email Address" value="<?=$row_info['email']?>" autocomplete="off" required="">
										</div>
										<div class="form-group">
											<label for="inp_password">Password:</label>
											<input type="password" class="form-control" name="inp_password" placeholder="Password" autocomplete="off">
										</div>
									<?php endif; ?>
									<div class="form-group">
										<label for="inp_name_last">Last Name:</label>
										<input type="text" class="form-control" name="inp_name_last" placeholder="*Last Name" value="<?=$row_info['name_last']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_name_first">First Name:</label>
										<input type="text" class="form-control" name="inp_name_first" placeholder="*First Name" value="<?=$row_info['name_first']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_name_middle">Middle Name:</label>
										<input type="text" class="form-control" name="inp_name_middle" placeholder="Middle Name" value="<?=$row_info['name_middle']?>" autocomplete="off">
									</div>
									<div class="form-group">
										<label for="inp_name_extension">Name Extension:</label>
										<input type="text" class="form-control" name="inp_name_extension" placeholder="Name Extension" value="<?=$row_info['name_extension']?>" autocomplete="off">
									</div>
									<div class="form-group">
										<label for="inp_gender">Gender:</label>
										<select name="inp_gender" class="form-control" required="">
											<option value="male" <?=($row_info['gender'] == "male" ? "selected" : "")?>>Male</option>
											<option value="female"<?=($row_info['gender'] == "female" ? "selected" : "")?>>Female</option>
											<option value="other"<?=($row_info['gender'] == "other" ? "selected" : "")?>>Other</option>
										</select>
									</div>
									<div class="form-group">
										<label for="inp_zip_code">Zip Code:</label>
										<input type="text" class="form-control" name="inp_zip_code" placeholder="*Zip Code" value="<?=$row_info['zip_code']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_country">Country:</label>
										<input type="text" class="form-control" name="inp_country" placeholder="*Country" value="<?=$row_info['country']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_province">Province:</label>
										<input type="text" class="form-control" name="inp_province" placeholder="*Province" value="<?=$row_info['province']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_city">City:</label>
										<input type="text" class="form-control" name="inp_city" placeholder="*City" value="<?=$row_info['city']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_street">Street/Road:</label>
										<input type="text" class="form-control" name="inp_street" placeholder="*Street/Road" value="<?=$row_info['street']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_address">House Number/Floor/Bldg./etc.:</label>
										<input type="text" class="form-control" name="inp_address" placeholder="House Number/Floor/Bldg./etc." value="<?=$row_info['address']?>" autocomplete="off">
									</div>
									<div class="form-group">
										<label for="inp_contact_num">Contact Number:</label>
										<input type="text" class="form-control" name="inp_contact_num" placeholder="*Contact #" value="<?=$row_info['contact_num']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-primary" value="Update">
									</div>
								<?=form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	
</script>
</html>