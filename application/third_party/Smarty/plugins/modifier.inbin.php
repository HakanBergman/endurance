<?php

function smarty_modifier_inbin($value, $bin) {
    return (($bin >> $value) & 1);
}
