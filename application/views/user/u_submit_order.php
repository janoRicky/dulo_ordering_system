
<?php
$template_header;
?>
<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-sm-1"></div>
				<div class="col-12 col-sm-10 content py-4">
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; Place Order &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-1 col-sm-2"></div> 
						<div class="col-10 col-sm-8">
							<?=form_open(base_url() . "place_order", "method='POST' enctype='multipart/form-data'")?>
								<div class="row mt-2 price">
									<div class="col-6 pull-right">
										<h3 class="font-weight-bold text-end">Grand Total: </h3>
									</div>
									<div class="col-6 pull-left">
										<h3 class="text-start">PHP <?=number_format($grand_total, 2)?></h3>
									</div>
								</div>
								<div class="row mt-2">
									<h2 class="font-weight-bold">Payment Method</h2>
								</div>
								<div class="row mt-2">
									<span>(Send Payment to GCash # 0999999999)</span>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Ref No: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_ref_no" placeholder="*Ref No" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Proof of Payment (Img / Screenshot): </h5>
									</div>
									<div class="col-8 col-md-9">
										<div class="img_u_box">
											<div class="img_u_change item_img p-3 text-center d-none">
												Change Image
											</div>
											<input class="d-none img_input" id="product_image" type="file" name="inp_img">
											<img class="item_img img_u_preview" id="image_preview" src="<?=base_url()?>assets/img/no_img.png">
										</div>
									</div>
								</div>
								<div class="row mt-2">
									<h2 class="font-weight-bold">Address</h2>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Zip Code: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_zip_code" placeholder="*Zip Code" value="<?=$account_details['zip_code']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Country: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_country" placeholder="*Country" value="<?=$account_details['country']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Province: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_province" placeholder="*Province" value="<?=$account_details['province']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">City: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_city" placeholder="*City" value="<?=$account_details['city']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">Street / Road: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_street" placeholder="*Street/Road" value="<?=$account_details['street']?>" autocomplete="off" required="">
									</div>
								</div>
								<div class="row mt-2">
									<div class="col-4 col-md-3">
										<h5 class="font-weight-bold">House Number / Floor / Bldg. / etc.: </h5>
									</div>
									<div class="col-8 col-md-9">
										<input class="form-control" type="text" name="inp_address" placeholder="House Number/Floor/Bldg./etc." value="<?=$account_details['address']?>" autocomplete="off">
									</div>
								</div>
								<hr>
								<div class="row mt-4 mb-3">
									<div class="col-12 text-center">
										<button class="button b_p b_lg" type="submit">
											<i class="fa fa-money" aria-hidden="true"></i> Place Order
										</button>
									</div>
								</div>
							<?=form_close()?>
						</div>
						<div class="col-1 col-sm-2"></div>
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