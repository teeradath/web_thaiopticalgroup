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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
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
                    	<li>
                            <a class="active" href="#"><span class="fa fa-sitemap fa-fw"></span> Menus</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-user"></span> Users</a>
                        </li>
                    	<li>
                            <a class="" href="#"><span class="glyphicon glyphicon-book"></span> News</a>
                        </li>
                        <li>
                            <a class="" href="#"><span class="glyphicon glyphicon-camera"></span> Gallery</a>
                        </li>
                        <li>
                            <a href="#"><span class="glyphicon glyphicon-list"></span> Article<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="#">Morris.js Charts</a>
                                </li>
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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Welcome to Administrator</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url();?>js/jquery-1.11.0.js?cache=1"></script>

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
