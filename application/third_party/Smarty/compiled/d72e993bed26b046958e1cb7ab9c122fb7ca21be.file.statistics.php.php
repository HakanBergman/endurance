<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 14:28:21
         compiled from "application/views/pages/student/statistics.php" */ ?>
<?php /*%%SmartyHeaderCode:95330732054d0ccf5e60cd9-19765510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd72e993bed26b046958e1cb7ab9c122fb7ca21be' => 
    array (
      0 => 'application/views/pages/student/statistics.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '95330732054d0ccf5e60cd9-19765510',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'student' => 0,
    'statistics' => 0,
    'compare_stats' => 0,
    'item' => 0,
    'yeartable' => 0,
    'periodtable' => 0,
    'weektable' => 0,
    'daytable' => 0,
    'periodstaple' => 0,
    'weekstaple' => 0,
    'daystaple' => 0,
    'yearstaple' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d0ccf607bac1_37346559',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d0ccf607bac1_37346559')) {function content_54d0ccf607bac1_37346559($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_Domains')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.Domains.php';
?><div style="float: left; width: 960px;">  
    <div class="box blue">
        <h1>Statistik för: <?php echo $_smarty_tpl->tpl_vars['student']->value->fullname;?>
</h1>
    </div>
    
    <div class="box" id="statistics">
        
        <form action="" method="post">
            <p>
                Från: <br />
                <input type="date" name="f" value="<?php echo $_smarty_tpl->tpl_vars['statistics']->value->dateFrom->hyGregorian('Y-m-d');?>
" />
            </p>
            <p>
                Till: <br />
                <input type="date" name="t" value="<?php echo $_smarty_tpl->tpl_vars['statistics']->value->dateTo->hyGregorian('Y-m-d');?>
" />
            </p>
            <p>
                <input type="checkbox" name="compare" <?php if ($_smarty_tpl->tpl_vars['compare_stats']->value){?>checked<?php }?>>&nbsp;Jämför med tidigare år<br>
            </p>
            <p>
                <input type="submit" value="Använd" />
            </p>
        </form>
        
        <form id="intensity">
            <label><input type="checkbox" checked="checked" onchange="$(this).closest('form').find('input').prop('checked', $(this).is(':checked'));" /> Markera alla</label><br />
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = smarty_modifier_Domains('parts',0,'fields',1,'values'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <label><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['item']->value->key;?>
" checked="checked" /> <?php echo $_smarty_tpl->tpl_vars['item']->value->val;?>
</label><br />
            <?php } ?>
        </form>
        
        <form id="activity">
            <label><input type="checkbox" checked="checked" onchange="$(this).closest('form').find('input').prop('checked', $(this).is(':checked'));" /> Markera alla</label><br />
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = smarty_modifier_Domains('parts',0,'fields',0,'values'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <label><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['item']->value->key;?>
" checked="checked" /> <?php echo $_smarty_tpl->tpl_vars['item']->value->val;?>
</label><br />
            <?php } ?>
        </form>
        
        
        <div class="small">
            
        </div>
        
        
        <div class="large">
            
        </div>
        
        <?php if ($_smarty_tpl->tpl_vars['compare_stats']->value){?>
        <div class="compare_small">
            
        </div>

        <div class="compare_large">
            
        </div>
        <?php }?>
    </div>
    

    <div class="box" id="statistics">
        
        
        <script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
        
        <div id="year_div" style="width: 930px; height: 400px;"></div>
        <?php echo $_smarty_tpl->getSubTemplate ("snippets/statistics_table.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('yeartable'=>$_smarty_tpl->tpl_vars['yeartable']->value), 0);?>

        
        <div id="period_div" style="width: 930px; height: 400px;"></div>
        <?php echo $_smarty_tpl->getSubTemplate ("snippets/statistics_table.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('yeartable'=>$_smarty_tpl->tpl_vars['periodtable']->value), 0);?>

        
        <div id="week_div" style="width: 930px; height: 400px;"></div>
        <?php echo $_smarty_tpl->getSubTemplate ("snippets/statistics_table.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('yeartable'=>$_smarty_tpl->tpl_vars['weektable']->value), 0);?>

        
        <div id="day_div" style="width: 930px; height: 400px;"></div>
        <?php echo $_smarty_tpl->getSubTemplate ("snippets/statistics_table.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('yeartable'=>$_smarty_tpl->tpl_vars['daytable']->value), 0);?>
        
        
    </div>
</div>

<div class="box" style="float: left; width: 200px; margin-left: 18px; margin-right: -121px;">
    <?php echo $_smarty_tpl->getSubTemplate ("snippets/statistics.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('statistics'=>$_smarty_tpl->tpl_vars['statistics']->value,'compare_stats'=>$_smarty_tpl->tpl_vars['compare_stats']->value), 0);?>

</div>


<script type="text/javascript">
    
    var stats = {
        current: null,
        data: <?php echo json_encode($_smarty_tpl->tpl_vars['statistics']->value->activity_and_intensity($_smarty_tpl->tpl_vars['student']->value->id));?>
,
        activity: <?php echo json_encode(smarty_modifier_Domains('parts',0,'fields',0,'values'));?>
,
        intensity: <?php echo json_encode(smarty_modifier_Domains('parts',0,'fields',1,'values'));?>
,
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
    

    
    <?php if ($_smarty_tpl->tpl_vars['compare_stats']->value){?>
    var compare_stats = {
        current: null,
        data: <?php echo json_encode($_smarty_tpl->tpl_vars['compare_stats']->value->activity_and_intensity($_smarty_tpl->tpl_vars['student']->value->id));?>
,
        activity: <?php echo json_encode(smarty_modifier_Domains('parts',0,'fields',0,'values'));?>
,
        intensity: <?php echo json_encode(smarty_modifier_Domains('parts',0,'fields',1,'values'));?>
,
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
    <?php }?>
    
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
        
    

function drawPeriodStapleVisualization() {
        
    var data = google.visualization.arrayToDataTable([
                    ['x', 'A1', 'A2', 'A3', 'A3+/Tävling', 'Styrka', 'Form', 'Planerat', 'Sjuk', 'Skada', 'Vila'],
                    
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['periodstaple']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <?php echo json_encode($_smarty_tpl->tpl_vars['item']->value);?>
,
                        <?php } ?>
                    
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

            


function drawWeekStapleVisualization() {
        
    var data = google.visualization.arrayToDataTable([
                    ['x', 'A1', 'A2', 'A3', 'A3+/Tävling', 'Styrka', 'Form', 'Planerat', 'Sjuk', 'Skada', 'Vila'],
                    
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['weekstaple']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <?php echo json_encode($_smarty_tpl->tpl_vars['item']->value);?>
,
                        <?php } ?>
                    
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

    
    

function drawDayStapleVisualization() {
        
    var data = google.visualization.arrayToDataTable([
                    ['x', 'A1', 'A2', 'A3', 'A3+/Tävling', 'Styrka', 'Form', 'Planerat', 'Sjuk', 'Skada', 'Vila'],
                    
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['daystaple']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <?php echo json_encode($_smarty_tpl->tpl_vars['item']->value);?>
,
                        <?php } ?>
                    
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

    

function drawYearStapleVisualization() {
        
    var data = google.visualization.arrayToDataTable([
                    ['x', 'A1', 'A2', 'A3', 'A3+/Tävling', 'Styrka', 'Form', 'Planerat', 'Sjuk', 'Skada', 'Vila'],
                    
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yearstaple']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <?php echo json_encode($_smarty_tpl->tpl_vars['item']->value);?>
,
                        <?php } ?>
                    
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

        
    
    $(function () {
        
        $('input[type=checkbox]').change(function () {
            
            drawVisualization();
            drawWeekStapleVisualization();
            drawYearStapleVisualization();
            drawPeriodStapleVisualization();
            drawDayStapleVisualization();
            
            <?php if ($_smarty_tpl->tpl_vars['compare_stats']->value){?>
                drawVisualizationCompare();
            <?php }?>
            
            if(stats.current !== null) {
                $('#statistics .small .chart').eq(stats.current).children('div').click();
            }
            
        });
        
        drawVisualization();
        drawWeekStapleVisualization();
        drawYearStapleVisualization();
        drawPeriodStapleVisualization();
        drawDayStapleVisualization();
        
        <?php if ($_smarty_tpl->tpl_vars['compare_stats']->value){?>
            drawVisualizationCompare();
        <?php }?>
        
        $.datepicker.setDefaults($.datepicker.regional['sv']);
        
        $.datepicker.setDefaults({
            firstDay: 1
        });
        
        $('input[type=date]').prop('type', 'text').datepicker({
            dateFormat: $.datepicker.W3C
        });
        
    });
    
</script>
<?php }} ?>