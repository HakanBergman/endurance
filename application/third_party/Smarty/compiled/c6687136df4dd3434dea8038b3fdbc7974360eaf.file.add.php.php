<?php /* Smarty version Smarty-3.1.13, created on 2015-02-09 15:02:09
         compiled from "application/views/pages/schedule/add.php" */ ?>
<?php /*%%SmartyHeaderCode:69651625654d8bde1808860-78721484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6687136df4dd3434dea8038b3fdbc7974360eaf' => 
    array (
      0 => 'application/views/pages/schedule/add.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69651625654d8bde1808860-78721484',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'schedule' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d8bde18625b2_97891117',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d8bde18625b2_97891117')) {function content_54d8bde18625b2_97891117($_smarty_tpl) {?>
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