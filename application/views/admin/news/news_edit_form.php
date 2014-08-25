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
<div class="alert alert-success" role="alert" id="text-pop" style="display: <?php echo $success?>;"><span class="glyphicon glyphicon-ok"></span> Edit News Success! </div>
<script>
$(document).ready(function() {
	setTimeout(function () {
        jQuery('#text-pop').slideUp("1500")
    }, 3000);
});
</script>

<?php echo form_open('tog_admin/news_edit/'.$this->uri->segment(3));?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-book"></span> Edit News <small>"<?php echo $arr_news[0]['news_title']?>"</small></h1>
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
				<!-- buttom -->
				<div class="form-horizontal" style="text-align: right;">
					<div class="form-group">
						<div class="col-sm-offset-10 col-sm-2">
							<?php echo anchor('tog_admin/news_list','Back','class="btn btn-primary"');?>
							<input type="submit" class="btn btn-primary" name="save" value="Save News"/>
						</div>
					</div>
				</div>
				<!-- /buttom -->
				<hr/>
				<div class="form-horizontal">
					<div class="form-group">
					    <div class="col-sm-10">
					      <div class="checkbox" style="margin-left: 15px;">
					        <label><input type="checkbox" name="isFrontPage" value="1" <?php echo $arr_news[0]['is_front_page']==1?'checked':''?>> Show Front Page</label>
					      </div>
					    </div>
				  	</div>
				</div>
				<div class="col-sm-10">
					<ul id="myTab" class="nav nav-tabs nav-justified">
						<?php foreach ($arr_news as $row): ?>
							<li class="<?php echo $row['lang_id']==1?'active':''; ?>">
								<a href="#news-<?php echo $row['language']; ?>" data-toggle="tab"><img src="<?php echo base_url().$row['flag']; ?>" width="24" height="16" title="English" /> Language <?php echo $row['language_text']; ?></a>
							</li>
						<?php endforeach;?>
					</ul>      
					<div id="myTabContent" class="tab-content">
						<?php foreach ($arr_news as $row2): ?>
							<div class="tab-pane fade <?php echo $row2['lang_id']==1?'active':''; ?> in" id="news-<?php echo $row2['language']?>">
								<div class="form-group">
						        	<label for="txtTitle"><?php echo $this->lang->line('Title').' '.$row2['language_text'];?> :</label>
		    						<input type="text" class="form-control" name="txtTitle_<?php  echo $row2['language'];?>" placeholder="<?php echo $this->lang->line('Title').' '.$row2['language_text'];?>" value="<?php echo $row2['news_title']?>">
						       	</div>
								<div class="form-group">
									<label for="txtDesc"><?php echo $this->lang->line('Description').' '.$row2['language_text'];?> :</label>
									<input type="text" class="form-control" name="txtDesc_<?php echo $row2['language'];?>" placeholder="<?php echo $this->lang->line('Description').' '.$row2['language_text'];?>" value="<?php echo $row2['news_description']?>">
								</div>
								<div class="form-group">
									<label for="txtDesc"><?php echo $this->lang->line('News').' '.$row2['language_text'];?> :</label>
									<textarea id="area_<?php echo $row2['language']; ?>" name="area_<?php echo $row2['language']; ?>"><?php echo $row2['news_text']?></textarea>
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
<?php foreach ($arr_news as $row3): ?>
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