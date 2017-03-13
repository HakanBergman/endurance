<div class="box schedules blue">
  <h1> Pass </h1>
</div>

<table class="box schedules" id="sort_workouts">
  <tbody id="sortworkouts">
    {* Fetching from controllers/template *}
    {* Why not controller/workout? TODO *}
    {foreach from=$template_workout item=cur key=key}
      {$cur|@var_dump}
      <tr class="sortable sectionsid" id="sectionsid_{$cur->group_id}">
        <td>{$cur->__string__} <span style="color: #999;">{$cur->comment}</span></td>
        <td style="width: 64px; text-align: center; color: darkgray; font-size: smaller;" class="tooltip"></td>
        <td style="width: 32px;"><img src="/assets/images/edit.png" alt="Ändra egenskaper" /></td>
        <td style="width: 32px;"><img src="/assets/images/remove.png" alt="Ta bort passet" /></td>
      </tr>');
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

