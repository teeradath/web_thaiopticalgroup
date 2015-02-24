<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/itemSlider/style.css?cache=1" />
<script src="<?php echo base_url()?>js/itemSlider/modernizr.custom.63321.js?cache=1"></script>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<i class="glyphicon glyphicon-list-alt"></i> <?php echo $this->lang->line('Annual Report');?>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo anchor('Home.html',$this->lang->line('HOME'));?></li>
			<li class="active"><?php echo $this->lang->line(@$Top_menu->menu_name);?></li>
			<li class="active"><?php echo $this->lang->line('Annual Report');?></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="main">
				<div id="mi-slider" class="mi-slider">
				<?php foreach ($arr_report as $row):?>
					<ul>
						<li>
						<?php 
							$htm = '<img src="'.base_url().$row['url_image'].'" class="img-responsive" alt="" style="border: 1px solid #999;">';
							$htm.= '<h4 style="background-image: url(\''.base_url().'images/pdf.gif\');background-repeat: no-repeat;background-position: 0px 20px;color: #555;">&nbsp;&nbsp;'.($this->session->userdata('lang_id')!='th'?$row['year']-543:$row['year']).'</h4>';
							echo anchor(base_url().$row['url_file'],$htm);
						?>
						</li>
					</ul>
				<?php endforeach;?>
					
					
					<nav>
					<?php foreach ($arr_report as $row):?>
						<a href="#"><?php echo ($this->session->userdata('lang_id')!='th'?$row['year']-543:$row['year'])?></a>
					<?php endforeach;?>
					</nav>
				</div>
			</div>
	</div>
</div>
<hr>
        
<!-- Pager -->
<div class="row">
	<div class="col-lg-12">
		<ul class="pager">
			<li class="next">
				<?php echo @$older_id->id!=''?anchor('Annual_Report-'.$older_id->year.'.html',$this->lang->line('Older').' &rarr;'):'';?>
			</li>
			<li class="previous">
				<?php echo @$newer_id!=''?anchor('Annual_Report-'.$newer_id.'.html','&larr; '.$this->lang->line('Newer')):'';?>
			</li>
		</ul>
	</div>
</div>
<!-- /.row -->
<script src="<?php echo base_url()?>js/itemSlider/jquery.catslider.js?cache=1"></script>
<script>
$(function() {
	$( '#mi-slider' ).catslider();
});
</script>