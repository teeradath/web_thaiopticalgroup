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
<div class="alert alert-success" role="alert" id="text-pop" style="display: <?php echo @$success?>;"><span class="glyphicon glyphicon-ok"></span> Edit Article Success! </div>
<script>
$(document).ready(function() {
	setTimeout(function () {
        jQuery('#text-pop').slideUp("1500")
    }, 3000);
});
</script>
<?php echo form_open('tog_admin/article/'.$this->uri->segment(3));?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-list"></span> Article <small>"<?php echo @$article_array[0]['article_title']!=''?$article_array[0]['article_title']:'-'?>"</small></h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Article Infornation
			</div>
			<div class="panel-body">
				<!-- buttom -->
				<div class="form-horizontal" style="text-align: right;">
					<div class="form-group">
						<div class="col-sm-offset-6 col-sm-6">
							<?php echo anchor('tog_admin','Back','class="btn btn-primary"');?>
							<input type="submit" class="btn btn-primary" name="save" value="Save Article"/>
						</div>
					</div>
				</div>
				<!-- /buttom -->
				<hr/>
				<div class="col-sm-10">
					<ul id="myTab" class="nav nav-tabs nav-justified">
						<?php foreach ($article_array as $row): ?>
							<li class="<?php echo $row['lang_id']==1?'active':''; ?>">
								<a href="#tab-<?php echo $row['language']; ?>" data-toggle="tab"><img src="<?php echo base_url().$row['flag']; ?>" width="24" height="16" title="English" /> Language <?php echo $row['language_text']; ?></a>
							</li>
						<?php endforeach;?>
					</ul>      
					<div id="myTabContent" class="tab-content">
						<?php foreach ($article_array as $row2): ?>
							<div class="tab-pane fade <?php echo $row2['lang_id']==1?'active':''; ?> in" id="tab-<?php echo $row2['language']?>">
								<div class="form-group">
						        	<label for="txtTitle"><?php echo $this->lang->line('Title').' '.$row2['language_text'];?> :</label>
		    						<input type="text" class="form-control" name="txtTitle_<?php  echo $row2['language'];?>" placeholder="<?php echo $this->lang->line('Title').' '.$row2['language_text'];?>" value="<?php echo @$row2['article_title']?>">
						       	</div>
								<div class="form-group">
									<label for="areatxt">บทความ <?php echo $row2['language_text'];?> :</label>
									<textarea id="area_<?php echo $row2['language']; ?>" name="area_<?php echo $row2['language']; ?>"><?php echo @$row2['article_text']?></textarea>
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
<?php foreach ($article_array as $row3): ?>
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