<?php /* Smarty version Smarty-3.1.13, created on 2015-02-17 12:48:24
         compiled from "application/views/pages/student/add.php" */ ?>
<?php /*%%SmartyHeaderCode:40079304354e32a88d54463-98844989%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3835bf82f621fe57875778d8a7fedaac4a929804' => 
    array (
      0 => 'application/views/pages/student/add.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40079304354e32a88d54463-98844989',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'groups' => 0,
    'g' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54e32a88d91585_53809585',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e32a88d91585_53809585')) {function content_54e32a88d91585_53809585($_smarty_tpl) {?>
<div class="box blue">

    <h1> Lägg till utövare </h1>

</div>

<form class="box" method="post" action="/student/add">

    <p>
        Fullständigt namn: <br />
        <input type="text" name="student[fullname]" />
    </p>


    <p>
        Epost: <br />
        <input type="text" name="student[email]" />
    </p>

    <p>
        Nytt Lösenord: <br />
        <input type="password" name="student[password]" value="" />
    </p>


    <p>
        Grupp: <br />
        <select name="student[group_id]">
            <?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['g']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value){
$_smarty_tpl->tpl_vars['g']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['g']->value->group_id;?>
"><?php echo $_smarty_tpl->tpl_vars['g']->value->title;?>
</option>
            <?php } ?>
        </select>
    </p>

    <p>
        <input type="submit" value="Spara" name="confirm" />
    </p>

</form>
<?php }} ?>