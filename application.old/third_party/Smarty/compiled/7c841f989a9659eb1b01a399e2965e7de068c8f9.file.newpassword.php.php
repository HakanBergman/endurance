<?php /* Smarty version Smarty-3.1.13, created on 2014-12-26 10:03:48
         compiled from "application/views/mail/newpassword.php" */ ?>
<?php /*%%SmartyHeaderCode:112159397549d2474c7c6a8-34739994%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c841f989a9659eb1b01a399e2965e7de068c8f9' => 
    array (
      0 => 'application/views/mail/newpassword.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112159397549d2474c7c6a8-34739994',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'reseturl' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_549d2474cd3985_17461056',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549d2474cd3985_17461056')) {function content_549d2474cd3985_17461056($_smarty_tpl) {?>
Hej <?php echo $_smarty_tpl->tpl_vars['user']->value->fullname;?>
,

Någon har beställt ett nytt lösenord till ditt konto, om detta inte var du kan du lugnt ignorera detta mail.

För att byta lösenord, besök följande adress:
<?php echo $_smarty_tpl->tpl_vars['reseturl']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['token']->value;?>


Hälsningar
Workout-teamet
<?php }} ?>