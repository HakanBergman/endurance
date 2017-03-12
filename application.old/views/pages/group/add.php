<div class="box blue">

    <h1> Lägg till grupp </h1>

</div>

<form class="box" method="post" action="/group/add">

    <p>
        Titel: <br />
        <input type="text" name="group[title]" value="" />
    </p>

    {include file="snippets/plan.php"}

    <p>
        <a href="/group/list">Avbryt</a> <input type="submit" value="Spara" />
    </p>

</form>
