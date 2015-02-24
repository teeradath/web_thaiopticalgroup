<style>
ul { 
	margin:0;
	padding:0;
}
.newsAll{font-size:0.4em;float:right;margin-top: 20px;color: #777;}
.newsAll:HOVER{color: #333;text-decoration: none;}
.gal-small{margin-top: 0px;color: #777;}
</style>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><span class="glyphicon glyphicon-picture"></span> <?php echo $row_gallery->gal_category?> 	
			<?php echo anchor('Gallery',$this->lang->line('Gallery')." <i class='glyphicon glyphicon-play'></i>",'class="newsAll"'); ?>
		</h1>
		
	</div>
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="gal-small"> 
			<i class="fa fa-clock-o"></i> 
			<?php echo $this->lang->line('Posted on');?> <?php echo date("d/m/Y", strtotime($row_gallery->gal_date)).' '.$this->lang->line('at').' '.date("H:i A", strtotime($row_gallery->gal_date))?><br>
			<i class="glyphicon glyphicon-signal" title="<?php echo $this->lang->line('View'); ?>"></i> <?php echo $view;?>
			</div>
		<div id="rg-gallery" class="rg-gallery">
			<div class="rg-thumbs">
				<!-- Elastislide Carousel Thumbnail Viewer -->
				<div class="es-carousel-wrapper">
					<div class="es-nav">
						<span class="es-nav-prev">Previous</span>
						<span class="es-nav-next">Next</span>
					</div>
					<div class="es-carousel">
						<ul>
						<?php if(count($arr_gallery_img)>0):?>
							<?php foreach ($arr_gallery_img as $row):?>
								<li><a href="#"><img src="<?php echo base_url().$row['image_url']?>" data-large="<?php echo base_url().$row['image_url']?>" alt="" data-description="" /></a></li>
							<?php endforeach;?>
						<?php else:?>
							<li><a href="#"><img src="http://dummyimage.com/600x500/ddd/999999.jpg&text=No+Image" data-large="http://dummyimage.com/600x500/ddd/999999.jpg&text=No+Image" alt="" data-description="" /></a></li>
						<?php endif;?>
						</ul>
					</div>
				</div>
				<!-- End Elastislide Carousel Thumbnail Viewer -->
			</div><!-- rg-thumbs -->
		</div><!-- rg-gallery -->
	</div>
</div><!-- /row -->		
<div class="row">
	<div class="col-lg-12">
		<hr/>
		<h2><span class="glyphicon glyphicon-list"></span> <?php echo $this->lang->line('Detail')?></h2>
		<hr/>
	</div>
</div>	
<div class="row">
	<div class="col-lg-12">
		<p><?php echo $row_gallery->gal_text;?></p>
	</div>
</div>	
<hr/>
<!-- Pager -->
<div class="row">
	<div class="col-lg-12">
		<ul class="pager">
			<li class="previous">
				<?php echo @$older_id->gal_id!=''?anchor('Gallery-'.$this->url_friendly->friendly($older_id->gal_category).'-'.$older_id->gal_id.'.html','&larr; '.$this->lang->line('Older')):'';?>
			</li>
			<li class="next">
				<?php echo @$newer_id->gal_id!=''?anchor('Gallery-'.$this->url_friendly->friendly($newer_id->gal_category).'-'.$newer_id->gal_id.'.html',$this->lang->line('Newer').' &rarr;'):'';?>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.tmpl.min.js?cache=1"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.easing.1.3.js?cache=1"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.elastislide.js?cache=1"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/gallery.js?cache=1"></script>
<noscript>
	<style>
		.es-carousel ul{
			display:block;
		}
	</style>
</noscript>
<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
<div class="rg-image-wrapper">
	{{if itemsCount > 1}}
		<div class="rg-image-nav">
			<a href="#" class="rg-image-nav-prev">Previous Image</a>
			<a href="#" class="rg-image-nav-next">Next Image</a>
		</div>
	{{/if}}
		<div class="rg-image"></div>
		<div class="rg-loading"></div>
		<div class="rg-caption-wrapper">
			<div class="rg-caption" style="display:none;">
				<p></p>
			</div>
		</div>
</div>
</script>