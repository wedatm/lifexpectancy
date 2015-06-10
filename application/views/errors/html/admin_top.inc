<header class="main-header">
<!-- Logo -->
<a href="<?php echo $base_url; ?>" class="logo">
    <span class="logo-mini"><b>Life Expectancy</b></span>
    <span class="logo-lg"><b>Life Expectancy </b></span>
</a>
<nav class="navbar navbar-static-top" role="navigation">
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="logo-lg" style="margin-left:1px; font-family: Source Sans Pro,sans-serif; font-size: larger;">Comparison of Life Expectancy in Kenyan Counties </span>
</a>
<div class="navbar-custom-menu">
<ul class="nav navbar-nav">

<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo $assets_url; ?>img/<?php echo $user_details['profile_pic'] ?>" class="user-image" alt="<?php echo $user_details['username'] ?>"/>
        <span class="hidden-xs"><?php echo $user_details['username'] ?></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img src="<?php echo $assets_url; ?>img/<?php echo $user_details['profile_pic'] ?>" class="img-circle" alt="<?php echo $user_details['username'] ?>" />
            <p><?php echo $user_details['username'] ?></p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-right">
                <a href="<?php echo $cont_url; ?>sign_out" class="btn btn-default btn-flat">Sign out</a>
            </div>
        </li>
       </ul>
      </li>
     </ul>
    </div>
   </nav>
  </header>
 <!-- Left side column. contains the logo and sidebar -->