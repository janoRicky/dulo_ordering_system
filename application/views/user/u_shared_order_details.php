
<?php
$template_header;
?>

<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-md-10 col-lg-8 mb-5">
					<div class="card shadow mt-3" style="border-radius: 15px;">
						<div class="card-body p-0">
							<div class="row m-0 p-0 justify-content-center py-4">
								<div class="col-12">
									<div class="row justify-content-center">
										<div class="col-10 p-4">
											<div class="row">
												<div class="col-12">
													<h5 class="fw-bold">Date Ordered:</h5>
												</div>
												<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
													<?=date("Y-m-d", strtotime($my_order["date_time"]))?>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-12">
													<h5 class="fw-bold">Ordered Item/s: </h5>
												</div>
											</div>
											<div class="row mt-2 justify-content-center">
												<div class="col-12 col-md-10">
													<?php foreach ($order_items->result_array() as $row): ?>
														<?php
														$item = $this->Model_read->get_product_wid_user($row["product_id"]);

														if ($item->num_rows() > 0):
															$item_info = $item->row_array();
															?>
															<div class="card shadow mb-3" style="border-radius: 15px;">
																<div class="card-body m-2">
																	<div class="row align-items-center item">
																		<div class="col-12 col-xl-5 mb-2 mb-xl-0">
																			<a href="<?=base_url()?>product?id=<?=$item_info['product_id']?>" class="text-dark">
																				<img class="product_img img-fluid w-100" style="height: 300px; object-fit: cover;" src="<?php
																				if (!empty($item_info["img"])) {
																					echo base_url(). 'uploads/products/product_'. $item_info["product_id"] .'/'. explode("/", $item_info["img"])[0];
																				} else {
																					echo base_url(). "assets/img/no_img.png";
																				}
																				?>">
																			</a>
																		</div>
																		<div class="col-12 col-xl-7">
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
																							<label class="rounded-pill bg-secondary pt-2 px-3 text-light mb-1">
																								<h6 class="fw-bold">Qty: <span class="fw-normal ms-2"><?=$row["qty"]?></span></h6>
																							</label>
																							<label class="rounded-pill bg-secondary pt-2 px-3 text-light">
																								<h6 class="fw-bold">Total: <span class="fw-normal ms-2">PHP <?=number_format($row["price"] * $row["qty"], 2)?></span></h6>
																							</label>
																						</div>
																					</div>
																				</div>
																				<div class="col-12 col-md-5 text-center text-sm-end">
																					<h5 class="fw-bold price">
																						PHP <?=number_format($row["price"], 2)?>
																					</h5>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-12 text-center text-sm-end pt-2">
																					<a class="text-decoration-none btn btn-info fw-bold rounded-pill px-3 py-2 mb-2" href="<?=base_url();?>product?id=<?=$row['product_id']?>" target="_blank">
																						<i class="mdi mdi-eye"></i> View
																					</a>
																					<a class="text-decoration-none btn fw-bold px-4 py-3 rounded-pill product_btn" href="<?=base_url();?>to_cart?id=<?=$row['product_id']?>&amount=1&submit=STC" role="button">
																						<i class="mdi mdi-cart-arrow-down"></i> Add To Cart
																					</a>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php endif; ?>
													<?php endforeach; ?>
												</div>
											</div>
											<div class="row mt-2 justify-content-center">
												<div class="col-12 col-sm-5 col-md-4">
													<div class="col-12">
														<h5 class="fw-bold">QR Link: </h5>
													</div>
													<div class="col-12 border border-2">
														<img class="w-100" src="<?=base_url()?>uploads/orders/<?=$my_order["img_qr"]?>">
													</div>
												</div>
												<div class="col-12 col-sm-7 col-md-8">
													<div class="row mt-2 justify-content-center">
														<div class="col-12">
															<h5 class="fw-bold">Order Summary: </h5>
														</div>
														<div class="col-12 col-md-10 table-responsive">
															<table class="table table-center table-hover table-bordered">
																<thead>
																	<tr>
																		<th class="text-center">Item</th>
																		<th class="text-center">Qty.</th>
																		<th class="text-center">Unit Price</th>
																		<th class="text-center">Total Price</th>
																	</tr>
																</thead>
																<tbody>
																	<?php $total_qty = 0; $total_price = 0; ?>
																	<?php foreach ($order_items->result_array() as $row): ?>
																		<?php
																		$item = $this->Model_read->get_product_wid_user($row["product_id"]);

																		if ($item->num_rows() > 0):
																			$item_info = $item->row_array();
																			?>
																			<tr>
																				<td class="text-center"><?=$item_info["name"]?></td>
																				<td class="text-center"><?=$row["qty"]?></td>
																				<?php $total_qty += $row["qty"]; ?>
																				<td class="text-center"><?=number_format($row["price"], 2)?></td>
																				<td class="text-center"><?=number_format($row["qty"] * $row["price"], 2)?></td>
																				<?php $total_price += $row["qty"] * $row["price"]; ?>
																			</tr>
																		<?php endif; ?>
																	<?php endforeach; ?>
																	<tr>
																		<td class="text-center">Total</td>
																		<td class="text-center"><?=$total_qty?></td>
																		<td class="text-center"></td>
																		<td class="text-center"><?=number_format($total_price, 2)?></td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
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
	});
</script>
</html>