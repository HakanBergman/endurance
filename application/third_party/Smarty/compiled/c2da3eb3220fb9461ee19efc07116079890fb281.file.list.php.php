<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 14:28:13
         compiled from "application/views/pages/group/list.php" */ ?>
<?php /*%%SmartyHeaderCode:167112855654d0cced4d4445-76579912%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2da3eb3220fb9461ee19efc07116079890fb281' => 
    array (
      0 => 'application/views/pages/group/list.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167112855654d0cced4d4445-76579912',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'groups' => 0,
    'cur' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d0cced504b20_84611072',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d0cced504b20_84611072')) {function content_54d0cced504b20_84611072($_smarty_tpl) {?>
<div class="box schedules blue">
    <h1> Alla Grupper </h1>
</div>

<table class="box schedules" id="sort_groups">
    <tbody id="tabledivbody">
    <tr>
        <td colspan="4">
            <a href="/group/add">
                Lägg till grupp
            </a>
        </td>
    </tr>
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cur']->key;
?>
    <tr class="sortable sectionsid" id="sectionsid_<?php echo $_smarty_tpl->tpl_vars['cur']->value->group_id;?>
">
        <td><?php echo $_smarty_tpl->tpl_vars['cur']->value->title;?>
</td>
        <td style="width: 64px; text-align: center; color: darkgray; font-size: smaller;" class="tooltip"></td>
        
        <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Ändra egenskaper');"><a href="/group/edit/<?php echo $_smarty_tpl->tpl_vars['cur']->value->group_id;?>
"><img src="/assets/images/edit.png" /></a></td>
        <td style="width: 32px;" onmouseout="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('');" onmouseover="$('.tooltip').eq(<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
).text('Ta bort gruppen');"><a href="/group/delete/<?php echo $_smarty_tpl->tpl_vars['cur']->value->group_id;?>
"><img src="/assets/images/remove.png" /></a></td>
        <td style="width: 42px;"><img src="/assets/images/down.png" class="movedownlink" />&nbsp;&nbsp;<img src="/assets/images/up.png" class="moveuplink" /></td>
    </tr>
    <?php } ?>
    <tr>
        <td colspan="4">
            <a href="/group/add">
                Lägg till grupp
            </a>
        </td>
    </tr>
    </tbody>
</table>
<?php }} ?>