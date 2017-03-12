
<div class="box blue">

    <h1>
        Årsplanering för {$student->fullname},
        {if $student_endyear}
        <select id="year">
            <option{if $now->year == $year} selected="selected"{/if}>{$now->year}</option>
            {if $now->year+1 < $student_endyear->year}
            <option{if $now->year+1 == $year} selected="selected"{/if}>{$now->year+1}</option>
            {/if}
        </select>
        {else}
        <select id="year">
            <option{if $now->year == $year} selected="selected"{/if}>{$now->year}</option>
            <option{if $now->year+1 == $year} selected="selected"{/if}>{$now->year+1}</option>
        </select>
        {/if}
    </h1>

</div>

<form class="box" method="post" action="/student/plan/{$student->id}/{$year}">

    {include file="snippets/plan.php"}
{if not $student_endyear}
    <p>
        <input type="submit" value="Spara" />
    </p>
{/if}

</form>

<script type="text/javascript">
    $(function() {
        $('#year').on('change', function() {
            window.location.href = "/student/plan/{$student->id}/" + $(this).val();
        });
    });
</script>
