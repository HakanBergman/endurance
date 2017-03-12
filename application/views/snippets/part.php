
{if $value != null}{$type=$value->type}{/if}

<fieldset{if isset($remove) && $remove} class="hide"{/if}>
    <legend>{$title}</legend>
    
    {if isset($primary)}
    <legend style="left: auto; right: 40px;">
        <label><input class="primary" type="checkbox" name="{$name}[primary]" value="1"{if $primary} checked="checked"{/if} /> Huvuddel</label>
    </legend>
    {/if}
    
    {if isset($remove)}
    <legend class="delete" style="left: auto; right: 8px;">
        <input type="hidden" name="{$name}[remove]" value="{if $remove}1{else}0{/if}" />
        <span onclick="$(this).parent().find('input').val(1);$(this).closest('fieldset').addClass('hide');{if $type == 4}showshape();{/if}">X</span>
    </legend>
    {/if}
    
    <input type="hidden" name="{$name}[type]" value="{$type}" />
    
    {foreach from='parts'|Domains:$type:'fields' item=f}
    {include file="snippets/field.tpl" name=$name value=$value f=$f}
    {/foreach}
    
</fieldset>
