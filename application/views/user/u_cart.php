
<?php
$template_header;
?>

<style>
	.product-inline-block {
		background: #ededed;
		padding: 15px;
		margin: 10px 0;
		min-height: 165px;
	}

	.marginslim {
		padding-left: 7px;
		padding-right: 7px;
	}
	/*.item_img {
		border: 0.25rem solid #ffc6dd;
		border-radius: 10%;

		box-shadow: 0 0 1.2rem #fff;
		width: 100%;
	}*/
</style>
<body>
	<?php $this->load->view("user/template/u_t_api_scripts"); ?>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row my-4">
				<div class="col-12 content pt-2">
					<div class="row justify-content-center my-5 pb-3">
						<div class="col-11 col-lg-10 col-xl-8">
							<div class="row">
								<div class="col-12 col-lg-7 pr-3">
									<?php if (count($cart) < 1): ?>
										<div class="card shadow mb-3" style="border-radius: 15px;">
											<div class="card-body">
												<div class="row align-items-center item mb-4">
													<div class="price text-center p-4 mt-4">
														<h4 class="fw-bold">
															CART IS EMPTY
														</h4>
													</div>
												</div>
											</div>
										</div>
									<?php endif; $grand_total = 0; ?>
									<?php foreach ($cart as $key => $val):?>
										<?php if ($val != NULL):?>
											<?php
											$item = $this->Model_read->get_product_wid_user($key);
											?>
											<?php if ($item->num_rows() > 0):?>
												<?php

												$item_info = $item->row_array();

												$price = $val * $item_info["price"];
												$grand_total += ($price);

												?>
												<div class="card shadow mb-3" style="border-radius: 15px;">
													<div class="card-body m-2">
														<div class="row align-items-center item">
															<div class="col-5">
																<a href="<?=base_url()?>product?id=<?=$item_info['product_id']?>" class="text-dark">
																	<img class="product_img img-fluid w-100" style="height: 200px; object-fit: cover;" src="<?php
																	if (!empty($item_info["img"])) {
																		echo base_url(). 'uploads/products/product_'. $item_info["product_id"] .'/'. explode("/", $item_info["img"])[0];
																	} else {
																		echo base_url(). "assets/img/no_img.png";
																	}
																	?>">
																</a>
															</div>
															<div class="col-7">
																<div class="row">
																	<div class="col-12 col-md-7">
																		<div class="row">
																			<div class="col-12">
																				<h4 class="fw-bold"><?=$item_info["name"]?></h4>
																			</div>
																			<div class="col-12">
																				<h5 class="font-weight-light"><?=$types[$item_info["type_id"]]?></h5>
																			</div>
																			<div class="col-12">
																				<label class="rounded-pill bg-secondary pt-2 px-3 text-light">
																					<h6 class="fw-bold">Qty: <span class="fw-normal ms-2"><?=$val?></span></h6>
																				</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-12 col-md-5 text-end">
																		<h5 class="fw-bold price">
																			PHP <?=number_format($price, 2)?>
																		</h5>
																	</div>
																</div>
																<div class="row">
																	<div class="col-6 text-start">
																		<a class="btn btn-info rounded-pill mt-1" href="<?=base_url()?>product?id=<?=$item_info['product_id']?>">
																			Update Qty
																		</a>
																	</div>
																	<div class="col-6 text-end">
																		<a class="remove_item btn fw-bold px-4 py-3 rounded-pill product_btn" href="<?=base_url()?>remove_from_cart?id=<?=$key?>">
																			<i class="fa fa-trash" aria-hidden="true"></i> Remove
																		</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php else: ?>
												<?php redirect(base_url() ."remove_from_cart?id=". $key); ?>
											<?php endif; ?>
										<?php endif; ?>
									<?php endforeach; ?>
								</div>
								<div class="col-12 col-lg-5 pl-4">
									<div class="col-12">
										<div class="card shadow" style="border-radius: 15px;">
											<div class="card-body mt-2 mx-3">
												<h5 class="card-title fw-bold">Delivery Method</h5>
												<hr class="my-3 px-5">
												<div class="row justify-content-center item mb-4">
													<div class="col-12 col-md-10 col-xl-8 text-center">
														<div class="input-group">
															<span class="input-group-text px-4">
																<i class="dm_pickup mdi mdi-store-outline mdi-36px d-none"></i>
																<i class="dm_ship mdi mdi-motorbike mdi-36px"></i>
															</span>
															<select id="delivery_method" class="form-control fw-bold" style="font-size: 1.35rem;">
																<option value="0">Ship</option>
																<option value="1">Pick-Up</option>
															</select>
														</div>
													</div>
													<div class="col-12 text-center pickup-address" style="display: none;">
														<div class="bg-secondary text-light px-4 py-2 mt-2" style="border-radius: 10px;">
															<h6 class="fw-bold">Pick-Up on:</h6>
															<span>JDC Compound Beside Palmera 5, Calabarzon, Philippines, Taytay, Philippines</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 mt-3">
										<div class="card shadow" style="border-radius: 15px;">
											<div class="card-body m-3 mb-0">
												<h3 class="card-title fw-bold">Checkout</h3>
												<?php if (count($cart) < 1): ?>
													<hr class="my-3 px-5">
													<div class="row align-items-center mb-4">
														<div class="col-12 p-3 price">
																<h5 class="fw-bold text-center">
																	CART IS EMPTY
																</h5>
														</div>
													</div>
												<?php endif; ?>
											</div>
											<?php if (count($cart) > 0): ?>
												<div class="card-footer p-3" style="background-color: #ffd500; border-radius: 0 0 15px 15px;">
													<div class="row">
														<div class="col-7 fw-bold text-center">
															<?=count($cart)?> Item<?=(count($cart) > 1 ? 's' : '')?>
															<h5 class="fw-bold">PHP <?=number_format($grand_total, 2)?></h5>
														</div>
														<div class="col-5">
															<?=form_open(base_url() . "submit_order", "method='POST'")?>
																<input type="hidden" name="grand_total" value="<?=$grand_total?>">
																<input id="method_delivery" type="hidden" name="delivery_method" required>
																

																<?php if ($this->session->userdata("user_in")): ?>
																	<button class="btn btn-dark fw-bold px-4 py-3 rounded-pill text-light" <?=($grand_total > 0 ? "" : "disabled")?>>
																		Payment
																	</button>
																<?php else: ?>
																	<button class="btn btn-dark fw-bold px-4 py-3 rounded-pill text-light" type="button" href="#" data-bs-toggle="modal" data-bs-target="#modal_sign_in_cart">
																		Payment
																	</button>
																<?php endif; ?>
															<?=form_close()?>
														</div>
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>
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
		$(".remove_item").on('click', function(event) {
			if (!confirm("remove item?")) {
				event.preventDefault();
			}
		});

		$("#delivery_method").on("change", function() {
			if ($(this).val() == 0) { // ship
				if ($(".dm_ship").hasClass("d-none")) {
					$(".dm_ship").toggleClass("d-none");
					$(".dm_pickup").toggleClass("d-none");

					$(".pickup-address").slideUp().fadeOut();
				}
			} else { // pickup
				if ($(".dm_pickup").hasClass("d-none")) {
					$(".dm_ship").toggleClass("d-none");
					$(".dm_pickup").toggleClass("d-none");

					$(".pickup-address").slideDown().fadeIn();
				}
			}
			$('#method_delivery').val($(this).val());
		});
		$("#method_delivery").val($("#delivery_method").find(":selected").val());
    });
</script>
</html>