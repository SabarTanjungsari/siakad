 <!-- Begin Page Content -->
 <div class="container-fluid">
 	<?php $this->view('message') ?>
 	<div class="row">
 		<div class="col-lg-6">
 			<h1 class="h3 mb-2 text-gray-800"><?= ucfirst($page) ?> new menu</h1>
 		</div>
 		<div class="col-lg-6">
 			<a href="<?= site_url('menu') ?>" class="btn btn-primary btn-icon-split btn-sm float-right">
 				<span class="icon text-white-50">
 					<i class="fas fa-undo"></i>
 				</span>
 				<span class="text">Back</span>
 			</a>
 		</div>
 	</div>

 	<div class="card o-hidden border-0 shadow-lg my-5">
 		<div class="card-body p-0">
 			<!-- Nested Row within Card Body -->
 			<div class="row">
 				<div class="col-lg">
 					<div class="p-5">
 						<?php echo	form_open_multipart('menu/process', 'class="user"'); ?>
 						<div class="form-group row">
 							<div class="col-sm-6 mb-3 mb-sm-0">
 								<input type="hidden" name="page" value="<?= $page ?>">
 								<input type="hidden" name="menu_id" value="<?= $row->menu_id ?>">
 								<input type="text" name="name" value="<?= $row->name ?>" class="form-control form-control-user <?= form_error('name') ? 'is-invalid' : null ?>" id="name" placeholder="Name">
 								<?= form_error('name') ?>
 							</div>
 							<div class="col-sm-6 mb-3 mb-sm-0">
 								<input type="text" name="link" value="<?= $row->link ?>" class="form-control form-control-user <?= form_error('link') ? 'is-invalid' : null ?>" id="link" placeholder="Link">
 								<?= form_error('link') ?>
 							</div>
 						</div>
 						<div class="form-group row">
 							<div class="col-sm">
 								<input type="description" name="description" value="<?= $row->description ?>" class="form-control form-control-user <?= form_error('description') ? 'is-invalid' : null ?>" id="description" placeholder="Description">
 								<?= form_error('description') ?>
 							</div>
 						</div>
 						<hr />
 						<div class="form-group row">
 							<div class="col-lg-6">
 								<button type="submit" name="<?= $page ?>" class="btn btn-success btn-user btn-block">
 									<i class="fab fa-telegram"></i> Save
 								</button>
 							</div>
 							<div class="col-lg-6">
 								<button type="Reset" class="btn btn-secondary btn-user btn-block">
 									<i class="fa fa-dot-circle"></i>
 									Reset</button>
 							</div>
 						</div>
 						<?php echo form_close(); ?>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>