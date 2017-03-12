<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 22:38:19
         compiled from "application/views/pages/student/list_ssf.php" */ ?>
<?php /*%%SmartyHeaderCode:86164552554d13fcbe2a2d1-14571226%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '008bbf1307a712a9e33cbaf567b83d7e5b3d91a8' => 
    array (
      0 => 'application/views/pages/student/list_ssf.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86164552554d13fcbe2a2d1-14571226',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'searchresult' => 0,
    'cur' => 0,
    'key' => 0,
    'date' => 0,
    'favs' => 0,
    'key2' => 0,
    'cur2' => 0,
    'schools' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d13fcc07c523_87404757',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d13fcc07c523_87404757')) {function content_54d13fcc07c523_87404757($_smarty_tpl) {?><div class="box schedules blue">
    <h1> Sök utövare </h1>
</div>
<table class="box schedules search">
    <tr>
        <th style="text-align: left; padding: 10px;" colspan="8">
            <form name="input" action="/ssf" method="get">
                <input id="search_shttp://open.spotify.com/local/Lars+Winnerb%c3%a4ck/3486+Ord+Fr%c3%a5n.../Iv%c3%a4g+Till+Hemligheten/185tudent" name="search_student" />
                <input type="submit" value="Sök" />
            </form>
        </th>
    </tr>
    <?php if ($_smarty_tpl->tpl_vars['searchresult']->value){?>
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['searchresult']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['cur']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cur']->key;
 $_smarty_tpl->tpl_vars['cur']->iteration++;
?>
    
    <tr class="searchresult">
        <td><?php echo $_smarty_tpl->tpl_vars['cur']->value->fullname;?>
 <?php if ($_smarty_tpl->tpl_vars['cur']->value->group){?><br /> <?php echo $_smarty_tpl->tpl_vars['cur']->value->group->title;?>
<?php }?> <?php if ($_smarty_tpl->tpl_vars['cur']->value->school){?><br /> <a href="/student/list/<?php echo $_smarty_tpl->tpl_vars['cur']->value->school->id;?>
"><?php echo $_smarty_tpl->tpl_vars['cur']->value->school->title;?>
</a><?php }?></td>
        <td style="width: 96px; text-align: center; color: darkgray; font-size: smaller;" id="field_<?php echo trim($_smarty_tpl->tpl_vars['key']->value);?>
" class="tooltip"></td>
        
        <td style="width: 32px;" onmouseout="$('#field_<?php echo trim($_smarty_tpl->tpl_vars['key']->value);?>
').text('');" onmouseover="$('#field_<?php echo trim($_smarty_tpl->tpl_vars['key']->value);?>
').text('Visa chat');"><a href="/student/chat/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
" style="text-decoration: none;"><img src="/assets/images/discussion.png" style="vertical-align: -10px;" /> <span style="color: #666; font-size: 8pt;"></span></a></td>
        <td style="width: 32px;" onmouseout="$('#field_<?php echo trim($_smarty_tpl->tpl_vars['key']->value);?>
').text('');" onmouseover="$('#field_<?php echo trim($_smarty_tpl->tpl_vars['key']->value);?>
').text('Visa statistik');"><a href="/student/statistics/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><img src="/assets/images/stats.png" /></a></td>
        <td style="width: 32px;" onmouseout="$('#field_<?php echo trim($_smarty_tpl->tpl_vars['key']->value);?>
').text('');" onmouseover="$('#field_<?php echo trim($_smarty_tpl->tpl_vars['key']->value);?>
').text('Visa kalender');"><a href="/overview/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/5"><img src="/assets/images/calender.png" /></a></td>
        <td style="width: 32px;" onmouseout="$('#field_<?php echo trim($_smarty_tpl->tpl_vars['key']->value);?>
').text('');" onmouseover="$('#field_<?php echo trim($_smarty_tpl->tpl_vars['key']->value);?>
').text('Visa årsplanering');"><a href="/student/plan/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><img src="/assets/images/time.png" /></a></td>
        <td style="width: 32px;" onmouseout="$('#field_<?php echo trim($_smarty_tpl->tpl_vars['key']->value);?>
').text('');" onmouseover="$('#field_<?php echo trim($_smarty_tpl->tpl_vars['key']->value);?>
').text('Ändra egenskaper');"><a href="/student/edit/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><img src="/assets/images/edit.png" /></a></td>
        <td style="width: 174px; text-align: left; background: #c0c0c0; padding: 10px;">
            <form name="save_to_list" action="/ssf/save/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
" method="post">
            <select style="width: 120px; height: 75px; border: 0px;" multiple name="lists[]">
                <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur2']->_loop = false;
 $_smarty_tpl->tpl_vars['key2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['favs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['cur2']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
$_smarty_tpl->tpl_vars['cur2']->_loop = true;
 $_smarty_tpl->tpl_vars['key2']->value = $_smarty_tpl->tpl_vars['cur2']->key;
 $_smarty_tpl->tpl_vars['cur2']->iteration++;
?>
                    <option value='favs_<?php echo $_smarty_tpl->tpl_vars['cur2']->iteration;?>
' <?php if (in_array($_smarty_tpl->tpl_vars['cur2']->iteration,$_smarty_tpl->tpl_vars['cur']->value->lists)){?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
</option>
                <?php } ?>
            </select>
            <input type="submit" value="Spara" />
            </form>
        </td>
    </tr>
    <?php } ?>
    <?php }?>
</table>
<br />
<div class="box schedules blue">
    <h1> Favoriter </h1>
</div>
<table class="box schedules favourites">
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['favs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['cur']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cur']->key;
 $_smarty_tpl->tpl_vars['cur']->iteration++;
?>
    <tr>
        <th colspan="6" style="background-color: #cccccc; text-align: left; padding-left: 10px;">
            <?php echo $_smarty_tpl->tpl_vars['key']->value;?>

        </th>
        <th style="background-color: #cccccc; text-align: right; padding-right: 10px;">
            <a href="/ssf/list/<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
">
                <img src="/assets/images/edit.png" height="20px" title="Redigera lista" />
            </a>
        </th>
    </tr>
        <?php  $_smarty_tpl->tpl_vars['cur2'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur2']->_loop = false;
 $_smarty_tpl->tpl_vars['key2'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cur']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['cur2']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['cur2']->key => $_smarty_tpl->tpl_vars['cur2']->value){
$_smarty_tpl->tpl_vars['cur2']->_loop = true;
 $_smarty_tpl->tpl_vars['key2']->value = $_smarty_tpl->tpl_vars['cur2']->key;
 $_smarty_tpl->tpl_vars['cur2']->iteration++;
?>
            <?php if ($_smarty_tpl->tpl_vars['cur2']->value){?>
                <tr>
                    <td>
                        <?php echo $_smarty_tpl->tpl_vars['cur2']->value->fullname;?>
<br />
                        <?php echo $_smarty_tpl->tpl_vars['cur2']->value->email;?>

                    </td>
                    <td style="width: 96px; text-align: center; color: darkgray; font-size: smaller;" id="<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
<?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
" class="tooltip"></td>
                    <td style="width: 64px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
<?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
<?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
').text('Visa chat');"><a href="/student/chat/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->id;?>
" style="text-decoration: none;"><img src="/assets/images/discussion.png" style="vertical-align: -10px;" /> <span style="color: #666; font-size: 8pt;"><?php echo $_smarty_tpl->tpl_vars['cur2']->value->user_chat_updated;?>
</span></a></td>
                    <td style="width: 32px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
<?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
<?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
').text('Visa statistik');"><a href="/student/statistics/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->id;?>
"><img src="/assets/images/stats.png" /></a></td>
                    <td style="width: 32px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
<?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
<?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
').text('Visa kalender');"><a href="/overview/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/5"><img src="/assets/images/calender.png" /></a></td>
                    <td style="width: 32px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
<?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
<?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
').text('Visa årsplanering');"><a href="/student/plan/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->id;?>
"><img src="/assets/images/time.png" /></a></td>
                    <td style="width: 32px;" onmouseout="$('#<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
<?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
').text('');" onmouseover="$('#<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
<?php echo $_smarty_tpl->tpl_vars['key2']->value;?>
').text('Ta bort från lista');"><a href="/ssf/remove/<?php echo $_smarty_tpl->tpl_vars['cur']->iteration;?>
/<?php echo $_smarty_tpl->tpl_vars['cur2']->value->id;?>
" onclick="return confirm('Vill du verkligen ta bort utövaren från denna lista?');"><img src="/assets/images/remove.png" /></a></td>
                </tr>
            <?php }?>
        <?php } ?>
    <?php } ?>
</table>
<br />
<div class="box schedules blue">
    <h1> Skolor <a alt="Visa statistik för grupp" href="/ssf/statistics"><img title="Visa statistik för grupp" src="/assets/images/stats.png"></a></h1>
</div>
<table class="box schedules">
    <?php  $_smarty_tpl->tpl_vars['cur'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cur']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['schools']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['cur']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['cur']->key => $_smarty_tpl->tpl_vars['cur']->value){
$_smarty_tpl->tpl_vars['cur']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['cur']->key;
 $_smarty_tpl->tpl_vars['cur']->iteration++;
?>
    <tr>
        <td>
            <a href="/student/list/<?php echo $_smarty_tpl->tpl_vars['cur']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['cur']->value->title;?>
</a>
        </td>
        <td style="width: 32px; text-align: right; margin-right: 10px;"><a alt="Visa statistik för grupp" href="/group/statistics/33"><img title="Visa statistik för grupp" src="/assets/images/stats.png"></a></td>
    </tr>
    <?php } ?>
</table>
<?php }} ?>