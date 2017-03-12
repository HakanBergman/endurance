<?php /* Smarty version Smarty-3.1.13, created on 2015-02-04 09:50:28
         compiled from "application/views/pages/schedule/duplicate.php" */ ?>
<?php /*%%SmartyHeaderCode:195069417754d1dd54dd4824-18573561%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8b2d05d4163579e5a2445ca6f35f1c4da36243c' => 
    array (
      0 => 'application/views/pages/schedule/duplicate.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195069417754d1dd54dd4824-18573561',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'schedule' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d1dd54e16938_22246725',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d1dd54e16938_22246725')) {function content_54d1dd54e16938_22246725($_smarty_tpl) {?>
<div class="box blue">

    <h1>Kopia av <?php echo $_smarty_tpl->tpl_vars['schedule']->value->title;?>
</h1>
</div>

<form class="box" method="post" action="/schedule/duplicate/add/<?php echo $_smarty_tpl->tpl_vars['schedule']->value->id;?>
">

    <p>
        Titel: <br />
        <input type="text" name="schedule[title]"<?php if ($_smarty_tpl->tpl_vars['schedule']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['schedule']->value->title;?>
"<?php }?> />
        <input type="hidden" name="schedule[id]" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
    </p>

    <p>
        <input type="submit" value="Spara" />
    </p>

</form>
<?php }} ?>