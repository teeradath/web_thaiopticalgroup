<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico?cache=1">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css?cache=1" rel="stylesheet" media="all">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>css/custom_style.css?cache=1" rel="stylesheet">
	<link href="<?php echo base_url();?>css/bjqs.css?cache=1" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>font-awesome-4.1.0/css/font-awesome.min.css?cache=1" rel="stylesheet" type="text/css" >

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]><![endif]-->
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js?cache=1"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js?cache=1"></script>
     <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url();?>js/jquery-1.11.0.js?cache=1"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js?cache=1"></script>
    <!-- Script to Activate the Carousel -->
    <title><?php echo urldecode($title);?></title>
</head>
<body>
<!-- Header Carousel -->
    <header class="container">
		<div class="row head-margin" style="">
			<div class="col-md-2 img-logo">
			<img class="img-responsive size-logo" src="<?php echo base_url();?>images/logo/logo_TOG.png"/>
			</div>
			<div class="col-md-10">
				<!--<div id="tran" class="tran-img"><img class="img-responsive" src="images/logo/tran.png" ></div>-->
				<table class="tb-title" >
					<tr>
						<td valign="bottom" align="left">
							<h2 class="title-web1">THAI OPTICAL GROUP PUBLIC COMPANY LIMITED</h2>
							<h3 class="title-web2">COMMITMENT TO QUALITY AND SERVICE</h3>
						</td>
					</tr>
				</table>
				
			</div>
		</div>
       
    </header>
	
    <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation" style="border-radius: 0px;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="background-color:#1e7fc4">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<div class="brand"><div class="navbar-brand"><img src="<?php echo base_url();?>images/logo/logo_TOG2.png" class="size-logo" /></div></div>
				<?php echo anchor('home/change_lang/en','<img src="'.base_url().'images/flag/en.png" width="24" height="16" title="English" />','class="navbar-toggle" style="padding:0;margin-top:15px"');?>
				<?php echo anchor('home/change_lang/th','<img src="'.base_url().'images/flag/th.png" width="24" height="16" title="Thailand" />','class="navbar-toggle" style="padding:0;margin-top:15px"');?>
				
				
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                	<?php echo $str_menu;?>
                </ul>
				<div class="lang-bar">
				<?php echo anchor('home/change_lang/th','<img src="'.base_url().'images/flag/th.png" width="24" height="16" title="Thailand" />');?> | 
				<?php echo anchor('home/change_lang/en','<img src="'.base_url().'images/flag/en.png" width="24" height="16" title="English" />');?>
				</div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
		<div class="bg-content">
			
			<?php
		    	if(isset($content_text)){echo $content_text;} if(isset($content_view) && !isset($content_data)){ $this->load->view($content_view); } 
		    	if(isset($content_view) && isset($content_data)){ foreach($content_data as $key => $value){ $data[$key] = $value; } $this->load->view($content_view,$data); }
		    ?>
		</div> 
    </div>
	
    <!-- /.container -->
    <div class="container">
	<!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
					<p>Copyright &copy; ThaiOpticalGroup 2014</p>
                </div>
            </div>
        </footer>
	</div>	
</body>
</html>
