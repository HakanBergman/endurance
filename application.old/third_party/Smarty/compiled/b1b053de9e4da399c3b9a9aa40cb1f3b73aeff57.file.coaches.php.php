<?php /* Smarty version Smarty-3.1.13, created on 2014-12-21 16:39:55
         compiled from "application/views/pages/student/coaches.php" */ ?>
<?php /*%%SmartyHeaderCode:9199434955496e9cb51a054-06679822%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1b053de9e4da399c3b9a9aa40cb1f3b73aeff57' => 
    array (
      0 => 'application/views/pages/student/coaches.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9199434955496e9cb51a054-06679822',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'coaches' => 0,
    'cur' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5496e9cb56e3f7_89054562',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5496e9cb56e3f7_89054562')) {function content_5496e9cb56e3f7_89054562($_smarty_tpl) {?>
<div class="box coaches blue">

    <h1> Mina externa tränare </h1>

</div>

<table class="box coaches">
    <tbody>
        <?php if (count($_smarty_tpl->tpl_vars['coaches']->value)==0){?>
            <tr>
                <td>Du har inga externa tränare.</td>
            </tr>
        <?php }else{ ?>
            <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['coaches']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cur']->key;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['cur']->value->fullname;?>
 - <?php echo $_smarty_tpl->tpl_vars['cur']->value->email;?>
</td>
                <td><a href="/external/delete_external_coach/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
" onclick="return confirm('Vill du verkligen ta bort <?php echo $_smarty_tpl->tpl_vars['cur']->value->fullname;?>
 som extern tränare?')">Ta bort</a></td>
            </tr>
            <?php } ?>
        <?php }?>
        <tr class="group-header">
        <td style="background-color: #cccccc;" colspan="2">
            <a href="/external/add">
                Lägg till extern tränare
            </a>
        </td>
    </tr>
    </tbody>
</table>
<?php }} ?>