 <!-- Begin Page Content -->
 <div class="container-fluid">
 	<?php $this->view('message') ?>
 	<div class="row">
 		<div class="col-lg-6">
 			<h1 class="h3 mb-2 text-gray-800">Users</h1>
 		</div>
 		<div class="col-lg-6">
 			<a href="<?= site_url('user/add') ?>" class="btn btn-primary btn-icon-split btn-sm float-right">
 				<span class="icon text-white-50">
 					<i class="fas fa-user-plus"></i>
 				</span>
 				<span class="text">Create</span>
 			</a>
 		</div>
 	</div>
 	<!-- DataTales Example -->
 	<div class="box-body table-responsive">
 		<table id="myTable" class="table table-bordered table-striped table-hover">
 			<thead>
 				<tr>
 					<td>#</td>
 					<td>Foto</td>
 					<td class="text-center">Name</td>
 					<td class="text-center">Email</td>
 					<td class="text-center">Role</td>
 					<td class="text-center">Actions</td>
 				</tr>
 			</thead>
 			<tbody>
 				<?php $no = 1;
					foreach ($row->result() as $key => $data) { ?>
 					<tr>
 						<td class="text-right" style="width: 5%;"><?= $no++ ?>.</td>
 						<td>
 							<?php if ($data->image != null) { ?>
 								<img src="<?= base_url('uploads/user/' . $data->image) ?>" style="width:50px;height:50px;">
 							<?php } else { ?>
 								<img src="<?= base_url('uploads/user/empty.png') ?>" style="width:50px;height:50px;">
 							<?php } ?>
 						</td>
 						<td><?= $data->name ?></td>
 						<td><?= $data->email ?></td>
 						<td><?= $data->role ?></td>
 						<td class="text-center" width="100px">
 							<a href="<?= site_url('user/edit/' . $data->user_id) ?>" class="btn btn-success btn-circle btn-sm">
 								<i class="fas fa-edit"></i>
 							</a>
 							<a href="<?= site_url('user/delete/' . $data->user_id) ?>" onclick="<?= $this->session->userdata('userid') == $data->user_id ? "return false" : "return confirm('Sure to delete data ?')" ?>" class="btn btn-danger btn-circle btn-sm <?= $this->session->userdata('userid') == $data->user_id ? 'disabled' : null ?>">
 								<i class="fas fa-trash"></i>
 							</a>
 						</td>
 					</tr>
 				<?php } ?>
 			</tbody>
 		</table>
 	</div>
 </div>
 <!-- /.container-fluid -->
