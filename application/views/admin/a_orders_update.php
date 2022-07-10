
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
						
						<div class="row py-3 col-12 col-md-9 mx-auto border-bottom mb-4 title_bar">
							<div class="col-12 text-start">
								<h2>Update Order #<?=$row_info["order_id"]?></h2>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto">
							<div class="col-12">
								<?=form_open(base_url() . "admin/order_update", "class='row' method='POST'"); ?>
									<input type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
									<input id="inp_user_id" type="hidden" name="inp_user_id" value="<?=$row_info['user_id']?>">
									<div class="col-12 col-md-6 text-start pb-3">
										<?php $user_info = $this->Model_read->get_user_acc_wid($row_info["user_id"])->row_array(); ?>
										<label for="inp_user_acc">
											<i id="user_acc_label" class="fa fa-check text-success" aria-hidden="true">[<?=$row_info["user_id"]?>]</i> User Account:
										</label>
										<div class="input-group">
											<input id="user_acc" type="text" class="form-control" name="inp_user_acc" placeholder="User" autocomplete="off" value="[<?=$user_info['user_id']?>] <?=$user_info['name_last']?>, <?=$user_info['name_first']?> <?=($user_info['email'] == NULL ? '(NO ACCOUNT)' : '('. $user_info['email'] .')')?>" data-bs-toggle="dropdown" required="">
											<div class="dropdown-menu dropdown-menu-left user_dropdown w-100"></div>
											<span class="input-group-append">
												<button class="btn btn-danger btn_clear_acc" type="button">
													<i class="fa fa-times" aria-hidden="true"></i>
												</button>
											</span>
										</div>
									</div>
									<div class="col-12 col-md-6 text-start pb-3">
										<label for="inp_description">Description:</label>
										<textarea class="form-control" name="inp_description" placeholder="Description"><?=$row_info['description']?></textarea>
									</div>
									<div class="col-12 col-md-3 text-start pb-3">
										<label for="inp_description">Pick-Up Time:</label>
										<input type="datetime-local" class="form-control" name="inp_datetime_pickup" value="<?=date('Y-m-d\TH:i', strtotime($row_info['date_time']))?>" required="">
									</div>
									<div class="col-12 col-md-3 text-start pb-3">
										<label for="inp_date">Date:</label>
										<input type="date" class="form-control" name="inp_date" autocomplete="off" value="<?=date('Y-m-d', strtotime($row_info['date_time']))?>" required="">
									</div>
									<div class="col-12 col-md-3 text-start pb-3">
										<label for="inp_time">Time:</label>
										<input type="time" class="form-control" name="inp_time" autocomplete="off" value="<?=date('H:i', strtotime($row_info['date_time']))?>" required="">
									</div>
									<div class="form-group">
										<label for="inp_time">Ordered Items:</label>
										<input id="items_no" type="hidden" name="items_no" value="<?=$tbl_order_items->num_rows()?>" required="">
										<table id="table_items" class="table table-striped table-hover table-responsive-md table-bordered">
											<thead>
												<tr>
													<th>Item</th>
													<th>Qty Available</th>
													<th>Qty.</th>
													<th>Price</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($tbl_order_items->result_array() as $key => $row): ?>
													<tr class="order_row item_product_<?=$row["product_id"]?>">
														<?php
														$product = $this->Model_read->get_product_wid($row["product_id"])->row_array();
														?>
														<td class="name">
															<input type="hidden" name="item_<?=$key + 1?>_id" value="<?=$row["product_id"]?>">
															<?=$product["name"]?>
														</td>
														<td>
															<?=$product["qty"]?>
														</td>
														<td>
															<input class="item_qty" type="number" name="item_<?=$key + 1?>_qty" min="0" value="<?=$row["qty"]?>">
														</td>
														<td class="item_price">
															<input type="hidden" name="item_<?=$key + 1?>_price" value="<?=$row["price"]?>">
															<span><?=$row["price"] * $row["qty"]?></span>
														</td>
														<td>
															<button type="button" class="btn btn-sm btn-primary btn_remove_item">Remove</button>
														</td>
													</tr>
												<?php endforeach; ?>
												<tr id="total_info">
													<td>Total</td>
													<td></td>
													<td id="total_qty">0</td>
													<td id="total_price">0.00</td>
													<td>
														<button id="btn_remove_all" type="button" class="btn btn-sm btn-primary">Remove All</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="form-group border px-3 py-2" style="background-color: #f1f1f1">
										<label for="inp_time">Products:</label>
										<table id="table_products" class="table table-striped table-hover table-responsive-md table-bordered">
											<thead>
												<tr>
													<th>Name</th>
													<th>Image</th>
													<th>Type</th>
													<th>Qty</th>
													<th>Price</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($tbl_products->result_array() as $row): ?>
													<tr id="product_<?=$row["product_id"]?>" class="text-center align-middle">
														<td class="name">
															<?=$row["name"]?>
														</td>
														<td>
															<img class="img-responsive img_row img_zoomable" src="<?php
															if (!empty($row["img"])) {
																echo base_url(). 'uploads/products/product_'. $row["product_id"] .'/'. $row["img"];
															} else {
																echo base_url(). "assets/img/no_img.png";
															}
															?>">
														</td>
														<td class="type">
															<?php
															if (isset($tbl_types[$row["type_id"]])) {
																echo $tbl_types[$row["type_id"]];
															} else {
																echo "Deleted Type (Edit Required)";
															}
															?>
														</td>
														<td class="qty">
															<?=$row["qty"]?>
														</td>
														<td class="price">
															<?=$row["price"]?>
														</td>
														<td>
															<button class="btn btn-sm btn-primary btn_add_to_items" type="button" data-id="<?=$row['product_id']?>">Add</button>
														</td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-primary" value="Update" id="update_order">
									</div>
								<?=form_close(); ?>
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

		total();

		$(".btn_add_to_items").on("click", function() {
			var p_id = $(this).attr("data-id");
			var $item_product = $(".item_product_" + p_id);
			
			if ($item_product.length < 1) {
				var ctr = parseInt($("#items_no").val()) + 1;
				var $product = $("#product_" + p_id);

				var $description = $("<td>").append($("<input>").attr({
					type: "hidden",
					name: "item_" + ctr + "_id",
					value: $.trim(p_id)
				})).append($product.children(".name").html());
				var $qty_available = $("<td>").html($product.children(".qty").html());
				var $qty = $("<td>").append($("<input>").attr({
					class: "item_qty",
					type: "number",
					name: "item_" + ctr + "_qty",
					min: "0",
					value: "0"
				}));
				var $price = $("<td>").append($("<input>").attr({
					type: "hidden",
					name: "item_" + ctr + "_price",
					value: $.trim($product.children(".price").html())
				})).append($("<span>")).attr("class", "item_price");
				var $action = $("<td>").append($("<button>").attr({
					type: "button",
					class: "btn btn-sm btn-primary btn_remove_item"
				}).html("Remove"));

				$("#total_info").before($("<tr>")
					.append($description)
					.append($qty_available)
					.append($qty)
					.append($price)
					.append($action).attr({
						id: "item_" + ctr,
						class: "item_product_" + p_id + " order_row"
					}));

				$("#items_no").val(ctr);
				$(".item_product_" + p_id).find(".item_qty").trigger("change");
			} else {
				var item_qty = $item_product.find(".item_qty");
				if (item_qty.val() < parseInt(item_qty.attr("max"))) {
					item_qty.val(parseInt(item_qty.val()) + 1);
					$(item_qty).trigger("change");
				}
			}
		});

		function total() {
			var total_qty = 0;
			var total_price = 0;
			if ($(".order_row").length > 0) {
				$(".item_qty").each(function(index, el) {
					total_qty += parseInt($(this).val());
				});
				$(".item_price > span").each(function(index, el) {
					total_price += parseFloat($(this).html());
				});
			}
			$("#total_qty").html(total_qty);
			$("#total_price").html(total_price.toFixed(2));
		}
		$(document).on("click", ".btn_remove_item", function() {
			$(this).parents("tr").remove();

			if ($(".order_row").length > 0) {
				var $item_qty = $(this).parents("tr").find(".item_qty");
				$(".item_qty").trigger("change");
			} else {
				$("#items_no").val(0);
				total();
			}
		});
		$(document).on("click", "#btn_remove_all", function() {
			$(".order_row").each(function(index, el) {
				$(el).remove();
			});
			
			$("#items_no").val(0);
			total();
		});

		$(document).on("change", ".item_qty", function(e) {
			var $item_price = $(e.target).parents("tr").children(".item_price");
			$item_price.children("span").html(parseFloat($(e.target).val() * $item_price.children("input").val()).toFixed(2));
			total();
		});

		$("#table_products").DataTable();

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
			if ($("#items_no").val() < 1 || $("#items_no").val().length < 1) {
				alert("Missing Ordered Items.");
				e.preventDefault();
			}
			if ($("#inp_user_id").val().length < 1) {
				alert("Missing User Account ID.");
				e.preventDefault();
			}
		});
	});
</script>
</html>