
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
						
						<div class="row pt-3 pb-1">
							<div class="col-12">
								<h2 class="fw-bold">Config</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-0 col-sm-2 col-md-3"></div>
							<div class="col-12 col-sm-8 col-md-6">
								<?=form_open(base_url() . "admin/config_update", "method='POST'")?>
									<?php foreach ($tbl_config->result_array() as $row): ?>
										<div class="row py-1">
											<div class="col-12 col-sm-4">
												<label><?=$row["c_key"]?>:</label>
											</div>
											<div class="col-12 col-sm-8">
												<input type="text" class="form-control" name="inp_<?=$row["c_key"]?>" placeholder="<?=$row["c_key"]?>" autocomplete="off" value="<?=$row['c_val']?>" required="">
											</div>
										</div>
									<?php endforeach; ?>
									<button type="submit" class="btn btn-primary form-control my-3">
										Update Config
									</button>
								<?=form_close()?>
							</div>
							<div class="col-0 col-sm-2 col-md-3"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
	});
</script>
</html>