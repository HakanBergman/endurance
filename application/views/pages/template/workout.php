<div class="box schedules blue">
  <h1> Pass </h1>
</div>

<table class="box schedules" id="sort_groups">
  <tbody id="tabledivbody">
    {foreach from=$groups item=cur key=key}
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



<div class="box schedules blue">

    <h1> Pass2 </h1>

</div>

<table class="box schedules">
    <tbody></tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="background-color: #cccccc;">
                <button>Lägg till pass</button>
            </td>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    
    $(function () {
        
        $('.box.schedules button').popup({
            id: 'add',
            type: 'template_workout',
            title: "Nytt pass",
            success: function (data) {
                location.reload();
            }
        });
        
        var workouts = $.parseJSON('{$workouts}');
 
        $.each( workouts, function( key, value ) {
            workout = value;
            $('.box.schedules tbody').append(row(workout));
            
        });        

    });
</script>
