<?php /* Smarty version Smarty-3.1.13, created on 2015-02-18 16:58:36
         compiled from "application/views/pages/group/delete.php" */ ?>
<?php /*%%SmartyHeaderCode:55989685154e4b6ac5fc5b6-02619697%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca2b1697425636a76d3e7c8193970b761ddeb3fb' => 
    array (
      0 => 'application/views/pages/group/delete.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55989685154e4b6ac5fc5b6-02619697',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'students' => 0,
    'student' => 0,
    'group' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54e4b6ac645a09_29304739',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e4b6ac645a09_29304739')) {function content_54e4b6ac645a09_29304739($_smarty_tpl) {?>
<div class="box blue schedules">
    <h1>Ta bort grupp</h1>
</div>

<?php if ($_smarty_tpl->tpl_vars['students']->value){?>
<div class="box schedules">
    
    <h2>Du kan inte ta bort denna grupp.</h2>
    
    <p>
        Följande utövare finns kopplade till denna grupp, koppla dessa till en
        annan grupp om du vill ta bort denna grupp.
    </p>
    
    <ul>
        <?php  $_smarty_tpl->tpl_vars['student'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['student']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['students']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['student']->key => $_smarty_tpl->tpl_vars['student']->value){
$_smarty_tpl->tpl_vars['student']->_loop = true;
?><li><?php echo $_smarty_tpl->tpl_vars['student']->value->fullname;?>
</li><?php } ?>
    </ul>
    
</div>
<?php }else{ ?>
<form action="/group/delete/<?php echo $_smarty_tpl->tpl_vars['group']->value->id;?>
" class="box schedules" method="post">
    
    <p>
        Vill du verkligen ta bort gruppen <?php echo $_smarty_tpl->tpl_vars['group']->value->title;?>
?
    </p>
    
    <p style="text-align: right;">
        <a href="/group/list">Avbryt</a>
        <input type="submit" name="confirm" value="Ta bort grupp" />
    </p>
    
</form>
<?php }?>
<?php }} ?>