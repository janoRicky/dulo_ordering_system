
<?php
$template_header;
?>
<body>
	<div class="wrapper">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-sm-10 col-md-4 col-lg-5 col-xl-6">
					<div id="test1" class="carousel slide" data-bs-ride="carousel">
						<div class="carousel-inner" style="max-height: 500px; border-radius: 2rem;">
							<div class="carousel-item active">
								<img src="<?=base_url('assets/img/test-1.jpg')?>" alt="Los Angeles" class="d-block w-100">
							</div>
							<div class="carousel-item">
								<img src="<?=base_url('assets/img/test-1.jpg')?>" alt="Chicago" class="d-block w-100">
							</div>
							<div class="carousel-item">
								<img src="<?=base_url('assets/img/test-1.jpg')?>" alt="New York" class="d-block w-100">
							</div>
						</div>
						
						<button class="carousel-control-prev" type="button" data-bs-target="#test1" data-bs-slide="prev">
							<i class="nav-icon mdi mdi-chevron-left mdi-48px car-control"></i>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#test1" data-bs-slide="next">
							<i class="nav-icon mdi mdi-chevron-right mdi-48px car-control"></i>
						</button>
					</div>
				</div>
				<div class="col-12 col-sm-10 col-md-4 col-lg-3 col-xl-2 my-sm-4">
					<div class="card shadow px-4 py-1" style="border-radius: 15px;">
						<div class="card-body">
							<div class="row align-items-center">
								<div class="col-12 my-2">
									<h4 class="fw-bold">
										ORDER NOW!
									</h4>
									<p>Choose your transaction</p>
								</div>
							</div>
							<div class="row align-items-center">
								<a href="products" class="btn my-1"  style="border-radius: 15px; background-color: #f7e929;">
									<i class="nav-icon mdi mdi-motorbike mdi-36px"></i> <i class="nav-icon mdi mdi-store-outline mdi-36px"></i><br>
									DELIVERY / PICK-UP
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-sm-10 col-md-8 d-flex flex-wrap justify-content-center">
					<?php if ($tbl_types->num_rows() > 0): ?>
						<?php foreach ($tbl_types->result_array() as $row): ?>
							<div class="featured_type col-3 col-lg-2 text-center px-2 px-lg-4 my-1 mx-1 pb-1 pt-3 <?=((!empty($type) && $type == $row['type_id']) ? 'active' : '')?>" role="button">
								<a class="text-dark text-decoration-none" href="<?=base_url('products?type='.$row['type_id'])?>">
									<img class="w-100 border border-1 rounded-circle shadow" src="<?=base_url('uploads/types/type_'.$row['type_id'].'/'.$row['img'])?>">
									<h5 class="fw-bold mt-3">
										<?=$row["name"]?>
									</h5>
								</a>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-sm-10 col-md-8">
					<div class="card shadow" style="border-radius: 15px;">
						<div class="card-body">
							<div class="row">
								<div class="col-12 mx-5 mt-3">
									<h3 class="fw-bold">Featured</h3>
									<p>Discover your new favorites here!</p>
								</div>
							</div>
							<div id="featured_items" class="carousel slide" data-bs-ride="carousel">
								<div class="carousel-inner p-4 pt-0" style="">
									<?php if ($tbl_products->num_rows() > 0): ?>
										<?php foreach ($tbl_products->result_array() as $key => $row): ?>
											<?php $per_slide = 4; ?>
											<?php if ($key % $per_slide == 0): ?>
												<div class="carousel-item <?=($key == 0 ? 'active' : '')?>">
													<div class="row justify-content-center">
											<?php endif; ?>
												<div class="col-<?=(12 / $per_slide)?>">
													<div class="card shadow" style="border-radius: 15px;">
														<img class="img-fluid w-100" style="height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;" src="<?=base_url('uploads/products/product_'.$row['product_id'].'/'.$row['img'])?>" class="card-img-top" alt="<?=ucwords($row["name"])?>">
														<div class="card-body">
															<h4 class="fw-bold"><?=ucwords($row["name"])?></h4>
															<h5>PHP <?=number_format($row["price"], 2)?></h5>
														</div>
													</div>
												</div>
											<?php if ($key % $per_slide == $per_slide - 1 && $key != 0): ?>
													</div>
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php endif; ?>
									<!-- IF FEATURED PRODUCT LAST -->
									<?php if ($tbl_products->num_rows() % $per_slide != 0): ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
								
								<button class="carousel-control-prev text-dark" type="button" data-bs-target="#featured_items" data-bs-slide="prev">
									<!-- <div class="bg-dark bg-opacity-25 p-2" style="border-radius: 100%;">
										<span class="carousel-control-prev-icon"></span>
									</div> -->
									<i class="nav-icon mdi mdi-chevron-left mdi-48px car-control"></i>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#featured_items" data-bs-slide="next">
									<i class="nav-icon mdi mdi-chevron-right mdi-48px car-control"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {

	});
</script>
</html>