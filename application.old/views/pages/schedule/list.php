<div class="box schedules blue">
    <h1> Alla program </h1>
</div>

<table class="box schedules">
    <tr>
        <tr><td colspan="7" style="padding-top: 12px; background: #136; color: white;">Skapade av mig</td></tr>
    </tr>
    {foreach from=$my_schedules item=cur key=key}
        <tr>
            <td>{$cur->title}</td>
            <td style="width: 64px; text-align: center; color: darkgray; font-size: smaller;" class="tooltip"></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Kopiera till utövare');"><a href="/schedule/assign/{$cur->id}"><img src="/assets/images/assign.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Duplicera program');"><a href="/schedule/duplicate/{$cur->id}"><img src="/assets/images/edit-copy.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Visa kalender');"><a href="/schedule/calendar/{$cur->id}/5"><img src="/assets/images/calender.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Ändra egenskaper');"><a href="/schedule/edit/{$cur->id}"><img src="/assets/images/edit.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Ta bort programmet');"><a href="/schedule/delete/{$cur->id}"><img src="/assets/images/remove.png" /></a></td>
        </tr>
    {/foreach}

    <tr>
        <tr><td colspan="7" style="padding-top: 12px; background: #136; color: white;">Skapade av andra</td></tr>
    </tr>
    {foreach from=$others_schedules item=cur key=key}
        {if ($cur->global == 1)}
        <tr>
            <td>{$cur->title}</td>
            <td style="width: 64px; text-align: center; color: darkgray; font-size: smaller;" class="tooltip"></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Kopiera till utövare');"><a href="/schedule/assign/{$cur->id}"><img src="/assets/images/assign.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Duplicera program');"><a href="/schedule/duplicate/{$cur->id}"><img src="/assets/images/edit-copy.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Visa kalender');"><a href="/schedule/calendar/{$cur->id}/5"><img src="/assets/images/calender.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Ändra egenskaper');"><a href="/schedule/edit/{$cur->id}"><img src="/assets/images/edit.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Ta bort programmet');"><a href="/schedule/delete/{$cur->id}"><img src="/assets/images/remove.png" /></a></td>
        </tr>
        {/if}
    {/foreach}

    <tr>
        <td colspan="6">
            <a href="/schedule/add">
                Lägg till program
            </a>
        </td>
    </tr>
</table>
