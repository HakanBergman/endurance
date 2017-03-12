<?php /* Smarty version Smarty-3.1.13, created on 2016-08-16 13:39:31
         compiled from "application/views/pages/school/edit.php" */ ?>
<?php /*%%SmartyHeaderCode:156046904857b2fb73d8cf84-10306445%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a064652f3bad0166c028aa11b332da3aad46171b' => 
    array (
      0 => 'application/views/pages/school/edit.php',
      1 => 1471346285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156046904857b2fb73d8cf84-10306445',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'school' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_57b2fb73db8974_64540585',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57b2fb73db8974_64540585')) {function content_57b2fb73db8974_64540585($_smarty_tpl) {?>
<div class="box blue">
    
    <h1> Ändra egenskaper </h1>
    
</div>

<form class="box" method="post" action="/school/edit/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
    
    <p>
        Titel: <br />
        <input type="text" name="school_title" value="<?php echo $_smarty_tpl->tpl_vars['school']->value->title;?>
" />
    </p>

    <p>
        <input type="submit" value="Spara" />
    </p>
    
</form>
<?php }} ?>