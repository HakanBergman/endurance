
<div class="box blue schedules">
    <h1>Ta bort grupp</h1>
</div>

{if $students}
<div class="box schedules">
    
    <h2>Du kan inte ta bort denna grupp.</h2>
    
    <p>
        Följande utövare finns kopplade till denna grupp, koppla dessa till en
        annan grupp om du vill ta bort denna grupp.
    </p>
    
    <ul>
        {foreach from=$students item=student}<li>{$student->fullname}</li>{/foreach}
    </ul>
    
</div>
{else}
<form action="/group/delete/{$group->id}" class="box schedules" method="post">
    
    <p>
        Vill du verkligen ta bort gruppen {$group->title}?
    </p>
    
    <p style="text-align: right;">
        <a href="/group/list">Avbryt</a>
        <input type="submit" name="confirm" value="Ta bort grupp" />
    </p>
    
</form>
{/if}
