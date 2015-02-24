<?php echo form_open('Annual-General-Meeting.html')?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<i class="glyphicon glyphicon-retweet"></i> <?php echo $this->lang->line('Annual General Meeting');?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo anchor('Home.html',$this->lang->line('HOME'));?></li>
			<li class="active"><?php echo $this->lang->line(@$Top_menu->menu_name);?></li>
			<li class="active"><?php echo $this->lang->line('Annual General Meeting');?></li>
		</ol>
	</div>
</div>
<!-- /.row -->
<!-- row -->
<div class="row">
	<div class="col-lg-8"><?php echo @$keyword!=''?'<h2>'.$this->lang->line('Search Results').' "'.$keyword.'"</h2>':'';?></div>
	<div class="col-lg-4">
		<div class="form-horizontal" style="text-align: right;">
			<div class="form-inline hidden-xs">
				<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('Search')?>.." name="keyword" value="<?php echo @$keyword?>"> <input type="submit" class="btn btn-primary" value="<?php echo $this->lang->line('Search')?>" name="search">
			</div>
		</div>
	</div>
	<div class="col-lg-12 hidden-xs">
		<hr>
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<table class="table table-striped">
		<thead>
			<tr>
				<th>
					<?php echo $this->lang->line('Title');?>
				</th>
				<th width="25%" style="text-align:center">
					<?php echo $this->lang->line('download');?>
				</th>
			<tr>
		</thead>
		<tbody>
		<?php if(count($meeting_arr)>0):?>
			<?php foreach ($meeting_arr as $row):?>
				<tr>
					<td><?php echo $row['meeting_title'];?></td>
					<td style="text-align:center"><?php echo anchor(base_url().$row['url_file'],'<i class="glyphicon glyphicon-download-alt"></i> <i class="hidden-xs">'.$this->lang->line('download').'</i>') ?></td>
				</tr>	
			<?php endforeach;?>
		<?php else:?>
			<tr><td colspan="2"><?php echo $this->lang->line('Not found record');?></td></tr>
		<?php endif;?>
		</tbody>
		</table>
		<div style="width: 100%;text-align: right ;">
			<?php echo @$pagination;?>
		</div>
	</div>
</div>
<?php echo form_close()?>