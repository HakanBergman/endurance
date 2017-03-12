<div class="box schedules blue">
  <h1> Pass </h1>
</div>

<table class="box schedules" id="sort_workouts">
  <tbody id="sortworkouts">
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

<script type="text/javascript">
    
        var row = function (info) {

        var $row = $('<tr class="sortable sectionsid" id="sectionsid_{$cur->group_id}">' +
            '"<td>' + info.__string__ + ' <span style="color: #999;">' + info.__comment__ + '</span></td>' +
            '<td style="width: 64px; text-align: center; color: darkgray; font-size: smaller;" class="tooltip"></td>' +
            '<td style="width: 32px;" onmouseout="' + "$(this).parent().find('.tooltip').text('');" + '" onmouseover="' + "$(this).parent().find('.tooltip').text('Ändra egenskaper');" + '"><img src="/assets/images/edit.png" /></td>' +
            '<td style="width: 32px;" onmouseout="' + "$(this).parent().find('.tooltip').text('');" + '" onmouseover="' + "$(this).parent().find('.tooltip').text('Ta bort passet');" + '"><img src="/assets/images/remove.png" /></td>' +
        '</tr>');
        
        $row.find('td').eq(2).popup({
            id: 'edit/' + info.workout_id,
            type: 'template_workout',
            title: info.__string__,
            submit: function () {
                this.find('img').attr('src', '/assets/images/load-medium.gif');
            },
            success: function (data) {
                if(data) { $row.replaceWith(row(data)); }
                else { $row.remove(); }
            },
            done: function () {
                this.find('img').attr('src', '/assets/images/edit.png');
            }
        });
        
        $row.find('td').eq(3).click(function () {
            
            if(!window.confirm("Är du säker på att du vill ta bort detta pass?")) {
                
                return ;
            }
            
            $(this).find('img').attr('src', '/assets/images/load-medium.gif');

            $.ajax({
                type: 'POST',
                url: '/popup/template_workout/delete/' + info.workout_id,
                data: { },
                dataType: 'json',
                success: function (data) {
                    location.reload();
                }
            });
            
        });
        
        return $row;
    };
    
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
