<?php /* Smarty version Smarty-3.1.13, created on 2015-04-17 13:26:53
         compiled from "application/views/mail/newuser.php" */ ?>
<?php /*%%SmartyHeaderCode:15046768395530edfdbaeb66-62794326%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '207a6f92205d25d61a07c5447d10b6a0b6973170' => 
    array (
      0 => 'application/views/mail/newuser.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15046768395530edfdbaeb66-62794326',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'password' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5530edfdc45710_75794054',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5530edfdc45710_75794054')) {function content_5530edfdc45710_75794054($_smarty_tpl) {?>
Hej <?php echo $_smarty_tpl->tpl_vars['user']->value->fullname;?>
,

Du har nu fått ett användarkonto på http://<?php echo $_SERVER['HTTP_HOST'];?>
/ med
följande inloggningsuppgifter.

Epost: <?php echo $_smarty_tpl->tpl_vars['user']->value->email;?>

Lösen: <?php echo $_smarty_tpl->tpl_vars['password']->value;?>


Hälsningar
Workout-teamet
<?php }} ?>