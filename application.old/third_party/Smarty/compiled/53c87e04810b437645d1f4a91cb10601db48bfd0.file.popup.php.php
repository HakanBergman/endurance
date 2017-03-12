<?php /* Smarty version Smarty-3.1.13, created on 2014-12-18 14:49:41
         compiled from "application/views/pages/popup.php" */ ?>
<?php /*%%SmartyHeaderCode:14463395735492db75e82f89-06499135%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53c87e04810b437645d1f4a91cb10601db48bfd0' => 
    array (
      0 => 'application/views/pages/popup.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14463395735492db75e82f89-06499135',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url' => 0,
    'o' => 0,
    'f' => 0,
    'workout' => 0,
    'type' => 0,
    'pageUser' => 0,
    'parts' => 0,
    'part' => 0,
    'key' => 0,
    'item' => 0,
    'day' => 0,
    'userid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5492db76133d01_51210387',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5492db76133d01_51210387')) {function content_5492db76133d01_51210387($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_Domains')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.Domains.php';
?>
<form action="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" method="post" style="font-size: 9pt;">
    <div class="result" style="clear: both;">
        <?php if (isset($_smarty_tpl->tpl_vars['o']->value->workoutnote_id)){?>
            <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = smarty_modifier_Domains('workoutnote'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['o']->value===false){?>
            <?php echo $_smarty_tpl->getSubTemplate ("snippets/field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('name'=>"workout",'value'=>null,'f'=>$_smarty_tpl->tpl_vars['f']->value), 0);?>

            <?php }else{ ?>
            <?php echo $_smarty_tpl->getSubTemplate ("snippets/field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('name'=>"workout",'value'=>$_smarty_tpl->tpl_vars['workout']->value,'f'=>$_smarty_tpl->tpl_vars['f']->value), 0);?>

            <?php }?>
            <?php } ?>
        <?php }else{ ?>
            <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = smarty_modifier_Domains('workout'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['o']->value===false){?>
            <?php echo $_smarty_tpl->getSubTemplate ("snippets/field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('name'=>"workout",'value'=>null,'f'=>$_smarty_tpl->tpl_vars['f']->value), 0);?>

            <?php }else{ ?>
            <?php echo $_smarty_tpl->getSubTemplate ("snippets/field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('name'=>"workout",'value'=>$_smarty_tpl->tpl_vars['workout']->value,'f'=>$_smarty_tpl->tpl_vars['f']->value), 0);?>

            <?php }?>
            <?php } ?>
        <?php }?>
        
        <?php if ($_smarty_tpl->tpl_vars['type']->value=='template_workout'&&$_smarty_tpl->tpl_vars['pageUser']->value->type!="10"){?>
        <p class="s2">
            <label>
                <input type="checkbox" name="workout[global]"<?php if ($_smarty_tpl->tpl_vars['workout']->value!==false&&$_smarty_tpl->tpl_vars['workout']->value->global){?> checked="checked"<?php }?> />
                Globalt pass
            </label>
        </p>
        <?php }?>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['type']->value=='day_result'){?>
    <div class="result" style="clear: both;">
        <?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = smarty_modifier_Domains('result'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value){
$_smarty_tpl->tpl_vars['f']->_loop = true;
?> 
        <?php if ($_smarty_tpl->tpl_vars['o']->value&&$_smarty_tpl->tpl_vars['o']->value->type=='day_result'){?>
            <?php echo $_smarty_tpl->getSubTemplate ("snippets/field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('name'=>"result",'value'=>$_smarty_tpl->tpl_vars['o']->value,'f'=>$_smarty_tpl->tpl_vars['f']->value), 0);?>

        <?php }else{ ?>
            <?php echo $_smarty_tpl->getSubTemplate ("snippets/field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('name'=>"result",'value'=>false,'f'=>$_smarty_tpl->tpl_vars['f']->value), 0);?>

        <?php }?>
        <?php } ?>
    </div>
    
    
    <?php }?>
    
    <?php if ($_smarty_tpl->tpl_vars['o']->value!==false){?>
    <?php  $_smarty_tpl->tpl_vars['part'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['part']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['parts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['part']->key => $_smarty_tpl->tpl_vars['part']->value){
$_smarty_tpl->tpl_vars['part']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['part']->key;
?>
    <div class="result type-<?php echo mb_strtolower($_smarty_tpl->tpl_vars['part']->value->title, 'UTF-8');?>
">
        <?php echo $_smarty_tpl->getSubTemplate ("snippets/part.php", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>((($_smarty_tpl->tpl_vars['key']->value+1)).(" ")).($_smarty_tpl->tpl_vars['part']->value->title),'name'=>(("part[").($_smarty_tpl->tpl_vars['key']->value)).("]"),'value'=>$_smarty_tpl->tpl_vars['part']->value,'primary'=>$_smarty_tpl->tpl_vars['part']->value->primary,'remove'=>false), 0);?>

    </div>
    <?php } ?>
    <?php }?>
    

    <?php if (!isset($_smarty_tpl->tpl_vars['o']->value->workoutnote_id)){?>
    <hr style="clear: both;" />
    
    <div id="add-part" style="clear: both; text-align: center;">
    
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = smarty_modifier_Domains('parts'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
    <button data-type="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->title;?>
</button>
    <?php } ?>
    </div>
    
    
    <hr style="clear: both;" />
    <?php }?>
    
    <div class="error_message" id="message_<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"></div>
    
    <div style="overflow: auto; padding-top: 4px; clear: both; text-align: center; padding: 12px 0px;">
        <?php if ($_smarty_tpl->tpl_vars['type']->value=='day_workout'&&($_smarty_tpl->tpl_vars['pageUser']->value->type=="10"||$_smarty_tpl->tpl_vars['pageUser']->value->type=="50")){?>
        <a class="button perform" style="margin: 0px 16px;">
            Genomför
        </a>
        <?php }?>
        
        <?php if ($_smarty_tpl->tpl_vars['workout']->value!==false){?><a class="button reject" onclick="$(this).closest('form').attr('action', '<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/delete').submit();" style="margin: 0px 16px;">Ta bort</a><?php }?>
        
        <a class="button accept" onclick="submitWorkout($(this).closest('form'));" style="margin: 0px 16px;">
            Spara
        </a>
    </div>
    
</form>

<script type="text/javascript">
 
    function submitWorkout(form) {
        <?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type=="10"){?>
            var isOneChecked = $(".primary:checked").length > 0;

            if(isOneChecked) {
                form.submit();
                return true;
            } else {
                $("#message_<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
").html("Du måste kryssa i minst en huvuddel för att spara passet.");
                return false;
            } 
        <?php }else{ ?>
            form.submit();
        <?php }?>
    }
    
    $(function () {  
    
         <?php if ($_smarty_tpl->tpl_vars['type']->value=='day_workout'&&($_smarty_tpl->tpl_vars['pageUser']->value->type=="10"||$_smarty_tpl->tpl_vars['pageUser']->value->type=="50")){?> 
         
            $('a.perform').each(function () {
                
               extra = '<?php echo $_smarty_tpl->tpl_vars['o']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['day']->value->day;?>
/<?php echo $_smarty_tpl->tpl_vars['o']->value->segment;?>
/<?php echo $_smarty_tpl->tpl_vars['userid']->value;?>
';
               title = 'Registrera <?php echo $_smarty_tpl->tpl_vars['workout']->value->title;?>
';
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
        <?php }?>
        
        
        setTimeout(function () {
            
            $(".primary").click(function(){
                var isOneChecked = $(".primary:checked").length > 0;
                if(isOneChecked) {
                    $(".message").html("");
                }
            });
            
            var i = <?php if ($_smarty_tpl->tpl_vars['workout']->value){?><?php echo count($_smarty_tpl->tpl_vars['parts']->value);?>
<?php }else{ ?>0<?php }?>;

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
</script><?php }} ?>