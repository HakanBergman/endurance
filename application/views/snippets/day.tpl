
<table class="scheduler">
    <col class="segment" span="1" />
    <tr>
        <td>Övrigt</td>
        {foreach from=$day item=cur}
            <td style="text-align: left;" valign="bottom">
                {foreach from='day'|Domains item=d}
                    {if $d->type == "checkbox"}
                        {if $cur}
                            <p>
                                {foreach from=$d->values item=v}
                                    {if $v->key|inbin:$cur->{$d->name}}
                                        {$v->val}<br />
                                    {/if}
                                {/foreach}
                            </p>
                        {/if}
                        {elseif $d->type == "number" || $d->type == "text"}
                            {$d->title}: {if $cur}{$cur->{$d->name}}
                        {/if}<br />
                    {/if}
                {/foreach}
    </td>
{/foreach}
</tr>
</table>
