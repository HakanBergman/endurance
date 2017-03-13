<div class="box schedules blue">
  <h1> Pass </h1>
</div>

<table class="box schedules" id="sort_workouts">
  <tbody id="sortworkouts">
    {* Fetching from controllers/template *}
    {* Why not controller workout? TODO *}
    {$workouts|@var_dump}   
    {$workouts[1]}
    {foreach from=$workouts item=cur key=key}
    <tr class="sortable sectionsid" id="sectionsid_{$cur->group_id}">
        <td>{$cur->title}</td>
        <td style="width: 64px; text-align: center; color: darkgray; font-size: smaller;" class="tooltip"></td>
        <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Ändra egenskaper');">
          <a href="/group/edit/{$cur->group_id}">
            <img src="/assets/images/edit.png" />
          </a>
        </td>
        <td style="width: 32px;" onmouseout="$('.tooltip').eq({$key}).text('');" onmouseover="$('.tooltip').eq({$key}).text('Ta bort gruppen');">
          <a href="/group/delete/{$cur->group_id}">
            <img src="/assets/images/remove.png" />
          </a>
        </td>
        <td style="width: 42px;">
          <img src="/assets/images/down.png" class="movedownlink" />&nbsp;&nbsp;<img src="/assets/images/up.png" class="moveuplink" />
        </td>
      </tr>
    {/foreach}
  </tbody>
  <tfoot>
    <tr>
      <td colspan="4" style="background-color: #cccccc;">
        <button>Lägg till pass</button>
      </td>
    </tr>
  </tfoot>
</table>

