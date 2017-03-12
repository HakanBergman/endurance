<?php

function smarty_modifier_length($length) {
    if($length == 0) { return ''; }
    return sprintf("%u:%02u", floor($length/3600), floor($length/60) % 60);
}
