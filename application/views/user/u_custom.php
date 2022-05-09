
<?php
$template_header;
?>

<style>
	.img_remove {
		position: absolute;
		top: 0;
		right: 0;
		color: #ff0000 !important;
		cursor: pointer;
		padding: 1rem;
	}
	.img_remove:hover {
		color: #ffc0c0 !important;
	}
</style>
<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-sm-1"></div>
				<div class="col-12 col-sm-10 content pt-4 pb-4">
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h3 class="font-weight-bold">&bull; Custom Product Details &bull;</h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<?=form_open(base_url() . "place_custom_order", "method='POST' enctype='multipart/form-data'")?>
							<div class="row">
								<div class="col-1"></div>
								<div class="col-10">
									<div class="row mt-2">
										<div class="col-12">
											<h5 class="font-weight-bold">Description: </h5>
										</div>
										<div class="col-12">
											<textarea class="form-control" rows="5" style="resize: none;" name="inp_description" placeholder="*e.g. based on [character], 2 pieces/copies, etc." maxlength="2040" required=""></textarea>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-12 col-sm-6">
											<h5 class="font-weight-bold">Type: </h5>
											<select class="form-control" name="inp_type_id" required="">
												<?php foreach ($types as $key => $val): ?>
													<option value="<?=$key?>"><?=$val?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-12 col-sm-6">
											<h5 class="font-weight-bold">Size: </h5>
											<input class="form-control" type="text" name="inp_size" placeholder="*e.g. 12cm" required="">
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-12">
											<input id="img_count" type="hidden" name="inp_img_count" value="0" required="">
											<h5 class="font-weight-bold">Image Reference/s: </h5>
											<div class="img_container row">
												<div class="col-12 col-sm-6 col-md-4 img_box mb-3">
													<div class="img_u_box">
														<input type="file" class="d-none img_input no_img" name="inp_img_1" required="">
														<img class="item_img img_preview" src="<?=base_url()?>assets/img/no_img.png">
														<div class="img_u_change item_img p-3 text-center d-none">
															Change Image
														</div>
														<a class="img_remove">
															<i class="fa fa-times fa-lg" aria-hidden="true"></i>
														</a>
														<input type="hidden" class="img_check" name="inp_img_1_check" required="">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-4 mb-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h3 class="font-weight-bold">&bull; Shipping Details &bull;</h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="row">
								<div class="col-1"></div>
								<div class="col-10">
									<div class="row mt-2 align-items-center">
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">Zip Code: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_zip_code" placeholder="*Zip Code" value="<?=$account_details['zip_code']?>" required="" autocomplete="off">
										</div>
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">Country: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_country" placeholder="*Country" value="<?=$account_details['country']?>" required="" autocomplete="off">
										</div>
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">Province: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_province" placeholder="*Province" value="<?=$account_details['province']?>" required="" autocomplete="off">
										</div>
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">City: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_city" placeholder="*City" value="<?=$account_details['city']?>" autocomplet required=""e="off">
										</div>
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">Street / Road: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_street" placeholder="*Street/Road" value="<?=$account_details['street']?>" required="" autocomplete="off">
										</div>
										<div class="col-4 col-md-2 my-3">
											<h5 class="font-weight-bold">House Number / Floor / Bldg. / etc.: </h5>
										</div>
										<div class="col-8 col-md-4">
											<input class="form-control" type="text" name="inp_address" placeholder="House Number/Floor/Bldg./etc." value="<?=$account_details['address']?>" autocomplete="off">
										</div>
									</div>
									<hr>
									<div class="row mt-4 mb-3">
										<div class="col-12 text-center">
											<button class="button b_p b_lg" type="submit">
												<i class="fa fa-send" aria-hidden="true"></i> Place Order
											</button>
										</div>
									</div>
								</div>
								<div class="col-1"></div>
							</div>
							<?=form_close()?>
						</div>
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
		$(document).on("mouseenter", ".img_box", function() {
			var img_prev = $(this).children().children(".img_preview");
			var img_change = $(this).children().children(".img_u_change");
			img_change.removeClass("d-none");
			img_change.css({
				top: img_prev.position.top,
				left: img_prev.position.left,
				width: img_prev.outerWidth(),
				height: img_prev.outerHeight()
			});
		}).on("mouseleave", ".img_box", function() {
			$(this).children().children(".img_u_change").addClass("d-none");
		});
		$(document).on("click", ".img_u_change", function() {
			$(this).siblings(".img_input").trigger("click");
		});

		$(document).on("change", ".img_input", function(t) {
			if (t.target.files && t.target.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(t.target.files[0]);
				reader.onload = function(e) {
					$(t.target).siblings(".img_preview").attr("src", e.target.result);
					$(t.target).siblings(".img_u_change").addClass("d-none");
				};

				$(".img_box").each(function(index, el) {
					$(this).children().children(".img_input").attr("name", "inp_img_" + (index + 1));
				});

				// add new imgbox
				if ($(".img_box").length < 10 && $(t.target).hasClass("no_img")) {
					$(t.target).removeClass("no_img");

					$(".img_container").append($("<div>").attr({
						class: "col-12 col-sm-6 col-md-4 img_box mb-3"
					}).append($("<div>").attr({
						class: "img_u_box"
					}).append($("<input>").attr({
						type: "file",
						class: "d-none img_input no_img",
						name: "inp_img_" + ($(".img_box").length + 1)
					})).append($("<img>").attr({
						class: "item_img img_preview",
						src: "<?=base_url()?>assets/img/no_img.png"
					})).append($("<div>").attr({
						class: "img_u_change item_img p-3 text-center d-none"
					}).html("Change Image")).append($("<a>").attr({
						class: "img_remove"
					}).append($("<i>").attr({ class: "fa fa-times fa-lg", "aria-hidden": "true" })))));
					
					$("#img_count").val($(".img_box").length);
				}
			}
		});

		$(document).on("click", ".img_remove", function(t) {
			if ($(".img_box").length > 1 && !$(this).siblings(".img_input").hasClass("no_img")) {
				$(this).parent().parent().remove();
			}
			$(".img_box").each(function(index, el) {
				$(this).children().children(".img_input").attr("name", "inp_img_" + (index + 1));
			});
		});
	});
</script>
</html>