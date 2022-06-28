
<?php
$template_header;
?>
<body>
	<?php $this->load->view("user/template/u_t_api_scripts"); ?>
	<div class="wrapper bg">
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
										<div class="row justify-content-center mt-5">
											<div class="col-11 col-sm-12 text-center">
												<h5 class="fw-bold">ADDITIONAL NOTE <span class="text-muted">[OPTIONAL]</span>:</h5>
											</div>
											<div class="col-11 col-sm-7">
												<textarea id="adtl_note" class="form-control text-center" name="adtl_note" maxlength="255" rows="3"><?=(isset($product_note) ? $product_note : "")?></textarea>
											</div>
										</div>
										<div class="row justify-content-center mt-1 mt-md-4">
											<div class="col-12 col-md-12">
												<div class="row justify-content-center py-3">
													<button class="btn btn-qty-subtract" type="button" style="width: 72px; height: 72px; border-radius: 100%;">
														<i class="mdi mdi-minus-circle-outline mdi-36px"></i>
													</button>
													<input class="form-control text-center mx-2" id="product_qty" style="width: 120px; font-size: 24px;" type="number" name="amount" min="1" value="<?=(isset($product_qty) ? $product_qty : '1')?>" required="" placeholder="*Qty">
													<button class="btn btn-qty-add" type="button" style="width: 72px; height: 72px; border-radius: 100%;">
														<i class="mdi mdi-plus-circle-outline mdi-36px"></i>
													</button>
												</div>
											</div>
										</div>
										<div class="row justify-content-center mt-1 mt-md-4 pb-4">
											<div class="col-10 col-md-12 text-center">
												<button class="btn fw-bold px-4 py-3 mb-2 rounded-pill product_btn" type="submit" name="submit" value="AC">
													<i class="mdi mdi-cart-arrow-down"></i> ADD TO CART
												</button>
												<button class="btn fw-bold px-4 py-3 mb-2 rounded-pill product_btn" type="submit" name="submit" value="BN">
													<i class="mdi mdi-cash" aria-hidden="true"></i> BUY NOW
												</button>
											</div>

											<?php if (isset($my_orders_pending)): ?>
												<div class="col-10 col-md-12 text-center">
													<button class="btn btn-success fw-bold px-4 py-3 mb-2 rounded-pill btn-add-to-order" type="button">
														ADD TO ORDER
													</button>
												</div>
											<?php endif; ?>
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
		<?php if (isset($my_orders_pending)): ?>
			<!-- ADD TO ORDER MODAL -->
			<div id="modal_add_to_order" class="modal">
				<div class="modal-dialog modal-xl">
					<div class="modal-content text-light" style="background-color: #000;">
						<?=form_open(base_url() . "add_to_order", "id='add_item' method='POST'")?>
							<input id="item_order_id" type="hidden" name="inp_oid">

							<input id="item_product_id" type="hidden" name="inp_product_id" value="<?=$product_details['product_id']?>">
							<input id="item_product_qty" type="hidden" name="inp_product_qty">
							<input id="item_adtl_note" type="hidden" name="inp_adtl_note">

							<div class="modal-body">
								<div class="row justify-content-end pe-3 pt-2">
									<button type="button" class="btn-close btn-close-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="row text-center">
									<div class="col-12 text-light pt-3 text-center">
										<h2 class="fw-bold">Select order.</h2>
									</div>
								</div>
								<div class="row mt-5 mb-5 px-5">
									<div class="col-12 p-4 table-responsive bg-light rounded">
										<div class="col-12 text-dark pt-3 text-center">
											<h5 class="fw-bold">My Orders (PENDING)</h5>
										</div>
										<table id="table_my_orders" class="table">
											<thead>
												<tr>
													<th>Order #</th>
													<th>Date Ordered</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($my_orders_pending->result_array() as $row): ?>
													<tr>
														<td class="text-center">
															<?=date("Y-m", strtotime($row["date_time"]))?>-<?= str_pad($row["order_id"], 6, '0', STR_PAD_LEFT) ?>
														</td>
														<td class="text-center">
															<?=date("Y-m-d", strtotime($row["date_time"]))?>
														</td>
														<td class="text-center">
															<a class="btn fw-bold rounded-pill btn-success px-3 py-2 mb-1 btn-add-item" data-oid="<?=$row["order_id"]?>">
																<i class="mdi mdi-plus"></i> Add
															</a>
															<a class="btn fw-bold rounded-pill product_btn px-3 py-2 mb-1" href="my_order_details?id=<?=$row["order_id"]?>">
																<i class="mdi mdi-eye"></i> Details
															</a>
														</td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>

							</div>
						<?=form_close()?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		<?php if (isset($my_orders_pending)): ?>
			$("#table_my_orders").DataTable({
				"order": [[0, "desc"]],
				"bLengthChange": false,
				createdRow: function (row, data, index) {
					$(row).addClass("order");
				}
			});
		<?php endif; ?>

		$('.btn-qty-add').on('click', function() {
			$('#product_qty').val(parseInt($('#product_qty').val()) + 1);
		});
		$('.btn-qty-subtract').on('click', function() {
			if (parseInt($('#product_qty').val()) - 1 > 0) {
				$('#product_qty').val(parseInt($('#product_qty').val()) - 1);
			}
		});

		$('.btn-add-to-order').on('click', function() {
			$('#item_adtl_note').val($('#adtl_note').val());
			$('#item_product_qty').val($('#product_qty').val());
			$('#modal_add_to_order').modal('toggle');
		});

		$(document).on('click', '.btn-add-item', function() {
			if ($('#item_order_id').val($(this).data('oid'))) {
				$('#add_item').submit();
			}
		});
	});
</script>
</html>
