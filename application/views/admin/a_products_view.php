
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
						<?php if ($this->session->flashdata("alert")): ?>
							<?php $alert = $this->session->flashdata("alert"); ?>
							<div class="alert alert-<?=$alert[0]?> alert-dismissible">
								<?=$alert[1]?>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-12 col-sm-6 text-start">
								<h2>View Product #<?=$row_info["product_id"]?></h2>
							</div>
							<div class="col-12 col-sm-6 text-end">
								<a class="btn btn-primary" href="<?=base_url();?>admin/products_edit?id=<?=$row_info['product_id']?>">
									<i class="fa fa-pencil p-1" aria-hidden="true"></i> Update
								</a>
							</div>
						</div>
						<div class="row view_container">
							<div class="col-12 col-md-3">
								<img class="img-responsive img_view img_zoomable" src="<?php
								if (!empty($row_info["img"])) {
									echo base_url(). 'uploads/products/product_'. $row_info["product_id"] .'/'. $row_info["img"];
								} else {
									echo base_url(). "assets/img/no_img.png";
								}
								?>">
							</div>
							<div class="col-12 col-md-9">
								<div class="row mt-2">
									<div class="col-12 col-md-6">
										<label>Name:</label><br>
										<?=$row_info["name"]?>
									</div>
									<div class="col-12 col-md-6">
										<label>Type:</label><br>
										<?php
										if ($row_info["type_name"] != NULL) {
											echo $row_info["type_name"];
										} else {
											echo "Deleted Type (Edit Required)";
										}
										?>
									</div>
									<div class="col-12">
										<label>Description:</label><br>
										<?=$row_info["description"]?>
									</div>
									<div class="col-12">
										<label>Date Added:</label><br>
										<?=date("Y-m-d / H:i:s A", strtotime($row_info["date_added"]))?>
									</div>
									<div class="col-12 col-md-6">
										<label>Price:</label><br>
										PHP <?=$row_info["price"]?>
									</div>
									<div class="col-12 col-md-6">
										<label>Quantity:</label><br>
										<?=$row_info["qty"]?>
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
</script>
</html>