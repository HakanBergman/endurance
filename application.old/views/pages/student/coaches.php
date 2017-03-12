
<div class="box coaches blue">

    <h1> Mina externa tränare </h1>

</div>

<table class="box coaches">
    <tbody>
        {if count($coaches) == 0}
            <tr>
                <td>Du har inga externa tränare.</td>
            </tr>
        {else}
            {foreach from=$coaches key=key item=cur}
            <tr>
                <td>{$cur->fullname} - {$cur->email}</td>
                <td><a href="/external/delete_external_coach/{$cur->id}" onclick="return confirm('Vill du verkligen ta bort {$cur->fullname} som extern tränare?')">Ta bort</a></td>
            </tr>
            {/foreach}
        {/if}
        <tr class="group-header">
        <td style="background-color: #cccccc;" colspan="2">
            <a href="/external/add">
                Lägg till extern tränare
            </a>
        </td>
    </tr>
    </tbody>
</table>
