
<p>
    Träningstimmar per år: <br />
    <input type="text" name="plan[hours]"{if $plan} value="{$plan->hours}"{/if} id="total" />
    <button id="hours_split">Fördela</button>
</p>

<p>Träningstimmar per period:</p>

<div id="hours" style="overflow: auto;">
    {for $i=0 to 12}
    <div style="float: left;">
        <span style="padding-left: 6px;">{$i+1}</span> <br />
        {assign var = "key" value='p'|cat:$i}
        <input type="text" size="3" name="plan[p{$i}]"{if $plan} value="{$plan->$key}"{/if} />
    </div>
    {/for}
    <div style="float: left;">
        <br /> =
        <input type="text" disabled="disabled" size="4" style="text-align: center;" />
        <button id="week_split">Fördela</button>
    </div>
</div>

<p>Träningstimmar per vecka:</p>

<div id="hoursweek" style="overflow: auto;">
    {for $i=0 to 12}
    <div style="float: left; text-align: center;">
        <span style="font-size: 8pt;">v. {(Period::to_date(null, $i, 1))|date_format:"%W"}</span><br />
        {for $j=0 to 3}
        {assign var = "key" value='p'|cat:$i|cat:'w'|cat:$j}
        <input type="text" size="3" name="plan[p{$i}w{$j}]"{if $plan} value="{$plan->$key}"{/if} /><br />
        {/for}
    </div>
    {/for}
</div>

<div id="hoursweeksummary" style="overflow: auto;">
    {for $i=0 to 12}
    <div style="float: left;">
        <input type="text" size="3" disabled="disabled" />
    </div>
    {/for}
    <div style="float: left;">
        =
        <input type="text" disabled="disabled" size="4" style="text-align: center;" />
    </div>
</div>

<script type="text/javascript">
    $(function () {

        var h = $('#hours input').slice(0, 13);
        var s = $('#hours input').eq(13);
        var t = $('#total');

        h.bind('change', function () {
            var sum = 0;
            h.each(function () {
                sum += parseInt($(this).val());
            });
            s.val(sum).css('background-color', ((Math.abs(sum - t.val()) > 10)?'red':'white'));
            w.eq(0).change();
        });

        var w = $('#hoursweek input');
        var ws = $('#hoursweeksummary input');

        w.bind('change', function () {
            var tot = 0;
            for(var i=0;i<13;i++) {
                var sum = 0;
                for(var j=0;j<4;j++) {
                    sum += parseInt(w.eq(i*4+j).val());
                }
                tot += sum;
                ws.eq(i).val(sum).css('background-color', ((Math.abs(sum - h.eq(i).val()) > 10)?'red':'white'));
            }
            ws.eq(13).val(tot).css('background-color', ((Math.abs(tot - t.val()) > 10)?'red':'white'));
        });

        t.bind('change', function () {
            h.eq(0).change();
        });

        t.change();

        $('#hours_split').click(function (e) {
            e.preventDefault();
            h.val(Math.round(parseInt($('#total').val()) / 13));
            t.change();
        });

        $('#week_split').click(function (e) {
            e.preventDefault();
            for(var i=0;i<13;i++) {
                $('#hoursweek div').eq(i).children('input').val(Math.round(parseInt(h.eq(i).val()) / 4));
                t.change();
            }
        });

    });
</script>
