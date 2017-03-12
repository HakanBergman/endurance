<?php /* Smarty version Smarty-3.1.13, created on 2015-02-04 08:49:34
         compiled from "application/views/pages/password.php" */ ?>
<?php /*%%SmartyHeaderCode:214181497554d1cf0e298965-21364445%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd4cfbc2eb588278c96db7197394654fbd92f1db' => 
    array (
      0 => 'application/views/pages/password.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214181497554d1cf0e298965-21364445',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'reseturl' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d1cf0e2c3714_55737527',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d1cf0e2c3714_55737527')) {function content_54d1cf0e2c3714_55737527($_smarty_tpl) {?><form action="<?php echo $_smarty_tpl->tpl_vars['reseturl']->value;?>
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