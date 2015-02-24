<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="fa fa-user fa-fw"></span> Profile</h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-2">
		<label>ชื่อ-สกุล : </label>
	</div>
	<div class="col-lg-10">
		<?php echo $user_row->full_name?>
	</div>
</div>

<div class="row">
	<div class="col-lg-2">
		<label>E-mail : </label>
	</div>
	<div class="col-lg-10">
		<?php echo $user_row->user_email?>
	</div>
</div>

<div class="row">
	<div class="col-lg-2">
		<label>Roles : </label>
	</div>
	<div class="col-lg-10">
		<?php echo $user_row->roles_name?>
	</div>
</div>