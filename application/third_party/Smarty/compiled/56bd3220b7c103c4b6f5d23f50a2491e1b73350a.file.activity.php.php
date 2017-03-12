<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 14:35:43
         compiled from "application/views/pages/activity.php" */ ?>
<?php /*%%SmartyHeaderCode:164600272654d0ceaf9f34e4-49830531%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56bd3220b7c103c4b6f5d23f50a2491e1b73350a' => 
    array (
      0 => 'application/views/pages/activity.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '164600272654d0ceaf9f34e4-49830531',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'segments' => 0,
    'segment' => 0,
    'i' => 0,
    'day_workout' => 0,
    'day_result' => 0,
    'url' => 0,
    'date' => 0,
    'd' => 0,
    'day' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d0ceafbc44d7_07979289',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d0ceafbc44d7_07979289')) {function content_54d0ceafbc44d7_07979289($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_length')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.length.php';
if (!is_callable('smarty_modifier_weekday')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.weekday.php';
if (!is_callable('smarty_modifier_Domains')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.Domains.php';
?>
<div style="float: left; width: 728px;">

    <div class="box blue"><h1>Planerat</h1></div>

    <table class="box">
        <tr>
            <th style="width: auto;"></th>
            <th style="width: 280px;">Planerat</th>
            <th style="width: 280px;">Utfört</th>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['segment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['segment']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['segments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['segment']->key => $_smarty_tpl->tpl_vars['segment']->value){
$_smarty_tpl->tpl_vars['segment']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['segment']->key;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['segment']->value;?>
</td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['day_workout']->value[$_smarty_tpl->tpl_vars['i']->value]){?>
                <div class="activity" data-id="<?php echo $_smarty_tpl->tpl_vars['day_workout']->value[$_smarty_tpl->tpl_vars['i']->value]->id;?>
" data-segment="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">
                    <p class="title"><?php echo $_smarty_tpl->tpl_vars['day_workout']->value[$_smarty_tpl->tpl_vars['i']->value]->__string__;?>
 <span class="duration"><?php echo smarty_modifier_length($_smarty_tpl->tpl_vars['day_workout']->value[$_smarty_tpl->tpl_vars['i']->value]->__duration__);?>
</span></p>
                    <p class="comment"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['day_workout']->value[$_smarty_tpl->tpl_vars['i']->value]->__comment__)===null||$tmp==='' ? "<i>inga kommentarer</i>" : $tmp);?>
</p>
                    <a class="<?php if ($_smarty_tpl->tpl_vars['day_workout']->value[$_smarty_tpl->tpl_vars['i']->value]->done){?>done<?php }else{ ?>report<?php }?>"></a>
                </div>
                <?php }?>
            </td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['day_result']->value[$_smarty_tpl->tpl_vars['i']->value]){?>
                <div class="activity" data-id="<?php echo $_smarty_tpl->tpl_vars['day_result']->value[$_smarty_tpl->tpl_vars['i']->value]->id;?>
">
                    <p class="title"><?php echo $_smarty_tpl->tpl_vars['day_result']->value[$_smarty_tpl->tpl_vars['i']->value]->__string__;?>
 <span class="duration"><?php echo smarty_modifier_length($_smarty_tpl->tpl_vars['day_result']->value[$_smarty_tpl->tpl_vars['i']->value]->__duration__);?>
</span></p>
                    <p class="comment"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['day_result']->value[$_smarty_tpl->tpl_vars['i']->value]->__comment__)===null||$tmp==='' ? "<i>inga kommentarer</i>" : $tmp);?>
</p>
                    <a class="edit"></a>
                </div>
                <?php }elseif(!$_smarty_tpl->tpl_vars['day_workout']->value[$_smarty_tpl->tpl_vars['i']->value]){?>
                <div class="activity" data-segment="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" style="border: 1px dashed #CCC;">
                    <p class="title" style="padding-top: 8px;">Lägg till träning</p>
                    <a class="add"></a>
                </div>
                <?php }?>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

<div style="float: right; width: 216px;">

    <div class="box blue"><h1>Dag</h1></div>

    <form action="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" method="post" class="box">

        <table style="width: 192px; text-align: center;">
            <tr><td></td></tr>
            <tr>
                <td rowspan="4"><a href="/activity/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->day-1;?>
/"><img src="/assets/images/left.png" /></a></td>
                <td rowspan="4"><div class="cal"><span><?php echo $_smarty_tpl->tpl_vars['date']->value->hyGregorian("M");?>
</span><?php echo $_smarty_tpl->tpl_vars['date']->value->hyGregorian("d");?>
</div></td>
                <td><b><?php echo smarty_modifier_weekday($_smarty_tpl->tpl_vars['date']->value->hyGregorian("N"));?>
</b></td>
                <td rowspan="4"><a href="/activity/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->day+1;?>
/"><img src="/assets/images/right.png" /></a></td>
            </tr>
            <tr>
                <td style="color: #333333; font-size: 10pt;"><?php echo $_smarty_tpl->tpl_vars['date']->value->hyGregorian("Y - m - d");?>
</td>
            </tr>
            <tr><td></td></tr>
        </table>

        <hr />

        <?php  $_smarty_tpl->tpl_vars['d'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['d']->_loop = false;
 $_from = smarty_modifier_Domains('day'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['d']->key => $_smarty_tpl->tpl_vars['d']->value){
$_smarty_tpl->tpl_vars['d']->_loop = true;
?>
        <?php if ($_smarty_tpl->tpl_vars['d']->value->type=="checkbox"){?>
        <?php if ($_smarty_tpl->tpl_vars['day']->value){?>
        <?php echo $_smarty_tpl->getSubTemplate ("snippets/checkboxes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('name'=>(("day[").($_smarty_tpl->tpl_vars['d']->value->name)).("]"),'values'=>$_smarty_tpl->tpl_vars['d']->value->values,'checked'=>$_smarty_tpl->tpl_vars['day']->value->{$_smarty_tpl->tpl_vars['d']->value->name}), 0);?>

        <?php }else{ ?>
        <?php echo $_smarty_tpl->getSubTemplate ("snippets/checkboxes.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('name'=>(("day[").($_smarty_tpl->tpl_vars['d']->value->name)).("]"),'values'=>$_smarty_tpl->tpl_vars['d']->value->values,'checked'=>null), 0);?>

        <?php }?>
        <?php }elseif($_smarty_tpl->tpl_vars['d']->value->type=="number"){?>
        <input type="number" size="6" name="day[<?php echo $_smarty_tpl->tpl_vars['d']->value->name;?>
]"<?php if ($_smarty_tpl->tpl_vars['day']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['day']->value->{$_smarty_tpl->tpl_vars['d']->value->name};?>
"<?php }?> />
        <label><?php echo $_smarty_tpl->tpl_vars['d']->value->title;?>
</label><br />
        <?php }elseif($_smarty_tpl->tpl_vars['d']->value->type=="text"){?>
        <input type="text" size="6" name="day[<?php echo $_smarty_tpl->tpl_vars['d']->value->name;?>
]"<?php if ($_smarty_tpl->tpl_vars['day']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['day']->value->{$_smarty_tpl->tpl_vars['d']->value->name};?>
"<?php }?> />
        <label><?php echo $_smarty_tpl->tpl_vars['d']->value->title;?>
</label><br />
        <?php }?>
        <?php } ?>

        <p style="text-align: right;"><input type="submit" value="Spara" /></p>

    </form>

</div>

<script type="text/javascript">

    $(function () {

        $.datepicker.setDefaults($.datepicker.regional['sv']);
        
        $.datepicker.setDefaults({
            firstDay: 1
        });

        $('a.report').each(function () {
            var $parent = $(this).parent();
            $(this).popup({
                id: 'add',
                type: 'day_result',
                extra: $parent.data('id') + '/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->day;?>
/' + $parent.data('segment'),
                title: "Registrera " + $parent.find('.title').clone().children().remove().end().text(),
                success: function (data) {
                    if(!data) { return ; }
                    /* FIXME */
                    window.location.reload();
                }
            });
        });

        $('a.add').each(function () {
            var $parent = $(this).parent();
            $(this).popup({
                id: 'add',
                type: 'day_result',
                extra: '0/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->day;?>
/' + $parent.data('segment'),
                title: "Registrera ny träning",
                success: function (data) {
                    if(!data) { return ; }
                    /* FIXME */
                    window.location.reload();
                }
            });
        });

        $('a.edit').each(function () {
            var $parent = $(this).parent();
            $(this).popup({
                id: $parent.data('id'),
                type: 'day_result',
                title: $parent.find('.title').clone().children().remove().end().text(),
                success: function (data) {
                    if(data) {
                        $parent.find('.title').text(data.__string__ + ' ').append($('<span class="duration" />').duration(data.__duration__));
                        $parent.find('.comment')[data.comment ? 'text' : 'html'](data.comment ? data.comment : "<i>inga kommentarer</i>");
                    } else {
                        $parent.remove();
                    }
                }
            });
        });

        $('.cal').click(function () {
            $('<div />').dialog({
                modal: true,
                title: "Välj datum",
                width: 340,
                height: 330,
                resizable: false
            }).datepicker({
                dateFormat: $.datepicker.W3C,
                defaultDate: '<?php echo $_smarty_tpl->tpl_vars['date']->value->gregorian("Y-m-d");?>
',
                onSelect: function (dateText) {
                    location.href = "/activity/" + dateText;
                }
            });
        });

    });

</script>
<?php }} ?>