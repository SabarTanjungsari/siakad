<?php if ($this->session->has_userdata('success')) { ?>
	<div id="message" class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fas fa-check-circle"> </i><?= strip_tags(str_replace('</p>', '', $this->session->flashdata('success'))); ?>
	</div>
<?php } ?>

<?php if ($this->session->has_userdata('error')) { ?>
	<div id="message" class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<i class="icon fas fa-ban"></i> <?= strip_tags(str_replace('</p>', '', $this->session->flashdata('error'))); ?>
	</div>
<?php } ?>
