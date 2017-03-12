
<table class="statistics main">
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
    <tr>
        <td>Passplanering</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Genomfört</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <th></th>
        <th>Tid</th>
        <th>Pass</th>
    </tr>
    {foreach from='parts'|Domains key=key item=item}
    <tr class="head" data-type="{$key}">
        <td>{$item->title}</td>
        <td></td>
        <td></td>
    </tr>
    {if isset($item->statgroup)}
    {foreach from=$item->fields[$item->statgroup]->values item=val}
    <tr class="body" data-type="{$key}" data-key="{$val->key}">
        <td>{$val->val}</td>
        <td></td>
        <td></td>
    </tr>
    {/foreach}
    {else}
    <tr class="body" data-type="{$key}" data-key="{$key}">
        <td>{$item->title}</td>
        <td></td>
        <td></td>
    </tr>
    {/if}
    {/foreach}
</table>

{if isset($link) && $link}
<p style="text-align: center;">
    <a href="/student/statistics/{$statistics->user}/{$statistics->dateFrom->gregorian('Y-m-d')}/{$statistics->dateTo->gregorian('Y-m-d')}">
        Visa mer statistik
    </a>
</p>
{/if}

<table class="statistics day">
    <tr>
        <th></th>
        <th>Antal</th>
    </tr>
    {foreach from=$statistics->day() item=item}
    <tr>
        <td>{$item->val}</td>
        <td>{$item->count}</td>
    </tr>
    {/foreach}
    <tr>
        <td>Form</td>
        <td>{$statistics->shape()|round:1}</td>
    </tr>
</table>

{if isset($compare_stats) && $compare_stats}
Föregående år
<table class="statistics compare">
    <tr>
        <th></th>
        <th>Tid</th>
        <th>Pass</th>
    </tr>
    <tr>
        <td>Årsplanering</td>
        <td>{$compare_stats->plan()|length}</td>
        <td>-</td>
    </tr>
    <tr>
        <td>Passplanering</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Genomfört</td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
        <th></th>
        <th>Tid</th>
        <th>Pass</th>
    </tr>
    {foreach from='parts'|Domains key=key item=item}
    <tr class="head" data-type="{$key}">
        <td>{$item->title}</td>
        <td></td>
        <td></td>
    </tr>
    {if isset($item->statgroup)}
    {foreach from=$item->fields[$item->statgroup]->values item=val}
    <tr class="body" data-type="{$key}" data-key="{$val->key}">
        <td>{$val->val}</td>
        <td></td>
        <td></td>
    </tr>
    {/foreach}
    {else}
    <tr class="body" data-type="{$key}" data-key="{$key}">
        <td>{$item->title}</td>
        <td></td>
        <td></td>
    </tr>
    {/if}
    {/foreach}
</table>

{if isset($link) && $link}
<p style="text-align: center;">
    <a href="/student/statistics/{$statistics->user}/{$statistics->dateFrom->gregorian('Y-m-d')}/{$statistics->dateTo->gregorian('Y-m-d')}">
        Visa mer statistik
    </a>
</p>
{/if}

<table class="statistics day">
    <tr>
        <th></th>
        <th>Antal</th>
    </tr>
    {foreach from=$compare_stats->day() item=item}
    <tr>
        <td>{$item->val}</td>
        <td>{$item->count}</td>
    </tr>
    {/foreach}
    <tr>
        <td>Form</td>
        <td>{$compare_stats->shape()|round:1}</td>
    </tr>
</table>
{/if}

<script type="text/javascript">

