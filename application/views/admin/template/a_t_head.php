<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta charset="utf-8">
	<title>
		<?php
		if ($title != NULL) {
			echo $title;
		}
		?>
	</title>
	<!-- ICONS LIBRARY -->
	<link rel="stylesheet" href="<?=base_url()?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="<?=base_url()?>assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">
	<!-- DATATABLES -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/datatables.min.css">
	
	<link rel="stylesheet" href="<?=base_url()?>assets/mdb.min.css">
	<!-- CUSTOM STYLE -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/a_style.css">

	<!-- PAGE ICON -->
	<link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/gif">


	<?php $this->load->view('admin/template/a_t_scripts'); // include the scripts from the view folder ?>

	<?php date_default_timezone_set('Asia/Manila'); ?>
</head>

<?php if ($this->session->flashdata("alert")): ?>
	<?php $alert = $this->session->flashdata("alert"); unset($_SESSION['alert']); ?>
	<div style="position: fixed; top: 5rem; right: 1rem; z-index: 9999;">
		<div id="alert" class="alert alert-<?=$alert[0]?> alert-dismissible mt-3">
			<?=$alert[1]?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	</div>
<?php endif; ?>