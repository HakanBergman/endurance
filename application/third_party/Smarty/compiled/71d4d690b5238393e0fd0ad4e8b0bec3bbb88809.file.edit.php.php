<?php /* Smarty version Smarty-3.1.13, created on 2015-02-05 10:35:09
         compiled from "application/views/pages/schedule/edit.php" */ ?>
<?php /*%%SmartyHeaderCode:201890604754d220f7185bf5-82081576%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71d4d690b5238393e0fd0ad4e8b0bec3bbb88809' => 
    array (
      0 => 'application/views/pages/schedule/edit.php',
      1 => 1423128891,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201890604754d220f7185bf5-82081576',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d220f71d33c6_35383663',
  'variables' => 
  array (
    'id' => 0,
    'schedule' => 0,
    'pageUser' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d220f71d33c6_35383663')) {function content_54d220f71d33c6_35383663($_smarty_tpl) {?>
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
<?php }else{ ?>
    <p>
        <input type="hidden" name="schedule[global]" <?php if ($_smarty_tpl->tpl_vars['schedule']->value!==false&&$_smarty_tpl->tpl_vars['schedule']->value->global){?> value='1'<?php }else{ ?> value='0'<?php }?>>
    </p>

    <?php }?>
    
    <p>
        <input name="confirm" type="submit" value="Spara" />
    </p>
    
</form>
<?php }} ?>