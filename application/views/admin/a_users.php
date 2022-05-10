
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
					<div class="col-12-fluid p-5">
						<?php if ($this->session->flashdata("alert")): ?>
							<?php $alert = $this->session->flashdata("alert"); ?>
							<div class="alert alert-<?=$alert[0]?> alert-dismissible">
								<?=$alert[1]?>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
						<?php endif; ?>
						<div class="row py-3 col-12 col-md-9 mx-auto border-bottom mb-4">
							<div class="col-12 col-sm-6 text-start">
								<h2 class="font-weight-bold">Users <small class="text-muted">x<?=$tbl_users->num_rows()?></small></h2>
							</div>
							<div class="col-12 col-sm-6 text-end">
								<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_new_account"><i class="fa fa-plus p-1" aria-hidden="true"></i> New User</button>
							</div>
						</div>
						<div class="row col-12 col-md-9 mx-auto">
							<div class="col-12 table-responsive table-striped table-hover table-bordered">
								<table id="table_users" class="table table-striped table-hover table-responsive-md table-bordered">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Gender</th>
											<th>Email</th>
											<th>Contact #</th>
											<th>Address</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($tbl_users->result_array() as $row): ?>
											<tr class="text-center align-middle">
												<td>
													<?=$row["user_id"]?>
												</td>
												<td>
													<?=$row["name_last"] .", ". $row["name_first"] ." ". $row["name_middle"] ." ". $row["name_extension"]?>
												</td>
												<td>
													<?=$row["gender"]?>
												</td>
												<td>
													<?php if ($row["email"] == NULL): ?>
														[NO ACCOUNT]
													<?php else: ?>
														<?=$row["email"]?>
													<?php endif; ?>
												</td>
												<td>
													<?=$row["contact_num"]?>
												</td>
												<td>
													<?=$row["zip_code"] ." / ". $row["country"] ." / ". $row["province"] ." / ". $row["city"] ." / ". $row["street"] ." / ". $row["address"]?>
												</td>
												<td>
													<a class="action_button" href="<?=base_url();?>admin/users_view?id=<?=$row['user_id']?>">
														<i class="fa fa-eye p-1" aria-hidden="true"></i>
													</a>
													<a class="action_button" href="<?=base_url();?>admin/users_edit?id=<?=$row['user_id']?>">
														<i class="fa fa-pencil p-1" aria-hidden="true"></i>
													</a>
													<i class="fa fa-trash p-1 btn_delete action_button" data-bs-toggle="modal" data-bs-target="#modal_delete_user" data-id="<?=$row['user_id']?>" aria-hidden="true"></i>
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
				<?=form_open(base_url() . "admin/user_create", "method='POST'");?>
					<div class="modal-header">
						<h4 class="modal-title">New User</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<button class="btn btn-secondary btn_no_account w-100" type="button">
								<i class="fa fa-times" aria-hidden="true"></i> No Account
							</button>
						</div>
						<div class="a_info">
							<div class="form-group">
								<label for="inp_email">Email:</label>
								<input type="email" class="form-control user_email" name="inp_email" placeholder="*Email Address" autocomplete="off" required="">
							</div>
							<div class="form-group">
								<label for="inp_password">Password:</label>
								<input type="password" class="form-control user_password" name="inp_password" placeholder="*Password" autocomplete="off" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inp_name_last">Last Name:</label>
							<input type="text" class="form-control" name="inp_name_last" placeholder="*Last Name" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_name_first">First Name:</label>
							<input type="text" class="form-control" name="inp_name_first" placeholder="*First Name" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_name_middle">Middle Name:</label>
							<input type="text" class="form-control" name="inp_name_middle" placeholder="Middle Name" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_name_extension">Name Extension:</label>
							<input type="text" class="form-control" name="inp_name_extension" placeholder="Name Extension" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_gender">Gender:</label>
							<select name="inp_gender" class="form-control" required="">
								<option value="male" selected="">Male</option>
								<option value="female">Female</option>
								<option value="other">Other</option>
							</select>
						</div>
						<div class="form-group">
							<label for="inp_zip_code">Zip Code:</label>
							<input type="text" class="form-control" name="inp_zip_code" placeholder="*Zip Code" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_country">Country:</label>
							<input type="text" class="form-control" name="inp_country" placeholder="*Country" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_province">Province:</label>
							<input type="text" class="form-control" name="inp_province" placeholder="*Province" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_city">City:</label>
							<input type="text" class="form-control" name="inp_city" placeholder="*City" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_street">Street/Road:</label>
							<input type="text" class="form-control" name="inp_street" placeholder="*Street/Road" autocomplete="off" required="">
						</div>
						<div class="form-group">
							<label for="inp_address">House Number/Floor/Bldg./etc.:</label>
							<input type="text" class="form-control" name="inp_address" placeholder="House Number/Floor/Bldg./etc." autocomplete="off">
						</div>
						<div class="form-group">
							<label for="inp_contact_num">Contact Number:</label>
							<input type="text" class="form-control" name="inp_contact_num" placeholder="*Contact #" autocomplete="off" required="">
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Add Account">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
	<div id="modal_delete_user" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<?=form_open(base_url() . "admin/user_delete", "method='POST'");?>
					<input id="delete_inp_id" type="hidden" name="inp_id">
					<div class="modal-header">
						<h4 class="modal-title">Delete Account</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Are you sure you want to delete Account #<span id="delete_id"></span>?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
						<input type="submit" class="btn btn-primary" value="Yes">
					</div>
				<?=form_close()?>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$(".btn_delete").on("click", function() {
			$("#delete_id").text($(this).data("id"));
			$("#delete_inp_id").val($(this).data("id"));
		});

		$("#table_users").DataTable({ "order": [[0, "desc"]] });

		$(".btn_no_account").on("click", function() {
			if ($(".a_info").is(":visible")) {
				$(".user_email").removeAttr("required");
				$(".user_password").removeAttr("required");
				$(this).removeClass("btn-secondary");
				$(this).addClass("btn-primary");
				$(this).children("i").removeClass("fa-times");
				$(this).children("i").addClass("fa-check");
				$(".a_info").hide("100");
			} else {
				$(".user_email").attr("required", true);
				$(".user_password").attr("required", true);
				$(this).removeClass("btn-primary");
				$(this).addClass("btn-secondary");
				$(this).children("i").removeClass("fa-check");
				$(this).children("i").addClass("fa-times");
				$(".a_info").show("100");
			}
			
		});
	});
</script>
</html>