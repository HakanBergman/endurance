<script>

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
                {if $pageUser->type != "5"}
                openModal(data);
                {/if}
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
            events: {$events}
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
