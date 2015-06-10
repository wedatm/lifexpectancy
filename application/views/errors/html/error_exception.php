<?php
$title="Error 707";
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

            <h2>Error !</h2>
            <h4> Server Error 707 </h4>
            <h4>An uncaught Exception was encountered</h4>

            <p>Type: <?php echo get_class($exception); ?></p>
            <p>Message: <?php echo $message; ?></p>
            <p>Filename: <?php echo $exception->getFile(); ?></p>
            <p>Line Number: <?php echo $exception->getLine(); ?></p>

            <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

                <p>Backtrace:</p>
                <?php foreach ($exception->getTrace() as $error): ?>

                    <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

                        <p style="margin-left:10px">
                            File: <?php echo $error['file']; ?><br />
                            Line: <?php echo $error['line']; ?><br />
                            Function: <?php echo $error['function']; ?>
                        </p>
                    <?php endif ?>

                <?php endforeach ?>

            <?php endif ?>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once("admin_footer_scripts.inc");
?>