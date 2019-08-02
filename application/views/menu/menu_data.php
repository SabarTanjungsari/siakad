 <!-- Begin Page Content -->
 <div class="container-fluid">
 	<?php $this->view('message') ?>
 	<div class="row">
 		<div class="col-lg-6">
 			<h1 class="h3 mb-2 text-gray-800">Menus</h1>
 		</div>
 		<div class="col-lg-6">
 			<a href="<?= site_url('menu/add') ?>" class="btn btn-primary btn-icon-split btn-sm float-right">
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
 					<td class="text-center">Icon</td>
 					<td class="text-center">Name</td>
 					<td class="text-center">Description</td>
 					<td class="text-center">Actions</td>
 				</tr>
 			</thead>
 			<tbody>
 				<?php $no = 1;
					foreach ($row->result() as $key => $data) { ?>
 					<tr>
 						<td class="text-right" style="width: 5%;"><?= $no++ ?>.</td>
 						<td class="text-center" width="50px">
 							<a href="#" class="btn btn-primary btn-circle btn-sm">
 								<i class="<?= $data->icon ?>"></i>
 							</a>
 						</td>
 						<td><?= $data->name ?></td>
 						<td><?= $data->description ?></td>
 						<td class="text-center" width="100px">
 							<a href="<?= site_url('menu/edit/' . $data->menu_id) ?>" class="btn btn-success btn-circle btn-sm">
 								<i class="fas fa-edit"></i>
 							</a>
 							<a href="<?= site_url('menu/delete/' . $data->menu_id) ?>" onclick="return confirm('Sure to delete data ?')" class="btn btn-danger btn-circle btn-sm">
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
