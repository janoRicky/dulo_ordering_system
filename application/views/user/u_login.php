
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
								<h5 class="font-weight-bold">&bull; Log-In &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-sm-3"></div>
						<div class="col-10 col-sm-6 text-center">
							<?=form_open(base_url() . "login_verify", "method='POST'")?>
								<div class="form-group">
									<h5 class="font-weight-bold" for="inp_email">Email:</h5>
									<input type="email" class="form-control" name="inp_email" placeholder="*Email Address" required="">
								</div>
								<div class="form-group">
									<h5 class="font-weight-bold" for="inp_password">Password:</h5>
									<input type="password" class="form-control" name="inp_password" placeholder="*Password" required="">
								</div>
								<button class="button b_p b_lg" type="submit">
									<i class="fa fa-sign-in" aria-hidden="true"></i> Log-In
								</button>
							<?=form_close()?>
						</div>
						<div class="col-1 col-sm-3"></div>
					</div>
					<div class="row my-4">
						<div class="col-12 text-center">
							Don't have an account? <a href="register">Register</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
</html>