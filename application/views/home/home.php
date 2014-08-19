<div class="row">
	<div class="col-lg-12">
		<!-- slider -->
		<div id="banner-fade" style="">
			<!-- start Basic Jquery Slider -->
			<ul class="bjqs">
				<li><img src="<?php echo base_url();?>images/banner/banner1.jpg" title=""></li>
				<li><img src="<?php echo base_url();?>images/banner/banner2.jpg" title=""></li>
				<li><img src="<?php echo base_url();?>images/banner/banner3.jpg" title=""></li>
				<li><img src="<?php echo base_url();?>images/banner/banner4.jpg" title=""></li>
				<li><img src="<?php echo base_url();?>images/banner/banner5.jpg" title=""></li>
				<li><img src="<?php echo base_url();?>images/banner/banner6.jpg" title=""></li>
				<li><img src="<?php echo base_url();?>images/banner/banner7.jpg" title=""></li>
			</ul>
		<!-- end Basic jQuery Slider -->
		</div>
	</div>
</div>
<!-- News Update -->
<div class="row">
	<!-- News Update -->
	<div class="col-md-3" style="margin-top:20px">
		<div class="news">
			<div class="news-head">
				<h2><i class="glyphicon glyphicon-book"></i> <?php echo $this->lang->line('News Update');?></h2>
			</div>
			<?php foreach ($arr_news as $row):?>
			<div class="news-body">
				<h3><?php echo $row['news_title'];?></h3>
				<p><?php echo $row['news_description'];?></p>
				<div class="btn-right">
					<?php echo anchor('news/text_news/'.$row['news_id'],$this->lang->line('Read More'),array('class'=>'btn btn-primary'))?>
				</div>
			</div>
			<?php endforeach;?>
			
			<div class="news-body">
			<div class="anchor-right">
					<?php echo anchor('news',$this->lang->line('News all')." <i class='glyphicon glyphicon-play'></i>")?>
			</div>
			</div>
		</div>
	</div>
	<div class="col-md-6" style="margin-top:20px">
		<img class="img-responsive" src="<?php echo base_url();?>images/logo/center_img.jpg" alt="" />
	</div>
	<!-- Iframe -->
	<div class="col-md-3 hidden-xs hidden-sm" style="margin-top:20px">
		<!--<iframe frameborder=0 scrolling=no width="200" height="240" src="http://weblink.settrade.com/banner/banner3.jsp"></iframe>-->
		<iframe marginWidth="0" marginHeight="0" src="http://www.settrade.com/IRPage/irpage.jsp?txtSymbol=TOG&language=th&key=22698" frameBorder="0" width="100%" scrolling="no" height="220px"></iframe>
		<iframe marginWidth="0" marginHeight="0" src="http://www.settrade.com/IRPage/irpage.jsp?txtSymbol=TOG&language=th&key=22698" frameBorder="0" width="100%" scrolling="no" height="220px"></iframe>
	</div>
</div>
<!-- /.row -->
<hr>

<!-- gallery Title-->
<div class="row" style="margin-top:15px">
	<div class="col-md-12 "><a href="gallery" style="color: #333;text-decoration: none;"><h1><span class="glyphicon glyphicon-camera"></span> <?php echo $this->lang->line('Gallery');?></h1></a></div>
</div>
<hr>
			
<!-- gallery -->
<?php $n = 0; $i=0; foreach ($arr_gallery as $row_gal): $n++; $i++; ?>
	<?php if($n==1):?>
	<div class="row" style="margin-top:15px">
	<?php endif;?>
		<div class="col-md-3 ">
			<div class="gallery">
				<div class="preview">
						<img class="img-responsive" src="<?php echo base_url().$row_gal['gal_image_url'];?>" alt="">
						<div class="overlay"></div>
						<div class="links">
							<a data-toggle="modal" href="#modal-<?php echo $i?>"><i class="glyphicon glyphicon-eye-open" style="line-height:40px;"></i>
							</a><a href="gallery/gallery_detail/<?php echo $row_gal['gal_id']?>"><i class="glyphicon glyphicon-link" style="line-height:40px;"></i></a>                        
						</div>
				</div>
				<div class="category">
					<h4><?php echo $row_gal['gal_category']?></h4>
					<p><?php echo $row_gal['gal_description']?></p>
				</div>
                <!-- Modal -->
				<div class="modal fade" id="modal-<?php echo $i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content" style="background-color:#eee">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="myModalLabel"><?php echo $row_gal['gal_category']?></h4>
				      </div>
				      <div class="modal-body">
				        <img src="<?php echo base_url().$row_gal['gal_image_url'];?>" alt=" " width="100%">
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		</div>	
	<?php if($n==4): $n=0;?>
	</div>
	<?php endif;?>
<?php endforeach;?>