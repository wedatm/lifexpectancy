<?php
$title="Error 303";
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

            <h1> Error !</h1>
            <h4> Server Error 303</h4>
            <h4>A PHP Error was encountered</h4>
            <p>Severity: <?php echo $severity; ?></p>
            <p>Message:  <?php echo $message; ?></p>
            <p>Filename: <?php echo $filepath; ?></p>
            <p>Line Number: <?php echo $line; ?></p>

            <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>

                <p>Backtrace:</p>
                <?php foreach (debug_backtrace() as $error): ?>

                    <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>

                        <p style="margin-left:10px">
                            File: <?php echo $error['file'] ?><br />
                            Line: <?php echo $error['line'] ?><br />
                            Function: <?php echo $error['function'] ?>
                        </p>

                    <?php endif ?>

                <?php endforeach ?>

            <?php endif ?>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once("admin_footer_scripts.inc");
?>