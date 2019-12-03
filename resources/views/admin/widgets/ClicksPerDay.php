<?php
    $dataSet = ClicksPerDay();
    $c = 0;
?>
<canvas id="views/browser"></canvas>
<script>
   /*
   chartID = The ID of HTML Element on the page (String)
   chart_type = the type of chart that you want to use (String) (https://www.chartjs.org/samples/latest/)
   labels = The labels that you want to add data about (String)
   data = The data of the labels (double)
   data_label = The label of any data you enter (String)
    */
    function renderChart(chartID , chart_type){
        var ctx = document.getElementById(chartID).getContext('2d');
        var myChart = new Chart(ctx,{
            type: chart_type,
            data: {
                labels: [<?php foreach ($dataSet as $browser => $count) { echo "'$browser',"; } ?>],
                            datasets:[<?php foreach ($dataSet as $browser => $count): ?>{
                            label: <?php echo "'$browser'"; ?>,
                            backgroundColor: ["rgba(0,102,0,0.2)"],
                            data:  [<?php echo $count.","; ?>],
                    },<?php endforeach; ?>]
            }
        });
    }
    renderChart( "views/browser" ,"bar");
</script>