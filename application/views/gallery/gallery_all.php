<?php echo form_open('');?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<i class="glyphicon glyphicon-picture"></i> <?php echo $this->lang->line('Gallery');?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo anchor('Home.html',$this->lang->line('HOME'));?></li>
			<li class="active"><?php echo $this->lang->line('Gallery');?></li>
		</ol>
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-8"><?php echo @$keyword!=''?'<h2>'.$this->lang->line('Search Results').' "'.$keyword.'"</h2>':'';?></div>
	<div class="col-lg-4">
		<div class="form-horizontal" style="text-align: right;">
			<div class="form-inline hidden-xs">
				<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('Search')?>.." name="keyword" value="<?php echo @$keyword?>"> <input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('Search')?>" name="search">
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel">
			<div class="panel-body">
				<table class="table ">
					<?php if(count($gallery_list)>0):?>
						<?php foreach ($gallery_list as $row):?>
						<tr>
							<td width="10%">
								<?php echo anchor('Gallery-'.$this->url_friendly->friendly($row['gal_category']).'-'.$row['gal_id'].'.html','<img style="max-height: 150px" class="img-hover" src="'.base_url().$row['gal_image_url'].'">');?>
							</td>
							<td style="border-right: 1px solid #ddd;vertical-align: middle;">
								 <b><?php echo $row['gal_category']?></b><br>
								 <span><?php echo $row['gal_description']?></span>
							</td>
							<td width="25%" style="color: #93969b">
								<i class="fa fa-clock-o" title="<?php echo $this->lang->line('Posted on'); ?>"></i> 
								<?php echo date("d/m/Y", strtotime($row['gal_date'])).' '.$this->lang->line('at').' '.date("H:i A", strtotime($row['gal_date']))?><br/>
								<i class="glyphicon glyphicon-signal" title="<?php echo $this->lang->line('View'); ?>"></i> <?php echo $row['gal_views'];?>
							</td>
						</tr>
						<?php endforeach;?>
					<?php else :?>
						<tr><td colspan="2"><?php echo $this->lang->line('Not found record');?></td></tr>
					<?php endif;?>
				</table>
				<div style="width: 100%;text-align: right ;">
					<?php echo @$pagination;?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close();?>