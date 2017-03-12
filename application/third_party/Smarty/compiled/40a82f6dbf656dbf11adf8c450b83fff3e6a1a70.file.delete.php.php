<?php /* Smarty version Smarty-3.1.13, created on 2015-02-23 22:26:10
         compiled from "application/views/pages/student/delete.php" */ ?>
<?php /*%%SmartyHeaderCode:1245276554eb9af252b1c6-70659404%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40a82f6dbf656dbf11adf8c450b83fff3e6a1a70' => 
    array (
      0 => 'application/views/pages/student/delete.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1245276554eb9af252b1c6-70659404',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'student' => 0,
    'group_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54eb9af25d9232_97863603',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54eb9af25d9232_97863603')) {function content_54eb9af25d9232_97863603($_smarty_tpl) {?>
<div class="box schedules blue"><h1> Ta bort utövare </h1></div>

<form action="/student/delete/<?php echo $_smarty_tpl->tpl_vars['student']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['group_id']->value;?>
" class="box schedules" method="post">
    
    <p>
        Vill du verkligen ta bort <?php echo $_smarty_tpl->tpl_vars['student']->value->fullname;?>
?
    </p>
    
    <p style="text-align: right;">
        <a href="/student/list">Avbryt</a>
        <input type="submit" name="confirm" value="Ta bort utövare" />
    </p>
    
</form>
<?php }} ?>