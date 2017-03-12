<div id="dashboard">
    <table>
        <tr style='vertical-align: top'>
            <td style='width: 300px; font-size: 0.9em;'>
                <div id="control1"></div>
                <div id="control2"></div>
            </td>
            <td style='width: 600px'>
                <div style="float: left;" id="chart1"></div>
                <div style="float: left;" id="chart2"></div>
            </td>
        </tr>
    </table>
</div>

<script type="text/javascript" src="//www.google.com/jsapi"></script>

<script type="text/javascript">
    
    function drawVisualization() {
        
        var data = google.visualization.arrayToDataTable([
            ['Intensitet', 'Aktivitet', 'Tid'],
            ['A1', 'Löpning', 60],
            ['A1', 'Löpning', 45],
            ['A1', 'Cykling', 30],
            ['A2', 'Cykling', 45],
            ['A2', 'Skidor', 55],
            ['A2', 'Skidor Fri', 160],
            ['A2', 'Skidor Fri', 45],
            ['A3', 'Löpning', 45],
            ['A3', 'Skidor Klassisk',30]
        ]);
        
        var intensityPicker = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'control1',
          'options': {
            'filterColumnLabel': 'Intensitet',
            'ui': {
              'labelStacking': 'vertical',
              'allowTyping': false,
              'allowMultiple': false    
            }
          }
        });
        
        var activityPicker = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'control2',
          'options': {
            'filterColumnLabel': 'Aktivitet',
            'ui': {
              'labelStacking': 'vertical',
              'allowTyping': false,
              'allowMultiple': true    
            }
          }
        });
        
        var barChart = new google.visualization.ChartWrapper({
          'chartType': 'PieChart',
          'containerId': 'chart1',
          'options': {
            'width': 400,
            'height': 300,
            'chartArea': { top: 0, right: 0, bottom: 0 }
          },
          'view': { columns: [0] }
        });
        
        new google.visualization.Dashboard(document.getElementById('dashboard'))
            .bind(intensityPicker, activityPicker)
            .bind(activityPicker, barChart)
            .draw(data);
        
    }
    
    google.load('visualization', '1.1', { packages: ['controls'], callback: drawVisualization });
    
</script>
