<div style="float: left; width: 960px;">  
    <div class="box blue">
        <h1>Statistik för: {$student->fullname}</h1>
    </div>
    
    <div class="box" id="statistics">
        
        <form action="" method="post">
            <p>
                Från: <br />
                <input type="date" name="f" value="{$statistics->dateFrom->hyGregorian('Y-m-d')}" />
            </p>
            <p>
                Till: <br />
                <input type="date" name="t" value="{$statistics->dateTo->hyGregorian('Y-m-d')}" />
            </p>
            <p>
                <input type="checkbox" name="compare" {if $compare_stats}checked{/if}>&nbsp;Jämför med tidigare år<br>
            </p>
            <p>
                <input type="submit" value="Använd" />
            </p>
        </form>
        
        <form id="intensity">
            <label><input type="checkbox" checked="checked" onchange="$(this).closest('form').find('input').prop('checked', $(this).is(':checked'));" /> Markera alla</label><br />
            {foreach from='parts'|Domains:0:'fields':1:'values' item=item}
            <label><input type="checkbox" name="{$item->key}" checked="checked" /> {$item->val}</label><br />
            {/foreach}
        </form>
        
        <form id="activity">
            <label><input type="checkbox" checked="checked" onchange="$(this).closest('form').find('input').prop('checked', $(this).is(':checked'));" /> Markera alla</label><br />
            {foreach from='parts'|Domains:0:'fields':0:'values' item=item}
            <label><input type="checkbox" name="{$item->key}" checked="checked" /> {$item->val}</label><br />
            {/foreach}
        </form>
        
        
        <div class="small">
            
        </div>
        
        
        <div class="large">
            
        </div>
        
        {if $compare_stats}
        <div class="compare_small">
            
        </div>

        <div class="compare_large">
            
        </div>
        {/if}
    </div>
    

    <div class="box" id="statistics">
        
        {literal}
        <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
        {/literal}
        <div id="year_div" style="width: 930px; height: 400px;"></div>
        {include file="snippets/statistics_table.php" yeartable=$yeartable}
        
        <div id="period_div" style="width: 930px; height: 400px;"></div>
        {include file="snippets/statistics_table.php" yeartable=$periodtable}
        
        <div id="week_div" style="width: 930px; height: 400px;"></div>
        {include file="snippets/statistics_table.php" yeartable=$weektable}
        
        <div id="day_div" style="width: 930px; height: 400px;"></div>
        {include file="snippets/statistics_table.php" yeartable=$daytable}        
        
    </div>
</div>

<div class="box" style="float: left; width: 200px; margin-left: 18px; margin-right: -121px;">
    {include file="snippets/statistics.php" statistics=$statistics compare_stats=$compare_stats}
</div>


