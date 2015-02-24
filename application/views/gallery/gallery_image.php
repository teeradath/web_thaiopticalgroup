<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title><?php echo urldecode($title);?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico?cache=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="Thaiopticalgroup, thaiopticalgroup, Picture, ไทยออพติคอลกรุ๊ป, ไทยออพติคอล, อุตสาหกรรมแว่นตาไทย, แว่นตา, เลนส์" />
        <meta name="keywords" content="Thaiopticalgroup, thaiopticalgroup, Picture, ไทยออพติคอลกรุ๊ป, ไทยออพติคอล, อุตสาหกรรมแว่นตาไทย, แว่นตา, เลนส์" />
        <meta name="author" content="Codrops" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/gallery/demo.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/gallery/lightbox.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/gallery/style.css" />
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="<?php echo base_url()?>js/gallery/modernizr.custom.52731.js"></script> 
		<!--[if lte IE 8]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
    </head>
    <body>
        <div class="container">
		
            <!-- Codrops top bar -->
            <div class="codrops-top">
            	<?php echo anchor('Home.html','<strong>&laquo; '.'Home'.'</strong>','style="color:#ddd"')?>
                <span class="">
                <?php echo anchor('Gallery.html','<strong>'.'Gallery'.'</strong>','style="color:#ddd"')?>
                </span>
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
			
			<header class="box-content">
			
				<h1>Gallery</h1>
				<h2><?php echo $row_gallery->gal_category;?></h2>
				<div><!-- let's check browser support with modernizr -->
					<p>
						<?php echo $row_gallery->gal_text;?>
					</p>
				</div>
				
			</header>
			
			<section id="main" class="main">
				<?php $i=0; foreach ($arr_gallery_img as $val): $i++;?>
					<div class="pb-wrapper pb-wrapper-<?php echo $i;?>">
					<div class="pb-scroll">
						<ul class="pb-strip">
							<?php $n=0; foreach ($val['gal_img'] as $img): $n++;?>
								<li><a href="<?php echo base_url().$img['image_url']?>" rel="lightbox[album<?php echo $i;?>]" title="Picture <?php echo $n;?>"><img src="<?php echo base_url().$img['image_url_thumb']?>" /></a></li>
							<?php endforeach;?>
						</ul>
					</div>
					<h3 class="pb-title"><?php echo anchor('Gallery-'.$this->url_friendly->friendly($val['gal_category']).'-'.$val['gal_id'].'.html',$val['gal_category']);?></h3>
				</div>
				<?php endforeach;?>
			</section>
        </div>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="<?php echo base_url()?>js/gallery/lightbox.js"></script>
    </body>
</html>