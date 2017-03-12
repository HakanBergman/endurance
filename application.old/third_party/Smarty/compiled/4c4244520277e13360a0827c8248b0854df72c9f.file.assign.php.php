<?php /* Smarty version Smarty-3.1.13, created on 2014-12-19 10:36:17
         compiled from "application/views/pages/schedule/assign.php" */ ?>
<?php /*%%SmartyHeaderCode:19121428685493f1915ed9b7-24231340%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c4244520277e13360a0827c8248b0854df72c9f' => 
    array (
      0 => 'application/views/pages/schedule/assign.php',
      1 => 1418907801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19121428685493f1915ed9b7-24231340',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'schedule' => 0,
    'action' => 0,
    'users' => 0,
    'group' => 0,
    'user' => 0,
    'date' => 0,
    'now' => 0,
    'i' => 0,
    'year' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5493f19182a486_79398886',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5493f19182a486_79398886')) {function content_5493f19182a486_79398886($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/function.math.php';
if (!is_callable('smarty_modifier_date_format')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.date_format.php';
?><form action="/schedule/assign/<?php echo $_smarty_tpl->tpl_vars['schedule']->value->id;?>
" method="post">
    
    <div class="box schedules blue"><h1> Kopiera program: <?php echo $_smarty_tpl->tpl_vars['schedule']->value->title;?>
 </h1></div>
    
    <table class="box schedules" id="users">
        
        <?php if ($_smarty_tpl->tpl_vars['action']->value=="select"){?>
        
        <?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['group']->key;
?>
        <tr class="group" style="background-color: lightgray;">
            <td style="width: 32px;"><input type="checkbox" id="g<?php echo $_smarty_tpl->tpl_vars['group']->value->id;?>
" /></td>
            <td colspan="2"><label for="g<?php echo $_smarty_tpl->tpl_vars['group']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['group']->value->title;?>
</label></td>
        </tr>
            <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_smarty_tpl->tpl_vars['key2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value->users; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
$_smarty_tpl->tpl_vars['user']->_loop = true;
 $_smarty_tpl->tpl_vars['key2']->value = $_smarty_tpl->tpl_vars['user']->key;
?>
                <?php if ($_smarty_tpl->tpl_vars['user']->value->active){?>
                    <tr class="user">
                        <td style="width: 32px;"><input type="checkbox" name="users[]" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->user_id;?>
" id="u<?php echo $_smarty_tpl->tpl_vars['user']->value->user_id;?>
" /></td>
                        <td colspan="2"><label for="u<?php echo $_smarty_tpl->tpl_vars['user']->value->user_id;?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value->fullname;?>
</label></td>
                    </tr>
                <?php }?>
            <?php } ?>
        <?php } ?>
        
        <?php }elseif($_smarty_tpl->tpl_vars['action']->value=="confirm"){?>
        
        <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
        <tr class="user">
            <td><?php echo $_smarty_tpl->tpl_vars['user']->value->fullname;?>
 <?php if ($_smarty_tpl->tpl_vars['user']->value->count>0){?><span style="color: #999;">(<?php echo $_smarty_tpl->tpl_vars['user']->value->count;?>
 pass finns redan sparat)</span><?php }?></td>
            <?php if ($_smarty_tpl->tpl_vars['user']->value->count==0){?>
            <td colspan="2">
                <input type="hidden" name="tasks[<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
]" value="insert" />
            </td>
            <?php }else{ ?>
            <td style="width: 96px;">
                <label><input type="radio" name="tasks[<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
]" value="insert" checked="checked" /> Lägg till </label>
            </td>
            <td style="width: 96px;">
                <label><input type="radio" name="tasks[<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
]" value="replace" /> Skriv över </label>
            </td>
            <?php }?>
        </tr>
        <?php } ?>
        
        <?php }?>
        
        <tr class="group">
            <td colspan="3" style="text-align: right">
                <?php if (isset($_smarty_tpl->tpl_vars['date']->value)){?>
                
                <input type="hidden" name="date" value="<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
-<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
" />
                <?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo substr(($_smarty_tpl->tpl_vars['now']->value->year+1),2,3);?>
 Period <?php echo $_smarty_tpl->tpl_vars['date']->value->period+1;?>
 (v. <?php echo $_smarty_tpl->tpl_vars['date']->value->week(0)->newGregorian();?>
 - <?php echo $_smarty_tpl->tpl_vars['date']->value->week(3)->newGregorian();?>
)
                
                <?php }else{ ?>
                
                <select name="date">
                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['now']->value->period+13+1 - ($_smarty_tpl->tpl_vars['now']->value->period-3) : $_smarty_tpl->tpl_vars['now']->value->period-3-($_smarty_tpl->tpl_vars['now']->value->period+13)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['now']->value->period-3, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>                    
                    <option value="<?php if ($_smarty_tpl->tpl_vars['i']->value<0){?><?php echo smarty_function_math(array('equation'=>'x - y','x'=>$_smarty_tpl->tpl_vars['now']->value->year,'y'=>1),$_smarty_tpl);?>
-<?php echo smarty_function_math(array('equation'=>'(x + y)','x'=>13,'y'=>$_smarty_tpl->tpl_vars['i']->value),$_smarty_tpl);?>
<?php }elseif($_smarty_tpl->tpl_vars['i']->value>12){?><?php echo smarty_function_math(array('equation'=>'x + y','x'=>$_smarty_tpl->tpl_vars['now']->value->year,'y'=>1),$_smarty_tpl);?>
-<?php echo smarty_function_math(array('equation'=>'(y - x)','x'=>13,'y'=>$_smarty_tpl->tpl_vars['i']->value),$_smarty_tpl);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['now']->value->year;?>
-<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
<?php }?>">
                    
                    
                    <?php if ($_smarty_tpl->tpl_vars['i']->value<0){?>
                        <?php echo $_smarty_tpl->tpl_vars['now']->value->year-1;?>
/<?php echo substr($_smarty_tpl->tpl_vars['now']->value->year,2,3);?>

                        <?php $_smarty_tpl->tpl_vars["year"] = new Smarty_variable($_smarty_tpl->tpl_vars['now']->value->year-1, null, 0);?>
                    <?php }elseif($_smarty_tpl->tpl_vars['i']->value>12){?>
                        <?php echo $_smarty_tpl->tpl_vars['now']->value->year+1;?>
/<?php echo substr(($_smarty_tpl->tpl_vars['now']->value->year+2),2,3);?>

                        <?php $_smarty_tpl->tpl_vars["year"] = new Smarty_variable($_smarty_tpl->tpl_vars['now']->value->year+1, null, 0);?>
                    <?php }else{ ?>
                        <?php echo $_smarty_tpl->tpl_vars['now']->value->year;?>
/<?php echo substr(($_smarty_tpl->tpl_vars['now']->value->year+1),2,3);?>

                        <?php $_smarty_tpl->tpl_vars["year"] = new Smarty_variable($_smarty_tpl->tpl_vars['now']->value->year, null, 0);?>
                    <?php }?> 
                    
                    <?php if ($_smarty_tpl->tpl_vars['i']->value<0){?>
                        P. <?php echo (13+$_smarty_tpl->tpl_vars['i']->value)+1;?>

                    <?php }elseif($_smarty_tpl->tpl_vars['i']->value>12){?>
                        P. <?php echo ($_smarty_tpl->tpl_vars['i']->value-13)+1;?>

                    <?php }else{ ?>
                        P. <?php echo ($_smarty_tpl->tpl_vars['i']->value)+1;?>

                    <?php }?>
                    (v. 
                    
                    <?php if ($_smarty_tpl->tpl_vars['i']->value<0){?>
                        <?php echo smarty_modifier_date_format((Period::to_date($_smarty_tpl->tpl_vars['year']->value,(13+$_smarty_tpl->tpl_vars['i']->value),0)),"%V");?>
 - <?php echo smarty_modifier_date_format((Period::to_date($_smarty_tpl->tpl_vars['year']->value,(13+$_smarty_tpl->tpl_vars['i']->value),3)),"%V");?>

                    <?php }elseif($_smarty_tpl->tpl_vars['i']->value>12){?>
                        <?php echo smarty_modifier_date_format((Period::to_date($_smarty_tpl->tpl_vars['year']->value,($_smarty_tpl->tpl_vars['i']->value-13),0)),"%V");?>
 - <?php echo smarty_modifier_date_format((Period::to_date($_smarty_tpl->tpl_vars['year']->value,($_smarty_tpl->tpl_vars['i']->value-13),3)),"%V");?>

                    <?php }else{ ?>
                        <?php echo smarty_modifier_date_format((Period::to_date($_smarty_tpl->tpl_vars['year']->value,($_smarty_tpl->tpl_vars['i']->value),0)),"%V");?>
 - <?php echo smarty_modifier_date_format((Period::to_date($_smarty_tpl->tpl_vars['year']->value,($_smarty_tpl->tpl_vars['i']->value),3)),"%V");?>

                    <?php }?>
                    
                    )
                </option>
             <?php }} ?>
            </select>
                <?php }?>
                <input type="submit" value="Kopiera till utövare"/>
            </td>
        </tr>
        
    </table>
    
</form>

<?php if ($_smarty_tpl->tpl_vars['action']->value=="select"){?>
<script type="text/javascript">
    $(function () {
        
        var updateui = function () {
            var l = $('#users .user input[type=checkbox]:checked').length;
            
            if(l == 0) {
                $('#users input[type=submit]').attr('disabled', true);
            } else {
                $('#users input[type=submit]').attr('disabled', false);
            }
            
        };
        
        $('#users .group input[type=checkbox]').change(function () {
            $(this).parent().parent().nextUntil('.group').find('input').attr("checked", $(this).attr("checked"));
        });
        
        $('#users input[type=checkbox]').change(updateui);
        
        updateui();
        
    });
</script>
<?php }?>
<?php }} ?>