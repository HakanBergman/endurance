<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 11:56:18
         compiled from "application/views/pages/student/delete.php" */ ?>
<?php /*%%SmartyHeaderCode:10356692215494045250b4a4-43850890%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40a82f6dbf656dbf11adf8c450b83fff3e6a1a70' => 
    array (
      0 => 'application/views/pages/student/delete.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10356692215494045250b4a4-43850890',
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
  'unifunc' => 'content_549404525417d6_72558167',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549404525417d6_72558167')) {function content_549404525417d6_72558167($_smarty_tpl) {?>
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