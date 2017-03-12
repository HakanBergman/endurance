
<div class="box blue">
    
    <h1> Lägg till tränare </h1>
    
</div>

<form class="box" method="post" action="/teacher/edit/add">
    
    Hör till skola:
    <select name="teacher_school">
        {foreach from=$schools key=key item=school}
        <option value="{$school->id}">{$school->title}</option>
        {/foreach}
    </select>
    
    <p>
        Fullständigt namn: <br />
        <input type="text" name="teacher_fullname" value="" />
    </p>
    
    <p>
        Epost: <br />
        <input type="text" name="teacher_email" value="" />
    </p>
    
    <p>
        <input type="submit" value="Spara" />
    </p>
    
</form>
