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
                    height: 1000px;
                    margin-right: 100px;
                    margin-bottom: 50px;
                }
            </style>



            <script type="text/javascript">

                var malaria_analysis=<?php print_r($malaria_analysis); ?>;
                var tuberculosis_analysis=<?php print_r($tuberculosis_analysis); ?>;
                var killer_diseases_analysis=<?php print_r($killer_diseases_analysis); ?>;
                var counties_label=<?php print_r($counties); ?>;
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
                            text: 'Analysis of the Safety Level from Killer Diseases for Kenyan Counties '
                        },
                        subtitle: {
                            text: 'Based on the Analysis of the Prevalence of TB and Malaria Infections (Check Below the Graph for the Data Sets Used) <br/>Source: The Humanitarian Data Exchange'
                        },
                        xAxis: [{
                            categories: counties_label,
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
                                text: 'Safety from Tuberculosis Score',
                                style: {
                                    color: "#5FB404"
                                }
                            },
                            opposite: true

                        }, { // Secondary yAxis
                            gridLineWidth: 0,
                            title: {
                                text: 'Overall Safety from Killer Diseases',
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
                                    text: 'Safety from Malaria Score',
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
                            name: 'Overall Safety from Killer Diseases',
                            type: 'column',
                            color: '#0000FF',
                            yAxis: 1,
                            data: killer_diseases_analysis,
                            tooltip: {
                                valueSuffix: ' %'
                            }

                        }, {
                            name: 'Safety from Malaria Score',
                            type: 'spline',
                            color: "#000000",
                            yAxis: 2,
                            data: malaria_analysis,
                            marker: {
                                enabled: false
                            },
                            dashStyle: 'shortdot',
                            tooltip: {
                                valueSuffix: ' %'
                            }

                        }, {
                            name: 'Safety from Tuberculosis Score',
                            type: 'spline',
                            color: "#5FB404",
                            data: tuberculosis_analysis,
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
            <p> Data on Prevalence Level of Tuberculosis,  in Kenyan Counties
                <a style="font-size: larger;" href="http://data.hdx.rwlabs.org/dataset/kenya-tuberculosis-prevalence-per-county/resource_download/573f09bd-084f-4e51-8936-8a40048b7c94">  (Click to View)</a>
            </p>
            <p> Data on Infection Level of Malaria and Usage of Bed Nets in Kenyan Counties
                <a style="font-size: larger;" href="https://www.opendata.go.ke/api/views/akug-z4w2/rows.csv?accessType=DOWNLOAD">  (Click to View)</a>
            </p>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once("admin_footer_scripts.inc");
?>