<script type="text/javascript">
    
    var stats = {
        current: null,
        data: {$statistics->activity_and_intensity($student->id)|json_encode},
        activity: {'parts'|Domains:0:'fields':0:'values'|json_encode},
        intensity: {'parts'|Domains:0:'fields':1:'values'|json_encode},
        assemble: function (options) {
            
            var values = {};
            
            for(var i=0; i<stats.data.length; i++) {
                if(
                    $('#activity').find('[name=' + stats.data[i].activity_key + ']').is(':checked') &&
                    $('#intensity').find('[name=' + stats.data[i].intensity_key + ']').is(':checked')
                ) {
                    if(options.type == 'activity') {
                        values[stats.data[i].activity_val] = ( values[stats.data[i].activity_val] || 0 ) + ( options.field == 'time' ? stats.data[i].duration : stats.data[i].count )
                    } else {
                        values[stats.data[i].intensity_val] = ( values[stats.data[i].intensity_val] || 0 ) + ( options.field == 'time' ? stats.data[i].duration : stats.data[i].count )
                    }
                }
            }
            
            var ret = [[
                ( options.type == 'intensity' ? "Intensitet" : "Aktivitet" ),
                ( options.field == 'time' ? "Tid" : "Antal" )
            ]];
            
            for(var key in stats[options.type]) {
                ret.push([stats[options.type][key].val, (values[stats[options.type][key].val] || 0)]);
            }
            
            return ret;
        },
        colors: function (options) {
            
            var ret = [];
            
            for(var i in stats[options.type]) {
                ret.push(stats[options.type][i].color);
            }
            
            return ret;
        }
    };
    

    
    {if $compare_stats}
    var compare_stats = {
        current: null,
        data: {$compare_stats->activity_and_intensity($student->id)|json_encode},
        activity: {'parts'|Domains:0:'fields':0:'values'|json_encode},
        intensity: {'parts'|Domains:0:'fields':1:'values'|json_encode},
        assemble: function (options) {
            
            var values = {};
            
            for(var i=0; i<compare_stats.data.length; i++) {
                if(
                    $('#activity').find('[name=' + compare_stats.data[i].activity_key + ']').is(':checked') &&
                    $('#intensity').find('[name=' + compare_stats.data[i].intensity_key + ']').is(':checked')
                ) {
                    if(options.type == 'activity') {
                        values[compare_stats.data[i].activity_val] = ( values[compare_stats.data[i].activity_val] || 0 ) + ( options.field == 'time' ? compare_stats.data[i].duration : compare_stats.data[i].count )
                    } else {
                        values[compare_stats.data[i].intensity_val] = ( values[compare_stats.data[i].intensity_val] || 0 ) + ( options.field == 'time' ? compare_stats.data[i].duration : compare_stats.data[i].count )
                    }
                }
            }
            
            var ret = [[
                ( options.type == 'intensity' ? "Intensitet" : "Aktivitet" ),
                ( options.field == 'time' ? "Tid" : "Antal" )
            ]];
            
            for(var key in compare_stats[options.type]) {
                ret.push([compare_stats[options.type][key].val, (values[compare_stats[options.type][key].val] || 0)]);
            }
            
            return ret;
        },
        colors: function (options) {
            
            var ret = [];
            
            for(var i in compare_stats[options.type]) {
                ret.push(compare_stats[options.type][i].color);
            }
            
            return ret;
        }
    };
    
    var drawVisualizationCompare = function () {
        
        var $box = $('#statistics .compare_small');
        var $large = $box.parent().find('.compare_large');
        
        $box.children().remove();
        
        for(var i=0; i<4; i++) {
            (function (i) {
                
                var o = {
                    type: ( (i%2) == 0 ? 'intensity' : 'activity' ),
                    field: ( i < 2 ? 'time' : 'count' )
                };
                
                $('<div />').appendTo($box).chart({
                    w: 224,
                    data: compare_stats.assemble(o),
                    colors: compare_stats.colors(o),
                    pieSliceText: 'value',
                    callback: function () {
                        
                        var $this = $(this);
                        var chart = $this.data('chart');
                        
                        $this.append($('<div />').click(function (e) {
                            
                            compare_stats.current = i;
                            
                            var $c = $large.children();
                            
                            $('<div />').appendTo($large).chart({ w: 960, data: compare_stats.assemble(o), colors: compare_stats.colors(o), pieSliceText: 'label' });
                            
                            $c.remove();
                            
                        }));
                        
                    }
                });
                
            })(i);
        }
        
    };
    {/if}
    
    var drawVisualization = function () {
              
        var $box = $('#statistics .small');
        var $large = $box.parent().find('.large');
        
        $box.children().remove();
        
        for(var i=0; i<4; i++) {
            (function (i) {
                
                var o = {
                    type: ( (i%2) == 0 ? 'intensity' : 'activity' ),
                    field: ( i < 2 ? 'time' : 'count' )
                };
                
                $('<div />').appendTo($box).chart({
                    w: 224,
                    data: stats.assemble(o),
                    colors: stats.colors(o),
                    pieSliceText: 'value',
                    callback: function () {
                        
                        var $this = $(this);
                        var chart = $this.data('chart');
                        
                        $this.append($('<div />').click(function (e) {
                            
                            stats.current = i;
                            
                            var $c = $large.children();
                            
                            $('<div />').appendTo($large).chart({ w: 960, data: stats.assemble(o), colors: stats.colors(o), pieSliceText: 'label' });
                            
                            $c.remove();
                            
                        }));
                        
                    }
                });
                
            })(i);
        }
        
    };
        
    
{literal}
function drawPeriodStapleVisualization() {
        
    var data = google.visualization.arrayToDataTable([
                    ['x', 'A1', 'A2', 'A3', 'A3+/Tävling', 'Styrka', 'Form', 'Planerat', 'Sjuk', 'Skada', 'Vila'],
                    {/literal}
                        {foreach from=$periodstaple item=item}
                            {$item|json_encode},
                        {/foreach}
                    {literal}
                  ]);

    data = formatTime(data, 1);
    data = formatTime(data, 2);
    data = formatTime(data, 3);
    data = formatTime(data, 4);
    data = formatTime(data, 5);
    data = formatTime(data, 7);

  // Create and draw the visualization.
  new google.visualization.ComboChart(document.getElementById('period_div')).
    draw(data, {
        title : 'Periodvis farter',
        isStacked: true,
        vAxes:[
                {titleTextStyle: {color: '#FF0000'}}, // Left axis
                {titleTextStyle: {color: '#FF0000'}} // Right axis
            ],
        series:[
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'line', targetAxisIndex:1},
                {type: 'line', targetAxisIndex:0},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
        ],
        colors: ['#ffff00', '#ffcc00', '#ff9900', '#ff6600', '#000000', '#b5ca92', '#63a2d9', '#00008b', '#ff0000', '#f08080'],
        seriesType: "bars",
} );
}
{/literal}
            

