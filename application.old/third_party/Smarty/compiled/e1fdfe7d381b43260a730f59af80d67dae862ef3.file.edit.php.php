<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 15:04:20
         compiled from "application/views/pages/teacher/edit.php" */ ?>
<?php /*%%SmartyHeaderCode:231304938549430649871f1-99665479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e1fdfe7d381b43260a730f59af80d67dae862ef3' => 
    array (
      0 => 'application/views/pages/teacher/edit.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '231304938549430649871f1-99665479',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'teacher' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_549430649bc490_43388529',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549430649bc490_43388529')) {function content_549430649bc490_43388529($_smarty_tpl) {?>
<div class="box blue">
    
    <h1> Ändra egenskaper </h1>
    
</div>

<form class="box" method="post" action="/teacher/edit/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
    
    <p>
        Fullständigt namn: <br />
        <input type="text" name="teacher_fullname" value="<?php echo $_smarty_tpl->tpl_vars['teacher']->value->fullname;?>
" />
    </p>
    
    <p>
        Epost: <br />
        <input type="text" name="teacher_email" value="<?php echo $_smarty_tpl->tpl_vars['teacher']->value->email;?>
" />
    </p>
    
    <p>
        <input type="submit" value="Spara" />
    </p>
    
</form>
<?php }} ?>