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
<div class="alert alert-success" role="alert" id="text-pop" style="display: <?php echo @$status=='success'?'block':'none'?>;"><span class="glyphicon glyphicon-ok"></span> Edit Gallery Success! </div>
<div class="alert alert-danger" role="alert" id="text-pop2" style="display: <?php echo @$status=='error'?'block':'none'?>;"><span class="glyphicon glyphicon-remove"></span> <?php echo @$msg_err;?> </div>
<script>
$(document).ready(function() {
	setTimeout(function () {
        jQuery('#text-pop').slideUp("1500")
    }, 3000);
});
</script>
<?php echo form_open_multipart('tog_admin/gallery_edit/'.$this->uri->segment(3));?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-camera"></span> Edit Category Gallery <small>"<?php echo $arr_gallery[0]['gal_category']?>"</small></h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Gallery Infornation
			</div>
			<div class="panel-body">
				<!-- Button -->
				<div class="form-horizontal" style="text-align: right;">
					<div class="form-group">
						<div class="col-sm-offset-10 col-sm-2">
							<?php echo anchor('tog_admin/gallery_list','Back','class="btn btn-primary"');?>
							<input type="submit" class="btn btn-primary" name="save" value="Save Category"/>
						</div>
					</div>
				</div>
				<!-- /Button -->
				<hr/>
				<div class="form-horizontal">
					<div class="form-group">
					    <div class="col-sm-10" style="text-align: center;">
					      <div class="form-group">
					      	<p><img src="<?php echo base_url().$arr_gallery[0]['gal_image_url']?>" style="border: 1px solid #ccc"></p>
					      	<label>Category Image </label> <label style="color: #E05353">"ขนาดไม่เกิน 400x350 Pixel"</label><br/>
					        <input type="file" name="file_image" value="<?php echo @$_POST['file_image'];?>" style="display: inline;border: 1px solid silver;">
					        <font color="error"><?php echo @$image_error;?></font>
					      </div>
					    </div>
				  	</div>
				</div>
				<div class="col-sm-10">
					<ul id="myTab" class="nav nav-tabs nav-justified">
						<?php foreach ($arr_gallery as $row): ?>
							<li class="<?php echo $row['lang_id']==1?'active':''; ?>">
								<a href="#tab-<?php echo $row['language']; ?>" data-toggle="tab"><img src="<?php echo base_url().$row['flag']; ?>" width="24" height="16" title="English" /> Language <?php echo $row['language_text']; ?></a>
							</li>
						<?php endforeach;?>
					</ul>      
					<div id="myTabContent" class="tab-content">
						<?php foreach ($arr_gallery as $row2): ?>
							<div class="tab-pane fade <?php echo $row2['lang_id']==1?'active':''; ?> in" id="tab-<?php echo $row2['language']?>">
								<div class="form-group">
						        	<label for="txtTitle"><?php echo $this->lang->line('Title').' '.$row2['language_text'];?> :</label>
		    						<input type="text" class="form-control" name="txtCategory_<?php  echo $row2['language'];?>" placeholder="<?php echo $this->lang->line('Title').' '.$row2['language_text'];?>" value="<?php echo $row2['gal_category'];?>">
						       	</div>
								<div class="form-group">
									<label for="txtDesc"><?php echo $this->lang->line('Description').' '.$row2['language_text'];?> :</label>
									<input type="text" class="form-control" name="txtDesc_<?php echo $row2['language'];?>" placeholder="<?php echo $this->lang->line('Description').' '.$row2['language_text'];?>" value="<?php echo $row2['gal_description'];?>">
								</div>
								<div class="form-group">
									<label for="txtDesc"><?php echo 'ข้อความ หรือ บทความ '.$row2['language_text'];?> :</label>
									<textarea id="area_<?php echo $row2['language']; ?>" name="area_<?php echo $row2['language']; ?>"><?php echo $row2['gal_text'];?></textarea>
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
<script>
<?php foreach ($arr_gallery as $row3): ?>
	CKEDITOR.replace('area_<?php echo $row3['language'];?>', {  
		filebrowserBrowseUrl : '<?php echo base_url(); ?>ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl : '<?php echo base_url(); ?>ckfinder/ckfinder.html?Type=Images',
		filebrowserFlashBrowseUrl : '<?php echo base_url(); ?>ckfinder/ckfinder.html?Type=Flash',
		filebrowserUploadUrl : '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl : '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl : '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	});	
<?php endforeach;?>
</script>