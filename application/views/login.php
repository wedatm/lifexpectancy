<!DOCTYPE html>
<html>
<head>
    <?php
    require_once("system_vars.php");
    ?>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo $admin_resources_url; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo $admin_resources_url; ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo $admin_resources_url; ?>plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $admin_resources_url; ?>bootstrap/css/custom.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo base_url(); ?>"><b>ISMS :: All in One</b></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign In</p>
        <form action="<?php echo $cont_url; ?>log_in/<?php echo $user_type; ?>" method="post">

            <div class="form-group has-feedback">
                <input name="user_name" id="user_name" type="email" value="<?php echo html_escape(set_value('user_name')); ?>" maxlength="50" class="form-control" required="" placeholder="Email/User ID"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input name="user_pass" id="user_pass"  type="password"  value="<?php echo html_escape(set_value('user_pass')); ?>"  required="" maxlength="50" class="form-control" placeholder="Password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8"></div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div><!-- /.col -->
            </div>

            <?php
            echo "<p class='red'>".$this->session->flashdata('custom_message')."</p>";
            ?>
            <?php echo validation_errors(); ?>
        </form>
    </div>
</div>

<!-- jQuery 2.1.4 -->
<script src="<?php echo $admin_resources_url; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo $admin_resources_url; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo $admin_resources_url; ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>