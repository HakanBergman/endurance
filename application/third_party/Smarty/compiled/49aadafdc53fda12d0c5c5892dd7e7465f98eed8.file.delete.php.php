<?php /* Smarty version Smarty-3.1.13, created on 2015-05-06 14:00:09
         compiled from "application/views/pages/teacher/delete.php" */ ?>
<?php /*%%SmartyHeaderCode:1823616362554a02490458b4-10145804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49aadafdc53fda12d0c5c5892dd7e7465f98eed8' => 
    array (
      0 => 'application/views/pages/teacher/delete.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1823616362554a02490458b4-10145804',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'teacher' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_554a0249079049_31206663',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554a0249079049_31206663')) {function content_554a0249079049_31206663($_smarty_tpl) {?>
<div class="box schedules blue"><h1> Ta bort tränare </h1></div>

<form action="/teacher/delete/<?php echo $_smarty_tpl->tpl_vars['teacher']->value->id;?>
" class="box schedules" method="post">
    <input type="hidden" name="delete_teacher" value="delete_teacher" />
    <p>
        Vill du verkligen ta bort <?php echo $_smarty_tpl->tpl_vars['teacher']->value->fullname;?>
 och all data kopplad till denna
        tränare?
    </p>
    
    <p style="text-align: right;">
        <a href="/teacher/list">Avbryt</a>
        <input type="submit" name="confirm" value="Ta bort tränare" />
    </p>
    
</form>
<?php }} ?>