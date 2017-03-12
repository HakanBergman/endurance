<?php

function smarty_modifier_weekday($weekday) {
    return ucfirst(strftime("%a", (3 + $weekday)*24*3600+10800));
}
