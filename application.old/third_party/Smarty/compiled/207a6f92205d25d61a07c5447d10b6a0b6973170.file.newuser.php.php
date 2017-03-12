<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 15:11:21
         compiled from "application/views/mail/newuser.php" */ ?>
<?php /*%%SmartyHeaderCode:100063824154943209277d59-80032323%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '207a6f92205d25d61a07c5447d10b6a0b6973170' => 
    array (
      0 => 'application/views/mail/newuser.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100063824154943209277d59-80032323',
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
  'unifunc' => 'content_549432092b3519_94150201',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549432092b3519_94150201')) {function content_549432092b3519_94150201($_smarty_tpl) {?>
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