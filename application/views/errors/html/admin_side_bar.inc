<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $assets_url; ?>img/<?php echo $user_details['profile_pic'] ?>" class="img-circle" alt="<?php echo $user_details['username'] ?>" />
            </div>
            <div class="pull-left info">
                <p><?php echo $user_details['username'] ?></p>
            </div>
        </div>
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li class="header">WHAT TO VIEW</li>

            <li><a href="<?php echo $cont_url; ?>sanitation"><i class="fa fa-dashboard"></i> <span>Life Expectancy</span></a></li>
            <li><a href="<?php echo $cont_url; ?>physicians"><i class="fa fa-user"></i> <span>Health Physicians</span></a></li>
            <li><a href="<?php echo $cont_url; ?>sanitation"><i class="fa fa-cutlery"></i> <span>Sanitation</span></a></li>
            <li><a href="<?php echo $cont_url; ?>diseases"><i class="fa fa-book"></i> <span>Diseases</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>