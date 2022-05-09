<header class="p-3 bg-dark text-light">
	<div class="container">
		<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
			<a href="<?=base_url()?>" class="d-flex align-items-center mb-lg-0 text-light text-decoration-none">
				<img class="bi me-2" width="40" height="40" src="<?=base_url()?>assets/img/dulo-logo.png">
				<h4 class="fw-bold">DULO By The A's</h4>
			</a>

			<ul class="nav col-12 col-lg-auto ms-lg-auto justify-content-center mb-md-0 me-lg-3">
				<li>
					<a href="products" class="nav-link px-2 text-light h5 px-3 <?=(uri_string() == 'products' ? 'rounded-pill bg-secondary' : '')?>">
						<i class="nav-icon mdi mdi-silverware-fork-knife"></i> Menu
					</a>
				</li>
				<li>
					<a href="cart" class="nav-link px-2 text-light h5 px-3 <?=(uri_string() == 'cart' ? 'rounded-pill bg-secondary' : '')?>">
						<i class="nav-icon mdi mdi-cart-arrow-down"></i> Cart
						<!-- <i class="rounded-pill bg-danger p-1"><?=($this->session->has_userdata("cart") ? count($this->session->userdata("cart")) : "0")?></i> -->
					</a>
				</li>
			</ul>


			<div class="text-end">
				<?php if ($this->session->userdata("user_in")): ?>
					<button type="button" class="btn btn-light border border-dark px-4 py-1 rounded-pill">Sign-in</button>
				<?php else: ?>
					<button type="button" class="btn btn-light border border-dark px-4 py-1 rounded-pill">Sign-in</button>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>
<!-- <div class="container-fluid navbar_">
	<div class="row p-4">
		<div class="col-12 text-center">
			<a class="nav_title" href="home">
				<h1>AngeliClay</h1>
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
	<?php $alert = $this->session->flashdata("notice"); ?>
	<div class="notice n_all row alert alert-<?=$alert[0]?>" data-bs-dismiss="alert">
		<div class="text-center w-100">
			<?=$this->session->flashdata("notice")[1]?>
		</div>
	</div>
<?php endif; ?>

<script type="text/javascript">
	setTimeout(function() {
		$(".notice").fadeOut(3000, function() {
			$(this).remove();
		});
	}, 30000);
</script>

