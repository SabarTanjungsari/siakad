 <!-- Begin Page Content -->
 <div class="container-fluid">
 	<?php $this->view('message') ?>
 	<div class="row">
 		<div class="col-lg-6">
 			<h1 class="h3 mb-2 text-gray-800"><?= ucfirst($page) ?> new User</h1>
 		</div>
 		<div class="col-lg-6">
 			<a href="<?= site_url('user') ?>" class="btn btn-primary btn-icon-split btn-sm float-right">
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
 						<?php echo	form_open_multipart('user/process', 'class="user"'); ?>
 						<div class="form-group row">
 							<div class="col-sm-6 mb-3 mb-sm-0">
 								<input type="hidden" name="page" value="<?= $page ?>">
 								<input type="hidden" name="user_id" value="<?= $row->user_id ?>">
 								<input type="text" name="username" value="<?= $row->name ?>" class="form-control <?= form_error('username') ? 'is-invalid' : null ?>" id="name" placeholder="Username">
 								<?= form_error('username') ?>
 							</div>
 							<div class="col-sm-6">
 								<input type="text" name="email" value="<?= $row->email ?>" class="form-control <?= form_error('email') ? 'is-invalid' : null ?>" id="email" placeholder="Email">
 								<?= form_error('email') ?>
 							</div>
 						</div>
 						<div class="form-group row">
 							<div class="col-sm-6 mb-3 mb-sm-0">
 								<input type="password" name="password" value="<?= $row->password ?>" class="form-control <?= form_error('password') ? 'is-invalid' : null ?>" id="password" placeholder="Password">
 								<?= form_error('password') ?>
 							</div>
 							<div class="col-sm-6">
 								<input type="password" name="passconf" value="<?= $row->password ?>" class="form-control <?= form_error('passconf') ? 'is-invalid' : null ?>" id="passconf" placeholder="Repeat Password">
 								<?= form_error('passconf') ?>
 							</div>
 						</div>
 						<div class="form-group row">
 							<div class="col-sm-6">
 								<select name="role" class="form-control <?= form_error('role') ? 'is-invalid' : null ?>">
 									<option value="">- Change Role -</option>
 									<?php foreach ($role->result() as $key => $data) { ?>
 										<option value="<?= $data->role_id ?>" <?= $data->role_id == $row->role_id ? 'selected' : null ?>><?= $data->name ?></option>
 									<?php } ?>
 								</select>
 								<?= form_error('role') ?>
 							</div>
 							<div class="col-sm-6">
 								<input type="text" name="description" value="<?= $row->description ?>" class="form-control" id="description" placeholder="Description">
 							</div>
 						</div>
 						<div class="form-group row">
 							<div class="col-sm-6">
 								<?php if ($row->image != null) { ?>
 									<div style="margin-bottom:5px">
 										<img src="<?= base_url('uploads/user/' . $row->image) ?>" class="rounded">
 									</div>
 								<?php } else { ?>
 									<img src="<?= base_url('uploads/user/empty.png') ?>" class="rounded">
 								<?php } ?>
 							</div>
 							<div class="col-sm-6 mb-3 mb-sm-0">
 								<input type="file" name="image" class="form-control">
 								<small class="text-info">(Biarkan kosong jika tidak <?= $page == 'edit' ? 'diganti' : 'ada' ?>)</small>
 							</div>
 						</div>
 						<hr />
 						<div class="form-group row">
 							<div class="col-lg-6">
 								<button type="submit" name="<?= $page ?>" class="btn btn-primary btn-user btn-block">
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
