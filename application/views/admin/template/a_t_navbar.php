<div id="navbar" class="col-12 p-1 position-fixed text-start navbar text-light fw-bold bg-dark">
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
			<button class="btn btn-link dropdown-toggle btn-sm text-light fw-bold" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
				<?=$this->session->userdata("admin_name")?>
			</button>
			<ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
				<li><a class="dropdown-item text-light text-center" href="accounts_view?id=<?=$this->session->userdata("admin_id")?>">My Info</a></li>
				<li><a class="dropdown-item text-light text-center" href="accounts_edit?id=<?=$this->session->userdata("admin_id")?>">Update Account</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item text-light text-center" href="logout">Logout</a></li>
			</ul>
		</div>
	</div>
</div>