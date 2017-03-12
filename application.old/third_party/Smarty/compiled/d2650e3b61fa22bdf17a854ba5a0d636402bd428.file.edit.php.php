<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 08:00:54
         compiled from "application/views/pages/group/edit.php" */ ?>
<?php /*%%SmartyHeaderCode:7151764245493cd265518e1-15159279%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2650e3b61fa22bdf17a854ba5a0d636402bd428' => 
    array (
      0 => 'application/views/pages/group/edit.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7151764245493cd265518e1-15159279',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'oldyear' => 0,
    'selyear' => 0,
    'o' => 0,
    'id' => 0,
    'group' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5493cd265b6985_37124108',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5493cd265b6985_37124108')) {function content_5493cd265b6985_37124108($_smarty_tpl) {?>
<div class="box blue">

    <h1> Ändra egenskaper 
        <?php if ($_smarty_tpl->tpl_vars['oldyear']->value){?>
            <select class="yearbox">
                <?php  $_smarty_tpl->tpl_vars['o'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['o']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['oldyear']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['o']->key => $_smarty_tpl->tpl_vars['o']->value){
$_smarty_tpl->tpl_vars['o']->_loop = true;
?>
                <option <?php if ($_smarty_tpl->tpl_vars['selyear']->value==$_smarty_tpl->tpl_vars['o']->value){?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['o']->value;?>
</option>
                <?php } ?>
            </select>
        <?php }?> 
    </h1>

</div>

<form class="box" method="post" action="/group/edit/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['selyear']->value;?>
">

    <p>
        Titel: <br />
        <input type="text" name="group[title]"<?php if ($_smarty_tpl->tpl_vars['group']->value){?> value="<?php echo $_smarty_tpl->tpl_vars['group']->value->title;?>
"<?php }?> />
    </p>

    <?php echo $_smarty_tpl->getSubTemplate ("snippets/plan.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    <p>
        <a href="/group/list">Avbryt</a> <input type="submit" value="Spara" />
    </p>

</form>

<script type="text/javascript">
	$(function() {
		$('.yearbox').on('change', function() {
			location.href = "/group/edit/<?php echo $_smarty_tpl->tpl_vars['group']->value->id;?>
/" + $(this).val();
		});
	});
</script>
<?php }} ?>