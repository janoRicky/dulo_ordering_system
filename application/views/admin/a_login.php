<?php
$template_header; // loads in the header of the page obtained from views/admin/template
?>

<body>
	<div class="wrapper h-100">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<a class="btn m-3" href="<?=base_url()?>" style="font-weight: bold;">< BACK TO MAIN SITE</a>
				</div> 
			</div>
			<div class="row">
				<div class="col-1 col-sm-2 col-md-3 col-lg-4"></div> 
				<div class="col-10 col-sm-8 col-md-6 col-lg-4">
					<div class="card text-center mt-5">
						<div class="card-header">
							<h3>LOG-IN</h3>
						</div>
						<div class="card-body">
							<?php if ($this->session->flashdata("login_alert")): ?>
								<?php $alert = $this->session->flashdata("login_alert"); ?>
								<div class="alert alert-<?=$alert[0]?> alert-dismissible">
									<?=$alert[1]?>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
							<?php endif; ?>
							<?=form_open(base_url() . "admin/login", "method='POST'")?>
								<div class="form-group">
									<label for="inp_email">Email:</label>
									<input type="email" class="form-control" name="inp_email" placeholder="*Email Address" required="">
								</div>
								<div class="form-group">
									<label for="inp_password">Password:</label>
									<input type="password" class="form-control" name="inp_password" placeholder="*Password" required="">
								</div>
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-sign-in" aria-hidden="true"></i> Sign-In
								</button>
							<?=form_close()?>
						</div>
					</div>
				</div>
				<div class="col-1 col-sm-2 col-md-3 col-lg-4"></div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () { // function runs on document ready
		
	});
</script>
</html>