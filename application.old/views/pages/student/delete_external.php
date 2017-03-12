
<div class="box schedules blue">
    
    <h1> Utövare </h1>
    
</div>

<table class="box schedules">
    {foreach from=$students key=key item=cur}
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
