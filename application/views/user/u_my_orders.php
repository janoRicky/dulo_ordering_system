
<?php
$template_header;
?>

<style type="text/css">
	.nav_order {
	    overflow-x: scroll;
	}
</style>
<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-sm-1"></div>
				<div class="col-12 col-sm-10 content pt-4">
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; My Orders <?=(!is_null($this->input->get("state")) ? "(". $states[$this->input->get("state")] .")" : "")?> &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row my-4">
						<div class="col-1 col-sm-2">
							<a class="scroll left w-100">
								<i class="fa fa-caret-left p-1 pull-right" aria-hidden="true"></i>
							</a>
						</div>
						<class class="col-10 col-sm-8 nav_order justify-content-center">
							<a href="my_orders">ALL (<?=(isset($order_state_counts) ? array_sum($order_state_counts) : 0)?>)</a>
							<a href="my_orders?state=0"><?=$states[0]?> (<?=(isset($order_state_counts[0]) ? $order_state_counts[0] : 0)?>)</a>
							<a href="my_orders?state=1"><?=$states[1]?> (<?=(isset($order_state_counts[1]) ? $order_state_counts[1] : 0)?>)</a>
							<a href="my_orders?state=2"><?=$states[2]?> (<?=(isset($order_state_counts[2]) ? $order_state_counts[2] : 0)?>)</a>
							<a href="my_orders?state=3"><?=$states[3]?> (<?=(isset($order_state_counts[3]) ? $order_state_counts[3] : 0)?>)</a>
							<a href="my_orders?state=4"><?=$states[4]?> (<?=(isset($order_state_counts[4]) ? $order_state_counts[4] : 0)?>)</a>
							<a href="my_orders?state=5"><?=$states[5]?> (<?=(isset($order_state_counts[5]) ? $order_state_counts[5] : 0)?>)</a>
							<a href="my_orders?state=6"><?=$states[6]?> (<?=(isset($order_state_counts[6]) ? $order_state_counts[6] : 0)?>)</a>
						</class>
						<div class="col-1 col-sm-2">
							<a class="scroll right w-100">
								<i class="fa fa-caret-right p-1 pull-left" aria-hidden="true"></i>
							</a>
						</div>
					</div>
					<div class="row">
						<div class="col-1"></div>
						<div class="col-10 p-4">
							<table id="table_my_orders" class="table">
								<thead>
									<tr>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($my_orders->result_array() as $row): ?>
										<tr>
											<td>
												<div class="row order">
													<div class="col-12 col-sm-6 col-lg-3 border p-3">
														<?=date("Y-m-d / H:i:s A", strtotime($row["date_time"]))?>
													</div>
													<div class="col-12 col-sm-6 col-lg-2 border p-3">
														<?=($this->Model_read->is_order_custom($row["order_id"]) ? "<i class='fa fa-list-alt' aria-hidden='true'></i> CUSTOM ORDER" : "<i class='fa fa-list' aria-hidden='true'></i> NORMAL ORDER")?>
													</div>
													<div class="col-12 col-sm-12 col-lg-3 border p-3">
														<?=$row["zip_code"] ." / ". $row["country"] ." / ". $row["province"] ." / ". $row["city"] ." / ". $row["street"] ." / ". $row["address"]?>
													</div>
													<div class="col-12 col-sm-6 col-lg-2 border p-3">
														<?=$states[$row["state"]]?>
													</div>
													<div class="col-12 col-sm-6 col-lg-2 border p-3">
														<?php if ($row["state"] == 1): ?>
															<a href="my_order_payment?id=<?=$row["order_id"]?>">
																<button class="button b_p">
																	<i class="fa fa-money" aria-hidden="true"></i> Payment
																</button>
															</a>
															<?php if ($this->Model_read->get_order_payments_adtl_worder_id($row["order_id"])->num_rows() > 0): ?>
																<a href="my_order_payment_adtl?id=<?=$row["order_id"]?>">
																	<button class="button b_p">
																		<i class="fa fa-money" aria-hidden="true"></i> Adtl. Payment
																	</button>
																</a>
															<?php endif; ?>
														<?php elseif ($row["state"] == 4): ?>
															<a class="receive" href="order_receive?order_id=<?=$row['order_id']?>">
																<button class="button b_p">
																	<i class="fa fa-check" aria-hidden="true"></i> Received
																</button>
															</a>
														<?php endif; ?>
														<a href="my_order_details?id=<?=$row["order_id"]?>">
															<button class="button b_p">
																<i class="fa fa-eye" aria-hidden="true"></i> Details
															</button>
														</a>
													</div>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
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