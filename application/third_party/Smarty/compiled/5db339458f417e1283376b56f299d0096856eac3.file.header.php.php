<?php /* Smarty version Smarty-3.1.13, created on 2015-02-03 14:28:13
         compiled from "application/views/header.php" */ ?>
<?php /*%%SmartyHeaderCode:82303846254d0cced3b2075-97506708%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5db339458f417e1283376b56f299d0096856eac3' => 
    array (
      0 => 'application/views/header.php',
      1 => 1422969584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '82303846254d0cced3b2075-97506708',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mobile' => 0,
    'pageUser' => 0,
    'date' => 0,
    'ismobile' => 0,
    'version' => 0,
    'user' => 0,
    'pageUserChat' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_54d0cced4cfee4_01738623',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d0cced4cfee4_01738623')) {function content_54d0cced4cfee4_01738623($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_Domains')) include '/opt/endurance.se/htdocs/application/third_party/Smarty/plugins/modifier.Domains.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo smarty_modifier_Domains('title');?>
</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="shortcut icon" href="/img/favicon.png" />
        <?php if (isset($_smarty_tpl->tpl_vars['mobile']->value)){?>
        <link rel="stylesheet" type="text/css" href="/assets/stylesheets/mobile" />
        <?php }else{ ?>
        <link rel="stylesheet" type="text/css" href="/assets/stylesheets" />
        <?php }?>
        <script type="text/javascript" src="/assets/scripts"></script>

        
        <meta name="viewport" content="initial-scale=1">
            <script type="text/javascript" src="/assets/js/analytics.js"></script>
    </head>
    <body>



        <div id="top">

            <a href="/" id="logo">

                <h1><b>Tränings</b>dagboken</h1>

                <div><tt></tt><tt></tt><tt></tt><tt></tt></div>

            </a>



            <div id="links">
                <div class="floatleft">
                    <?php if ($_smarty_tpl->tpl_vars['pageUser']->value!==false){?>
                    <?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type=="10"){?>
                    <a href="/activity" class="activity">Registrera aktivitet</a>
                    <a href="/overview/<?php echo $_smarty_tpl->tpl_vars['pageUser']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/5" id="overview">Översikt</a>
                    
                    <?php if ($_smarty_tpl->tpl_vars['ismobile']->value){?>
                        <?php if (isset($_smarty_tpl->tpl_vars['version']->value)){?>
                            <?php if ($_smarty_tpl->tpl_vars['version']->value=='regular'){?>
                            <img src="/assets/images/sep.png" alt="|" width="2" height="24" class="sep" />
                            <a href="/mswitch/mobile/<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->day;?>
">Mobilanpassad</a>
                            <?php }elseif($_smarty_tpl->tpl_vars['version']->value=='mobile'){?>
                            <a href="/mswitch/regular/<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->day;?>
">Växla till ej mobilanpassad</a>
                            <?php }?>
                        <?php }?>
                    <?php }else{ ?>
                        <?php if (isset($_smarty_tpl->tpl_vars['version']->value)){?>
                            <?php if ($_smarty_tpl->tpl_vars['version']->value=='mobile'){?>
                            <a href="/mswitch/regular/<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->year;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->period;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->week;?>
/<?php echo $_smarty_tpl->tpl_vars['date']->value->day;?>
">Växla till ej mobilanpassad</a>
                            <?php }?>
                        <?php }?>
                    <?php }?>
                    
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" class="sep" />
                    <a href="/template/workout" id="pass">Pass</a>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" class="sep" />
                    <a href="/student/chat/<?php echo $_smarty_tpl->tpl_vars['pageUser']->value->id;?>
" id="chat">Chat<?php if ($_smarty_tpl->tpl_vars['pageUserChat']->value){?> <span style="color: #666; font-size: 8pt;"><?php echo $_smarty_tpl->tpl_vars['pageUserChat']->value->updated;?>
</span><?php }?></a>

                    

                    <?php }elseif($_smarty_tpl->tpl_vars['pageUser']->value->type=="50"){?>
                    <a href="/group/list">Grupper</a>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" />
                    <a href="/student/list">Utövare</a>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" />
                    <a href="/template/workout">Pass</a>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" />
                    <a href="/schedule/list">Program</a>
                    <?php }elseif($_smarty_tpl->tpl_vars['pageUser']->value->type=="100"){?>
                    <a href="/teacher/list">Tränare</a>
                    <?php }elseif($_smarty_tpl->tpl_vars['pageUser']->value->type=="5"){?>
                    <a href="/external">Utövare</a>
                    <?php }elseif($_smarty_tpl->tpl_vars['pageUser']->value->type=="150"){?>
                    <a href="/ssf">Översikt</a>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['pageUser']->value->type!="100"){?>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" />
                    <a href="/event/calendar" id="calendar">Kalender</a>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" class="sep" />
                    <?php }?>
                    <?php }?>
                </div>
                <div class="floatright">
                    <?php if ($_smarty_tpl->tpl_vars['pageUser']->value===false){?>
                    <a href="/">Logga in</a>
                    <?php }else{ ?>
                    <a href="/user" id="profile"><?php echo $_smarty_tpl->tpl_vars['pageUser']->value->fullname;?>
</a>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" class="sep" />
                    <a href="/login/logout">Logga ut</a>
                    <?php }?>
                </div>

                <div id="temp" style="float: right; clear: both; display: none; white-space: nowrap;">
                    <a href="/login/out">Logga ut</a>
                </div>

            </div>
        </div>

        <div id="mid">
            <?php echo display_notices();?>

            <div id="site"><?php }} ?>