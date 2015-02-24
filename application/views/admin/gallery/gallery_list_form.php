<?php echo form_open('tog_admin/gallery_list');?>
<div class="alert alert-success" role="alert" id="text-pop" style="display: <?php echo @$success?>;"><span class="glyphicon glyphicon-ok"></span> Create Gallery Success! </div>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-camera"></span> Gallery</h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Gallery List
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6 ">
						<div class="form-inline" style="margin-bottom: 10px">
							<input type="text" class="form-control" placeholder="ค้นหา.." name="keyword" value="<?php echo @$_POST['keyword'];?>"> <input type="submit" class="btn btn-warning" value="ค้นหา" name="search">
						</div>
					</div>
					<div class="col-md-6" style="text-align: right;">
						<?php echo anchor('tog_admin/gallery_add','<span class="glyphicon glyphicon-plus"></span> เพิ่ม','class="btn btn-success"')?>
					</div>
				</div>
 				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th width="10%" style="text-align: center;">#</th>
								<th width="10%">วันที่</th>
								<th width="20%">Category</th>
								<th>คำอธิบาย</th>
								<th width="5%" style="text-align: center;">เพิ่มรูป</th>
								<th width="5%" style="text-align: center;">แก้ไข</th>
								<th width="5%" style="text-align: center;">ลบ</th>
							</tr>
						</thead>
						<tbody>
							<?php if (count($gallery_list)>0):?>
							<?php $i=0; foreach ($gallery_list as $row): $i++;?>
							<tr>
								<td align="center"><img class="img-responsive" style="max-height: 150px" src="<?php echo base_url().$row['gal_image_url'];?>" > </td>
								<td style="vertical-align: middle;"><?php echo $row['gal_date'];?></td>
								<td style="vertical-align: middle;"><?php echo $row['gal_category'];?></td>
								<td style="vertical-align: middle;"><?php echo $row['gal_description'];?></td>
								<td align="center" style="vertical-align: middle;">
									<?php echo anchor('tog_admin/gallery_add_images/'.$row['gal_id'],'<span class="glyphicon glyphicon-plus" style="font-size:1.1em;color: #5cb85c;"></span>')?>
								</td>
								<td align="center" style="vertical-align: middle;">
									<?php echo anchor('tog_admin/gallery_edit/'.$row['gal_id'],'<span class="glyphicon glyphicon-edit"></span>','style="font-size:1.1em;"')?>
								</td>
								<td align="center" style="vertical-align: middle;">
									<a href="#" style="color:#E05353 " style="font-size:1.1em;" id="btn-del-<?php echo $i;?>" onclick="del(<?php echo $row['gal_id']?>)">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
							<?php endforeach;?>
						<?php else:?>
							<tr>
								<td valign="top" colspan="6" class="dataTables_empty">No matching records found</td>
							</tr>
						<?php endif;?>
						</tbody>
					</table>
				</div>
				<!-- /.table-responsive -->
				<div class="row">
					<div class="col-lg-6">
						<div class="form-inline" style="display: <?php echo @$RecordsPerPage?>">
						<?php 
							$options = array(
									'15'  => '15',
									'30'    => '30',
									'50'   => '50',
									'100'   => '100'
							); ?>
						<?php echo form_dropdown('dd_perpage',$options ,$this->session->userdata('perpage'),'id="dd_perpage" aria-controls="dataTables-example" class="form-control input-sm"').' records per page';?>
						</div>
					</div>
					<div class="col-lg-6" style="text-align: right;">
						<?php echo @$pagination;?>
					</div>
				</div>
			</div>
			<!-- /panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<input type="hidden" name="dd_perpage_hid" id="dd_perpage_hid" value="<?php echo @$_POST['dd_perpage'];?>" >
<?php echo form_close();?>
<script>
$(document).ready(function() {
	$( "#dd_perpage" ).change(function() {
		$('#dd_perpage_hid').val($( "#dd_perpage" ).val())
		$("form").submit();
	});
	setTimeout(function () {
        jQuery('#text-pop').slideUp("1500")
    }, 3000);

});

function del(id){
	if(confirm("Do you want to delete it?")){
		window.location.href = '<?php echo base_url().'tog_admin/gallery_delete'?>/'+id;
	}else{
		return false;
	}
}
</script>