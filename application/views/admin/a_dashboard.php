
<?php
$template_header;
?>

<body>
	<div class="wrapper h-100">
		<div class="container-fluid">
			<div class="row">
				<?php $this->load->view("admin/template/a_t_sidebar"); ?>
				<?php $this->load->view("admin/template/a_t_navbar", $nav); ?>
				<div class="col-12 text-center pt-3">
					<div class="container-fluid p-2 py-5 p-sm-5 justify-content-center">
						<?php if ($this->session->flashdata("alert")): ?>
							<?php $alert = $this->session->flashdata("alert"); ?>
							<div class="alert alert-<?=$alert[0]?> alert-dismissible">
								<?=$alert[1]?>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-12 border-bottom">
								<h3 class="font-weight-bold" class="p-3">Welcome Admin <?=$this->session->userdata("admin_name")?>!</h3>
							</div>
						</div>
						<div class="row justify-content-center">
							<div class="col-12 col-md-7 mt-2">
								<div class="row">
									<div class="col-12">
										<h5 class="font-weight-bold">
											<i class="fa fa-calendar" aria-hidden="true"></i> Total New Orders This Month (<?=date("M")?>)
										</h5>
									</div>
									<div class="col-12 col-md-10 col-lg-7 mx-auto">
										<canvas id="lineChart" height="200"></canvas>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-3 mt-5">
								<div class="card">
									<a href="orders">
										<h5 class="card-header font-weight-bold">
											<i class="fa fa-list fa-lg" aria-hidden="true"></i> Current Orders
										</h5>
									</a>
									<div class="card-body">
										<div class="row align-items-center">
											<div class="col-12 my-2">
												<a href="orders?state=0">
													<div class="card text-center bg-info text-dark py-3 px-2">
														<h6 class="my-auto font-weight-bold">PENDING (<?=$regular_count_0?>)</h6>
													</div>
												</a>
											</div>
											<div class="col-12 my-2">
												<a href="orders?state=1">
													<div class="card text-center bg-warning text-dark py-3 px-2">
														<h6 class="my-auto font-weight-bold">WAITING FOR PAYMENT (<?=$regular_count_1?>)</h6>
													</div>
												</a>
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
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {

		$(".side_link.dashboard").addClass("active");

		<?php
		$arr_regular = array();
		foreach ($tbl_regular->result_array() as $row) {
			$arr_regular[] = date("d", strtotime($row["date_time"]));
		}
		$days_regular = array_count_values($arr_regular);

		$arr_custom = array();
		foreach ($tbl_custom->result_array() as $row) {
			$arr_custom[] = date("d", strtotime($row["date_time"]));
		}
		$days_custom = array_count_values($arr_custom);

		$days_t = date("t");
		$days = array();
		$data_regular = array();
		$data_custom = array();

		$day_ctr_regular = 0;
		$day_ctr_custom = 0;
		for ($i = 1; $i < $days_t; $i++) {

			if (isset($days_regular[$i])) {
				$day_ctr_regular += $days_regular[$i];
			}
			if (isset($days_custom[$i])) {
				$day_ctr_custom += $days_custom[$i];
			}
			if (($i - 1) % 4 == 0) {
				array_push($days, $i);
				array_push($data_regular, $day_ctr_regular);
				array_push($data_custom, $day_ctr_custom);
				if ($i + 4 > $days_t && $i != $days_t) {
					array_push($days, $days_t);
					array_push($data_regular, $day_ctr_regular);
					array_push($data_custom, $day_ctr_custom);
				}
				$day_ctr_regular = 0;
			}
		}

		echo "var days_label = ". json_encode($days) .";";
		echo "var data_regular = ". json_encode($data_regular) .";";
		echo "var data_custom = ". json_encode($data_custom) .";";
		?>

		var ctxL = document.getElementById("lineChart").getContext("2d");
		var myLineChart = new Chart(ctxL, {
			type: "line",
			data: {
				labels: days_label,
				datasets: [{
					label: "Custom Orders",
					data: data_custom,
					backgroundColor: [ "rgba(105, 0, 132, .2)" ],
					borderColor: [ "rgba(200, 99, 132, .7)" ],
					borderWidth: 2
				},
				{
					label: "Regular Orders",
					data: data_regular,
					backgroundColor: [
					"rgba(0, 137, 132, .2)",
					],
					borderColor: [
					"rgba(0, 10, 130, .7)",
					],
					borderWidth: 2
				}]
			},
			options: {
				responsive: true
			}
		});
	});
</script>
</html>