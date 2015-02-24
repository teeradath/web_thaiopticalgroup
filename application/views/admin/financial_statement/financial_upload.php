<style>
.tab-content {
    border-left: 1px solid #ddd;
    border-right: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 10px;
}
</style>
<div class="alert alert-danger" role="alert" id="text-pop11" style="display:<?php echo  @$upload_err!='success'&&@$upload_err!=''?'block':'none'?>;"><span class="glyphicon glyphicon-remove"></span> <?php echo  strip_tags(@$upload_err)?>! </div>
<div class="alert alert-success" role="alert" id="text-pop" style="display:<?php echo  @$upload_err=='success'?'block':'none'?>;"><span class="glyphicon glyphicon-ok"></span> Upload Success! </div>
<div class="ajax_load">
    <img title="Loading" src="<?php echo base_url()?>/images/loading_admin.gif" alt="" width="200px" />
</div>
<?php echo form_open_multipart('tog_admin/financial_upload/'.$this->uri->segment(3),'id="form1"');?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-list-alt"></span> Uploads Financial <small>"<?php echo $year->year?>"</small></h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading" style="height: 50px">
				<label style="margin-top: 5px;"><?php echo $year->year?></label>
				<?php echo anchor('tog_admin/financial_list','Back','class="btn btn-sm btn-success" style="float:right;"');?>
			</div>
			<div class="panel-body">
				<!-- Button -->
				<div class="col-sm-6">
				
				</div>
				<div class="col-sm-6" style="text-align: right;">
					<div class="form-horizontal" >
						<div class="form-group">
							<div>
								<input type="submit" class="btn btn-primary" id="btnUpload" name="save" value="Upload"/>
							</div>
						</div>
					</div>
				</div>
				<!-- /Button -->
				<div class="col-sm-12">
				<hr style="margin-top: 0" />
				</div>
				<div class="col-sm-10">
				
					<div id="div-file" class="form-group">
						
					</div>
					<ul id="myTab" class="nav nav-tabs nav-justified">
						<?php foreach ($arr_lang as $row): ?>
							<li class="<?php echo $row['lang_id']==1?'active':''; ?>">
								<a href="#news-<?php echo $row['language']; ?>" data-toggle="tab"><img src="<?php echo base_url().$row['flag']; ?>" width="24" height="16" title="English" /> Language <?php echo $row['language_text']; ?></a>
							</li>
						<?php endforeach;?>
					</ul>      
					<div id="myTabContent" class="tab-content" style="padding: 15px;">
						<?php foreach ($arr_lang as $row2): ?>
							<div class="tab-pane fade <?php echo $row2['lang_id']==1?'active':''; ?> in" id="news-<?php echo $row2['language']?>">
								<div class="form-group <?php echo (form_error("txtTitle_".$row2['language'])!=""?"has-error":"");?>">
						        	<label for="txtTitle"><?php echo $this->lang->line('Title').' '.$row2['language_text'];?> :</label>
		    						<input type="text" class="form-control" name="txtTitle_<?php  echo $row2['language'];?>" placeholder="<?php echo $this->lang->line('Title').' '.$row2['language_text'];?>" value="<?php echo @$this->input->post('txtTitle_'.$row2['language'])?>">
		    						<?php echo form_error("txtTitle_".$row2['language'],"<font color='error'>","</font>");?>
						       	</div>
						       	<div class="form-inline" role="form">
						       	<div class="form-group <?php echo (form_error("file_".$row2['language'])!=""?"has-error":"");?>">
						       		<input type="file" class="form-control" name="file_<?php  echo $row2['language'];?>" style="height: 34px;">
									<label style="color: #E05353"> ".zip|.rar|.pdf|.xls|.doc"</label>
								</div>
								<?php echo form_error("file_".$row2['language'],"<br><font color='error'>","</font>");?>
								</div>			
							</div>
						<?php endforeach;?>
					</div>
				</div>
				
				<div class="col-sm-10">
				<h2>List Files</h2>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Title</th>
								<th width="5%" style="text-align: center;">Language</th>
								<th width="5%" style="text-align: center;">แก้ไข</th>
								<th width="5%" style="text-align: center;">ลบ</th>
							</tr>
						</thead>
						<tbody id="tbody-imgList">
						<?php if(count($arr_file)>0):?>
							<?php foreach ($arr_file as $row):?>
							<tr>
								<td id="td-title<?php echo $row['upload_id']?>"><?php echo $row['text']?></td>
								<td><?php echo $row['language_text']?></td>
								<td align="center"><a href="#" style="font-size:1.1em;" onclick="edit(<?php echo $row['upload_id']?>,'<?php echo $row['url_file']?>')" id="btnEdit<?php echo $row['upload_id']?>" ><span class="glyphicon glyphicon-edit"></span></a></td>
								<td style="text-align: center;vertical-align: middle;">
									<a href="#" style="color:#E05353 " style="font-size:1.1em;" id="btn-del-1" onclick="del(<?php echo $row['upload_id']?>,<?php echo $row['financial_id']?>)">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
							<?php endforeach;?>
						<?php else:?>
							<tr>
								<td valign="top" colspan="4" class="dataTables_empty">No matching records found</td>
							</tr>
						<?php endif;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="id" name="id" value="">
