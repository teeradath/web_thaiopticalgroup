<?php echo form_open('tog_admin/financial_edit/'.$this->uri->segment(3));?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-list-alt"></span> Edit Financial</h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Financial Infornation
			</div>
			<div class="panel-body">
				<!-- Button -->
				<div class="form-horizontal" style="text-align: right;">
					<div class="form-group">
						<div class="col-sm-offset-6 col-sm-6">
							<?php echo anchor('tog_admin/financial_list','Back','class="btn btn-primary"');?>
							<input type="submit" class="btn btn-primary" name="save" value="Save Financial"/>
						</div>
					</div>
				</div>
				<!-- /Button -->
				<hr/>
				
			<div class="col-sm-10">
				<div class="form-inline" role="form">
  					<div class="form-group <?php echo (form_error("year")!=""?"has-error":"");?>" >
						<label for="year">ปี :</label>
						<input type="number" name="year" class="form-control" value="<?php echo @$is_year->year?>">
						 <?php echo form_error("year","<font color='error'>","</font>");?>
					</div>
				</div>
			</div>
				  	
			</div>
		</div>
	</div>
</div>
<?php echo form_close();?>