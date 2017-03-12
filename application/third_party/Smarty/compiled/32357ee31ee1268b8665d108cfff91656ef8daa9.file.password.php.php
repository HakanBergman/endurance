<?php /* Smarty version Smarty-3.1.13, created on 2015-05-12 11:17:41
         compiled from "application/views/pages/teacher/password.php" */ ?>
<?php /*%%SmartyHeaderCode:5036728355551c535d51623-77774264%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '32357ee31ee1268b8665d108cfff91656ef8daa9' => 
    array (
      0 => 'application/views/pages/teacher/password.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5036728355551c535d51623-77774264',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'teacher' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5551c535e123d6_75990682',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5551c535e123d6_75990682')) {function content_5551c535e123d6_75990682($_smarty_tpl) {?>
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