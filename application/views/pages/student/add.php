
<div class="box blue">

    <h1> Lägg till utövare </h1>

</div>

<form class="box" method="post" action="/student/add">

    <p>
        Fullständigt namn: <br />
        <input type="text" name="student[fullname]" />
    </p>


    <p>
        Epost: <br />
        <input type="text" name="student[email]" />
    </p>

    <p>
        Nytt Lösenord: <br />
        <input type="password" name="student[password]" value="" />
    </p>


    <p>
        Grupp: <br />
        <select name="student[group_id]">
            {foreach from=$groups item=g}
            <option value="{$g->group_id}">{$g->title}</option>
            {/foreach}
        </select>
    </p>

    <p>
        <input type="submit" value="Spara" name="confirm" />
    </p>

</form>
