<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 15:00:14
         compiled from "application/views/pages/student/mobile_calendar.php" */ ?>
<?php /*%%SmartyHeaderCode:75804444254d0d46e6ce855-53663604%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68e037ffbb48a59b114459a8f81b48f2130e91b2' => 
    array (
      0 => 'application/views/pages/student/mobile_calendar.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '75804444254d0d46e6ce855-53663604',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'student' => 0,
    'date' => 0,
    'id' => 0,
    'prevday' => 0,
    'activeday' => 0,
    'nextday' => 0,
    'day_workout' => 0,
    'workout' => 0,
    'day_result' => 0,
    'button' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d0d46e96f840_15285746',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d0d46e96f840_15285746')) {function content_54d0d46e96f840_15285746($_smarty_tpl) {?><div class="calendar-main performance mobile">
    <br />

    <form action="/student/ajax_changedate/<?php echo $_smarty_tpl->tpl_vars['student']->value->id;?>
/" type="post">
        Välj datum:<br />
        <input type="date" name="pickdate" id="pickdate">
        <input type="submit" class="button accept" value="OK!">
    </form>

    <div class="box-strapper planning">
        <div class="box blue">

            <h1>Planering: <?php echo $_smarty_tpl->tpl_vars['student']->value->fullname;?>
, <?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
</h1>   
            <div>

                <div class="tabs" style="float: left;">
                    <div style="float: left;">
                        <div style="float: left;">
                            <?php $_smarty_tpl->tpl_vars['prevday'] = new Smarty_variable($_smarty_tpl->tpl_vars['date']->value->day-1, null, 0);?>
                            <a href="/mobile/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['prevday']->value;?>
"><img src="/assets/images/left.png" /></a>
                        </div>
                        <div style="float: left; padding: 4px;">
                            <?php echo $_smarty_tpl->tpl_vars['activeday']->value;?>

                        </div>
                        <div style="float: left;">
                            <?php $_smarty_tpl->tpl_vars['nextday'] = new Smarty_variable($_smarty_tpl->tpl_vars['date']->value->day+1, null, 0);?>
                            <a href="/mobile/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['nextday']->value;?>
"><img src="/assets/images/right.png" /></a>
                        </div>
                    </div>

                    <a href="/mobile/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['date']->value->isNow()){?> class="active"<?php }?>>Idag</a>

                </div>
            </div>

        </div>

        <div class="box wide" id="scheduler-plan">
            <table class="scheduler">
                <col span="1" class="segment">
                <tbody>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>


                    <tr class="week">
                        <td>Mo.</td>
                        <td valign="bottom" class="day ui-droppable">


                            <?php  $_smarty_tpl->tpl_vars['workout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['workout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['day_workout']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['workout']->key => $_smarty_tpl->tpl_vars['workout']->value){
$_smarty_tpl->tpl_vars['workout']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['workout']->value->segment==0){?>
                            <div id="#<?php echo $_smarty_tpl->tpl_vars['workout']->value->id;?>
" class="day_workout workout" style="border-right-color: <?php echo $_smarty_tpl->tpl_vars['workout']->value->__color__;?>
;" id="day_result_271993">
                                <span style="float: left;"><?php echo $_smarty_tpl->tpl_vars['workout']->value->__string__;?>
</span>
                                <span style="float: right; color: #666;"><?php if ($_smarty_tpl->tpl_vars['workout']->value->__duration__>0){?><?php echo gmdate("H:i",$_smarty_tpl->tpl_vars['workout']->value->__duration__);?>
<?php }?></span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            <?php }?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr class="week">
                        <td>Fm.</td>
                        <td valign="bottom" class="day ui-droppable">
                            <?php  $_smarty_tpl->tpl_vars['workout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['workout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['day_workout']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['workout']->key => $_smarty_tpl->tpl_vars['workout']->value){
$_smarty_tpl->tpl_vars['workout']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['workout']->value->segment==1){?>
                            <div id="#<?php echo $_smarty_tpl->tpl_vars['workout']->value->id;?>
" class="day_workout workout" style="border-right-color: <?php echo $_smarty_tpl->tpl_vars['workout']->value->__color__;?>
;" id="day_result_271993">
                                <span style="float: left;"><?php echo $_smarty_tpl->tpl_vars['workout']->value->__string__;?>
</span>
                                <span style="float: right; color: #666;"><?php echo gmdate("H:i",$_smarty_tpl->tpl_vars['workout']->value->__duration__);?>
</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            <?php }?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr><tr class="week">
                        <td>Em.</td>
                        <td valign="bottom" class="day ui-droppable">
                            <?php  $_smarty_tpl->tpl_vars['workout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['workout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['day_workout']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['workout']->key => $_smarty_tpl->tpl_vars['workout']->value){
$_smarty_tpl->tpl_vars['workout']->_loop = true;
?>    
                            <?php if ($_smarty_tpl->tpl_vars['workout']->value->segment==2){?>
                            <div id="#<?php echo $_smarty_tpl->tpl_vars['workout']->value->id;?>
" class="day_workout workout" style="border-right-color: <?php echo $_smarty_tpl->tpl_vars['workout']->value->__color__;?>
;" id="day_result_271993">
                                <span style="float: left;"><?php echo $_smarty_tpl->tpl_vars['workout']->value->__string__;?>
</span>
                                <span style="float: right; color: #666;"><?php echo gmdate("H:i",$_smarty_tpl->tpl_vars['workout']->value->__duration__);?>
</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            <?php }?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr class="week"><td>Kv.</td>
                        <td valign="bottom" class="day ui-droppable">
                            <?php  $_smarty_tpl->tpl_vars['workout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['workout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['day_workout']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['workout']->key => $_smarty_tpl->tpl_vars['workout']->value){
$_smarty_tpl->tpl_vars['workout']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['workout']->value->segment==3){?>
                            <div id="#<?php echo $_smarty_tpl->tpl_vars['workout']->value->id;?>
" class="day_workout workout" style="border-right-color: <?php echo $_smarty_tpl->tpl_vars['workout']->value->__color__;?>
;" id="day_result_271993">
                                <span style="float: left;"><?php echo $_smarty_tpl->tpl_vars['workout']->value->__string__;?>
</span>
                                <span style="float: right; color: #666;"><?php echo gmdate("H:i",$_smarty_tpl->tpl_vars['workout']->value->__duration__);?>
</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            <?php }?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="summary">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="box-strapper planning">
        <div class="box blue">

            <h1>Genomfört: <?php echo $_smarty_tpl->tpl_vars['student']->value->fullname;?>
, <?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
</h1>

            <div>

                <div class="tabs" style="float: left;">
                    <div style="float: left;">
                        <div style="float: left;">
                            <?php $_smarty_tpl->tpl_vars['prevday'] = new Smarty_variable($_smarty_tpl->tpl_vars['date']->value->day-1, null, 0);?>
                            <a href="/mobile/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['prevday']->value;?>
"><img src="/assets/images/left.png" /></a>
                        </div>
                        <div style="float: left; padding: 4px;">
                            <?php echo $_smarty_tpl->tpl_vars['activeday']->value;?>

                        </div>
                        <div style="float: left;">
                            <?php $_smarty_tpl->tpl_vars['nextday'] = new Smarty_variable($_smarty_tpl->tpl_vars['date']->value->day+1, null, 0);?>
                            <a href="/mobile/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['nextday']->value;?>
"><img src="/assets/images/right.png" /></a>
                        </div>
                    </div>

                    <a href="/mobile/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['date']->value->isNow()){?> class="active"<?php }?>>Idag</a>

                </div>

            </div>

        </div>

        <div class="box wide" id="scheduler-plan">
            <table class="scheduler">
                <col span="1" class="segment">
                <tbody>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>


                    <tr class="week">
                        <td>Mo.</td>
                        <td valign="bottom" data-segment="0" class="day ui-droppable">
                            <?php $_smarty_tpl->tpl_vars["button"] = new Smarty_variable("yes", null, 0);?>
                            <?php  $_smarty_tpl->tpl_vars['workout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['workout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['day_result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['workout']->key => $_smarty_tpl->tpl_vars['workout']->value){
$_smarty_tpl->tpl_vars['workout']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['workout']->value->segment==0){?>
                            <div id="#<?php echo $_smarty_tpl->tpl_vars['workout']->value->id;?>
" class="day_result workout" style="border-right-color: rgb(255, 255, 0);" id="day_result_271993">
                                <span style="float: left;"><?php echo $_smarty_tpl->tpl_vars['workout']->value->__string__;?>
</span>
                                <span style="float: right; color: #666;"><?php echo gmdate("H:i",$_smarty_tpl->tpl_vars['workout']->value->__duration__);?>
</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            <?php $_smarty_tpl->tpl_vars["button"] = new Smarty_variable("no", null, 0);?>
                            <?php }?>
                            <?php } ?>
                            <?php if ($_smarty_tpl->tpl_vars['button']->value=="yes"){?>
                            <a class="activity" href="#">Registrera aktivitet</a>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr class="week">
                        <td>Fm.</td>
                        <td valign="bottom" data-segment="1" class="day ui-droppable">
                            <?php $_smarty_tpl->tpl_vars["button"] = new Smarty_variable("yes", null, 0);?>
                            <?php  $_smarty_tpl->tpl_vars['workout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['workout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['day_result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['workout']->key => $_smarty_tpl->tpl_vars['workout']->value){
$_smarty_tpl->tpl_vars['workout']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['workout']->value->segment==1){?>
                            <div id="#<?php echo $_smarty_tpl->tpl_vars['workout']->value->id;?>
" class="day_result workout" style="border-right-color: rgb(255, 255, 0);" id="day_result_271993">
                                <span style="float: left;"><?php echo $_smarty_tpl->tpl_vars['workout']->value->__string__;?>
</span>
                                <span style="float: right; color: #666;"><?php echo gmdate("H:i",$_smarty_tpl->tpl_vars['workout']->value->__duration__);?>
</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            <?php $_smarty_tpl->tpl_vars["button"] = new Smarty_variable("no", null, 0);?>
                            <?php }?>
                            <?php } ?>
                            <?php if ($_smarty_tpl->tpl_vars['button']->value=="yes"){?>
                            <a class="activity" href="#">Registrera aktivitet</a>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr><tr class="week">
                        <td>Em.</td>
                        <td valign="bottom" data-segment="1" class="day ui-droppable">
                            <?php $_smarty_tpl->tpl_vars["button"] = new Smarty_variable("yes", null, 0);?>
                            <?php  $_smarty_tpl->tpl_vars['workout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['workout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['day_result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['workout']->key => $_smarty_tpl->tpl_vars['workout']->value){
$_smarty_tpl->tpl_vars['workout']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['workout']->value->segment==2){?>
                            <div id="#<?php echo $_smarty_tpl->tpl_vars['workout']->value->id;?>
" class="day_result workout" style="border-right-color: rgb(255, 255, 0);" id="day_result_271993">
                                <span style="float: left;"><?php echo $_smarty_tpl->tpl_vars['workout']->value->__string__;?>
</span>
                                <span style="float: right; color: #666;"><?php echo gmdate("H:i",$_smarty_tpl->tpl_vars['workout']->value->__duration__);?>
</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            <?php $_smarty_tpl->tpl_vars["button"] = new Smarty_variable("no", null, 0);?>
                            <?php }?>
                            <?php } ?>
                            <?php if ($_smarty_tpl->tpl_vars['button']->value=="yes"){?>
                            <a class="activity" href="#">Registrera aktivitet</a>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr class="week"><td>Kv.</td>
                        <td valign="bottom" data-segment="3" class="day ui-droppable">
                            <?php $_smarty_tpl->tpl_vars["button"] = new Smarty_variable("yes", null, 0);?>
                            <?php  $_smarty_tpl->tpl_vars['workout'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['workout']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['day_result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['workout']->key => $_smarty_tpl->tpl_vars['workout']->value){
$_smarty_tpl->tpl_vars['workout']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['workout']->value->segment==3){?>
                            <div id="#<?php echo $_smarty_tpl->tpl_vars['workout']->value->id;?>
" class="day_result workout" style="border-right-color: rgb(255, 255, 0);" id="day_result_271993">
                                <span style="float: left;"><?php echo $_smarty_tpl->tpl_vars['workout']->value->__string__;?>
</span>
                                <span style="float: right; color: #666;"><?php echo gmdate("H:i",$_smarty_tpl->tpl_vars['workout']->value->__duration__);?>
</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            <?php $_smarty_tpl->tpl_vars["button"] = new Smarty_variable("no", null, 0);?>
                            <?php }?>
                            <?php } ?>
                            <?php if ($_smarty_tpl->tpl_vars['button']->value=="yes"){?>
                            <a class="activity" href="#">Registrera aktivitet</a>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="summary"></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>



</form>
</div>

<script type="text/javascript">
    

    
    
    $(function () {


        $('a.activity').each(function () {
            var $parent = $(this).parent();
            $(this).popup({
                id: 'add',
                type: 'day_result',
                extra: '0/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->day;?>
/' + $parent.data('segment'),
                title: "Registrera ny träning",
                success: function (data) {
                    if (!data) {
                        return;
                    }
                    /* FIXME */
                    window.location.reload();
                }
            });
        });

        var day_workout = $.parseJSON('<?php echo json_encode($_smarty_tpl->tpl_vars['day_workout']->value);?>
');
        var day_result = $.parseJSON('<?php echo json_encode($_smarty_tpl->tpl_vars['day_result']->value);?>
');

        $('div.day_workout').each(function (key, value) {
            id = $(this).attr("id").substr(1);

            if (typeof day_workout[key] != 'undefined') {
                var $parent = $(this).parent();
                $(this).popup({
                    id: day_workout[key].id,
                    type: day_workout[key].__class__,
                    title: day_workout[key].__string__,
                    extra: day_workout[key].__userid__,
                    success: function (data) {
                        if (!data) {
                            return;
                        }
                        /* FIXME */
                        window.location.reload();
                    }
                });
            }
        });

        $('div.day_result').each(function (key, value) {
            id = $(this).attr("id").substr(1);

            if (typeof day_result[key] != 'undefined') {
                var $parent = $(this).parent();
                $(this).popup({
                    id: day_result[key].id,
                    type: day_result[key].__class__,
                    title: day_result[key].__string__,
                    extra: day_result[key].__userid__,
                    success: function (data) {
                        if (!data) {
                            return;
                        }
                        /* FIXME */
                        window.location.reload();
                    }
                });
            }
        });
    });

</script>
<?php }} ?>