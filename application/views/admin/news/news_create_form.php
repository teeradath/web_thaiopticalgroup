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
<?php echo form_open('tog_admin/news_add');?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-book"></span> Create News</h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				News Infornation
			</div>
			<div class="panel-body">
				<!-- Button -->
				<div class="form-horizontal" style="text-align: right;">
					<div class="form-group">
						<div class="col-sm-offset-10 col-sm-2">
							<?php echo anchor('tog_admin/news_list','Back','class="btn btn-primary"');?>
							<input type="submit" class="btn btn-primary" name="save" value="Save News"/>
						</div>
					</div>
				</div>
				<!-- /Button -->
				<hr/>
				<div class="form-horizontal">
					<div class="form-group">
					    <div class="col-sm-10">
					      <div class="checkbox" style="margin-left: 15px;">
					        <label><input type="checkbox" checked name="isFrontPage" value="1"/> Show Front Page</label>
					      </div>
					    </div>
				  	</div>
				</div>
				<div class="col-sm-10">
					<ul id="myTab" class="nav nav-tabs nav-justified">
						<?php foreach ($arr_lang as $row): ?>
							<li class="<?php echo $row['lang_id']==1?'active':''; ?>">
								<a href="#news-<?php echo $row['language']; ?>" data-toggle="tab"><img src="<?php echo base_url().$row['flag']; ?>" width="24" height="16" title="English" /> Language <?php echo $row['language_text']; ?></a>
							</li>
						<?php endforeach;?>
					</ul>      
					<div id="myTabContent" class="tab-content">
						<?php foreach ($arr_lang as $row2): ?>
							<div class="tab-pane fade <?php echo $row2['lang_id']==1?'active':''; ?> in" id="news-<?php echo $row2['language']?>">
								<div class="form-group">
						        	<label for="txtTitle"><?php echo $this->lang->line('Title').' '.$row2['language_text'];?> :</label>
		    						<input type="text" class="form-control" name="txtTitle_<?php  echo $row2['language'];?>" placeholder="<?php echo $this->lang->line('Title').' '.$row2['language_text'];?>">
						       	</div>
								<div class="form-group">
									<label for="txtDesc"><?php echo $this->lang->line('Description').' '.$row2['language_text'];?> :</label>
									<input type="text" class="form-control" name="txtDesc_<?php echo $row2['language'];?>" placeholder="<?php echo $this->lang->line('Description').' '.$row2['language_text'];?>">
								</div>
								<div class="form-group">
									<label for="txtDesc"><?php echo $this->lang->line('News').' '.$row2['language_text'];?> :</label>
									<textarea id="area_<?php echo $row2['language']; ?>" name="area_<?php echo $row2['language']; ?>"></textarea>
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
<?php foreach ($arr_lang as $row3): ?>
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