

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
    <div class="calendar-main week{$week} performance" >

        <div class="box-strapper week{$week} planning">
            <div class="box blue">

            <h1>Planering: {$student->fullname}, {$date->year}</h1>



                <div class="tabs" style="float: left;">
                    <div style="float: left;">
                        <div style="float: left;">
                            {if $week != 5}
                                <a href="/overview/{$id}/{$date->year}/{$date->period-1}/0"><img src="/assets/images/left.png" /></a>
                            {else}
                                <a href="/overview/{$id}/{$date->year}/{$date->period-1}/5"><img src="/assets/images/left.png" /></a>
                            {/if}
                        </div>
                        <div style="float: left; padding: 4px;">
                            Period {$date->period+1}
                        </div>
                        <div style="float: left;">
                            {if $week != 5}
                                <a href="/overview/{$id}/{$date->year}/{$date->period+1}/0"><img src="/assets/images/right.png" /></a>
                            {else}
                                <a href="/overview/{$id}/{$date->year}/{$date->period+1}/5"><img src="/assets/images/right.png" /></a>
                            {/if}
                        </div>
                    </div>


                    {for $i=0 to 3}
                    <a href="/overview/{$id}/{$date->year}/{$date->period}/{$i}"{if $i == $week} class="active"{/if}>V. {$date->gregorianWeek($i)}</a>
                    {/for}
                    <a href="/overview/{$id}/{$date->year}/{$date->period}/5"{if 5 == $week} class="active"{/if}>Översikt</a>
                    <a href="/overview/{$id}"{if $date->isNow() and 5 != $week} class="active"{/if} style="margin-left: 32px;">Idag</a>
                </div>


        </div>

             {if 5 == $week}
                <div class="box wide scheduler-plan scheduler-week-{$date->gregorianWeek(0)}" id="scheduler-plan1"></div>
                <div class="box wide scheduler-plan scheduler-week-{$date->gregorianWeek(1)}" id="scheduler-plan2"></div>
                <div class="box wide scheduler-plan scheduler-week-{$date->gregorianWeek(2)}" id="scheduler-plan3"></div>
                <div class="box wide scheduler-plan scheduler-week-{$date->gregorianWeek(3)}" id="scheduler-plan4"></div>
            {else}
                <div class="box wide" id="scheduler-plan"></div>
            {/if}
        </div>
        <div class="box-strapper week{$week} result">
            <div class="box blue">
                <h1>Genomfört: {$student->fullname} <a href="/student/chat/{$id}" style="text-decoration: none; float: right; color: #c0c0c0; font-size: 12px;"><img src="/assets/images/discussion.png" style="vertical-align: -10px;" /> Chat</a></h1>

            </div>

            {if $week != 5}
                <div class="box wide" id="scheduler-result"></div>
            {else}
                <div class="box wide scheduler-result" id="scheduler-result1"></div>
                <div class="box wide scheduler-result" id="scheduler-result2"></div>
                <div class="box wide scheduler-result" id="scheduler-result3"></div>
                <div class="box wide scheduler-result" id="scheduler-result4"></div>
                <div class="box wide scheduler-result" id="scheduler-result5" style="display: none;"></div>
            {/if}

        {if $week != 5}
            <div class="box wide">{include file="snippets/day.tpl" day=$day}</div>
        {/if}
        </div>
        <div style="clear: both;"></div>
    </div>
    
  </div>
  <div id="sideBar">
    <!--Some content in your right column/sidebar-->
    <div id="fixeddiv">
        <div style="width: 160px;">
            <div class="week{$week} calendar-meta">
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
                        <a href="/student/calendar/{$id}/stats/{$date->year}">Å</a>
                        <a href="/student/calendar/{$id}/stats/{$date->year}/{$date->period}">P</a>
                        <a href="/student/calendar/{$id}/stats/{$date->year}/{$date->period}/{$date->week}">V</a>
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



        {if $week == 5}

           $('#scheduler-plan1').scheduler({
                    posturl: '/calendar/day_workout/{$id}/{$date->year}/{$date->period}',
                    segments: {'segments'|Domains|json_encode},
                    weekdays: [
                            '{$weekdates[0]}',
                            '{$weekdates[1]}',
                            '{$weekdates[2]}',
                            '{$weekdates[3]}',
                            '{$weekdates[4]}',
                            '{$weekdates[5]}',
                            '{$weekdates[6]}'
                    ],
                    week: 0,
                    trash: '#trash',
                    overview: true
                });
             
 
                var day_workout = $.parseJSON('{$day_workout1}');
                $.each(day_workout, function(key, value) {
                    $('#scheduler-plan1').scheduler('add', value);
                }); 
               
                $('#scheduler-plan2').scheduler({
                    posturl: '/calendar/day_workout/{$id}/{$date->year}/{$date->period}',
                    segments: {'segments'|Domains|json_encode},
                    weekdays: [
                        '{$weekdates[7]}',
                            '{$weekdates[8]}',
                            '{$weekdates[9]}',
                            '{$weekdates[10]}',
                            '{$weekdates[11]}',
                            '{$weekdates[12]}',
                            '{$weekdates[13]}'
                    ],
                    week: 1,
                    trash: '#trash',
                   overview: true
                });

                var day_workout = $.parseJSON('{$day_workout2}');
                $.each(day_workout, function(key, value) {
                    $('#scheduler-plan2').scheduler('add', value);
                });
  
                $('#scheduler-plan3').scheduler({
                    posturl: '/calendar/day_workout/{$id}/{$date->year}/{$date->period}',
                    segments: {'segments'|Domains|json_encode},
                    weekdays: [
                            '{$weekdates[14]}',
                            '{$weekdates[15]}',
                            '{$weekdates[16]}',
                            '{$weekdates[17]}',
                            '{$weekdates[18]}',
                            '{$weekdates[19]}',
                            '{$weekdates[20]}'
                    ],
                    week: 2,
                    trash: '#trash',
                    overview: true
                });

                var day_workout = $.parseJSON('{$day_workout3}');
                $.each(day_workout, function(key, value) {
                    $('#scheduler-plan3').scheduler('add', value);
                });

                $('#scheduler-plan4').scheduler({
                    posturl: '/calendar/day_workout/{$id}/{$date->year}/{$date->period}',
                    segments: {'segments'|Domains|json_encode},
                    weekdays: [
                        '{$weekdates[21]}',
                            '{$weekdates[22]}',
                            '{$weekdates[23]}',
                            '{$weekdates[24]}',
                            '{$weekdates[25]}',
                            '{$weekdates[26]}',
                            '{$weekdates[27]}'
                    ],
                    week: 3,
                    trash: '#trash',
                    overview: true
                });

                var day_workout = $.parseJSON('{$day_workout4}');
                //console.log(day_workout);
                $.each(day_workout, function(key, value) {
                    $('#scheduler-plan4').scheduler('add', value);
                });

                $('#scheduler-plan5').scheduler({
                    posturl: '/calendar/day_workout/{$id}/{$date->year}/{$date->period}',
                    segments: {'segments'|Domains|json_encode},
                    weekdays: [
                            '{$weekdates[0]}',
                            '{$weekdates[24]}',
                            '{$weekdates[25]}',
                            '{$weekdates[26]}',
                            '{$weekdates[27]}',
                            '{$weekdates[5]}',
                            '{$weekdates[6]}'
                    ],
                    week: 5,
                    trash: '#trash',
                    overview: true
                });

                $('#scheduler-plan5').scheduler('update');
                
                var template_workout_notes = $.parseJSON('{$template_workout_notes}');
                $.each(template_workout_notes, function(key, value) {        
                    $('#scheduler-plan1').scheduler('add', value);
                });

                var template_workout_global = $.parseJSON('{$template_workout_global}');
                $.each(template_workout_global, function(key, value) {        
                    $('#scheduler-plan1').scheduler('add', value);
                });
                

                var template_workout = $.parseJSON('{$template_workout}');
                if (template_workout !== false) {
                    $('#workouts').append('<hr />');
                    $.each(template_workout, function(key, value) {
                        $('#scheduler-plan1').scheduler('add', value);
                    });
                }
 
        {else}
        

            $('#scheduler-plan').scheduler({
                posturl: '/calendar/day_workout/{$id}/{$date->year}/{$date->period}',
                        segments: {'segments'|Domains|json_encode},
                        weekdays: [
                            '{$weekdates[0]}',
                            '{$weekdates[1]}',
                            '{$weekdates[2]}',
                            '{$weekdates[3]}',
                            '{$weekdates[4]}',
                            '{$weekdates[5]}',
                            '{$weekdates[6]}'
                        ],
                        week: {$date->week},
                        trash: '#trash',
                        overview: false
                });

                var day_workout = $.parseJSON('{$day_workout}');
                $.each(day_workout, function(key, value) {
                    $('#scheduler-plan').scheduler('add', value);
                });

                $('#scheduler-plan').scheduler('update');
                
                var template_workout_notes = $.parseJSON('{$template_workout_notes}');
                $.each(template_workout_notes, function(key, value) {        
                    $('#scheduler-plan').scheduler('add', value);
                });

                var template_workout_global = $.parseJSON('{$template_workout_global}');
                $.each(template_workout_global, function(key, value) {        
                    $('#scheduler-plan').scheduler('add', value);
                });

                var template_workout = $.parseJSON('{$template_workout}');
                if (template_workout !== false) {
                    $('#workouts').append('<hr />');
                    $.each(template_workout, function(key, value) {
                        $('#scheduler-plan').scheduler('add', value);
                    });
                }

        {/if}

        /**** STATS ****/
        {if $week == 5}
            $('.tabs.stats a').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
                $('.box.stats').html('<p style="text-align: center;"><img src="/assets/images/load-medium.gif" /></p>').load($(this).attr('href'));
            }).first().next().click();
        {else}
            $('.tabs.stats a').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
                $('.box.stats').html('<p style="text-align: center;"><img src="/assets/images/load-medium.gif" /></p>').load($(this).attr('href'));
            }).last().click();
        {/if}


        /**** RESULTS ****/
        {if $week == 5}

            $('#scheduler-result1').scheduler({
                posturl: '/calendar/day_result/{$id}/{$date->year}/{$date->period}',
                segments: {'segments'|Domains|json_encode},
                weekdays: [
                            '{$weekdates[0]}',
                            '{$weekdates[1]}',
                            '{$weekdates[2]}',
                            '{$weekdates[3]}',
                            '{$weekdates[4]}',
                            '{$weekdates[5]}',
                            '{$weekdates[6]}'
                        ],
                week: 0,
                summary: '#duration_result',
                overview: true
            });

            var day_result = $.parseJSON('{$day_result1}');
            $.each(day_result, function(key, value) { 
                $('#scheduler-result1').scheduler('add', value);
            });
            
            var day_workoutnotes = $.parseJSON('{$day_workoutnotes1}');
                $.each(day_workoutnotes, function(key, value) {
                    $('#scheduler-result1').scheduler('add', value);
                });

            $('#scheduler-result2').scheduler({
                posturl: '/calendar/day_result/{$id}/{$date->year}/{$date->period}',
                segments: {'segments'|Domains|json_encode},
                weekdays: [
                            '{$weekdates[7]}',
                            '{$weekdates[8]}',
                            '{$weekdates[9]}',
                            '{$weekdates[10]}',
                            '{$weekdates[11]}',
                            '{$weekdates[12]}',
                            '{$weekdates[13]}'
                        ],
                week: 1,
                summary: '#duration_result',
                overview: true
            });

            var day_result = $.parseJSON('{$day_result2}');
            
            $.each(day_result, function(key, value) { 
                $('#scheduler-result2').scheduler('add', value);
            });
            
            
            
            var day_workoutnotes = $.parseJSON('{$day_workoutnotes2}');
                $.each(day_workoutnotes, function(key, value) {
                    $('#scheduler-result2').scheduler('add', value);
                });

            $('#scheduler-result3').scheduler({
                posturl: '/calendar/day_result/{$id}/{$date->year}/{$date->period}',
                segments: {'segments'|Domains|json_encode},
                weekdays: [
                            '{$weekdates[14]}',
                            '{$weekdates[15]}',
                            '{$weekdates[16]}',
                            '{$weekdates[17]}',
                            '{$weekdates[18]}',
                            '{$weekdates[19]}',
                            '{$weekdates[20]}'
                        ],
                week: 2,
                summary: '#duration_result',
                overview: true
            });

            var day_result = $.parseJSON('{$day_result3}');
            $.each(day_result, function(key, value) { 
                $('#scheduler-result3').scheduler('add', value);
            });
            
            var day_workoutnotes = $.parseJSON('{$day_workoutnotes3}');
                $.each(day_workoutnotes, function(key, value) {
                    $('#scheduler-result3').scheduler('add', value);
                });

            $('#scheduler-result4').scheduler({
                posturl: '/calendar/day_result/{$id}/{$date->year}/{$date->period}',
                segments: {'segments'|Domains|json_encode},
                weekdays: [
                            '{$weekdates[21]}',
                            '{$weekdates[22]}',
                            '{$weekdates[23]}',
                            '{$weekdates[24]}',
                            '{$weekdates[25]}',
                            '{$weekdates[26]}',
                            '{$weekdates[27]}'
                        ],
                week: 3,
                summary: '#duration_result',
                overview: true
            });

            var day_result = $.parseJSON('{$day_result4}');
            $.each(day_result, function(key, value) { 
                $('#scheduler-result4').scheduler('add', value);
            });
            
            var day_workoutnotes = $.parseJSON('{$day_workoutnotes4}');
                $.each(day_workoutnotes, function(key, value) {
                    $('#scheduler-result4').scheduler('add', value);
                });

            $('#scheduler-result5').scheduler({
                posturl: '/calendar/day_result/{$id}/{$date->year}/{$date->period}',
                segments: {'segments'|Domains|json_encode},
                weekdays: [
                            '{1|weekday} {$weekdates[27]}'
                        ],
                week: 5,
                summary: '#duration_result'
            });

            $('#scheduler-result5').scheduler('update');

        {else} 

            $('#scheduler-result').scheduler({
                posturl: '/calendar/day_result/{$id}/{$date->year}/{$date->period}',
                segments: {'segments'|Domains|json_encode},
                weekdays: [
                            '{$weekdates[0]}',
                            '{$weekdates[1]}',
                            '{$weekdates[2]}',
                            '{$weekdates[3]}',
                            '{$weekdates[4]}',
                            '{$weekdates[5]}',
                            '{$weekdates[6]}'
                        ],
                week: {$date->week},
                summary: '#duration_result',
                overview: false
            });

            var day_result = $.parseJSON('{$day_result}');
            $.each(day_result, function(key, value) { 
                $('#scheduler-result').scheduler('add', value);
            });
            
            var day_workoutnotes = $.parseJSON('{$day_workoutnotes}');
                $.each(day_workoutnotes, function(key, value) {
                    $('#scheduler-result').scheduler('add', value);
                });

            $('#scheduler-result').scheduler('update');

        {/if}

        var ssf_events = $.parseJSON('{$ssf_events}');
        addEvents(ssf_events, 'ssf_events', '#378006');
        var school_events = $.parseJSON('{$school_events}');
        addEvents(school_events, 'school_events', '#084B8A');
        var user_events = $.parseJSON('{$user_events}');
        addEvents(user_events, 'user_events', '#FFBF00');
    });

</script>
