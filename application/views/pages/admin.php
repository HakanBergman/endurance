
<form action="/admin/new/user" method="post" class="box">
    
    {if isset($newuser)}
    <p>
        Användaren <a href="/user/{$newuser->id}">{$newuser}</a> tillagd.
    </p>
    {/if}
    
    <h1>
        Lägg till
        <select name="type" style="font-size: 18pt;">
            <option value="student">utövare</option>
            <option value="teacher">tränare</option>
            <option value="admin">admin</option>
        </select>
    </h1>
    
    <p>
        Fullnamn: <br />
        <input type="text" name="fullname" />
    </p>
    
    <p>
        Epost: <br />
        <input type="text" name="email" />
    </p>
    
    <p>
        Lösenord: <br />
        <input type="password" name="password" />
    </p>
    
    <p>
        <input type="submit" value="Lägg till" />
    </p>
    
</form>

{if $user->type == "admin"}
<form action="/admin/new/group" method="post" class="box">
    
    <h1>Lägg till grupp</h1>
    
    <p>
        Titel: <br />
        <input type="text" name="title" />
    </p>
    
    <p>
        <input type="submit" value="Lägg till" />
    </p>
    
</form>

<div class="box">
    
    <h1>Användare</h1>
    
    {foreach from=$users item=cur}
    <hr />
    <form action="/admin/set/group" method="post">
        
        <input type="hidden" name="user" value="{$cur->id}" />
        
        <h2>{$cur} <span style="font-size: small;">{$cur->type}</span></h2>
        
        {if $cur->type != "admin"}
        <p>
            Grupp:
            <select name="group">
                <option value="0" {if $cur->_group == 0}selected="selected"{/if}></option>
                {foreach from=$groups item=g}
                <option value="{$g->id}" {if $cur->_group == $g->id}selected="selected"{/if}>{$g}</option>
                {/foreach}
            </select>
            <input type="submit" value="Spara" />
        </p>
        {/if}
        
    </form>
    {/foreach}
</div>
{/if}
