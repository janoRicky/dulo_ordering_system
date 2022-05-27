
<?php
$template_header;
?>
<body class="d-flex flex-column min-vh-100 w-100">
	<div class="wrapper">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-sm-10 col-md-7 d-flex flex-wrap justify-content-center">
					<?php if ($tbl_types->num_rows() > 0): ?>
						<?php foreach ($tbl_types->result_array() as $row): ?>
							<div class="featured_type col-3 col-lg-2 text-center px-2 px-lg-4 my-1 mx-1 pb-1 pt-3 <?=((!empty($type) && $type == $row['type_id']) ? 'active' : '')?>" role="button">
								<a class="text-dark text-decoration-none h-100 w-100" href="<?=base_url('products?type='.$row['type_id'])?>">
									<img class="w-100 border border-1 rounded-circle shadow" src="<?=base_url('uploads/types/type_'.$row['type_id'].'/'.$row['img'])?>" style="border: 5px solid lightyellow;">
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
				<div class="col-12 col-sm-10 col-md-10 rounded-pill" style="">

				</div>
			</div>
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-sm-10 col-md-10">
					<div class="row justify-content-center">
						<?php if ($tbl_products->num_rows() > 0): ?>
							<?php foreach ($tbl_products->result_array() as $row): ?>
								<div class="col-6 col-lg-6 col-xl-4 my-3">
									<a class="text-dark text-decoration-none h-100 w-100" href="<?=base_url('product?id='.$row['product_id'])?>">
										<div class="card shadow p-2" style="border-radius: 15px;">
											<div class="card-body">
												<div class="row">
													<div class="col-5">
														<img class="product_img img-fluid w-100" style="height: 200px; object-fit: cover;" src="<?=base_url('uploads/products/product_'.$row['product_id'].'/'.$row['img'])?>" alt="<?=ucwords($row["name"])?>">
													</div>
													<div class="col-7 pt-2">
														<h4 class="fw-bold"><?=ucwords($row["name"])?></h4>
														<p>
															<?php 
															$description = $row["description"];
															if (strlen($description) > 100) {
															    $description = substr($description, 0, 100);
															    $description .= "...";
															}
														    ?>
														    <?=$description?>
														</p>
														<div class="row">
															<div class="col-6">
																<h5 class="py-2" style="position: absolute; bottom: 0;">
																	<span class="fw-bold">Starts at:</span><br>
																	PHP <?=number_format($row["price"], 2)?>
																</h5>
															</div>
															<div class="col-6 text-end">
																<button class="btn fw-bold rounded-pill product_btn">
																	<i class="mdi mdi-eye"></i> VIEW
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</a>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div class="col-10 mt-5 text-center" style="margin-bottom: 10rem;">
								<h1 class="fw-bold">Nothing Found!</h1>
							</div>
						<?php endif; ?>
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
