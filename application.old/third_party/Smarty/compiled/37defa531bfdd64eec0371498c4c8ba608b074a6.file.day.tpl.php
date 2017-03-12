<?php /* Smarty version Smarty-3.1.13, created on 2014-12-18 14:48:57
         compiled from "application/views/snippets/day.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15485311965492db494a18a2-59403418%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '37defa531bfdd64eec0371498c4c8ba608b074a6' => 
    array (
      0 => 'application/views/snippets/day.tpl',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15485311965492db494a18a2-59403418',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'day' => 0,
    'd' => 0,
    'cur' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5492db49505d75_44347341',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5492db49505d75_44347341')) {function content_5492db49505d75_44347341($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_Domains')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.Domains.php';
if (!is_callable('smarty_modifier_inbin')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.inbin.php';
?>
<table class="scheduler">
    <col class="segment" span="1" />
    <tr>
        <td>Övrigt</td>
        <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['day']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
?>
            <td style="text-align: left;" valign="bottom">
                <?php  $_smarty_tpl->tpl_vars['d'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['d']->_loop = false;
 $_from = smarty_modifier_Domains('day'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['d']->key => $_smarty_tpl->tpl_vars['d']->value){
$_smarty_tpl->tpl_vars['d']->_loop = true;
?>
                    <?php if ($_smarty_tpl->tpl_vars['d']->value->type=="checkbox"){?>
                        <?php if ($_smarty_tpl->tpl_vars['cur']->value){?>
                            <p>
                                <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['d']->value->values; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
                                    <?php if (smarty_modifier_inbin($_smarty_tpl->tpl_vars['v']->value->key,$_smarty_tpl->tpl_vars['cur']->value->{$_smarty_tpl->tpl_vars['d']->value->name})){?>
                                        <?php echo $_smarty_tpl->tpl_vars['v']->value->val;?>
<br />
                                    <?php }?>
                                <?php } ?>
                            </p>
                        <?php }?>
                        <?php }elseif($_smarty_tpl->tpl_vars['d']->value->type=="number"||$_smarty_tpl->tpl_vars['d']->value->type=="text"){?>
                            <?php echo $_smarty_tpl->tpl_vars['d']->value->title;?>
: <?php if ($_smarty_tpl->tpl_vars['cur']->value){?><?php echo $_smarty_tpl->tpl_vars['cur']->value->{$_smarty_tpl->tpl_vars['d']->value->name};?>

                        <?php }?><br />
                    <?php }?>
                <?php } ?>
    </td>
<?php } ?>
</tr>
</table>
<?php }} ?>