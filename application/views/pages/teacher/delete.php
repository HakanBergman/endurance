
<div class="box schedules blue"><h1> Ta bort tränare </h1></div>

<form action="/teacher/delete/{$teacher->id}" class="box schedules" method="post">
    <input type="hidden" name="delete_teacher" value="delete_teacher" />
    <p>
        Vill du verkligen ta bort {$teacher->fullname} och all data kopplad till denna
        tränare?
    </p>
    
    <p style="text-align: right;">
        <a href="/teacher/list">Avbryt</a>
        <input type="submit" name="confirm" value="Ta bort tränare" />
    </p>
    
</form>
