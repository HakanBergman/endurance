
<div class="box blue">

    <h1> Lägg till extern tränare </h1>

</div>

<form class="box" method="post" action="/external/add">

    {if isset($coach)}
        {if count($coach) != 0 && count($user_coaches) == 0} 
        <p>Det finns en användare med denna e-post:
        {$coach->fullname} {$coach->email}</p>
        <p>
        Vill du koppla denna användare som extern tränare?
        </p>
        <p>
            <input type="hidden" value="{$coach->email}" name="coach_email" />
            <input type="hidden" value="save_coach" name="save_coach" />
            <input type="submit" value="Ok" name="confirm" /> 
            <input type="button" onClick="javascript:window.location.href='/student/coaches/{$userid}'" value="Avbryt" name="confirm" />
        </p>
        {else if count($user_coaches) > 0}
        Denna användare är redan kopplad som extern tränare.
        <input type="button" onClick="javascript:window.location.href='/student/coaches/{$userid}'" value="Avbryt" name="confirm" />
        {else}
        Det finns ingen användare med denna e-post.
        <input type="button" onClick="javascript:window.location.href='/student/coaches/{$userid}'" value="Avbryt" name="confirm" />
        {/if}
    {else}
        <p>
            Epost: <br />
            <input type="text" name="coach_email" />
        </p>
        <p>
            <input type="submit" value="Spara" name="confirm" />
        </p>
    {/if}
    

</form>
