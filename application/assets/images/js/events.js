$(function() {
    $(".group-header").nextUntil('.group-header').toggle(1000);

    $(".group-header").click(function() {
        $(this).nextUntil('.group-header').toggle(1000);
        var source = $(this).find(".group-header-toggle").attr('src');
        if (source == "/assets/images/minus.png") {
            $(this).find(".group-header-toggle").prop('src', "/assets/images/plus.png");
        } else {
            $(this).find(".group-header-toggle").prop('src', "/assets/images/minus.png");
        }
    })

    $("#tabledivbody").sortable({
        items: ".sortable",
        cursor: 'move',
        opacity: 0.6,
        containment: "parent",
        update: function() {
            sendOrderToServer();
        }
    });

    function sendOrderToServer() {
        var order = $("#tabledivbody").sortable("serialize");
        $.ajax({
            type: "POST", dataType: "json", url: "/group/sort",
            data: order,
            success: function(response) {
                if (response.status == "success") {
                    window.location.href = window.location.href;
                } else {
                    alert('Some error occurred');
                }
            }
        });
    }

    $(".moveuplink").click(function() {
        $(this).parents(".sectionsid").insertBefore($(this).parents(".sectionsid").prev());
        sendOrderToServer();
    });
    $(".movedownlink").click(function() {
        $(this).parents(".sectionsid").insertAfter($(this).parents(".sectionsid").next());
        sendOrderToServer();
    });
});

function replaceCharacters(TextString) {

    var diakrit = ['å', 'ä', 'ö'];
    var amp = ['a', 'a', 'o'];

    for (i = 0; diakrit[i]; i++) {
        TextString = TextString.replace(new RegExp(diakrit[i], "gi"), amp[i]).replace(/\s+/g, '-').toLowerCase();
    }

    return TextString;

}

function mysqlTimeStampToDate(timestamp) {
    //function parses mysql datetime string and returns javascript Date object
    //input has to be in this format: 2007-06-05 15:26:02
    var regex = /^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
    var parts = timestamp.replace(regex, "$1 $2 $3 $4 $5 $6").split(' ');
    return new Date(parts[0], parts[1] - 1, parts[2], parts[3], parts[4], parts[5]);
}


