<?php /* Smarty version Smarty-3.1.13, created on 2014-12-26 10:04:13
         compiled from "application/views/pages/password.php" */ ?>
<?php /*%%SmartyHeaderCode:1955762429549d248ddcee84-80108044%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd4cfbc2eb588278c96db7197394654fbd92f1db' => 
    array (
      0 => 'application/views/pages/password.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1955762429549d248ddcee84-80108044',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'reseturl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_549d248ddfa315_84435116',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549d248ddfa315_84435116')) {function content_549d248ddfa315_84435116($_smarty_tpl) {?><form action="<?php echo $_smarty_tpl->tpl_vars['reseturl']->value;?>
" method="post" class="box" style="width: 256px;">

    <p>
        Nytt lösenord: <br />
        <input type="password" name="password" />
    </p>
    
    <p>
        <input type="submit" value="Byt lösenord" />
    </p>
    
</form>
<?php }} ?>