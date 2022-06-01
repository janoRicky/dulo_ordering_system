
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
			<div class="row mb-4 mt-4">
				<div class="col-0 col-sm-1"></div>
				<div class="col-12 col-sm-10 content py-4">
					<?php if ($order_payments->num_rows() > 0): ?>
						<div class="row my-4 alert alert-warning alert-dismissible mx-auto" style="max-width: 80%;">
							<div class="text-center w-100">
								Payment has already been made.<br>Please wait for confirmation if you already paid the right amount.
								<a href="my_order_details?id=<?=$order_id?>">View</a>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
					<?php endif; ?>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="fw-bold"> Custom Order Payment </h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1"></div>
						<div class="col-10">
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="fw-bold">Date / Time: </h5>
								</div>
								<div class="col-8 col-md-9">
									<?=date("Y-m-d / H:i:s A", strtotime($my_order["date_time"]))?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="fw-bold">Full Address: </h5>
								</div>
								<div class="col-8 col-md-9">
									<?=$my_order["province"] ." / ". $my_order["city"] ." / ". $my_order["street"] ." / ". $my_order["address"]?>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-4 col-md-3">
									<h5 class="fw-bold">Order State: </h5>
								</div>
								<div class="col-8 col-md-9">
									<?=$states[$my_order["state"]]?>
								</div>
							</div>
						</div>
						<div class="col-1"></div>
					</div>
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="fw-bold"> Ordered Item/s Details </h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1"></div>
						<div class="col-10">
							<?php if ($type == "CUSTOM"): ?>
								<?php
								$order_item = $order_items->row_array();
								$product_info = $this->Model_read->get_product_custom_wid($order_item["product_id"])->row_array();
								?>
								<div class="row mt-2">
									<div class="col-12">
										<h5 class="fw-bold">Custom Description:</h5>
									</div>
									<div class="col-12 custom_description">
										<?=$product_info["description"]?>
									</div>
									<div class="col-3 col-sm-2">
										<h5 class="fw-bold">Type:</h5>
									</div>
									<div class="col-9 col-sm-4">
										<?=$types[$product_info["type_id"]]?>
									</div>
									<div class="col-3 col-sm-2">
										<h5 class="fw-bold">Size:</h5>
									</div>
									<div class="col-9 col-sm-4">
										<?=$product_info["size"]?>
									</div>
								</div>
								<div class="row mt-1">
									<div class="col-12">
										<h5 class="fw-bold">Reference Images:</h5>
									</div>
									<div class="row mt-1">
										<?php $imgs = explode("/", $product_info["img"]); ?>
										<?php foreach ($imgs as $src): ?>
											<?php if ($src != NULL): ?>
												<div class="col-12 col-sm-6 col-md-4 pb-3 mx-auto">
													<img class="item_img" src="
													<?=base_url(). 'uploads/custom/custom_'. $product_info["custom_id"] .'/'. $src?>">
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="row mt-1">
									<div class="col-3 col-sm-2">
										<h5 class="fw-bold">Qty:</h5>
									</div>
									<div class="col-9 col-sm-4">
										<?=$order_item["qty"]?>
									</div>
									<div class="col-3 col-sm-2">
										<h5 class="fw-bold">Price:</h5>
									</div>
									<div class="col-9 col-sm-4">
										<?=$order_item["price"]?>
									</div>
								</div>
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
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="fw-bold"> Payment Details </h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1"></div>
						<div class="col-10">
							<?=form_open(base_url() . "payment", "method='POST' enctype='multipart/form-data'")?>
								<input type="hidden" name="inp_order_id" value="<?=$order_id?>" required="">
								<div class="row mt-2">
									<span>(Send Payment to GCash # 0999999999)</span>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="fw-bold">Ref No: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_ref_no" placeholder="*Ref No" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="fw-bold">Proof of Payment (Img / Screenshot): </h5>
									</div>
									<div class="col-8 col-md-9">
										<div class="img_u_box">
											<div class="img_u_change item_img p-3 text-center d-none">
												Change Image [REQUIRED]
											</div>
											<input class="d-none img_input" id="product_image" type="file" name="inp_img" required="">
											<img class="item_img img_u_preview" id="image_preview" src="<?=base_url()?>assets/img/no_img.png">
										</div>
									</div>
								</div>
								<hr>
								<div class="row mt-4 mb-3">
									<div class="col-12 text-center">
										<button class="button b_p b_lg" type="submit">
											<i class="fa fa-money" aria-hidden="true"></i> Submit Payment
										</button>
									</div>
								</div>
							<?=form_close()?>
						</div>
						<div class="col-1"></div>
					</div>
				</div>
				<div class="col-0 col-sm-1"></div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("mouseenter", ".img_u_box", function() {
			var img_prev = $(this).children("#image_preview");
			var img_change = $(this).children(".img_u_change");
			img_change.removeClass("d-none");
			img_change.css({
				top: img_prev.position.top,
				left: img_prev.position.left,
				width: img_prev.outerWidth(),
				height: img_prev.outerHeight()
			});
		}).on("mouseleave", ".img_u_box", function() {
			$(this).children(".img_u_change").addClass("d-none");
		});
		$(document).on("click", ".img_u_change", function() {
			$(this).siblings(".img_input").trigger("click");
		});

		$(document).on("change", "#product_image", function(t) {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
				reader.onload = function(e) {
					$("#image_preview").attr("src", e.target.result);
					$(t.target).siblings(".img_u_change").addClass("d-none");
				};
			}
		});
	});

</script>
</html>