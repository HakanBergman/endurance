<?php /* Smarty version Smarty-3.1.13, created on 2014-12-21 16:39:57
         compiled from "application/views/pages/student/add_external_coach.php" */ ?>
<?php /*%%SmartyHeaderCode:18227406705496e9cdadb012-23284995%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5936241393448f563746c6e87fd57dfb0ba5992' => 
    array (
      0 => 'application/views/pages/student/add_external_coach.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18227406705496e9cdadb012-23284995',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'coach' => 0,
    'user_coaches' => 0,
    'userid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5496e9cdb416f4_60451286',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5496e9cdb416f4_60451286')) {function content_5496e9cdb416f4_60451286($_smarty_tpl) {?>
<div class="box blue">

    <h1> Lägg till extern tränare </h1>

</div>

<form class="box" method="post" action="/external/add">

    <?php if (isset($_smarty_tpl->tpl_vars['coach']->value)){?>
        <?php if (count($_smarty_tpl->tpl_vars['coach']->value)!=0&&count($_smarty_tpl->tpl_vars['user_coaches']->value)==0){?> 
        <p>Det finns en användare med denna e-post:
        <?php echo $_smarty_tpl->tpl_vars['coach']->value->fullname;?>
 <?php echo $_smarty_tpl->tpl_vars['coach']->value->email;?>
</p>
        <p>
        Vill du koppla denna användare som extern tränare?
        </p>
        <p>
            <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['coach']->value->email;?>
" name="coach_email" />
            <input type="hidden" value="save_coach" name="save_coach" />
            <input type="submit" value="Ok" name="confirm" /> 
            <input type="button" onClick="javascript:window.location.href='/student/coaches/<?php echo $_smarty_tpl->tpl_vars['userid']->value;?>
'" value="Avbryt" name="confirm" />
        </p>
        <?php }elseif(count($_smarty_tpl->tpl_vars['user_coaches']->value)>0){?>
        Denna användare är redan kopplad som extern tränare.
        <input type="button" onClick="javascript:window.location.href='/student/coaches/<?php echo $_smarty_tpl->tpl_vars['userid']->value;?>
'" value="Avbryt" name="confirm" />
        <?php }else{ ?>
        Det finns ingen användare med denna e-post.
        <input type="button" onClick="javascript:window.location.href='/student/coaches/<?php echo $_smarty_tpl->tpl_vars['userid']->value;?>
'" value="Avbryt" name="confirm" />
        <?php }?>
    <?php }else{ ?>
        <p>
            Epost: <br />
            <input type="text" name="coach_email" />
        </p>
        <p>
            <input type="submit" value="Spara" name="confirm" />
        </p>
    <?php }?>
    

</form>
<?php }} ?>