
<?php
$template_header;
?>

<body>
	<?php $this->load->view("user/template/u_t_api_scripts"); ?>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row my-4 justify-content-center">
				<div class="col-12 col-md-10 col-lg-8 mb-5">
					<div class="row p-0 m-0">
						<div class="col-12 col-md-8">
							<div class="card shadow" style="border-radius: 15px;">
								<div class="card-body p-0">
									<div class="row m-0 p-0 justify-content-center py-4">
										<div class="col-10 col-sm-6">
											<div class="row mt-2">
												<div class="col-12">
													<h5 class="fw-bold">Full Name: </h5>
												</div>
												<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
													<?=$account_details["name_last"] .", ". $account_details["name_first"] ." ". $account_details["name_middle"] ." ". $account_details["name_extension"]?>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-12">
													<h5 class="fw-bold">Email: </h5>
												</div>
												<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
													<?=$account_details["email"]?>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-12">
													<h5 class="fw-bold">Gender: </h5>
												</div>
												<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
													<?=$account_details["gender"]?>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-12">
													<h5 class="fw-bold">Contact Num: </h5>
												</div>
												<div class="col-12 text-center rounded-pill bg-secondary text-light py-2">
													<?=$account_details["contact_num"]?>
												</div>
											</div>
											<div class="row mt-4 mb-4">
												<div class="col-12 text-center">
													<a href="account_details">
														<button class="btn fw-bold rounded-pill product_btn px-3 py-2">
															<i class="fa fa-pencil" aria-hidden="true"></i> Update Personal Info
														</button>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-4 justify-content-center text-center">
							<div class="card shadow" style="border-radius: 15px;">
								<div class="card-body px-2 pt-2 pb-4">
									<h5 class="card-title fw-bold mt-3">My Orders</h5>
									<hr class="my-3 mx-3">
									<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders">ALL (<?=(isset($order_state_counts) ? array_sum($order_state_counts) : 0)?>)</a><br>
									<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=0"><?=$states[0]?> (<?=(isset($order_state_counts[0]) ? $order_state_counts[0] : 0)?>)</a><br>
									<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=1"><?=$states[1]?> (<?=(isset($order_state_counts[1]) ? $order_state_counts[1] : 0)?>)</a><br>
									<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=2"><?=$states[2]?> (<?=(isset($order_state_counts[2]) ? $order_state_counts[2] : 0)?>)</a><br>
									<a style="" class="btn py-2 px-4 m-0 fw-bold my_order_state" href="my_orders?state=3"><?=$states[3]?> (<?=(isset($order_state_counts[3]) ? $order_state_counts[3] : 0)?>)</a><br>
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
</html>