<input type="hidden" id="uri" name="uri" value="">
<?php echo form_close()?>
<script>
$(document).ready(function() {
	oldtext = '';
	$('#btnUpload').click(function(){
		var bool = true;
		$( "input[type=file]" ).each(function() {
			if($( this ).val()==""){
				$( this ).css("border","1px dashed red");
				bool = false;
			}else{
				$( this ).css("border","1px solid silver");

			}
		});
		if(!bool){
			alert('กรุณาเลือกไฟล์ให้ครบทุกภาษา');	
			return bool;
		}
		$("#form1").submit();
	});
	
	setTimeout(function () {
        jQuery('#text-pop').slideUp("1500")
    }, 3000);

});
function del(id,id2){
	if(confirm("Do you want to delete it?")){
		window.location.href = '<?php echo base_url().'tog_admin/financial_delete_2'?>/'+id+'/'+id2;
	}else{
		return false;
	}
}

function edit(id,url){
	$( "#errEditFile" ).remove();
	var text = $('#td-title'+id).html();
	var arrFileName = url.split("/");
	oldtext = $('#td-title'+id).html();
	$('#btnEdit'+id).removeAttr('onclick');
	$('#td-title'+id).empty();
	var htm = '<div class="form-inline" role="form"> <input type="text" class="form-control" value="'+text+'" id="txtEdit'+id+'" name="txtEdit'+id+'" style="min-width: 400px;"> ';
	htm += '<label>'+arrFileName[3]+'</label> <input type="file" class="form-control" style="width:250px;" name="file'+id+'"> '
	htm += '<a href="#" onclick="saveEdit('+id+',\''+url+'\')" class="btn btn-sm btn-success">save</a> <a href="#" onclick="cancel('+id+',\''+url+'\')" class="btn btn-sm btn-danger">cancel</a></div>'
	jQuery('#td-title'+id).html(htm);
}

function cancel(id,url){
	var text = $('#txtEdit'+id).val();
	$('#btnEdit'+id).attr('onclick','edit('+id+',"'+url+'")');
	$('#td-title'+id).empty();
	$('#td-title'+id).html(oldtext);
}

function saveEdit(id,url){
	$('#id').val(id);
	$('#uri').val(url);
	$("#form1").submit();
}

$("#form1").submit(function(e){
	if($('#id').val()!="" && $('#uri').val()!=""){
		var formData = new FormData(this);
		$('.ajax_load').css('display','block');
		$.ajax({
	        url: "<?php echo base_url()?>ajax/financialEdit/"+$('#id').val(),
	    	type: 'POST',
	        data:  formData,
	    	mimeType:"multipart/form-data",
	    	contentType: false,
	        cache: false,
	        processData:false,
	    	success: function(data){
		    	//alert(data)
		    	$('#btnEdit'+$('#id').val()).attr('onclick','edit('+$('#id').val()+',"'+$('#uri').val()+'")');
	        	$('#td-title'+$('#id').val()).empty();
	        	$('#td-title'+$('#id').val()).html(data);
	        	$('#id').val("");
	        	$('#uri').val("");
	        	$('.ajax_load').css('display','none');
			}       
	    });
		return false;
	}
	return true;
});


</script>