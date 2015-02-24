<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title;?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>images/favicon.ico?cache=1">
	
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css?cache=1" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>css/plugins/metisMenu/metisMenu.min.css?cache=1" rel="stylesheet">

    <!-- Timeline CSS 
    <link href="<?php echo base_url();?>css/plugins/timeline.css?cache=1" rel="stylesheet">-->

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>css/sb-admin-2.css?cache=1" rel="stylesheet">

    <!-- Morris Charts CSS 
    <link href="<?php echo base_url();?>css/plugins/morris.css?cache=1" rel="stylesheet">-->

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>font-awesome-4.1.0/css/font-awesome.min.css?cache=1" rel="stylesheet" type="text/css">

     <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url();?>js/jquery-1.11.0.js?cache=1"></script>
    
    <!-- CKEditor -->
    <script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>ckfinder/ckfinder.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]><![endif]-->
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js?cache=1"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js?cache=1"></script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php echo anchor('home','ThaiOpcalGroup','class="navbar-brand" target="_blank"')?>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      <?php echo $this->session->userdata('sess_fullname');?>  <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><?php echo anchor('tog_admin/user_profile','<i class="fa fa-user fa-fw"></i> User Profile')?>
                        </li>
                        <li><?php echo anchor('tog_admin/settings','<i class="fa fa-gear fa-fw"></i> Settings')?>
                        </li>
                        <li class="divider"></li>
                        <li><?php echo anchor('tog_admin/logout','<i class="fa fa-sign-out fa-fw"></i> Logout')?>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    	<!-- Menu Admin -->
                    	
                    	<!-- Administrator -->
                    	<?php if($this->session->userdata('sess_roles')==1):?>
                    	<li>
                            <?php echo anchor('tog_admin/menus','<span class="fa fa-sitemap fa-fw"></span> Menus', 'class="'.(@$active=='Menus'?'active':'').'"')?>
                        </li>
                        <li>
                            <?php echo anchor('tog_admin/users','<span class="glyphicon glyphicon-user"></span> Users', 'class="'.(@$active=='Users'?'active':'').'"')?>
                        </li>
                        <?php endif;?>
                        <!-- /Administrator -->
                        
                    	<li>
                            <?php echo anchor('tog_admin/news_list','<span class="glyphicon glyphicon-book"></span> News','class="'.(@$active=='News'?'active':'').'"')?>
                        </li>
                        <li>
                            <?php echo anchor('tog_admin/gallery_list','<span class="glyphicon glyphicon-camera"></span> Gallery', 'class="'.(@$active=='Gallery'?'active':'').'"')?>
                        </li>                       
                        <li>
                            <?php echo anchor('tog_admin/financial_list','<span class="glyphicon glyphicon-list-alt"></span> Financial Statement', 'class="'.(@$active=='Financial'?'active':'').'"')?>
                        </li>
                        <li>
                            <?php echo anchor('tog_admin/Annual_list','<span class="glyphicon glyphicon-file"></span> Annual Report', 'class="'.(@$active=='Annual'?'active':'').'"')?>
                        </li>
                        <li>
                            <?php echo anchor('tog_admin/form_56_1_list','<span class="glyphicon glyphicon-paperclip"></span> Form 56-1', 'class="'.(@$active=='Form 56-1'?'active':'').'"')?>
                        </li>
                        <li>
                            <?php echo anchor('tog_admin/meeting_list','<span class="glyphicon glyphicon-retweet"></span> Annual General Meeting', 'class="'.(@$active=='Meeting'?'active':'').'"')?>
                        </li>
                        <li class="<?php echo @$active=='Article'?'active':''?>" >
                            <a href="#"><span class="glyphicon glyphicon-list"></span> Article<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php echo $article_menu;?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <!-- /Menu Admin -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php 
		    	if(isset($content_text)){echo $content_text;} if(isset($content_view) && !isset($content_data)){ $this->load->view($content_view); } 
		    	if(isset($content_view) && isset($content_data)){ foreach($content_data as $key => $value){ $data[$key] = $value; } $this->load->view($content_view,$data); }
		    ?>	
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js?cache=1"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>js/plugins/metisMenu/metisMenu.min.js?cache=1"></script>

    <!-- Morris Charts JavaScript 
    <script src="<?php echo base_url();?>js/plugins/morris/raphael.min.js?cache=1"></script>
    <script src="<?php echo base_url();?>js/plugins/morris/morris.min.js"></script>
    <script src="<?php echo base_url();?>js/plugins/morris/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>js/sb-admin-2.js?cache=1"></script>

</body>

</html>
