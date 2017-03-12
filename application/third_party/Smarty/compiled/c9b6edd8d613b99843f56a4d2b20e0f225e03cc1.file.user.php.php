<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 23:35:23
         compiled from "application/views/pages/user.php" */ ?>
<?php /*%%SmartyHeaderCode:105315752554d14d2b01e458-89009861%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9b6edd8d613b99843f56a4d2b20e0f225e03cc1' => 
    array (
      0 => 'application/views/pages/user.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105315752554d14d2b01e458-89009861',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageUser' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d14d2b0ce244_18915557',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d14d2b0ce244_18915557')) {function content_54d14d2b0ce244_18915557($_smarty_tpl) {?>
<div class="maincol left">
    
    <div class="box blue">
        <h1> Byt lösenord </h1>
    </div>
    <form action="/user/password" class="box" method="post">

        <p>
            Gammalt lösenord: <br />
            <input type="password" name="old" />
        </p>

        <p>
            Nytt lösenord: <br />
            <input type="password" name="new" />
        </p>

        <p>
            Upprepa lösenord: <br />
            <input type="password" name="confirm" />
        </p>

        <p>
            <input type="submit" value="Byt lösenord" />
        </p>

    </form>

    <div class="box blue">
        <h1> Byt epost </h1>
    </div>
    <form action="/user/email" class="box" method="post">

        <p>
            Ny epost: <br />
            <input type="text" name="email" />
        </p>

        <p>
            <input type="submit" value="Byt epost" />
        </p>

    </form>

    <div class="box blue">
        <h1> Byt namn </h1>
    </div>

    <form action="/user/fullname" class="box" method="post">

        <p>
            Nytt fullständigt namn: <br />
            <input type="text" name="fullname" />
        </p>

        <p>
            <input type="submit" value="Byt namn" />
        </p>

    </form>
</div>

<?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type=="10"){?>
<div class="rightcol right">
    <div class="box blue">
        <h1> Länkar </h1>
    </div>
    <div class="box">
        <a href="/assets/files/traningsdagboken2utovare.pdf" target="_blank">Lathund</a><br />
        <a href="/student/plan/<?php echo $_smarty_tpl->tpl_vars['pageUser']->value->id;?>
">Planering</a><br />
        <a href="/student/coaches/<?php echo $_smarty_tpl->tpl_vars['pageUser']->value->id;?>
">Mina externa tränare</a><br />
        <a href="/student/move">Flytta</a><br />
    </div>
</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type=="50"){?>
<div class="rightcol right">
    <div class="box blue">
        <h1> Länkar </h1>
    </div>
    <div class="box">
        <a href="/assets/files/traningsdagboken2tranare.pdf" target="_blank">Lathund</a><br />
        <a href="/external">Externa Utövare</a><br />
    </div>
</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type=="150"){?>
<div class="rightcol right">
    <div class="box blue">
        <h1> Länkar </h1>
    </div>
    <div class="box">
        <a href="/assets/files/traningsdagboken2ssf.pdf" target="_blank">Lathund</a><br />
    </div>
</div>
<?php }?>


<?php }} ?>