{literal}
function drawWeekStapleVisualization() {
        
    var data = google.visualization.arrayToDataTable([
                    ['x', 'A1', 'A2', 'A3', 'A3+/Tävling', 'Styrka', 'Form', 'Planerat', 'Sjuk', 'Skada', 'Vila'],
                    {/literal}
                        {foreach from=$weekstaple item=item}
                            {$item|json_encode},
                        {/foreach}
                    {literal}
                  ]);

    data = formatTime(data, 1);
    data = formatTime(data, 2);
    data = formatTime(data, 3);
    data = formatTime(data, 4);
    data = formatTime(data, 5);
    data = formatTime(data, 7);

  // Create and draw the visualization.
  new google.visualization.ComboChart(document.getElementById('week_div')).
    draw(data, {
        title : 'Veckovis farter',
        isStacked: true,
        vAxes:[
                {titleTextStyle: {color: '#FF0000'}}, // Left axis
                {titleTextStyle: {color: '#FF0000'}} // Right axis
            ],
        series:[
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'line', targetAxisIndex:1},
                {type: 'line', targetAxisIndex:0},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
        ],
        colors: ['#ffff00', '#ffcc00', '#ff9900', '#ff6600', '#000000', '#b5ca92', '#63a2d9', '#00008b', '#ff0000', '#f08080'],
        seriesType: "bars",
} );
}
{/literal}
    
    
{literal}
function drawDayStapleVisualization() {
        
    var data = google.visualization.arrayToDataTable([
                    ['x', 'A1', 'A2', 'A3', 'A3+/Tävling', 'Styrka', 'Form', 'Planerat', 'Sjuk', 'Skada', 'Vila'],
                    {/literal}
                        {foreach from=$daystaple item=item}
                            {$item|json_encode},
                        {/foreach}
                    {literal}
                  ]);
    
    data = formatTime(data, 1);
    data = formatTime(data, 2);
    data = formatTime(data, 3);
    data = formatTime(data, 4);
    data = formatTime(data, 5);
    data = formatTime(data, 7);

  // Create and draw the visualization.
  new google.visualization.ComboChart(document.getElementById('day_div')).
    draw(data, {
        title : 'Dagvis farter',
        isStacked: true,
        vAxes:[
                {titleTextStyle: {color: '#FF0000'}}, // Left axis
                {titleTextStyle: {color: '#FF0000'}} // Right axis
            ],
        series:[
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'line', targetAxisIndex:1},
                {type: 'line', targetAxisIndex:0},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
        ],
        colors: ['#ffff00', '#ffcc00', '#ff9900', '#ff6600', '#000000', '#b5ca92', '#63a2d9', '#00008b', '#ff0000', '#f08080'],
        seriesType: "bars",
} );
}
{/literal}
    
