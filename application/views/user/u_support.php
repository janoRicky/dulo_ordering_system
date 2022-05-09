
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
		text-decoration: underline;
		font-weight: bold;
	}
</style>
<body>
	<div class="wrapper bg">
		<?php $this->load->view("user/template/u_t_navbar"); ?>
		<div class="container-fluid">
			<div class="row mb-4 mt-4">
				<div class="col-0 col-sm-1"></div>
				<div class="col-12 col-sm-10 content pt-4">
					<div class="row mt-4">
						<div class="col-12 banner text-center">
							<div class="banner_board">
								<h5 class="font-weight-bold">&bull; Customer Support &bull;</h5>
							</div>
						</div>
					</div>
					<div class="row my-5">
						<div class="col-0 col-sm-1"></div>
						<div class="col-12 col-sm-10">
							<div class="row mt-2">
								<div id="message_container" class="col-12 col-sm-7 mt-1" style="max-height: 80vh; overflow-y: scroll;">
									<?php 
									$msg_remaining = $tbl_messages_all->num_rows() - ($tbl_page * 10);
									?>
									<?php if ($tbl_messages_all->num_rows() > 10 && $msg_remaining - 10 > 0): ?>
										<div class="row m-1">
											<?=form_open(base_url() . "customer_support", "method='GET' class='w-100 text-center'")?>
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
												<div class="col-4 font-italic text-center" style="color: grey; font-size: 0.75rem;">
													<?=$row["date_time"]?>
												</div>
												<div class="col-8 bg-primary mr-auto px-3 py-2 text-end" style="color: #fff; border-radius: 0.35rem; word-break: break-word; max-width: 90%;">
													<?=$row["message"]?>
												</div>
											</div>
										<?php else: ?>
											<div class="row m-1 align-items-center">
												<div class="col-8 bg-secondary ml-auto px-3 py-2 text-start" style="color: #fff; border-radius: 0.35rem; word-break: break-word;">
													<?=$row["message"]?>
												</div>
												<div class="col-4 font-italic text-center" style="color: grey; font-size: 0.75rem;">
													<?php if ($row["admin_id"] == "0"): ?>
														[SYSTEM]
													<?php else: ?>
														Admin #<?=$row["admin_id"]?>
													<?php endif; ?>
													<br> <?=$row["date_time"]?>
												</div>
											</div>
										<?php endif; ?>
									<?php endfor; ?>
									<?php if ($tbl_messages_all->num_rows() > $msg_remaining): ?>
										<div class="row m-1">
											<?=form_open(base_url() . "customer_support", "method='GET' class='w-100 text-center'")?>
												<input type="hidden" name="pg" value="<?=$tbl_page - 1?>">
												<button class="older_messages" type="submit">
													Newer messages (<?=($tbl_messages_all->num_rows() - $msg_remaining)?>)
												</button>
											<?=form_close()?>
										</div>
									<?php endif; ?>
								</div>
								<div class="col-12 col-sm-5 mt-1">
									<?=form_open(base_url() . "send_message", "method='POST'")?>
										<input type="hidden" name="inp_user_id" value="<?=$user_id?>">
										<textarea class="form-control" name="inp_message" placeholder="Your message here..." style="resize: none;" required=""></textarea>
										<button class="btn btn-primary pull-right font-weight-bold px-2 py-1 mt-1" type="submit">
											Send <i class="fa fa-caret-right fa-lg" aria-hidden="true"></i>
										</button>
									<?=form_close()?>
								</div>
							</div>
						</div>
						<div class="col-0 col-sm-1"></div>
					</div>
				</div>
				<div class="col-0 col-sm-1"></div>
			</div>
		</div>
		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		$("#message_container").animate({ scrollTop: $("#message_container").height() }, 100);
		$("#message_container").get(0).scrollIntoView();
	});
</script>
</html>