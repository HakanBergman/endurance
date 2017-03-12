<?php /* Smarty version Smarty-3.1.13, created on 2015-02-04 09:48:33
         compiled from "application/views/pages/schedule/calendar.php" */ ?>
<?php /*%%SmartyHeaderCode:65361039254d1dce13c33a8-37521388%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b5a4ba02917dc2bca715602660002de0adc416f' => 
    array (
      0 => 'application/views/pages/schedule/calendar.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65361039254d1dce13c33a8-37521388',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'schedule' => 0,
    'id' => 0,
    'w' => 0,
    'week' => 0,
    'groups' => 0,
    'g' => 0,
    'now' => 0,
    'i' => 0,
    'year' => 0,
    'schedule_workout1' => 0,
    'schedule_workout2' => 0,
    'schedule_workout3' => 0,
    'schedule_workout4' => 0,
    'template_workout_global' => 0,
    'template_workout' => 0,
    'schedule_workout' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d1dce1610cf5_99504545',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d1dce1610cf5_99504545')) {function content_54d1dce1610cf5_99504545($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/function.math.php';
if (!is_callable('smarty_modifier_date_format')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_Domains')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.Domains.php';
if (!is_callable('smarty_modifier_weekday')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.weekday.php';
?>
<div style="float: left; width: 960px;" class="planner">

    <div class="box blue" style="margin-left: 86px;">

        <h1>Programmets utformning: <?php echo $_smarty_tpl->tpl_vars['schedule']->value->title;?>
</h1>

        <div class="tabs">
            <?php $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['w']->step = 1;$_smarty_tpl->tpl_vars['w']->total = (int)ceil(($_smarty_tpl->tpl_vars['w']->step > 0 ? 4+1 - (1) : 1-(4)+1)/abs($_smarty_tpl->tpl_vars['w']->step));
if ($_smarty_tpl->tpl_vars['w']->total > 0){
for ($_smarty_tpl->tpl_vars['w']->value = 1, $_smarty_tpl->tpl_vars['w']->iteration = 1;$_smarty_tpl->tpl_vars['w']->iteration <= $_smarty_tpl->tpl_vars['w']->total;$_smarty_tpl->tpl_vars['w']->value += $_smarty_tpl->tpl_vars['w']->step, $_smarty_tpl->tpl_vars['w']->iteration++){
$_smarty_tpl->tpl_vars['w']->first = $_smarty_tpl->tpl_vars['w']->iteration == 1;$_smarty_tpl->tpl_vars['w']->last = $_smarty_tpl->tpl_vars['w']->iteration == $_smarty_tpl->tpl_vars['w']->total;?>
            <a href="/schedule/calendar/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['w']->value-1;?>
"<?php if ($_smarty_tpl->tpl_vars['w']->value-1==$_smarty_tpl->tpl_vars['week']->value){?> class="active"<?php }?>>Vecka <?php echo $_smarty_tpl->tpl_vars['w']->value;?>
</a>
            <?php }} ?>
            <a href="/schedule/calendar/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/5"<?php if (5==$_smarty_tpl->tpl_vars['week']->value){?> class="active"<?php }?>>Översikt</a>
        </div>

    </div>
    <?php if (5==$_smarty_tpl->tpl_vars['week']->value){?>
    <div class="box wide" id="scheduler1"></div>
    <div class="box wide" id="scheduler2"></div>
    <div class="box wide" id="scheduler3"></div>
    <div class="box wide" id="scheduler4"></div>
    <div class="box wide" id="scheduler5"></div>
    <?php }else{ ?>
    <div class="box wide" id="scheduler"></div>
    <?php }?>
</div>
<div style="float: left; width: 160px; margin-left: 12px;">
<div style="position: fixed; width: 160px;">

    <div class="box blue">

        <h1> Pass </h1>

    </div>

    <div class="box" style="height:200px; overflow:auto;">

        <div id="workouts"></div>

    </div>

    <div class="box">

        <h1 style="font-size: 18pt; text-align: center;"> Summering </h1>

        <table style="width: 100%;">
            <tr><td>Nuvarande:</td><td id="duration_week" style="text-align: right;"></td></tr>
            <tr><td>Planerad:</td><td id="duration_planned" style="text-align: right;">n/a</td></tr>
        </table>

        <p>
            Grupp och period för att visa planerad tid:
        </p>
        
        <p>
            <select style="width: 100%;" id="group"><?php  $_smarty_tpl->tpl_vars['g'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['g']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['g']->key => $_smarty_tpl->tpl_vars['g']->value){
$_smarty_tpl->tpl_vars['g']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['g']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['g']->value->title;?>
</option><?php } ?></select> <br />
            
            <select style="width: 100%;" id="period">
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['now']->value->period+13+1 - ($_smarty_tpl->tpl_vars['now']->value->period-3) : $_smarty_tpl->tpl_vars['now']->value->period-3-($_smarty_tpl->tpl_vars['now']->value->period+13)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['now']->value->period-3, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>                    
                    <option value="<?php if ($_smarty_tpl->tpl_vars['i']->value<0){?><?php echo smarty_function_math(array('equation'=>'x - y','x'=>$_smarty_tpl->tpl_vars['now']->value->year,'y'=>1),$_smarty_tpl);?>
-<?php echo smarty_function_math(array('equation'=>'(x + y)','x'=>13,'y'=>$_smarty_tpl->tpl_vars['i']->value),$_smarty_tpl);?>
<?php }elseif($_smarty_tpl->tpl_vars['i']->value>12){?><?php echo smarty_function_math(array('equation'=>'x + y','x'=>$_smarty_tpl->tpl_vars['now']->value->year,'y'=>1),$_smarty_tpl);?>
-<?php echo smarty_function_math(array('equation'=>'(y - x)','x'=>13,'y'=>$_smarty_tpl->tpl_vars['i']->value),$_smarty_tpl);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['now']->value->year;?>
-<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
<?php }?>"
                >
                    
                    
                    <?php if ($_smarty_tpl->tpl_vars['i']->value<0){?>
                        <?php echo $_smarty_tpl->tpl_vars['now']->value->year-1;?>
/<?php echo substr($_smarty_tpl->tpl_vars['now']->value->year,2,3);?>

                        <?php $_smarty_tpl->tpl_vars["year"] = new Smarty_variable($_smarty_tpl->tpl_vars['now']->value->year-1, null, 0);?>
                    <?php }elseif($_smarty_tpl->tpl_vars['i']->value>12){?>
                        <?php echo $_smarty_tpl->tpl_vars['now']->value->year+1;?>
/<?php echo substr(($_smarty_tpl->tpl_vars['now']->value->year+2),2,3);?>

                        <?php $_smarty_tpl->tpl_vars["year"] = new Smarty_variable($_smarty_tpl->tpl_vars['now']->value->year+1, null, 0);?>
                    <?php }else{ ?>
                        <?php echo $_smarty_tpl->tpl_vars['now']->value->year;?>
/<?php echo substr(($_smarty_tpl->tpl_vars['now']->value->year+1),2,3);?>

                        <?php $_smarty_tpl->tpl_vars["year"] = new Smarty_variable($_smarty_tpl->tpl_vars['now']->value->year, null, 0);?>
                    <?php }?> 
                    
                    
                    <?php if ($_smarty_tpl->tpl_vars['i']->value<0){?>
                        P. <?php echo (13+$_smarty_tpl->tpl_vars['i']->value)+1;?>

                    <?php }elseif($_smarty_tpl->tpl_vars['i']->value>12){?>
                        P. <?php echo ($_smarty_tpl->tpl_vars['i']->value-13)+1;?>

                    <?php }else{ ?>
                        P. <?php echo ($_smarty_tpl->tpl_vars['i']->value)+1;?>

                    <?php }?>
                    (v. 
                    
                    <?php echo smarty_modifier_date_format((Period::to_date($_smarty_tpl->tpl_vars['year']->value,$_smarty_tpl->tpl_vars['i']->value,0)),"%V");?>
 - <?php echo smarty_modifier_date_format((Period::to_date($_smarty_tpl->tpl_vars['year']->value,$_smarty_tpl->tpl_vars['i']->value,3)),"%V");?>

                    )
                </option><?php }} ?>
            </select> <br />
            <button style="width: 50%; margin-left: 50%;" id="show">Visa</button>
        </p>



    </div>

</div>
</div>

<script type="text/javascript">
    
    
    $(function () {
        $('#show').click(function () {
            
            values = $('#period').val().split("-");

            $('#duration_planned').html('<img src="/assets/images/load-small.gif" />');
            jQuery.post(
                    '/schedule/summary/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
',
                    { 
                      'group': $('#group').val(), 
                      'period': values[1], 
                      'week': <?php echo $_smarty_tpl->tpl_vars['week']->value;?>
,
                      'year': values[0]
                    },
                    function (data) {
                        $('#duration_planned').text(data);
                    }
            );
        });
    });
    
    
    <?php if ($_smarty_tpl->tpl_vars['week']->value==5){?>
    $(function () {
      
    $('#scheduler1').scheduler({
            posturl: '/calendar/schedule_workout/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
',
            segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
            weekdays: ['<?php echo smarty_modifier_weekday(1);?>
', '<?php echo smarty_modifier_weekday(2);?>
', '<?php echo smarty_modifier_weekday(3);?>
', '<?php echo smarty_modifier_weekday(4);?>
', '<?php echo smarty_modifier_weekday(5);?>
', '<?php echo smarty_modifier_weekday(6);?>
', '<?php echo smarty_modifier_weekday(7);?>
'],
            week: 0,
            trash: '#trash'
        });

        var schedule_workout1 = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['schedule_workout1']->value;?>
');
        $.each( schedule_workout1, function( key, value ) {
            workout = value;
            $('#scheduler1').scheduler('add', workout);
        });
        
        /*-------------------*/

        $('#scheduler2').scheduler({
            posturl: '/calendar/schedule_workout/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
',
            segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
            weekdays: ['<?php echo smarty_modifier_weekday(1);?>
', '<?php echo smarty_modifier_weekday(2);?>
', '<?php echo smarty_modifier_weekday(3);?>
', '<?php echo smarty_modifier_weekday(4);?>
', '<?php echo smarty_modifier_weekday(5);?>
', '<?php echo smarty_modifier_weekday(6);?>
', '<?php echo smarty_modifier_weekday(7);?>
'],
            week: 1,
            trash: '#trash'
        });
        
        var schedule_workout2 = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['schedule_workout2']->value;?>
');
        $.each( schedule_workout2, function( key, value ) {
            workout = value;
            $('#scheduler2').scheduler('add', workout);
        });
        
        /*-------------------*/
        
        $('#scheduler3').scheduler({
            posturl: '/calendar/schedule_workout/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
',
            segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
            weekdays: ['<?php echo smarty_modifier_weekday(1);?>
', '<?php echo smarty_modifier_weekday(2);?>
', '<?php echo smarty_modifier_weekday(3);?>
', '<?php echo smarty_modifier_weekday(4);?>
', '<?php echo smarty_modifier_weekday(5);?>
', '<?php echo smarty_modifier_weekday(6);?>
', '<?php echo smarty_modifier_weekday(7);?>
'],
            week: 2,
            trash: '#trash'
        });
        
        var schedule_workout3 = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['schedule_workout3']->value;?>
');
        $.each( schedule_workout3, function( key, value ) {
            workout = value;
            $('#scheduler3').scheduler('add', workout);
        });
        
        /*-------------------*/
        
        $('#scheduler4').scheduler({
            posturl: '/calendar/schedule_workout/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
',
            segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
            weekdays: ['<?php echo smarty_modifier_weekday(1);?>
', '<?php echo smarty_modifier_weekday(2);?>
', '<?php echo smarty_modifier_weekday(3);?>
', '<?php echo smarty_modifier_weekday(4);?>
', '<?php echo smarty_modifier_weekday(5);?>
', '<?php echo smarty_modifier_weekday(6);?>
', '<?php echo smarty_modifier_weekday(7);?>
'],
            week: 3,
            trash: '#trash'
        });
        
        var schedule_workout4 = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['schedule_workout4']->value;?>
');
        $.each( schedule_workout4, function( key, value ) {
            workout = value;
            $('#scheduler4').scheduler('add', workout);
        });
        
        /*-------------------*/
        
        var template_workout_global = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['template_workout_global']->value;?>
'); 
        $.each( template_workout_global, function( key, value ) {
            workout = value;
            $('#scheduler1').scheduler('add', workout);
        });
        
        $('#workouts').append('<hr />');
        
        /*-------------------*/
        
        var template_workout = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['template_workout']->value;?>
');
        $.each( template_workout, function( key, value ) {
            workout = value;
            $('#scheduler1').scheduler('add', workout);
        });
        
        /*-------------------*/
        
        $('#scheduler5').scheduler('update');
        
        /*-------------------*/
    }); 
    <?php }else{ ?> 
        $(function () {
            
            
            $('#scheduler').scheduler({
            posturl: '/calendar/schedule_workout/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
',
                    segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                    weekdays: ['<?php echo smarty_modifier_weekday(1);?>
', '<?php echo smarty_modifier_weekday(2);?>
', '<?php echo smarty_modifier_weekday(3);?>
', '<?php echo smarty_modifier_weekday(4);?>
', '<?php echo smarty_modifier_weekday(5);?>
', '<?php echo smarty_modifier_weekday(6);?>
', '<?php echo smarty_modifier_weekday(7);?>
'],
                    week: <?php echo $_smarty_tpl->tpl_vars['week']->value;?>
,
                    trash: '#trash'
            });
            
            var schedule_workout = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['schedule_workout']->value;?>
');
            $.each( schedule_workout, function( key, value ) {
                workout = value;
                $('#scheduler').scheduler('add', workout);
            });

            var template_workout_global = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['template_workout_global']->value;?>
'); 
            $.each( template_workout_global, function( key, value ) {
                workout = value;
                $('#scheduler').scheduler('add', workout);
            });
            
            $('#workouts').append('<hr />');
            
            var template_workout = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['template_workout']->value;?>
');
            $.each( template_workout, function( key, value ) {
                workout = value;
                $('#scheduler').scheduler('add', workout);
            });            
            
            $('#scheduler').scheduler('update');
        });    

    <?php }?>
        
</script><?php }} ?>