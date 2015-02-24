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
<?php echo form_open_multipart('tog_admin/form_56_1_edit/'.$this->uri->segment(3),'id="form1"');?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-paperclip"></span> แก้ไข แบบฟอร์ม 56-1</h1>
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
							<?php echo anchor('tog_admin/form_56_1_list','Back','class="btn btn-primary"');?>
							<input type="submit" id="btnSave" class="btn btn-primary" name="save" value="Save"/>
						</div>
					</div>
				</div>
				<!-- /Button -->
				<hr/>
				<div class="col-sm-10" >
					<div class="form-horizontal" style="padding: 0 15px;">
						<div class="form-group <?php echo (form_error("num_year")!=""?"has-error":"");?>">
					        <label>ปี พ.ศ.</label>
					        <input type="number" name="num_year" class="form-control" placeholder="ปี พ.ศ." value="<?php echo @$form56_arr[0]['form_year']?>">
					        <?php echo form_error("num_year","<font color='error'>","</font>");?>
					    </div>
				  	</div>
				</div>
				<div class="col-sm-10">
					<ul id="myTab" class="nav nav-tabs nav-justified">
						<?php foreach ($form56_arr as $row): ?>
							<li class="<?php echo $row['lang_id']==1?'active':''; ?>">
								<a href="#news-<?php echo $row['language']; ?>" data-toggle="tab"><img src="<?php echo base_url().$row['flag']; ?>" width="24" height="16" title="English" /> Language <?php echo $row['language_text']; ?></a>
							</li>
						<?php endforeach;?>
					</ul>      
					<div id="myTabContent" class="tab-content">
						<?php foreach ($form56_arr as $row2): ?>
							<div class="tab-pane fade <?php echo $row2['lang_id']==1?'active':''; ?> in" id="news-<?php echo $row2['language']?>">
								<div class="form-group">
									<label for="fileName_<?php echo $row2['language'];?>" style="color: green"><?php echo $row2['url_file']?></label><br>
									<label for="file_<?php echo $row2['language'];?>"><?php echo 'ไฟล์ '.$row2['language_text'];?> <font color="error"> ".zip|.rar|.pdf" </font> :</label>
									<input type="file" class="form-control" name="file_<?php echo $row2['language'];?>" placeholder="<?php echo 'ไฟล์ '.$row2['language_text'];?>">
								</div>
							</div>
						<?php endforeach;?>
					</div>
				</div>  
			</div>
		</div>
	</div>
</div>
<?php echo form_close();?>