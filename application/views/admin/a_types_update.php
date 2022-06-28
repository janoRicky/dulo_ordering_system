
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
							<div class="col-12 text-start">
								<h2>Update Type #<?=$row_info["type_id"]?></h2>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto">
							<div class="col-12">
								<?=form_open(base_url() . "admin/type_update", "class='row' method='POST' enctype='multipart/form-data'"); ?>
									<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$row_info["type_id"]?>">
									<div class="col-12 col-md-6">
										<label class="float-start">Image:</label>
										<input class="form-control mb-1 d-none" id="type_image" type="file" name="inp_img">
										<img class="img-responsive img_view img_update" id="image_preview" src="<?php
										if (!empty($row_info["img"])) {
											echo base_url(). 'uploads/types/type_'. $row_info["type_id"] .'/'. $row_info["img"];
										} else {
											echo base_url(). "assets/img/no_img.png";
										}
										?>">
									</div>
									<div class="col-12 col-md-6">
										<div class="col-12 text-start pb-3">
											<label for="inp_type">Type Name:</label>
											<input type="text" class="form-control" name="inp_name" placeholder="*Type Name" value="<?=$row_info['name']?>" autocomplete="off" required="">
										</div>
										<div class="col-12 text-start pb-3">
											<label for="inp_type">Description:</label>
											<textarea class="form-control" name="inp_description" placeholder="*Description" required=""><?=$row_info['description']?></textarea>
										</div>
									</div>
									<div class="form-group mt-4">
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