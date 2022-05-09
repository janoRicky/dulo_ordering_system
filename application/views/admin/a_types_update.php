
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
							<div class="col-12 text-start">
								<h2>Update Type #<?=$row_info["type_id"]?></h2>
							</div>
							<div class="col-12">
								<?=form_open(base_url() . "admin/type_update", "method='POST' enctype='multipart/form-data'"); ?>
									<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$row_info["type_id"]?>">
									<div class="form-group">
										<label>Image:</label>
										<input class="form-control mb-1" id="type_image" type="file" name="inp_img">
										<img class="img-responsive img_view img_zoomable" id="image_preview" src="<?php
										if (!empty($row_info["img"])) {
											echo base_url(). 'uploads/types/type_'. $row_info["type_id"] .'/'. $row_info["img"];
										} else {
											echo base_url(). "assets/img/no_img.png";
										}
										?>">
									</div>
									<div class="form-group">
										<label for="inp_type">Type Name:</label>
										<input type="text" class="form-control" name="inp_name" placeholder="*Type Name" value="<?=$row_info['name']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<label for="inp_type">Description:</label>
										<textarea class="form-control" name="inp_description" placeholder="*Description"style="resize: none;" required=""><?=$row_info['description']?></textarea>
									</div>
									<div class="form-group">
										<label for="inp_type">Price Range:</label>
										<input type="text" class="form-control" name="inp_price_range" placeholder="*e.g. 150.00 - 200.00" value="<?=$row_info['price_range']?>" autocomplete="off" required="">
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-primary" value="Update">
									</div>
								<?=form_close(); ?>
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

		$("#type_image").change(function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.readAsDataURL(this.files[0]);
				reader.onload = function(e) {
					$("#image_preview").attr("src", e.target.result);
				};
			}
		});

	});
</script>
</html>