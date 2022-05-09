
<?php
$template_header;
?>

<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-sm-1"></div>
				<div class="col-12 col-sm-10 content pt-4">
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; My Orders &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row my-4">
						<div class="col-1 col-sm-2">
							<a class="scroll left">
								<i class="fa fa-caret-left p-1" aria-hidden="true"></i>
							</a>
						</div>
						<class class="col-10 col-sm-8 nav_order justify-content-center">
							<a href="my_orders">ALL (<?=(isset($order_state_counts) ? array_sum($order_state_counts) : 0)?>)</a>
							<a href="my_orders?state=0"><?=$states[0]?> (<?=(isset($order_state_counts[0]) ? $order_state_counts[0] : 0)?>)</a>
							<a href="my_orders?state=1"><?=$states[1]?> (<?=(isset($order_state_counts[1]) ? $order_state_counts[1] : 0)?>)</a>
							<a href="my_orders?state=2"><?=$states[2]?> (<?=(isset($order_state_counts[2]) ? $order_state_counts[2] : 0)?>)</a>
							<a href="my_orders?state=3"><?=$states[3]?> (<?=(isset($order_state_counts[3]) ? $order_state_counts[3] : 0)?>)</a>
							<a href="my_orders?state=4"><?=$states[4]?> (<?=(isset($order_state_counts[4]) ? $order_state_counts[4] : 0)?>)</a>
							<a href="my_orders?state=5"><?=$states[5]?> (<?=(isset($order_state_counts[5]) ? $order_state_counts[5] : 0)?>)</a>
							<a href="my_orders?state=6"><?=$states[6]?> (<?=(isset($order_state_counts[6]) ? $order_state_counts[6] : 0)?>)</a>
						</class>
						<div class="col-1 col-sm-2">
							<a class="scroll right">
								<i class="fa fa-caret-right p-1" aria-hidden="true"></i>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-1"></div>
						<div class="col-10 p-4">
							<div class="row">
								<div class="col-4 col-md-3">
									<h5 class="font-weight-bold">Date / Time: </h5>
								</div>
								<div class="col-8 col-md-9">
									<?=date("Y-m-d / H:i:s A", strtotime($my_order["date_time"]))?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Full Address: </h5>
								</div>
								<div class="col-9">
									<?=$my_order["zip_code"] ." / ". $my_order["country"] ." / ". $my_order["province"] ." / ". $my_order["city"] ." / ". $my_order["street"] ." / ". $my_order["address"]?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-3">
									<h5 class="font-weight-bold">Order State: </h5>
								</div>
								<div class="col-9">
									<?=$states[$my_order["state"]]?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<h5 class="font-weight-bold">Ordered Item/s: </h5>
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
												<h5 class="font-weight-bold">Custom Description:</h5>
											</div>
											<div class="col-12 custom_description">
												<?=$product_info["description"]?>
											</div>
										</div>
										<hr>
										<div class="row mt-2">
											<div class="col-6 col-sm-3">
												<h5 class="font-weight-bold">Type:</h5>
											</div>
											<div class="col-6 col-sm-3">
												<?=$types[$product_info["type_id"]]?>
											</div>
											<div class="col-6 col-sm-3">
												<h5 class="font-weight-bold">Size:</h5>
											</div>
											<div class="col-6 col-sm-3">
												<?=$product_info["size"]?>
											</div>
										</div>
										<hr>
										<div class="row mt-2">
											<div class="col-12">
												<h5 class="font-weight-bold">Reference Images:</h5>
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
													<h5 class="font-weight-bold">Qty:</h5>
												</div>
												<div class="col-6 col-sm-3">
													<?=$order_item["qty"]?>
												</div>
												<div class="col-6 col-sm-3">
													<h5 class="font-weight-bold">Price:</h5>
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
														<td>
															<a href="<?=base_url();?>product?id=<?=$row['product_id']?>">
																<button class="button b_p">
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
									<h5 class="font-weight-bold">Payments:</h5>
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
						<div class="col-1"></div>
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