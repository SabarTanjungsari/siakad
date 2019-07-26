<div class="navbar-collapse collapse">
	<ul class="nav navbar-nav">
		<?php foreach ($menus as $menu) { ?>
			<li><a><?= $menu->name ?></a></li>
			<?php
			if (isset($menu->children)) {
				foreach ($menu->children as $child) {
					?>
					<li class="dropdown megamenu-fullwidth">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<</a> <ul class="dropdown-menu">
					<li class="megamenu-content">
						<ul class="col-lg-2 col-sm-2 col-md-2">
							<li class="no-border">
								<p><strong>Head</strong></p>
							</li>
							<li><a href="#"><?= $child->link ?><br></a></li>
						</ul>
					</li>
				</ul>
				</li>
			<?php
			}
		}
		?>
	<?php } ?>
	</ul>
</div>