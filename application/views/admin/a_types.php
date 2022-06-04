
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
								<h2 class="fw-bold">Types <small class="text-muted">x<?=$tbl_types->num_rows()?></small></h2>
							</div>
							<div class="col-12 col-sm-6 text-end">
								<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_new_type"><i class="fa fa-plus p-1" aria-hidden="true"></i> New Type</button>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto">
							<div class="col-12 table-responsive table-striped table-hover table-bordered">
								<table id="table_types" class="table table-striped table-hover table-responsive-md table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Img</th>
											<th>Name</th>
											<th>Price Range</th>
											<th>Featured</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($tbl_types->result_array() as $row): ?>
											<tr class="text-center align-middle">
												<td>
													<?=$row["type_id"]?>
												</td>
												<td>
													<img class="img-responsive img_row img_zoomable" src="<?php
													if (!empty($row["img"])) {
														echo base_url(). 'uploads/types/type_'. $row["type_id"] .'/'. $row["img"];
													} else {
														echo base_url(). "assets/img/no_img.png";
													}
													?>">
												</td>
												<td>
													<?=$row["name"]?>
												</td>
												<td>
													<?=$row["price_range"]?>
												</td>
												<td>
													<?php if ($row["featured"] == 1): ?>
														<i class="fa fa-check-circle text-success fa-lg" aria-hidden="true"></i>
													<?php else: ?>
														<i class="fa fa-times-circle text-danger fa-lg" aria-hidden="true"></i>
													<?php endif; ?>
												</td>
												<td>
													<button class="btn btn-primary btn-sm btn_featured" data-bs-toggle="modal" data-bs-target="#modal_featured" data-id="<?=$row['type_id']?>">Feature</button><br>
													<a class="action_button" href="<?=base_url()?>admin/types_view?id=<?=$row['type_id']?>">
														<i class="fa fa-eye fa-lg text-primary p-1" aria-hidden="true"></i>
													</a>
													<a class="action_button" href="<?=base_url()?>admin/types_edit?id=<?=$row['type_id']?>">
														<i class="fa fa-pencil fa-lg text-warning p-1" aria-hidden="true"></i>
													</a>
													<i class="fa fa-trash fa-lg text-danger p-1 btn_delete action_button" data-bs-toggle="modal" data-bs-target="#modal_delete_type" data-id="<?=$row['type_id']?>" aria-hidden="true"></i>
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
	<div id="modal_new_type" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/type_create", "method='POST' enctype='multipart/form-data'")?>
					<div class="modal-header">
						<h4 class="modal-title">New Type</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group text-center">
							<label>Image:</label>
							<input class="form-control mb-1 d-none" id="type_image" type="file" name="inp_img">
							<img class="img_view img_update" id="image_preview" src="<?=base_url()?>assets/img/no_img.png">
						</div>
						<div class="form-group">
							<label>Type Name:</label>
							<input type="text" class="form-control" name="inp_name" placeholder="*Type Name" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label>Description:</label>
							<textarea class="form-control" name="inp_description" placeholder="*Description"style="resize: none;" required=""></textarea>
						</div>
						<div class="form-group">
							<label>Price Range:</label>
							<input type="text" class="form-control" name="inp_price_range" placeholder="*e.g. 150.00 - 200.00" autocomplete="off" required="">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Add Type">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_delete_type" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/type_delete", "method='POST'")?>
					<input id="delete_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Delete Type</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Are you sure you want to delete Type #<span id="delete_id"></span>?
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
				<?=form_open(base_url() . "admin/type_update_featured", "method='POST'");?>
					<input id="featured_inp_id" type="hidden" name="inp_id">
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
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$(".btn_featured").on("click", function() {
			$("#featured_inp_id").val($(this).data("id"));
		});
		$(".btn_delete").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});

		$("#table_types").DataTable({ "order": [[0, "desc"]] });

		$(document).on("change", "#type_image", function() {
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