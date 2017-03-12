<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 14:44:05
         compiled from "application/views/pages/schedule/add.php" */ ?>
<?php /*%%SmartyHeaderCode:91770236854942ba5e83068-40454520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6687136df4dd3434dea8038b3fdbc7974360eaf' => 
    array (
      0 => 'application/views/pages/schedule/add.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91770236854942ba5e83068-40454520',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'schedule' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54942ba5eb7016_41696978',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54942ba5eb7016_41696978')) {function content_54942ba5eb7016_41696978($_smarty_tpl) {?>
<div class="box blue">
    
    <h1> Lägg till program </h1>
    
</div>

<form class="box" method="post" action="/schedule/add">
    
    <p>
        Titel: <br />
        <input type="text" name="schedule[title]" />
    </p>
    
    <p>
        <input type="checkbox" name="schedule[global]" <?php if ($_smarty_tpl->tpl_vars['schedule']->value!==false&&$_smarty_tpl->tpl_vars['schedule']->value->global){?> checked="checked"<?php }?>> Globalt program
    </p>
    
    <p>
        <input name="confirm" type="submit" value="Spara" />
    </p>
    
</form>
<?php }} ?>