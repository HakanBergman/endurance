
(function($) {

    var update_summary = function($parent) {
        var total = [0, 0, 0, 0, 0, 0, 0];
        
        week = $parent.data('scheduler').week;
        
        if(week === 5) {
            
            total = 0;
            
            $parent.siblings().each(function(key) { 
                $(this).find('tr.week td .workout').each(function(key) {
                    
                    var t = $(this);
                    
                    if (t.data('info')['__duration__']) {
                        total += parseInt(t.data('info')['__duration__']);
                    }
                }); 
            });
            
            for (var i = 0; i < 7; i++) {
                $parent.find('tr td.summary').eq(i).duration(total);
            }
            $($parent.data('scheduler').summary).duration(total);
            
            
            
        } else {
            $parent.find('tr.week td .workout').each(function(key) {
                var t = $(this);
                if (t.data('info')['__duration__']) {
                    total[t.parent().data('day') % 7] += parseInt(t.data('info')['__duration__']);
                }
            });

            for (var i = 0; i < 7; i++) {
                $parent.find('tr td.summary').eq(i).duration(total[i]);
            }

            total = total[0] + total[1] + total[2] + total[3] + total[4] + total[5] + total[6];
            $($parent.data('scheduler').summary).duration(total);
        }

    };

    var update_summary_overview = function() {
        
        sumtotal = 0;
        for (var j = 1; j < 5; j++) {
            var total = [0, 0, 0, 0, 0, 0, 0];
            $parent = $('#scheduler' + j);
            $parent.find('tr.week td .workout').each(function(key) {
                var t = $(this);
                
                if (t.data('info')['__duration__']) {
                    
                    total[t.parent().data('day') % 7] += parseInt(t.data('info')['__duration__']);
                }
            });

            for (var i = 0; i < 7; i++) {
                $parent.find('tr td.summary').eq(i).duration(total[i]);
            }

            total = total[0] + total[1] + total[2] + total[3] + total[4] + total[5] + total[6];
            sumtotal += total;
            

        }
        $($parent.data('scheduler').summary).duration(sumtotal);
        
    }

    var methods = {
        init: function(options) {

            options = $.extend({
                'posturl': '',
                'weekdays': [],
                'segments': [],
                'week': 0,
                'type': 'schedule',
                'trash': null,
                'summary': '#duration_week',
                'overview': false
            }, options);
            
            week = 0;

            this.each(function() {

                var i, tr, td;
                var $parent = $(this);
                var $table = $('<table />');

                $parent.data('scheduler', options);

                $table.addClass('scheduler');
                $table.append('<col class="segment" span="1" />');
                
                tr = $('<tr />');
                tr.append('<th />');
                for (i in options.weekdays) {
                    tr.append('<th>' + options.weekdays[i] + '</th>');
                }

                $table.append(tr);

                /** Event calendar **/
                tr = $('<tr />');
                tr.append('<td />');
                for (i in options.weekdays) {
                    tr.append('<td class="day_'+i+' '+replaceCharacters(options.weekdays[i])+'"></td>');
                }
                tr.addClass('event_calendar');
                tr.addClass('ssf_events');
                $table.append(tr);
                $table.append('<tr class="event_calendar"><td colspan="8"><hr /></td></tr>');
                
                tr = $('<tr />');
                tr.append('<td />');
                for (i in options.weekdays) {
                    tr.append('<td class="day_'+i+' '+replaceCharacters(options.weekdays[i])+'"></td>');
                }
                tr.addClass('event_calendar');
                tr.addClass('school_events');
                $table.append(tr);
                $table.append('<tr class="event_calendar"><td colspan="8"><hr /></td></tr>');
                
                tr = $('<tr />');
                tr.append('<td />');
                for (i in options.weekdays) {
                    tr.append('<td class="event_day day_'+i+' '+replaceCharacters(options.weekdays[i])+'"></td>');
                }
                tr.addClass('event_calendar');
                tr.addClass('user_events');
                $table.append(tr);
                $table.append('<tr class="event_calendar"><td colspan="8"><hr /></td></tr>');
                
                /****/

                for (i in options.segments) {
                    tr = $('<tr />');
                    tr.addClass('week');
                    tr.append('<td>' + options.segments[i] + '</td>');
                    for (var d = 0; d < 7; d++) {
                        td = $('<td />');
                        td.addClass('day');
                        td.data('day', d);
                        td.data('segment', i);
                        td.attr('valign', 'bottom');
                        tr.append(td);
                    }
                    $table.append(tr);
                    $table.append('<tr><td colspan="8"><hr /></td></tr>');
                }

                tr = $('<tr />');
                tr.append('<td />');
                for (i = 0; i < 7; i++) {
                    tr.append('<td class="summary" />');
                }
                $table.append(tr);

                $parent.append($table);

                $table.find('.day').droppable({
                    tolerance: 'pointer',
                    drop: function(event, ui) {
  
                        var $this = $(this);

                        if ($this.find('.workout').length > 0) {
                            return false;
                        }

                        var $info = ui.draggable.data('info');
                        
                        $this.prepend('<img src="/assets/images/load-small.gif" />');

                        if (typeof $info.__class__ != 'undefined' && ($info.__class__ == 'template_workout' || $info.__class__ == 'template_workout_notes')) {
                            
                            $.post(
                                    options.posturl, {
                                action: 'add',
                                workout: $info.workout_id,
                                week: options.week,
                                day: $this.data('day'),
                                segment: $this.data('segment')
                            },
                            function(Rdata) {
                                $parent.scheduler('add', Rdata);
                                $this.find('img').eq(0).remove();
                                update_summary($parent);
                            }
                            );
                                

                        } else if ($info.__class__ == 'schedule_workout' || $info.__class__ == 'day_workout' || $info.__class__ == 'day_result' || $info.__class__ == 'day_workoutnotes') {
                           
                           if($info.__class__ == 'day_workoutnotes') {
                                $.post(
                                options.posturl, {
                                    action: 'move',
                                    id: $info.id,
                                    week: options.week,
                                    day: $this.data('day'),
                                    segment: $this.data('segment'),
                                    workoutnote_id: $info.workoutnote_id
                                },
                                function(Rdata) {
                                    ui.draggable.remove();
                                    $parent.scheduler('add', Rdata);
                                    $this.find('img').eq(0).remove();
                                    update_summary($parent);
                                }
                                );
                           } else {
                                $.post(
                                options.posturl, {
                                    action: 'move',
                                    id: $info.id,
                                    week: options.week,
                                    day: $this.data('day'),
                                    segment: $this.data('segment')
                                },
                                function(Rdata) {
                                    ui.draggable.remove();
                                    $parent.scheduler('add', Rdata);
                                    $this.find('img').eq(0).remove();
                                    update_summary($parent);
                                }
                                );
                           }

                        }

                        return true;
                    }
                });

            });

            if (options['trash']) {
                $(options['trash']).droppable({
                    accept: '#' + this.attr('id') + ' .workout',
                    tolerance: 'pointer',
                    drop: function(event, ui) {
                        var $this = $(this);
                        $this.attr('src', "/assets/images/trash-f.png");
                        var $info = ui.draggable.data('info');
                        $.post(options.posturl, {
                            id: $info.id,
                            action: "remove"
                        }, function(data) {
                            $this.attr('src', "/assets/images/trash-e.png");
                            update_summary();
                        });
                        ui.draggable.remove();
                        ui.helper.remove();
                    }
                });
            }

            return this;
        },
        add: function(item) {
            
            if (typeof item !== 'object') {
                item = $.parseJSON(item);
                
            }

            return this.each(function() {

                var $div = $('<div />');
                var $this = $(this);
                var $data = $this.data('scheduler');

                $div.addClass('workout');
                $div.css('border-right-color', item.__color__);

                $div.append('<span style="float: left;">' + item.__string__ + '</span>');
                if(item.__duration__ != 0) {
                    $div.append('<span style="float: right; color: #666;">' + $.duration(item.__duration__) + '</span>');
                } else {
                    $div.append('<span style="float: right; color: #666;"></span>');    
                }
                if (item.__class__ != 'template_workout') {
                    $div.append('<span style="clear: both; float: left; color: #666; font-size: 7pt;">' + item.__comment__.replace(/(^\s|\s$)/g, '').replace(/[\n\r]+/g, "<br />") + '</span>');
                }

                $div.data('id', item.id);
                $div.data('info', item);

                $div.attr('id', item.__class__ + '_' + item.id)

                if (item.__class__ == 'template_workout') {
                    $div.attr('title', item.__comment__);
                    $('#workouts').append($div);
                } else if(item.__class__ == 'template_workout_notes') {
                    $div.attr('title', item.__comment__);
                    $('#workouts').append($div);
                } 
                else {
                    $this.find('tr.week').eq(item.segment).find('td.day').eq(item.day).append($div);
                    $div.popup({
                        id: item.id,
                        type: item.__class__,
                        title: item.__string__,
                        extra: item.__userid__,
                        submit: function(data) {
                            $div.prepend('<img src="/assets/images/load-small.gif" />');
                        },
                        success: function(data) {
                            $div.remove();
                            if (!data) {
                                return;
                            }
                            $this.scheduler('add', data);
                            update_summary($this);
                        }
                    });
                }

                $div.draggable({
                    helper: function() {
                       
                        var $data = $this.data('scheduler');
                        
                        /* FIXME: add easter egg here :) */
                        if($data.overview) {
                            boxwidth = 50;
                        } else {
                            boxwidth = 107;
                        }
                        return $('<div />')
                                .width(boxwidth)
                                .addClass('workout')
                                .css('border-right-color', item.__color__)
                                .append('<span style="float: left;">' + item.__string__ + '</span>')
                                .append('<span style="float: right; color: #666;">' + $.duration(item.__duration__) + '</span>')
                                .append('<span style="clear: both; float: left; color: #666; font-size: 7pt;">' + item.__comment__.replace(/(^\s|\s$)/g, '').replace(/[\n\r]+/g, "<br />") + '</span>');
                    },
                    start: function(event, ui) {
                        $(this).css('opacity', 0.25);
                    },
                    stop: function(event, ui) {
                        $(this).css('opacity', 1);
                    }
                });

            });
        },
        update: function() {
            return this.each(function() {
                if ($(this).attr('id') !== 'scheduler5') {
                    update_summary($(this));
                } else {
                    update_summary_overview();
                }
            });
        }
    };

    $.fn.scheduler = function(method) {

        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.scheduler');
            return false;
        }

    };

})(jQuery);