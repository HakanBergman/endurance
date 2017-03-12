<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 15:04:57
         compiled from "application/views/pages/teacher/password.php" */ ?>
<?php /*%%SmartyHeaderCode:172087074054943089c70339-74574170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '32357ee31ee1268b8665d108cfff91656ef8daa9' => 
    array (
      0 => 'application/views/pages/teacher/password.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172087074054943089c70339-74574170',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'teacher' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54943089ca2346_61486641',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54943089ca2346_61486641')) {function content_54943089ca2346_61486641($_smarty_tpl) {?>
<div class="box blue">
    
    <h1> Ändra lösenord: <?php echo $_smarty_tpl->tpl_vars['teacher']->value->fullname;?>
 </h1>
    
</div>

<form class="box" method="post" action="/teacher/password/<?php echo $_smarty_tpl->tpl_vars['teacher']->value->id;?>
">
    
    <p>
        Nytt lösenord: <br />
        <input type="text" name="password" />
    </p>
    
    <p>
        <input type="submit" value="Spara" />
    </p>
    
</form>
<?php }} ?>