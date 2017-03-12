<div class="calendar-main performance mobile">
    <br />

    <form action="/student/ajax_changedate/{$student->id}/" type="post">
        Välj datum:<br />
        <input type="date" name="pickdate" id="pickdate">
        <input type="submit" class="button accept" value="OK!">
    </form>

    <div class="box-strapper planning">
        <div class="box blue">

            <h1>Planering: {$student->fullname}, {$date->year}</h1>   
            <div>

                <div class="tabs" style="float: left;">
                    <div style="float: left;">
                        <div style="float: left;">
                            {assign var=prevday value=$date->day-1}
                            <a href="/mobile/{$id}/{$date->year}/{$date->period}/{$date->week}/{$prevday}"><img src="/assets/images/left.png" /></a>
                        </div>
                        <div style="float: left; padding: 4px;">
                            {$activeday}
                        </div>
                        <div style="float: left;">
                            {assign var=nextday value=$date->day+1}
                            <a href="/mobile/{$id}/{$date->year}/{$date->period}/{$date->week}/{$nextday}"><img src="/assets/images/right.png" /></a>
                        </div>
                    </div>

                    <a href="/mobile/{$id}"{if $date->isNow()} class="active"{/if}>Idag</a>

                </div>
            </div>

        </div>

        <div class="box wide" id="scheduler-plan">
            <table class="scheduler">
                <col span="1" class="segment">
                <tbody>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>


                    <tr class="week">
                        <td>Mo.</td>
                        <td valign="bottom" class="day ui-droppable">


                            {foreach $day_workout as $workout}
                            {if $workout->segment == 0}
                            <div id="#{$workout->id}" class="day_workout workout" style="border-right-color: {$workout->__color__};" id="day_result_271993">
                                <span style="float: left;">{$workout->__string__}</span>
                                <span style="float: right; color: #666;">{if $workout->__duration__ > 0}{gmdate("H:i", $workout->__duration__)}{/if}</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            {/if}
                            {/foreach}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr class="week">
                        <td>Fm.</td>
                        <td valign="bottom" class="day ui-droppable">
                            {foreach $day_workout as $workout}
                            {if $workout->segment == 1}
                            <div id="#{$workout->id}" class="day_workout workout" style="border-right-color: {$workout->__color__};" id="day_result_271993">
                                <span style="float: left;">{$workout->__string__}</span>
                                <span style="float: right; color: #666;">{gmdate("H:i", $workout->__duration__)}</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            {/if}
                            {/foreach}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr><tr class="week">
                        <td>Em.</td>
                        <td valign="bottom" class="day ui-droppable">
                            {foreach $day_workout as $workout}    
                            {if $workout->segment == 2}
                            <div id="#{$workout->id}" class="day_workout workout" style="border-right-color: {$workout->__color__};" id="day_result_271993">
                                <span style="float: left;">{$workout->__string__}</span>
                                <span style="float: right; color: #666;">{gmdate("H:i", $workout->__duration__)}</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            {/if}
                            {/foreach}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr class="week"><td>Kv.</td>
                        <td valign="bottom" class="day ui-droppable">
                            {foreach $day_workout as $workout}
                            {if $workout->segment == 3}
                            <div id="#{$workout->id}" class="day_workout workout" style="border-right-color: {$workout->__color__};" id="day_result_271993">
                                <span style="float: left;">{$workout->__string__}</span>
                                <span style="float: right; color: #666;">{gmdate("H:i", $workout->__duration__)}</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            {/if}
                            {/foreach}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="summary">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <div class="box-strapper planning">
        <div class="box blue">

            <h1>Genomfört: {$student->fullname}, {$date->year}</h1>

            <div>

                <div class="tabs" style="float: left;">
                    <div style="float: left;">
                        <div style="float: left;">
                            {assign var=prevday value=$date->day-1}
                            <a href="/mobile/{$id}/{$date->year}/{$date->period}/{$date->week}/{$prevday}"><img src="/assets/images/left.png" /></a>
                        </div>
                        <div style="float: left; padding: 4px;">
                            {$activeday}
                        </div>
                        <div style="float: left;">
                            {assign var=nextday value=$date->day+1}
                            <a href="/mobile/{$id}/{$date->year}/{$date->period}/{$date->week}/{$nextday}"><img src="/assets/images/right.png" /></a>
                        </div>
                    </div>

                    <a href="/mobile/{$id}"{if $date->isNow()} class="active"{/if}>Idag</a>

                </div>

            </div>

        </div>

        <div class="box wide" id="scheduler-plan">
            <table class="scheduler">
                <col span="1" class="segment">
                <tbody>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>


                    <tr class="week">
                        <td>Mo.</td>
                        <td valign="bottom" data-segment="0" class="day ui-droppable">
                            {assign var="button" value="yes"}
                            {foreach $day_result as $workout}
                            {if $workout->segment == 0}
                            <div id="#{$workout->id}" class="day_result workout" style="border-right-color: rgb(255, 255, 0);" id="day_result_271993">
                                <span style="float: left;">{$workout->__string__}</span>
                                <span style="float: right; color: #666;">{gmdate("H:i", $workout->__duration__)}</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            {assign var="button" value="no"}
                            {/if}
                            {/foreach}
                            {if $button == "yes"}
                            <a class="activity" href="#">Registrera aktivitet</a>
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr class="week">
                        <td>Fm.</td>
                        <td valign="bottom" data-segment="1" class="day ui-droppable">
                            {assign var="button" value="yes"}
                            {foreach $day_result as $workout}
                            {if $workout->segment == 1}
                            <div id="#{$workout->id}" class="day_result workout" style="border-right-color: rgb(255, 255, 0);" id="day_result_271993">
                                <span style="float: left;">{$workout->__string__}</span>
                                <span style="float: right; color: #666;">{gmdate("H:i", $workout->__duration__)}</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            {assign var="button" value="no"}
                            {/if}
                            {/foreach}
                            {if $button == "yes"}
                            <a class="activity" href="#">Registrera aktivitet</a>
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr><tr class="week">
                        <td>Em.</td>
                        <td valign="bottom" data-segment="1" class="day ui-droppable">
                            {assign var="button" value="yes"}
                            {foreach $day_result as $workout}
                            {if $workout->segment == 2}
                            <div id="#{$workout->id}" class="day_result workout" style="border-right-color: rgb(255, 255, 0);" id="day_result_271993">
                                <span style="float: left;">{$workout->__string__}</span>
                                <span style="float: right; color: #666;">{gmdate("H:i", $workout->__duration__)}</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            {assign var="button" value="no"}
                            {/if}
                            {/foreach}
                            {if $button == "yes"}
                            <a class="activity" href="#">Registrera aktivitet</a>
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr class="week"><td>Kv.</td>
                        <td valign="bottom" data-segment="3" class="day ui-droppable">
                            {assign var="button" value="yes"}
                            {foreach $day_result as $workout}
                            {if $workout->segment == 3}
                            <div id="#{$workout->id}" class="day_result workout" style="border-right-color: rgb(255, 255, 0);" id="day_result_271993">
                                <span style="float: left;">{$workout->__string__}</span>
                                <span style="float: right; color: #666;">{gmdate("H:i", $workout->__duration__)}</span>
                                <span style="clear: both; float: left; color: #666; font-size: 7pt;"></span>
                            </div>
                            {assign var="button" value="no"}
                            {/if}
                            {/foreach}
                            {if $button == "yes"}
                            <a class="activity" href="#">Registrera aktivitet</a>
                            {/if}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="summary"></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>



