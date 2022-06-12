
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
							<div class="col-12 col-sm-6 text-start">
								<h2>View Custom Order #<?=$row_info["order_id"]?></h2>
							</div>
							<div class="col-12 col-sm-6 text-end">
								<a class="btn btn-primary" href="<?=base_url();?>admin/orders_custom_edit?id=<?=$row_info['order_id']?>">
									<i class="fa fa-pencil fa-lg text-warning p-1" aria-hidden="true"></i> Update
								</a>
							</div>
						</div>
						<div class="row view_container">
							<div class="col-12">
								<div class="row mt-2 justify-content-center">
									<div class="col-12">
										<?php
										$user_info = $this->Model_read->get_user_acc_wid($row_info["user_id"])->row_array();
										?>
										<?php if ($user_info["email"] == NULL): ?>
											<label>No Account:</label><br>
											<a href="<?=base_url();?>admin/users_view?id=<?=$row_info["user_id"]?>">
												<i class="fa fa-eye fa-lg text-primary p-1" aria-hidden="true"></i><?=$user_info["name_last"] .", ". $user_info["name_first"] ." ". $user_info["name_middle"] ." ". $user_info["name_extension"]?> [User #<?=$row_info["user_id"]?>]
											</a>
										<?php else: ?>
											<label>User Email:</label><br>
											<a href="<?=base_url();?>admin/users_view?id=<?=$row_info["user_id"]?>">
												<i class="fa fa-eye fa-lg text-primary p-1" aria-hidden="true"></i><?=$user_info["email"]?> [User #<?=$row_info["user_id"]?>]
											</a>
										<?php endif; ?>
									</div>
									<div class="col-12">
										<label>Order Description:</label><br>
										<?=$row_info["description"]?>
									</div>
									<div class="col-12">
										<label>Date / Time:</label><br>
										<?=date("Y-m-d / h:i:s A", strtotime($row_info["date_time"]))?>
									</div>
									<div class="col-12">
										<label>Full Address:</label><br>
										<?=$row_info["province"] ." / ". $row_info["city"] ." / ". $row_info["street"] ." / ". $row_info["address"]?>
									</div>
									<div class="col-12">
										<h4 class="pt-3 text-center fw-bold"> Custom Product Details </h4>
									</div>
									<?php if ($product_info["product_id"] != NULL): ?>
										<div class="col-12">
											<a href="<?=base_url();?>admin/products_view?id=<?=$product_info['product_id']?>">
												<i class="fa fa-eye p-1" aria-hidden="true"> Product #<?=$product_info['product_id']?></i>
											</a>
										</div>
									<?php endif; ?>
									<div class="col-12">
										<label>Custom Description:</label><br>
										<?=$product_info["description"]?>
									</div>
									<div class="col-12 col-md-6">
										<label>Type:</label><br>
										<?php
										if (isset($tbl_types[$product_info["type_id"]])) {
											echo $tbl_types[$product_info["type_id"]];
										} else {
											echo "Deleted Type (Edit Required)";
										}
										?>
									</div>
									<div class="col-12 col-md-6">
										<label>Size:</label><br>
										<?=$product_info["size"]?>
									</div>
									<div class="col-12">
										<label>Reference Images:</label>
									</div>
									<div class="col-12">
										<?php $imgs = explode("/", $product_info["img"]); ?>
										<?php foreach ($imgs as $src): ?>
											<?php if ($src != NULL): ?>
												<div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-3 mx-auto img_m_view">
													<img class="img-responsive img_zoomable" src="
													<?=base_url(). 'uploads/custom/custom_'. $product_info["custom_id"] .'/'. $src?>">
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
									<div class="col-12 col-md-6">
										<label>Qty:</label><br>
										<?=($order_item_info["qty"] != NULL ? $order_item_info["qty"] : "NONE")?>
									</div>
									<div class="col-12 col-md-6">
										<label>Price:</label><br>
										<?=($order_item_info["price"] != NULL ? "PHP ". number_format($order_item_info["price"], 2) : "NONE")?>
									</div>
									<div class="col-12">
										<label>Payments:</label>
										<table id="table_payments" class="table table-striped table-hover table-responsive-md table-bordered">
											<thead>
												<tr>
													<th>ID</th>
													<th>Img</th>
													<th>Date / Time</th>
													<th>Description</th>
													<th>Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php $total_payment = 0; ?>
												<?php if ($tbl_payments->num_rows() < 1): ?>
													<tr>
														<td colspan="6" class="fw-bold">[ EMPTY ]</td>
													</tr>
												<?php else: ?>
													<?php foreach ($tbl_payments->result_array() as $row): ?>
														<tr>
															<td class="id"><?=$row["payment_id"]?></td>
															<td>
																<?php if($row["img"] != NULL): ?>
																	<img class="img-responsive img_row img_zoomable" src="<?php
																	if (!empty($row["img"])) {
																		echo base_url(). 'uploads/users/user_'. $row_info["user_id"] .'/payments/order_'. $row_info["order_id"] .'/'. $row["img"];
																	} else {
																		echo base_url(). "assets/img/no_img.png";
																	}
																	?>">
																<?php endif; ?>
															</td>
															<td class="date_time"><?=$row["date_time"]?></td>
															<td class="description"><?=$row["description"]?></td>
															<td class="amount">
																PHP <span><?=number_format($row["amount"], 2)?></span>
															</td>
															<td>
																<button class="btn btn-primary btn-sm btn_update_payment my-2" data-bs-toggle="modal" data-bs-target="#modal_payment_update" data-id="<?=$row['payment_id']?>">
																	Update
																</button>
															</td>
														</tr>
													<?php endforeach; ?>
													<tr>
														<td class="fw-bold">Total</td>
														<td></td>
														<td></td>
														<td></td>
														<td>
															PHP <?=number_format($total_payment, 2)?>
														</td>
														<td></td>
													</tr>
												<?php endif; ?>
											</tbody>
										</table>
										<button class="btn btn-primary btn-lg my-2" data-bs-toggle="modal" data-bs-target="#modal_payment" data-id="<?=$row_info['order_id']?>">
											Add Payment
										</button>
									</div>
									<div class="col-12">
										<label>Unpaid Payments:</label>
										<table class="table table-striped table-hover table-responsive-md table-bordered">
											<thead>
												<tr>
													<th>ID</th>
													<th>Description</th>
													<th>Amount To Be Paid</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php if ($tbl_payments_unpaid->num_rows() < 1): ?>
													<tr>
														<td colspan="4" class="fw-bold">[ EMPTY ]</td>
													</tr>
												<?php else: ?>
													<?php foreach ($tbl_payments_unpaid->result_array() as $row): ?>
														<tr>
															<td class="id"><?=$row["payment_id"]?></td>
															<td class="description"><?=$row["description"]?></td>
															<td class="amount">
																PHP <span><?=number_format($row["amount"], 2)?></span>
															</td>
															<td>
																<i class="fa fa-trash fa-lg text-danger p-1 btn_delete_payment action_button" data-bs-toggle="modal" data-bs-target="#modal_delete_payment_tbp" data-id="<?=$row['payment_id']?>" aria-hidden="true"></i>
															</td>
														</tr>
													<?php endforeach; ?>
												<?php endif; ?>
											</tbody>
										</table>
										<button class="btn btn-primary btn-lg my-2" data-bs-toggle="modal" data-bs-target="#modal_payment_tbp" data-id="<?=$row_info['order_id']?>">
											Add Payment To Be Paid
										</button>
									</div>
									<div class="col-12">
										<label>Order State:</label><br>
										<?=$states[$row_info["state"]]?><br>
										<button class="btn btn-primary btn-lg btn_state my-2" data-bs-toggle="modal" data-bs-target="#modal_state_order" data-id="<?=$row_info['order_id']?>">State</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="modal_payment" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_add_payment", "method='POST' enctype='multipart/form-data'");?>
					<input type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
					<div class="modal-header">
						<h4 class="modal-title">Add Payment</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Payment Description:</label>
							<textarea class="form-control" rows="3" style="resize: none;" name="inp_description" maxlength="128" placeholder="Description"></textarea>
						</div>
						<div class="form-group text-center">
							<label>Proof of Purchase / Screenshot:</label>
							<input class="form-control mb-1" id="proof_image" type="file" name="inp_img_proof">
							<img class="img_view img_zoomable" id="proof_preview" src="<?=base_url()?>assets/img/no_img.png">
						</div>
						<div class="form-group">
							<label>Date:</label>
							<input type="date" class="form-control" name="inp_date" autocomplete="off" value="<?=date('Y-m-d')?>" required="">
						</div>
						<div class="form-group">
							<label>Time:</label>
							<input type="time" class="form-control" name="inp_time" autocomplete="off" value="<?=date('H:i')?>" required="">
						</div>
						<div class="form-group">
							<label>Amount:</label>
							<input type="number" class="form-control" name="inp_amount" placeholder="*Amount" autocomplete="off" required="" step="0.000001">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" name="payment_submit" value="Submit Payment for Custom Order">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_payment_update" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_update_payment", "method='POST' enctype='multipart/form-data'");?>
					<input type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
					<input class="payment_u_id" type="hidden" name="inp_payment_id">
					<div class="modal-header">
						<h4 class="modal-title">Update Payment</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Payment Description:</label>
							<textarea class="form-control payment_u_description" rows="3" style="resize: none;" name="inp_description" maxlength="128" placeholder="Description"></textarea>
						</div>
						<div class="form-group">
							<label>Date:</label>
							<input type="date" class="form-control payment_u_date" name="inp_date" autocomplete="off" value="<?=date('Y-m-d')?>" required="">
						</div>
						<div class="form-group">
							<label>Time:</label>
							<input type="time" class="form-control payment_u_time" name="inp_time" autocomplete="off" value="<?=date('H:i')?>" required="">
						</div>
						<div class="form-group">
							<label>Amount:</label>
							<input type="number" class="form-control payment_u_amount" name="inp_amount" placeholder="*Price" autocomplete="off" required="" step="0.000001">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" name="payment_submit" value="Update Payment for Custom Order">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_state_order" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_update_state_custom", "method='POST' enctype='multipart/form-data'");?>
					<input type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
					<input type="hidden" name="inp_custom_id" value="<?=$product_info['custom_id']?>">
					<div class="modal-header">
						<h4 class="modal-title">Change State</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>State:</label>
							<select id="state_change" class="form-control" name="inp_state">
								<?php foreach ($states as $key => $val): ?>
									<?php if ((($row_info["state"] == 0 || $row_info["state"] == 1) && ($key < 2 || $key > 5)) || (($row_info["state"] == 1 || $row_info["state"] == 2) && ($key < 4 || $key > 5)) || (($row_info["state"] > 2))): ?>
										<option value="<?=$key?>" <?=($row_info["state"] == $key ? "selected" : "")?>><?=$val?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="state_waiting d-none">
							<div class="form-group">
								<label>Quantity:</label>
								<input type="number" class="form-control state_wp_inp" name="inp_qty_pw" placeholder="*Quantity" autocomplete="off" value="<?=$order_item_info['qty']?>" required="">
							</div>
							<div class="form-group">
								<label>Price:</label>
								<input type="number" class="form-control state_wp_inp" name="inp_price_pw" placeholder="*Price" autocomplete="off" step="0.000001" value="<?=$order_item_info['price']?>" required="">
							</div>
						</div>
						<?php if ($product_info["product_id"] == NULL && $order_item_info['qty'] != "" && $order_item_info['price'] != ""): ?>
							<div class="state_shipped d-none">
								<div class="form-group text-center">
									<label>Image:</label>
									<input class="form-control mb-1" id="product_image" type="file" name="inp_img">
									<img class="img_view img_zoomable" id="image_preview" src="<?=base_url()?>assets/img/no_img.png">
								</div>
								<div class="form-group">
									<label>Name:</label>
									<input type="text" class="form-control state_ts_inp" name="inp_name" placeholder="*Name" autocomplete="off" required="">
								</div>
								<div class="form-group">
									<label>Description:</label>
									<input type="text" class="form-control state_ts_inp" name="inp_description" placeholder="*Description" autocomplete="off" required="">
								</div>
								<div class="form-group">
									<label>Type:</label>
									<select name="inp_type_id" class="form-control state_ts_inp" required="">
										<?php foreach ($tbl_types as $key => $val): ?>
											<option value="<?=$key?>"><?=$val?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label>Price:</label>
									<input type="number" class="form-control state_ts_inp" name="inp_price_ps" placeholder="*Price" autocomplete="off" step="0.000001" value="<?=$order_item_info['price']?>" required="">
								</div>
							</div>
						<?php endif; ?>
						<div class="state_cancelled d-none">
							<div class="form-group text-center">
								<h4 class="text-danger">
									Order state cannot be reverted once it is cancelled.
								</h4>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Update State">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_delete_payment_tbp" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/payment_delete", "method='POST'");?>
					<input id="delete_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Delete Order</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Are you sure you want to delete Payment (TBP) #<span id="delete_id"></span>?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
						<input type="submit" class="btn btn-primary" value="Yes">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_payment_tbp" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/order_add_payment_tbp", "method='POST' enctype='multipart/form-data'");?>
					<input type="hidden" name="inp_id" value="<?=$row_info['order_id']?>">
					<div class="modal-header">
						<h4 class="modal-title">Add Payment</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Payment Description:</label>
							<textarea class="form-control" rows="3" style="resize: none;" name="inp_description" maxlength="128" placeholder="Description"></textarea>
						</div>
						<div class="form-group">
							<label>Amount:</label>
							<input type="number" class="form-control" name="inp_amount" placeholder="*Price" autocomplete="off" required="" step="0.000001">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" name="payment_submit" value="Submit Payment for Custom Order">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {

		$(".btn_delete_payment").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});
		
		$(".btn_state").on("click", function() {
			$("#state_change").trigger("change");
		});

		$(document).on("change", "#state_change", function(e) {
			$(".state_waiting").addClass("d-none");
			$(".state_shipped").addClass("d-none");
			$(".state_cancelled").addClass("d-none");
			$(".state_ts_inp").removeAttr("required");
			$(".state_wp_inp").removeAttr("required");
			if ($(this).val() == "1") {
				$(".state_waiting").removeClass("d-none");
				$(".state_wp_inp").attr("required", true);
			} else if ($(this).val() == "3") {
				$(".state_shipped").removeClass("d-none");
				$(".state_ts_inp").attr("required", true);
			} else if ($(this).val() == "6") {
				$(".state_cancelled").removeClass("d-none");
			}
		});

		$(document).on("change", "#product_image", function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
				reader.onload = function(e) {
					$("#image_preview").attr("src", e.target.result);
				};
			}
		});

		$(document).on("change", "#proof_image", function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
				reader.onload = function(e) {
					$("#proof_preview").attr("src", e.target.result);
				};
			}
		});

		$(document).on("click", ".btn_update_payment", function() {
			var cell = $(this).parent();
			$(".payment_u_id").val(cell.siblings(".id").html());
			$(".payment_u_description").val(cell.siblings(".description").html());
			var date_time = cell.siblings(".date_time").html().split(" ");
			$(".payment_u_date").val(date_time[0]);
			var time = date_time[1].split(":");
			$(".payment_u_time").val(time[0] +":"+ time[1] +":00");
			$(".payment_u_amount").val(cell.siblings(".amount").children("span").html().replace(",", ""));
		});
	});
</script>
</html>