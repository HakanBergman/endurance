<?php /* Smarty version Smarty-3.1.13, created on 2014-12-18 19:44:57
         compiled from "application/views/pages/email.php" */ ?>
<?php /*%%SmartyHeaderCode:281203772549320a9d13217-73333481%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c961ab5e5692166218845d619200edc20af06d8' => 
    array (
      0 => 'application/views/pages/email.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '281203772549320a9d13217-73333481',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_549320a9d38028_80658185',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549320a9d38028_80658185')) {function content_549320a9d38028_80658185($_smarty_tpl) {?><form action="/reset/email" method="post" class="box" style="width: 256px;">

    <p>
        Din epost-adress: <br />
        <input type="text" name="email" />
    </p>
    
    <p>
        <input type="submit" value="Skicka instruktioner" />
    </p>
    
</form>
<?php }} ?>