<?php /* Smarty version Smarty-3.1.13, created on 2016-08-16 13:39:23
         compiled from "application/views/pages/teacher/list.php" */ ?>
<?php /*%%SmartyHeaderCode:8700472705539ecd25915a1-13859597%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fca2a77333ba9f7134668793a814560dcb5cfce' => 
    array (
      0 => 'application/views/pages/teacher/list.php',
      1 => 1471346940,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8700472705539ecd25915a1-13859597',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5539ecd262cbf2_21431532',
  'variables' => 
  array (
    'schools' => 0,
    'school' => 0,
    'cur' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5539ecd262cbf2_21431532')) {function content_5539ecd262cbf2_21431532($_smarty_tpl) {?> 
<div class="box schedules blue">

    <h1> Tränare </h1>

</div>

<table class="box schedules">

    <?php  $_smarty_tpl->tpl_vars['school'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['school']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['schools']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['school']->key => $_smarty_tpl->tpl_vars['school']->value){
$_smarty_tpl->tpl_vars['school']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['school']->key;
?>
    <tr>
        <th style="background-color: #cccccc;" colspan="5"><?php echo $_smarty_tpl->tpl_vars['school']->value->title;?>
</th>
        <th style="width: 32px; background-color: #cccccc;" onmouseout="$('.tooltip').eq().text('');" onmouseover="$('.tooltip').eq().text('Ändra egenskaper');"><a href="/school/edit/<?php echo $_smarty_tpl->tpl_vars['school']->value->id;?>
"><img src="/assets/images/edit.png" height="20" /></a></th>
    </tr>
    <?php if (isset($_smarty_tpl->tpl_vars['school']->value->school_teachers)){?>
        <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['school']->value->school_teachers; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cur']->key;
?>

        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['cur']->value->fullname;?>
</td>
            <td style="width: 64px; text-align: center; color: darkgray; font-size: smaller;" class="tooltip"></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq().text('');" onmouseover="$('.tooltip').eq().text('Ändra lösenord');"><a href="/teacher/password/<?php echo $_smarty_tpl->tpl_vars['cur']->value->user_id;?>
"><img src="/assets/images/password.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq().text('');" onmouseover="$('.tooltip').eq().text('Ändra egenskaper');"><a href="/teacher/edit/<?php echo $_smarty_tpl->tpl_vars['cur']->value->user_id;?>
"><img src="/assets/images/edit.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq().text('');" onmouseover="$('.tooltip').eq().text('Ta bort tränaren');"><a href="/teacher/delete/<?php echo $_smarty_tpl->tpl_vars['cur']->value->user_id;?>
"><img src="/assets/images/remove.png" /></a></td>
        </tr>
        <?php } ?>
    <?php }?>

    <?php } ?>

    <tr>
        <td colspan="5" style="background-color: #cccccc;">
            <a href="/teacher/edit/add">
                Lägg till tränare
            </a>
        </td>
    </tr>

</table>
<?php }} ?>