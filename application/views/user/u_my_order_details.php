
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
							<div class="row m-0 p-0 justify-content-center pb-4 pt-2">
								<div class="col-12">
									<div class="row my-2 justify-content-center">
										<class class="col-12 col-sm-10 justify-content-center text-center">
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders">ALL (<?=(isset($order_state_counts) ? array_sum($order_state_counts) : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=0"><?=$states[0]?> (<?=(isset($order_state_counts[0]) ? $order_state_counts[0] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=1"><?=$states[1]?> (<?=(isset($order_state_counts[1]) ? $order_state_counts[1] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=2"><?=$states[2]?> (<?=(isset($order_state_counts[2]) ? $order_state_counts[2] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=3"><?=$states[3]?> (<?=(isset($order_state_counts[3]) ? $order_state_counts[3] : 0)?>)</a>
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
												<div class="col-12 col-md-6 col-lg-7">
													<div class="row">
														<div class="col-12">
															<h5 class="fw-bold">Order #: </h5>
														</div>
														<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
															<?=date("Y-m", strtotime($my_order["date_time"]))?>-<?= str_pad($my_order["order_id"], 6, '0', STR_PAD_LEFT) ?>
														</div>
													</div>
													<div class="row">
														<div class="col-12">
															<h5 class="fw-bold">Date / Time: </h5>
														</div>
														<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
															<?=date("Y-m-d / h:i A", strtotime($my_order["date_time"]))?>
														</div>
													</div>
													<div class="row">
														<div class="col-12">
															<h5 class="fw-bold">Pick Up Date / Time: </h5>
														</div>
														<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
															<?=date("Y-m-d / h:i A", strtotime($my_order["datetime_pickup"]))?>
														</div>
													</div>
													<div class="row mt-2">
														<div class="col-12">
															<h5 class="fw-bold">Order State: </h5>
														</div>
														<?php if ($my_order["state"] == 0): ?>
															<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
																<h5 class="fw-bold pt-2"><?=$states[$my_order["state"]]?></h5>
															</div>
														<?php elseif ($my_order["state"] == 1): ?>
															<div class="col-12 text-center rounded-pill bg-success text-light py-2">
																<h5 class="fw-bold pt-2"><?=$states[$my_order["state"]]?></h5>
															</div>
														<?php elseif ($my_order["state"] == 2): ?>
															<div class="col-12 text-center rounded-pill bg-primary text-light py-2">
																<h5 class="fw-bold pt-2"><?=$states[$my_order["state"]]?></h5>
															</div>
														<?php else: ?>
															<div class="col-12 text-center rounded-pill bg-danger text-light py-2">
																<h5 class="fw-bold pt-2"><?=$states[$my_order["state"]]?></h5>
															</div>
														<?php endif; ?>
													</div>
												</div>
												<div class="col-12 col-md-6 col-lg-5 mt-2">
													<div class="col-12">
														<h5 class="fw-bold">QR Link: </h5>
													</div>
													<div class="col-10 col-md-12 border border-2 mx-auto">
														<img class="w-100" src="<?=base_url()?>uploads/orders/<?=$my_order["img_qr"]?>">
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-12">
													<h5 class="fw-bold">Ordered Item/s: </h5>
												</div>
											</div>
											<div class="row mt-2 justify-content-center">
												<div class="col-12 col-md-10 table-responsive">
													<table class="table table-center table-hover table-bordered">
														<thead>
															<tr>
																<th class="text-center">Item</th>
																<th class="text-center">Qty.</th>
																<th class="text-center">Unit Price</th>
																<th class="text-center">Total Price</th>
																<th class="text-center"></th>
															</tr>
														</thead>
														<tbody>
															<?php $total_qty = 0; $total_price = 0; ?>
															<?php foreach ($order_items->result_array() as $row): ?>
																<tr>
																	<td class="text-center"><?=$this->Model_read->get_product_wid($row["product_id"])->row_array()["name"]?></td>
																	<td class="text-center"><?=$row["qty"]?></td>
																	<?php $total_qty += $row["qty"]; ?>
																	<td class="text-center"><?=number_format($row["price"], 2)?></td>
																	<td class="text-center"><?=number_format($row["qty"] * $row["price"], 2)?></td>
																	<?php $total_price += $row["qty"] * $row["price"]; ?>
																	<td class="text-center">
																		<a class="text-decoration-none" href="<?=base_url();?>product?id=<?=$row['product_id']?>">
																			<button class="btn fw-bold rounded-pill product_btn px-3 py-2">
																				<i class="mdi mdi-eye"></i> View
																			</button>
																		</a>

																		<?php if ($my_order["state"] == 0): ?>
																			<a class="text-decoration-none remove_item" href="<?=base_url();?>remove_item?id=<?=$row['item_id']?>&oid=<?=$order_id?>">
																				<button class="btn btn-danger fw-bold rounded-pill px-3 py-2">
																					<i class="mdi mdi-trash-can"></i>
																				</button>
																			</a>
																		<?php endif; ?>
																	</td>
																</tr>
															<?php endforeach; ?>
															<tr>
																<td class="text-center fw-bold">Total</td>
																<td class="text-center"><?=$total_qty?></td>
																<td class="text-center"></td>
																<td class="text-center"><?=number_format($total_price, 2)?></td>
																<td class="text-center"></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											<?php if ($order_payments->num_rows() > 0): ?>
												<div class="row mt-2">
													<h5 class="fw-bold">Payments:</h5>
												</div>
												<div class="row mt-2 text-center">
													<div class="col-12 table-responsive">
														<table class="table table-center table-hover table-bordered">
															<thead>
																<tr>
																	<th class="text-center">Img</th>
																	<th class="text-center">Date / Time</th>
																	<?php if ($my_order["state"] == 0): ?>
																		<th></th>
																	<?php endif; ?>
																</tr>
															</thead>
															<tbody>
																<?php $total_payment = 0; ?>
																<?php foreach ($order_payments->result_array() as $row): ?>
																	<tr>
																		<td class="col-4 text-center">
																			<?php if($row["img"] != NULL): ?>
																				<img class="img-responsive w-100 item_img" src="<?php
																				if (!empty($row['img'])) {
																					echo base_url(). 'uploads/users/user_'. $user_id .'/payments/order_'. $order_id .'/'. $row["img"];
																				} else {
																					echo base_url(). "assets/img/no_img.png";
																				}
																				?>">
																			<?php else: ?>
																				N/A
																			<?php endif; ?>
																		</td>
																		<td class="text-center"><?=date("Y-m-d / h:i A", strtotime($row["date_time"]))?></td>
																		<?php if ($my_order["state"] == 0): ?>
																			<td>
																				<a class="btn btn-danger rounded-pill remove_payment" href="remove_payment?id=<?=$row['payment_id']?>&oid=<?=$order_id?>">
																					<i class="mdi mdi-trash-can"></i>Remove
																				</a>
																			</td>
																		<?php endif; ?>
																	</tr>
																<?php endforeach; ?>
															</tbody>
														</table>
													</div>
												</div>
											<?php else: ?>
												<hr>
												<div class="row mt-4 mb-5 text-center">
													<h4 class="fw-bold">NO PAYMENT</h4>
												</div>
											<?php endif; ?>

											<?php if ($order_payments->num_rows() < 10): // limit payment to 10 ?>
												<?php if ($my_order["state"] < 2): ?>
													<div class="row mt-2 text-center">
														<a href="my_order_payment?id=<?=$my_order["order_id"]?>" class="btn fw-bold rounded-pill product_btn px-3 py-2">
															<i class="mdi mdi-cash"></i> Add Payment
														</a>
													</div>
												<?php endif; ?>
											<?php endif; ?>

											<?php if ($my_order["state"] == 0): ?>
												<div class="row mt-2 text-center">
													<a href="cancel_order?oid=<?=$my_order["order_id"]?>" id="cancel_order" class="btn btn-danger fw-bold rounded-pill px-3 py-2">
														<i class="mdi mdi-close"></i> Cancel Order
													</a>
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
		$(document).on("click", "#cancel_order", function(e) {
			if (!confirm("Are you sure you want to cancel this order?")) {
				e.preventDefault();
			}
		});
		$(document).on("click", ".remove_payment", function(e) {
			if (!confirm("Are you sure you want to remove this payment?")) {
				e.preventDefault();
			}
		});
		$(document).on("click", ".remove_item", function(e) {
			if (!confirm("Are you sure you want to remove this item?")) {
				e.preventDefault();
			}
		});
	});
</script>
</html>