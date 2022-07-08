
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
							<div class="col text-start">
								<h2 class="fw-bold">Products <small class="text-muted">x<?=$tbl_products->num_rows()?></small></h2>
							</div>
							<div class="col-auto text-end">
								<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_new_product"><i class="fa fa-plus p-1" aria-hidden="true"></i> New Product</button>
								<?php $this->load->view("admin/template/a_t_export_buttons"); ?>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto">
							<div class="col-12 table-responsive table-striped table-hover table-bordered">
								<table id="table_main" class="table table-striped table-hover table-bordered table-responsive-md">
									<thead>
										<tr>
											<th data-included="yes">ID</th>
											<th>Img</th>
											<th data-included="yes">Name</th>
											<th data-included="yes">Type</th>
											<th>Visible</th>
											<th>Featured</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($tbl_products->result_array() as $row): ?>
											<tr class="text-center align-middle">
												<td>
													<?=$row["product_id"]?>
												</td>
												<td>
													<img class="img-responsive img_row img_zoomable" src="<?php
													if (!empty($row["img"])) {
														echo base_url(). 'uploads/products/product_'. $row["product_id"] .'/'. $row["img"];
													} else {
														echo base_url(). "assets/img/no_img.png";
													}
													?>">
												</td>
												<td>
													<?=$row["name"]?>
												</td>
												<td>
													<?php
													if (isset($tbl_types[$row["type_id"]])) {
														echo $tbl_types[$row["type_id"]];
													} else {
														echo "Deleted Type (Edit Required)";
													}
													?>
												</td>
												<td>
													<?php if ($row["visibility"] == 1): ?>
														<i class="fa fa-check-circle text-success fa-lg" aria-hidden="true"></i>
													<?php else: ?>
														<i class="fa fa-times-circle text-danger fa-lg" aria-hidden="true"></i>
													<?php endif; ?>
												</td>
												<td>
													<?php if ($row["featured"] == 1): ?>
														<i class="fa fa-check-circle text-success fa-lg" aria-hidden="true"></i>
													<?php else: ?>
														<i class="fa fa-times-circle text-danger fa-lg" aria-hidden="true"></i>
													<?php endif; ?>
												</td>
												<td>
													<button class="btn btn-success btn-sm btn_featured" data-bs-toggle="modal" data-bs-target="#modal_featured" data-id="<?=$row['product_id']?>">Feature</button><br>
													<button class="btn btn-info btn-sm mt-1 btn_visibility" data-bs-toggle="modal" data-bs-target="#modal_visibility" data-id="<?=$row['product_id']?>">Visibility</button><br>
													<a class="action_button" href="<?=base_url();?>admin/products_view?id=<?=$row['product_id']?>">
														<i class="fa fa-eye fa-lg text-primary p-1" aria-hidden="true"></i>
													</a>
													<a class="action_button" href="<?=base_url();?>admin/products_edit?id=<?=$row['product_id']?>">
														<i class="fa fa-pencil fa-lg text-warning p-1" aria-hidden="true"></i>
													</a>
													<i class="fa fa-trash fa-lg text-danger p-1 btn_delete action_button" data-bs-toggle="modal" data-bs-target="#modal_delete_product" data-id="<?=$row['product_id']?>" aria-hidden="true"></i>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- bootstrap modals -->
	<div id="modal_new_product" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/product_create", "method='POST' enctype='multipart/form-data'")?>
					<div class="modal-header">
						<h4 class="modal-title">New Product</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group text-center">
							<label>Image:</label>
							<input class="form-control mb-1 d-none" id="product_image" type="file" name="inp_img">
							<img class="img_view img_update" id="image_preview" src="<?=base_url()?>assets/img/no_img.png">
						</div>
						<div class="form-group">
							<label>Name:</label>
							<input type="text" class="form-control" name="inp_name" placeholder="*Name" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label>Description:</label>
							<textarea class="form-control" rows="5" style="resize: none;" name="inp_description" placeholder="*Description" required=""></textarea>
						</div>
						<div class="form-group">
							<label>Type:</label>
							<select name="inp_type_id" class="form-control" required="">
								<?php foreach ($tbl_types as $key => $val): ?>
									<option value="<?=$key?>"><?=$val?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Price:</label>
							<input type="number" class="form-control" name="inp_price" placeholder="*Price" autocomplete="off" required="" step="0.000001">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Add Product">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_delete_product" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/product_delete", "method='POST'");?>
					<input id="delete_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Delete Product</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Are you sure you want to delete Product #<span id="delete_id"></span>?
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Yes">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_featured" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/product_update_featured", "method='POST'");?>
					<input id="featured_inp_id" type="hidden" name="inp_id">
					<!-- <div class="modal-header">
						<h4 class="modal-title">Feature Product</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Featured:</label>
							<select name="inp_featured_no" class="form-control" required="">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Feature">
					</div> -->
					<div class="modal-header">
						<h4 class="modal-title">Feature Type</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-warning" name="inp_submit" value="Unfeature">
						<input type="submit" class="btn btn-primary" name="inp_submit" value="Feature">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_visibility" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/product_update_visibility", "method='POST'");?>
					<input id="visibility_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Set Visibility</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-warning" name="inp_submit" value="Set to Invisible">
						<input type="submit" class="btn btn-primary" name="inp_submit" value="Set to Visible">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
</body>
<script src="<?=base_url()?>assets/js/admin_tables.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$(".btn_featured").on("click", function() {
			$("#featured_inp_id").val($(this).data("id"));
		});
		$(".btn_visibility").on("click", function() {
			$("#visibility_inp_id").val($(this).data("id"));
		});
		$(".btn_delete").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});


		$(document).on("change", "#product_image", function() {
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