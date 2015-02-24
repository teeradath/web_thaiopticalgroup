<?php echo form_open('tog_admin/form_56_1_list');?>
<div class="alert alert-success" role="alert" id="text-pop" style="display: <?php echo @$success?>;"><span class="glyphicon glyphicon-ok"></span> Create Success! </div>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-paperclip"></span> แบบฟอร์ม 56-1</h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Data List
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6 ">
						<div class="form-inline" style="margin-bottom: 10px">
							<input type="text" class="form-control" placeholder="ค้นหา.." name="keyword" value="<?php echo @$_POST['keyword'];?>"> <input type="submit" class="btn btn-warning" value="ค้นหา" name="search">
						</div>
					</div>
					<div class="col-md-6" style="text-align: right;">
						<?php echo anchor('tog_admin/form_56_1_add','<span class="glyphicon glyphicon-plus"></span> เพิ่ม','class="btn btn-success"')?>
					</div>
				</div>
 				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th width="" >เบบฟอร์ม 56-1</th>
								<th width="5%" style="text-align: center;">แก้ไข</th>
								<th width="5%" style="text-align: center;">ลบ</th>
							</tr>
						</thead>
						<tbody>
						<?php if (count($form56_list)>0):?>
							<?php foreach ($form56_list as $row):?>
							<tr>
								<td style="vertical-align: middle;">แบบ 56-1 <?php echo $row['form_year'];?> </td>
								<td align="center" style="vertical-align: middle;"><?php echo anchor('tog_admin/form_56_1_edit/'.$row['form_id'],'<span class="glyphicon glyphicon-edit"></span>','style="font-size:1.1em;"')?></td>
								<td align="center" style="vertical-align: middle;"><a href="#" style="color:#E05353 " style="font-size:1.1em;" onclick="del(<?php echo $row['form_id']?>)"><span class="glyphicon glyphicon-remove"></span></a></td>
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
						<div class="form-inline" style="display: <?php echo $RecordsPerPage?>">
						<?php 
							$options = array(
									'15'  => '15',
									'30'    => '30',
									'50'   => '50',
									'100'   => '100'
							);
							echo form_dropdown('dd_perpage',$options ,$this->session->userdata('perpage'),'id="dd_perpage" aria-controls="dataTables-example" class="form-control input-sm"');
						?> records per page
						</div>
					</div>
					<div class="col-lg-6" style="text-align: right;">
					<?php echo @$pagination;?>
					</div>
				</div>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
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
		window.location.href = '<?php echo base_url().'tog_admin/form_56_1_delete'?>/'+id;
	}else{
		return false;
	}
}
</script>