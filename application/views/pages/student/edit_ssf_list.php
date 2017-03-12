
<div class="box blue">

    <h1> Ändra egenskaper </h1>

</div>

<form class="box" method="post" action="/ssf/list/{$listIndex}">

    <p>
        Listans namn: <br />
        <input type="text" name="list_title" value="{$listTitle}" />
    </p>

    <p>
        <input name="confirm" type="submit" value="Spara" />
    </p>

</form>
