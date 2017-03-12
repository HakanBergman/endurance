<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 14:34:37
         compiled from "application/views/pages/student/calendar.php" */ ?>
<?php /*%%SmartyHeaderCode:121421150154d0ce6d7b0a34-23679464%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '532c20aa3ab1f0603ba63cd52593de0ebe47e6a0' => 
    array (
      0 => 'application/views/pages/student/calendar.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121421150154d0ce6d7b0a34-23679464',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'week' => 0,
    'student' => 0,
    'date' => 0,
    'id' => 0,
    'i' => 0,
    'day' => 0,
    'weekdates' => 0,
    'day_workout1' => 0,
    'day_workout2' => 0,
    'day_workout3' => 0,
    'day_workout4' => 0,
    'template_workout_notes' => 0,
    'template_workout_global' => 0,
    'template_workout' => 0,
    'day_workout' => 0,
    'day_result1' => 0,
    'day_workoutnotes1' => 0,
    'day_result2' => 0,
    'day_workoutnotes2' => 0,
    'day_result3' => 0,
    'day_workoutnotes3' => 0,
    'day_result4' => 0,
    'day_workoutnotes4' => 0,
    'day_result' => 0,
    'day_workoutnotes' => 0,
    'ssf_events' => 0,
    'school_events' => 0,
    'user_events' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d0ce6dc298f8_94582877',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d0ce6dc298f8_94582877')) {function content_54d0ce6dc298f8_94582877($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_Domains')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.Domains.php';
if (!is_callable('smarty_modifier_weekday')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.weekday.php';
?>

<div id="eventContent" title="Event Details" style="display: none;">
    <form style="font-size: 9pt;" method="post" action="" id="eventform">
        <!--input type="hidden" id="event_start" name="start" value="" /-->
        <!--input type="hidden" id="event_end" name="end" value="" /-->
        <input type="hidden" id="event_id" name="id" value="" />
        <div style="clear: both;" class="result">
            <p class="s4">Titel <br>
                <input type="text" value="" name="title" id="event_title">
            </p>

            <p class="s4">
                Beskrivning:<br>
                <textarea name="description" id="event_description" type="text"></textarea>
            </p>

            <p class="s4">Mer info:<br>
                <input type="text" value="" name="moreinfo" id="event_url">
            </p>

            <p class="s4">Startdatum:<br>
                <input maxlength="10" type="text" class="datepicker" value="" name="start" id="event_start">
            </p>
            
            <p class="s4">Slutdatum:<br>
                <input maxlength="10" type="text" class="datepicker" value="" name="end" id="event_end">
            </p>

            <label><input type="checkbox" value="1" name="allDay" id="event_allday">Heldag</label>
        </div>
        <div id="event_buttons" style="overflow: auto; padding-top: 4px; clear: both; text-align: center; padding: 12px 0px;">     
        </div>
    </form>
</div>

<div id="wrapper">
  <div id="mainContent">
    <!--Content for your main div - like a blog post-->
    <div class="calendar-main week<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
 performance" >

        <div class="box-strapper week<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
 planning">
            <div class="box blue">

            <h1>Planering: <?php echo $_smarty_tpl->tpl_vars['student']->value->fullname;?>
, <?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
</h1>



                <div class="tabs" style="float: left;">
                    <div style="float: left;">
                        <div style="float: left;">
                            <?php if ($_smarty_tpl->tpl_vars['week']->value!=5){?>
                                <a href="/overview/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period-1;?>
/0"><img src="/assets/images/left.png" /></a>
                            <?php }else{ ?>
                                <a href="/overview/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period-1;?>
/5"><img src="/assets/images/left.png" /></a>
                            <?php }?>
                        </div>
                        <div style="float: left; padding: 4px;">
                            Period <?php echo $_smarty_tpl->tpl_vars['date']->value->period+1;?>

                        </div>
                        <div style="float: left;">
                            <?php if ($_smarty_tpl->tpl_vars['week']->value!=5){?>
                                <a href="/overview/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period+1;?>
/0"><img src="/assets/images/right.png" /></a>
                            <?php }else{ ?>
                                <a href="/overview/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period+1;?>
/5"><img src="/assets/images/right.png" /></a>
                            <?php }?>
                        </div>
                    </div>


                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 3+1 - (0) : 0-(3)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                    <a href="/overview/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['i']->value==$_smarty_tpl->tpl_vars['week']->value){?> class="active"<?php }?>>V. <?php echo $_smarty_tpl->tpl_vars['date']->value->gregorianWeek($_smarty_tpl->tpl_vars['i']->value);?>
</a>
                    <?php }} ?>
                    <a href="/overview/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/5"<?php if (5==$_smarty_tpl->tpl_vars['week']->value){?> class="active"<?php }?>>Översikt</a>
                    <a href="/overview/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['date']->value->isNow()&&5!=$_smarty_tpl->tpl_vars['week']->value){?> class="active"<?php }?> style="margin-left: 32px;">Idag</a>
                </div>


        </div>

             <?php if (5==$_smarty_tpl->tpl_vars['week']->value){?>
                <div class="box wide scheduler-plan scheduler-week-<?php echo $_smarty_tpl->tpl_vars['date']->value->gregorianWeek(0);?>
" id="scheduler-plan1"></div>
                <div class="box wide scheduler-plan scheduler-week-<?php echo $_smarty_tpl->tpl_vars['date']->value->gregorianWeek(1);?>
" id="scheduler-plan2"></div>
                <div class="box wide scheduler-plan scheduler-week-<?php echo $_smarty_tpl->tpl_vars['date']->value->gregorianWeek(2);?>
" id="scheduler-plan3"></div>
                <div class="box wide scheduler-plan scheduler-week-<?php echo $_smarty_tpl->tpl_vars['date']->value->gregorianWeek(3);?>
" id="scheduler-plan4"></div>
            <?php }else{ ?>
                <div class="box wide" id="scheduler-plan"></div>
            <?php }?>
        </div>
        <div class="box-strapper week<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
 result">
            <div class="box blue">
                <h1>Genomfört: <?php echo $_smarty_tpl->tpl_vars['student']->value->fullname;?>
 <a href="/student/chat/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" style="text-decoration: none; float: right; color: #c0c0c0; font-size: 12px;"><img src="/assets/images/discussion.png" style="vertical-align: -10px;" /> Chat</a></h1>

            </div>

            <?php if ($_smarty_tpl->tpl_vars['week']->value!=5){?>
                <div class="box wide" id="scheduler-result"></div>
            <?php }else{ ?>
                <div class="box wide scheduler-result" id="scheduler-result1"></div>
                <div class="box wide scheduler-result" id="scheduler-result2"></div>
                <div class="box wide scheduler-result" id="scheduler-result3"></div>
                <div class="box wide scheduler-result" id="scheduler-result4"></div>
                <div class="box wide scheduler-result" id="scheduler-result5" style="display: none;"></div>
            <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['week']->value!=5){?>
            <div class="box wide"><?php echo $_smarty_tpl->getSubTemplate ("snippets/day.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('day'=>$_smarty_tpl->tpl_vars['day']->value), 0);?>
</div>
        <?php }?>
        </div>
        <div style="clear: both;"></div>
    </div>
    
  </div>
  <div id="sideBar">
    <!--Some content in your right column/sidebar-->
    <div id="fixeddiv">
        <div style="width: 160px;">
            <div class="week<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
 calendar-meta">
                <div class="box blue" style="position: relative;">
                    <h1> Pass </h1>
                    <span style="position: absolute; bottom: 8px; right: 12px;" onclick="if ($('#workouts').is(':hidden')) {
                                $('#workouts').slideDown();
                                $(this).text('Dölj');
                            } else {
                                $('#workouts').slideUp();
                                $(this).text('Visa');
                            }">
                        Visa
                    </span>
                </div>
                <div class="box" id="workouts" style="display: none; height: 150px; overflow: auto;"></div>

                <div class="box blue">
                    <h1>Statistik</h1>
                    <div class="tabs stats">
                        <a href="/student/calendar/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/stats/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
">Å</a>
                        <a href="/student/calendar/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/stats/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
">P</a>
                        <a href="/student/calendar/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/stats/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
">V</a>
                    </div>
                </div>
                <div class="box stats" style="background: white; overflow: scroll; max-height: 500px;">

                </div>

            </div>
        </div>
    </div>
  </div>
  <div class="clear"></div>
</div>

<script type="text/javascript">

    $(function() {
        

    var s = $("#fixeddiv");
    var pos = s.position();                   
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
        /*s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);*/
        if (windowpos >= pos.top) {
            s.addClass("stick");
        } else {
            s.removeClass("stick");
        }
    });



        <?php if ($_smarty_tpl->tpl_vars['week']->value==5){?>

           $('#scheduler-plan1').scheduler({
                    posturl: '/calendar/day_workout/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                    segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                    weekdays: [
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[0];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[1];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[2];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[3];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[4];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[5];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[6];?>
'
                    ],
                    week: 0,
                    trash: '#trash',
                    overview: true
                });
             
 
                var day_workout = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_workout1']->value;?>
