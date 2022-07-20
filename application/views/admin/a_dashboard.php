
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
						
						<div class="row py-3 col-12 col-md-9 mx-auto mb-4 title_bar">
							<div class="col-12">
								<h3 class="fw-bold" class="p-3">Welcome Admin <?=$this->session->userdata("admin_name")?>!</h3>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto">
							<div class="col-12 col-md-8 mt-2">
								<div class="row">
									<div class="col-12">
										<h5 class="fw-bold">
											<i class="fa fa-calendar" aria-hidden="true"></i> Total New Orders This Month (<?=date("M")?>)
										</h5>
									</div>
									<div class="col-12 mx-auto">
										<canvas id="lineChart" height="200"></canvas>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="col-12 mt-5">
									<div class="card">
										<a href="orders">
											<h5 class="card-header fw-bold py-3">
												<i class="fa fa-list fa-lg" aria-hidden="true"></i> Current Orders
											</h5>
										</a>
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-12 my-2">
													<a href="orders?state=0">
														<div class="card text-center bg-secondary text-light py-3 px-2">
															<h6 class="my-auto fw-bold">PENDING (<?=$regular_count_0?>)</h6>
														</div>
													</a>
												</div>
												<div class="col-12 my-2">
													<a href="orders?state=1">
														<div class="card text-center bg-success text-light py-3 px-2">
															<h6 class="my-auto fw-bold">ACCEPTED (<?=$regular_count_1?>)</h6>
														</div>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12 mt-4">
									<a href="products">
										<div class="card bg-warning text-light py-3">
											<div>
												<i class="fa fa-shopping-bag fa-3x" style="position: absolute; left: 1em; color: rgba(255,255,255, 0.4);"></i>
											</div>
											<span class="card-title fw-bold" style="font-size: 1.5em; z-index: 10; color: #fff;">
												Products (<?=$products_count?>)
											</span>
										</div>
									</a>
								</div>
								<div class="col-12 mt-4">
									<a href="products">
										<div class="card bg-info text-light py-3">
											<div>
												<i class="fa fa-tags fa-3x" style="position: absolute; left: 1em; color: rgba(255,255,255, 0.4);"></i>
											</div>
											<span class="card-title fw-bold" style="font-size: 1.5em; z-index: 10; color: #fff;">
												Types (<?=$types_count?>)
											</span>
										</div>
									</a>
								</div>
								<div class="col-12 mt-4">
									<a href="products">
										<div class="card bg-primary text-light py-3">
											<div>
												<i class="fa fa-users fa-3x" style="position: absolute; left: 1em; color: rgba(255,255,255, 0.4);"></i>
											</div>
											<span class="card-title fw-bold" style="font-size: 1.5em; z-index: 10; color: #fff;">
												Users (<?=$users_count?>)
											</span>
										</div>
									</a>
								</div>
							</div>


							<hr class="my-3">
							<?php
							$from = $this->input->get("from") ? $this->input->get("from") : date('Y-m-01');
							$to = $this->input->get("to") ? $this->input->get("to") : date('Y-m-t');



							$best_selling = $this->Model_read->get_best_selling_products($from,$to);

							// print_r($best_selling->result_array());


							?>
							<div class="col-12 col-md-8 mx-auto" style="margin-top: 60px; margin-bottom: 300px;">
								<div class="row">
									<div class="col-12">
										<?=form_open(base_url() . "admin/dashboard", "method='GET'"); ?>
											<h4 class="fw-bold">
												<i class="fa fa-bar-chart" aria-hidden="true"></i> 
												Best Selling Products From 
												<small><input class="text-center" type="date" name="from" value="<?=$from?>"></small>
												 To 
												<small><input class="text-center" type="date" name="to" value="<?=$to?>"></small>
												<button class="btn btn-primary btn-sm" type="submit" value=""> View</button>
											</h4>
										<?=form_close(); ?>
									</div>
									<div class="col-12 mx-auto">
										<div class="table-responsive table-striped table-hover table-bordered">
											<table id="table_main" class="table table-hover table-responsive-md">
												<tbody>
													<?php foreach ($best_selling->result_array() as $key => $row):
														$product = $this->Model_read->get_product_wid($row["product_id"]);
														if ($product->num_rows() > 0):
															$product_info = $product->row_array(); ?>
															<tr class="text-center align-middle">
																<td class="text-center">
																	<h3 class="fw-bold">
																		#<?=$key+1?>
																	</h3>
																</td>
																<td>
																	<img class="img-responsive img_row img_zoomable" src="<?php
																	if (!empty($product_info["img"])) {
																		echo base_url(). 'uploads/products/product_'. $product_info["product_id"] .'/'. $product_info["img"];
																	} else {
																		echo base_url(). "assets/img/no_img.png";
																	}
																	?>">
																</td>
																<td>
																	<h5 class="fw-bold"><?=$product_info["name"]?></h5>
																	<h4 class="fw-bold"><?=$row["tot_qty"]?> <small>Sold</small></h4>
																</td>
															</tr>
													<?php endif;
													endforeach; ?>
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
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {

		$(".side_link.dashboard").addClass("active");

		<?php
		$arr_regular = array();
		foreach ($tbl_pickup->result_array() as $row) {
			$arr_regular[] = date("d", strtotime($row["date_time"]));
		}
		$days_regular = array_count_values($arr_regular);

		// $arr_custom = array();
		// foreach ($tbl_custom->result_array() as $row) {
		// 	$arr_custom[] = date("d", strtotime($row["date_time"]));
		// }
		// $days_custom = array_count_values($arr_custom);

		$days_t = date("t");
		$days = array();
		$data_regular = array();
		// $data_custom = array();

		$day_ctr_regular = 0;
		// $day_ctr_custom = 0;
		for ($i = 1; $i < $days_t; $i++) {

			if (isset($days_regular[$i])) {
				$day_ctr_regular += $days_regular[$i];
			}
			// if (isset($days_custom[$i])) {
			// 	$day_ctr_custom += $days_custom[$i];
			// }
			if (($i - 1) % 4 == 0) {
				array_push($days, $i);
				array_push($data_regular, $day_ctr_regular);
				// array_push($data_custom, $day_ctr_custom);
				if ($i + 4 > $days_t && $i != $days_t) {
					array_push($days, $days_t);
					array_push($data_regular, $day_ctr_regular);
					// array_push($data_custom, $day_ctr_custom);
				}
				$day_ctr_regular = 0;
			}
		}

		echo "var days_label = ". json_encode($days) .";";
		echo "var data_regular = ". json_encode($data_regular) .";";
		// echo "var data_custom = ". json_encode($data_custom) .";";
		?>

		var ctxL = document.getElementById("lineChart").getContext("2d");
		var myLineChart = new Chart(ctxL, {
			type: "line",
			data: {
				labels: days_label,
				datasets: [
					// {
					// 	label: "Custom Orders",
					// 	data: data_custom,
					// 	backgroundColor: [ "rgba(105, 0, 132, .2)" ],
					// 	borderColor: [ "rgba(200, 99, 132, .7)" ],
					// 	borderWidth: 2
					// },
					{
						label: "Orders",
						data: data_regular,
						backgroundColor: [
						"rgba(0, 137, 132, .2)",
						],
						borderColor: [
						"rgba(0, 10, 130, .7)",
						],
						borderWidth: 2
					}
				]
			},
			options: {
				responsive: true
			}
		});
	});
</script>
</html>