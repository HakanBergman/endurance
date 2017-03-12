
<div class="box schedules blue"><h1> Ta bort program </h1></div>

<form action="/schedule/delete/{$schedule->id}" class="box schedules" method="post">
    
    <p>
        Vill du verkligen ta bort {$schedule->title} och all data kopplad till detta
        program?
    </p>
    
    <p style="text-align: right;">
        <a href="/schedule/list">Avbryt</a>
        <input type="submit" name="confirm" value="Ta bort program" />
    </p>
    
</form>
