
<?php
$template_header;
?>

<style>
	.img_change {
		position: absolute;
		top: 0;
		left: 0;

		background-color: rgba(0,0,0,0.8);
		color: #fff;
		font-weight: bold;

		cursor: pointer;
	}
	.img_preview {
		object-fit: contain;
		min-height: 10rem;
		max-height: 12rem;
		border: 1px solid #000;
	}
</style>
<body>
	<?php $this->load->view("user/template/u_t_api_scripts"); ?>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-md-10 col-lg-8 mb-2">
					<div class="card shadow mt-3" style="border-radius: 15px;">
						<div class="card-body p-0">
							<div class="row m-0 p-0 justify-content-center py-4">
								<div class="col-12">
									<div class="row">
										<div class="col-12 px-5">
											<button class="btn_link btn btn-primary rounded-pill fw-bold px-4 py-2" data-href="<?=base_url()?>my_order_details?id=<?=$my_order["order_id"]?>">
												< BACK TO ORDER
											</button>
										</div>
									</div>
									<div class="row justify-content-center">
										<div class="col-10 p-4">
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
											<div class="row mt-2">
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
																		<a href="<?=base_url();?>product?id=<?=$row['product_id']?>">
																			<button class="btn fw-bold rounded-pill product_btn px-3 py-2">
																				<i class="mdi mdi-eye"></i> View
																			</button>
																		</a>
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
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-9 col-lg-6 mb-5">
					<div class="card shadow mt-3" style="border-radius: 15px;">
						<div class="card-body p-0">
							<div class="row m-0 p-0 justify-content-center py-4">
								<div class="col-12">
									<?=form_open(base_url() . "payment", "method='POST' enctype='multipart/form-data'")?>
										<input type="hidden" name="inp_order_id" value="<?=$order_id?>" required="">
										<h5 class="card-title fw-bold">Payment</h5>
										<hr class="my-3 px-5">
										<div class="row mt-2 justify-content-center">
											<div class="col-11 col-sm-10 col-md-9 col-lg-8 rounded-pill text-center pt-3 pb-3 mb-4 text-light" style="background-color: #007dfe;">
												<img class="mb-2" src="https://www.gcash.com/wp-content/uploads/2019/07/gcash-logo.png" alt="GCash">
												<h5 class="fw-bold px-1">(Send Payment to GCash # 0999999999)</h5>
											</div>
										</div>
										<div class="row mt-2">
											<div class="col-12 text-center">
												<h6 class="fw-bold">Proof of Payment (Img / Screenshot): </h6>
											</div>
											<div class="col-12 text-center">
												<div class="img_u_box">
													<input class="d-none img_input" id="product_image" type="file" name="inp_img">
													<img class="item_img img_u_preview col-12 col-md-8 col-lg-6" role="button" id="image_preview" src="<?=base_url()?>assets/img/no_img.png" data-default="<?=base_url()?>assets/img/no_img.png" data-change="<?=base_url()?>assets/img/change_img.png" style="border: 2px solid #000; border-radius: 5px;">
												</div>
											</div>
										</div>
										<hr>
										<div class="row mt-4 mb-2">
											<div class="col-12 col-md-6 d-none d-md-block text-end">
												<h3 class="fw-bold">Grand Total: </h3>
												<h3 class="">PHP <?=number_format($total_price, 2)?></h3>
											</div>
											<div class="col-12 col-md-6 text-center text-md-start">
												<button class="btn btn-dark fw-bold px-4 py-3 rounded-pill text-light" type="submit">
													<i class="mdi mdi-cash"></i> Place Order
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
		$(document).on("mouseenter", ".img_u_box", function() {
			var img_prev = $(this).children("#image_preview");
			var img_preview = $(this).children(".img_u_preview");
			img_preview.attr("src", img_preview.attr('data-change'));

			img_preview.css({
				border: '2px dotted #000',
			});
		}).on("mouseleave", ".img_u_box", function() {
			var img_preview = $(this).children(".img_u_preview");
			if (img_preview.attr('data-new') != null) {
				img_preview.attr("src", img_preview.attr('data-new'));
			} else {
				img_preview.attr("src", img_preview.attr('data-default'));
			}

			img_preview.css({
				border: '2px solid #000',
			});
		});

		$(document).on("click", ".img_u_preview", function() {
			$(this).siblings(".img_input").trigger("click");
		});

		$(document).on("change", "#product_image", function(t) {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
				reader.onload = function(e) {
					$("#image_preview").attr("src", e.target.result).attr('data-new', e.target.result);
					$(t.target).siblings(".img_u_change").addClass("d-none");
				};
			}
		});
	});

</script>
</html>