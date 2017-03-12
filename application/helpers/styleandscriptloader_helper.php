<?php

function loadCss($mobile = false) {
    $dir = dirname(__FILE__) . '/../../assets/css';
    
    $css = "";
    $css .= file_get_contents("$dir/activity.css");
    $css .= file_get_contents("$dir/button.css");        
    $css .= file_get_contents("$dir/fullcalendar.css");
    $css .= file_get_contents("$dir/jquery-ui.css");
    $css .= file_get_contents("$dir/notice.css");
    $css .= file_get_contents("$dir/schedule.css");
    $css .= file_get_contents("$dir/scheduler.css");
    $css .= file_get_contents("$dir/site.css");
    $css .= file_get_contents("$dir/statistics.css");
    $css .= file_get_contents("$dir/tabs.css");
    $css .= file_get_contents("$dir/workout.css");
    if($mobile == "mobile") { 
         $css .= file_get_contents("$dir/x_mobile.css");
         
    }
    
    return $css;
    
}

function loadjJs($mobile = false) {
    $dir = dirname(__FILE__) . '/../../assets/js';
    $script = "";
    /* jQuery 1.11.0 */
    $script .= file_get_contents("$dir/jquery-1.11.0.min.js");
    $script .= file_get_contents("$dir/jquery-migrate-1.2.1.min.js");

    /* jQuery UI 1.8.17 */
    $script .= file_get_contents("$dir/jquery-ui.js");
    $script .= file_get_contents("$dir/jquery.ui.touch-punch.min.js");
    $script .= file_get_contents("$dir/workout.scheduler.js");
    $script .= file_get_contents("$dir/workout.duration.js");
    $script .= file_get_contents("$dir/workout.popup.js");
    $script .= file_get_contents("$dir/workout.chart.js");
    $script .= file_get_contents("$dir/fullcalendar.js");
    $script .= file_get_contents("$dir/events.js");
    if($mobile == "mobile") { 
        
    }
    
    return $script;
}