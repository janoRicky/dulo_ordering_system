
<?php
$template_header;
?>
<body>
	<div class="wrapper">
		<?php $this->load->view("user/template/u_t_navbar"); ?>

		<div class="row my-4">
			<div class="col-0 col-sm-1 col-md-2"></div>
			<div class="col-12 col-sm-10 col-md-8">
				<div id="test1" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner" style="max-height: 500px; border-radius: 2rem;">
						<div class="carousel-item active">
							<img src="<?=base_url('assets/img/test-1.jpg')?>" alt="Los Angeles" class="d-block w-100">
						</div>
						<div class="carousel-item">
							<img src="<?=base_url('assets/img/test-1.jpg')?>" alt="Chicago" class="d-block w-100">
						</div>
						<div class="carousel-item">
							<img src="<?=base_url('assets/img/test-1.jpg')?>" alt="New York" class="d-block w-100">
						</div>
					</div>
					
					<button class="carousel-control-prev" type="button" data-bs-target="#test1" data-bs-slide="prev">
						<div class="bg-dark bg-opacity-25 rounded-circle p-2">
							<span class="carousel-control-prev-icon"></span>
						</div>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#test1" data-bs-slide="next">
						<div class="bg-dark bg-opacity-25 rounded-circle p-2">
							<span class="carousel-control-next-icon"></span>
						</div>
					</button>
				</div>
			</div>
			<div class="col-0 col-sm-1 col-md-2"></div>
		</div>
		<div class="row my-4">
			<div class="col-0 col-sm-1 col-md-2"></div>
			<div class="col-12 col-sm-10 col-md-8">
				<div id="test2" class="carousel slide" data-bs-ride="carousel">
					<div class="carousel-inner p-4" style="">
						<div class="carousel-item active">
							<div class="row">
								<div class="col-6">
									<div class="card shadow" style="">
										<img src="<?=base_url('assets/img/test-3.jpg')?>" class="card-img-top" alt="...">
										<div class="card-body">
											<h4>PHP 100,000.99</p>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="card shadow" style="">
										<img src="<?=base_url('assets/img/test-2.jpg')?>" class="card-img-top" alt="...">
										<div class="card-body">
											<h4>PHP 100,000.99</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="row">
								<div class="col-6">
									<div class="card shadow" style="">
										<img src="<?=base_url('assets/img/test-3.jpg')?>" class="card-img-top" alt="...">
										<div class="card-body">
											<h4>PHP 100,000.99</p>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="card shadow" style="">
										<img src="<?=base_url('assets/img/test-2.jpg')?>" class="card-img-top" alt="...">
										<div class="card-body">
											<h4>PHP 100,000.99</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="row">
								<div class="col-6">
									<div class="card shadow" style="">
										<img src="<?=base_url('assets/img/test-2.jpg')?>" class="card-img-top" alt="...">
										<div class="card-body">
											<h4>PHP 100,000.99</p>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="card shadow" style="">
										<img src="<?=base_url('assets/img/test-3.jpg')?>" class="card-img-top" alt="...">
										<div class="card-body">
											<h4>PHP 100,000.99</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<button class="carousel-control-prev" type="button" data-bs-target="#test2" data-bs-slide="prev">
						<div class="bg-dark bg-opacity-25 rounded-circle p-2">
							<span class="carousel-control-prev-icon"></span>
						</div>
					</button>
					<button class="carousel-control-next" type="button" data-bs-target="#test2" data-bs-slide="next">
						<div class="bg-dark bg-opacity-25 rounded-circle p-2">
							<span class="carousel-control-next-icon"></span>
						</div>
					</button>
				</div>
			</div>
			<div class="col-0 col-sm-1 col-md-2"></div>
		</div>

		<?php $this->load->view("user/template/u_t_footer"); ?>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function () {
		
		// var feat_ctr = 1;
		// $(window).on("resize", function(e) {
		// 	$(".feat_item").each(function(index, el) {
		// 		$(this).addClass("d-none");
		// 	});
		// 	if ($(window).width() < 568) {
		// 		$(".feat_item.item_" + feat_ctr).removeClass("d-none").find("img").css({width: "100%", "float": "center"});
		// 	} else {
		// 		$(".feat_item").each(function(index, el) {
		// 			$(this).removeClass("d-none");
		// 		});
		// 	}
		// });
		// $(window).trigger("resize");
		// setInterval(function() {
		// 	var feat_1 = feat_ctr;
		// 	var feat_2 = feat_ctr + 1;
		// 	var feat_3 = feat_ctr + 2;
		// 	if (feat_2 > $(".feat_item").length) {
		// 		feat_2 = 1;
		// 		feat_3 = 2;
		// 	} else if (feat_3 > $(".feat_item").length) {
		// 		feat_3 = 1;
		// 	}

		// 	$(".feat_item.item_" + feat_1).fadeOut(300, function() {
		// 		if ($(window).width() >= 568) {
		// 			$(this).fadeIn(1000)
		// 			.find("img").css({width: "75%", "float": "left"});
		// 		}
		// 	});
		// 	if ($(window).width() < 568) {
		// 		$(".feat_item.item_" + feat_1).addClass("d-none");
		// 	}
		// 	$(".feat_item.item_" + feat_2).fadeOut(300, function() {
		// 		if ($(window).width() < 568) {
		// 			$(this).removeClass("d-none");
		// 		}
		// 		$(this).fadeIn(1000)
		// 		.find("img").css({width: "100%", "float": "center"});
		// 	});
		// 	$(".feat_item.item_" + feat_3).fadeOut(300, function() {
		// 		if ($(window).width() >= 568) {
		// 			$(this).prependTo(".feat_container").fadeIn(1000)
		// 			.find("img").css({width: "75%", "float": "right"});
		// 		}
		// 	});
		// 	if ($(window).width() < 568) {
		// 		$(".feat_item.item_" + feat_3).addClass("d-none");
		// 	}

		// 	if (feat_ctr >= $(".feat_item").length) {
		// 		feat_ctr = 1;
		// 	} else {
		// 		feat_ctr += 1;
		// 	}
		// }, 5000);
	});
</script>
</html>