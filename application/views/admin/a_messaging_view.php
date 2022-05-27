
<?php
$template_header;
?>
<style type="text/css">
	.older_messages {
		background-color: rgba(0, 0, 0, 0);
		border: 0;
		color: #4285f4;
		cursor: pointer;
		word-break: break-word;
		max-width: 90%;
	}
	.older_messages:hover {
		text-decoration: underline;
	}
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
						
						<div class="row view_container">
							<div class="col-12 text-start">
								<?php $user_info = $this->Model_read->get_user_acc_wid($row_info["user_id"])->row_array(); ?>
								<h2>
									Message <a href="users_view?id=<?=$row_info["user_id"]?>">User #<?=$row_info["user_id"]?></a>
								</h2>
								<h5 class="text-muted"><?=$user_info["name_last"]?> , <?=$user_info["name_first"]?></h5>
							</div>
							<div class="col-12 col-sm-10 mx-auto">
								<div class="row mt-2">
									<div id="message_container" class="col-12 col-sm-7 mt-1" style="max-height: 80vh; overflow-y: scroll;">
										<?php 
										$msg_remaining = $tbl_messages_all->num_rows() - ($tbl_page * 10);
										?>
										<?php if ($tbl_messages_all->num_rows() > 10 && $msg_remaining - 10 > 0): ?>
											<div class="row m-1">
												<?=form_open(base_url() . "admin/messaging_view", "method='GET' class='w-100 text-center'")?>
													<input type="hidden" name="id" value="<?=$row_info["user_id"]?>">
													<input type="hidden" name="pg" value="<?=$tbl_page + 1?>">
													<button class="older_messages" type="submit">
														Older messages (<?=$msg_remaining - 10?>)
													</button>
												<?=form_close()?>
											</div>
										<?php endif; ?>
										<?php $messages = $tbl_messages->result_array();
										for ($i = count($messages) - 1; $i >= 0; $i--): 
											$row = $messages[$i];
											?>
											<?php if ($row["admin_id"] == NULL): ?>
												<div class="row m-1 align-items-center">
													<div class="col-8 bg-primary mr-auto px-3 py-2 text-start" style="color: #fff; border-radius: 0.35rem; word-break: break-word; max-width: 90%;">
														<?=$row["message"]?>
													</div>
													<div class="col-4 font-italic text-center" style="color: grey; font-size: 0.75rem;">
														<?=$row["date_time"]?>
													</div>
												</div>
											<?php else: ?>
												<div class="row m-1 align-items-center">
													<div class="col-4 font-italic text-center" style="color: grey; font-size: 0.75rem;">
														<?php if ($row["admin_id"] == "0"): ?>
															[SYSTEM]
														<?php else: ?>
															Admin #<?=$row["admin_id"]?>
														<?php endif; ?>
														<br><?=$row["date_time"]?>
													</div>
													<div class="col-8 bg-secondary ml-auto px-3 py-2 text-end" style="color: #fff; border-radius: 0.35rem; word-break: break-word;">
														<?=$row["message"]?>
													</div>
												</div>
											<?php endif; ?>
										<?php endfor; ?>
										<?php if ($tbl_messages_all->num_rows() > $msg_remaining): ?>
											<div class="row m-1">
												<?=form_open(base_url() . "admin/messaging_view", "method='GET' class='w-100 text-center'")?>
													<input type="hidden" name="id" value="<?=$row_info["user_id"]?>">
													<input type="hidden" name="pg" value="<?=$tbl_page - 1?>">
													<button class="older_messages" type="submit">
														Newer messages (<?=($tbl_messages_all->num_rows() - $msg_remaining)?>)
													</button>
												<?=form_close()?>
											</div>
										<?php endif; ?>
									</div>
									<div class="col-12 col-sm-5 mt-1">
										<?=form_open(base_url() . "admin/message_send", "method='POST'")?>
											<input type="hidden" name="inp_user_id" value="<?=$row_info["user_id"]?>">
											<textarea class="form-control" name="inp_message" placeholder="Your message here..." style="resize: none;" required=""></textarea>
											<button class="btn btn-primary pull-right fw-bold px-2 py-1 mt-1" type="submit">
												Send <i class="fa fa-caret-right fa-lg" aria-hidden="true"></i>
											</button>
										<?=form_close()?>
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
	$(document).ready(function () {
		$("#message_container").animate({ scrollTop: $("#message_container").height() }, 100);
		$("#message_container").get(0).scrollIntoView();
	});
</script>
</html>