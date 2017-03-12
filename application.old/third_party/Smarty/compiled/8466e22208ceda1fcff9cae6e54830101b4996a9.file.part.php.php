<?php /* Smarty version Smarty-3.1.13, created on 2014-12-18 14:49:53
         compiled from "application/views/snippets/part.php" */ ?>
<?php /*%%SmartyHeaderCode:1284693775492db81c5eee4-99102395%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8466e22208ceda1fcff9cae6e54830101b4996a9' => 
    array (
      0 => 'application/views/snippets/part.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1284693775492db81c5eee4-99102395',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'value' => 0,
    'remove' => 0,
    'title' => 0,
    'primary' => 0,
    'name' => 0,
    'type' => 0,
    'f' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5492db81cf74c5_50033189',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5492db81cf74c5_50033189')) {function content_5492db81cf74c5_50033189($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_Domains')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.Domains.php';
?>
<?php if ($_smarty_tpl->tpl_vars['value']->value!=null){?><?php $_smarty_tpl->tpl_vars['type'] = new Smarty_variable($_smarty_tpl->tpl_vars['value']->value->type, null, 0);?><?php }?>

<fieldset<?php if (isset($_smarty_tpl->tpl_vars['remove']->value)&&$_smarty_tpl->tpl_vars['remove']->value){?> class="hide"<?php }?>>
    <legend><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</legend>
    
    <?php if (isset($_smarty_tpl->tpl_vars['primary']->value)){?>
    <legend style="left: auto; right: 40px;">
        <label><input class="primary" type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[primary]" value="1"<?php if ($_smarty_tpl->tpl_vars['primary']->value){?> checked="checked"<?php }?> /> Huvuddel</label>
    </legend>
    <?php }?>
    
    <?php if (isset($_smarty_tpl->tpl_vars['remove']->value)){?>
    <legend class="delete" style="left: auto; right: 8px;">
        <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[remove]" value="<?php if ($_smarty_tpl->tpl_vars['remove']->value){?>1<?php }else{ ?>0<?php }?>" />
        <span onclick="$(this).parent().find('input').val(1);$(this).closest('fieldset').addClass('hide');<?php if ($_smarty_tpl->tpl_vars['type']->value==4){?>showshape();<?php }?>">X</span>
    </legend>
    <?php }?>
    
    <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
[type]" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" />
    
    <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = smarty_modifier_Domains('parts',$_smarty_tpl->tpl_vars['type']->value,'fields'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
    <?php echo $_smarty_tpl->getSubTemplate ("snippets/field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('name'=>$_smarty_tpl->tpl_vars['name']->value,'value'=>$_smarty_tpl->tpl_vars['value']->value,'f'=>$_smarty_tpl->tpl_vars['f']->value), 0);?>

    <?php } ?>
    
</fieldset>
<?php }} ?>