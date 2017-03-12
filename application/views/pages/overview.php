<div class="box blue">
    
    <h1>Hej {$user->fullname}!</h1>
    
    <p style="float: left; width: 450px;">
        Välkommen till Träningsdagboken. Här registrerar du din träning och får
        hjälp av din tränare att träna rätt. Klicka på registrera aktivitet för
        att starta din träning.<br />
        Lycka till!
    </p>
    
    <div class="box" style="float: left; width: 424px; overflow: hidden;">
        
        <table class="statistics" style="float: left; margin-right: 12px; border-radius: 0px 6px 6px 0px; overflow: hidden; border: 1px solid #CCC;">
            <tr>
                <th></th>
                <th>Tid</th>
                <th>Pass</th>
            </tr>
            <tr>
                <td>Årsplanering</td>
                <td>{$statistics->plan()|length}</td>
                <td>-</td>
            </tr>
            {$s=$statistics->summary('day_workouts', $pageUser->id)}
            <tr>
                <td>Passplanering</td>
                <td>{$s->duration|length}</td>
                <td>{$s->count}</td>
            </tr>
            {$s=$statistics->summary('day_results', $pageUser->id)}
            <tr>
                <td>Genomfört</td>
                <td>{$s->duration|length}</td>
                <td>{$s->count}</td>
            </tr>
        </table>
        
    </div>
    
    <p style="height: 32px; clear: both;"></p>
    
    <div style="overflow: auto;">
        
        <div style="float: left; margin: 0px 24px 0px 12px;">
            <a href="/overview/{$date->year}/{$date->period-1}/0"><img src="/assets/images/left.png" width="8" height="15" /></a>
            Period {$date->period+1}
            <a href="/overview/{$date->year}/{$date->period+1}/0"><img src="/assets/images/right.png" width="8" height="15" /></a>
        </div>
        
        <div class="tabs" style="float: left;">
            {for $i=0 to 3}
            <a href="/overview/{$date->year}/{$date->period}/{$i}"{if $i == $date->week} class="active"{/if}>Vecka {$w=Period::to_week($date->year,$date->period,$i)}{$w}</a>
            {/for}
            <a href="/overview"{if $date->isNow()} class="active"{/if} style="margin-left: 32px;">Idag</a>
        </div>
        
    </div>
    
</div>

<div class="box" id="scheduler-plan"></div>

<div class="box blue" style="margin-top: 12px;">
    <h1>Genomförd träning</h1>
</div>

<div class="box" id="scheduler-result"></div>

<div class="box">{include file="snippets/day.tpl" day=$day}</div>

<div class="box blue" style="margin-top: 12px;">
    <h1>Kom igång med träningsdagboken</h1>
</div>

<div class="box">
    
    <img src="/assets/images/tmp1.jpg" width="192" height="192" style="float: left; margin: 12px;" />
    
    <div style="float: left; margin: 12px; width: 224px;">
        <h3>Skidtips</h3>
        <p>
            Vi har nu fått in 2012 års produktkatalog över de nya skidorna med
            kolfiber. Ta kontakt med din tränare så berättar han mer.
        </p>
    </div>
    
    <img src="/assets/images/tmp2.jpg" width="192" height="192" style="float: left; margin: 12px;" />
    
    <div style="float: left; margin: 12px; width: 224px;">
        <h3>Sommartips</h3>
        <p>
            Det går fortfarande bra att åka skidor inomhus i skidbacken i Dubai.
        </p>
    </div>
    
</div>
<script type="text/javascript">
    
    $(function () {
        
        var weekdays = [
            '{1|weekday} {$weekdates[0]}',
            '{2|weekday} {$weekdates[1]}',
            '{3|weekday} {$weekdates[2]}',
            '{4|weekday} {$weekdates[3]}',
            '{5|weekday} {$weekdates[4]}',
            '{6|weekday} {$weekdates[5]}',
            '{7|weekday} {$weekdates[6]}'
        ];
        
        $('#scheduler-plan').scheduler({
            posturl: '/calendar/day_workout/{$id}/{$date->year}/{$date->period}',
            segments: {'segments'|Domains|json_encode},
            weekdays: weekdays,
            week: {$date->week},
            trash: '#trash'
        });
        
        var day_workout = $.parseJSON('{$day_workout}');
                $.each(day_workout, function(key, value) {
                    $('#scheduler-plan').scheduler('add', value);
                });
        
        $('#scheduler-plan').scheduler('update');

        /**** RESULTS ****/
        
        $('#scheduler-result').scheduler({
            posturl: '/calendar/day_result/{$id}/{$date->year}/{$date->period}',
            segments: {'segments'|Domains|json_encode},
            weekdays: weekdays,
            week: {$date->week}
        });
        
        var day_result = $.parseJSON('{$day_result}');
                $.each(day_result, function(key, value) {
                    $('#scheduler-result').scheduler('add', value);
                });
        
        $('#scheduler-result').scheduler('update');
        
        $('#scheduler-result').find('.day').addClass('add-training').on('click', function () {
            if($(this).children().length) { return ; }
            var d = ($(this).index() - 1);
            var s = (($(this).parent().index() - 1) / 2);
            $.popup({
                id: 'add',
                type: 'day_result',
                extra: '0/{$date->year}/{$date->period}/{$date->week}/' + d + '/' + s,
                title: "Registrera ny träning (" + weekdays[d] + ", " + {'segments'|Domains|json_encode}[s] + ")",
                success: function (data) {
                    if(!data) { return ; }
                    $('#scheduler-result').scheduler('add', data);
                    $('#scheduler-result').scheduler('update');
                }
            });
        });
        
        /**** STATS ****/
        
        $(function () {
            
            var activity = {'parts'|Domains:0:'fields':0:'values'|json_encode};
            var stats = {$statistics->activity({$pageUser->id})|json_encode};
            
            var data = [['Aktivitet', 'Tid']];
            var color = [];
            
            for(var i in activity) {
                
                var a = (function (key) {
                    for(var i in stats) {
                        if(stats[i].activity == key) {
                            return stats[i];
                        }
                    }
                    return null;
                })(activity[i].key);
                
                data.push([activity[i].val, ( a ? parseInt(a.duration) : 0 )]);
                color.push(activity[i].color);
                
            }
            
            $('<div />').css('float', 'left').insertAfter('table.statistics').chart({
                w: 200,
                data: data,
                colors: color
            });
            
        });
        
    });
    
</script>
