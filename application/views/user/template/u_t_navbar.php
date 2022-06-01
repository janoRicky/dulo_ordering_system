<header class="p-3 text-light" style="background-color: #000;">
	<div class="container">
		<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
			

				<div class="col-12 col-lg-4">
					<a href="<?=base_url()?>" class="d-flex align-items-center mb-lg-0 text-light text-decoration-none">
						<img class="bi me-2" width="40" height="40" src="<?=base_url()?>assets/img/dulo-logo.png">
						<h4 class="fw-bold">DULO By The A's</h4>
					</a>
				</div>
				<div class="col-12 col-lg-8">
					<ul class="nav col-12 col-lg-auto ms-lg-auto justify-content-end mb-md-0 me-lg-3">
						<li>
							<a href="products" class="nav-link px-2 text-light h5 px-3 mx-1">
								<i class="nav-icon mdi mdi-chat-question-outline"></i> Help
							</a>
						</li>
						<li>
							<a href="products" class="nav-link px-2 text-light h5 px-3 mx-1 <?=(uri_string() == 'products' ? 'rounded-pill bg-secondary' : '')?>">
								<i class="nav-icon mdi mdi-silverware-fork-knife"></i> Menu
							</a>
						</li>
						<li class="p-2 ps-4">
							<?php if ($this->session->userdata("user_in")): ?>
								<a class="text-decoration-none text-light fw-bold" href="account">My Account</a>
								<span class="mx-2"><i class="nav-icon mdi mdi-circle text-success"></i></span>
								<a id="logout" class="text-decoration-none text-light fw-bold" href="#">Logout</a>
							<?php else: ?>
								<a class="text-decoration-none text-light fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#modal_sign_up">Sign-Up</a>
								<span class="mx-2"><i class="nav-icon mdi mdi-circle text-danger"></i></span>
								<a class="text-decoration-none text-light fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#modal_sign_in">Log In</a>
							<?php endif; ?>
						</li>
					</ul>


					<div class="col-12 text-end d-flex flex-wrap justify-content-end">
						<?=form_open(base_url() . "products", "class='col-12 col-sm-5 col-lg-8' method='GET'")?>
							<!-- <input type="search" class="form-control" placeholder="Search..." aria-label="Search"> -->
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Search Menu..." aria-label="Search Menu..." aria-describedby="button-addon2" name="search" value="<?=$this->input->get("search")?>">
								<button class="btn btn-outline-secondary" type="submit">
									<i class="nav-icon mdi mdi-magnify"></i>
								</button>
							</div>
						<?=form_close()?>
						<div class="text-end mt-1 mt-sm-0 ms-2">
							<a href="cart" class="px-2 nav-link text-light h5 px-3 <?=(uri_string() == 'cart' ? 'rounded-pill bg-secondary' : '')?>">
								<i class="nav-icon mdi mdi-cart-arrow-down"></i> Cart
								<span class="text-small">(<?=($this->session->has_userdata("cart") ? count($this->session->userdata("cart")) : "0")?>)</span>
							</a>
						</div>
					</div>
				</div>
		</div>
	</div>
</header>
<?php if ($this->session->flashdata("notice")): ?>
	<?php $alert = $this->session->flashdata("notice"); unset($_SESSION["notice"]); ?>
	<div class="notice n_all row alert alert-<?=$alert[0]?> rounded-pill" data-bs-dismiss="alert" role="button" style="position: fixed; top: 5rem; right: 4rem; z-index: 9999;">
		<div class="text-center w-100">
			<?=$alert[1]?>
		</div>
	</div>
<?php endif; ?>

<script type="text/javascript">
	setTimeout(function() {
		$(".notice").fadeOut(12000, function() {
			$(this).remove();
		});
	}, 5000);
</script>

