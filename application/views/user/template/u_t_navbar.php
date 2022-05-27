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
								<span class="mx-2">|</span>
								<a class="text-decoration-none text-light fw-bold" href="logout">Logout</a>
							<?php else: ?>
								<a class="text-decoration-none text-light fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#modal_sign_up">Sign-Up</a>
								<span class="mx-2">|</span>
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
<!-- <div class="container-fluid navbar_">
	<div class="row p-4">
		<div class="col-12 text-center">
			<a class="nav_title" href="home">
				<h1>dulo</h1>
			</a>
		</div>
	</div>
	<div class="row p-3 mt-2 nav_link_bar">
		<nav class="col-12">
			<ul class="nav justify-content-center">
				<li class="nav-item px-4">
					<a class="nav-link nav_link <?=(uri_string() == 'home' ? 'active' : '')?>" href="home">
						<i class="fa fa-home" aria-hidden="true"></i> Home
					</a>
				</li>
				<li class="nav-item px-4">
					<a class="nav-link nav_link <?=(uri_string() == 'products' ? 'active' : '')?>" href="products">
						<i class="fa fa-shopping-bag" aria-hidden="true"></i> Products
					</a>
				</li>
				<li class="nav-item px-4">
					<a class="nav-link nav_link <?=(uri_string() == 'cart' ? 'active' : '')?>" href="cart">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart (<?=($this->session->has_userdata("cart") ? count($this->session->userdata("cart")) : "0")?>)
					</a>
				</li>
				<?php if ($this->session->userdata("user_in")): ?>
					<li class="nav-item px-4">
						<a class="nav-link nav_link dropdown-toggle <?=(uri_string() == 'account' || uri_string() == 'my_orders' ? 'active' : '')?>" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							
						</a>
						<div class="dropdown-menu dropdown_menu dropdown-menu-right">
							
						</div>
					</li>
				<?php else: ?>
					<li class="nav-item px-4">
						<a class="nav-link nav_link" href="login">
							<i class="fa fa-sign-in" aria-hidden="true"></i> Log-In
						</a>
					</li>
				<?php endif; ?>
				
			</ul>
		</nav>
	</div>
</div> -->

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

