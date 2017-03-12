<?php /* Smarty version Smarty-3.1.13, created on 2015-09-22 13:16:31
         compiled from "application/views/mail/move_student.php" */ ?>
<?php /*%%SmartyHeaderCode:15404141045601388f6a9c20-65867631%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd746590f3ee638289586dd27dc6275515e1d9832' => 
    array (
      0 => 'application/views/mail/move_student.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15404141045601388f6a9c20-65867631',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'school' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5601388f775be5_14304684',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5601388f775be5_14304684')) {function content_5601388f775be5_14304684($_smarty_tpl) {?>Hej!

Utövaren <?php echo $_smarty_tpl->tpl_vars['user']->value->fullname;?>
 <?php echo $_smarty_tpl->tpl_vars['user']->value->email;?>
 begär att få bli flyttad till <?php echo $_smarty_tpl->tpl_vars['school']->value->title;?>


<?php if ($_smarty_tpl->tpl_vars['message']->value!=''){?>
Meddelande: <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

<?php }?>

Endurance.se
<?php }} ?>