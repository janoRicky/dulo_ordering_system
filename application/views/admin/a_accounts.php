
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
								<h2 class="fw-bold">Accounts <small class="text-muted">x<?=$tbl_accounts->num_rows()?></small></h2>
							</div>
							<div class="col-auto text-end">
								<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_new_account"><i class="fa fa-plus p-1" aria-hidden="true"></i> New Account</button>
								<?php $this->load->view("admin/template/a_t_export_buttons"); ?>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto">
							<div class="col-12 table-responsive table-striped table-hover table-bordered">
								<table id="table_main" class="table table-striped table-hover table-responsive-sm table-bordered">
									<thead>
										<tr>
											<th data-included="yes">ID</th>
											<th data-included="yes">Name</th>
											<th data-included="yes">Email</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($tbl_accounts->result_array() as $row): ?>
											<tr class="text-center align-middle">
												<td>
													<?=$row["admin_id"]?>
												</td>
												<td>
													<?=$row["name"]?>
												</td>
												<td>
													<?=$row["email"]?>
												</td>
												<td>
													<a class="action_button" href="<?=base_url();?>admin/accounts_view?id=<?=$row['admin_id']?>">
														<i class="fa fa-eye fa-lg text-primary p-1" aria-hidden="true"></i>
													</a>
													<a class="action_button" href="<?=base_url();?>admin/accounts_edit?id=<?=$row['admin_id']?>">
														<i class="fa fa-pencil fa-lg text-warning p-1" aria-hidden="true"></i>
													</a>
													<i class="fa fa-trash fa-lg text-danger p-1 btn_delete action_button" data-bs-toggle="modal" data-bs-target="#modal_delete_account" data-id="<?=$row['admin_id']?>" aria-hidden="true"></i>
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
	<div id="modal_new_account" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/acc_create", "method='POST'");?>
					<div class="modal-header">
						<h4 class="modal-title">New Account</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Name:</label>
							<input type="text" class="form-control" name="inp_name" placeholder="*Name" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label>Email:</label>
							<input type="email" class="form-control" name="inp_email" placeholder="*Email Address" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label>Password:</label>
							<input type="password" class="form-control" name="inp_password" placeholder="*Password" autocomplete="off" required="">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Add Account">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_delete_account" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/acc_delete", "method='POST'");?>
					<input id="delete_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Delete Account</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Are you sure you want to delete Account #<span id="delete_id"></span>?
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Yes">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
</body>
<script src="<?=base_url()?>assets/js/admin_tables.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("click", ".btn_delete", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});
	});
</script>
</html>