<?php echo form_open('')?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<i class="glyphicon glyphicon-book"></i> <?php echo $this->lang->line('News Update');?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo anchor('Home.html',$this->lang->line('HOME'));?></li>
			<li class="active"><?php echo $this->lang->line('News Update');?></li>
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
				<table class="table table-hover">
				<?php if(count($arr_new)>0):?>
					<?php foreach ($arr_new as $row):?>
						<tr>
							<td style="border-right: 1px solid #ddd">
								<b><?php echo anchor('News-'.$this->url_friendly->friendly($row['news_title']).'-'.$row['news_id'].'.html',$row['news_title'],'style="color:#333;"');?></b>
								<p><?php echo $row['news_description'];?></p>
							</td>
							<td width="25%" style="color: #93969b">
								<i class="fa fa-clock-o" title="<?php echo $this->lang->line('Posted on'); ?>"></i> 
								<?php echo date("d/m/Y", strtotime($row['news_date'])).' '.$this->lang->line('at').' '.date("H:i A", strtotime($row['news_date']))?><br/>
								<i class="glyphicon glyphicon-signal" title="<?php echo $this->lang->line('View'); ?>"></i> <?php echo $row['news_view'];?>
							</td>
						</tr>
					<?php endforeach;?>
				<?php else:?>
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
<?php echo form_close()?>