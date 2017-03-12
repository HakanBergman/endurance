<?php /* Smarty version Smarty-3.1.13, created on 2015-02-05 08:53:03
         compiled from "application/views/pages/student/edit_ssf_list.php" */ ?>
<?php /*%%SmartyHeaderCode:91451843554d3215fdb33b6-55966416%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c68e559003b3a6bb19aff5bfef4584cea15ad46e' => 
    array (
      0 => 'application/views/pages/student/edit_ssf_list.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91451843554d3215fdb33b6-55966416',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'listIndex' => 0,
    'listTitle' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d3215fde2c93_20845047',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d3215fde2c93_20845047')) {function content_54d3215fde2c93_20845047($_smarty_tpl) {?>
<div class="box blue">

    <h1> Ändra egenskaper </h1>

</div>

<form class="box" method="post" action="/ssf/list/<?php echo $_smarty_tpl->tpl_vars['listIndex']->value;?>
">

    <p>
        Listans namn: <br />
        <input type="text" name="list_title" value="<?php echo $_smarty_tpl->tpl_vars['listTitle']->value;?>
" />
    </p>

    <p>
        <input name="confirm" type="submit" value="Spara" />
    </p>

</form>
<?php }} ?>