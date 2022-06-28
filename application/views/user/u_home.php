
<?php
$template_header;
?>
<body>
	<?php $this->load->view("user/template/u_t_api_scripts"); ?>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-sm-10 col-md-4 col-lg-5 col-xl-6">
					<div id="test1" class="carousel slide" data-bs-ride="carousel">
						<div class="carousel-inner" style="max-height: 500px; border-radius: 2rem;">
							<div class="carousel-item active">
								<img src="<?=base_url('assets/img/test-1.jpg')?>" class="d-block w-100">
							</div>
							<div class="carousel-item">
								<img src="<?=base_url('assets/img/test-1.jpg')?>" class="d-block w-100">
							</div>
							<div class="carousel-item">
								<img src="<?=base_url('assets/img/test-1.jpg')?>" class="d-block w-100">
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
								<div class="col-12 my-2 text-center">
									<h4 class="fw-bold">
										ORDER NOW!
									</h4>
								</div>
							</div>
							<div class="row align-items-center">
								<a href="products" class="btn my-1 fw-bold"  style="border-radius: 15px; background-color: #f7e929;">
									<i class="nav-icon mdi mdi-store-outline mdi-36px"></i><br>
									PICK-UP
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
						<div class="card-body featured_container">
							<div class="row">
								<div class="col-12 px-5 pt-3">
									<h3 class="fw-bold">Featured</h3>
									<p>Discover your new favorites here!</p>
								</div>
							</div>
							<div class="featured_carousel">
								<?php if ($tbl_products->num_rows() > 0): ?>
									<?php foreach ($tbl_products->result_array() as $key => $row): ?>
										<div class="featured_item mb-3 btn_link" role="button" data-href="<?=base_url('product?id='.$row['product_id'])?>">
											<div class="card shadow h-100" style="border-radius: 15px;">
												<img class="img img-fluid w-100" src="<?=base_url('uploads/products/product_'.$row['product_id'].'/'.$row['img'])?>" class="card-img-top" alt="<?=ucwords($row["name"])?>">
												<div class="card-body w-100">
													<h5 class="fw-bold"><?=ucwords($row["name"])?></h5>
													<h5 class="price">PHP <?=number_format($row["price"], 2)?></h5>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
								<div class="control left" role="button" style="left: 40px;">
									<i class="nav-icon mdi mdi-chevron-left mdi-48px"></i>
								</div>
								<div class="control right" role="button" style="right: 40px;">
									<i class="nav-icon mdi mdi-chevron-right mdi-48px"></i>
								</div>
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
		$(document).on('click', '.control.left', function() {
			$('.featured_carousel').animate({
			    scrollLeft: $('.featured_carousel').scrollLeft() - 700
			}, 400);
		});
		$(document).on('click', '.control.right', function() {
			$('.featured_carousel').animate({
			    scrollLeft: $('.featured_carousel').scrollLeft() + 700
			}, 400);
		});
	});
</script>
</html>