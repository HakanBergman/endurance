<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 15:03:49
         compiled from "application/views/pages/teacher/list.php" */ ?>
<?php /*%%SmartyHeaderCode:1904171433549430457a3216-88732140%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fca2a77333ba9f7134668793a814560dcb5cfce' => 
    array (
      0 => 'application/views/pages/teacher/list.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1904171433549430457a3216-88732140',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'schools' => 0,
    'school' => 0,
    'cur' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54943045803e89_65742000',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54943045803e89_65742000')) {function content_54943045803e89_65742000($_smarty_tpl) {?> 
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