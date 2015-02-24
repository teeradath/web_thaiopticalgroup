<style>
<!--
.tab-content {
    border-left: 1px solid #ddd;
    border-right: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 10px;
}
-->
</style>
<?php //echo validation_errors(); ?>
<div class="alert alert-danger" role="alert" id="text-pop11" style="display:<?php echo  @$add_error!=''?'block':'none'?>;"><span class="glyphicon glyphicon-remove"></span> <?php echo  strip_tags(@$add_error)?>! </div>
<?php echo form_open('tog_admin/user_edit/'.$this->uri->segment(3),'id="form1"');?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-user"></span> Edit User</h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Infornation
			</div>
			<div class="panel-body">
				<!-- Button -->
				<div class="form-horizontal" style="text-align: right;">
					<div class="form-group">
						<div class="col-sm-offset-6 col-sm-6">
							<?php echo anchor('tog_admin/users','Back','class="btn btn-primary"');?>
							<input type="submit" id="btnSave" class="btn btn-primary" name="save" value="Save"/>
						</div>
					</div>
				</div>
				<!-- /Button -->
				<hr/>
				<div class="col-sm-10" >
					<div class="form-horizontal" style="padding: 0 15px;">
						<div class="form-group <?php echo (form_error("txt_fullname")!=""?"has-error":"");?>">
					        <label>ชื่อ-สกุล :</label>
					        <input type="text" name="txt_fullname" class="form-control" placeholder="ชื่อ-สกุล..." value="<?php echo @$this->input->post('txt_fullname')!=""?@$this->input->post('txt_fullname'):$user_row->full_name?>">
					        <?php echo form_error("txt_fullname","<font color='error'>","</font>");?>
					    </div>
					    <div class="form-group <?php echo (form_error("txt_email")!=""?"has-error":"");?>">
					        <label>Email :</label>
					        <input type="email" name="txt_email" class="form-control" placeholder="Email..." value="<?php echo @$this->input->post('txt_email')!=""?@$this->input->post('txt_email'):$user_row->user_email?>">
					        <?php echo form_error("txt_email","<font color='error'>","</font>");?>
					    </div>
					    <div class="form-group <?php echo (form_error("txt_pass")!=""?"has-error":"");?>">
					        <label>Password :</label>
					        <input type="password" name="txt_pass" class="form-control" placeholder="Password...">
					        <?php echo form_error("txt_pass","<font color='error'>","</font>");?>
					    </div>
					    <div class="form-group <?php echo (form_error("dd_roles")!=""?"has-error":"");?>">
					        <label>Roles :</label>
					        <?php echo form_dropdown('dd_roles',$dd_roles,@$_POST['dd_roles']!=""?@$_POST['dd_roles']:$user_row->roles_id,'class="form-control"')?>
					        <?php echo form_error("dd_roles","<font color='error'>","</font>");?>
					    </div>
				  	</div>
				</div> 
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="old_email" value="<?php echo $user_row->user_email?>" >
<?php echo form_close();?>