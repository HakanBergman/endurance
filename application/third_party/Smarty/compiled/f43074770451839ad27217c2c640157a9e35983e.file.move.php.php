<?php /* Smarty version Smarty-3.1.13, created on 2015-02-04 13:56:31
         compiled from "application/views/pages/student/move.php" */ ?>
<?php /*%%SmartyHeaderCode:24698260754d216ff438892-74944096%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f43074770451839ad27217c2c640157a9e35983e' => 
    array (
      0 => 'application/views/pages/student/move.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24698260754d216ff438892-74944096',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'schools' => 0,
    'school' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d216ff4786b6_72228608',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d216ff4786b6_72228608')) {function content_54d216ff4786b6_72228608($_smarty_tpl) {?>
<div class="box blue">

    <h1> Flytta </h1>

</div>

<form class="box" method="post" action="/student/move">

    <p>Använd detta förmulär för att initiera en flytt till ny anläggning/grupp.<br /> 
        Ett e-postmeddelande kommer att gå till ansvarig som ser till att flytten blir utförd.<br />
        Observera att flytten inte sker direkt utan sköts manuellt.</p>

    <p>
        Flytta till: <br />
        <select name="schoolselect" id="schoolselect" onchange="getGroups()">
            <?php  $_smarty_tpl->tpl_vars['school'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['school']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['schools']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['school']->key => $_smarty_tpl->tpl_vars['school']->value){
$_smarty_tpl->tpl_vars['school']->_loop = true;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['school']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['school']->value->title;?>
</option>
            <?php } ?>
        </select>
    </p>
    
    <p>
        Eventuell ytterligare information om din flytt:<br />
         <textarea rows="4" cols="50" id="movemessage" name="movemessage"></textarea> 
    </p>

    <p>
        <input type="submit" value="Ok" onclick="return confirm('Är du säker?');" />
    </p>

</form>

<script>

            function getGroups() {
                school_id = document.getElementById("schoolselect").value;

                $.ajax({
                    type: 'POST',
                    url: '/student/ajax_groups/' + school_id,
                    data: {},
                    dataType: 'json',
                    success: function(data) {

                        $("#groupselect").find('option').remove();
                        $.each(data, function(dataKey, dataVal) {
                            console.log(dataVal.title);
                            $("#groupselect").append("<option value='" + dataVal.id + "'>" + dataVal.title + "</option>");
                        });

                        $('input[type="submit"]').removeAttr('disabled');

                    }
                });
            }
</script><?php }} ?>