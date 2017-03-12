<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 08:32:30
         compiled from "application/views/pages/schedule/list.php" */ ?>
<?php /*%%SmartyHeaderCode:12764252425493d48e8cfe07-25204671%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e74df023de83d1cbd8ce4a9e29192652deb6ecd' => 
    array (
      0 => 'application/views/pages/schedule/list.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12764252425493d48e8cfe07-25204671',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'my_schedules' => 0,
    'cur' => 0,
    'key' => 0,
    'others_schedules' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5493d48e99e282_60921055',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5493d48e99e282_60921055')) {function content_5493d48e99e282_60921055($_smarty_tpl) {?><div class="box schedules blue">
    <h1> Alla program </h1>
</div>

<table class="box schedules">
    <tr>
        <tr><td colspan="7" style="padding-top: 12px; background: #136; color: white;">Skapade av mig</td></tr>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['my_schedules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cur']->key;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['cur']->value->title;?>
</td>
            <td style="width: 64px; text-align: center; color: darkgray; font-size: smaller;" class="tooltip"></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Kopiera till utövare');"><a href="/schedule/assign/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><img src="/assets/images/assign.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Duplicera program');"><a href="/schedule/duplicate/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><img src="/assets/images/edit-copy.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Visa kalender');"><a href="/schedule/calendar/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
/5"><img src="/assets/images/calender.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Ändra egenskaper');"><a href="/schedule/edit/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><img src="/assets/images/edit.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Ta bort programmet');"><a href="/schedule/delete/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><img src="/assets/images/remove.png" /></a></td>
        </tr>
    <?php } ?>

    <tr>
        <tr><td colspan="7" style="padding-top: 12px; background: #136; color: white;">Skapade av andra</td></tr>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['others_schedules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cur']->key;
?>
        <?php if (($_smarty_tpl->tpl_vars['cur']->value->global==1)){?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['cur']->value->title;?>
</td>
            <td style="width: 64px; text-align: center; color: darkgray; font-size: smaller;" class="tooltip"></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Kopiera till utövare');"><a href="/schedule/assign/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><img src="/assets/images/assign.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Duplicera program');"><a href="/schedule/duplicate/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><img src="/assets/images/edit-copy.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Visa kalender');"><a href="/schedule/calendar/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
/5"><img src="/assets/images/calender.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Ändra egenskaper');"><a href="/schedule/edit/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><img src="/assets/images/edit.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Ta bort programmet');"><a href="/schedule/delete/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><img src="/assets/images/remove.png" /></a></td>
        </tr>
        <?php }?>
    <?php } ?>

    <tr>
        <td colspan="6">
            <a href="/schedule/add">
                Lägg till program
            </a>
        </td>
    </tr>
</table>
<?php }} ?>