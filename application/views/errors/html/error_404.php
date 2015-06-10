<?php
$title="Error 404";
require_once("admin_header.inc");
?>
<body class="skin-blue-light sidebar-mini">
<div class="wrapper">
    <?php
    require_once("admin_top.inc");
    require_once("admin_side_bar.inc");
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php
        require_once("admin_content_top.inc");
        ?>
        <section class="content">
            <?php
            require_once("admin_first_row.inc");
            ?>

            <div class="section-heading">
                <h2>Error !</h2>
                <h1><?php echo $heading; ?></h1>
                <?php echo $message; ?>
            </div>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once("admin_footer_scripts.inc");
?>