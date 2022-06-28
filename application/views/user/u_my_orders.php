
<?php
$template_header;
?>

<style type="text/css">
	.nav_order {
	    overflow-x: scroll;
	}
</style>
<body>
	<?php $this->load->view("user/template/u_t_api_scripts"); ?>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-md-10 col-lg-8 mb-5">
					<div class="card shadow" style="border-radius: 15px;">
						<div class="card-body p-0">
							<div class="row m-0 p-0 justify-content-center pb-4 pt-2">
								<div class="col-12">
									<div class="row my-2 justify-content-center">
										<class class="col-12 col-sm-10 justify-content-center text-center">
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders">ALL (<?=(isset($order_state_counts) ? array_sum($order_state_counts) : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=0"><?=$states[0]?> (<?=(isset($order_state_counts[0]) ? $order_state_counts[0] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=1"><?=$states[1]?> (<?=(isset($order_state_counts[1]) ? $order_state_counts[1] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=2"><?=$states[2]?> (<?=(isset($order_state_counts[2]) ? $order_state_counts[2] : 0)?>)</a>
											<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=3"><?=$states[3]?> (<?=(isset($order_state_counts[3]) ? $order_state_counts[3] : 0)?>)</a>
										</class>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card shadow mt-3" style="border-radius: 15px;">
						<div class="card-body p-0">
							<div class="row m-0 p-0 justify-content-center py-4">
								<div class="col-12">
									<div class="row justify-content-center">
										<div class="col-10 p-4 table-responsive">
											<table id="table_my_orders" class="table">
												<thead>
													<tr>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($my_orders->result_array() as $row): ?>
														<tr>
															<td class="text-center">
																<?=date("Y-m", strtotime($row["date_time"]))?>-<?= str_pad($row["order_id"], 6, '0', STR_PAD_LEFT) ?>
															</td>
															<td class="text-center">
																<?=date("Y-m-d", strtotime($row["date_time"]))?>
															</td>
															<td class="text-center">
																<?php if ($row["state"] == 0): ?>
																	<div class="border border-3 border-secondary text-secondary rounded-pill">
																		<?=$states[$row["state"]]?>
																	</div>
																<?php elseif ($row["state"] == 1): ?>
																	<div class="border border-3 border-success text-success rounded-pill">
																		<?=$states[$row["state"]]?>
																	</div>
																<?php elseif ($row["state"] == 2): ?>
																	<div class="border border-3 border-primary text-primary rounded-pill">
																		<?=$states[$row["state"]]?>
																	</div>
																<?php else: ?>
																	<div class="border border-3 border-danger text-danger rounded-pill">
																		<?=$states[$row["state"]]?>
																	</div>
																<?php endif; ?>
															</td>
															<td class="text-center">
																<?php if ($row["state"] == 0): ?>
																	<a class="btn fw-bold rounded-pill btn-success px-3 py-2 mb-1" href="my_order_payment?id=<?=$row["order_id"]?>">
																		<i class="mdi mdi-cash"></i> Payment
																	</a>
																<?php endif; ?>
																<a class="btn fw-bold rounded-pill product_btn px-3 py-2 mb-1" href="my_order_details?id=<?=$row["order_id"]?>">
																	<i class="mdi mdi-eye"></i> Details
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
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$("#table_my_orders").DataTable({
			"order": [[0, "desc"]],
			"bLengthChange": false,
			createdRow: function (row, data, index) {
				$(row).addClass("order");
			},
			fnDrawCallback: function() {
				$("#table_my_orders thead").remove();
			}
		});
		
		$(document).on("mouseenter", ".scroll.left", function() {
			timer_left = setInterval(function() {
				$(".nav_order").scrollLeft($(".nav_order").scrollLeft() - 10);
			}, 20);
		}).on("mouseleave", ".scroll.left", function() {
			clearInterval(timer_left);
		});
		$(document).on("mouseenter", ".scroll.right", function() {
			timer_right = setInterval(function() {
				$(".nav_order").scrollLeft($(".nav_order").scrollLeft() + 10);
			}, 20);
		}).on("mouseleave", ".scroll.right", function() {
			clearInterval(timer_right);
		});

		$(document).on("click", ".receive", function(e) {
			if (!confirm("Are you sure you want to set this order as RECEIVED?")) {
				e.preventDefault();
			}
		});
	});
</script>
</html>