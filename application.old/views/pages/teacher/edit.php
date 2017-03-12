
<div class="box blue">
    
    <h1> Ändra egenskaper </h1>
    
</div>

<form class="box" method="post" action="/teacher/edit/{$id}">
    
    <p>
        Fullständigt namn: <br />
        <input type="text" name="teacher_fullname" value="{$teacher->fullname}" />
    </p>
    
    <p>
        Epost: <br />
        <input type="text" name="teacher_email" value="{$teacher->email}" />
    </p>
    
    <p>
        <input type="submit" value="Spara" />
    </p>
    
</form>
