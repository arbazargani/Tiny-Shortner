<?php $dataSets = Widget001(); ?>
<script>

google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      // data.addColumn('number', 'X');
      data.addColumn('string', 'X');
      data.addColumn('number', 'Links');

      data.addRows([
        <?php foreach( $dataSets as $date => $links ){echo "['$date', $links], ";} ?>
      ]);

      var options = {
        hAxis: {
          title: 'Date'
        },
        vAxis: {
          title: 'Count'
        },
          width: 700,
          colors: ['#e0440e'],
          chartArea: {
              backgroundColor: {
                  fill: '#3a3a3a',
                  fillOpacity: 1
              },
          },
          // Colors the entire chart area, simple version
          // backgroundColor: '#FF0000',
          // Colors the entire chart area, with opacity
          backgroundColor: {
              fill: '#dfdfdf',
              fillOpacity: 0.7
          },
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
</script>

<h3>تعداد لینک در هفته اخیر</h3>
<br/>
<div id="chart_div"></div>
