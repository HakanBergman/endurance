<?php /* Smarty version Smarty-3.1.13, created on 2015-02-04 13:56:12
         compiled from "application/views/pages/student/plan.php" */ ?>
<?php /*%%SmartyHeaderCode:180311281954d216eca52334-86545249%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54174cbc87ff334044d31bd624c1dbc24bc68dd2' => 
    array (
      0 => 'application/views/pages/student/plan.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180311281954d216eca52334-86545249',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'student' => 0,
    'student_endyear' => 0,
    'now' => 0,
    'year' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d216ecaf7bb5_05720975',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d216ecaf7bb5_05720975')) {function content_54d216ecaf7bb5_05720975($_smarty_tpl) {?>
<div class="box blue">

    <h1>
        Årsplanering för <?php echo $_smarty_tpl->tpl_vars['student']->value->fullname;?>
,
        <?php if ($_smarty_tpl->tpl_vars['student_endyear']->value){?>
        <select id="year">
            <option<?php if ($_smarty_tpl->tpl_vars['now']->value->year==$_smarty_tpl->tpl_vars['year']->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['now']->value->year;?>
</option>
            <?php if ($_smarty_tpl->tpl_vars['now']->value->year+1<$_smarty_tpl->tpl_vars['student_endyear']->value->year){?>
            <option<?php if ($_smarty_tpl->tpl_vars['now']->value->year+1==$_smarty_tpl->tpl_vars['year']->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['now']->value->year+1;?>
</option>
            <?php }?>
        </select>
        <?php }else{ ?>
        <select id="year">
            <option<?php if ($_smarty_tpl->tpl_vars['now']->value->year==$_smarty_tpl->tpl_vars['year']->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['now']->value->year;?>
</option>
            <option<?php if ($_smarty_tpl->tpl_vars['now']->value->year+1==$_smarty_tpl->tpl_vars['year']->value){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['now']->value->year+1;?>
</option>
        </select>
        <?php }?>
    </h1>

</div>

<form class="box" method="post" action="/student/plan/<?php echo $_smarty_tpl->tpl_vars['student']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
">

    <?php echo $_smarty_tpl->getSubTemplate ("snippets/plan.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php if (!$_smarty_tpl->tpl_vars['student_endyear']->value){?>
    <p>
        <input type="submit" value="Spara" />
    </p>
<?php }?>

</form>

<script type="text/javascript">
    $(function() {
        $('#year').on('change', function() {
            window.location.href = "/student/plan/<?php echo $_smarty_tpl->tpl_vars['student']->value->id;?>
/" + $(this).val();
        });
    });
</script>
<?php }} ?>