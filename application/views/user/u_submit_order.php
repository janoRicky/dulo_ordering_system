
<?php
$template_header;
?>
<body>
	<?php $this->load->view("user/template/u_t_api_scripts"); ?>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-12 content pt-2">
					<div class="row justify-content-center my-5 pb-3">
						<div class="col-11 col-lg-10 col-xl-8">
							<?=form_open(base_url() . "place_order", "class='row justify-content-center' method='POST' enctype='multipart/form-data'")?>
								<div class="col-12 col-lg-6 pr-3 d-block d-md-none">
									<div class="card shadow" style="border-radius: 15px; background-color: #ffd500;">
										<div class="card-body row">
											<div class="col-12 col-md-6 text-end">
												<div class="row mt-2 price">
													<div class="col-6 pull-right">
														<h3 class="fw-bold text-end">Grand Total: </h3>
													</div>
													<div class="col-6 pull-left">
														<h3 class="text-start">PHP <?=number_format($grand_total, 2)?></h3>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 col-lg-8 pr-3">
									<div class="row mt-2">
										<div class="col-12">
											<div class="card shadow" style="border-radius: 15px;">
												<div class="card-body mt-2 mx-3">
													<div class="row justify-content-center mt-2 mb-4">
														<div class="col-12 col-md-9 col-lg-6 row rounded shadow p-0 text-center">
															<div class="col-auto rounded-start border border-1 text-light bg-info">
																<i class="mdi mdi-store-outline mdi-36px"></i>
															</div>
															<div class="col rounded-end border border-1 border-start-0 p-2">
																<h4 class="fw-bold">Pick-Up</h4>
															</div>
														</div>
														<div class="col-12 col-md-10 col-lg-8 text-center">
															<div class="bg-secondary text-light px-4 py-2 mt-2" style="border-radius: 10px;">
																<h6 class="fw-bold">Pick-Up on:</h6>
																<span>JDC Compound Beside Palmera 5, Calabarzon, Philippines, Taytay, Philippines</span>
															</div>
														</div>
													</div>
													<h5 class="card-title fw-bold">Pick-Up Time</h5>
													<hr class="my-3 px-5">
													<div class="row justify-content-center item mb-4">
														<div class="col-12 col-md-10 col-lg-7 text-center">
															<div class="row mt-2">
																<div class="col-12">
																	<input type="datetime-local" name="inp_datetime_pickup" value="<?=date('Y-m-d\TH:i:s')?>">
																</div>
															</div>
														</div>
													</div>
													<h5 class="card-title fw-bold">Payment Method</h5>
													<hr class="my-3 px-5">
													<div class="row justify-content-center item mb-4">
														<div class="col-12 col-md-10 col-lg-7 text-center">
															<div class="row mt-2">
																<div class="col-12">
																	<div class="input-group">
																		<span class="input-group-text px-4">
																			<i class="dm_pickup mdi mdi-store-outline mdi-24px d-none"></i>
																			<i class="dm_online mdi mdi-credit-card mdi-24px"></i>
																		</span>
																		<select id="payment_method" name="inp_payment_method" class="form-control fw-bold" style="font-size: 16px;">
																			<option value="0">Payment On Pick-Up</option>
																			<option value="1">Online Payment</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-12 text-center payment" style="display: none;">
															<div class="row mt-2 justify-content-center">
																<div class="col-12 col-md-10 col-lg-8 rounded-pill text-center pt-3 pb-3 mb-4 text-light" style="background-color: #007dfe;">
																	<img class="mb-2" src="https://www.gcash.com/wp-content/uploads/2019/07/gcash-logo.png" alt="GCash">
																	<h5 class="fw-bold">(Send Payment to GCash # 0999999999)</h5>
																</div>
															</div>
															<div class="row mt-2">
																<div class="col-12 text-start">
																	<h6 class="fw-bold">Proof of Payment (Img / Screenshot): </h6>
																</div>
																<div class="col-12">
																	<div class="img_u_box">
																		<input class="d-none img_input" id="product_image" type="file" name="inp_img">
																		<img class="item_img img_u_preview col-12 col-md-8 col-lg-6" role="button" id="image_preview" src="<?=base_url()?>assets/img/no_img.png" data-default="<?=base_url()?>assets/img/no_img.png" data-change="<?=base_url()?>assets/img/change_img.png" style="border: 2px solid #000; border-radius: 5px;">
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
								<div class="col-12 col-lg-8 text-center mt-3">
									<div class="card shadow" style="border-radius: 15px; background-color: #ffd500;">
										<div class="card-body row">
											<div class="col-12 col-md-6 d-none d-md-block text-end">
												<h3 class="fw-bold">Grand Total: </h3>
												<h3 class="">PHP <?=number_format($grand_total, 2)?></h3>
											</div>
											<div class="col-12 col-md-6 text-center text-md-start">
												<button class="btn btn-dark fw-bold px-4 py-3 rounded-pill text-light" type="submit">
													<i class="fa fa-money" aria-hidden="true"></i> Place Order
												</button>
											</div>
										</div>
									</div>
								</div>
							<?=form_close()?>
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


		$("#payment_method").on("change", function() {
			if ($(this).val() == 0) { // online payment
				if ($(".dm_online").hasClass("d-none")) {
					$(".dm_online").toggleClass("d-none");
					$(".dm_pickup").toggleClass("d-none");

					$(".payment").slideUp().fadeOut();
					// $("#ref_no").removeAttr("required");
					// $("#ref_no").val('payment_on_pickup');
				}
			} else { // pickup
				if ($(".dm_pickup").hasClass("d-none")) {
					$(".dm_online").toggleClass("d-none");
					$(".dm_pickup").toggleClass("d-none");

					$(".payment").slideDown().fadeIn();
					// $("#ref_no").attr("required", "");
					// $("#ref_no").val('');

				}
			}
		});
	});
</script>
</html>