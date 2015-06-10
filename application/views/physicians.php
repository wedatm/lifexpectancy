<?php
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
        <!-- Main content -->
        <section class="content">
            <?php
            require_once("admin_first_row.inc");
            ?>
            <style type="text/css">
                #container {
                    min-width: 310px;
                    width: 100%;
                    height: 1200px;
                    margin-right: 100px;
                    margin-bottom: 50px;
                }
            </style>

            <script type="text/javascript">
                $(function () {
                    var physician_density_array=<?php print_r($physician_density); ?>;
                    var counties_array=<?php print_r($counties); ?>;

                    $('#container').highcharts({
                        credits: {
                            enabled: false
                        },
                        chart: {
                            type: 'column',
                            margin: 75,
                            options3d: {
                                enabled: true,
                                alpha: 10,
                                beta: 10,
                                depth: 150
                            }
                        },
                        title: {
                            text: '% Score on Safety based on the Density of Physicians for every 10,000 People in a county'
                        },
                        subtitle: {
                            text: 'Based on the Availability of Medical Physicians (Check Below the Graph to View the Data Sets Used). <br/> National Average for Kenya: 18 Sources: <a style="color: blue;" href="http://data.hdx.rwlabs.org/dataset/physicians-density-in-kenya-per-county/resource_download/5c853dad-d0ab-454f-a64f-9d932da6c244">The Humanitarian Data Exchange</href>'
                        },
                        plotOptions: {
                            column: {
                                depth: 25
                            }
                        },
                        xAxis: {
                            categories: counties_array
                        },
                        yAxis: {
                            title: {
                                text: "% Score on Safety based on the National Average"
                            }
                        },
                        series: [{
                            name: ' ',
                            data: physician_density_array
                        }]
                    });
                });
            </script>
            <script src="<?php echo $assets_url ?>js/highcharts.js"></script>
            <script src="<?php echo $assets_url ?>js/highcharts-3d.js"></script>
            <script src="<?php echo $assets_url ?>js/modules/exporting.js"></script>
            <div id="container"></div>
            <h4 style="font-weight: bold;"> Data Sets Analysed </h4>
            <p> Data on the Physician Density in the various Kenyan Counties (The Number of Physicians for every 10,000 People)
                <a style="font-size: larger;" href="http://data.hdx.rwlabs.org/dataset/physicians-density-in-kenya-per-county/resource_download/90bb4dac-8086-4bd4-b50d-341cc955e7f5">  (Click to View)</a>
            </p>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once("admin_footer_scripts.inc");
?>