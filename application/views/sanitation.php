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
                    height: 900px;
                    margin-right: 100px;
                    margin-bottom: 50px;
                }
            </style>
            <script>
                var counties_labels=<?php print_r($counties); ?>;
                var open_defecation_score_data=<?php print_r($open_defecation); ?>;
                var water_treatment_analysis_score_data=<?php print_r($water_treatment_score); ?>;
                var general_sanitation_score_data=<?php print_r($overall_score); ?>;

            </script>
            <script type="text/javascript">

                $(function () {
                    Highcharts.setOptions({
                        chart: {
                            plotBackgroundColor: 'rgba(255, 255, 255, .9)',
                            plotShadow: true,
                            plotBorderWidth: 1
                        }
                    });
                    $("#container").highcharts({
                        chart: {
                            alignTicks: true,
                            animation: true
                        },
                        options3d: {
                            alpha: 0,
                            beta: 0,
                            depth: 100,
                            enabled: true,
                            frame: {
                                back:
                                {
                                    color: "transparent",
                                    size: 1
                                },
                                bottom:
                                {
                                    color: "transparent",
                                    size: 1
                                },
                                side:
                                {
                                    color: "transparent",
                                    size: 1
                                }
                            },
                            viewDistance: 100
                        }
                    });

                    $('#container').highcharts({
                        credits: {
                            enabled: false
                        },
                        chart: {
                            zoomType: 'xy'
                        },
                        title: {
                            text: 'Analysis of Sanitation in Kenyan Counties. '
                        },
                        subtitle: {
                            text: 'Based on the Improvment of Sanitation Level, Level of Open Defecation, Usage of Untreated Drinking Water (Check Below the Graph for the Data Sets Used) <br/>Source: The Humanitarian Data Exchange'
                        },
                        xAxis: [{
                            categories: counties_labels,
                            crosshair: true
                        }],
                        yAxis: [{ // Primary yAxis
                            labels: {
                                format: '{value}%',
                                style: {
                                    color: "#5FB404"
                                }
                            },
                            title: {
                                text: 'Safe Defecation Score',
                                style: {
                                    color: "#5FB404"
                                }
                            },
                            opposite: true

                        }, { // Secondary yAxis
                            gridLineWidth: 0,
                            title: {
                                text: 'Overall Sanitation Score',
                                style: {
                                    color: "#0000FF"
                                }
                            },
                            labels: {
                                format: '{value} %',
                                style: {
                                    color: "#0000FF"
                                }
                            }

                        },
                            { // Tertiary yAxis
                            gridLineWidth: 0,
                            title: {
                                text: 'Water Treatment Score',
                                style: {
                                    color: "#000000"
                                }
                            },
                            labels: {
                                format: '{value} %',
                                style: {
                                    color: "#000000"
                                }
                            },
                            opposite: true
                        }],
                        tooltip: {
                            shared: true
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'left',
                            x: 100,
                            verticalAlign: 'top',
                            y: 75,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                        },
                        series: [{
                            name: 'Overall Sanitation Score',
                            type: 'column',
                            color: '#0000FF',
                            yAxis: 1,
                            data: general_sanitation_score_data,
                            tooltip: {
                                valueSuffix: ' %'
                            }

                        }, {
                            name: 'Water Treatment Score',
                            type: 'spline',
                            color: "#000000",
                            yAxis: 2,
                            data: water_treatment_analysis_score_data,
                            marker: {
                                enabled: false
                            },
                            dashStyle: 'shortdot',
                            tooltip: {
                                valueSuffix: ' %'
                            }

                        }, {
                            name: 'Safe Defecation Score',
                            type: 'spline',
                            color: "#5FB404",
                            data: open_defecation_score_data,
                            tooltip: {
                                valueSuffix: ' %'
                            }
                        }]
                    });
                });
            </script>



            <script src="<?php echo $assets_url ?>js/highcharts.js"></script>
            <script src="<?php echo $assets_url ?>js/exporting.js"></script>
            <script src="<?php echo $assets_url ?>js/3d.js"></script>
            <div id="container" style="margin: 0 auto"></div>
            <h4 style="font-weight: bold;"> Data Sets Analysed </h4>
            <p> Data on Sanitation Improvement & Level of Open Defecation,  in Kenyan Counties
            <a style="font-size: larger;" href="http://data.hdx.rwlabs.org/dataset/kenya-population-totals-per-county/resource_download/895287eb-4a0e-4ce8-8bbb-f97e7c217df3">  (Click to View)</a>
            </p>
            <p> Data on Usage of Untreated Water for Drinking in Kenyan Counties
                <a style="font-size: larger;" href="http://www.majidata.go.ke/dataset_dl.php?meza=H_County_WaterSupply_DrkTrt">  (Click to View)</a>
            </p>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once("admin_footer_scripts.inc");
?>