function openModal(data) {

    data = data || false;

    if (data) {

        if (data.start) {
            $("#event_start").val(data.start);
        } else {
            $("#event_start").val("");
        }

        if (data.end) {
            $("#event_end").val(data.end);
        } else {
            $("#event_end").val("");
        }

        if (data.id) {
            $("#event_id").val(data.id);
        } else {
            $("#event_id").val("");
        }

        if (data.title) {
            title = data.title;
            $("#event_title").val(data.title);
        } else {
            title = "Redigera aktivitet";
            $("#event_title").val("");
        }
        if (data.description) {
            $("#event_description").val(data.description);
        } else {
            $("#event_description").val("");
        }

        if (data.allDay) {
            $("#event_allday").prop('checked', true);
        } else {
            $("#event_allday").prop('checked', false);
        }

        if (data.moreinfo) {
            $("#event_url").val(data.moreinfo);
        } else {
            $("#event_url").val("");
        }

        if (!(data.start instanceof Date)) {
            data.start = mysqlTimeStampToDate(data.start);
            data.end = mysqlTimeStampToDate(data.end);
        }

        if (data.start) {

            var year = data.start.getFullYear(), month = (data.start.getMonth() + 1), day = data.start.getDate(), hours = data.start.getHours(), minutes = data.start.getMinutes();
            if (month < 10)
                month = "0" + month;
            if (day < 10)
                day = "0" + day;
            if (hours < 10)
                hours = "0" + hours;
            if (minutes < 10)
                minutes = "0" + minutes;

            var properlyFormatted = "" + year + "-" + month + "-" + day;

            $("#event_start").val(properlyFormatted);
            if (!data.allDay) {
                $("#event_start_time").html("Starttid: " + hours + ":" + minutes);
            } else {
                $("#event_start_time").html("");
            }
        } else {
            $("#event_start").val("");
            $("#event_start_time").html("");
        }

        if (data.end) {
            var year = data.end.getFullYear(), month = (data.end.getMonth() + 1), day = data.end.getDate(), hours = data.end.getHours(), minutes = data.end.getMinutes();
            if (month < 10)
                month = "0" + month;
            if (day < 10)
                day = "0" + day;
            if (hours < 10)
                hours = "0" + hours;
            if (minutes < 10)
                minutes = "0" + minutes;

            var properlyFormatted = "" + year + "-" + month + "-" + day;

            $("#event_end").val(properlyFormatted);
            if (!data.allDay) {
                $("#event_end_time").html("Sluttid: " + hours + ":" + minutes);
            } else {
                $("#event_end_time").html("");
            }
        } else {
            $("#event_end").val("");
            $("#event_end_time").html("");
        }

        id = data.id || false;
        if (id) {
            $("#eventform").attr("action", "/event/edit/" + data.id);
        } else {
            $("#eventform").attr("action", "/event/add/");
        }
    }
    else {
        title = "Skapa aktivitet";
    }



    if (data.editable === false) {
        $("#event_allday").prop('disabled', true);
        $('#event_start').prop('readonly', true);
        $('#event_end').prop('readonly', true);
        $('#event_url').prop('readonly', true);
        $('#event_description').prop('readonly', true);
        $('#event_title').prop('readonly', true);
        var buttons = $("#eventContent").find(".button");
        buttons.remove();

        $("#event_start").datepicker("destroy");
        $("#event_end").datepicker("destroy");

    } else {
        $("#event_allday").prop('disabled', false);
        $('#event_start').prop('readonly', false);
        $('#event_end').prop('readonly', false);
        $('#event_url').prop('readonly', false);
        $('#event_description').prop('readonly', false);
        $('#event_title').prop('readonly', false);
        var buttons = "<a style='margin: 0px 16px;' onclick='deleteEvent($(this).closest(\"form\"));' class='button reject'>Ta bort</a>";
        buttons += "<a style='margin: 0px 16px;' onclick='submitEvent($(this).closest(\"form\"));' class='button accept'>Spara</a>";
        $("#event_buttons").html(buttons);

        $("#event_start").datepicker({
            defaultDate: data.start,
            changeMonth: true,
            numberOfMonths: 1,
            firstDay: 1,
            dateFormat: "yy-mm-dd",
            onClose: function(selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#event_end").datepicker({
            defaultDate: data.end,
            changeMonth: true,
            numberOfMonths: 1,
            firstDay: 1,
            dateFormat: "yy-mm-dd",
            onClose: function(selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    }

    $("#eventContent").dialog({
        modal: true,
        resizable: false,
        width: 440,
        title: title
    });

}

function addEvents(events, rowclass, colorcode) {
    $.each(events, function(key, event) {
        addEvent(event, rowclass, colorcode);
    });
}

function addEvent(event, rowclass, colorcode) {

    $.each(event.formatted_dates, function(key, week) {
        var numdays = week.length;

        $.each(week, function(key2, date) {

            var cssclass = '.' + replaceCharacters(date);

            if (key2 === 0) {

                var eventid = 'event_' + event.id;

                //Skapa event
                var eventObject = '<div title="' + event.title + '" class="' + eventid + ' eventitem" style="border-right-color: ' + colorcode + ';"><span style="float: left;">' + event.title + '</span><span style="float: right; color: #666;"></span><span style="clear: both; float: left; color: #666; font-size: 7pt;"></span></div>';
                var $jQueryObject = $($.parseHTML(eventObject));
                //Lägg till event i utförande
                $('.performance .' + rowclass + ' ' + cssclass).append($jQueryObject);

                $("." + eventid).click(function() {
                    openModal(event);
                });

                var colsleft = $('.performance .' + rowclass + ' .' + eventid).parent().nextAll().length + 1;
                if ((numdays + 1) <= colsleft) {
                    $('.performance .' + rowclass + ' ' + cssclass).attr('colspan', (numdays));

                } else {
                    $('.performance .' + rowclass + ' ' + cssclass).attr('colspan', colsleft);
                }

            } else {
                $('.performance .' + rowclass + ' ' + cssclass).remove();
            }
        });
    });

}

function setHeight() {

    var scheduler_plan = $(".scheduler-plan");
    var scheduler_result = $(".scheduler-result");

    $.each(scheduler_plan, function(key, plan) {

        rowheight = $(this).find(".ssf_events").height();
        $(scheduler_result[key]).find(".ssf_events").height(rowheight);

        rowheight = $(this).find(".school_events").height();
        $(scheduler_result[key]).find(".school_events").height(rowheight);

        rowheight = $(this).find(".user_events").height();
        $(scheduler_result[key]).find(".user_events").height(rowheight);

    });

}

function submitEvent(form) {
    var data = form.serialize();
    $.ajax({
        url: form.attr('action'),
        data: data,
        type: "POST",
        success: function(data) {
            window.location.reload();
        },
        error: function(xhr, status, error) {
        }
    });
}

function deleteEvent(form) {
    var data = form.serialize();
    $.ajax({
        url: "/event/delete/" + $('#event_id').val(),
        data: data,
        type: "POST",
        success: function(data) {
            window.location.reload();
        },
        error: function(xhr, status, error) {
        }
    });
}