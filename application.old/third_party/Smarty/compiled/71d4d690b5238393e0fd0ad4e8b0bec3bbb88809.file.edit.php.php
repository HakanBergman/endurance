<?php /* Smarty version Smarty-3.1.13, created on 2015-01-08 10:45:59
         compiled from "application/views/pages/schedule/edit.php" */ ?>
<?php /*%%SmartyHeaderCode:121948748154ae51d7b5a086-01560415%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71d4d690b5238393e0fd0ad4e8b0bec3bbb88809' => 
    array (
      0 => 'application/views/pages/schedule/edit.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121948748154ae51d7b5a086-01560415',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'schedule' => 0,
    'pageUser' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54ae51d7bcd0d6_21317048',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54ae51d7bcd0d6_21317048')) {function content_54ae51d7bcd0d6_21317048($_smarty_tpl) {?>
<div class="box blue">
    
    <h1> Ändra egenskaper </h1>
    
</div>

<form class="box" method="post" action="/schedule/edit/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
    
    <p>
        Titel: <br />
        <input type="text" name="schedule[title]" value="<?php echo $_smarty_tpl->tpl_vars['schedule']->value->title;?>
" />
    </p>
    
    
    <?php if ($_smarty_tpl->tpl_vars['schedule']->value->user_id==$_smarty_tpl->tpl_vars['pageUser']->value->id){?>
    <p>
        <input type="checkbox" name="schedule[global]" <?php if ($_smarty_tpl->tpl_vars['schedule']->value!==false&&$_smarty_tpl->tpl_vars['schedule']->value->global){?> checked="checked"<?php }?>> Globalt program
    </p>
    <?php }?>
    
    <p>
        <input name="confirm" type="submit" value="Spara" />
    </p>
    
</form>
<?php }} ?>