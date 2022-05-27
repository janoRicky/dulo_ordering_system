
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
								<h2>View Type #<?=$row_info["type_id"]?></h2>
							</div>
							<div class="col-12 col-sm-6 text-end">
								<a class="btn btn-primary" href="<?=base_url()?>admin/types_edit?id=<?=$row_info['type_id']?>">
									<i class="fa fa-pencil fa-lg text-warning p-1" aria-hidden="true"></i> Update
								</a>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto view_container">
							<div class="col-12 col-md-3">
								<img class="img-responsive img_view img_zoomable" src="<?php
								if (!empty($row_info["img"])) {
									echo base_url(). 'uploads/types/type_'. $row_info["type_id"] .'/'. $row_info["img"];
								} else {
									echo base_url(). "assets/img/no_img.png";
								}
								?>">
							</div>
							<div class="col-12 col-md-9">
								<div class="row mt-2">
									<div class="col-12 row border-0">
										<div class="col-12 col-md-4">
											<label>Type Name:</label><br>
										</div>
										<div class="col-12 col-md-8">
											<?=$row_info["name"]?>
										</div>
									</div>
									<div class="col-12 row border-0">
										<div class="col-12 col-md-4">
											<label>Description:</label><br>
										</div>
										<div class="col-12 col-md-8">
											<?=$row_info["description"]?>
										</div>
									</div>
									<div class="col-12 row border-0">
										<div class="col-12 col-md-4">
											<label>Price Range:</label><br>
										</div>
										<div class="col-12 col-md-8">
											PHP <?=$row_info["price_range"]?>
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
</script>
</html>