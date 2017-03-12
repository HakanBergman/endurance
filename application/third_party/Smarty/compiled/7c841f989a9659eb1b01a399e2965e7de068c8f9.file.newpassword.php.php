<?php /* Smarty version Smarty-3.1.13, created on 2015-02-04 08:47:39
         compiled from "application/views/mail/newpassword.php" */ ?>
<?php /*%%SmartyHeaderCode:128240841554d1ce9bb6ef74-54031313%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c841f989a9659eb1b01a399e2965e7de068c8f9' => 
    array (
      0 => 'application/views/mail/newpassword.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128240841554d1ce9bb6ef74-54031313',
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
  'unifunc' => 'content_54d1ce9bba7f35_19684214',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d1ce9bba7f35_19684214')) {function content_54d1ce9bba7f35_19684214($_smarty_tpl) {?>
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