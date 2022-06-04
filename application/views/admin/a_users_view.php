
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
							<div class="col-12 col-sm-6 text-start">
								<h2>View User #<?=$row_info["user_id"]?> <?=($row_info["email"] == NULL ? "[NO ACCOUNT]" : "")?></h2>
							</div>
							<div class="col-12 col-sm-6 text-end">
								<a class="btn btn-primary" href="<?=base_url();?>admin/users_edit?id=<?=$row_info['user_id']?>">
									<i class="fa fa-pencil fa-lg text-warning p-1" aria-hidden="true"></i> Update
								</a>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto view_container">
							<?php if ($row_info["email"] != NULL): ?>
								<div class="col-12 col-sm-6 text-end">
									<a href="<?=base_url();?>admin/messaging_view?id=<?=$row_info['user_id']?>">
										<button class="btn btn-primary fw-bold">
											<i class="fa fa-comments-o p-1" aria-hidden="true"></i> Messaging
										</button>
									</a>
								</div>
							<?php endif; ?>
							<div class="col-12">
								<div class="row mt-2">
									<?php if ($row_info["email"] != NULL): ?>
										<div class="col-12 col-md-6 row border-0">
											<div class="col-12 col-md-4">
												<label>Email:</label>
											</div>
											<div class="col-12 col-md-8">
												<?=$row_info["email"]?>
											</div>
										</div><br>
									<?php endif; ?>
									<div class="col-12 col-md-6 row border-0">
										<div class="col-12 col-md-4">
											<label>Full Name:</label>
										</div>
										<div class="col-12 col-md-8">
											<?=$row_info["name_last"] .", ". $row_info["name_first"] ." ". $row_info["name_middle"] ." ". $row_info["name_extension"]?>
										</div>
									</div>
									<div class="col-12 col-md-6 row border-0">
										<div class="col-12 col-md-4">
											<label>Gender:</label>
										</div>
										<div class="col-12 col-md-8">
											<?=strtoupper($row_info["gender"])?>
										</div>
									</div>
									<div class="col-12 col-md-6 row border-0">
										<div class="col-12 col-md-4">
											<label>Contact #:</label>
										</div>
										<div class="col-12 col-md-8">
											<?=$row_info["contact_num"]?>
										</div>
									</div>
									<div class="col-12 col-md-6 row border-0">
										<div class="col-12 col-md-4">
											<label>Full Address:</label>
										</div>
										<div class="col-12 col-md-8">
											<?=$row_info["province"] ." / ". $row_info["city"] ." / ". $row_info["street"] ." / ". $row_info["address"]?>
										</div>
									</div>
									<div class="col-12">
										<label>User Orders:</label><br>
										<table id="table_orders" class="table table-striped table-hover table-responsive-md table-bordered">
											<thead>
												<tr>
													<th>ID</th>
													<th>Date / Time</th>
													<th>Order Type</th>
													<th>Ordered Qty.</th>
													<th>Ordered Price</th>
													<th>State</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($tbl_orders->result_array() as $row): ?>
													<?php
													$order_type = ($this->Model_read->is_order_custom($row["order_id"]) ? "CUSTOM" : "NORMAL");
													if ($order_type == "NORMAL") {
														$total_qty = 0;
														$total_price = 0;
														foreach ($this->Model_read->get_order_items_qty_price_worder_id($row["order_id"])->result_array() as $item) {
															$total_qty += $item["qty"];
															$total_price += $item["qty"] * $item["price"];
														}
													} else {
														$order_item_info = $this->Model_read->get_order_items_worder_id($row["order_id"])->row_array();
													}
													?>
													<tr class="text-center align-middle">
														<td>
															<?=$row["order_id"]?>
														</td>
														<td>
															<?=date("Y-m-d / h:i:s A", strtotime($row["date_time"]))?>
														</td>
														<td>
															<?=$order_type?>
														</td>
														<td class="qty">
															<?php if ($order_type == "NORMAL"): ?>
																<?=$total_qty?>
															<?php else: ?>
																<?=($order_item_info["qty"] != NULL ? $order_item_info["qty"] : "NONE")?>
															<?php endif; ?>
														</td>
														<td>
															<?php if ($order_type == "NORMAL"): ?>
																PHP <?=number_format($total_price, 2)?>
															<?php else: ?>
																<?=($order_item_info["price"] != NULL ? "PHP ". number_format($order_item_info["price"], 2) : "NONE")?>
															<?php endif; ?>
														</td>
														<td>
															<?=$states[$row["state"]]?>
														</td>
														<td>
															<a class="btn btn-primary" href="<?=base_url()?>admin/orders<?=($order_type == "CUSTOM" ? "_custom" : "")?>_view?id=<?=$row['order_id']?>">
																<i class="mdi mdi-eye"></i> View
															</a>
														</td>
													</tr>
												<?php endforeach; ?>
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
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$("#table_orders").DataTable({ "order": [[0, "desc"]] });
	});
</script>
</html>