<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>{'title'|Domains}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="shortcut icon" href="/img/favicon.png" />
        {if isset($mobile)}
        <link rel="stylesheet" type="text/css" href="/assets/stylesheets/mobile" />
        {else}
        <link rel="stylesheet" type="text/css" href="/assets/stylesheets" />
        {/if}
        <script type="text/javascript" src="/assets/scripts"></script>

        {*<link href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold" rel="stylesheet" type="text/css" />*}
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
                    {if $pageUser !== false}
                    {if $pageUser->type == "10"}
                    <a href="/activity" class="activity">Registrera aktivitet</a>
                    <a href="/overview/{$pageUser->id}/{$date->year}/{$date->period}/5" id="overview">Översikt</a>
                    
                    {if $ismobile}
                        {if isset($version)}
                            {if $version == 'regular'}
                            <img src="/assets/images/sep.png" alt="|" width="2" height="24" class="sep" />
                            <a href="/mswitch/mobile/{$user->id}/{$date->year}/{$date->period}/{$date->week}/{$date->day}">Mobilanpassad</a>
                            {elseif $version == 'mobile'}
                            <a href="/mswitch/regular/{$user->id}/{$date->year}/{$date->period}/{$date->week}/{$date->day}">Växla till ej mobilanpassad</a>
                            {/if}
                        {/if}
                    {else}
                        {if isset($version)}
                            {if $version == 'mobile'}
                            <a href="/mswitch/regular/{$user->id}/{$date->year}/{$date->period}/{$date->week}/{$date->day}">Växla till ej mobilanpassad</a>
                            {/if}
                        {/if}
                    {/if}
                    
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" class="sep" />
                    <a href="/template/workout" id="pass">Pass</a>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" class="sep" />
                    <a href="/student/chat/{$pageUser->id}" id="chat">Chat{if $pageUserChat} <span style="color: #666; font-size: 8pt;">{$pageUserChat->updated}</span>{/if}</a>

                    

                    {elseif $pageUser->type == "50"}
                    <a href="/group/list">Grupper</a>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" />
                    <a href="/student/list">Utövare</a>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" />
                    <a href="/template/workout">Pass</a>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" />
                    <a href="/schedule/list">Program</a>
                    {elseif $pageUser->type == "100"}
                    <a href="/teacher/list">Tränare</a>
                    {elseif $pageUser->type == "5"}
                    <a href="/external">Utövare</a>
                    {elseif $pageUser->type == "150"}
                    <a href="/ssf">Översikt</a>
                    {/if}
                    {if $pageUser->type != "100"}
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" />
                    <a href="/event/calendar" id="calendar">Kalender</a>
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" class="sep" />
                    {/if}
                    {/if}
                </div>
                <div class="floatright">
                    {if $pageUser === false}
                    <a href="/">Logga in</a>
                    {else}
                    {*if $page_user_school}{$page_user_school->title} - {/if*}<a href="/user" id="profile">{$pageUser->fullname}</a>{* <span style="padding-left: 8px;" onclick="$('#temp').toggle(400);"><img src="/assets/images/down.png" /></span>*}
                    <img src="/assets/images/sep.png" alt="|" width="2" height="24" class="sep" />
                    <a href="/login/logout">Logga ut</a>
                    {/if}
                </div>

                <div id="temp" style="float: right; clear: both; display: none; white-space: nowrap;">
                    <a href="/login/out">Logga ut</a>
                </div>

            </div>
        </div>

        <div id="mid">
            {display_notices()}
            <div id="site">