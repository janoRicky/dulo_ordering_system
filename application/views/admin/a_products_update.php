
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
								<h2>Update Product #<?=$row_info["product_id"]?></h2>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto">
							<div class="col-12">
								<?=form_open(base_url() . "admin/product_update", "class='row' method='POST' enctype='multipart/form-data'")?>
									<input id="update_inp_id" type="hidden" name="inp_id" value="<?=$row_info['product_id']?>">
									<div class="col-12 col-md-6">
										<label class="float-start">Image:</label>
										<input class="form-control mb-1 d-none" id="product_image" type="file" name="inp_img">
										<img class="img-responsive img_view img_update" id="image_preview" src="<?php
										if (!empty($row_info["img"])) {
											echo base_url(). 'uploads/products/product_'. $row_info["product_id"] .'/'. $row_info["img"];
										} else {
											echo base_url(). "assets/img/no_img.png";
										}
										?>">
									</div>
									<div class="col-12 col-md-6">
										<div class="col-12 text-start pb-3">
											<label class="float-start">Name:</label>
											<input type="text" class="form-control" name="inp_name" placeholder="*Name" value="<?=$row_info['name']?>" autocomplete="off" required="">
										</div>
										<div class="col-12 text-start pb-3">
											<label class="float-start">Description:</label>
											<textarea class="form-control" name="inp_description" rows="5" required=""><?=$row_info['description']?></textarea>
										</div>
										<div class="col-12 text-start pb-3">
											<label class="float-start">Type:</label>
											<select name="inp_type_id" class="form-control">
												<?php foreach ($tbl_types as $key => $val): ?>
													<option value="<?=$key?>" <?=($row_info["type_id"] == $key ? "selected" : "")?>><?=$val?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-12 text-start pb-3">
											<label class="float-start">Price:</label>
											<input type="number" class="form-control" name="inp_price" placeholder="*Price" value="<?=$row_info['price']?>" autocomplete="off" required="" step="0.000001">
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
		$("#product_image").change(function() {
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