');
                $.each(day_workout, function(key, value) {
                    $('#scheduler-plan1').scheduler('add', value);
                }); 
               
                $('#scheduler-plan2').scheduler({
                    posturl: '/calendar/day_workout/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                    segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                    weekdays: [
                        '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[7];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[8];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[9];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[10];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[11];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[12];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[13];?>
'
                    ],
                    week: 1,
                    trash: '#trash',
                   overview: true
                });

                var day_workout = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_workout2']->value;?>
');
                $.each(day_workout, function(key, value) {
                    $('#scheduler-plan2').scheduler('add', value);
                });
  
                $('#scheduler-plan3').scheduler({
                    posturl: '/calendar/day_workout/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                    segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                    weekdays: [
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[14];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[15];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[16];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[17];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[18];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[19];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[20];?>
'
                    ],
                    week: 2,
                    trash: '#trash',
                    overview: true
                });

                var day_workout = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_workout3']->value;?>
');
                $.each(day_workout, function(key, value) {
                    $('#scheduler-plan3').scheduler('add', value);
                });

                $('#scheduler-plan4').scheduler({
                    posturl: '/calendar/day_workout/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                    segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                    weekdays: [
                        '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[21];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[22];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[23];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[24];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[25];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[26];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[27];?>
'
                    ],
                    week: 3,
                    trash: '#trash',
                    overview: true
                });

                var day_workout = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_workout4']->value;?>
