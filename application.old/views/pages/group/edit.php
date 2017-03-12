
<div class="box blue">

    <h1> Ändra egenskaper 
        {if $oldyear}
            <select class="yearbox">
                {foreach $oldyear as $o}
                <option {if $selyear == $o}selected{/if} >{$o}</option>
                {/foreach}
            </select>
        {/if} 
    </h1>

</div>

<form class="box" method="post" action="/group/edit/{$id}/{$selyear}">

    <p>
        Titel: <br />
        <input type="text" name="group[title]"{if $group} value="{$group->title}"{/if} />
    </p>

    {include file="snippets/plan.php"}

    <p>
        <a href="/group/list">Avbryt</a> <input type="submit" value="Spara" />
    </p>

</form>

<script type="text/javascript">
	$(function() {
		$('.yearbox').on('change', function() {
			location.href = "/group/edit/{$group->id}/" + $(this).val();
		});
	});
</script>