$(function () {

    var i;
    var titles = [{foreach from='parts'|Domains item=item}{$item->title|json_encode}, {/foreach}""];

    var stat = {$statistics->table('day_results')|json_encode};
    var $table = $('table.statistics.main');

    var summaries = {};
    var total = [0, 0];

    //---Genomfört
    for(i in stat) {
        var s = stat[i];

        summaries[s.type] = summaries[s.type] || {
            duration: 0,
            count: 0.0,
            amount: 0,
            count_total: 0
        };


        var $tr = $table.find('.body[data-type="' + s.type + '"][data-key="' + s.title_key + '"]');

        if(s.type == 3) { 
            $tr.find('td').eq(1).text(s.amount + ' st');
        }
        else if(s.type == 4) { 
            $tr.find('td').eq(1).text(s.count_total + ' st');
        }
        else if(parseInt(s.duration)) { 
            $tr.find('td').eq(1).duration(s.duration);
        }

        $tr.find('td').eq(2).text(Math.round(s.count * 100) / 100);

        summaries[s.type].duration += parseInt(s.duration);
        summaries[s.type].count += parseFloat(s.count);
        summaries[s.type].amount += parseInt(s.amount);
        summaries[s.type].count_total += parseInt(s.count_total);

        if(s.type != 2) {
            total[0] += parseInt(s.duration);
            total[1] += parseFloat(s.count);
        } else {
            console.log(s);
        }
    }

    $table.find('tr').eq(3).find('td').eq(1).duration(total[0]);
    

    $table.find('tr').eq(3).find('td').eq(2).text(Math.round(total[1] * 1E2) / 1E2);


    //---Passplanering---
    var stat = {$statistics->table('day_workouts')|json_encode};
   

    var $table = $('table.statistics.main');

    var total = [0, 0];

    for(i in stat) {
        var s = stat[i];
        //console.log(s);
        
        if(s.type != 2) {
            total[0] += parseInt(s.duration);
            total[1] += parseInt(s.count);
        }
        
    }

    $table.find('tr').eq(2).find('td').eq(1).duration(total[0]);
    $table.find('tr').eq(2).find('td').eq(2).text(total[1]);
    
    var activity = {'parts'|Domains:0:'fields':0:'values'|json_encode};

    {if isset($student->id)}
        var stats = {$statistics->activity($student->id)|json_encode};  
    {else}
        var stats = {$statistics->activity($students)|json_encode};
    {/if}
    

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

    $('<div />').insertAfter('table.statistics.main').chart({
        w: 200,
        data: data,
        colors: color
    });
    
    {* ==================================================*}
    {* ============ Jämför med tidigare år ==============*}
    {* ==================================================*}
    {if isset($compare_stats) && $compare_stats}

            var i;
            var titles = [{foreach from='parts'|Domains item=item}{$item->title|json_encode}, {/foreach}""];

            var stat = {$compare_stats->table('day_results')|json_encode};
            var $table = $('table.statistics.compare');

            var summaries = {};
            var total = [0, 0];


            /*---Genomfört---*/
            for(i in stat) {
                var s = stat[i];

                summaries[s.type] = summaries[s.type] || {
                    duration: 0,
                    count: 0.0,
                    amount: 0,
                    count_total: 0
                };

                var $tr = $table.find('.body[data-type="' + s.type + '"][data-key="' + s.title_key + '"]');

                if(s.type == 3) { 
                    $tr.find('td').eq(1).text(s.amount + ' st');
                }
                else if(s.type == 4) { 
                    $tr.find('td').eq(1).text(s.count_total + ' st');
                }
                else if(parseInt(s.duration)) { 
                    $tr.find('td').eq(1).duration(s.duration);
                }

                $tr.find('td').eq(2).text(Math.round(s.count * 100) / 100);

                summaries[s.type].duration += parseInt(s.duration);
                summaries[s.type].count += parseFloat(s.count);
                summaries[s.type].amount += parseInt(s.amount);
                summaries[s.type].count_total += parseInt(s.count_total);

                if(s.type != 2) {
                    total[0] += parseInt(s.duration);
                    total[1] += parseFloat(s.count);
                }  
            }

            $table.find('tr').eq(3).find('td').eq(1).duration(total[0]);
            $table.find('tr').eq(3).find('td').eq(2).text(Math.round(total[1] * 1E2) / 1E2);

            /*---Summering---*/
            for(i in summaries) {
                var $tr = $table.find('.head[data-type="' + i + '"], .head-body[data-type="' + i + '"]');
                if(i == 3) { $tr.find('td').eq(1).text(summaries[i].amount + ' st'); }
                else if(i == 4) { $tr.find('td').eq(1).text(summaries[i].count_total + ' st'); }
                else if(summaries[i].duration) { $tr.find('td').eq(1).duration(summaries[i].duration); }
                $tr.find('td').eq(2).text(Math.round(summaries[i].count * 1E2) / 1E2);
            }

            var stat = {$compare_stats->table('day_workouts')|json_encode};

            var $table = $('table.statistics.compare');

            var total = [0, 0];

            for(i in stat) {
                var s = stat[i];

                if(s.type != 2) {
                    total[0] += parseInt(s.duration);
                    total[1] += parseInt(s.count);
                }

            }

            $table.find('tr').eq(2).find('td').eq(1).duration(total[0]);
            $table.find('tr').eq(2).find('td').eq(2).text(total[1]);

            var activity = {'parts'|Domains:0:'fields':0:'values'|json_encode};

            {if isset($student->id)}
                var stats = {$compare_stats->activity($student->id)|json_encode};  
            {else}
                var stats = {$compare_stats->activity($students)|json_encode};
            {/if}

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

            $('<div />').insertAfter('table.statistics.compare').chart({
                w: 200,
                data: data,
                colors: color
            });
    {/if}{* ============ End: Jämför med tidigare år ==============*}
 
});
</script>