</form>
</div>

<script type="text/javascript">
    

    
    
    $(function () {


        $('a.activity').each(function () {
            var $parent = $(this).parent();
            $(this).popup({
                id: 'add',
                type: 'day_result',
                extra: '0/{$date->year}/{$date->period}/{$date->week}/{$date->day}/' + $parent.data('segment'),
                title: "Registrera ny träning",
                success: function (data) {
                    if (!data) {
                        return;
                    }
                    /* FIXME */
                    window.location.reload();
                }
            });
        });

        var day_workout = $.parseJSON('{$day_workout|json_encode}');
        var day_result = $.parseJSON('{$day_result|json_encode}');

        $('div.day_workout').each(function (key, value) {
            id = $(this).attr("id").substr(1);

            if (typeof day_workout[key] != 'undefined') {
                var $parent = $(this).parent();
                $(this).popup({
                    id: day_workout[key].id,
                    type: day_workout[key].__class__,
                    title: day_workout[key].__string__,
                    extra: day_workout[key].__userid__,
                    success: function (data) {
                        if (!data) {
                            return;
                        }
                        /* FIXME */
                        window.location.reload();
                    }
                });
            }
        });

        $('div.day_result').each(function (key, value) {
            id = $(this).attr("id").substr(1);

            if (typeof day_result[key] != 'undefined') {
                var $parent = $(this).parent();
                $(this).popup({
                    id: day_result[key].id,
                    type: day_result[key].__class__,
                    title: day_result[key].__string__,
                    extra: day_result[key].__userid__,
                    success: function (data) {
                        if (!data) {
                            return;
                        }
                        /* FIXME */
                        window.location.reload();
                    }
                });
            }
        });
    });

</script>
