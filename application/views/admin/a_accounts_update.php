
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
								<h2>Update Account #<?=$row_info["admin_id"]?></h2>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto">
							<div class="col-12">
								<?=form_open(base_url() . "admin/acc_update", "class='row' method='POST'"); ?>
									<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$row_info["admin_id"]?>">
									<div class="col-12 col-md-6 text-start pb-3">
										<label for="inp_name">Name:</label>
										<input type="text" class="form-control" name="inp_name" placeholder="*Name" value="<?=$row_info['name']?>" autocomplete="off" required="">
									</div>
									<div class="col-12 col-md-6 text-start pb-3">
										<label for="inp_email">Email:</label>
										<input type="email" class="form-control" name="inp_email" placeholder="*Email Address" value="<?=$row_info['email']?>" autocomplete="off" required="">
									</div>
									<div class="col-12 col-md-6 text-start pb-3">
										<label for="inp_password">Password:</label>
										<input type="password" class="form-control" name="inp_password" placeholder="*Password" autocomplete="off" required="">
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