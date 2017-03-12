<?php /* Smarty version Smarty-3.1.13, created on 2015-01-02 09:31:43
         compiled from "application/views/pages/group/add.php" */ ?>
<?php /*%%SmartyHeaderCode:178218659354a6576f7b3977-15825526%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'daaa266e332936de6068290bd061087013450f53' => 
    array (
      0 => 'application/views/pages/group/add.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178218659354a6576f7b3977-15825526',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54a6576f822b04_68209653',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54a6576f822b04_68209653')) {function content_54a6576f822b04_68209653($_smarty_tpl) {?><div class="box blue">

    <h1> Lägg till grupp </h1>

</div>

<form class="box" method="post" action="/group/add">

    <p>
        Titel: <br />
        <input type="text" name="group[title]" value="" />
    </p>

    <?php echo $_smarty_tpl->getSubTemplate ("snippets/plan.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    <p>
        <a href="/group/list">Avbryt</a> <input type="submit" value="Spara" />
    </p>

</form>
<?php }} ?>