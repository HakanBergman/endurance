
<form action="{$url}" method="post" style="font-size: 9pt;">
    <div class="result" style="clear: both;">
        {if isset($o->workoutnote_id)}
            {foreach from='workoutnote'|Domains item=f}
            {if $o === false}
            {include file="snippets/field.tpl" name="workout" value=null f=$f}
            {else}
            {include file="snippets/field.tpl" name="workout" value=$workout f=$f}
            {/if}
            {/foreach}
        {else}
            {foreach from='workout'|Domains item=f}
            {if $o === false}
            {include file="snippets/field.tpl" name="workout" value=null f=$f}
            {else}
            {include file="snippets/field.tpl" name="workout" value=$workout f=$f}
            {/if}
            {/foreach}
        {/if}
        
        {if $type == 'template_workout' and $pageUser->type != "10"}
        <p class="s2">
            <label>
                <input type="checkbox" name="workout[global]"{if $workout !== false && $workout->global} checked="checked"{/if} />
                Globalt pass
            </label>
        </p>
        {/if}
    </div>

    {if $type == 'day_result'}
    <div class="result" style="clear: both;">
        {foreach from='result'|Domains item=f} 
        {if $o && $o->type == 'day_result'}
            {include file="snippets/field.tpl" name="result" value=$o f=$f}
        {else}
            {include file="snippets/field.tpl" name="result" value=false f=$f}
        {/if}
        {/foreach}
    </div>
    
    
    {/if}
    
    {if $o !== false}
    {foreach from=$parts key=key item=part}
    <div class="result type-{$part->title|lower}">
        {include file="snippets/part.php" title=($key + 1)|cat:" "|cat:$part->title name="part["|cat:$key|cat:"]" value=$part primary=$part->primary remove=false}
    </div>
    {/foreach}
    {/if}
    

    {if !isset($o->workoutnote_id)}
    <hr style="clear: both;" />
    
    <div id="add-part" style="clear: both; text-align: center;">
    
    {foreach from='parts'|Domains key=key item=item}
    <button data-type="{$key}">{$item->title}</button>
    {/foreach}
    </div>
    
    
    <hr style="clear: both;" />
    {/if}
    
    <div class="error_message" id="message_{$type}"></div>
    
    <div style="overflow: auto; padding-top: 4px; clear: both; text-align: center; padding: 12px 0px;">
        {if $type == 'day_workout' and ($pageUser->type == "10" or $pageUser->type == "50")}
        <a class="button perform" style="margin: 0px 16px;">
            Genomför
        </a>
        {/if}
        
        {if $workout !== false}<a class="button reject" onclick="$(this).closest('form').attr('action', '{$url}/delete').submit();" style="margin: 0px 16px;">Ta bort</a>{/if}
        
        <a class="button accept" onclick="submitWorkout($(this).closest('form'));" style="margin: 0px 16px;">
            Spara
        </a>
    </div>
    
</form>

<script type="text/javascript">
 
    function submitWorkout(form) {
        {if $pageUser->type == "10"}
            var isOneChecked = $(".primary:checked").length > 0;

            if(isOneChecked) {
                form.submit();
                return true;
            } else {
                $("#message_{$type}").html("Du måste kryssa i minst en huvuddel för att spara passet.");
                return false;
            } 
        {else}
            form.submit();
        {/if}
    }
    
    $(function () {  
    
         {if $type == 'day_workout' and ($pageUser->type == "10" or $pageUser->type == "50")} 
         
            $('a.perform').each(function () {
                
               extra = '{$o->id}/{$day->year}/{$day->period}/{$day->week}/{$day->day}/{$o->segment}/{$userid}';
               title = 'Registrera {$workout->title}';
               $(this).popup({
                   id: 'add',
                   type: 'day_result',
                   extra: extra,
                   title: title,
                   success: function (data) {
                       if(!data) { return ; }
                       /* FIXME */
                       window.location.reload();
                   }
               });
               
              
               
           }); 
        {/if}
        
        
        setTimeout(function () {
            
            $(".primary").click(function(){
                var isOneChecked = $(".primary:checked").length > 0;
                if(isOneChecked) {
                    $(".message").html("");
                }
            });
            
            var i = {if $workout}{$parts|count}{else}0{/if};

            var lastEl, lastType;
            
            if(i > 0) {
                lastEl = $('#add-part').parent().find('.result').last();
                lastType = lastEl.find('input[name="part[' + (i-1) + '][type]"]').val();
            } else {
                lastEl = null;
                lastType = null;
            }
            
            if($('.type-vila').length) {
                $(".field-form").hide();
                obj =  $(".field-form select");
                opt = document.createElement("option");
                opt.value = -1;
                opt.text='vila';
                obj.append(opt);
                obj.val(-1);
            }
            
            $('#add-part button').click(function (e) {
                
                e.preventDefault();
                var type = $(this).data('type');
                
                $.post(
                    '/popup/add_part', {
                        title: "Ny del: " + $(this).text(),
                        name: "part[" + (i++) + "]",
                        type: type
                    }, function (data) {
                        
                        var $r = $('<div class="result">' + data + '</div>');
                        $('#add-part').prev().before($r);
                        
                        if(lastType == type) {
                            $r.find('select').eq(0).val(lastEl.find('select').eq(0).val());
                        }
                        
                        lastEl = $r;
                        lastType = type;
                        
                        if(type == 4) {
                            $(".field-form").hide();
                            obj =  $(".field-form select");
                            opt = document.createElement("option");
                            opt.value = -1;
                            opt.text='vila';
                            obj.append(opt);
                            obj.val(-1);
                        }
                        
                    }
                );
                
            });
            
        }, 10);
    }); 
    function showshape() {
        
        if($('.type-vila fieldset:visible').length == 0) {
            obj = obj =  $(".field-form select");
            obj.val(4);
            $(".field-form select option[value='-1']").each(function() {
                $(this).remove();
            });

            $(".field-form").show();
        }
    }
</script>