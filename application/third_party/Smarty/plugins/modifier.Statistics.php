<?php

function smarty_modifier_Statistics($key) {
    return call_user_func_array(array('Statistics', 'get'), func_get_args());
}
