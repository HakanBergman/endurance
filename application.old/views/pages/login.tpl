
<form action="/login" method="post" class="box" style="width: 256px;">
    
    {if isset($error)}
    <p style="color: red;">
        Fel användarnamn eller lösenord.
    </p>
    {/if}
    
    <p>
        Epost: <br />
        <input type="text" name="mail" />
    </p>
    
    <p>
        Lösenord: <br />
        <input type="password" name="pass" />
    </p>
    
    <p>
        <input type="submit" value="Logga in" />
    </p>
    
</form>
