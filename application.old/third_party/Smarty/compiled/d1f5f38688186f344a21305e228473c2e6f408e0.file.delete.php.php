<?php /* Smarty version Smarty-3.1.13, created on 2015-01-08 17:21:51
         compiled from "application/views/pages/schedule/delete.php" */ ?>
<?php /*%%SmartyHeaderCode:165606403054aeae9f2e2714-16113167%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1f5f38688186f344a21305e228473c2e6f408e0' => 
    array (
      0 => 'application/views/pages/schedule/delete.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165606403054aeae9f2e2714-16113167',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'schedule' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54aeae9f314606_64592562',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54aeae9f314606_64592562')) {function content_54aeae9f314606_64592562($_smarty_tpl) {?>
<div class="box schedules blue"><h1> Ta bort program </h1></div>

<form action="/schedule/delete/<?php echo $_smarty_tpl->tpl_vars['schedule']->value->id;?>
" class="box schedules" method="post">
    
    <p>
        Vill du verkligen ta bort <?php echo $_smarty_tpl->tpl_vars['schedule']->value->title;?>
 och all data kopplad till detta
        program?
    </p>
    
    <p style="text-align: right;">
        <a href="/schedule/list">Avbryt</a>
        <input type="submit" name="confirm" value="Ta bort program" />
    </p>
    
</form>
<?php }} ?>