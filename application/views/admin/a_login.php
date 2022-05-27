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
					<div class="card text-center mt-5 bg-dark p-4" style="border-radius: 10rem;">
						<div class="row">
							<div class="col-10 col-md-6 pt-4 mx-auto">
								<img class="w-100" src="<?=base_url()?>assets/img/dulo-logo.png">
							</div>
							<div class="col-12 text-light pt-3">
								<h2 class="fw-bold">ADMIN LOG-IN</h2>
							</div>
						</div>
						<div class="card-body">
							<?php if (!empty($alert)): ?>
								<div class="alert alert-<?=$alert[0]?> alert-dismissible mt-3">
									<?=$alert[1]?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php endif; ?>
							<?=form_open(base_url() . "admin/login", "method='POST'")?>
								<div class="form-group">
									<label for="inp_email" class="text-light">Email:</label>
									<input type="email" class="form-control text-center" name="inp_email" placeholder="*Email Address" required="">
								</div>
								<div class="form-group">
									<label for="inp_password" class="text-light">Password:</label>
									<input type="password" class="form-control text-center" name="inp_password" placeholder="*Password" required="">
								</div>
								<button type="submit" class="btn btn-primary rounded-pill mt-3 fw-bold">
									<h5><i class="fa fa-sign-in" aria-hidden="true"></i> Sign-In</h5>
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