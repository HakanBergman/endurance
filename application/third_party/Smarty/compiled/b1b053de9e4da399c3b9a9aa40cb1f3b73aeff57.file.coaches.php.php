<?php /* Smarty version Smarty-3.1.13, created on 2015-02-04 13:56:26
         compiled from "application/views/pages/student/coaches.php" */ ?>
<?php /*%%SmartyHeaderCode:160306910354d216fa9a4f89-22886308%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1b053de9e4da399c3b9a9aa40cb1f3b73aeff57' => 
    array (
      0 => 'application/views/pages/student/coaches.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160306910354d216fa9a4f89-22886308',
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
  'unifunc' => 'content_54d216fa9f8684_10609575',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d216fa9f8684_10609575')) {function content_54d216fa9f8684_10609575($_smarty_tpl) {?>
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