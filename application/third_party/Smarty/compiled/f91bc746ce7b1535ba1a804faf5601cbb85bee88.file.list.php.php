<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 14:28:15
         compiled from "application/views/pages/student/list.php" */ ?>
<?php /*%%SmartyHeaderCode:23723432854d0ccef50df08-28244576%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f91bc746ce7b1535ba1a804faf5601cbb85bee88' => 
    array (
      0 => 'application/views/pages/student/list.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23723432854d0ccef50df08-28244576',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageUser' => 0,
    'school' => 0,
    'students' => 0,
    'cur' => 0,
    'cur2' => 0,
    'key' => 0,
    'key2' => 0,
    'date' => 0,
    'lists' => 0,
    'key3' => 0,
    'external_students' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d0ccef718936_05065698',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d0ccef718936_05065698')) {function content_54d0ccef718936_05065698($_smarty_tpl) {?>
<div class="box schedules blue">
    <h1>Utövare <?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type=="150"){?><?php echo $_smarty_tpl->tpl_vars['school']->value->title;?>
<?php }?> <a href="/school/statistics/<?php echo $_smarty_tpl->tpl_vars['school']->value->id;?>
" title="Statistik för skola"><img src="/assets/images/stats.png" /></a></h1>
    
</div>

<table class="box schedules">
    <?php if (count($_smarty_tpl->tpl_vars['students']->value)){?>
    <tr class="group-header">
        <td colspan="<?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type=="150"){?>9<?php }else{ ?>8<?php }?>" style="background-color: #cccccc;">
            <?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type!="150"){?>
            <a href="/student/add">
                Lägg till utövare
            </a>
            <?php }?>
        </td>
    </tr>
    <?php }else{ ?>
    <tr>
        <td colspan="8">
            Lägg upp grupper innan du administrerar användare.
        </td>
    </tr>
    <?php }?>

    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['students']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cur']->key;
?>
        <?php if (count($_smarty_tpl->tpl_vars['cur']->value->users)!=0){?>
        <tr class="group-header">
            <th colspan="<?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type=="150"){?>9<?php }else{ ?>8<?php }?>" style="background-color: #cccccc;"><?php echo $_smarty_tpl->tpl_vars['cur']->value->title;?>
<?php if (count($_smarty_tpl->tpl_vars['cur']->value->users)!=0){?>&nbsp;<a href="/group/statistics/<?php echo $_smarty_tpl->tpl_vars['cur']->value->group_id;?>
" alt="Visa statistik för grupp"><img src="/assets/images/stats.png" title="Visa statistik för grupp" /></a><?php }?> 
            <img src="/assets/images/plus.png" width="25" class="group-header-toggle" />
            </th>
        </tr>
        <?php }?>
        <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur2']->_loop = false;
 $_smarty_tpl->tpl_vars['key2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cur']->value->users; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
$_smarty_tpl->tpl_vars['cur2']->_loop = true;
 $_smarty_tpl->tpl_vars['key2']->value = $_smarty_tpl->tpl_vars['cur2']->key;
?>
        <tr>
            <td <?php if (!$_smarty_tpl->tpl_vars['cur2']->value->active){?>class="inactive"<?php }?>><?php echo $_smarty_tpl->tpl_vars['cur2']->value->fullname;?>
</td>
            <td style="width: 500px; text-align: center; color: darkgray; font-size: smaller;" id="<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
" class="tooltip"></td>
            <td style="width: 32px;" <?php if ($_smarty_tpl->tpl_vars['cur2']->value->active){?>onmouseout="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('');" onmouseover="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('Visa chat');"<?php }?>><?php if ($_smarty_tpl->tpl_vars['cur2']->value->active){?><a href="/student/chat/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->user_id;?>
" style="text-decoration: none;"><img src="/assets/images/discussion.png" style="vertical-align: -10px;" /> <span style="color: #666; font-size: 8pt;"><?php echo $_smarty_tpl->tpl_vars['cur2']->value->user_chat_updated;?>
</span></a><?php }?></td>
            <td style="width: 32px;" onmouseout="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('');" onmouseover="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('Visa statistik');"><a href="/student/statistics/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->user_id;?>
"><img src="/assets/images/stats.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('');" onmouseover="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('Visa kalender');"><a href="/overview/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->user_id;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/5"><img src="/assets/images/calender.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('');" onmouseover="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('Visa årsplanering');"><a href="/student/plan/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->user_id;?>
"><img src="/assets/images/time.png" /></a></td>
            <td style="width: 32px;" <?php if ($_smarty_tpl->tpl_vars['cur2']->value->active){?>onmouseout="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('');" onmouseover="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('Ändra egenskaper');"><a href="/student/edit/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->user_id;?>
"><img src="/assets/images/edit.png" /></a><?php }?></td>
            <td style="width: 32px;" onmouseout="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('');" onmouseover="$('#<?php echo ($_smarty_tpl->tpl_vars['key']->value).($_smarty_tpl->tpl_vars['key2']->value);?>
').text('Ta bort utövaren');"><a href="/student/delete/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->user_id;?>
/<?php echo $_smarty_tpl->tpl_vars['cur']->value->group_id;?>
"><img src="/assets/images/remove.png" /></a></td>
            <?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type=="150"){?>
            <?php if ($_smarty_tpl->tpl_vars['lists']->value){?>
            <td style="width: 100px; text-align: left; background: #c0c0c0; padding: 10px;">
                <form name="save_to_list" action="/ssf/save/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->user_id;?>
" method="post">
                    <select style="width: 120px; height: 75px; border: 0px;" multiple name="lists[]">
                        <?php  $_smarty_tpl->tpl_vars['cur3'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur3']->_loop = false;
 $_smarty_tpl->tpl_vars['key3'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['lists']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['cur3']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['cur3']->key => $_smarty_tpl->tpl_vars['cur3']->value){
$_smarty_tpl->tpl_vars['cur3']->_loop = true;
 $_smarty_tpl->tpl_vars['key3']->value = $_smarty_tpl->tpl_vars['cur3']->key;
 $_smarty_tpl->tpl_vars['cur3']->iteration++;
?>
                        <option value='favs_<?php echo $_smarty_tpl->tpl_vars['cur3']->iteration;?>
' <?php if (in_array($_smarty_tpl->tpl_vars['cur3']->iteration,$_smarty_tpl->tpl_vars['cur2']->value->lists)){?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['key3']->value;?>
</option>
                        <?php } ?>
                    </select>
                    <input type="submit" value="Spara" />
                </form>
            </td>
            <?php }?>
            <?php }?>
        </tr>
        <?php } ?>
    <?php } ?>
    <?php if (count($_smarty_tpl->tpl_vars['students']->value)){?>
    <tr class="group-header">
        <td colspan="<?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type=="150"){?>9<?php }else{ ?>8<?php }?>" style="background-color: #cccccc;">
            <?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type!="150"){?>
            <a href="/student/add">
                Lägg till utövare
            </a>
            <?php }?>
        </td>
    </tr>
    <?php }else{ ?>
    <tr>
        <td colspan="8">
            Lägg upp grupper innan du administrerar användare.
        </td>
    </tr>
    <?php }?>
</table>

<?php if (count($_smarty_tpl->tpl_vars['external_students']->value)!=0){?>
<div class="box schedules blue">
    <h1> Externa Utövare </h1>
</div>

<table class="box schedules">
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['external_students']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cur']->key;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['cur']->value->fullname;?>
 - <?php echo $_smarty_tpl->tpl_vars['cur']->value->email;?>
</td>
            <td style="width: 96px; text-align: center; color: darkgray; font-size: smaller;" id="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" class="tooltip"></td>
            <td style="width: 64px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('Visa chat');"><a href="/student/chat/<?php echo $_smarty_tpl->tpl_vars['cur']->value->user_id;?>
" style="text-decoration: none;"><img src="/assets/images/discussion.png" style="vertical-align: -10px;" /> <span style="color: #666; font-size: 8pt;"><?php echo $_smarty_tpl->tpl_vars['cur']->value->user_chat_updated;?>
</span></a></td>
            <td style="width: 32px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('Visa statistik');"><a href="/student/statistics/<?php echo $_smarty_tpl->tpl_vars['cur']->value->user_id;?>
"><img src="/assets/images/stats.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('Visa kalender');"><a href="/student/calendar/<?php echo $_smarty_tpl->tpl_vars['cur']->value->user_id;?>
"><img src="/assets/images/calender.png" /></a></td>
            <td style="width: 32px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
').text('Visa årsplanering');"><a href="/student/plan/<?php echo $_smarty_tpl->tpl_vars['cur']->value->user_id;?>
"><img src="/assets/images/time.png" /></a></td>
        </tr>
    <?php } ?>
</table>
<?php }?>
<?php }} ?>