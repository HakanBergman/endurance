
<div class="box blue">
    
    <h1>Chat för {$student->fullname}</h1>
</div>

<form class="box" method="post" action="/student/chat/{$student->id}">
    
    <p>
        Senast uppdaterad: {if $chat}{$chat->updated}{else}aldrig{/if}
    </p>
    
    <p>
        <textarea name="text" style="width: 100%;" rows="24">{if $chat}{$chat->text}{/if}</textarea>
    </p>
    
    <p>
        <input type="submit" value="Spara" />
    </p>
    
</form>
