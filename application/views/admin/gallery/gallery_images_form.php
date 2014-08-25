<div class="alert alert-success" role="alert" id="text-pop" style="display: <?php echo @$status=='success'?'block':'none'?>;"><span class="glyphicon glyphicon-ok"></span> Add Gallery Images Success! </div>
<?php echo form_open_multipart('tog_admin/gallery_add_images/'.$this->uri->segment(3));?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-camera"></span> Add Images Gallery <small>"<?php echo $arr_gallery[0]['gal_category']?>"</small></h1>
 	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<img src="<?php echo base_url().$arr_gallery[0]['gal_image_url']?>" style="height:40px;border: 1px solid #999"> <?php echo $arr_gallery[0]['gal_category']?>
			</div>
			<div class="panel-body">
				<!-- Button -->
				<div class="col-sm-6">
					<a class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
					<a class="btn btn-success">Add Images</a>
				</div>
				<div class="col-sm-6" style="text-align: right;">
					<div class="form-horizontal" >
						<div class="form-group">
							<div >
								<?php echo anchor('tog_admin/gallery_list','Back','class="btn btn-primary"');?>
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
						<p><input type="file" name="file_image" value="<?php echo @$_POST['file_image'];?>" style="display: inline;border: 1px solid silver;">
						<a class="btn btn-sm btn-danger">ลบ</a>
						<label style="color: #E05353">"ขนาดไม่เกิน 1MB"</label></p>
						
						<p><input type="file" name="file_image" value="<?php echo @$_POST['file_image'];?>" style="display: inline;border: 1px solid silver;">
						<a class="btn btn-sm btn-danger">ลบ</a>
						<label style="color: #E05353">"ขนาดไม่เกิน 1MB"</label></p>
						
						<p><input type="file" name="file_image" value="<?php echo @$_POST['file_image'];?>" style="display: inline;border: 1px solid silver;">
						<a class="btn btn-sm btn-danger">ลบ</a>
						<label style="color: #E05353">"ขนาดไม่เกิน 1MB"</label></p>
						
					</div>
				</div>
				<div class="col-sm-10">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th width="10%" style="text-align: center;">#</th>
								<th>Images</th>
								<th width="5%" style="text-align: center;">แก้ไข</th>
								<th width="5%" style="text-align: center;">ลบ</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="text-align: center;vertical-align: middle;">6</td>
								<td><img alt="" src="<?php echo base_url().'images/gallery/img/400x350-01.jpg'?>" style="max-width: 150px"></td>
								<td style="text-align: center;vertical-align: middle;"><?php echo anchor('','<span class="glyphicon glyphicon-edit"></span>','style="font-size:1.1em;"')?></td>
								<td style="text-align: center;vertical-align: middle;">
									<a href="#" style="color:#E05353 " style="font-size:1.1em;" id="btn-del-1" onclick="del()">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
							<tr>
								<td style="text-align: center;vertical-align: middle;">6</td>
								<td><img alt="" src="<?php echo base_url().'images/gallery/img/400x350-02.jpg'?>" style="max-width: 150px"></td>
								<td style="text-align: center;vertical-align: middle;"><?php echo anchor('','<span class="glyphicon glyphicon-edit"></span>','style="font-size:1.1em;"')?></td>
								<td style="text-align: center;vertical-align: middle;">
									<a href="#" style="color:#E05353 " style="font-size:1.1em;" id="btn-del-1" onclick="del()">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
							<tr>
								<td style="text-align: center;vertical-align: middle;">6</td>
								<td><img alt="" src="<?php echo base_url().'images/gallery/img/400x350-03.jpg'?>" style="max-width: 150px"></td>
								<td style="text-align: center;vertical-align: middle;"><?php echo anchor('#','<span class="glyphicon glyphicon-edit"></span>','style="font-size:1.1em;"')?></td>
								<td style="text-align: center;vertical-align: middle;">
									<a href="#" style="color:#E05353 " style="font-size:1.1em;" id="btn-del-1" onclick="del()">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close()?>