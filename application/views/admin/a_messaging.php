
<?php
$template_header;
?>
<style type="text/css">
	.message_link {
		color: white;
		text-decoration: none;
	}
</style>
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
								<h2 class="fw-bold">Messages <small class="text-muted">x<?=$tbl_messages->num_rows()?></small></h2>
							</div>
						</div>
						
						<div class="row col-12 col-md-9 mx-auto">
							<div class="col-12 table-responsive table-striped table-hover table-bordered">
								<table id="table_messages" class="table table-striped table-hover table-responsive-md table-bordered">
									<thead>
										<tr>
											<th>User Email</th>
											<th>Latest Message</th>
											<th>Time</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($tbl_messages->result_array() as $row): ?>
											<tr class="text-center align-middle">
												<td>
													<?php
													$user_info = $this->Model_read->get_user_acc_wid($row["user_id"])->row_array();
													?>
													<?=$user_info["email"]?>
												</td>
												<td class="text-white <?=($row['admin_id'] == NULL ? 'bg-primary' : 'bg-secondary')?>">
													<?=($row["seen"] ? "[SEEN] " : "") . substr($row["message"], 0, 100) . (strlen($row["message"]) > 100 ? "..." : "")?>
												</td>
												<td>
													<?php
													$dateDiff = strtotime(date('Y-m-d H:i:s')) - strtotime($row['date_time']);
													$days = $dateDiff / (60 * 60 * 24);
													$hours = $dateDiff / (60 * 60);
													$minutes = $dateDiff / 60;
													if ($days > 1) {
														$timePassed = floor($days) . 'd';
													}
													elseif ($hours > 1) {
														$timePassed = floor($hours) . 'h';
													}
													elseif ($minutes > 1) {
														$timePassed = floor($minutes) . 'm';
													} else {
														$timePassed = $dateDiff . 's';
													}
													?>
													<?=$timePassed?> ago
												</td>
												<td>
													<a href="messaging_view?id=<?=$row["user_id"]?>">
														<i class="fa fa-eye fa-lg text-primary p-1" aria-hidden="true"></i>
													</a>
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
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$("#table_messages").DataTable();
	});
</script>
</html>