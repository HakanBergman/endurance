<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 14:28:22
         compiled from "application/views/snippets/statistics_table.php" */ ?>
<?php /*%%SmartyHeaderCode:4271900454d0ccf6080fa5-01110890%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9f1f612f8b5cb4dd49012d50c7094510a83164c' => 
    array (
      0 => 'application/views/snippets/statistics_table.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4271900454d0ccf6080fa5-01110890',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'yeartable' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d0ccf6112e73_00716024',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d0ccf6112e73_00716024')) {function content_54d0ccf6112e73_00716024($_smarty_tpl) {?><div style="overflow: auto; padding: 15px;">
<table class="statistics">
<tbody>
<tr>
    <th>Säsong</th>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[0];?>
</td>
    <?php } ?>
</tr>
<tr>
    <td>Styrka</td>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[5];?>
</td>
    <?php } ?>
</tr>
<tr>
    <td>A3+</td>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[4];?>
</td>
    <?php } ?>
</tr>
<tr>
    <td>A3</td>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[3];?>
</td>
    <?php } ?>
</tr>
<tr>
    <td>A2</td>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[2];?>
</td>
    <?php } ?>
</tr>
<tr>
    <td>A1</td>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[1];?>
</td>
    <?php } ?>
</tr>
<tr>
    <th>Totaltid:</th>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[8];?>
</td>
    <?php } ?>
</tr>
<tr>
    <th>Planerad tid:</th>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[7];?>
</td>
    <?php } ?>
</tr>
<tr>
    <td>Form</td>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[6];?>
</td>
    <?php } ?>
</tr>
<tr>
    <td>Sjuk</td>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[9];?>
</td>
    <?php } ?>
</tr>
<tr>
    <td>Skada</td>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[10];?>
</td>
    <?php } ?>
</tr>
<tr>
    <td>Vila</td>
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['yeartable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
        <td><?php echo $_smarty_tpl->tpl_vars['item']->value[11];?>
</td>
    <?php } ?>
</tr>
<tbody>
</table>
</div><?php }} ?>