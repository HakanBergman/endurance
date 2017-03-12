
<div style="float: left; width: 960px;">
    <div class="box blue">
        <h1>Statistik för: {$title}</h1>
    </div>
    
    <div class="box" id="statistics">
        
        <form action="" method="post">
            <p>
                Från: <br />
                <input type="date" name="f" value="{$statistics->dateFrom->gregorian('Y-m-d')}" />
            </p>
            <p>
                Till: <br />
                <input type="date" name="t" value="{$statistics->dateTo->gregorian('Y-m-d')}" />
            </p>
            <p>
                <input type="checkbox" name="compare" {if $compare_stats}checked{/if}>&nbsp;Jämför med föregående år<br>
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
        
        {*{$statistics->dateFrom->gregorian('Y-m-d')} - {$statistics->dateTo->gregorian('Y-m-d')}*}
        <div class="small"></div>
        
        <div class="large"></div>
        
        {if $compare_stats}
            {*Tidigare år: {$compare_stats->dateFrom->gregorian('Y-m-d')} - {$compare_stats->dateTo->gregorian('Y-m-d')}*}
            <br />
            Föregående år
            <div class="compare_small"></div>

            <div class="compare_large"></div>
        {/if}
    </div>
</div>

<div class="box" style="float: left; width: 200px; margin-left: 18px; margin-right: -121px;">
    {include file="snippets/statistics.php"}
</div>

<script type="text/javascript">
    
    var stats = {
        current: null,
        data: {$statistics->activity_and_intensity($students)|json_encode},
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
        data: {$compare_stats->activity_and_intensity($students)|json_encode},
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
    
    $(function () {
        
        $('input[type=checkbox]').change(function () {
            
            drawVisualization();
            
            {if $compare_stats}
                drawVisualizationCompare();
            {/if}
            
            if(stats.current !== null) {
                $('#statistics .small .chart').eq(stats.current).children('div').click();
            }
            
        });
        
        drawVisualization();
        
        {if $compare_stats}
            drawVisualizationCompare();
        {/if}
        
        $.datepicker.setDefaults($.datepicker.regional['sv']);
        
        $('input[type=date]').prop('type', 'text').datepicker({
            dateFormat: $.datepicker.W3C
        });
        
    });
    
</script>