');
                //console.log(day_workout);
                $.each(day_workout, function(key, value) {
                    $('#scheduler-plan4').scheduler('add', value);
                });

                $('#scheduler-plan5').scheduler({
                    posturl: '/calendar/day_workout/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                    segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                    weekdays: [
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[0];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[24];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[25];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[26];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[27];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[5];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[6];?>
'
                    ],
                    week: 5,
                    trash: '#trash',
                    overview: true
                });

                $('#scheduler-plan5').scheduler('update');
                
                var template_workout_notes = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['template_workout_notes']->value;?>
');
                $.each(template_workout_notes, function(key, value) {        
                    $('#scheduler-plan1').scheduler('add', value);
                });

                var template_workout_global = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['template_workout_global']->value;?>
');
                $.each(template_workout_global, function(key, value) {        
                    $('#scheduler-plan1').scheduler('add', value);
                });
                

                var template_workout = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['template_workout']->value;?>
');
                if (template_workout !== false) {
                    $('#workouts').append('<hr />');
                    $.each(template_workout, function(key, value) {
                        $('#scheduler-plan1').scheduler('add', value);
                    });
                }
 
        <?php }else{ ?>
        

            $('#scheduler-plan').scheduler({
                posturl: '/calendar/day_workout/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                        segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                        weekdays: [
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[0];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[1];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[2];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[3];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[4];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[5];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[6];?>
'
                        ],
                        week: <?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
,
                        trash: '#trash',
                        overview: false
                });

                var day_workout = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_workout']->value;?>
');
                $.each(day_workout, function(key, value) {
                    $('#scheduler-plan').scheduler('add', value);
                });

                $('#scheduler-plan').scheduler('update');
                
                var template_workout_notes = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['template_workout_notes']->value;?>
');
                $.each(template_workout_notes, function(key, value) {        
                    $('#scheduler-plan').scheduler('add', value);
                });

                var template_workout_global = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['template_workout_global']->value;?>
');
                $.each(template_workout_global, function(key, value) {        
                    $('#scheduler-plan').scheduler('add', value);
                });

                var template_workout = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['template_workout']->value;?>
');
                if (template_workout !== false) {
                    $('#workouts').append('<hr />');
                    $.each(template_workout, function(key, value) {
                        $('#scheduler-plan').scheduler('add', value);
                    });
                }

        <?php }?>

        /**** STATS ****/
        <?php if ($_smarty_tpl->tpl_vars['week']->value==5){?>
            $('.tabs.stats a').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
                $('.box.stats').html('<p style="text-align: center;"><img src="/assets/images/load-medium.gif" /></p>').load($(this).attr('href'));
            }).first().next().click();
        <?php }else{ ?>
            $('.tabs.stats a').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
                $('.box.stats').html('<p style="text-align: center;"><img src="/assets/images/load-medium.gif" /></p>').load($(this).attr('href'));
            }).last().click();
        <?php }?>


        /**** RESULTS ****/
        <?php if ($_smarty_tpl->tpl_vars['week']->value==5){?>

            $('#scheduler-result1').scheduler({
                posturl: '/calendar/day_result/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                weekdays: [
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[0];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[1];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[2];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[3];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[4];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[5];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[6];?>
'
                        ],
                week: 0,
                summary: '#duration_result',
                overview: true
            });

            var day_result = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_result1']->value;?>
