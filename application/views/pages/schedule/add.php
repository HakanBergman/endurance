
<div class="box blue">
    
    <h1> Lägg till program </h1>
    
</div>

<form class="box" method="post" action="/schedule/add">
    
    <p>
        Titel: <br />
        <input type="text" name="schedule[title]" />
    </p>
    
    <p>
        <input type="checkbox" name="schedule[global]" {if $schedule !== false && $schedule->global} checked="checked"{/if}> Globalt program
    </p>
    
    <p>
        <input name="confirm" type="submit" value="Spara" />
    </p>
    
</form>