{literal}
function drawYearStapleVisualization() {
        
    var data = google.visualization.arrayToDataTable([
                    ['x', 'A1', 'A2', 'A3', 'A3+/Tävling', 'Styrka', 'Form', 'Planerat', 'Sjuk', 'Skada', 'Vila'],
                    {/literal}
                        {foreach from=$yearstaple item=item}
                            {$item|json_encode},
                        {/foreach}
                    {literal}
                  ]);

    data = formatTime(data, 1);
    data = formatTime(data, 2);
    data = formatTime(data, 3);
    data = formatTime(data, 4);
    data = formatTime(data, 5);
    data = formatTime(data, 7);

  // Create and draw the visualization.
  new google.visualization.ComboChart(document.getElementById('year_div')).
    draw(data, {
        title : 'Flerårsplan',
        isStacked: true,
        vAxes:[
                {titleTextStyle: {color: '#FF0000'}}, // Left axis
                {titleTextStyle: {color: '#FF0000'}} // Right axis
            ],
        series:[
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'bars', targetAxisIndex:0},
                {type: 'line', targetAxisIndex:1},
                {type: 'line', targetAxisIndex:0},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
                {type: 'line', targetAxisIndex:1, pointSize: 5},
        ],
        colors: ['#ffff00', '#ffcc00', '#ff9900', '#ff6600', '#000000', '#b5ca92', '#63a2d9', '#00008b', '#ff0000', '#f08080'],
        seriesType: "bars",
} );
}
{/literal}
    
    
{literal}    
    function formatTime (data, column) {
        for(var i=0;i<data.getNumberOfRows();i++) {
            var s = Math.floor(data.getValue(i, column) * 60 * 60);
            var m = Math.floor(s / 60);
            var h = Math.floor(m / 60);
            s = s % 60; m = m % 60;
            var r = h + ":" + (m<10?"0"+m:m) + ":" + (s<10?"0"+s:s);
            data.setFormattedValue(i, column, r);
        }
        return data;
    }
{/literal}
        
    
    $(function () {
        
        $('input[type=checkbox]').change(function () {
            
            drawVisualization();
            drawWeekStapleVisualization();
            drawYearStapleVisualization();
            drawPeriodStapleVisualization();
            drawDayStapleVisualization();
            
            {if $compare_stats}
                drawVisualizationCompare();
            {/if}
            
            if(stats.current !== null) {
                $('#statistics .small .chart').eq(stats.current).children('div').click();
            }
            
        });
        
        drawVisualization();
        drawWeekStapleVisualization();
        drawYearStapleVisualization();
        drawPeriodStapleVisualization();
        drawDayStapleVisualization();
        
        {if $compare_stats}
            drawVisualizationCompare();
        {/if}
        
        $.datepicker.setDefaults($.datepicker.regional['sv']);
        
        $.datepicker.setDefaults({
            firstDay: 1
        });
        
        $('input[type=date]').prop('type', 'text').datepicker({
            dateFormat: $.datepicker.W3C
        });
        
    });
    
</script>
