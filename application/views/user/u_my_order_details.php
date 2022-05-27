
<?php
$template_header;
?>

<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-md-10 col-lg-8 mb-5">
					<div class="card shadow" style="border-radius: 15px;">
						<div class="card-body p-0">
							<div class="row m-0 p-0 justify-content-center pb-4 pt-2">
								<div class="col-12">
									<!-- <div class="row mt-4">
										<div class="col-12 banner text-center">
											<div class="banner_board">
												<h5 class="fw-bold"> My Orders <?=(!is_null($this->input->get("state")) ? "(". $states[$this->input->get("state")] .")" : "")?> </h5>
											</div>
										</div>
									</div> -->
									<div class="row my-2 justify-content-center">
										<class class="col-12 col-sm-10 justify-content-center text-center">
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders">ALL (<?=(isset($order_state_counts) ? array_sum($order_state_counts) : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=0"><?=$states[0]?> (<?=(isset($order_state_counts[0]) ? $order_state_counts[0] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=1"><?=$states[1]?> (<?=(isset($order_state_counts[1]) ? $order_state_counts[1] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=2"><?=$states[2]?> (<?=(isset($order_state_counts[2]) ? $order_state_counts[2] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=3"><?=$states[3]?> (<?=(isset($order_state_counts[3]) ? $order_state_counts[3] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=4"><?=$states[4]?> (<?=(isset($order_state_counts[4]) ? $order_state_counts[4] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=5"><?=$states[5]?> (<?=(isset($order_state_counts[5]) ? $order_state_counts[5] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=6"><?=$states[6]?> (<?=(isset($order_state_counts[6]) ? $order_state_counts[6] : 0)?>)</a>
										</class>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card shadow mt-3" style="border-radius: 15px;">
						<div class="card-body p-0">
							<div class="row m-0 p-0 justify-content-center py-4">
								<div class="col-12">
									<div class="row justify-content-center">
										<div class="col-10 p-4">
											<div class="row">
												<div class="col-4 col-md-3">
													<h5 class="fw-bold">Date / Time: </h5>
												</div>
												<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
													<?=date("Y-m-d / H:i:s A", strtotime($my_order["date_time"]))?>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-3">
													<h5 class="fw-bold">Full Address: </h5>
												</div>
												<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
													<?=$my_order["province"] ." / ". $my_order["city"] ." / ". $my_order["street"] ." / ". $my_order["address"]?>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-3">
													<h5 class="fw-bold">Order State: </h5>
												</div>
												<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
													<?=$states[$my_order["state"]]?>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-12">
													<h5 class="fw-bold">Ordered Item/s: </h5>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-1"></div>
												<div class="col-10">
													<?php if ($type == "CUSTOM"): ?>
														<?php
														$order_item = $order_items->row_array();
														$product_info = $this->Model_read->get_product_custom_wid($order_item["product_id"])->row_array();
														?>
														<hr>
														<div class="row mt-2">
															<div class="col-12">
																<h5 class="fw-bold">Custom Description:</h5>
															</div>
															<div class="col-12 custom_description">
																<?=$product_info["description"]?>
															</div>
														</div>
														<hr>
														<div class="row mt-2">
															<div class="col-6 col-sm-3">
																<h5 class="fw-bold">Type:</h5>
															</div>
															<div class="col-6 col-sm-3">
																<?=$types[$product_info["type_id"]]?>
															</div>
															<div class="col-6 col-sm-3">
																<h5 class="fw-bold">Size:</h5>
															</div>
															<div class="col-6 col-sm-3">
																<?=$product_info["size"]?>
															</div>
														</div>
														<hr>
														<div class="row mt-2">
															<div class="col-12">
																<h5 class="fw-bold">Reference Images:</h5>
															</div>
															<?php $imgs = explode("/", $product_info["img"]); ?>
															<?php foreach ($imgs as $src): ?>
																<?php if ($src != NULL): ?>
																	<div class="col-12 col-sm-6 col-md-4 pb-3 mx-auto">
																		<img class="img-responsive item_img" src="
																		<?=base_url(). 'uploads/custom/custom_'. $product_info["custom_id"] .'/'. $src?>">
																	</div>
																<?php endif; ?>
															<?php endforeach; ?>
														</div>
														<hr>
														<?php if ($my_order["state"] > 0): ?>
															<div class="row mt-2">
																<div class="col-6 col-sm-3">
																	<h5 class="fw-bold">Qty:</h5>
																</div>
																<div class="col-6 col-sm-3">
																	<?=$order_item["qty"]?>
																</div>
																<div class="col-6 col-sm-3">
																	<h5 class="fw-bold">Price:</h5>
																</div>
																<div class="col-6 col-sm-3">
																	<?=$order_item["price"]?>
																</div>
															</div>
															<hr>
														<?php endif; ?>
													<?php else: ?>
														<table class="table table-center table-hover table-responsive-sm table-bordered">
															<thead>
																<tr>
																	<th>Item</th>
																	<th>Qty.</th>
																	<th>Unit Price</th>
																	<th>Total Price</th>
																	<th></th>
																</tr>
															</thead>
															<tbody>
																<?php $total_qty = 0; $total_price = 0; ?>
																<?php foreach ($order_items->result_array() as $row): ?>
																	<tr>
																		<td><?=$this->Model_read->get_product_wid($row["product_id"])->row_array()["name"]?></td>
																		<td><?=$row["qty"]?></td>
																		<?php $total_qty += $row["qty"]; ?>
																		<td><?=$row["price"]?></td>
																		<td><?=$row["qty"] * $row["price"]?></td>
																		<?php $total_price += $row["qty"] * $row["price"]; ?>
																		<td class="text-center">
																			<a href="<?=base_url();?>product?id=<?=$row['product_id']?>">
																				<button class="btn fw-bold rounded-pill product_btn px-3 py-2">
																					<i class="fa fa-eye" aria-hidden="true"></i> View
																				</button>
																			</a>
																		</td>
																	</tr>
																<?php endforeach; ?>
																<tr>
																	<td>Total</td>
																	<td><?=$total_qty?></td>
																	<td></td>
																	<td><?=$total_price?></td>
																	<td></td>
																</tr>
															</tbody>
														</table>
													<?php endif; ?>
												</div>
												<div class="col-1"></div>
											</div>
											<?php if ($order_payments->num_rows() > 0): ?>
												<div class="row mt-2">
													<h5 class="fw-bold">Payments:</h5>
												</div>
												<div class="row mt-2">
													<div class="col-12">
														<table class="table table-center table-hover table-responsive-sm table-bordered">
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Img</th>
																	<th>Date / Time</th>
																	<?php if ($my_order["state"] > 1): ?>
																		<th>Amount</th>
																	<?php endif; ?>
																</tr>
															</thead>
															<tbody>
																<?php $total_payment = 0; ?>
																<?php foreach ($order_payments->result_array() as $row): ?>
																	<tr>
																		<td><?=$row["payment_id"]?></td>
																		<td class="col-4">
																			<?php if($row["img"] != NULL): ?>
																				<img class="img-responsive item_img" src="<?php
																				if (!empty($row['img'])) {
																					echo base_url(). 'uploads/users/user_'. $user_id .'/payments/order_'. $order_id .'/'. $row["img"];
																				} else {
																					echo base_url(). "assets/img/no_img.png";
																				}
																				?>">
																			<?php endif; ?>
																		</td>
																		<td><?=$my_order["date_time"]?></td>
																		<?php if ($my_order["state"] > 1): ?>
																			<td><?=$row["amount"]?></td>
																			<?php $total_payment += $row["amount"]; ?>
																		<?php endif; ?>
																	</tr>
																<?php endforeach; ?>
																<?php if ($my_order["state"] > 1): ?>
																	<tr>
																		<td>Total</td>
																		<td></td>
																		<td></td>
																		<td><?=$total_payment?></td>
																	</tr>
																<?php endif; ?>
															</tbody>
														</table>
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
		$(document).on("mouseenter", ".scroll.left", function() {
			timer_left = setInterval(function() {
				$(".nav_order").scrollLeft($(".nav_order").scrollLeft() - 10);
			}, 20);
		}).on("mouseleave", ".scroll.left", function() {
			clearInterval(timer_left);
		});
		$(document).on("mouseenter", ".scroll.right", function() {
			timer_right = setInterval(function() {
				$(".nav_order").scrollLeft($(".nav_order").scrollLeft() + 10);
			}, 20);
		}).on("mouseleave", ".scroll.right", function() {
			clearInterval(timer_right);
		});

		$(document).on("click", ".receive", function(e) {
			if (!confirm("Are you sure you want to set this order as RECEIVED?")) {
				e.preventDefault();
			}
		});
	});
</script>
</html>