
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
						
						<div class="row py-3 col-12 col-md-9 mx-auto border-bottom mb-4 title_bar">
							<div class="col-12 text-start">
								<h2>Update User #<?=$row_info["user_id"]?> <?=($row_info["email"] == NULL ? "[NO ACCOUNT]" : "")?></h2>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto">
							<div class="col-12">
								<?=form_open(base_url() . "admin/user_update", "class='row' method='POST'"); ?>
									<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$row_info["user_id"]?>">
									<?php if ($row_info["email"] != NULL): ?>
										<div class="col-12 col-md-6 text-start pb-3">
											<label for="inp_email">Email:</label>
											<input type="email" class="form-control" name="inp_email" placeholder="*Email Address" value="<?=$row_info['email']?>" autocomplete="off" required="">
										</div>
										<div class="col-12 col-md-6 text-start pb-3">
											<label for="inp_password">Password:</label>
											<input type="password" class="form-control" name="inp_password" placeholder="Password" autocomplete="off">
										</div>
									<?php endif; ?>
									<div class="col-12 col-md-6 text-start pb-3">
										<label for="inp_name_last">Last Name:</label>
										<input type="text" class="form-control" name="inp_name_last" placeholder="*Last Name" value="<?=$row_info['name_last']?>" autocomplete="off" required="">
									</div>
									<div class="col-12 col-md-6 text-start pb-3">
										<label for="inp_name_first">First Name:</label>
										<input type="text" class="form-control" name="inp_name_first" placeholder="*First Name" value="<?=$row_info['name_first']?>" autocomplete="off" required="">
									</div>
									<div class="col-12 col-md-6 text-start pb-3">
										<label for="inp_name_middle">Middle Name:</label>
										<input type="text" class="form-control" name="inp_name_middle" placeholder="Middle Name" value="<?=$row_info['name_middle']?>" autocomplete="off">
									</div>
									<div class="col-12 col-md-6 text-start pb-3">
										<label for="inp_name_extension">Name Extension:</label>
										<input type="text" class="form-control" name="inp_name_extension" placeholder="Name Extension" value="<?=$row_info['name_extension']?>" autocomplete="off">
									</div>
									<div class="col-12 col-md-6 text-start pb-3">
										<label for="inp_gender">Gender:</label>
										<select name="inp_gender" class="form-control" required="">
											<option value="male" <?=($row_info['gender'] == "male" ? "selected" : "")?>>Male</option>
											<option value="female"<?=($row_info['gender'] == "female" ? "selected" : "")?>>Female</option>
											<option value="other"<?=($row_info['gender'] == "other" ? "selected" : "")?>>Other</option>
										</select>
									</div>
									<div class="col-12 col-md-6 text-start pb-3">
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