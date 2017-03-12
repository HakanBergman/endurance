
<div class="box blue">

    <h1> Ändra egenskaper </h1>

</div>

<form class="box" method="post" action="/student/edit/{$id}">

    <p>
        Fullständigt namn: <br />
        <input type="text" name="student[fullname]"{if $student} value="{$student->fullname}"{/if} />
    </p>


    <p>
        Epost: <br />
        <input type="text" name="student[email]"{if $student} value="{$student->email}"{/if} />
    </p>

    <p>
        Nytt Lösenord: <br />
        <input type="text" name="student[password]" value="" />
    </p>


    <p {if $pageUser->type == "150"}style="display: none;"{/if}>
        Grupp: <br />
        <select name="student[group_id]">
            {foreach from=$groups item=g}<option value="{$g->id}"{if $student && $student->user_groups.0->group_id == $g->id} selected="selected"{/if}>{$g->title}</option>{/foreach}
        </select>
    </p>

    <p>
        <input name="confirm" type="submit" value="Spara" />
    </p>

</form>
