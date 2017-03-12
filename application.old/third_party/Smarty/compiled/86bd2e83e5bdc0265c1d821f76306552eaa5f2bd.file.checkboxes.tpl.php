<?php /* Smarty version Smarty-3.1.13, created on 2014-12-18 14:49:42
         compiled from "application/views/snippets/checkboxes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5082665555492db76a93326-34056186%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86bd2e83e5bdc0265c1d821f76306552eaa5f2bd' => 
    array (
      0 => 'application/views/snippets/checkboxes.tpl',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5082665555492db76a93326-34056186',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'values' => 0,
    'name' => 0,
    'v' => 0,
    'checked' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5492db76acdd91_97771511',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5492db76acdd91_97771511')) {function content_5492db76acdd91_97771511($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_inbin')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.inbin.php';
?>
<p>
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['values']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
    <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[<?php echo $_smarty_tpl->tpl_vars['v']->value->key;?>
]" value="1" id="<?php echo md5($_smarty_tpl->tpl_vars['name']->value);?>
<?php echo $_smarty_tpl->tpl_vars['v']->value->key;?>
"<?php if ($_smarty_tpl->tpl_vars['checked']->value&&smarty_modifier_inbin($_smarty_tpl->tpl_vars['v']->value->key,$_smarty_tpl->tpl_vars['checked']->value)){?> checked="checked"<?php }?> />
    <label for="<?php echo md5($_smarty_tpl->tpl_vars['name']->value);?>
<?php echo $_smarty_tpl->tpl_vars['v']->value->key;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value->val;?>
</label><br />
    <?php } ?>
</p>
<?php }} ?>