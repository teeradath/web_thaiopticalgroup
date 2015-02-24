<div class="alert alert-success" role="alert" id="text-pop" style="display:none;"><span class="glyphicon glyphicon-ok"></span> Add Gallery Images Success! </div>
<div class="ajax_load">
    <img title="Loading" src="<?php echo base_url()?>/images/loading_admin.gif" alt="" width="200px" />
</div>
<?php echo form_open_multipart('tog_admin/gallery_add_images/'.$this->uri->segment(3),'id="form1"');?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-camera"></span> Add Images Gallery <small>"<?php echo $arr_gallery[0]['gal_category']?>"</small></h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<img src="<?php echo base_url().$arr_gallery[0]['gal_image_url']?>" style="height:40px;border: 1px solid #999"> <?php echo $arr_gallery[0]['gal_category']?>
				<?php echo anchor('tog_admin/gallery_list','Back','class="btn btn-success" style="float:right;"');?>
			</div>
			<div class="panel-body">
				<!-- Button -->
				<div class="col-sm-6">
					<a id="btnAdd" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
					<a id="btnDel" class="btn btn-danger" disabled="disabled" onclick="removeTag();"><span class="glyphicon glyphicon-minus"></span></a>
				</div>
				<div class="col-sm-6" style="text-align: right;">
					<div class="form-horizontal" >
						<div class="form-group">
							<div>
								<a id="btnSave" class="btn btn-primary">Add Images</a>
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
						<p id="p-file0"><input type="file" name="file_image0" style="display: inline;border: 1px solid silver;">
						<label style="color: #E05353"> "ขนาดไม่เกิน 1200x700 Pixel"</label></p>
											
					</div>
				</div>
				<div class="col-sm-10">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th>#Images</th>
								<th width="5%" style="text-align: center;">ลบ</th>
							</tr>
						</thead>
						<tbody id="tbody-imgList">
						<?php if(count($arr_gallery_img)>0):?>
							<?php foreach ($arr_gallery_img as $row):?>
							<tr>
								<td><img alt="" src="<?php echo base_url().$row['image_url']?>" style="max-width: 150px"></td>
								<td style="text-align: center;vertical-align: middle;">
									<a href="#" style="color:#E05353 " style="font-size:1.1em;" id="btn-del-1" onclick="del(<?php echo $row['img_id']?>)">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
							<?php endforeach;?>
						<?php else:?>
							<tr>
								<td valign="top" colspan="2" class="dataTables_empty">No matching records found</td>
							</tr>
						<?php endif;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="n" name="n" value="0">
<input type="hidden" id="gal_id" name="gal_id" value="<?php echo$arr_gallery[0]['gal_id']; ?>">
<?php echo form_close()?>
<script lang="jascript">
$(function () {
	$('#btnAdd').click(function(){
		var i = $('#n').val()*1;
		var tag_p_file = '<p id="p-file'+(i+1)+'"><input type="file" name="file_image'+(i+1)+'" style="display: inline;border: 1px solid silver;">';
		tag_p_file +=' <label style="color: #E05353"> "ขนาดไม่เกิน 1200x700 Pixel"</label></p>';
		$('#n').val(i+1);
		$('#div-file').append(tag_p_file);
		$('#btnDel').removeAttr("disabled");
		tag_p_file='';
	});

	$('#btnSave').click(function(){
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
			alert('กรุณาเลือกรูปให้ครบ');	
			return bool;
		}
		$("#form1").submit();
	});
	
	$("#form1").submit(function(e){
	    var formURL = '<?php echo base_url()?>ajax/uploadFile';
	    var formData = new FormData(this);
	    $('.ajax_load').css('display','block');
	    $.ajax({
	        url: formURL,
	    	type: 'POST',
	        data:  formData,
	    	mimeType:"multipart/form-data",
	    	contentType: false,
	        cache: false,
	        processData:false,
	    	success: function(data){
	    		$( "font" ).remove();
		    	var arr = data.split('#%#');
		    	//alert(data)
		    	if(arr[1]!=''){
		    		var err = arr[1].split('@');
		    		var succ = arr[0].split('@');
		    		for (i = 1; i < succ.length; i++) {
			    		$('#p-file'+succ[i]).html('<font color="#5cb85c"><span class="glyphicon glyphicon-ok"></span> Upload Success</font>');
			    	}
			    	$('#p-file'+err[1]).append('<font color="error">'+err[2]+'</font>');
			    	
			    	$.ajax({
			            type: "POST",
			            url: "<?php echo base_url()?>ajax/getImags/"+$('#gal_id').val(),
			            success: function(data2) {
			            	$('#tbody-imgList').empty();
			            	$('#tbody-imgList').html(data2);
			            }
			        });
			    }else{
				    $('#div-file').empty();
				    var tag_p_file = '<p id="p-file0"><input type="file" name="file_image0" style="display: inline;border: 1px solid silver;">';
					tag_p_file +=' <label style="color: #E05353"> "ขนาดไม่เกิน 1200x700 Pixel"</label></p>';
				    $('#div-file').html(tag_p_file);
				    $('#n').val(0*1);
				    $('#text-pop').css('display','block');
				    $('#btnDel').attr("disabled","disabled");

				    $.ajax({
			            type: "POST",
			            url: "<?php echo base_url()?>ajax/getImags/"+$('#gal_id').val(),
			            success: function(data2) {
			            	$('#tbody-imgList').empty();
			            	$('#tbody-imgList').html(data2);
			            }
			        });
				    
				    setTimeout(function () {
				        jQuery('#text-pop').slideUp("1500")
				    }, 3000);
				}
		    	$('.ajax_load').css('display','none');
			}       
	    });
	  return false;

	});
});
function removeTag(){
	var i = $('#n').val();
	
		$('p').remove('#p-file'+i);
		$('#n').val(i-1);
	if(($('#n').val()*1) == 0){
		$('#btnDel').attr("disabled","disabled");
	}
}

function del(id){
	if(confirm("Do you want to delete it?")){
		$('.ajax_load').css('display','block');
		$.ajax({
            type: "POST",
            url: "<?php echo base_url()?>ajax/delImags/"+id+"/"+$('#gal_id').val(),
            success: function(data2) {
            	$('#tbody-imgList').empty();
            	$('#tbody-imgList').html(data2);
            	$('.ajax_load').css('display','none');
            }
        });
	}else{
		return false;
	}
	
}
</script>















