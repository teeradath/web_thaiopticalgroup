<!-- Page Heading/Breadcrumbs -->
<style>
.newsAll{font-size:0.4em;float:right;margin-top: 20px;color: #777;}
.newsAll:HOVER{color: #333;text-decoration: none;}
</style>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $this->lang->line('News Update');?> 
			<small> <?php echo $row_news->news_title;?></small>
			<?php echo anchor('News',$this->lang->line('News all')." <i class='glyphicon glyphicon-play'></i>",'class="newsAll"'); ?>
		</h1>
		
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<ol class="breadcrumb">
			<li><?php echo anchor('home',$this->lang->line('HOME'));?></li>
			<li><?php echo anchor('News',$this->lang->line('News Update'));?></li>
			<li class="active"><?php echo $row_news->news_title;?></li>
		</ol>
	</div>
</div>
<!-- /.row -->

<!-- Content Row -->
<div class="row">
	<!-- News Post -->
	<div class="col-lg-12">
		<!-- Date/Time -->
		<p>
			<i class="fa fa-clock-o"></i> 
			<?php echo $this->lang->line('Posted on');?> <?php echo date("d/m/Y", strtotime($row_news->news_date)).' '.$this->lang->line('at').' '.date("H:i A", strtotime($row_news->news_date))?>
		</p>
		<hr/>
		<!-- Post Content -->
		<p>
			<?php echo $row_news->news_text;?>
		</p>
	</div>
</div>
        
<hr>
        
<!-- Pager -->
<div class="row">
	<div class="col-lg-12">
		<ul class="pager">
			<li class="previous">
				<?php echo @$older_id->news_id!=''?anchor('News-'.$this->url_friendly->friendly($older_id->news_title).'-'.$older_id->news_id.'.html','&larr; '.$this->lang->line('Older')):'';?>
			</li>
			<li class="next">
				<?php echo @$newer_id->news_id!=''?anchor('News-'.$this->url_friendly->friendly($newer_id->news_title).'-'.$newer_id->news_id.'.html',$this->lang->line('Newer').' &rarr;'):'';?>
			</li>
		</ul>
	</div>
</div>
<!-- /.row -->
        