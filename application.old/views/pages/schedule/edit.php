
<div class="box blue">
    
    <h1> Ändra egenskaper </h1>
    
</div>

<form class="box" method="post" action="/schedule/edit/{$id}">
    
    <p>
        Titel: <br />
        <input type="text" name="schedule[title]" value="{$schedule->title}" />
    </p>
    
    {* Only show if the user owns the schedule *}
    {if $schedule->user_id == $pageUser->id}
    <p>
        <input type="checkbox" name="schedule[global]" {if $schedule !== false && $schedule->global} checked="checked"{/if}> Globalt program
    </p>
    {/if}
    
    <p>
        <input name="confirm" type="submit" value="Spara" />
    </p>
    
</form>
