<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 14:28:22
         compiled from "application/views/snippets/statistics.php" */ ?>
<?php /*%%SmartyHeaderCode:176901425854d0ccf611bac7-26585510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b62f502640eaad6356976ff1937c6f99e4845e9' => 
    array (
      0 => 'application/views/snippets/statistics.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '176901425854d0ccf611bac7-26585510',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'statistics' => 0,
    'key' => 0,
    'item' => 0,
    'val' => 0,
    'link' => 0,
    'compare_stats' => 0,
    'student' => 0,
    'students' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d0ccf62f6fe2_18144254',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d0ccf62f6fe2_18144254')) {function content_54d0ccf62f6fe2_18144254($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_length')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.length.php';
if (!is_callable('smarty_modifier_Domains')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.Domains.php';
?>
<table class="statistics main">
    <tr>
        <th></th>
        <th>Tid</th>
        <th>Pass</th>
    </tr>
    <tr>
        <td>Årsplanering</td>
        <td><?php echo smarty_modifier_length($_smarty_tpl->tpl_vars['statistics']->value->plan());?>
</td>
        <td>-</td>
    </tr>
    <tr>
        <td>Passplanering</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Genomfört</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <th></th>
        <th>Tid</th>
        <th>Pass</th>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = smarty_modifier_Domains('parts'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
    <tr class="head" data-type="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value->title;?>
</td>
        <td></td>
        <td></td>
    </tr>
    <?php if (isset($_smarty_tpl->tpl_vars['item']->value->statgroup)){?>
    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value->fields[$_smarty_tpl->tpl_vars['item']->value->statgroup]->values; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
    <tr class="body" data-type="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" data-key="<?php echo $_smarty_tpl->tpl_vars['val']->value->key;?>
">
        <td><?php echo $_smarty_tpl->tpl_vars['val']->value->val;?>
</td>
        <td></td>
        <td></td>
    </tr>
    <?php } ?>
    <?php }else{ ?>
    <tr class="body" data-type="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" data-key="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value->title;?>
</td>
        <td></td>
        <td></td>
    </tr>
    <?php }?>
    <?php } ?>
</table>

<?php if (isset($_smarty_tpl->tpl_vars['link']->value)&&$_smarty_tpl->tpl_vars['link']->value){?>
<p style="text-align: center;">
    <a href="/student/statistics/<?php echo $_smarty_tpl->tpl_vars['statistics']->value->user;?>
/<?php echo $_smarty_tpl->tpl_vars['statistics']->value->dateFrom->gregorian('Y-m-d');?>
/<?php echo $_smarty_tpl->tpl_vars['statistics']->value->dateTo->gregorian('Y-m-d');?>
">
        Visa mer statistik
    </a>
</p>
<?php }?>

<table class="statistics day">
    <tr>
        <th></th>
        <th>Antal</th>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['statistics']->value->day(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
    <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value->val;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value->count;?>
</td>
    </tr>
    <?php } ?>
    <tr>
        <td>Form</td>
        <td><?php echo round($_smarty_tpl->tpl_vars['statistics']->value->shape(),1);?>
</td>
    </tr>
</table>

<?php if (isset($_smarty_tpl->tpl_vars['compare_stats']->value)&&$_smarty_tpl->tpl_vars['compare_stats']->value){?>
Föregående år
<table class="statistics compare">
    <tr>
        <th></th>
        <th>Tid</th>
        <th>Pass</th>
    </tr>
    <tr>
        <td>Årsplanering</td>
        <td><?php echo smarty_modifier_length($_smarty_tpl->tpl_vars['compare_stats']->value->plan());?>
</td>
        <td>-</td>
    </tr>
    <tr>
        <td>Passplanering</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Genomfört</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <th></th>
        <th>Tid</th>
        <th>Pass</th>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = smarty_modifier_Domains('parts'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
    <tr class="head" data-type="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value->title;?>
</td>
        <td></td>
        <td></td>
    </tr>
    <?php if (isset($_smarty_tpl->tpl_vars['item']->value->statgroup)){?>
    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value->fields[$_smarty_tpl->tpl_vars['item']->value->statgroup]->values; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
    <tr class="body" data-type="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" data-key="<?php echo $_smarty_tpl->tpl_vars['val']->value->key;?>
">
        <td><?php echo $_smarty_tpl->tpl_vars['val']->value->val;?>
</td>
        <td></td>
        <td></td>
    </tr>
    <?php } ?>
    <?php }else{ ?>
    <tr class="body" data-type="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" data-key="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value->title;?>
</td>
        <td></td>
        <td></td>
    </tr>
    <?php }?>
    <?php } ?>
</table>

<?php if (isset($_smarty_tpl->tpl_vars['link']->value)&&$_smarty_tpl->tpl_vars['link']->value){?>
<p style="text-align: center;">
    <a href="/student/statistics/<?php echo $_smarty_tpl->tpl_vars['statistics']->value->user;?>
/<?php echo $_smarty_tpl->tpl_vars['statistics']->value->dateFrom->gregorian('Y-m-d');?>
/<?php echo $_smarty_tpl->tpl_vars['statistics']->value->dateTo->gregorian('Y-m-d');?>
">
        Visa mer statistik
    </a>
</p>
<?php }?>

<table class="statistics day">
    <tr>
        <th></th>
        <th>Antal</th>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['compare_stats']->value->day(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
    <tr>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value->val;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value->count;?>
</td>
    </tr>
    <?php } ?>
    <tr>
        <td>Form</td>
        <td><?php echo round($_smarty_tpl->tpl_vars['compare_stats']->value->shape(),1);?>
</td>
    </tr>
</table>
<?php }?>

<script type="text/javascript">

$(function () {

    var i;
    var titles = [<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = smarty_modifier_Domains('parts'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><?php echo json_encode($_smarty_tpl->tpl_vars['item']->value->title);?>
, <?php } ?>""];

    var stat = <?php echo json_encode($_smarty_tpl->tpl_vars['statistics']->value->table('day_results'));?>
;
    var $table = $('table.statistics.main');

    var summaries = {};
    var total = [0, 0];

    //---Genomfört
    for(i in stat) {
        var s = stat[i];

        summaries[s.type] = summaries[s.type] || {
            duration: 0,
            count: 0.0,
            amount: 0,
            count_total: 0
        };


        var $tr = $table.find('.body[data-type="' + s.type + '"][data-key="' + s.title_key + '"]');

        if(s.type == 3) { 
            $tr.find('td').eq(1).text(s.amount + ' st');
        }
        else if(s.type == 4) { 
            $tr.find('td').eq(1).text(s.count_total + ' st');
        }
        else if(parseInt(s.duration)) { 
            $tr.find('td').eq(1).duration(s.duration);
        }

        $tr.find('td').eq(2).text(Math.round(s.count * 100) / 100);

        summaries[s.type].duration += parseInt(s.duration);
        summaries[s.type].count += parseFloat(s.count);
        summaries[s.type].amount += parseInt(s.amount);
        summaries[s.type].count_total += parseInt(s.count_total);

        if(s.type != 2) {
            total[0] += parseInt(s.duration);
            total[1] += parseFloat(s.count);
        } else {
            //console.log(s);
        }
    }

    $table.find('tr').eq(3).find('td').eq(1).duration(total[0]);
    

    $table.find('tr').eq(3).find('td').eq(2).text(Math.round(total[1] * 1E2) / 1E2);


    //---Passplanering---
    var stat = <?php echo json_encode($_smarty_tpl->tpl_vars['statistics']->value->table('day_workouts'));?>
;
   

    var $table = $('table.statistics.main');

    var total = [0, 0];

    for(i in stat) {
        var s = stat[i];
        //console.log(s);
        
        if(s.type != 2) {
            total[0] += parseInt(s.duration);
            total[1] += parseInt(s.count);
        }
        
    }

    $table.find('tr').eq(2).find('td').eq(1).duration(total[0]);
    $table.find('tr').eq(2).find('td').eq(2).text(total[1]);
    
    var activity = <?php echo json_encode(smarty_modifier_Domains('parts',0,'fields',0,'values'));?>
;

    <?php if (isset($_smarty_tpl->tpl_vars['student']->value->id)){?>
        var stats = <?php echo json_encode($_smarty_tpl->tpl_vars['statistics']->value->activity($_smarty_tpl->tpl_vars['student']->value->id));?>
;  
    <?php }else{ ?>
        var stats = <?php echo json_encode($_smarty_tpl->tpl_vars['statistics']->value->activity($_smarty_tpl->tpl_vars['students']->value));?>
;
    <?php }?>
    

    var data = [['Aktivitet', 'Tid']];
    var color = [];

    for(var i in activity) {

        var a = (function (key) {
            for(var i in stats) {
                if(stats[i].activity == key) {
                    return stats[i];
                }
            }
            return null;
        })(activity[i].key);

        data.push([activity[i].val, ( a ? parseInt(a.duration) : 0 )]);
        color.push(activity[i].color);

    }

    $('<div />').insertAfter('table.statistics.main').chart({
        w: 200,
        data: data,
        colors: color
    });
    
    
    
    
    <?php if (isset($_smarty_tpl->tpl_vars['compare_stats']->value)&&$_smarty_tpl->tpl_vars['compare_stats']->value){?>

            var i;
            var titles = [<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = smarty_modifier_Domains('parts'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?><?php echo json_encode($_smarty_tpl->tpl_vars['item']->value->title);?>
, <?php } ?>""];

            var stat = <?php echo json_encode($_smarty_tpl->tpl_vars['compare_stats']->value->table('day_results'));?>
;
            var $table = $('table.statistics.compare');

            var summaries = {};
            var total = [0, 0];


            /*---Genomfört---*/
            for(i in stat) {
                var s = stat[i];

                summaries[s.type] = summaries[s.type] || {
                    duration: 0,
                    count: 0.0,
                    amount: 0,
                    count_total: 0
                };

                var $tr = $table.find('.body[data-type="' + s.type + '"][data-key="' + s.title_key + '"]');

                if(s.type == 3) { 
                    $tr.find('td').eq(1).text(s.amount + ' st');
                }
                else if(s.type == 4) { 
                    $tr.find('td').eq(1).text(s.count_total + ' st');
                }
                else if(parseInt(s.duration)) { 
                    $tr.find('td').eq(1).duration(s.duration);
                }

                $tr.find('td').eq(2).text(Math.round(s.count * 100) / 100);

                summaries[s.type].duration += parseInt(s.duration);
                summaries[s.type].count += parseFloat(s.count);
                summaries[s.type].amount += parseInt(s.amount);
                summaries[s.type].count_total += parseInt(s.count_total);

                if(s.type != 2) {
                    total[0] += parseInt(s.duration);
                    total[1] += parseFloat(s.count);
                }  
            }

            $table.find('tr').eq(3).find('td').eq(1).duration(total[0]);
            $table.find('tr').eq(3).find('td').eq(2).text(Math.round(total[1] * 1E2) / 1E2);

            /*---Summering---*/
            for(i in summaries) {
                var $tr = $table.find('.head[data-type="' + i + '"], .head-body[data-type="' + i + '"]');
                if(i == 3) { $tr.find('td').eq(1).text(summaries[i].amount + ' st'); }
                else if(i == 4) { $tr.find('td').eq(1).text(summaries[i].count_total + ' st'); }
                else if(summaries[i].duration) { $tr.find('td').eq(1).duration(summaries[i].duration); }
                $tr.find('td').eq(2).text(Math.round(summaries[i].count * 1E2) / 1E2);
            }

            var stat = <?php echo json_encode($_smarty_tpl->tpl_vars['compare_stats']->value->table('day_workouts'));?>
