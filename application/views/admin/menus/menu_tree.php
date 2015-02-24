<link href="<?php echo base_url();?>css/treeMenu/jquery.bonsai.css?cache=1" rel="stylesheet">
<script src="<?php echo base_url();?>js/treeMenu/jquery.qubit.js?cache=1"></script>
<script src="<?php echo base_url();?>js/treeMenu/jquery.bonsai.js?cache=1"></script>

<!-- <pre><?php //print_r(@$this->input->post())?></pre> -->
<div class="ajax_load">
    <img title="Loading" src="<?php echo base_url()?>/images/loading_admin.gif" alt="" width="200px" />
</div>
<div class="alert alert-success" role="alert" id="text-pop" style="display: none"><span class="glyphicon glyphicon-ok"></span> Success! </div>
<?php echo form_open('','id="form1"')?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="fa fa-sitemap fa-fw"></span> Tree Menus</h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">Tree Information</div>
			<div class="panel-body">
				<!-- buttom -->
				<div class="form-horizontal" style="text-align: right;">
					<div class="form-group">
						<div class="col-sm-offset-6 col-sm-6">
							<?php echo anchor('tog_admin','Back','class="btn btn-primary"');?>
							<input type="button" class="btn btn-primary" id="btnSave" name="save" value="Save Menus"/>
						</div>
					</div>
				</div>
				<hr/>
				<!-- /buttom -->
				<!-- Tree Menus -->
				<?php echo $menus?>
				<!-- /Tree Menus -->
			</div>
		</div>
	</div>
</div>
<?php echo $menus_hid?>
<?php echo form_close()?>
<script>
$(function () {
	$('.tree-menus').bonsai({
	  	expandAll: true,
	  	checkboxes: true, // depends on jquery.qubit plugin
		createCheckboxes: true // takes values from data-name and data-value, and data-name is inherited
	});

	$('#btnSave').click(function(){
		
		$("#form1").submit();
	});
	
	$("#form1").submit(function(e){
		var formURL = '<?php echo base_url()?>ajax/disableMenu';
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
		    	//alert(data);
	    		$('#text-pop').css('display','block');
		    	$('.ajax_load').css('display','none');
			}       
	    });
	    setTimeout(function () {
	        jQuery('#text-pop').slideUp("1500")
	    }, 3000);
	  return false;
	});
	
});
function chk_box(name){
	var arr_id = name.split('_');
	//alert($('[name=]').val());
	$('input:checkbox[name='+name+']').each(function() {    
		if($(this).is(':checked')){
			$('#hid_'+arr_id[1]).val(1);
			//alert($("#"+$(this).attr("id")).parent().parent().attr('id'));
			var par_id = $("#"+$(this).attr("id")).parent().parent().attr('id').split('_');
			if(par_id[1]!=0)
				$('#hid_'+par_id[1]).val(1);
			
			//alert("check ->"+$(this).attr("name"));
			$('#ol_'+arr_id[1]+' li input:checkbox').each(function(){
				var arr_id2 = $(this).attr("name").split('_');
				if($(this).is(':checked'))
					$('#hid_'+arr_id2[1]).val(1);
				else
					$('#hid_'+arr_id2[1]).val(0);
				//alert($(this).attr("name") + " has a value of " + $(this).val());
			});
		}
		else{
			$('#hid_'+arr_id[1]).val(0);
			//alert("not Check ->"+$(this).attr("name"));
			$('#ol_'+arr_id[1]+' li input:checkbox').each(function(){
				var arr_id3 = $(this).attr("name").split('_');
				if($(this).is(':checked'))
					$('#hid_'+arr_id3[1]).val(1);
				else
					$('#hid_'+arr_id3[1]).val(0);
				//alert($(this).attr("name") + " has a value of " + $(this).val());
			});
		}

	});
}
</script>










