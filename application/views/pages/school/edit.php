
<div class="box blue">
    
    <h1> Ändra egenskaper </h1>
    
</div>

<form class="box" method="post" action="/school/edit/{$id}">
    
    <p>
        Titel: <br />
        <input type="text" name="school_title" value="{$school->title}" />
    </p>

    <p>
        <input type="submit" value="Spara" />
    </p>
    
</form>
