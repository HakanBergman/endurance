<?php /* Smarty version Smarty-3.1.13, created on 2015-02-04 08:19:25
         compiled from "application/views/pages/student/chat.php" */ ?>
<?php /*%%SmartyHeaderCode:65454759854d1c7fd435d39-26261721%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca66761afffe48238b75ad4e3b407c8883b1e0da' => 
    array (
      0 => 'application/views/pages/student/chat.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65454759854d1c7fd435d39-26261721',
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
  'unifunc' => 'content_54d1c7fd4817e4_72725688',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d1c7fd4817e4_72725688')) {function content_54d1c7fd4817e4_72725688($_smarty_tpl) {?>
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