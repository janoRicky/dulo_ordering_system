
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
								<h2>View Account #<?=$row_info["admin_id"]?></h2>
							</div>
							<div class="col-12 col-sm-6 text-end">
								<a class="btn btn-primary" href="<?=base_url();?>admin/accounts_edit?id=<?=$row_info['admin_id']?>">
									<i class="fa fa-pencil p-1" aria-hidden="true"></i> Update
								</a>
							</div>
						</div>
						<div class="row view_container">
							<div class="col-12">
								<div class="row mt-2">
									<div class="col-12">
										<label>Full Name:</label><br>
										<?=$row_info["name"]?>
									</div>
									<div class="col-12">
										<label>Email:</label><br>
										<?=$row_info["email"]?>
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