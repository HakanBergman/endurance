
<p>
    {foreach from=$values item=v}
    <input type="checkbox" name="{$name}[{$v->key}]" value="1" id="{$name|md5}{$v->key}"{if $checked && $v->key|inbin:$checked} checked="checked"{/if} />
    <label for="{$name|md5}{$v->key}">{$v->val}</label><br />
    {/foreach}
</p>
