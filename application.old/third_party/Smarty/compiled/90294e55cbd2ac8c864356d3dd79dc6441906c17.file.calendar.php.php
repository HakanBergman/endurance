<?php /* Smarty version Smarty-3.1.13, created on 2014-12-18 14:55:14
         compiled from "application/views/pages/event/calendar.php" */ ?>
<?php /*%%SmartyHeaderCode:10273080965492dcc23ffd47-03174201%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90294e55cbd2ac8c864356d3dd79dc6441906c17' => 
    array (
      0 => 'application/views/pages/event/calendar.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10273080965492dcc23ffd47-03174201',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageUser' => 0,
    'events' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5492dcc244c5b7_30310820',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5492dcc244c5b7_30310820')) {function content_5492dcc244c5b7_30310820($_smarty_tpl) {?><script>

    $(document).ready(function() {

        calendar = $('#calendar2').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            timeFormat: 'HH:mm',
            lang: 'es',
            selectable: true,
            selectHelper: true,
            firstDay: 1,
            select: function(start, end, allDay) {
                data = {};
                data.start = start;
                data.end = end;
                data.allDay = allDay;
                <?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type!="5"){?>
                openModal(data);
                <?php }?>
            },
            eventClick: function(event, element) {
                    openModal(event);
            },
            eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc) {
                if (event.editable) {
                    $.ajax({
                        url: ("/event/edit/" + event.id),
                        data: ({
                            start: event.start,
                            end: event.end,
                            allDay: event.allDay
                        }),
                        type: "POST",
                        success: function(data) {
                        },
                        error: function(xhr, status, error) {
                        }
                    });
                }
            },
            eventResize: function(event, dayDelta, minuteDelta, revertFunc) {
            
                if (event.editable) {
                    $.ajax({
                        url: ("/event/edit/" + event.id),
                        data: ({
                            start: event.start,
                            end: event.end,
                            allDay: event.allDay
                        }),
                        type: "POST",
                        success: function(data) {
                        },
                        error: function(xhr, status, error) {
                        }
                    });
                }
            },
            editable: false,
            theme: true,
            events: <?php echo $_smarty_tpl->tpl_vars['events']->value;?>

        });
    });

</script>

<div class="box blue">
    <h1>Aktivitetskalender</h1>
</div>
<div class="box" id='calendar2'></div>

<div id="eventContent" title="Event Details" style="display: none;">
    <form style="font-size: 9pt;" method="post" action="" id="eventform">
        <!--input type="hidden" id="event_start" name="start" value="" /-->
        <!--input type="hidden" id="event_end" name="end" value="" /-->
        <input type="hidden" id="event_id" name="id" value="" />
        <div style="clear: both;" class="result">
            <p class="s4">Titel <br>
                <input type="text" value="" name="title" id="event_title">
            </p>

            <p class="s4">
                Beskrivning:<br>
                <textarea name="description" id="event_description" type="text"></textarea>
            </p>

            <p class="s4">Mer info:<br>
                <input type="text" value="" name="moreinfo" id="event_url">
            </p>

            <p class="s4">Startdatum:<br>
                <input maxlength="10" type="text" class="datepicker" value="" name="start" id="event_start">
            </p>
            <p><span id="event_start_time"></span></p>
            
            <p class="s4">Slutdatum:<br>
                <input maxlength="10" type="text" class="datepicker" value="" name="end" id="event_end">
            </p>
            <p><span id="event_end_time"></span></p>

            <label><input type="checkbox" value="1" name="allDay" id="event_allday">Heldag</label>
        </div>
        <div id="event_buttons" style="overflow: auto; padding-top: 4px; clear: both; text-align: center; padding: 12px 0px;">     
            
        </div>
    </form>
</div>
<?php }} ?>