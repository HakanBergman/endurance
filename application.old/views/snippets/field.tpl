{if $f->type == "time"}
    {if $ismobile}
        <p class="s2">
            {$f->title} <br />
            <input class="time" type="number" name="{$name}[{$f->name}][]" size="2" value="{if $value}{($value->{$f->name}/3600)|floor}{else}00{/if}" style="text-align: center;" /> :
            <input class="time" type="number" name="{$name}[{$f->name}][]" size="2" value="{if $value}{($value->{$f->name}%3600/60)|floor}{else}00{/if}" style="text-align: center;" /> :
            <input class="time" type="number" name="{$name}[{$f->name}][]" size="2" value="{if $value}{$value->{$f->name}%60}{else}00{/if}" style="text-align: center;" />
        </p>
    {else}
        <p class="s2">
            {$f->title} <br />
            <input type="text" name="{$name}[{$f->name}][]" size="2" value="{if $value}{($value->{$f->name}/3600)|floor}{else}00{/if}" style="text-align: center;" /> :
            <input type="text" name="{$name}[{$f->name}][]" size="2" value="{if $value}{($value->{$f->name}%3600/60)|floor}{else}00{/if}" style="text-align: center;" /> :
            <input type="text" name="{$name}[{$f->name}][]" size="2" value="{if $value}{$value->{$f->name}%60}{else}00{/if}" style="text-align: center;" />
        </p>   
    {/if}

{elseif $f->type == "select"}
    <p class="s2">
        {$f->title} <br />
        <select name="{$name}[{$f->name}]">
            {foreach from=$f->values item=v}
                <option value="{$v->key}"{if (($value && $v->key == $value->{$f->name}) || (!$value && isset($v->default)))} selected="selected"{/if}>{$v->val}</option>
            {/foreach}
        </select>
    </p>
{elseif $f->type == "amount"}

    <p class="s1">
        {$f->title} <br />
        <input type="number" name="{$name}[{$f->name}]"{if $value} value="{$value->{$f->name}}"{/if} />
    </p>



{elseif $f->type == "text"}
    <p class="s4">
        {$f->title} <br />
        <input type="text" name="{$name}[{$f->name}]"{if $value} value="{$value->{$f->name}}"{/if} />
    </p>

{elseif $f->type == "textarea"}
    <p class="s4">
        {$f->title} <br />
        <textarea type="text" id="{$name}[{$f->name}]" name="{$name}[{$f->name}]" rows="3" >{if $value}{$value->{$f->name}}{/if}</textarea>
    </p>
{/if}