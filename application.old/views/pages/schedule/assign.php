<form action="/schedule/assign/{$schedule->id}" method="post">
    
    <div class="box schedules blue"><h1> Kopiera program: {$schedule->title} </h1></div>
    
    <table class="box schedules" id="users">
        
        {if $action == "select"}
        
        {foreach from=$users key=key item=group}
        <tr class="group" style="background-color: lightgray;">
            <td style="width: 32px;"><input type="checkbox" id="g{$group->id}" /></td>
            <td colspan="2"><label for="g{$group->id}">{$group->title}</label></td>
        </tr>
            {foreach from=$group->users key=key2 item=user}
                {if $user->active}
                    <tr class="user">
                        <td style="width: 32px;"><input type="checkbox" name="users[]" value="{$user->user_id}" id="u{$user->user_id}" /></td>
                        <td colspan="2"><label for="u{$user->user_id}">{$user->fullname}</label></td>
                    </tr>
                {/if}
            {/foreach}
        {/foreach}
        
        {elseif $action == "confirm"}
        
        {foreach from=$users item=user}
        <tr class="user">
            <td>{$user->fullname} {if $user->count > 0}<span style="color: #999;">({$user->count} pass finns redan sparat)</span>{/if}</td>
            {if $user->count == 0}
            <td colspan="2">
                <input type="hidden" name="tasks[{$user->id}]" value="insert" />
            </td>
            {else}
            <td style="width: 96px;">
                <label><input type="radio" name="tasks[{$user->id}]" value="insert" checked="checked" /> Lägg till </label>
            </td>
            <td style="width: 96px;">
                <label><input type="radio" name="tasks[{$user->id}]" value="replace" /> Skriv över </label>
            </td>
            {/if}
        </tr>
        {/foreach}
        
        {/if}
        
        <tr class="group">
            <td colspan="3" style="text-align: right">
                {if isset($date)}
                
                <input type="hidden" name="date" value="{$date->year}-{$date->period}" />
                {$date->year}/{($now->year + 1)|substr:2:3} Period {$date->period + 1} (v. {$date->week(0)->newGregorian()} - {$date->week(3)->newGregorian()})
                
                {else}
                
                <select name="date">
                {for $i=$now->period-3 to $now->period+13}                    
                    <option value="{if $i < 0}{math equation='x - y' x=$now->year y=1}-{math equation='(x + y)' x=13 y=$i}{elseif $i > 12}{math equation='x + y' x=$now->year y=1}-{math equation='(y - x)' x=13 y=$i}{else}{$now->year}-{$i}{/if}">
                    
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
                    {if $i < 0}
                        P. {(13+$i)+1}
                    {elseif $i > 12}
                        P. {($i-13)+1}
                    {else}
                        P. {($i)+1}
                    {/if}
                    (v. 
                    {* veckonummer *}
                    {if $i < 0}
                        {(Period::to_date($year, (13+$i), 0))|date_format:"%V"} - {(Period::to_date($year, (13+$i), 3))|date_format:"%V"}
                    {elseif $i > 12}
                        {(Period::to_date($year, ($i-13), 0))|date_format:"%V"} - {(Period::to_date($year, ($i-13), 3))|date_format:"%V"}
                    {else}
                        {(Period::to_date($year, ($i), 0))|date_format:"%V"} - {(Period::to_date($year, ($i), 3))|date_format:"%V"}
                    {/if}
                    
                    )
                </option>
             {/for}
            </select>
                {/if}
                <input type="submit" value="Kopiera till utövare"/>
            </td>
        </tr>
        
    </table>
    
</form>

{if $action == "select"}
<script type="text/javascript">
    $(function () {
        
        var updateui = function () {
            var l = $('#users .user input[type=checkbox]:checked').length;
            
            if(l == 0) {
                $('#users input[type=submit]').attr('disabled', true);
            } else {
                $('#users input[type=submit]').attr('disabled', false);
            }
            
        };
        
        $('#users .group input[type=checkbox]').change(function () {
            $(this).parent().parent().nextUntil('.group').find('input').attr("checked", $(this).attr("checked"));
        });
        
        $('#users input[type=checkbox]').change(updateui);
        
        updateui();
        
    });
</script>
{/if}
