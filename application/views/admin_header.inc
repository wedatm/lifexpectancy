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
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo $admin_resources_url; ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo $admin_resources_url; ?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo $admin_resources_url; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $admin_resources_url; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="http://localhost/lifexpectancy/assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <?php
     foreach($additional_js as $k=>$n){
       echo '<script src="'.$admin_resources_url.$n.'"></script>';
     }
     ?>
</head>