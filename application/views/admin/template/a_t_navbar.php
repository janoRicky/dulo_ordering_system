<div id="navbar" class="col-12 p-1 position-fixed text-start navbar text-light font-weight-bold bg-dark">
	<div class="col-12">
		<button id="sidebar_toggle" class="bg-transparent border-0 text-light mr-2" style="font-size: 1.2rem; padding: 0.5rem 0.5rem; cursor: pointer;">
			<i class="fa fa-navicon" aria-hidden="true"></i>
		</button>
		<?php foreach ($nav as $key => $val): ?>
			<?php if ($key > 0): ?>
				<span> / </span>
			<?php endif; ?>
			<a href="<?=$val['link']?>"><?=$val['text']?></a>
		<?php endforeach; ?>
		<div class="dropdown pull-right">
			<button class="btn btn-link dropdown-toggle btn-sm text-light font-weight-bold" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
				<?=$this->session->userdata("admin_name")?>
			</button>
			<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
				<li><a class="dropdown-item" href="#">Action</a></li>
				<li><a class="dropdown-item" href="#">Another action</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="logout">Logout</a></li>
			</ul>
		</div>
	</div>
</div>