<?php /* Smarty version Smarty-3.1.13, created on 2015-02-26 11:15:20
         compiled from "application/views/pages/student/edit.php" */ ?>
<?php /*%%SmartyHeaderCode:96941474254eef238182a51-49940479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a80cfe632dd0cbe33e40e0336dc4a42aabc2adec' => 
    array (
      0 => 'application/views/pages/student/edit.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96941474254eef238182a51-49940479',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'id' => 0,
    'student' => 0,
    'pageUser' => 0,
    'groups' => 0,
    'g' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54eef238272779_92617630',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54eef238272779_92617630')) {function content_54eef238272779_92617630($_smarty_tpl) {?>
<div class="box blue">

    <h1> Ändra egenskaper </h1>

</div>

<form class="box" method="post" action="/student/edit/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">

    <p>
        Fullständigt namn: <br />
        <input type="text" name="student[fullname]"<?php if ($_smarty_tpl->tpl_vars['student']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['student']->value->fullname;?>
"<?php }?> />
    </p>


    <p>
        Epost: <br />
        <input type="text" name="student[email]"<?php if ($_smarty_tpl->tpl_vars['student']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['student']->value->email;?>
"<?php }?> />
    </p>

    <p>
        Nytt Lösenord: <br />
        <input type="text" name="student[password]" value="" />
    </p>


    <p <?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type=="150"){?>style="display: none;"<?php }?>>
        Grupp: <br />
        <select name="student[group_id]">
            <?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['g']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value){
$_smarty_tpl->tpl_vars['g']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['g']->value->id;?>
"<?php if ($_smarty_tpl->tpl_vars['student']->value&&$_smarty_tpl->tpl_vars['student']->value->user_groups[0]->group_id==$_smarty_tpl->tpl_vars['g']->value->id){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['g']->value->title;?>
</option><?php } ?>
        </select>
    </p>

    <p>
        <input name="confirm" type="submit" value="Spara" />
    </p>

</form>
<?php }} ?>