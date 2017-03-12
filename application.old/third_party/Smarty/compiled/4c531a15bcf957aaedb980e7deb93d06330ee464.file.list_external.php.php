<?php /* Smarty version Smarty-3.1.13, created on 2015-01-13 15:46:51
         compiled from "application/views/pages/student/list_external.php" */ ?>
<?php /*%%SmartyHeaderCode:64552379154b52fdb9c3a88-46987178%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c531a15bcf957aaedb980e7deb93d06330ee464' => 
    array (
      0 => 'application/views/pages/student/list_external.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64552379154b52fdb9c3a88-46987178',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'students' => 0,
    'cur' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54b52fdba7b5d0_33838917',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54b52fdba7b5d0_33838917')) {function content_54b52fdba7b5d0_33838917($_smarty_tpl) {?>
<div class="box schedules blue">
    
    <h1> Utövare </h1>
    
</div>

<table class="box schedules">
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['students']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cur']->key;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['cur']->value->fullname;?>
 - <?php echo $_smarty_tpl->tpl_vars['cur']->value->email;?>
</td>
            <td style="width: 96px; text-align: center; color: darkgray; font-size: smaller;" id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" class="tooltip"></td>
            <td style="width: 64px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('Visa chat');"><a href="/student/chat/<?php echo $_smarty_tpl->tpl_vars['cur']->value->user_id;?>
" style="text-decoration: none;"><img src="/assets/images/discussion.png" style="vertical-align: -10px;" /> <span style="color: #666; font-size: 8pt;"><?php echo $_smarty_tpl->tpl_vars['cur']->value->user_chat_updated;?>
</span></a></td>
            <td style="width: 32px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('Visa statistik');"><a href="/student/statistics/<?php echo $_smarty_tpl->tpl_vars['cur']->value->user_id;?>
"><img src="/assets/images/stats.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('Visa kalender');"><a href="/student/calendar/<?php echo $_smarty_tpl->tpl_vars['cur']->value->user_id;?>
"><img src="/assets/images/calender.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('Visa årsplanering');"><a href="/student/plan/<?php echo $_smarty_tpl->tpl_vars['cur']->value->user_id;?>
"><img src="/assets/images/time.png" /></a></td>
        </tr>
    <?php } ?>
</table>
<?php }} ?>