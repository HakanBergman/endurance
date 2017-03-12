 
<div class="box schedules blue">

    <h1> Tränare </h1>

</div>

<table class="box schedules">

    {foreach from=$schools key=key item=school}
    <tr>
        <th style="background-color: #cccccc;" colspan="5">{$school->title}</th>
    </tr>
    {if isset($school->school_teachers)}
        {foreach from=$school->school_teachers key=key item=cur}

        <tr>
            <td>{$cur->fullname}</td>
            <td style="width: 64px; text-align: center; color: darkgray; font-size: smaller;" class="tooltip"></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq().text('');" onmouseover="$('.tooltip').eq().text('Ändra lösenord');"><a href="/teacher/password/{$cur->user_id}"><img src="/assets/images/password.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq().text('');" onmouseover="$('.tooltip').eq().text('Ändra egenskaper');"><a href="/teacher/edit/{$cur->user_id}"><img src="/assets/images/edit.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('.tooltip').eq().text('');" onmouseover="$('.tooltip').eq().text('Ta bort tränaren');"><a href="/teacher/delete/{$cur->user_id}"><img src="/assets/images/remove.png" /></a></td>
        </tr>
        {/foreach}
    {/if}

    {/foreach}

    <tr>
        <td colspan="5" style="background-color: #cccccc;">
            <a href="/teacher/edit/add">
                Lägg till tränare
            </a>
        </td>
    </tr>

</table>