');
            $.each(day_result, function(key, value) { 
                $('#scheduler-result1').scheduler('add', value);
            });
            
            var day_workoutnotes = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_workoutnotes1']->value;?>
');
                $.each(day_workoutnotes, function(key, value) {
                    $('#scheduler-result1').scheduler('add', value);
                });

            $('#scheduler-result2').scheduler({
                posturl: '/calendar/day_result/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                weekdays: [
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[7];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[8];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[9];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[10];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[11];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[12];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[13];?>
'
                        ],
                week: 1,
                summary: '#duration_result',
                overview: true
            });

            var day_result = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_result2']->value;?>
');
            
            $.each(day_result, function(key, value) { 
                $('#scheduler-result2').scheduler('add', value);
            });
            
            
            
            var day_workoutnotes = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_workoutnotes2']->value;?>
');
                $.each(day_workoutnotes, function(key, value) {
                    $('#scheduler-result2').scheduler('add', value);
                });

            $('#scheduler-result3').scheduler({
                posturl: '/calendar/day_result/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                weekdays: [
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[14];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[15];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[16];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[17];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[18];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[19];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[20];?>
'
                        ],
                week: 2,
                summary: '#duration_result',
                overview: true
            });

            var day_result = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_result3']->value;?>
');
            $.each(day_result, function(key, value) { 
                $('#scheduler-result3').scheduler('add', value);
            });
            
            var day_workoutnotes = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_workoutnotes3']->value;?>
');
                $.each(day_workoutnotes, function(key, value) {
                    $('#scheduler-result3').scheduler('add', value);
                });

            $('#scheduler-result4').scheduler({
                posturl: '/calendar/day_result/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                weekdays: [
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[21];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[22];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[23];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[24];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[25];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[26];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[27];?>
'
                        ],
                week: 3,
                summary: '#duration_result',
                overview: true
            });

            var day_result = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_result4']->value;?>
');
            $.each(day_result, function(key, value) { 
                $('#scheduler-result4').scheduler('add', value);
            });
            
            var day_workoutnotes = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_workoutnotes4']->value;?>
');
                $.each(day_workoutnotes, function(key, value) {
                    $('#scheduler-result4').scheduler('add', value);
                });

            $('#scheduler-result5').scheduler({
                posturl: '/calendar/day_result/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                weekdays: [
                            '<?php echo smarty_modifier_weekday(1);?>
 <?php echo $_smarty_tpl->tpl_vars['weekdates']->value[27];?>
'
                        ],
                week: 5,
                summary: '#duration_result'
            });

            $('#scheduler-result5').scheduler('update');

        <?php }else{ ?> 

            $('#scheduler-result').scheduler({
                posturl: '/calendar/day_result/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
',
                segments: <?php echo json_encode(smarty_modifier_Domains('segments'));?>
,
                weekdays: [
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[0];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[1];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[2];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[3];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[4];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[5];?>
',
                            '<?php echo $_smarty_tpl->tpl_vars['weekdates']->value[6];?>
'
                        ],
                week: <?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
,
                summary: '#duration_result',
                overview: false
            });

            var day_result = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_result']->value;?>
');
            $.each(day_result, function(key, value) { 
                $('#scheduler-result').scheduler('add', value);
            });
            
            var day_workoutnotes = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['day_workoutnotes']->value;?>
');
                $.each(day_workoutnotes, function(key, value) {
                    $('#scheduler-result').scheduler('add', value);
                });

            $('#scheduler-result').scheduler('update');

        <?php }?>

        var ssf_events = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['ssf_events']->value;?>
');
        addEvents(ssf_events, 'ssf_events', '#378006');
        var school_events = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['school_events']->value;?>
');
        addEvents(school_events, 'school_events', '#084B8A');
        var user_events = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['user_events']->value;?>
');
        addEvents(user_events, 'user_events', '#FFBF00');
    });

</script>
<?php }} ?>