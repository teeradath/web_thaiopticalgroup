<?php echo form_open('tog_admin/settings')?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="fa fa-gear fa-fw"></span> Settings</h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-2">
		<label>ชื่อ-สกุล : </label>
	</div>
	<div class="col-lg-6">
		<div class="form-group <?php echo (form_error("txt_fullname")!=""?"has-error":"");?>">
				<input type="text" class="form-control" name="txt_fullname" value="<?php echo $user_row->full_name?>"/>
				<?php echo form_error("txt_fullname","<font color='error'>","</font>");?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-2">
		<label>E-mail : </label>
	</div>
	<div class="col-lg-6">
		<div class="form-group <?php echo (form_error("txt_email")!=""?"has-error":"");?>">
				<input type="email" class="form-control" name="txt_email" value="<?php echo @$_POST['txt_email']!=null?@$_POST['txt_email']:$user_row->user_email?>"/>
				<?php echo form_error("txt_email","<font color='error'>","</font>");?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-2">
		<label>Old Password : </label>
	</div>
	<div class="col-lg-6">
		<div class="form-group <?php echo (form_error("txt_oldpass")!=""?"has-error":"");?>">
				<input type="password" class="form-control" name="txt_oldpass" placeholder="Old password..." value="<?php echo @$_POST['txt_oldpass']?>"/>
				<?php echo form_error("txt_oldpass","<font color='error'>","</font>");?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-2">
		<label>New Password : </label>
	</div>
	<div class="col-lg-6">
		<div class="form-group <?php echo (form_error("txt_newpass")!=""?"has-error":"");?>">
				<input type="password" class="form-control" name="txt_newpass" placeholder="New password..." value="<?php echo @$_POST['txt_newpass']?>"/>
				<?php echo form_error("txt_newpass","<font color='error'>","</font>");?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-2">
		<label>Roles : </label>
	</div>
	<div class="col-lg-3 ">
		<div class="form-group">
			<?php echo form_dropdown('dd_roles',$dd_roles,$user_row->roles_id,'class="form-control"')?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-lg-offset-2" style="text-align: right;">
		<input type="submit" class="btn btn-success" name="save" value="Settings">
	</div>
</div>
<?php echo form_close();?>