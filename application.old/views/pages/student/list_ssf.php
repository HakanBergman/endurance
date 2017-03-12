<div class="box schedules blue">
    <h1> Sök utövare </h1>
</div>
<table class="box schedules search">
    <tr>
        <th style="text-align: left; padding: 10px;" colspan="8">
            <form name="input" action="/ssf" method="get">
                <input id="search_shttp://open.spotify.com/local/Lars+Winnerb%c3%a4ck/3486+Ord+Fr%c3%a5n.../Iv%c3%a4g+Till+Hemligheten/185tudent" name="search_student" />
                <input type="submit" value="Sök" />
            </form>
        </th>
    </tr>
    {if $searchresult}
    {foreach from=$searchresult key=key item=cur}
    
    <tr class="searchresult">
        <td>{$cur->fullname} {if $cur->group}<br /> {$cur->group->title}{/if} {if $cur->school}<br /> <a href="/student/list/{$cur->school->id}">{$cur->school->title}</a>{/if}</td>
        <td style="width: 96px; text-align: center; color: darkgray; font-size: smaller;" id="field_{$key|trim}" class="tooltip"></td>
        
        <td style="width: 32px;" onmouseout="$('#field_{$key|trim}').text('');" onmouseover="$('#field_{$key|trim}').text('Visa chat');"><a href="/student/chat/{$cur->id}" style="text-decoration: none;"><img src="/assets/images/discussion.png" style="vertical-align: -10px;" /> <span style="color: #666; font-size: 8pt;">{*$cur->user_chat_updated*}</span></a></td>
        <td style="width: 32px;" onmouseout="$('#field_{$key|trim}').text('');" onmouseover="$('#field_{$key|trim}').text('Visa statistik');"><a href="/student/statistics/{$cur->id}"><img src="/assets/images/stats.png" /></a></td>
        <td style="width: 32px;" onmouseout="$('#field_{$key|trim}').text('');" onmouseover="$('#field_{$key|trim}').text('Visa kalender');"><a href="/overview/{$cur->id}/{$date->year}/{$date->period}/5"><img src="/assets/images/calender.png" /></a></td>
        <td style="width: 32px;" onmouseout="$('#field_{$key|trim}').text('');" onmouseover="$('#field_{$key|trim}').text('Visa årsplanering');"><a href="/student/plan/{$cur->id}"><img src="/assets/images/time.png" /></a></td>
        <td style="width: 32px;" onmouseout="$('#field_{$key|trim}').text('');" onmouseover="$('#field_{$key|trim}').text('Ändra egenskaper');"><a href="/student/edit/{$cur->id}"><img src="/assets/images/edit.png" /></a></td>
        <td style="width: 174px; text-align: left; background: #c0c0c0; padding: 10px;">
            <form name="save_to_list" action="/ssf/save/{$cur->id}" method="post">
            <select style="width: 120px; height: 75px; border: 0px;" multiple name="lists[]">
                {foreach from=$favs key=key2 item=cur2}
                    <option value='favs_{$cur2@iteration}' {if in_array($cur2@iteration, $cur->lists)}selected{/if} >{$key2}</option>
                {/foreach}
            </select>
            <input type="submit" value="Spara" />
            </form>
        </td>
    </tr>
    {/foreach}
    {/if}
</table>
<br />
<div class="box schedules blue">
    <h1> Favoriter </h1>
</div>
<table class="box schedules favourites">
    {foreach from=$favs key=key item=cur}
    <tr>
        <th colspan="6" style="background-color: #cccccc; text-align: left; padding-left: 10px;">
            {$key}
        </th>
        <th style="background-color: #cccccc; text-align: right; padding-right: 10px;">
            <a href="/ssf/list/{$cur@iteration}">
                <img src="/assets/images/edit.png" height="20px" title="Redigera lista" />
            </a>
        </th>
    </tr>
        {foreach from=$cur key=key2 item=cur2}
            {if $cur2}
                <tr>
                    <td>
                        {$cur2->fullname}<br />
                        {$cur2->email}
                    </td>
                    <td style="width: 96px; text-align: center; color: darkgray; font-size: smaller;" id="{$cur@iteration}{$key2}" class="tooltip"></td>
                    <td style="width: 64px;" onmouseout="$('#{$cur@iteration}{$key2}').text('');" onmouseover="$('#{$cur@iteration}{$key2}').text('Visa chat');"><a href="/student/chat/{$cur2->id}" style="text-decoration: none;"><img src="/assets/images/discussion.png" style="vertical-align: -10px;" /> <span style="color: #666; font-size: 8pt;">{$cur2->user_chat_updated}</span></a></td>
                    <td style="width: 32px;" onmouseout="$('#{$cur@iteration}{$key2}').text('');" onmouseover="$('#{$cur@iteration}{$key2}').text('Visa statistik');"><a href="/student/statistics/{$cur2->id}"><img src="/assets/images/stats.png" /></a></td>
                    <td style="width: 32px;" onmouseout="$('#{$cur@iteration}{$key2}').text('');" onmouseover="$('#{$cur@iteration}{$key2}').text('Visa kalender');"><a href="/overview/{$cur2->id}/{$date->year}/{$date->period}/5"><img src="/assets/images/calender.png" /></a></td>
                    <td style="width: 32px;" onmouseout="$('#{$cur@iteration}{$key2}').text('');" onmouseover="$('#{$cur@iteration}{$key2}').text('Visa årsplanering');"><a href="/student/plan/{$cur2->id}"><img src="/assets/images/time.png" /></a></td>
                    <td style="width: 32px;" onmouseout="$('#{$cur@iteration}{$key2}').text('');" onmouseover="$('#{$cur@iteration}{$key2}').text('Ta bort från lista');"><a href="/ssf/remove/{$cur@iteration}/{$cur2->id}" onclick="return confirm('Vill du verkligen ta bort utövaren från denna lista?');"><img src="/assets/images/remove.png" /></a></td>
                </tr>
            {/if}
        {/foreach}
    {/foreach}
</table>
<br />
<div class="box schedules blue">
    <h1> Skolor <a alt="Visa statistik för grupp" href="/ssf/statistics"><img title="Visa statistik för grupp" src="/assets/images/stats.png"></a></h1>
</div>
<table class="box schedules">
    {foreach from=$schools key=key item=cur}
    <tr>
        <td>
            <a href="/student/list/{$cur->id}">{$cur->title}</a>
        </td>
        <td style="width: 32px; text-align: right; margin-right: 10px;"><a alt="Visa statistik för grupp" href="/group/statistics/33"><img title="Visa statistik för grupp" src="/assets/images/stats.png"></a></td>
    </tr>
    {/foreach}
</table>
