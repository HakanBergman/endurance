<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 15:11:00
         compiled from "application/views/pages/teacher/add.php" */ ?>
<?php /*%%SmartyHeaderCode:1470405014549431f446d3b7-03144096%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d8ef0a1ffae23344898758aee6579fa1766ddbc' => 
    array (
      0 => 'application/views/pages/teacher/add.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1470405014549431f446d3b7-03144096',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'schools' => 0,
    'school' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_549431f44a98b4_81255660',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549431f44a98b4_81255660')) {function content_549431f44a98b4_81255660($_smarty_tpl) {?>
<div class="box blue">
    
    <h1> Lägg till tränare </h1>
    
</div>

<form class="box" method="post" action="/teacher/edit/add">
    
    Hör till skola:
    <select name="teacher_school">
        <?php  $_smarty_tpl->tpl_vars['school'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['school']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['schools']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['school']->key => $_smarty_tpl->tpl_vars['school']->value){
$_smarty_tpl->tpl_vars['school']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['school']->key;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['school']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['school']->value->title;?>
</option>
        <?php } ?>
    </select>
    
    <p>
        Fullständigt namn: <br />
        <input type="text" name="teacher_fullname" value="" />
    </p>
    
    <p>
        Epost: <br />
        <input type="text" name="teacher_email" value="" />
    </p>
    
    <p>
        <input type="submit" value="Spara" />
    </p>
    
</form>
<?php }} ?>