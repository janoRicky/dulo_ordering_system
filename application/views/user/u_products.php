
<?php
$template_header;
?>
<style type="text/css">
	.custom_order {
		color: #954123;
		font-size: 2rem;
		font-weight: bold;

		border: 0.5rem solid #dc8a6b;
		border-width: 0 0.5rem;
		border-radius: 3rem;
	}
</style>
<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-sm-1"></div>
				<div class="col-12 col-sm-10 content pt-4">
					<div class="row">
						<div class="col-12 banner text-center mt-4">
							<?=form_open(base_url() . "products", "id='search_bar' method='GET'")?>
								<input id="page" type="hidden" name="page" value="<?=$page_no?>">
								<div class="row">
									<div class="col-0 col-sm-1"></div>
									<div class="col-12 col-sm-10">
										<div class="row px-3">
											<div class="col-5 col-md-6">
												<input id="search_value" class="form-control" type="text" name="search" value="<?=$this->input->get("search")?>" placeholder="Search">
											</div>
											<div class="col-3 col-md-4">
												<select id="search_type" class="form-control" name="type">
													<option value="">All</option>
													<?php foreach ($types as $key => $val): ?>
														<option value="<?=$key?>" <?=($this->input->get("type") == $key ? "selected" : "")?>><?=$val?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="col-2 col-md-1">
												<button class="button" type="button" onclick="$('#search_type').val(''); $('#search_value').val('');">
													<i class="fa fa-refresh" aria-hidden="true"></i>
												</button>
											</div>
											<div class="col-2 col-md-1">
												<button class="button" type="submit" onclick="$('#page').val(0);">
													<i class="fa fa-search" aria-hidden="true"></i>
												</button>
											</div>
										</div>
									</div>
									<div class="col-0 col-sm-1"></div>
								</div>
							<?=form_close()?>
						</div>
					</div>
					<div class="row mt-5">
						<div class="col-0 col-sm-3"></div>
						<div class="col-12 col-sm-6">
							<a href="<?=base_url()?>custom" class="text-dark">
								<div class="custom_order text-center p-3">
									<span>Place Custom Order</span>
								</div>
							</a>
						</div>
						<div class="col-0 col-sm-3"></div>
					</div>
					<div class="row mt-5">
						<div class="col-1"></div>
						<div class="col-10">
							<div class="row align-items-center">
								<?php foreach ($tbl_products->result_array() as $row): ?>
									<div class="col-12 col-sm-6 py-2">
										<a href="<?=base_url()?>product?id=<?=$row['product_id']?>" class="text-dark">
											<div class="row align-items-center item">
												<div class="col-6">
													<img class="img-responsive item_img" src="<?php
													if (!empty($row["img"])) {
														echo base_url(). 'uploads/products/product_'. $row["product_id"] .'/'. explode("/", $row["img"])[0];
													} else {
														echo base_url(). "assets/img/no_img.png";
													}
													?>">
												</div>
												<div class="col-6">
													<div class="row">
														<div class="col-12">
															<h4 class="font-weight-bold"><?=$row["name"]?></h4>
														</div>
													</div>
													<div class="row">
														<div class="col-12">
															<h5 class="font-weight-light"><?=$types[$row["type_id"]]?></h5>
														</div>
													</div>
													<div class="row">
														<div class="col-1"></div>
														<div class="col-12">
															<h5 class="font-weight-bold">
																PHP <?=number_format($row["price"], 2)?>
															</h5>
														</div>
														<div class="col-1"></div>
													</div>
													<?php if ($row["qty"] < 1): ?>
														<div class="row">
															<div class="col-1"></div>
															<div class="col-10 text-center">
																<span class="font-weight-bold"><h5>SOLD OUT</h5></span>
															</div>
															<div class="col-1"></div>
														</div>
													<?php endif; ?>
												</div>
											</div>
										</a>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="col-1"></div>
					</div>
					<script type="text/javascript">
						function page(pg) {
							$('#page').val(pg);
							$('#search_bar').submit();
						}
					</script>
					<div class="row mt-4 pt-4 pb-4">
						<div class="col-12 banner text-center mb-4">
							<nav aria-label="..." class="m-1">
								<ul class="pagination justify-content-center paging">
									<li class="page-item <?=($page_no < 1 ? "disabled" : NULL)?>" onclick="page(<?=$page_no - 1?>)">
										<span class="page-link"><i class="fa fa-angle-left font-weight-bold" aria-hidden="true"></i></span>
									</li>
									<?php for ($i = 1; $i <= $page_total; $i++): ?>
										<li class="page-item <?=($page_no + 1 == $i ? "active" : NULL)?>" onclick="page(<?=$i - 1?>)">
											<span class="page-link">
												<?=$i?>
											</span>
										</li>
									<?php endfor; ?>
									<li class="page-item <?=($page_limit ? "disabled" : NULL)?>" onclick="page(<?=$page_no + 1?>)">
										<span class="page-link"><i class="fa fa-angle-right font-weight-bold" aria-hidden="true"></i></span>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<div class="col-0 col-sm-1"></div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
</html>