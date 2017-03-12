
<div style="float: left; width: 728px;">

    <div class="box blue"><h1>Planerat</h1></div>

    <table class="box">
        <tr>
            <th style="width: auto;"></th>
            <th style="width: 280px;">Planerat</th>
            <th style="width: 280px;">Utfört</th>
        </tr>
        {foreach from=$segments key=i item=segment}
        <tr>
            <td>{$segment}</td>
            <td>
                {if $day_workout[$i]}
                <div class="activity" data-id="{$day_workout[$i]->id}" data-segment="{$i}">
                    <p class="title">{$day_workout[$i]->__string__} <span class="duration">{$day_workout[$i]->__duration__|length}</span></p>
                    <p class="comment">{$day_workout[$i]->__comment__|default:"<i>inga kommentarer</i>"}</p>
                    <a class="{if $day_workout[$i]->done}done{else}report{/if}"></a>
                </div>
                {/if}
            </td>
            <td>
                {if $day_result[$i]}
                <div class="activity" data-id="{$day_result[$i]->id}">
                    <p class="title">{$day_result[$i]->__string__} <span class="duration">{$day_result[$i]->__duration__|length}</span></p>
                    <p class="comment">{$day_result[$i]->__comment__|default:"<i>inga kommentarer</i>"}</p>
                    <a class="edit"></a>
                </div>
                {elseif !$day_workout[$i]}
                <div class="activity" data-segment="{$i}" style="border: 1px dashed #CCC;">
                    <p class="title" style="padding-top: 8px;">Lägg till träning</p>
                    <a class="add"></a>
                </div>
                {/if}
            </td>
        </tr>
        {/foreach}
    </table>

</div>

<div style="float: right; width: 216px;">

    <div class="box blue"><h1>Dag</h1></div>

    <form action="{$url}" method="post" class="box">

        <table style="width: 192px; text-align: center;">
            <tr><td></td></tr>
            <tr>
                <td rowspan="4"><a href="/activity/{$date->year}/{$date->period}/{$date->week}/{$date->day-1}/"><img src="/assets/images/left.png" /></a></td>
                <td rowspan="4"><div class="cal"><span>{$date->hyGregorian("M")}</span>{$date->hyGregorian("d")}</div></td>
                <td><b>{$date->hyGregorian("N")|weekday}</b></td>
                <td rowspan="4"><a href="/activity/{$date->year}/{$date->period}/{$date->week}/{$date->day+1}/"><img src="/assets/images/right.png" /></a></td>
            </tr>
            <tr>
                <td style="color: #333333; font-size: 10pt;">{$date->hyGregorian("Y - m - d")}</td>
            </tr>
            <tr><td></td></tr>
        </table>

        <hr />

        {foreach from='day'|Domains item=d}
        {if $d->type == "checkbox"}
        {if $day}
        {include file="snippets/checkboxes.tpl" name="day["|cat:$d->name|cat:"]" values=$d->values checked=$day->{$d->name}}
        {else}
        {include file="snippets/checkboxes.tpl" name="day["|cat:$d->name|cat:"]" values=$d->values checked=null}
        {/if}
        {elseif $d->type == "number"}
        <input type="number" size="6" name="day[{$d->name}]"{if $day} value="{$day->{$d->name}}"{/if} />
        <label>{$d->title}</label><br />
        {elseif $d->type == "text"}
        <input type="text" size="6" name="day[{$d->name}]"{if $day} value="{$day->{$d->name}}"{/if} />
        <label>{$d->title}</label><br />
        {/if}
        {/foreach}

        <p style="text-align: right;"><input type="submit" value="Spara" /></p>

    </form>

</div>

<script type="text/javascript">

    $(function () {

        $.datepicker.setDefaults($.datepicker.regional['sv']);
        
        $.datepicker.setDefaults({
            firstDay: 1
        });

        $('a.report').each(function () {
            var $parent = $(this).parent();
            $(this).popup({
                id: 'add',
                type: 'day_result',
                extra: $parent.data('id') + '/{$date->year}/{$date->period}/{$date->week}/{$date->day}/' + $parent.data('segment'),
                title: "Registrera " + $parent.find('.title').clone().children().remove().end().text(),
                success: function (data) {
                    if(!data) { return ; }
                    /* FIXME */
                    window.location.reload();
                }
            });
        });

        $('a.add').each(function () {
            var $parent = $(this).parent();
            $(this).popup({
                id: 'add',
                type: 'day_result',
                extra: '0/{$date->year}/{$date->period}/{$date->week}/{$date->day}/' + $parent.data('segment'),
                title: "Registrera ny träning",
                success: function (data) {
                    if(!data) { return ; }
                    /* FIXME */
                    window.location.reload();
                }
            });
        });

        $('a.edit').each(function () {
            var $parent = $(this).parent();
            $(this).popup({
                id: $parent.data('id'),
                type: 'day_result',
                title: $parent.find('.title').clone().children().remove().end().text(),
                success: function (data) {
                    if(data) {
                        $parent.find('.title').text(data.__string__ + ' ').append($('<span class="duration" />').duration(data.__duration__));
                        $parent.find('.comment')[data.comment ? 'text' : 'html'](data.comment ? data.comment : "<i>inga kommentarer</i>");
                    } else {
                        $parent.remove();
                    }
                }
            });
        });

        $('.cal').click(function () {
            $('<div />').dialog({
                modal: true,
                title: "Välj datum",
                width: 340,
                height: 330,
                resizable: false
            }).datepicker({
                dateFormat: $.datepicker.W3C,
                defaultDate: '{$date->gregorian("Y-m-d")}',
                onSelect: function (dateText) {
                    location.href = "/activity/" + dateText;
                }
            });
        });

    });

</script>
