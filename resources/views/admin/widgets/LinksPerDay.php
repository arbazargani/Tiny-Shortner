<?php
    $dataSet = LinksPerDay();
    $c = 0;
?>
<canvas id="links/day"></canvas>
<script>
   /*
   chartID = The ID of HTML Element on the page (String)
   chart_type = the type of chart that you want to use (String) (https://www.chartjs.org/samples/latest/)
   labels = The labels that you want to add data about (String)
   data = The data of the labels (double)
   data_label = The label of any data you enter (String)
    */
    function renderChart(chartID , chart_type , labels , data , data_label ){
        var ctx = document.getElementById(chartID).getContext('2d');
        var myChart = new Chart(ctx,{
            type: chart_type,
            data: {
                labels: labels,
                datasets:[{
                        label: data_label,
                        backgroundColor: ["rgba(255,0,0,0.2)"],
                        data: data,
                }]
            }
        });
    }


        data1 = [<?php foreach ($dataSet as $date => $links) {
            $c ++;
            echo "$links";
            if ($c !== count($dataSet)) {
                echo ",";
            }
        } ?>];
        labels1 = [<?php $c = 0; foreach ($dataSet as $date => $links) {
            $c ++;
            echo "'$date'";
            if ($c !== count($dataSet)) {
                echo ",";
            }
        } ?>];
        renderChart( "links/day" ,"line" ,labels1 , data1 , "تعداد لینک");
</script>