
<div class="box blue">
    
    <h1> Ändra lösenord: {$teacher->fullname} </h1>
    
</div>

<form class="box" method="post" action="/teacher/password/{$teacher->id}">
    
    <p>
        Nytt lösenord: <br />
        <input type="text" name="password" />
    </p>
    
    <p>
        <input type="submit" value="Spara" />
    </p>
    
</form>
