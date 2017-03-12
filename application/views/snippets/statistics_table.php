<div style="overflow: auto; padding: 15px;">
<table class="statistics">
<tbody>
<tr>
    <th>Säsong</th>
    {foreach from=$yeartable item=item}
        <td>{$item.0}</td>
    {/foreach}
</tr>
<tr>
    <td>Styrka</td>
    {foreach from=$yeartable item=item}
        <td>{$item.5}</td>
    {/foreach}
</tr>
<tr>
    <td>A3+</td>
    {foreach from=$yeartable item=item}
        <td>{$item.4}</td>
    {/foreach}
</tr>
<tr>
    <td>A3</td>
    {foreach from=$yeartable item=item}
        <td>{$item.3}</td>
    {/foreach}
</tr>
<tr>
    <td>A2</td>
    {foreach from=$yeartable item=item}
        <td>{$item.2}</td>
    {/foreach}
</tr>
<tr>
    <td>A1</td>
    {foreach from=$yeartable item=item}
        <td>{$item.1}</td>
    {/foreach}
</tr>
<tr>
    <th>Totaltid:</th>
    {foreach from=$yeartable item=item}
        <td>{$item.8}</td>
    {/foreach}
</tr>
<tr>
    <th>Planerad tid:</th>
    {foreach from=$yeartable item=item}
        <td>{$item.7}</td>
    {/foreach}
</tr>
<tr>
    <td>Form</td>
    {foreach from=$yeartable item=item}
        <td>{$item.6}</td>
    {/foreach}
</tr>
<tr>
    <td>Sjuk</td>
    {foreach from=$yeartable item=item}
        <td>{$item.9}</td>
    {/foreach}
</tr>
<tr>
    <td>Skada</td>
    {foreach from=$yeartable item=item}
        <td>{$item.10}</td>
    {/foreach}
</tr>
<tr>
    <td>Vila</td>
    {foreach from=$yeartable item=item}
        <td>{$item.11}</td>
    {/foreach}
</tr>
<tbody>
</table>
</div>