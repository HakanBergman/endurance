<?php /* Smarty version Smarty-3.1.13, created on 2014-12-18 15:02:38
         compiled from "application/views/pages/student/chat.php" */ ?>
<?php /*%%SmartyHeaderCode:4148905395492de7e15e620-12455085%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca66761afffe48238b75ad4e3b407c8883b1e0da' => 
    array (
      0 => 'application/views/pages/student/chat.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4148905395492de7e15e620-12455085',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'student' => 0,
    'chat' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5492de7e1a7015_71604122',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5492de7e1a7015_71604122')) {function content_5492de7e1a7015_71604122($_smarty_tpl) {?>
<div class="box blue">
    
    <h1>Chat för <?php echo $_smarty_tpl->tpl_vars['student']->value->fullname;?>
</h1>
</div>

<form class="box" method="post" action="/student/chat/<?php echo $_smarty_tpl->tpl_vars['student']->value->id;?>
">
    
    <p>
        Senast uppdaterad: <?php if ($_smarty_tpl->tpl_vars['chat']->value){?><?php echo $_smarty_tpl->tpl_vars['chat']->value->updated;?>
<?php }else{ ?>aldrig<?php }?>
    </p>
    
    <p>
        <textarea name="text" style="width: 100%;" rows="24"><?php if ($_smarty_tpl->tpl_vars['chat']->value){?><?php echo $_smarty_tpl->tpl_vars['chat']->value->text;?>
<?php }?></textarea>
    </p>
    
    <p>
        <input type="submit" value="Spara" />
    </p>
    
</form>
<?php }} ?>