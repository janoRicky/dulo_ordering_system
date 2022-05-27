
<?php
$template_header;
?>

<body>
	<div class="wrapper h-100">
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view("admin/template/a_t_sidebar"); ?>
				<?php $this->load->view("admin/template/a_t_navbar", $nav); ?>
				<div class="col-12 text-center">
					<div class="container-fluid p-2 py-5 p-sm-5 justify-content-center">
						
						<div class="row">
							<div class="col-12 text-start">
								<h2>Update Custom Order #<?=$row_info["order_id"]?></h2>
							</div>
							<div class="col-12">
								<?=form_open(base_url() . "admin/order_custom_update", "method='POST' enctype='multipart/form-data'")?>
									<input type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
									<input id="inp_user_id" type="hidden" name="inp_user_id" value="<?=$row_info['user_id']?>">
									<div class="form-group">
										<?php $user_info = $this->Model_read->get_user_acc_wid($row_info["user_id"])->row_array(); ?>
										<label for="inp_user_acc">
											<i id="user_acc_label" class="fa fa-check text-success" aria-hidden="true">[<?=$row_info["user_id"]?>]</i> User Account:
										</label>
										<div class="input-group">
											<input id="user_acc" type="text" class="form-control" name="inp_user_acc" placeholder="User" autocomplete="off" value="[<?=$user_info['user_id']?>] <?=$user_info['name_last']?>, <?=$user_info['name_first']?> <?=($user_info['email'] == NULL ? '(NO ACCOUNT)' : '('. $user_info['email'] .')')?>" data-bs-toggle="dropdown" required="">
											<div class="dropdown-menu dropdown-menu-left user_dropdown w-100"></div>
											<span class="input-group-append">
												<button class="btn btn-secondary btn_clear_acc" type="button">
													<i class="fa fa-times" aria-hidden="true"></i>
												</button>
											</span>
										</div>
									</div>
									<div class="form-group">
										<label for="inp_description">Description:</label>
										<input type="text" class="form-control" name="inp_description" placeholder="*Description" autocomplete="off" value="<?=$row_info['description']?>" required="">
									</div>
									<div class="form-group">
										<label for="inp_date">Date:</label>
										<input type="date" class="form-control" name="inp_date" autocomplete="off" value="<?=date('Y-m-d', strtotime($row_info['date_time']))?>" required="">
									</div>
									<div class="form-group">
										<label for="inp_time">Time:</label>
										<input type="time" class="form-control" name="inp_time" autocomplete="off" value="<?=date('H:i', strtotime($row_info['date_time']))?>" required="">
									</div>
									<div class="form-group">
										<label for="inp_province">Province:</label>
										<input type="text" class="form-control" name="inp_province" id="inp_province" placeholder="*Province" value="<?=$row_info['province']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_city">City:</label>
										<input type="text" class="form-control" name="inp_city" id="inp_city" placeholder="*City" value="<?=$row_info['city']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_street">Street/Road:</label>
										<input type="text" class="form-control" name="inp_street" id="inp_street" placeholder="*Street/Road" value="<?=$row_info['street']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_address">House Number/Floor/Bldg./etc.:</label>
										<input type="text" class="form-control" name="inp_address" id="inp_address" placeholder="House Number/Floor/Bldg./etc." value="<?=$row_info['address']?>" autocomplete="off">
									</div>
									<h4 class="pt-3 text-center fw-bold"> Custom Product Details </h4>
									<input type="hidden" name="inp_product_id" value="<?=$product_info['custom_id']?>">
									<div class="form-group">
										<label for="inp_custom_description">Custom Description:</label>
										<textarea class="form-control" rows="5" style="resize: none;" name="inp_custom_description" placeholder="*" maxlength="2040" required=""><?=$product_info["description"]?></textarea>
									</div>
									<div class="form-group">
										<label for="inp_type_id">Type:</label>
										<select class="form-control" name="inp_type_id" required="">
											<?php foreach ($tbl_types as $key => $val): ?>
												<option value="<?=$key?>" <?=($product_info["type_id"] == $key ? "selected" : "")?>><?=$val?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label for="inp_size">Size:</label>
										<input type="text" class="form-control" name="inp_size" placeholder="*e.g. 12cm" value="<?=$product_info['size']?>" required="">
									</div>
									<div class="form-group container">
										<label for="inp_img">Images:</label>
										<div class="img_container row">
											<?php
											$imgs = explode("/", $product_info["img"]);
											$ctr = 0;
											?>
											<?php foreach ($imgs as $src): ?>
												<?php if ($src != NULL): ?>
													<?php $ctr++; ?>
													<div class="col-12 col-sm-6 col-md-4 col-lg-3 img_box mb-3">
														<div class="img_m_box">
															<input type="file" class="d-none img_input" name="inp_img_<?=$ctr?>">
															<img class="img_m_preview" src="<?=base_url(). 'uploads/custom/custom_'. $product_info["custom_id"] .'/'. $src?>">
															<div class="img_m_change p-3 text-center d-none">
																Change Image
															</div>
															<a class="img_m_remove">
																<i class="fa fa-times fa-lg" aria-hidden="true"></i>
															</a>
															<input type="hidden" class="img_check" name="inp_img_<?=$ctr?>_check" value="<?=$src?>">
														</div>
													</div>
												<?php endif; ?>
											<?php endforeach; ?>
											<?php if ($ctr < 10): ?>
												<div class="col-12 col-sm-6 col-md-4 col-lg-3 img_box mb-3">
													<div class="img_m_box">
														<input type="file" class="d-none img_input no_img" name="inp_img_<?=$ctr + 1?>">
														<img class="img_m_preview" src="<?=base_url()?>assets/img/no_img.png">
														<div class="img_m_change p-3 text-center d-none">
															Change Image
														</div>
														<a class="img_m_remove">
															<i class="fa fa-times fa-lg" aria-hidden="true"></i>
														</a>
														<input type="hidden" class="img_check" name="inp_img_<?=$ctr + 1?>_check" value="<?=$src?>">
													</div>
												</div>
											<?php endif; ?>
										</div>
										<input type="hidden" id="img_count" name="inp_img_count" value="<?=$ctr?>">
									</div>
									<div class="form-group">
										<label for="inp_qty">Ordered Qty:</label>
										<input type="number" class="form-control" name="inp_qty" placeholder="Qty" value="<?=$order_item_info['qty']?>">
									</div>
									<div class="form-group">
										<label for="inp_price">Unit Price:</label>
										<input type="number" class="form-control" name="inp_price" placeholder="Price" step="0.000001" value="<?=$order_item_info['price']?>">
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-primary" value="Update">
									</div>
								<?=form_close()?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("mouseenter", ".img_box", function() {
			var img_prev = $(this).children().children(".img_m_preview");
			var img_change = $(this).children().children(".img_m_change");
			img_change.removeClass("d-none");
			img_change.css({
				top: img_prev.position.top,
				left: img_prev.position.left,
				width: img_prev.outerWidth(),
				height: img_prev.outerHeight()
			});
		}).on("mouseleave", ".img_box", function() {
			$(this).children().children(".img_m_change").addClass("d-none");
		});
		$(document).on("click", ".img_m_change", function() {
			$(this).siblings(".img_input").trigger("click");
		});

		$(document).on("change", ".img_input", function(t) {
			if (t.target.files && t.target.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(t.target.files[0]);
				reader.onload = function(e) {
					$(t.target).siblings(".img_m_preview").attr("src", e.target.result);
					$(t.target).siblings(".img_m_change").addClass("d-none");
				};

				$(".img_box").each(function(index, el) {
					$(this).children().children(".img_input").attr("name", "inp_img_" + (index + 1));
				});

				// add new imgbox
				if ($(".img_box").length < 10 && $(t.target).hasClass("no_img")) {
					$(t.target).removeClass("no_img");

					$(".img_container").append($("<div>").attr({
						class: "col-12 col-sm-6 col-md-4 col-lg-3 img_box mb-3"
					}).append($("<div>").attr({
						class: "img_m_box"
					}).append($("<input>").attr({
						type: "file",
						class: "d-none img_input no_img",
						name: "inp_img_" + ($(".img_box").length + 1)
					})).append($("<img>").attr({
						class: "img_m_preview",
						src: "<?=base_url()?>assets/img/no_img.png"
					})).append($("<div>").attr({
						class: "img_m_change p-3 text-center d-none"
					}).html("Change Image")).append($("<a>").attr({
						class: "img_m_remove"
					}).append($("<input>").attr({
						type: "hidden",
						class: "img_check",
						name: "inp_img_" + ($(".img_box").length + 1) + "_check"
					})).append($("<i>").attr({ class: "fa fa-times fa-lg", "aria-hidden": "true" })))));
					
					$("#img_count").val($(".img_box").length);
				}
			}
		});

		$(document).on("click", ".img_m_remove", function(t) {
			if ($(".img_box").length > 1 && !$(this).siblings(".img_input").hasClass("no_img")) {
				$(this).parent().parent().remove();
			}
			$(".img_box").each(function(index, el) {
				$(this).children().children(".img_input").attr("name", "inp_img_" + (index + 1));
			});
		});

		$("#user_acc").on("keyup focus", function(e) {
			if ($(this).val().length > 0) {
				if (!$(".user_dropdown").hasClass("show")) {
					$("#user_acc").dropdown("toggle");
				}
				$.get("user_search", { dataType: "json", search: $(this).val() })
				.done(function(data) {
					var users = $.parseJSON(data);
					$(".user_dropdown").html("");
					$.each(users, function(index, val) {
						$(".user_dropdown").append($("<a>").attr({ class: "dropdown-item user_item", "user-id": index }).html(val));
					});
				});
			} else {
				if ($(".user_dropdown").hasClass("show")) {
					$("#user_acc").dropdown("toggle");
				}
				$("#inp_user_id").val(null);

				$("#user_acc_label").removeClass("fa-check");
				$("#user_acc_label").addClass("fa-times");
				$("#user_acc_label").removeClass("text-success");
				$("#user_acc_label").addClass("text-danger");
				$("#user_acc_label").html("");
			}
		});
		$(document).on("click", ".user_item", function(t) {
			var id = $(this).attr("user-id");
			if ($(this).html().length > 0) {
				$("#user_acc").val($(this).html());
				$("#inp_user_id").val(id);

				$("#user_acc_label").removeClass("fa-times");
				$("#user_acc_label").addClass("fa-check");
				$("#user_acc_label").removeClass("text-danger");
				$("#user_acc_label").addClass("text-success");
				$("#user_acc_label").html("["+ id +"]");
			}
		});

		$(document).on("click", ".btn_clear_acc", function(t) {
			$("#user_acc").val(null);
			$("#inp_user_id").val(null);

			$("#user_acc_label").removeClass("fa-check");
			$("#user_acc_label").addClass("fa-times");
			$("#user_acc_label").removeClass("text-success");
			$("#user_acc_label").addClass("text-danger");
			$("#user_acc_label").html("");
		});

		$(document).on("click", "#update_order", function(e) {
			if ($("#inp_user_id").val().length < 1) {
				alert("Missing User Account ID.");
				e.preventDefault();
			}
		});
	});
</script>
</html>