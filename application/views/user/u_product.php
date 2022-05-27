
<?php
$template_header;
?>
<body>
	<div class="wrapper">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-md-10 col-lg-8 mb-5">
					<div class="card shadow" style="border-radius: 15px;">
						<div class="card-body p-0">
							<div class="row m-0 p-0">
								<div class="col-12 col-md-5 m-0 p-4" style="border-radius: 15px 0 0 15px; background-color: #dfdfdf;">
									<img class="product_img img-responsive w-100" src="<?php
									if (!empty($product_details["img"])) {
										echo base_url(). 'uploads/products/product_'. $product_details["product_id"] .'/'. explode("/", $product_details["img"])[0];
									} else {
										echo base_url(). "assets/img/no_img.png";
									}
									?>">
									<div class="row mt-2">
										<div class="col-12 text-center">
											<h2 class="fw-bold"><?=$product_details["name"]?></h2>
										</div>
									</div>
									<div class="row mt-1 mb-2">
										<div class="col-0 col-sm-3"></div>
										<div class="col-12 col-sm-6 text-center">
											<h3 class="text-muted price" style="color: #dd0000 !important;">
												PHP <?=number_format($product_details["price"], 2)?>
											</h3>
										</div>
										<div class="col-0 col-sm-3"></div>
									</div>
									<div class="row mb-2 px-4">
										<div class="col-12">
											<h4 class="font-weight-light"><?=$product_details["description"]?></h4>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-7">
									<?php
									$current_qty = $product_details["qty"];
									if ($this->session->has_userdata("cart")) {
										$cart = $this->session->userdata("cart");
										$item_key = array_search($product_details["product_id"], array_column($cart, 0));
										if ($item_key !== FALSE) {
											$current_qty = $product_details["qty"] - $cart[$item_key][1];
										}
									}
									?>
									<?=form_open(base_url() . "to_cart", "method='GET'")?>
										<input type="hidden" name="id" value="<?=$product_details['product_id']?>">
										<div class="row justify-content-center my-5">
											<div class="col-12 col-sm-12 text-center">
												<h5 class="fw-bold">ADDITIONAL NOTE <span class="text-muted">[OPTIONAL]</span>:</h5>
											</div>
											<div class="col-12 col-sm-7">
												<textarea class="form-control text-center" name="note" rows="3"></textarea>
											</div>
										</div>
										<div class="row justify-content-center mt-4">
											<div class="col-5 col-md-12">
												<div class="row justify-content-center py-3">
													<button class="btn btn-qty-subtract" type="button" style="width: 72px; height: 72px; border-radius: 100%;">
														<i class="mdi mdi-minus-circle-outline mdi-36px"></i>
													</button>
													<input class="form-control text-center mx-2" id="product_qty" style="width: 120px; font-size: 24px;" type="number" name="amount" min="1" value="1" required="" placeholder="*Qty">
													<button class="btn btn-qty-add" type="button" style="width: 72px; height: 72px; border-radius: 100%;">
														<i class="mdi mdi-plus-circle-outline mdi-36px"></i>
													</button>
												</div>
											</div>
										</div>
										<div class="row justify-content-center mt-4">
											<div class="col-7 col-md-12 text-center">
												<button class="btn fw-bold px-4 py-3 rounded-pill product_btn" type="submit" name="submit" value="AC">
													<i class="mdi mdi-cart-arrow-down"></i> ADD TO CART
												</button>
												<button class="btn fw-bold px-4 py-3 rounded-pill product_btn" type="submit" name="submit" value="BN">
													<i class="mdi mdi-cash" aria-hidden="true"></i> BUY NOW
												</button>
											</div>
										</div>
									<?=form_close()?>
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
		$('.btn-qty-add').on('click', function() {
			$('#product_qty').val(parseInt($('#product_qty').val()) + 1);
		});
		$('.btn-qty-subtract').on('click', function() {
			if (parseInt($('#product_qty').val()) - 1 > 0) {
				$('#product_qty').val(parseInt($('#product_qty').val()) - 1);
			}
		});
	});
</script>
</html>
