<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css?cache=1" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>css/plugins/metisMenu/metisMenu.min.css?cache=1" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>css/sb-admin-2.css?cache=1" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>font-awesome-4.1.0/css/font-awesome.min.css?cache=1" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]><![endif]-->
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js?cache=1"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js?cache=1"></script>
    

</head>

<body>
	<?php echo form_open("login/index");?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" >
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group <?php echo (form_error("email")!=""?"has-error":"");?>">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                    <?php echo form_error("email","<font color='error'>","</font>");?>
                                </div>
                                <div class="form-group <?php echo (form_error("password")!=""?"has-error":"");?>">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    <?php echo form_error("password","<font color='error'>","</font>");?>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                	<font color='error'><?php echo @$error_val;?></font>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="login" class="btn btn-lg btn-success btn-block" value="Login" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php echo form_close();?>
    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url();?>js/jquery-1.11.0.js?cache=1"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>js/bootstrap.min.js?cache=1"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>js/plugins/metisMenu/metisMenu.min.js?cache=1"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>js/sb-admin-2.js?cache=1"></script>

</body>

</html>
