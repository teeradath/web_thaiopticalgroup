<style type="text/css">
	<!--
	#outerdiv
	{
	width:825px;
	height:850px;
	overflow:hidden;
	position:relative;
	}

	#inneriframe
	{
	position: absolute;
	top: -170px;
	left: -189px;
	width: 100%;
	height: 850px;
	}

	-->
</style>
<!-- row Slider -->
<div class="row">
	<div class="col-lg-12">
		<!-- slider -->
		<div id="banner-fade" style="" >
			<!-- start Basic Jquery Slider -->
			<ul class="bjqs">
				<li><img src="<?php echo base_url(); ?>images/banner/banner1.jpg" title=""></li>
				<li><img src="<?php echo base_url(); ?>images/banner/banner2.jpg" title=""></li>
				<li><img src="<?php echo base_url(); ?>images/banner/banner3.jpg" title=""></li>
				<li><img src="<?php echo base_url(); ?>images/banner/banner4.jpg" title=""></li>
				<li><img src="<?php echo base_url(); ?>images/banner/banner5.jpg" title=""></li>
				<li><img src="<?php echo base_url(); ?>images/banner/banner6.jpg" title=""></li>
				<li><img src="<?php echo base_url(); ?>images/banner/banner7.jpg" title=""></li>
			</ul>
			<!-- end Basic jQuery Slider -->
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12" style="margin-top: 20px">
		<ol class="breadcrumb">
			<li><?php echo anchor('Home.html',$this->lang->line('HOME'));?></li>
			<li class="active"><?php echo $this->lang->line($Top_menu->menu_name)?></li>
			<li class="active"><?php echo $this->lang->line(@$sub_menu->menu_name);?></li>
		</ol>
	</div>
</div>
<div class="row" >
	<div class="col-lg-12">
		<h2><?php echo @$article_array->article_title;?></h2>
		<hr>
	</div>
</div>
<div class="row" style="margin-top: 10px">
	<div class="col-lg-12">
		<?php echo @$article_array->article_text;?>
	</div>
</div>



<script src="<?php echo base_url();?>js/bjqs-1.3.min.js?cache=1"></script>
<script>
	$(function () {
    	$('#banner-fade').bjqs({
            height: 290,
            width: 1110,
            responsive: true,
			animtype : 'slide'
        });
	});
</script>