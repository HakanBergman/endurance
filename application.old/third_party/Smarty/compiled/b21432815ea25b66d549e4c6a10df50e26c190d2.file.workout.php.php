<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 08:30:09
         compiled from "application/views/pages/template/workout.php" */ ?>
<?php /*%%SmartyHeaderCode:12496768445493d401d78016-43817481%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b21432815ea25b66d549e4c6a10df50e26c190d2' => 
    array (
      0 => 'application/views/pages/template/workout.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12496768445493d401d78016-43817481',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'workouts' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5493d401db4fe1_16460635',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5493d401db4fe1_16460635')) {function content_5493d401db4fe1_16460635($_smarty_tpl) {?>
<div class="box schedules blue">

    <h1> Pass </h1>

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
    
        var row = function (info) {

        var $row = $('<tr>' +
            '<td>' + info.__string__ + ' <span style="color: #999;">' + info.__comment__ + '</span></td>' +
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
        
        var workouts = $.parseJSON('<?php echo $_smarty_tpl->tpl_vars['workouts']->value;?>
');
 
        $.each( workouts, function( key, value ) {
            workout = value;
            $('.box.schedules tbody').append(row(workout));
            
        });        

    });
</script>
<?php }} ?>