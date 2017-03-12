<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 08:00:54
         compiled from "application/views/snippets/plan.php" */ ?>
<?php /*%%SmartyHeaderCode:11117707525493cd265b9b02-86044167%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c90d08c20c6d551164e3a4e8ae43cb68d48e6f44' => 
    array (
      0 => 'application/views/snippets/plan.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11117707525493cd265b9b02-86044167',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'plan' => 0,
    'i' => 0,
    'key' => 0,
    'j' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5493cd26642706_55644977',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5493cd26642706_55644977')) {function content_5493cd26642706_55644977($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.date_format.php';
?>
<p>
    Träningstimmar per år: <br />
    <input type="text" name="plan[hours]"<?php if ($_smarty_tpl->tpl_vars['plan']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['plan']->value->hours;?>
"<?php }?> id="total" />
    <button id="hours_split">Fördela</button>
</p>

<p>Träningstimmar per period:</p>

<div id="hours" style="overflow: auto;">
    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 12+1 - (0) : 0-(12)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
    <div style="float: left;">
        <span style="padding-left: 6px;"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</span> <br />
        <?php $_smarty_tpl->tpl_vars["key"] = new Smarty_variable(('p').($_smarty_tpl->tpl_vars['i']->value), null, 0);?>
        <input type="text" size="3" name="plan[p<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
]"<?php if ($_smarty_tpl->tpl_vars['plan']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['plan']->value->{$_smarty_tpl->tpl_vars['key']->value};?>
"<?php }?> />
    </div>
    <?php }} ?>
    <div style="float: left;">
        <br /> =
        <input type="text" disabled="disabled" size="4" style="text-align: center;" />
        <button id="week_split">Fördela</button>
    </div>
</div>

<p>Träningstimmar per vecka:</p>

<div id="hoursweek" style="overflow: auto;">
    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 12+1 - (0) : 0-(12)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
    <div style="float: left; text-align: center;">
        <span style="font-size: 8pt;">v. <?php echo smarty_modifier_date_format((Period::to_date(null,$_smarty_tpl->tpl_vars['i']->value,1)),"%W");?>
</span><br />
        <?php $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['j']->step = 1;$_smarty_tpl->tpl_vars['j']->total = (int)ceil(($_smarty_tpl->tpl_vars['j']->step > 0 ? 3+1 - (0) : 0-(3)+1)/abs($_smarty_tpl->tpl_vars['j']->step));
if ($_smarty_tpl->tpl_vars['j']->total > 0){
for ($_smarty_tpl->tpl_vars['j']->value = 0, $_smarty_tpl->tpl_vars['j']->iteration = 1;$_smarty_tpl->tpl_vars['j']->iteration <= $_smarty_tpl->tpl_vars['j']->total;$_smarty_tpl->tpl_vars['j']->value += $_smarty_tpl->tpl_vars['j']->step, $_smarty_tpl->tpl_vars['j']->iteration++){
$_smarty_tpl->tpl_vars['j']->first = $_smarty_tpl->tpl_vars['j']->iteration == 1;$_smarty_tpl->tpl_vars['j']->last = $_smarty_tpl->tpl_vars['j']->iteration == $_smarty_tpl->tpl_vars['j']->total;?>
        <?php $_smarty_tpl->tpl_vars["key"] = new Smarty_variable(((('p').($_smarty_tpl->tpl_vars['i']->value)).('w')).($_smarty_tpl->tpl_vars['j']->value), null, 0);?>
        <input type="text" size="3" name="plan[p<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
w<?php echo $_smarty_tpl->tpl_vars['j']->value;?>
]"<?php if ($_smarty_tpl->tpl_vars['plan']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['plan']->value->{$_smarty_tpl->tpl_vars['key']->value};?>
"<?php }?> /><br />
        <?php }} ?>
    </div>
    <?php }} ?>
</div>

<div id="hoursweeksummary" style="overflow: auto;">
    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 12+1 - (0) : 0-(12)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
    <div style="float: left;">
        <input type="text" size="3" disabled="disabled" />
    </div>
    <?php }} ?>
    <div style="float: left;">
        =
        <input type="text" disabled="disabled" size="4" style="text-align: center;" />
    </div>
</div>

<script type="text/javascript">
    $(function () {

        var h = $('#hours input').slice(0, 13);
        var s = $('#hours input').eq(13);
        var t = $('#total');

        h.bind('change', function () {
            var sum = 0;
            h.each(function () {
                sum += parseInt($(this).val());
            });
            s.val(sum).css('background-color', ((Math.abs(sum - t.val()) > 10)?'red':'white'));
            w.eq(0).change();
        });

        var w = $('#hoursweek input');
        var ws = $('#hoursweeksummary input');

        w.bind('change', function () {
            var tot = 0;
            for(var i=0;i<13;i++) {
                var sum = 0;
                for(var j=0;j<4;j++) {
                    sum += parseInt(w.eq(i*4+j).val());
                }
                tot += sum;
                ws.eq(i).val(sum).css('background-color', ((Math.abs(sum - h.eq(i).val()) > 10)?'red':'white'));
            }
            ws.eq(13).val(tot).css('background-color', ((Math.abs(tot - t.val()) > 10)?'red':'white'));
        });

        t.bind('change', function () {
            h.eq(0).change();
        });

        t.change();

        $('#hours_split').click(function (e) {
            e.preventDefault();
            h.val(Math.round(parseInt($('#total').val()) / 13));
            t.change();
        });

        $('#week_split').click(function (e) {
            e.preventDefault();
            for(var i=0;i<13;i++) {
                $('#hoursweek div').eq(i).children('input').val(Math.round(parseInt(h.eq(i).val()) / 4));
                t.change();
            }
        });

    });
</script>
<?php }} ?>