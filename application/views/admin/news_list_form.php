<?php echo form_open('tog_admin/news_list')?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">News</h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				News List
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6 ">
						<div class="form-inline" style="margin-bottom: 10px">
							<input type="text" class="form-control" placeholder="ค้นหา.."> <input type="submit" class="btn btn-primary" value="ค้นหา">
						</div>
					</div>
					<div class="col-md-6" style="text-align: right;">
						<?php echo anchor('tog_admin/news_add','<span class="glyphicon glyphicon-plus"></span> เพิ่ม','class="btn btn-success"')?>
					</div>
				</div>
 				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th width="5%">หน้าหลัก</th>
								<th width="10%">วันที่</th>
								<th width="20%">หัวข้อ</th>
								<th>คำอธิบาย</th>
								<th width="5%" style="text-align: center;">แก้ไข</th>
								<th width="5%" style="text-align: center;">ลบ</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($news_list as $row):?>
							<tr>
								<td align="center"> <input type="checkbox" <?php echo $row['is_front_page']==1?'checked':'';?> > </td>
								<td><?php echo $row['news_date'];?></td>
								<td><?php echo $row['news_title'];?></td>
								<td ><?php echo $row['news_description'];?></td>
								<td align="center"><a href="#"><span class="glyphicon glyphicon-edit"></span></a></td>
								<td align="center"><a href="#" style="color:#E05353 "><span class="glyphicon glyphicon-remove"></span></a></td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
				<!-- /.table-responsive -->
				<div class="row">
					<div class="col-lg-6">
						<div class="form-inline">
						<?php 
							$options = array(
									'15'  => '15',
									'30'    => '30',
									'50'   => '50',
									'100'   => '100'
							);
							echo form_dropdown('dd_perpage',$options ,$this->session->userdata('perpage'),'id="dd_perpage" aria-controls="dataTables-example" class="form-control input-sm"');
						?>
							<!--  <select name="dd_perpage" id="dd_perpage" aria-controls="dataTables-example" class="form-control input-sm">
								<option value="10">15</option>
								<option value="25">30</option>
								<option value="50">50</option>
								<option value="100">100</option>  
								<option value="1" >1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select> -->records per page
						</div>
					</div>
					<div class="col-lg-6" style="text-align: right;">
					<?php echo $pagination;?>
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
		$( "form" ).submit();
	});
});
</script>


