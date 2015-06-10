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
                    var life_expectancy_array=<?php print_r($counties_life_expectancy_array); ?>;
                    var counties_array=<?php print_r($counties_array); ?>;

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
                            text: '% of People that will live to reach Kenya\'s Expectancy Age in Various Counties'
                        },
                        subtitle: {
                            text: 'Based on the Analysis of Common Killer Diseases (Malaria, Tuberculosis), Sanitation (Water, Waste Management) and Availability of Medical Physicians<br/> Average Life expectancy in Kenya: 59.7 Sources: <a style="color: blue;" href="http://www.worldlifeexpectancy.com/kenya-life-expectancy">World Life Expectancy</href><br/> Check Below the Graph for all the Data Sets Used'
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
                                text: "% of the Population that will reach Kenya\'s Life Expectancy Age"
                            }
                        },
                        series: [{
                            name: ' ',
                            data: life_expectancy_array
                        }]
                    });
                });
            </script>
            <script src="<?php echo $assets_url ?>js/highcharts.js"></script>
            <script src="<?php echo $assets_url ?>js/highcharts-3d.js"></script>
            <script src="<?php echo $assets_url ?>js/modules/exporting.js"></script>
            <div id="container"></div>
            <h4 style="font-weight: bold;"> Data Sets Analysed </h4>
            <p> Data on Sanitation Improvement & Level of Open Defecation,  in Kenyan Counties
                <a style="font-size: larger;" href="http://data.hdx.rwlabs.org/dataset/kenya-population-totals-per-county/resource_download/895287eb-4a0e-4ce8-8bbb-f97e7c217df3">  (Click to View)</a>
            </p>
            <p> Data on Usage of Untreated Water for Drinking in Kenyan Counties
                <a style="font-size: larger;" href="http://www.majidata.go.ke/dataset_dl.php?meza=H_County_WaterSupply_DrkTrt">  (Click to View)</a>
            </p>
            <p> Data on the Prevalence of Tuberculosis in the various Kenyan Counties (Number of cases for every 10,000 People)
                <a style="font-size: larger;" href="http://data.hdx.rwlabs.org/dataset/kenya-tuberculosis-prevalence-per-county/resource_download/573f09bd-084f-4e51-8936-8a40048b7c94">  (Click to View)</a>
            </p>
            <p> Data on reported Cases of Malaria and Bed Net Usage in the various Kenyan Counties
                <a style="font-size: larger;" href="https://www.opendata.go.ke/api/views/akug-z4w2/rows.csv?accessType=DOWNLOAD">  (Click to View)</a>
            </p>
            <p> Data on the Physician Density in the various Kenyan Counties (The Number of Physicians for every 10,000 People)
                <a style="font-size: larger;" href="http://data.hdx.rwlabs.org/dataset/physicians-density-in-kenya-per-county/resource_download/90bb4dac-8086-4bd4-b50d-341cc955e7f5">  (Click to View)</a>
            </p>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
<?php
require_once("admin_footer_scripts.inc");
?>