
<div class="box blue">

    <h1>Kopia av {$schedule->title}</h1>
</div>

<form class="box" method="post" action="/schedule/duplicate/add/{$schedule->id}">

    <p>
        Titel: <br />
        <input type="text" name="schedule[title]"{if $schedule} value="{$schedule->title}"{/if} />
        <input type="hidden" name="schedule[id]" value="{$id}" />
    </p>

    <p>
        <input type="submit" value="Spara" />
    </p>

</form>
