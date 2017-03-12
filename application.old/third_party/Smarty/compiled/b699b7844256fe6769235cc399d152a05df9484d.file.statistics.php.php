<?php /* Smarty version Smarty-3.1.13, created on 2014-12-18 14:49:20
         compiled from "application/views/pages/group/statistics.php" */ ?>
<?php /*%%SmartyHeaderCode:20342050155492db60ed3ad2-12931373%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b699b7844256fe6769235cc399d152a05df9484d' => 
    array (
      0 => 'application/views/pages/group/statistics.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20342050155492db60ed3ad2-12931373',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'group' => 0,
    'statistics' => 0,
    'compare_stats' => 0,
    'item' => 0,
    'students' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5492db610875d8_33846496',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5492db610875d8_33846496')) {function content_5492db610875d8_33846496($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_Domains')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.Domains.php';
?><div style="float: left; width: 960px;">
    <div class="box blue">
        <h1>Statistik för: <?php echo $_smarty_tpl->tpl_vars['group']->value->title;?>
</h1>
    </div>
    
    <div class="box" id="statistics">
        
        <form action="" method="post">
            <p>
                Från: <br />
                <input type="date" name="f" value="<?php echo $_smarty_tpl->tpl_vars['statistics']->value->dateFrom->gregorian('Y-m-d');?>
" />
            </p>
            <p>
                Till: <br />
                <input type="date" name="t" value="<?php echo $_smarty_tpl->tpl_vars['statistics']->value->dateTo->gregorian('Y-m-d');?>
" />
            </p>
            <p>
                <input type="checkbox" name="compare" <?php if ($_smarty_tpl->tpl_vars['compare_stats']->value){?>checked<?php }?>>&nbsp;Jämför med föregående år<br>
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
        
        
        <div class="small"></div>
        
        <div class="large"></div>
        
        <?php if ($_smarty_tpl->tpl_vars['compare_stats']->value){?>
            
            <br />
            Föregående år
            <div class="compare_small"></div>

            <div class="compare_large"></div>
        <?php }?>
    </div>
</div>

<div class="box" style="float: left; width: 200px; margin-left: 18px; margin-right: -121px;">
    <?php echo $_smarty_tpl->getSubTemplate ("snippets/statistics.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>

<script type="text/javascript">
    
    var stats = {
        current: null,
        data: <?php echo json_encode($_smarty_tpl->tpl_vars['statistics']->value->activity_and_intensity($_smarty_tpl->tpl_vars['students']->value));?>
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
        data: <?php echo json_encode($_smarty_tpl->tpl_vars['compare_stats']->value->activity_and_intensity($_smarty_tpl->tpl_vars['students']->value));?>
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
    
    $(function () {
        
        $('input[type=checkbox]').change(function () {
            
            drawVisualization();
            
            <?php if ($_smarty_tpl->tpl_vars['compare_stats']->value){?>
                drawVisualizationCompare();
            <?php }?>
            
            if(stats.current !== null) {
                $('#statistics .small .chart').eq(stats.current).children('div').click();
            }
            
        });
        
        drawVisualization();
        
        <?php if ($_smarty_tpl->tpl_vars['compare_stats']->value){?>
            drawVisualizationCompare();
        <?php }?>
        
        $.datepicker.setDefaults($.datepicker.regional['sv']);
        
        $('input[type=date]').prop('type', 'text').datepicker({
            dateFormat: $.datepicker.W3C
        });
        
    });
    
</script>
<?php }} ?>