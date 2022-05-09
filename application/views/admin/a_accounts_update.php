
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
								<h2>Update Account #<?=$row_info["admin_id"]?></h2>
							</div>
							<div class="col-12">
								<?=form_open(base_url() . "admin/acc_update", "method='POST'"); ?>
									<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$row_info["admin_id"]?>">
									<div class="form-group">
										<label for="inp_name">Name:</label>
										<input type="text" class="form-control" name="inp_name" placeholder="*Name" value="<?=$row_info['name']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_email">Email:</label>
										<input type="email" class="form-control" name="inp_email" placeholder="*Email Address" value="<?=$row_info['email']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
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