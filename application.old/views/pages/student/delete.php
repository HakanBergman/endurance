
<div class="box schedules blue"><h1> Ta bort utövare </h1></div>

<form action="/student/delete/{$student->id}/{$group_id}" class="box schedules" method="post">
    
    <p>
        Vill du verkligen ta bort {$student->fullname}?
    </p>
    
    <p style="text-align: right;">
        <a href="/student/list">Avbryt</a>
        <input type="submit" name="confirm" value="Ta bort utövare" />
    </p>
    
</form>
