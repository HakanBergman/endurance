<?php /* Smarty version Smarty-3.1.13, created on 2015-02-04 08:47:34
         compiled from "application/views/pages/email.php" */ ?>
<?php /*%%SmartyHeaderCode:94177786054d1ce965694e4-27627908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c961ab5e5692166218845d619200edc20af06d8' => 
    array (
      0 => 'application/views/pages/email.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94177786054d1ce965694e4-27627908',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d1ce9658dd59_91483313',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d1ce9658dd59_91483313')) {function content_54d1ce9658dd59_91483313($_smarty_tpl) {?><form action="/reset/email" method="post" class="box" style="width: 256px;">

    <p>
        Din epost-adress: <br />
        <input type="text" name="email" />
    </p>
    
    <p>
        <input type="submit" value="Skicka instruktioner" />
    </p>
    
</form>
<?php }} ?>