;

            var $table = $('table.statistics.compare');

            var total = [0, 0];

            for(i in stat) {
                var s = stat[i];

                if(s.type != 2) {
                    total[0] += parseInt(s.duration);
                    total[1] += parseInt(s.count);
                }

            }

            $table.find('tr').eq(2).find('td').eq(1).duration(total[0]);
            $table.find('tr').eq(2).find('td').eq(2).text(total[1]);

            var activity = <?php echo json_encode(smarty_modifier_Domains('parts',0,'fields',0,'values'));?>
;

            <?php if (isset($_smarty_tpl->tpl_vars['student']->value->id)){?>
                var stats = <?php echo json_encode($_smarty_tpl->tpl_vars['compare_stats']->value->activity($_smarty_tpl->tpl_vars['student']->value->id));?>
;  
            <?php }else{ ?>
                var stats = <?php echo json_encode($_smarty_tpl->tpl_vars['compare_stats']->value->activity($_smarty_tpl->tpl_vars['students']->value));?>
;
            <?php }?>

            var data = [['Aktivitet', 'Tid']];
            var color = [];

            for(var i in activity) {

                var a = (function (key) {
                    for(var i in stats) {
                        if(stats[i].activity == key) {
                            return stats[i];
                        }
                    }
                    return null;
                })(activity[i].key);

                data.push([activity[i].val, ( a ? parseInt(a.duration) : 0 )]);
                color.push(activity[i].color);

            }

            $('<div />').insertAfter('table.statistics.compare').chart({
                w: 200,
                data: data,
                colors: color
            });
    <?php }?>
 
});
</script>
<?php }} ?>