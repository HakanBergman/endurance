
<div style="float: left; width: 960px;" class="planner">

    <div class="box blue" style="margin-left: 86px;">

        <h1>Programmets utformning: {$schedule->title}</h1>

        <div class="tabs">
            {for $w=1 to 4}
            <a href="/schedule/calendar/{$id}/{$w-1}"{if $w-1 == $week} class="active"{/if}>Vecka {$w}</a>
            {/for}
            <a href="/schedule/calendar/{$id}/5"{if 5 == $week} class="active"{/if}>Översikt</a>
        </div>

    </div>
    {if 5 == $week}
    <div class="box wide" id="scheduler1"></div>
    <div class="box wide" id="scheduler2"></div>
    <div class="box wide" id="scheduler3"></div>
    <div class="box wide" id="scheduler4"></div>
    <div class="box wide" id="scheduler5"></div>
    {else}
    <div class="box wide" id="scheduler"></div>
    {/if}
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
            <select style="width: 100%;" id="group">{foreach from=$groups item=g}<option value="{$g->id}">{$g->title}</option>{/foreach}</select> <br />
            
            <select style="width: 100%;" id="period">
                {for $i=$now->period-3 to $now->period+13}                    
                    <option value="{if $i < 0}{math equation='x - y' x=$now->year y=1}-{math equation='(x + y)' x=13 y=$i}{elseif $i > 12}{math equation='x + y' x=$now->year y=1}-{math equation='(y - x)' x=13 y=$i}{else}{$now->year}-{$i}{/if}"
                >
                    
                    {* år *}
                    {if $i < 0}
                        {$now->year - 1}/{$now->year|substr:2:3}
                        {assign var="year" value=$now->year - 1}
                    {elseif $i > 12}
                        {$now->year + 1}/{($now->year + 2)|substr:2:3}
                        {assign var="year" value=$now->year + 1}
                    {else}
                        {$now->year}/{($now->year + 1)|substr:2:3}
                        {assign var="year" value=$now->year}
                    {/if} 
                    {* period *}
                    {*Period {$i+1}*}
                    {if $i < 0}
                        P. {(13+$i)+1}
                    {elseif $i > 12}
                        P. {($i-13)+1}
                    {else}
                        P. {($i)+1}
                    {/if}
                    (v. 
                    {* veckonummer *}
                    {(Period::to_date($year, $i, 0))|date_format:"%V"} - {(Period::to_date($year, $i, 3))|date_format:"%V"}
                    )
                </option>{/for}
            </select> <br />
            <button style="width: 50%; margin-left: 50%;" id="show">Visa</button>
        </p>



    </div>

</div>
</div>

<script type="text/javascript">
    
    {* Översikt *}
    $(function () {
        $('#show').click(function () {
            
            values = $('#period').val().split("-");

            $('#duration_planned').html('<img src="/assets/images/load-small.gif" />');
            jQuery.post(
                    '/schedule/summary/{$id}',
                    { 
                      'group': $('#group').val(), 
                      'period': values[1], 
                      'week': {$week},
                      'year': values[0]
                    },
                    function (data) {
                        $('#duration_planned').text(data);
                    }
            );
        });
    });
    
    
    {if $week == 5}
    $(function () {
      
    $('#scheduler1').scheduler({
            posturl: '/calendar/schedule_workout/{$id}',
            segments: {'segments'|Domains|json_encode},
            weekdays: ['{1|weekday}', '{2|weekday}', '{3|weekday}', '{4|weekday}', '{5|weekday}', '{6|weekday}', '{7|weekday}'],
            week: 0,
            trash: '#trash'
        });

        var schedule_workout1 = $.parseJSON('{$schedule_workout1}');
        $.each( schedule_workout1, function( key, value ) {
            workout = value;
            $('#scheduler1').scheduler('add', workout);
        });
        
        /*-------------------*/

        $('#scheduler2').scheduler({
            posturl: '/calendar/schedule_workout/{$id}',
            segments: {'segments'|Domains|json_encode},
            weekdays: ['{1|weekday}', '{2|weekday}', '{3|weekday}', '{4|weekday}', '{5|weekday}', '{6|weekday}', '{7|weekday}'],
            week: 1,
            trash: '#trash'
        });
        
        var schedule_workout2 = $.parseJSON('{$schedule_workout2}');
        $.each( schedule_workout2, function( key, value ) {
            workout = value;
            $('#scheduler2').scheduler('add', workout);
        });
        
        /*-------------------*/
        
        $('#scheduler3').scheduler({
            posturl: '/calendar/schedule_workout/{$id}',
            segments: {'segments'|Domains|json_encode},
            weekdays: ['{1|weekday}', '{2|weekday}', '{3|weekday}', '{4|weekday}', '{5|weekday}', '{6|weekday}', '{7|weekday}'],
            week: 2,
            trash: '#trash'
        });
        
        var schedule_workout3 = $.parseJSON('{$schedule_workout3}');
        $.each( schedule_workout3, function( key, value ) {
            workout = value;
            $('#scheduler3').scheduler('add', workout);
        });
        
        /*-------------------*/
        
        $('#scheduler4').scheduler({
            posturl: '/calendar/schedule_workout/{$id}',
            segments: {'segments'|Domains|json_encode},
            weekdays: ['{1|weekday}', '{2|weekday}', '{3|weekday}', '{4|weekday}', '{5|weekday}', '{6|weekday}', '{7|weekday}'],
            week: 3,
            trash: '#trash'
        });
        
        var schedule_workout4 = $.parseJSON('{$schedule_workout4}');
        $.each( schedule_workout4, function( key, value ) {
            workout = value;
            $('#scheduler4').scheduler('add', workout);
        });
        
        /*-------------------*/
        
        var template_workout_global = $.parseJSON('{$template_workout_global}'); 
        $.each( template_workout_global, function( key, value ) {
            workout = value;
            $('#scheduler1').scheduler('add', workout);
        });
        
        $('#workouts').append('<hr />');
        
        /*-------------------*/
        
        var template_workout = $.parseJSON('{$template_workout}');
        $.each( template_workout, function( key, value ) {
            workout = value;
            $('#scheduler1').scheduler('add', workout);
        });
        
        /*-------------------*/
        
        $('#scheduler5').scheduler('update');
        
        /*-------------------*/
    }); 
    {else} {* Vecka 1 - 4 *}
        $(function () {
            
            
            $('#scheduler').scheduler({
            posturl: '/calendar/schedule_workout/{$id}',
                    segments: {'segments'|Domains|json_encode},
                    weekdays: ['{1|weekday}', '{2|weekday}', '{3|weekday}', '{4|weekday}', '{5|weekday}', '{6|weekday}', '{7|weekday}'],
                    week: {$week},
                    trash: '#trash'
            });
            
            var schedule_workout = $.parseJSON('{$schedule_workout}');
            $.each( schedule_workout, function( key, value ) {
                workout = value;
                $('#scheduler').scheduler('add', workout);
            });

            var template_workout_global = $.parseJSON('{$template_workout_global}'); 
            $.each( template_workout_global, function( key, value ) {
                workout = value;
                $('#scheduler').scheduler('add', workout);
            });
            
            $('#workouts').append('<hr />');
            
            var template_workout = $.parseJSON('{$template_workout}');
            $.each( template_workout, function( key, value ) {
                workout = value;
                $('#scheduler').scheduler('add', workout);
            });            
            
            $('#scheduler').scheduler('update');
        });    

    {/if}
        
</script>