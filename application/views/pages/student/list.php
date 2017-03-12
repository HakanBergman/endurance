
<div class="box schedules blue">
    <h1>Utövare {if $pageUser->type == "150"}{$school->title}{/if} <a href="/school/statistics/{$school->id}" title="Statistik för skola"><img src="/assets/images/stats.png" /></a></h1>
    
</div>

<table class="box schedules">
    {if count($students)}
    <tr class="group-header">
        <td colspan="{if $pageUser->type == "150"}9{else}8{/if}" style="background-color: #cccccc;">
            {if $pageUser->type != "150"}
            <a href="/student/add">
                Lägg till utövare
            </a>
            {/if}
        </td>
    </tr>
    {else}
    <tr>
        <td colspan="8">
            Lägg upp grupper innan du administrerar användare.
        </td>
    </tr>
    {/if}

    {foreach from=$students key=key item=cur}
        {if count($cur->users) != 0}
        <tr class="group-header">
            <th colspan="{if $pageUser->type == "150"}9{else}8{/if}" style="background-color: #cccccc;">{$cur->title}{if count($cur->users) != 0}&nbsp;<a href="/group/statistics/{$cur->group_id}" alt="Visa statistik för grupp"><img src="/assets/images/stats.png" title="Visa statistik för grupp" /></a>{/if} 
            <img src="/assets/images/plus.png" width="25" class="group-header-toggle" />
            </th>
        </tr>
        {/if}
        {foreach from=$cur->users key=key2 item=cur2}
        <tr>
            <td {if not $cur2->active}class="inactive"{/if}>{$cur2->fullname}</td>
            <td style="width: 500px; text-align: center; color: darkgray; font-size: smaller;" id="{$key|cat:$key2}" class="tooltip"></td>
            <td style="width: 32px;" {if $cur2->active}onmouseout="$('#{$key|cat:$key2}').text('');" onmouseover="$('#{$key|cat:$key2}').text('Visa chat');"{/if}>{if $cur2->active}<a href="/student/chat/{$cur2->user_id}" style="text-decoration: none;"><img src="/assets/images/discussion.png" style="vertical-align: -10px;" /> <span style="color: #666; font-size: 8pt;">{$cur2->user_chat_updated}</span></a>{/if}</td>
            <td style="width: 32px;" onmouseout="$('#{$key|cat:$key2}').text('');" onmouseover="$('#{$key|cat:$key2}').text('Visa statistik');"><a href="/student/statistics/{$cur2->user_id}"><img src="/assets/images/stats.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('#{$key|cat:$key2}').text('');" onmouseover="$('#{$key|cat:$key2}').text('Visa kalender');"><a href="/overview/{$cur2->user_id}/{$date->year}/{$date->period}/5"><img src="/assets/images/calender.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('#{$key|cat:$key2}').text('');" onmouseover="$('#{$key|cat:$key2}').text('Visa årsplanering');"><a href="/student/plan/{$cur2->user_id}"><img src="/assets/images/time.png" /></a></td>
            <td style="width: 32px;" {if $cur2->active}onmouseout="$('#{$key|cat:$key2}').text('');" onmouseover="$('#{$key|cat:$key2}').text('Ändra egenskaper');"><a href="/student/edit/{$cur2->user_id}"><img src="/assets/images/edit.png" /></a>{/if}</td>
            <td style="width: 32px;" onmouseout="$('#{$key|cat:$key2}').text('');" onmouseover="$('#{$key|cat:$key2}').text('Ta bort utövaren');"><a href="/student/delete/{$cur2->user_id}/{$cur->group_id}"><img src="/assets/images/remove.png" /></a></td>
            {if $pageUser->type == "150"}
            {if $lists}
            <td style="width: 100px; text-align: left; background: #c0c0c0; padding: 10px;">
                <form name="save_to_list" action="/ssf/save/{$cur2->user_id}" method="post">
                    <select style="width: 120px; height: 75px; border: 0px;" multiple name="lists[]">
                        {foreach from=$lists key=key3 item=cur3}
                        <option value='favs_{$cur3@iteration}' {if in_array($cur3@iteration, $cur2->lists)}selected{/if} >{$key3}</option>
                        {/foreach}
                    </select>
                    <input type="submit" value="Spara" />
                </form>
            </td>
            {/if}
            {/if}
        </tr>
        {/foreach}
    {/foreach}
    {if count($students)}
    <tr class="group-header">
        <td colspan="{if $pageUser->type == "150"}9{else}8{/if}" style="background-color: #cccccc;">
            {if $pageUser->type != "150"}
            <a href="/student/add">
                Lägg till utövare
            </a>
            {/if}
        </td>
    </tr>
    {else}
    <tr>
        <td colspan="8">
            Lägg upp grupper innan du administrerar användare.
        </td>
    </tr>
    {/if}
</table>

{if $external_students|count != 0}
<div class="box schedules blue">
    <h1> Externa Utövare </h1>
</div>

<table class="box schedules">
    {foreach from=$external_students key=key item=cur}
        <tr>
            <td>{$cur->fullname} - {$cur->email}</td>
            <td style="width: 96px; text-align: center; color: darkgray; font-size: smaller;" id="{$key}" class="tooltip"></td>
            <td style="width: 64px;" onmouseout="$('#{$key}').text('');" onmouseover="$('#{$key}').text('Visa chat');"><a href="/student/chat/{$cur->user_id}" style="text-decoration: none;"><img src="/assets/images/discussion.png" style="vertical-align: -10px;" /> <span style="color: #666; font-size: 8pt;">{$cur->user_chat_updated}</span></a></td>
            <td style="width: 32px;" onmouseout="$('#{$key}').text('');" onmouseover="$('#{$key}').text('Visa statistik');"><a href="/student/statistics/{$cur->user_id}"><img src="/assets/images/stats.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('#{$key}').text('');" onmouseover="$('#{$key}').text('Visa kalender');"><a href="/student/calendar/{$cur->user_id}"><img src="/assets/images/calender.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('#{$key}').text('');" onmouseover="$('#{$key}').text('Visa årsplanering');"><a href="/student/plan/{$cur->user_id}"><img src="/assets/images/time.png" /></a></td>
        </tr>
    {/foreach}
</table>
{/if}
