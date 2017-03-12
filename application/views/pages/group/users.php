
<div class="box schedules blue">
    
    <h1> Elever i gruppen: {$group} </h1>
    
</div>

<table class="box schedules">
    
    {foreach from=$users key=key item=cur}
    <tr>
        {if $cur->type == "teacher"}
        <td colspan="3" style="background-color: #cccccc;">{$cur}<span class="tooltip"></span></td>
        {elseif $cur->type == "student"}
        <td>{$cur}</td>
        <td style="width: 64px; text-align: center; color: darkgray; font-size: smaller;" class="tooltip"></td>
        <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Ändra egenskaper');"><a href="/student/edit/{$cur->id}"><img src="/img/edit.png" /></a></td>
        {*<td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Ta bort utövare');"><a href="/group/users/{$group->id}/delete/{$cur->id}"><img src="/img/remove.png" /></a></td>*}
        {/if}
    </tr>
    {/foreach}
    <tr>
        <td colspan="2" style="background-color: #cccccc;">
            <form action="/group/users/{$group->id}/add" method="post" id="adduser">
                <input type="text" name="user" style="width: 256px;" />
            </form>
        </td>
        <td style="background-color: #cccccc;"><img src="/assets/images/add.png" onclick="$('#adduser').submit()" /></td>
    </tr>
</table>

<script type="text/javascript">
    
    $('#adduser input[name=user]').autocomplete({
        source: "autocomplete,user"
    });
    
</script>
